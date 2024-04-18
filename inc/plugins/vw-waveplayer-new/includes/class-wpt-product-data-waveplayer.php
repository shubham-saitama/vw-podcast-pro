<?php
namespace PerfectPeach\VwWavePlayer;

use Barn2\Plugin\WC_Product_Table\Data\Abstract_Product_Data;

class Product_Data_WavePlayer extends Abstract_Product_Data { //phpcs:ignore Generic.Files.OneObjectStructurePerFile.MultipleFound, Generic.Classes.OpeningBraceSameLine.ContentAfterBrace

	/**
		 * Overrides the default 'get_data' method of the Abstract_Product_Data class
		 *
		 * @since  3.0.0
		 */
	public function get_data() {
		if ( ! $this->product ) {
			return;
		}

		/**
		 * Filters the skin used to render the player inside the Barn2 WooCommerce Product Table
		 *
		 * @since 3.0.7
		 * @param string $skin The name of the skin
		 */
		$skin = apply_filters( 'vwwaveplayer_wc_product_table_skin', WooCommerce_Addon_Support::wc_product_table_default_skin() );

		/**
		 * Filters the size used to render the player inside the Barn2 WooCommerce Product Table
		 *
		 * @since 3.3.0
		 * @param string $size The size (lg, md, sm or xs)
		 */
		$size = apply_filters( 'vwwaveplayer_wc_product_table_size', WooCommerce_Addon_Support::wc_product_table_default_size() );

		$value = do_shortcode( "[vwwaveplayer skin='$skin' size='$size']" );

		return apply_filters( 'vwwaveplayer_product_table_instance', $value, $this->product );
	}
}
