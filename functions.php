<?php
/**
 * vw-podcast-pro functions and definitions
 *
 * @package vw-podcast-pro
 */

if (!function_exists('vw_podcast_pro_setup')):
	// echo "<pre>";
// echo print_r($terms_content);
// echo "</pre>";
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function vw_podcast_pro_setup()
	{
		$GLOBALS['content_width'] = apply_filters('vw_podcast_pro_content_width', 640);
		if (!isset($content_width))
			$content_width = 640;
		load_theme_textdomain('vw-podcast-pro', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('woocommerce');
		add_theme_support('custom-header');
		add_theme_support('title-tag');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');
		add_theme_support('wc-template-functions');

		add_theme_support(
			'custom-logo',
			array(
				'height' => 240,
				'width' => 240,
				'flex-height' => true,
			)
		);
		add_image_size('vw-podcast-pro-homepage-thumb', 240, 145, true);
		register_nav_menus(
			array(
				'primary' => __('Primary Menu', 'vw-podcast-pro'),
				'footer1' => __('Footer Menu1', 'vw-podcast-pro'),
				'footer2' => __('Footer Menu2', 'vw-podcast-pro'),
			)
		);
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'f1f1f1'
			)
		);
		add_editor_style(array('assets/css/editor-style.css'));
	}
endif;
add_action('after_setup_theme', 'vw_podcast_pro_setup');

/* Theme Widgets Setup */
function vw_podcast_pro_widgets_init()
{
	register_sidebar(
		array(
			'name' => __('Blog Sidebar', 'vw-podcast-pro'),
			'description' => __('Appears on blog page sidebar', 'vw-podcast-pro'),
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Main Page Sidebar', 'vw-podcast-pro'),
			'description' => __('Appears on page sidebar', 'vw-podcast-pro'),
			'id' => 'main-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Footer Column 1', 'vw-podcast-pro'),
			'description' => __('Appears on footer', 'vw-podcast-pro'),
			'id' => 'footer-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Footer Column 2', 'vw-podcast-pro'),
			'description' => __('Appears on footer', 'vw-podcast-pro'),
			'id' => 'footer-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Footer Column 3', 'vw-podcast-pro'),
			'description' => __('Appears on footer', 'vw-podcast-pro'),
			'id' => 'footer-3',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Footer Column 4', 'vw-podcast-pro'),
			'description' => __('Appears on footer', 'vw-podcast-pro'),
			'id' => 'footer-4',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name' => __('Single Blog Widget', 'your-theme-text-domain'),
			'id' => 'single-blog-widget',
			'description' => __('Add widgets for the single blog page here.', 'your-theme-text-domain'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);




}
add_action('widgets_init', 'vw_podcast_pro_widgets_init');


/* Theme Font URL */
function vw_podcast_pro_font_url()
{
	$font_url = '';
	$font_family = array();
	$font_family[] = 'PT Sans:300,400,600,700,800,900';
	$font_family[] = 'Roboto:400,700';
	$font_family[] = 'Roboto Condensed:400,700';
	$font_family[] = 'Open Sans';
	$font_family[] = 'Overpass';
	$font_family[] = 'Montserrat:300,400,600,700,800,900';
	$font_family[] = 'Playball:300,400,600,700,800,900';
	$font_family[] = 'Alegreya:300,400,600,700,800,900';
	$font_family[] = 'Julius Sans One';
	$font_family[] = 'Arsenal';
	$font_family[] = 'Slabo';
	$font_family[] = 'Lato';
	$font_family[] = 'Overpass Mono';
	$font_family[] = 'Source Sans Pro';
	$font_family[] = 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Merriweather';
	$font_family[] = 'Rubik';
	$font_family[] = 'Lora';
	$font_family[] = 'Ubuntu';
	$font_family[] = 'Cabin';
	$font_family[] = 'Arimo';
	$font_family[] = 'Playfair Display';
	$font_family[] = 'Quicksand';
	$font_family[] = 'Padauk';
	$font_family[] = 'Muli';
	$font_family[] = 'Inconsolata';
	$font_family[] = 'Bitter';
	$font_family[] = 'Pacifico';
	$font_family[] = 'Indie Flower';
	$font_family[] = 'VT323';
	$font_family[] = 'Dosis';
	$font_family[] = 'Frank Ruhl Libre';
	$font_family[] = 'Fjalla One';
	$font_family[] = 'Oxygen';
	$font_family[] = 'Arvo';
	$font_family[] = 'Noto Serif';
	$font_family[] = 'Lobster';
	$font_family[] = 'Crimson Text';
	$font_family[] = 'Yanone Kaffeesatz';
	$font_family[] = 'Anton';
	$font_family[] = 'Libre Baskerville';
	$font_family[] = 'Bree Serif';
	$font_family[] = 'Gloria Hallelujah';
	$font_family[] = 'Josefin Sans';
	$font_family[] = 'Abril Fatface';
	$font_family[] = 'Varela Round';
	$font_family[] = 'Vampiro One';
	$font_family[] = 'Shadows Into Light';
	$font_family[] = 'Cuprum';
	$font_family[] = 'Rokkitt';
	$font_family[] = 'Vollkorn';
	$font_family[] = 'Francois One';
	$font_family[] = 'Orbitron';
	$font_family[] = 'Patua One';
	$font_family[] = 'Acme';
	$font_family[] = 'Satisfy';
	$font_family[] = 'Josefin Slab';
	$font_family[] = 'Quattrocento Sans';
	$font_family[] = 'Architects Daughter';
	$font_family[] = 'Russo One';
	$font_family[] = 'Monda';
	$font_family[] = 'Righteous';
	$font_family[] = 'Lobster Two';
	$font_family[] = 'Hammersmith One';
	$font_family[] = 'Courgette';
	$font_family[] = 'Permanent Marker';
	$font_family[] = 'Cherry Swash';
	$font_family[] = 'Cormorant Garamond';
	$font_family[] = 'Poiret One';
	$font_family[] = 'BenchNine';
	$font_family[] = 'Economica';
	$font_family[] = 'Handlee';
	$font_family[] = 'Cardo';
	$font_family[] = 'Alfa Slab One';
	$font_family[] = 'Averia Serif Libre';
	$font_family[] = 'Cookie';
	$font_family[] = 'Chewy';
	$font_family[] = 'Great Vibes';
	$font_family[] = 'Coming Soon';
	$font_family[] = 'Philosopher';
	$font_family[] = 'Days One';
	$font_family[] = 'Kanit';
	$font_family[] = 'Shrikhand';
	$font_family[] = 'Tangerine';
	$font_family[] = 'IM Fell English SC';
	$font_family[] = 'Boogaloo';
	$font_family[] = 'Bangers';
	$font_family[] = 'Fredoka One';
	$font_family[] = 'Bad Script';
	$font_family[] = 'Volkhov';
	$font_family[] = 'Shadows Into Light Two';
	$font_family[] = 'Marck Script';
	$font_family[] = 'Sacramento';
	$font_family[] = 'Poppins';
	$font_family[] = 'PT Serif';
	$font_family[] = 'Work Sans';
	$query_args = array(
		'family' => urlencode(implode('|', $font_family)),
	);
	$font_url = add_query_arg($query_args, '//fonts.googleapis.com/css');
	return $font_url;
}

// custom thumbnail size 
add_image_size('custom-thumbnail', 240, 240, true);



