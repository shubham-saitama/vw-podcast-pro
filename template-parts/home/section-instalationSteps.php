<?php
/**
 * Template to show Module Section
 *
 * @package vw_podcast_pro
 */
$section_hide = get_theme_mod('vw_podcast_pro_insatllationStep_text_image_enable');
if ('Disable' == $section_hide) {
    return;
}
if (get_theme_mod('vw_podcast_pro_insatllationStep_text_image_bgcolor', '')) {
    $per_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_insatllationStep_text_image_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_insatllationStep_text_image_bgimage', '')) {
    $per_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_insatllationStep_text_image_bgimage')) . '\')';
} else {
    $per_back = '';
}
?>
<section class="stepToInstall <?php// echo esc_attr($img_bg); ?> section-space" style="<?php echo esc_attr($per_back); ?>">
    <div class="container">

        <div class="h2">
            <h2><?php echo get_theme_mod('vw_podcast_pro_insatllationStep_heading'); ?></h2>
        </div>
        <p class="heading-description"><?php echo get_theme_mod('vw_podcast_pro_insatllationStep_text'); ?></p>
        <div class="row justify-content-between mt-5 stepsRow">
            <?php
            for ($i = 1; $i <= 4; $i++) {
                $setting_name = 'vw_podcast_pro_installationStep_image' . $i;
                $text_setting_name = 'vw_podcast_pro_installationStep_heading' . $i;

                // Get the values of the settings
                $image_url = get_theme_mod($setting_name);
                $title_text = get_theme_mod($text_setting_name);

                echo '<div class="installation-step-card">';
                echo '<div class="step-number">';
                echo '0'.$i;
                echo '</div>';
                // Output the image field
                echo '<div class="card-image mb-3">';
                if (!empty($image_url)) {
                    echo '<img src="' . esc_url($image_url) . '" alt="Card Image ' . $i . '">';
                }
                echo '</div>';

                // Output the title text field
                echo '<div class="card-title">';
                if (!empty($title_text)) {
                    echo '<h5>' . esc_html($title_text) . '</h5>';
                }
                echo '</div>';

                echo '</div>'; // Close installation-step-card div
            }
            ?>
        </div>
    </div>
   
</section>