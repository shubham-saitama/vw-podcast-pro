<?php
/**
 * Template part for displaying FAQ Section
 *
 * @package vw_podcast_pro
 */
$section_hide = get_theme_mod('vw_podcast_pro_faq_sec_enable');
if ('Disable' == $section_hide) {
    return;
}
if (get_theme_mod('vw_podcast_pro_faq_sec_bgcolor', '')) {
    $per_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_faq_sec_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_faq_sec_bgimage', '')) {
    $per_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_faq_sec_bgimage')) . '\')';
} else {
    $per_back = '';
}
// $img_bg = get_theme_mod('vw_podcast_pro_faq_bgimage');
$faqCount = get_theme_mod('vw_podcast_pro_faq_count', 5); // Number of FAQ questions to display
?>
<section id="faq" class="<?php //echo esc_attr($img_bg); ?> section-space" style="<?php echo esc_attr($per_back); ?>">
    <div class="container">
        <div class="row">
            <div class="faq-right col-lg-12 col-md-12 col-12">
                <h3>Faq</h3>
                <div class="accordion-wrapper">
                    <?php
                    for ($i = 1; $i <= $faqCount; $i++) {
                        $faqQuestion = get_theme_mod('vw_podcast_pro_faq_sec_section_' . $i);
                        $faqAnswer = get_theme_mod('vw_podcast_pro_faq_sec_answer_' . $i);
                        ?>

                        <?php
                        if ($faqQuestion && $faqAnswer) {
                            ?>
                            <h6 class="accordion-click">
                                Q:
                                <?php echo esc_html($faqQuestion); ?> <i class="fa-solid fa-chevron-down"></i>
                            </h3>
                            <div class="answer">
                                <?php echo esc_html($faqAnswer); ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
</section>