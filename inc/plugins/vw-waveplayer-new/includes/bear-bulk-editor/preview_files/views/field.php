<?php
// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
// phpcs:reason This file will not be included in the global scope.

defined( 'ABSPATH' ) || exit;

$product = wc_get_product( $product_id );

if ( ! $product ) {
	return;
}

$title       = $product->get_title();
$files_count = count( $preview_files );
$attachments = array();

foreach ( $preview_files as $id ) {
	$img_url = get_the_post_thumbnail_url( $id );
	$img_id  = 0;
	$img_id  = attachment_url_to_postid( $img_url );

	$attachments[] = array(
		'id'    => $id,
		'title' => get_the_title( $id ),
		'thumb' => wp_get_attachment_image_src( $img_id ?: $id, 'thumbnail', true )[0],
	);
}

//***
if ( empty( $attachments ) ) {
	?>
	<div
		class="woobe-button"
		data-count="0"
		data-product_id="<?php echo esc_attr( $product_id ); ?>"
		id="popup_val_<?php echo esc_attr( $field_key ); ?>_<?php echo esc_attr( $product_id ); ?>"
		data-key="<?php echo esc_attr( $field_key ); ?>"
		data-terms_ids=""
		data-name="<?php echo sprintf( esc_html__( 'Product: %s', 'woocommerce-bulk-editor' ), esc_html( $title ) ); ?>"
	>
		<?php printf( _n( 'Preview file', 'Preview files (%s)', $files_count, 'vwwaveplayer' ), esc_attr( $files_count ) ); ?>
	</div>
	<?php
} else {
	?>
	<a
		href="javascript: void(0);"
		class="preview_files_popup_editor_btn"
		data-preview_files='<?php echo esc_attr( wp_json_encode( $attachments ) ); ?>'
		data-count="<?php echo esc_attr( $files_count ); ?>"
		data-product_id="<?php echo esc_attr( $product_id ); ?>"
		id="popup_val_<?php echo esc_attr( $field_key ); ?>_<?php echo esc_attr( $product_id ); ?>"
		data-key="<?php echo esc_attr( $field_key ); ?>"
		data-terms_ids=""
		data-name="<?php echo sprintf( esc_html__( 'Product: %s', 'woocommerce-bulk-editor' ), $title ); ?>"
	>
		<?php
		foreach ( $attachments as $key => $attachment ) {
			if ( $key > 2 ) {
				break;
			}

			?>
			<img src="<?php echo esc_attr( $attachment['thumb'] ); ?>" alt="" class="woobe_btn_gal_block" />
			<?php
		}
		if ( $files_count > 3 ) {
			?>
			<div class="woobe_btn_gal_block">(+<?php echo esc_attr( $files_count - 3 ); ?>)</div>
			<?php
		}
		?>
	</a>
	<?php
}

// phpcs:enable WordPress.WP.GlobalVariablesOverride.Prohibited
