<?php
/**
 * WooCommerce class
 *
 * @package VwWavePlayer/WooCommerce
 */

namespace PerfectPeach\VwWavePlayer;

use \WP_Query as WP_Query;
use \WC_Admin_Meta_Boxes as WC_Admin_Meta_Boxes;

defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce class
 *
 * The WooCommerce class handles the integration between VwWavePlayer and WooCommerce
 *
 * @since 3.0.0
 * @package VwWavePlayer
 */
class WooCommerce {

	/**
	 * Loads the WooCommerce integration
	 */
	public static function load() {
		self::addons_support();
		add_action( 'init', array( __CLASS__, 'register_hooks' ) );
	}

	/**
	 * Get the default action priority for the single product page player
	 *
	 * @since  3.0.0
	 * @return array
	 */
	public static function get_product_player_priority( $position ) {
		$priorities = array(
			'before'         => 4,
			'after'          => 6,
			'before_rating'  => 9,
			'after_price'    => 11,
			'before_excerpt' => 19,
			'after_excerpt'  => 21,
			'before_meta'    => 39,
			'after_meta'     => 41,
		);

		return $priorities[ $position ] ?? 10;
	}

	/**
	 * Registers all the hooks to integrate VwWavePlayer into WooCommerce
	 *
	 * @since 3.0.0
	 */
	public static function register_hooks() {

		$product_player_position = self::product_player_position();

		if ( 'none' !== $product_player_position ) {

			if ( 'after_summary' === $product_player_position ) {
				add_action( 'woocommerce_after_single_product_summary', array( __CLASS__, 'print_product_player' ), 5 );
			} else {
				add_action( 'woocommerce_single_product_summary', array( __CLASS__, 'print_product_player' ), self::get_product_player_priority( $product_player_position ) );
			}

			add_action( 'woocommerce_single_product_lightbox_summary', array( __CLASS__, 'print_product_player' ), 1 );
			add_filter( 'woocommerce_blocks_product_grid_item_html', array( __CLASS__, 'blocks_product_grid_item_html' ), 10, 3 );
			do_action( 'vwwaveplayer_single_product_player_callback' );
		}

		if ( filter_var( vwwaveplayer()->get_option( 'woocommerce_replace_product_image' ), FILTER_VALIDATE_BOOLEAN ) ) {
			add_filter( 'woocommerce_product_get_image_id', array( __CLASS__, 'product_get_image_id' ), 10, 2 );
			add_filter( 'has_post_thumbnail', array( __CLASS__, 'has_post_thumbnail' ), 10, 3 );
			add_filter( 'post_thumbnail_id', array( __CLASS__, 'post_thumbnail_id' ), 10, 2 );
		}

		$shop_page_hook = 'template_redirect';
		if ( vwwaveplayer()->is_ajax() ) {
			$shop_page_hook = 'wp_loaded';
		}
		add_action( $shop_page_hook, array( __CLASS__, 'shop_page_hooks' ), 10 );

		add_action( 'woocommerce_product_options_advanced', array( __CLASS__, 'add_preview_files' ) );
		add_action( 'woocommerce_process_product_meta', array( __CLASS__, 'save_preview_files' ) );
		add_action( 'woocommerce_process_product_meta', array( __CLASS__, 'save_music_type' ) );

		add_action( 'wp_ajax_vwwaveplayer_create_product', array( __CLASS__, 'ajax_create_product' ) );

		add_filter( 'vwwaveplayer_add_track_info', array( __CLASS__, 'add_product_info_to_track' ), 10, 3 );
		add_filter( 'vwwaveplayer_add_external_track_info', array( __CLASS__, 'add_product_info_to_external_track' ), 10, 34 );

		add_filter( 'woocommerce_post_class', array( __CLASS__, 'woocommerce_post_class' ), 10, 2 );

		add_filter( 'woocommerce_product_export_row_data', array( __CLASS__, 'export_preview_files' ), 10, 3 );
		add_filter( 'woocommerce_product_importer_pre_expand_data', array( __CLASS__, 'import_preview_files' ) );
		add_filter( 'woocommerce_csv_product_import_mapping_options', array( __CLASS__, 'import_mapping_options' ), 10, 2 );
		add_filter( 'woocommerce_csv_product_import_mapping_special_columns', array( __CLASS__, 'import_mapping_special_columns' ) );

		add_action( 'elementor/frontend/widget/before_render', array( __CLASS__, 'toggle_is_elementor_single_product_image' ) );
		add_action( 'elementor/frontend/widget/after_render', array( __CLASS__, 'toggle_is_elementor_single_product_image' ) );

		add_action( 'woocommerce_before_cart', array( __CLASS__, 'maybe_add_style_before_cart' ) );
		add_action( 'woocommerce_before_mini_cart', array( __CLASS__, 'maybe_add_style_before_mini_cart' ) );

		add_filter( 'vwwaveplayer_cached_tracks', array( __CLASS__, 'update_cached_tracks' ) );
	}

	/**
	 * Get the position for the player on the shop page
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public static function shop_player_position() {
		return vwwaveplayer()->get_option( 'woocommerce_shop_player' );
	}

	/**
	 * Whether the product thumbnail should be removed on the shop page
	 *
	 * @since 3.0.0
	 * @return boolean
	 */
	public static function shall_remove_shop_thumbnail() {
		return self::shop_player_position() === 'replace';
	}

	/**
	 * Whether the product thumbnail should be replaced with a player instance
	 *
	 * @since 3.2.2
	 * @return boolean
	 */
	public static function shall_replace_shop_thumbnail() {
		global $product;

		$replace_thumbnail = true;

		if ( ! self::shall_remove_shop_thumbnail() ) {
			$replace_thumbnail = false;
		}

		if ( self::is_single_product() ) {
			$replace_thumbnail = false;
		}

		return apply_filters( 'vwwaveplayer_shall_replace_shop_thumbnail', $replace_thumbnail, $product );
	}

