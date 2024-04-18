"use strict";

(function ($) {
    let button = null;

    const init = () => {
        bindEvents();
    }

    const woobe_act_preview_files_editor = (event) => {
        button = event.currentTarget;

        $('#preview_files_popup_editor .woobe-modal-title').html(
            $(button).data('name') + ' [' + $(button).data('key') + ']'
        );

        woobe_popup_clicked = $( button );
        const product_id = parseInt( $( button ).data('product_id'), 10);

        if ( button && $( button ).data( 'count' ) > 0 ) {
            if ( product_id > 0 ) {
                $( '#products_preview_files_form ul.woobe_fields_tmp' ).empty();

                const previewFiles = $(button).data( 'preview_files' );

                previewFiles.forEach( ( previewFile ) => updateListItem( previewFile ) );

                $('#preview_files_popup_editor').show();
                $('#woobe_preview_files_bulk_operations').hide();

                __woobe_init_preview_files();
            } else {
                //we can use such button for any another extensions
                $('#preview_files_popup_editor').show();
                $('#woobe_preview_files_bulk_operations').show();
                
                __woobe_init_preview_files();
            }

        } else {
            if (product_id > 0) {
                $('#products_preview_files_form ul.woobe_fields_tmp').empty();
                $('#woobe_preview_files_bulk_operations').hide();
            } else {
                //this we need do for another applications, for example bulk editor
                if ($('#products_preview_files_form .woobe_fields_tmp').length == 0) {
                    $('#products_preview_files_form ul.woobe_fields_tmp').empty();
                }
                $('#woobe_preview_files_bulk_operations').show();
            }


            $('#preview_files_popup_editor').show();
            __woobe_init_preview_files();
        }

        return false;
    }

    //service
    const __woobe_init_preview_files = () => {
        $("#products_preview_files_form .woobe_fields_tmp").sortable({
            opacity: 0.8,
            cursor: "grab",
            placeholder: 'woobe-options-highlight'
        });
    }

    const updateListItem = ( attachment ) => {
        const template = document.querySelector('#woobe_preview_file_li_tpl');
        const newItem = template.content.cloneNode(true);

        newItem.querySelector('img').src = attachment?.attributes?.thumb?.src ?? attachment?.thumb;
        newItem.querySelector('input').value = attachment?.id;
        newItem.querySelector('span.woobe_preview_file_name').textContent = attachment?.attributes?.title ?? attachment?.title;

        $( '#products_preview_files_form ul.woobe_fields_tmp' ).append( newItem );
    }

    const bindEvents = () => {
        $( document ).on( 'click', '.woobe-modal-save-preview-files', (e) => {
            const product_id = woobe_popup_clicked.data('product_id');
            const key = woobe_popup_clicked.data('key');

            if (product_id > 0) {
                $('#preview_files_popup_editor').hide();
                woobe_message(lang.saving, 'warning');
                $.ajax({
                    method: "POST",
                    url: ajaxurl,
                    data: {
                        action: 'woobe_update_page_field',
                        product_id: product_id,
                        field: key,
                        value: $('#products_preview_files_form').serialize()
                    },
                    success: function (html) {
                        woobe_message(lang.saved, 'notice');
                        $(button).parent().html(html);
                        button = null;

                        $(document).trigger('woobe_page_field_updated', [product_id, key, $('#products_preview_files_form').serialize()]);
                    }
                });
            } else {
                //for preview_files buttons in any extensions
                $(document).trigger('woobe_act_preview_files_editor_saved', [product_id, key, $('#products_preview_files_form').serialize()]);
            }
        });

        $( document ).on( 'click', '.woobe-modal-close-preview-files', (event) => {
            $('#preview_files_popup_editor').hide();
        });

        $( document ).on( 'click', 'a.preview_files_popup_editor_btn, td[data-field="preview_files"] div.woobe-button', woobe_act_preview_files_editor );

        $( document ).on( 'click', '.woobe_insert_preview_file', (event) => {
            event.preventDefault();

            const media = wp.media({
                title: lang.upload_images,
                multiple: 'add',
                library: {
                    type: ['audio'],
                },
            });

            media.on('open', () => {
                    const selection = media.state().get('selection');
                    const selectedIds = $('#products_preview_files_form ul.woobe_fields_tmp input').map( (index, item) => parseInt( item.value ) ).toArray().filter( (item) => item );
                    selectedIds.forEach( ( selectedId ) => {
                        const attachment = wp.media.attachment( selectedId );
                        selection.add( attachment ? [ attachment ] : [] );
                    });            
                })
                .on( 'select', () => {
                    $( '#products_preview_files_form ul.woobe_fields_tmp' ).empty();

                    const attachments = media?.state()?.get('selection')?.models;
                    
                    attachments.forEach( ( attachment ) => updateListItem( attachment ) );

                    __woobe_init_preview_files();
                })
                .open();
        });

        
        $( document ).on( 'click', '.woobe_preview_file_delete', (event) => {
            event.target.closest('li').remove();
        });


        $( document ).on( 'click', '.woobe_preview_file_delete_all', () => {
            $('#preview_file_popup_editor form .woobe_fields_tmp').html('');
        });
    }

    init();

})(jQuery);

