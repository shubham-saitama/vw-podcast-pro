<?php
$custom_css = "";

$vw_podcast_pro_advertisement_sec_floating_wave_img = get_theme_mod('vw_podcast_pro_advertisement_sec_floating_wave_img');
if ($vw_podcast_pro_advertisement_sec_floating_wave_img != false) {
	$custom_css .= '.adds-link::after{';
	if ($vw_podcast_pro_advertisement_sec_floating_wave_img != false) {
		$custom_css .= 'background-image:url(' . esc_html($vw_podcast_pro_advertisement_sec_floating_wave_img) . ');';
	}
	$custom_css .= '}';
}




$custom_css .= '.left-inner::after {';

	$custom_css .= 'background-image:url(' . esc_html(get_template_directory_uri().'/assets/images/reg-background.png') . ');';

$custom_css .= '}';

$vw_podcast_pro_body_background = get_theme_mod('vw_podcast_pro_body_background');

if ($vw_podcast_pro_body_background != false) {
	$custom_css .= 'body{';
	if ($vw_podcast_pro_body_background != false && $vw_podcast_pro_body_background != false) {
		$custom_css .= 'background-color: ' . esc_html($vw_podcast_pro_body_background) . ' !important;';
	}
	$custom_css .= '}';
}





$vw_podcast_pro_player_control_color = get_theme_mod('vw_podcast_pro_player_control_color');
$vw_podcast_pro_player_control_font_size = get_theme_mod('vw_podcast_pro_player_control_font_size');
$vw_podcast_pro_player_control_font_family = get_theme_mod('vw_podcast_pro_player_control_font_family');
$vw_podcast_pro_player_control_font_weight = get_theme_mod('vw_podcast_pro_player_control_font_weight');

if ($vw_podcast_pro_player_control_color != false || $vw_podcast_pro_player_control_font_family != false || $vw_podcast_pro_player_control_font_size != false || $vw_podcast_pro_player_control_font_weight != false) {
	$custom_css .= '.vwwaveplayer .vwwvpl-stats,.vwwaveplayer .vwwvpl-icon.vwwvpl-likes::before,.dureation-wrap i.fa.fa-clock-o,i.fa-solid.fa-ellipsis-vertical,.player .vwwvpl-duration{';
	if ($vw_podcast_pro_player_control_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_player_control_color) . ' ;';
	}
	if ($vw_podcast_pro_player_control_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_player_control_font_family) . ' ;';
	}
	if ($vw_podcast_pro_player_control_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_player_control_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_player_control_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_player_control_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_ad_artistName_color = get_theme_mod('vw_podcast_pro_ad_artistName_color');
$vw_podcast_pro_ad_artistName_font_size = get_theme_mod('vw_podcast_pro_ad_artistName_font_size');
$vw_podcast_pro_ad_artistName_font_family = get_theme_mod('vw_podcast_pro_ad_artistName_font_family');
$vw_podcast_pro_ad_artistName_font_weight = get_theme_mod('vw_podcast_pro_ad_artistName_font_weight');

if ($vw_podcast_pro_ad_artistName_color != false || $vw_podcast_pro_ad_artistName_font_family != false || $vw_podcast_pro_ad_artistName_font_size != false || $vw_podcast_pro_ad_artistName_font_weight != false) {
	$custom_css .= '.event-add-section .artist{';
	if ($vw_podcast_pro_ad_artistName_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_ad_artistName_color) . ' ;';
	}
	if ($vw_podcast_pro_ad_artistName_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_ad_artistName_font_family) . ' ;';
	}
	if ($vw_podcast_pro_ad_artistName_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_ad_artistName_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_ad_artistName_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_ad_artistName_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_proad_event_schedule_text_color = get_theme_mod('vw_podcast_proad_event_schedule_text_color');
$vw_podcast_proad_event_schedule_text_font_size = get_theme_mod('vw_podcast_proad_event_schedule_text_font_size');
$vw_podcast_proad_event_schedule_text_font_family = get_theme_mod('vw_podcast_proad_event_schedule_text_font_family');
$vw_podcast_proad_event_schedule_text_font_weight = get_theme_mod('vw_podcast_proad_event_schedule_text_font_weight');

if ($vw_podcast_proad_event_schedule_text_color != false || $vw_podcast_proad_event_schedule_text_font_family != false || $vw_podcast_proad_event_schedule_text_font_size != false || $vw_podcast_proad_event_schedule_text_font_weight != false) {
	$custom_css .= '.venue-name,.evt-timing,.date,.date small{';
	if ($vw_podcast_proad_event_schedule_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_proad_event_schedule_text_color) . ' ;';
	}
	if ($vw_podcast_proad_event_schedule_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_proad_event_schedule_text_font_family) . ' ;';
	}
	if ($vw_podcast_proad_event_schedule_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_proad_event_schedule_text_font_size) . 'px ;';
	}
	if ($vw_podcast_proad_event_schedule_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_proad_event_schedule_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}



$vw_podcast_pro_for_artist_register_deatils_text_color = get_theme_mod('vw_podcast_pro_for_artist_register_deatils_text_color');
$vw_podcast_pro_for_artist_register_deatils_text_font_size = get_theme_mod('vw_podcast_pro_for_artist_register_deatils_text_font_size');
$vw_podcast_pro_for_artist_register_deatils_text_font_family = get_theme_mod('vw_podcast_pro_for_artist_register_deatils_text_font_family');
$vw_podcast_pro_for_artist_register_deatils_text_font_weight = get_theme_mod('vw_podcast_pro_for_artist_register_deatils_text_font_weight');

