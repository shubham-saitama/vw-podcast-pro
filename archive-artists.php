<?php
/**
 * Template Name: Archive Artists
 */

get_header();

 // Get all terms of the "songs categories" custom taxonomy
$terms = get_terms(
    array(
        'taxonomy' => 'artists', // Change 'song_categories' to your actual taxonomy name
        'hide_empty' => false, // Set to true if you want to exclude empty terms
    )
); ?>



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

        <section class="category-artist-page section-space">
            <div class="">
                <div class="row">

                    <?php  // Get all terms of the "songs categories" custom taxonomy
                    $terms = get_terms(
                        array(
                            'taxonomy' => 'artists', // Change 'song_categories' to your actual taxonomy name
                            'hide_empty' => false, // Set to true if you want to exclude empty terms
                        )
                    ); ?>
                        <div class="archive-row">
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