	/**
	 * Get the position for the player on the single product page
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public static function product_player_position() {
		return vwwaveplayer()->get_option( 'woocommerce_product_player' );
	}

	/**
	 * Register the action and filter callback functions
	 * responsible for replacing the product thumbnail
	 * with an instance of the player on the shop page
	 *
	 * @since 3.0.0
	 */
	public static function shop_page_hooks() {
		if ( self::is_single_product() ) {
			return;
		}

		$shop_player = self::shop_player_position();

		if ( 'none' !== $shop_player ) {
			if ( 'replace' === $shop_player ) {
				add_filter( 'post_thumbnail_html', array( __CLASS__, 'product_player_html' ), 20, 2 );
				add_filter( 'wp_get_attachment_image', array( __CLASS__, 'product_player_html' ) );
				add_filter( 'woocommerce_single_product_image_html', array( __CLASS__, 'product_player_html' ), 10, 2 );
				add_filter( 'woocommerce_single_product_image_thumbnail_html', array( __CLASS__, 'product_player_html' ), 10, 2 );
				add_filter( 'woocommerce_product_get_image', array( __CLASS__, 'product_player_html' ), 10, 2 );
				do_action( 'vwwaveplayer_shop_product_player_callback' );
			} else {
				$hooks = apply_filters(
					'vwwaveplayer_shop_hooks',
					array(
						'before_item'   => array(
							'name'     => 'woocommerce_before_shop_loop_item',
							'priority' => 9,
						),
						'before'        => array(
							'name'     => 'woocommerce_shop_loop_item_title',
							'priority' => 9,
						),
						'after'         => array(
							'name'     => 'woocommerce_shop_loop_item_title',
							'priority' => 11,
						),
						'before_price'  => array(
							'name'     => 'woocommerce_after_shop_loop_item_title',
							'priority' => 9,
						),
						'before_button' => array(
							'name'     => 'woocommerce_after_shop_loop_item',
							'priority' => 9,
						),
						'after_item'    => array(
							'name'     => 'woocommerce_after_shop_loop_item',
							'priority' => 999,
						),
					)
				);

				if ( ! in_array( $shop_player, array_keys( $hooks ), true ) ) {
					$shop_player = 'after';
				}

				add_action( $hooks[ $shop_player ]['name'], array( __CLASS__, 'print_product_player' ), $hooks[ $shop_player ]['priority'] );
			}
		}
	}

	/**
	 * Get the active theme name
	 *
	 * @since  3.0.10
	 * @return string
	 */
	public static function get_active_theme_name() {
		$name  = '';
		$theme = wp_get_theme();

		if ( $theme ) {
			$name = $theme->get_template();
		}

		return $name;
	}

	/**
	 * Add support for WooCommerce themes and addons
	 *
	 * @since 3.0.0
	 */
	public static function addons_support() {
		require_once 'class-woocommerce-addon-support.php';
		require_once 'class-woocommerce-theme-support.php';
	}

	/**
	 * Filter the result of the has_post_thumbnail default function
	 *
	 * @since 3.0.6
	 * @param string|int $has_thumbnail The ID of the current featured image.
	 * @param WP_Post    $_post         The post object of the current post in the loop.
	 * @param string|int $thumbnail_id  The ID of the featured image.
	 * @return int
	 */
	public static function has_post_thumbnail( $has_thumbnail, $_post, $thumbnail_id ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
		global $post;
		if ( ! $_post ) {
			$_post = $post;
		}
		if ( 'product' !== get_post_type( $_post ) ) {
			return $has_thumbnail;
		}
		$post_id = is_numeric( $_post ) ? $_post : $post->ID;
		$product = wc_get_product( $post_id );
		if ( $product && self::get_preview_files_thumbnail_id( $product->get_id() ) ) {
			$has_thumbnail = true;
		}
		return $has_thumbnail;
	}

	/**
	 * Get the ID of the featured image of a product
	 * or, if any, the first featured image
	 * of the preview files associated with it
	 *
	 * @since 3.0.0
	 * @param string|int $image_id The ID of the current featured image.
	 * @param WC_Product $product  The product to retrieve a featured image for.
	 * @return int
	 */
	public static function product_get_image_id( $image_id, $product ) {
		if ( ! $image_id || (string) $image_id !== get_option( 'woocommerce_placeholder_image', '0' ) ) {
			$track_image_id = self::get_preview_files_thumbnail_id( $product->get_id() );
			if ( $track_image_id ) {
				return (int) $track_image_id;
			}
		}
		return (int) $image_id;
	}

	/**
	 * Get the ID of the featured image of a product
	 * or, if any, the first featured image
	 * of the preview files associated with it
	 *
	 * @since  3.0.0
	 * @param  string       $html               The img element of the current featured image.
	 * @param  int          $post_id            The ID of the current $post object.
	 * @param  int          $post_thumbnail_id  The ID of the current featured image.
	 * @param  string|array $size               The requested size.
	 * @param  array        $attr               An array of attributes for the img element.
	 * @return string       The modified img element
	 */
	public static function post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		$product = wc_get_product( $post_id );

		if ( ! $product ) {
			return $html;
		}

		$post_thumbnail_id = self::product_get_image_id( $post_thumbnail_id, $product );

		if ( is_numeric( $post_thumbnail_id ) ) {
			$html = wp_get_attachment_image( $post_thumbnail_id, $size, false, $attr );
		}

