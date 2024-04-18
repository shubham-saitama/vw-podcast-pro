<?php
/**
 * Plugin Name: VW WavePlayer
 * Plugin URI: 
 * Description: VW WavePlayer is an audio player that uses the waveform of each track as its timeline.
 * Author: VW Waveplayer
 * Version: 1.0.0
 * Author URI: 
 * Requires PHP: 7.4
 * Text Domain: vw-waveplayer
 * Domain Path: /languages
 *
 * WC requires at least: 5.0
 * WC tested up to: 8.2.1
 *
 * @package VwWavePlayer
 */

namespace PerfectPeach\VwWavePlayer; //phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound

defined( 'ABSPATH' ) || exit;

require_once 'includes/class-vwwaveplayer.php';
require_once 'includes/class-debug.php';

/**
 * Returns the main instance of VwWavePlayer.
 *
 * @since  3.0.0
 * @return VwWavePlayer
 */
function vwwaveplayer() {
	return VwWavePlayer::instance( __FILE__ );
}

$GLOBALS['vwwaveplayer'] = vwwaveplayer();
