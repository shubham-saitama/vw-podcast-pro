<?php
/*
 * Template Name: Artists Archive
 * Description: A custom template for displaying the archive of songs by category.
 */

get_header(); // Include header template
?>
<div class="body-wrapper">

    <nav class="main-sidebar">
        <span class="mobile-open">
            <i class="fas fa-chevron-left d-none"></i>
            <i class="fas fa-chevron-right"></i>
        </span>
        <div class="inner-slidbar">
            <?php dynamic_sidebar('main-sidebar'); ?>
        </div>
    </nav>
    <div class="main-pageWrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php get_template_part('template-parts/home/section-header'); ?>
                <?php if (have_posts()): ?>

                    <header class="page-header">
                        <h1 class="page-title my-5">
                            <?php single_cat_title(); ?>
                        </h1>
                    </header><!-- .page-header -->
                    <section class="category-archive">
                        <div class="archive-row">
                            <?php
                            // Start the Loop.
                            while (have_posts()):
                                the_post();

                                // Your template for displaying each song.
                                // You can use functions like the_title(), the_content(), etc.
                                // Loop through the posts
                        

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
                                                <li class="options-div"><a href="<?php the_permalink($post_id); ?>">View
                                                        Song</a>
                                                </li>
                                                <?php echo !empty($artist_link) ? '<li class="options-div"><a href="' . esc_url($artist_link) . '">View Artist</a></li>' : ''; ?>
                                                <?php echo !empty($first_term) ? '<li class="options-div"><a href="' . esc_url($first_term) . '">Song Radio</a></li>' : ''; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div><!-- .archive-row -->
                    </section>

                    <?php
                    // Previous/next page navigation.
                    the_posts_pagination();
                    ?>
                <?php else:
                    // If no content, include the "No posts found" template.
                    get_template_part('template-parts/content', 'none');
                endif;
                ?>
                <?php get_footer(); ?>

            </main><!-- .site-main -->
        </div><!-- .content-area -->
    </div>
</div>