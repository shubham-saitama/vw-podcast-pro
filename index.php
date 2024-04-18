<?php
/**
 * The template for displaying index page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package vw-podcast-pro
 */
get_header();
$background_img = get_theme_mod('vw_podcast_pro_inner_page_banner_bgimage');
?>

<div class="title-box text-center banner-img" style="background-image:url(<?php echo esc_url($background_img); ?>)">
  <div class="banner-page-text container p-0">
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
<?php do_action( 'vw_podcast_pro_after_defaulttitle' ); ?>
<div class="post-section p-0">
	<div class="container p-0">
		<div class="row p-0">
			<div class="col-md-12 p-0">
				<div class="row p-0">
					<?php while ( have_posts() ) : the_post();
						if (has_post_thumbnail()) { // Check if the post has a featured image
							the_post_thumbnail(); // Display the featured image
						}
            $track_url_1 = wp_get_attachment_url($track['post_id']);
            $post_title = get_the_title($post_id);
            $content = get_post_field('post_content', $post_id);
            $thumbnail_new = get_the_post_thumbnail_url($post_id, 'medium');
            $single_page_url = get_permalink($post_id);

						echo do_shortcode("[vwwaveplayer url='" . $track_url_1 . "' size='sm' skin='thumb_n_wave' override_wave_colors='0' style='light' autoplay='0']");
					endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>