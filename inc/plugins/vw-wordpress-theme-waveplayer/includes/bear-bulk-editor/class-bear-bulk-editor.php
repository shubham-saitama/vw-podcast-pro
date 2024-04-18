<?php
/**
 * Add support to the Bear Bulk Editor plugin
 *
 * @package VwWavePlayer/Bear_Bulk_Editor
 */

namespace PerfectPeach\VwWavePlayer\Integrations;

defined( 'ABSPATH' ) || exit;

/**
 * Add support to the Bear Bulk Editor plugin
 *
 * @package VwWavePlayer/Bear_Bulk_Editor
 */
class Bear_Bulk_Editor {
	public static function init() {
		if ( class_exists( 'WOOBE_EXT' ) ) {
			require_once __DIR__ . '/preview_files/preview_files.php';
		}
	}
}

Bear_Bulk_Editor::init();
