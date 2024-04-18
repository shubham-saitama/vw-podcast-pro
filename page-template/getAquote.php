<?php
/**
 * Template Name:Get A Quote Template
 *
 *
 */

get_header();
// get_template_part('template-parts/banner');

if (get_theme_mod('vw_podcast_pro_getAquote_bgcolor', '')) {
  $about_page_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_getAquote_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_getAquote_bgimage', '')) {
  $about_page_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_getAquote_bgimage')) . '\')';
} else {
  $about_page_back = '';
}
// $img_bg = get_theme_mod('vw_podcast_pro_getAquote_bg_attachment');

if (get_theme_mod('vw_podcast_pro_getAquote_bgcolor', '')) {
  $getAquote_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_getAquote_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_getAquote_bgimage', '')) {
  $getAquote_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_getAquote_bgimage')) . '\')';
} else {
  $getAquote_back = '';
}

$quotecontactForm = get_theme_mod('vw_podcast_pro_pricing_from_shortcode');
get_template_part('template-parts/banner'); ?>
<section class="getAquote">
  <div class="container">
    <div class="row">

    </div>
  </div>
  </div>
</section>

<section class="freequote section-space">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12 col-12">
        <?php echo do_shortcode($quotecontactForm); ?>
      </div>
      <div class="col-lg-5 col-md-12 col-12 image-container">
        <div class="quote-image">
          <img src="<?php echo get_theme_mod('vw_podcast_pro_quote_page_image'); ?>" alt="get quote image">
        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>