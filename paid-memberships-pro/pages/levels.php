<?php
/**
 * Template: pricing page
 * Version: 2.0
 *
 * See documentation for how to override the PMPro templates.
 * @link https://www.paidmembershipspro.com/documentation/templates/
 *
 * @version 2.0
 *
 * @author Paid Memberships Pro
 */
global $wpdb, $pmpro_msg, $pmpro_msgt, $current_user;

$pmpro_levels = pmpro_sort_levels_by_order(pmpro_getAllLevels(false, true));
$pmpro_levels = apply_filters('pmpro_levels_array', $pmpro_levels);

$user_level = pmpro_getMembershipLevelForUser($current_user->ID);

if ($pmpro_msg) {
	?>
	<div class="<?php echo esc_attr(pmpro_get_element_class('pmpro_message ' . $pmpro_msgt, $pmpro_msgt)); ?>">
		<?php echo wp_kses_post($pmpro_msg); ?>
	</div>
	<?php
}
?>
<div class="<?php echo esc_attr(pmpro_get_element_class('pmpro_levels_wrapper')); ?>">
	<?php
	foreach ($pmpro_levels as $level) {
		$is_current_level = !empty($user_level) && $user_level->id == $level->id;
		?>
		<div
			class="<?php echo esc_attr(pmpro_get_element_class('pmpro_level' . ($is_current_level ? ' active-plan' : ''))); ?>">
			<div class="name-des-wrap">
				<h4>
					<?php echo esc_html($level->name); ?>
				</h4>
				<p class="<?php echo esc_attr(pmpro_get_element_class('pmpro_level_description')); ?>">
					<?php echo esc_html($level->description); ?>
				</p>
			</div>
			<div class="<?php echo esc_attr(pmpro_get_element_class('pmpro_level_details')); ?>">
				<span class="<?php echo esc_attr(pmpro_get_element_class('pmpro_level_expiration')); ?>">
					<?php echo pmpro_getLevelExpiration($level); ?>
				</span>
				<span class="<?php echo esc_attr(pmpro_get_element_class('pmpro_level_cost')); ?>">
					<?php echo pmpro_getLevelCost($level, true, true); ?>
				</span>
				<?php if (empty($user_level) || $user_level->id != $level->id) { ?>
					<input type="radio" name="pmpro_level_id" value="<?php echo esc_attr($level->id); ?>" />
				<?php } ?>
			</div>

		</div>
	<?php } ?>
</div>
<div class="<?php echo esc_attr(pmpro_get_element_class('pmpro_submit_button_wrapper')); ?>">
	<form id="pmpro_form" method="post" action="<?php echo esc_url(pmpro_url("checkout")); ?>">
		<?php wp_nonce_field('pmpro_form', 'pmpro_form_nonce'); ?>
		<input type="submit" name="submit"
			class="<?php echo esc_attr(pmpro_get_element_class('pmpro_btn pmpro_btn-submit')); ?>"
			value="<?php esc_attr_e('Buy Membership', 'paid-memberships-pro'); ?>" />
		<?php if (!is_user_logged_in()) { ?>
			<p>
				<?php esc_html_e('Already a member?', 'paid-memberships-pro'); ?> <a
					href="<?php echo esc_url(wp_login_url()); ?>">
					<?php esc_html_e('Login', 'paid-memberships-pro'); ?>
				</a>
			</p>
		<?php } ?>
	</form>
</div>
