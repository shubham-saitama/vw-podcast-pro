<?php
/**
 * Template Name:Blog Full Width Extend
 */

get_header();

?>



<div class="body-wrapper">
	<?php get_template_part('/template-parts/header/sidebar-header'); ?>
	<div class="main-pageWrap">
		<?php get_template_part('template-parts/banner'); ?>

		<?php do_action('vw_podcast_pro_before_blog'); ?>

		<section id="full-width-blog">
			<div class="container-fluid">
				<div class="row my-5">
					<?php
					$args = array(
						'post_type' => 'post',
						// Fetch posts
						'posts_per_page' => 6,
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
							<div class="blog-card col-lg-4 col-md-6 col-12 m-0 mb-4">
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
						// Add pagination links with Font Awesome icons
					
						// Pagination
						echo "<div class='pagination'>";
						echo paginate_links(
							array(
								'total' => $query->max_num_pages
							)
						);
						echo "</div>";

						// Restore original post data
						wp_reset_postdata();
					else:
						echo "No posts found.";
					endif;
					?>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
		</section>
	</div>


	<?php get_footer(); ?>
</div>
</div>