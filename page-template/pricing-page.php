<?php
/**
 * Template Name: Pricing Page
 */
get_header();
?>


<div class="body-wrapper">
    <?php get_template_part('/template-parts/header/sidebar-header'); ?>
    <div class="main-pageWrap">
        <?php
        get_template_part('template-parts/home/section-header');

        ?>
        <?php get_template_part('template-parts/banner'); ?>

        <div class="plan-features-wrap">
            <div class="container-custom">
                <div class="page-heading text-center">
                    <h3>
                        <?php echo get_theme_mod('vw_podcast_pro_pricing_page_heading'); ?>
                    </h3>
                    <p class="section-descreption text-center">
                        <?php echo get_theme_mod('vw_podcast_pro_pricing_page_descreption'); ?>
                    </p>
                </div>
                <div class="wrapper-inner">
                    <?php
                    for ($i = 1; $i <= 5; $i++) { ?>
                        <div class="image-wrapper">
                            <div class="image-wrapper-plan">
                                <img src="<?php echo get_theme_mod('vw_podcast_pro_feature_image_' . $i); ?>"
                                    alt="Plan Feature Image" title="Plan Feature Image">
                            </div>
                            <p>
                                <?php echo get_theme_mod('vw_podcast_pro_pricing_page_feature_img_text' . $i); ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php echo do_shortcode('[pmpro_levels]'); ?>

        <?php get_footer(); ?>
    </div>
</div>