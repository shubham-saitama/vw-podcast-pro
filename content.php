<?php
/**
 * @package vw-podcast-pro
 */
?>
<div class="blog-post-repeat">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="postmeta">
					<div class="post-date"><?php the_date(); ?></div>
					<div class="post-comment"> | <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>
					<div class="post-categories"> | <?php the_category( __( ', ', 'vw-podcast-pro' ) );?></div>
					<div class="clear"></div>
				</div>
			<?php endif; ?>
	        <?php if ( is_search() || ! is_single() ) : // Only display Excerpts for Search ?>
	            <div class="post-thumb"><?php the_post_thumbnail( 'medium', array( 'class' => 'alignleft' ) ); ?>
	        <?php else : ?>
	            <div class="post-thumb"><?php the_post_thumbnail(); ?>
	        <?php endif; ?>
				</div>
		</header>
		<?php if ( is_search() || ! is_single() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
				<p class="read-more"><a href="<?php the_permalink(); ?>"><?php _e( 'Read More &raquo;','vw-podcast-pro' ); ?></a></p>
			</div><div class="clear"></div>
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'vw-podcast-pro' ) ); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'vw-podcast-pro' ),
						'after'  => '</div>',
					) );
				?>
			</div>
		<?php endif; ?>
	</article>
	<div class="spacer20"></div>
</div>
