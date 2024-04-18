<?php
/**
 * Template Name: History Page
 */

get_header();

?>


<div class="body-wrapper">

    <?php get_template_part('/template-parts/header/sidebar-header'); ?>
    <div class="main-pageWrap">
        <?php get_template_part('template-parts/home/section-header'); ?>
        <?php get_template_part('template-parts/banner'); ?>
        <div class="container p-0">
            <h2 class="sec-heading my-5">
                Recently Played
            </h2>


            <?php
            // Get the track history
            $track_history = get_track_history();
            $i = 1;
            // Check if there is any track history
            if (!empty($track_history)) {
                echo '<ul>';
                foreach ($track_history as $track_id) {

                    $track_url = wp_get_attachment_url($track_id);
                    if ($track_id) {
                        // Get attachment metadata
                        $attachment_metadata = wp_get_attachment_metadata($track_id);
                        $length_formatted = isset($attachment_metadata['length_formatted']) ? $attachment_metadata['length_formatted'] : 'N/A';
                        $album = isset($attachment_metadata["album"]) ? $attachment_metadata['album'] : 'Album N/A';
                    }

                    global $wpdb;
                    $sql_query = $wpdb->prepare(
                        "SELECT post_id 
                                FROM {$wpdb->prefix}postmeta
                                WHERE meta_key = 'song_mp3_file'
                                AND meta_value = %s
                                LIMIT 10",
                        $track_url
                    );
                    $post_ids = $wpdb->get_col($sql_query);

                    if ($post_ids) {
                        foreach ($post_ids as $post_id) {
                            if ($i > 15) {
                                break; // Stop processing tracks if already rendered 6
                            }

                            $track_url_1 = get_post_meta($post_id, 'song_mp3_file', 'true');
                            $post_title = get_the_title($post_id);


                            $single_page_url = get_permalink($post_id);
                            $radio_terms = wp_get_post_terms($post_id, 'radios');
                            $first_term = !empty($radio_terms) ? get_term_link($radio_terms[0]) : ''; // Extracting the first term link if present
                            $artist_terms = wp_get_post_terms($post_id, 'artists');
                            $artist_link = !empty($artist_terms) ? get_term_link($artist_terms[0]) : ''; // Extracting the artist term link if present
                            ?>
                            <div class="player-history">
                                <div class="song-info-wrap">
                                    <div class="liked-div-wrapper">
                                        <?php echo do_shortcode("[vwwaveplayer url=" . $track_url_1 . " shape = 'square' size='xs' skin='w3-exhibition' override_wave_colors='0' style='light' autoplay='0']"); ?>
                                        <div class="duretion">
                                            <?php echo $length_formatted; ?>
                                        </div>
                                    </div>
                                    <div class="song-albun-history">
                                        <?php echo $album; ?>
                                    </div>
                                    <div class="song-title-des-wrap">
                                        <div class="song-title">
                                            <a href="<?php echo $single_page_url; ?>">
                                                <?php echo $post_title; ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="option-trigger"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                                    <div class="options">
                                        <ul class="option-wrapper">
                                            <li class="options-div"><a href="<?php the_permalink($post_id); ?>">View Song</a>
                                            </li>
                                            <?php echo !empty($artist_link) ? '<li class="options-div"><a href="' . esc_url($artist_link) . '">View Artist</a></li>' : ''; ?>
                                            <?php echo !empty($first_term) ? '<li class="options-div"><a href="' . esc_url($first_term) . '">Song Radio</a></li>' : ''; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // Increment $i only if a track is rendered and the conditions are met
                            $i++;
                        }
                    }
                }
                echo '</ul>';
            } else {
                // If there is no track history, display a message
                echo '<p>No track history available.</p>';
            }
            ?>
        </div>
        <?php
        get_footer();
        ?>