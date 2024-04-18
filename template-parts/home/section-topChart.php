<?php

$section_hide = get_theme_mod('vw_podcast_pro_recomended_song_desc_image_enable');
$single_page_title = get_theme_mod('vw_podcast_pro_top_chart_section_show_all_btn');
if ('Disable' == $section_hide) {
    return;
}
?>

<section class="top-chart section-space">
    <div class="">
        <div class="row">
            <div class="section-heading">
                <h3>Top Charts</h3>
                <div class="show-all">
                    <a href="<?php echo get_permalink(get_page_by_title($single_page_title)); ?>"><?php echo get_theme_mod('vw_podcast_pro_top_chart_section_show_all_text'); ?></a>
                </div>
            </div>
        </div>
        <div class="song-row">

            <?php
            // Define WP_Query arguments
            $args = array(
                'post_type' => 'top_chart', // Custom post type name
                'posts_per_page' => 6, // Retrieve all posts
                "order" => 'asc'
            );

            // Instantiate WP_Query
            $top_chart_query = new WP_Query($args);
            ?>
            <?php  // Check if there are any posts
            if ($top_chart_query->have_posts()) {
                // Start the loop
                while ($top_chart_query->have_posts()) {
                    $top_chart_query->the_post();
                    // Get post title
                    $post_title = get_the_title();

                    // Get custom meta fields
                    $category = get_post_meta(get_the_ID(), 'category', true);
                    $language = get_post_meta(get_the_ID(), 'top_charts_language', true);
                    $song_count = get_post_meta(get_the_ID(), 'top_charts_song_count', true);
                    $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                    $term_description = get_the_content(get_the_ID());

                    ?>
                    <div class="player">
                        <div class="song-thumbnail" style="background-image:url()">
                            <img src="<?php echo $featured_image_url; ?>" alt="Artist Image" title="Radio Image">
                        </div>
                        <div class="song-info-wrap">
                            <div class="song-title text-center">
                                <a href="<?php echo get_permalink(); ?>" class="mb-1">
                                    <?php echo $post_title; ?>
                                </a>
                                <div class="song-description text-center">
                                    <p>
                                        <?php echo $term_description; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                // Restore original post data
                wp_reset_postdata();
            } else {
                // If no posts found
                echo 'No posts found';
            } ?>

            <?php // }  ?>
        </div>
    </div>
</section>