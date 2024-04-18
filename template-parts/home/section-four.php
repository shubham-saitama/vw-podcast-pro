<?php
/**
 * Template to show Top Benifits
 *
 * @package vw_podcast_pro
 */
$section_hide = get_theme_mod('vw_podcast_pro_topBenefits_heading_enable');
if ('Disable' == $section_hide) {
    return;
}
if (get_theme_mod('vw_podcast_pro_topBenefits_heading_bgcolor', '')) {
    $per_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_topBenefits_heading_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_topBenefits_heading_bgimage', '')) {
    $per_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_topBenefits_heading_bgimage')) . '\')';
} else {
    $per_back = '';
}
?>
<section id="topBenifits" class="section-space" style="<?php echo esc_attr($per_back); ?>">
    <div class="">
        <div class="row">
            <h3>Popular Songs</h3>
        </div>
        <div class="song-row">
            <?php
            // Get the top liked tracks
            $top_tracks = get_top_liked_tracks();
            // Check if there are any top liked tracks
            if ($top_tracks) {
                foreach ($top_tracks as $track) {
                    $track_url = wp_get_attachment_url($track['post_id']);
                    // Custom database query
                    global $wpdb;

                    $post_ids = $wpdb->get_col(
                        $wpdb->prepare(
                            "SELECT post_id 
                            FROM {$wpdb->prefix}postmeta
                            WHERE meta_key = 'song_mp3_file'
                            AND meta_value = %s",
                            $track_url
                        )
                    );
                    if ($post_ids) {
                        foreach ($post_ids as $post_id) {
                            $track_url_1 = wp_get_attachment_url($track['post_id']);
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
                        }
                    } 

                }
            }
            ?>

        </div>
    </div>

</section>



