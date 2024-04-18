<?php
/**
 * The template for displaying all category pages.
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
	<div class="banner-page-text container">
		<div class="row">
			<div class="col-lg-4 col-sm-6 col-6">
				<div class="above_title">
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
			<div class="col-lg-8">

			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="middle-align">
		<div class="row">
			<div class="col-md-12">
				<div class="row justify-content-start my-5">
					<?php if (have_posts()): ?>
						<header class="page-header">
							<?php
							the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
						</header>
						<?php /* Start the Loop */?>
						<?php while (have_posts()):
							the_post(); ?>
							<div class="blog-card mx-3 my-3" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
								<div class="date-box">
									<?php $post_month = get_the_date('M'); ?>
									<?php $post_date = get_the_date('d'); ?>
									<div class="day">
										<?php echo $post_date ?>
									</div>
									<div class="month">
										<?php echo $post_month ?>
									</div>
								</div>
								<div class="blog-card-content">
									<div class="info-bar">
										<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
											<p><i class="<?php echo get_theme_mod('vw_podcast_pro_blog_author'); ?>"
													aria-hidden="true"> </i>
												<?php the_author(); ?>
											</p>
										</a>
										<p>
											<i
												class="<?php echo get_theme_mod('vw_podcast_pro_blog_comment_icon'); ?>"></i>
											<?php comments_number(); ?>
										</p>
										<p><i
												class="<?php echo get_theme_mod('vw_podcast_pro_blog_fright_icon'); ?>"></i>
											<?php
											// Check if the post has tags
											$post_tags = get_the_tags();
											if ($post_tags) {
												echo '<p>';
												foreach ($post_tags as $tag) {
													// Generate the link to view all posts with this tag
													$tag_link = get_tag_link($tag);
													// Display the tag as a link
													echo '<a href="' . esc_url($tag_link) . '">' . $tag->name . '</a>';
													// Add a comma and space after each tag (except the last one)
													if ($tag !== end($post_tags)) {
														echo ', ';
													}
												}

												echo '</p>';
											}
											?>
										</p>
									</div>
									<a href="<?php the_permalink(); ?>">
										<h5>
											<?php the_title(); ?>
										</h5>
									</a>
								</div>
							</div>
						<?php endwhile; ?>
						<?php // Previous/next page navigation.
							// the_posts_pagination( array(
							// 	'prev_text'          => __( 'Previous page', 'vw-podcast-pro' ),
							// 	'next_text'          => __( 'Next page', 'vw-podcast-pro' ),
							// 	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-podcast-pro' ) . ' </span>',
							// ));?>
					<?php endif; ?>
				</div>
			</div>
			<?php /*<div class="col-md-4">
					<?php get_sidebar( 'page' ); ?>
				</div> */?>

			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>