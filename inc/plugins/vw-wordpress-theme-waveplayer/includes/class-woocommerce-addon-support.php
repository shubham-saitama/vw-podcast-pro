<?php
/**
 * WooCommerce_Addon_Support class
 *
 * @package VwWavePlayer/WooCommerce_Addon_Support
 */

namespace PerfectPeach\VwWavePlayer;

use Barn2\Plugin\WC_Product_Table\Util\Settings as WPT_Settings;
use WC_PB_DB;

defined( 'ABSPATH' ) || exit;

/**
 * The WooCommerce_Addon_Support class add support to external WooCommerce addons
 *
 * @package VwWavePlayer/WooCommerce_Addon_Support
 */
class WooCommerce_Addon_Support {

	/**
	 * Register the callback functions activating this class
	 *
	 * @since 3.0.0
	 */
	public static function load() {
		add_filter( 'wc_product_table_custom_table_data_waveplayer', array( __CLASS__, 'wc_product_table_custom_column' ), 10, 3 );
		add_filter( 'wc_product_table_shortcode_output', array( __CLASS__, 'wc_product_table_shortcode_output' ), 10 );
		add_filter( 'vwwaveplayer_wc_product_table_skin', array( __CLASS__, 'wc_product_table_default_skin' ), 10 );

		add_filter( 'woocommerce_get_settings_product-table', array( __CLASS__, 'wc_product_table_settings' ) );

		add_action( 'wpuf_add_post_after_insert', array( __CLASS__, 'wpuf_get_preview_files' ) );
		add_action( 'wpuf_edit_post_after_update', array( __CLASS__, 'wpuf_get_preview_files' ) );

		// Support for WooCommerce Quick View Pro.
		$player_position         = WooCommerce::product_player_position();
		$product_player_priority = array(
			'before'         => 4,
			'after'          => 6,
			'before_rating'  => 9,
			'after_price'    => 11,
			'before_excerpt' => 19,
			'after_excerpt'  => 21,
			'before_meta'    => 39,
			'after_meta'     => 41,
		);

		if ( 'after_summary' === $player_position ) {
			add_action( 'wc_quick_view_pro_quick_view_after_product_details', array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ) );
		} else {
			add_action( 'wc_quick_view_pro_quick_view_product_details', array( 'PerfectPeach\VwWavePlayer\WooCommerce', 'print_product_player' ), $product_player_priority[ $player_position ] );
		}

		// Support for WooBeWoo Product Table.
		add_filter( 'wtbp_getEnabledColumns', array( __CLASS__, 'wtbp_get_enabled_columns' ) );
		add_filter( 'wtbp_getColumnContent', array( __CLASS__, 'wtbp_get_column_content' ), 10, 2 );
		add_filter( 'wtbp_addFullColumnList', array( __CLASS__, 'wtbp_add_full_column_list' ) );

