jQuery(function($){
    var mediaUploader;

    $('#service-image-one').click(function(e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Select'
            },
            multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('input[name="service-image-one"]').val(attachment.url);
        });

        mediaUploader.open();
    });

    var mediaUploader;

    $('#service-image-two').click(function(e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Select'
            },
            multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('input[name="service-image-two"]').val(attachment.url);
        });

        mediaUploader.open();
    });


    var mediaUploader;

      $('#post-meta-image-one').click(function(e) {
          e.preventDefault();

          if (mediaUploader) {
              mediaUploader.open();
              return;
          }

          mediaUploader = wp.media.frames.file_frame = wp.media({
              title: 'Choose Image',
              button: {
                  text: 'Select'
              },
              multiple: false
          });

          mediaUploader.on('select', function() {
              var attachment = mediaUploader.state().get('selection').first().toJSON();
              $('input[name="post-meta-image-one"]').val(attachment.url);
          });

          mediaUploader.open();
      });

      $('#post-meta-image-two').click(function(e) {
          e.preventDefault();

          if (mediaUploader) {
              mediaUploader.open();
              return;
          }

          mediaUploader = wp.media.frames.file_frame = wp.media({
              title: 'Choose Image',
              button: {
                  text: 'Select'
              },
              multiple: false
          });

          mediaUploader.on('select', function() {
              var attachment = mediaUploader.state().get('selection').first().toJSON();
              $('input[name="post-meta-image-two"]').val(attachment.url);
          });

          mediaUploader.open();
      });


});
function customMediaUploader(button) {
    var customUploader = wp.media({
        title: 'Upload Image',
        button: {
            text: 'Select Image'
        },
        multiple: false
    });
  
    customUploader.on('select', function() {
        var attachment = customUploader.state().get('selection').first().toJSON();
        var mediaIdField = jQuery(button).closest('p').find('.custom_media_id');
        var mediaPreview = jQuery(button).closest('p').find('.custom_media_preview');
  
        mediaIdField.val(attachment.id);
        mediaPreview.html('<img src="' + attachment.url + '" alt="Image" style="max-width:100%;height:auto;" />');
    });
  
    customUploader.open();
  }