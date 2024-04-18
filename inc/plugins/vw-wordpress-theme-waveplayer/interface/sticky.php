<?php
/**
 * You can customize this interface copying the whole folder
 * in your current child theme folder, in the following location:
 * /wp-content/themes/<your-child-theme>/vwwaveplayer/interface/skins
 *
 * If VwWavePlayer find this skin in your child theme folder, it will override the factory one.
 *
 * @package VwWavePlayer/skins
 */

defined( 'ABSPATH' ) || exit;

/*
This is the HTML markup used for the sticky player.

You can customize this interface copying this file
in your current child theme folder, in the following location:
/wp-content/themes/<your-child-theme>/vwwaveplayer/interface/sticky.php

If VwWavePlayer find this file in your child theme folder, it will override the factory one.

*/

?>

<div id="vwwvpl-sticky-player" class="<?php echo esc_attr( $classes ); ?>">
	<div class="vwwvpl-container">
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
		<div class="vwwvpl-wave">
			<div class="vwwvpl-position">0:00</div>
			<div class="vwwvpl-waveform"></div>
			<div class="vwwvpl-duration">0:00</div>
		</div>
		<div class="vwwvpl-trackinfo"></div>
		<button type="button" class="vwwvpl-sticky-player-toggle"></button>
	</div>
</div>
