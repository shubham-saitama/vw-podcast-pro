<?php
/**
 * Skin Name: Mini Thumb
 * Supports: size,shape
 * Author: VW Waveplayer
 * Version: 3.3.0
 * Author URI: 
 * Description: The perfect skin when you need a simple play button enclosed in the track or product thumbnail
 *
 * You can customize this interface copying the whole folder
 * in your current child theme folder, in the following location:
 * /wp-content/themes/<your-child-theme>/vwwaveplayer/interface/skins/mini_thumb
 *
 * If VwWavePlayer find this skin in your child theme folder, it will override the factory one.
 *
 * @package VwWavePlayer/Skins
 */

defined( 'ABSPATH' ) || exit;

?>
<div id="<?php echo esc_attr( $args['id'] ); ?>" class="<?php echo esc_attr( $args['classes'] ); ?>" <?php echo $args['dataset']; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="vwwvpl-main-block">
		<div class="vwwvpl-poster"></div>
		<div class="vwwvpl-controls">
			<div class="vwwvpl-icon vwwvpl-play"></div>
		</div>
	</div>
</div>
