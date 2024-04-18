<?php
/**
 * WooCommerce_Theme_Support class
 *
 * @package VwWavePlayer/WooCommerce_Theme_Support
 */

namespace PerfectPeach\VwWavePlayer;

defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce_Theme_Support class
 *
 * The WooCommerce class handles the integration between VwWavePlayer and WooCommerce
 *
 * @since 3.0.0
 * @package VwWavePlayer/WooCommerce_Theme_Support
 */
class WooCommerce_Theme_Support {

	/**
	 * Register the callback functions activating this class
	 *
	 * @since 3.0.0
	 */
	public static function load() {
		add_action( 'vwwaveplayer_single_product_player_callback', array( __CLASS__, 'register_single_product_player_hooks' ), 10 );
		add_action( 'template_redirect', array( __CLASS__, 'register_shop_product_player_hooks' ), 20 );
		add_filter( 'vwwaveplayer_player_args', array( __CLASS__, 'filter_player_args' ), 10, 2 );
		add_filter( 'vwwaveplayer_cart_player_args', array( __CLASS__, 'cart_player_args' ), 10, 2 );
		add_filter( 'vwwaveplayer_mini_cart_player_args', array( __CLASS__, 'mini_cart_player_args' ), 10, 2 );
		add_filter( 'vwwaveplayer_shop_hooks', array( __CLASS__, 'shop_hooks' ) );
		add_filter( 'vwwaveplayer_is_single_product', array( __CLASS__, 'is_single_product' ) );
	}

	/**
	 * Register the callback functions responsible for adding a player instance
	 * in the single product page.
	 * This is only required for themes that malfunction with the default methods
	 *
	 * @since 3.0.0
	 */
	public static function register_single_product_player_hooks() {

		$player_position                 = WooCommerce::product_player_position();
		$default_product_player_priority = WooCommerce::get_product_player_priority( $player_position );
		$active_theme_name               = WooCommerce::get_active_theme_name();

		switch ( $active_theme_name ) {
			case 'thegem':
				$product_player_priority = array(
					'before'         => 9,
					'after'          => 11,
					'before_rating'  => 19,
					'after_price'    => 31,
					'before_excerpt' => 34,
					'after_excerpt'  => 36,
					'before_meta'    => 44,
					'after_meta'     => 46,
				);
				add_action( 'thegem_woocommerce_single_product_right', array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ), $product_player_priority[ $player_position ] );

				$product_player_priority = array(
					'before'         => 9,
					'after'          => 11,
					'before_rating'  => 19,
					'after_price'    => 31,
					'before_excerpt' => 34,
					'after_excerpt'  => 36,
					'before_meta'    => 54,
					'after_meta'     => 56,
				);
				add_action( 'thegem_woocommerce_single_product_quick_view_right', array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ), $product_player_priority[ $player_position ] );
				break;

