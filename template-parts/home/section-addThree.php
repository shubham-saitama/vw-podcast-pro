
<?php
$section_hide = get_theme_mod('vw_podcast_pro_ad_three_section_enable');
if ('Disable' == $section_hide) {
  return;
}

$background_img_three = get_theme_mod('vw_podcast_pro_advertisement_sec_image_bgimage_three');

?>
<section class="add-two advertisements section-space" style="<?php if (!empty($background_img_three)) { ?>background-image:url(<?php echo $background_img_three;} ?>);">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="add-column col-lg-4 col-md-6 col-12">
                <h4>
                    <?php echo get_theme_mod('vw_podcast_pro_ad_three_heading');  ?>
                </h4>
            </div>
            <div class="add-column  col-lg-4 col-md-6 col-12">
                <h5><?php echo get_theme_mod('vw_podcast_pro_ad_three_register_title');  ?></h5>
                <a class="red-btn" href="<?php echo get_theme_mod('vw_podcast_pro_ad_threebutton_link');?>"><?php echo get_theme_mod('vw_podcast_pro_ad_threebutton_title');  ?></a>
                <p><?php echo get_theme_mod('vw_podcast_pro_ad_three_middle_txt');?></p>
            </div>
            <div class="add-column three ">
                <img src="<?php echo get_theme_mod('vw_podcast_pro_ad_three_section_image'); ?>" alt="Add three image">
            </div>
        </div>
    </div>
</section>
