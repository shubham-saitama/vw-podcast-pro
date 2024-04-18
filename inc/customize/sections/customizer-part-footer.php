<?php

$wp_customize->add_section(
    'vw_podcast_pro_footer_sec',
    array(
        'title' => __('Footer Settings', 'vw-podcast-pro'),
        'description' => __('Add Footer setting here.', 'vw-podcast-pro'),
        'panel' => 'vw_podcast_pro_panel_id',
    )
);


$wp_customize->add_setting(
    'vw_podcast_pro_footer_bgcolor',
    array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'vw_podcast_pro_footer_bgcolor',
        array(
            'label' => __('Background Color', 'vw-podcast-pro'),
            'section' => 'vw_podcast_pro_footer_sec',
            'settings' => 'vw_podcast_pro_footer_bgcolor',
        )
    )
);
$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_footer_bgcolor', array(
	'selector' => 'div#header .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_footer_bgcolor',
) );
$wp_customize->add_setting(
	'vw_podcast_pro_footer_bg_image',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_footer_bg_image',
		array(
			'label' => __('Background image ', 'vw-podcast-pro'),
            'description' => __('Add an image atleast 1920x768 px'),
			'section' => 'vw_podcast_pro_footer_sec',
			'settings' => 'vw_podcast_pro_footer_bg_image'
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_footer_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_footer_title_settings',  
		array(
			'label' => __('Footer Text Setting', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_footer_sec'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_footer_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_footer_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_footer_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_footer_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_footer_title_font_family',
	array(
		'section' => 'vw_podcast_pro_footer_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_footer_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_footer_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' =>__('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_footer_sec',
		'setting' => 'vw_podcast_pro_footer_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_footer_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_footer_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_footer_sec',
			'settings' => 'vw_podcast_pro_footer_title_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_footer_headings_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_footer_headings_settings',
		array(
			'label' => __('Footer Headings Setting', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_footer_sec'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_footer_headings_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_footer_headings_font_weight',
	array(
		'section' => 'vw_podcast_pro_footer_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_footer_headings_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_footer_headings_font_family',
	array(
		'section' => 'vw_podcast_pro_footer_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_footer_headings_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_footer_headings_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' =>__('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_footer_sec',
		'setting' => 'vw_podcast_pro_footer_headings_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_footer_headings_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_footer_headings_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_footer_sec',
			'settings' => 'vw_podcast_pro_footer_headings_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_spanish_footer_col_4',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_spanish_footer_col_4',
		array(
			'label' => __('column 4 Gradient Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_footer_sec'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_btn_color_bg_grad_one',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_spanish_show_all_btn_color_bg_grad_one',
		array(
			'label' => __('Gradient Color 1', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_footer_sec',
			'settings' => 'vw_podcast_pro_spanish_show_all_btn_color_bg_grad_one',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_btn_color_bg_grad_two',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_spanish_show_all_btn_color_bg_grad_two',
		array(
			'label' => __('Gradient Color 2', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_footer_sec',
			'settings' => 'vw_podcast_pro_spanish_show_all_btn_color_bg_grad_two',
		)
	)
);
for ($i = 1; $i <= 4; $i++) {
	$wp_customize->add_setting(
		'vw_podcast_pro_vision_footer_social_icons'.$i,
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(
		new vw_podcast_pro_Fontawesome_Icon_Chooser(
			$wp_customize,
			'vw_podcast_pro_vision_footer_social_icons'.$i,
			array(
				'section' => 'vw_podcast_pro_footer_sec',
				'type' => 'icon',
				'label' => esc_html__('Social Icon '.$i, 'vw-podcast-pro'),
			)
		)
	);
	$wp_customize->add_setting(
		'vw_podcast_pro_footer_social_icons_image_link' .$i,
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'vw_podcast_pro_footer_social_icons_image_link' .$i,
		array(
			'label' => __('Social Icon '.$i. ' Link', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_footer_sec',
			'setting' => 'vw_podcast_pro_footer_social_icons_image_link' .$i,
			'type' => 'text'
		)
	);	
}




$wp_customize->add_setting(
	'vw_podcast_pro_footer_copyright_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_footer_copyright_text',
	array(
		'label' => __('Copyright Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_footer_sec',
		'setting' => 'vw_podcast_pro_footer_copyright_text',
		'type' => 'text'
	)
);
