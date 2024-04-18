<?php
/**
 * Template Name: Register Page
 */

get_header();

$form_shortcode = get_theme_mod('vw_podcast_pro_for_artist_from_shortcode_text');

?>


<section id="vw-sticky-menu" style="<?php echo $background_setting ?>" class="mt-4">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="header-navigation col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12 p-0">
                <div class="nav-left-wrap">
                    <div class="for-artist-nav">
                        <div class="reg-logo">
                            <img src="<?php echo get_theme_mod('vw_podcast_pro_register_page_image_logo'); ?>"
                                alt="for-artist-logo" titlr="artist logo">
                        </div>
                    </div>
                    <div class="nav-wrap">
                        <div class="home-btn">
                            <a href="<?php echo get_home_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
                        </div>
                        <div class="profile-btn">
                            <a href="<?php echo get_permalink(get_page_by_title('Profile')) ?>"><i class="fa fa-user"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="navigation-search">
                        <form role="search" method="get" class="search-form serach-page"
                            action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="search" class="search-field" placeholder="Search…"
                                value="<?php echo get_search_query(); ?>" name="s" />
                            <button type="submit" class="search-submit d-none"><span
                                    class="screen-reader-text">Search</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 notification-bell">
                <div class="subscribe">
                    subscribe
                </div>
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


<div class="title-box text-center banner-img my-5"
    style="background-image:url(<?php echo esc_url($background_img); ?>)">
    <div class="container p-0">
        <div class="banner-page-text ">
            <div class="row p-0">
                <div class="col-lg-4 col-sm-6 col-6">
                    <div class="above_title">
                        <h1>
                            <?php the_title(); ?>
                        </h1>
                        <?php if (get_theme_mod('vw_podcast_pro_site_breadcrumb_enable', true) != '') { ?>
                            <div class=" bradcrumbs">
                                <?php vw_podcast_pro_the_breadcrumb(); ?>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <div class="col-lg-8">

                </div>
            </div>
        </div>
    </div>
</div>

<section class="bedome-artist mb-5">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-md-12 col-12 artist-left">
                <h1>
                    <?php echo get_theme_mod('vw_podcast_pro_for_artist_heading_span'); ?><br><span>
                        <?php echo get_theme_mod('vw_podcast_pro_for_artist_heading'); ?>
                    </span>
                </h1>
                <p class="heading-tag"><b>
                        <?php echo get_theme_mod('vw_podcast_pro_for_artist_heading_text'); ?>
                    </b></p>
                <p class="heading-text">
                    <?php echo get_theme_mod('vw_podcast_pro_for_artist_heading_text'); ?>
                </p>
                <div class="artist-inner-wrap">
                    <div class="button-wrap">
                        <a href="" class="register-btn">
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_banner_btn'); ?>
                        </a>
                    </div>
                    <div class="inner-text-wrap">
                        <p>
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_register_details'); ?>
                        </p>
                        <small>
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_register_deatils_text'); ?>
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12 artist-right">
                <div class="left-inner">
                    <img src="<?php echo get_theme_mod('vw_podcast_pro_for_artist_banner_image'); ?>"
                        alt="Artist main image" title="Become Artist Image">
                </div>
            </div>
        </div>
    </div>
</section>


<section class="responsive-showcase">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-12 res-left">
                <img src="<?php echo get_theme_mod('vw_podcast_pro_register_artist_right'); ?>"
                    alt="Responsive showcase">
            </div>
            <div class="col-lg-6 col-md-12 col-12 res-right">
                <h2>
                    <?php echo get_theme_mod('vw_podcast_pro_for_artist_res_showcase_heading_text'); ?>
                </h2>
                <p>
                    <?php echo get_theme_mod('vw_podcast_pro_for_artist_res_text_text'); ?>
                </p>
                <a class="register-btn">
                    <?php echo get_theme_mod('vw_podcast_pro_for_artist_res_button_text'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="podcast-from-sec secton-space">
    <div class="container">
        <div class="row p-0">
            <div class="col-lg-6 col-md-12 col-12 form-left">
                <h2>
                    <?php echo get_theme_mod('vw_podcast_pro_for_artist_dorm_sec_text'); ?>
                </h2>
                <p>
                    <?php echo get_theme_mod('vw_podcast_pro_for_artist_from_text_text'); ?>
                <div class="joining-num-wrapper">
                    <div class="joining-num-card">
                        <div class="join-num">
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_from_joining_num'); ?>
                        </div>
                        <div class="number-heading">
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_joining_num_tag'); ?>
                        </div>
                        <p>
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_joining_num_text'); ?>
                        </p>
                    </div>
                    <div class="joining-num-card">
                        <div class="join-num">
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_from_joining_num_2'); ?>
                        </div>
                        <div class="number-heading">
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_joining_num_tag_2'); ?>
                        </div>
                        <p>
                            <?php echo get_theme_mod('vw_podcast_pro_for_artist_joining_num_text'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 form-right">
                <?php echo do_shortcode($form_shortcode); ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/home/section-faq') ?>
<?php get_template_part('template-parts/home/recent-posts') ?>
<?php
get_footer();
?>