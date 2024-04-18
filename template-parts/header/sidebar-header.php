<nav class="main-sidebar">
    <span class="mobile-open">
        <i class="fas fa-chevron-left d-none"></i>
        <i class="fas fa-chevron-right"></i>
    </span>

    <div class="inner-slidbar">
        <div class="vw-logo" id="site-sticky-menu1">
            <?php
            // Set custom logo URL
            
            // Get the custom logo URL
            $logo = get_theme_mod('custom_logo');
            // Check if custom logo is set
            if ($logo != '') {
                // Output the custom logo using vw_podcast_pro_the_custom_logo() function
                vw_podcast_pro_the_custom_logo();
            } else {
                // If no custom logo is set, display default logo or site title and tagline
                ?>

                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/logo.png'; ?>"
                        alt="<?php bloginfo('name'); ?>" /></a>
                <div class="logo-text">
                    <?php if (get_theme_mod('vw_podcast_pro_display_title') != false) { ?>
                        <h2><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php esc_attr(bloginfo('name')); ?></a>
                        </h2>
                    <?php }
                    if (get_theme_mod('vw_podcast_pro_display_tagline') != false) {
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()): ?>
                            <p><?php echo esc_html($description); ?></p>
                        <?php endif;
                    } ?>
                </div>
            <?php } ?>
        </div>
        <?php dynamic_sidebar('main-sidebar'); ?>
    </div>
</nav>