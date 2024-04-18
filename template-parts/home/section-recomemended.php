<?php
$section_hide = get_theme_mod('vw_podcast_pro_recomended_section_ad_btn_link_image_enable');
$single_page_title = get_theme_mod('vw_podcast_pro_recomm_show_all_btn');


if ($section_hide === 'Disable') {
    return;
}
?>
<section class="recomended">
    <div class="section-heading">
        <h3>Recommended</h3>
        <div class="show-all">
            <a href="<?php echo $single_page_title ?>"><?php echo get_theme_mod('vw_podcast_pro_recomm_show_all_text'); ?></a>
        </div>
    </div>
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
                'terms' => 'songs-cat1', // Slug of the category within the custom taxonomy
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
            $single_page_url = get_permalink($post_id);
            $post_id = get_the_ID();
            $track_url_1 = get_post_meta($post_id, 'song_mp3_file', true);
            $post_title = get_the_title($post_id);
            $content = get_post_field('post_content', $post_id);
            $thumbnail_new = get_the_post_thumbnail_url($post_id, 'medium');
            $radio_terms = wp_get_post_terms($post_id, 'radios');
            $first_term = !empty($radio_terms) ? get_term_link($radio_terms[0]) : ''; // Extracting the first term link if present
            $artist_terms = wp_get_post_terms($post_id, 'artists');
            $artist_link = !empty($artist_terms) ? get_term_link($artist_terms[0]) : ''; // Extracting the artist term link if present
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
                        <a href="<?php echo $single_page_url; ?>">
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
                            <li class="options-div"><a href="<?php the_permalink($post_id); ?>">View Song</a></li>
                            <?php echo !empty($artist_link) ? '<li class="options-div"><a href="' . esc_url($artist_link) . '">View Artist</a></li>' : ''; ?>
                            <?php echo !empty($first_term) ? '<li class="options-div"><a href="' . esc_url($first_term) . '">Song Radio</a></li>' : ''; ?>
                        </ul>
                    </div>
                </div>
            </div>


            <?php
        } ?>
    </div>

</section>