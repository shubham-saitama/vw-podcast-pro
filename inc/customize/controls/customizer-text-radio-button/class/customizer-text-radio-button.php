<?php
/**
 * The range value customize control extends the WP_Customize_Control class.
 *
 * Alpha Color Picker Custom Control
 *
 * @author Braad Martin <http://braadmartin.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Text Radio Button Custom Control
 */
 class vw_podcast_pro_Text_Radio_Button_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'text_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'vwthemes-text-radio-button-style', get_template_directory_uri(). '/inc/customize/controls/customizer-text-radio-button/css/customizer-text-radio-button.css', null, '1.0.0' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
			<div class="text_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

			<div class="radio-buttons">
				<?php foreach ( $this->choices as $key => $value ) { ?>
 					<label class="radio-button-label">
 						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
 						<span><?php echo esc_attr( $value ); ?></span>
 					</label>
 				<?php	} ?>
			</div>
			</div>
		<?php
		}
	}

/**
 * Text sanitization
 *
 * @param  string	Input to be sanitized (either a string containing a single string or multiple, separated by commas)
 * @return string	Sanitized input
 */
if ( ! function_exists( 'vw_podcast_pro_text_sanitization' ) ) {
	function vw_podcast_pro_text_sanitization( $input ) {
		if ( strpos( $input, ',' ) !== false) {
			$input = explode( ',', $input );
		}
		if( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[$key] = sanitize_text_field( $value );
			}
			$input = implode( ',', $input );
		}
		else {
			$input = sanitize_text_field( $input );
		}
		return $input;
	}
}
