"use strict"

class ColorPicker extends elementorModules.Module {
	constructor( ...args ) {
		super( ...args );

		this.createPicker();
	}

	getDefaultSettings() {
		return {
			picker: {
				theme: 'monolith',
				position: 'bottom-middle',
				components: {
					opacity: true,
					hue: true,
					interaction: {
						input: true,
						hex: true,
						rgba: true,
						hsla: true,
					},
				},
			},
			classes: {
				active: 'elementor-active',
				pickerHeader: 'elementor-color-picker__header',
				pickerToolsContainer: 'e-color-picker__tools',
				pickerTool: 'e-control-tool',
				clearButton: 'e-color-picker__clear',
				plusIcon: 'eicon-plus',
			},
		};
	}

	createPicker() {
		const pickerSettings = this.getSettings( 'picker' );

		pickerSettings.default = pickerSettings.default || null;

		this.picker = new Pickr( pickerSettings );

		// Set a default palette. It doesn't affect the selected value.
		this.picker.setColor( pickerSettings.default || '#020101' );

		this.color = this.processColor();

		this.picker
			.on( 'change', () => this.onPickerChange() )
			.on( 'clear', () => this.onPickerClear() )
			.on( 'show', () => this.onPickerShow() )
			.on( 'hide', () => this.onPickerHide() );

		this.$pickerAppContainer = jQuery( this.picker.getRoot().app );

		this.createPickerHeader();
	}

	addTipsyToClearButton() {
		this.$clearButton.tipsy( {
			title: () => 'Clear',
			gravity: () => 's',
		} );
	}

	processColor() {
		const color = this.picker.getColor();

		let colorRepresentation;

		if ( 1 === color.a ) {
			colorRepresentation = color.toHEXA();
		} else {
			colorRepresentation = color.toRGBA();
		}

		return colorRepresentation.toString();
	}

	getColor() {
		return this.color;
	}

	createPickerHeader() {
		const { classes } = this.getSettings(),
			$pickerHeader = jQuery( '<div>', { class: classes.pickerHeader } )
				.text( 'Color Picker' ),
			$pickerToolsContainer = jQuery( '<div>', { class: classes.pickerToolsContainer } ),
			addButton = this.getSettings( 'addButton' );

		this.$pickerToolsContainer = $pickerToolsContainer;

		if ( addButton ) {
			this.createAddButton();
		}

		this.createClearButton();

		$pickerToolsContainer.append( this.$clearButton, this.$addButton );

		$pickerHeader.append( $pickerToolsContainer );

		this.$pickerAppContainer.prepend( $pickerHeader );
	}

	createAddButton() {
		const { classes } = this.getSettings();

		this.$addButton = jQuery( '<button>', { class: classes.pickerTool } ).html( jQuery( '<i>', { class: classes.plusIcon } ) );

		this.$addButton.on( 'click', () => this.onAddButtonClick() );

		this.$addButton.tipsy( {
			title: () => 'Create New Global Color',
			gravity: () => 's',
		} );
	}

	// Move the clear button from Pickr's default location into the Color Picker header.
	createClearButton() {
		const { classes } = this.getSettings();

		this.$clearButton = jQuery( '<div>', { class: classes.clearButton + ' ' + classes.pickerTool } )
			.html( '<i class="eicon-undo"></i>' );

		this.$clearButton.on( 'click', () => this.picker._clearColor() );

		this.addTipsyToClearButton();
	}

	destroy() {
		this.picker.destroyAndRemove();
	}

	// TODO: CHECK IF THIS IS STILL NECESSARY
	fixTipsyForFF( $button ) {
		// There's a bug in FireFox about hiding the tooltip after the button was clicked,
		// So let's force it to hide.
		$button.data( 'tipsy' ).hide();
	}

	introductionViewed() {
		return ColorPicker.droppingIntroductionViewed || elementor.config.user.introduction.colorPickerDropping;
	}

	toggleClearButtonState( active ) {
		this.$clearButton.toggleClass( 'e-control-tool-disabled', ! active );
	}

