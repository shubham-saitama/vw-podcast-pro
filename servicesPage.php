<?php
/**
 * The Template for displaying Services.
 *
 * @package vw-podcast-pro
 */
get_header();
get_template_part('template-parts/banner');
if (get_theme_mod('vw_podcast_pro_services_page_bg_color', '')) {
  $service_backg = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_services_page_bg_color', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_services_page_bg_image', '')) {
  $service_backg = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_services_page_bg_image')) . '\')';
} else {
  $service_backg = '';
}
?>
<section id="service-page" class="<?php echo esc_attr($img_bg); ?>" style="<?php echo esc_attr($service_backg); ?>">
  <div class="container">
    <div class="row mb-2 justify-content-center text-center">
      <div class="col-lg-6 col-md-6">
        <!-- <?php //if (get_theme_mod('vw_podcast_pro_our_services_page_sub_heading') != ''): ?>
          <p class="sub-head-border position-relative">
            <?php//echo esc_html(get_theme_mod('vw_podcast_pro_our_services_page_sub_heading')); ?>
          </p>
        <?php// endif; ?>
        <?php// if (get_theme_mod('vw_podcast_pro_our_services_page_heading') != ''): ?>
          <h2 class="">
            <?php// echo esc_html(get_theme_mod('vw_podcast_pro_our_services_page_heading')); ?>
          </h2>
        <?php// endif; ?>
        <?php //if (get_theme_mod('vw_podcast_pro_our_services_page_paragraph') != ''): ?>
          <p class="performance-para">
            <?php // esc_html(get_theme_mod('vw_podcast_pro_our_services_page_paragraph')); ?>
          </p>
        <?php //endif; ?> -->
      </div>
    </div>
    <div class="service-page-inner my-5">
          <div class="row">
      <?php
      $args = array(
        'post_type' => 'services',
        // Replace 'services' with your actual custom post type name
        'posts_per_page' => -1,
        // Display all posts
        'order' => 'ASC', // Display posts in ascending order
      );

      $services_query = new WP_Query($args);

      if ($services_query->have_posts()) {
        while ($services_query->have_posts()) {
          $services_query->the_post();
          $icon_url = get_post_meta(get_the_ID(), 'services_icon', true); // Get the icon URL
          // Get the featured image URL
          $featured_image_url = get_the_post_thumbnail_url();

          // Get other post content or meta information
          $title = get_the_title();
          $content = get_the_content();
          $link = get_permalink();
          // Display the service card
          // Display the icon if available
      
          if ($featured_image_url) {
            echo '<div class="service-card col-lg-4 col-md-6 col-12 mb-4"  style="background-image: url(' . ($featured_image_url) . ');">';
          }
          if ($icon_url) {
            echo '<div class="services-icon"><img src="' . esc_url($icon_url) . '" alt="Service Icon"></div>';
          }
          echo '<a href="'. esc_html($link) .'"><h3>' . esc_html($title) . '</h3> </a>';
          echo '</div>';
         
        }

        wp_reset_postdata(); // Reset the post data to the main query
      } else {
        echo 'No services found.';
      }
      ?>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>