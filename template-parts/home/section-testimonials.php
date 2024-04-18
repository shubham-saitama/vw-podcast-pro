<?php
/**
 * Template part for displaying Testimonials
 *
 * @package vw_podcast_pro
 */
$section_hide = get_theme_mod('vw_podcast_pro_testimonial_text_image_enable');
if ('Disable' == $section_hide) {
    return;
}
if (get_theme_mod('vw_podcast_pro_testimonial_text_image_bgcolor', '')) {
    $per_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_testimonial_text_image_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_testimonial_text_image_bgimage', '')) {
    $per_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_testimonial_text_image_bgimage')) . '\')';
} else {
    $per_back = '';
}

?>