		return $html;
	}

	public static function post_thumbnail_id( $thumbnail_id, $post ) {
		if ( ! is_a( $post, 'WP_Post' ) || $post->post_type !== 'product' ) {
			return $thumbnail_id;
		}

		return self::get_preview_files_thumbnail_id( $post->ID );
	}

	/**
	 * Get the ID of the featured image
	 * of the first preview file associated with the product
	 *
	 * @since 3.0.0
	 * @param string $product_id The ID of the product.
	 * @return int|boolean
	 */
	public static function get_preview_files_thumbnail_id( $product_id ) {

		$preview_files = self::get_preview_files( $product_id );
		if ( isset( $preview_files['ids'] ) ) {
			foreach ( $preview_files['ids'] as $id ) {
				// we do not use `get_post_thumbnail_id` here as to avoid an infinite loop.
				$thumbnail_id = (int) get_post_meta( $id, '_thumbnail_id', true );

				if ( $thumbnail_id ) {
					return $thumbnail_id;
				}
			}
		}
		return false;
	}


	/**
	 * HTML markup allowing to add preview files to the product
	 *
	 * @since 3.0.0
	 */
	public static function add_preview_files() {
		global $post;

		if ( ! $post ) {
			return;
		}

		$product = wc_get_product( $post->ID );
		if ( $product && $product->is_type( 'grouped' ) ) {
			return;
		}

		$post_id = $post->ID;
		?>
		<p class="form-field _music_type_field">
			<label for="_music_type"><?php esc_html_e( 'Music type', 'vwwaveplayer' ); ?></label>
			<select id="_music_type" name="_music_type" class="select short">
				<option value="single" <?php selected( get_post_meta( $post_id, '_music_type', true ) === 'single' ); ?>>Single</option>
				<option value="album" <?php selected( get_post_meta( $post_id, '_music_type', true ) === 'album' ); ?>>Album</option>
			</select>
			<span class="description"><?php esc_html_e( 'Choose a music type', 'vwwaveplayer' ); ?></span>
		</p>
		<div class="form-field preview_files">
			<label><?php esc_html_e( 'Preview files', 'vwwaveplayer' ); ?></label>
			<table class="widefat">
				<thead>
					<tr>
						<th class="sort">&nbsp;</th>
						<th><?php esc_html_e( 'Name ', 'vwwaveplayer' ); ?><span class="woocommerce-help-tip"></span></th>
						<th colspan="2"><?php esc_html_e( 'File URL ', 'vwwaveplayer' ); ?> <span class="woocommerce-help-tip"></span></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody class="ui-sortable">
					<?php
					$preview_files = get_post_meta( $post_id, '_preview_files', true );

					if ( $preview_files ) {
						if ( ! is_array( $preview_files ) ) {
							?>
								<tr>
									<td class="sort"></td>
									<td class="file_name"><input type="text" class="input_text" placeholder="<?php esc_attr_e( 'File Name', 'vwwaveplayer' ); ?>" name="_wc_preview_file_names[]" value="" /></td>
									<td class="file_url"><input type="text" class="input_text" placeholder="<?php esc_attr_e( 'http://', 'vwwaveplayer' ); ?>" name="_wc_preview_file_urls[]" value="<?php echo esc_attr( $preview_files ); ?>" /></td>
									<td class="file_url_choose" width="1%"><a href="#" class="button upload_preview_button" data-choose="<?php esc_attr_e( 'Choose file', 'vwwaveplayer' ); ?>" data-update="<?php esc_attr_e( 'Insert file URL', 'vwwaveplayer' ); ?>"><?php echo esc_html( str_replace( ' ', '&nbsp;', __( 'Choose file', 'vwwaveplayer' ) ) ); ?></a></td>
									<td width="1%"><a href="#" class="delete"><?php esc_html_e( 'Delete', 'vwwaveplayer' ); ?></a></td>
								</tr>
							<?php
						} else {
							foreach ( $preview_files as $key => $file ) {
								?>
								<tr>
									<td class="sort"></td>
									<td class="file_name"><input type="text" class="input_text" placeholder="<?php esc_attr_e( 'File Name', 'vwwaveplayer' ); ?>" name="_wc_preview_file_names[]" value="<?php echo esc_attr( $file['name'] ); ?>" /></td>
									<td class="file_url"><input type="text" class="input_text" placeholder="<?php esc_attr_e( 'http://', 'vwwaveplayer' ); ?>" name="_wc_preview_file_urls[]" value="<?php echo esc_attr( $file['file'] ); ?>" /></td>
									<td class="file_url_choose" width="1%"><a href="#" class="button upload_preview_button" data-choose="<?php esc_attr_e( 'Choose file', 'vwwaveplayer' ); ?>" data-update="<?php esc_attr_e( 'Insert file URL', 'vwwaveplayer' ); ?>"><?php echo esc_html( str_replace( ' ', '&nbsp;', __( 'Choose file', 'vwwaveplayer' ) ) ); ?></a></td>
									<td width="1%"><a href="#" class="delete"><?php esc_html_e( 'Delete', 'vwwaveplayer' ); ?></a></td>
								</tr>
								<?php
							}
						}
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">
							<a href="#" class="button insert" data-row="<tr>
	<td class=&quot;sort&quot;></td>
	<td class=&quot;file_name&quot;><input type=&quot;text&quot; class=&quot;input_text&quot; placeholder=&quot;File Name&quot; name=&quot;_wc_preview_file_names[]&quot; value=&quot;&quot; /></td>
	<td class=&quot;file_url&quot;><input type=&quot;text&quot; class=&quot;input_text&quot; placeholder=&quot;http://&quot; name=&quot;_wc_preview_file_urls[]&quot; value=&quot;&quot; /></td>
	<td class=&quot;file_url_choose&quot; width=&quot;1%&quot;><a href=&quot;#&quot; class=&quot;button upload_preview_button&quot; data-choose=&quot;<?php esc_attr_e( 'Choose File', 'vwwaveplayer' ); ?>&quot; data-update=&quot;<?php esc_attr_e( 'Insert File URL', 'vwwaveplayer' ); ?>&quot;><?php esc_html_e( 'Choose File', 'vwwaveplayer' ); ?></a></td>
	<td width=&quot;1%&quot;><a href=&quot;#&quot; class=&quot;delete&quot;><?php esc_html_e( 'Delete', 'vwwaveplayer' ); ?></a></td>
</tr>"><?php esc_html_e( 'Add File', 'vwwaveplayer' ); ?></a>
						</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<?php
	}

	/**
	 * Saves the preview files when the product is updated
	 *
	 * @since 3.0.0
	 * @param int $product_id The ID of the product being updated.
	 */
	public static function save_preview_files( $post_id ) {
		if ( get_post_type( $post_id ) !== 'product' ) {
			return;
		}

		//phpcs:disable WordPress.Security.NonceVerification.Recommended
		$result = self::process_request();
		$files  = $result['files'];
		$errors = $result['errors'];

		if ( ! empty( $errors ) ) {
			if ( isset( $_REQUEST['context'] ) && $_REQUEST['context'] === 'batch' ) {
				do_action( 'qm/concatenate', 'vwwaveplayer', 'batch', 'error', 'The following preview file was not found: ' . implode( ', ', $errors ) );
			} else {
				WC_Admin_Meta_Boxes::add_error(
					sprintf(
						// translators: %s is the list of files.
						_n(
							'The following preview file was not found: %s',
							'The following preview files were not found: %s',
							count( $errors ),
							'vwwaveplayer'
						),
						'<br/><code>' . implode( '</code><br/><code>', $errors ) . '</code>'
					)
				);
			}
		}

		if ( ! empty( $files ) ) {
			update_post_meta( $post_id, '_preview_files', $files );
		} else {
			delete_post_meta( $post_id, '_preview_files' );
		}

		delete_transient( "vwwaveplayer_preview_files_$post_id" );
	}

	public static function process_request() {
		$files = array();

		if ( isset( $_REQUEST['_wc_preview_file_urls'] ) ) {
			$file_names    = isset( $_REQUEST['_wc_preview_file_names'] ) ? $_REQUEST['_wc_preview_file_names'] : array();  // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			$file_urls     = isset( $_REQUEST['_wc_preview_file_urls'] ) ? wp_unslash( array_map( 'trim', $_REQUEST['_wc_preview_file_urls'] ) ) : array(); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			$file_url_size = count( $file_urls );
			$uploads       = wp_upload_dir();
			$upload_dir    = trailingslashit( $uploads['basedir'] );
			$upload_url    = trailingslashit( $uploads['baseurl'] );

			$file_errors = array();

			for ( $i = 0; $i < $file_url_size; $i ++ ) {

				$file_urls[ $i ] = str_replace( $upload_url, '', $file_urls[ $i ] );

				if ( ! empty( $file_urls[ $i ] ) ) {
					if ( 0 === strpos( $file_urls[ $i ], 'http' ) || 0 === strpos( $file_urls[ $i ], '//' ) ) {
						$file_is  = 'absolute';
						$file_url = $file_urls[ $i ];
					} elseif ( '[' === substr( $file_urls[ $i ], 0, 1 ) && ']' === substr( $file_urls[ $i ], -1 ) ) {
						$file_is  = 'shortcode';
						$file_url = wc_clean( $file_urls[ $i ] );
					} else {
						$file_is  = 'relative';
						$file_url = wc_clean( $file_urls[ $i ] );
					}

					$check_url = $file_url;
					$file_name = wc_clean( $file_names[ $i ] );
					$file_hash = md5( $file_url );

					if ( 'relative' === $file_is ) {
						$file_url = preg_replace( '/\/*(wp-content|uploads)\/*/', '', $file_url );
						$file_id  = attachment_url_to_postid( "{$upload_url}{$file_url}" );

						if ( $file_id ) {
							$file_path = get_attached_file( $file_id );
							$check_url = wp_get_attachment_url( $file_id );
						} else {
							$file_path = realpath( "{$upload_dir}{$file_url}" );
							$check_url = realpath( "{$upload_url}{$file_url}" );
						}

						if ( ! file_exists( $file_path ) ) {
							/**
							 * The file doesn't exist on the local server.
							 * Check if the URL is filtered by a plugin, replaced with a remote URL
							 * and if the remote URL exists.
							 */
							$file_request = wp_remote_head( $check_url );
							$not_found    = is_a( $file_request, 'WP_Error' ) || wp_remote_retrieve_response_code( $file_request ) >= 400;

							if ( $not_found ) {
								// The URL doesn't exist anywhere.
								$file_errors[] = $check_url;
								continue;
							}
						}
					}

					$files[ $file_hash ] = array(
						'name' => $file_name,
						'file' => $file_url,
					);
				}
			}
		}
		//phpcs:enable WordPress.Security.NonceVerification.Recommended

		return array(
			'files'  => $files,
			'errors' => $file_errors,
		);
	}

	/**
	 * Save the music type of a product
	 *
	 * @since 3.0.0
	 * @param int|string $product_id The ID of the product being updated.
	 */
	public static function save_music_type( $product_id ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found

		if ( ! isset( $_REQUEST['_music_type'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return;
		}

		$music_type = $_REQUEST['_music_type']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

		update_post_meta( $product_id, '_music_type', $music_type );
	}

	/**
	 * Get the preview files of a product
	 *
	 * @since  3.0.0
	 * @param  int|string $product_id The ID of the product.
	 * @return array
	 */
	public static function get_preview_files( $product_id ) {
		$product = wc_get_product( $product_id );

		if ( ! $product ) {
			return array();
		}

		$preview_files = get_transient( "vwwaveplayer_preview_files_$product_id" );

		if ( $preview_files ) {
			return $preview_files;
		}

		$preview_files = array();
		$products      = array();

		if ( $product->is_type( 'grouped' ) ) {
			$products = $product->get_children();
		} else {
			$products[] = $product->get_id();
		}

		foreach ( $products as $id ) {
			$_preview_files = get_post_meta( $id, '_preview_files', true );

			if ( $_preview_files ) {
				if ( ! is_array( $_preview_files ) ) {
					$files = explode( ',', $_preview_files );
					foreach ( $files as $file ) {
						if ( is_numeric( $file ) ) {
							if ( wp_attachment_is( 'audio', $file ) ) {
								$file_ids[] = $file;
							}
						} else {
							$file    = self::normalize_media_url( $file );
							$file_id = vwwaveplayer()->attachment_url_to_postid( $file );

							if ( $file_id ) {
								$file_ids[] = $file_id;
							} else {
								$file_urls[] = $file;
							}
						}
					}
				} else {
					foreach ( $_preview_files as $key => $value ) {
						$file    = self::normalize_media_url( $value['file'] );
						$file_id = vwwaveplayer()->attachment_url_to_postid( $file );

						if ( $file_id ) {
							$file_ids[] = $file_id;
						} else {
							$file_urls[] = $file;
						}
					}
				}
			}
		}

		if ( ! empty( $file_ids ) ) {
			$preview_files['ids'] = $file_ids;
		}

		if ( ! empty( $file_urls ) ) {
			$preview_files['url'] = $file_urls;
		}

		set_transient( "vwwaveplayer_preview_files_$product_id", $preview_files );

		return $preview_files;
	}

	/**
	 * Normalize the relative URL of a media file
	 *
	 * @since 3.2.1
	 * @param  string $url The URL to be normalize
	 * @return string
	 */
	public static function normalize_media_url( $url ) {
		if ( preg_match( '/^(http|\/\/)/', $url ) ) {
			// the URL is absolute so we return it untouched
			return $url;
		}

		$uploads         = wp_upload_dir();
		$upload_url      = trailingslashit( $uploads['baseurl'] );
		$site_url        = untrailingslashit( get_option( 'siteurl' ) );
		$upload_url_path = str_replace( $site_url, '', $upload_url );

		return path_join( $upload_url, str_replace( $upload_url_path, '', $url ) );
	}

	/**
	 * Get the HTML markup of the player that includes
	 * all the preview files associated with a product
	 *
	 * @since  3.0.0
	 * @param  WC_Product $_product The current product object.
	 * @param  array      $args     Additional parameters to pass to the shortcode.
	 * @return string
	 */
	public static function product_player( $_product = null, $args = array() ) {
		global $product;

		if ( ! $_product ) {
			$_product = $product;
		}

		if ( is_numeric( $_product ) ) {
			$_product = wc_get_product( $_product );
		}

		if ( ! $_product ) {
			return false;
		}

		$args  = array_merge( self::get_player_args(), $args );
		$files = self::get_preview_files( $_product->get_id() );

		if ( isset( $files['ids'] ) ) {
			$type = 'ids';
		} elseif ( isset( $files['url'] ) ) {
			$type = 'url';
		}

		if ( isset( $type ) && isset( $files[ $type ] ) ) {
			$list = implode( ',', $files[ $type ] );
			if ( $list ) {
				$args[ $type ] = $list;
				$params        = implode(
					' ',
					array_map(
						function( $key, $value ) {
							return "$key='$value'";
						},
						array_keys( $args ),
						$args
					)
				);
				return do_shortcode( "[vwwaveplayer $params]" );
			}
		}

		return false;
	}


	/**
	 * Output the product player to the page
	 *
	 * @since  3.0.0
	 */
	public static function print_product_player() {
		global $product;

		$product_player = self::product_player( $product, self::get_player_args() );

		if ( $product_player ) {
			echo $product_player; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
	
	/**
	 * Get the correct player options 
	 * 
	 * @since 3.5.2
	 * @return array
	 */
	public static function get_player_args() {
		$options = vwwaveplayer()->get_options();
		$size    = $options['size'];
		$args    = array(
			'skin' => $options['woocommerce_shop_player_skin'],
			'size' => $options['woocommerce_shop_player_size'] === 'default' ? $size : $options['woocommerce_shop_player_size'],
			'info' => $options['woocommerce_shop_player_info'],
		);

		if ( self::is_single_product() ) {
			$args    = array(
				'skin' => $options['woocommerce_product_player_skin'],
				'size' => $options['woocommerce_product_player_size'] === 'default' ? $size : $options['woocommerce_product_player_size'],
				'info' => $options['woocommerce_product_player_info'],
			);
		}

		return $args;
	}

	/**
	 * Whether the current page is the single product page
	 * and the current WooCommerce loop is not the 'related' one
	 *
	 * @since  3.0.0
	 * @return boolean
	 */
	public static function is_single_product() {
		global $product;

		$is_single_product = false;

		if ( did_action( 'woocommerce_before_single_product_summary' ) > did_action( 'woocommerce_after_single_product_summary' ) ) {
			$is_single_product = true;
		}

		if ( isset( $GLOBALS['is_elementor_single_product_image'] ) && $GLOBALS['is_elementor_single_product_image'] ) {
			$is_single_product = true;
		}

		return apply_filters( 'vwwaveplayer_is_single_product', $is_single_product, $product );
	}

	/**
	 * Toggle a global variable to determine whether we are inside the Elemento Pro woocommerce-product-images widget
	 *
	 * @since 4.0.0
	 *
	 * @param object $element An elementor element
	 */
	public static function toggle_is_elementor_single_product_image( $element ) {
		if ( 'woocommerce-product-images' !== $element->get_name() ) {
			return;
		}

		if ( ! isset( $GLOBALS['is_elementor_single_product_image'] ) ) {
			$GLOBALS['is_elementor_single_product_image'] = true;
		} else {
			unset( $GLOBALS['is_elementor_single_product_image'] );
		}
	}

	/**
	 * Whether the current loop is a woocommerce loop
	 * where the shop-type player can be added
	 *
	 * @since  3.1.3
	 * @return boolean
	 * @deprecated 3.2.2 Use is_shop_loop_item() instead
	 */
	public static function is_woocommerce_loop() {
		return is_woocommerce() && ! self::is_single_product();
	}

	/**
	 * Whether we are inside the shop loop item
	 * where the shop-type player can be added
	 *
	 * @since  3.1.3
	 * @return boolean
	 */
	public static function is_shop_loop_item() {
		global $product;

		return apply_filters( 'vwwaveplayer_is_shop_loop_item', did_action( 'woocommerce_before_shop_loop_item' ) > did_action( 'woocommerce_after_shop_loop_item' ), $product );
	}

	/**
	 * Whether the current loop is the mini cart
	 *
	 * @since  3.1.3
	 * @return boolean
	 */
	public static function is_mini_cart() {
		return ( did_action( 'woocommerce_before_mini_cart' ) > did_action( 'woocommerce_after_mini_cart' ) );
	}

	/**
	 * Return the HTML markup of the product player
	 *
	 * @since  3.0.0
	 * @param  string         $html     When used as a filter, the markup being replaced.
	 * @param  WC_Product|int $_product The ID or object of the current product.
	 * @return string
	 */
	public static function product_player_html( $html, $_product = null ) {
		if ( ! self::shall_replace_shop_thumbnail() ) {
			return $html;
		}

		global $product;

		if ( is_numeric( $_product ) ) {
			if ( 'attachment' === get_post_type( $_product ) ) {
				$_product = $product;
			} elseif ( 'product' === get_post_type( $_product ) ) {
				$_product = wc_get_product( $_product );
			}
		}

		if ( ! is_a( $_product, 'WC_Product' ) ) {
			return $html;
		}

		$args = apply_filters( 'vwwaveplayer_player_args', array(), $_product );

		if ( false === $args ) {
			return $html;
		}

		if ( is_cart() ) {
			$args = self::get_cart_args( $_product );

			if ( empty( $args ) ) {
				return $html;
			}
		}

		if ( self::is_mini_cart() ) {
			$args = self::get_cart_args( $_product, true );

			if ( empty( $args ) ) {
				return $html;
			}
		}

		$product_player = self::product_player( $_product, $args );

		if ( $product_player ) {
			$html = $product_player;
		}

		return $html;
	}

	public static function get_cart_args( $product = null, $is_mini = false ) {
		$type = $is_mini ? 'mini_cart' : 'cart';

		return apply_filters( "vwwaveplayer_{$type}_player_args", array(), $product );
	}

	public static function maybe_add_style_before_cart( $is_mini = false ) {
		$default_skin = vwwaveplayer()->get_option( 'skin' );
		$args         = self::get_cart_args( null, $is_mini );

		if ( empty( $args ) || ! isset( $args['skin'] ) || $args['skin'] === $default_skin || WC()->cart->is_empty() ) {
			return;
		}

		Renderer::print_style( $args['skin'] );
	}

	public static function maybe_add_style_before_mini_cart() {
		self::maybe_add_style_before_cart( true );
	}

	/**
	 * Return the HTML markup of the product block
	 *
	 * @since  3.0.0
	 * @param  string $html    When used as a filter, the markup being replaced.
	 * @param  object $data    The object containing the markup of each product element.
	 * @param  object $product The current product object in the loop.
	 * @return string
	 */
	public static function blocks_product_grid_item_html( $html, $data, $product ) {
		$product_player = self::product_player( $product );
		if ( $product_player ) {
			$html = "<li class=\"wc-block-grid__product\">
    			<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
    				{$data->image}
                    {$product_player}
    				{$data->title}
    			</a>
    			{$data->badge}
    			{$data->price}
    			{$data->rating}
    			{$data->button}
    		</li>";
		}

		return $html;
	}


	/**
	 * Add a product to the cart
	 *
	 * @since  3.0.0
	 */
	public static function ajax_add_to_cart() {
		ob_start();

		$product_id        = isset( $_POST['product_id'] ) ? (int) $_POST['product_id'] : 0; // phpcs:ignore WordPress.Security.NonceVerification.Missing
		$quantity          = 1;
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		$product_status    = get_post_status( $product_id );
		$added             = WC()->cart->add_to_cart( $product_id, $quantity );

		if ( $passed_validation && $added && 'publish' === $product_status ) {
			ob_start();

			woocommerce_mini_cart();

			$mini_cart = ob_get_clean();

			$data = array(
				'fragments'  => apply_filters(
					'woocommerce_add_to_cart_fragments',
					array(
						'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>',
					)
				),
				'cart_hash'  => WC()->cart->get_cart_hash(),
				'ajax_nonce' => wp_create_nonce( 'vwwaveplayer-ajax-call' ),
			);

			wp_send_json_success( $data );
		} else {
			$data = array(
				'message'     => __( 'The product was not added to the cart', 'vwwaveplayer' ),
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ), // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				'product_id'  => $product_id,
			);
			wp_send_json_error( $data );
		}
	}

	/**
	 * Retrieve the audio attachments
	 *
	 * @since  3.0.0
	 * @param  int    $posts_per_page The number of tracks per page.
	 * @param  int    $paged          The page where to start getting tracks.
	 * @param  string $search         The string to search.
	 * @return array                  An array of tracks and albums.
	 */
	public static function get_audio_attachments( $posts_per_page = 10, $paged = 1, $search = '' ) {

		$tracks = array();
		$albums = array();

		$args = array(
			'posts_per_page' => $posts_per_page,
			'paged'          => $paged,
			'post_type'      => 'attachment',
			'post_mime_type' => 'audio',
			'post_status'    => 'any',
		);

		if ( $search ) {
			$args['s'] = $search;
		}
		$query        = new WP_Query( $args );
		$found_tracks = $query->found_posts;

		if ( $query->have_posts() ) {
			foreach ( $query->posts as $attachment ) {
				$id          = $attachment->ID;
				$track       = wp_get_attachment_metadata( $id );
				$track['id'] = $id;
				$post        = get_post( $id );
				if ( $post->post_title ) {
					$track['title'] = $post->post_title;
				}
				$track_file    = wp_get_attachment_url( $id );
				$track['file'] = $track_file;

				$track['product'] = self::get_product_id(
					array(
						'file' => $track_file,
						'id'   => $id,
					)
				);

				$tracks[] = $track;
				if ( isset( $track['album'] ) ) {
					$key = $track['album'];
					if ( ! isset( $albums[ $key ] ) ) {
						$albums[ $key ]           = array();
						$albums[ $key ]['count']  = 0;
						$albums[ $key ]['tracks'] = array();
					}
					$albums[ $key ]['count']++;
					$albums[ $key ]['tracks'][] = $track['id'];
				}
			}
			foreach ( $albums as $title => $album ) {
				$album['product'] = self::get_product_id( array( 'album' => $title ) );
				$album['tracks']  = implode( ',', $album['tracks'] );
				$albums[ $title ] = $album;
			}
		}

		return array(
			'tracks'       => $tracks,
			'found_tracks' => $found_tracks,
		);
	}


	/**
	 * Generate the HTML markup for the audio attachment list with checkboxes
	 *
	 * @since  3.0.0
	 * @param  int    $posts_per_page The number of tracks per page.
	 * @param  int    $paged          The page where to start getting tracks.
	 * @param  string $search         The string to search.
	 * @return array                  An array of containers for the track and the album inputs.
	 */
	public static function music_inputs( $posts_per_page = 10, $paged = 1, $search = '' ) {
		$result = self::get_audio_attachments( $posts_per_page, $paged, $search );
		if ( $result ) {
			$tracks       = $result['tracks'];
			$found_tracks = $result['found_tracks'];
			$per_page     = $posts_per_page;
		} else {
			return false;
		}
		$track_inputs = '';
		foreach ( $tracks as $track ) {
			$id       = esc_attr( $track['id'] );
			$title    = esc_attr( $track['title'] );
			$length   = esc_html( isset( $track['length_formatted'] ) ? $track['length_formatted'] : '' );
			$file     = esc_html( basename( $track['file'] ) );
			$product  = $track['product'];
			$disabled = $product > 0 ? 'disabled' : '';

			$track_inputs .= "<div><input type='checkbox' name='music_track_$id' value='$id' $disabled data-title='$title' /><span class='$disabled'>$id. <strong>$title</strong> – $length ($file)</span></div>";
		}
		$args = array(
			'base'      => '%_%',
			'format'    => '#%#%',
			'current'   => (int) $paged,
			'total'     => ceil( $found_tracks / $posts_per_page ),
			'prev_text' => '<',
			'next_text' => '>',
		);
		// translators: %s is the number of tracks found.
		$found_tracks_label = '<span class="found-tracks">' . sprintf( esc_attr( _n( '%s track', '%s tracks', $found_tracks, 'vwwaveplayer' ) ), number_format_i18n( $found_tracks ) ) . '</span>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		require_once ABSPATH . 'wp-admin/includes/template.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-screen.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
		$pagination = new \WP_List_Table( array( 'ajax' => true ) );
		$pagination->set_pagination_args(
			array(
				'total_items' => $found_tracks,
				'total_pages' => ceil( $found_tracks / $posts_per_page ),
				'per_page'    => $posts_per_page,
			)
		);

		ob_start();
		?>

		<div class="tablenav-pages">
			<?php $pagination->pagination( 'top' ); ?>
		</div>

		<?php
		$paginate_links = ob_get_clean(); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		return array(
			'track_inputs'   => $track_inputs,
			'paginate_links' => $paginate_links,
			'found_tracks'   => $found_tracks,
		);
	}

	/**
	 * Generate the HTML markup for the audio attachment list with checkboxes
	 *
	 * @since  3.0.0
	 * @param array $data  The data to match the products against.
	 * @return int|boolean The ID of the product or false if no product was found
	 */
	public static function get_product_id( $data ) {

		$product_id = false;

		$args = array(
			'posts_per_page' => 1,
			'post_status'    => 'any',
			'post_type'      => 'product',
		);

		$meta_query = array();
		$music_type = '';
		if ( isset( $data['file'] ) || isset( $data['id'] ) ) {
			$value                  = isset( $data['file'] ) ? $data['file'] : $data['id'];
			$meta_query['relation'] = 'AND';
			$meta_query[]           = array(
				'key'     => '_preview_files',
				'value'   => $value,
				'compare' => 'LIKE',
			);
			$music_type             = 'single';
		} elseif ( isset( $data['album'] ) ) {
			$args['title'] = $data['album'];
			$music_type    = 'album';
		}
		if ( $music_type ) {
			$meta_query[]       = array(
				'key'     => '_music_type',
				'value'   => $music_type,
				'compare' => '=',
			);
			$args['meta_query'] = $meta_query; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
		}

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$query->the_post();
			$product_id = get_the_ID();
			wp_reset_postdata();
		}

		return $product_id;
	}

	/**
	 * Callback function hooked to the 'vwwaveplayer_add_track_info' filter
	 * Add the relevant data of a product associated with the track
	 *
	 * @since  3.0.0
	 * @param array $track     The array containing the track info.
	 * @param int   $track_id  The ID of the track.
	 * @param int   $post_id   The ID of the post containing the track.
	 * @return array           The filtered array containing the track info
	 */
	public static function add_product_info_to_track( $track, $track_id, $post_id ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
		if ( is_admin() && function_exists( 'get_current_screen' ) ) {
			$screen = get_current_screen();
			if ( $screen && 'post' === $screen->base ) {
				return $track;
			}
		}

		global $product;
		$options         = vwwaveplayer()->get_options();
		$base_url        = preg_replace( '/(http|https)\:/', '', trailingslashit( wp_upload_dir()['baseurl'] ) );
		$track_file      = str_replace( $base_url, '', preg_replace( '/(http|https)\:/', '', $track['file'] ) );
		$attachment_file = get_post_meta( $track_id, '_wp_attached_file', true );

		$meta_query_conditions = array(
			'relation' => 'OR',
			array(
				'key'     => '_preview_files',
				'value'   => "$track_file",
				'compare' => 'LIKE',
			),
			array(
				'key'     => '_preview_files',
				'value'   => "^$track_id$",
				'compare' => 'REGEXP',
			),
		);

		if ( $attachment_file !== $track_file ) {
			$meta_query_conditions[] = array(
				'key'     => '_preview_files',
				'value'   => "$attachment_file",
				'compare' => 'LIKE',
			);
		}

		$args = array(
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'search_fields'  => array(
				'meta' => array( '_preview_files' ),
			),
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				'relation' => 'AND',
				$meta_query_conditions,
			),
		);

		$query = new WP_Query( $args );
		if ( $query->found_posts ) {
			$post                   = current( $query->posts );
			$track['product_id']    = $post->ID;
			$track['product_title'] = $post->post_title;
			$track['product_url']   = get_permalink( $post->ID );
			$_product               = wc_get_product( $post->ID );
			$track['product_price'] = floatval( $_product->get_price() );
			if ( $_product->is_type( 'variable' ) ) {
				$track['product_variations'] = $_product->get_available_variations();
				setup_postdata( $post );
				ob_start();
				woocommerce_variable_add_to_cart();
				$cart_form = ob_get_clean();
				if ( $product && $product->is_type( 'grouped' ) ) {
					wp_reset_postdata();
				}
				$track['product_variations_form'] = $cart_form;
			}

			$default_poster_size = isset( $options['default_thumbnail_size'] ) && $options['default_thumbnail_size'] ? $options['default_thumbnail_size'] : 'thumbnail';

			// we do not use `get_post_thumbnail_id` here as to avoid an infinite loop.
			$post_featured_image_id = (int) get_post_meta( $post->ID, '_thumbnail_id', true );

			if ( vwwaveplayer()->get_option( 'default_thumbnail' ) === $track['poster'] && $post_featured_image_id ) {
				$track['poster']           = current( wp_get_attachment_image_src( $post_featured_image_id, $default_poster_size ) ) ? current( wp_get_attachment_image_src( $post_featured_image_id, $default_poster_size ) ) : '';
				$track['poster_thumbnail'] = current( wp_get_attachment_image_src( $post_featured_image_id, 'vwwaveplayer-playlist-thumb' ) ) ? current( wp_get_attachment_image_src( $post_featured_image_id, 'vwwaveplayer-playlist-thumb' ) ) : '';
				$track['poster_srcset']    = wp_get_attachment_image_srcset( $post_featured_image_id, array( 48, 48 ) ) ? wp_get_attachment_image_srcset( $post_featured_image_id, array( 48, 48 ) ) : '';
			}
			$track['product_formatted_price'] = wc_price( $track['product_price'] );
			$track['in_cart']                 = 0;
			if ( WC()->cart ) {
				foreach ( WC()->cart->get_cart() as $cart_item ) {
					if ( $track['product_id'] === $cart_item['product_id'] ) {
						$track['in_cart'] = 1;
						break;
					}
				}
			}
		}
		return $track;
	}

	/**
	 * Callback function hooked to the 'vwwaveplayer_add_external_track_info' filter
	 * Add the relevant data of a product associated with the track
	 *
	 * @since  3.0.0
	 * @param array  $track     The array containing the track info.
	 * @param int    $hash      The MD5 hash of the URL identifying the external track
	 *                          (this is passed for verification only).
	 * @param int    $post_id   The ID of the post containing the track.
	 * @param string $url       The URL of the external track.
	 * @return array           The filtered array containing the track info
	 */
	public static function add_product_info_to_external_track( $track, $hash, $post_id, $url ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundBeforeLastUsed
		global $product;

		$options = vwwaveplayer()->get_options();

		$args  = array(
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'search_fields'  => array(
				'meta' => array( '_preview_files' ),
			),
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				'relation' => 'AND',
				array(
					'relation' => 'OR',
					array(
						'key'     => '_preview_files',
						'value'   => "$url",
						'compare' => 'LIKE',
					),
				),
			),
		);
		$query = new WP_Query( $args );
		if ( $query->found_posts ) {
			$post                   = current( $query->posts );
			$preview_files          = get_post_meta( $post->ID, '_preview_files', true );
			$track['product_id']    = $post->ID;
			$track['product_title'] = $post->post_title;
			$track['product_url']   = get_permalink( $post->ID );
			$_product               = wc_get_product( $post->ID );
			$track['product_price'] = floatval( $_product->get_price() );
			if ( $_product->is_type( 'variable' ) ) {
				$track['product_variations'] = $_product->get_available_variations();
				setup_postdata( $post );
				ob_start();
				woocommerce_variable_add_to_cart();
				$cart_form = ob_get_clean();
				if ( $product && $product->is_type( 'grouped' ) ) {
					wp_reset_postdata();
				}
				$track['product_variations_form'] = $cart_form;
			}

			$default_poster_size = isset( $options['default_thumbnail_size'] ) && $options['default_thumbnail_size'] ? $options['default_thumbnail_size'] : 'thumbnail';

			// we do not use `get_post_thumbnail_id` here as to avoid an infinite loop.
			$post_featured_image_id = (int) get_post_meta( $post->ID, '_thumbnail_id', true );

			if ( vwwaveplayer()->get_option( 'default_thumbnail' ) === $track['poster'] && $post_featured_image_id ) {
				$track['poster']           = current( wp_get_attachment_image_src( $post_featured_image_id, $default_poster_size ) ) ? current( wp_get_attachment_image_src( $post_featured_image_id, $default_poster_size ) ) : '';
				$track['poster_thumbnail'] = current( wp_get_attachment_image_src( $post_featured_image_id, 'vwwaveplayer-playlist-thumb' ) ) ? current( wp_get_attachment_image_src( $post_featured_image_id, 'vwwaveplayer-playlist-thumb' ) ) : '';
				$track['poster_srcset']    = wp_get_attachment_image_srcset( $post_featured_image_id, array( 48, 48 ) ) ? wp_get_attachment_image_srcset( $post_featured_image_id, array( 48, 48 ) ) : '';
			}

			$track['product_formatted_price'] = wc_price( $track['product_price'] );
			$track['in_cart']                 = 0;
			if ( WC()->cart ) {
				foreach ( WC()->cart->get_cart() as $cart_item ) {
					if ( $track['product_id'] === $cart_item['product_id'] ) {
						$track['in_cart'] = 1;
						break;
					}
				}
			}
		}
		return $track;
	}

	/**
	 * Callback function hooked to the 'woocommerce_post_class' filter
	 * Add the 'vwwaveplayer-product' class to a product with preview files
	 *
	 * @since  3.0.0
	 * @param array      $classes The array containing the track info.
	 * @param WC_Product $product The current $product object.
	 * @return array     The filtered array containing the product item classes
	 */
	public static function woocommerce_post_class( $classes, $product ) {
		if ( get_post_meta( $product->get_id(), '_preview_files', true ) ) {
			$classes[] = 'vwwaveplayer-product';
		}

		return $classes;
	}

	/**
	 * Add preview files to the product exported data
	 *
	 * @since  3.1.9
	 * @param  array      $row        The associative array with the exported data for each row.
	 * @param  WC_Product $product    The product corresponding to the current row.
	 * @param  mixed      $exporter   The instance of the CSV exporter.
	 * @return array
	 */
	public static function export_preview_files( $row, $product, $exporter ) {
		$_preview_files = get_post_meta( $product->get_id(), '_preview_files', true );
		$preview_files  = array();

		if ( $_preview_files ) {
			if ( is_scalar( $_preview_files ) ) {
				if ( is_numeric( $_preview_files ) ) {
					$preview_files[ md5( $_preview_files ) ] = wp_get_attachment_url( $_preview_files );
				} else {
					$attachment_id = vwwaveplayer()->attachment_url_to_postid( $_preview_files );

					if ( ! $attachment_id ) {
						return $row;
					}
				}
			} else {
				$preview_files = $_preview_files;
			}

			$column_names = $exporter->get_column_names();

			$i = 1;
			foreach ( $preview_files as $file_id => $preview_file ) {
				/* translators: %d: Preview file index */
				$column_names[ 'preview_files:id' . $i ] = sprintf( __( 'Preview file %d ID', 'vwwaveplayer' ), $i );
				/* translators: %d: Preview file index */
				$column_names[ 'preview_files:name' . $i ] = sprintf( __( 'Preview file %d name', 'vwwaveplayer' ), $i );
				/* translators: %d: Preview file index */
				$column_names[ 'preview_files:url' . $i ] = sprintf( __( 'Preview file %d URL', 'vwwaveplayer' ), $i );
				$row[ 'preview_files:id' . $i ]           = $file_id;
				$row[ 'preview_files:name' . $i ]         = $preview_file['name'];
				$row[ 'preview_files:url' . $i ]          = $preview_file['file'];
				$i++;
			}

			$exporter->set_column_names( $column_names );
		}

		return $row;
	}

	/**
	 * Get the preview files from the data imported from a CSV file
	 *
	 * @since  3.1.9
	 * @param  array $data The associative array with the data imported from the CSV file.
	 * @return array       The expanded data
	 */
	public static function import_preview_files( $data ) {
		$preview_files = array();

		foreach ( $data as $key => $value ) {
			if ( 0 === strpos( $key, 'preview_files:id' ) ) {
				if ( ! empty( $value ) ) {
					$preview_files[ str_replace( 'preview_files:id', '', $key ) ]['id'] = $value;
				}
				unset( $data[ $key ] );
			} elseif ( 0 === strpos( $key, 'preview_files:name' ) ) {
				if ( ! empty( $value ) ) {
					$preview_files[ str_replace( 'preview_files:name', '', $key ) ]['name'] = $value;
				}
				unset( $data[ $key ] );
			} elseif ( 0 === strpos( $key, 'preview_files:url' ) ) {
				if ( ! empty( $value ) ) {
					$parsed_url = wp_parse_url( $value );

					if ( ! isset( $parsed_url['host'] ) ) {
						// the url is relative so we make it absolute with the current domain and.
						$upload_dir = wp_upload_dir();
						$rootdir    = get_home_path();
						$basedir    = trailingslashit( $upload_dir['basedir'] );

						if ( file_exists( wp_normalize_path( "$rootdir$value" ) ) ) {
							$value = site_url( $value );
						} elseif ( file_exists( wp_normalize_path( "$basedir$value" ) ) ) {
							$value = trailingslashit( $upload_dir['baseurl'] ) . $value;
						}
					}

					$preview_files[ str_replace( 'preview_files:url', '', $key ) ]['url'] = $value;
				}
				unset( $data[ $key ] );
			}
		}

		if ( ! empty( $preview_files ) ) {
			$data['preview_files'] = array();

			foreach ( $preview_files as $key => $file ) {
				if ( empty( $file['url'] ) ) {
					continue;
				}

				$file_id = isset( $file['id'] ) ? $file['id'] : md5( $file['url'] );

				$data['preview_files'][ $file_id ] = array(
					'name' => $file['name'] ? $file['name'] : wc_get_filename_from_url( $file['url'] ),
					'file' => $file['url'],
				);
			}
		}

		return $data;
	}

	/**
	 * Add the preview file data to the import mapping options
	 *
	 * @since  3.1.9
	 * @param  array  $options An associative array of import mapping options.
	 * @param  string $item    The current item being imported.
	 * @return array           The filtered mapping options.
	 */
	public static function import_mapping_options( $options, $item ) {
		$index = $item;

		if ( preg_match( '/\d+/', $item, $matches ) ) {
			$index = $matches[0];
		}

		$options['preview_files'] = array(
			'name'    => __( 'Preview files', 'vwwaveplayer' ),
			'options' => array(
				'preview_files:id' . $index   => __( 'Preview file ID', 'vwwaveplayer' ),
				'preview_files:name' . $index => __( 'Preview file name', 'vwwaveplayer' ),
				'preview_files:url' . $index  => __( 'Preview file URL', 'vwwaveplayer' ),
			),
		);

		return $options;
	}

	/**
	 * Filter the special columns of the import mapping
	 *
	 * @since  3.1.9
	 * @param  array $headers The associative array with the CSV headers.
	 * @return array          The filtered headers.
	 */
	public static function import_mapping_special_columns( $headers ) {
		/* translators: %d: Preview file index */
		$headers[ __( 'Preview file %d ID', 'vwwaveplayer' ) ] = 'preview_files:id';
		/* translators: %d: Preview file index */
		$headers[ __( 'Preview file %d name', 'vwwaveplayer' ) ] = 'preview_files:name';
		/* translators: %d: Preview file index */
		$headers[ __( 'Preview file %d URL', 'vwwaveplayer' ) ] = 'preview_files:url';

		return $headers;
	}

	/**
	 * Update cached tracks to check whether the corresponding product, if any, is in cart or not.
	 *
	 * @since 3.5.0
	 * @param  array $tracks The cached tracks being evaluated.
	 * @return array
	 */
	public static function update_cached_tracks( $tracks ) {
		if ( ! WC()->cart ) {
			return $tracks;
		}

		$cart = WC()->cart->get_cart_contents();

		foreach ( $tracks as $key => $track ) {
			if ( ! isset( $track['product_id'] ) ) {
				continue;
			}

			$tracks[ $key ]['in_cart'] = (int) in_array( $track['product_id'], array_column( $cart, 'product_id' ), true );;
		}

		return $tracks;
	}
}

WooCommerce::load();
