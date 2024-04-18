<?php  // Get all terms of the "songs categories" custom taxonomy
$section_hide = get_theme_mod('vw_podcast_pro_top_artists_section_heading_image_enable');
if ("Disable" == $section_hide) {
    return;
}
$terms = get_terms(
    array(
        'taxonomy' => 'artists', // Change 'song_categories' to your actual taxonomy name
        'hide_empty' => false, // Set to true if you want to exclude empty terms
    )
); 
$single_page_title = get_theme_mod('vw_podcast_pro_artist_show_all_btn');

?>

<section class="category-artist artist-cat-home section-space">
    <div class="">
        <div class="row">
            <div class="section-heading">
                <h3>Top Searched Artists</h3>
                <div class="show-all">
                    <a href="<?php echo $single_page_title; ?>"><?php echo get_theme_mod('vw_podcast_pro_artist_show_all_text'); ?></a>
                </div>
            </div>
            <?php  // Get all terms of the "songs categories" custom taxonomy
            $terms = get_terms(
                array(
                    'taxonomy' => 'artists', // Change 'song_categories' to your actual taxonomy name
                    'hide_empty' => false, // Set to true if you want to exclude empty terms
                )
            ); ?>
            <div class="song-row">
                <?php
                $i = 1;
                // Loop through each term
                foreach ($terms as $term) {
                    if ($i > 6) {
                        continue;
                    }
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
                            <img src="<?php echo $thumbnail; ?>" alt="Artist Image" title="Artist Image">
                        </div>
                        <div class="song-info-wrap">
                            <div class="song-title text-center">
                                <a href="<?php echo $term_link; ?>">
                                    <?php echo $term_name; ?>
                                </a>
                            </div>
                            <div class="song-description text-center">
                                <?php echo $term_description; ?>
                            </div>
                        </div>
                    </div>
                    <?php $i++;
                } ?>
            </div>
        </div>
    </div>
</section>