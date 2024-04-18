<?php
$vw_podcast_pro_trending_sec_image_enable = get_theme_mod('vw_podcast_pro_popular_romance_enable');

if ($vw_podcast_pro_trending_sec_image_enable === 'Disable') {
    return;
}
$single_page_link = get_theme_mod('vw_podcast_pro_spanish_show_all_btn_link');

$sec_heading = get_theme_mod('vw_podcast_pro_popular_romanceheading');
$sec_language = get_theme_mod('vw_podcast_pro_popular_romancelanguage');
$lowerCase_secLang = strtolower(str_replace(' ', '', $sec_language));
$single_page_title = get_theme_mod('vw_podcast_pro_romance_show_all_btn_link');
$section_category = get_theme_mod('vw_podcast_pro_romance_category');
$members_only = get_theme_mod('vw_podcast_pro_popular_romance_is_membership');

// Check if the content is premium content
if ($members_only === 'Disable') {
    ?>
    <section class="romance">
        <div class="section-heading">
            <h3>
                <?php echo $sec_heading; ?>
            </h3>
            <div class="show-all">
                <a href="<?php echo $single_page_title; ?>"><?php echo get_theme_mod('vw_podcast_pro_romance_show_all_btn_text'); ?></a>
            </div>
        </div>
        <div class="song-row">
            <?php
            $top_tracks = get_top_played_tracks();
            if ($top_tracks) {
                $i = 1;
                foreach ($top_tracks as $track) {
                    if ($i > 6) {
                        break; // Stop processing tracks if already rendered 6
                    }
                    render_track($track, $lowerCase_secLang, $section_category, $i);
                }
            }
            ?>
        </div>
    </section>
    <?php
} else {
    // Check if the user has any membership level
    if (pmpro_hasMembershipLevel()) {
        ?>
        <section class="romance">
            <div class="section-heading">
                <h3>
                    <?php echo $sec_heading; ?>
                </h3>
                <div class="show-all">
                    <a href="<?php echo get_permalink(get_page_by_title($single_page_title)); ?>">Show All</a>
                </div>
            </div>
            <div class="song-row">
                <?php
                $top_tracks = get_top_played_tracks();
                if ($top_tracks) {
                    $i = 1;
                    foreach ($top_tracks as $track) {
                        if ($i > 6) {
                            break; // Stop processing tracks if already rendered 6
                        }
                        render_track($track, $lowerCase_secLang, $section_category, $i);
                    }
                }
                ?>
            </div>
        </section>

        <?php
    } else {
        render_register_button();
    }
}
?>