<?php

/*
* Related Post
*/

if ( !function_exists('vw_podcast_pro_related_posts') ) {
    function vw_podcast_pro_related_posts(){ ?>
        <div class="related-post-wrapper">
            <?php if(get_theme_mod('vw_podcast_pro_related_posts_title')!=''){ ?>
                <h3>
                    <?php echo esc_html(get_theme_mod('vw_podcast_pro_related_posts_title')); ?>
                </h3>
            <?php } ?>
            <div class="row">
                <?php
                    $current_post_title = get_the_ID();
                    $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => get_theme_mod('vw_podcast_pro_related_post_count')
                    );
                    $query = new WP_Query($args);
                    if ( $query->have_posts() ) :  while ($query->have_posts()) : $query->the_post();

                    if(get_the_ID() != $current_post_title){?>
                    <div class="col-lg-4 col-md-4 related-post-wrap mb-4">
                        <?php
                        if(has_post_thumbnail()){
                          the_post_thumbnail();
                        }
                        ?>
                        <a href="<?php the_permalink(); ?>" class="post-page-title pt-2"><?php the_title(); ?></a>
                        <div class="post-single-text"><?php $excerpt = get_the_excerpt(); echo esc_html(vw_podcast_pro_string_limit_words($excerpt,15)); ?></div>
                    </div>
                <?php } endwhile; endif; ?>
            </div>
        </div>
    <?php }
}

/*
* Post navigation
*/
if ( !function_exists('vw_podcast_pro_single_navigation') ) {
    function vw_podcast_pro_single_navigation(){
        the_post_navigation( array(
            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __(get_theme_mod('vw_podcast_pro_blog_category_next_title'), 'vw-podcast-pro' ) .'</span> ' .
                '<span class="screen-reader-text">' . __( 'Next post:', 'vw-podcast-pro' ) . '</span> ' .
                '<span class="post-title">%title</span>',
            'prev_text' => '<span class="meta-nav" aria-hidden="true">'. __(get_theme_mod('vw_podcast_pro_blog_category_prev_title'), 'vw-podcast-pro' ) . '</span> ' .
                '<span class="screen-reader-text">' . __( 'Previous post:', 'vw-podcast-pro' ) . '</span> ' .
                '<span class="post-title">%title</span>',
        ) );
    }
}

/*
* Show Page title on pages, post.
*/
if ( !function_exists('vw_podcast_pro_post_auther_bio') ) {

    function vw_podcast_pro_post_auther_bio(){ ?>
        <div class="authordetails">
            <div class="authordescription">
                <?php
                $author_details = "";
                $user_posts=get_author_posts_url( get_the_author_meta( 'ID' ) );
                global $post;
                $content ='';
                                // Detect if it is a single post with a post author
                if ( is_single() && isset( $post->post_author ) ) {
                                    // Get author's display name
                    $display_name = get_the_author_meta( 'display_name', $post->post_author );
                                    // Get author's biographical information or description
                    $user_description = get_the_author_meta( 'user_description', $post->post_author );
                    if ( ! empty( $user_description ) )
                        $author_details .= '<p class="author_links"><a href="'. $user_posts .'"> ' . esc_html($display_name) . '</a>';
                                    // Author avatar and bio
                    $author_details .= '<div class="clear"></div><div class="row"><div class="col-md-2 col-lg-2 author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ).'</div><div class="col-md-10 col-lg-10 b-content">' . nl2br( $user_description ). '</div>';

                    $author_details .= '</div>';

                                    // Pass all this info to post content
                    $content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
                }
                echo $content;
                ?>
            </div>
            <ul class ="social-profile">
                <?php
                $tumbler_url = get_the_author_meta( 'tumbler_url' );
                if ( $tumbler_url && $tumbler_url != '' ) {
                    echo '<li class="tumbler">
                    <a href="' . esc_url($tumbler_url) . '" target="_blank"><i class="fab fa-tumblr"></i></a></li>';
                }

                $pinterest_profile = get_the_author_meta( 'pinterest_profile' );
                if ( $pinterest_profile && $pinterest_profile != '' ) {
                    echo '<li class="google">
                    <a href="' . esc_url($pinterest_profile) . '" rel="author" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>';
                }

                $twitter_profile = get_the_author_meta( 'twitter_profile' );
                if ( $twitter_profile && $twitter_profile != '' ) {
                    echo '<li class="twitter">
                    <a href="' . esc_url($twitter_profile) . '" target="_blank"> <i class="fab fa-twitter"></i></a></li>';
                }

                $facebook_profile = get_the_author_meta( 'facebook_profile' );
                if ( $facebook_profile && $facebook_profile != '' ) {
                    echo '<li class="facebook">
                    <a href="' . esc_url($facebook_profile) . '" target="_blank"> <i class="fab fa-facebook-f"></i></a></li>';
                }
                ?>
            </ul>
        </div>
    <?php
    }
}