			case 'oceanwp':
				remove_action( 'woocommerce_single_product_summary', array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ), $default_product_player_priority );
				$product_player_action = array(
					'before'         => 'ocean_before_single_product_title',
					'after'          => 'ocean_after_single_product_title',
					'before_rating'  => 'ocean_before_single_product_rating',
					'after_price'    => 'ocean_after_single_product_price',
					'before_excerpt' => 'ocean_before_single_product_excerpt',
					'after_excerpt'  => 'ocean_after_single_product_excerpt',
					'before_meta'    => 'ocean_before_single_product_meta',
					'after_meta'     => 'ocean_after_single_product_meta',
				);
				add_action( $product_player_action[ $player_position ], array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ) );
				break;
		}
	}

	public static function shop_hooks( $hooks ) {
		$active_theme_name = WooCommerce::get_active_theme_name();

		switch ( $active_theme_name ) {
			case 'oceanwp':
				$hooks = array(
					'before_item'   => array(
						'name'     => 'ocean_before_archive_product_item',
						'priority' => 10,
					),
					'before'        => array(
						'name'     => 'ocean_before_archive_product_title',
						'priority' => 10,
					),
					'after'         => array(
						'name'     => 'ocean_after_archive_product_title',
						'priority' => 10,
					),
					'before_price'  => array(
						'name'     => 'ocean_before_archive_product_price',
						'priority' => 10,
					),
					'before_button' => array(
						'name'     => 'woocommerce_after_shop_loop_item',
						'priority' => 10,
					),
					'after_item'    => array(
						'name'     => 'ocean_after_archive_product_item',
						'priority' => 10,
					),
				);
				break;
		}

		return $hooks;
	}

	/**
	 * Register the callback functions responsible for adding a player instance
	 * in the single product page.
	 * This is only required for themes that malfunction with the default methods
	 *
	 * @since 3.0.0
	 */
	public static function register_shop_product_player_hooks() {
		if ( WooCommerce::is_single_product() ) {
			return;
		}

		$position = WooCommerce::shop_player_position();

		/**
		 * REHub theme support
		 *
		 * @since 3.0.4
		 */
		add_filter( 'rh_thumb_output', array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'product_player_html' ) );

		/**
		 * OceanWP theme support
		 *
		 * @since 3.0.6
		 */
		if ( class_exists( 'OceanWP_WooCommerce_Config' ) ) {
			if ( WooCommerce::shall_remove_shop_thumbnail() ) {
				remove_action( "woocommerce_{$position}_shop_loop_item_title", array( 'OceanWP_WooCommerce_Config', 'loop_product_thumbnail' ), 10 );
				add_filter(
					'ocean_woo_product_elements_positioning',
					function( $sections ) {
						return array_diff( $sections, array( 'image' ) );
					}
				);
			}
			if ( 'none' !== $position ) {
				remove_action( "woocommerce_{$position}_shop_loop_item_title", array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ), 10 );
				add_action( "ocean_{$position}_archive_product_title", array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ), 10 );
				add_action( 'ocean_woo_quick_view_product_content', array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ), 10 );

			}
		}
	}

	public static function is_single_product( $is_single_product ) {
		$active_theme_name = WooCommerce::get_active_theme_name();

		switch ( $active_theme_name ) {
			case 'shopkeeper':
				if ( did_action( 'woocommerce_before_single_product_summary' ) === did_action( 'woocommerce_after_single_product_summary_data_tabs' ) ) {
					$is_single_product = false;
				}
				break;
		}

		return $is_single_product;
	}

	public static function filter_player_args( $args, $product ) {
		$active_theme_name = WooCommerce::get_active_theme_name();

		switch ( $active_theme_name ) {
			case 'betheme':
				if ( did_action( 'woocommerce_before_single_product' ) > did_action( 'woocommerce_before_single_product_summary' ) ) {
					$args['skin']  = 'mini_thumb';
					$args['size']  = 'sm';
					$args['class'] = 'vwwvpl-fill-available';
				}

				break;

			case 'storefront':
				if ( did_action( 'storefront_after_footer' ) > 0 ) {
					$args['skin'] = 'mini_thumb';
					$args['size'] = 'xs';
					$args['css']  = 'max-width:3.706325903em;margin:0 1.41575em 0 0;padding:3px;border:1px solid rgba(0,0,0,.1);border-radius:3px;border:1px solid #ddd;';
				}

				if ( did_action( 'storefront_before_single_product_pagination' ) > did_action( 'storefront_after_single_product_pagination' ) ) {
					$args['skin'] = 'mini_thumb';
					$args['size'] = 'md';

					if ( did_action( 'storefront_before_single_product_pagination_previous' ) > did_action( 'storefront_after_single_product_pagination_previous' ) ) {
						$args['css'] = 'margin:0 0 0 1.41575em;';
					} else {
						$args['css'] = 'margin:0 1.41575em 0 0;';
					}
				}

				break;

			case 'shopkeeper':
				if ( did_action( 'woocommerce_before_single_product_summary_product_images' ) > did_action( 'woocommerce_before_single_product_summary' ) ) {
					$args = false;
				}
		}

		return $args;
	}

	public static function cart_player_args( $args, $product ) {
		$active_theme_name = WooCommerce::get_active_theme_name();

		$theme_args = array(
			'skin' => 'mini_thumb',
			'size' => 'sm',
		);

		switch ( $active_theme_name ) {
			case 'slug-of-the-theme-here':
				$theme_args = array(
					'skin' => 'mini_thumb',
					'size' => 'md',
				);
				break;
		}

		return array_merge( $args, $theme_args );
	}

	public static function mini_cart_player_args( $args, $product ) {
		$active_theme_name = WooCommerce::get_active_theme_name();

		$theme_args = array(
			'skin' => 'mini_thumb',
			'size' => 'xs',
			'css'  => 'float:right;margin-left:.25em;',
		);

		switch ($active_theme_name ) {
			case 'storefront':
				$theme_args['css'] = 'float:right;margin-left:.25em;';
				break;
		}

		return array_merge( $args, $theme_args );
	}
}

WooCommerce_Theme_Support::load();
