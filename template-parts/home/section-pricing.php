<?php
/**
 * Template part for displaying Pricing section
 *
 * @package vw-logistics-pricing_sec
 */

$section_hide = get_theme_mod('vw_podcast_pro_pricing_text_image_enable');
if ('Disable' == $section_hide) {
    return;
}
if (get_theme_mod('vw_podcast_pro_pricing_text_image_bgcolor', '')) {
    $pricing_sec_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_pricing_text_image_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_pricing_text_image_bgimage', '')) {
    $pricing_sec_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_pricing_text_image_bgimage')) . '\')';
} else {
    $pricing_sec_back = '';
}

$form_shortcode = get_theme_mod('vw_podcast_pro_pricing_from_shortcode');
// $img_bg = get_theme_mod('vw_podcast_pro_pricing_sec_bgimage_setting');
?>
