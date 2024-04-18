<?php
/**
 * Skin Name: WavePlayer2 Legacy
 * Supports: size,shape,infobar,playlist
 * Author: VW Waveplayer
 * Version: 3.0.0
 * Author URI: 
 * Description: This is the traditional WavePlayer2 visual interface. If you have been using VwWavePlayer 2, we recommend selecting this skin to minimize the chances of problems with your current customization.
 *
 * You can customize this interface copying the whole folder
 * in your current child theme folder, in the following location:
 * /wp-content/themes/<your-child-theme>/vwwaveplayer/interface/skins/w2-legacy
 *
 * If VwWavePlayer find this skin in your child theme folder, it will override the factory one.
 *
 * @package VwWavePlayer/skins
 */

defined( 'ABSPATH' ) || exit;

?>
<div id="<?php echo esc_attr( $args['id'] ); ?>" class="<?php echo esc_attr( $args['classes'] ); ?>" <?php echo $args['dataset']; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="vwwvpl-left-box" style="background-image:url(<?php echo esc_attr( $args['default_thumbnail'] ); ?>)">
		<div class="vwwvpl-interface">
			<div class="vwwvpl-volume-overlay"></div>
			<div class="vwwvpl-icon vwwvpl-info"></div>
			<div class="vwwvpl-controls">
				<div class="vwwvpl-icon vwwvpl-prev vwwvpl-disabled"></div>
				<div class="vwwvpl-icon vwwvpl-play"></div>
				<div class="vwwvpl-icon vwwvpl-next vwwvpl-disabled"></div>
			</div>
			<?php if ( isset( $args['volume_mode'] ) && 'slider' === $args['volume_mode'] ) { ?>
				<div class="vwwvpl-volume-slider">
					<div class="rail">
						<div class="value"></div>
					</div>
					<div class="handle"></div>
					<div class="touchable"></div>
				</div>
			<?php } else { ?>
				<div class="vwwvpl-icon vwwvpl-volume vwwvpl-volume_up"></div>
			<?php } ?>
		</div>
		<div class="vwwvpl-poster"></div>
	</div>
	<div class="vwwvpl-right-box">
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
		<div class="vwwvpl-duration"></div>
		<div class="vwwvpl-waveform"></div>
		<div class="vwwvpl-infobar">
			<div class="vwwvpl-playing-info"><div class="vwwvpl-infoblock"></div></div>
		</div>
	</div>
	<div class="vwwvpl-playlist">
		<div class="vwwvpl-playlist-wrapper"></div>
	</div>
</div>
