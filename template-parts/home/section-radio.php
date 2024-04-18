<?php

$section_hide = get_theme_mod('vw_podcast_pro_radio_song_desc_image_enable');
if ('Disable' == $section_hide) {
    return;
}


$single_page_title = get_theme_mod('vw_podcast_pro_radio_show_all_btn');
// Get all terms of the "songs categories" custom taxonomy
$terms = get_terms(
    array(
        'taxonomy' => 'radios', // Change 'song_categories' to your actual taxonomy name
        'hide_empty' => false, // Set to true if you want to exclude empty terms
    )
); ?>
<section class="category-radio category-artist section-space">
    <div class="">
        <div class="row">

            <div class="section-heading">
                <h3>Radio Station</h3>
                <div class="show-all">
                    <a href="<?php echo get_permalink(get_page_by_title($single_page_title)); ?>"><?php echo get_theme_mod('vw_podcast_pro_radio_show_all_text'); ?></a>
                </div>
            </div>
            <?php  // Get all terms of the "songs categories" custom taxonomy
            $terms = get_terms(
                array(
                    'taxonomy' => 'radios', // Change 'song_categories' to your actual taxonomy name
                    'hide_empty' => false, // Set to true if you want to exclude empty terms
                )
            ); ?>
            <div class="song-row">
                <?php
                // Loop through each term
                foreach ($terms as $term) {
                    // Get term name
                    $term_name = $term->name;

                    // Get term image (if stored as term meta)
                    $term_id = $term->term_id;
                    $thumbnail = get_term_meta($term_id, 'category_custom_image_url', true); // Change 'full' to your desired image size
                    $term_description = term_description($term_id);
                    // Get term link
                    $term_link = get_term_link($term);
                    ?>
                    <div class="player">
                        <div class="song-thumbnail" style="background-image:url()">
                            <img src="<?php echo $thumbnail; ?>" alt="Artist Image" title="Radio Image">
                        </div>
                        <div class="song-info-wrap">
                            <div class="song-title text-center">
                                <a href="<?php echo $term_link; ?>">
                                    <?php echo $term_name; ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </div>
</section>