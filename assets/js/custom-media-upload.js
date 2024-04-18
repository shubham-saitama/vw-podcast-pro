// jQuery(document).ready(function($){
//     var custom_media = true;

//     jQuery('.custom-media-image-upload').click(function(e) {
//         var send_attachment_bkp = wp.media.editor.send.attachment;
//         var button = jQuery(this);
//         var id = button.prev('input');
//         custom_media = true;

//         wp.media.editor.send.attachment = function(props, attachment) {
//             if (custom_media) {
//                 id.val(attachment.id);
//                 var imageUrl = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
//                 id.prev().prev().attr('src', imageUrl);
//             } else {
//                 return send_attachment_bkp.apply(this, [props, attachment]);
//             };
//         }

//         wp.media.editor.open(button);
//         return false;
//     });

//     jQuery('.custom-media-image-remove').click(function(){
//         var id = jQuery(this).prev('input');
//         id.val('');
//         jQuery(this).prev().prev().attr('src', '');
//     });

//     jQuery('.add_media').on('click', function(){
//         custom_media = false;
//     });
// });
