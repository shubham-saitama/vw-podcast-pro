<?php
  $content_type = get_theme_mod( 'vw_podcast_pro_post_content_blog','Excerpt Content');
  $excerpt_length="";
  if($content_type == "Excerpt Content"){
    $excerpt_length=get_theme_mod( 'vw_podcast_pro_excerpt_length',15);
  }
  $theme_lay = get_theme_mod( 'vw_podcast_pro_plugin_single_blog_option','two_col');

  if($theme_lay == 'one_col'){
    $col_class = 'col-md-12 col-sm-12';
  }else if($theme_lay == 'two_col'){
    $col_class = 'col-lg-4 col-md-6 col-sm-6 ';
  }else{
    $col_class = 'col-lg-4 col-md-6 col-sm-6 ';
  }
?>
<div class="<?php echo esc_attr($col_class); ?> mb-4">
  <div class="newsinner">
      <div class="post-img position-relative  px-0">
        <?php if (has_post_thumbnail()) { ?>
          <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title() ?>">
        <?php } ?>
      </div>
        <div class="post-content latest-bg latest-bg">
              <div class="latest-new-content position-relative">
                <div class="vw-news-meta">
                  <?php if ( get_theme_mod('vw_podcast_pro_post_general_settings_post_author',true) == "1" ) { ?>
                    <span class="vw-blog-author">
                      <i class="fa-solid fa-user"></i>
                      <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
                    </span>
                  <?php }?>
                  <?php if ( get_theme_mod('vw_podcast_pro_post_general_settings_post_comments',true) == "1" ) { ?>
                    <span class="vw-blog-comments ms-2">
                      <i class="fas fa-comments"></i>
                      <?php comments_number( '2 Comment', 'Comment 1', 'Comments % ' ); ?>
                    </span>
                  <?php } ?>
                </div>
                  <h4 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                  <div class="latest-news-text mb-2">
                    <?php
                          $excerpt = get_the_excerpt();
                          echo esc_html(vw_podcast_pro_string_limit_words($excerpt,('19')));
                      ?>
                  </div>
              </div>
        </div>
    </div>
</div>
