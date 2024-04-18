<?php
/**
 * Template Name: Archive Top Charts Page
 */

get_header();

$args = array(
    'post_type' => 'albums',
    'posts_per_page' => -1, // -1 to retrieve all albums
    'orderby' => 'title', // Order by title
    'order' => 'ASC' // Ascending order
);

$albums_query = new WP_Query($args);
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
        <?php get_template_part('template-parts/home/section-header'); ?>
        <div class="title-box text-center banner-img my-5"
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

        <section class="top-chart section-space">
            <div class="">
                <div class="song-row">

                    <?php
                    // Define WP_Query arguments
                    $args = array(
                        'post_type' => 'top_chart', // Custom post type name
                        'posts_per_page' => 6, // Retrieve all posts
                        "order" => 'asc'
                    );

                    // Instantiate WP_Query
                    $top_chart_query = new WP_Query($args);
                    ?>
                    <?php  // Check if there are any posts
                    if ($top_chart_query->have_posts()) {
                        // Start the loop
                        while ($top_chart_query->have_posts()) {
                            $top_chart_query->the_post();
                            // Get post title
                            $post_title = get_the_title();

                            // Get custom meta fields
                            $category = get_post_meta(get_the_ID(), 'category', true);
                            $language = get_post_meta(get_the_ID(), 'top_charts_language', true);
                            $song_count = get_post_meta(get_the_ID(), 'top_charts_song_count', true);
                            $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                            $term_description = get_the_content(get_the_ID());

                            ?>
                            <div class="player">
                                <div class="song-thumbnail" style="background-image:url()">
                                    <img src="<?php echo $featured_image_url; ?>" alt="Artist Image" title="Radio Image">
                                </div>
                                <div class="song-info-wrap">
                                    <div class="song-title text-center">
                                        <a href="<?php echo get_permalink(); ?>" class="mb-1">
                                            <?php echo $post_title; ?>
                                        </a>
                                        <div class="song-description text-center">
                                            <p>
                                                <?php echo $term_description; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        // Restore original post data
                        wp_reset_postdata();
                    } else {
                        // If no posts found
                        echo 'No posts found';
                    } ?>

                    <?php // }   ?>
                </div>
            </div>
        </section>
        <?php get_footer(); ?>
    </div>
</div>