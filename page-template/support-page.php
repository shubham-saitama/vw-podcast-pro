<?php
/**
 * Template Name:Support Page Template
 *
 *
 */

get_header();

if (get_theme_mod('vw_podcast_pro_contactus_page_bgcolor', '')) {
    $about_page_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_contactus_page_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_contactus_page_bgimage', '')) {
    $about_page_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_contactus_page_bgimage')) . '\')';
} else {
    $about_page_back = '';
}

$supportContactForm = get_theme_mod('vw_podcast_pro_contactus_contactform_shortcode');
$faqCount = get_theme_mod('vw_podcast_pro_faq_count', 5); // Number of FAQ questions to display

?>

<div class="body-wrapper">

    <?php get_template_part('/template-parts/header/sidebar-header'); ?>
    <div class="main-pageWrap">
        <?php get_template_part('template-parts/home/section-header'); ?>
        <?php get_template_part('template-parts/banner'); ?>
        <section class="support-page" style="<?php echo $about_page_back ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="middle-content p-0">
                        <?php the_content(); ?>
                    </div>
                    <div class="contactus-section mt-5">
                        <div class="row">
                            <div class="support-contact-info col-lg-6">
                                <h3>
                                    <?php echo get_theme_mod('vw_podcast_pro_contactus_contact_sectionheading'); ?>
                                </h3>
                                <p>
                                    <?php echo get_theme_mod('vw_podcast_pro_contactus_contact_section_desc'); ?>
                                </p>
                                <div class="map">
                                    <iframe
                                        src="https://maps.google.com/maps?q=<?php echo get_theme_mod('vw_podcast_pro_contactus_latitude'); ?>,<?php echo get_theme_mod('vw_podcast_pro_contactus_longitude'); ?>&hl=en&z=20&amp;output=embed"
                                        frameborder="0">
                                    </iframe>
                                </div>
                            </div>
                            <div class="contact col-lg-6">
                                <div class="support-form-wrapper">
                                    <?php echo do_shortcode($supportContactForm); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php get_template_part('template-parts/home/section-faq') ?>
                </div>
            </div>
        </section>


        <?php get_footer(); ?>
    </div>
</div>