if ($vw_podcast_pro_for_artist_register_deatils_text_color != false || $vw_podcast_pro_for_artist_register_deatils_text_font_family != false || $vw_podcast_pro_for_artist_register_deatils_text_font_size != false || $vw_podcast_pro_for_artist_register_deatils_text_font_weight != false) {
	$custom_css .= '.inner-text-wrap small{';
	if ($vw_podcast_pro_for_artist_register_deatils_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_register_deatils_text_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_register_deatils_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_register_deatils_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_register_deatils_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_register_deatils_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_register_deatils_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_register_deatils_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_for_artist_res_showcase_heading_text_color = get_theme_mod('vw_podcast_pro_for_artist_res_showcase_heading_text_color');
$vw_podcast_pro_for_artist_res_showcase_heading_text_font_size = get_theme_mod('vw_podcast_pro_for_artist_res_showcase_heading_text_font_size');
$vw_podcast_pro_for_artist_res_showcase_heading_text_font_family = get_theme_mod('vw_podcast_pro_for_artist_res_showcase_heading_text_font_family');
$vw_podcast_pro_for_artist_res_showcase_heading_text_font_weight = get_theme_mod('vw_podcast_pro_for_artist_res_showcase_heading_text_font_weight');

if ($vw_podcast_pro_for_artist_res_showcase_heading_text_color != false || $vw_podcast_pro_for_artist_res_showcase_heading_text_font_family != false || $vw_podcast_pro_for_artist_res_showcase_heading_text_font_size != false || $vw_podcast_pro_for_artist_res_showcase_heading_text_font_weight != false) {
	$custom_css .= 'section.responsive-showcase h2{';
	if ($vw_podcast_pro_for_artist_res_showcase_heading_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_res_showcase_heading_text_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_res_showcase_heading_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_res_showcase_heading_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_res_showcase_heading_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_res_showcase_heading_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_res_showcase_heading_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_res_showcase_heading_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_for_artist_res_text_text_color = get_theme_mod('vw_podcast_pro_for_artist_res_text_text_color');
$vw_podcast_pro_for_artist_res_text_text_font_size = get_theme_mod('vw_podcast_pro_for_artist_res_text_text_font_size');
$vw_podcast_pro_for_artist_res_text_text_font_family = get_theme_mod('vw_podcast_pro_for_artist_res_text_text_font_family');
$vw_podcast_pro_for_artist_res_text_text_font_weight = get_theme_mod('vw_podcast_pro_for_artist_res_text_text_font_weight');

if ($vw_podcast_pro_for_artist_res_text_text_color != false || $vw_podcast_pro_for_artist_res_text_text_font_family != false || $vw_podcast_pro_for_artist_res_text_text_font_size != false || $vw_podcast_pro_for_artist_res_text_text_font_weight != false) {
	$custom_css .= 'section.responsive-showcase p{';
	if ($vw_podcast_pro_for_artist_res_text_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_res_text_text_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_res_text_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_res_text_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_res_text_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_res_text_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_res_text_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_res_text_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_for_artist_res_button_text_color = get_theme_mod('vw_podcast_pro_for_artist_res_button_text_color');
$vw_podcast_pro_for_artist_res_button_text_font_size = get_theme_mod('vw_podcast_pro_for_artist_res_button_text_font_size');
$vw_podcast_pro_for_artist_res_button_text_font_family = get_theme_mod('vw_podcast_pro_for_artist_res_button_text_font_family');
$vw_podcast_pro_for_artist_res_button_text_font_weight = get_theme_mod('vw_podcast_pro_for_artist_res_button_text_font_weight');

if ($vw_podcast_pro_for_artist_res_button_text_color != false || $vw_podcast_pro_for_artist_res_button_text_font_family != false || $vw_podcast_pro_for_artist_res_button_text_font_size != false || $vw_podcast_pro_for_artist_res_button_text_font_weight != false) {
	$custom_css .= 'section.responsive-showcase a.register-btn{';
	if ($vw_podcast_pro_for_artist_res_button_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_res_button_text_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_res_button_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_res_button_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_res_button_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_res_button_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_res_button_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_res_button_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_for_artist_from_text_text_color = get_theme_mod('vw_podcast_pro_for_artist_from_text_text_color');
$vw_podcast_pro_for_artist_from_text_text_font_size = get_theme_mod('vw_podcast_pro_for_artist_from_text_text_font_size');
$vw_podcast_pro_for_artist_from_text_text_font_family = get_theme_mod('vw_podcast_pro_for_artist_from_text_text_font_family');
$vw_podcast_pro_for_artist_from_text_text_font_weight = get_theme_mod('vw_podcast_pro_for_artist_from_text_text_font_weight');

if ($vw_podcast_pro_for_artist_from_text_text_color != false || $vw_podcast_pro_for_artist_from_text_text_font_family != false || $vw_podcast_pro_for_artist_from_text_text_font_size != false || $vw_podcast_pro_for_artist_from_text_text_font_weight != false) {
	$custom_css .= '.form-left p{';
	if ($vw_podcast_pro_for_artist_from_text_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_from_text_text_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_from_text_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_from_text_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_from_text_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_from_text_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_from_text_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_from_text_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_for_artist_dorm_sec_text_color = get_theme_mod('vw_podcast_pro_for_artist_dorm_sec_text_color');
$vw_podcast_pro_for_artist_dorm_sec_text_font_size = get_theme_mod('vw_podcast_pro_for_artist_dorm_sec_text_font_size');
$vw_podcast_pro_for_artist_dorm_sec_text_font_family = get_theme_mod('vw_podcast_pro_for_artist_dorm_sec_text_font_family');
$vw_podcast_pro_for_artist_dorm_sec_text_font_weight = get_theme_mod('vw_podcast_pro_for_artist_dorm_sec_text_font_weight');

if ($vw_podcast_pro_for_artist_dorm_sec_text_color != false || $vw_podcast_pro_for_artist_dorm_sec_text_font_family != false || $vw_podcast_pro_for_artist_dorm_sec_text_font_size != false || $vw_podcast_pro_for_artist_dorm_sec_text_font_weight != false) {
	$custom_css .= '.form-left h2{';
	if ($vw_podcast_pro_for_artist_dorm_sec_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_dorm_sec_text_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_dorm_sec_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_dorm_sec_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_dorm_sec_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_dorm_sec_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_dorm_sec_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_dorm_sec_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_for_artist_from_joining_num_color = get_theme_mod('vw_podcast_pro_for_artist_from_joining_num_color');
$vw_podcast_pro_for_artist_from_joining_num_font_size = get_theme_mod('vw_podcast_pro_for_artist_from_joining_num_font_size');
$vw_podcast_pro_for_artist_from_joining_num_font_family = get_theme_mod('vw_podcast_pro_for_artist_from_joining_num_font_family');
$vw_podcast_pro_for_artist_from_joining_num_font_weight = get_theme_mod('vw_podcast_pro_for_artist_from_joining_num_font_weight');

if ($vw_podcast_pro_for_artist_from_joining_num_color != false || $vw_podcast_pro_for_artist_from_joining_num_font_family != false || $vw_podcast_pro_for_artist_from_joining_num_font_size != false || $vw_podcast_pro_for_artist_from_joining_num_font_weight != false) {
	$custom_css .= '.join-num{';
	if ($vw_podcast_pro_for_artist_from_joining_num_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_from_joining_num_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_from_joining_num_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_from_joining_num_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_from_joining_num_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_from_joining_num_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_from_joining_num_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_from_joining_num_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_for_artist_joining_num_tag_color = get_theme_mod('vw_podcast_pro_for_artist_joining_num_tag_color');
$vw_podcast_pro_for_artist_joining_num_tag_font_size = get_theme_mod('vw_podcast_pro_for_artist_joining_num_tag_font_size');
$vw_podcast_pro_for_artist_joining_num_tag_font_family = get_theme_mod('vw_podcast_pro_for_artist_joining_num_tag_font_family');
$vw_podcast_pro_for_artist_joining_num_tag_font_weight = get_theme_mod('vw_podcast_pro_for_artist_joining_num_tag_font_weight');

if ($vw_podcast_pro_for_artist_joining_num_tag_color != false || $vw_podcast_pro_for_artist_joining_num_tag_font_family != false || $vw_podcast_pro_for_artist_joining_num_tag_font_size != false || $vw_podcast_pro_for_artist_joining_num_tag_font_weight != false) {
	$custom_css .= '.number-heading{';
	if ($vw_podcast_pro_for_artist_joining_num_tag_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_joining_num_tag_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_joining_num_tag_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_joining_num_tag_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_joining_num_tag_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_joining_num_tag_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_joining_num_tag_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_joining_num_tag_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_for_artist_joining_num_text_color = get_theme_mod('vw_podcast_pro_for_artist_joining_num_text_color');
$vw_podcast_pro_for_artist_joining_num_text_font_size = get_theme_mod('vw_podcast_pro_for_artist_joining_num_text_font_size');
$vw_podcast_pro_for_artist_joining_num_text_font_family = get_theme_mod('vw_podcast_pro_for_artist_joining_num_text_font_family');
$vw_podcast_pro_for_artist_joining_num_text_font_weight = get_theme_mod('vw_podcast_pro_for_artist_joining_num_text_font_weight');

if ($vw_podcast_pro_for_artist_joining_num_text_color != false || $vw_podcast_pro_for_artist_joining_num_text_font_family != false || $vw_podcast_pro_for_artist_joining_num_text_font_size != false || $vw_podcast_pro_for_artist_joining_num_text_font_weight != false) {
	$custom_css .= '.joining-num-card p{';
	if ($vw_podcast_pro_for_artist_joining_num_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_joining_num_text_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_joining_num_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_joining_num_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_joining_num_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_joining_num_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_joining_num_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_joining_num_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_for_artist_banner_btn_color = get_theme_mod('vw_podcast_pro_for_artist_banner_btn_color');
$vw_podcast_pro_for_artist_banner_btn_font_size = get_theme_mod('vw_podcast_pro_for_artist_banner_btn_font_size');
$vw_podcast_pro_for_artist_banner_btn_font_family = get_theme_mod('vw_podcast_pro_for_artist_banner_btn_font_family');
$vw_podcast_pro_for_artist_banner_btn_font_weight = get_theme_mod('vw_podcast_pro_for_artist_banner_btn_font_weight');

if ($vw_podcast_pro_for_artist_banner_btn_color != false || $vw_podcast_pro_for_artist_banner_btn_font_family != false || $vw_podcast_pro_for_artist_banner_btn_font_size != false || $vw_podcast_pro_for_artist_banner_btn_font_weight != false) {
	$custom_css .= 'a.register-btn{';
	if ($vw_podcast_pro_for_artist_banner_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_banner_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_banner_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_banner_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_banner_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_banner_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_banner_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_banner_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_for_artist_heading_text_color = get_theme_mod('vw_podcast_pro_for_artist_heading_text_color');
$vw_podcast_pro_for_artist_heading_text_font_size = get_theme_mod('vw_podcast_pro_for_artist_heading_text_font_size');
$vw_podcast_pro_for_artist_heading_text_font_family = get_theme_mod('vw_podcast_pro_for_artist_heading_text_font_family');
$vw_podcast_pro_for_artist_heading_text_font_weight = get_theme_mod('vw_podcast_pro_for_artist_heading_text_font_weight');

if ($vw_podcast_pro_for_artist_heading_text_color != false || $vw_podcast_pro_for_artist_heading_text_font_family != false || $vw_podcast_pro_for_artist_heading_text_font_size != false || $vw_podcast_pro_for_artist_heading_text_font_weight != false) {
	$custom_css .= 'section.bedome-artist p.heading-tag,section.bedome-artist p.heading-text{';
	if ($vw_podcast_pro_for_artist_heading_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_heading_text_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_heading_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_heading_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_heading_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_heading_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_heading_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_heading_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_for_artist_heading_span_color = get_theme_mod('vw_podcast_pro_for_artist_heading_span_color');
$vw_podcast_pro_for_artist_heading_span_font_size = get_theme_mod('vw_podcast_pro_for_artist_heading_span_font_size');
$vw_podcast_pro_for_artist_heading_span_font_family = get_theme_mod('vw_podcast_pro_for_artist_heading_span_font_family');
$vw_podcast_pro_for_artist_heading_span_font_weight = get_theme_mod('vw_podcast_pro_for_artist_heading_span_font_weight');

if ($vw_podcast_pro_for_artist_heading_span_color != false || $vw_podcast_pro_for_artist_heading_span_font_family != false || $vw_podcast_pro_for_artist_heading_span_font_size != false || $vw_podcast_pro_for_artist_heading_span_font_weight != false) {
	$custom_css .= '.artist-left h1{';
	if ($vw_podcast_pro_for_artist_heading_span_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_heading_span_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_heading_span_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_heading_span_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_heading_span_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_heading_span_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_heading_span_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_heading_span_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_for_artist_register_details_color = get_theme_mod('vw_podcast_pro_for_artist_register_details_color');
$vw_podcast_pro_for_artist_register_details_font_size = get_theme_mod('vw_podcast_pro_for_artist_register_details_font_size');
$vw_podcast_pro_for_artist_register_details_font_family = get_theme_mod('vw_podcast_pro_for_artist_register_details_font_family');
$vw_podcast_pro_for_artist_register_details_font_weight = get_theme_mod('vw_podcast_pro_for_artist_register_details_font_weight');

if ($vw_podcast_pro_for_artist_register_details_color != false || $vw_podcast_pro_for_artist_register_details_font_family != false || $vw_podcast_pro_for_artist_register_details_font_size != false || $vw_podcast_pro_for_artist_register_details_font_weight != false) {
	$custom_css .= '.inner-text-wrap p{';
	if ($vw_podcast_pro_for_artist_register_details_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_register_details_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_register_details_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_register_details_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_register_details_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_register_details_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_register_details_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_register_details_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_for_artist_heading_color = get_theme_mod('vw_podcast_pro_for_artist_heading_color');
$vw_podcast_pro_for_artist_heading_font_size = get_theme_mod('vw_podcast_pro_for_artist_heading_font_size');
$vw_podcast_pro_for_artist_heading_font_family = get_theme_mod('vw_podcast_pro_for_artist_heading_font_family');
$vw_podcast_pro_for_artist_heading_font_weight = get_theme_mod('vw_podcast_pro_for_artist_heading_font_weight');

if ($vw_podcast_pro_for_artist_heading_color != false || $vw_podcast_pro_for_artist_heading_font_family != false || $vw_podcast_pro_for_artist_heading_font_size != false || $vw_podcast_pro_for_artist_heading_font_weight != false) {
	$custom_css .= '.bedome-artist .artist-left h1 span{';
	if ($vw_podcast_pro_for_artist_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_for_artist_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_for_artist_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_for_artist_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_for_artist_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_for_artist_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_for_artist_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_spanish_show_all_btn_color_bg_grad_one = get_theme_mod('vw_podcast_pro_spanish_show_all_btn_color_bg_grad_one');
$vw_podcast_pro_spanish_show_all_btn_color_bg_grad_two = get_theme_mod('vw_podcast_pro_spanish_show_all_btn_color_bg_grad_two');


if ($vw_podcast_pro_spanish_show_all_btn_color_bg_grad_one != false || $vw_podcast_pro_spanish_show_all_btn_color_bg_grad_two != false) {
	$custom_css .= '#footer .last-col{';
	if ($vw_podcast_pro_spanish_show_all_btn_color_bg_grad_one != false || $vw_podcast_pro_spanish_show_all_btn_color_bg_grad_two != false)
		$custom_css .= 'background-image: linear-gradient(to right,' . esc_html($vw_podcast_pro_spanish_show_all_btn_color_bg_grad_one) . ',' . esc_html($vw_podcast_pro_spanish_show_all_btn_color_bg_grad_two) . ');';
	$custom_css .= '}';
}

$vw_podcast_pro_radio_radio_sec_title_color = get_theme_mod('vw_podcast_pro_radio_radio_sec_title_color');
$vw_podcast_pro_radio_radio_sec_title_font_size = get_theme_mod('vw_podcast_pro_radio_radio_sec_title_font_size');
$vw_podcast_pro_radio_radio_sec_title_font_family = get_theme_mod('vw_podcast_pro_radio_radio_sec_title_font_family');
$vw_podcast_pro_radio_radio_sec_title_font_weight = get_theme_mod('vw_podcast_pro_radio_radio_sec_title_font_weight');

if ($vw_podcast_pro_radio_radio_sec_title_color != false || $vw_podcast_pro_radio_radio_sec_title_font_family != false || $vw_podcast_pro_radio_radio_sec_title_font_size != false || $vw_podcast_pro_radio_radio_sec_title_font_weight != false) {
	$custom_css .= 'section.category-radio h3{';
	if ($vw_podcast_pro_radio_radio_sec_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_radio_radio_sec_title_color) . ' ;';
	}
	if ($vw_podcast_pro_radio_radio_sec_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_radio_radio_sec_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_radio_radio_sec_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_radio_radio_sec_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_radio_radio_sec_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_radio_radio_sec_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_artist_show_all_btn_color = get_theme_mod('vw_podcast_pro_artist_show_all_btn_color');
$vw_podcast_pro_artist_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_artist_show_all_btn_font_size');
$vw_podcast_pro_artist_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_artist_show_all_btn_font_family');
$vw_podcast_pro_artist_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_artist_show_all_btn_font_weight');

if ($vw_podcast_pro_artist_show_all_btn_color != false || $vw_podcast_pro_artist_show_all_btn_font_family != false || $vw_podcast_pro_artist_show_all_btn_font_size != false || $vw_podcast_pro_artist_show_all_btn_font_weight != false) {
	$custom_css .= 'section.category-artist.artist-cat-home .show-all a{';
	if ($vw_podcast_pro_artist_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_artist_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_artist_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_artist_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_artist_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_artist_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_artist_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_artist_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_404_page_title_color = get_theme_mod('vw_podcast_pro_404_page_title_color');
$vw_podcast_pro_404_page_title_font_size = get_theme_mod('vw_podcast_pro_404_page_title_font_size');
$vw_podcast_pro_404_page_title_font_family = get_theme_mod('vw_podcast_pro_404_page_title_font_family');
$vw_podcast_pro_404_page_title_font_weight = get_theme_mod('vw_podcast_pro_404_page_title_font_weight');

if ($vw_podcast_pro_404_page_title_color != false || $vw_podcast_pro_404_page_title_font_family != false || $vw_podcast_pro_404_page_title_font_size != false || $vw_podcast_pro_404_page_title_font_weight != false) {
	$custom_css .= 'span.big-word{';
	if ($vw_podcast_pro_404_page_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_404_page_title_color) . ' ;';
	}
	if ($vw_podcast_pro_404_page_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_404_page_title_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_404_page_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_404_page_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_404_page_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_404_page_title_font_family) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_404_page_content_color = get_theme_mod('vw_podcast_pro_404_page_content_color');
$vw_podcast_pro_404_page_content_font_size = get_theme_mod('vw_podcast_pro_404_page_content_font_size');
$vw_podcast_pro_404_page_content_font_family = get_theme_mod('vw_podcast_pro_404_page_content_font_family');
$vw_podcast_pro_404_page_content_font_weight = get_theme_mod('vw_podcast_pro_404_page_content_font_weight');

if ($vw_podcast_pro_404_page_content_color != false || $vw_podcast_pro_404_page_content_font_family != false || $vw_podcast_pro_404_page_content_font_size != false || $vw_podcast_pro_404_page_content_font_weight != false) {
	$custom_css .= 'p.error-para.mt-3.heading-description{';
	if ($vw_podcast_pro_404_page_content_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_404_page_content_color) . ' ;';
	}
	if ($vw_podcast_pro_404_page_content_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_404_page_content_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_404_page_content_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_404_page_content_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_404_page_content_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_404_page_content_font_family) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_404_page_button_color = get_theme_mod('vw_podcast_pro_404_page_button_color');
$vw_podcast_pro_404_page_button_font_size = get_theme_mod('vw_podcast_pro_404_page_button_font_size');
$vw_podcast_pro_404_page_button_font_family = get_theme_mod('vw_podcast_pro_404_page_button_font_family');
$vw_podcast_pro_404_page_button_font_weight = get_theme_mod('vw_podcast_pro_404_page_button_font_weight');

if ($vw_podcast_pro_404_page_button_color != false || $vw_podcast_pro_404_page_button_font_family != false || $vw_podcast_pro_404_page_button_font_size != false || $vw_podcast_pro_404_page_button_font_weight != false) {
	$custom_css .= '.tablet-error a.red-btn{';
	if ($vw_podcast_pro_404_page_button_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_404_page_button_color) . ' ;';
	}
	if ($vw_podcast_pro_404_page_button_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_404_page_button_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_404_page_button_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_404_page_button_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_404_page_button_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_404_page_button_font_family) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_404_page_button_bg_color = get_theme_mod('vw_podcast_pro_404_page_button_bg_color');
if ($vw_podcast_pro_404_page_button_bg_color != false) {
	$custom_css .= '.tablet-error a.red-btn{';
	if ($vw_podcast_pro_404_page_button_bg_color != false) {
		$custom_css .= 'background-color: ' . esc_html($vw_podcast_pro_404_page_button_bg_color) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_blog_page_para_para_color = get_theme_mod('vw_podcast_pro_blog_page_para_para_color');
$vw_podcast_pro_blog_page_para_para_font_size = get_theme_mod('vw_podcast_pro_blog_page_para_para_font_size');
$vw_podcast_pro_blog_page_para_para_font_family = get_theme_mod('vw_podcast_pro_blog_page_para_para_font_family');
$vw_podcast_pro_blog_page_para_para_font_weight = get_theme_mod('vw_podcast_pro_blog_page_para_para_font_weight');


if ($vw_podcast_pro_blog_page_para_para_color != false || $vw_podcast_pro_blog_page_para_para_font_family != false || $vw_podcast_pro_blog_page_para_para_font_size != false || $vw_podcast_pro_blog_page_para_para_font_weight != false) {
	$custom_css .= '.blog-single .single-post p,.info-bar a,a.blog-link{';
	if ($vw_podcast_pro_blog_page_para_para_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_blog_page_para_para_color) . ' !important;';
	}
	if ($vw_podcast_pro_blog_page_para_para_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_blog_page_para_para_font_family) . ' !important;';
	}
	if ($vw_podcast_pro_blog_page_para_para_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_blog_page_para_para_font_size) . 'px !important;';
	}
	if ($vw_podcast_pro_blog_page_para_para_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_blog_page_para_para_font_weight) . ' !important;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_post_general_settings_heading_color = get_theme_mod('vw_podcast_pro_post_general_settings_heading_color');
$vw_podcast_pro_post_general_settings_overview_count_font_size = get_theme_mod('vw_podcast_pro_post_general_settings_overview_count_font_size');
$vw_podcast_pro_post_general_settings_overview_count_font_family = get_theme_mod('vw_podcast_pro_post_general_settings_overview_count_font_family');
$vw_podcast_pro_post_general_settings_overview_count_font_weight = get_theme_mod('vw_podcast_pro_post_general_settings_overview_count_font_weight');


if ($vw_podcast_pro_post_general_settings_heading_color != false || $vw_podcast_pro_post_general_settings_overview_count_font_family != false || $vw_podcast_pro_post_general_settings_overview_count_font_size != false || $vw_podcast_pro_post_general_settings_overview_count_font_weight != false) {
	$custom_css .= '.single-page-title h2{';
	if ($vw_podcast_pro_post_general_settings_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_post_general_settings_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_post_general_settings_overview_count_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_post_general_settings_overview_count_font_family) . ' ;';
	}
	if ($vw_podcast_pro_post_general_settings_overview_count_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_post_general_settings_overview_count_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_post_general_settings_overview_count_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_post_general_settings_overview_count_font_weight) . ' ;';
	}
	$custom_css .= '}';
}



$vw_podcast_pro_post_general_settings_subheadings_color = get_theme_mod('vw_podcast_pro_post_general_settings_subheadings_color');
$vw_podcast_pro_post_general_settings_subheadings_font_size = get_theme_mod('vw_podcast_pro_post_general_settings_subheadings_font_size');
$vw_podcast_pro_post_general_settings_subheadings_font_family = get_theme_mod('vw_podcast_pro_post_general_settings_subheadings_font_family');
$vw_podcast_pro_post_general_settings_subheadings_font_weight = get_theme_mod('vw_podcast_pro_post_general_settings_subheadings_font_weight');


if ($vw_podcast_pro_post_general_settings_subheadings_color != false || $vw_podcast_pro_post_general_settings_subheadings_font_family != false || $vw_podcast_pro_post_general_settings_subheadings_font_size != false || $vw_podcast_pro_post_general_settings_subheadings_font_weight != false) {
	$custom_css .= 'div#single-post-page h3,div#single-post-page h4	,div#single-post-page .blog-que,div#single-post-page h5,.recent-posts h2,h2#reply-title{';
	if ($vw_podcast_pro_post_general_settings_subheadings_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_post_general_settings_subheadings_color) . ' ;';
	}
	if ($vw_podcast_pro_post_general_settings_subheadings_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_post_general_settings_subheadings_font_family) . ' ;';
	}
	if ($vw_podcast_pro_post_general_settings_subheadings_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_post_general_settings_subheadings_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_post_general_settings_subheadings_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_post_general_settings_subheadings_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_post_general_settings_page_text_color = get_theme_mod('vw_podcast_pro_post_general_settings_page_text_color');
$vw_podcast_pro_post_general_settings_page_text_font_size = get_theme_mod('vw_podcast_pro_post_general_settings_page_text_font_size');
$vw_podcast_pro_post_general_settings_page_text_font_family = get_theme_mod('vw_podcast_pro_post_general_settings_page_text_font_family');
$vw_podcast_pro_post_general_settings_page_text_font_weight = get_theme_mod('vw_podcast_pro_post_general_settings_page_text_font_weight');


if ($vw_podcast_pro_post_general_settings_page_text_color != false || $vw_podcast_pro_post_general_settings_page_text_font_family != false || $vw_podcast_pro_post_general_settings_page_text_font_size != false || $vw_podcast_pro_post_general_settings_page_text_font_weight != false) {
	$custom_css .= '#single-post-page p{';
	if ($vw_podcast_pro_post_general_settings_page_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_post_general_settings_page_text_color) . ' ;';
	}
	if ($vw_podcast_pro_post_general_settings_page_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_post_general_settings_page_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_post_general_settings_page_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_post_general_settings_page_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_post_general_settings_page_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_post_general_settings_page_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

// Blog Page End 

// add gradient color 


$vw_podcast_pro_advertisement_sec_image_bgcolor = get_theme_mod('vw_podcast_pro_advertisement_sec_image_bgcolor');
$vw_podcast_pro_advertisement_sec_image_bgcolor_2 = get_theme_mod('vw_podcast_pro_advertisement_sec_image_bgcolor_2');
if ($vw_podcast_pro_advertisement_sec_image_bgcolor_2 != false && $vw_podcast_pro_advertisement_sec_image_bgcolor != false) {
	$custom_css .= 'section.first.advertisements{';
	if ($vw_podcast_pro_advertisement_sec_image_bgcolor_2 != false && $vw_podcast_pro_advertisement_sec_image_bgcolor_2 != false) {
		$custom_css .= 'background: transparent linear-gradient(89deg, ' . esc_html($vw_podcast_pro_advertisement_sec_image_bgcolor) . ' 0%, ' . esc_html($vw_podcast_pro_advertisement_sec_image_bgcolor_2) . ' 40%, ' . esc_html($vw_podcast_pro_advertisement_sec_image_bgcolor) . ' 100%) 0% 0% no-repeat padding-box;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_advertisement_sec_image_bgcolor_2_three = get_theme_mod('vw_podcast_pro_advertisement_sec_image_bgcolor_2_three');
$vw_podcast_pro_advertisement_sec_image_bgcolor_three = get_theme_mod('vw_podcast_pro_advertisement_sec_image_bgcolor_three');
if ($vw_podcast_pro_advertisement_sec_image_bgcolor_2_three != false && $vw_podcast_pro_advertisement_sec_image_bgcolor_three != false) {
	$custom_css .= 'section.add-two.advertisements{';
	if ($vw_podcast_pro_advertisement_sec_image_bgcolor_2_three != false && $vw_podcast_pro_advertisement_sec_image_bgcolor_three != false) {
		$custom_css .= 'background: transparent linear-gradient(89deg, ' . esc_html($vw_podcast_pro_advertisement_sec_image_bgcolor_2_three) . ' 0%, ' . esc_html($vw_podcast_pro_advertisement_sec_image_bgcolor_three) . ' 40%, ' . esc_html($vw_podcast_pro_advertisement_sec_image_bgcolor_2_three) . ' 100%) 0% 0% no-repeat padding-box;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_advertisement_two_sec_image_bgcolor = get_theme_mod('vw_podcast_pro_advertisement_two_sec_image_bgcolor');
$vw_podcast_pro_advertisement_two_sec_image_bgcolor_2 = get_theme_mod('vw_podcast_pro_advertisement_two_sec_image_bgcolor_2');
if ($vw_podcast_pro_advertisement_two_sec_image_bgcolor_2 != false && $vw_podcast_pro_advertisement_two_sec_image_bgcolor != false) {
	$custom_css .= 'section.add-three.advertisements{';
	if ($vw_podcast_pro_advertisement_two_sec_image_bgcolor_2 != false && $vw_podcast_pro_advertisement_two_sec_image_bgcolor_2 != false) {
		$custom_css .= 'background: transparent linear-gradient(89deg, ' . esc_html($vw_podcast_pro_advertisement_two_sec_image_bgcolor) . ' 0%, ' . esc_html($vw_podcast_pro_advertisement_two_sec_image_bgcolor_2) . ' 40%, ' . esc_html($vw_podcast_pro_advertisement_two_sec_image_bgcolor) . ' 100%) 0% 0% no-repeat padding-box;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_section_add_timer_color = get_theme_mod('vw_podcast_pro_section_add_timer_color');
$vw_podcast_pro_section_add_timer_font_size = get_theme_mod('vw_podcast_pro_section_add_timer_font_size');
$vw_podcast_pro_section_add_timer_font_family = get_theme_mod('vw_podcast_pro_section_add_timer_font_family');
$vw_podcast_pro_section_add_timer_font_weight = get_theme_mod('vw_podcast_pro_section_add_timer_font_weight');

if ($vw_podcast_pro_section_add_timer_color != false || $vw_podcast_pro_section_add_timer_font_family != false || $vw_podcast_pro_section_add_timer_font_size != false || $vw_podcast_pro_section_add_timer_font_weight != false) {
	$custom_css .= 'span.ad-timer{';
	if ($vw_podcast_pro_section_add_timer_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_section_add_timer_color) . ' ;';
	}
	if ($vw_podcast_pro_section_add_timer_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_section_add_timer_font_family) . ' ;';
	}
	if ($vw_podcast_pro_section_add_timer_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_section_add_timer_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_section_add_timer_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_section_add_timer_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_h5_color = get_theme_mod('vw_podcast_pro_h5_color');
$vw_podcast_pro_h5_font_size = get_theme_mod('vw_podcast_pro_h5_font_size');
$vw_podcast_pro_h5_font_family = get_theme_mod('vw_podcast_pro_h5_font_family');
$vw_podcast_pro_h5_font_weight = get_theme_mod('vw_podcast_pro_h5_font_weight');

if ($vw_podcast_pro_h5_color != false || $vw_podcast_pro_h5_font_family != false || $vw_podcast_pro_h5_font_size != false || $vw_podcast_pro_h5_font_weight != false) {
	$custom_css .= 'h5,section h5,h5.card-title{';
	if ($vw_podcast_pro_h5_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_h5_color) . ' ;';
	}
	if ($vw_podcast_pro_h5_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_h5_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_h5_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_h5_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_h5_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_h5_font_family) . ' ;';
	}
	$custom_css .= '}';
}
// Boxed or full width layout
$vw_podcast_pro_radio_boxed_full_layout = get_theme_mod('vw_podcast_pro_radio_boxed_full_layout');
$vw_podcast_pro_radio_boxed_full_layout_value = get_theme_mod('vw_podcast_pro_radio_boxed_full_layout_value');



$vw_podcast_pro_body_font_family = get_theme_mod('vw_podcast_pro_body_font_family');
if ($vw_podcast_pro_body_font_family != false) {
	$custom_css .= 'html body,p, ul,ul li,span, h1,h2,h3,h4,h5,h6,a,input,label,div,::placeholder,.answer{';
	if ($vw_podcast_pro_body_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_body_font_family) . ' !important;';
	}
	$custom_css .= '}';
}

// Sidebar Settings 

$vw_podcast_pro_sidebar_primary_menu_color = get_theme_mod('vw_podcast_pro_sidebar_primary_menu_color');
$vw_podcast_pro_sidebar_primary_menu_font_size = get_theme_mod('vw_podcast_pro_sidebar_primary_menu_font_size');
$vw_podcast_pro_sidebar_primary_menu_font_family = get_theme_mod('vw_podcast_pro_sidebar_primary_menu_font_family');
$vw_podcast_pro_sidebar_primary_menu_font_weight = get_theme_mod('vw_podcast_pro_sidebar_primary_menu_font_weight');

if ($vw_podcast_pro_sidebar_primary_menu_color != false || $vw_podcast_pro_sidebar_primary_menu_font_family != false || $vw_podcast_pro_sidebar_primary_menu_font_size != false || $vw_podcast_pro_sidebar_primary_menu_font_weight != false) {
	$custom_css .= 'ul#menu-primary-menu li a{';
	if ($vw_podcast_pro_sidebar_primary_menu_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_sidebar_primary_menu_color) . ' ;';
	}
	if ($vw_podcast_pro_sidebar_primary_menu_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_sidebar_primary_menu_font_family) . ' ;';
	}
	if ($vw_podcast_pro_sidebar_primary_menu_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_sidebar_primary_menu_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_sidebar_primary_menu_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_sidebar_primary_menu_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_sidebar_primary_menu_color_bg = get_theme_mod('vw_podcast_pro_sidebar_primary_menu_color_bg');
if ($vw_podcast_pro_sidebar_primary_menu_color_bg != false) {
	$custom_css .= 'ul#menu-primary-menu li{';
	if ($vw_podcast_pro_sidebar_primary_menu_color_bg != false) {
		$custom_css .= 'background-color: ' . esc_html($vw_podcast_pro_sidebar_primary_menu_color_bg) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_sidebar_browse_menu_color = get_theme_mod('vw_podcast_pro_sidebar_browse_menu_color');
$vw_podcast_pro_sidebar_browse_menu_font_size = get_theme_mod('vw_podcast_pro_sidebar_browse_menu_font_size');
$vw_podcast_pro_sidebar_browse_menu_font_family = get_theme_mod('vw_podcast_pro_sidebar_browse_menu_font_family');
$vw_podcast_pro_sidebar_browse_menu_font_weight = get_theme_mod('vw_podcast_pro_sidebar_browse_menu_font_weight');

if ($vw_podcast_pro_sidebar_browse_menu_color != false || $vw_podcast_pro_sidebar_browse_menu_font_family != false || $vw_podcast_pro_sidebar_browse_menu_font_size != false || $vw_podcast_pro_sidebar_browse_menu_font_weight != false) {
	$custom_css .= ' ul#menu-browse li a{';
	if ($vw_podcast_pro_sidebar_browse_menu_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_sidebar_browse_menu_color) . ' ;';
	}
	if ($vw_podcast_pro_sidebar_browse_menu_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_sidebar_browse_menu_font_family) . ' ;';
	}
	if ($vw_podcast_pro_sidebar_browse_menu_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_sidebar_browse_menu_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_sidebar_browse_menu_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_sidebar_browse_menu_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_sidebar_library_menu_color = get_theme_mod('vw_podcast_pro_sidebar_library_menu_color');
$vw_podcast_pro_sidebar_library_menu_font_size = get_theme_mod('vw_podcast_pro_sidebar_library_menu_font_size');
$vw_podcast_pro_sidebar_library_menu_font_family = get_theme_mod('vw_podcast_pro_sidebar_library_menu_font_family');
$vw_podcast_pro_sidebar_library_menu_font_weight = get_theme_mod('vw_podcast_pro_sidebar_library_menu_font_weight');

if ($vw_podcast_pro_sidebar_library_menu_color != false || $vw_podcast_pro_sidebar_library_menu_font_family != false || $vw_podcast_pro_sidebar_library_menu_font_size != false || $vw_podcast_pro_sidebar_library_menu_font_weight != false) {
	$custom_css .= 'ul#menu-library li a{';
	if ($vw_podcast_pro_sidebar_library_menu_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_sidebar_library_menu_color) . ' ;';
	}
	if ($vw_podcast_pro_sidebar_library_menu_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_sidebar_library_menu_font_family) . ' ;';
	}
	if ($vw_podcast_pro_sidebar_library_menu_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_sidebar_library_menu_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_sidebar_library_menu_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_sidebar_library_menu_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_sidebar_seconday_menu_title_color = get_theme_mod('vw_podcast_pro_sidebar_seconday_menu_title_color');
$vw_podcast_pro_sidebar_seconday_menu_title_font_size = get_theme_mod('vw_podcast_pro_sidebar_seconday_menu_title_font_size');
$vw_podcast_pro_sidebar_seconday_menu_title_font_family = get_theme_mod('vw_podcast_pro_sidebar_seconday_menu_title_font_family');
$vw_podcast_pro_sidebar_seconday_menu_title_font_weight = get_theme_mod('vw_podcast_pro_sidebar_seconday_menu_title_font_weight');

if ($vw_podcast_pro_sidebar_seconday_menu_title_color != false || $vw_podcast_pro_sidebar_seconday_menu_title_font_family != false || $vw_podcast_pro_sidebar_seconday_menu_title_font_size != false || $vw_podcast_pro_sidebar_seconday_menu_title_font_weight != false) {
	$custom_css .= 'nav.main-sidebar h3.widget-title{';
	if ($vw_podcast_pro_sidebar_seconday_menu_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_sidebar_seconday_menu_title_color) . ' ;';
	}
	if ($vw_podcast_pro_sidebar_seconday_menu_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_sidebar_seconday_menu_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_sidebar_seconday_menu_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_sidebar_seconday_menu_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_sidebar_seconday_menu_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_sidebar_seconday_menu_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

// Audiobook Section 


$vw_podcast_pro_category_taxonomy_title_color = get_theme_mod('vw_podcast_pro_category_taxonomy_title_color');
$vw_podcast_pro_category_taxonomy_title_font_size = get_theme_mod('vw_podcast_pro_category_taxonomy_title_font_size');
$vw_podcast_pro_category_taxonomy_title_font_family = get_theme_mod('vw_podcast_pro_category_taxonomy_title_font_family');
$vw_podcast_pro_category_taxonomy_title_font_weight = get_theme_mod('vw_podcast_pro_category_taxonomy_title_font_weight');

if ($vw_podcast_pro_category_taxonomy_title_color != false || $vw_podcast_pro_category_taxonomy_title_font_family != false || $vw_podcast_pro_category_taxonomy_title_font_size != false || $vw_podcast_pro_category_taxonomy_title_font_weight != false) {
	$custom_css .= '.category-wrap a{';
	if ($vw_podcast_pro_category_taxonomy_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_category_taxonomy_title_color) . ' ;';
	}
	if ($vw_podcast_pro_category_taxonomy_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_category_taxonomy_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_category_taxonomy_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_category_taxonomy_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_category_taxonomy_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_category_taxonomy_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_category_taxonomy_title_color_bg = get_theme_mod('vw_podcast_pro_category_taxonomy_title_color_bg');
if ($vw_podcast_pro_category_taxonomy_title_color_bg != false) {
	$custom_css .= '.categories-wrapper{';
	if ($vw_podcast_pro_category_taxonomy_title_color_bg != false) {
		$custom_css .= 'background-color: ' . esc_html($vw_podcast_pro_category_taxonomy_title_color_bg) . ' ;';
	}
	$custom_css .= '}';
}

// History and Ad  sec 


$vw_podcast_pro_history_title_color = get_theme_mod('vw_podcast_pro_history_title_color');
$vw_podcast_pro_history_title_font_size = get_theme_mod('vw_podcast_pro_history_title_font_size');
$vw_podcast_pro_history_title_font_family = get_theme_mod('vw_podcast_pro_history_title_font_family');
$vw_podcast_pro_history_title_font_weight = get_theme_mod('vw_podcast_pro_history_title_font_weight');

if ($vw_podcast_pro_history_title_color != false || $vw_podcast_pro_history_title_font_family != false || $vw_podcast_pro_history_title_font_size != false || $vw_podcast_pro_history_title_font_weight != false) {
	$custom_css .= '.player-history .song-title a{';
	if ($vw_podcast_pro_history_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_history_title_color) . ' ;';
	}
	if ($vw_podcast_pro_history_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_history_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_history_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_history_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_history_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_history_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_history_title_color_bg = get_theme_mod('vw_podcast_pro_history_title_color_bg');
if ($vw_podcast_pro_history_title_color_bg != false) {
	$custom_css .= '.playlist ul{';
	if ($vw_podcast_pro_history_title_color_bg != false) {
		$custom_css .= 'background-color: ' . esc_html($vw_podcast_pro_history_title_color_bg) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_history_title_color = get_theme_mod('vw_podcast_pro_history_title_color');
$vw_podcast_pro_history_title_font_size = get_theme_mod('vw_podcast_pro_history_title_font_size');
$vw_podcast_pro_history_title_font_family = get_theme_mod('vw_podcast_pro_history_title_font_family');
$vw_podcast_pro_history_title_font_weight = get_theme_mod('vw_podcast_pro_history_title_font_weight');

if ($vw_podcast_pro_history_title_color != false || $vw_podcast_pro_history_title_font_family != false || $vw_podcast_pro_history_title_font_size != false || $vw_podcast_pro_history_title_font_weight != false) {
	$custom_css .= 'section#blog-news .h2 h2{';
	if ($vw_podcast_pro_history_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_history_title_color) . ' ;';
	}
	if ($vw_podcast_pro_history_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_history_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_history_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_history_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_history_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_history_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}




$vw_podcast_pro_history_song_des_color = get_theme_mod('vw_podcast_pro_history_song_des_color');
$vw_podcast_pro_history_song_des_font_size = get_theme_mod('vw_podcast_pro_history_song_des_font_size');
$vw_podcast_pro_history_song_des_font_family = get_theme_mod('vw_podcast_pro_history_song_des_font_family');
$vw_podcast_pro_history_song_des_font_weight = get_theme_mod('vw_podcast_pro_history_song_des_font_weight');

if ($vw_podcast_pro_history_song_des_color != false || $vw_podcast_pro_history_song_des_font_family != false || $vw_podcast_pro_history_song_des_font_size != false || $vw_podcast_pro_history_song_des_font_weight != false) {
	$custom_css .= '.player-history .song-description p{';
	if ($vw_podcast_pro_history_song_des_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_history_song_des_color) . ' ;';
	}
	if ($vw_podcast_pro_history_song_des_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_history_song_des_font_family) . ' ;';
	}
	if ($vw_podcast_pro_history_song_des_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_history_song_des_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_history_song_des_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_history_song_des_font_weight) . ' ;';
	}
	$custom_css .= '}';
}



$vw_podcast_pro_ad_title_color = get_theme_mod('vw_podcast_pro_ad_title_color');
$vw_podcast_pro_ad_title_font_size = get_theme_mod('vw_podcast_pro_ad_title_font_size');
$vw_podcast_pro_ad_title_font_family = get_theme_mod('vw_podcast_pro_ad_title_font_family');
$vw_podcast_pro_ad_title_font_weight = get_theme_mod('vw_podcast_pro_ad_title_font_weight');

if ($vw_podcast_pro_ad_title_color != false || $vw_podcast_pro_ad_title_font_family != false || $vw_podcast_pro_ad_title_font_size != false || $vw_podcast_pro_ad_title_font_weight != false) {
	$custom_css .= '.ad-event h5{';
	if ($vw_podcast_pro_ad_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_ad_title_color) . ' ;';
	}
	if ($vw_podcast_pro_ad_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_ad_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_ad_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_ad_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_ad_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_ad_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_ad_timer_taxonomy_color = get_theme_mod('vw_podcast_pro_ad_timer_taxonomy_color');
$vw_podcast_pro_ad_timer_taxonomy_font_size = get_theme_mod('vw_podcast_pro_ad_timer_taxonomy_font_size');
$vw_podcast_pro_ad_timer_taxonomy_font_family = get_theme_mod('vw_podcast_pro_ad_timer_taxonomy_font_family');
$vw_podcast_pro_ad_timer_taxonomy_font_weight = get_theme_mod('vw_podcast_pro_ad_timer_taxonomy_font_weight');

if ($vw_podcast_pro_ad_timer_taxonomy_color != false || $vw_podcast_pro_ad_timer_taxonomy_font_family != false || $vw_podcast_pro_ad_timer_taxonomy_font_size != false || $vw_podcast_pro_ad_timer_taxonomy_font_weight != false) {
	$custom_css .= 'div#countdown-timer span,.count-wrapper div{';
	if ($vw_podcast_pro_ad_timer_taxonomy_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_ad_timer_taxonomy_color) . ' ;';
	}
	if ($vw_podcast_pro_ad_timer_taxonomy_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_ad_timer_taxonomy_font_family) . ' ;';
	}
	if ($vw_podcast_pro_ad_timer_taxonomy_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_ad_timer_taxonomy_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_ad_timer_taxonomy_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_ad_timer_taxonomy_font_weight) . ' ;';
	}
	$custom_css .= '}';
}





// trending section 


$vw_podcast_pro_trending_show_all_btn_color = get_theme_mod('vw_podcast_pro_trending_show_all_btn_color');
$vw_podcast_pro_trending_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_trending_show_all_btn_font_size');
$vw_podcast_pro_trending_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_trending_show_all_btn_font_family');
$vw_podcast_pro_trending_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_trending_show_all_btn_font_weight');

if ($vw_podcast_pro_trending_show_all_btn_color != false || $vw_podcast_pro_trending_show_all_btn_font_family != false || $vw_podcast_pro_trending_show_all_btn_font_size != false || $vw_podcast_pro_trending_show_all_btn_font_weight != false) {
	$custom_css .= 'section.trending .show-all a{';
	if ($vw_podcast_pro_trending_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_trending_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_trending_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_trending_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_trending_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_trending_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_trending_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_trending_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_section_event_name_color = get_theme_mod('vw_podcast_pro_section_event_name_color');
$vw_podcast_pro_section_event_name_font_size = get_theme_mod('vw_podcast_pro_section_event_name_font_size');
$vw_podcast_pro_section_event_name_font_family = get_theme_mod('vw_podcast_pro_section_event_name_font_family');
$vw_podcast_pro_section_event_name_font_weight = get_theme_mod('vw_podcast_pro_section_event_name_font_weight');

if ($vw_podcast_pro_section_event_name_color != false || $vw_podcast_pro_section_event_name_font_family != false || $vw_podcast_pro_section_event_name_font_size != false || $vw_podcast_pro_section_event_name_font_weight != false) {
	$custom_css .= 'section.first.advertisements h4{';
	if ($vw_podcast_pro_section_event_name_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_section_event_name_color) . ' ;';
	}
	if ($vw_podcast_pro_section_event_name_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_section_event_name_font_family) . ' ;';
	}
	if ($vw_podcast_pro_section_event_name_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_section_event_name_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_section_event_name_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_section_event_name_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_section_event_desc_color = get_theme_mod('vw_podcast_pro_section_event_desc_color');
$vw_podcast_pro_section_event_desc_font_size = get_theme_mod('vw_podcast_pro_section_event_desc_font_size');
$vw_podcast_pro_section_event_desc_font_family = get_theme_mod('vw_podcast_pro_section_event_desc_font_family');
$vw_podcast_pro_section_event_desc_font_weight = get_theme_mod('vw_podcast_pro_section_event_desc_font_weight');

if ($vw_podcast_pro_section_event_desc_color != false || $vw_podcast_pro_section_event_desc_font_family != false || $vw_podcast_pro_section_event_desc_font_size != false || $vw_podcast_pro_section_event_desc_font_weight != false) {
	$custom_css .= '.add-title p{';
	if ($vw_podcast_pro_section_event_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_section_event_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_section_event_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_section_event_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_section_event_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_section_event_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_section_event_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_section_event_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_section_team_name_color = get_theme_mod('vw_podcast_pro_section_team_name_color');
$vw_podcast_pro_section_team_name_font_size = get_theme_mod('vw_podcast_pro_section_team_name_font_size');
$vw_podcast_pro_section_team_name_font_family = get_theme_mod('vw_podcast_pro_section_team_name_font_family');
$vw_podcast_pro_section_team_name_font_weight = get_theme_mod('vw_podcast_pro_section_team_name_font_weight');

if ($vw_podcast_pro_section_team_name_color != false || $vw_podcast_pro_section_team_name_font_family != false || $vw_podcast_pro_section_team_name_font_size != false || $vw_podcast_pro_section_team_name_font_weight != false) {
	$custom_css .= '.team-name{';
	if ($vw_podcast_pro_section_team_name_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_section_team_name_color) . ' ;';
	}
	if ($vw_podcast_pro_section_team_name_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_section_team_name_font_family) . ' ;';
	}
	if ($vw_podcast_pro_section_team_name_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_section_team_name_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_section_team_name_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_section_team_name_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_section_cup_title_color = get_theme_mod('vw_podcast_pro_section_cup_title_color');
$vw_podcast_pro_section_cup_title_font_size = get_theme_mod('vw_podcast_pro_section_cup_title_font_size');
$vw_podcast_pro_section_cup_title_font_family = get_theme_mod('vw_podcast_pro_section_cup_title_font_family');
$vw_podcast_pro_section_cup_title_font_weight = get_theme_mod('vw_podcast_pro_section_cup_title_font_weight');

if ($vw_podcast_pro_section_cup_title_color != false || $vw_podcast_pro_section_cup_title_font_family != false || $vw_podcast_pro_section_cup_title_font_size != false || $vw_podcast_pro_section_cup_title_font_weight != false) {
	$custom_css .= '.center-title h5{';
	if ($vw_podcast_pro_section_cup_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_section_cup_title_color) . ' ;';
	}
	if ($vw_podcast_pro_section_cup_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_section_cup_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_section_cup_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_section_cup_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_section_cup_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_section_cup_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_section_add_button_color = get_theme_mod('vw_podcast_pro_section_add_button_color');
$vw_podcast_pro_section_add_button_font_size = get_theme_mod('vw_podcast_pro_section_add_button_font_size');
$vw_podcast_pro_section_add_button_font_family = get_theme_mod('vw_podcast_pro_section_add_button_font_family');
$vw_podcast_pro_section_add_button_font_weight = get_theme_mod('vw_podcast_pro_section_add_button_font_weight');

if ($vw_podcast_pro_section_add_button_color != false || $vw_podcast_pro_section_add_button_font_family != false || $vw_podcast_pro_section_add_button_font_size != false || $vw_podcast_pro_section_add_button_font_weight != false) {
	$custom_css .= '.adds-link a{';
	if ($vw_podcast_pro_section_add_button_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_section_add_button_color) . ' ;';
	}
	if ($vw_podcast_pro_section_add_button_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_section_add_button_font_family) . ' ;';
	}
	if ($vw_podcast_pro_section_add_button_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_section_add_button_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_section_add_button_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_section_add_button_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_section_add_text_color = get_theme_mod('vw_podcast_pro_section_add_text_color');
$vw_podcast_pro_section_add_text_font_size = get_theme_mod('vw_podcast_pro_section_add_text_font_size');
$vw_podcast_pro_section_add_text_font_family = get_theme_mod('vw_podcast_pro_section_add_text_font_family');
$vw_podcast_pro_section_add_text_font_weight = get_theme_mod('vw_podcast_pro_section_add_text_font_weight');

if ($vw_podcast_pro_section_add_text_color != false || $vw_podcast_pro_section_add_text_font_family != false || $vw_podcast_pro_section_add_text_font_size != false || $vw_podcast_pro_section_add_text_font_weight != false) {
	$custom_css .= '.adds-link p{';
	if ($vw_podcast_pro_section_add_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_section_add_text_color) . ' ;';
	}
	if ($vw_podcast_pro_section_add_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_section_add_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_section_add_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_section_add_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_section_add_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_section_add_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}




$vw_podcast_pro_trending_section_heading_color = get_theme_mod('vw_podcast_pro_trending_section_heading_color');
$vw_podcast_pro_trending_section_heading_font_size = get_theme_mod('vw_podcast_pro_trending_section_heading_font_size');
$vw_podcast_pro_trending_section_heading_font_family = get_theme_mod('vw_podcast_pro_trending_section_heading_font_family');
$vw_podcast_pro_trending_section_heading_font_weight = get_theme_mod('vw_podcast_pro_trending_section_heading_font_weight');

if ($vw_podcast_pro_trending_section_heading_color != false || $vw_podcast_pro_trending_section_heading_font_family != false || $vw_podcast_pro_trending_section_heading_font_size != false || $vw_podcast_pro_trending_section_heading_font_weight != false) {
	$custom_css .= 'section.trending h1{';
	if ($vw_podcast_pro_trending_section_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_trending_section_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_trending_section_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_trending_section_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_trending_section_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_trending_section_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_trending_section_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_trending_section_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_trending_song_title_color = get_theme_mod('vw_podcast_pro_trending_song_title_color');
$vw_podcast_pro_trending_song_title_font_size = get_theme_mod('vw_podcast_pro_trending_song_title_font_size');
$vw_podcast_pro_trending_song_title_font_family = get_theme_mod('vw_podcast_pro_trending_song_title_font_family');
$vw_podcast_pro_trending_song_title_font_weight = get_theme_mod('vw_podcast_pro_trending_song_title_font_weight');

if ($vw_podcast_pro_trending_song_title_color != false || $vw_podcast_pro_trending_song_title_font_family != false || $vw_podcast_pro_trending_song_title_font_size != false || $vw_podcast_pro_trending_song_title_font_weight != false) {
	$custom_css .= 'section.trending .song-title{';
	if ($vw_podcast_pro_trending_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_trending_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_trending_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_trending_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_trending_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_trending_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_trending_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_trending_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_trending_song_desc_color = get_theme_mod('vw_podcast_pro_trending_song_desc_color');
$vw_podcast_pro_trending_song_desc_font_size = get_theme_mod('vw_podcast_pro_trending_song_desc_font_size');
$vw_podcast_pro_trending_song_desc_font_family = get_theme_mod('vw_podcast_pro_trending_song_desc_font_family');
$vw_podcast_pro_trending_song_desc_font_weight = get_theme_mod('vw_podcast_pro_trending_song_desc_font_weight');

if ($vw_podcast_pro_trending_song_desc_color != false || $vw_podcast_pro_trending_song_desc_font_family != false || $vw_podcast_pro_trending_song_desc_font_size != false || $vw_podcast_pro_trending_song_desc_font_weight != false) {
	$custom_css .= 'section.trending .song-description p{';
	if ($vw_podcast_pro_trending_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_trending_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_trending_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_trending_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_trending_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_trending_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_trending_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_trending_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}





// trending section ends 

// new releases section 



$vw_podcast_pro_new_releases_color = get_theme_mod('vw_podcast_pro_new_releases_color');
$vw_podcast_pro_new_releases_font_size = get_theme_mod('vw_podcast_pro_new_releases_font_size');
$vw_podcast_pro_new_releases_font_family = get_theme_mod('vw_podcast_pro_new_releases_font_family');
$vw_podcast_pro_new_releases_font_weight = get_theme_mod('vw_podcast_pro_new_releases_font_weight');

if ($vw_podcast_pro_new_releases_color != false || $vw_podcast_pro_new_releases_font_family != false || $vw_podcast_pro_new_releases_font_size != false || $vw_podcast_pro_new_releases_font_weight != false) {
	$custom_css .= 'section#newReleases h3{';
	if ($vw_podcast_pro_new_releases_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_new_releases_color) . ' ;';
	}
	if ($vw_podcast_pro_new_releases_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_new_releases_font_family) . ' ;';
	}
	if ($vw_podcast_pro_new_releases_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_new_releases_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_new_releases_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_new_releases_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_new_releases_song_color = get_theme_mod('vw_podcast_pro_new_releases_song_color');
$vw_podcast_pro_new_releases_song_font_size = get_theme_mod('vw_podcast_pro_new_releases_song_font_size');
$vw_podcast_pro_new_releases_song_font_family = get_theme_mod('vw_podcast_pro_new_releases_song_font_family');
$vw_podcast_pro_new_releases_song_font_weight = get_theme_mod('vw_podcast_pro_new_releases_song_font_weight');

if ($vw_podcast_pro_new_releases_song_color != false || $vw_podcast_pro_new_releases_song_font_family != false || $vw_podcast_pro_new_releases_song_font_size != false || $vw_podcast_pro_new_releases_song_font_weight != false) {
	$custom_css .= 'section#newReleases .song-title{';
	if ($vw_podcast_pro_new_releases_song_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_new_releases_song_color) . ' ;';
	}
	if ($vw_podcast_pro_new_releases_song_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_new_releases_song_font_family) . ' ;';
	}
	if ($vw_podcast_pro_new_releases_song_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_new_releases_song_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_new_releases_song_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_new_releases_song_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_new_releases_song_des_color = get_theme_mod('vw_podcast_pro_new_releases_song_des_color');
$vw_podcast_pro_new_releases_song_des_font_size = get_theme_mod('vw_podcast_pro_new_releases_song_des_font_size');
$vw_podcast_pro_new_releases_song_des_font_family = get_theme_mod('vw_podcast_pro_new_releases_song_des_font_family');
$vw_podcast_pro_new_releases_song_des_font_weight = get_theme_mod('vw_podcast_pro_new_releases_song_des_font_weight');

if ($vw_podcast_pro_new_releases_song_des_color != false || $vw_podcast_pro_new_releases_song_des_font_family != false || $vw_podcast_pro_new_releases_song_des_font_size != false || $vw_podcast_pro_new_releases_song_des_font_weight != false) {
	$custom_css .= 'section#newReleases .song-description p{';
	if ($vw_podcast_pro_new_releases_song_des_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_new_releases_song_des_color) . ' ;';
	}
	if ($vw_podcast_pro_new_releases_song_des_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_new_releases_song_des_font_family) . ' ;';
	}
	if ($vw_podcast_pro_new_releases_song_des_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_new_releases_song_des_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_new_releases_song_des_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_new_releases_song_des_font_weight) . ' ;';
	}
	$custom_css .= '}';
}



// popular in english section 


$vw_podcast_pro_popular_english_section_heading_color = get_theme_mod('vw_podcast_pro_popular_english_section_heading_color');
$vw_podcast_pro_popular_english_section_heading_font_size = get_theme_mod('vw_podcast_pro_popular_english_section_heading_font_size');
$vw_podcast_pro_popular_english_section_heading_font_family = get_theme_mod('vw_podcast_pro_popular_english_section_heading_font_family');
$vw_podcast_pro_popular_english_section_heading_font_weight = get_theme_mod('vw_podcast_pro_popular_english_section_heading_font_weight');

if ($vw_podcast_pro_popular_english_section_heading_color != false || $vw_podcast_pro_popular_english_section_heading_font_family != false || $vw_podcast_pro_popular_english_section_heading_font_size != false || $vw_podcast_pro_popular_english_section_heading_font_weight != false) {
	$custom_css .= 'section.english h3{';
	if ($vw_podcast_pro_popular_english_section_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_popular_english_section_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_popular_english_section_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_popular_english_section_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_popular_english_section_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_popular_english_section_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_popular_english_section_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_popular_english_section_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_popular_english_song_title_heading_color = get_theme_mod('vw_podcast_pro_popular_english_song_title_heading_color');
$vw_podcast_pro_popular_english_song_title_heading_font_size = get_theme_mod('vw_podcast_pro_popular_english_song_title_heading_font_size');
$vw_podcast_pro_popular_english_song_title_heading_font_family = get_theme_mod('vw_podcast_pro_popular_english_song_title_heading_font_family');
$vw_podcast_pro_popular_english_song_title_heading_font_weight = get_theme_mod('vw_podcast_pro_popular_english_song_title_heading_font_weight');

if ($vw_podcast_pro_popular_english_song_title_heading_color != false || $vw_podcast_pro_popular_english_song_title_heading_font_family != false || $vw_podcast_pro_popular_english_song_title_heading_font_size != false || $vw_podcast_pro_popular_english_song_title_heading_font_weight != false) {
	$custom_css .= 'section.english .song-title a{';
	if ($vw_podcast_pro_popular_english_song_title_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_popular_english_song_title_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_popular_english_song_title_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_popular_english_song_title_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_popular_english_song_title_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_popular_english_song_title_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_popular_english_song_title_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_popular_english_song_title_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_popular_popular_english_song_desc_color = get_theme_mod('vw_podcast_pro_popular_popular_english_song_desc_color');
$vw_podcast_pro_popular_popular_english_song_desc_font_size = get_theme_mod('vw_podcast_pro_popular_popular_english_song_desc_font_size');
$vw_podcast_pro_popular_popular_english_song_desc_font_family = get_theme_mod('vw_podcast_pro_popular_popular_english_song_desc_font_family');
$vw_podcast_pro_popular_popular_english_song_desc_font_weight = get_theme_mod('vw_podcast_pro_popular_popular_english_song_desc_font_weight');

if ($vw_podcast_pro_popular_popular_english_song_desc_color != false || $vw_podcast_pro_popular_popular_english_song_desc_font_family != false || $vw_podcast_pro_popular_popular_english_song_desc_font_size != false || $vw_podcast_pro_popular_popular_english_song_desc_font_weight != false) {
	$custom_css .= 'section.english .song-description p{';
	if ($vw_podcast_pro_popular_popular_english_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_popular_popular_english_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_popular_popular_english_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_popular_popular_english_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_popular_popular_english_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_popular_popular_english_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_popular_popular_english_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_popular_popular_english_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_advertisement_section_vs_text_btn_color = get_theme_mod('vw_podcast_pro_advertisement_section_vs_text_btn_color');
$vw_podcast_pro_advertisement_section_vs_text_btn_font_size = get_theme_mod('vw_podcast_pro_advertisement_section_vs_text_btn_font_size');
$vw_podcast_pro_advertisement_section_vs_text_btn_font_family = get_theme_mod('vw_podcast_pro_advertisement_section_vs_text_btn_font_family');
$vw_podcast_pro_advertisement_section_vs_text_btn_font_weight = get_theme_mod('vw_podcast_pro_advertisement_section_vs_text_btn_font_weight');

if ($vw_podcast_pro_advertisement_section_vs_text_btn_color != false || $vw_podcast_pro_advertisement_section_vs_text_btn_font_family != false || $vw_podcast_pro_advertisement_section_vs_text_btn_font_size != false || $vw_podcast_pro_advertisement_section_vs_text_btn_font_weight != false) {
	$custom_css .= '.add-tag{';
	if ($vw_podcast_pro_advertisement_section_vs_text_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_advertisement_section_vs_text_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_advertisement_section_vs_text_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_advertisement_section_vs_text_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_advertisement_section_vs_text_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_advertisement_section_vs_text_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_advertisement_section_vs_text_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_advertisement_section_vs_text_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_nreleases_show_all_btn_color = get_theme_mod('vw_podcast_pro_nreleases_show_all_btn_color');
$vw_podcast_pro_nreleases_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_nreleases_show_all_btn_font_size');
$vw_podcast_pro_nreleases_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_nreleases_show_all_btn_font_family');
$vw_podcast_pro_nreleases_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_nreleases_show_all_btn_font_weight');

if ($vw_podcast_pro_nreleases_show_all_btn_color != false || $vw_podcast_pro_nreleases_show_all_btn_font_family != false || $vw_podcast_pro_nreleases_show_all_btn_font_size != false || $vw_podcast_pro_nreleases_show_all_btn_font_weight != false) {
	$custom_css .= 'section#newReleases .show-all a{';
	if ($vw_podcast_pro_nreleases_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_nreleases_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_nreleases_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_nreleases_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_nreleases_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_nreleases_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_nreleases_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_nreleases_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_propopular_romance_color = get_theme_mod('vw_podcast_propopular_romance_color');
$vw_podcast_propopular_romance_font_size = get_theme_mod('vw_podcast_propopular_romance_font_size');
$vw_podcast_propopular_romance_font_family = get_theme_mod('vw_podcast_propopular_romance_font_family');
$vw_podcast_propopular_romance_font_weight = get_theme_mod('vw_podcast_propopular_romance_font_weight');

if ($vw_podcast_propopular_romance_color != false || $vw_podcast_propopular_romance_font_family != false || $vw_podcast_propopular_romance_font_size != false || $vw_podcast_propopular_romance_font_weight != false) {
	$custom_css .= 'section.romance h3{';
	if ($vw_podcast_propopular_romance_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_propopular_romance_color) . ' ;';
	}
	if ($vw_podcast_propopular_romance_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_propopular_romance_font_family) . ' ;';
	}
	if ($vw_podcast_propopular_romance_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_propopular_romance_font_size) . 'px ;';
	}
	if ($vw_podcast_propopular_romance_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_propopular_romance_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_popular_romance_song_title_color = get_theme_mod('vw_podcast_pro_popular_romance_song_title_color');
$vw_podcast_pro_popular_romance_song_title_font_size = get_theme_mod('vw_podcast_pro_popular_romance_song_title_font_size');
$vw_podcast_pro_popular_romance_song_title_font_family = get_theme_mod('vw_podcast_pro_popular_romance_song_title_font_family');
$vw_podcast_pro_popular_romance_song_title_font_weight = get_theme_mod('vw_podcast_pro_popular_romance_song_title_font_weight');

if ($vw_podcast_pro_popular_romance_song_title_color != false || $vw_podcast_pro_popular_romance_song_title_font_family != false || $vw_podcast_pro_popular_romance_song_title_font_size != false || $vw_podcast_pro_popular_romance_song_title_font_weight != false) {
	$custom_css .= 'section.romance .song-title a{';
	if ($vw_podcast_pro_popular_romance_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_popular_romance_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_popular_romance_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_popular_romance_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_popular_romance_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_popular_romance_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_popular_romance_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_popular_romance_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_popular_romance_song_desc_color = get_theme_mod('vw_podcast_pro_popular_romance_song_desc_color');
$vw_podcast_pro_popular_romance_song_desc_font_size = get_theme_mod('vw_podcast_pro_popular_romance_song_desc_font_size');
$vw_podcast_pro_popular_romance_song_desc_font_family = get_theme_mod('vw_podcast_pro_popular_romance_song_desc_font_family');
$vw_podcast_pro_popular_romance_song_desc_font_weight = get_theme_mod('vw_podcast_pro_popular_romance_song_desc_font_weight');

if ($vw_podcast_pro_popular_romance_song_desc_color != false || $vw_podcast_pro_popular_romance_song_desc_font_family != false || $vw_podcast_pro_popular_romance_song_desc_font_size != false || $vw_podcast_pro_popular_romance_song_desc_font_weight != false) {
	$custom_css .= 'section.romance .song-description p{';
	if ($vw_podcast_pro_popular_romance_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_popular_romance_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_popular_romance_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_popular_romance_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_popular_romance_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_popular_romance_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_popular_romance_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_popular_romance_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_popular_spanish_song_title_color = get_theme_mod('vw_podcast_pro_popular_spanish_song_title_color');
$vw_podcast_pro_popular_spanish_song_title_font_size = get_theme_mod('vw_podcast_pro_popular_spanish_song_title_font_size');
$vw_podcast_pro_popular_spanish_song_title_font_family = get_theme_mod('vw_podcast_pro_popular_spanish_song_title_font_family');
$vw_podcast_pro_popular_spanish_song_title_font_weight = get_theme_mod('vw_podcast_pro_popular_spanish_song_title_font_weight');

if ($vw_podcast_pro_popular_spanish_song_title_color != false || $vw_podcast_pro_popular_spanish_song_title_font_family != false || $vw_podcast_pro_popular_spanish_song_title_font_size != false || $vw_podcast_pro_popular_spanish_song_title_font_weight != false) {
	$custom_css .= 'section.spanish .song-title a{';
	if ($vw_podcast_pro_popular_spanish_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_popular_spanish_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_popular_spanish_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_popular_spanish_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_popular_spanish_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_popular_spanish_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_popular_spanish_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_popular_spanish_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_popular_spanish_section_heading_color = get_theme_mod('vw_podcast_pro_popular_spanish_section_heading_color');
$vw_podcast_pro_popular_spanish_section_heading_font_size = get_theme_mod('vw_podcast_pro_popular_spanish_section_heading_font_size');
$vw_podcast_pro_popular_spanish_section_heading_font_family = get_theme_mod('vw_podcast_pro_popular_spanish_section_heading_font_family');
$vw_podcast_pro_popular_spanish_section_heading_font_weight = get_theme_mod('vw_podcast_pro_popular_spanish_section_heading_font_weight');

if ($vw_podcast_pro_popular_spanish_section_heading_color != false || $vw_podcast_pro_popular_spanish_section_heading_font_family != false || $vw_podcast_pro_popular_spanish_section_heading_font_size != false || $vw_podcast_pro_popular_spanish_section_heading_font_weight != false) {
	$custom_css .= 'section.spanish .section-heading h3{';
	if ($vw_podcast_pro_popular_spanish_section_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_popular_spanish_section_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_popular_spanish_section_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_popular_spanish_section_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_popular_spanish_section_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_popular_spanish_section_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_popular_spanish_section_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_popular_spanish_section_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_popular_spanish_song_desc_color = get_theme_mod('vw_podcast_pro_popular_spanish_song_desc_color');
$vw_podcast_pro_popular_spanish_song_desc_font_size = get_theme_mod('vw_podcast_pro_popular_spanish_song_desc_font_size');
$vw_podcast_pro_popular_spanish_song_desc_font_family = get_theme_mod('vw_podcast_pro_popular_spanish_song_desc_font_family');
$vw_podcast_pro_popular_spanish_song_desc_font_weight = get_theme_mod('vw_podcast_pro_popular_spanish_song_desc_font_weight');

if ($vw_podcast_pro_popular_spanish_song_desc_color != false || $vw_podcast_pro_popular_spanish_song_desc_font_family != false || $vw_podcast_pro_popular_spanish_song_desc_font_size != false || $vw_podcast_pro_popular_spanish_song_desc_font_weight != false) {
	$custom_css .= 'section.spanish .song-description p{';
	if ($vw_podcast_pro_popular_spanish_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_popular_spanish_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_popular_spanish_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_popular_spanish_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_popular_spanish_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_popular_spanish_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_popular_spanish_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_popular_spanish_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}



// top searched artists 


$vw_podcast_pro_top_artists_section_heading_color = get_theme_mod('vw_podcast_pro_top_artists_section_heading_color');
$vw_podcast_pro_top_artists_section_heading_font_size = get_theme_mod('vw_podcast_pro_top_artists_section_heading_font_size');
$vw_podcast_pro_top_artists_section_heading_font_family = get_theme_mod('vw_podcast_pro_top_artists_section_heading_font_family');
$vw_podcast_pro_top_artists_section_heading_font_weight = get_theme_mod('vw_podcast_pro_top_artists_section_heading_font_weight');

if ($vw_podcast_pro_top_artists_section_heading_color != false || $vw_podcast_pro_top_artists_section_heading_font_family != false || $vw_podcast_pro_top_artists_section_heading_font_size != false || $vw_podcast_pro_top_artists_section_heading_font_weight != false) {
	$custom_css .= '.artist-cat-home h3{';
	if ($vw_podcast_pro_top_artists_section_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_top_artists_section_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_top_artists_section_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_top_artists_section_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_top_artists_section_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_top_artists_section_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_top_artists_section_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_top_artists_section_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_top_artists_song_title_color = get_theme_mod('vw_podcast_pro_top_artists_song_title_color');
$vw_podcast_pro_top_artists_song_title_font_size = get_theme_mod('vw_podcast_pro_top_artists_song_title_font_size');
$vw_podcast_pro_top_artists_song_title_font_family = get_theme_mod('vw_podcast_pro_top_artists_song_title_font_family');
$vw_podcast_pro_top_artists_song_title_font_weight = get_theme_mod('vw_podcast_pro_top_artists_song_title_font_weight');

if ($vw_podcast_pro_top_artists_song_title_color != false || $vw_podcast_pro_top_artists_song_title_font_family != false || $vw_podcast_pro_top_artists_song_title_font_size != false || $vw_podcast_pro_top_artists_song_title_font_weight != false) {
	$custom_css .= '.artist-cat-home .song-title a{';
	if ($vw_podcast_pro_top_artists_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_top_artists_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_top_artists_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_top_artists_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_top_artists_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_top_artists_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_top_artists_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_top_artists_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_top_artists_song_desc_color = get_theme_mod('vw_podcast_pro_top_artists_song_desc_color');
$vw_podcast_pro_top_artists_song_desc_font_size = get_theme_mod('vw_podcast_pro_top_artists_song_desc_font_size');
$vw_podcast_pro_top_artists_song_desc_font_family = get_theme_mod('vw_podcast_pro_top_artists_song_desc_font_family');
$vw_podcast_pro_top_artists_song_desc_font_weight = get_theme_mod('vw_podcast_pro_top_artists_song_desc_font_weight');

if ($vw_podcast_pro_top_artists_song_desc_color != false || $vw_podcast_pro_top_artists_song_desc_font_family != false || $vw_podcast_pro_top_artists_song_desc_font_size != false || $vw_podcast_pro_top_artists_song_desc_font_weight != false) {
	$custom_css .= '.artist-cat-home .song-description p{';
	if ($vw_podcast_pro_top_artists_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_top_artists_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_top_artists_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_top_artists_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_top_artists_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_top_artists_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_top_artists_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_top_artists_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

// advertisement Section 
// top chart section 

$vw_podcast_pro_top_chart_song_desc_color = get_theme_mod('vw_podcast_pro_top_chart_song_desc_color');
$vw_podcast_pro_top_chart_song_desc_font_size = get_theme_mod('vw_podcast_pro_top_chart_song_desc_font_size');
$vw_podcast_pro_top_chart_song_desc_font_family = get_theme_mod('vw_podcast_pro_top_chart_song_desc_font_family');
$vw_podcast_pro_top_chart_song_desc_font_weight = get_theme_mod('vw_podcast_pro_top_chart_song_desc_font_weight');

if ($vw_podcast_pro_top_chart_song_desc_color != false || $vw_podcast_pro_top_chart_song_desc_font_family != false || $vw_podcast_pro_top_chart_song_desc_font_size != false || $vw_podcast_pro_top_chart_song_desc_font_weight != false) {
	$custom_css .= 'section.top-chart .song-description p{';
	if ($vw_podcast_pro_top_chart_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_top_chart_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_top_chart_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_top_chart_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_top_chart_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_top_chart_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}



$vw_podcast_pro_recomended_section_title_color = get_theme_mod('vw_podcast_pro_recomended_section_title_color');
$vw_podcast_pro_recomended_section_title_font_size = get_theme_mod('vw_podcast_pro_recomended_section_title_font_size');
$vw_podcast_pro_recomended_section_title_font_family = get_theme_mod('vw_podcast_pro_recomended_section_title_font_family');
$vw_podcast_pro_recomended_section_title_font_weight = get_theme_mod('vw_podcast_pro_recomended_section_title_font_weight');

if ($vw_podcast_pro_recomended_section_title_color != false || $vw_podcast_pro_recomended_section_title_font_family != false || $vw_podcast_pro_recomended_section_title_font_size != false || $vw_podcast_pro_recomended_section_title_font_weight != false) {
	$custom_css .= 'section.recomended h3{';
	if ($vw_podcast_pro_recomended_section_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_recomended_section_title_color) . ' ;';
	}
	if ($vw_podcast_pro_recomended_section_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_recomended_section_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_recomended_section_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_recomended_section_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_recomended_section_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_recomended_section_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_recomended_song_desc_color = get_theme_mod('vw_podcast_pro_recomended_song_desc_color');
$vw_podcast_pro_recomended_song_desc_font_size = get_theme_mod('vw_podcast_pro_recomended_song_desc_font_size');
$vw_podcast_pro_recomended_song_desc_font_family = get_theme_mod('vw_podcast_pro_recomended_song_desc_font_family');
$vw_podcast_pro_recomended_song_desc_font_weight = get_theme_mod('vw_podcast_pro_recomended_song_desc_font_weight');

if ($vw_podcast_pro_recomended_song_desc_color != false || $vw_podcast_pro_recomended_song_desc_font_family != false || $vw_podcast_pro_recomended_song_desc_font_size != false || $vw_podcast_pro_recomended_song_desc_font_weight != false) {
	$custom_css .= 'section.recomended .song-description p{';
	if ($vw_podcast_pro_recomended_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_recomended_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_recomended_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_recomended_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_recomended_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_recomended_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_recomended_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_recomended_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_recomended_song_title_color = get_theme_mod('vw_podcast_pro_recomended_song_title_color');
$vw_podcast_pro_recomended_song_title_font_size = get_theme_mod('vw_podcast_pro_recomended_song_title_font_size');
$vw_podcast_pro_recomended_song_title_font_family = get_theme_mod('vw_podcast_pro_recomended_song_title_font_family');
$vw_podcast_pro_recomended_song_title_font_weight = get_theme_mod('vw_podcast_pro_recomended_song_title_font_weight');

if ($vw_podcast_pro_recomended_song_title_color != false || $vw_podcast_pro_recomended_song_title_font_family != false || $vw_podcast_pro_recomended_song_title_font_size != false || $vw_podcast_pro_recomended_song_title_font_weight != false) {
	$custom_css .= 'section.recomended .song-title{';
	if ($vw_podcast_pro_recomended_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_recomended_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_recomended_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_recomended_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_recomended_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_recomended_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_recomended_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_recomended_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_top_chart_color = get_theme_mod('vw_podcast_pro_top_chart_color');
$vw_podcast_pro_top_chart_font_size = get_theme_mod('vw_podcast_pro_top_chart_font_size');
$vw_podcast_pro_top_chart_font_family = get_theme_mod('vw_podcast_pro_top_chart_font_family');
$vw_podcast_pro_top_chart_font_weight = get_theme_mod('vw_podcast_pro_top_chart_font_weight');

if ($vw_podcast_pro_top_chart_color != false || $vw_podcast_pro_top_chart_font_family != false || $vw_podcast_pro_top_chart_font_size != false || $vw_podcast_pro_top_chart_font_weight != false) {
	$custom_css .= 'section.top-chart h3{';
	if ($vw_podcast_pro_top_chart_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_top_chart_color) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_top_chart_font_family) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_top_chart_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_top_chart_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_top_chart_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_top_chart_song_title_color = get_theme_mod('vw_podcast_pro_top_chart_song_title_color');
$vw_podcast_pro_top_chart_song_title_font_size = get_theme_mod('vw_podcast_pro_top_chart_song_title_font_size');
$vw_podcast_pro_top_chart_song_title_font_family = get_theme_mod('vw_podcast_pro_top_chart_song_title_font_family');
$vw_podcast_pro_top_chart_song_title_font_weight = get_theme_mod('vw_podcast_pro_top_chart_song_title_font_weight');

if ($vw_podcast_pro_top_chart_song_title_color != false || $vw_podcast_pro_top_chart_song_title_font_family != false || $vw_podcast_pro_top_chart_song_title_font_size != false || $vw_podcast_pro_top_chart_song_title_font_weight != false) {
	$custom_css .= 'section.top-chart .song-title a{';
	if ($vw_podcast_pro_top_chart_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_top_chart_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_top_chart_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_top_chart_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_top_chart_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_top_chart_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_top_chart_song_desc_color = get_theme_mod('vw_podcast_pro_top_chart_song_desc_color');
$vw_podcast_pro_top_chart_song_desc_font_size = get_theme_mod('vw_podcast_pro_top_chart_song_desc_font_size');
$vw_podcast_pro_top_chart_song_desc_font_family = get_theme_mod('vw_podcast_pro_top_chart_song_desc_font_family');
$vw_podcast_pro_top_chart_song_desc_font_weight = get_theme_mod('vw_podcast_pro_top_chart_song_desc_font_weight');

if ($vw_podcast_pro_top_chart_song_desc_color != false || $vw_podcast_pro_top_chart_song_desc_font_family != false || $vw_podcast_pro_top_chart_song_desc_font_size != false || $vw_podcast_pro_top_chart_song_desc_font_weight != false) {
	$custom_css .= 'section.top-chart .song-description p{';
	if ($vw_podcast_pro_top_chart_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_top_chart_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_top_chart_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_top_chart_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_top_chart_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_top_chart_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_ad_three_heading_color = get_theme_mod('vw_podcast_pro_ad_three_heading_color');
$vw_podcast_pro_ad_three_heading_font_size = get_theme_mod('vw_podcast_pro_ad_three_heading_font_size');
$vw_podcast_pro_ad_three_heading_font_family = get_theme_mod('vw_podcast_pro_ad_three_heading_font_family');
$vw_podcast_pro_ad_three_heading_font_weight = get_theme_mod('vw_podcast_pro_ad_three_heading_font_weight');

if ($vw_podcast_pro_ad_three_heading_color != false || $vw_podcast_pro_ad_three_heading_font_family != false || $vw_podcast_pro_ad_three_heading_font_size != false || $vw_podcast_pro_ad_three_heading_font_weight != false) {
	$custom_css .= 'section.add-two h4{';
	if ($vw_podcast_pro_ad_three_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_ad_three_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_ad_three_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_ad_three_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_ad_three_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_ad_three_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_ad_three_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_ad_three_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_ad_three_register_title_color = get_theme_mod('vw_podcast_pro_ad_three_register_title_color');
$vw_podcast_pro_ad_three_register_title_font_size = get_theme_mod('vw_podcast_pro_ad_three_register_title_font_size');
$vw_podcast_pro_ad_three_register_title_font_family = get_theme_mod('vw_podcast_pro_ad_three_register_title_font_family');
$vw_podcast_pro_ad_three_register_title_font_weight = get_theme_mod('vw_podcast_pro_ad_three_register_title_font_weight');

if ($vw_podcast_pro_ad_three_register_title_color != false || $vw_podcast_pro_ad_three_register_title_font_family != false || $vw_podcast_pro_ad_three_register_title_font_size != false || $vw_podcast_pro_ad_three_register_title_font_weight != false) {
	$custom_css .= '.add-column h5{';
	if ($vw_podcast_pro_ad_three_register_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_ad_three_register_title_color) . ' ;';
	}
	if ($vw_podcast_pro_ad_three_register_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_ad_three_register_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_ad_three_register_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_ad_three_register_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_ad_three_register_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_ad_three_register_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_ad_threebutton_title_color = get_theme_mod('vw_podcast_pro_ad_threebutton_title_color');
$vw_podcast_pro_ad_threebutton_title_font_size = get_theme_mod('vw_podcast_pro_ad_threebutton_title_font_size');
$vw_podcast_pro_ad_threebutton_title_font_family = get_theme_mod('vw_podcast_pro_ad_threebutton_title_font_family');
$vw_podcast_pro_ad_threebutton_title_font_weight = get_theme_mod('vw_podcast_pro_ad_threebutton_title_font_weight');

if ($vw_podcast_pro_ad_threebutton_title_color != false || $vw_podcast_pro_ad_threebutton_title_font_family != false || $vw_podcast_pro_ad_threebutton_title_font_size != false || $vw_podcast_pro_ad_threebutton_title_font_weight != false) {
	$custom_css .= '.add-column a.red-btn{';
	if ($vw_podcast_pro_ad_threebutton_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_ad_threebutton_title_color) . ' ;';
	}
	if ($vw_podcast_pro_ad_threebutton_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_ad_threebutton_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_ad_threebutton_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_ad_threebutton_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_ad_threebutton_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_ad_threebutton_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_ad_three_middle_txt_color = get_theme_mod('vw_podcast_pro_ad_three_middle_txt_color');
$vw_podcast_pro_ad_three_middle_txt_font_size = get_theme_mod('vw_podcast_pro_ad_three_middle_txt_font_size');
$vw_podcast_pro_ad_three_middle_txt_font_family = get_theme_mod('vw_podcast_pro_ad_three_middle_txt_font_family');
$vw_podcast_pro_ad_three_middle_txt_font_weight = get_theme_mod('vw_podcast_pro_ad_three_middle_txt_font_weight');

if ($vw_podcast_pro_ad_three_middle_txt_color != false || $vw_podcast_pro_ad_three_middle_txt_font_family != false || $vw_podcast_pro_ad_three_middle_txt_font_size != false || $vw_podcast_pro_ad_three_middle_txt_font_weight != false) {
	$custom_css .= '.add-column p{';
	if ($vw_podcast_pro_ad_three_middle_txt_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_ad_three_middle_txt_color) . ' ;';
	}
	if ($vw_podcast_pro_ad_three_middle_txt_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_ad_three_middle_txt_font_family) . ' ;';
	}
	if ($vw_podcast_pro_ad_three_middle_txt_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_ad_three_middle_txt_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_ad_three_middle_txt_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_ad_three_middle_txt_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_section_event_name_color = get_theme_mod('vw_podcast_pro_section_event_name_color');
$vw_podcast_pro_section_event_name_font_size = get_theme_mod('vw_podcast_pro_section_event_name_font_size');
$vw_podcast_pro_section_event_name_font_family = get_theme_mod('vw_podcast_pro_section_event_name_font_family');
$vw_podcast_pro_section_event_name_font_weight = get_theme_mod('vw_podcast_pro_section_event_name_font_weight');

if ($vw_podcast_pro_section_event_name_color != false || $vw_podcast_pro_section_event_name_font_family != false || $vw_podcast_pro_section_event_name_font_size != false || $vw_podcast_pro_section_event_name_font_weight != false) {
	$custom_css .= 'section#blog-news .h2 h2{';
	if ($vw_podcast_pro_section_event_name_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_section_event_name_color) . ' ;';
	}
	if ($vw_podcast_pro_section_event_name_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_section_event_name_font_family) . ' ;';
	}
	if ($vw_podcast_pro_section_event_name_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_section_event_name_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_section_event_name_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_section_event_name_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_radio_radio_sec_song_title_color = get_theme_mod('vw_podcast_pro_radio_radio_sec_song_title_color');
$vw_podcast_pro_radio_radio_sec_song_title_font_size = get_theme_mod('vw_podcast_pro_radio_radio_sec_song_title_font_size');
$vw_podcast_pro_radio_radio_sec_song_title_font_family = get_theme_mod('vw_podcast_pro_radio_radio_sec_song_title_font_family');
$vw_podcast_pro_radio_radio_sec_song_title_font_weight = get_theme_mod('vw_podcast_pro_radio_radio_sec_song_title_font_weight');

if ($vw_podcast_pro_radio_radio_sec_song_title_color != false || $vw_podcast_pro_radio_radio_sec_song_title_font_family != false || $vw_podcast_pro_radio_radio_sec_song_title_font_size != false || $vw_podcast_pro_radio_radio_sec_song_title_font_weight != false) {
	$custom_css .= 'section.category-radio.category-artist .song-title a{';
	if ($vw_podcast_pro_radio_radio_sec_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_radio_radio_sec_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_radio_radio_sec_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_radio_radio_sec_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_radio_radio_sec_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_radio_radio_sec_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_radio_radio_sec_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_radio_radio_sec_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_radio_show_all_btn_color = get_theme_mod('vw_podcast_pro_radio_show_all_btn_color');
$vw_podcast_pro_radio_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_radio_show_all_btn_font_size');
$vw_podcast_pro_radio_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_radio_show_all_btn_font_family');
$vw_podcast_pro_radio_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_radio_show_all_btn_font_weight');

if ($vw_podcast_pro_radio_show_all_btn_color != false || $vw_podcast_pro_radio_show_all_btn_font_family != false || $vw_podcast_pro_radio_show_all_btn_font_size != false || $vw_podcast_pro_radio_show_all_btn_font_weight != false) {
	$custom_css .= 'section.category-radio.category-artist .show-all a{';
	if ($vw_podcast_pro_radio_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_radio_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_radio_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_radio_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_radio_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_radio_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_radio_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_radio_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_recomm_show_all_btn_color = get_theme_mod('vw_podcast_pro_recomm_show_all_btn_color');
$vw_podcast_pro_recomm_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_recomm_show_all_btn_font_size');
$vw_podcast_pro_recomm_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_recomm_show_all_btn_font_family');
$vw_podcast_pro_recomm_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_recomm_show_all_btn_font_weight');

if ($vw_podcast_pro_recomm_show_all_btn_color != false || $vw_podcast_pro_recomm_show_all_btn_font_family != false || $vw_podcast_pro_recomm_show_all_btn_font_size != false || $vw_podcast_pro_recomm_show_all_btn_font_weight != false) {
	$custom_css .= 'section.recomended .show-all a{';
	if ($vw_podcast_pro_recomm_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_recomm_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_recomm_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_recomm_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_recomm_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_recomm_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_recomm_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_recomm_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_english_show_all_btn_color = get_theme_mod('vw_podcast_pro_english_show_all_btn_color');
$vw_podcast_pro_english_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_english_show_all_btn_font_size');
$vw_podcast_pro_english_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_english_show_all_btn_font_family');
$vw_podcast_pro_english_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_english_show_all_btn_font_weight');

if ($vw_podcast_pro_english_show_all_btn_color != false || $vw_podcast_pro_english_show_all_btn_font_family != false || $vw_podcast_pro_english_show_all_btn_font_size != false || $vw_podcast_pro_english_show_all_btn_font_weight != false) {
	$custom_css .= 'section.english .show-all a{';
	if ($vw_podcast_pro_english_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_english_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_english_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_english_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_english_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_english_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_english_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_english_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_romance_song_title_color = get_theme_mod('vw_podcast_pro_romance_song_title_color');
$vw_podcast_pro_romance_song_title_font_size = get_theme_mod('vw_podcast_pro_romance_song_title_font_size');
$vw_podcast_pro_romance_song_title_font_family = get_theme_mod('vw_podcast_pro_romance_song_title_font_family');
$vw_podcast_pro_romance_song_title_font_weight = get_theme_mod('vw_podcast_pro_romance_song_title_font_weight');

if ($vw_podcast_pro_romance_song_title_color != false || $vw_podcast_pro_romance_song_title_font_family != false || $vw_podcast_pro_romance_song_title_font_size != false || $vw_podcast_pro_romance_song_title_font_weight != false) {
	$custom_css .= 'section.romance .song-title a{';
	if ($vw_podcast_pro_romance_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_romance_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_romance_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_romance_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_romance_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_romance_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_romance_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_romance_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_spanish_show_all_btn_color = get_theme_mod('vw_podcast_pro_spanish_show_all_btn_color');
$vw_podcast_pro_spanish_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_spanish_show_all_btn_font_size');
$vw_podcast_pro_spanish_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_spanish_show_all_btn_font_family');
$vw_podcast_pro_spanish_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_spanish_show_all_btn_font_weight');

if ($vw_podcast_pro_spanish_show_all_btn_color != false || $vw_podcast_pro_spanish_show_all_btn_font_family != false || $vw_podcast_pro_spanish_show_all_btn_font_size != false || $vw_podcast_pro_spanish_show_all_btn_font_weight != false) {
	$custom_css .= 'section.spanish .show-all a{';
	if ($vw_podcast_pro_spanish_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_spanish_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_spanish_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_spanish_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_spanish_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_spanish_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_spanish_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_spanish_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_romance_show_all_btn_color = get_theme_mod('vw_podcast_pro_romance_show_all_btn_color');
$vw_podcast_pro_romance_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_romance_show_all_btn_font_size');
$vw_podcast_pro_romance_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_romance_show_all_btn_font_family');
$vw_podcast_pro_romance_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_romance_show_all_btn_font_weight');

if ($vw_podcast_pro_romance_show_all_btn_color != false || $vw_podcast_pro_romance_show_all_btn_font_family != false || $vw_podcast_pro_romance_show_all_btn_font_size != false || $vw_podcast_pro_romance_show_all_btn_font_weight != false) {
	$custom_css .= 'section.romance .show-all a{';
	if ($vw_podcast_pro_romance_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_romance_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_romance_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_romance_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_romance_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_romance_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_romance_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_romance_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_top_chart_section_show_all_btn_color = get_theme_mod('vw_podcast_pro_top_chart_section_show_all_btn_color');
$vw_podcast_pro_top_chart_section_show_all_btn_font_size = get_theme_mod('vw_podcast_pro_top_chart_section_show_all_btn_font_size');
$vw_podcast_pro_top_chart_section_show_all_btn_font_family = get_theme_mod('vw_podcast_pro_top_chart_section_show_all_btn_font_family');
$vw_podcast_pro_top_chart_section_show_all_btn_font_weight = get_theme_mod('vw_podcast_pro_top_chart_section_show_all_btn_font_weight');

if ($vw_podcast_pro_top_chart_section_show_all_btn_color != false || $vw_podcast_pro_top_chart_section_show_all_btn_font_family != false || $vw_podcast_pro_top_chart_section_show_all_btn_font_size != false || $vw_podcast_pro_top_chart_section_show_all_btn_font_weight != false) {
	$custom_css .= 'section.top-chart .show-all a{';
	if ($vw_podcast_pro_top_chart_section_show_all_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_top_chart_section_show_all_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_section_show_all_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_top_chart_section_show_all_btn_font_family) . ' ;';
	}
	if ($vw_podcast_pro_top_chart_section_show_all_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_top_chart_section_show_all_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_top_chart_section_show_all_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_top_chart_section_show_all_btn_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_add_two_sec_ad_small_title_color = get_theme_mod('vw_podcast_pro_add_two_sec_ad_small_title_color');
$vw_podcast_pro_add_two_sec_ad_small_title_font_size = get_theme_mod('vw_podcast_pro_add_two_sec_ad_small_title_font_size');
$vw_podcast_pro_add_two_sec_ad_small_title_font_family = get_theme_mod('vw_podcast_pro_add_two_sec_ad_small_title_font_family');
$vw_podcast_pro_add_two_sec_ad_small_title_font_weight = get_theme_mod('vw_podcast_pro_add_two_sec_ad_small_title_font_weight');

if ($vw_podcast_pro_add_two_sec_ad_small_title_color != false || $vw_podcast_pro_add_two_sec_ad_small_title_font_family != false || $vw_podcast_pro_add_two_sec_ad_small_title_font_size != false || $vw_podcast_pro_add_two_sec_ad_small_title_font_weight != false) {
	$custom_css .= 'section.add-three.advertisements .small-title{';
	if ($vw_podcast_pro_add_two_sec_ad_small_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_add_two_sec_ad_small_title_color) . ' ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_small_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_add_two_sec_ad_small_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_small_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_add_two_sec_ad_small_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_small_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_add_two_sec_ad_small_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_add_two_sec_ad_main_title_color = get_theme_mod('vw_podcast_pro_add_two_sec_ad_main_title_color');
$vw_podcast_pro_add_two_sec_ad_main_title_font_size = get_theme_mod('vw_podcast_pro_add_two_sec_ad_main_title_font_size');
$vw_podcast_pro_add_two_sec_ad_main_title_font_family = get_theme_mod('vw_podcast_pro_add_two_sec_ad_main_title_font_family');
$vw_podcast_pro_add_two_sec_ad_main_title_font_weight = get_theme_mod('vw_podcast_pro_add_two_sec_ad_main_title_font_weight');

if ($vw_podcast_pro_add_two_sec_ad_main_title_color != false || $vw_podcast_pro_add_two_sec_ad_main_title_font_family != false || $vw_podcast_pro_add_two_sec_ad_main_title_font_size != false || $vw_podcast_pro_add_two_sec_ad_main_title_font_weight != false) {
	$custom_css .= 'section.add-three.advertisements.section-space h4{';
	if ($vw_podcast_pro_add_two_sec_ad_main_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_add_two_sec_ad_main_title_color) . ' ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_main_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_add_two_sec_ad_main_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_main_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_add_two_sec_ad_main_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_main_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_add_two_sec_ad_main_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_add_two_sec_ad_feature_text_color = get_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_color');
$vw_podcast_pro_add_two_sec_ad_feature_text_font_size = get_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_font_size');
$vw_podcast_pro_add_two_sec_ad_feature_text_font_family = get_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_font_family');
$vw_podcast_pro_add_two_sec_ad_feature_text_font_weight = get_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_font_weight');

if ($vw_podcast_pro_add_two_sec_ad_feature_text_color != false || $vw_podcast_pro_add_two_sec_ad_feature_text_font_family != false || $vw_podcast_pro_add_two_sec_ad_feature_text_font_size != false || $vw_podcast_pro_add_two_sec_ad_feature_text_font_weight != false) {
	$custom_css .= 'section.add-three span.feature{';
	if ($vw_podcast_pro_add_two_sec_ad_feature_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_add_two_sec_ad_feature_text_color) . ' ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_feature_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_add_two_sec_ad_feature_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_feature_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_add_two_sec_ad_feature_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_add_two_sec_ad_feature_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_add_two_sec_ad_feature_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}




$vw_podcast_pro_faq_sec_question_color = get_theme_mod('vw_podcast_pro_faq_sec_question_color');
$vw_podcast_pro_faq_sec_question_font_size = get_theme_mod('vw_podcast_pro_faq_sec_question_font_size');
$vw_podcast_pro_faq_sec_question_font_family = get_theme_mod('vw_podcast_pro_faq_sec_question_font_family');
$vw_podcast_pro_faq_sec_question_font_weight = get_theme_mod('vw_podcast_pro_faq_sec_question_font_weight');

if ($vw_podcast_pro_faq_sec_question_color != false || $vw_podcast_pro_faq_sec_question_font_family != false || $vw_podcast_pro_faq_sec_question_font_size != false || $vw_podcast_pro_faq_sec_question_font_weight != false) {
	$custom_css .= 'h6.accordion-click{';
	if ($vw_podcast_pro_faq_sec_question_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_faq_sec_question_color) . ' ;';
	}
	if ($vw_podcast_pro_faq_sec_question_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_faq_sec_question_font_family) . ' ;';
	}
	if ($vw_podcast_pro_faq_sec_question_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_faq_sec_question_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_faq_sec_question_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_faq_sec_question_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_faq_sec_answer_color = get_theme_mod('vw_podcast_pro_faq_sec_answer_color');
$vw_podcast_pro_faq_sec_answer_font_size = get_theme_mod('vw_podcast_pro_faq_sec_answer_font_size');
$vw_podcast_pro_faq_sec_answer_font_family = get_theme_mod('vw_podcast_pro_faq_sec_answer_font_family');
$vw_podcast_pro_faq_sec_answer_font_weight = get_theme_mod('vw_podcast_pro_faq_sec_answer_font_weight');

if ($vw_podcast_pro_faq_sec_answer_color != false || $vw_podcast_pro_faq_sec_answer_font_family != false || $vw_podcast_pro_faq_sec_answer_font_size != false || $vw_podcast_pro_faq_sec_answer_font_weight != false) {
	$custom_css .= 'section#faq .answer{';
	if ($vw_podcast_pro_faq_sec_answer_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_faq_sec_answer_color) . ' ;';
	}
	if ($vw_podcast_pro_faq_sec_answer_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_faq_sec_answer_font_family) . ' ;';
	}
	if ($vw_podcast_pro_faq_sec_answer_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_faq_sec_answer_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_faq_sec_answer_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_faq_sec_answer_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
// add two section 



// blog section 

$vw_podcast_pro_blog_heading_color = get_theme_mod('vw_podcast_pro_blog_heading_color');
$vw_podcast_pro_blog_heading_font_size = get_theme_mod('vw_podcast_pro_blog_heading_font_size');
$vw_podcast_pro_blog_heading_font_family = get_theme_mod('vw_podcast_pro_blog_heading_font_family');
$vw_podcast_pro_blog_heading_font_weight = get_theme_mod('vw_podcast_pro_blog_heading_font_weight');

if ($vw_podcast_pro_blog_heading_color != false || $vw_podcast_pro_blog_heading_font_family != false || $vw_podcast_pro_blog_heading_font_size != false || $vw_podcast_pro_blog_heading_font_weight != false) {
	$custom_css .= 'section#blog-news .h2 h2{';
	if ($vw_podcast_pro_blog_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_blog_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_blog_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_blog_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_blog_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_blog_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_blog_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_blog_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}





$vw_podcast_pro_blog_heading_text_color = get_theme_mod('vw_podcast_pro_blog_heading_text_color');
$vw_podcast_pro_blog_heading_text_font_size = get_theme_mod('vw_podcast_pro_blog_heading_text_font_size');
$vw_podcast_pro_blog_heading_text_font_family = get_theme_mod('vw_podcast_pro_blog_heading_text_font_family');
$vw_podcast_pro_blog_heading_text_font_weight = get_theme_mod('vw_podcast_pro_blog_heading_text_font_weight');

if ($vw_podcast_pro_blog_heading_text_color != false || $vw_podcast_pro_blog_heading_text_font_family != false || $vw_podcast_pro_blog_heading_text_font_size != false || $vw_podcast_pro_blog_heading_text_font_weight != false) {
	$custom_css .= 'section#blog-news p.heading-description{';
	if ($vw_podcast_pro_blog_heading_text_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_blog_heading_text_color) . ' ;';
	}
	if ($vw_podcast_pro_blog_heading_text_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_blog_heading_text_font_family) . ' ;';
	}
	if ($vw_podcast_pro_blog_heading_text_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_blog_heading_text_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_blog_heading_text_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_blog_heading_text_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_blog_read_more_color = get_theme_mod('vw_podcast_pro_blog_read_more_color');
$vw_podcast_pro_blog_read_more_font_size = get_theme_mod('vw_podcast_pro_blog_read_more_font_size');
$vw_podcast_pro_blog_read_more_font_family = get_theme_mod('vw_podcast_pro_blog_read_more_font_family');
$vw_podcast_pro_blog_read_more_font_weight = get_theme_mod('vw_podcast_pro_blog_read_more_font_weight');

if ($vw_podcast_pro_blog_read_more_color != false || $vw_podcast_pro_blog_read_more_font_family != false || $vw_podcast_pro_blog_read_more_font_size != false || $vw_podcast_pro_blog_read_more_font_weight != false) {
	$custom_css .= 'a.blog-link{';
	if ($vw_podcast_pro_blog_read_more_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_blog_read_more_color) . ' ;';
	}
	if ($vw_podcast_pro_blog_read_more_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_blog_read_more_font_family) . ' ;';
	}
	if ($vw_podcast_pro_blog_read_more_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_blog_read_more_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_blog_read_more_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_blog_read_more_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_blog_sec_answer_color = get_theme_mod('vw_podcast_pro_blog_sec_answer_color');
$vw_podcast_pro_blog_sec_answer_font_size = get_theme_mod('vw_podcast_pro_blog_sec_answer_font_size');
$vw_podcast_pro_blog_sec_answer_font_family = get_theme_mod('vw_podcast_pro_blog_sec_answer_font_family');
$vw_podcast_pro_blog_sec_answer_font_weight = get_theme_mod('vw_podcast_pro_blog_sec_answer_font_weight');

if ($vw_podcast_pro_blog_sec_answer_color != false || $vw_podcast_pro_blog_sec_answer_font_family != false || $vw_podcast_pro_blog_sec_answer_font_size != false || $vw_podcast_pro_blog_sec_answer_font_weight != false) {
	$custom_css .= '.info-bar a,.info-bar p{';
	if ($vw_podcast_pro_blog_sec_answer_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_blog_sec_answer_color) . ' ;';
	}
	if ($vw_podcast_pro_blog_sec_answer_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_blog_sec_answer_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_blog_sec_answer_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_blog_sec_answer_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_blog_sec_answer_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_blog_sec_answer_font_family) . ' ;';
	}
	$custom_css .= '}';
}



$vw_podcast_pro_blog_title_color = get_theme_mod('vw_podcast_pro_blog_title_color');
$vw_podcast_pro_blog_title_font_size = get_theme_mod('vw_podcast_pro_blog_title_font_size');
$vw_podcast_pro_blog_title_font_family = get_theme_mod('vw_podcast_pro_blog_title_font_family');
$vw_podcast_pro_blog_title_font_weight = get_theme_mod('vw_podcast_pro_blog_title_font_weight');

if ($vw_podcast_pro_blog_title_color != false || $vw_podcast_pro_blog_title_font_family != false || $vw_podcast_pro_blog_title_font_size != false || $vw_podcast_pro_blog_title_font_weight != false) {
	$custom_css .= '.blog-card-content h5{';
	if ($vw_podcast_pro_blog_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_blog_title_color) . ' ;';
	}
	if ($vw_podcast_pro_blog_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_blog_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_blog_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_blog_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_blog_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_blog_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_widget_title_color = get_theme_mod('vw_podcast_pro_widget_title_color');
$vw_podcast_pro_widget_title_font_size = get_theme_mod('vw_podcast_pro_widget_title_font_size');
$vw_podcast_pro_widget_title_font_family = get_theme_mod('vw_podcast_pro_widget_title_font_family');
$vw_podcast_pro_widget_title_font_weight = get_theme_mod('vw_podcast_pro_widget_title_font_weight');

if ($vw_podcast_pro_widget_title_color != false || $vw_podcast_pro_widget_title_font_family != false || $vw_podcast_pro_widget_title_font_size != false || $vw_podcast_pro_widget_title_font_weight != false) {
	$custom_css .= '.sidebar-Touch h5{';
	if ($vw_podcast_pro_widget_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_widget_title_color) . ' ;';
	}
	if ($vw_podcast_pro_widget_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_widget_title_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_widget_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_widget_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_widget_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_widget_title_font_family) . ' ;';
	}
	$custom_css .= '}';
}



$vw_podcast_pro_widget_btn_color = get_theme_mod('vw_podcast_pro_widget_btn_color');
$vw_podcast_pro_widget_btn_font_size = get_theme_mod('vw_podcast_pro_widget_btn_font_size');
$vw_podcast_pro_widget_btn_font_family = get_theme_mod('vw_podcast_pro_widget_btn_font_family');
$vw_podcast_pro_widget_btn_font_weight = get_theme_mod('vw_podcast_pro_widget_btn_font_weight');

if ($vw_podcast_pro_widget_btn_color != false || $vw_podcast_pro_widget_btn_font_family != false || $vw_podcast_pro_widget_btn_font_size != false || $vw_podcast_pro_widget_btn_font_weight != false) {
	$custom_css .= '.sidebar-Touch a{';
	if ($vw_podcast_pro_widget_btn_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_widget_btn_color) . ' ;';
	}
	if ($vw_podcast_pro_widget_btn_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_widget_btn_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_widget_btn_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_widget_btn_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_widget_btn_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_widget_btn_font_family) . ' ;';
	}
	$custom_css .= '}';
}


// policy page setting 


$vw_podcast_pro_policy_page_heading_color = get_theme_mod('vw_podcast_pro_policy_page_heading_color');
$vw_podcast_pro_policy_page_heading_font_size = get_theme_mod('vw_podcast_pro_policy_page_heading_font_size');
$vw_podcast_pro_policy_page_heading_font_family = get_theme_mod('vw_podcast_pro_policy_page_heading_font_family');
$vw_podcast_pro_policy_page_heading_font_weight = get_theme_mod('vw_podcast_pro_policy_page_heading_font_weight');

if ($vw_podcast_pro_policy_page_heading_color != false || $vw_podcast_pro_policy_page_heading_font_family != false || $vw_podcast_pro_policy_page_heading_font_size != false || $vw_podcast_pro_policy_page_heading_font_weight != false) {
	$custom_css .= 'body.page-template-about-us .main-pageWrap h4,body.page-template-about-us .main-pageWrap h5{';
	if ($vw_podcast_pro_policy_page_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_policy_page_heading_color) . ' !important;';
	}
	if ($vw_podcast_pro_policy_page_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_policy_page_heading_font_weight) . ' !important;';
	}
	if ($vw_podcast_pro_policy_page_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_policy_page_heading_font_size) . 'px !important;';
	}
	if ($vw_podcast_pro_policy_page_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_policy_page_heading_font_family) . ' !important;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_policy_page_sub_headings_color = get_theme_mod('vw_podcast_pro_policy_page_sub_headings_color');
$vw_podcast_pro_policy_page_sub_headings_font_size = get_theme_mod('vw_podcast_pro_policy_page_sub_headings_font_size');
$vw_podcast_pro_policy_page_sub_headings_font_family = get_theme_mod('vw_podcast_pro_policy_page_sub_headings_font_family');
$vw_podcast_pro_policy_page_sub_headings_font_weight = get_theme_mod('vw_podcast_pro_policy_page_sub_headings_font_weight');

if ($vw_podcast_pro_policy_page_sub_headings_color != false || $vw_podcast_pro_policy_page_sub_headings_font_family != false || $vw_podcast_pro_policy_page_sub_headings_font_size != false || $vw_podcast_pro_policy_page_sub_headings_font_weight != false) {
	$custom_css .= 'body.page-template-default h4,body.page-template-default h3{';
	if ($vw_podcast_pro_policy_page_sub_headings_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_policy_page_sub_headings_color) . ' ;';
	}
	if ($vw_podcast_pro_policy_page_sub_headings_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_policy_page_sub_headings_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_policy_page_sub_headings_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_policy_page_sub_headings_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_policy_page_sub_headings_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_policy_page_sub_headings_font_family) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_policy_page_page_texts_color = get_theme_mod('vw_podcast_pro_policy_page_page_texts_color');
$vw_podcast_pro_policy_page_page_texts_font_size = get_theme_mod('vw_podcast_pro_policy_page_page_texts_font_size');
$vw_podcast_pro_policy_page_page_texts_font_family = get_theme_mod('vw_podcast_pro_policy_page_page_texts_font_family');
$vw_podcast_pro_policy_page_page_texts_font_weight = get_theme_mod('vw_podcast_pro_policy_page_page_texts_font_weight');

if ($vw_podcast_pro_policy_page_page_texts_color != false || $vw_podcast_pro_policy_page_page_texts_font_family != false || $vw_podcast_pro_policy_page_page_texts_font_size != false || $vw_podcast_pro_policy_page_page_texts_font_weight != false) {
	$custom_css .= 'body.page-template-about-us .main-pageWrap p,body.page-template-about-us .main-pageWrap li{';
	if ($vw_podcast_pro_policy_page_page_texts_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_policy_page_page_texts_color) . ' ;';
	}
	if ($vw_podcast_pro_policy_page_page_texts_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_policy_page_page_texts_font_weight) . ' ;';
	}
	if ($vw_podcast_pro_policy_page_page_texts_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_policy_page_page_texts_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_policy_page_page_texts_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_policy_page_page_texts_font_family) . ' ;';
	}
	$custom_css .= '}';
}
// footer 

// song archive pages

$vw_podcast_pro_archive_main_heading_color = get_theme_mod('vw_podcast_pro_archive_main_heading_color');
$vw_podcast_pro_archive_main_heading_font_size = get_theme_mod('vw_podcast_pro_archive_main_heading_font_size');
$vw_podcast_pro_archive_main_heading_font_family = get_theme_mod('vw_podcast_pro_archive_main_heading_font_family');
$vw_podcast_pro_archive_main_heading_font_weight = get_theme_mod('vw_podcast_pro_archive_main_heading_font_weight');

if ($vw_podcast_pro_archive_main_heading_color != false || $vw_podcast_pro_archive_main_heading_font_family != false || $vw_podcast_pro_archive_main_heading_font_size != false || $vw_podcast_pro_archive_main_heading_font_weight != false) {
	$custom_css .= '.archive header.page-header h1,.page-template-archive-artists .above_title h1{';
	if ($vw_podcast_pro_archive_main_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_archive_main_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_archive_main_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_archive_main_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_archive_main_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_archive_main_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_archive_main_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_archive_main_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_archive_song_heading_color = get_theme_mod('vw_podcast_pro_archive_song_heading_color');
$vw_podcast_pro_archive_song_heading_font_size = get_theme_mod('vw_podcast_pro_archive_song_heading_font_size');
$vw_podcast_pro_archive_song_heading_font_family = get_theme_mod('vw_podcast_pro_archive_song_heading_font_family');
$vw_podcast_pro_archive_song_heading_font_weight = get_theme_mod('vw_podcast_pro_archive_song_heading_font_weight');

if ($vw_podcast_pro_archive_song_heading_color != false || $vw_podcast_pro_archive_song_heading_font_family != false || $vw_podcast_pro_archive_song_heading_font_size != false || $vw_podcast_pro_archive_song_heading_font_weight != false) {
	$custom_css .= 'section.category-archive .song-title,.page-template-archive-artists .song-title{';
	if ($vw_podcast_pro_archive_song_heading_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_archive_song_heading_color) . ' ;';
	}
	if ($vw_podcast_pro_archive_song_heading_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_archive_song_heading_font_family) . ' ;';
	}
	if ($vw_podcast_pro_archive_song_heading_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_archive_song_heading_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_archive_song_heading_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_archive_song_heading_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_archive_song_desc_color = get_theme_mod('vw_podcast_pro_archive_song_desc_color');
$vw_podcast_pro_archive_song_desc_font_size = get_theme_mod('vw_podcast_pro_archive_song_desc_font_size');
$vw_podcast_pro_archive_song_desc_font_family = get_theme_mod('vw_podcast_pro_archive_song_desc_font_family');
$vw_podcast_pro_archive_song_desc_font_weight = get_theme_mod('vw_podcast_pro_archive_song_desc_font_weight');

if ($vw_podcast_pro_archive_song_desc_color != false || $vw_podcast_pro_archive_song_desc_font_family != false || $vw_podcast_pro_archive_song_desc_font_size != false || $vw_podcast_pro_archive_song_desc_font_weight != false) {
	$custom_css .= 'section.category-archive .song-description p,.page-template-archive-artists .song-description p{';
	if ($vw_podcast_pro_archive_song_desc_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_archive_song_desc_color) . ' ;';
	}
	if ($vw_podcast_pro_archive_song_desc_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_archive_song_desc_font_family) . ' ;';
	}
	if ($vw_podcast_pro_archive_song_desc_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_archive_song_desc_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_archive_song_desc_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_archive_song_desc_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_footer_headings_color = get_theme_mod('vw_podcast_pro_footer_headings_color');
$vw_podcast_pro_footer_headings_font_size = get_theme_mod('vw_podcast_pro_footer_headings_font_size');
$vw_podcast_pro_footer_headings_font_family = get_theme_mod('vw_podcast_pro_footer_headings_font_family');
$vw_podcast_pro_footer_headings_font_weight = get_theme_mod('vw_podcast_pro_footer_headings_font_weight');

if ($vw_podcast_pro_footer_headings_color != false || $vw_podcast_pro_footer_headings_font_family != false || $vw_podcast_pro_footer_headings_font_size != false || $vw_podcast_pro_footer_headings_font_weight != false) {
	$custom_css .= 'div#footer h3{';
	if ($vw_podcast_pro_footer_headings_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_footer_headings_color) . ' !important;';
	}
	if ($vw_podcast_pro_footer_headings_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_footer_headings_font_family) . ' ;';
	}
	if ($vw_podcast_pro_footer_headings_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_footer_headings_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_footer_headings_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_footer_headings_font_weight) . ' !important;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_footer_title_color = get_theme_mod('vw_podcast_pro_footer_title_color');
$vw_podcast_pro_footer_title_font_size = get_theme_mod('vw_podcast_pro_footer_title_font_size');
$vw_podcast_pro_footer_title_font_family = get_theme_mod('vw_podcast_pro_footer_title_font_family');
$vw_podcast_pro_footer_title_font_weight = get_theme_mod('vw_podcast_pro_footer_title_font_weight');

if ($vw_podcast_pro_footer_title_color != false || $vw_podcast_pro_footer_title_font_family != false || $vw_podcast_pro_footer_title_font_size != false || $vw_podcast_pro_footer_title_font_weight != false) {
	$custom_css .= '#footer .textwidget p,div#footer ul li a,#footer p.post-date{';
	if ($vw_podcast_pro_footer_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_footer_title_color) . ' ;';
	}
	if ($vw_podcast_pro_footer_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_footer_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_footer_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_footer_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_footer_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_footer_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}
// footer end 

// sinle song page 

$vw_podcast_pro_song_title_color = get_theme_mod('vw_podcast_pro_song_title_color');
$vw_podcast_pro_song_title_font_size = get_theme_mod('vw_podcast_pro_song_title_font_size');
$vw_podcast_pro_song_title_font_family = get_theme_mod('vw_podcast_pro_song_title_font_family');
$vw_podcast_pro_song_title_font_weight = get_theme_mod('vw_podcast_pro_song_title_font_weight');

if ($vw_podcast_pro_song_title_color != false || $vw_podcast_pro_song_title_font_family != false || $vw_podcast_pro_song_title_font_size != false || $vw_podcast_pro_song_title_font_weight != false) {
	$custom_css .= '.single-songs .song-info-bar h2{';
	if ($vw_podcast_pro_song_title_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_song_title_color) . ' ;';
	}
	if ($vw_podcast_pro_song_title_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_song_title_font_family) . ' ;';
	}
	if ($vw_podcast_pro_song_title_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_song_title_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_song_title_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_song_title_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_artist_name_color = get_theme_mod('vw_podcast_pro_artist_name_color');
$vw_podcast_pro_artist_name_font_size = get_theme_mod('vw_podcast_pro_artist_name_font_size');
$vw_podcast_pro_artist_name_font_family = get_theme_mod('vw_podcast_pro_artist_name_font_family');
$vw_podcast_pro_artist_name_font_weight = get_theme_mod('vw_podcast_pro_artist_name_font_weight');

if ($vw_podcast_pro_artist_name_color != false || $vw_podcast_pro_artist_name_font_family != false || $vw_podcast_pro_artist_name_font_size != false || $vw_podcast_pro_artist_name_font_weight != false) {
	$custom_css .= '.single-songs .artist-name{';
	if ($vw_podcast_pro_artist_name_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_artist_name_color) . ' ;';
	}
	if ($vw_podcast_pro_artist_name_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_artist_name_font_family) . ' ;';
	}
	if ($vw_podcast_pro_artist_name_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_artist_name_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_artist_name_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_artist_name_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_play_btn_taxonomy_color = get_theme_mod('vw_podcast_pro_play_btn_taxonomy_color');
$vw_podcast_pro_play_btn_taxonomy_font_size = get_theme_mod('vw_podcast_pro_play_btn_taxonomy_font_size');
$vw_podcast_pro_play_btn_taxonomy_font_family = get_theme_mod('vw_podcast_pro_play_btn_taxonomy_font_family');
$vw_podcast_pro_play_btn_taxonomy_font_weight = get_theme_mod('vw_podcast_pro_play_btn_taxonomy_font_weight');

if ($vw_podcast_pro_play_btn_taxonomy_color != false || $vw_podcast_pro_play_btn_taxonomy_font_family != false || $vw_podcast_pro_play_btn_taxonomy_font_size != false || $vw_podcast_pro_play_btn_taxonomy_font_weight != false) {
	$custom_css .= '.single-songs .main-pageWrap .vw-cusom-player .vwwvpl-icon.vwwvpl-play{';
	if ($vw_podcast_pro_play_btn_taxonomy_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_play_btn_taxonomy_color) . ' ;';
	}
	if ($vw_podcast_pro_play_btn_taxonomy_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_play_btn_taxonomy_font_family) . ' ;';
	}
	if ($vw_podcast_pro_play_btn_taxonomy_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_play_btn_taxonomy_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_play_btn_taxonomy_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_play_btn_taxonomy_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_song_duration_played_color = get_theme_mod('vw_podcast_pro_song_duration_played_color');
$vw_podcast_pro_song_duration_played_font_size = get_theme_mod('vw_podcast_pro_song_duration_played_font_size');
$vw_podcast_pro_song_duration_played_font_family = get_theme_mod('vw_podcast_pro_song_duration_played_font_family');
$vw_podcast_pro_song_duration_played_font_weight = get_theme_mod('vw_podcast_pro_song_duration_played_font_weight');

if ($vw_podcast_pro_song_duration_played_color != false || $vw_podcast_pro_song_duration_played_font_family != false || $vw_podcast_pro_song_duration_played_font_size != false || $vw_podcast_pro_song_duration_played_font_weight != false) {
	$custom_css .= '.single-songs .played{';
	if ($vw_podcast_pro_song_duration_played_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_song_duration_played_color) . ' ;';
	}
	if ($vw_podcast_pro_song_duration_played_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_song_duration_played_font_family) . ' ;';
	}
	if ($vw_podcast_pro_song_duration_played_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_song_duration_played_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_song_duration_played_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_song_duration_played_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_song_meta_taxonomy_color = get_theme_mod('vw_podcast_pro_song_meta_taxonomy_color');
$vw_podcast_pro_song_meta_taxonomy_font_size = get_theme_mod('vw_podcast_pro_song_meta_taxonomy_font_size');
$vw_podcast_pro_song_meta_taxonomy_font_family = get_theme_mod('vw_podcast_pro_song_meta_taxonomy_font_family');
$vw_podcast_pro_song_meta_taxonomy_font_weight = get_theme_mod('vw_podcast_pro_song_meta_taxonomy_font_weight');

if ($vw_podcast_pro_song_meta_taxonomy_color != false || $vw_podcast_pro_song_meta_taxonomy_font_family != false || $vw_podcast_pro_song_meta_taxonomy_font_size != false || $vw_podcast_pro_song_meta_taxonomy_font_weight != false) {
	$custom_css .= '.single-songs .album-metadata{';
	if ($vw_podcast_pro_song_meta_taxonomy_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_song_meta_taxonomy_color) . ' ;';
	}
	if ($vw_podcast_pro_song_meta_taxonomy_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_song_meta_taxonomy_font_family) . ' ;';
	}
	if ($vw_podcast_pro_song_meta_taxonomy_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_song_meta_taxonomy_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_song_meta_taxonomy_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_song_meta_taxonomy_font_weight) . ' ;';
	}
	$custom_css .= '}';
}



// Single albums page 


$vw_podcast_pro_song_title_album_playlist_color = get_theme_mod('vw_podcast_pro_song_title_album_playlist_color');
$vw_podcast_pro_song_title_album_playlist_font_size = get_theme_mod('vw_podcast_pro_song_title_album_playlist_font_size');
$vw_podcast_pro_song_title_album_playlist_font_family = get_theme_mod('vw_podcast_pro_song_title_album_playlist_font_family');
$vw_podcast_pro_song_title_album_playlist_font_weight = get_theme_mod('vw_podcast_pro_song_title_album_playlist_font_weight');

if ($vw_podcast_pro_song_title_album_playlist_color != false || $vw_podcast_pro_song_title_album_playlist_font_family != false || $vw_podcast_pro_song_title_album_playlist_font_size != false || $vw_podcast_pro_song_title_album_playlist_font_weight != false) {
	$custom_css .= '.single-albums .song-info-bar h2,.single-playlists .song-info-bar h2{';
	if ($vw_podcast_pro_song_title_album_playlist_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_song_title_album_playlist_color) . ' ;';
	}
	if ($vw_podcast_pro_song_title_album_playlist_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_song_title_album_playlist_font_family) . ' ;';
	}
	if ($vw_podcast_pro_song_title_album_playlist_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_song_title_album_playlist_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_song_title_album_playlist_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_song_title_album_playlist_font_weight) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_artist_name_album_playlist_color = get_theme_mod('vw_podcast_pro_artist_name_album_playlist_color');
$vw_podcast_pro_artist_name_album_playlist_font_size = get_theme_mod('vw_podcast_pro_artist_name_album_playlist_font_size');
$vw_podcast_pro_artist_name_album_playlist_font_family = get_theme_mod('vw_podcast_pro_artist_name_album_playlist_font_family');
$vw_podcast_pro_artist_name_album_playlist_font_weight = get_theme_mod('vw_podcast_pro_artist_name_album_playlist_font_weight');

if ($vw_podcast_pro_artist_name_album_playlist_color != false || $vw_podcast_pro_artist_name_album_playlist_font_family != false || $vw_podcast_pro_artist_name_album_playlist_font_size != false || $vw_podcast_pro_artist_name_album_playlist_font_weight != false) {
	$custom_css .= '.single-albums .artist-name,.single-playlists .artist-name{';
	if ($vw_podcast_pro_artist_name_album_playlist_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_artist_name_album_playlist_color) . ' ;';
	}
	if ($vw_podcast_pro_artist_name_album_playlist_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_artist_name_album_playlist_font_family) . ' ;';
	}
	if ($vw_podcast_pro_artist_name_album_playlist_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_artist_name_album_playlist_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_artist_name_album_playlist_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_artist_name_album_playlist_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_play_btn_taxonomy_album_playlist_color = get_theme_mod('vw_podcast_pro_play_btn_taxonomy_album_playlist_color');
$vw_podcast_pro_play_btn_taxonomy_album_playlist_font_size = get_theme_mod('vw_podcast_pro_play_btn_taxonomy_album_playlist_font_size');
$vw_podcast_pro_play_btn_taxonomy_album_playlist_font_family = get_theme_mod('vw_podcast_pro_play_btn_taxonomy_album_playlist_font_family');
$vw_podcast_pro_play_btn_taxonomy_album_playlist_font_weight = get_theme_mod('vw_podcast_pro_play_btn_taxonomy_album_playlist_font_weight');

if ($vw_podcast_pro_play_btn_taxonomy_album_playlist_color != false || $vw_podcast_pro_play_btn_taxonomy_album_playlist_font_family != false || $vw_podcast_pro_play_btn_taxonomy_album_playlist_font_size != false || $vw_podcast_pro_play_btn_taxonomy_album_playlist_font_weight != false) {
	$custom_css .= '.single-albums .main-pageWrap .vw-cusom-player .vwwvpl-icon.vwwvpl-play,.single-playlists .main-pageWrap .vw-cusom-player .vwwvpl-icon.vwwvpl-play{';
	if ($vw_podcast_pro_play_btn_taxonomy_album_playlist_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_play_btn_taxonomy_album_playlist_color) . ' ;';
	}
	if ($vw_podcast_pro_play_btn_taxonomy_album_playlist_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_play_btn_taxonomy_album_playlist_font_family) . ' ;';
	}
	if ($vw_podcast_pro_play_btn_taxonomy_album_playlist_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_play_btn_taxonomy_album_playlist_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_play_btn_taxonomy_album_playlist_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_play_btn_taxonomy_album_playlist_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_song_duration_played_album_playlist_color = get_theme_mod('vw_podcast_pro_song_duration_played_album_playlist_color');
$vw_podcast_pro_song_duration_played_album_playlist_font_size = get_theme_mod('vw_podcast_pro_song_duration_played_album_playlist_font_size');
$vw_podcast_pro_song_duration_played_album_playlist_font_family = get_theme_mod('vw_podcast_pro_song_duration_played_album_playlist_font_family');
$vw_podcast_pro_song_duration_played_album_playlist_font_weight = get_theme_mod('vw_podcast_pro_song_duration_played_album_playlist_font_weight');

if ($vw_podcast_pro_song_duration_played_album_playlist_color != false || $vw_podcast_pro_song_duration_played_album_playlist_font_family != false || $vw_podcast_pro_song_duration_played_album_playlist_font_size != false || $vw_podcast_pro_song_duration_played_album_playlist_font_weight != false) {
	$custom_css .= '.single-albums .played,.single-playlists .played{';
	if ($vw_podcast_pro_song_duration_played_album_playlist_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_song_duration_played_album_playlist_color) . ' ;';
	}
	if ($vw_podcast_pro_song_duration_played_album_playlist_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_song_duration_played_album_playlist_font_family) . ' ;';
	}
	if ($vw_podcast_pro_song_duration_played_album_playlist_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_song_duration_played_album_playlist_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_song_duration_played_album_playlist_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_song_duration_played_album_playlist_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_song_meta_taxonomy_album_playlist_color = get_theme_mod('vw_podcast_pro_song_meta_taxonomy_album_playlist_color');
$vw_podcast_pro_song_meta_taxonomy_album_playlist_font_size = get_theme_mod('vw_podcast_pro_song_meta_taxonomy_album_playlist_font_size');
$vw_podcast_pro_song_meta_taxonomy_album_playlist_font_family = get_theme_mod('vw_podcast_pro_song_meta_taxonomy_album_playlist_font_family');
$vw_podcast_pro_song_meta_taxonomy_album_playlist_font_weight = get_theme_mod('vw_podcast_pro_song_meta_taxonomy_album_playlist_font_weight');

if ($vw_podcast_pro_song_meta_taxonomy_album_playlist_color != false || $vw_podcast_pro_song_meta_taxonomy_album_playlist_font_family != false || $vw_podcast_pro_song_meta_taxonomy_album_playlist_font_size != false || $vw_podcast_pro_song_meta_taxonomy_album_playlist_font_weight != false) {
	$custom_css .= '.single-albums .album-metadata,.single-playlists .album-metadata{';
	if ($vw_podcast_pro_song_meta_taxonomy_album_playlist_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_song_meta_taxonomy_album_playlist_color) . ' ;';
	}
	if ($vw_podcast_pro_song_meta_taxonomy_album_playlist_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_song_meta_taxonomy_album_playlist_font_family) . ' ;';
	}
	if ($vw_podcast_pro_song_meta_taxonomy_album_playlist_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_song_meta_taxonomy_album_playlist_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_song_meta_taxonomy_album_playlist_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_song_meta_taxonomy_album_playlist_font_weight) . ' ;';
	}
	$custom_css .= '}';
}



// playlist section 

$vw_podcast_pro_playlist_sec_headings_color = get_theme_mod('vw_podcast_pro_playlist_sec_headings_color');
$vw_podcast_pro_playlist_sec_headings_font_size = get_theme_mod('vw_podcast_pro_playlist_sec_headings_font_size');
$vw_podcast_pro_playlist_sec_headings_font_family = get_theme_mod('vw_podcast_pro_playlist_sec_headings_font_family');
$vw_podcast_pro_playlist_sec_headings_font_weight = get_theme_mod('vw_podcast_pro_playlist_sec_headings_font_weight');

if ($vw_podcast_pro_playlist_sec_headings_color != false || $vw_podcast_pro_playlist_sec_headings_font_family != false || $vw_podcast_pro_playlist_sec_headings_font_size != false || $vw_podcast_pro_playlist_sec_headings_font_weight != false) {
	$custom_css .= 'section.playheading .list-item-title,.single-playlists .list-item-title{';
	if ($vw_podcast_pro_playlist_sec_headings_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_playlist_sec_headings_color) . ' ;';
	}
	if ($vw_podcast_pro_playlist_sec_headings_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_playlist_sec_headings_font_family) . ' ;';
	}
	if ($vw_podcast_pro_playlist_sec_headings_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_playlist_sec_headings_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_playlist_sec_headings_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_playlist_sec_headings_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_playlist_typography_color = get_theme_mod('vw_podcast_pro_playlist_typography_color');
$vw_podcast_pro_playlist_typography_font_size = get_theme_mod('vw_podcast_pro_playlist_typography_font_size');
$vw_podcast_pro_playlist_typography_font_family = get_theme_mod('vw_podcast_pro_playlist_typography_font_family');
$vw_podcast_pro_playlist_typography_font_weight = get_theme_mod('vw_podcast_pro_playlist_typography_font_weight');


if ($vw_podcast_pro_playlist_typography_color != false || $vw_podcast_pro_playlist_typography_font_family != false || $vw_podcast_pro_playlist_typography_font_size != false || $vw_podcast_pro_playlist_typography_font_weight != false) {
	$custom_css .= '.single-albums .player-history .song-title a, .single-albums .player-history .song-albun-history, .single-albums .duretion,.serial-number,.single-playlists .player-history.album .song-title a,.single-playlists .player-history .song-albun-history, .single-playlists .duretion,.serial-number,.song-info-wrap{';
	if ($vw_podcast_pro_playlist_typography_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_playlist_typography_color) . ' ;';
	}
	if ($vw_podcast_pro_playlist_typography_font_family != false) {
		$custom_css .= 'font-family:' . esc_html($vw_podcast_pro_playlist_typography_font_family) . ' ;';
	}
	if ($vw_podcast_pro_playlist_typography_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_playlist_typography_font_size) . 'px ;';
	}
	if ($vw_podcast_pro_playlist_typography_font_weight != false) {
		$custom_css .= 'font-weight:' . esc_html($vw_podcast_pro_playlist_typography_font_weight) . ' ;';
	}
	$custom_css .= '}';
}

//General Button Color Pallete option

$vw_podcast_pro_body_font_size = get_theme_mod('vw_podcast_pro_body_font_size');
if ($vw_podcast_pro_body_font_size != false) {
	$custom_css .= 'html body,p, ul,ul li,span,ul#menu-library li a, ul#menu-browse li a{';
	if ($vw_podcast_pro_body_font_size != false) {
		$custom_css .= 'font-size:' . esc_html($vw_podcast_pro_body_font_size) . 'px !important;';
	}
	$custom_css .= '}';
}

$vw_podcast_pro_body_color = get_theme_mod('vw_podcast_pro_body_color');
if ($vw_podcast_pro_body_color != false) {
	$custom_css .= 'html body,p, ul,ul li,span,h1,h2,h3,h4,h5,h6,a,input,#header .current-menu-item a,.main-navigation a{';
	if ($vw_podcast_pro_body_color != false) {
		$custom_css .= 'color:' . esc_html($vw_podcast_pro_body_color) . ' !important;';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_h1_font_family = get_theme_mod('vw_podcast_pro_h1_font_family');
$vw_podcast_pro_h1_font_size = get_theme_mod('vw_podcast_pro_h1_font_size');
$vw_podcast_pro_h1_font_weight = get_theme_mod('vw_podcast_pro_h1_font_weight');
$vw_podcast_pro_h1_color = get_theme_mod('vw_podcast_pro_h1_color');
$vw_podcast_pro_h2_font_family = get_theme_mod('vw_podcast_pro_h2_font_family');
$vw_podcast_pro_h2_font_size = get_theme_mod('vw_podcast_pro_h2_font_size');
$vw_podcast_pro_h2_font_weight = get_theme_mod('vw_podcast_pro_h2_font_weight');
$vw_podcast_pro_h2_color = get_theme_mod('vw_podcast_pro_h2_color');
$vw_podcast_pro_h3_font_family = get_theme_mod('vw_podcast_pro_h3_font_family');
$vw_podcast_pro_h3_font_size = get_theme_mod('vw_podcast_pro_h3_font_size');
$vw_podcast_pro_h3_font_weight = get_theme_mod('vw_podcast_pro_h3_font_weight');
$vw_podcast_pro_h3_color = get_theme_mod('vw_podcast_pro_h3_color');
$vw_podcast_pro_h4_font_family = get_theme_mod('vw_podcast_pro_h4_font_family');
$vw_podcast_pro_h4_font_size = get_theme_mod('vw_podcast_pro_h4_font_size');
$vw_podcast_pro_h4_color = get_theme_mod('vw_podcast_pro_h4_color');
$vw_podcast_pro_h5_font_family = get_theme_mod('vw_podcast_pro_h5_font_family');
$vw_podcast_pro_h5_font_size = get_theme_mod('vw_podcast_pro_h5_font_size');
$vw_podcast_pro_h5_color = get_theme_mod('vw_podcast_pro_h5_color');
$vw_podcast_pro_h6_font_family = get_theme_mod('vw_podcast_pro_h6_font_family');
$vw_podcast_pro_h6_font_size = get_theme_mod('vw_podcast_pro_h6_font_size');
$vw_podcast_pro_h6_color = get_theme_mod('vw_podcast_pro_h6_color');
$vw_podcast_pro_paragarpah_font_family = get_theme_mod('vw_podcast_pro_paragarpah_font_family');
$vw_podcast_pro_para_font_size = get_theme_mod('vw_podcast_pro_para_font_size');
$vw_podcast_pro_para_font_weight = get_theme_mod('vw_podcast_pro_para_font_weight');
$vw_podcast_pro_para_color = get_theme_mod('vw_podcast_pro_para_color');
// $vw_podcast_pro_hi_first_color = get_theme_mod('vw_podcast_pro_hi_first_color');
$vw_podcast_pro_hi_scnd_color = get_theme_mod('vw_podcast_pro_hi_scnd_color');
$vw_podcast_pro_image_below_heading = get_theme_mod('vw_podcast_pro_image_below_heading');
$vw_podcast_pro_h4_font_weight = get_theme_mod('vw_podcast_pro_h4_font_weight');
$vw_podcast_pro_h5_font_weight = get_theme_mod('vw_podcast_pro_h5_font_weight');
$vw_podcast_pro_h6_font_weight = get_theme_mod('vw_podcast_pro_h6_font_weight');

$vw_podcast_pro_genral_heading_decoration_section = get_theme_mod('vw_podcast_pro_genral_heading_decoration_section');



if ($vw_podcast_pro_paragarpah_font_family != false || $vw_podcast_pro_para_color != false || $vw_podcast_pro_para_font_size != false || $vw_podcast_pro_para_font_weight != false) {
	$custom_css .= 'body p,.playlist p,.category-artist .song-description p,.add-column p,body #footer .textwidget p{';
	if ($vw_podcast_pro_paragarpah_font_family != false) {
		$custom_css .= 'font-family: ' . esc_html($vw_podcast_pro_paragarpah_font_family) . ' !important;';
	}
	if ($vw_podcast_pro_para_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_para_color) . ' !important;';
	}
	if ($vw_podcast_pro_para_font_size != false) {
		$custom_css .= 'font-size: ' . esc_html($vw_podcast_pro_para_font_size) . 'px !important;';
	}
	if ($vw_podcast_pro_para_font_weight != false) {
		$custom_css .= 'font-weight: ' . esc_html($vw_podcast_pro_para_font_weight) . ' !important;';
	}
	$custom_css .= '}';
}
/*-------------------h1-----------------------*/
if ($vw_podcast_pro_h1_font_family != false || $vw_podcast_pro_h1_color != false || $vw_podcast_pro_h1_font_size != false || $vw_podcast_pro_h1_font_weight != false) {
	$custom_css .= 'body h1,body #section#main-banner  h1{';
	if ($vw_podcast_pro_h1_font_family != false) {
		$custom_css .= 'font-family: ' . esc_html($vw_podcast_pro_h1_font_family) . ' !important;';
	}
	if ($vw_podcast_pro_h1_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_h1_color) . ' !important;';
	}
	if ($vw_podcast_pro_h1_font_size != false) {
		$custom_css .= 'font-size: ' . esc_html($vw_podcast_pro_h1_font_size) . 'px !important;';
	}
	if ($vw_podcast_pro_h1_font_weight != false) {
		$custom_css .= 'font-weight: ' . esc_html($vw_podcast_pro_h1_font_weight) . ' !important;';
	}
	$custom_css .= '}';
}

/*-------------------h2-----------------------*/
if ($vw_podcast_pro_h2_font_family != false || $vw_podcast_pro_h2_color != false || $vw_podcast_pro_h2_font_size != false || $vw_podcast_pro_h2_font_weight != false) {
	$custom_css .= 'body h2,h2,section h2,.h2 h2{';
	if ($vw_podcast_pro_h2_font_family != false) {
		$custom_css .= 'font-family: ' . esc_html($vw_podcast_pro_h2_font_family) . '!important;';
	}
	if ($vw_podcast_pro_h2_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_h2_color) . ' !important;';
	}
	if ($vw_podcast_pro_h2_font_size != false) {
		$custom_css .= 'font-size: ' . esc_html($vw_podcast_pro_h2_font_size) . 'px !important;';
	}
	if ($vw_podcast_pro_h2_font_weight != false) {
		$custom_css .= 'font-weight: ' . esc_html($vw_podcast_pro_h2_font_weight) . ' !important;';
	}
	$custom_css .= '}';
}
/*-------------------h3-----------------------*/
if ($vw_podcast_pro_h3_font_family != false || $vw_podcast_pro_h3_color != false || $vw_podcast_pro_h3_font_size != false || $vw_podcast_pro_h3_font_weight != false) {
	$custom_css .= 'h3, #new-product .product-name a, #feature-product .product-name a ,.footer-top-col h3,h3.product-name a ,.container #blog-right-sidebar h3, #footer h3, #category .section-title h3, .collectionbox-text h3 a, .collection-inner h3, #author .section-title h3, #testimonials .section-title h3, #testimonials h3 small, .collectionbox-text h3, .news_box_outer h3, .section-title h3, section h3, h3.contact-page, .contac_form h3, #full-width-blog .postbox h3, .postbox h3, #comments h3.comment-reply-title, #sidebar h3, .tesimonialtitle a{';
	if ($vw_podcast_pro_h3_font_family != false) {
		$custom_css .= 'font-family: ' . esc_html($vw_podcast_pro_h3_font_family) . ' !important;';
	}
	if ($vw_podcast_pro_h3_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_h3_color) . ' !important;';
	}
	if ($vw_podcast_pro_h3_font_size != false) {
		$custom_css .= 'font-size: ' . esc_html($vw_podcast_pro_h3_font_size) . 'px !important;';
	}
	if ($vw_podcast_pro_h3_font_weight != false) {
		$custom_css .= 'font-weight: ' . esc_html($vw_podcast_pro_h3_font_weight) . ' !important;';
	}
	$custom_css .= '}';

}
if ($vw_podcast_pro_h4_font_family != false || $vw_podcast_pro_h4_color != false || $vw_podcast_pro_h4_font_size != false || $vw_podcast_pro_h4_font_weight != false) {
	$custom_css .= 'h4, section h4,h4.customer-name,.pack-top h4, .pack-top span{';
	if ($vw_podcast_pro_h4_font_family != false) {
		$custom_css .= 'font-family: ' . esc_html($vw_podcast_pro_h4_font_family) . ' !important;';
	}
	if ($vw_podcast_pro_h4_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_h4_color) . ' !important;';
	}
	if ($vw_podcast_pro_h4_font_size != false) {
		$custom_css .= 'font-size: ' . esc_html($vw_podcast_pro_h4_font_size) . 'px !important;';
	}
	if ($vw_podcast_pro_h4_font_weight != false) {
		$custom_css .= 'font-weight: ' . esc_html($vw_podcast_pro_h4_font_weight) . ' !important;';
	}
	$custom_css .= '}';
	$custom_css .= '}';
}

if ($vw_podcast_pro_h6_font_family != false || $vw_podcast_pro_h6_color != false || $vw_podcast_pro_h6_font_size != false || $vw_podcast_pro_h6_font_weight != false) {
	$custom_css .= 'body h6,#new-product h6.product-brand, #feature-product h6.product-brand,h6,#latest_post .collectionbox-text h6, .postbox h6, #category .categorytitle a{';
	if ($vw_podcast_pro_h6_font_family != false) {
		$custom_css .= 'font-family: ' . esc_html($vw_podcast_pro_h6_font_family) . ' !important;';
	}
	if ($vw_podcast_pro_h6_color != false) {
		$custom_css .= 'color: ' . esc_html($vw_podcast_pro_h6_color) . ' !important;';
	}
	if ($vw_podcast_pro_h6_font_size != false) {
		$custom_css .= 'font-size: ' . esc_html($vw_podcast_pro_h6_font_size) . 'px !important;';
	}
	if ($vw_podcast_pro_h6_font_weight != false) {
		$custom_css .= 'font-weight: ' . esc_html($vw_podcast_pro_h6_font_weight) . ' !important;';
	}
	$custom_css .= '}';
}










//Footer Copyright






//  Padding Top
$vw_podcast_pro_section_header_padding_top = get_theme_mod('vw_podcast_pro_section-header_padding_top');
$vw_podcast_pro_section_banner_padding_top = get_theme_mod('vw_podcast_pro_section-banner_padding_top');
$vw_podcast_pro_section_trending_padding_top = get_theme_mod('vw_podcast_pro_section-trending_padding_top');
$vw_podcast_pro_section_addOne_padding_top = get_theme_mod('vw_podcast_pro_section-addOne_padding_top');
$vw_podcast_pro_section_newReleases_padding_top = get_theme_mod('vw_podcast_pro_section-newReleases_padding_top');
$vw_podcast_pro_section_radio_padding_top = get_theme_mod('vw_podcast_pro_section-radio_padding_top');
$vw_podcast_pro_section_artists_padding_top = get_theme_mod('vw_podcast_pro_section-artists_padding_top');
$vw_podcast_pro_section_addTwo_padding_top = get_theme_mod('vw_podcast_pro_section-addTwo_padding_top');
$vw_podcast_pro_section_recomemended_padding_top = get_theme_mod('vw_podcast_pro_section-recomemended_padding_top');
$vw_podcast_pro_section_topChart_padding_top = get_theme_mod('vw_podcast_pro_section-topChart_padding_top');
$vw_podcast_pro_section_english_padding_top = get_theme_mod('vw_podcast_pro_section-english_padding_top');
$vw_podcast_pro_section_addThree_padding_top = get_theme_mod('vw_podcast_pro_section-addThree_padding_top');
$vw_podcast_pro_section_pricing_padding_top = get_theme_mod('vw_podcast_pro_section-pricing_padding_top');
$vw_podcast_pro_section_romance_padding_top = get_theme_mod('vw_podcast_pro_section-romance_padding_top');
$vw_podcast_pro_section_spanish_padding_top = get_theme_mod('vw_podcast_pro_section-spanish_padding_top');
// padding top settings 
if ($vw_podcast_pro_section_header_padding_top != false) {
	$custom_css .= 'section#vw-sticky-menu{';
	if ($vw_podcast_pro_section_header_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_header_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_banner_padding_top != false) {
	$custom_css .= '.event-add-section{';
	if ($vw_podcast_pro_section_banner_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_banner_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}

if ($vw_podcast_pro_section_trending_padding_top != false) {
	$custom_css .= 'section.trending{';
	if ($vw_podcast_pro_section_trending_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_trending_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}

if ($vw_podcast_pro_section_addOne_padding_top != false) {
	$custom_css .= 'section.first.advertisements{';
	if ($vw_podcast_pro_section_addOne_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_addOne_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_newReleases_padding_top != false) {
	$custom_css .= 'section#newReleases{';
	if ($vw_podcast_pro_section_newReleases_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_newReleases_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_radio_padding_top != false) {
	$custom_css .= 'section.category-radio.category-artist{';
	if ($vw_podcast_pro_section_radio_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_radio_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_artists_padding_top != false) {
	$custom_css .= 'section.category-artist{';
	if ($vw_podcast_pro_section_romance_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_romance_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_romance_padding_top != false) {
	$custom_css .= 'section.add-three.advertisements{';
	if ($vw_podcast_pro_section_addTwo_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_addTwo_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_recomemended_padding_top != false) {
	$custom_css .= 'section.recomended{';
	if ($vw_podcast_pro_section_recomemended_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_recomemended_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_topChart_padding_top != false) {
	$custom_css .= 'section.top-chart.section-space{';
	if ($vw_podcast_pro_section_topChart_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_topChart_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_english_padding_top != false) {
	$custom_css .= 'section.english{';
	if ($vw_podcast_pro_section_english_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_english_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}

if ($vw_podcast_pro_section_addThree_padding_top != false) {
	$custom_css .= 'section.add-two.advertisements{';
	if ($vw_podcast_pro_section_addThree_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_addThree_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_romance_padding_top != false) {
	$custom_css .= 'section.romance{';
	if ($vw_podcast_pro_section_romance_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_romance_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}
if ($vw_podcast_pro_section_spanish_padding_top != false) {
	$custom_css .= 'section.spanish{';
	if ($vw_podcast_pro_section_spanish_padding_top != false) {
		$custom_css .= 'padding-top: ' . esc_html($vw_podcast_pro_section_spanish_padding_top) . 'px ;';
	}
	$custom_css .= '}';
}

// padding top setting 






$vw_podcast_pro_post_general_settings_post_author = get_theme_mod($vw_podcast_pro_post_general_settings_post_author);

if ($vw_podcast_pro_post_general_settings_post_author != false) {
	$custom_css .= 'li.entry-author.list-unstyled{';
	if ($vw_podcast_pro_post_general_settings_post_author != false) {
		$custom_css .= 'display: ' . esc_html($vw_podcast_pro_post_general_settings_post_author) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_post_general_settings = get_theme_mod($vw_podcast_pro_post_general_settings);

if ($vw_podcast_pro_post_general_settings != false) {
	$custom_css .= 'li.entry-author.list-unstyled{';
	if ($vw_podcast_pro_post_general_settings != false) {
		$custom_css .= 'display: ' . esc_html($vw_podcast_pro_post_general_settings) . ' ;';
	}
	$custom_css .= '}';
}





$vw_podcast_pro_post_general_settings_post_date = get_theme_mod($vw_podcast_pro_post_general_settings_post_date);

if ($vw_podcast_pro_post_general_settings_post_date != false) {
	$custom_css .= 'li.entry-author.list-unstyled{';
	if ($vw_podcast_pro_post_general_settings_post_date != false) {
		$custom_css .= 'display: ' . esc_html($vw_podcast_pro_post_general_settings_post_date) . ' ;';
	}
	$custom_css .= '}';
}

// Banner settings end 
$vw_podcast_pro_primary_btn_bg = get_theme_mod('vw_podcast_pro_primary_btn_bg');

if ($vw_podcast_pro_primary_btn_bg != false) {
	$custom_css .= 'section.add-three a.red-btn,a.red-btn,.adds-link a{';
	if ($vw_podcast_pro_primary_btn_bg != false) {
		$custom_css .= 'background-color: ' . esc_html($vw_podcast_pro_primary_btn_bg) . ' ;';
	}
	$custom_css .= '}';
}


$vw_podcast_pro_hi_first_color_2 = get_theme_mod('vw_podcast_pro_hi_first_color_2');
$vw_podcast_pro_hi_first_color_3 = get_theme_mod('vw_podcast_pro_hi_first_color_3');

if ($vw_podcast_pro_hi_first_color_2 != false && $vw_podcast_pro_hi_first_color_3 != false) {
	$custom_css .= 'section.add-two.advertisements,section.first.advertisements,section.add-three.advertisements.section-space,.last-col,.submit-btn-wrapper input,ul#menu-primary-menu li:hover,.player_mini,.vwwvpl-icon.vwwvpl-play,.socialbox a:hover,.pmpro_level.active-plan,.blog-card:hover .tags,.blog-card:hover a.blog-link{';
	if ($vw_podcast_pro_hi_first_color_2 != false && $vw_podcast_pro_hi_first_color_3 != false) {
		$custom_css .= 'background: transparent linear-gradient(180deg, ' . esc_html($vw_podcast_pro_hi_first_color_2) . ' 0%,' . esc_html($vw_podcast_pro_hi_first_color_3) . ' 100%) 0% 0% no-repeat padding-box;';
	}
	$custom_css .= '}';
}




$vw_podcast_pro_from_bg_image = get_theme_mod('vw_podcast_pro_from_bg_image');

if ($vw_podcast_pro_from_bg_image != false) {
	$custom_css .= '.support-contact-info::after{';
	if ($vw_podcast_pro_from_bg_image != false) {
		$custom_css .= 'background-image:url(' . esc_html($vw_podcast_pro_from_bg_image) . ');';
	}
	$custom_css .= '}';
}
$vw_podcast_pro_from_bg_color = get_theme_mod('vw_podcast_pro_from_bg_color');

$custom_css .= '.support-contact-info{';
if ($vw_podcast_pro_from_bg_color != false) {
	$custom_css .= 'background-color: ' . esc_html($vw_podcast_pro_from_bg_color) . ' ;';
}
$custom_css .= '}';