		// Support for WooCommerce Product Bundles
		add_filter( 'get_post_metadata', array( __CLASS__, 'get_bundle_preview_files' ), 100, 4 );
	}

	/**
	 * Create a custom data column to support the Barn2 WooCommerce Product Table plugin
	 *
	 * @since  3.0.0
	 * @param  Abstract_Product_Table_Data $data_obj The table data object.
	 * @param  WC_Product                  $product  The product object.
	 * @param  array                       $args     An array of parameters to create the custom column.
	 * @return Abstract_Product_Table_Data           The custom column object
	 */
	public static function wc_product_table_custom_column( $data_obj, $product, $args ) { //phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundBeforeLastUsed, Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed,
		require_once 'class-wpt-product-data-vwwaveplayer.php';

		return new Product_Data_WavePlayer( $product );
	}

	/**
	 * Prefix the custom column shortcode output with the skin style
	 *
	 * @since  3.0.0
	 * @param  string $output The HTML output of the custom column shortcode.
	 * @return string
	 */
	public static function wc_product_table_shortcode_output( $output ) {
		if ( false === strpos( $output, 'col-vwwaveplayer' ) ) {
			return $output;
		}

		static $used_skins = array();

		$skin  = self::wc_product_table_default_skin( 'play_n_wave' );
		$style = '';

		if ( ! in_array( $skin, $used_skins, true ) ) {
			$style = '<style type="text/css">' . Renderer::get_skin_style( $skin ) . '</style>';
			$used_skins[] = $skin;
		}

		return $style . $output;
	}

	/**
	 * Add the VwWavePlayer skin to the Product Table Settings
	 *
	 * @since  3.0.7
	 * @param  array  $settings        The settings of the WooCommerce Products page.
	 * @param  string $current_section The current section of the WooCommerce Products page.
	 * @return array                   The filtered settings
	 */
	public static function wc_product_table_settings( $settings ) {
		$skins        = Renderer::get_skins();
		$skin_options = array();
		foreach ( $skins as $skin ) {
			$skin_options[ $skin['skin'] ] = $skin['name'];
		}
		$settings[] = array(
			'title' => __( 'VwWavePlayer', 'vwwaveplayer' ),
			'type'  => 'title',
			'id'    => 'product_table_settings_waveplayer',
			'desc'  => __( 'Once a preview files is added to each product, VwWavePlayer can automatically render a player for each row of the table by simply adding a `vwwaveplayer` column to the table columns definition.', 'vwwaveplayer' ),
		);
		$settings[] = array(
			'title'   => __( 'Default skin', 'vwwaveplayer' ),
			'type'    => 'select',
			'id'      => WPT_Settings::OPTION_TABLE_STYLING . '[vwwaveplayer_skin]',
			'options' => $skin_options,
			'desc'    => __( 'The skin used for the VwWavePlayer instance.', 'vwwaveplayer' ),
			'default' => 'play_n_wave',
		);
		$settings[] = array(
			'title'   => __( 'Default size', 'vwwaveplayer' ),
			'type'    => 'select',
			'id'      => WPT_Settings::OPTION_TABLE_STYLING . '[vwwaveplayer_size]',
			'options' => array(
				'lg' => __( 'Large', 'vwwaveplayer' ),
				'md' => __( 'Medium', 'vwwaveplayer' ),
				'sm' => __( 'Small', 'vwwaveplayer' ),
				'xs' => __( 'Extra small', 'vwwaveplayer' ),
			),
			'desc'    => __( 'The skin used for the VwWavePlayer instance.', 'vwwaveplayer' ),
			'default' => 'play_n_wave',
		);
		$settings[] = array(
			'type' => 'sectionend',
			'id'   => 'product_table_settings_waveplayer',
		);
		return $settings;
	}

	/**
	 * Applies the default skin as defined in the settings
	 *
	 * @since 3.0.7
	 * @return string
	 */
	public static function wc_product_table_default_skin() {
		$skins         = Renderer::get_skins();
		$style_options = WPT_Settings::get_setting_table_styling();
		$skin          = vwwaveplayer()->get_option( 'skin' );

		if ( isset( $style_options['vwwaveplayer_skin'] ) && in_array( $style_options['vwwaveplayer_skin'], array_keys( $skins ), true ) ) {
			$skin = $style_options['vwwaveplayer_skin'];
		}

		return $skin;
	}

	/**
	 * Applies the default size as defined in the settings
	 *
	 * @since 3.3.0
	 * @return string
	 */
	public static function wc_product_table_default_size() {
		$style_options = WPT_Settings::get_setting_table_styling();
		$size          = vwwaveplayer()->get_option( 'size' );

		if ( isset( $style_options['vwwaveplayer_size'] ) && in_array( $style_options['vwwaveplayer_size'], array( 'lg', 'md', 'sm', 'xs' ), true ) ) {
			$size = $style_options['vwwaveplayer_size'];
		}

		return $size;
	}

	/**
	 * Adds support to WP Frontend Uploader through the use of the '_wpuf_preview_files' metadata
	 *
	 * @since  3.0.0
	 * @param  string $post_id The ID of the post object currently being edited.
	 */
	public static function wpuf_get_preview_files( $post_id ) {
		if ( isset( $_POST['_wpuf_preview_files'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Missing

			$files              = $_POST['_wpuf_preview_files']; //phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			$wpuf_preview_files = array();

			foreach ( $files as $file_id ) {
				$file_name                              = get_post( $file_id )->post_title;
				$file_url                               = wp_get_attachment_url( $file_id );
				$wpuf_preview_files[ md5( $file_url ) ] = array(
					'name' => $file_name,
					'file' => $file_url,
				);
			}
			update_post_meta( $post_id, '_preview_files', $wpuf_preview_files );
		}
		if ( isset( $_POST['wpuf_files']['_preview_files'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Missing

			$files              = $_POST['wpuf_files']['_preview_files'];  //phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			$wpuf_preview_files = array();
			foreach ( $files as $file ) {
				$file_name                                 = get_post( $file_id )->post_title;
				$file_url                                  = wp_get_attachment_url( $file );
				$_wc_preview_file_urls[ md5( $file_url ) ] = array(
					'name' => $file_name,
					'file' => $file_url,
				);
			}
			update_post_meta( $post_id, '_preview_files', $_wc_preview_file_urls );
		}
	}


	/**
	 * Add VwWavePlayer to the enabled columns of the WooBeWoo Product Table
	 *
	 * @since  3.0.10
	 * @param  array $columns The columns that can be added to the product table.
	 * @return array          The column array with VwWavePlayer added
	 */
	public static function wtbp_get_enabled_columns( $columns ) {
		$columns[] = 'wtbp_waveplayer';
		return $columns;
	}

	/**
	 * Generate the player for the current row of the WooBeWoo Product Table
	 *
	 * @since  3.0.10
	 * @param  array $data The product data being collected row by row.
	 * @param  array $args The settings of the current table.
	 * @return array       The filtered data with the product player markup added
	 */
	public static function wtbp_get_column_content( $data, $args ) {
		$atts = array(
			/**
			 * Filters the skin used to render the player inside the WooBeWoo Product Table
			 *
			 * @since 3.0.10
			 * @param string $skin The name of the skin
			 */
			'skin' => apply_filters( 'vwwaveplayer_wtbp_player_skin', 'play_n_wave' ),
			/**
			 * Filters the size used to render the player inside the WooBeWoo Product Table
			 *
			 * @since 3.0.7
			 * @param string $size The size of the player (lg, md, sm, xs).
			 */
			'size' => apply_filters( 'vwwaveplayer_wtbp_player_size', 'sm' ),
		);

		$data['wtbp_waveplayer'] = WooCommerce::product_player( $args['product'], $atts );
		return $data;
	}

	/**
	 * Add VwWavePlayer to the field select box of the WooBeWoo Product Table
	 *
	 * @since  3.0.10
	 * @param  array $list The list of available fields.
	 * @return array       The list of fields with VwWavePlayer added
	 */
	public static function wtbp_add_full_column_list( $list ) {
		$list[] = array(
			'slug'       => 'wtbp_waveplayer',
			'name'       => 'VwWavePlayer',
			'is_enabled' => true,
			'is_default' => 0,
			'sub'        => 0,
			'class'      => 'wtbp_waveplayer',
		);
		return $list;
	}

	/**
	 * Return the preview files of a bundle product
	 *
	 * @param  mixed $metadata  The metadata value to be filtered.
	 * @param  mixed $object_id The ID of the object metadata is for.
	 * @param  mixed $meta_key  The meta key.
	 * @param  mixed $single    Whether to return a single value.
	 * @return array            The filtered metadata value.
	 */
	public static function get_bundle_preview_files( $metadata, $object_id, $meta_key, $single ) {
		if ( $meta_key !== '_preview_files' ) {
			return $metadata;
		}

		if ( class_exists( 'WC_PB_DB' ) ) {
			$bundled_items = WC_PB_DB::query_bundled_items(
				array(
					'bundle_id' => $object_id,
					'return'    => 'ids',
				)
			);

			if ( ! empty( $bundle_items ) ) {
				if ( ! $single && is_array( $metadata ) ) {
					$metadata = current( $metadata );
				}

				if ( $metadata && ! is_array( $metadata) ) {
					$metadata = explode( ',', $metadata );
				}

				foreach ( $bundled_items as $bundled_item ) {
					$preview_files = WooCommerce::get_preview_files( $bundled_item );

					if ( ! empty( $preview_files ) ) {
						$metadata = array_merge( $metadata, $preview_files );
					}
				}

				if ( ! $single ) {
					$metadata = array( $metadata );
				}
			}
		}

		return $metadata;
	}
}

WooCommerce_Addon_Support::load();
