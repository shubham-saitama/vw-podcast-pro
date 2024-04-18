<?php

require get_template_directory() . '/theme-wizard/tgm/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function vw_podcast_pro_register_recommended_plugins()
{
	$plugins = array(
		array(
			'name' => __('Paid Memberships Pro – Content Restriction, User Registration, & Paid Subscriptions', 'vw-podcast-pro'),
			'slug' => 'paid-memberships-pro',
			'source' => '',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('Contact Form 7', 'vw-podcast-pro'),
			'slug' => 'contact-form-7',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('VW Wordpress Theme Waveplayer', 'vw-podcast-pro'),
			'slug' => 'vw-wordpress-theme-waveplayer	',
			'source' =>  get_template_directory() . '/inc/plugins/vw-wordpress-theme-waveplayer.zip',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('Font Awesome', 'vw-podcast-pro'),
			'slug' => 'font-awesome',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('Contact Form 7', 'vw-podcast-pro'),
			'slug' => 'contact-form-7',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('WooCommerce', 'vw-podcast-pro'),
			'slug' => 'woocommerce',
			'source' => '',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('Classic Widgets', 'vw-podcast-pro'),
			'slug' => 'classic-widgets',
			'source' => '',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('Ibtana - WordPress Website Builder', 'vw-podcast-pro'),
			'slug' => 'ibtana-visual-editor',
			'source' => '',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('Ibtana - Ecommerce Product Addons', 'vw-podcast-pro'),
			'slug' => 'ibtana-ecommerce-product-addons',
			'source' => '',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('YITH WooCommerce Subscription', 'vw-podcast-pro'),
			'slug' => 'yith-woocommerce-subscription',
			'source' => '',
			'required' => true,
			'force_activation' => false,
		),
		array(
			'name' => __('Menu Image, Icons made easy', 'vw-podcast-pro'),
			'slug' => 'menu-image',
			'source' => '',
			'required' => true,
			'force_activation' => false,
		),
	);
	$vw_podcast_pro_config = array();
	tgmpa($plugins, $vw_podcast_pro_config);
}
add_action('tgmpa_register', 'vw_podcast_pro_register_recommended_plugins');




