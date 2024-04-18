<div class="recent-posts my-5">
    <div class="container">
        <?php if (get_theme_mod('vw_podcast_pro_single_blog_heading_tag') != false && get_theme_mod('vw_podcast_pro_blog_heading') != false) { ?>
            <div class="heading text-center">
                <div class="h2">
                    <h2>
                        <?php echo get_theme_mod('vw_podcast_pro_single_blog_heading_tag'); ?>
                    </h2>
                </div>
                <p class="heading-description">
                    <?php echo get_theme_mod('vw_podcast_pro_single_blog_heading'); ?>
                    </h2>
            </div>
        <?php } ?>

        <div class="related-posts my-5">
            <div class="slick-slider">
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
                        <div class="slide">
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
</div>