/* Theme enqueue scripts */
function vw_podcast_pro_scripts()
{
	$custom_css = "";
	wp_enqueue_style('vw-podcast-pro-font', vw_podcast_pro_font_url(), array());
	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style('vw-podcast-pro-basic-style', get_stylesheet_uri());
	wp_style_add_data('vw-podcast-pro-style', 'rtl', 'replace');


	if (is_rtl()) {
		wp_enqueue_style('rtl-style', get_template_directory_uri() . '/rtl-style.css', true, null, 'all');
		wp_add_inline_style('rtl-style', $custom_css);
		wp_enqueue_script('vw-podcast-pro-customscripts-rtl', get_template_directory_uri() . '/assets/js/custom-rtl.js', array('jquery'), '', true);
	} else {
		// ---------- CSS Enqueue -----------


		wp_enqueue_style('other-page-style', get_template_directory_uri() . '/assets/css/main-css/other-pages.css', true, null, 'all');
		wp_add_inline_style('other-page-style', $custom_css);
		wp_enqueue_style('home-page-style', get_template_directory_uri() . '/assets/css/main-css/home-page.css', true, null, 'all');
		wp_add_inline_style('home-page-style', $custom_css);
		if ('post' == get_post_type() && is_home()) {
			wp_enqueue_style('other-page-style', get_template_directory_uri() . '/assets/css/main-css/other-pages.css', true, null, 'all');
			wp_add_inline_style('other-page-style', $custom_css);

		}
		wp_enqueue_style('header-footer-style', get_template_directory_uri() . '/assets/css/main-css/header-footer.css', true, null, 'all');
		// wp_enqueue_style('vw-podcast-pro', get_template_directory_uri() . '/assets/css/vw-podcast-pro.css', true, null, 'all');

		/* Inline style sheet */
		require get_parent_theme_file_path('/inline_style.php');
		wp_add_inline_style('vw-podcast-pro-basic-style', $custom_css);
		wp_enqueue_style('responsive-style', get_template_directory_uri() . '/assets/css/main-css/mobile-main.css', true, null, 'screen and (max-width: 3000px) and (min-width: 320px)');

		wp_add_inline_style('header-footer-style', $custom_css);
		wp_add_inline_style('responsive-media-style', $custom_css);
	}

	wp_enqueue_style('slick-css', get_template_directory_uri() . '/assets/css/slick.css', true);
	wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/assets/css/slick-theme.css', true);
	if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
		wp_enqueue_style('amp-style', get_template_directory_uri() . '/assets/css/main-css/amp-style.css', true, null, 'all');
	} else {
		wp_enqueue_style('animation-wow', get_template_directory_uri() . '/assets/css/animate.css');
		wp_enqueue_style('owl-carousel-style', get_template_directory_uri() . '/assets/css/owl.carousel.css');
	}
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/inc/customize/controls/social-icons/css/all.min.css');
	wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
	wp_enqueue_style('effect', get_template_directory_uri() . '/assets/css/effect.css');
	wp_enqueue_style('jquery-ui.min.css', get_template_directory_uri() . '/assets/css/jquery-ui.min.css');
	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), true);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', true);
	wp_enqueue_script('waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js', array('jquery'), '', true);
	wp_enqueue_script('counterJs', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '', true);
	// wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/html5lightbox.js', array('jquery'), '', true);
	wp_enqueue_script('bootstrap-notify-js', get_template_directory_uri() . '/assets/js/bootstrap-notify.min.js', array('bootstrap'));
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true);
	wp_enqueue_script('slick-carousel', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '', true);

	wp_enqueue_script('jquery-ui-slider');


	global $wpdb;
	$product_price_max_query = "SELECT MAX( CAST( $wpdb->postmeta.meta_value AS SIGNED ) ) AS product_max_price FROM $wpdb->postmeta WHERE meta_key='%s'";
	$product_meta_price_max = $wpdb->get_row($wpdb->prepare($product_price_max_query, '_price'));

	$listing_price_max_query = "SELECT MAX( CAST( $wpdb->postmeta.meta_value AS SIGNED ) ) AS listing_max_price FROM $wpdb->postmeta WHERE meta_key='%s'";
	$listing_meta_price_max = $wpdb->get_row($wpdb->prepare($listing_price_max_query, '_al_listing_price'));

	$auto_listings_options = get_option('auto_listings_options');
	$currency_symbol = '$';
	if ($auto_listings_options) {
		$currency_symbol = isset($auto_listings_options['currency_symbol']) ? $auto_listings_options['currency_symbol'] : '$';
	}



	wp_register_script('vw-podcast-pro-customscripts', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'));

	// // $vw_podcast_pro_customscripts_obj = array(
	// // 	'is_home' =>  ( is_home() || is_front_page() ),
	// // 	'home_url' =>  home_url(),
	// // 	'is_rtl' => is_rtl(),
	// // 	'product_max_price'  =>  $product_meta_price_max->product_max_price,
	// // 	'listing_max_price'  => $listing_meta_price_max->listing_max_price,
	// // 	'listing_currency_symbol' => $currency_symbol,	// $vw_podcast_pro_customscripts_obj = array(
	// // 	'is_home' =>  ( is_home() || is_front_page() ),
	// // 	'home_url' =>  home_url(),
	// // 	'is_rtl' => is_rtl(),
	// // 	'product_max_price'  =>  $product_meta_price_max->product_max_price,
	// // 	'listing_max_price'  => $listing_meta_price_max->listing_max_price,
	// // 	'listing_currency_symbol' => $currency_symbol,
	// // 	'get_woocommerce_currency_symbol' => get_woocommerce_currency_symbol(),
	// // 	'ajaxurl'				=>	admin_url('admin-ajax.php')
	// // );

	// // wp_localize_script('vw-podcast-pro-customscripts', 'vw_podcast_pro_customscripts_obj' ,$vw_podcast_pro_customscripts_obj);

	// wp_enqueue_script('vw-podcast-pro-customscripts');
	// // 	'get_woocommerce_currency_symbol' => get_woocommerce_currency_symbol(),
	// // 	'ajaxurl'				=>	admin_url('admin-ajax.php')
	// // );

	// // wp_localize_script('vw-podcast-pro-customscripts', 'vw_podcast_pro_customscripts_obj' ,$vw_podcast_pro_customscripts_obj);

	wp_enqueue_script('vw-podcast-pro-customscripts');

	wp_enqueue_script('vw-podcast-pro-customscripts', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '', true);
	wp_enqueue_script('animation-wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	wp_enqueue_style('vw-podcast-pro-ie', get_template_directory_uri() . '/assets/css/ie.css', array('vw-podcast-pro-basic-style'));
	wp_style_add_data('vw-podcast-pro-ie', 'conditional', 'IE');
}
add_action('wp_enqueue_scripts', 'vw_podcast_pro_scripts');

/* Implement the Custom Header feature. */
require get_parent_theme_file_path('/inc/custom-header.php');
/* Custom template tags for this theme. */
require get_parent_theme_file_path('/inc/template-tags.php');
/* Customizer additions. */
require get_parent_theme_file_path('/inc/customize/customizer.php');
/* wc-templatefunction */
// require get_parent_theme_file_path( 'inc/wc-template-functions.php' );
// require 'inc/wc-template-functions.php';
//about us
require get_template_directory() . '/inc/widget/about-us-widget.php';
// Contact-Widgets
require get_parent_theme_file_path('inc/widget/contact-widget.php');
// social-widgets
require get_parent_theme_file_path('inc/widget/socail-widget.php');





/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path('inc/custom-functions.php');

require get_template_directory() . '/inc/verify_theme_version.php';
/* Theme Wizard */
require get_template_directory() . '/theme-wizard/config.php';
require get_parent_theme_file_path('/theme-wizard/plugin-activation.php');
// /* URL DEFINES */
// require get_parent_theme_file_path('custom-filter.php');
define('vw_podcast_pro_SITE_URL', 'https://www.vwthemes.com/');
/* Theme Credit link */
function vw_podcast_pro_credit_link()
{
	echo esc_html_e(' Design & Developed by', 'vw-podcast-pro') . "<a href=" . esc_url(vw_podcast_pro_SITE_URL) . " target='_blank'> VW Themes</a>";
}
/*Radio Button sanitization*/
function vw_podcast_pro_sanitize_choices($input, $setting)
{
	global $wp_customize;
	$control = $wp_customize->get_control($setting->id);
	if (array_key_exists($input, $control->choices)) {
		return $input;
	} else {
		return $setting->default;
	}
}



/* Excerpt Read more overwrite */
function vw_podcast_pro_excerpt_more($link)
{
	if (is_admin()) {
		return $link;
	}
	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url(get_permalink(get_the_ID())),
		/* translators: %s: Name of current post */
		sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'vw-podcast-pro'), get_the_title(get_the_ID()))
	);
	return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'vw_podcast_pro_excerpt_more');

define('vw_podcast_pro_THEME_DOC', 'https://www.vwthemesdemo.com/docs/vw-podcast-pro/');
define('vw_podcast_pro_SUPPORT', 'https://www.vwthemes.com/support/vw-theme/');
define('vw_podcast_pro_FAQ', 'https://www.vwthemes.com/faqs/');
define('vw_podcast_pro_CONTACT', 'https://www.vwthemes.com/contact/');
define('vw_podcast_pro_REVIEW', 'https://www.vwthemes.com/topic/reviews-and-testimonials/');

define('vw_podcast_pro_banner_link', 'https://www.vwthemes.com/premium-plugin/vw-title-banner-plugin/');
define('vw_podcast_pro_social_media_plugin', 'https://www.vwthemes.com/free-plugin/vw-social-media/');
define('vw_podcast_pro_preloader_plugin', 'https://www.vwthemes.com/free-plugin/vw-preloader/');
define('vw_podcast_pro_accordion_plugin', 'https://www.vwthemes.com/free-plugin/vw-accordion/');
define('vw_podcast_pro_gallery_link', 'https://www.vwthemes.com/premium-plugin/vw-gallery-plugin/');
define('vw_podcast_pro_footer_link', 'https://www.youtube.com/watch?v=7BvTpLh-RB8');

define('IBTANA_THEME_LICENCE_ENDPOINT', 'https://vwthemes.com/wp-json/ibtana-licence/v2/');

//-------- Bundle Notice ---------
add_action('admin_notices', 'vw_theme_bundle_admin_notice');
function vw_theme_bundle_admin_notice()
{
	?>
	<div class="notice bundle-notice is-dismissible">
		<div class="theme_box">
			<h3>
				<?php echo esc_html('Thank You For Purchasing VW Podcast Pro Theme', 'vw-podcast-pro'); ?>
			</h3>
			<p>
				<?php echo esc_html('Get our all', 'sirat-pro'); ?>
				<strong>
					<?php echo esc_html('120+ Premium Themes', 'vw-podcast-pro'); ?>
				</strong>
				<?php echo esc_html('worth $7021 With Our', 'vw-podcast-pro'); ?>
				<strong>
					<?php echo esc_html('WP Theme Bundle', 'vw-podcast-pro'); ?>
				</strong>
				<?php echo esc_html('in just $89.', 'vw-podcast-pro'); ?>
			</p>

		</div>
		<div class="bubdle_button">
			<a href="https://www.vwthemes.com/premium/all-themes/" class="button button-primary button-hero" target="_blank"
				rel="noopener">
				<?php echo esc_html('Get Bundle at $89', 'vw-podcast-pro'); ?>
			</a>
		</div>
	</div>
	<?php
}

add_action('switch_theme', 'vw_podcast_pro_deactivate');
function vw_podcast_pro_deactivate()
{
	ThemeWhizzie::remove_the_theme_key();
	ThemeWhizzie::set_the_validation_status('false');
}

define('CUSTOM_TEXT_DOMAIN', 'vw-podcast-pro');
add_filter('woocommerce_add_to_cart_fragments', 'vw_podcast_pro_wc_refresh_mini_cart_count');
function vw_podcast_pro_wc_refresh_mini_cart_count($fragments)
{
	ob_start();
	$items_count = WC()->cart->get_cart_contents_count();
	?>
	<span class="cart-value">
		<?php echo $items_count ? $items_count : '0'; ?>
	</span>
	<?php
	$fragments['.cart-value'] = ob_get_clean();
	return $fragments;
}

add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns()
	{
		return 3; // 3 products per row
	}
}
// Remove default WC image sizes
function remove_wc_image_sizes()
{
	remove_image_size('woocommerce_thumbnail');
	remove_image_size('woocommerce_single');
	remove_image_size('woocommerce_gallery_thumbnail');
	remove_image_size('shop_thumbnail');
}
add_action('init', 'remove_wc_image_sizes');

add_filter('woocommerce_gallery_thumbnail_size', function ($size) {
	return 'full';
});

add_action('wp_footer', 'single_added_to_cart_event');

function aw_include_script()
{

	if (!did_action('wp_enqueue_media')) {
		wp_enqueue_media();
	}

	wp_enqueue_script('awscript', get_stylesheet_directory_uri() . '/assets/js/admin_script.js', array('jquery'), null, false);
	wp_enqueue_script('uploaderjs', get_stylesheet_directory_uri() . '/assets/js/uploader.js', array(), "1.0", true);
	wp_enqueue_style('AdminCSS', get_stylesheet_directory_uri() . '/assets/css/admin_css.css');
}
add_action('admin_enqueue_scripts', 'aw_include_script');


function single_added_to_cart_event()
{
	if (isset($_POST['add-to-cart']) && isset($_POST['quantity'])) {
		// Get added to cart product ID (or variation ID) and quantity (if needed)
		$quantity = $_POST['quantity'];
		$product_id = isset($_POST['variation_id']) ? $_POST['variation_id'] : $_POST['add-to-cart'];

		// JS code goes here below
		?>
		<script>
			jQuery(function ($) {
				alert('Product added to cart');
			});
		</script>
		<?php
	}
}
// buy now button
function buy_now_submit_form()
{
	?>

	<?php
}
add_action('woocommerce_after_add_to_cart_form', 'buy_now_submit_form');

add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout($redirect_url)
{
	if (isset($_REQUEST['is_buy_now']) && $_REQUEST['is_buy_now']) {
		global $woocommerce;
		$redirect_url = wc_get_checkout_url();
	}
	return $redirect_url;
}


//additional info tab
add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
function woo_rename_tabs($tabs)
{

	$tabs['additional_information']['title'] = __('Additional Information');

	$tabs['description']['priority'] = 5; // Description first
	$tabs['reviews']['priority'] = 15; //  Reviews third
	$tabs['additional_information']['priority'] = 10;

	$tabs['additional_information']['title'] = __('Additional Information');
	$tabs['additional_information']['callback'] = 'woocommerce_additional_information_callback';

	$tabs['description']['title'] = __('Description');

	// Rename the additional information tab
	return $tabs;
}





