<?php
/**
 * Template Name:Blog with Left Sidebar 
 */

get_header();

?>

<?php do_action('vw_podcast_pro_before_blog'); ?>

<div id="blog-left-sidebar">
	<div class="">
		<div class="middle-align">
			<div class="row">
				<?php
				/**
				 * Template Name:Blog With Left And Right Sidebar
				 */

				get_header();
				get_template_part('template-parts/banner');
				?>
				<?php do_action('vw_podcast_pro_before_blog'); ?>
				<main id="maincontent" role="main" class="my-5">
					<div id="blog-right-sidebar">
						<div class="container">
							<div class="content_page row">
								<div class="col-lg-4 col-md-3-col-12">
									<?php
									if (is_active_sidebar('sidebar-1')) {
										dynamic_sidebar('sidebar-1');
									}
									?>
									
								</div>
								<div class="col-lg-8 col-md-12 col-12">
									<div class="row">
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
												<div class="blog-card col-lg-6 col-md-6 col-12 m-0 mb-4">
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
														<img src="<?php echo get_the_post_thumbnail_url(); ?>"
															alt="blog thumbnail">
													</div>

													<div class="blog-card-content">
														<div class="info-bar">
															<a href="#"><i
																	class="<?php echo get_theme_mod('vw_podcast_pro_blog_icons'); ?>"></i>
																<?php echo get_the_date('j, F Y'); ?>
															</a>
															<p>
																<i
																	class="<?php echo get_theme_mod('vw_podcast_pro_blog_icons2'); ?>"></i>
																<?php comments_number(); ?>
															</p>
														</div>
														<h5>
															<?php the_title(); ?>
														</h5>
														<a class="blog-link" href="<?php the_permalink(); ?>">
															<?php echo get_theme_mod('vw_podcast_pro_blog_read_more'); ?> <i
																class="<?php echo get_theme_mod('vw_podcast_pro_blog_icons3'); ?>"></i>
														</a>
													</div>
												</div>

												<?php
											endwhile;
											// Add pagination links with Font Awesome icons
											echo '<div class="pagination">';
											echo paginate_links(
												array(
													'total' => $query->max_num_pages,
													'prev_text' => '<i class="fas fa-angle-left"></i>',
													// Font Awesome left arrow icon
													'next_text' => '<i class="fas fa-angle-right"></i>',
													// Font Awesome right arrow icon
												)
											);
											echo '</div>';
											wp_reset_postdata();
										else:
											echo "No posts found.";
										endif;
										?>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</main>
				<?php do_action('vw_podcast_pro_after_blog'); ?>
				<?php get_footer(); ?>
			</div>
		</div>
	</div>
</div>

<?php do_action('vw_podcast_pro_after_blog'); ?>

<?php get_footer(); ?>