<?php
/**
 * Skin Name: Info'n'Wave
 * Supports: size,infobar
 * Author: VW Waveplayer
 * Version: 3.3.0
 * Author URI: 
 * Description: A minimal interface with just the waveform, the play button and the info bar
 *
 * You can customize this interface copying the whole folder
 * in your current child theme folder, in the following location:
 * /wp-content/themes/<your-child-theme>/vwwaveplayer/interface/skins/info_n_wave
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
		<div class="vwwvpl-waveform"></div>
	</div>
        <div class="vwwvpl-playing-info"><div class="vwwvpl-infoblock"></div></div>
</div>
