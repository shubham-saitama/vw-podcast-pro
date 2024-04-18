<?php
/**
 * Template part for displaying Banner
 *
 * @package vw-podcast-pro
 */

$section_hide = get_theme_mod('vw_podcast_pro_category_sec_image_enable');
if ('Disable' == $section_hide) {
    return;
}
$category_enable = get_theme_mod('vw_podcast_pro_category_sec_image_enable');

if (get_theme_mod('vw_podcast_pro_our_banners_bgcolor', '')) {
    $banner_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_our_banners_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_our_banners_bgimage', '')) {
    $banner_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_our_banners_bgimage')) . '\')';
} else {
    $banner_back = '';
}
// Requires the media library that unlocks the function
require_once ABSPATH . 'wp-admin/includes/media.php';

?>


<section id="main-banner" style="<?php echo esc_attr($banner_back); ?>" class=" section-space">
    <div class="">
   
       <?php  // Get all terms of the "songs categories" custom taxonomy
        $terms = get_terms(
            array(
                'taxonomy' => 'song_categories', // Change 'song_categories' to your actual taxonomy name
                'hide_empty' => false, // Set to true if you want to exclude empty terms
            )
        );
        ?>
        
        <div class="categories-wrapper">
            <?php
            // Loop through each term
            foreach ($terms as $term) {
                // Get term name
                $term_name = $term->name;

                // Get term image (if stored as term meta)
                $term_id = $term->term_id;
                $image = get_term_meta($term_id, 'term_image', true); // Change 'full' to your desired image size
            
                // Get term link
                $term_link = get_term_link($term);

                // Output term name, image, and link
                echo '<div class="category-wrap">';
                if ($image) {
                    echo '<img src="' . $image . '" alt="' . $image . '" title="category image" loading="lazy" width="151" height="150">';
                }
                echo '<a href="' . $term_link . '">' . $term_name . ' </a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>