	onPickerChange() {
		this.picker.applyColor();

		const newColor = this.processColor();

		if ( newColor === this.color ) {
			return;
		}

		this.color = newColor;

		const onChange = this.getSettings( 'onChange' );

		if ( onChange ) {
			onChange();
		}
	}

	onPickerClear() {
		this.color = '';

		const onClear = this.getSettings( 'onClear' );

		if ( onClear ) {
			onClear();
		}
	}

	onPickerShow() {
		const { result: resultInput } = this.picker.getRoot().interaction;
		const onPickerShow = this.getSettings( 'onPickerShow' );

		if ( onPickerShow ) {
			onPickerShow();
		}

		setTimeout( () => {
			resultInput.select();
		}, 100 );
	}

	onPickerHide() {
		const onPickerHide = this.getSettings( 'onPickerHide' );

		if ( onPickerHide ) {
			onPickerHide();
		}
	}

	onAddButtonClick() {
		this.picker.hide();

		const onPickerAddButtonClick = this.getSettings( 'onAddButtonClick' );

		if ( onPickerAddButtonClick ) {
			onPickerAddButtonClick();
		}

		this.fixTipsyForFF( this.$addButton );
	}
}

elementor.addControlView(
    'ColorTuplet',
    elementor.modules.controls.BaseMultiple.extend({
        ui: function ui() {
            var ui = elementor.modules.controls.BaseMultiple.prototype.ui.apply(this, arguments);
            ui.colorPickerPlaceholder = '.elementor-color-picker-placeholder';
            return ui;
        },
        initColors: function initColors() {
            var _this2 = this;

            this.colorPicker1 = new ColorPicker({
                picker: {
                    el: this.ui.colorPickerPlaceholder[0],
                    default: this.getControlValue( this.model.get( 'name' ) )
                },
                onChange: function onChange() {
                    _this2.setValue(_this2.model.attributes.name, _this2.colorPicker1.getColor());
                },
                onClear: function onClear() {
                    _this2.setValue(_this2.model.attributes.name, '');
                }
            });
            this.colorPicker2 = new ColorPicker({
                picker: {
                    el: this.ui.colorPickerPlaceholder[1],
                    default: this.getControlValue( this.model.get( 'name' ) + '_2' )
                },
                onChange: function onChange() {
                    _this2.setValue(`${_this2.model.attributes.name}_2`, _this2.colorPicker2.getColor());
                },
                onClear: function onClear() {
                    _this2.setValue(`${_this2.model.attributes.name}_2`, '');
                }
            });

        },
        onReady: function onReady() {
            this.initColors();
        },
        onBeforeDestroy: function onBeforeDestroy() {
            this.colorPicker1.destroy();
            this.colorPicker2.destroy();
        }
    })
)

