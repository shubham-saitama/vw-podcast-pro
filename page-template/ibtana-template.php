<?php
/**
 * Template Name:Ibtana Template
 */
get_header();
 if ( (ThemeWhizzie::get_the_validation_status() === 'true') && (ThemeWhizzie::get_the_suspension_status() == 'false') ) {
?>
	<div id="ive-theme-content-area">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; wp_reset_query(); ?>
	</div>
<?php
  }
 get_footer(); ?>