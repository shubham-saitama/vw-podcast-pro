<?php
/**
 * The template for displaying the footer.
 *
 * @package vw-podcast-pro
 */

$about_section = get_theme_mod('vw_podcast_pro_footer_enable');
if ('Disable' == $about_section) {
	return;
}
if (get_theme_mod('vw_podcast_pro_footer_bgcolor')) {
	$section_backg = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_footer_bgcolor')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_footer_bg_image')) {
	$section_backg = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_footer_bg_image')) . '\')';
} else {
	$section_backg = '';
}
?>
<div class="clearfix"></div>
<footer class="outer-footer mt-5" style="<?php echo $section_backg ?>">
	<?php get_template_part('template-parts/footer/custom-footer'); ?>
	<?php get_template_part('template-parts/footer/footer-columns'); ?>
	<?php get_template_part('template-parts/footer/footer-contact'); ?>
	<?php get_template_part('template-parts/footer/copyright'); ?>
</footer>

<?php wp_footer(); ?>
</body>

</html>