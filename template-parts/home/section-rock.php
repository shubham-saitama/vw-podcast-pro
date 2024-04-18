<section class="rock-cat">
    <h3>Indi Rock</h3>
    <?php
    // WP_Query arguments
    $args = array(
        'post_type' => 'songs', // Assuming 'songs' is the custom post type for songs
        'posts_per_page' => 6,
        'order' => 'rand',
        // Retrieve 6 posts
        'tax_query' => array(
            array(
                'taxonomy' => 'song_categories', // Name of your custom taxonomy
                'field' => 'slug',
                'terms' => 'rock', // Slug of the category within the custom taxonomy
            ),
        ),
        // You can add other arguments as needed
    );

    $query = new WP_Query($args);
    ?>
    <div class="song-row">
        <?php
        // Loop through the posts
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $track_url_1 = get_post_meta($post_id, 'song_mp3_file', true);
            $post_title = get_the_title($post_id);
            $content = get_post_field('post_content', $post_id);
            $thumbnail_new = get_the_post_thumbnail_url($post_id, 'medium');
            ?>
            <div class="player">
                <div class="song-thumbnail" style="background-image:url(<?php echo $thumbnail_new; ?>)">
                    <?php if ($track_url_1) {

                        // Attachment ID found, you can use it as needed
                        echo do_shortcode("[vwwaveplayer url='" . $track_url_1 . "' size = 'sm' skin='thumb_n_wave'
                                    override_wave_colors='0' style='light' autoplay='0']");
                        // echo do_shortcode("[vwwaveplayer url='" . $mp3_file_attachment_id . "' size = 'sm' skin='wvpl-skin-w3-standard' override_wave_colors='0' style='light' autoplay='0']");
                    } ?>
                </div>
                <div class="song-info-wrap">
                    <div class="song-title">
                        <a href="<?php echo the_permalink(); ?>">
                            <?php echo $post_title; ?>
                        </a>
                    </div>
                    <div class="song-description">
                        <p>
                            <?php echo $content; ?>
                        </p>
                    </div>
                    <div class="option-trigger">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                    <div class="options">
                        <ul class="option-wrapper">
                            <li class="options-div">option name</li>
                            <li class="options-div">option name</li>
                            <li class="options-div">option name</li>
                            <li class="options-div">option name</li>
                        </ul>
                    </div>
                </div>
            </div>


            <?php
        } ?>
    </div>
</section>