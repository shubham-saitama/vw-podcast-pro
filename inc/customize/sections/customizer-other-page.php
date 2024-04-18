<?php






// call widget 
$wp_customize->add_setting(
	'vw_podcast_pro_single_services_widget',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_single_services_widget',
		array(
			'label' => __('Phone Sidebar Widget', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_service'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_single_service_widget_image',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);


$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_single_service_widget_image',
		array(
			'label' => __('Widget Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_service',
			'settings' => 'vw_podcast_pro_single_service_widget_image'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_single_service_widget_title',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_single_service_widget_title',
	array(
		'label' => __('Widget title text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_single_service',
		'setting' => 'vw_podcast_pro_single_service_widget_title',
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_single_service_widget_number',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'vw_podcast_pro_single_service_widget_number',
	array(
		'label' => __('Phone Number', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_single_service',
		'type' => 'number'
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_single_service_widget_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_single_service_widget_text',
	array(
		'label' => __('Widget Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_single_service',
		'setting' => 'vw_podcast_pro_single_service_widget_text',
		'type' => 'text'
	)
);





// call widget ends 






/*-----------------------Blog Page Settings--------------------------*/


// --------------- Post General Settings ---------------
$wp_customize->add_section(
	'vw_podcast_pro_post_general_settings',
	array(
		'title' => __('Single Blog Page Settings', 'vw-podcast-pro'),
		'description' => __('See section settings below and do check documentation too.', 'vw-podcast-pro'),
		'priority' => null,
		'panel' => 'vw_podcast_pro_panel_id',
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_post_date',
	array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_podcast_pro_switch_sanitization'
	)
);

$wp_customize->add_control(
	new vw_podcast_pro_Toggle_Switch_Custom_control(
		$wp_customize,
		'vw_podcast_pro_post_general_settings_post_date',
		array(
			'label' => esc_html__('Show or Hide Post Date', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_post_comments',
	array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_podcast_pro_switch_sanitization'
	)
);
$wp_customize->add_control(
	new vw_podcast_pro_Toggle_Switch_Custom_control(
		$wp_customize,
		'vw_podcast_pro_post_general_settings_post_comments',
		array(
			'label' => esc_html__('Show or Hide Comments', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_post_author',
	array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_podcast_pro_switch_sanitization'
	)
);
$wp_customize->add_control(
	new vw_podcast_pro_Toggle_Switch_Custom_control(
		$wp_customize,
		'vw_podcast_pro_post_general_settings_post_author',
		array(
			'label' => esc_html__('Show or Hide Author', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_overview_count_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_overview_count_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_post_general_settings_overview_count_settings',
		array(
			'label' => __('Main Heading Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings'
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_overview_count_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_post_general_settings_overview_count_font_weight',
	array(
		'section' => 'vw_podcast_pro_post_general_settings',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_overview_count_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_post_general_settings_overview_count_font_family',
	array(
		'section' => 'vw_podcast_pro_post_general_settings',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_overview_count_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_post_general_settings_overview_count_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_post_general_settings',
		'setting' => 'vw_podcast_pro_post_general_settings_overview_count_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_post_general_settings_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings',
			'settings' => 'vw_podcast_pro_post_general_settings_heading_color',
		)
	)
);







$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_subheadings_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_subheadings_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_post_general_settings_subheadings_settings',
		array(
			'label' => __('Page Sub-Heading Setting', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings'
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_subheadings_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_post_general_settings_subheadings_font_weight',
	array(
		'section' => 'vw_podcast_pro_post_general_settings',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_subheadings_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_post_general_settings_subheadings_font_family',
	array(
		'section' => 'vw_podcast_pro_post_general_settings',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_subheadings_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_post_general_settings_subheadings_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_post_general_settings',
		'setting' => 'vw_podcast_pro_post_general_settings_subheadings_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_post_general_settings_subheadings_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_post_general_settings_subheadings_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings',
			'settings' => 'vw_podcast_pro_post_general_settings_subheadings_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_blog_page_para_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_form_counter_sub_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_blog_page_para_settings',
		array(
			'label' => __('Page Paragraph/Text Typography Setting', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings'
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_blog_page_para_para_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_blog_page_para_para_font_weight',
	array(
		'section' => 'vw_podcast_pro_post_general_settings',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_blog_page_para_para_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_blog_page_para_para_font_family',
	array(
		'section' => 'vw_podcast_pro_post_general_settings',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_blog_page_para_para_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_blog_page_para_para_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_post_general_settings',
		'setting' => 'vw_podcast_pro_blog_page_para_para_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_blog_page_para_para_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(

		$wp_customize,
		'vw_podcast_pro_blog_page_para_para_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings',
			'settings' => 'vw_podcast_pro_blog_page_para_para_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_recent_post_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_form_counter_sub_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_recent_post_settings',
		array(
			'label' => __('Recent Post Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_post_general_settings'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_single_blog_heading_tag',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_single_blog_heading_tag',
	array(
		'label' => __('Recent Post Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_post_general_settings',
		'setting' => 'vw_podcast_pro_single_blog_heading_tag',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_single_blog_heading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_single_blog_heading',
	array(
		'label' => __('Recent Post Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_post_general_settings',
		'setting' => 'vw_podcast_pro_single_blog_heading',
		'type' => 'text'
	)
);











// Policy Pages 

$wp_customize->add_section(
	'vw_podcast_pro_policy_page',
	array(
		'title' => __('Policy, Cookies, About us,Settings', 'vw-podcast-pro'),
		'description' => __('Add Policy Page setting here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_form_counter_heading_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_policy_page_heading_settings',
		array(
			'label' => __('Text Pages Headings Typography Setting(h4)', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_policy_page'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_policy_page_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_policy_page',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_policy_page_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_policy_page',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_policy_page_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_policy_page',
		'setting' => 'vw_podcast_pro_policy_page_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_policy_page_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_policy_page',
			'settings' => 'vw_podcast_pro_policy_page_heading_color',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_sub_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_form_counter_heading_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_policy_page_sub_heading_settings',
		array(
			'label' => __('Text Pages Page Sub-Headings Typography Setting(h4)', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_policy_page'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_form_counter_heading_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_policy_page_text_settings',
		array(
			'label' => __('Policy Page Text Typography', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_policy_page'
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_page_texts_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_policy_page_page_texts_font_weight',
	array(
		'section' => 'vw_podcast_pro_policy_page',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_page_texts_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_policy_page_page_texts_font_family',
	array(
		'section' => 'vw_podcast_pro_policy_page',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_page_texts_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_policy_page_page_texts_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_policy_page',
		'setting' => 'vw_podcast_pro_policy_page_page_texts_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_policy_page_page_texts_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_policy_page_page_texts_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_policy_page',
			'settings' => 'vw_podcast_pro_policy_page_page_texts_color',
		)
	)
);



// Policy Pages End 

// Sogn archive page 





// song archive ends 
$wp_customize->add_section(
	'vw_podcast_pro_song_archive',
	array(
		'title' => __('Song Archive Pages', 'vw-podcast-pro'),
		'description' => __('Settings on this section affects songs,archive, categories , artists, radio page.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_archive_main_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_archive_main_heading_settings',
		array(
			'label' => __('Page Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_song_archive'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_archive_main_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_main_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_song_archive',
		'setting' => 'vw_podcast_pro_archive_main_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_archive_main_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_main_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_song_archive',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_archive_main_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_main_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_song_archive',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_archive_main_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_archive_main_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_song_archive',
			'settings' => 'vw_podcast_pro_archive_main_heading_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_archive_song_heading_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_song_archive'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_song_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_song_archive',
		'setting' => 'vw_podcast_pro_archive_song_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_song_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_song_archive',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_song_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_song_archive',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_archive_song_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_song_archive',
			'settings' => 'vw_podcast_pro_archive_song_heading_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_desc_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_archive_song_desc_settings',
		array(
			'label' => __('Song Descreption Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_song_archive'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_desc_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_song_desc_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_song_archive',
		'setting' => 'vw_podcast_pro_archive_song_desc_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_desc_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_song_desc_font_weight',
	array(
		'section' => 'vw_podcast_pro_song_archive',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_desc_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_archive_song_desc_font_family',
	array(
		'section' => 'vw_podcast_pro_song_archive',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_archive_song_desc_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_archive_song_desc_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_song_archive',
			'settings' => 'vw_podcast_pro_archive_song_desc_color',
		)
	)
);


// ---------------------404 Page---------------------------

//404 Page Setting



$wp_customize->add_section(
	'vw_podcast_pro_404_page',
	array(
		'title' => __('404 Page Settings', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_404_page_big_word',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'vw_podcast_pro_404_page_big_word',
	array(
		'label' => __('Add Word', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_404_page',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_404_page_content',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'vw_podcast_pro_404_page_content',
	array(
		'label' => __('Add Paragraph', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_404_page',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_button_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_button_text',
	array(
		'label' => __('Add Button Text', 'vw-podcast-pro'),
		'input_attrs' => array(
			'placeholder' => __('Back to Home Page', 'vw-podcast-pro'),
		),
		'section' => 'vw_podcast_pro_404_page',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_error_temp_bg_images',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_error_temp_bg_images',
		array(
			'label' => __('404 Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_404_page',
			'settings' => 'vw_podcast_pro_error_temp_bg_images'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_color_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_404_page_color_settings',
		array(
			'label' => __('Heading Typography', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_404_page'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_404_page_title_color',
		array(
			'label' => __('Heading Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_404_page',
			'settings' => 'vw_podcast_pro_404_page_title_color',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_title_font_family',
	array(
		'section' => 'vw_podcast_pro_404_page',
		'label' => __('Heading Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_title_font_size',
	array(
		'label' => __('Heading Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_404_page',
		'setting' => 'vw_podcast_pro_404_page_title_font_size',
		'type' => 'number'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_404_page_sub_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_sub_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_404_page',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_404_page_content_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_404_page_content_color',
		array(
			'label' => __('Content Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_404_page',
			'settings' => 'vw_podcast_pro_404_page_content_color',
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_404_page_content_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_content_font_family',
	array(
		'section' => 'vw_podcast_pro_404_page',
		'label' => __('Content Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_404_page_content_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_content_font_size',
	array(
		'label' => __('Content Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_404_page',
		'setting' => 'vw_podcast_pro_404_page_content_font_size',
		'type' => 'number'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_404_page_content_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_content_font_weight',
	array(
		'section' => 'vw_podcast_pro_404_page',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_404_page_button_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_404_page_button_settings',
		array(
			'label' => __('Button Typography', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_404_page'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_button_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_404_page_button_color',
		array(
			'label' => __('Button Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_404_page',
			'settings' => 'vw_podcast_pro_404_page_button_color',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_button_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_button_font_family',
	array(
		'section' => 'vw_podcast_pro_404_page',
		'label' => __('Button Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_button_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_button_font_size',
	array(
		'label' => __('Button Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_404_page',
		'setting' => 'vw_podcast_pro_404_page_button_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_button_bg_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_404_page_button_bg_color',
		array(
			'label' => __('Button Background Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_404_page',
			'settings' => 'vw_podcast_pro_404_page_button_bg_color',
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_404_page_button_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_404_page_button_font_weight',
	array(
		'section' => 'vw_podcast_pro_404_page',
		'label' => __('Button Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);



// pricing Page Setting



$wp_customize->add_section(
	'vw_podcast_pro_pricing_page',
	array(
		'title' => __('Pricing Page Settings', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_pricing_page_heading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_pricing_page_heading',
	array(
		'label' => __('Page Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_pricing_page',
		'setting' => 'vw_podcast_pro_pricing_page_heading',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_pricing_page_descreption',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_pricing_page_descreption',
	array(
		'label' => __('Heading Description', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_pricing_page',
		'setting' => 'vw_podcast_pro_pricing_page_descreption',
		'type' => 'text'
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_mission_features_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_mission_features_settings',
		array(
			'label' => __('Feature and Features Images Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_pricing_page'
		)
	)
);

for ($i = 1; $i <= 5; $i++) {
	// Setting
	$wp_customize->add_setting(
		'vw_podcast_pro_feature_image_' . $i,
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	// Control
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'vw_podcast_pro_feature_image_' . $i,
			array(
				'label' => __('Features Images ' . $i, 'vw-podcast-pro'),
				'section' => 'vw_podcast_pro_pricing_page',
				'settings' => 'vw_podcast_pro_feature_image_' . $i
			)
		)
	);
	$wp_customize->add_setting(
		'vw_podcast_pro_pricing_page_feature_img_text' . $i,
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'vw_podcast_pro_pricing_page_feature_img_text' . $i,
		array(
			'label' => __('Feature Text ' . $i, 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_pricing_page',
			'setting' => 'vw_podcast_pro_pricing_page_feature_img_text' . $i,
			'type' => 'text'
		)
	);

}








// Single Song page 



$wp_customize->add_section(
	'vw_podcast_pro_single_song',
	array(
		'title' => __('Single Song Section', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_song_title_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_song_title_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_title_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_title_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_single_song',
		'setting' => 'vw_podcast_pro_song_title_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_song_title_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_title_font_weight',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_title_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_title_font_family',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_song_title_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_song_title_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song',
			'settings' => 'vw_podcast_pro_song_title_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_artist_name_settings',
		array(
			'label' => __('Song Artist Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_name_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_single_song',
		'setting' => 'vw_podcast_pro_artist_name_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_name_font_weight',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_name_font_family',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_artist_name_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song',
			'settings' => 'vw_podcast_pro_artist_name_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_song_duration_played_settings',
		array(
			'label' => __('Duration and Times Played Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_duration_played_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_single_song',
		'setting' => 'vw_podcast_pro_song_duration_played_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_duration_played_font_weight',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_duration_played_font_family',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_song_duration_played_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song',
			'settings' => 'vw_podcast_pro_song_duration_played_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_song_meta_taxonomy_settings',
		array(
			'label' => __('Song Metadata Taxomony Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_meta_taxonomy_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_single_song',
		'setting' => 'vw_podcast_pro_song_meta_taxonomy_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_meta_taxonomy_font_weight',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_meta_taxonomy_font_family',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_song_meta_taxonomy_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song',
			'settings' => 'vw_podcast_pro_song_meta_taxonomy_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_play_btn_taxonomy_settings',
		array(
			'label' => __('Play Button Taxonomy Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_play_btn_taxonomy_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_single_song',
		'setting' => 'vw_podcast_pro_play_btn_taxonomy_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_play_btn_taxonomy_font_weight',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_play_btn_taxonomy_font_family',
	array(
		'section' => 'vw_podcast_pro_single_song',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_play_btn_taxonomy_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_single_song',
			'settings' => 'vw_podcast_pro_play_btn_taxonomy_color',
		)
	)
);





// single Albums page



$wp_customize->add_section(
	'vw_podcast_pro_singe_album_sec',
	array(
		'title' => __('Single Album Page/Single Playlist', 'vw-podcast-pro'),
		'description' => __('Add features section settings here.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_title_album_playlist_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_song_title_album_playlist_settings',
		array(
			'label' => __('Song Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_title_album_playlist_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_title_album_playlist_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_singe_album_sec',
		'setting' => 'vw_podcast_pro_song_title_album_playlist_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_song_title_album_playlist_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_title_album_playlist_font_weight',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_title_album_playlist_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_title_album_playlist_font_family',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_song_title_album_playlist_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_song_title_album_playlist_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec',
			'settings' => 'vw_podcast_pro_song_title_album_playlist_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_album_playlist_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_artist_name_album_playlist_settings',
		array(
			'label' => __('Song Artist Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_album_playlist_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_name_album_playlist_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_singe_album_sec',
		'setting' => 'vw_podcast_pro_artist_name_album_playlist_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_album_playlist_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_name_album_playlist_font_weight',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_album_playlist_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_artist_name_album_playlist_font_family',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_artist_name_album_playlist_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_artist_name_album_playlist_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec',
			'settings' => 'vw_podcast_pro_artist_name_album_playlist_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_album_playlist_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_song_duration_played_album_playlist_settings',
		array(
			'label' => __('Duration and Times Played Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_album_playlist_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_duration_played_album_playlist_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_singe_album_sec',
		'setting' => 'vw_podcast_pro_song_duration_played_album_playlist_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_album_playlist_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_duration_played_album_playlist_font_weight',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_album_playlist_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_duration_played_album_playlist_font_family',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_song_duration_played_album_playlist_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_song_duration_played_album_playlist_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec',
			'settings' => 'vw_podcast_pro_song_duration_played_album_playlist_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_album_playlist_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_song_meta_taxonomy_album_playlist_settings',
		array(
			'label' => __('Song Metadata Taxomony Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_album_playlist_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_meta_taxonomy_album_playlist_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_singe_album_sec',
		'setting' => 'vw_podcast_pro_song_meta_taxonomy_album_playlist_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_album_playlist_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_meta_taxonomy_album_playlist_font_weight',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_album_playlist_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_song_meta_taxonomy_album_playlist_font_family',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_song_meta_taxonomy_album_playlist_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_song_meta_taxonomy_album_playlist_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec',
			'settings' => 'vw_podcast_pro_song_meta_taxonomy_album_playlist_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_album_playlist_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_play_btn_taxonomy_album_playlist_settings',
		array(
			'label' => __('Play Button Taxonomy Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_album_playlist_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_play_btn_taxonomy_album_playlist_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_singe_album_sec',
		'setting' => 'vw_podcast_pro_play_btn_taxonomy_album_playlist_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_album_playlist_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_play_btn_taxonomy_album_playlist_font_weight',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_album_playlist_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_play_btn_taxonomy_album_playlist_font_family',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_play_btn_taxonomy_album_playlist_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_play_btn_taxonomy_album_playlist_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec',
			'settings' => 'vw_podcast_pro_play_btn_taxonomy_album_playlist_color',
		)
	)
);






$wp_customize->add_setting(
	'vw_podcast_pro_playlist_sec_headings_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_playlist_sec_headings_settings',
		array(
			'label' => __('Playlist Title Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_playlist_sec_headings_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_playlist_sec_headings_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_singe_album_sec',
		'setting' => 'vw_podcast_pro_playlist_sec_headings_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_playlist_sec_headings_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_playlist_sec_headings_font_weight',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_playlist_sec_headings_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_playlist_sec_headings_font_family',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_playlist_sec_headings_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_playlist_sec_headings_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec',
			'settings' => 'vw_podcast_pro_playlist_sec_headings_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_playlist_typography_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_playlist_typography_settings',
		array(
			'label' => __('Playlist Typographys Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec'
		)
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_playlist_typography_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_playlist_typography_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_singe_album_sec',
		'setting' => 'vw_podcast_pro_playlist_typography_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_playlist_typography_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_playlist_typography_font_weight',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_playlist_typography_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_playlist_typography_font_family',
	array(
		'section' => 'vw_podcast_pro_singe_album_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_playlist_typography_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_playlist_typography_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_singe_album_sec',
			'settings' => 'vw_podcast_pro_playlist_typography_color',
		)
	)
);




// customizer for artist page 


$wp_customize->add_section(
	'vw_podcast_pro_for_artist_sec',
	array(
		'title' => __('For Artists Page', 'vw-podcast-pro'),
		'description' => __('"For Artists" page settings.', 'vw-podcast-pro'),
		'panel' => 'vw_podcast_pro_panel_id',
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_span_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_heading_span_settings',
		array(
			'label' => __('Heading Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_register_page_image_logo',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_register_page_image_logo',
		array(
			'label' => __('Register Page Logo', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_register_page_image_logo'
		)
	)
);


// $wp_customize->add_setting(
// 	'vw_podcast_pro_register_artist_banner_image',
// 	array(
// 		'default' => '',
// 		'sanitize_callback' => 'esc_url_raw',
// 	)
// );
// $wp_customize->add_control(
// 	new WP_Customize_Image_Control(
// 		$wp_customize,
// 		'vw_podcast_pro_register_artist_banner_image',
// 		array(
// 			'label' => __('Banner Image', 'vw-podcast-pro'),
// 			'section' => 'vw_podcast_pro_for_artist_sec',
// 			'settings' => 'vw_podcast_pro_register_artist_banner_image'
// 		)
// 	)
// );


$wp_customize->add_setting(
	'vw_podcast_pro_register_artist_right',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_register_artist_right',
		array(
			'label' => __('Responsive showcase', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_register_artist_right'
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_span',
	array(
		'default' => 'Become',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_span',
	array(
		'label' => __('Heading Top', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_heading_span',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading',
	array(
		'default' => 'Podcast Artist',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading',
	array(
		'label' => __('Heading Bottom', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_heading',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_span_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_span_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_heading_span_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_span_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_span_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_span_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_span_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_span_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_heading_span_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_heading_span_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_heading_settings',
		array(
			'label' => __('Hading Tag Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading',
	array(
		'label' => __('Section Heading Tag', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_heading',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_heading_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_heading_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_heading_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_heading_text_settings',
		array(
			'label' => __('Heading Text Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_text',
	array(
		'label' => __('Heading text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_heading_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_heading_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_heading_text_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_heading_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_heading_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_heading_text_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_banner_btn_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_banner_btn_settings',
		array(
			'label' => __('Banner Button Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_banner_btn',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_banner_btn',
	array(
		'label' => __('Banner Button', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_banner_btn',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_banner_btn_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_banner_btn_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_banner_btn_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_banner_btn_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_banner_btn_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_banner_btn_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_banner_btn_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_banner_btn_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_banner_btn_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_banner_btn_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_details_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_register_details_settings',
		array(
			'label' => __('Register Details Bold Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_details',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_register_details',
	array(
		'label' => __('Register Details Bold', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_register_details',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_details_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_register_details_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_register_details_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_details_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_register_details_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_details_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_register_details_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_details_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_register_details_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_register_details_color',
		)
	)
);




$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_deatils_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_register_deatils_text_settings',
		array(
			'label' => __('Register Details Text Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_deatils_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_register_deatils_text',
	array(
		'label' => __('Register Deatils Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_register_deatils_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_deatils_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_register_deatils_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_register_deatils_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_deatils_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_register_deatils_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_deatils_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_register_deatils_text_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_register_deatils_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_register_deatils_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_register_deatils_text_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_banner_image_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization',
		'description' => __('Ideal Image Size 601 X 701', 'vw-podcast-pro'),
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_banner_image_settings',
		array(
			'label' => __('Banner Image Setting', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_banner_image',
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_banner_image',
		array(
			'label' => __('Banner Image', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_banner_image'
		)
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_showcase_heading_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_res_showcase_heading_text_settings',
		array(
			'label' => __('Responsive Showcase Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_showcase_heading_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_showcase_heading_text',
	array(
		'label' => __('Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_res_showcase_heading_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_showcase_heading_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_showcase_heading_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_res_showcase_heading_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_showcase_heading_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_showcase_heading_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_showcase_heading_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_showcase_heading_text_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_showcase_heading_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_res_showcase_heading_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_res_showcase_heading_text_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_text_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_res_text_text_settings',
		array(
			'label' => __('Responsive Showcase TextSettings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_text_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_text_text',
	array(
		'label' => __('Section Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_res_text_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_text_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_text_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_res_text_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_text_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_text_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_text_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_text_text_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_text_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_res_text_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_res_text_text_color',
		)
	)
);





$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_button_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_res_button_text_settings',
		array(
			'label' => __('Section Button Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_button_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_button_text',
	array(
		'label' => __('Section Heading Tag', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_res_button_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_button_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_button_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_res_button_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_button_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_button_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_button_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_res_button_text_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_res_button_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_res_button_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_res_button_text_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_dorm_sec_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_dorm_sec_text_settings',
		array(
			'label' => __('From Section Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_dorm_sec_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_dorm_sec_text',
	array(
		'label' => __('Section Heading', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_dorm_sec_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_dorm_sec_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_dorm_sec_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_dorm_sec_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_dorm_sec_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_dorm_sec_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_dorm_sec_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_dorm_sec_text_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_dorm_sec_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_dorm_sec_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_dorm_sec_text_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_text_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_from_text_text_settings',
		array(
			'label' => __('Section Text Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_text_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_text_text',
	array(
		'label' => __('Section Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_from_text_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_text_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_text_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_from_text_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_text_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_text_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_text_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_text_text_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_text_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_from_text_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_from_text_text_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_joining_num_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_from_joining_num_settings',
		array(
			'label' => __('Joining Numbers Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_joining_num',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_joining_num',
	array(
		'label' => __('Number', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_from_joining_num',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_joining_num_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_joining_num_2',
	array(
		'label' => __('Number', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_from_joining_num_2',
		'type' => 'text'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_joining_num_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_joining_num_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_from_joining_num_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_joining_num_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_joining_num_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_joining_num_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_joining_num_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_joining_num_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_from_joining_num_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_from_joining_num_color',
		)
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_tag_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_joining_num_tag_settings',
		array(
			'label' => __('Joining Num Tag Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_tag',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_tag',
	array(
		'label' => __('Heading Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_joining_num_tag',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_tag_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_tag_2',
	array(
		'label' => __('Heading Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_joining_num_tag_2',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_tag_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_tag_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_joining_num_tag_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_tag_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_tag_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_tag_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_tag_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_tag_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_joining_num_tag_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_joining_num_tag_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_joining_num_text_settings',
		array(
			'label' => __('Card Text Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_text',
	array(
		'label' => __('Card Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_joining_num_text',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_text_2',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_text_2',
	array(
		'label' => __('Card 2 Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_joining_num_text_2',
		'type' => 'text'
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_text_font_size',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_text_font_size',
	array(
		'label' => __('Font Size', 'vw-podcast-pro'),
		'description' => __('Add font size in px', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_joining_num_text_font_size',
		'type' => 'number'
	)
);
$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_text_font_weight',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_text_font_weight',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Weight', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_weight_array,
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_text_font_family',
	array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'vw_podcast_pro_sanitize_choices'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_joining_num_text_font_family',
	array(
		'section' => 'vw_podcast_pro_for_artist_sec',
		'label' => __('Font Family', 'vw-podcast-pro'),
		'type' => 'select',
		'choices' => $font_array,
	)
);


$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_joining_num_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_joining_num_text_color',
		array(
			'label' => __('Color', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec',
			'settings' => 'vw_podcast_pro_for_artist_joining_num_text_color',
		)
	)
);



$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_shortcode_text_settings',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'vw_podcast_pro_text_sanitization'
	)
);
$wp_customize->add_control(
	new VW_Themes_Seperator_custom_Control(
		$wp_customize,
		'vw_podcast_pro_for_artist_from_shortcode_text_settings',
		array(
			'label' => __('Form Settings Settings', 'vw-podcast-pro'),
			'section' => 'vw_podcast_pro_for_artist_sec'
		)
	)
);

$wp_customize->add_setting(
	'vw_podcast_pro_for_artist_from_shortcode_text',
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	'vw_podcast_pro_for_artist_from_shortcode_text',
	array(
		'label' => __('Shortcode Text', 'vw-podcast-pro'),
		'section' => 'vw_podcast_pro_for_artist_sec',
		'setting' => 'vw_podcast_pro_for_artist_from_shortcode_text',
		'type' => 'text'
	)
);
