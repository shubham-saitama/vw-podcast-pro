<?php
/**
 * Template to show Client Slider
 *
 * @package vw_podcast_pro
 */
$section_hide = get_theme_mod('vw_podcast_pro_our_client_slider_image_enable');
if ('Disable' == $section_hide) {
  return;
}
if (get_theme_mod('vw_podcast_pro_our_client_slider_image_bgcolor', '')) {
  $per_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_our_client_slider_image_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_our_client_slider_image_bgimage', '')) {
  $per_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_our_client_slider_image_bgimage')) . '\')';
} else {
  $per_back = '';
}
?>

<section id="partnerSlider" class="section-space" style="<?php echo esc_attr($per_back); ?>">
  <div class="container">
    <div class="row align-item-center justify-content-center">
      <div id="clientSlider" class="owl-carousel">
        <!-- Slide loop -->
        <!-- Slider Container -->
          <?php
          $num_image_fields = get_theme_mod('vw_podcast_pro_client_images_count'); // Adjust this number to match the number of image fields you want to display
          
          for ($i = 1; $i <= $num_image_fields; $i++) {
            $setting_name = 'vw_podcast_pro_client_slider_image_' . $i;
            $image_url = get_theme_mod($setting_name);

            if (!empty($image_url)) {
              echo '<div class="item"><img src="' . esc_url($image_url) . '" alt="Client Logo ' . $i . '"> </div>';
            }
          }
          ?>
      </div>
    </div>
  </div>
</section>