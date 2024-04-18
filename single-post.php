<?php
/**
 * The Template for displaying all single posts.
 *
 * @package vw-podcast-pro
 */
get_header();
// get_template_part( 'template-parts/banner' );

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

		<?php while (have_posts()):
			the_post(); ?>
			<div class=" blog-single">
				<?php if (has_post_thumbnail()) { ?>
					<div class="single-post-img">
						<img src="<?php the_post_thumbnail_url('full'); ?>">
					</div>
				<?php } ?>
				<div class="container single-post" id="single-post-page">
					<div class="row justify-content-center">
						<div class="content_page col-lg-12 col-md-12 col-sm-12  mt-5">
							<div class="single-post">
								<div class="single-page-title text-lg-start text-md-start ">
									<h2>
										<?php echo get_the_title(); ?>
									</h2>
								</div>

								<ul class="d-flex text-lg-start  mb-4 post-ul mt-4">
									<?php if (get_theme_mod('vw_podcast_pro_post_general_settings_post_author', true) == "1") { ?>
										<li class="entry-author list-unstyled">
											<img class="single-author-image"
												src="<?php echo esc_url(get_avatar_url($current_user->ID)); ?>">
											<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
												<?php the_author(); ?>
											</a>
										</li>
									<?php } ?>

									<?php if (get_theme_mod('vw_podcast_pro_post_general_settings_post_date', true) == "1") { ?>
										<li class="entry-date before-dot self-align-center">
											<?php echo esc_html(get_the_date('M d, Y')); ?>
										</li>
									<?php } ?>
									<?php if (get_theme_mod('vw_podcast_pro_post_general_settings_post_comments', true) == "1") {
										$comments_count = get_comments_number(); ?>
										<li class="entry-comments">
											<a href="#comments">
												0<?php printf(_n('%d Comment', '%d Comments', $comments_count, 'vw-podcast-pro'), $comments_count); ?>
											</a>
										</li>
									<?php } ?>
								</ul>
								<div class="single-post-content before-dot ">
									<div class="">
										<p class="mb-4">
											<?php echo esc_html(get_post_meta($post->ID, 'post_para_1', true)); ?>
										</p>
									</div>
									<div class="">
										<h4 class="mb-2 blog-que">
											<?php echo esc_html(get_post_meta($post->ID, 'post_que', true)); ?>
										</h4>
									</div>

									<div class="">
										<p class="mb-3">
											<?php echo esc_html(get_post_meta($post->ID, 'post_para_2', true)); ?>
										</p>
									</div>
								</div>
								<div class="row single-blog-img">
									<div class="col-md-6 my-5">
										<?php if (get_post_meta($post->ID, 'post_image_1', true)) { ?>
											<img src="<?php echo esc_html(get_post_meta($post->ID, 'post_image_1', true)); ?>"
												alt="Single Blog Image">
										<?php } ?>
									</div>
									<div class="col-md-6 my-5">
										<?php if (get_post_meta($post->ID, 'post_image_2', true)) { ?>
											<img src="<?php echo esc_html(get_post_meta($post->ID, 'post_image_2', true)); ?>"
												alt="Single Blog Image">
										<?php } ?>
									</div>
								</div>
								<div class="">
									<p class="mb-5">
										<?php echo esc_html(get_post_meta($post->ID, 'post_para_3', true)); ?>
									</p>
								</div>

							</div>
							<div class="single-blog-widget">
								<div class="row">
									<div class="col-lg-8 col-md-6 col-12 categories">
										<span>
											<?php
											$categories = get_the_category();
											if ($categories) {
												echo "Categories: ";
												foreach ($categories as $category) {
													echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a> ';
												}
											}
											?>

										</span>
									</div>
									<div class="col-lg-4 col-md-6 col-12 social-icons">
										<?php if (is_active_sidebar('single-blog-widget')): ?>
											<aside id="single-blog-widget-area" class="widget-area">
												<?php vw_podcast_pro_social_share(); ?>
											</aside>
										<?php endif; ?>

									</div>
								</div>
							</div>

						</div>
						<div class="single-post-comment col-lg-12 col-md-12 col-12 section-space">
							<?php
							if (comments_open() || '0' != get_comments_number()) {
								comments_template();
							}
							?>
						</div>
						<div class="recent-posts my-5">
							<?php if (get_theme_mod('vw_podcast_pro_single_blog_heading_tag') != false && get_theme_mod('vw_podcast_pro_blog_heading') != false) { ?>
								<div class="heading text-center">
									<div class="h2">
										<h2>
											<?php echo get_theme_mod('vw_podcast_pro_single_blog_heading_tag'); ?>
										</h2>
									</div>
									<p class="heading-description">
										<?php echo get_theme_mod('vw_podcast_pro_single_blog_heading'); ?>
										</h2>
								</div>
							<?php } ?>

							<div class="related-posts my-5">
								<div class="slick-slider">
									<?php
									$args = array(
										'post_type' => 'post',
										// Fetch posts
										'posts_per_page' => 5,
										// Number of posts to display
										'order' => 'DESC',
										// Display posts in descending order
										'orderby' => 'date' // Order posts by date
									);
									$query = new WP_Query($args);

									if ($query->have_posts()):
										while ($query->have_posts()):
											$query->the_post();
											?>
											<div class="blog-card">
												<div class="tags">
													<?php
													// Get the post categories
													$categories = get_the_category();
													if ($categories) {
														foreach ($categories as $category) {
															// Generate the link to view all posts in this category
															$category_link = get_category_link($category);
															// Display the category as a link
															echo '<a href="' . esc_url($category_link) . '">' . $category->name . '</a>';
															// Add a comma and space after each category (except the last one)
															if ($category !== end($categories)) {
																echo ', ';
															}
														}
													}
													?>
												</div>
												<div class="thumbnail-wrap">
													<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="blog thumbnail">
												</div>

												<div class="blog-card-content">
													<h5>
														<?php the_title(); ?>
													</h5>
													<div class="info-bar">
														<a href="#">
															<?php echo get_the_date('j, F Y'); ?>
														</a>
														<p>
															<?php echo get_the_author(); ?>
														</p>
														<a class="blog-link" href="<?php the_permalink(); ?>">
															<?php echo get_theme_mod('vw_podcast_pro_blog_read_more'); ?>
														</a>
													</div>

												</div>
											</div>
											<?php
										endwhile;
										wp_reset_postdata();
									else:
										echo "No posts found.";
									endif;
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; // end of the loop.      ?>

		<?php get_footer(); ?>
	</div>
</div>

</div>