(function ($, __) {
    "use strict"

    document.addEventListener( 'vwwaveplayer.engine.ready', (event) => {
        const VwWavePlayer = event.detail.engine

		VwWavePlayer.setOption( 'autoplay', false )

        const previewFilesInit = () => {
            // File inputs.
        	$(document).on( 'click', '#woocommerce-product-data .preview_files a.insert', function() {
        		$( this ).closest( '.preview_files' ).find( 'tbody' ).append( $( this ).data( 'row' ) );
        		return false;
        	});
        	$(document).on( 'click', '#woocommerce-product-data .preview_files a.delete', function() {
        		$( this ).closest( 'tr' ).remove();
        		return false;
        	});
            // Previews ordering.
        	$( '.preview_files tbody' ).sortable({
        		items: 'tr',
        		cursor: 'move',
        		axis: 'y',
        		handle: 'td.sort',
        		scrollSensitivity: 40,
        		forcePlaceholderSize: true,
        		helper: 'clone',
        		opacity: 0.65
        	});

            // Uploading files.
            var preview_file_frame;
            var file_path_field;

            $( document ).on( 'click', '.upload_preview_button', function( event ) {
                var $el = $( this );

                file_path_field = $el.closest( 'tr' ).find( 'td.file_url input' );

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( preview_file_frame ) {
                    preview_file_frame.open();
                    return;
                }

                var preview_file_states = [
                    // Main states.
                    new wp.media.controller.Library({
                        library:   wp.media.query(
                            {
                                type: 'audio',
                            }
                        ),
                        multiple:  true,
                        title:     $el.data('choose'),
                        priority:  20,
                        filterable: 'all'
                    })
                ];

                // Create the media frame.
                preview_file_frame = wp.media.frames.preview_file = wp.media({
                    // Set the title of the modal.
                    title: $el.data('choose'),
                    library: {
                        type: 'audio'
                    },
                    button: {
                        text: $el.data('update')
                    },
                    multiple: true,
                    states: preview_file_states
                });

                // When an image is selected, run a callback.
                preview_file_frame.on( 'select', function() {
                    var file_path = '';
                    var selection = preview_file_frame.state().get( 'selection' );

                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.url ) {
                            file_path = attachment.url;
                        }
                    });

                    file_path_field.val( file_path ).change();
                });

                // Set post to 0 and set our custom type.
                preview_file_frame.on( 'ready', function() {
                    preview_file_frame.uploader.options.uploader.params = {
                        type: 'download_preview'
                    };
                });

                // Finally, open the modal.
                preview_file_frame.open();
            });
        }

        const settingsPageInit = () => {

            const overrideWaveColors = VwWavePlayer.vars.options.override_wave_colors

            iro.use(iroTransparencyPlugin);
            let colorPicker

            const initColorPicker = function( useTransparency = true ) {
                colorPicker = null
                $('#color-picker').remove()
                $('#color-picker-container').append($('<div>', {id: 'color-picker'}))
                colorPicker = new iro.ColorPicker('#color-picker', {
                    width: 120,
                    color: "rgb(255, 0, 0)",
                    borderWidth: 1,
                    handleRadius: 5,
                    sliderHeight: 20,
                    sliderMargin: 10,
                    borderColor: "#000",
                    transparency: useTransparency,
                });

                colorPicker.on(["color:change"], function(color){
                    let colorSwatch = document.querySelector('.color-swatch.current')
                    if ( !colorSwatch )
                        return

                    const newColor = simplifyColorCode(color.hex8String)

                    if ( colorSwatch.classList.contains('palette-swatch') ) {
                        const index = $(colorSwatch).index(),
                              colorCodes = $('#palette').attr('data-colors').split('-')
                        colorCodes[index] = color.hexString.replace('#','')
                        colorSwatch.dataset.color = Object.values(color.rgb).join(',')
                        colorSwatch.dataset.hue = color.hsl.h
                        updateColorStyles( colorCodes )
                    } else {
                        const colorInput = colorSwatch.nextElementSibling

                        if ( colorInput) colorInput.value = newColor
                        colorSwatch.style.backgroundColor = newColor
                        const optionName = colorSwatch.dataset.name.replace('vwwaveplayer_','');
                        vwwvplVars.options[optionName] = newColor;
                        sampleRedraw();
                    }
                    $('#color-picker-value').val( newColor ).select().focus()
                });
            }

            if ( document.location.search.includes('page=vwwaveplayer') ) {
                const currentTab = $('#vwwaveplayer_current_tab').val()
                if ( currentTab === 'waveform' ) {
                    initColorPicker()
                    VwWavePlayer.vars.options.override_wave_colors = false
                } else if ( currentTab === 'palettes' ) {
                    initColorPicker(false)
                    VwWavePlayer.vars.options.override_wave_colors = overrideWaveColors
                }
                window.history.replaceState( {page: 'vwwaveplayer', tab: currentTab} , $(`#vwwaveplayer-${currentTab} h2`).text() + ' ‹ VwWavePlayer Settings', `${document.location.pathname}?page=vwwaveplayer&tab=${currentTab}` );
				$('input[name=_wp_http_referer]').val( $('input[name=_wp_http_referer]').val().replace(/\&tab=(.*)/, `&tab=${currentTab}`) )
                let maxWidth = 0
                const isPaletteTabActive = $(`#vwwaveplayer-palettes`).is(':visible');
                $(`#vwwaveplayer-palettes`).show();
                $('.vwwvpl-palette-selectbox ul').show()
                $('.vwwvpl-palette-selectbox li.vwwvpl-palette-item').each( (i,e) => {
                    const name = $(e).find('.vwwvpl-palette-item-name').get(0)
                    if ( name && name.tagName === 'SPAN' )
                        maxWidth = Math.max( maxWidth, 125 + Number(getComputedStyle(name).getPropertyValue('width').replace('px','')) )
                })
                $('.vwwvpl-palette-selectbox ul').hide()
                $(`#vwwaveplayer-palettes`).toggle(isPaletteTabActive);
                $('.vwwvpl-palette-selectbox>div.vwwvpl-palette-item').css( { width: maxWidth} )
            }

            window.onpopstate = (event) => {
                // if ( !event.state || !event.state.tab )
                //     return false
                //
                // const currentTab = event.state.tab
                // $('.vwwaveplayer_tab').removeClass('nav-tab-active');
                // $(`#vwwaveplayer-tab-${currentTab}`).addClass('nav-tab-active');
                // $('.vwwaveplayer-option-page:visible').hide();
                // $(`#vwwaveplayer-${currentTab}`).show();
                // $('#vwwaveplayer_current_tab').val(currentTab);
                // window.history.replaceState( event.state , event.title, `${document.location.pathname}?page=vwwaveplayer&tab=${currentTab}` );
            }

			wp.codeEditor.initialize( $('#vwwaveplayer_custom_css'), wvplCM.css );
			wp.codeEditor.initialize( $('#vwwaveplayer_custom_js'), wvplCM.js );

            $(document).on( 'click', '#vwwaveplayer_register_license', (event) => {
                $('#vwwaveplayer_unregister_license + div.notice').remove()
                const noticeText = $('<p>'),
                      notice = $('<div>', {class: 'notice'}).append(noticeText)

                $('#vwwaveplayer_register_license').prop('disabled', true).addClass('in-progress')
                $('input[name=vwwaveplayer_purchase_code]').prop('disabled', true)
                if ( !$('input[name=vwwaveplayer_purchase_code]').val() ) {
                    $('#vwwaveplayer_unregister_license').after( notice )
                    notice.addClass('update-message notice-error')
                    noticeText.html( __('The purchase code cannot be empty', 'vwwaveplayer') )
                    $('#vwwaveplayer_register_license').removeClass('in-progress').prop('disabled', false)
                    $('input[name=vwwaveplayer_purchase_code]').prop('disabled', false )
                    return false
                }
				const postData = {
					code: $('input[name=vwwaveplayer_purchase_code]').val(),
					optin: $('input#vwwaveplayer_email_optin:checked').length,
					nonce: VwWavePlayer.vars.admin_tools_nonce
				}
				VwWavePlayer.ajaxCall( 'register_purchase_code', postData )
				.then( result => {
					const noticeText = $('<p>'),
						  notice = $('<div>', {class: 'notice'}).append(noticeText)

					$('#vwwaveplayer_register_license').removeClass('in-progress').prop('disabled', false)
					$('#vwwaveplayer_unregister_license').after( notice )
					if ( result.success ) {
						notice.addClass('updated-message notice-success')
						$('#vwwaveplayer_register_license').hide()
						$('span.vwwaveplayer-register-description-block').hide()
						$('#vwwaveplayer_unregister_license').show()
						$('span.vwwaveplayer-unregister-description-block').show()
					} else {
						$('input[name=vwwaveplayer_purchase_code]').prop('disabled', false )
						notice.addClass('update-message notice-error')
					}
					noticeText.html(result.data.message)
				})
            })
            $(document).on( 'click', '#vwwaveplayer_unregister_license', (event) => {
                $('#vwwaveplayer_unregister_license').prop('disabled', true).addClass('in-progress')
                $('#vwwaveplayer_unregister_license + div.notice').remove()
				const postData = {
					code: $('input[name=vwwaveplayer_purchase_code]').val(),
					nonce: VwWavePlayer.vars.admin_tools_nonce
				}
				VwWavePlayer.ajaxCall( 'unregister_purchase_code', postData )
				.then( result => {
					const noticeText = $('<p>'),
						  notice = $('<div>', {class: 'notice'}).append(noticeText)

					$('#vwwaveplayer_unregister_license').removeClass('in-progress').prop('disabled', false).after( notice )
					if (result.success) {
						notice.addClass('updated-message notice-success')
						$('#vwwaveplayer_unregister_license').hide()
						$('span.vwwaveplayer-unregister-description-block').hide()
						$('#vwwaveplayer_register_license').show()
						$('span.vwwaveplayer-register-description-block').show()
						$('input[name=vwwaveplayer_purchase_code]').prop('disabled', false )
					} else {
						notice.addClass('update-message notice-error')
					}
					noticeText.html(result.data.message)
				})
            })

            const slValues = [
                {var: 'fc',   s: 20, l: 10, a: 1 },
                {var: 'fc-s', s: 25, l: 25, a: 1 },
                {var: 'bc',   s: 20, l: 90, a: 1 },
                {var: 'bc-s', s: 25, l: 75, a: 1 },
                {var: 'hc',   s: 30, l: 40, a: 1 },
                {var: 'hc-s', s: 35, l: 60, a: 1 },
                {var: 'wc',   s: 70, l: 40, a: 1 },
                {var: 'wc-s', s: 70, l: 60, a: 1 },
                {var: 'pc',   s: 60, l: 25, a: 1 },
                {var: 'pc-s', s: 60, l: 75, a: 1 },
                {var: 'cc',   s: 60, l: 40, a: 1 },
                {var: 'cc-s', s: 60, l: 60, a: 1 },
            ]

            const generatePalette = function(monoChromatic = true, monoChromaticPair = true) {
                const paletteGroupLength = 2,
                      paletteLength = Math.round( slValues.length / paletteGroupLength )
                const sVariance = 10,
                      lVariance = 5,
                      globalAlpha = 1
                let h = 3600*Math.random() / 10,
                    colorCodes = []
                for( let i = 0; i < paletteLength; i++ ) {
                    for( let j = 0; j < paletteGroupLength; j++ ) {
                        const index = paletteGroupLength * i + j
                        let {s, l, a} = slValues[index]
                        s = Math.max( 0, Math.min( 100, s + sVariance * ( 1 - 2 * Math.random() ) ) )
                        l = Math.max( 0, Math.min( 100, l + lVariance * ( 1 - 2 * Math.random() ) ) )
                        a = a * globalAlpha
                        const iroColor = new iro.Color({h, s, l, a})
                        colorCodes.push( iroColor.hexString.slice(1) )
                        if ( ! monoChromaticPair )
                            h = 3600*Math.random() / 10
                        const colorTriplet =  Object.values(iroColor.rgb).join(',')
                        const thisSwatch = $(`#palette>div:eq(${slValues[index].var})`)
                        thisSwatch.attr('data-color', colorTriplet )
                                  .attr('data-hue', iroColor.hsl.h)
                    }
                    if ( ! monoChromatic )
                        h = 3600*Math.random() / 10
                }
                $('#palette').attr( 'data-index', '' )
                updateColorStyles( colorCodes )
            }

            const updateColorStyles = function( colorCodes ) {
                $('#player_examples').css({'--poster-image': VwWavePlayer})
                const colorStyles = VwWavePlayer.getColorStyleFromPalette( colorCodes )
                $('#palette').attr('data-colors', colorCodes.join('-') )
                for( let index = slValues.length - 1; index >= 0; index-- ) {
                    const color = new iro.Color( `#${colorCodes[index]}` ),
                          colorTriplet = Object.values(color.rgb).join(',')
                    $('#palette').get(0).style.setProperty( `--${slValues[index].var}`, colorTriplet )
                    $(`.palette-swatch`).eq(index).attr( 'data-color', colorTriplet ).attr( 'data-hue', color.hsl.h )
                    if ( index < slValues.length - 1 ) {
                        const nextHue = $(`.palette-swatch`).eq(index+1).attr('data-hue')
                        $(`.palette-swatch`).eq(index).toggleClass('linked', Math.abs( Number(nextHue) - color.hsl.h ) < 5 )
                    }
                    $('#player_examples .vwwaveplayer').each( (i,e) => {
                        e.style.setProperty( `--${slValues[index].var}`, colorTriplet )
                    })
                }
            }

            if ( $('li.vwwvpl-palette-item.selected').length )
                updateColorStyles( $('li.vwwvpl-palette-item.selected').attr('data-colors').split('-') )

            // $('button#vwwaveplayer_random_palette').click()

            // $(document).on( 'click', '#palette>div.palette-swatch', (event) => {
            //     const target = event.target,
            //           s = 100 * event.offsetX / target.offsetWidth,
            //           l = 100 * event.offsetY / target.offsetHeight,
            //           iroColor = new iro.Color( { h: target.dataset.hue, s, l } )
            //
            //     target.dataset.color = Object.values(iroColor.rgb).join(',')
            //     $('#vwwaveplayer-palettes .vwwaveplayer').vwwaveplayer('refresh')
            // })

            $(document).on('click', 'button#vwwaveplayer_random_palette', (event) => {
                const monoChromatic = $('input#vwwaveplayer_monochromatic_palette:checked').length > 0,
                      monoChromaticPairs = $('input#vwwaveplayer_monochromatic_pairs:checked').length > 0,
                      palette = generatePalette( monoChromatic, monoChromaticPairs )
                $('#vwwaveplayer-palettes .vwwaveplayer').vwwaveplayer('refresh')
                $('#vwwaveplayer_save_palette').prop( 'disabled', false )
                $('input[name=vwwaveplayer_palette_name]').val('')
            })

            const addPalette = ( id, name, colors, index ) => {
                const colorCodes = colors.split('-').map( c => `#${c}` )

                const palette = $('<li>', {class:'vwwvpl-palette-item'}).attr('data-id', id).attr('data-colors', colors)
                palette.append( $('<span>', {class: 'vwwvpl-palette-item-name'}).text(name) )
                for( const color of colorCodes ) {
                    palette.append($('<span>', {class:'vwwvpl-palette-item-swatch'}).css('background-color', color ))
                }
                if ( index >= $('.vwwvpl-palette-selectbox ul li').length ) {
                    $('.vwwvpl-palette-selectbox ul li').removeClass('selected')
                    palette.addClass('selected')
                    $('.vwwvpl-palette-selectbox ul').append(palette)
                } else {
                    $('.vwwvpl-palette-selectbox ul li').eq(index).html( palette.html() ).addClass('selected')
                }
                $('.vwwvpl-palette-selectbox>div.vwwvpl-palette-item').html( palette.html() )
            }

            $(document).on( 'click', 'button#vwwaveplayer_save_palette', (event) => {
                event.preventDefault();
                var el = $(event.target);
				const postData = {
					index: $('#palette').attr('data-index'),
					name: $('input[name=vwwaveplayer_palette_name]').val(),
					colors: $('#palette').attr('data-colors'),
					nonce: vwwvplVars.admin_tools_nonce
				}
				VwWavePlayer.ajaxCall( 'save_palette', postData )
				.then( result => {
					if (result.success) {
						$('#palette').attr('data-index', result.data.index)
						addPalette( result.data.id, $('input[name=vwwaveplayer_palette_name]').val(), $('#palette').attr('data-colors'), result.data.index )
						$('#vwwaveplayer_save_palette').prop( 'disabled', true )
					}
				})
            });


            $(document).on('change', 'input#vwwaveplayer_monochromatic_palette', (event) => {
                const allLinked = $('input#vwwaveplayer_monochromatic_palette:checked').length > 0
                $('button#vwwaveplayer_random_palette').click()
                $('#palette>div.palette-swatch-shade').toggleClass('linked', allLinked)
            })

            $(document).on('change', 'input#vwwaveplayer_monochromatic_pairs', (event) => {
                const pairsLinked = $('input#vwwaveplayer_monochromatic_pairs:checked').length > 0
                $('input#vwwaveplayer_monochromatic_palette').prop( 'disabled', !pairsLinked )
                if ( !pairsLinked )
                    $('input#vwwaveplayer_monochromatic_palette').prop( 'checked', false )
                $('#palette>div.palette-swatch-main').toggleClass('linked', pairsLinked)
                $('button#vwwaveplayer_random_palette').click()
            })

            $(document).on('change', 'input[name=vwwaveplayer_player_background_image]', (event) => {
                $('#player_examples .vwwaveplayer').toggleClass( 'vwwvpl-exhibition-mode', $(event.target).prop('checked') )
                $('#player_examples .vwwaveplayer').toggleClass( 'vwwvpl-exhibition-mode', $(event.target).prop('checked') )
            })

            $(document).on('change', 'input[name=vwwaveplayer_override_wave_colors]', (event) => {
                VwWavePlayer.vars.options.override_wave_colors = !!$('input[name=vwwaveplayer_override_wave_colors]:checked').length
                $('#vwwaveplayer-palettes .vwwaveplayer').vwwaveplayer('refresh')
            })

            $(document).on('click', '.vwwvpl-palette-selectbox', (event) => {
                if ( $(event.target).closest('li.vwwvpl-palette-item').length )
                    return false
                $(event.currentTarget).focus()
                $(event.currentTarget).find('ul').toggle()
            })

            $(document).on('click', (event) => {
                if ( $(event.target).closest('.vwwvpl-palette-selectbox').length )
                    return false
                $('.vwwvpl-palette-selectbox').blur()
                $('.vwwvpl-palette-selectbox').find('ul').hide()
            })

            $(document).on('click', '.vwwvpl-palette-selectbox ul li.vwwvpl-palette-item', (event) => {
                const dataIndex = $(event.currentTarget).index()
                const colors = $(event.currentTarget).attr('data-colors')
                $('input[name=vwwaveplayer_default_palette]').val(colors)
                $('.vwwvpl-palette-selectbox ul li.vwwvpl-palette-item').removeClass('selected')
                $('.vwwvpl-palette-selectbox > div.vwwvpl-palette-item').html( $(event.currentTarget).html() )
                $(event.currentTarget).addClass('selected').closest('ul').hide()
                $('#palette').attr('data-index', dataIndex )
                $('#vwwaveplayer_save_palette').prop( 'disabled', false )
                $('input[name=vwwaveplayer_palette_name]').val($(event.currentTarget).text().trim())
                updateColorStyles( colors.split('-') )
            })

            var frame;
            $(document).on('click', '.media-frame a.play-button', function(event){
                event.preventDefault();
                var id = $(this).data('id'),
                    audio = $('.media-frame audio#' + id )[0];
                    $('.media-frame audio[id!='+id+']').each(function(i,e){
                        $(e)[0].pause();
                        $(e)[0].currentTime = 0;
                    })
                audio.paused ? audio.play() : audio.pause();
                event.stopPropagation();
                return false;
            });

            $(document).on( 'change', 'select[name=vwwaveplayer_skin]', function(event){
                const support = $(this).find('option:selected').data('support').split(',')
                $(`tr[data-option=size]`).toggle( support.includes('size') )
                $(`tr[data-option=shape]`).toggle( support.includes('shape') )
                $(`tr[data-option=info]`).toggle( support.includes('playlist') )
            });

            $(document).on('click', '.woocommerce-music-type .woocommerce-option', function(event){

            });

            $(document).on( 'click', '.vwwaveplayer_tab', (event) => {
                event.preventDefault()
				VwWavePlayer.stop()
                const currentTab = $(event.target).attr('href').replace('#','')
                if ( currentTab === 'waveform_options' ) {
                    initColorPicker()
                    VwWavePlayer.vars.options.override_wave_colors = false
                } else if ( currentTab === 'palettes' ) {
                    initColorPicker(false)
                    VwWavePlayer.vars.options.override_wave_colors = overrideWaveColors
                }
                VwWavePlayer.stop()
                $('.vwwaveplayer_tab').removeClass('nav-tab-active');
                $(event.target).addClass('nav-tab-active');
                $('.vwwaveplayer-option-page:visible').hide();
                $(`#vwwaveplayer-${currentTab}`).show();
				$('.CodeMirror').each(function(i, el){
					el.CodeMirror.refresh()
				});
                $('#vwwaveplayer_current_tab').val(currentTab);
                window.history.replaceState( {page: 'vwwaveplayer', tab: currentTab} , $(`#vwwaveplayer-${currentTab} h2`).text() + ' ‹ VwWavePlayer Settings', `${document.location.pathname}?page=vwwaveplayer&tab=${currentTab}` );
				$('input[name=_wp_http_referer]').val( $('input[name=_wp_http_referer]').val().replace(/\&tab=(.*)/, `&tab=${currentTab}`) )
            });

            $(document).on( 'click', '#vwwvpl-sample-waveform .play-button', function(e){
                $(this).parent().toggleClass('playing');
                VwWavePlayer.toggle();
            });

            $(document).on( 'paused', '#vwwvpl-sample-waveform', function(e){
                $(this).removeClass('playing');
            });

            $(document).on( 'playing', '#vwwvpl-sample-waveform', function(e){
                $(this).addClass('playing');
            });

            $(document).on( 'click', '#vwwaveplayer_default_thumbnail', function(event) {
                event.preventDefault();

                if ( frame ) {
                  frame.open();
                  return;
                }

                frame = wp.media({
                    title: 'Select or Upload the default thumbnail',
                    button: {
                    text: 'Use this image'
                    },
                    library : {
                        type : 'image',
                    },
                    multiple: false,
                });

                frame.on( 'select', function() {

                  var attachment = frame.state().get('selection').first().toJSON();

                  $('#vwwaveplayer_default_thumbnail').css( {backgroundImage: 'url(' + attachment.url + ')'} );
                  $('input[name=vwwaveplayer_default_thumbnail]').val(attachment.url);
                });

                frame.open();
            });

            $(document).on( 'click', '.vwwaveplayer-thumbnail-remove', (event) => {
                event.preventDefault()
                event.stopPropagation()
                $('#vwwaveplayer_default_thumbnail').css( {backgroundImage: ''} );
                $('input[name=vwwaveplayer_default_thumbnail]').val('');
            })

            $(document).on( 'change', 'select[name=vwwaveplayer_wave_mode]', function() {
                $('#vwwaveplayer_gap_width_group').toggleClass('vwwvpl-inactive', $(this).val() == 0 );
            });

            $(document).on( 'change', 'select[name=vwwaveplayer_wave_animation]', function() {
                $('#vwwaveplayer_amp_freq_ratio_group').toggleClass('vwwvpl-inactive', $(this).val() == 1 );
                sampleRedraw();
            });

            $(document).on( 'change', 'select[name=vwwaveplayer_amp_freq_ratio]', function() {
                sampleRedraw();
            });

            var changeBackground = function(color) {
                $('#vwwvpl-sample-waveform').css('background-color', color);
            }

            $(document).on( 'click', '.wvpl_clear_cache', function(event){
                event.preventDefault();
                var el = $(this);
				const postData = {
					mode: $(this).attr('data-elements'),
					nonce: VwWavePlayer.vars.admin_tools_nonce
				}
				VwWavePlayer.ajaxCall( 'clear_cache', postData )
				.then( result => {
					var status = result.success ? 'notice updated is-dismissible' : 'notice error is-dismissible';
					el.parent().append($('<div>', {class: status}).html($('<p>').html(result.data.message)));
                    setTimeout( () => el.parent().find('.notice').each( (i,n) => $(n).slideUp( () => n.remove() ) ), 5000 )
				})
            });

            $(document).on( 'click', '.wvpl_delete_peaks', function(event){
                event.preventDefault();
                var el = $(this);
				const postData = {
					mode: $(this).attr('data-elements'),
					nonce: VwWavePlayer.vars.admin_tools_nonce
				}
				VwWavePlayer.ajaxCall( 'delete_peaks', postData )
				.then( result => {
					var status = result.success ? 'notice updated is-dismissible' : 'notice error is-dismissible';
					el.parent().append($('<div>', {class: status}).html($('<p>').html(result.data.message)));
				})
            });


            var audioFiles = [];
            $(document).on( 'click', '.wvpl_regenerate_peaks', function(event){
                event.preventDefault();
                $('input.wvpl_regenerate_peaks').prop('disabled', true);
                $('input[name=vwwaveplayer_overwrite_peak_files]').prop('disabled', true);
                const overwrite = $('input[name=vwwaveplayer_overwrite_peak_files]').prop('checked');
                const postData = {
					all: true,
					overwrite,
					nonce: VwWavePlayer.vars.admin_tools_nonce
				}
				VwWavePlayer.ajaxCall( 'get_audio_attachments', postData )
				.then( result => {
					if ( result.success ) {
						audioFiles = Object.values(result.data.audioFiles);
						var totalDuration = audioFiles.reduce( (s,t) => Number(t.meta.length?t.meta.length:0) + s, 0 );
						$('.wvpl_regenerate_file_progress').val(0).show();
						$('.wvpl_regenerate_peak_progress').val(1).prop('max', audioFiles.length).show();
						$('#wvpl_regenerate_peak_notice').empty().append(
							$('<div>', {class: 'notice updated is-dismissible'}).html(
								$('<p>').append(
                                    // translators: %s is the number of files
									$('<span>').html( __('<strong>%s</strong> ready for peak generation', 'vwwaveplayer').replace('%s', audioFiles.length) )
								)
							)
						);
						generatePeakFile( 0, 0, totalDuration );
					}
				})
            });

            function generatePeakFile( index, time, totalDuration ) {
                if ( index < audioFiles.length && audioFiles.length > 0 ) {
                    $('.wvpl_regenerate_peak_progress').val(index);
                    var overwrite = $('input[name=vwwaveplayer_overwrite_peak_files]').prop('checked');
                    const audioFile = audioFiles[index];
                    if ( !audioFile.hasPeakFile || overwrite) {
                        const start = Date.now(),
                              url = audioFile.file_url,
                              title = audioFile.post_title,
                              duration = audioFile.meta.length;

						VwWavePlayer.getAudioData( url, audioFile.ID, ( at, length ) => {
							if ( length > 0 ) {
                                $('.wvpl_regenerate_file_progress').val(at/length);
                            }
						})
						.then( array => {
							VwWavePlayer.decodeAudioData(array, (buffer) => {
								const peaks = VwWavePlayer.extractPeaks( buffer )
								const postData = {
									nonce: VwWavePlayer.vars.admin_tools_nonce,
									overwrite: overwrite,
									peaks: peaks.join(',').replace(/0\./gi,'.'),
									id: audioFile.ID
								};

								VwWavePlayer.ajaxCall( 'write_peaks', postData )
								.then( result => {
									if ( result.success ) {
										duration && ( totalDuration -= duration );
										const stop = Date.now(),
											  delta = (stop-start)/1000,
											  rate = duration/delta,
											  timeLeft = totalDuration / rate,
											  etaDate = new Date( Date.now() + Math.round(1000*timeLeft) );

										$('#wvpl_regenerate_peak_notice').empty().append(
											$('<div>', {class: 'notice updated is-dismissible'}).html(
												$('<p>').append(
													$('<span>').html( `${index+1} done, ${audioFiles.length - index - 1} files to go`),
													$('<br>'),
													$('<span>').html( `Peak file for “<strong>${title}</strong>” was successfully regenerated in ${Math.round(delta*100)/100} seconds (<strong>${Math.round(100*rate/60)/100} min/s</strong>)`),
													$('<br>'),
													$('<span>').html( `Estimated completion in <strong>${Math.round(timeLeft)}</strong> seconds (${etaDate.toLocaleTimeString()})` )
												)
											)
										);
										index++;
										generatePeakFile(index, time+(stop-start)/1000, totalDuration );
									} else {
										VwWavePlayer.log( result.data.message )
									}
								})
                            });
						})
                    } else {
                        index++;
                        generatePeakFile(index, time);
                    }
                } else {
                    $('#wvpl_regenerate_peak_notice').empty().append(
                        $('<div>', {class: 'notice updated is-dismissible'}).html(
                            $('<p>').append(
                                audioFiles.length > 0 ?
                                    $('<span>').html( '<strong>' + audioFiles.length + ' peak files</strong> were successfully regenerated in <strong>' + (Math.round(time*100)/100).toString(10) + '</strong> seconds' ) :
                                    $('<span>').html( 'No tracks needed to be regenerated.' )
                            )
                        )
                    );
                    $('.wvpl_regenerate_file_progress').hide();
                    $('.wvpl_regenerate_peak_progress').hide();
                    $('input.wvpl_regenerate_peaks').prop('disabled', false);
                    $('input[name=vwwaveplayer_overwrite_peak_files]').prop('disabled', false);
                    $('input[name=vwwaveplayer_overwrite_peak_files]').prop('checked', false);
                }
            }

            var waveInit = function() {
                VwWavePlayer.audio.loop = true;
            }

            var sampleRedraw = function( event ) {
                $('#vwwaveplayer-waveform .vwwaveplayer').vwwaveplayer('refresh')
            }

            $(document).on('click', '#vwwaveplayer_form', function(e){
                if ( $(e.target).is( [
                        '.color-swatch',
                        '#color-picker-value',
                        '#color-picker-container',
                        '#color-picker',
                        '.iro__wheel',
                        '.iro__wheel__lightness',
                        '.iro__slider',
                        '.iro__slider__value'
                    ].join(',') ) )
                    return;

                $('#color-picker-container').removeClass('active');
            })

            $(document).on( 'click', '#vwwaveplayer_form .color-swatch', function() {
                const colorWidth = $('#color-picker-container').width(),
                      left = $(this).position().left - colorWidth/2,
                      top = $(this).position().top + $(this).height() + 10;

                if ( left + colorWidth/2 > document.body.clientWidth )
                    left = document.body.clientWidth - colorWidth;

                $('#color-picker-container').css({left:left, top: top}).addClass('active');
                $('.color-swatch').removeClass('current');
                $(this).addClass('current');
                let color, colorCode
                if ( $(this).hasClass('palette-swatch') ) {
                    const index = $(this).index()
                    const colors = $('#palette').attr('data-colors').split('-')
                    color = new iro.Color( `#${colors[index]}` );
                    colorCode = simplifyColorCode( color.hexString )
                } else {
                    color = new iro.Color( $(this).css('background-color') );
                    colorCode = simplifyColorCode( color.hex8String )
                }
                $('#color-picker-value').val( colorCode ).select().focus()
                colorPicker.color.hex8String = color.hex8String;
            });

            $(document).on( 'input', '#color-picker-value', (event) => {
                if ( !isColor( $(event.target).val() ) )
                    return false;

                const newColor = simplifyColorCode( $(event.target).val() )
                if ( $('.color-swatch.current').data('name') ) {
                    const optionName = $('.color-swatch.current').data('name').replace('vwwaveplayer_','');
                    $(`#vwwaveplayer_${optionName}`).val( newColor )
                    vwwvplVars.options[optionName] = newColor;
                    $('.color-swatch.current').css('background-color', newColor)
                    colorPicker.color.hexString = newColor.hexString
                    sampleRedraw();
                } else {
                    const index = $('.color-swatch.current').index()
                    const colorCodes = $('#palette').attr('data-colors').split('-')
                    const color = new iro.Color( newColor );
                    colorCodes[index] = color.hexString.replace('#','')
                    $('.color-swatch.current').data( 'color', Object.values(color.rgb).join(',') ).data( 'hue', color.hsl.h )
                    colorPicker.color.hexString = color.hexString
                    updateColorStyles( colorCodes )
                }
            });

            $(document).on( 'input', '#vwwaveplayer-waveform :input[name^="vwwaveplayer"]', function() {
                const optionName = this.name.replace('vwwaveplayer_','');
                vwwvplVars.options[optionName] = this.value;
                sampleRedraw();
            });

            $(document).on( 'change blur', 'input.vwwaveplayer-color-input', function(e) {
                let colorSwatch = $(`.color-swatch[data-name=${$('#color-picker-container').data('name')}]`);
                let value = $('#color-picker').val();
                if ( isColor(value) ) {
                    colorSwatch.css('background-color', value);
                    sampleRedraw();
                } else {
                    let oldColor = new iro.Color(colorSwatch.css('background-color'));
                    $('#color-picker').val( simplifyColorCode(oldColor.hex8String) );
                }
            });

            const isColor = ( colorCode ) => {
                return !!colorCode.match(/^#[\da-f]{8}$|^#[\da-f]{6}$|^#[\da-f]{4}$|^#[\da-f]{3}$/i);
            }

            const simplifyColorCode = ( colorCode ) => {
                let match
                if ( match = colorCode.match(/^#([\da-f]{3})f$/i) )
                    colorCode = `#${match[1]}`
                if ( match = colorCode.match(/^#([\da-f]{6})ff$/i) )
                    colorCode = `#${match[1]}`
                if ( match = colorCode.match(/^#([\da-f])\1([\da-f])\2([\da-f])\3$/i) )
                    colorCode = `#${match[1]}${match[2]}${match[3]}`
                if ( match = colorCode.match(/^#([\da-f])\1([\da-f])\2([\da-f])\3([\da-f])\4$/i) )
                    colorCode = `#${match[1]}${match[2]}${match[3]}${match[4]}`

                return colorCode
            }

            $(document).on( 'click', '.wvpl_toggle_selection', function(event){
                event.preventDefault();
                var select = $(this).data('mode') == 'select',
                    type = $(this).data('type');
                $('#vwwaveplayer_music_'+type+' input:enabled').each(function(i,e){
                    $(e).prop('checked', select);
                });
            })

			$(document).on( 'keyup keypress', '#vwwaveplayer-woocommerce #track-search-input', function(event){
				if (event.keyCode === 13) {
					event.preventDefault();
					updateMusicInputs( 1, event.target.value )
					return false
				}
			})

			$(document).on( 'keyup keypress', '#track-pagination #current-page-selector', function(event){
				if (event.keyCode === 13) {
					event.preventDefault();
					updateMusicInputs( event.target.value )
					return false
				}
			})

			$(document).on( 'click', '#track-pagination .pagination-links a', function(event){
				event.preventDefault();
				let paged = 1
				const page = event.currentTarget.href.match( /paged=(\d+)/ )
				if ( page && page[1] )
					paged = page[1]

				updateMusicInputs( paged )
			})

			const updateMusicInputs = ( paged = 1, search = '' ) => {
				const postData = {
					paged,
					search,
					nonce: VwWavePlayer.vars.admin_tools_nonce
				}

				VwWavePlayer.ajaxCall( 'music_inputs', postData )
				.then( result => {
					if ( result.success ) {
						const trackInputs = result.data.track_inputs,
							  paginateLinks = result.data.paginate_links
						$('#vwwaveplayer-woocommerce #track-pagination').html( paginateLinks )
						$('#vwwaveplayer-woocommerce #vwwaveplayer_music_tracks').html( trackInputs )
					} else {
						VwWavePlayer.log( result.data.message )
					}
				})
			}

            $(document).on( 'click', '.wvpl_create_products', function(event){
                event.preventDefault();

                var type = $(this).data('type');
                var index = 0,
                    itemsCount = $('#vwwaveplayer_music_' + type + ' input:checked').length,
                    progress = $('.wvpl_products_progress_'+type);

                progress.val(index).prop('max', itemsCount).show();

                $('#vwwaveplayer_music_'+type+' input:checked').each(function(i,e){
					const postData = {
						type: type,
						product_type: $('#vwwaveplayer_woocommerce_product_type').val(),
						id: $(e).val(),
						price: $('#vwwaveplayer_woocommerce_price_'+type).val(),
						tracks: $(e).data('tracks'),
						title: $(e).data('title'),
						nonce: vwwvplVars.admin_tools_nonce
					}
					VwWavePlayer.ajaxCall( 'create_product', postData )
					.then( result => {
						index++;
						progress.val(index);
						$(e).prop('checked', false).prop('disabled', true).next().toggleClass('disabled', true);
						if ( index == itemsCount ) {
							progress.parent().append($('<div>', {class: 'notice updated is-dismissible'}).html($('<p>').html(itemsCount + ' products successfully created')));
						}
					})
                })
            });

            $(document).on( 'click', 'table.vwwaveplayer-custom-fields .row-actions button.editinline', (event) => {
                event.preventDefault();
                const row = $(event.target).closest('tr'),
                      fieldName = row.find('input.field-name').val(),
                      fieldLabel = row.find('input.field-label').val(),
                      fieldType = row.find('input.field-type').val(),
                      fieldDefault = row.find('input.field-default').val(),
                      fieldOptions = row.find('input.field-options').val()

                row.addClass('updating')
                $('#custom_field_editor').find('#field_name').val( fieldName )
                $('#custom_field_editor').find('#field_label').val( fieldLabel )
                $('#custom_field_editor').find('#field_type').val( fieldType )
                $('#custom_field_editor').find('#field_default').val( fieldDefault )
                $('#custom_field_editor').find('#field_options').prop('disabled', !['select','radio'].includes(fieldType) ).val( fieldOptions )
                $('#custom_field_editor').insertAfter( row )
                $(event.target).closest('table').find('tr#custom_field_editor').removeClass('hidden').data('cf-name', fieldName)
            })

            $(document).on( 'click', 'table.vwwaveplayer-custom-fields .row-actions .trash a', (event) => {
                event.preventDefault();
                const row = $(event.target).closest('tr'),
                      fieldName = row.find('.field-name').val()
                row && row.remove()
                const newFieldNames = $('#custom_field_names').val().split(',').filter( n => (n && n !== fieldName) ).join(',')
                $('#custom_field_names').val( newFieldNames )
            })

            $(document).on( 'click', 'table.vwwaveplayer-custom-fields button#add-custom-field', (event) => {
                event.preventDefault();
                resetCustomFieldEditor()
                $('#custom_field_editor').removeClass('hidden').data('cf-name', 0).insertAfter( $('table.vwwaveplayer-custom-fields tr.custom-field-row').last() )
            })

            $(document).on( 'keypress', 'table.vwwaveplayer-custom-fields :input', (event) => {
                if ( event.which === 13 ) {
                    event.preventDefault();
                    const row = $(event.target).closest('tr')
                    row.find('button#update-custom-field').click()
                }

            })

            $(document).on( 'change', 'table.vwwaveplayer-custom-fields :input', (event) => {
                event.preventDefault();

                $(event.target).closest('td').find('label').removeClass('form-invalid')
                $(event.target).closest('td').find('.notice').remove()

                if ( event.target.id === 'field_label' && !$('table.vwwaveplayer-custom-fields input#field_name').val() )
                    $('table.vwwaveplayer-custom-fields input#field_name').val( $(event.target).val().toLowerCase().replace(/[ -]/g, '_').replace(/[^a-z0-9_]/g, '') )
            })

            $(document).on( 'click', 'table.vwwaveplayer-custom-fields button#cancel-custom-field', (event) => {
                resetCustomFieldEditor()
            })

            $(document).on( 'click', 'table.vwwaveplayer-custom-fields button#update-custom-field', (event) => {
                event.preventDefault();

                const row = $('#custom_field_editor'),
                      updatingRow = $('table.vwwaveplayer-custom-fields tr.updating'),
                      allFieldNames = $('#custom_field_names').val() ? $('#custom_field_names').val().split(',') : [],
                      newFieldName = $('input#field_name').val(),
                      newFieldType = $('select#field_type').val(),
                      newFieldDefault = $('input#field_default').val()

                row.find('.notice').remove()

                if ( !$('input#field_name').val() ) {
                    $('input#field_name').closest('label').addClass('form-invalid')
                    $(event.target).closest('label').after(
                        $('<div>', {class: 'notice notice-error'}).append(
                            $('<p>').text( __( 'The field name must be a valid identifier.', 'vwwaveplayer' ) )
                        )
                    )
                    return;
                }

                if ( updatingRow && newFieldName !== updatingRow.data('name') && allFieldNames.includes( newFieldName ) ) {
                    $('input#field_name').closest('label').addClass('form-invalid')
                    $(event.target).closest('label').after(
                        $('<div>', {class: 'notice notice-error'}).append(
                            $('<p>').text( __( 'Field names must be unique. A field with this name is already present.', 'vwwaveplayer' ) )
                        )
                    )
                    return;
                }

                let dataRow = row.data('row'),
                    dataOptions

                const options = ['select','radio'].includes( newFieldType ) ? $('input#field_options').val() : ''
                if ( ['select','radio'].includes( newFieldType ) && options.split(',').reduce( ( result, item ) => result + Number(item.length > 0), 0 ) <= 1 ) {
                    $('input#field_options').closest('label').addClass('form-invalid')
                    $(event.target).closest('label').after(
                        $('<div>', {class: 'notice notice-error'}).append(
                            $('<p>').text( __( 'The selected type of field must have at least two options. Please type two or more options, separated by commas.', 'vwwaveplayer' ) )
                        )
                    )
                    return;
                }

                let description = `name: <strong>${newFieldName}</strong><br/>
                                   type: <strong>${newFieldType}</strong><br/>
                                   default: <strong>${newFieldDefault}</strong><br/>`
                if ( options ) {
                    description = description.concat(`<br/>options: ${options}`)
                    dataOptions = row.data('options').replace( /%%name%%/gi, newFieldName )
                                                     .replace( /%%options%%/gi, options )
                } else {
                    dataOptions = ''
                }

                dataRow = dataRow.replace( /%%description%%/gi, description )
                                 .replace( /%%name%%/gi, $('input#field_name').val() )
                                 .replace( /%%label%%/gi, $('input#field_label').val() )
                                 .replace( /%%type%%/gi, $('select#field_type').val() )
                                 .replace( /%%default%%/gi, $('input#field_default').val() )
                                 .replace( /%%option_input%%/gi, dataOptions )

                allFieldNames.push(newFieldName)
                updatingRow.length ? $(dataRow).insertBefore( updatingRow ) : $(dataRow).insertBefore( row )
                updatingRow.remove()
                $('#custom_field_names').val( allFieldNames.join(',') )
                resetCustomFieldEditor()
            })

            const resetCustomFieldEditor = function() {
                $('#custom_field_editor').addClass('hidden')
                $('table.vwwaveplayer-custom-fields tr.updating').removeClass('updating')
                $('input#field_name').val('')
                $('input#field_label').val('')
                $('input#field_ldefault').val('')
                $('select#field_type').val('text')
                $('input#field_options').val('').prop('disabled', true)
            }

            $(document).on( 'change', 'table.vwwaveplayer-custom-fields select#field_type', (event) => {
                event.preventDefault();
                $('table.vwwaveplayer-custom-fields input#field_options').prop('disabled', !['select','radio'].includes( $(event.target).val() ) )
            })

            $(document).on( 'click', '.notice-vwwaveplayer-registration', (event) => {
				VwWavePlayer.ajaxCall( 'dismiss_registration_notice' )
            })

            waveInit();
        }

        previewFilesInit()

        if ( document.location.href.includes('page=vwwaveplayer') )
            settingsPageInit()
    })

})(jQuery, wp.i18n.__);
