<?php
/**
 * Debug class that takes advantage of the logging capabilities of the Query Monitor plugin.
 *
 * @package VwWavePlayer/Debug
 */

namespace PerfectPeach\VwWavePlayer; //phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound

defined( 'ABSPATH' ) || exit;

/**
 * A class with some simple debugging tools
 *
 * @package VwWavePlayer/Debug
 */
class Debug {

	/**
	 * Store the start time.
	 *
	 * @var int
	 */
	public static $start = 0;

	public static $timers = array();

	public static function is_debug_enabled() {
		if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
			return false;
		}

		return true;
	}

	/**
	 * Log a variable to the Query Monitor Log panel.
	 *
	 * @since 3.5.2
	 * @param mixed ...$vars A list of variables that will be output to the log file.
	 */
	public static function debug( ...$vars ) {
		if ( ! self::is_debug_enabled() ) {
			return;
		}

		if ( count( $vars ) === 1 ) {
			$vars = $vars[0];
		}

		do_action( 'qm/debug', $vars );
	}

	/**
	 * Log a variable to the Query Monitor Log panel.
	 *
	 * This is an alias of the debug() method.
	 *
	 * @since 3.0.0
	 * @since 3.5.2 An alias of the debug() method.
	 * @param mixed ...$vars A list of variables that will be output to the log file.
	 */
	public static function log( ...$vars ) {
		self::debug( ...$vars );
	}

	public static function start( $label = 'vwwaveplayer' ) {
		if ( ! self::is_debug_enabled() ) {
			return;
		}

		do_action( 'qm/start', $label );
	}

	public static function lap( $label = 'vwwaveplayer', $lap_name = null ) {
		if ( ! self::is_debug_enabled() ) {
			return;
		}

		do_action( 'qm/lap', $label, $lap_name );
	}

	public static function stop( $label = 'vwwaveplayer' ) {
		if ( ! self::is_debug_enabled() ) {
			return;
		}

		do_action( 'qm/stop', $label );
	}

	/**
	 * Set the $start property to the current microtime.
	 *
	 * @since 3.0.0
	 */
	public static function timer_start() {
		if ( ! self::is_debug_enabled() ) {
			return;
		}

		self::$start = microtime( true );
	}

	/**
	 * Output the elapsed microtime since the $start property
	 * and reset the $start property to the current microtime
	 *
	 * @since 3.0.0
	 * @param string $label The descriptive label being output to the log file
	 *                      before the current microtime.
	 */
	public static function timer_delta( $label = 'delta' ) {
		if ( ! self::is_debug_enabled() ) {
			return;
		}

		$t     = microtime( true );
		$delta = sprintf( '%.3f', 1000 * ( $t - self::$start ) );
		self::log( "$label: $delta" );
		self::$start = $t;
	}
}
