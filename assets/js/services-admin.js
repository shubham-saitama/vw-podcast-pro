jQuery(document).ready(function($){
    $('#services_icon_upload').click(function(e) {
        e.preventDefault();
        var imageUploader = wp.media({
            title: 'Upload Icon',
            button: {
                text: 'Use this icon'
            },
            multiple: false
        });

        imageUploader.on('select', function() {
            var attachment = imageUploader.state().get('selection').first().toJSON();
            $('#services_icon').val(attachment.url);
        });

        imageUploader.open();
    });
});
