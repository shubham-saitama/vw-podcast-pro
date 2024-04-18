<?php
/**
 * Uninstall VwWavePlayer
 *
 * @package VwWavePlayer
 */

defined( 'ABSPATH' ) || exit;
defined( 'WP_UNINSTALL_PLUGIN' ) || exit;


$vwwaveplayer_option_names = array(
	'skin',
	'default_palette',
	'size',
	'style',
	'show_list',
	'shape',
	'autoplay',
	'repeat',
	'shuffle',
	'wave_color',
	'wave_color_2',
	'progress_color',
	'progress_color_2',
	'cursor_color',
	'cursor_color_2',
	'cursor_width',
	'hover_opacity',
	'wave_mode',
	'gap_width',
	'wave_compression',
	'wave_normalization',
	'wave_asymmetry',
	'wave_animation',
	'amp_freq_ratio',
	'template',
	'custom_css',
	'custom_js',
	'default_thumbnail',
	'default_thumbnail_size',
	'audio_override',
	'jump',
	'delete_settings',
	'info',
	'playlist_template',
	'sticky_template',
	'sticky_player_position',
	'full_width_playlist',
	'default_font',
	'base_font_size',
	'override_wave_colors',
	'media_library_title',
	'beta_program',
	'purchase_code',
	'email_optin',
	'version',
	'woocommerce_shop_player',
	'woocommerce_shop_player_skin',
	'woocommerce_shop_player_size',
	'woocommerce_shop_player_info',
	'woocommerce_remove_shop_image',
	'woocommerce_product_player',
	'woocommerce_product_player_skin',
	'woocommerce_product_player_size',
	'woocommerce_product_player_info',
	'woocommerce_remove_product_image',
	'woocommerce_replace_product_image',
	'woocommerce_music_type_filter',
	'options',
);

global $wp_filesystem;
WP_Filesystem();

if ( get_option( 'vwwaveplayer_delete_settings' ) ) {
	if ( ! is_multisite() ) {
		$vwwaveplayer_upload_dir    = wp_upload_dir();
		$vwwaveplayer_upload_subdir = trailingslashit( $vwwaveplayer_upload_dir['basedir'] ) . 'peaks';
		$wp_filesystem->rmdir( $vwwaveplayer_upload_subdir );
		foreach ( $vwwaveplayer_option_names as $vwwaveplayer_option_name ) {
			delete_option( "vwwaveplayer_$vwwaveplayer_option_name" );
		}
	} else {
		global $wpdb;

		$vwwaveplayer_blog_ids         = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		$vwwaveplayer_original_blog_id = get_current_blog_id();

		foreach ( $vwwaveplayer_blog_ids as $vwwaveplayer_blog_id ) {
			switch_to_blog( $blog_id );
			foreach ( $vwwaveplayer_option_names as $vwwaveplayer_option_name ) {
				delete_option( "vwwaveplayer_$option_name" );
			}
			$vwwaveplayer_upload_dir    = wp_upload_dir();
			$vwwaveplayer_upload_subdir = trailingslashit( $vwwaveplayer_upload_dir['basedir'] ) . 'peaks';
			$wp_filesystem->rmdir( $vwwaveplayer_upload_subdir );
		}

		switch_to_blog( $vwwaveplayer_original_blog_id );
		delete_option( $vwwaveplayer_option_name );
	}
}
