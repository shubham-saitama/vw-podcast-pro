<?php
/**
 * Elementor_Color_Tuplet_Control class
 *
 * @package VwWavePlayer/Elementor
 */

namespace PerfectPeach\VwWavePlayer; //phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound

use \Elementor\Plugin as Elementor;
use \Elementor\Modules\DynamicTags\Module as TagsModule;

defined( 'ABSPATH' ) || exit;

/**
 * Control_Color_Tuplet class
 *
 * @package VwWavePlayer/Elementor
 */
class Elementor_Color_Tuplet_Control extends \Elementor\Base_Data_Control {

	/**
	 * Redefines the default get_type method of the base class
	 *
	 * @since  3.0.0
	 * @return string The type of control
	 */
	public function get_type() {
		return 'colorTuplet';
	}

	/**
	 * Enqueue the required script
	 *
	 * @since  3.0.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'vwwaveplayer-elementor-controls' );
	}

	/**
	 * Output the HTML markup of the control template
	 *
	 * @since  3.0.0
	 */
	public function content_template() {
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">{{{ data.label || '' }}}</label>
			<div class="elementor-control-input-wrapper elementor-control-dynamic-switcher-wrapper elementor-control-unit-5">
				<div class="elementor-color-picker-placeholder"></div>
				<div class="elementor-color-picker-placeholder"></div>
			</div>
		</div>
		<?php
	}


	/**
	 * Return the default settings for the control
	 *
	 * @since  3.0.0
	 * @return array
	 */
	protected function get_default_settings() {
		return array(
			'alpha'   => true,
			'scheme'  => '',
			'dynamic' => array(
				'categories' => array( 'colorTuplet' ),
				'returnType' => 'object',
			),
		);
	}
}
