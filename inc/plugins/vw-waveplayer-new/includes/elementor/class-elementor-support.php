<?php
/**
 * Elementor_Support class
 *
 * @package VwWavePlayer/Elementor
 */

namespace PerfectPeach\VwWavePlayer;

use \Elementor\Plugin as Elementor;

defined( 'ABSPATH' ) || exit;

/**
 * Add support for the Elementor editor
 *
 * @package VwWavePlayer/Elementor
 */
class Elementor_Support {

	const VERSION                   = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION       = '7.0';

	/**
	 * Initialize the Elementor support callback functions
	 *
	 * @since 3.0.0
	 */
	public static function init() {
		add_filter( 'elementor/editor/localize_settings', array( __CLASS__, 'localize_settings' ) );
		add_action( 'elementor/widgets/register', array( __CLASS__, 'register_widget' ) );
		add_action( 'elementor/controls/register', array( __CLASS__, 'register_controls' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
	}

	/**
	 * Initialize the VwWavePlayer widget in the Elementor editor
	 *
	 * @since 3.0.0
	 */
	public static function register_widget( $widgets_manager ) {
		require_once __DIR__ . '/class-elementor-widget.php';

		$widgets_manager->register( new Elementor_Widget() );
	}

	/**
	 * Initialize the custom controls for the VwWavePlayer widget
	 *
	 * @since 3.0.0
	 */
	public static function register_controls( $controls_manager) {
		require_once __DIR__ . '/class-elementor-playlist-control.php';
		$controls_manager->register( new Elementor_Playlist_Control() );

		require_once __DIR__ . '/class-elementor-color-tuplet-control.php';
		$controls_manager->register( new Elementor_Color_Tuplet_Control() );
	}

	/**
	 * Enqueue the styles and scripts required by the VwWavePlayer widget
	 *
	 * @since 3.0.0
	 */
	public static function enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_style( 'vwwaveplayer-elementor-playlist', plugins_url( "/assets/css/elementor/playlist-control$suffix.css", dirname( __DIR__ ) ), array(), vwwaveplayer()->get_version() );
		wp_enqueue_style( 'vwwaveplayer-elementor-playlist' );

		$deps = array( 'wp-util', 'lodash', 'mce-view', 'media-views', 'wp-i18n' );
		wp_register_script( 'vwwaveplayer', plugins_url( '/assets/js/vwwaveplayer.js', dirname( __DIR__ ) ), $deps, vwwaveplayer()->get_version(), true );
		if ( function_exists( 'wp_add_inline_script' ) ) {
			wp_add_inline_script( 'vwwaveplayer', vwwaveplayer()->script_vars() );
		}

		wp_register_script( 'vwwaveplayer_media_waveplayer', plugins_url( "/assets/js/media-vwwaveplayer$suffix.js", dirname( __DIR__ ) ), $deps, vwwaveplayer()->get_version(), true );

		wp_register_script( 'vwwaveplayer-elementor-controls', plugins_url( "/assets/js/elementor/vwwaveplayer-controls$suffix.js", dirname( __DIR__ ) ), array( 'jquery' ), vwwaveplayer()->get_version(), true );
	}

	/**
	 * Add the relevant strings to the Elementor configuration
	 *
	 * @since  3.0.0
	 * @param  array $config The original array.
	 * @return array         The modified array.
	 */
	public static function localize_settings( $config ) {
		// translators: %s represents the number of selected tracks.
		$config['i18n']['playlist_tracks_selected']       = esc_html__( '%s Tracks Selected', 'vwwaveplayer' );
		$config['i18n']['playlist_no_tracks_selected']    = esc_html__( 'No Tracks Selected', 'vwwaveplayer' );
		$config['i18n']['delete_playlist']                = esc_html__( 'Reset VwWavePlayer Playlist', 'vwwaveplayer' );
		$config['i18n']['dialog_confirm_playlist_delete'] = esc_html__( 'Are you sure you want to reset the playlist for this instance?', 'vwwaveplayer' );
		$config['i18n']['insert_tracks']                  = esc_html__( 'Insert Tracks', 'vwwaveplayer' );
		return $config;
	}

}

Elementor_Support::init();