elementor.addControlView(
    'Playlist',
    elementor.modules.controls.BaseData.extend({
        ui: function ui() {
            var ui = elementor.modules.controls.BaseData.prototype.ui.apply(this, arguments);
            ui.addTracks = '.elementor-control-playlist-add';
            ui.clearPlaylist = '.elementor-control-playlist-clear';
            ui.playlistThumbnails = '.elementor-control-playlist-thumbnails';
            ui.status = '.elementor-control-playlist-status-title';
            return ui;
        },
        events: function events() {
            return _.extend(elementor.modules.controls.BaseData.prototype.events.apply(this, arguments), {
                'click @ui.addTracks': 'onAddTracksClick',
                'click @ui.clearPlaylist': 'onClearPlaylistClick',
                'click @ui.playlistThumbnails': 'onPlaylistThumbnailsClick'
            });
        },
        onReady: function onReady() {
            this.initRemoveDialog();
        },
        applySavedValue: function applySavedValue() {
            var tracks = this.getControlValue(),
            tracksCount = tracks.length,
            hasTracks = !!tracksCount;
            this.$el.toggleClass('elementor-playlist-has-tracks', hasTracks).toggleClass('elementor-playlist-empty', !hasTracks);
            this.ui.status.text(elementor.translate(hasTracks ? 'playlist_tracks_selected' : 'playlist_no_tracks_selected', [tracksCount]));
            this.ui.playlistThumbnails.empty()

            if (!hasTracks) {
                return;
            }

            var attachments = wp.media.query({
                orderby: 'post__in',
                order: 'ASC',
                type: 'audio',
                perPage: -1,
                post__in: _.pluck(tracks, 'id')
            });
            attachments.more().done( () => {
                this.buildThumbnails( attachments )
            })
        },

        buildThumbnails: function buildThumbnails( attachments ) {
            var $playlistThumbnails = this.ui.playlistThumbnails;
            this.getControlValue().forEach(function (track) {
                var $thumbnail = jQuery('<div>', {
                    class: 'elementor-control-playlist-thumbnail'
                });
                const trackAttachment = Object.values(attachments.models).find( (m) => m.id === track.id )
                if ( trackAttachment ) {
                    if ( trackAttachment.attributes && trackAttachment.attributes.thumb )
                        $thumbnail.css('background-image', 'url(' + trackAttachment.attributes.thumb.src + ')');
                }
                $playlistThumbnails.append($thumbnail);
            });
        },

        hasTracks: function hasTracks() {
            return !!this.getControlValue().length;
        },
        openFrame: function openFrame(action) {
            this.initFrame(action);
            this.frame.open();
        },
        initFrame: function initFrame(action) {
            var frameStates = {
                create: 'playlist',
                add: 'playlist-library',
                edit: 'playlist-edit'
            };
            var options = {
                frame: 'post',
                multiple: true,
                state: frameStates[action],
                button: {
                    text: elementor.translate('insert_tracks')
                }
            };

            if (this.hasTracks()) {
                options.selection = this.fetchSelection();
            }

            this.frame = wp.media(options); // When a file is selected, run a callback.

            this.frame.on({
                update: this.select,
                'menu:render:default': this.menuRender,
                'content:render:browse': this.playlistSettings
            }, this);
        },
        menuRender: function menuRender(view) {
            view.unset('insert');
            view.unset('featured-image');
        },
        playlistSettings: function playlistSettings(browser) {
            browser.sidebar.on('ready', function () {
                browser.sidebar.unset('playlist');
            });
        },
        fetchSelection: function fetchSelection() {
            var attachments = wp.media.query({
                orderby: 'post__in',
                order: 'ASC',
                type: 'audio',
                perPage: -1,
                post__in: _.pluck(this.getControlValue(), 'id')
            });
            return new wp.media.model.Selection(attachments.models, {
                props: attachments.props.toJSON(),
                multiple: true
            });
        },

        /**
        * Callback handler for when an attachment is selected in the media modal.
        * Gets the selected track information, and sets it within the control.
        */
        select: function select(selection) {
            var tracks = [];
            selection.each(function (track) {
                tracks.push({
                    id: track.get('id'),
                    url: track.get('url')
                });
            });
            this.setValue(tracks);
            this.applySavedValue();
        },
        onBeforeDestroy: function onBeforeDestroy() {
            if (this.frame) {
                this.frame.off();
            }

            this.$el.remove();
        },
        resetPlaylist: function resetPlaylist() {
            this.setValue([]);
            this.applySavedValue();
        },
        initRemoveDialog: function initRemoveDialog() {
            var removeDialog;

            this.getRemoveDialog = function () {
                if (!removeDialog) {
                    removeDialog = elementorCommon.dialogsManager.createWidget('confirm', {
                        message: elementor.translate('dialog_confirm_playlist_delete'),
                        headerMessage: elementor.translate('delete_playlist'),
                        strings: {
                            confirm: elementor.translate('delete'),
                            cancel: elementor.translate('cancel')
                        },
                        defaultOption: 'confirm',
                        onConfirm: this.resetPlaylist.bind(this)
                    });
                }

                return removeDialog;
            };
        },
        onAddTracksClick: function onAddTracksClick() {
            this.openFrame(this.hasTracks() ? 'add' : 'create');
        },
        onClearPlaylistClick: function onClearPlaylistClick() {
            this.getRemoveDialog().show();
        },
        onPlaylistThumbnailsClick: function onPlaylistThumbnailsClick() {
            this.openFrame('edit');
        }
    })
)
