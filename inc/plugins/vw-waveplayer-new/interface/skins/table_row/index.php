<?php
/**
 * Skin Name: Table Row
 * Supports: size
 * Author: VW Waveplayer
 * Version: 3.0.0
 * Author URI: 
 * Description: An interface that shows the player as a table row. This is ideal to show multiple players in a table.
 *
 * You can customize this interface copying the whole folder
 * in your current child theme folder, in the following location:
 * /wp-content/themes/<your-child-theme>/vwwaveplayer/interface/skins/table_row
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
		<div class="vwwvpl-controls">
			<div class="vwwvpl-icon vwwvpl-play"></div>
		</div>
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
	<div class="vwwvpl-infobar">
		<div class="vwwvpl-playing-info"><div class="vwwvpl-infoblock"></div></div>
	</div>
</div>
