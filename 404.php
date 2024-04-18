<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package vw-podcast-pro
 */
get_header();
get_template_part('template-parts/banner');

if (get_theme_mod('vw_podcast_pro_404_page_bgcolor', '')) {
	$error_page_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_404_page_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_404_page_bgimage', '')) {
	$error_page_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_404_page_bgimage')) . '\')';
} else {
	$error_page_back = '';
}
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
		<section class="content_page error-page <?php echo esc_attr($img_bg); ?>"
			style="<?php echo esc_attr($error_page_back); ?>">
			<div class="container">
				<div class="row text-center justify-content-center my-5">
					<div class="col-md-8 tablet-error">
						<img class="errorimg"
							src="<?php echo esc_html(get_theme_mod('vw_podcast_pro_error_temp_bg_images')); ?>">
						<div class="page-content error_bgs">

							<span class="big-word">
								<?php echo get_theme_mod('vw_podcast_pro_404_page_big_word'); ?>
							</span>


							<?php if (get_theme_mod('vw_podcast_pro_404_page_content') != ''): ?>
								<p class="error-para mt-3 heading-description">
									<?php echo esc_html(get_theme_mod('vw_podcast_pro_404_page_content')); ?>
								</p>
							<?php endif; ?>
							<?php if (get_theme_mod('vw_podcast_pro_404_page_button_text') != ''): ?>
								<a class="red-btn" href="<?php echo esc_url(home_url()); ?>">
									<?php echo esc_html(get_theme_mod('vw_podcast_pro_404_page_button_text')); ?>
								</a>
							<?php endif; ?>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php get_footer(); ?>
	</div>
</div>