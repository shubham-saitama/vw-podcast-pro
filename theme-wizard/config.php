<?php
/**
 * Settings for theme wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
// Load the Whizzie class and other dependencies
require trailingslashit( WHIZZIE_DIR ) . 'whizzie.php';
// Gets the theme object
$current_theme = wp_get_theme();
$theme_title = $current_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$vw_podcast_pro_config['page_slug'] 	= 'vw-podcast-pro';
$vw_podcast_pro_config['page_title']	= 'Get Started';

// You can remove elements here as required
// Don't rename the IDs - nothing will break but your changes won't get carried through
$vw_podcast_pro_config['steps'] = array( 
	'intro' => array(
		'id'			=> 'intro', // ID for section - don't rename
		'title'			=> __( 'Welcome to ', 'vw-podcast-pro' ) . $theme_title, // Section title
		'icon'			=> 'dashboard', // Uses Dashicons
		'button_text'	=> __( 'Start Now', 'vw-podcast-pro' ), // Button text
		'can_skip'		=> false, // Show a skip button?
		'icon_url'      => get_template_directory_uri().'/theme-wizard/assets/images/Icons-01.svg'
	),
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Plugins', 'vw-podcast-pro' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'vw-podcast-pro' ),
		'can_skip'		=> true,
		'icon_url'      => get_template_directory_uri().'/theme-wizard/assets/images/Icons-02.svg'
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Demo Importer', 'vw-podcast-pro' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text_one'	=> __( 'Click On The Image To Import Customizer Demo', 'vw-podcast-pro' ),
		'button_text_two'	=> __( 'Click On The Image To Import Gutenberg Block Demo', 'vw-podcast-pro' ),
		'can_skip'		=> true,
		'icon_url'      => get_template_directory_uri().'/theme-wizard/assets/images/Icons-03.svg'
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', 'vw-podcast-pro' ),
		'icon'			=> 'yes',
		'icon_url'      => get_template_directory_uri().'/theme-wizard/assets/images/Icons-04.svg'
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'ThemeWhizzie' ) ) {
	$ThemeWhizzie = new ThemeWhizzie( $vw_podcast_pro_config );
}