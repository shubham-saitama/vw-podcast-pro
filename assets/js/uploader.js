jQuery(function ($) {
    $('body').on('click', '#custom-button-upload', function (e) {
        e.preventDefault();
        obj_uploader = wp.media({
            title: 'Custom image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        }).on('select', function () {
            var attachment = obj_uploader.state().get('selection').first().toJSON();
            $('#category_custom_image').html('');
            $('#category_custom_image').html(
                "<img src=" + attachment.url + " style='width: 100%'>"
            );
            $('#category_custom_image_url').val(attachment.url);
            $("#custom-button-upload").hide();
            $("#custom-button-remove").show();
        })
            .open();
    });

    $(".custom-button-remove").click(function () {
        $('#category_custom_image').html('');
        $('#category_custom_image_url').val('');
        $(this).hide();
        $("#custom-button-upload").show();
    });

});

document.addEventListener('DOMContentLoaded', function () {
    var songSearchInput = document.getElementById('song-search');
    var allSongs = document.querySelectorAll('.song-item');

    songSearchInput.addEventListener('input', function () {
        var searchText = songSearchInput.value.toLowerCase();

        allSongs.forEach(function (song) {
            var songTitle = song.textContent.toLowerCase();
            if (songTitle.indexOf(searchText) === -1) {
                song.style.display = 'none';
            } else {
                song.style.display = 'block';
            }
        });
    });
});

jQuery(document).ready(function ($) {
    // Media Library File Upload
    $('#upload_mp3_button').click(function (e) {
        e.preventDefault();
        var custom_uploader = wp.media({
            title: 'Choose MP3 File',
            button: {
                text: 'Choose MP3'
            },
            multiple: false
        });

        custom_uploader.on('select', function () {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#song_mp3_file').val(attachment.url);
        });

        custom_uploader.open();
    });
});


jQuery(document).ready(function ($) {
    $('#top-chart-category').select2({
        placeholder: 'Select categories',
        allowClear: true
    });
});



jQuery(document).ready(function () {
    // listen if someone clicks 'Buy Now' button
    jQuery('#buy_now_button').click(function () {
        // set value to 1
        jQuery('#is_buy_now').val('1');
        //submit the form
        jQuery('form.cart').submit();
    });
});

jQuery(document).ready(function ($) {
    $('.custom-media-upload').click(function (e) {
        e.preventDefault();
        var customUploader = wp.media({
            title: 'Choose Image',
            button: { text: 'Choose Image' },
            multiple: false
        });
        customUploader.on('select', function () {
            var attachment = customUploader.state().get('selection').first().toJSON();
            $(this).prev('input[type="text"]').val(attachment.url);
        });
        customUploader.open();
    });
});