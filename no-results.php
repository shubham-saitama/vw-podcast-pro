<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package vw-podcast-pro
 */
?>
<header>
	<h3 class="entry-title"><?php _e( 'Nothing Found', 'vw-podcast-pro' ); ?></h3>
</header>
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'vw-podcast-pro' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php elseif ( is_search() ) : ?>
	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vw-podcast-pro' ); ?></p><br />
		<?php get_search_form(); ?>
<?php else : ?>
	<p><?php _e( 'Don\'t worry &hellip; it happens to the best of us.', 'vw-podcast-pro' ); ?></p>
	<br />
	<div class="read-moresec">
		<div><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button hvr-sweep-to-right"><?php _e( 'Back to Home Page', 'vw-podcast-pro' ); ?></a></div>
	</div>
<?php endif; ?>