/*
* Show post Share
*/
if ( !function_exists('vw_podcast_pro_social_share') ) {
    /**
     * [vw_podcast_pro_social_share show all the social share buttons
     * @return [type] string
     */
    function vw_podcast_pro_social_share(){
        ?>
        <?php do_action('vw_podcast_pro_before_blog_sharing'); ?>
            <div class="share_icon row p-0 m-0">
                <p class="socila_share col-md-12 p-0">
                    <?php if(get_theme_mod('vw_podcast_pro_post_general_settings_post_share_facebook',true)==1 || get_theme_mod('vw_podcast_pro_post_general_settings_post_share_linkedin',true)==1 || get_theme_mod('vw_podcast_pro_post_general_settings_post_share_twitter',true)==1){ ?>

                    <b><?php echo esc_html('Share: ','vw-podcast-pro'); ?></b>

                    <?php }

                    if ( get_theme_mod('vw_podcast_pro_post_general_settings_post_share_facebook',true) == "1" ) { ?>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_permalink(); ?>" target="_blank"><i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php echo esc_html('facebook.com', 'vw-podcast-pro' ) ; ?></span></a>
                    <?php }

                    if ( get_theme_mod('vw_podcast_pro_post_general_settings_post_share_linkedin',true) == "1" ) { ?>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php the_title(); ?>" target="_blank"><i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php echo esc_html('linkedin.com', 'vw-podcast-pro' ) ; ?></span></a>
                    <?php }

                    if ( get_theme_mod('vw_podcast_pro_post_general_settings_post_share_twitter',true) == "1" ) { ?>
                        <a href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo the_title(); ?>" target="_blank"><i class="fab fa-x-twitter"></i><span class="screen-reader-text"><?php echo esc_html('twitter.com', 'vw-podcast-pro' ) ; ?></span></a>
                    <?php } ?>
                    <?php if ( get_theme_mod('vw_podcast_pro_post_general_settings_post_share_youtube',true) == "1" ) { ?>
                        <a href="https://youtube.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo the_title(); ?>" target="_blank"><i class="fa fa-youtube-play"></i><span class="screen-reader-text"><?php echo esc_html('twitter.com', 'vw-podcast-pro' ) ; ?></span></a>
                    <?php } ?>
                    <?php if ( get_theme_mod('vw_podcast_pro_post_general_settings_post_share_instagram',true) == "1" ) { ?>
                        <a href="https://instagram.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo the_title(); ?>" target="_blank"><i class="fab fa-instagram"></i><span class="screen-reader-text"><?php echo esc_html('twitter.com', 'vw-podcast-pro' ) ; ?></span></a>
                    <?php } ?>
                </p>
            </div>
        <?php
    }
}

 /* Breadcrumb Begin */
 function vw_podcast_pro_shop_breadcrumbs() {
 	if (!is_home()) {
 		  echo '<a href="';
 	      	echo esc_url(home_url());
 	    	echo '">';
 	      	echo ' Home > Shop';
 	   	 	echo "</a> ";
 		}
 }
 function vw_podcast_pro_listing_breadcrumbs() {
 	if (!is_home()) {
 		  echo '<a href="';
 	      	echo esc_url(home_url());
 	    	echo '">';
 	      	echo ' Home > Car Models';
 	   	 	echo "</a> ";
 		}
 }

 function vw_podcast_pro_the_breadcrumb() {
    if (!is_home()) {
        echo '<a href="' . esc_url(home_url()) . '">Home</a>';
        
        if (is_category() || is_single()) {
            $categories = get_the_category();
            if (!empty($categories)) {
                $category = $categories[0]; // Get the first category
                echo ' / <a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
            }

            if (is_single()) {
                echo ' / <span>';
                the_title();
                echo '</span>';
            }
        } elseif (is_page()) {
            echo ' / <span>';
            the_title();
            echo '</span>';
        }
    }
}


function vw_podcast_pro_string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

// Recent post widget with thumbnails
// include vw_podcast_pro_EXT_DIR.'../../../wp-includes/default-widgets.php';
Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
    function widget($args, $instance) {
            if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'vw-podcast-pro' );
        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        /**
         * Filter the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );
        if ($r->have_posts()) :
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ( $title ) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        } ?>
        <ul>
          <?php while ( $r->have_posts() ) : $r->the_post(); ?>
              <li>
                <div class="recent-post-box">
                  <div class="media post-thumb">
                    <div class="media-body post-content">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                   <div class="the-author">
                   <?php if ( $show_date ) : ?>
                         <p class="post-date"><?php echo get_the_date();?></p>
                     <?php endif; ?>
                     
                         <p class="post-date">Admin: <?php the_author();?></p>

                   </div>
                    </div>
                  </div>
                </div>
              </li>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </ul>

        <?php echo $args['after_widget'];

        endif;
    }
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');
