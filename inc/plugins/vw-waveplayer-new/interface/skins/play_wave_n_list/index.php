<?php
/**
 * Skin Name: Play,Wave'n'List
 * Supports: size,playlist
 * Author: VW Waveplayer
 * Version: 3.0.0
 * Author URI: 
 * Description: A minimal interface with just the waveform and the play button. This interface is particularly useful for single-track instances, as a WooCommerce product player or in combination with tables.
 *
 * You can customize this interface copying the whole folder
 * in your current child theme folder, in the following location:
 * /wp-content/themes/<your-child-theme>/vwwaveplayer/interface/skins/play_wave_n_list
 *
 * If VwWavePlayer find this skin in your child theme folder, it will override the factory one.
 *
 * @package VwWavePlayer/Skins
 */

defined( 'ABSPATH' ) || exit;

?>
<div id="<?php echo esc_attr( $args['id'] ); ?>" class="<?php echo esc_attr( $args['classes'] ); ?>" <?php echo $args['dataset']; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="vwwvpl-controls">
		<div class="vwwvpl-icon vwwvpl-play"></div>
	</div>
	<div class="vwwvpl-wave">
		<div class="vwwvpl-overlay">
			<svg>
				<use xlink:href="#waveform-animation" />
			</svg>
			<div class="percentage"></div>
			<div class="vwwvpl-loading">
				<div class="vwwvpl-loading-progress"></div>
			</div>
			<div class="message"></div>
		</div>
		<div class="vwwvpl-position"></div>
		<div class="vwwvpl-waveform"></div>
		<div class="vwwvpl-duration"></div>
	</div>
	<div class="vwwvpl-playlist">
		<div class="vwwvpl-playlist-wrapper"></div>
	</div>
</div>