// **************************** Our Team ****************************

// disable cart page 


// function custom_disable_cart_page() {
//     if (is_cart()) {
//         // Redirect to the checkout page when users try to access the cart.
//         wp_redirect(wc_get_checkout_url());
//         exit;
//     }
// }
// add_action('template_redirect', 'custom_disable_cart_page');



function register_single_blog_widget_sidebar()
{
	register_sidebar(
		array(
			'name' => __('Single Blog Widget', 'your-theme-text-domain'),
			'id' => 'single-blog-widget',
			'description' => __('Add widgets for the single blog page here.', 'your-theme-text-domain'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'register_single_blog_widget_sidebar');






// function to change replay form name 
add_filter('comment_form_defaults', 'my_comment_title', 20);
function my_comment_title($defaults)
{
	$defaults['title_reply'] = __('Leave A Comment', 'customizr-child');
	return $defaults;
}

// change submit button text in wordpress comment form
function wcs_change_submit_button_text($defaults)
{
	$defaults['label_submit'] = 'Leave a Comment';
	return $defaults;
}
add_filter('comment_form_defaults', 'wcs_change_submit_button_text');



/**
 * Comment Form Placeholder Author, Email, URL
 */
function placeholder_author_email_url_form_fields($fields)
{
	// Define placeholder texts
	$replace_author = __('Enter Your Name', 'yourdomain');
	$replace_email = __('Enter Your Email', 'yourdomain');
	$replace_url = __('Your Website', 'yourdomain');

	// Modify the 'author' field
	$fields['author'] = '<p class="comment-form-author">' .
		'<label for="author">' . __('Name', 'yourdomain') . '</label> ' .
		'<span class="required">*</span>' .
		'<input id="author" name="author" type="text" placeholder="' . $replace_author . '" value="" size="20" /></p>';

	// Modify the 'email' field
	$fields['email'] = '<p class="comment-form-email">' .
		'<label for="email">' . __('Email', 'yourdomain') . '</label> ' .
		'<span class="required">*</span>' .
		'<input id="email" name="email" type="email" placeholder="' . $replace_email . '" value="" size="30" /></p>';

	// Modify the 'url' field
	$fields['url'] = '<p class="comment-form-url">' .
		'<label for="url">' . __('Website', 'yourdomain') . '</label>' .
		'<input id="url" name="url" type="url" placeholder="' . $replace_url . '" value="" size="30" /></p>';

	return $fields;
}

add_filter('comment_form_default_fields', 'placeholder_author_email_url_form_fields');


/**
 * Comment Form Placeholder Comment Field
 */
function placeholder_comment_form_field($fields)
{
	$replace_comment = __('Enter Your Comment', 'yourdomain');

	$fields['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun') .
		'</label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . $replace_comment . '" aria-required="true"></textarea></p>';

	return $fields;
}
add_filter('comment_form_defaults', 'placeholder_comment_form_field');



// widget for categories and title 


// Register Custom Post Type
function custom_post_type_songs()
{

	$labels = array(
		'name' => _x('Songs', 'Post Type General Name', 'text_domain'),
		'singular_name' => _x('Song', 'Post Type Singular Name', 'text_domain'),
		'menu_name' => __('Songs', 'text_domain'),
		'name_admin_bar' => __('Song', 'text_domain'),
		'archives' => __('Song Archives', 'text_domain'),
		'attributes' => __('Song Attributes', 'text_domain'),
		'parent_item_colon' => __('Parent Song:', 'text_domain'),
		'all_items' => __('All Songs', 'text_domain'),
		'add_new_item' => __('Add New Song', 'text_domain'),
		'add_new' => __('Add New', 'text_domain'),
		'new_item' => __('New Song', 'text_domain'),
		'edit_item' => __('Edit Song', 'text_domain'),
		'update_item' => __('Update Song', 'text_domain'),
		'view_item' => __('View Song', 'text_domain'),
		'view_items' => __('View Songs', 'text_domain'),
		'search_items' => __('Search Song', 'text_domain'),
		'not_found' => __('Not found', 'text_domain'),
		'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
		'featured_image' => __('Featured Image', 'text_domain'),
		'set_featured_image' => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image' => __('Use as featured image', 'text_domain'),
		'insert_into_item' => __('Insert into song', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this song', 'text_domain'),
		'items_list' => __('Songs list', 'text_domain'),
		'items_list_navigation' => __('Songs list navigation', 'text_domain'),
		'filter_items_list' => __('Filter songs list', 'text_domain'),
	);
	$args = array(
		'label' => __('Song', 'text_domain'),
		'description' => __('Post Type Description', 'text_domain'),
		'labels' => $labels,
		'supports' => array('title', 'editor', 'thumbnail', 'categories'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type('songs', $args);

}
add_action('init', 'custom_post_type_songs', 0);


// Register Custom Taxonomy
function custom_taxonomy_song_categories()
{

	$labels = array(
		'name' => _x('Song Categories', 'Taxonomy General Name', 'text_domain'),
		'singular_name' => _x('Song Category', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name' => __('Song Category', 'text_domain'),
		'all_items' => __('All Song Categories', 'text_domain'),
		'parent_item' => __('Parent Song Category', 'text_domain'),
		'parent_item_colon' => __('Parent Song Category:', 'text_domain'),
		'new_item_name' => __('New Song Category Name', 'text_domain'),
		'add_new_item' => __('Add New Song Category', 'text_domain'),
		'edit_item' => __('Edit Song Category', 'text_domain'),
		'update_item' => __('Update Song Category', 'text_domain'),
		'view_item' => __('View Song Category', 'text_domain'),
		'separate_items_with_commas' => __('Separate Song categories with commas', 'text_domain'),
		'add_or_remove_items' => __('Add or remove Song categories', 'text_domain'),
		'choose_from_most_used' => __('Choose from the most used', 'text_domain'),
		'popular_items' => __('Popular Song Categories', 'text_domain'),
		'search_items' => __('Search Song Categories', 'text_domain'),
		'not_found' => __('Not Found', 'text_domain'),
		'no_terms' => __('No Song Categories', 'text_domain'),
		'items_list' => __('Song Categories list', 'text_domain'),
		'items_list_navigation' => __('Song Categories list navigation', 'text_domain'),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
	);
	register_taxonomy('song_categories', array('songs'), $args);

}
add_action('init', 'custom_taxonomy_song_categories', 0);


// Add custom taxonomy 'artists' to custom post type 'songs'
function custom_taxonomy_artists()
{
	$labels = array(
		'name' => _x('Artists', 'taxonomy general name', 'textdomain'),
		'singular_name' => _x('Artist', 'taxonomy singular name', 'textdomain'),
		'search_items' => __('Search Artists', 'textdomain'),
		'popular_items' => __('Popular Artists', 'textdomain'),
		'all_items' => __('All Artists', 'textdomain'),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __('Edit Artist', 'textdomain'),
		'update_item' => __('Update Artist', 'textdomain'),
		'add_new_item' => __('Add New Artist', 'textdomain'),
		'new_item_name' => __('New Artist Name', 'textdomain'),
		'separate_items_with_commas' => __('Separate artists with commas', 'textdomain'),
		'add_or_remove_items' => __('Add or remove artists', 'textdomain'),
		'choose_from_most_used' => __('Choose from the most used artists', 'textdomain'),
		'not_found' => __('No artists found.', 'textdomain'),
		'menu_name' => __('Artists', 'textdomain'),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'artist'),
	);

	register_taxonomy('artists', 'songs', $args);
}
add_action('init', 'custom_taxonomy_artists');

// Register Custom Taxonomy radio channels
function custom_taxonomy_radios()
{

	$labels = array(
		'name' => _x('Radio Channels', 'Taxonomy General Name', 'text_domain'),
		'singular_name' => _x('Radio', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name' => __('Radios', 'text_domain'),
		'all_items' => __('All Radios', 'text_domain'),
		'parent_item' => __('Parent Radio', 'text_domain'),
		'parent_item_colon' => __('Parent Radio:', 'text_domain'),
		'new_item_name' => __('New Radio Name', 'text_domain'),
		'add_new_item' => __('Add New Radio', 'text_domain'),
		'edit_item' => __('Edit Radio', 'text_domain'),
		'update_item' => __('Update Radio', 'text_domain'),
		'view_item' => __('View Radio', 'text_domain'),
		'separate_items_with_commas' => __('Separate radios with commas', 'text_domain'),
		'add_or_remove_items' => __('Add or remove radios', 'text_domain'),
		'choose_from_most_used' => __('Choose from the most used', 'text_domain'),
		'popular_items' => __('Popular Radios', 'text_domain'),
		'search_items' => __('Search Radios', 'text_domain'),
		'not_found' => __('Not Found', 'text_domain'),
		'no_terms' => __('No radios', 'text_domain'),
		'items_list' => __('Radios list', 'text_domain'),
		'items_list_navigation' => __('Radios list navigation', 'text_domain'),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
	);
	register_taxonomy('radios', array('songs'), $args);

}
add_action('init', 'custom_taxonomy_radios', 0);

// Add Custom Meta Box for MP3 File
function add_song_meta_box()
{
	add_meta_box(
		'song_mp3_meta_box',
		'Song MP3 File',
		'display_song_mp3_meta_box',
		'songs',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'add_song_meta_box');

// Display the Meta Box Content
function display_song_mp3_meta_box($post)
{
	// Retrieve current MP3 file
	$mp3_file = get_post_meta($post->ID, 'song_mp3_file', true);

	// Display input field for MP3 file
	?>
	<p>
		<label for="song_mp3_file">Select MP3 File:</label>
		<br />
		<input type="text" name="song_mp3_file" id="song_mp3_file" class="regular-text"
			value="<?php echo esc_attr($mp3_file); ?>" />
		<input type="button" class="button button-secondary" value="Select MP3" id="upload_mp3_button" />
	</p>

	<?php
}

// Save the Meta Box Data
function save_song_mp3_meta($post_id)
{
	if (isset($_POST['song_mp3_file'])) {
		update_post_meta($post_id, 'song_mp3_file', sanitize_text_field($_POST['song_mp3_file']));
	}
}
add_action('save_post', 'save_song_mp3_meta');

function add_language_meta_box()
{
	add_meta_box(
		'language_meta_box',          // Unique ID
		'Language',                   // Box title
		'render_language_meta_box',   // Content callback function
		'songs',                      // Add meta box to our custom post type
		'side',                       // Context
		'default'                     // Priority
	);
}
add_action('add_meta_boxes', 'add_language_meta_box');

function render_language_meta_box($post)
{
	// Retrieve the current value of the language meta field
	$language = get_post_meta($post->ID, 'language', true);
	// Output the HTML for the meta box
	wp_nonce_field('language_meta_box_nonce', 'language_meta_box_nonce');
	?>
	<label for="language">Language:</label>
	<input type="text" id="language" name="language" value="<?php echo esc_attr($language); ?>" />
	<?php
}

function save_language_meta($post_id)
{
	// Verify nonce
	if (!isset($_POST['language_meta_box_nonce']) || !wp_verify_nonce($_POST['language_meta_box_nonce'], 'language_meta_box_nonce')) {
		return;
	}
	// Check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	// Check permissions
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	// Save data
	if (isset($_POST['language'])) {
		update_post_meta($post_id, 'language', sanitize_text_field($_POST['language']));
	}
}
add_action('save_post', 'save_language_meta');

function song_category_add_form_fields_callback()
{
	$image_id = null;
	?>

	<div id="category_custom_image"></div>
	<input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
	<div style="margin-bottom: 20px;">
		<span>Category Image </span>
		<a href="#" class="button custom-button-upload" id="custom-button-upload">Upload image</a>
		<a href="#" class="button custom-button-remove" id="custom-button-remove" style="display: none">Remove image</a>
	</div>

	<?php

}

add_action('song_categories_add_form_fields', 'song_category_add_form_fields_callback');

add_action('create_term', 'custom_create_song_category_callback', 10, 3);

function custom_create_song_category_callback($term_id, $tt_id, $taxonomy)
{
	// add term meta data
	if ($taxonomy == 'song_categories') {
		add_term_meta(
			$term_id,
			'term_image',
			esc_url($_REQUEST['category_custom_image_url'])
		);
	}
}

function song_category_edit_form_fields_callback($term, $taxonomy)
{

	// $term_image_id = get_term_meta($term->term_id, 'term_image', true);
	// $term_image_url = wp_get_attachment_image_url($term_image_id, 'full');
	$term_id = $term->term_id;
	$image = get_term_meta($term_id, 'term_image', true);

	?>
	<style>
		tr.form-field.term-image-wrap td {
			display: flex;
			align-items: baseline;
		}
	</style>
	<tr class="form-field term-image-wrap">
		<th scope="row"><label for="image">Image</label></th>
		<td>
			<?php if ($image): ?>
				<span id="category_custom_image">
					<img src="<?php echo $image; ?>" style="width: 100%; max-width:200px;" />
				</span>
				<input type="hidden" id="category_custom_image_url" name="category_custom_image_url">

				<span>
					<a href="#" class="button custom-button-upload" id="custom-button-upload" style="display: none">Upload
						image</a>
					<a href="#" class="button custom-button-remove">Remove image</a>
				</span>
			<?php else: ?>
				<span id="category_custom_image"></span>
				<input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
				<span>
					<a href="#" class="button custom-button-upload" id="custom-button-upload">Upload image</a>
					<a href="#" class="button custom-button-remove" style="display: none">Remove image</a>
				</span>
			<?php endif; ?>
		</td>
	</tr>

	<?php
}

add_action('song_categories_edit_form_fields', 'song_category_edit_form_fields_callback', 10, 2);

function edit_song_category_callback($term_id)
{
	if (isset($_POST['category_custom_image_url'])) {
		update_term_meta(
			$term_id,
			'term_image',
			esc_url($_POST['category_custom_image_url'])
		);
	}
}
add_action('edited_song_categories', 'edit_song_category_callback');






// ******************************************code for upload image on category artist ****************************************************
// Add custom fields to the artists category form
function artist_category_add_form_fields_callback()
{
	?>
	<div class="form-field">
		<label for="category_custom_image_url">Category Image</label>
		<div id="category_custom_image"></div>
		<input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
		<div style="margin-top: 5px;">
			<a href="#" class="button custom-button-upload" id="custom-button-upload">Upload Image</a>
			<a href="#" class="button custom-button-remove" id="custom-button-remove" style="display: none;">Remove
				Image</a>
		</div>
	</div>
	<?php
}
add_action('artists_add_form_fields', 'artist_category_add_form_fields_callback');

// Save custom fields when creating the artists category
function custom_create_artist_category_callback($term_id, $tt_id, $taxonomy)
{
	if ($taxonomy == 'artists') {
		if (isset($_POST['category_custom_image_url'])) {
			add_term_meta($term_id, 'category_custom_image_url', esc_url($_POST['category_custom_image_url']));
		}
	}
}
add_action('create_term', 'custom_create_artist_category_callback', 10, 3);

// Display custom fields on the edit artists category form
function artist_category_edit_form_fields_callback($term, $taxonomy)
{
	$category_custom_image_url = get_term_meta($term->term_id, 'category_custom_image_url', true);
	?>
	<tr class="form-field">
		<th scope="row"><label for="category_custom_image_url">Category Image</label></th>
		<td>
			<div id="category_custom_image">
				<?php if (!empty($category_custom_image_url)): ?>
					<img src="<?php echo esc_url($category_custom_image_url); ?>" style="max-width: 100%;" />
				<?php endif; ?>
			</div>
			<input type="hidden" id="category_custom_image_url" name="category_custom_image_url"
				value="<?php echo esc_attr($category_custom_image_url); ?>">
			<div style="margin-top: 5px;">
				<a href="#" class="button custom-button-upload" id="custom-button-upload" <?php echo empty($category_custom_image_url) ? '' : ' style="display: none;"'; ?>>Upload Image</a>
				<a href="#" class="button custom-button-remove" <?php echo empty($category_custom_image_url) ? ' style="display: none;"' : ''; ?>>Remove Image</a>
			</div>
		</td>
	</tr>
	<?php
}
add_action('artists_edit_form_fields', 'artist_category_edit_form_fields_callback', 10, 2);

// Save custom fields when editing the artists category
function edit_artist_category_callback($term_id)
{
	if (isset($_POST['category_custom_image_url'])) {
		update_term_meta($term_id, 'category_custom_image_url', esc_url($_POST['category_custom_image_url']));
	}
}
add_action('edited_artists', 'edit_artist_category_callback');



// ******************************************end code for upload image on category artist ****************************************************


// ---------------------------------------code for upload imaege on category radio--------------------------------------------------------------
// Add custom fields to the radio category form
function radios_add_form_fields_callback()
{
	?>
	<div class="form-field">
		<label for="category_custom_image_url">Category Image</label>
		<div id="category_custom_image"></div>
		<input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
		<div style="margin-top: 5px;">
			<a href="#" class="button custom-button-upload" id="custom-button-upload">Upload Image</a>
			<a href="#" class="button custom-button-remove" id="custom-button-remove" style="display: none;">Remove
				Image</a>
		</div>
	</div>
	<?php
}
add_action('radios_add_form_fields', 'radios_add_form_fields_callback');

// Save custom fields when creating the radio category
function custom_create_radios_callback($term_id, $tt_id, $taxonomy)
{
	if ($taxonomy == 'radio') {
		if (isset($_POST['category_custom_image_url'])) {
			add_term_meta($term_id, 'category_custom_image_url', esc_url($_POST['category_custom_image_url']));
		}
	}
}
add_action('create_term', 'custom_create_radios_callback', 10, 3);

// Display custom fields on the edit radio category form
function radios_edit_form_fields_callback($term, $taxonomy)
{
	$category_custom_image_url = get_term_meta($term->term_id, 'category_custom_image_url', true);
	?>
	<tr class="form-field">
		<th scope="row"><label for="category_custom_image_url">Category Image</label></th>
		<td>
			<div id="category_custom_image">
				<?php if (!empty($category_custom_image_url)): ?>
					<img src="<?php echo esc_url($category_custom_image_url); ?>" style="max-width: 100%;" />
				<?php endif; ?>
			</div>
			<input type="hidden" id="category_custom_image_url" name="category_custom_image_url"
				value="<?php echo esc_attr($category_custom_image_url); ?>">
			<div style="margin-top: 5px;">
				<a href="#" class="button custom-button-upload" id="custom-button-upload" <?php echo empty($category_custom_image_url) ? '' : ' style="display: none;"'; ?>>Upload Image</a>
				<a href="#" class="button custom-button-remove" <?php echo empty($category_custom_image_url) ? ' style="display: none;"' : ''; ?>>Remove Image</a>
			</div>
		</td>
	</tr>
	<?php
}
add_action('radios_edit_form_fields', 'radios_edit_form_fields_callback', 10, 2);

// Save custom fields when editing the radio category
function edit_radios_callback($term_id)
{
	if (isset($_POST['category_custom_image_url'])) {
		update_term_meta($term_id, 'category_custom_image_url', esc_url($_POST['category_custom_image_url']));
	}
}
add_action('edited_radio', 'edit_radios_callback');


// ---------------------------------------code for upload imaege on category radio--------------------------------------------------------------



// code to add meta field in ad_event 




// custom post type category 

function create_top_charts_post_type()
{
	$labels = array(
		'name' => _x('Top Charts', 'Post type general name', 'textdomain'),
		'singular_name' => _x('Top Chart', 'Post type singular name', 'textdomain'),
		'menu_name' => _x('Top Charts', 'Admin Menu text', 'textdomain'),
		'name_admin_bar' => _x('Top Chart', 'Add New on Toolbar', 'textdomain'),
		'add_new' => __('Add New', 'textdomain'),
		'add_new_item' => __('Add New Top Chart', 'textdomain'),
		'new_item' => __('New Top Chart', 'textdomain'),
		'edit_item' => __('Edit Top Chart', 'textdomain'),
		'view_item' => __('View Top Chart', 'textdomain'),
		'all_items' => __('All Top Charts', 'textdomain'),
		'search_items' => __('Search Top Charts', 'textdomain'),
		'parent_item_colon' => __('Parent Top Charts:', 'textdomain'),
		'not_found' => __('No top charts found.', 'textdomain'),
		'not_found_in_trash' => __('No top charts found in Trash.', 'textdomain'),
		'featured_image' => _x('Top Chart Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
		'set_featured_image' => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'use_featured_image' => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
		'archives' => _x('Top Chart archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
		'insert_into_item' => _x('Insert into top chart', 'Overrides the “Insert into post”/“Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
		'uploaded_to_this_item' => _x('Uploaded to this top chart', 'Overrides the “Uploaded to this post”/“Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
		'filter_items_list' => _x('Filter top charts list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/“Filter pages list”. Added in 4.4', 'textdomain'),
		'items_list_navigation' => _x('Top Charts list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/“Pages list navigation”. Added in 4.4', 'textdomain'),
		'items_list' => _x('Top Charts list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/“Pages list”. Added in 4.4', 'textdomain'),
	);

	$args = array(
		'labels' => $labels,
		'description' => 'A custom post type for managing top charts.',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'top-charts'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title', 'editor', 'thumbnail'),
	);

	register_post_type('top_chart', $args);
}
add_action('init', 'create_top_charts_post_type');


// Add meta boxes for custom fields
function add_top_charts_meta_boxes()
{
	add_meta_box(
		'top_charts_language',
		'Language',
		'top_charts_language_meta_box_callback',
		'top_chart',
		'normal',
		'default'
	);

	add_meta_box(
		'top_charts_song_count',
		'Song Count',
		'top_charts_song_count_meta_box_callback',
		'top_chart',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes', 'add_top_charts_meta_boxes');

// Callback function to display the language meta box

function top_charts_language_meta_box_callback($post)
{
	$language = get_post_meta($post->ID, 'top_charts_language', true);
	?>
	<label for="top_charts_language">Language:</label>
	<input type="text" id="top_charts_language" name="top_charts_language" value="<?php echo esc_attr($language); ?>">
	<?php
}

// Callback function to display the song count meta box
function top_charts_song_count_meta_box_callback($post)
{
	$song_count = get_post_meta($post->ID, 'top_charts_song_count', true);
	?>
	<label for="top_charts_song_count">Song Count:</label>
	<input type="number" id="top_charts_song_count" name="top_charts_song_count"
		value="<?php echo esc_attr($song_count); ?>" min="0">
	<?php
}

// Save custom fields data


function save_top_charts_meta_data($post_id)
{
	if (isset($_POST['top_charts_language'])) {
		update_post_meta($post_id, 'top_charts_language', sanitize_text_field($_POST['top_charts_language']));
	}

	if (isset($_POST['top_charts_song_count'])) {
		update_post_meta($post_id, 'top_charts_song_count', intval($_POST['top_charts_song_count']));
	}
}
add_action('save_post', 'save_top_charts_meta_data');

// Hook into the add_meta_boxes action
add_action('add_meta_boxes', 'add_top_chart_category_meta_box');


// Define the callback function for the meta box
function add_top_chart_category_meta_box()
{
	// Add meta box to the 'top_chart' custom post type
	add_meta_box(
		'top_chart_category_meta_box', // Meta box ID
		'Top Chart Category', // Title
		'render_top_chart_category_meta_box', // Callback function to render the meta box content
		'top_chart', // Custom post type
		'side', // Context (where to display the meta box)
		'default' // Priority
	);
}
function render_top_chart_category_meta_box($post)
{
	// Retrieve the current value of the 'category' meta field, if it exists
	$selected_category1 = get_post_meta($post->ID, 'category', true);

	// Retrieve all song categories
	$song_categories = get_terms(
		array(
			'taxonomy' => 'song_categories', // Assuming 'song_categories' is the taxonomy name
			'hide_empty' => false, // Show even if there are no posts in the category
		)
	);

	?>
	<label for="top-chart-category">Category:</label>
	<select id="top-chart-category" name="top_chart_category" style="width: 100%;">
		<option value="">Select Category</option>
		<?php foreach ($song_categories as $song_category): ?>
			<option value="<?php echo esc_attr($song_category->term_id); ?>" <?php selected($selected_category1, $song_category->term_id); ?>>
				<?php echo esc_html($song_category->name); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<p class="description">Select the category for this post.</p>

	<?php
}


// Hook into the save_post action to save the meta box data
add_action('save_post', 'save_top_chart_category_meta_box');

// Define the callback function to save the meta box data
function save_top_chart_category_meta_box($post_id)
{
	// Check if nonce is set
	if (!isset($_POST['top_chart_category_nonce'])) {
		return;
	}

	// Verify nonce
	if (!wp_verify_nonce($_POST['top_chart_category_nonce'], 'save_top_chart_category')) {
		return;
	}

	// Check if this is an autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check user's permissions
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Save the meta field value
	if (isset($_POST['top_chart_category'])) {
		update_post_meta($post_id, 'category', sanitize_text_field($_POST['top_chart_category']));
	}
}

// Hook into the post_submitbox_misc_actions action to add a nonce field
add_action('post_submitbox_misc_actions', 'add_top_chart_category_nonce_field');

// Define the function to add a nonce field
function add_top_chart_category_nonce_field()
{
	// Add nonce field for security
	wp_nonce_field('save_top_chart_category', 'top_chart_category_nonce');
}



// Define the callback function for the meta box
function add_top_chart_artist_category_meta_box()
{
	// Add meta box to the 'top_chart' custom post type
	add_meta_box(
		'top_chart_artist_category_meta_box', // Meta box ID
		'Top Chart Artist Category', // Title
		'render_top_chart_artist_category_meta_box', // Callback function to render the meta box content
		'top_chart', // Custom post type
		'side', // Context (where to display the meta box)
		'default' // Priority
	);
}

// Hook into the add_meta_boxes action
add_action('add_meta_boxes', 'add_top_chart_artist_category_meta_box');

// Define the callback function to render the meta box content
function render_top_chart_artist_category_meta_box($post)
{
	// Retrieve the current value of the 'artist_category' meta field, if it exists
	$selected_category2 = get_post_meta($post->ID, 'artist_category', true);

	// Retrieve all artist categories
	$artist_categories = get_terms(
		array(
			'taxonomy' => 'artists', // Assuming 'artist_categories' is the taxonomy name
			'hide_empty' => false, // Show even if there are no posts in the category
		)
	);

	?>
	<label for="top-chart-artist-category">Artist Category:</label>
	<select id="top-chart-artist-category" name="top_chart_artist_category" style="width: 100%;">
		<option value="">Select Artist </option>
		<?php foreach ($artist_categories as $artist_category): ?>
			<option value="<?php echo esc_attr($artist_category->term_id); ?>" <?php selected($selected_category2, $artist_category->term_id); ?>>
				<?php echo esc_html($artist_category->name); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<p class="description">Select the artist category for this post.</p>

	<?php
}

// Hook into the save_post action to save the meta box data
add_action('save_post', 'save_top_chart_artist_category_meta_box');

// Define the callback function to save the meta box data
function save_top_chart_artist_category_meta_box($post_id)
{
	// Check if nonce is set
	if (!isset($_POST['top_chart_artist_category_nonce'])) {
		return;
	}

	// Verify nonce
	if (!wp_verify_nonce($_POST['top_chart_artist_category_nonce'], 'save_top_chart_artist_category')) {
		return;
	}

	// Check if this is an autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check user's permissions
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Save the meta field value
	if (isset($_POST['top_chart_artist_category'])) {
		update_post_meta($post_id, 'artist_category', sanitize_text_field($_POST['top_chart_artist_category']));
	}
}

// Hook into the post_submitbox_misc_actions action to add a nonce field
add_action('post_submitbox_misc_actions', 'add_top_chart_artist_category_nonce_field');

// Define the function to add a nonce field
function add_top_chart_artist_category_nonce_field()
{
	// Add nonce field for security
	wp_nonce_field('save_top_chart_artist_category', 'top_chart_artist_category_nonce');
}










// post meta fields 
function custom_add_post_meta_field()
{
	add_meta_box(
		'custom_post_paras',
		'Custom Post Paragraphs',
		'custom_render_meta_field',
		'post',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'custom_add_post_meta_field');

function custom_render_meta_field($post)
{
	$post_para_1 = get_post_meta($post->ID, 'post_para_1', true);
	$post_para_2 = get_post_meta($post->ID, 'post_para_2', true);
	$post_para_3 = get_post_meta($post->ID, 'post_para_3', true);
	$post_que = get_post_meta($post->ID, 'post_que', true);
	$post_image_1 = get_post_meta($post->ID, 'post_image_1', true);
	$post_image_2 = get_post_meta($post->ID, 'post_image_2', true);
	?>
	<label for="post_para_1">Custom Paragraph 1:</label>
	<textarea style="width:100%" id="post_para_1" name="post_para_1"><?php echo esc_textarea($post_para_1); ?></textarea>

	<label for="post_para_2">Custom Paragraph 2:</label>
	<textarea style="width:100%" id="post_para_2" name="post_para_2"><?php echo esc_textarea($post_para_2); ?></textarea>

	<label for="post_para_3">Custom Paragraph 3:</label>
	<textarea style="width:100%" id="post_para_3" name="post_para_3"><?php echo esc_textarea($post_para_3); ?></textarea>

	<label for="post_que">Post Question:</label>
	<textarea style="width:100%" id="post_que" name="post_que"><?php echo esc_textarea($post_que); ?></textarea>

	<label for="post_image_1">Image 1:</label>
	<div class="custom-media-uploader" style="width:100%">
		<input type="text" id="post_image_1" name="post_image_1" value="<?php echo esc_attr($post_image_1); ?>" />
		<input type="button" class="button button-secondary custom-media-upload" value="Upload Image" />
	</div>

	<label for="post_image_2">Image 2:</label>
	<div class="custom-media-uploader" style="width:100%">
		<input type="text" id="post_image_2" name="post_image_2" value="<?php echo esc_attr($post_image_2); ?>" />
		<input type="button" class="button button-secondary custom-media-upload" value="Upload Image" />
	</div>


	<?php
}

function custom_save_post_meta($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	if (!current_user_can('edit_post', $post_id))
		return;

	$custom_fields = ['post_para_1', 'post_para_2', 'post_para_3', 'post_que'];

	foreach ($custom_fields as $field) {
		if (isset($_POST[$field])) {
			update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
		}
	}
}
add_action('save_post', 'custom_save_post_meta');


// *************************custom post-types and their meta fields **************************************



ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '55M');

add_filter('unzip_file_use_ziparchive', '__return_false');




// for most likes



// Define a function to retrieve and process top liked tracks
// Define a function to retrieve and process top liked tracks
function get_top_liked_tracks()
{
	global $wpdb;

	// // Query to get all users who have liked tracks
	// $user_query = $wpdb->get_results(
	// 	"SELECT user_id, meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'wvpl_likes'"
	// );

	// $track_likes = array();

	// foreach ($user_query as $user) {
	// 	// Extract track IDs from user meta value
	// 	$liked_tracks = maybe_unserialize($user->meta_value);
	// 	error_log('tracks===>',$liked_tracks);
	// 	// Check if $liked_tracks is not empty
	// 	if (!empty($liked_tracks)) {
	// 		// Count likes for each track
	// 		foreach ($liked_tracks as $track_id) {
	// 			if (isset($track_likes[$track_id])) {
	// 				$track_likes[$track_id]++;
	// 			} else {
	// 				$track_likes[$track_id] = 1;
	// 			}
	// 		}
	// 	}
	// }

	// arsort($track_likes);

	// // Get top N tracks (e.g., top 10)
	// $top_tracks = array_slice($track_likes, 0, 10, true);

	// // Fetch post titles for the top liked tracks
	// $top_liked_tracks = array();
	// foreach ($top_tracks as $track_id => $like_count) {
	// 	$post_title = get_the_title($track_id);
	// 	if ($post_title) {
	// 		$top_liked_tracks[] = array(
	// 			'post_id' => $track_id,
	// 			'post_title' => $post_title,
	// 			'like_count' => $like_count,
	// 		);
	// 	}
	// }

	// echo '<pre>';
	// print_r($top_liked_tracks);
	// echo '</pre>';
// Query to get all users who have liked tracks
$user_id = get_current_user_id(); // Example: Get the ID of the current user

$user_query = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT meta_value FROM {$wpdb->usermeta} WHERE user_id = %d AND meta_key = 'wvpl_likes'",
        $user_id
    )
);

// Initialize an empty array to store the meta_values
$likes_array = array();

// Loop through the query results
if ($user_query) {
    foreach ($user_query as $like) {
        // Add the meta_value to the likes_array
        $likes_array[] = $like->meta_value;
    }
}


	return $likes_array;
}


// events custom post type 

// Register custom post type
function create_ad_event_post_type()
{
	$labels = array(
		'name' => 'Ad Events',
		'singular_name' => 'Ad Event',
		'menu_name' => 'Ad Events',
		'name_admin_bar' => 'Ad Event',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Ad Event',
		'new_item' => 'New Ad Event',
		'edit_item' => 'Edit Ad Event',
		'view_item' => 'View Ad Event',
		'all_items' => 'All Ad Events',
		'search_items' => 'Search Ad Events',
		'parent_item_colon' => 'Parent Ad Events:',
		'not_found' => 'No ad events found.',
		'not_found_in_trash' => 'No ad events found in Trash.'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'ad-event'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'thumbnail'), // Add 'thumbnail' support
		'taxonomies' => array(),
	);

	register_post_type('ad_event', $args);
}
add_action('init', 'create_ad_event_post_type');


// Add meta boxes for custom meta fields
function add_ad_event_meta_boxes()
{
	add_meta_box(
		'ad_event_artists_meta_box',
		'Artists',
		'render_ad_event_artists_meta_box',
		'ad_event',
		'normal',
		'default'
	);

	add_meta_box(
		'ad_event_date_meta_box',
		'Date',
		'render_ad_event_date_meta_box',
		'ad_event',
		'normal',
		'default'
	);
	add_meta_box(
		'ad_event_venue_name_meta_box',
		'Venue Name',
		'render_ad_event_venue_name_meta_box',
		'ad_event',
		'normal',
		'default'
	);

	add_meta_box(
		'ad_event_start_time_meta_box',
		'Start Time',
		'render_ad_event_start_time_meta_box',
		'ad_event',
		'normal',
		'default'
	);

	add_meta_box(
		'ad_event_end_time_meta_box',
		'End Time',
		'render_ad_event_end_time_meta_box',
		'ad_event',
		'normal',
		'default'
	);

	add_meta_box(
		'ad_event_entry_fee_tag_meta_box',
		'Entry Fee Tag',
		'render_ad_event_entry_fee_tag_meta_box',
		'ad_event',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes', 'add_ad_event_meta_boxes');

// Render Artists meta box
function render_ad_event_artists_meta_box($post)
{
	$artists = get_post_meta($post->ID, 'artists', true);
	?>
	<label for="ad-event-artists">Artists:</label>
	<input type="text" id="ad-event-artists" name="ad_event_artists" value="<?php echo esc_attr($artists); ?>">
	<?php
}
// Render Date meta box
function render_ad_event_date_meta_box($post)
{
	$date = get_post_meta($post->ID, 'date', true);
	?>
	<label for="ad-event-date">Date:</label>
	<input type="date" id="ad-event-date" name="ad_event_date" value="<?php echo esc_attr($date); ?>">
	<?php
}


// Render Venue Name meta box
function render_ad_event_venue_name_meta_box($post)
{
	$venue_name = get_post_meta($post->ID, 'venue_name', true);
	?>
	<label for="ad-event-venue-name">Venue Name:</label>
	<input type="text" id="ad-event-venue-name" name="ad_event_venue_name" value="<?php echo esc_attr($venue_name); ?>">
	<?php
}

// Render Start Time meta box
function render_ad_event_start_time_meta_box($post)
{
	$start_time = get_post_meta($post->ID, 'start_time', true);
	?>
	<label for="ad-event-start-time">Start Time:</label>
	<input type="time" id="ad-event-start-time" name="ad_event_start_time" value="<?php echo esc_attr($start_time); ?>">
	<?php
}

// Render End Time meta box
function render_ad_event_end_time_meta_box($post)
{
	$end_time = get_post_meta($post->ID, 'end_time', true);
	?>
	<label for="ad-event-end-time">End Time:</label>
	<input type="time" id="ad-event-end-time" name="ad_event_end_time" value="<?php echo esc_attr($end_time); ?>">
	<?php
}

// Render Entry Fee Tag meta box
function render_ad_event_entry_fee_tag_meta_box($post)
{
	$entry_fee_tag = get_post_meta($post->ID, 'entry_fee_tag', true);
	?>
	<label for="ad-event-entry-fee-tag">Entry Fee Tag:</label>
	<input type="text" id="ad-event-entry-fee-tag" name="ad_event_entry_fee_tag"
		value="<?php echo esc_attr($entry_fee_tag); ?>">
	<?php
}

// Save meta box data
function save_ad_event_meta_boxes($post_id)
{
	// Check nonce
	if (!isset($_POST['ad_event_meta_box_nonce']) || !wp_verify_nonce($_POST['ad_event_meta_box_nonce'], 'save_ad_event_meta_boxes')) {
		return;
	}

	// Check if this is an autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check user permissions
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Save meta box data
	$meta_fields = array('artists', 'date', 'countdown_timer', 'venue_name', 'start_time', 'end_time', 'entry_fee_tag');

	foreach ($meta_fields as $meta_field) {
		if (isset($_POST['ad_event_' . $meta_field])) {
			update_post_meta($post_id, $meta_field, sanitize_text_field($_POST['ad_event_' . $meta_field]));
		}
	}
}
add_action('save_post', 'save_ad_event_meta_boxes');

// Add nonce for security
function add_ad_event_meta_box_nonce_field()
{
	wp_nonce_field('save_ad_event_meta_boxes', 'ad_event_meta_box_nonce');
}
add_action('post_submitbox_misc_actions', 'add_ad_event_meta_box_nonce_field');



// Add Custom Meta Box for MP3 File
function add_song_meta_box1()
{
	add_meta_box(
		'song_mp3_meta_box',
		'Song MP3 File',
		'display_song_mp3_meta_box1',
		'ad_event',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'add_song_meta_box1');

// Display the Meta Box Content
function display_song_mp3_meta_box1($post)
{
	// Retrieve current MP3 file
	$mp3_file = get_post_meta($post->ID, 'song_mp3_file', true);

	// Display input field for MP3 file
	?>
	<p>
		<label for="song_mp3_file">Select MP3 File:</label>
		<br />
		<input type="text" name="song_mp3_file" id="song_mp3_file" class="regular-text"
			value="<?php echo esc_attr($mp3_file); ?>" />
		<input type="button" class="button button-secondary" value="Select MP3" id="upload_mp3_button" />
	</p>

	<?php
}

// Save the Meta Box Data
function save_song_mp3_meta1($post_id)
{
	if (isset($_POST['song_mp3_file'])) {
		update_post_meta($post_id, 'song_mp3_file', sanitize_text_field($_POST['song_mp3_file']));
	}
}
add_action('save_post', 'save_song_mp3_meta1');














function enqueue_select2_scripts()
{
	// Enqueue Select2 CSS
	wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array(), '4.0.13');
	// Enqueue Select2 JS
	wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), '4.0.13', true);
}
add_action('admin_enqueue_scripts', 'enqueue_select2_scripts');

// Add custom CSS for Select2
function custom_select2_css()
{
	?>
	<style>
		.select2-container--default .select2-selection--multiple .select2-selection__choice {
			color: #333;
		}
	</style>
	<?php
}
add_action('admin_head', 'custom_select2_css');














// song player render functions


// Hook the function to the 'init' action
// add_action('wp_loaded', 'get_top_liked_tracks');


function get_top_played_tracks()
{
	global $wpdb;

	// Query to get top played tracks based on play count from post meta
	$track_play_counts = $wpdb->get_results(
		"SELECT post_id, meta_value AS play_count FROM {$wpdb->postmeta} WHERE meta_key = 'wvpl_play_count'"
	);

	$top_played_tracks = array();

	foreach ($track_play_counts as $track) {
		// Get the post title
		$post_title = get_the_title($track->post_id);

		// Only proceed if the post title exists
		if ($post_title) {
			$top_played_tracks[] = array(
				'post_id' => $track->post_id,
				'post_title' => $post_title,
				'play_count' => intval($track->play_count), // Convert play count to integer
			);
		}
	}

	// Sort the top played tracks by play count in descending order
	usort($top_played_tracks, function ($a, $b) {
		return $b['play_count'] - $a['play_count'];
	});

	// Limit to top N tracks (e.g., top 10)
	$top_played_tracks = array_slice($top_played_tracks, 0, 10);
	return $top_played_tracks;

}

// Hook the function to the 'init' action
add_action('wp_loaded', 'get_top_played_tracks');




function render_trending_section($sec_heading, $single_page_title, $lowerCase_secLang, $section_category)
{
	?>
	<section>
		<div class="section-heading">
			<h3>
				<?php echo $sec_heading; ?>
			</h3>
			<div class="show-all">
				<a href="<?php echo get_permalink(get_page_by_title($single_page_title)); ?>">Show All</a>
			</div>
		</div>
		<div class="song-row">
			<?php
			$top_tracks = get_top_played_tracks();
			if ($top_tracks) {
				$i = 1;
				foreach ($top_tracks as $track) {
					if ($i > 6) {
						break; // Stop processing tracks if already rendered 6
					}
					render_track($track, $lowerCase_secLang, $section_category, $i);
				}
			}
			?>
		</div>
	</section>
	<?php
}


function render_register_button()
{
	?>
	<div class="membersip-pitch">
		<h3>Members only content.</h3>
		<p>Not a subscriber yet ? check our plans.</p>
		<a class="red-btn" href="<?php echo get_permalink(get_page_by_title('Plans')) ?>">View Plans</a>
	</div>
	<?php
}
function render_track($track, $lowerCase_secLang, $section_category, &$i)
{
	$track_url = wp_get_attachment_url($track['post_id']);
	global $wpdb;
	$sql_query = $wpdb->prepare(
		"SELECT post_id 
        FROM {$wpdb->prefix}postmeta
        WHERE meta_key = 'song_mp3_file'
        AND meta_value = %s
        LIMIT 10",
		$track_url
	);
	$post_ids = $wpdb->get_col($sql_query);
	if ($post_ids) {
		foreach ($post_ids as $post_id) {
			$post_language = get_post_meta($post_id, 'language', true);
			$lowerCase_postLang = strtolower(str_replace(' ', '', $post_language));
			if ($lowerCase_secLang !== false && $lowerCase_postLang !== $lowerCase_secLang && $lowerCase_secLang !== '') {
				continue;
			}
			$taxonomy_terms = wp_get_post_terms($post_id, 'song_categories');

			$category_match = false;
			foreach ($taxonomy_terms as $term) {
				// Check if the term slug exists in the section categories array
				if (in_array($term->slug, $section_category)) {
					$category_match = true;
					break; // Exit the loop if a match is found
				}
			}
			if (!$category_match) {
				continue;
			}
			// Render track only if it matches the conditions
			$track_url_1 = wp_get_attachment_url($track['post_id']);
			$post_title = get_the_title($post_id);
			$content = get_post_field('post_content', $post_id);
			$thumbnail_new = get_the_post_thumbnail_url($post_id, 'medium');
			$single_page_url = get_permalink($post_id);
			$radio_terms = wp_get_post_terms($post_id, 'radios');
			$first_term = !empty($radio_terms) ? get_term_link($radio_terms[0]) : ''; // Extracting the first term link if present
			$artist_terms = wp_get_post_terms($post_id, 'artists');
			$artist_link = !empty($artist_terms) ? get_term_link($artist_terms[0]) : ''; // Extracting the artist term link if present
			?>
			<div class="player">
				<div class="song-number">
					<?php echo $i; ?>
				</div>
				<div class="song-thumbnail" style="background-image:url(<?php echo $thumbnail_new; ?>)">
					<?php if ($track_url_1) {
						echo do_shortcode("[vwwaveplayer url='" . $track_url_1 . "' size='sm' skin='thumb_n_wave' override_wave_colors='0' style='light' autoplay='0']");

					} ?>
				</div>
				<div class="song-info-wrap">
					<div class="song-title">
						<a href="<?php echo $single_page_url; ?>">
							<?php echo $post_title; ?>
						</a>
					</div>
					<div class="song-description">
						<p>
							<?php echo $content; ?>
						</p>
					</div>
					<div class="option-trigger"><i class="fa-solid fa-ellipsis-vertical"></i></div>
					<div class="options">
						<ul class="option-wrapper">
							<li class="options-div"><a href="<?php the_permalink($post_id); ?>">View Song</a></li>
							<?php echo !empty($artist_link) ? '<li class="options-div"><a href="' . esc_url($artist_link) . '">View Artist</a></li>' : ''; ?>
							<?php echo !empty($first_term) ? '<li class="options-div"><a href="' . esc_url($first_term) . '">Song Radio</a></li>' : ''; ?>
						</ul>
					</div>
				</div>
			</div>
			<?php
			// Increment $i only if a track is rendered and the conditions are met
			$i++;
		}
	}
}





//-----for update track history-------------------------------


// Add AJAX endpoint for updating track history
add_action('wp_ajax_update_track_history', 'update_track_history_callback');
add_action('wp_ajax_nopriv_update_track_history', 'update_track_history_callback');

function update_track_history_callback()
{
	// Check if the request is coming from a valid source
	check_ajax_referer('update_track_history_nonce', 'security');

	// Get the current user ID
	$user_id = get_current_user_id();

	// Define the 'track_history' meta key if it doesn't exist
	$track_history = get_user_meta($user_id, 'track_history', true);
	if (!$track_history) {
		$track_history = array(); // Initialize an empty array if track history doesn't exist
	}

	// Get the track ID from the AJAX request
	$track_id = isset($_POST['track_id']) ? sanitize_text_field($_POST['track_id']) : '';

	// Check if the track ID already exists in the track history array
	$index = array_search($track_id, $track_history);
	if ($index !== false) {
		// If the track ID exists, unset it and reset array indices
		unset($track_history[$index]);
		$track_history = array_values($track_history);
	}

	// Append the new track ID to the existing track history
	array_unshift($track_history, $track_id);

	// Update track history meta key for the user
	update_user_meta($user_id, 'track_history', $track_history);

	// You can return any response back to the client if needed
	// In this example, we'll just send a success message
	wp_send_json_success('Track history updated successfully');
}

// Localize the script with new data
add_action('wp_enqueue_scripts', 'add_custom_script');

function add_custom_script()
{
	// Enqueue your custom script
	wp_enqueue_script('custom-script', get_template_directory_uri() . '/custom.js', array('jquery'), '1.0', true);

	// Create nonce for security
	$nonce = wp_create_nonce('update_track_history_nonce');

	// Pass AJAX URL and nonce to script
	wp_localize_script(
		'custom-script',
		'ajax_object',
		array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'update_track_history_nonce' => $nonce,
		)
	);
}



//for fetch track history --------------------


// Define a function to retrieve track history
function get_track_history()
{
	global $wpdb;

	// Initialize an empty array to store unique track history
	$track_history = array();

	// Query to get all users' track history
	$user_track_history_query = $wpdb->get_results(
		"SELECT user_id, meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'track_history'"
	);

	// Loop through each user's track history
	foreach ($user_track_history_query as $user_track_history) {
		// Extract track IDs from user meta value
		$user_track_ids = maybe_unserialize($user_track_history->meta_value);

		// Check if $user_track_ids is not empty
		if (!empty($user_track_ids)) {
			// Merge unique track IDs into the track history array
			$track_history = array_merge($track_history, array_unique($user_track_ids));
		}
	}



	// You may want to perform additional processing or filtering on $track_history here

	return $track_history;
}

// Hook the function to the 'init' action
add_action('wp_loaded', 'get_track_history');



// Define a function to render the number of likes for a track
function render_likes_for_track($track_id)
{
	global $wpdb;

	// Query to get the total count of likes for the specified track ID
	$like_count_query = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(*) 
            FROM {$wpdb->usermeta} 
            WHERE meta_key = 'wvpl_likes' 
            AND meta_value = %d",
			$track_id
		)
	);

	// Return the total number of likes for the specified track
	return $like_count_query;
}



// Register custom post type for albums
function register_albums_post_type()
{
	$labels = array(
		'name' => 'Albums',
		'singular_name' => 'Album',
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'hierarchical' => true, // Set to true to enable archives
	);

	register_post_type('albums', $args);
}
add_action('init', 'register_albums_post_type');

// Add meta box for song selection on the edit screen of "albums" post type
function add_album_songs_meta_box()
{
	add_meta_box(
		'album_songs_meta_box',
		'Album Songs',
		'render_album_songs_meta_box',
		'albums',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes', 'add_album_songs_meta_box');
function render_album_songs_meta_box($post)
{
	// Query all posts from "songs" post type
	$songs_query = new WP_Query(
		array(
			'post_type' => 'songs',
			'posts_per_page' => -1, // Retrieve all songs
		)
	);

	// Get selected songs array
	$selected_songs = get_post_meta($post->ID, 'selected_songs', true);
	if (!is_array($selected_songs)) {
		$selected_songs = array(); // Initialize as empty array if not an array
	}

	// Display the search box
	echo '<input type="text" id="song-search" placeholder="Search Songs" class="">';

	// Display the list of songs
	if ($songs_query->have_posts()) {
		echo '<ul id="song-list">';
		while ($songs_query->have_posts()) {
			$songs_query->the_post();
			$song_id = get_the_ID();
			$song_title = get_the_title();
			$checked = in_array($song_id, $selected_songs) ? 'checked' : '';

			echo '<li class="song-item">';
			echo '<label>';
			echo '<input type="checkbox" name="selected_songs[]" value="' . esc_attr($song_id) . '" ' . $checked . '>';
			echo esc_html($song_title);
			echo '</label>';
			echo '</li>';
		}
		echo '</ul>';
	}

	// Restore original post data
	wp_reset_postdata();
}


// Save selected songs when "albums" post is saved or updated
function save_album_selected_songs($post_id)
{
	if (isset($_POST['selected_songs'])) {
		$selected_songs = array_map('absint', $_POST['selected_songs']);
		update_post_meta($post_id, 'selected_songs', $selected_songs);
	}
}
add_action('save_post_albums', 'save_album_selected_songs');

// Add AJAX handler for song search
function ajax_song_search()
{
	$search_query = isset($_GET['search_query']) ? sanitize_text_field($_GET['search_query']) : '';

	// Query songs based on search query
	$songs_query = new WP_Query(
		array(
			'post_type' => 'songs',
			'posts_per_page' => -1,
			's' => $search_query,
		)
	);

	// Output the list of songs
	ob_start();
	if ($songs_query->have_posts()) {
		echo '<ul id="song-list">';
		while ($songs_query->have_posts()) {
			$songs_query->the_post();
			$song_id = get_the_ID();
			$song_title = get_the_title();
			echo '<li class="song-item">';
			echo '<label>';
			echo '<input type="checkbox" name="selected_songs[]" value="' . esc_attr($song_id) . '">';
			echo esc_html($song_title);
			echo '</label>';
			echo '</li>';
		}
		echo '</ul>';
	} else {
		echo '<p>No songs found.</p>';
	}
	wp_reset_postdata();
	$output = ob_get_clean();

	echo $output;

	die();
}
add_action('wp_ajax_ajax_song_search', 'ajax_song_search');
add_action('wp_ajax_nopriv_ajax_song_search', 'ajax_song_search'); // Allow AJAX for non-logged-in users





// Step 1: Define meta fields for album post type	
function custom_album_meta_fields()
{
	add_meta_box(
		'album_info_meta_box',
		'Album Information',
		'render_album_info_meta_box',
		'albums',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'custom_album_meta_fields');

function render_album_info_meta_box($post)
{
	// Retrieve existing values for collection name, artist name, movie name, company name, play count, and duration
	$collection_name = get_post_meta($post->ID, 'collection_name', true);
	$artist_name = get_post_meta($post->ID, 'artist_name', true);
	$movie_name = get_post_meta($post->ID, 'movie_name', true);
	$company_name = get_post_meta($post->ID, 'company_name', true);
	$play_count = get_post_meta($post->ID, 'play_count', true);
	$duration = get_post_meta($post->ID, 'duration', true);

	// Output meta box HTML
	?>
	<p>
		<label for="collection_name">Collection Name:</label>
		<input type="text" id="collection_name" name="collection_name" value="<?php echo esc_attr($collection_name); ?>">
	</p>
	<p>
		<label for="artist_name">Artist Name:</label>
		<input type="text" id="artist_name" name="artist_name" value="<?php echo esc_attr($artist_name); ?>">
	</p>
	<p>
		<label for="movie_name">Movie Name:</label>
		<input type="text" id="movie_name" name="movie_name" value="<?php echo esc_attr($movie_name); ?>">
	</p>
	<p>
		<label for="company_name">Company Name:</label>
		<input type="text" id="company_name" name="company_name" value="<?php echo esc_attr($company_name); ?>">
	</p>
	<p>
		<label for="play_count">Play Count:</label>
		<input type="number" id="play_count" name="play_count" value="<?php echo esc_attr($play_count); ?>" min="0">
	</p>
	<p>
		<label for="duration">Duration (minutes):</label>
		<input type="number" id="duration" name="duration" value="<?php echo esc_attr($duration); ?>" min="0">
	</p>
	<?php
}

// Step 2: Save meta field values
function save_album_meta_fields($post_id)
{
	if (isset($_POST['collection_name'])) {
		update_post_meta($post_id, 'collection_name', sanitize_text_field($_POST['collection_name']));
	}
	if (isset($_POST['artist_name'])) {
		update_post_meta($post_id, 'artist_name', sanitize_text_field($_POST['artist_name']));
	}
	if (isset($_POST['movie_name'])) {
		update_post_meta($post_id, 'movie_name', sanitize_text_field($_POST['movie_name']));
	}
	if (isset($_POST['company_name'])) {
		update_post_meta($post_id, 'company_name', sanitize_text_field($_POST['company_name']));
	}
	if (isset($_POST['play_count'])) {
		update_post_meta($post_id, 'play_count', intval($_POST['play_count']));
	}
	if (isset($_POST['duration'])) {
		update_post_meta($post_id, 'duration', intval($_POST['duration']));
	}
}
add_action('save_post_albums', 'save_album_meta_fields');



function custom_archive_query($query)
{
	if (is_tax('song_categories') && $query->is_main_query()) {
		$query->set('posts_per_page', -1); // -1 to retrieve all posts
	}
}
add_action('pre_get_posts', 'custom_archive_query');






// Register custom post type for playlists
function register_playlists_post_type()
{
	$labels = array(
		'name' => 'Playlists',
		'singular_name' => 'Playlist',
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'hierarchical' => true, // Set to true to enable archives
	);

	register_post_type('playlists', $args);
}
add_action('init', 'register_playlists_post_type');

// Add meta box for song selection on the edit screen of "playlists" post type
function add_playlist_songs_meta_box()
{
	add_meta_box(
		'playlist_songs_meta_box',
		'Playlist Songs',
		'render_playlist_songs_meta_box',
		'playlists',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes', 'add_playlist_songs_meta_box');

function render_playlist_songs_meta_box($post)
{
	// Query all posts from "songs" post type
	$songs_query = new WP_Query(
		array(
			'post_type' => 'songs',
			'posts_per_page' => -1, // Retrieve all songs
		)
	);

	// Get selected songs array
	$selected_songs = get_post_meta($post->ID, 'playlist_selected_songs', true);
	if (!is_array($selected_songs)) {
		$selected_songs = array(); // Initialize as empty array if not an array
	}

	// Display the search box
	echo '<input type="text" id="song-search" placeholder="Search Songs" class="">';

	// Display the list of songs
	if ($songs_query->have_posts()) {
		echo '<ul id="song-list">';
		while ($songs_query->have_posts()) {
			$songs_query->the_post();
			$song_id = get_the_ID();
			$song_title = get_the_title();
			$checked = in_array($song_id, $selected_songs) ? 'checked' : '';

			echo '<li class="song-item">';
			echo '<label>';
			echo '<input type="checkbox" name="playlist_selected_songs[]" value="' . esc_attr($song_id) . '" ' . $checked . '>';
			echo esc_html($song_title);
			echo '</label>';
			echo '</li>';
		}
		echo '</ul>';
	}

	// Restore original post data
	wp_reset_postdata();
}

// Save selected songs when "playlists" post is saved or updated
function save_playlist_selected_songs($post_id)
{
	if (isset($_POST['playlist_selected_songs'])) {
		$selected_songs = array_map('absint', $_POST['playlist_selected_songs']);
		update_post_meta($post_id, 'playlist_selected_songs', $selected_songs);
	}
}
add_action('save_post_playlists', 'save_playlist_selected_songs');

// Step 1: Define meta fields for playlist post type
function custom_playlist_meta_fields()
{
	add_meta_box(
		'playlist_info_meta_box',
		'Playlist Information',
		'render_playlist_info_meta_box',
		'playlists',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'custom_playlist_meta_fields');

function render_playlist_info_meta_box($post)
{
	// Retrieve existing values for collection name, artist name, movie name, company name, play count, and duration
	$collection_name = get_post_meta($post->ID, 'playlist_collection_name', true);
	$artist_name = get_post_meta($post->ID, 'playlist_artist_name', true);
	$movie_name = get_post_meta($post->ID, 'playlist_movie_name', true);
	$company_name = get_post_meta($post->ID, 'playlist_company_name', true);
	$play_count = get_post_meta($post->ID, 'playlist_play_count', true);
	$duration = get_post_meta($post->ID, 'playlist_duration', true);

	// Output meta box HTML
	?>
	<p>
		<label for="playlist_collection_name">Collection Name:</label>
		<input type="text" id="playlist_collection_name" name="playlist_collection_name"
			value="<?php echo esc_attr($collection_name); ?>">
	</p>
	<p>
		<label for="playlist_artist_name">Artist Name:</label>
		<input type="text" id="playlist_artist_name" name="playlist_artist_name"
			value="<?php echo esc_attr($artist_name); ?>">
	</p>
	<p>
		<label for="playlist_movie_name">Movie Name:</label>
		<input type="text" id="playlist_movie_name" name="playlist_movie_name" value="<?php echo esc_attr($movie_name); ?>">
	</p>
	<p>
		<label for="playlist_company_name">Company Name:</label>
		<input type="text" id="playlist_company_name" name="playlist_company_name"
			value="<?php echo esc_attr($company_name); ?>">
	</p>
	<p>
		<label for="playlist_play_count">Play Count:</label>
		<input type="number" id="playlist_play_count" name="playlist_play_count"
			value="<?php echo esc_attr($play_count); ?>" min="0">
	</p>
	<p>
		<label for="playlist_duration">Duration (minutes):</label>
		<input type="number" id="playlist_duration" name="playlist_duration" value="<?php echo esc_attr($duration); ?>"
			min="0">
	</p>
	<?php
}

// Step 2: Save meta field values
function save_playlist_meta_fields($post_id)
{
	if (isset($_POST['playlist_collection_name'])) {
		update_post_meta($post_id, 'playlist_collection_name', sanitize_text_field($_POST['playlist_collection_name']));
	}
	if (isset($_POST['playlist_artist_name'])) {
		update_post_meta($post_id, 'playlist_artist_name', sanitize_text_field($_POST['playlist_artist_name']));
	}
	if (isset($_POST['playlist_movie_name'])) {
		update_post_meta($post_id, 'playlist_movie_name', sanitize_text_field($_POST['playlist_movie_name']));
	}
	if (isset($_POST['playlist_company_name'])) {
		update_post_meta($post_id, 'playlist_company_name', sanitize_text_field($_POST['playlist_company_name']));
	}
	if (isset($_POST['playlist_play_count'])) {
		update_post_meta($post_id, 'playlist_play_count', intval($_POST['playlist_play_count']));
	}
	if (isset($_POST['playlist_duration'])) {
		update_post_meta($post_id, 'playlist_duration', intval($_POST['playlist_duration']));
	}
}
add_action('save_post_playlists', 'save_playlist_meta_fields');




/**
 * Function to get order history for the currently logged-in user.
 * Returns an array of order details including membership level name and member name.
 */
function get_current_user_order_history()
{
	// Check if the user is logged in.
	if (is_user_logged_in()) {
		// Get the current user's ID.
		$user_id = get_current_user_id();

		global $wpdb;

		// Retrieve all invoices for the user.
		$invoices = $wpdb->get_results("SELECT mo.*, UNIX_TIMESTAMP(mo.timestamp) as timestamp, du.code_id as code_id 
                                        FROM $wpdb->pmpro_membership_orders mo 
                                        LEFT JOIN $wpdb->pmpro_discount_codes_uses du ON mo.id = du.order_id 
                                        WHERE mo.user_id = '$user_id' 
                                        ORDER BY mo.timestamp DESC");

		$order_details = array();

		// Loop through each invoice to extract order details.
		foreach ($invoices as $invoice) {
			$level_name = ''; // Initialize level name.
			$member_name = ''; // Initialize member name.

			// Get the membership level name.
			$membership_level = pmpro_getLevel($invoice->membership_id);
			if ($membership_level) {
				$level_name = $membership_level->name;
			}

			// Get the member's name.
			$member = get_userdata($user_id);
			if ($member) {
				$member_name = $member->display_name;
			}

			// Construct the order detail array.
			$order_detail = array(
				'date' => date_i18n(get_option('date_format'), $invoice->timestamp),
				'invoice_id' => $invoice->code,
				'level_name' => $level_name,
				'member_name' => $member_name,
				'total_billed' => pmpro_formatPrice($invoice->total),
				'discount_code' => '-',
				'status' => empty($invoice->status) ? '-' : $invoice->status
			);

			// Add the order detail to the array.
			$order_details[] = $order_detail;
		}

		return $order_details; // Return the array of order details.
	} else {
		return array(); // Return an empty array if the user is not logged in.
	}
}

// function remove_site_identity_section($wp_customize) {
//     // Remove the Site Identity section
//     $wp_customize->remove_section('title_tagline');
// }
// add_action('customize_register', 'remove_site_identity_section', 20);




function vw_podcast_pro_category_section_shortcode() {
	ob_start();
	get_template_part('template-parts/home/section-banner');
	$output = ob_get_clean();
	return $output;
	// error_log('Banner Shortcode');
  }
  add_shortcode( 'section-category', 'vw_podcast_pro_category_section_shortcode' );


  function vw_podcast_pro_header_section_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-header');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section-header', 'vw_podcast_pro_header_section_shortcode');
function vw_podcast_pro_ad_history_section_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-history');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section-history', 'vw_podcast_pro_ad_history_section_shortcode');
function vw_podcast_pro_trending_section_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-trending');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section-trending', 'vw_podcast_pro_trending_section_shortcode');
function vw_podcast_pro_new_releases_section_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-trending');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section-released', 'vw_podcast_pro_new_releases_section_shortcode');


function vw_podcast_pro_top_artists_section_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-artists');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section-artists', 'vw_podcast_pro_top_artists_section_shortcode');

function vw_podcast_pro_radio_section_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-radio');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section-radio', 'vw_podcast_pro_radio_section_shortcode');


function vw_podcast_pro_recomended_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-recomemended');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section-recomended', 'vw_podcast_pro_recomended_shortcode');

function vw_podcast_pro_top_chart_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-topChart');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section-topChart', 'vw_podcast_pro_top_chart_shortcode');
function vw_podcast_pro_popular_english_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-english');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section_english', 'vw_podcast_pro_popular_english_shortcode');

function vw_podcast_pro_popular_romance_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-romance');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section_romance', 'vw_podcast_pro_popular_romance_shortcode');

function vw_podcast_pro_spanish_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-spanish');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section_spanish', 'vw_podcast_pro_spanish_shortcode');

function vw_podcast_pro_adOne_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-addOne');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section_addone', 'vw_podcast_pro_adOne_shortcode');

function vw_podcast_pro_addTwo_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-addTwo');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section_two', 'vw_podcast_pro_addTwo_shortcode');


function vw_podcast_pro_addThree_shortcode() {
    ob_start();
    get_template_part('template-parts/home/section-addThree');
    $output = ob_get_clean();
    return $output;
}
add_shortcode('section_three', 'vw_podcast_pro_addThree_shortcode');

function custom_main_sidebar_shortcode() {
    ob_start();
    ?>
    <nav class="main-sidebar">
        <span class="mobile-open">
            <i class="fas fa-chevron-left d-none"></i>
            <i class="fas fa-chevron-right"></i>
        </span>
        <div class="inner-slidbar">
            <?php dynamic_sidebar('main-sidebar'); ?>
        </div>
    </nav>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_sidebar', 'custom_main_sidebar_shortcode');

?>