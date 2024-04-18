<?php

// Sidebar 

$wp_customize->add_section(
	'vw_podcast_pro_sidebar_section',
	array(
		'title' => __('sidebar Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_primary_menu_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_primary_menu_settings',
		array(
			'label' => __('Sidebar Primary Menu Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_primary_menu_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_primary_menu_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_sidebar_section',
		'setting' => 'vw_podcast_pro_sidebar_primary_menu_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_primary_menu_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_primary_menu_font_weight',
	array(
		'section' => 'vw_podcast_pro_sidebar_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_primary_menu_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_primary_menu_font_family',
	array(
		'section' => 'vw_podcast_pro_sidebar_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_primary_menu_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_primary_menu_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section',
			'settings' => 'vw_podcast_pro_sidebar_primary_menu_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_primary_menu_color_bg',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_primary_menu_color_bg',
		array(
			'label' => __('Background Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section',
			'settings' => 'vw_podcast_pro_sidebar_primary_menu_color_bg',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_seconday_menu_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_seconday_menu_title_settings',
		array(
			'label' => __('Secondary Menu Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section'
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_seconday_menu_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_seconday_menu_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_sidebar_section',
		'setting' => 'vw_podcast_pro_sidebar_seconday_menu_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_seconday_menu_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_seconday_menu_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_sidebar_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_seconday_menu_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_seconday_menu_title_font_family',
	array(
		'section' => 'vw_podcast_pro_sidebar_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_seconday_menu_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_seconday_menu_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section',
			'settings' => 'vw_podcast_pro_sidebar_seconday_menu_title_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_browse_menu_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_browse_menu_settings',
		array(
			'label' => __('Sidebar Browse Menu Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_browse_menu_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_browse_menu_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_sidebar_section',
		'setting' => 'vw_podcast_pro_sidebar_browse_menu_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_browse_menu_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_browse_menu_font_weight',
	array(
		'section' => 'vw_podcast_pro_sidebar_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_browse_menu_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_browse_menu_font_family',
	array(
		'section' => 'vw_podcast_pro_sidebar_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_browse_menu_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_browse_menu_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section',
			'settings' => 'vw_podcast_pro_sidebar_browse_menu_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_library_menu_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_library_menu_settings',
		array(
			'label' => __('Sidebar Library Menu Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_library_menu_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_library_menu_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_sidebar_section',
		'setting' => 'vw_podcast_pro_sidebar_library_menu_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_library_menu_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_library_menu_font_weight',
	array(
		'section' => 'vw_podcast_pro_sidebar_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_library_menu_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_sidebar_library_menu_font_family',
	array(
		'section' => 'vw_podcast_pro_sidebar_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_sidebar_library_menu_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_sidebar_library_menu_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_sidebar_section',
			'settings' => 'vw_podcast_pro_sidebar_library_menu_color',
		)
	)
);


// sidebar ends 




// Audio book setting 


$wp_customize->add_section(
	'vw_podcast_pro_category_section',
	array(
		'title' => __('Category Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_category_sec_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_category_sec_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_category_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_category_taxonomy_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_category_taxonomy_title_settings',
		array(
			'label' => __('Category Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_category_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_category_taxonomy_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_category_taxonomy_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_category_section',
		'setting' => 'vw_podcast_pro_category_taxonomy_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_category_taxonomy_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_category_taxonomy_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_category_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_category_taxonomy_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_category_taxonomy_title_font_family',
	array(
		'section' => 'vw_podcast_pro_category_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_category_taxonomy_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_category_taxonomy_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_category_section',
			'settings' => 'vw_podcast_pro_category_taxonomy_title_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_category_taxonomy_title_color_bg',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_category_taxonomy_title_color_bg',
		array(
			'label' => __('Background Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_category_section',
			'settings' => 'vw_podcast_pro_category_taxonomy_title_color_bg',
		)
	)
);

// Audio book ends 


// history and ad Secton 




$wp_customize->add_section(
	'vw_podcast_pro_history_section',
	array(
		'title' => __('History and Ad Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_history_sec_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_history_sec_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_history_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_history_sec_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_history_sec_image_enable',
));



$wp_customize->add_setting(
	'vw_podcast_pro_history_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_history_title_settings',
		array(
			'label' => __('History Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_history_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_history_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_history_section',
		'setting' => 'vw_podcast_pro_history_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_history_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_history_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_history_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_history_title_font_family',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_history_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_history_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section',
			'settings' => 'vw_podcast_pro_history_title_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_history_song_des_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_history_song_des_settings',
		array(
			'label' => __('History Song Descreptin Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_history_song_des_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_history_song_des_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_history_section',
		'setting' => 'vw_podcast_pro_history_song_des_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_history_song_des_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_history_song_des_font_weight',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_history_song_des_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_history_song_des_font_family',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_history_song_des_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_history_song_des_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section',
			'settings' => 'vw_podcast_pro_history_song_des_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_history_title_color_bg',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_history_title_color_bg',
		array(
			'label' => __('History Section BG Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section',
			'settings' => 'vw_podcast_pro_history_title_color_bg',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_ad_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_ad_title_settings',
		array(
			'label' => __('Advertisement Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_history_section',
		'setting' => 'vw_podcast_pro_ad_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_title_font_family',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_ad_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section',
			'settings' => 'vw_podcast_pro_ad_title_color',
		)
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_ad_timer_taxonomy_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_ad_timer_taxonomy_settings',
		array(
			'label' => __('Addvertisement Timer and Entry Fee Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_timer_taxonomy_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_timer_taxonomy_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_history_section',
		'setting' => 'vw_podcast_pro_ad_timer_taxonomy_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_timer_taxonomy_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_timer_taxonomy_font_weight',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_timer_taxonomy_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_timer_taxonomy_font_family',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_timer_taxonomy_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_ad_timer_taxonomy_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section',
			'settings' => 'vw_podcast_pro_ad_timer_taxonomy_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_artistName_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_ad_artistName_settings',
		array(
			'label' => __('Advertisment Artist Name Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_artistName_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_artistName_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_history_section',
		'setting' => 'vw_podcast_pro_ad_artistName_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_artistName_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_artistName_font_weight',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_artistName_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_artistName_font_family',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_artistName_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_ad_artistName_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section',
			'settings' => 'vw_podcast_pro_ad_artistName_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_proad_event_schedule_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_proad_event_schedule_text_settings',
		array(
			'label' => __('Event Schedule Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_proad_event_schedule_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_proad_event_schedule_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_history_section',
		'setting' => 'vw_podcast_proad_event_schedule_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_proad_event_schedule_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_proad_event_schedule_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_proad_event_schedule_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_proad_event_schedule_text_font_family',
	array(
		'section' => 'vw_podcast_pro_history_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_proad_event_schedule_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_proad_event_schedule_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_history_section',
			'settings' => 'vw_podcast_proad_event_schedule_text_color',
		)
	)
);

// history and ad section ends 




// trending section 

$wp_customize->add_section(
	'vw_podcast_pro_trending_section',
	array(
		'title' => __('Trending Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_sec_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_sec_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section?', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_trending_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_sec_is_membership',
	array(
		'default' => 'Disable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_sec_is_membership',
	array(
		'type' => 'radio',
		'label' => __('Make This Section Members Only Section?', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_trending_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_heading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_heading',
	array(
		'label' => __('Section Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_trending_section',
		'setting' => 'vw_podcast_pro_trending_heading',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_trending_language',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_language',
	array(
		'label' => __('Section Language', 'vw-podcast-pro'),
		'description' => __('Leave empty to render trending across all languages.', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_trending_section',
		'setting' => 'vw_podcast_pro_trending_language',
		'type' => 'text'
	)
);

$args = array(
	'post_type' => 'Songs',
	'taxonomy' => 'song_categories',
	'hide_empty' => false
);
$categories = get_categories($args);
$cat_product = array();
$i = 0;
foreach ($categories as $category) {
	if ($i == 0) {
		$default = $category->slug;
		$i++;
	}
	$cat_product[$category->slug] = $category->name;
}

$wp_customize->add_setting('vw_podcast_pro_categories', array(
	'default' => array(), // Set the default values as an empty array
	'sanitize_callback' => 'vw_podcast_pro_sanitize_multiselect', // Define a custom sanitize function
)
);

$wp_customize->add_control(new vw_podcast_pro_Multiselect_Control($wp_customize, 'vw_podcast_pro_categories', array(
	'label' => __('Song Categories', 'vw_podcast_pro'),
	'section' => 'vw_podcast_pro_trending_section',
	'choices' => $cat_product,
	'description' => __('Press Ctrl/Cmd and click to select or unselect a category.', 'vw-podcast-pro'),
)
));

function vw_podcast_pro_sanitize_multiselect($input)
{
	if (!is_array($input)) {
		return array();
	}
	return array_map('sanitize_text_field', $input);
}

// $wp_customize->add_setting(
// 	'vw_podcast_pro_trending_single_page_title',
// 	array(
// 		'default' => '',
// 		'sanitize_callback' => 'sanitize_text_field'
// 	)
// );
// $wp_customize->add_control(
// 	'vw_podcast_pro_trending_single_page_title',
// 	array(
// 		'label' => __('Single Page Title', 'vw-podcast-pro'),
// 		'section' => 'vw_podcast_pro_trending_section',
// 		'description' => __('Add Page Title of the page you want to redirect show all btn to.', 'vw-podcast-pro'),
// 		'setting' => 'vw_podcast_pro_trending_single_page_title',
// 		'type' => 'text'
// 	)
// );





$wp_customize->add_setting(
	'vw_podcast_pro_trending_section_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_trending_section_heading_settings',
		array(
			'label' => __('Section Heading Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_trending_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_trending_section_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_section_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_trending_section',
		'setting' => 'vw_podcast_pro_trending_section_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_trending_section_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_section_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_trending_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_section_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_section_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_trending_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_trending_section_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_trending_section_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_trending_section',
			'settings' => 'vw_podcast_pro_trending_section_heading_color',
		)
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_trending_song_title_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_trending_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_song_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_trending_section',
		'setting' => 'vw_podcast_pro_trending_song_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_song_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_trending_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_song_title_font_family',
	array(
		'section' => 'vw_podcast_pro_trending_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_trending_song_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_trending_section',
			'settings' => 'vw_podcast_pro_trending_song_title_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_trending_song_desc_settings',
		array(
			'label' => __('Trending Song Descreption Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_trending_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_song_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_trending_section',
		'setting' => 'vw_podcast_pro_trending_song_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_song_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_trending_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_song_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_trending_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_trending_song_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_trending_song_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_trending_section',
			'settings' => 'vw_podcast_pro_trending_song_desc_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_trending_show_all_btn_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_trending_show_all_btn_settings',
		array(
			'label' => __('Show All Button Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_trending_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_show_all_btn_link',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_show_all_btn_link',
	array(
		'label' => __('Single Song Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_trending_show_all_btn_link',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_trending_show_all_btn_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_show_all_btn_text',
	array(
		'label' => __('Button text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_trending_show_all_btn_text',
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_trending_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_trending_section',
		'setting' => 'vw_podcast_pro_trending_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_trending_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_trending_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_trending_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_trending_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_trending_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_trending_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_trending_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_trending_section',
			'settings' => 'vw_podcast_pro_trending_show_all_btn_color',
		)
	)
);

// history section 



// $wp_customize->add_setting(
// 	'vw_podcast_pro_section_heaing_typography_settings',
// 	array(
// 		'default' => '',
// 		'transport' => 'postMessage',
// 		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
// 	)
// );
// $wp_customize->add_control(
// 	new VW_Themes_Seperator_custom_Control(
// 		$wp_customize,
// 		'vw_podcast_pro_section_heaing_typography_settings',
// 		array(
// 			'label' => __('Heading Typography Settings', 'vw-podcast-pro'),
// 			'section' => 'vw_podcast_pro_history_section'
// 		)
// 	)
// );



// $wp_customize->add_setting(
// 	'vw_podcast_pro_section_heaing_typography_font_size',
// 	array(
// 		'default' => '',
// 		'sanitize_callback' => 'sanitize_text_field'
// 	)
// );
// $wp_customize->add_control(
// 	'vw_podcast_pro_section_heaing_typography_font_size',
// 	array(
// 		'label' => __('Font Size', 'vw-podcast-pro'),
// 		'description' => __('Add font size in px', 'vw-podcast-pro'),
// 		'section' => 'vw_podcast_pro_history_section',
// 		'setting' => 'vw_podcast_pro_section_heaing_typography_font_size',
// 		'type' => 'number'
// 	)
// );
// $wp_customize->add_setting(
// 	'vw_podcast_pro_section_heaing_typography_font_weight',
// 	array(
// 		'default' => '',
// 		'capability' => 'edit_theme_options',
// 		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
// 	)
// );
// $wp_customize->add_control(
// 	'vw_podcast_pro_section_heaing_typography_font_weight',
// 	array(
// 		'section' => 'vw_podcast_pro_history_section',
// 		'label' => __('Font Weight', 'vw-podcast-pro'),
// 		'type' => 'select',
// 		'choices' => $font_weight_array,
// 	)
// );

// $wp_customize->add_setting(
// 	'vw_podcast_pro_section_heaing_typography_font_family',
// 	array(
// 		'default' => '',
// 		'capability' => 'edit_theme_options',
// 		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
// 	)
// );
// $wp_customize->add_control(
// 	'vw_podcast_pro_section_heaing_typography_font_family',
// 	array(
// 		'section' => 'vw_podcast_pro_history_section',
// 		'label' => __('Font Family', 'vw-podcast-pro'),
// 		'type' => 'select',
// 		'choices' => $font_array,
// 	)
// );


// $wp_customize->add_setting(
// 	'vw_podcast_pro_section_heaing_typography_color',
// 	array(
// 		'default' => '',
// 		'sanitize_callback' => 'sanitize_hex_color'
// 	)
// );
// $wp_customize->add_control(
// 	new WP_Customize_Color_Control(
// 		$wp_customize,
// 		'vw_podcast_pro_section_heaing_typography_color',
// 		array(
// 			'label' => __('Color', 'vw-podcast-pro'),
// 			'section' => 'vw_podcast_pro_history_section',
// 			'settings' => 'vw_podcast_pro_section_heaing_typography_color',
// 		)
// 	)
// );




// trending section ends 


$wp_customize->add_section(
	'vw_podcast_pro_advertisement_section',
	array(
		'title' => __('Advertisement and Ad Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_sec_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_advertisement_sec_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_advertisement_sec_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_advertisement_sec_image_enable',
) );

$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_sec_image_bgcolor',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_sec_image_bgcolor',
		array(
			'label' => __('Gradient color 1', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_advertisement_sec_image_bgcolor',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_sec_image_bgcolor_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_sec_image_bgcolor_2',
		array(
			'label' => __('Gradient color 2', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_advertisement_sec_image_bgcolor_2',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_sec_image_bgimage',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_sec_image_bgimage',
		array(
			'label' => __('Background image ', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'description' => __('Remove Background image if you want to set gradient.', 'vw-podcast-pro'),
			'settings' => 'vw_podcast_pro_advertisement_sec_image_bgimage'
		)
	)
);


// floating css
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_sec_floating_wave_img',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_sec_floating_wave_img',
		array(
			'label' => __('Waveform Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_advertisement_sec_floating_wave_img'
		)
	)
);

// floating ends 

$wp_customize->add_setting(
	'vw_podcast_pro_section_event_name_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_section_event_name_settings',
		array(
			'label' => __('Event Name Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_event_name',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_event_name',
	array(
		'label' => __('Event Name', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_event_name',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_event_name_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_event_name_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_event_name_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_event_name_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_event_name_font_weight',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_event_name_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_event_name_font_family',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_section_event_name_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_section_event_name_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_section_event_name_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_section_event_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_section_event_desc_settings',
		array(
			'label' => __('Event Date Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_event_desc',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_event_desc',
	array(
		'label' => __('Event Date', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_event_desc',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_event_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_event_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_event_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_event_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_event_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_event_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_event_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_section_event_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_section_event_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_section_event_desc_color',
		)
	)
);








$wp_customize->add_setting(
	'vw_podcast_pro_section_team_name_1',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_team_name_1',
	array(
		'label' => __('Team One Name', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_team_name_1',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_team_name_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_team_name_2',
	array(
		'label' => __('Team Two Name', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_team_name_2',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_team_name_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_section_team_name_settings',
		array(
			'label' => __('Team Name Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_team_name_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_team_name_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_team_name_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_team_name_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_team_name_font_weight',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_team_name_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_team_name_font_family',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_team_name_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_section_team_name_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_section_team_name_color',
		)
	)
);







$wp_customize->add_setting(
	'vw_podcast_pro_section_cup_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_section_cup_title_settings',
		array(
			'label' => __('Cup Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_cup_title',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_cup_title',
	array(
		'label' => __('Cup Title Name', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_cup_title',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_cup_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_cup_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_cup_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_cup_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_cup_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_cup_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_cup_title_font_family',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_section_cup_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_section_cup_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_section_cup_title_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_team_image_1',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_popular_team_image_1',
		array(
			'label' => __('Team one Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_popular_team_image_1'
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_popular_team_image_2',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_popular_team_image_2',
		array(
			'label' => __('Team Two Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_popular_team_image_2'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_cup_image',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_popular_cup_image',
		array(
			'label' => __('Club Logo (Championship Logo)', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_popular_cup_image'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_vs_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_vs_text_settings',
		array(
			'label' => __('VS text', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_section_vs_text_btn',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_advertisement_section_vs_text_btn',
	array(
		'label' => __('VS Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_advertisement_section_vs_text_btn',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_section_vs_text_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_advertisement_section_vs_text_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_advertisement_section_vs_text_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_section_vs_text_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_advertisement_section_vs_text_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_section_vs_text_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_advertisement_section_vs_text_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_section_vs_text_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_section_vs_text_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_advertisement_section_vs_text_btn_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_section_add_timer_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_section_add_timer_settings',
		array(
			'label' => __('Heading Typography Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_add_timer',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_timer',
	array(
		'label' => __('Add Time', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_add_timer',
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_section_add_timer_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_timer_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_add_timer_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_add_timer_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_timer_font_weight',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_add_timer_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_timer_font_family',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_section_add_timer_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_section_add_timer_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_section_add_timer_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_section_add_button_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_section_add_button_settings',
		array(
			'label' => __('Advertisement Button Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_add_button',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_button',
	array(
		'label' => __('Button Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_add_button',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_add_button_link',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_button_link',
	array(
		'label' => __('Button link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_add_button_link',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_add_button_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_button_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_add_button_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_add_button_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_button_font_weight',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_add_button_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_button_font_family',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_section_add_button_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_section_add_button_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_section_add_button_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_add_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_section_add_text_settings',
		array(
			'label' => __('Text Button below Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_add_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_text',
	array(
		'label' => __('Section Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_add_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_add_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_advertisement_section',
		'setting' => 'vw_podcast_pro_section_add_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_section_add_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_section_add_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_section_add_text_font_family',
	array(
		'section' => 'vw_podcast_pro_advertisement_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_section_add_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_section_add_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_advertisement_section',
			'settings' => 'vw_podcast_pro_section_add_text_color',
		)
	)
);


// advertisement section ends 


// new releases section 


$wp_customize->add_section(
	'vw_podcast_pro_nreleases_section',
	array(
		'title' => __('New Releases Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_nreleases_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_new_releases_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_new_releases_image_enable',
) );

$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_new_releases_settings',
		array(
			'label' => __('Section Heading Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_nreleases_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_section_heading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_section_heading',
	array(
		'label' => __('Section Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_nreleases_section',
		'setting' => 'vw_podcast_pro_new_releases_section_heading',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_nreleases_section',
		'setting' => 'vw_podcast_pro_new_releases_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_font_weight',
	array(
		'section' => 'vw_podcast_pro_nreleases_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_font_family',
	array(
		'section' => 'vw_podcast_pro_nreleases_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_new_releases_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_nreleases_section',
			'settings' => 'vw_podcast_pro_new_releases_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_new_releases_song_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_nreleases_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_song_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_nreleases_section',
		'setting' => 'vw_podcast_pro_new_releases_song_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_song_font_weight',
	array(
		'section' => 'vw_podcast_pro_nreleases_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_song_font_family',
	array(
		'section' => 'vw_podcast_pro_nreleases_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_new_releases_song_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_nreleases_section',
			'settings' => 'vw_podcast_pro_new_releases_song_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_des_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_new_releases_song_des_settings',
		array(
			'label' => __('Song Descreption Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_nreleases_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_des_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_song_des_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_nreleases_section',
		'setting' => 'vw_podcast_pro_new_releases_song_des_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_des_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_song_des_font_weight',
	array(
		'section' => 'vw_podcast_pro_nreleases_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_des_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_new_releases_song_des_font_family',
	array(
		'section' => 'vw_podcast_pro_nreleases_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_new_releases_song_des_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_new_releases_song_des_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_nreleases_section',
			'settings' => 'vw_podcast_pro_new_releases_song_des_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_nreleases_show_all_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_nreleases_show_all_settings',
		array(
			'label' => __('See All Button', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_nreleases_section'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_nreleases_show_all_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_nreleases_show_all_text',
	array(
		'label' => __('Button text', 'vw-podcast-pro'),
		'description' => __('Page to link to see all button.', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_nreleases_section',
		'setting' => 'vw_podcast_pro_nreleases_show_all_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_nreleases_show_all_btn',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_nreleases_show_all_btn',
	array(
		'label' => __('Single Page Title', 'vw-podcast-pro'),
		'description' => __('Page to link to see all button.', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_nreleases_section',
		'setting' => 'vw_podcast_pro_nreleases_show_all_btn',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_nreleases_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_nreleases_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_nreleases_section',
		'setting' => 'vw_podcast_pro_nreleases_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_nreleases_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_nreleases_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_nreleases_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_nreleases_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_nreleases_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_nreleases_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_nreleases_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_nreleases_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_nreleases_section',
			'settings' => 'vw_podcast_pro_nreleases_show_all_btn_color',
		)
	)
);


// top searched artists 


$wp_customize->add_section(
	'vw_podcast_pro_top_artists',
	array(
		'title' => __('Top Artist Page', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_section_heading_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_section_heading_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_artists',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_top_artists_section_heading_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_top_artists_section_heading_image_enable',
) );






$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_section_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_top_artists_section_heading_settings',
		array(
			'label' => __('Section Heading Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_artists'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_section_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_section_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_artists',
		'setting' => 'vw_podcast_pro_top_artists_section_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_section_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_section_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_top_artists',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_section_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_section_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_top_artists',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_section_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_top_artists_section_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_artists',
			'settings' => 'vw_podcast_pro_top_artists_section_heading_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_top_artists_song_title_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_artists'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_song_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_artists',
		'setting' => 'vw_podcast_pro_top_artists_song_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_song_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_top_artists',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_song_title_font_family',
	array(
		'section' => 'vw_podcast_pro_top_artists',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_top_artists_song_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_artists',
			'settings' => 'vw_podcast_pro_top_artists_song_title_color',
		)
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_top_artists_song_desc_settings',
		array(
			'label' => __('Artist Descreption Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_artists'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_song_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_artists',
		'setting' => 'vw_podcast_pro_top_artists_song_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_song_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_top_artists',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_artists_song_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_top_artists',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_artists_song_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_top_artists_song_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_artists',
			'settings' => 'vw_podcast_pro_top_artists_song_desc_color',
		)
	)
);







$wp_customize->add_setting(
	'vw_podcast_pro_artist_show_all_btn_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_artist_show_all_btn_settings',
		array(
			'label' => __('See All button Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_artists'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_artist_show_all_btn',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_show_all_btn',
	array(
		'label' => __('Category Arcive Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_artists',
		'setting' => 'vw_podcast_pro_artist_show_all_btn',
		'description' => __('Page Title you want to link show all button to.', 'vw-podcast-pro'),
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_artist_show_all_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_show_all_text',
	array(
		'label' => __('Button Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_artists',
		'setting' => 'vw_podcast_pro_artist_show_all_text',
		'description' => __('Page Title you want to link show all button to.', 'vw-podcast-pro'),
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_artist_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_artists',
		'setting' => 'vw_podcast_pro_artist_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_artist_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_top_artists',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_artist_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_top_artists',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_artist_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_artist_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_artists',
			'settings' => 'vw_podcast_pro_artist_show_all_btn_color',
		)
	)
);







$wp_customize->add_section(
	'vw_podcast_pro_radio',
	array(
		'title' => __('Radio Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_radio_song_desc_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_song_desc_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_radio',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_radio_song_desc_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_radio_song_desc_image_enable',
) );


$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_radio_radio_sec_title_settings',
		array(
			'label' => __('Section Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_radio'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_radio_sec_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_radio',
		'setting' => 'vw_podcast_pro_radio_radio_sec_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_radio_sec_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_radio',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_radio_sec_title_font_family',
	array(
		'section' => 'vw_podcast_pro_radio',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_radio_radio_sec_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_radio',
			'settings' => 'vw_podcast_pro_radio_radio_sec_title_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_song_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_radio_radio_sec_song_title_settings',
		array(
			'label' => __('Radio Name Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_radio'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_song_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_radio_sec_song_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_radio',
		'setting' => 'vw_podcast_pro_radio_radio_sec_song_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_song_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_radio_sec_song_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_radio',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_song_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_radio_sec_song_title_font_family',
	array(
		'section' => 'vw_podcast_pro_radio',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_radio_radio_sec_song_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_radio_radio_sec_song_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_radio',
			'settings' => 'vw_podcast_pro_radio_radio_sec_song_title_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_radio_show_all_btn_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_radio_show_all_btn_settings',
		array(
			'label' => __('See All Button Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_radio'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_radio_show_all_btn',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_show_all_btn',
	array(
		'label' => __('Single Page Title', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_radio',
		'setting' => 'vw_podcast_pro_radio_show_all_btn',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_radio_show_all_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_show_all_text',
	array(
		'label' => __('Button Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_radio',
		'setting' => 'vw_podcast_pro_radio_show_all_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_radio_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_radio',
		'setting' => 'vw_podcast_pro_radio_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_radio_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_radio',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_radio_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_radio_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_radio',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_radio_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_radio_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_radio',
			'settings' => 'vw_podcast_pro_radio_show_all_btn_color',
		)
	)
);



$wp_customize->add_section(
	'vw_podcast_pro_add_two_sec',
	array(
		'title' => __('Advertisement Two Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_small_title_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_small_title_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);


$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_advertisement_sec_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_advertisement_sec_image_enable',
) );
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_two_sec_image_bgcolor',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_two_sec_image_bgcolor',
		array(
			'label' => __('Gradient color 1', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec',
			'settings' => 'vw_podcast_pro_advertisement_two_sec_image_bgcolor',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_two_sec_image_bgcolor_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_two_sec_image_bgcolor_2',
		array(
			'label' => __('Gradient color 2', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec',
			'settings' => 'vw_podcast_pro_advertisement_two_sec_image_bgcolor_2',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_two_sec_image_bgimage',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_two_sec_image_bgimage',
		array(
			'label' => __('Background Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec',
			'description' => __('Remove Background image if you want to set gradient.', 'vw-podcast-pro'),
			'settings' => 'vw_podcast_pro_advertisement_two_sec_image_bgimage'
		)
	)
);

$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_add_two_sec_ad_small_title_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_add_two_sec_ad_small_title_image_enable',
) );




$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_small_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_add_two_sec_ad_small_title_settings',
		array(
			'label' => __('Add small title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_small_title',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_small_title',
	array(
		'label' => __('Add Small Title ', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_small_title',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_small_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_small_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_small_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_small_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_small_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_add_two_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_small_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_small_title_font_family',
	array(
		'section' => 'vw_podcast_pro_add_two_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_small_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_add_two_sec_ad_small_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec',
			'settings' => 'vw_podcast_pro_add_two_sec_ad_small_title_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_main_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_add_two_sec_ad_main_title_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_main_title',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_main_title',
	array(
		'label' => __('Main Title', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_main_title',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_main_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_main_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_main_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_main_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_main_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_add_two_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_main_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_main_title_font_family',
	array(
		'section' => 'vw_podcast_pro_add_two_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_main_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_add_two_sec_ad_main_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec',
			'settings' => 'vw_podcast_pro_add_two_sec_ad_main_title_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_feature_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_add_two_sec_ad_feature_text_settings',
		array(
			'label' => __('Ad Feature Text Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_feature_text_1',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_feature_text_1',
	array(
		'label' => __('Ad Feature Text 1', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_feature_text_1',
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_feature_text_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_feature_text_2',
	array(
		'label' => __('Ad Feature Text 2', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_feature_text_2',
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_feature_text_3',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_feature_text_3',
	array(
		'label' => __('Ad Feature Text 3', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_feature_text_3',
		'type' => 'text'
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_feature_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_feature_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_feature_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_feature_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_feature_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_add_two_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_feature_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_feature_text_font_family',
	array(
		'section' => 'vw_podcast_pro_add_two_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_feature_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_add_two_sec_ad_feature_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec',
			'settings' => 'vw_podcast_pro_add_two_sec_ad_feature_text_color',
		)
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_buttons_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_add_two_sec_ad_buttons_text_settings',
		array(
			'label' => __('Button Text Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_add_two_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_buttons_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_buttons_text',
	array(
		'label' => __('Button 1', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_buttons_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_buttons_text_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_buttons_text_2',
	array(
		'label' => __('Button 2', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_buttons_text_2',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_btn_link',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_btn_link',
	array(
		'label' => __('Button Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_btn_link',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_add_two_sec_ad_btn_link_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_add_two_sec_ad_btn_link_2',
	array(
		'label' => __('Button 2 Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_add_two_sec',
		'setting' => 'vw_podcast_pro_add_two_sec_ad_btn_link_2',
		'type' => 'text'
	)
);

// Recomended section 

$wp_customize->add_section(
	'vw_podcast_pro_recomended_section',
	array(
		'title' => __('Recomended Songs Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_recomended_section_ad_btn_link_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_section_ad_btn_link_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_recomended_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_recomended_section_ad_btn_link_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_recomended_section_ad_btn_link_image_enable',
) );



$wp_customize->add_setting(
	'vw_podcast_pro_recomended_section_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_recomended_section_title_settings',
		array(
			'label' => __('Section Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_recomended_section'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_recomended_section_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_section_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_recomended_section',
		'setting' => 'vw_podcast_pro_recomended_section_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_recomended_section_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_section_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_recomended_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_recomended_section_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_section_title_font_family',
	array(
		'section' => 'vw_podcast_pro_recomended_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_recomended_section_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_recomended_section_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_recomended_section',
			'settings' => 'vw_podcast_pro_recomended_section_title_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_recomended_song_title_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_recomended_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_song_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_recomended_section',
		'setting' => 'vw_podcast_pro_recomended_song_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_song_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_recomended_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_song_title_font_family',
	array(
		'section' => 'vw_podcast_pro_recomended_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_recomended_song_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_recomended_section',
			'settings' => 'vw_podcast_pro_recomended_song_title_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_recomended_song_desc_settings',
		array(
			'label' => __('Song Descreption Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_recomended_section'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_song_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_recomended_section',
		'setting' => 'vw_podcast_pro_recomended_song_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_song_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_recomended_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_song_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_recomended_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_recomended_song_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_recomended_section',
			'settings' => 'vw_podcast_pro_recomended_song_desc_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_recomm_show_all_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_recomm_show_all_settings',
		array(
			'label' => __('See All Button', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_recomended_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_recomm_show_all_btn',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomm_show_all_btn',
	array(
		'label' => __('Single Page Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_recomended_section',
		'setting' => 'vw_podcast_pro_recomm_show_all_btn',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_recomm_show_all_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomm_show_all_text',
	array(
		'label' => __('Button Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_recomended_section',
		'setting' => 'vw_podcast_pro_recomm_show_all_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_recomm_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomm_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_recomended_section',
		'setting' => 'vw_podcast_pro_recomm_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_recomm_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomm_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_recomended_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_recomm_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomm_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_recomended_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_recomm_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_recomm_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_recomended_section',
			'settings' => 'vw_podcast_pro_recomm_show_all_btn_color',
		)
	)
);



// top chart section 


$wp_customize->add_section(
	'vw_podcast_pro_top_chart_section',
	array(
		'title' => __('Top chart Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_recomended_song_desc_image_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_recomended_song_desc_image_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_chart_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_recomended_song_desc_image_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_recomended_song_desc_image_enable',
) );




$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_top_chart_settings',
		array(
			'label' => __('Section Heading Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_chart_section'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_chart_section',
		'setting' => 'vw_podcast_pro_top_chart_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_font_weight',
	array(
		'section' => 'vw_podcast_pro_top_chart_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_font_family',
	array(
		'section' => 'vw_podcast_pro_top_chart_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_top_chart_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_chart_section',
			'settings' => 'vw_podcast_pro_top_chart_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_top_chart_song_title_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_chart_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_song_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_chart_section',
		'setting' => 'vw_podcast_pro_top_chart_song_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_song_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_top_chart_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_song_title_font_family',
	array(
		'section' => 'vw_podcast_pro_top_chart_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_top_chart_song_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_chart_section',
			'settings' => 'vw_podcast_pro_top_chart_song_title_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_top_chart_song_desc_settings',
		array(
			'label' => __('Song Descreption Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_chart_section'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_song_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_chart_section',
		'setting' => 'vw_podcast_pro_top_chart_song_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_song_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_top_chart_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_song_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_top_chart_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_song_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_top_chart_song_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_chart_section',
			'settings' => 'vw_podcast_pro_top_chart_song_desc_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_section_show_all_btn_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_top_chart_section_show_all_btn_settings',

		array(
			'description' => __('Add Page Title to link page to show all button.', 'vw-podcast-pro'),
			'label' => __('Single Page Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_chart_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_section_show_all_btn',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_section_show_all_btn',
	array(
		'label' => __('Single Page Title', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_chart_section',
		'setting' => 'vw_podcast_pro_top_chart_section_show_all_btn',
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_section_show_all_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_section_show_all_text',
	array(
		'label' => __('Button Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_chart_section',
		'setting' => 'vw_podcast_pro_top_chart_section_show_all_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_section_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_section_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_top_chart_section',
		'setting' => 'vw_podcast_pro_top_chart_section_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_section_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_section_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_top_chart_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_section_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_top_chart_section_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_top_chart_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_top_chart_section_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_top_chart_section_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_top_chart_section',
			'settings' => 'vw_podcast_pro_top_chart_section_show_all_btn_color',
		)
	)
);


// Poplar section 

$wp_customize->add_section(
	'vw_podcast_pro_popular_english',
	array(
		'title' => __('Popular English Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_english_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial('vw_podcast_pro_popular_english_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_popular_english_enable',
));

$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_is_membership',
	array(
		'default' => 'Disable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_english_is_membership',
	array(
		'type' => 'radio',
		'label' => __('Make This Section Members Only Section?', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_englishheading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_englishheading',
	array(
		'label' => __('Section Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'setting' => 'vw_podcast_pro_popular_englishheading',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_englishlanguage',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_englishlanguage',
	array(
		'label' => __('Section Language', 'vw-podcast-pro'),
		'description' => __('Leave empty to render trending across all languages.', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'setting' => 'vw_podcast_pro_popular_englishlanguage',
		'type' => 'text'
	)
);
$args = array(
	'post_type' => 'Songs',
	'taxonomy' => 'song_categories',
	'hide_empty' => false
);
$categories = get_categories($args);
$cat_product = array();
$i = 0;

foreach ($categories as $category) {
	if ($i == 0) {
		$default = $category->slug;
		$i++;
	}
	$cat_product[$category->slug] = $category->name;
}

$wp_customize->add_setting('vw_podcast_pro_categories_english', array(
	'default' => array(), // Set the default values as an empty array
	'sanitize_callback' => 'vw_podcast_pro_sanitize_multiselect1', // Define a custom sanitize function
)
);

$wp_customize->add_control(new vw_podcast_pro_Multiselect_Control($wp_customize, 'vw_podcast_pro_categories_english', array(
	'label' => __('Song Categories', 'vw_podcast_pro'),
	'section' => 'vw_podcast_pro_popular_english',
	'choices' => $cat_product,
	'description' => __('Press Ctrl/Cmd and click to select or unselect a category.', 'vw-podcast-pro'),
)
));

function vw_podcast_pro_sanitize_multiselect1($input)
{
	if (!is_array($input)) {
		return array();
	}
	return array_map('sanitize_text_field', $input);
}
$wp_customize->add_setting(
	'vw_podcast_pro_popular_englishsingle_page_title',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_englishsingle_page_title',
	array(
		'label' => __('Single Page Title', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'setting' => 'vw_podcast_pro_popular_englishsingle_page_title',
		'type' => 'text'
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_section_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_popular_english_section_heading_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_english'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_section_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_english_section_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'setting' => 'vw_podcast_pro_popular_english_section_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_section_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_english_section_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_english',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_section_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_english_section_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_english',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_section_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_popular_english_section_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_english',
			'settings' => 'vw_podcast_pro_popular_english_section_heading_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_song_title_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_popular_english_song_title_heading_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_english'
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_song_title_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_english_song_title_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'setting' => 'vw_podcast_pro_popular_english_song_title_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_song_title_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_english_song_title_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_english',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_song_title_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_english_song_title_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_english',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_english_song_title_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_popular_english_song_title_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_english',
			'settings' => 'vw_podcast_pro_popular_english_song_title_heading_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_popular_popular_english_song_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_popular_popular_english_song_desc_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_english'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_popular_english_song_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_popular_english_song_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'setting' => 'vw_podcast_pro_popular_popular_english_song_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_popular_english_song_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_popular_english_song_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_english',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_popular_english_song_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_popular_english_song_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_english',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_popular_english_song_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_popular_popular_english_song_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_english',
			'settings' => 'vw_podcast_pro_popular_popular_english_song_desc_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_english_show_all_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_english_show_all_settings',
		array(
			'label' => __('See All Button', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_english'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_english_show_all_btn',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_english_show_all_btn',
	array(
		'label' => __('Single Page Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'setting' => 'vw_podcast_pro_english_show_all_btn',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_english_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_english_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_english',
		'setting' => 'vw_podcast_pro_english_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_english_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_english_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_english',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_english_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_english_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_english',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_english_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_english_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_english',
			'settings' => 'vw_podcast_pro_english_show_all_btn_color',
		)
	)
);

// Romance Section 


// advertisement three 


$wp_customize->add_section(
	'vw_podcast_pro_ad_three_section',
	array(
		'title' => __('Advertisement Three Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_section_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_section_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_sec_image_bgcolor_three',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_sec_image_bgcolor_three',
		array(
			'label' => __('Gradient color 1', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section',
			'settings' => 'vw_podcast_pro_advertisement_sec_image_bgcolor_three',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_sec_image_bgcolor_2_three',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_sec_image_bgcolor_2_three',
		array(
			'label' => __('Gradient color 2', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section',
			'settings' => 'vw_podcast_pro_advertisement_sec_image_bgcolor_2_three',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_advertisement_sec_image_bgimage_three',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_advertisement_sec_image_bgimage_three',
		array(
			'label' => __('Background Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section',
			'description' => __('Remove Background image if you want to set gradient.', 'vw-podcast-pro'),
			'settings' => 'vw_podcast_pro_advertisement_sec_image_bgimage_three'
		)
	)
);


$wp_customize->selective_refresh->add_partial( 'vw_podcast_pro_ad_three_section_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_ad_three_section_enable',
) );




$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_ad_three_heading_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_heading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_heading',
	array(
		'label' => __('Section Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_three_heading',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_three_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_ad_three_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_ad_three_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_ad_three_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section',
			'settings' => 'vw_podcast_pro_ad_three_heading_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_register_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_ad_three_register_title_settings',
		array(
			'label' => __('Regiser Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_register_title',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_register_title',
	array(
		'label' => __('Middle Title', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_three_register_title',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_register_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_register_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_three_register_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_register_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_register_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_ad_three_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_register_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_register_title_font_family',
	array(
		'section' => 'vw_podcast_pro_ad_three_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_register_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_ad_three_register_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section',
			'settings' => 'vw_podcast_pro_ad_three_register_title_color',
		)
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_ad_threebutton_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_ad_threebutton_title_settings',
		array(
			'label' => __('Button Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_threebutton_title',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_threebutton_title',
	array(
		'label' => __('Add Button text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_threebutton_title',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_threebutton_link',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_threebutton_link',
	array(
		'label' => __('Button link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_threebutton_link',
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_threebutton_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_threebutton_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_threebutton_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_threebutton_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_threebutton_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_ad_three_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_threebutton_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_threebutton_title_font_family',
	array(
		'section' => 'vw_podcast_pro_ad_three_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_threebutton_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_ad_threebutton_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section',
			'settings' => 'vw_podcast_pro_ad_threebutton_title_color',
		)
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_middle_txt_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_ad_three_middle_txt_settings',
		array(
			'label' => __('Middle Text Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_middle_txt',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_middle_txt',
	array(
		'label' => __('Middle Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_three_middle_txt',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_middle_txt_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_middle_txt_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_ad_three_section',
		'setting' => 'vw_podcast_pro_ad_three_middle_txt_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_middle_txt_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_middle_txt_font_weight',
	array(
		'section' => 'vw_podcast_pro_ad_three_section',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_middle_txt_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_ad_three_middle_txt_font_family',
	array(
		'section' => 'vw_podcast_pro_ad_three_section',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_middle_txt_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_ad_three_middle_txt_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section',
			'settings' => 'vw_podcast_pro_ad_three_middle_txt_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_ad_three_section_image',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_ad_three_section_image',
		array(
			'label' => __('Section Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_ad_three_section',
			'settings' => 'vw_podcast_pro_ad_three_section_image'
		)
	)
);

// Poplar romance section 

$wp_customize->add_section(
	'vw_podcast_pro_popular_romance',
	array(
		'title' => __('Popular in romance Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_romance_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_romance_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial('vw_podcast_pro_popular_romance_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_popular_romance_enable',
));

$wp_customize->add_setting(
	'vw_podcast_pro_popular_romance_is_membership',
	array(
		'default' => 'Disable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_romance_is_membership',
	array(
		'type' => 'radio',
		'label' => __('Make This Section Members Only Section?', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_romanceheading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_romanceheading',
	array(
		'label' => __('Section Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_popular_romanceheading',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_romancelanguage',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_romancelanguage',
	array(
		'label' => __('Section Language', 'vw-podcast-pro'),
		'description' => __('Leave empty to render trending across all languages.', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_popular_romancelanguage',
		'type' => 'text'
	)
);
$args = array(
	'post_type' => 'Songs',
	'taxonomy' => 'song_categories',
	'hide_empty' => false
);
$categories = get_categories($args);
$cat_product = array();
$i = 0;
foreach ($categories as $category) {
	if ($i == 0) {
		$default = $category->slug;
		$i++;
	}
	$cat_product[$category->slug] = $category->name;
}

$wp_customize->add_setting('vw_podcast_pro_romance_category', array(
	'default' => array(), // Set the default values as an empty array
	'sanitize_callback' => 'vw_podcast_pro_sanitize_multiselect3', // Define a custom sanitize function
)
);

$wp_customize->add_control(new vw_podcast_pro_Multiselect_Control($wp_customize, 'vw_podcast_pro_romance_category', array(
	'label' => __('Song Categories', 'vw_podcast_pro'),
	'section' => 'vw_podcast_pro_popular_romance',
	'choices' => $cat_product,
	'description' => __('Press Ctrl/Cmd and click to select or unselect a category.', 'vw-podcast-pro'),
)
));

function vw_podcast_pro_sanitize_multiselect3($input)
{
	if (!is_array($input)) {
		return array();
	}
	return array_map('sanitize_text_field', $input);
}
// $wp_customize->add_setting(
// 	'vw_podcast_pro_popular_romancesingle_page_title',
// 	array(
// 		'default' => '',
// 		'sanitize_callback' => 'sanitize_text_field'
// 	)
// );
// $wp_customize->add_control(
// 	'vw_podcast_pro_popular_romancesingle_page_title',
// 	array(
// 		'label' => __('Single Page Link', 'vw-podcast-pro'),
// 		'section' => 'vw_podcast_pro_popular_romance',
// 		'setting' => 'vw_podcast_pro_popular_romancesingle_page_title',
// 		'type' => 'text'
// 	)
// );

$wp_customize->add_setting(
	'vw_podcast_propopular_romance_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_propopular_romance_settings',
		array(
			'label' => __('Section Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_romance'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_propopular_romance_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_propopular_romance_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_propopular_romance_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_propopular_romance_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_propopular_romance_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_romance',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_propopular_romance_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_propopular_romance_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_romance',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_propopular_romance_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_propopular_romance_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_romance',
			'settings' => 'vw_podcast_propopular_romance_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_romance_song_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_romance_song_title_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_romance'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_romance_song_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_song_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_romance_song_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_romance_song_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_song_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_romance',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_romance_song_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_song_title_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_romance',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_romance_song_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_romance_song_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_romance',
			'settings' => 'vw_podcast_pro_romance_song_title_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_romance_song_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_popular_romance_song_desc_settings',
		array(
			'label' => __('Song Desc Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_romance'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_romance_song_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_romance_song_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_popular_romance_song_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_romance_song_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_romance_song_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_romance',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_romance_song_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_romance_song_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_romance',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_romance_song_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_popular_romance_song_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_romance',
			'settings' => 'vw_podcast_pro_popular_romance_song_desc_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_romance_show_all_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_romance_show_all_settings',
		array(
			'label' => __('See All Button', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_romance'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_romance_show_all_btn_link',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_show_all_btn_link',
	array(
		'label' => __('Single Page Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_romance_show_all_btn_link',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_romance_show_all_btn_link',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_show_all_btn_link',
	array(
		'label' => __('Single Page Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_romance_show_all_btn_link',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_romance_show_all_btn_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_show_all_btn_text',
	array(
		'label' => __('Button Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_romance_show_all_btn_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_romance_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_romance',
		'setting' => 'vw_podcast_pro_romance_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_romance_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_romance',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_romance_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_romance_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_romance',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_romance_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_romance_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_romance',
			'settings' => 'vw_podcast_pro_romance_show_all_btn_color',
		)
	)
);



// Poplar spanish section 

$wp_customize->add_section(
	'vw_podcast_pro_popular_spanish',
	array(
		'title' => __('Popular in Spanish Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_enable',
	array(
		'default' => 'Enable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_enable',
	array(
		'type' => 'radio',
		'label' => __('Do you want this section', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->selective_refresh->add_partial('vw_podcast_pro_popular_spanish_enable', array(
	'selector' => 'section#featureSection .container',
	'render_callback' => 'vw_podcast_pro_pro_customize_partial_vw_podcast_pro_popular_spanish_enable',
));
$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_is_membership',
	array(
		'default' => 'Disable',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_is_membership',
	array(
		'type' => 'radio',
		'label' => __('Make This Section Members Only Section?', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'choices' => array(
			'Enable' => __('Enable', 'vw-podcast-pro'),
			'Disable' => __('Disable', 'vw-podcast-pro')
		),
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanishheading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanishheading',
	array(
		'label' => __('Section Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'setting' => 'vw_podcast_pro_popular_spanishheading',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanishlanguage',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanishlanguage',
	array(
		'label' => __('Section Language', 'vw-podcast-pro'),
		'description' => __('Leave empty to render trending across all languages.', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'setting' => 'vw_podcast_pro_popular_spanishlanguage',
		'type' => 'text'
	)
);
$args = array(
	'post_type' => 'Songs',
	'taxonomy' => 'song_categories',
	'hide_empty' => false
);
$categories = get_categories($args);
$cat_product = array();
$i = 0;
foreach ($categories as $category) {
	if ($i == 0) {
		$default = $category->slug;
		$i++;
	}
	$cat_product[$category->slug] = $category->name;
}

$wp_customize->add_setting('vw_podcast_pro_spanish_category', array(
	'default' => array(), // Set the default values as an empty array
	'sanitize_callback' => 'vw_podcast_pro_sanitize_multiselect2', // Define a custom sanitize function
)
);

$wp_customize->add_control(new vw_podcast_pro_Multiselect_Control($wp_customize, 'vw_podcast_pro_spanish_category', array(
	'label' => __('Song Categories', 'vw_podcast_pro'),
	'section' => 'vw_podcast_pro_popular_spanish',
	'choices' => $cat_product,
	'description' => __('Press Ctrl/Cmd and click to select or unselect a category.', 'vw-podcast-pro'),
)
));

function vw_podcast_pro_sanitize_multiselect2($input)
{
	if (!is_array($input)) {
		return array();
	}
	return array_map('sanitize_text_field', $input);
}
// $wp_customize->add_setting(
// 	'vw_podcast_pro_popular_spanishsingle_page_title',
// 	array(
// 		'default' => '',
// 		'sanitize_callback' => 'sanitize_text_field'
// 	)
// );
// $wp_customize->add_control(
// 	'vw_podcast_pro_popular_spanishsingle_page_title',
// 	array(
// 		'label' => __('Single Page Title', 'vw-podcast-pro'),
// 		'section' => 'vw_podcast_pro_popular_spanish',
// 		'setting' => 'vw_podcast_pro_popular_spanishsingle_page_title',
// 		'type' => 'text'
// 	)
// );


$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_popular_spanish_song_title_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_spanish'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_song_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'setting' => 'vw_podcast_pro_popular_spanish_song_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_song_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_spanish',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_song_title_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_spanish',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_popular_spanish_song_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_spanish',
			'settings' => 'vw_podcast_pro_popular_spanish_song_title_color',
		)
	)
);






$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_section_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_popular_spanish_section_heading_settings',
		array(
			'label' => __('Section Heading Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_spanish'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_section_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_section_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'setting' => 'vw_podcast_pro_popular_spanish_section_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_section_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_section_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_spanish',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_section_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_section_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_spanish',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_section_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_popular_spanish_section_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_spanish',
			'settings' => 'vw_podcast_pro_popular_spanish_section_heading_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_popular_spanish_song_desc_settings',
		array(
			'label' => __('Song Descreption Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_spanish'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_song_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'setting' => 'vw_podcast_pro_popular_spanish_song_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_song_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_spanish',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_popular_spanish_song_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_spanish',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_popular_spanish_song_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_popular_spanish_song_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_spanish',
			'settings' => 'vw_podcast_pro_popular_spanish_song_desc_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_spanish_show_all_settings',
		array(
			'label' => __('See All Button', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_spanish'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_spanish_show_all_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'setting' => 'vw_podcast_pro_spanish_show_all_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_btn_link',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_spanish_show_all_btn_link',
	array(
		'label' => __('Single Page Link', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'setting' => 'vw_podcast_pro_spanish_show_all_btn_link',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_btn_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_spanish_show_all_btn_text',
	array(
		'label' => __('Button Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_popular_spanish',
		'setting' => 'vw_podcast_pro_spanish_show_all_btn_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_spanish_show_all_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_popular_spanish',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_spanish_show_all_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_popular_spanish',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_spanish_show_all_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_spanish_show_all_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_popular_spanish',
			'settings' => 'vw_podcast_pro_spanish_show_all_btn_color',
		)
	)
);











// faq section 


$wp_customize->add_section(
	'vw_podcast_pro_faq_sec',
	array(
		'title' => __('FAQ Section', 'vw-podcast-pro'),
		'imageription' => __('Add _section btn setting here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_Questin_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_faq_sec_Questin_settings',
		array(
			'label' => __('FAQ Question and Answer Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_faq_sec'
		)
	)
);



for ($i = 1; $i <= 5; $i++) {
	// FAQ Section Setting
	$wp_customize->add_setting(
		'vw_podcast_pro_faq_sec_section_' . $i,
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	// FAQ Section Control
	$wp_customize->add_control(
		'vw_podcast_pro_faq_sec_section_' . $i,
		array(
			'label' => __('FAQ Question', 'vw-podcast-pro') . ' ' . $i,
			'section' => 'vw_podcast_pro_faq_sec',
			'setting' => 'vw_podcast_pro_faq_sec_section_' . $i,
			'type' => 'text'
		)
	);

	// FAQ Answer Setting
	$wp_customize->add_setting(
		'vw_podcast_pro_faq_sec_answer_' . $i,
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	// FAQ Answer Control
	$wp_customize->add_control(
		'vw_podcast_pro_faq_sec_answer_' . $i,
		array(
			'label' => __('FAQ Answer', 'vw-podcast-pro') . ' ' . $i,
			'section' => 'vw_podcast_pro_faq_sec',
			'setting' => 'vw_podcast_pro_faq_sec_answer_' . $i,
			'type' => 'text'
		)
	);
}







$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_question_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_faq_sec_question_settings',
		array(
			'label' => __('FAQ Questions Typography Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_faq_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_question_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_faq_sec_question_font_weight',
	array(
		'section' => 'vw_podcast_pro_faq_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_question_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_faq_sec_question_font_family',
	array(
		'section' => 'vw_podcast_pro_faq_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_question_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_faq_sec_question_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'imageription' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_faq_sec',
		'setting' => 'vw_podcast_pro_faq_sec_question_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_question_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_faq_sec_question_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_faq_sec',
			'settings' => 'vw_podcast_pro_faq_sec_question_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_answer_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_faq_sec_answer_settings',
		array(
			'label' => __('Faq Answer Typography Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_faq_sec'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_answer_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_faq_sec_answer_font_weight',
	array(
		'section' => 'vw_podcast_pro_faq_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_answer_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_faq_sec_answer_font_family',
	array(
		'section' => 'vw_podcast_pro_faq_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_answer_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_faq_sec_answer_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'imageription' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_faq_sec',
		'setting' => 'vw_podcast_pro_faq_sec_answer_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_faq_sec_answer_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_faq_sec_answer_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_faq_sec',
			'settings' => 'vw_podcast_pro_faq_sec_answer_color',
		)
	)
);

