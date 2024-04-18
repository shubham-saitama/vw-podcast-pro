<?php
/**
 * Template Name: Wishlist
 */
get_header();
$background_img = get_theme_mod('vw_podcast_pro_inner_page_banner_bgimage');
?>

<div class="body-wrapper">
    <?php get_template_part('/template-parts/header/sidebar-header'); ?>
    <div class="main-pageWrap">
        <?php get_template_part('template-parts/home/section-header'); ?>
        <div class="title-box text-center banner-img my-3"
            style="background-image:url(<?php echo esc_url($background_img); ?>)">
            <div class="banner-page-text ">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-6">
                        <div class="above_title">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                            <?php if (get_theme_mod('vw_podcast_pro_site_breadcrumb_enable', true) != '') { ?>
                                <div class=" bradcrumbs">
                                    <?php vw_podcast_pro_the_breadcrumb(); ?>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-8">

                    </div>
                </div>
            </div>
        </div>
        <?php do_action('vw_podcast_pro_after_defaulttitle'); ?>

        <section class="liked-tracks">
            <div class="archive-row">

                <?php
                // Get the top liked tracks
                $liked_tracks = get_top_liked_tracks();

                global $wpdb;
                if (empty($liked_tracks)) {
                    echo '<p class="no-tracks">No liked tracks found.</p>';
                } else {
                    foreach ($liked_tracks as $track_id) {
                        // Get the URL of the track using the track ID
                        $track_url = wp_get_attachment_url($track_id);

                        // Prepare SQL query to retrieve post IDs based on the track URL
                        $sql_query = $wpdb->prepare(
                            "SELECT post_id 
                            FROM {$wpdb->prefix}postmeta
                            WHERE meta_key = 'song_mp3_file'
                            AND meta_value = %s
                            LIMIT 10",
                            $track_url
                        );

                        // Execute the SQL query
                        $post_ids = $wpdb->get_col($sql_query);

                        if ($post_ids) {
                            foreach ($post_ids as $post_id) {
                                // Render track only if it matches the conditions
                                $track_url_1 = wp_get_attachment_url($track_id);
                                $post_title = get_the_title($post_id);
                                $content = get_post_field('post_content', $post_id);
                                $thumbnail_new = get_the_post_thumbnail_url($post_id, 'medium');
                                $single_page_url = get_permalink($post_id);
                                $radio_terms = wp_get_post_terms($post_id, 'radios');
                                $first_term = !empty($radio_terms) ? get_term_link($radio_terms[0]) : ''; // Extracting the first term link if present
                                $artist_terms = wp_get_post_terms($post_id, 'artists');
                                $artist_link = !empty($artist_terms) ? get_term_link($artist_terms[0]) : ''; // Extracting the artist term link if present
                                ?>
                                <div class="player">
                                    <div class="song-number">
                                        <?php echo $i; ?>
                                    </div>
                                    <div class="song-thumbnail" style="background-image:url(<?php echo $thumbnail_new; ?>)">
                                        <?php if ($track_url_1) {
                                            echo do_shortcode("[vwwaveplayer url='" . $track_url_1 . "' size='sm' skin='thumb_n_wave' override_wave_colors='0' style='light' autoplay='0']");

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
                            }
                        }
                    }
                }
                ?>
        </section>
        <section class="recomended">
            <h3>Related Songs</h3>

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
                                    <li class="options-div"><a href="<?php the_permalink($post_id); ?>">View Song</a>
                                    </li>
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

        <?php  // Get all terms of the "songs categories" custom taxonomy
        $terms = get_terms(
            array(
                'taxonomy' => 'artists', // Change 'song_categories' to your actual taxonomy name
                'hide_empty' => false, // Set to true if you want to exclude empty terms
            )
        ); ?>

        <section class="category-artist section-space">
            <div class="">
                <div class="row">
                    <h3>Fans Also Liked</h3>
                    <?php  // Get all terms of the "songs categories" custom taxonomy
                    $terms = get_terms(
                        array(
                            'taxonomy' => 'artists', // Change 'song_categories' to your actual taxonomy name
                            'hide_empty' => false, // Set to true if you want to exclude empty terms
                        )
                    ); ?>
                    <div class="song-row">
                        <?php
                        // Loop through each term
                        foreach ($terms as $term) {
                            // Get term name
                            $term_name = $term->name;

                            // Get term image (if stored as term meta)
                            $term_id = $term->term_id;
                            $thumbnail = get_term_meta($term_id, 'category_custom_image_url', true); // Change 'full' to your desired image size
                            $term_description = term_description($term_id);
                            // Get term link
                            $term_link = get_term_link($term);
                            ?>
                            <div class="player">
                                <div class="song-thumbnail" style="background-image:url()">
                                    <img src="<?php echo $thumbnail; ?>" alt="Artist Image" title="Artist Image">
                                </div>
                                <div class="song-info-wrap">
                                    <div class="song-title text-center">
                                        <a href="<?php echo $term_link; ?>">
                                            <?php echo $term_name; ?>
                                        </a>
                                    </div>
                                    <div class="song-description text-center">
                                        <?php echo $term_description; ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php get_footer(); ?>
    </div>
</div>