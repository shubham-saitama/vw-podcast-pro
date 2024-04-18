<?php

$version = "1.2.2";
$theme_name = "VW Podcast Pro";

add_action( 'admin_notices', 'custom_notice' );

	function custom_notice() {
		global $theme_name;
		$request = wp_remote_get('https://vwthemes.com/version/themes/home?theme_name='.$theme_name);
			if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200) {
				$data=wp_remote_retrieve_body($request);
				global $version;
				if($version < $data) {
					echo '<div class="notice is-dismissible error thb_admin_notices">
					<p>There is an update available for the <strong>' . esc_html($theme_name) . '</strong> theme.</p>
					</div>';
				}
			} ?>
	<?php } ?>
