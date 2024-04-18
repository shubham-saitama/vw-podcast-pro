<?php
/**
 * Provide an array of options for the VwWavePlayer settings
 *
 * @package VwWavePlayer/Admin
 */

defined( 'ABSPATH' ) || exit;

$vwwaveplayer_admin_page_options = array(

	'player'       => array(
		'label'       => esc_html__( 'Player', 'vwwaveplayer' ),
		'title'       => esc_html__( 'Player Default Options', 'vwwaveplayer' ),
		'description' => esc_html__( 'If one of the following parameters is not specified in a shortcode, the player is going to use the following default settings.', 'vwwaveplayer' ),
		'settings'    => array(
			'autoplay'            => array(
				'label'       => esc_html__( 'Autoplay', 'vwwaveplayer' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'If checked, the player will start playing back its playlist as soon as the page that contains it finishes loading up.', 'vwwaveplayer' ),
				'value'       => 1,
			),
			'repeat'              => array(
				'label'       => esc_html__( 'Repeat all', 'vwwaveplayer' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'If checked, the player will continuously play back its playlist. At the end of the last track, the player will restart from the first one.', 'vwwaveplayer' ),
				'value'       => 1,
			),
			'shuffle'             => array(
				'label'       => esc_html__( 'Shuffle', 'vwwaveplayer' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'If checked, the tracks of each player will be shuffled in a random order every time the page containing the player loads.', 'vwwaveplayer' ),
				'value'       => 1,
			),
			'audio_override'      => array(
				'label'       => esc_html__( 'Audio override', 'vwwaveplayer' ),
				'type'        => 'checkbox',
				'description' => wp_kses( __( 'If checked, every <code>[audio]</code> and <code>[playlist]</code> shortcode will be replaced with VwWavePlayer.', 'vwwaveplayer' ), 'post' ),
				'value'       => 1,
			),
			'jump'                => array(
				'label'       => esc_html__( 'Jump to the next player', 'vwwaveplayer' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'If checked, upon completion of a playlist, the next player in the page will start.', 'vwwaveplayer' ),
				'value'       => 1,
			),
			'media_library_title' => array(
				'label'       => esc_html__( 'Use title in Media Library thumbnail', 'vwwaveplayer' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'By default, WordPress uses file names to describe the thumbnail of an audio track in the Media Library. Setting this option, the thumbnail will display the title instead.', 'vwwaveplayer' ),
				'value'       => 1,
			),
		),
	),

	'style'        => array(
		'label'       => esc_html__( 'Style', 'vwwaveplayer' ),
		'title'       => esc_html__( 'Styling Options', 'vwwaveplayer' ),
		'description' => esc_html__( 'A VwWavePlayer instance will follow the default values. You can ovverride each option when adding a new instance to a post or page.', 'vwwaveplayer' ),
		'settings'    => array(
			'skin'                   => array(
				'label'            => esc_html__( 'Skin', 'vwwaveplayer' ),
				'type'             => 'select',
				'description'      => esc_html__( 'Select the skin for the default player instances.', 'vwwaveplayer' ),
				'options_callback' => array( '\PerfectPeach\VwWavePlayer\Renderer', 'get_skin_options' ),
				'callback_params'  => array( '' ),
			),
			'style'                  => array(
				'label'       => esc_html__( 'Style', 'vwwaveplayer' ),
				'type'        => 'select',
				'description' => wp_kses( __( 'The style of the interface can be set to follow the <code>prefers-color-scheme</code> of the device or forced to <strong>light</strong> or <strong>dark</strong><br/>Modern browsers can now react to the the <strong>light</strong> or <strong>dark</strong> mode of the user device.', 'vwwaveplayer' ), 'post' ),
				'options'     => array(
					'light'                => array(
						'label' => esc_html__( 'Light', 'vwwaveplayer' ),
						'value' => 'light',
					),
					'dark'                 => array(
						'label' => esc_html__( 'Dark', 'vwwaveplayer' ),
						'value' => 'dark',
					),
					'prefers-color-scheme' => array(
						'label' => esc_html__( 'Use "prefers-color-scheme" setting', 'vwwaveplayer' ),
						'value' => 'color-scheme',
					),
				),
			),
			'size'                   => array(
				'label'       => esc_html__( 'Size', 'vwwaveplayer' ),
				'type'        => 'select',
				'description' => esc_html__( 'The player comes in four different sizes: large, medium, small and extra small, that correspond to heights of 200px, 160px, 120px and 80 px respectively.', 'vwwaveplayer' ),
				'options'     => array(
					'large'  => array(
						'label' => esc_html__( 'Large', 'vwwaveplayer' ),
						'value' => 'lg',
					),
					'medium' => array(
						'label' => esc_html__( 'Medium', 'vwwaveplayer' ),
						'value' => 'md',
					),
					'small'  => array(
						'label' => esc_html__( 'Small', 'vwwaveplayer' ),
						'value' => 'sm',
					),
					'xsmall' => array(
						'label' => esc_html__( 'Extra Small', 'vwwaveplayer' ),
						'value' => 'xs',
					),
				),
			),
			'shape'                  => array(
				'label'       => esc_html__( 'Shape', 'vwwaveplayer' ),
				'type'        => 'select',
				'description' => esc_html__( 'The thumbnail of the active track is displayed inside a container that can have three different shapes: square, circle and rounded.', 'vwwaveplayer' ),
				'options'     => array(
					'square'  => array(
						'label' => esc_html__( 'Square', 'vwwaveplayer' ),
						'value' => 'square',
					),
					'circle'  => array(
						'label' => esc_html__( 'Circle', 'vwwaveplayer' ),
						'value' => 'circle',
					),
					'rounded' => array(
						'label' => esc_html__( 'Rounded', 'vwwaveplayer' ),
						'value' => 'rounded',
					),
				),
			),
			'default_font'           => array(
				'label'            => esc_html__( 'Default font', 'vwwaveplayer' ),
				'type'             => 'select',
				'description'      => wp_kses( __( 'Select the font for the default player instances. This is a list of the 50 most popular Google Fonts. By selecting <strong>\'default\'</strong>, VwWavePlayer will inherit the font of its container.', 'vwwaveplayer' ), 'post' ),
				'options_callback' => array( '\PerfectPeach\VwWavePlayer\Admin', 'get_google_fonts_options' ),
				'callback_params'  => array( '' ),
			),
			'base_font_size'         => array(
				'label'       => esc_html__( 'Base font size', 'vwwaveplayer' ),
				'type'        => 'number',
				'description' => esc_html__( 'Select the base font size of the texts in the player.', 'vwwaveplayer' ),
			),
			'sticky_player_position' => array(
				'label'       => esc_html__( 'Sticky Player Position', 'vwwaveplayer' ),
				'type'        => 'select',
				'description' => esc_html__( 'Select whether the sticky player is going to be disabled or show at the top or bottom of the window.', 'vwwaveplayer' ),
				'options'     => array(
					'disabled' => array(
						'label' => esc_html__( 'Disabled', 'vwwaveplayer' ),
						'value' => 'disabled',
					),
					'bottom'   => array(
						'label' => esc_html__( 'Bottom', 'vwwaveplayer' ),
						'value' => 'bottom',
					),
					'top'      => array(
						'label' => esc_html__( 'Top', 'vwwaveplayer' ),
						'value' => 'top',
					),
				),
			),
			'info'                   => array(
				'label'       => esc_html__( 'Display Info', 'vwwaveplayer' ),
				'type'        => 'select',
				'description' => esc_html__( 'Select whether to display the info bar, the playlist or nothing.', 'vwwaveplayer' ),
				'options'     => array(
					'none'     => array(
						'label' => esc_html__( 'None', 'vwwaveplayer' ),
						'value' => 'none',
					),
					'info'     => array(
						'label' => esc_html__( 'Info bar', 'vwwaveplayer' ),
						'value' => 'info',
					),
					'playlist' => array(
						'label' => esc_html__( 'Info bar and playlist', 'vwwaveplayer' ),
						'value' => 'playlist',
					),
				),
			),
			'full_width_playlist'    => array(
				'label'       => esc_html__( 'Full width playlist', 'vwwaveplayer' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'If checked, the playlist will span across the full width of the player, instead of just under the waveform.', 'vwwaveplayer' ),
				'value'       => 1,
			),
			'default_thumbnail'      => array(
				'label'       => esc_html__( 'Default thumbnail', 'vwwaveplayer' ),
				'type'        => 'picture',
				'description' => esc_html__( 'Set the image to be displayed as a default thumbnail, whenever an audio track has no featured image associated.', 'vwwaveplayer' ),
				'value'       => 1,
			),
			'default_thumbnail_size' => array(
				'label'            => esc_html__( 'Default thumbnail size', 'vwwaveplayer' ),
				'type'             => 'select',
				'description'      => esc_html__( 'For better results, we recommend to select square sizes.', 'vwwaveplayer' ),
				'options_callback' => array( '\PerfectPeach\VwWavePlayer\Renderer', 'get_registered_image_sizes' ),
				'callback_params'  => array( '' ),
			),
		),
	),

	'palettes'     => array(
		'label'       => esc_html__( 'Palettes', 'vwwaveplayer' ),
		'title'       => esc_html__( 'Player Palettes', 'vwwaveplayer' ),
		'description' => esc_html__( 'Here you can change the basic colors applying to every skin, such as text, border or background colors. You can also create your own palette to easily switch between different configurations.', 'vwwaveplayer' ),
		'settings'    => array(),
	),

	'waveform'     => array(
		'label'       => esc_html__( 'Waveform', 'vwwaveplayer' ),
		'title'       => esc_html__( 'Waveform Options and Colors', 'vwwaveplayer' ),
		'description' => esc_html__( 'If one of the following parameters is not specified in a shortcode, the player is going to use the following default settings.', 'vwwaveplayer' ),
		'settings'    => array(),
	),

	'placeholders' => array(
		'label'    => esc_html__( 'Placeholders', 'vwwaveplayer' ),
		'title'    => esc_html__( 'Placeholder Templates', 'vwwaveplayer' ),
		'settings' => array(),
	),

	'advanced'     => array(
		'label'       => esc_html__( 'Advanced', 'vwwaveplayer' ),
		'title'       => esc_html__( 'Advanced', 'vwwaveplayer' ),
		'description' => esc_html__( 'You can add your custom CSS rulesets and Javascript functions in the text area below', 'vwwaveplayer' ),
		'settings'    => array(
			'custom_css' => array(
				'label' => esc_html__( 'Custom CSS', 'vwwaveplayer' ),
				'type'  => 'textarea',
				'value' => '',
				'rows'  => 20,
				'class' => 'monospace',
			),
			'custom_js'  => array(
				'label' => esc_html__( 'Custom Javascript', 'vwwaveplayer' ),
				'type'  => 'textarea',
				'value' => '',
				'rows'  => 20,
				'class' => 'monospace',
			),
		),
	),

	'woocommerce'  => array(
		'label'     => esc_html__( 'WooCommerce', 'vwwaveplayer' ),
		'title'     => esc_html__( 'WooCommerce Options', 'vwwaveplayer' ),
		'condition' => defined( 'WC_VERSION' ),
		'settings'  => array(),
	),

	'tools'        => array(
		'label'    => esc_html__( 'Tools', 'vwwaveplayer' ),
		'title'    => esc_html__( 'Tools', 'vwwaveplayer' ),
		'settings' => array(),
	),

);
