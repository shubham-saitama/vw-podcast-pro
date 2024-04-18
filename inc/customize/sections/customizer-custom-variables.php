<?php
$wp_customize->add_section('vw_podcast_pro_section_ordering_settings', array(
  'title' => __('Section Ordering', 'vw-podcast-pro'),
  'description' => __('Section Ordering.', 'vw-podcast-pro'),
  'panel' => 'vw_podcast_pro_panel_id',
)
);
$wp_customize->add_setting(
  'vw_podcast_pro_section_ordering_settings_repeater',
  array(
    'default' => '',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  new vw_podcast_pro_Repeater_Custom_Control(
    $wp_customize,
    'vw_podcast_pro_section_ordering_settings_repeater',
    array(
      'label' => __('Section Reordering', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_section_ordering_settings',
      'button_labels' => array(
        'add' => __('Add Row', 'vw-podcast-pro'),
      )
    )
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_section_ordering_padding_settings',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_section_ordering_padding_settings',
    array(
      'label' => __('Section Padding Top Settings', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_section_ordering_settings'
    )
  )
);

$section_order = explode(',', get_theme_mod('vw_podcast_pro_section_ordering_settings_repeater'));

foreach ($section_order as $key => $value) {

  if ($value != '') {
    $wp_customize->add_setting('vw_podcast_pro_' . $value . '_padding_top', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field',
    )
    );
    $wp_customize->add_control('vw_podcast_pro_' . $value . '_padding_top', array(
      'label' => __($value, ' Padding Top', 'vw-podcast-pro'),
      'description' => __('Add Padding Top in Pixels', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_section_ordering_settings',
      'setting' => 'vw_podcast_pro_' . $value . '_padding_top',
      'type' => 'number'
    )
    );
  }
}




//General Color Pallete
$wp_customize->add_section('vw_podcast_pro_color_pallette', array(
  'title' => __('Typography / General settings', 'vw-podcast-pro'),
  'description' => __('Typography settings', 'vw-podcast-pro'),
  'panel' => 'vw_podcast_pro_panel_id',
)
);

//This is Button Text FontFamily picker setting

$wp_customize->add_setting(
  'vw_podcast_pro_body_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_body_section_ct_pallete',
    array(
      'label' => __('Body Typography ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

$wp_customize->add_setting('vw_podcast_pro_body_font_family', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control(
  'vw_podcast_pro_body_font_family',
  array(
    'section' => 'vw_podcast_pro_color_pallette',
    'label' => __('Body Font family', 'vw-podcast-pro'),
    'type' => 'select',
    'choices' => $font_array,
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_body_font_size',
  array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  'vw_podcast_pro_body_font_size',
  array(
    'label' => __('font size in px', 'vw-podcast-pro'),
    'section' => 'vw_podcast_pro_color_pallette',
    'setting' => 'vw_podcast_pro_body_font_size',
    'type' => 'number'
  )
);
$wp_customize->add_setting('vw_podcast_pro_body_color', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_body_color', array(
  'label' => __('Body color', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_body_color',
)
));

$wp_customize->add_setting(
  'vw_podcast_pro_h1_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);

$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_h1_section_ct_pallete',
    array(
      'label' => __('H1 Typography ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

$wp_customize->add_setting('vw_podcast_pro_h1_font_family', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control(
  'vw_podcast_pro_h1_font_family',
  array(
    'section' => 'vw_podcast_pro_color_pallette',
    'label' => __('H1', 'vw-podcast-pro'),
    'type' => 'select',
    'choices' => $font_array,
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_h1_font_size',
  array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  'vw_podcast_pro_h1_font_size',
  array(
    'label' => __('H1 font size in px', 'vw-podcast-pro'),
    'section' => 'vw_podcast_pro_color_pallette',
    'setting' => 'vw_podcast_pro_h1_font_size',
    'type' => 'number'
  )
);

$wp_customize->add_setting(
	'vw_podcast_pro_h1_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_h1_font_weight',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('H1 Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);
$wp_customize->add_setting('vw_podcast_pro_h1_color', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_h1_color', array(
  'label' => __('H1 color', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_h1_color',
)
));

$wp_customize->add_setting(
  'vw_podcast_pro_h2_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_h2_section_ct_pallete',
    array(
      'label' => __('H2 Typography ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

$wp_customize->add_setting('vw_podcast_pro_h2_font_family', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control(
  'vw_podcast_pro_h2_font_family',
  array(
    'section' => 'vw_podcast_pro_color_pallette',
    'label' => __('H2', 'vw-podcast-pro'),
    'type' => 'select',
    'choices' => $font_array,
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_h2_font_size',
  array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  'vw_podcast_pro_h2_font_size',
  array(
    'label' => __('H2 font size in px', 'vw-podcast-pro'),
    'section' => 'vw_podcast_pro_color_pallette',
    'setting' => 'vw_podcast_pro_h2_font_size',
    'type' => 'number'
  )
);
$wp_customize->add_setting(
	'vw_podcast_pro_h2_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_h2_font_weight',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('H2 Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);
$wp_customize->add_setting('vw_podcast_pro_h2_color', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_h2_color', array(
  'label' => __('H2 color', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_h2_color',
)
));

$wp_customize->add_setting(
  'vw_podcast_pro_h3_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_h3_section_ct_pallete',
    array(
      'label' => __('H3 Typography ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

$wp_customize->add_setting('vw_podcast_pro_h3_font_family', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control(
  'vw_podcast_pro_h3_font_family',
  array(
    'section' => 'vw_podcast_pro_color_pallette',
    'label' => __('H3', 'vw-podcast-pro'),
    'type' => 'select',
    'choices' => $font_array,
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_h3_font_size',
  array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  'vw_podcast_pro_h3_font_size',
  array(
    'label' => __('H3 font size in px', 'vw-podcast-pro'),
    'section' => 'vw_podcast_pro_color_pallette',
    'setting' => 'vw_podcast_pro_h3_font_size',
    'type' => 'number'
  )
);
$wp_customize->add_setting(
	'vw_podcast_pro_h3_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_h3_font_weight',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('H3 Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);
$wp_customize->add_setting('vw_podcast_pro_h3_color', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_h3_color', array(
  'label' => __('H3 color', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_h3_color',
)
));

$wp_customize->add_setting(
  'vw_podcast_pro_h4_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_h4_section_ct_pallete',
    array(
      'label' => __('H4 Typography ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

$wp_customize->add_setting('vw_podcast_pro_h4_font_family', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control(
  'vw_podcast_pro_h4_font_family',
  array(
    'section' => 'vw_podcast_pro_color_pallette',
    'label' => __('H4', 'vw-podcast-pro'),
    'type' => 'select',
    'choices' => $font_array,
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_h4_font_size',
  array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  'vw_podcast_pro_h4_font_size',
  array(
    'label' => __('H4 font size in px', 'vw-podcast-pro'),
    'section' => 'vw_podcast_pro_color_pallette',
    'setting' => 'vw_podcast_pro_h4_font_size',
    'type' => 'number'
  )
);
$wp_customize->add_setting(
	'vw_podcast_pro_h4_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_h4_font_weight',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('H4 Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);
$wp_customize->add_setting('vw_podcast_pro_h4_color', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_h4_color', array(
  'label' => __('H4 color', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_h4_color',
)
));

$wp_customize->add_setting(
  'vw_podcast_pro_h5_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_h5_section_ct_pallete',
    array(
      'label' => __('H5 Typography ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

$wp_customize->add_setting('vw_podcast_pro_h5_font_family', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control(
  'vw_podcast_pro_h5_font_family',
  array(
    'section' => 'vw_podcast_pro_color_pallette',
    'label' => __('H5', 'vw-podcast-pro'),
    'type' => 'select',
    'choices' => $font_array,
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_h5_font_size',
  array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  'vw_podcast_pro_h5_font_size',
  array(
    'label' => __('H5 font size in px', 'vw-podcast-pro'),
    'section' => 'vw_podcast_pro_color_pallette',
    'setting' => 'vw_podcast_pro_h5_font_size',
    'type' => 'number'
  )
);
$wp_customize->add_setting(
	'vw_podcast_pro_h5_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_h5_font_weight',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('H5 Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);
$wp_customize->add_setting('vw_podcast_pro_h5_color', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_h5_color', array(
  'label' => __('H5 colo herer', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_h5_color',
)
));

$wp_customize->add_setting(
  'vw_podcast_pro_h6_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_h6_section_ct_pallete',
    array(
      'label' => __('H6 Typography ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

$wp_customize->add_setting('vw_podcast_pro_h6_font_family', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control(
  'vw_podcast_pro_h6_font_family',
  array(
    'section' => 'vw_podcast_pro_color_pallette',
    'label' => __('H6', 'vw-podcast-pro'),
    'type' => 'select',
    'choices' => $font_array,
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_h6_font_size',
  array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  'vw_podcast_pro_h6_font_size',
  array(
    'label' => __('H6 font size in px', 'vw-podcast-pro'),
    'section' => 'vw_podcast_pro_color_pallette',
    'setting' => 'vw_podcast_pro_h6_font_size',
    'type' => 'number'
  )
);
$wp_customize->add_setting(
	'vw_podcast_pro_h6_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_h6_font_weight',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('h6 Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);
$wp_customize->add_setting('vw_podcast_pro_h6_color', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_h6_color', array(
  'label' => __('H6 color', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_h6_color',
)
));

$wp_customize->add_setting(
  'vw_podcast_pro_para_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_para_section_ct_pallete',
    array(
      'label' => __('Paragraph Typography ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

//paragarph font family
$wp_customize->add_setting('vw_podcast_pro_paragarpah_font_family', array(
  'default' => '',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control(
  'vw_podcast_pro_paragarpah_font_family',
  array(
    'section' => 'vw_podcast_pro_color_pallette',
    'label' => __('Paragraph', 'vw-podcast-pro'),
    'type' => 'select',
    'choices' => $font_array,
  )
);
$wp_customize->add_setting(
  'vw_podcast_pro_para_font_size',
  array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  )
);
$wp_customize->add_control(
  'vw_podcast_pro_para_font_size',
  array(
    'label' => __('Paragraph font size in px', 'vw-podcast-pro'),
    'section' => 'vw_podcast_pro_color_pallette',
    'setting' => 'vw_podcast_pro_para_font_size',
    'type' => 'number'
  )
);
$wp_customize->add_setting(
	'vw_podcast_pro_para_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_para_font_weight',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('Paragraph Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);
$wp_customize->add_setting('vw_podcast_pro_para_color', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'vw_podcast_pro_para_color',
    array(
      'label' => __('Para color', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette',
      'settings' => 'vw_podcast_pro_para_color',
    )
  )
);

$wp_customize->add_setting(
  'vw_podcast_pro_global_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_global_section_ct_pallete',
    array(
      'label' => __('Global Colors ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);

$wp_customize->add_setting(
  'vw_podcast_pro_primary_section_ct_pallete',
  array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
  )
);
$wp_customize->add_control(
  new VW_Themes_Seperator_custom_Control(
    $wp_customize,
    'vw_podcast_pro_primary_section_ct_pallete',
    array(
      'label' => __('Primary ', 'vw-podcast-pro'),
      'section' => 'vw_podcast_pro_color_pallette'
    )
  )
);
$wp_customize->add_setting('vw_podcast_pro_body_background', array(
  'default' => '#030020',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_body_background', array(
  'label' => __('Body Background', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_body_background',
)
));


$wp_customize->add_setting('vw_podcast_pro_primary_btn_bg', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_primary_btn_bg', array(
  'label' => __('Primary Button BG', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_primary_btn_bg',
)
));
$wp_customize->add_setting('vw_podcast_pro_hi_first_color_2', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_hi_first_color_2', array(
  'label' => __('Gradient color 1', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_hi_first_color_2',
)
));

$wp_customize->add_setting('vw_podcast_pro_hi_first_color_3', array(
  'default' => '',
  'sanitize_callback' => 'sanitize_hex_color'
)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_podcast_pro_hi_first_color_3', array(
  'label' => __('Gradient Color 2', 'vw-podcast-pro'),
  'section' => 'vw_podcast_pro_color_pallette',
  'settings' => 'vw_podcast_pro_hi_first_color_3',
)
));




$wp_customize->add_setting(
	'vw_podcast_pro_player_control_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_player_control_settings',
		array(
			'label' => __('Player Control Setting', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_color_pallette'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_player_control_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_player_control_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_color_pallette',
		'setting' => 'vw_podcast_pro_player_control_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_player_control_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_player_control_font_weight',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_player_control_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_player_control_font_family',
	array(
		'section' => 'vw_podcast_pro_color_pallette',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_player_control_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_player_control_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_color_pallette',
			'settings' => 'vw_podcast_pro_player_control_color',
		)
	)
);


// header settings 

$wp_customize->add_setting(
	'vw_podcast_pro_header_notification_link',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_header_notification_link',
	array(
		'label' => __('Notification shortcode', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_color_pallette',
		'setting' => 'vw_podcast_pro_header_notification_link',
		'type' => 'text'
	)
);
