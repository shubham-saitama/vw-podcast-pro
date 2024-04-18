<?php
/*
Template Name: Trending Songs Template
*/
get_header();

// Get the language query parameter
$language = isset($_GET['language']) ? $_GET['language'] : '';
?>
<div class="body-wrapper">

    <?php get_template_part('/template-parts/header/sidebar-header'); ?>
    <div class="main-pageWrap">
        <?php get_template_part('template-parts/home/section-header'); ?>
        <?php get_template_part('template-parts/banner'); ?>
        <div class="song-row trending-page">

            <?php
            // Get the top liked tracks
            $top_tracks = get_top_played_tracks();
            // Check if there are any top liked tracks
            if ($top_tracks) {
                $i = 1;
                foreach ($top_tracks as $track) {
                    $track_url = wp_get_attachment_url($track['post_id']);
                    // Custom database query
                    global $wpdb;

                    $sql_query = $wpdb->prepare(
                        "SELECT post_id 
            FROM {$wpdb->prefix}postmeta
            WHERE meta_key = 'song_mp3_file'
            AND meta_value = %s
            LIMIT 6",
                        $track_url
                    );
                    $post_ids = $wpdb->get_col($sql_query);
                    if ($post_ids) {

                        foreach ($post_ids as $post_id) {
                            if ($i > 6) {
                                continue;
                            }
                            $track_url_1 = wp_get_attachment_url($track['post_id']);
                            $post_title = get_the_title($post_id);
                            $content = get_post_field('post_content', $post_id);
                            $thumbnail_new = get_the_post_thumbnail_url($post_id, 'medium');
                            $i++;
                            ?>
                            <div class="player">
                                <div class="song-thumbnail" style="background-image:url(<?php echo $thumbnail_new; ?>)">
                                    <?php if ($track_url_1) {
                                        echo do_shortcode("[vwwaveplayer url='" . $track_url_1 . "' size='sm' skin='thumb_n_wave' override_wave_colors='0' style='light' autoplay='0']");
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
            } else {
                echo 'No Songs found !!';
            }
            ?>

        </div>




        <?php get_footer(); ?>
    </div>
</div>