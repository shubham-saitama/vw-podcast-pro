<?php
$section_enable = get_theme_mod('vw_podcast_pro_advertisement_sec_image_enable');
$background_img = get_theme_mod('vw_podcast_pro_advertisement_sec_image_bgimage');
if ($section_enable === "Disable") {
    return;
}
?>
<section class="first advertisements"
    style='background-image:url(<?php if (!empty($background_img)) {
        echo $background_img;
    } ?>)'>
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="row col-lg-9 col-md-12 col-12">
                <div class="add-title col-lg-4 col-md-12 col-12">
                    <h4>
                        <?php echo get_theme_mod('vw_podcast_pro_section_event_name'); ?>
                        </h3>
                        <p>
                            <?php echo get_theme_mod('vw_podcast_pro_section_event_desc'); ?>
                        </p>
                </div>
                <div class="center-wrapper col-lg-8 col-md-12 col-12">
                    <div class="adds-row">
                        <div class="ad-image1">
                            <img src="<?php echo get_theme_mod('vw_podcast_pro_popular_team_image_1'); ?>"
                                alt="image one" title="image one">
                            <div class="team-name">
                                <?php echo get_theme_mod('vw_podcast_pro_section_team_name_1'); ?>
                            </div>
                        </div>
                        <div class="center-title">
                            <div class="center-img-wrap">
                                <img src="<?php echo get_theme_mod('vw_podcast_pro_popular_cup_image'); ?>" alt="Trophy"
                                    title="Trophy">
                            </div>
                            <h5>
                                <?php echo get_theme_mod('vw_podcast_pro_section_cup_title'); ?>
                            </h5>
                            <div class="add-tag">
                                <?php echo get_theme_mod('vw_podcast_pro_advertisement_section_vs_text_btn'); ?>
                            </div>
                        </div>
                        <div class="ad-image2">
                            <img src="<?php echo get_theme_mod('vw_podcast_pro_popular_team_image_2'); ?>"
                                alt="image two" title="image two">
                            <div class="team-name">
                                <?php echo get_theme_mod('vw_podcast_pro_section_team_name_2'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adds-link col-lg-2 col-md-12 col-12">
                <span class="ad-timer">
                    <?php echo get_theme_mod('vw_podcast_pro_section_add_timer'); ?>
                </span>
                <a href="<?php echo get_theme_mod('vw_podcast_pro_section_add_button_link'); ?>">
                    <?php echo get_theme_mod('vw_podcast_pro_section_add_button'); ?>
                </a>
                <p>
                    <?php echo get_theme_mod('vw_podcast_pro_section_add_text'); ?>
                </p>
            </div>
        </div>
    </div>
</section>