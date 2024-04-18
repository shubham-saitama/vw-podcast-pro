<?php
/**
 * Template to show the content of blog
 *
 * @package vw_podcast_pro
 */
$about_section = get_theme_mod('vw_podcast_pro_blog_image_enable');
if ('Disable' == $about_section) {
  return;
}
if (get_theme_mod('vw_podcast_pro_blog_image_bgcolor', '')) {
  $about_backg = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_blog_image_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_blog_image_bgimage', '')) {
  $about_backg = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_blog_image_bgimage')) . '\')';
} else {
  $about_backg = '';
}
?>

<section id="blog-news" class="section-space" style="<?php echo esc_attr($about_backg); ?>">
  <div class="container">
    <div class="row">
      <?php if (get_theme_mod('vw_podcast_pro_blog_heading') != false) { ?>
        <div class="h2">
          <h2>
            <?php echo get_theme_mod('vw_podcast_pro_blog_heading'); ?>
          </h2>
        </div>
        <p class="heading-description">
          <?php echo get_theme_mod('vw_podcast_pro_blog_heading_text'); ?>
        </p>
      <?php } ?>
      <div class="owl-carousel mt-5">
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
                <div class="info-bar">
                  <a href="#"><i class="<?php echo get_theme_mod('vw_podcast_pro_blog_icons'); ?>"></i>
                    <?php echo get_the_date('j, F Y'); ?>
                  </a>
                  <p>
                    <i class="<?php echo get_theme_mod('vw_podcast_pro_blog_icons2'); ?>"></i>
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
          wp_reset_postdata();
        else:
          echo "No posts found.";
        endif;
        ?>

      </div>
    </div>
  </div>
</section>