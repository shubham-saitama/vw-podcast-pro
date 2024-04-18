<?php

namespace PerfectPeach\VwWavePlayer\Integrations\WOOBE;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

use PerfectPeach\VwWavePlayer\WooCommerce as VwWavePlayer_WooCommerce;
use WOOBE_EXT;
use WOOBE_HELPER;

use function PerfectPeach\VwWavePlayer\vwwaveplayer;

final class Preview_Files extends WOOBE_EXT {
	protected $slug = 'preview_files';
	protected $is   = 'external';

	public function __construct() {
		add_action( 'woobe_ext_scripts', array( $this, 'woobe_ext_scripts' ), 1 );
		add_action( 'woobe_page_end', array( $this, 'woobe_page_end' ), 1 );
		add_filter( 'woobe_extend_fields', array( $this, 'add_preview_files_field' ) );
		add_filter( 'woobe_wrap_field_val', array( $this, 'wrap_preview_field_val' ), 10, 3 );
		add_filter( 'woobe_before_update_product_field', array( $this, 'update_preview_files' ), 10, 3 );
	}

	public function add_preview_files_field( $fields ) {
		$fields['preview_files'] = array(
			'show'                    => 1,
			'title'                   => esc_html__( 'Preview Files', 'vwwaveplayer' ),
			'desc'                    => esc_html__( 'Select the audio tracks for this product', 'vwwaveplayer' ),
			'field_type'              => 'preview_files',
			'type'                    => 'textinput',
			'editable'                => true,
			'edit_view'               => 'preview_files_popup_editor',
			'order'                   => false,
			'direct'                  => true,
			'prohibit_product_types'  => array( 'variation', 'grouped' ),
			'css_classes'             => 'not-for-variations not-for-grouped',
			'shop_manager_visibility' => 1,
		);

		return $fields;
	}

	public function woobe_ext_scripts() {
		wp_enqueue_script( 'woobe_ext_' . $this->slug, plugins_url( 'assets/js/' . $this->slug . '.js', __FILE__ ), array(), WOOBE_VERSION, true );
		wp_enqueue_style( 'woobe_ext_' . $this->slug, plugins_url( 'assets/css/' . $this->slug . '.css', __FILE__ ), array(), WOOBE_VERSION );
		?>
		<script>
			lang.<?php echo $this->slug ?> = {};
			//lang.<?php echo $this->slug ?>.xxx = 'xxx';
		</script>
		<?php
	}

	public function woobe_page_end() {
		echo WOOBE_HELPER::render_html( $this->get_ext_path() . 'views/panel.php', array() );
	}

	public function wrap_preview_field_val( $res, $post, $field_key ) {
		if ( $field_key === 'preview_files' ) {
			$preview_files = VwWavePlayer_WooCommerce::get_preview_files( $post['ID'] );

			$res = WOOBE_HELPER::render_html(
				$this->get_ext_path() . 'views/field.php',
				array(
					'product_id'    => $post['ID'],
					'field_key'     => $field_key,
					'preview_files' => $preview_files['ids'] ?? array(),
				)
			);
		}

		return $res;
	}

	public function update_preview_files( $value, $product_id, $field_key ) {
		if ( $field_key === 'preview_files' ) {
			$ids           = $value['woobe_preview_files'] ?? array();
			$preview_files = array();
			$uploads       = wp_upload_dir();
			$uploads_url   = trailingslashit( $uploads['baseurl'] );

			foreach ( $ids as $id ) {
				$attachment = get_post( $id );

				if ( ! $attachment ) {
					continue;
				}

				$url  = str_replace( $uploads_url, '', get_post_meta( $id, '_wp_attached_file', true ) );
				$hash = md5( $url );

				$preview_files[ $hash ] = array(
					'name' => wc_clean( get_the_title( $id ) ),
					'file' => $url,
				);
			}

			update_post_meta( $product_id, '_preview_files', $preview_files );
			delete_transient( "vwwaveplayer_preview_files_$product_id" );

			echo WOOBE_HELPER::render_html(
				$this->get_ext_path() . 'views/field.php',
				array(
					'product_id'    => $product_id,
					'field_key'     => $field_key,
					'preview_files' => $ids ?? array(),
				)
			);

			exit;
		}

		return $value;
	}
}

new Preview_Files();
