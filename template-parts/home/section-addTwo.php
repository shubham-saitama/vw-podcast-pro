<?php
$background_img = get_theme_mod('vw_podcast_pro_advertisement_two_sec_image_bgimage');
$section_hide = get_theme_mod('vw_podcast_pro_add_two_sec_ad_small_title_image_enable');
if ('Disable' == $section_hide) {
    return;
}
?>

<section class="add-three advertisements section-space"
    style="<?php if (!empty($background_img)) { ?> background-image:url(<?php echo $background_img;
    } ?>)">
    <div class="container-fluid">
        <div class="row justify-content-start">
            <div class="add-column col-lg-5 col-md-5 col-12">
                <span class="small-title">
                    <?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_small_title'); ?>
                </span>
                <h4>
                    <?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_main_title'); ?>
                </h4>
            </div>
            <div class="add-column col-lg-7 col-md-7 col-12">
                <div class="row">
                    <div class="plan-features col-lg-6 col-md-12 col-12">
                        <span class="feature">
                            <?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_1'); ?>
                        </span>
                        <span class="feature">
                            <?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_2'); ?>
                        </span>
                        <span class="feature">
                            <?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_3'); ?>
                        </span>
                    </div>
                    <div class="buttons-wrapper col-lg-6 col-md-12 col-12">
                        <a class="red-btn trans" target="_blank" href="<?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_btn_link'); ?>"><?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_buttons_text'); ?></a>
                        <a class="red-btn" target="_blank"
                            href="<?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_btn_link_2'); ?>">
                            <?php echo get_theme_mod('vw_podcast_pro_add_two_sec_ad_buttons_text_2'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>