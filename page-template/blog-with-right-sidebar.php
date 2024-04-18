<?php
/**
 * Template Name:Blog with Right Sidebar
 */

get_header();

get_template_part('template-parts/banner'); ?>

<?php do_action('vw_podcast_pro_before_blog'); ?>

<div id="blog-right-sidebar">
	<div class="container">
		<div class="middle-align">
			<div class="row">
				<div class="col-lg-9 col-md-8 content_page">
					<div class="row">
						<?php if (have_posts()): ?>
							<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$args = array(
								'paged' => $paged,
								'category_name' => get_theme_mod('vw_podcast_pro_category_setting')
							);
							$custom_query = new WP_Query($args);
							while ($custom_query->have_posts()):
								$custom_query->the_post();
								get_template_part('template-parts/post/post-content');
							endwhile; // end of the loop.
							wp_reset_postdata(); ?>
						<?php else: ?>
							<h2>
								<?php _e('Not Found', 'vw-podcast-pro'); ?>
							</h2>
						<?php endif; ?>
					</div>
					<div class="navigation">
						<?php
						$big = 999999999;
						echo paginate_links(
							array(
								'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
								'format' => 'paged=%#%',
								'current' => (get_query_var('paged') ? get_query_var('paged') : 1),
								'total' => $custom_query->max_num_pages
							)
						);
						?>
					</div>
				</div>
				<div class="col-lg-3 col-md-4" id="sidebar">
					<?php dynamic_sidebar('sidebar-1'); ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
</div>

<?php do_action('vw_podcast_pro_after_blog'); ?>

<?php get_footer(); ?>