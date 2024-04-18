<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package vw-podcast-pro
 */
get_header();
$background_img = get_theme_mod('vw_podcast_pro_inner_page_banner_bgimage');
// get_template_part('template-parts/banner');
?>

<div class="title-box text-center banner-img" style="background-image:url(<?php echo esc_url($background_img); ?>)">
	<div class="banner-page-text container">
		<div class="row">
			<div class="col-lg-4 col-sm-6 col-6">
				<div class="above_title text-center">
					<h1>
						<?php the_archive_title(); ?>
					</h1>
					<?php if (get_theme_mod('vw_podcast_pro_site_breadcrumb_enable', true) != '') { ?>
						<div class=" bradcrumbs">
							<?php vw_podcast_pro_the_breadcrumb(); ?>
						</div>
					<?php }
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="middle-align">
		<div class="row">
			<div class="col-md-12">
				<div class="row justify-content-between my-5">
					<?php if (have_posts()): ?>
						<?php /* Start the Loop */ ?>
						<?php while (have_posts()):
							the_post();
							
							?>
						<?php endwhile;
					endif;
					?>
				</div>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>