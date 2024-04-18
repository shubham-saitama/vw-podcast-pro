<?php

$header_widgets_section = get_theme_mod('vw_saas_services_pro_header_widgets_enable');
if ('Disable' == $header_widgets_section) {
    return;
}
if (get_theme_mod('vw_saas_services_pro_header_widgets_bgcolor', '')) {
    $background_setting = 'background-color:' . esc_attr(get_theme_mod('vw_saas_services_pro_header_widgets_bgcolor', '')) . ';';
} elseif (get_theme_mod('vw_saas_services_pro_header_bgimage', '')) {
    $background_setting = 'background-image:url(' . esc_attr(get_theme_mod('vw_saas_services_pro_header_bgimage', '')) . ');';
} else {
    $background_setting = '';
}
?>
<section id="vw-sticky-menu" style="<?php echo $background_setting ?>" class="mt-4">
    <div class="">
        <div class="row align-items-center justify-content-between">
            <div class="header-navigation col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12 p-0">
                <div class="nav-left-wrap">
                    <div class="nav-wrap">
                        <div class="navigation-backward">
                            <?php if (function_exists('wp_get_referer')): ?>
                                <a href="<?php echo esc_url(wp_get_referer()); ?>" class="backward-button"><i
                                        class="fa-solid fa-arrow-left"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="navigation-forward">
                            <?php if (function_exists('wp_get_referer')): ?>
                                <a href="<?php echo esc_url(wp_get_referer()); ?>" class="forward-button"><i
                                        class="fa-solid fa-arrow-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="navigation-search">
                        <form role="search" method="get" class="search-form serach-page"
                            action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="search" class="search-field" placeholder="Search…"
                                value="<?php echo get_search_query(); ?>" name="s" />
                            <button type="submit"
                                class="search-submit d-none"><spanclass="screen-reader-text">Search</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 notification-bell">
                <a class="subscribe" href="<?php echo get_permalink(get_page_by_title('Plans')) ?>">subscribe</a>
                <p> <i class="fa fa-bell"
                        aria-hidden="true"></i></p>
                <div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                            <?php
                            $notificationForm = get_theme_mod('vw_podcast_pro_header_notification_link');
                             echo do_shortcode($notificationForm); 
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="toggle-nav mobile-menu">
    <div role="button" on="tap:sidebar1.toggle" tabindex="0" class="hamburger" id="open_nav"><span
            class="screen-reader-text">
            <?php echo esc_html('Menu', 'vw-saas-services-pro'); ?>
        </span>
        <i
            class="<?php echo esc_html(get_theme_mod('vw_saas_services_pro_res_open_menu_icon', 'fas fa-bars')); ?> menu-open"></i>
        <i class="fa fa-times menu-close"></i>
    </div>
</div>
