<?php
/**
 * Template part for displaying services
 *
 * @package vw-podcast-pro
 */

$section_hide = get_theme_mod('vw_podcast_pro_GetInTouch_enable');
if ('Disable' == $section_hide) {
    return;
}
if (get_theme_mod('vw_podcast_pro_GetInTouch_bgcolor')) {
    $GetInTouch_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_GetInTouch_bgcolor', '')) . ';';
} 
elseif (get_theme_mod('vw_podcast_pro_GetInTouch_bgimage')) {
    $GetInTouch_back = 'background-image:url(' . esc_url(get_theme_mod('vw_podcast_pro_GetInTouch_bgimage')) . ')';
} else {
    $GetInTouch_back = '';
}
// $img_bg = get_theme_mod('vw_podcast_pro_GetInTouch_bgimage_setting');
?>
<section id="GetInTouch" style="<?php echo esc_attr($GetInTouch_back); ?>"
    class="<?php// echo esc_attr($img_bg); ?> section-space">
    <div class="container">
        <div class="row justify-content-between">
            <div class="GetInTouch heading text-left col-lg-6 col-md-6 col-12">
                <div class="GetInTouch_wrapper">
                    <div class="heading-tagline">
                        <?php $tagline = get_theme_mod('vw_podcast_pro_GetInTouch_heading_tagline');
                        if (!empty($tagline)) {
                            echo esc_html($tagline);
                        } ?>
                    </div>
                    <?php $heading = get_theme_mod('vw_podcast_pro_GetInTouch_heading_font_text');
                    if (!empty($heading)) { ?>
                        <h2 class="left">
                            <?php echo esc_html($heading); ?>
                        </h2>
                    <?php } ?>
                    <?php $section_desc = get_theme_mod('vw_podcast_pro_GetInTouch_section_desc');
                    if (!empty($section_desc)) { ?>
                        <p class="section-desc">
                            <?php echo esc_html($section_desc); ?>
                        </p>
                    <?php } ?>
                    <div class="support-box">
                        <?php $support_icon = get_theme_mod('vw_podcast_pro_GetInTouch_support_icon');
                        if (!empty($support_icon)) { ?>
                            <div class="icon-wrap">
                                <img src="<?php echo esc_url($support_icon); ?>" alt="Support icon">
                            </div>
                        <?php } ?>
                        <div class="support-inner-wrap">
                            <?php $support_text = get_theme_mod('vw_podcast_pro_GetInTouch_support_text');
                            if (!empty($support_text)) { ?>
                                <p class="support-para">
                                    <?php echo esc_html($support_text); ?>
                                </p>
                            <?php } ?>
                            <?php $support_contact_number = get_theme_mod('vw_podcast_pro_GetInTouch_support_contact_number');
                            if (!empty($support_contact_number)) { ?>
                                <a href="tel:<?php echo esc_attr($support_contact_number); ?>"><?php echo esc_html($support_contact_number); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="GetInTouch-features col-lg-6 col-md-6 col-12">
                <?php
                for ($i = 1; $i <= 2; $i++) {
                    $feature_icon = get_theme_mod('vw_podcast_pro_GetInTouch_feature' . $i . '_icon');
                    $feature_title = get_theme_mod('vw_podcast_pro_GetInTouch_feature' . $i . '_title');
                    $feature_desc = get_theme_mod('vw_podcast_pro_GetInTouch_feature' . $i . '_desc');

                    if (!empty($feature_icon) || !empty($feature_title) || !empty($feature_desc)) {
                        ?>
                        <div class="GetInTouch-feature-wrapper">
                            <div class="GetInTouch-feature">
                                <?php if (!empty($feature_icon)) { ?>
                                    <div class="icon">
                                        <img src="<?php echo esc_url($feature_icon); ?>" alt="Support icon">
                                    </div>
                                <?php } ?>
                                <div class="feature-info">
                                    <?php if (!empty($feature_title)) { ?>
                                        <p class="label">
                                            <?php echo esc_html($feature_title); ?>
                                        </p>
                                    <?php } ?>
                                    <?php if (!empty($feature_desc)) { ?>
                                        <div class="desc">
                                            <?php echo esc_html($feature_desc); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>