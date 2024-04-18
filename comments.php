<?php
/**
 * The template for displaying Comments.
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package vw-podcast-pro
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return; 
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'vw-podcast-pro' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'vw-podcast-pro'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	      <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
	         <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'vw-podcast-pro' ); ?></h2>
	         <div class="nav-links">
	            <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'vw-podcast-pro' ) ); ?></div>
	            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'vw-podcast-pro' ) ); ?></div>
	         </div><!-- .nav-links -->
	      </nav><!-- #comment-nav-above -->
      <?php endif; // Check for comment navigation. ?>
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => '<i class="fas fa-reply"></i> ' . __( 'Reply', 'vw-podcast-pro' ),
				) );
			?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	      <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
	         <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'vw-podcast-pro' ); ?></h2>
	         <div class="nav-links">
	            <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'vw-podcast-pro' ) ); ?></div>
	            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'vw-podcast-pro' ) ); ?></div>
	         </div><!-- .nav-links -->
	      </nav><!-- #comment-nav-below -->
      <?php endif; // Check for comment navigation. ?>
	<?php endif; // Check for have_comments(). ?>
	
	<?php // If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'vw-podcast-pro' ); ?></p>
	<?php endif; ?>
	<?php
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		) );
	?>
</div>