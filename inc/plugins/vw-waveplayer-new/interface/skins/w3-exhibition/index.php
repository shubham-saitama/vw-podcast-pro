<?php
/**
 * Skin Name: WavePlayer3 Exhibition
 * Supports: size,shape,infobar,playlist
 * Author: VW Waveplayer
 * Version: 3.0.0
 * Author URI: 
 * Description: The new interface included in WavePlayer3, using the most advanced styling techniques for the best reasult in a broad variety of configurations. This is the same as the 'WavePlayer3' skin except it has a blurred background using the thumbnail of the track being played back.
 *
 * You can customize this interface copying the whole folder
 * in your current child theme folder, in the following location:
 * /wp-content/themes/<your-child-theme>/vwwaveplayer/interface/skins/w3-exhibition
 *
 * If VwWavePlayer find this skin in your child theme folder, it will override the factory one.
 *
 * @package VwWavePlayer/Skins
 */

defined( 'ABSPATH' ) || exit;

?>
<div id="<?php echo esc_attr( $args['id'] ); ?>" class="<?php echo esc_attr( $args['classes'] ); ?>" <?php echo $args['dataset']; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="vwwvpl-cover">
		<div class="vwwvpl-poster"></div>
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
	<div class="vwwvpl-interface">
		<div class="vwwvpl-controls">
			<div class="vwwvpl-icon vwwvpl-prev vwwvpl-disabled"></div>
			<div class="vwwvpl-icon vwwvpl-play"></div>
			<div class="vwwvpl-icon vwwvpl-next vwwvpl-disabled"></div>
		</div>
		<div class="vwwvpl-volume-slider">
			<div class="rail">
				<div class="value"></div>
			</div>
			<div class="handle"></div>
			<div class="touchable"></div>
		</div>
		<div class="vwwvpl-infobar">
			<div class="vwwvpl-playing-info"><div class="vwwvpl-infoblock"></div></div>
		</div>
	</div>
	<div class="vwwvpl-playlist">
		<div class="vwwvpl-playlist-wrapper"></div>
	</div>
</div>
