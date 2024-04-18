<?php
/**
 * Template Name: Albums Page
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
        <div class="song-row">
            <?php
            if ($albums_query->have_posts()) {
                while ($albums_query->have_posts()) {
                    $albums_query->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); // Change 'thumbnail' to your desired image size
                    ?>
                    <div class="player album">
                        <div class="song-thumbnail">
                            <?php if ($thumbnail_url) { ?>
                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>"
                                    title="<?php the_title_attribute(); ?>">
                            <?php } else { ?>
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/placeholder-image.jpg'); ?>"
                                    alt="Placeholder Image" title="Placeholder Image">
                            <?php } ?>
                        </div>
                        <div class="song-info-wrap">
                            <div class="song-title text-center">
                                <a href="<?php echo get_permalink(); ?>">
                                    <?php the_title(); ?>
                                  
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                wp_reset_postdata();
            } else {
                echo 'No albums found.';
            }
            ?>
        </div>
        <?php get_footer(); ?>
    </div>
</div>