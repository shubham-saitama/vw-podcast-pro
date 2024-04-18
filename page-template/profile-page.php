<?php
/**
 * Template Name: Playlist Page
 */

get_header();

?>
<div class="body-wrapper">
    <?php get_template_part('/template-parts/header/sidebar-header'); ?>
    <div class="main-pageWrap">
        <?php get_template_part('template-parts/home/section-header'); ?>
        <div class="title-box text-center banner-img my-5"
            style="background-image:url(<?php echo esc_url($background_img); ?>)">
            <div class="banner-page-text ">
                <div class="row">
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
        <?php do_action('vw_podcast_pro_after_defaulttitle'); ?>
        <?php
        global $current_user;
        // Get the current user ID
        $current_user_id = get_current_user_id();
        // Get the current user's membership level
        $user_level = pmpro_getMembershipLevelForUser($current_user->ID);
        // Get the user's profile picture (assuming Membership Pro plugin provides a function for this)
        // $profile_picture = membership_pro_get_profile_picture($current_user_id);
        $current_user = wp_get_current_user();

        $avatar_url = get_avatar_url($current_user->ID);


        // Call the function to get the order history for the current user.
        $current_user_order_history = get_current_user_order_history();
        $current_username = $current_user_order_history->$order['member_name'];
        ?>

        <section class="userinfo">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-1 col-md-1 col-12 profile-picture">
                        <img src="<?php echo $avatar_url; ?>" alt="Profile picture" title="Profile Picture">
                    </div>
                    <div class="col-md-10 col-lg-10 col-12 username">
                        <small>Profile</small>
                        <div class="h3">
                            <?php echo $current_username; ?>
                        </div>
                        <div class="button-wrapper-profile">
                            <a class="play-button"
                                href="<?php echo get_permalink(get_page_by_title('Top Playlist')) ?>">
                                Play
                            </a>
                            <a href="<?php echo $edit_profile_url = pmpro_url('member_profile_edit'); ?>"><i
                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="account-info my-5">
            <div class="container-fluid p-0">
                <div class="account-wrap-row">
                    <div class="current-plan">
                        <div class="current-plan-inner">
                            <small>Your Plan</small>
                            <?php if (is_user_logged_in() && function_exists('pmpro_hasMembershipLevel') && pmpro_hasMembershipLevel()) {
                                global $current_user;
                                $current_user->membership_level = pmpro_getMembershipLevelForUser($current_user->ID);
                                ?>
                                <div class="user-current-plan">
                                    <?php echo $current_user->membership_level->name; ?>
                                </div>
                            <?php } ?>
                            <div class="button-holder">
                                <a href="<?php echo esc_url(get_permalink(get_page_by_title('Plans'))); ?>"
                                    class="explore-link">Explore Plans</a>
                            </div>
                        </div>
                    </div>
                    <div class="account-user">
                        <a class="card-plans one"
                            href="<?php echo esc_url(get_permalink(get_page_by_title('Plans'))); ?>">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <span>Plans</span>
                            <div class="arrow-tag">
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </div>
                        </a>
                        <div class="card-plans" id="slider-id">
                            <i class="fa fa-history" aria-hidden="true"></i>
                            <span>Order History</span>
                            <div class="arrow-tag">
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </div>
                            </a>
                            <?php if (!empty($current_user_order_history)) {
                                echo "<table>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Date</th>";
                                echo "<th>Invoice ID</th>";
                                echo "<th>Membership Level</th>";
                                echo "<th>Total Billed</th>";
                                echo "<th>Discount Code</th>";
                                echo "<th>Status</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                foreach ($current_user_order_history as $order) {
                                    echo "<tr>";
                                    echo "<td>" . $order['date'] . "</td>";
                                    echo "<td>" . $order['invoice_id'] . "</td>";
                                    echo "<td>" . $order['level_name'] . "</td>";
                                    echo "<td>" . $order['total_billed'] . "</td>";
                                    echo "<td>" . $order['discount_code'] . "</td>";
                                    echo "<td>" . $order['status'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "No order history available.";
                            } ?>

                        </div>
                    </div>
                </div>

        </section>
        <?php
        get_footer(); ?>

        <?php
        // Check if user is logged in
        if (!is_user_logged_in()) {
            ?>
            <div class="popup-wrapper">
                <div class="login-popup">
                    <?php
                    // User is not logged in
                    echo pmpro_login_form(false, false);
                    ?>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>