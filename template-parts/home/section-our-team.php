<?php
/**
 * Template to show the our team section
 *
 * @package vw_podcast_pro
 */
$section_hide = get_theme_mod('vw_podcast_pro_our_team_enable');
if ('Disable' == $section_hide) {
    return;
}
if (get_theme_mod('vw_podcast_pro_our_team_bgcolor', '')) {
    $per_back = 'background-color:' . esc_attr(get_theme_mod('vw_podcast_pro_our_team_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_podcast_pro_our_team_bgimage', '')) {
    $per_back = 'background-image:url(\'' . esc_url(get_theme_mod('vw_podcast_pro_our_team_bgimage')) . '\')';
} else {
    $per_back = '';
}
// $img_bg = get_theme_mod('vw_podcast_pro_our_team_image');
?>
<section id="Our-team" class="<?php //echo esc_attr($img_bg); ?> section-space"
    style="<?php echo esc_attr($per_back); ?>">
    <div class="container">
        <div class="services heading text-center">
            <div class="h2">
                <h2>
                    <?php echo get_theme_mod('vw_podcast_pro_our_team_heading_font_text'); ?>
                </h2>
            </div>
            <p class="heading-description"><?php echo get_theme_mod('vw_podcast_pro_our_team_para_one'); ?></p>
            <div class="row mt-5">
                <div class="owl-carousel">
                    <?php
                    $args = array(
                        'post_type' => 'our_team',
                        'posts_per_page' => -1,
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()):

                        while ($query->have_posts()):
                            $query->the_post();
                            $designation = get_post_meta(get_the_ID(), '_our_team_designation', true);
                            $facebook = get_post_meta(get_the_ID(), '_our_team_facebook', true);
                            $twitter = get_post_meta(get_the_ID(), '_our_team_twitter', true);
                            $instagram = get_post_meta(get_the_ID(), '_our_team_instagram', true);
                            $whatsapp = get_post_meta(get_the_ID(), '_our_team_whatsapp', true);
                            ?>

                            <div class="team-card">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="team-card-thumbnail">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="card-row mt-4">
                                    <h3>
                                        <?php the_title(); ?>
                                    </h3>

                                    <?php if (!empty($designation)): ?>
                                        <p class="designation">
                                            <?php echo esc_html($designation); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="social-links-wrap">
                                    <div class="social-media-links active">
                                        <?php if (!empty($facebook)): ?>
                                            <a target="_blank" href="<?php echo esc_url($facebook); ?>"><i
                                                    class="<?php echo get_theme_mod('vw_podcast_pro_social_team_icon_1'); ?> align-middle "
                                                    aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                        <?php if (!empty($twitter)): ?>
                                            <a target="_blank" href="<?php echo esc_url($twitter); ?>"><i
                                                    class="<?php echo get_theme_mod('vw_podcast_pro_social_team_icon_2'); ?> align-middle "
                                                    aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                        <?php if (!empty($instagram)): ?>
                                            <a target="_blank" href="<?php echo esc_url($instagram); ?>"><i
                                                    class="<?php echo get_theme_mod('vw_podcast_pro_social_team_icon_3'); ?> align-middle "
                                                    aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                        <?php if (!empty($whatsapp)): ?>
                                            <a target="_blank" href="<?php echo sanitize_text_field($whatsapp); ?>"><i
                                                    class="<?php echo get_theme_mod('vw_podcast_pro_social_team_icon_4'); ?> align-middle "
                                                    aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="get_in_touch">
                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                        Get Touch
                                    </div>
                                </div>
                            </div>
                            

                        <?php endwhile;

                        wp_reset_postdata();
                    else:
                        echo 'No team members found.';
                    endif;
                    ?>


                </div>
            </div>
        </div>
    </div>
</section>