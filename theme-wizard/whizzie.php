<?php
/**
 * Wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class ThemeWhizzie
{

	public static $is_valid_key = 'false';
	public static $theme_key = '';

	protected $version = '1.1.0';

	/** @var string Current theme name, used as namespace in actions. */

	protected $theme_name = '';
	protected $theme_title = '';
	protected $plugin_path = '';
	protected $parent_slug = '';

	/** @var string Wizard page slug and title. */
	protected $page_slug = '';
	protected $page_title = '';

	/** @var array Wizard steps set by user. */
	protected $config_steps = array();

	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

	// Where to find the widget.wie file
	protected $widget_file_url = '';

	/**
	 * Constructor
	 *
	 * @param $vw_podcast_pro_config	Our config parameters
	 */
	public function __construct($vw_podcast_pro_config)
	{
		$this->set_vars($vw_podcast_pro_config);
		$this->init();

		include_once (ABSPATH . 'wp-admin/includes/plugin.php');
	}

	public static function get_the_validation_status()
	{
		return get_option('vw_podcast_pro_theme_validation_status');
	}

	public static function set_the_validation_status($is_valid)
	{
		update_option('vw_podcast_pro_theme_validation_status', $is_valid);
	}

	public static function get_the_suspension_status()
	{
		return get_option('vw_podcast_pro_theme_suspension_status');
	}

	public static function set_the_suspension_status($is_suspended)
	{
		update_option('vw_podcast_pro_theme_suspension_status', $is_suspended);
	}

	public static function set_the_theme_key($the_key)
	{
		update_option('vw_pro_theme_key', $the_key);
	}

	public static function remove_the_theme_key()
	{
		delete_option('vw_pro_theme_key');
	}

	public static function get_the_theme_key()
	{
		return get_option('vw_pro_theme_key');
	}

	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $vw_podcast_pro_config	Our config parameters
	 */
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $vw_podcast_pro_pro_config	Our config parameters
	 */
	public function set_vars($vw_podcast_pro_pro_config)
	{

		require_once trailingslashit(WHIZZIE_DIR) . 'tgm/tgm.php';
		require_once trailingslashit(WHIZZIE_DIR) . 'widgets/class-vw-widget-importer.php';

		if (isset($vw_podcast_pro_pro_config['page_slug'])) {
			$this->page_slug = esc_attr($vw_podcast_pro_pro_config['page_slug']);
		}
		if (isset($vw_podcast_pro_pro_config['page_title'])) {
			$this->page_title = esc_attr($vw_podcast_pro_pro_config['page_title']);
		}
		if (isset($vw_podcast_pro_pro_config['steps'])) {
			$this->config_steps = $vw_podcast_pro_pro_config['steps'];
		}

		$this->plugin_path = trailingslashit(dirname(__FILE__));
		$relative_url = str_replace(get_template_directory(), '', $this->plugin_path);
		$this->plugin_url = trailingslashit(get_template_directory_uri() . $relative_url);
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get('Name');
		$this->theme_name = strtolower(preg_replace('#[^a-zA-Z]#', '', $current_theme->get('Name')));
		$this->page_slug = apply_filters($this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-wizard');
		$this->parent_slug = apply_filters($this->theme_name . '_theme_setup_wizard_parent_slug', '');

		$this->widget_file_url = trailingslashit(WHIZZIE_DIR) . 'widgets/vw-podcast-pro.wie';
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init()
	{

		if (class_exists('TGM_Plugin_Activation') && isset($GLOBALS['tgmpa'])) {
			add_action('init', array($this, 'get_tgmpa_instance'), 30);
			add_action('init', array($this, 'set_tgmpa_url'), 40);
		}

		add_action('after_switch_theme', array($this, 'redirect_to_wizard'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('admin_menu', array($this, 'menu_page'));
		add_action('admin_init', array($this, 'get_plugins'), 30);
		add_filter('tgmpa_load', array($this, 'tgmpa_load'), 10, 1);
		add_action('wp_ajax_setup_plugins', array($this, 'setup_plugins'));
		add_action('wp_ajax_setup_widgets', array($this, 'setup_widgets'));

		add_action('wp_ajax_setup_builder', array($this, 'setup_builder'));
		add_action('wp_ajax_wz_install_activate_ibtana', array($this, 'wz_install_activate_ibtana'));

		add_action('wp_ajax_wz_activate_vw_podcast_pro', array($this, 'wz_activate_vw_podcast_pro'));

		add_action('admin_enqueue_scripts', array($this, 'vw_podcast_pro_admin_theme_style'));


	}

	public function redirect_to_wizard()
	{
		global $pagenow;
		if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']) && current_user_can('manage_options')) {
			wp_redirect(admin_url('themes.php?page=' . esc_attr($this->page_slug)));
		}
	}

	public function enqueue_scripts()
	{
		wp_enqueue_style('theme-wizard-style', get_template_directory_uri() . '/theme-wizard/assets/css/theme-wizard-style.css');
		wp_register_script('theme-wizard-script', get_template_directory_uri() . '/theme-wizard/assets/js/theme-wizard-script.js', array('jquery'), time());
		wp_localize_script(
			'theme-wizard-script',
			'vw_podcast_pro_whizzie_params',
			array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'wpnonce' => wp_create_nonce('whizzie_nonce'),
				'verify_text' => esc_html('verifying', 'vw-podcast-pro'),
				'IBTANA_THEME_LICENCE_ENDPOINT' => IBTANA_THEME_LICENCE_ENDPOINT
			)
		);
		wp_enqueue_script('theme-wizard-script');
		wp_enqueue_script('tabs', get_template_directory_uri() . '/theme-wizard/getstarted/js/tab.js');
		wp_enqueue_script('vw-notify-popup', get_template_directory_uri() . '/assets/js/notify.min.js');
	}

	public static function get_instance()
	{
		if (!self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function tgmpa_load($status)
	{
		return is_admin() || current_user_can('install_themes');
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance()
	{
		$this->tgmpa_instance = call_user_func(array(get_class($GLOBALS['tgmpa']), 'get_instance'));
	}

	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url()
	{
		$this->tgmpa_menu_slug = (property_exists($this->tgmpa_instance, 'menu')) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters($this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug);
		$tgmpa_parent_slug = (property_exists($this->tgmpa_instance, 'parent_slug') && $this->tgmpa_instance->parent_slug !== 'themes.php') ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters($this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug);
	}

	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page()
	{
		add_menu_page(esc_html($this->page_title), esc_html($this->page_title), 'manage_options', $this->page_slug, array($this, 'vw_podcast_pro_mostrar_guide'), get_template_directory_uri() . '/theme-wizard/assets/images/admin-menu.svg', 40);
	}

	public function activation_page()
	{
		$theme_key = ThemeWhizzie::get_the_theme_key();
		$validation_status = ThemeWhizzie::get_the_validation_status();
		?>
		<div class="wrap">
			<label>
				<?php esc_html_e('Enter Your Theme License Key:', 'vw-podcast-pro'); ?>
			</label>
			<form id="vw_podcast_pro_license_form">
				<input type="text" name="vw_podcast_pro_license_key" value="<?php echo $theme_key ?>" <?php if ($validation_status === 'true') {
					   echo "disabled";
				   } ?> required placeholder="License Key" />
				<div class="licence-key-button-wrap">
					<button class="button" type="submit" name="button" <?php if ($validation_status === 'true') {
						echo "disabled";
					} ?>>
						<?php if ($validation_status === 'true') {
							?>
							Activated
							<?php
						} else { ?>
							Activate
							<?php
						}
						?>
					</button>

					<?php if ($validation_status === 'true') { ?>
						<button id="change--key" class="button" type="button" name="button">
							Change Key
						</button>
						<div class="next-button">
							<button id="start-now-next" class="button" type="button" name="button"
								onclick="openCity(event, 'demo_offer')">
								Next
							</button>
						</div>
					<?php } ?>
				</div>
			</form>
		</div>
		<?php
	}

	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page()
	{

		tgmpa_load_bulk_installer();

		// install plugins with TGM.
		if (!class_exists('TGM_Plugin_Activation') || !isset($GLOBALS['tgmpa'])) {
			die('Failed to find TGM');
		}
		$url = wp_nonce_url(add_query_arg(array('plugins' => 'go')), 'whizzie-setup');

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys($_POST); // Extra fields to pass to WP_Filesystem.
		if (false === ($creds = request_filesystem_credentials(esc_url_raw($url), $method, false, false, $fields))) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if (!WP_Filesystem($creds)) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials(esc_url_raw($url), $method, true, false, $fields);
			return true;
		}


		/* If we arrive here, we have the filesystem */ ?>
		<div class="wrap">
			<div class="wizard-logo-wrap">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/theme-wizard/assets/images/adminIcon.png'); ?>">
				<span class="wizard-main-title">
					<?php esc_html_e('Welcome to ', 'vw-podcast-pro');
					echo $this->theme_title; ?>
				</span>
			</div>
			<?php echo '<div class="card whizzie-wrap">';
			// The wizard is a list with only one item visible at a time
			$steps = $this->get_steps();
			echo '<ul class="whizzie-menu vw-wizard-menu-page">';
			foreach ($steps as $step) {
				$class = 'step step-' . esc_attr($step['id']);
				echo '<li data-step="' . esc_attr($step['id']) . '" class="' . esc_attr($class) . '" >';
				printf(
					'<span class="wizard-main-title">%s</span>',
					esc_html($step['title'])
				);
				// $content is split into summary and detail
				$content = call_user_func(array($this, $step['view']));
				if (isset($content['summary'])) {
					printf(
						'<div class="summary">%s</div>',
						wp_kses_post($content['summary'])
					);
				}
				if (isset($content['detail'])) {
					// Add a link to see more detail
					printf('<div class="wz-require-plugins">');
					printf(
						'<div class="detail">%s</div>',
						$content['detail'] // Need to escape this
					);
					printf('</div>');
				}

				printf('<div class="wizard-button-wrapper">');
				if (ThemeWhizzie::get_the_validation_status() === 'true') {
					// The next button
					if (isset($step['button_text']) && $step['button_text']) {
						printf(
							'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
							esc_attr($step['callback']),
							esc_attr($step['id']),
							esc_html($step['button_text'])
						);
					}

					if (isset($step['button_text_one'])) {
						printf(
							'<div class="button-wrap button-wrap-one">
	<a href="#" class="button button-primary do-it" data-callback="install_widgets" data-step="widgets"><img src="' . get_template_directory_uri() . '/theme-wizard/assets/images/Customize-Icon.png"></a>
	<p class="demo-type-text">%s</p>
	</div>',
							esc_html($step['button_text_one'])
						);
					}
					if (isset($step['button_text_two'])) {
						printf(
							'<div class="button-wrap button-wrap-two">
	<a href="#" class="button button-primary do-it" data-step="widgets" data-callback="page_builder" id="ibtana_button"><img src="' . get_template_directory_uri() . '/theme-wizard/assets/images/Gutenberg-Icon.png"></a>
	<p class="demo-type-text">%s</p>
	</div>',
							esc_html($step['button_text_two'])
						);
					}

				} else {
					printf(
						'<div class="button-wrap"><a href="#" class="button button-primary key-activation-tab-click">%s</a></div>',
						esc_html(__('Activate Your License', 'vw-podcast-pro'))
					);
				}
				printf('</div>');

				echo '</li>';
			}
			echo '</ul>';
			echo '<ul class="whizzie-nav wizard-icon-nav">';
			$stepI = 1;
			foreach ($steps as $step) {
				$stepAct = ($stepI == 1) ? 1 : 0;
				if (isset($step['icon_url']) && $step['icon_url']) {
					echo '<li class="nav-step-' . esc_attr($step['id']) . '" wizard-steps="step-' . esc_attr($step['id']) . '" data-enable="' . $stepAct . '">
	<img src="' . esc_attr($step['icon_url']) . '">
	</li>';
				}
				$stepI++;
			}
			echo '</ul>';
			?>
			<div class="step-loading"><span class="spinner">
					<img
						src="<?php echo esc_url(get_template_directory_uri() . '/theme-wizard/assets/images/Spinner-Animaion.gif'); ?>">
				</span></div>
			<?php echo '</div>'; ?>

		</div>
	<?php }
	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps()
	{
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id' => 'intro',
				'title' => __('', 'vw-podcast-pro'),
				'icon' => 'dashboard',
				'view' => 'get_step_intro',
				// Callback for content
				'callback' => 'do_next_step',
				// Callback for JS
				'button_text' => __('Start Now', 'vw-podcast-pro'),
				'can_skip' => false,
				// Show a skip button?
				'icon_url' => get_template_directory_uri() . '/theme-wizard/assets/images/Icons-01.svg'
			),
			'plugins' => array(
				'id' => 'plugins',
				'title' => __('Plugins', 'vw-podcast-pro'),
				'icon' => 'admin-plugins',
				'view' => 'get_step_plugins',
				'callback' => 'install_plugins',
				'button_text' => __('Install Plugins', 'vw-podcast-pro'),
				'can_skip' => true,
				'icon_url' => get_template_directory_uri() . '/theme-wizard/assets/images/Icons-02.svg'
			),
			'widgets' => array(
				'id' => 'widgets',
				'title' => __('Customizer', 'vw-podcast-pro'),
				'icon' => 'welcome-widgets-menus',
				'view' => 'get_step_widgets',
				'callback' => 'install_widgets',
				'button_text_one' => __('Click On The Image To Import Customizer Demo', 'vw-podcast-pro'),
				'button_text_two' => __('Click On The Image To Import Gutenberg Block Demo', 'vw-podcast-pro'),
				'can_skip' => true,
				'icon_url' => get_template_directory_uri() . '/theme-wizard/assets/images/Icons-03.svg'
			),

			'done' => array(
				'id' => 'done',
				'title' => __('All Done', 'vw-podcast-pro'),
				'icon' => 'yes',
				'view' => 'get_step_done',
				'callback' => '',
				'icon_url' => get_template_directory_uri() . '/theme-wizard/assets/images/Icons-04.svg'
			)
		);

		// Iterate through each step and replace with dev config values
		if ($dev_steps) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array('title', 'icon', 'button_text', 'can_skip', 'button_text_two');
			foreach ($dev_steps as $dev_step) {
				// We can only proceed if an ID exists and matches one of our IDs
				if (isset($dev_step['id'])) {
					$id = $dev_step['id'];
					if (isset($steps[$id])) {
						foreach ($can_config as $element) {
							if (isset($dev_step[$element])) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/**
	 * Print the content for the intro step
	 */
	public function get_step_intro()
	{ ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Thank you for choosing this ' . $this->theme_title . ' Theme. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.', 'vw-podcast-pro'); ?>
			</p>
			<p>
				<?php esc_html_e('You may even skip the steps and get back to the dashboard if you have no time at the present moment. You can come back any time if you change your mind.', 'vw-podcast-pro'); ?>
			</p>
		</div>
	<?php }

	public function get_step_importer()
	{ ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Thank you for choosing this ' . $this->theme_title . ' Theme. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.', 'vw-podcast-pro'); ?>
			</p>
		</div>
	<?php }
	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	function moveArrayPosition(&$array, $a, $b)
	{
		$p1 = array_splice($array, $a, 1);
		$p2 = array_splice($array, 0, $b);
		$array = array_merge($p2, $p1, $array);
		return $array;
	}
	public function get_step_plugins()
	{
		$plugins = $this->get_plugins();
		$content = array(); ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.', 'pet-care-pro') ?>
			</p>
		</div>
		<?php // The detail element is initially hidden from the user
				$content['detail'] = '<span class="wizard-plugin-count">' . count($plugins['all']) . '</span><ul class="whizzie-do-plugins">';
				// Add each plugin into a list
				$plugins['all'] = $this->moveArrayPosition($plugins['all'], 5, 9);

				foreach ($plugins['all'] as $slug => $plugin) {
					$content['detail'] .= '<li data-slug="' . esc_attr($slug) . '">' . esc_html($plugin['name']) . '<div class="wizard-plugin-title">';

					$content['detail'] .= '<span class="wizard-plugin-status">Installation Required</span><i class="spinner"></i></div></li>';

				}
				$content['detail'] .= '</ul>';

				return $content;
	}


	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets()
	{ ?>
		<div class="summary">
			<p>
				<?php esc_html_e('This theme supports importing the demo content and adding widgets. Get them installed with the below button. Using the Customizer, it is possible to update or even deactivate them', 'vw-podcast-pro'); ?>
			</p>
		</div>
	<?php }


	/**
	 * Print the content for the Design choices for the user
	 */

	public function get_step_design()
	{ ?>

		<div class="ibtana-design-product-row">
		</div>
		<div class="wizard-design-button-wrapper">
			<a href="#" class="button button-primary do-it" data-step="design" id="IbtanaImportButton"
				data-callback="inner_page_builder">Import</a>
		</div>

	<?php }
	/**
	 * Print the content for the final step
	 */
	public function get_step_done()
	{

		?>

		<div class="vw-setup-finish">
			<p>
				<?php echo esc_html('Your demo content has been imported successfully . Click on the finish button for more information.'); ?>
			</p>
			<div class="finish-buttons">
				<a href="<?php echo esc_url(admin_url('/customize.php')); ?>" class="wz-btn-customizer" target="_blank">
					<?php esc_html_e('Customize Your Demo', 'vw-podcast-pro') ?>
				</a>
				<a href="" class="wz-btn-builder" target="_blank">
					<?php esc_html_e('Customize Your Demo', 'vw-podcast-pro'); ?>
				</a>
				<a href="<?php echo esc_url(site_url()); ?>" class="wz-btn-visit-site" target="_blank">
					<?php esc_html_e('Visit Your Site', 'vw-podcast-pro'); ?>
				</a>
			</div>
			<div class="vw-finish-btn">
				<a href="javascript:void(0);" class="button button-primary" onclick="openCity(event, 'theme_info')"
					data-tab="theme_info">Finish</a>
			</div>
		</div>

	<?php }


	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins()
	{

		$instance = call_user_func(array(get_class($GLOBALS['tgmpa']), 'get_instance'));
		$plugins = array(
			'all' => array(),
			'install' => array(),
			'update' => array(),
			'activate' => array()
		);
		foreach ($instance->plugins as $slug => $plugin) {
			if ($instance->is_plugin_active($slug) && false === $instance->does_plugin_have_update($slug)) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if (!$instance->is_plugin_installed($slug)) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if (false !== $instance->does_plugin_have_update($slug)) {
						$plugins['update'][$slug] = $plugin;
					}
					if ($instance->can_plugin_activate($slug)) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	public function setup_plugins()
	{

		if (!check_ajax_referer('whizzie_nonce', 'wpnonce') || empty($_POST['slug'])) {
			wp_send_json_error(array('error' => 1, 'message' => esc_html__('No Slug Found', 'vw-podcast-pro')));
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ($plugins['activate'] as $slug => $plugin) {
			if ($_POST['slug'] == $slug) {
				$json = array(
					'url' => admin_url($this->tgmpa_url),
					'plugin' => array($slug),
					'tgmpa-page' => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce' => wp_create_nonce('bulk-plugins'),
					'action' => 'tgmpa-bulk-activate',
					'action2' => -1,
					'message' => esc_html__('Activating Plugin', 'vw-podcast-pro'),
				);
				break;
			}
		}
		foreach ($plugins['update'] as $slug => $plugin) {
			if ($_POST['slug'] == $slug) {
				$json = array(
					'url' => admin_url($this->tgmpa_url),
					'plugin' => array($slug),
					'tgmpa-page' => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce' => wp_create_nonce('bulk-plugins'),
					'action' => 'tgmpa-bulk-update',
					'action2' => -1,
					'message' => esc_html__('Updating Plugin', 'vw-podcast-pro'),
				);
				break;
			}
		}
		foreach ($plugins['install'] as $slug => $plugin) {
			if ($_POST['slug'] == $slug) {
				$json = array(
					'url' => admin_url($this->tgmpa_url),
					'plugin' => array($slug),
					'tgmpa-page' => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce' => wp_create_nonce('bulk-plugins'),
					'action' => 'tgmpa-bulk-install',
					'action2' => -1,
					'message' => esc_html__('Installing Plugin', 'vw-podcast-pro'),
				);
				break;
			}
		}
		if ($json) {
			$json['hash'] = md5(serialize($json)); // used for checking if duplicates happen, move to next plugin
			wp_send_json($json);
		} else {
			wp_send_json(array('done' => 1, 'message' => esc_html__('Success', 'vw-podcast-pro')));
		}
		exit;
	}

	// ------- Create Nav Menu --------
	public function theme_create_customizer_nav_menu()
	{

		$menuname = 'Primary menu';
		$bpmenulocation = 'primary';
		$menu_exists = wp_get_nav_menu_object($menuname);

		if (!$menu_exists) {
			$menu_id = wp_create_nav_menu($menuname);
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Home'),
					'menu-item-classes' => 'home',
					'menu-item-url' => home_url('/'),
					'menu-item-status' => 'publish'
				)
			);
			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fa fa-home');
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Profile', 'vw-podcast-pro'),
					'menu-item-classes' => 'profile',
					'menu-item-status' => 'publish',
					'menu-item-url' => get_permalink(get_page_by_title('Profile')),
				)
			);
			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fa fa-user');
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Premium', 'vw-podcast-pro'),
					'menu-item-classes' => 'premium',
					'menu-item-status' => 'publish',
					'menu-item-url' => get_permalink(get_page_by_title('Plans')),
				),
			);
			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fa fa-diamond');
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Liked', 'vw-podcast-pro'),
					'menu-item-classes' => 'Liked',
					'menu-item-status' => 'publish',
					'menu-item-url' => get_permalink(get_page_by_title('Liked')),
				),
			);
			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fa fa-heart');
			if (!has_nav_menu($bpmenulocation)) {
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$bpmenulocation] = $menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}
		}
	}
	// }
	// ------- Create Footer Menu --------

	public function theme_create_customizer_footer_services_menu()
	{
		$menuname = 'Artists';
		$bpmenulocation = 'footer1';
		$menu_exists = wp_get_nav_menu_object($menuname);

		if (!$menu_exists) {
			$menu_id = wp_create_nav_menu($menuname);

			// Get all terms from the 'artists' taxonomy
			$artist_terms = get_terms(
				array(
					'taxonomy' => 'artists',
					'hide_empty' => false,
				)
			);

			if (!empty($artist_terms)) {
				foreach ($artist_terms as $term) {
					wp_update_nav_menu_item(
						$menu_id,
						0,
						array(
							'menu-item-title' => $term->name,
							'menu-item-url' => get_term_link($term),
							'menu-item-status' => 'publish',
						)
					);
				}
			}

			if (!has_nav_menu($bpmenulocation)) {
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$bpmenulocation] = $menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}
		}
	}


	public function theme_create_customizer_quick_links_menu()
	{

		$page_names = array('About Us', 'Support', 'Privacy Policies', 'Cookies Policy', 'For Artist', 'Plans', 'Blog', '404');
		$menuname = 'Quick Links';
		$bpmenulocation = 'quick_links';
		$menu_exists = wp_get_nav_menu_object($menuname);

		if (!$menu_exists) {
			$menu_id = wp_create_nav_menu($menuname);

			if (!empty($page_names)) {
				foreach ($page_names as $page_name) {
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_update_nav_menu_item(
							$menu_id,
							0,
							array(
								'menu-item-title' => $page->post_title,
								'menu-item-url' => get_permalink($page),
								'menu-item-status' => 'publish',
							)
						);
					}
				}
			}

			if (!has_nav_menu($bpmenulocation)) {
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$bpmenulocation] = $menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}
		}
	}





	// ------- Create Footer Menu --------
	public function theme_create_customizer_footer_quick_links_menu()
	{
		$menuname = 'Library';
		$bpmenulocation = 'footer2';
		$menu_exists = wp_get_nav_menu_object($menuname);

		if (!$menu_exists) {
			$menu_id = wp_create_nav_menu($menuname);
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('History', 'vw-podcast-pro'),
					'menu-item-classes' => 'page',
					'menu-item-url' => get_permalink(get_page_by_title('History')),
					'menu-item-status' => 'publish'
				)
			);
			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fa fa-history');
			$category = get_term_by('slug', 'songs-cat1', 'song_categories');
			$category_permalink = get_term_link($category);
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Songs', 'vw-podcast-pro'),
					'menu-item-classes' => 'page',
					'menu-item-url' => $category_permalink,
					'menu-item-status' => 'publish'
				)
			);
			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fa fa-music');
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Albums', 'vw-podcast-pro'),
					'menu-item-classes' => 'page',
					'menu-item-url' => get_permalink(get_page_by_title('Album')),
					'menu-item-status' => 'publish'
				)
			);
			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fas fa-compact-disc');

			$song_category = get_term_by('slug', 'songs-cat3', 'song_categories');
			$song_category_permalink = get_term_link($song_category);
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Podcast', 'vw-podcast-pro'),
					'menu-item-classes' => 'page',
					'menu-item-url' => $song_category_permalink,
					'menu-item-status' => 'publish'
				)
			);

			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fas fa-podcast');
			$nav_menu_id = wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Artists', 'vw-podcast-pro'),
					'menu-item-classes' => 'Artist-page',
					'menu-item-url' => get_permalink(get_page_by_title('Artists')),
					'menu-item-status' => 'publish'
				)
			);
			update_post_meta($nav_menu_id, '_menu_item_image_type', 'icon');
			update_post_meta($nav_menu_id, '_menu_image_icon', 'fas fa-microphone');
			if (!has_nav_menu($bpmenulocation)) {
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$bpmenulocation] = $menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}
		}
	}

	public function theme_create_customizer_footer_support_menu()
	{
		$menuname = 'Browse';
		$bpmenulocation = 'footer3';
		$menu_exists = wp_get_nav_menu_object($menuname);

		if (!$menu_exists) {
			$menu_id = wp_create_nav_menu($menuname);
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('New Release', 'vw-podcast-pro'),
					'menu-item-classes' => 'page',
					'menu-item-url' => get_permalink(get_page_by_title('New Release')),
					'menu-item-status' => 'publish'
				)
			);
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Hot Trending', 'vw-podcast-pro'),
					'menu-item-classes' => 'page',
					'menu-item-url' => get_permalink(get_page_by_title('Trending Page')),
					'menu-item-status' => 'publish'
				)
			);
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title' => __('Top Playlists', 'vw-podcast-pro'),
					'menu-item-classes' => 'page',
					'menu-item-url' => get_permalink(get_page_by_title('Top Playlist')),
					'menu-item-status' => 'publish'
				)
			);
			// wp_update_nav_menu_item(
			// 	$menu_id,
			// 	0,
			// 	array(
			// 		'menu-item-title' => __('Top Artist', 'vw-podcast-pro'),
			// 		'menu-item-classes' => 'page',
			// 		'menu-item-url' => get_permalink(get_page_by_title('Orders & Shipping')),
			// 		'menu-item-status' => 'publish'
			// 	)
			// );

			if (!has_nav_menu($bpmenulocation)) {
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$bpmenulocation] = $menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}
		}
	}





	function isAssoc(array $arr)
	{
		if (array() === $arr)
			return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}

	function create_product_attribute_wocommerce()
	{

		$attribute_data = array(
			array(
				'name' => 'Color',
				'type' => 'color',
				'taxonomy' => 'pa_color',
				'data' => array(
					'Metallic Bronze' => '#aa8347',
					'Blue' => '#6b89bb',
					'Silver' => '#959595',
					'Green' => '#83a685'
				)
			)
		);
		$new_attribute_data = array();
		$old_attribute_taxonomies = wc_get_attribute_taxonomies();
		foreach ($attribute_data as $attribute_data_single) {
			$is_attribute_found = false;
			foreach ($old_attribute_taxonomies as $old_attribute_taxonomy) {
				if ($attribute_data_single['type'] === $old_attribute_taxonomy->attribute_type) {
					$is_attribute_found = true;
					break;
				}
			}
			if (!$is_attribute_found) {
				array_push($new_attribute_data, $attribute_data_single);
			}
		}

		foreach ($new_attribute_data as $attribute_single_args) {
			$args = array(
				'name' => __($attribute_single_args['name'], 'vw-podcast-pro'),
				'type' => $attribute_single_args['type'],
				'orderby' => 'menu_order',
				'has_archives' => false,
			);
			$wc_create_attribute = wc_create_attribute($args);

			// if ( taxonomy_exists( $attribute_single_args['taxonomy'] ) ) {
			register_taxonomy($attribute_single_args['taxonomy'], array('product'), array());
			// }

			if (!is_wp_error($wc_create_attribute)) {

				if ((array_keys($attribute_single_args['data']) !== range(0, count($attribute_single_args['data']) - 1))) {
					foreach ($attribute_single_args['data'] as $single_data_key => $single_data) {
						$wp_insert_term = wp_insert_term($single_data_key, $attribute_single_args['taxonomy']);
						if (!is_wp_error($wp_insert_term)) {
							update_term_meta($wp_insert_term['term_id'], 'product_attribute_' . $attribute_single_args['type'], $single_data);
						}
					}
				} else {
					foreach ($attribute_single_args['data'] as $single_data_key => $single_data) {
						wp_insert_term($single_data, $attribute_single_args['taxonomy']);
					}
				}
			}
		}

		// Attribute Creation Code END
	}
	// Attribute Creation Code ENDs




	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function setup_widgets()
	{

		ini_set('upload_max_filesize', '300M');
		ini_set('max_execution_time', '3000');

		// Create a auto listing page and assigned the template start
		$listing_title = 'Auto Listings';
		$listing_page_array = array(
			'post_type' => 'page',
			'post_title' => $listing_title,
			'post_status' => 'publish',
			'post_author' => 1
		);




		set_theme_mod('vw_podcast_pro_inner_page_banner_bgimage', get_template_directory_uri() . '/assets/images/with-banner.png');
		set_theme_mod('vw_podcast_pro_trending_sec_is_membership', 'Disable');
		set_theme_mod('vw_podcast_pro_popular_english_is_membership', 'Disable');
		set_theme_mod('vw_podcast_pro_popular_romance_is_membership', 'Disable');
		set_theme_mod('vw_podcast_pro_popular_spanish_is_membership', 'Disable');

		set_theme_mod('vw_podcast_pro_romance_show_all_btn_link','http://localhost/wordpresstwo/index.php/plans/');

		// vw_title_banner_image_wp_custom_attachment START
		$image_url = get_template_directory_uri() . '/assets/images/with-banner.png';
		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents($image_url);
		$filename = basename($image_url);
		if (wp_mkdir_p($upload_dir['path'])) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}
		file_put_contents($file, $image_data);
		$wp_filetype = wp_check_filetype($filename, null);
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => sanitize_file_name($filename),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment($attachment, $file);
		require_once (ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata($attach_id, $file);
		wp_update_attachment_metadata($attach_id, $attach_data);
		$attachment_url = wp_get_attachment_url($attach_id);
		// vw_title_banner_image_wp_custom_attachment END







		//POST and update the customizer and other related data of VW Video Vlog Pro
		$home_id = '';
		$vw_blog_id = '';
		$page_id = '';
		$contact_id = '';
		// Create a front page and assigned the template
		$home_title = 'Home';
		$home_check = get_page_by_title($home_title);
		$home = array(
			'post_type' => 'page',
			'post_title' => $home_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'home'
		);
		$home_id = wp_insert_post($home);
		//Set the home page template
		add_post_meta($home_id, '_wp_page_template', 'page-template/home-page.php');

		//Set the static front page
		$home = get_page_by_title('Home');
		update_option('page_on_front', $home->ID);
		update_option('show_on_front', 'page');

		//  assign the banner image to the shop page
		$shop_page = get_page_by_title('Shop');
		add_post_meta($shop_page->ID, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		// $listing_page = get_page_by_title('Car Models');
		// add_post_meta( $listing_page->ID, 'vw_title_banner_image_wp_custom_attachment', $attachment_url );

		// Create a blog Blog and assigned the template
		$blog_title = 'Blog';
		$blog_check = get_page_by_title($blog_title);
		$blog = array(
			'post_type' => 'page',
			'post_title' => $blog_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'blog'
		);
		$blog_id = wp_insert_post($blog);

		//Set the blog page template
		add_post_meta($blog_id, '_wp_page_template', 'page-template/blog-fullwidth-extend.php');
		add_post_meta($blog_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
		// add_post_meta( $blog_id, '

		$blog_title = 'Blog Left Sidebar';
		$blog = array(
			'post_type' => 'page',
			'post_title' => $blog_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'blog-left-sidebar'
		);
		$blog_id = wp_insert_post($blog);

		//Set the blog page template
		add_post_meta($blog_id, '_wp_page_template', 'page-template/blog-with-left-sidebar.php');
		add_post_meta($blog_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		$blog_title = 'Blog Right Sidebar';
		$blog = array(
			'post_type' => 'page',
			'post_title' => $blog_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'blog-right-sidebar'
		);
		$blog_id = wp_insert_post($blog);

		//Set the blog page template
		add_post_meta($blog_id, '_wp_page_template', 'page-template/blog-with-left-right-sidebar.php');
		add_post_meta($blog_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		// Create a Pages
		if (get_page_by_title('Page') == NULL) {
			$page_title = 'Page ';
			$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est. laborum.ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

			$page_check = get_page_by_title($page_title);
			$page = array(
				'post_type' => 'page',
				'post_title' => $page_title,
				'post_content' => $content,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug' => 'page'
			);
			$page_id = wp_insert_post($page);
			add_post_meta($page_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
			$page_title = 'Page Left Sidebar';
			$content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.';

			$page_check = get_page_by_title($page_title);
			$vw_page = array(
				'post_type' => 'page',
				'post_title' => $page_title,
				'post_content' => $content,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug' => 'page-left'
			);
			$page_id = wp_insert_post($vw_page);

			//Set the blog page template
			add_post_meta($page_id, '_wp_page_template', 'page-template/page-with-left-sidebar.php');
			add_post_meta($page_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

			$page_title = 'Page Right Sidebar';
			$content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semelTe obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel.';

			$page_check = get_page_by_title($page_title);
			$vw_page = array(
				'post_type' => 'page',
				'post_title' => $page_title,
				'post_content' => $content,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug' => 'page-right'
			);
			$page_id = wp_insert_post($vw_page);

			//Set the blog page template
			add_post_meta($page_id, '_wp_page_template', 'page-template/page-with-right-sidebar.php');
			add_post_meta($page_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
		}
		// Create a contact page and assigned the template
		$contact_title = 'Contact Us';
		$contact_check = get_page_by_title($contact_title);
		$contact = array(
			'post_type' => 'page',
			'post_title' => $contact_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'contact'
		);
		$contact_id = wp_insert_post($contact);


		//Set the blog with right sidebar template
		add_post_meta($contact_id, '_wp_page_template', 'page-template/contact.php');
		add_post_meta($contact_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);


		$services_title = 'Service';
		$services_check = get_page_by_title($services_title);
		$services = array(
			'post_type' => 'page',
			'post_title' => $services_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'servicesPage'
		);
		$services_id = wp_insert_post($services);

		add_post_meta($services_id, '_wp_page_template', '/servicesPage.php');
		add_post_meta($services_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);


		// Create about us page and assign it a template
		$aboutUS_title = 'About US';
		$about_content = "
		
		
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>

<h4>Customer Service And Support</h4>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
</p>

<ol class='about-list'>
<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</li>
<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</li>
<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</li>
</ol>

<h4>Or Pick A Topic:</h4>

<ul class='unorderd-list'>
<li>Advertising on VW Audio Podcast?</li>
<li>Press query?</li>
<li>Applying for a job?</li>
</ul>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magn aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>


<h4>VW Audio Podcast Around The World</h4>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>

<div class='row justify-content-between'>
<div class='col-md-5 col-lg-6 col-12'>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
</div>
<div class='col-md-5 col-lg-6 col-12'>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
</div>
</div>
		
		";
		$aboutUS_check = get_page_by_title($aboutUS_title);

		if (!$aboutUS_check) {
			$aboutUS = array(
				'post_type' => 'page',
				'post_title' => $aboutUS_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => 'about-us', // Use post_name to set the slug
				'post_content' => $about_content,
			);
			$aboutUS_id = wp_insert_post($aboutUS);

			if ($aboutUS_id) {
				add_post_meta($aboutUS_id, '_wp_page_template', 'page-template/about-us.php');
				add_post_meta($aboutUS_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
			}
		}

		// Create Sector1 page and assign it a template
		$sector1_title = 'Human Resources';
		$sector1_check = get_page_by_title($sector1_title);

		if (!$sector1_check) {
			$sector1 = array(
				'post_type' => 'page',
				'post_title' => $sector1_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => 'sector-page' // Use post_name to set the slug
			);
			$sector1_id = wp_insert_post($sector1);

			if ($sector1_id) {
				add_post_meta($sector1_id, '_wp_page_template', 'page-template/sector-page.php');
				add_post_meta($sector1_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
			}
		}
		// Create sector2 page and assign it a template
		$sector2_title = 'E-Commerce';
		$sector2_check = get_page_by_title($sector2_title);

		if (!$sector2_check) {
			$sector2 = array(
				'post_type' => 'page',
				'post_title' => $sector2_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => 'sector-page' // Use post_name to set the slug
			);
			$sector2_id = wp_insert_post($sector2);

			if ($sector2_id) {
				add_post_meta($sector2_id, '_wp_page_template', 'page-template/commerce-page.php');
				add_post_meta($sector2_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
			}
		}
		$sector3_title = 'Finance';
		$sector3_check = get_page_by_title($sector3_title);

		if (!$sector3_check) {
			$sector3 = array(
				'post_type' => 'page',
				'post_title' => $sector3_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => 'sector-page' // Use post_name to set the slug
			);
			$sector3_id = wp_insert_post($sector3);

			if ($sector3_id) {
				add_post_meta($sector3_id, '_wp_page_template', 'page-template/finance-page.php');
				add_post_meta($sector3_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
			}
		}
		$sector4_title = 'Manufacturing';
		$sector4_check = get_page_by_title($sector4_title);

		if (!$sector4_check) {
			$sector4 = array(
				'post_type' => 'page',
				'post_title' => $sector4_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => 'sector-page' // Use post_name to set the slug
			);
			$sector4_id = wp_insert_post($sector4);

			if ($sector4_id) {
				add_post_meta($sector4_id, '_wp_page_template', 'page-template/manufacturing-page.php');
				add_post_meta($sector4_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
			}
		}
		$sector5_title = 'Supply Chain';
		$sector5_check = get_page_by_title($sector5_title);

		if (!$sector5_check) {
			$sector5 = array(
				'post_type' => 'page',
				'post_title' => $sector5_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => 'sector-page' // Use post_name to set the slug
			);
			$sector5_id = wp_insert_post($sector5);

			if ($sector5_id) {
				add_post_meta($sector5_id, '_wp_page_template', 'page-template/supply-chain.php');
				add_post_meta($sector5_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
			}
		}




		// / Create a Terms page and assigned the template





		// Trending Page 

		$Trending = array(
			'post_type' => 'page',
			'post_title' => 'Trending Page',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'trending-page'
		);
		$trending_id = wp_insert_post($Trending);
		add_post_meta($trending_id, '_wp_page_template', 'page-template/trending-songs-template.php');
		add_post_meta($trending_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);


		// Trending Page 

		$Trending_eng = array(
			'post_type' => 'page',
			'post_title' => 'Trendng English Page',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'trending-english-page'
		);
		$trending_eng_id = wp_insert_post($Trending_eng);
		add_post_meta($trending_eng_id, '_wp_page_template', 'page-template/trending-songs-template.php');
		add_post_meta($trending_eng_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);




		// Support page 



		$supportPage_content =
			'
			<h2 class="my-4">How To Get Support?</h2>

			<h4>Dear customers, future customers and Friends!</h4>

			<p>This support interface has all the tools we need to listen to your ideas and help you with your problems. Just choose your Department and write your questions or problems. We love feedback and satisfied customers. We promise that you will get answer for your question in 24 hours, so prepare to get satisfied.</p>

			<hr>

			<h4>If you have product related problem on your site please provide us the following things:</h4>

			<p>This support interface has all the tools we need to listen to your ideas and help you with your problems. Just choose your Department and write your questions or problems. We love feedback and satisfied customers. We promise that you will get answer for your question in 24 hours, so prepare to get satisfied.</p>


			<ul class="half-width">
				<li>Link to your site: To check your site...</li>
				<li>FTP access (optional): Sometimes we can`t solve the problems without it...</li>
				<li>Admin account: To dig in the site more deeply...</li>
				<li>Important: Please sure that you added your domain to our domain list here. We will be priority support for domains which are registered in our domain list.</li>
				<li>Order id: To identify yourself...</li>
				<li>Order id: To identify yourself...</li>
			</ul>

			<hr>

			<h4>How to write a support message?<h4>

			<ul>
				<li>Language: Please write us in the following languages: english.</li>
				<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
			</ul>

			<h2>Contact Us</h2>

			<h4>Lorem Ipsum is simply dummy text of the printing</h4>

			<ul>
				<li>Lorem Ipsum is simply dummy text of the printing</li>
				<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>
			</ul>

			';

		$supportPagec = array(
			'post_type' => 'page',
			'post_content' => $supportPage_content,
			'post_title' => 'Support',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'supportpage'
		);
		$supportPage_id = wp_insert_post($supportPagec);
		add_post_meta($supportPage_id, '_wp_page_template', 'page-template/support-page.php');
		add_post_meta($supportPage_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);



		// History page 

		$song_history = array(
			'post_type' => 'page',
			'post_title' => 'History',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'history-page'
		);
		$song_history_id = wp_insert_post($song_history);
		add_post_meta($song_history_id, '_wp_page_template', 'page-template/history-page.php');
		add_post_meta($song_history_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);


		// Album page
		$song_album = array(
			'post_type' => 'page',
			'post_title' => 'Album',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'albums'
		);
		$song_album_id = wp_insert_post($song_album);
		add_post_meta($song_album_id, '_wp_page_template', '/archive-albums.php');
		add_post_meta($song_album_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		// profile page
		$song_profile = array(
			'post_type' => 'page',
			'post_title' => 'profile',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'profile-page'
		);
		$song_profile_id = wp_insert_post($song_profile);
		add_post_meta($song_profile_id, '_wp_page_template', '/page-template/profile-page.php');
		add_post_meta($song_profile_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		// profile page
		$song_artists = array(
			'post_type' => 'page',
			'post_title' => 'Artists',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'artist-page'
		);
		$song_artists_id = wp_insert_post($song_artists);
		add_post_meta($song_artists_id, '_wp_page_template', '/archive-artists.php');
		add_post_meta($song_artists_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		// profile page
		$song_releases = array(
			'post_type' => 'page',
			'post_title' => 'New Release',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'new-releases'
		);
		$song_releases_id = wp_insert_post($song_releases);
		add_post_meta($song_releases_id, '_wp_page_template', '/archive-albums.php');
		add_post_meta($song_releases_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);
		// profile page

		//  top trending page

		$song_playlist = array(
			'post_type' => 'page',
			'post_title' => 'Top Playlist',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'playlists'
		);
		$song_playlist_id = wp_insert_post($song_playlist);
		add_post_meta($song_playlist_id, '_wp_page_template', '/archive-playlist.php');
		add_post_meta($song_playlist_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		//  Artistis page

		$song_register = array(
			'post_type' => 'page',
			'post_title' => 'For Artist',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'register'
		);
		$song_register_id = wp_insert_post($song_register);
		add_post_meta($song_register_id, '_wp_page_template', '/page-template/register-page.php');
		add_post_meta($song_register_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		$song_register = array(
			'post_type' => 'page',
			'post_title' => 'Liked',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'liked'
		);
		$song_register_id = wp_insert_post($song_register);
		add_post_meta($song_register_id, '_wp_page_template', '/page-template/wishlist-page.php');
		add_post_meta($song_register_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);


		$cookie_content = "
		

<h4 class='first'>Last Updated: [30-10-2022]</h4>

<p>Welcome to [Your Website Name] ('we' 'us', or 'our'). This Cookies Policy is designed to explain how we use cookies and similar tracking technologies on our website, including our podcast and music streaming services.</p>
<h4>What Are Cookies?</h4>
<p>Cookies are small text files that are stored on your device when you visit a website. They serve various purposes, including helping the website function properly, providing a more personalized experience, and gathering information for analytical and marketing purposes.</p>
<h4>How We Use Cookies</h4>
<p><b>We use cookies on our website and related services for the following purposes:</b></p>

<h5>1. Essential Cookies</h5>
<p>These cookies are necessary for the basic functionality of our website and services, such as enabling you to log in and access your account.</p>
<h5>2. Performance and Analytics Cookies</h5>
<p>We use cookies to collect information about how you interact with our website. This helps us improve our website's performance and user experience. The information collected may include:</p>


<ul class='unorderd-list'>
  <li>Pages visited</li>
  <li>Time spent on our website</li>
  <li>Type of browser used</li>
  <li>Time spent on our website</li>
  <li>IP address (anonymized)</li>
  <li>Geographical location (anonymized)</li>
</ul>
<h5>3. Marketing and Advertising Cookies</h5>
<p>We may use cookies for marketing and advertising purposes to personalize the content and ads you see on our website and other platforms. This helps us tailor our offerings to your interests and preferences.</p>
<h5>4. Third-party Cookies</h5>
<p>Some cookies on our website are placed by third-party services and tools. These third-party cookies are subject to their respective privacy policies. We do not have control over the information collected by these cookies.</p>
<h4>Your Cookie Choices</h4>
<p>You can manage and control cookies by adjusting your browser settings. You can choose to accept or reject cookies. Keep in mind that disabling cookies may affect your experience on our website and services.</p>
<h4>Changes to This Policy</h4>
<p>We may update this Cookies Policy from time to time to reflect changes in our use of cookies and related technologies. We encourage you to check this page periodically for updates.</p>
<h4>Contact Us</h4>
<p>If you have any questions or concerns about our Cookies Policy, please contact us at [123Street User Town City USA +12 345678901].</p>

<p><b>By using our website and services, you consent to the use of cookies as described in this policy.</b></p>
<p>Remember to replace [Your Website Name] and [your contact information] with your actual website name and contact details. Additionally, you may want to consult with legal professionals to ensure your Cookies Policy complies with relevant data protection laws and regulations in your jurisdiction.</p>
		";
		$song_cookie = array(
			'post_type' => 'page',
			'post_title' => 'Cookies Policy',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'cookie',
			'post_content' => $cookie_content,
		);
		$song_cookie_id = wp_insert_post($song_cookie);
		add_post_meta($song_cookie_id, '_wp_page_template', '/page-template/about-us.php');
		add_post_meta($song_cookie_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		$Privacy_Policy_content = "

<h4>Last Update On August 30,2023</h4>
<p>VW Audio Podcast (Formerly known as VW Audio Podcast Private Limited and VW Audio Podcast Media Private Limited) and/or its affiliates ('VW Audio Podcast,' the 'Company,' 'we', 'us', and 'our',) respect your privacy and is committed to protecting it through its compliance with its privacy policies. This policy describes:</p>

<ul class='unorderd-list'>
  <li>the types of information that VW Audio Podcast may collect from you when you access or use its websites, applications and other online services (collectively, referred as 'Services'); and</li>
  <li>its practices for collecting, using, maintaining, protecting and disclosing that information.</li>
</ul>

<p>This policy applies only to the information VW Audio Podcast collects through its Services, in email, text and other electronic communications sent through or in connection with its Services.</p>
<p>This policy DOES NOT apply to information that you provide to, or that is collected by, any third-party, such as restaurants at which you make reservations and/or pay through WP Food Services and social networks that you use in connection with its Services. VW Audio Podcast encourages you to consult directly with such third-parties about their privacy practices.</p>
<p>Please read this policy carefully to understand VW Audio Podcast's policies and practices regarding your information and how VW Audio Podcast will treat it. By accessing or using its Services and/or registering for an account with VW Audio Podcast, you agree to this privacy policy and you are consenting to VW Audio Podcast's collection, use, disclosure, retention, and protection of your personal information as described here. If you do not provide the informationVW Audio Podcast requires, VW Audio Podcast may not be able to provide all of its Services to you.</p>
<p>If you reside in a country within the European Union/European Economic Area (EAA), VW Audio Podcast Media Portugal, Unipessoal LDA , located at Avenida 24 de Julho, N 102-E, 1200-870, Lisboa, Portugal, will be the controller of your personal data provided to, or collected by or for, or processed in connection with our Services;</p>
<p>If you reside in a country within the European Union/European Economic Area (EAA), VW Audio Podcast Media Portugal, Unipessoal LDA , located at Avenida 24 de Julho, N 102-E, 1200-870, Lisboa, Portugal, will be the controller of your personal data provided to, or collected by or for, or processed in connection with our Services;</p>

<h4>The information we collect and how we use it</h4>
<p><b>VW Audio Podcast Limited ('Podcast', the 'Company', 'we', 'us', and 'our') collects several types of information from and about users of our Services, including:</b></p>
<ul class='unorderd-list'>
  <li>Your Personal Information('PI') - Personal Information is the information that can be associated with a specific person and could be used to identify that's pecific person whether from that data, or from the data and other information that we have, or is likely to have access to. We do not consider personal information to include information that has been made anonymous or aggregated so that it can no longer be used to identify a specific person, whether in combination with other information or otherwise.</li>
  <li>Information about your internet connection, the equipment you use to access our Services and your usage details.</li>
</ul>
<h4>Information You Provide to Us</h4>
<p>The information we collect on or through our Services may include:</p>
<p><b>Your account information:</b> Your full name, email address, postal code, password and other information you may provide with your account, such as your gender, mobile phone number and website. Your profile picture that will be publicly displayed as part of your account profile. You may optionally provide us with this information through third-party sign-in services such as Facebook and Google Plus. In such cases, we fetch and store whatever information is made available to us by you through these sign-in services.</p>
<p><b>Your preferences :</b>Your preferences and settings such as time zone and language.</p>
<p><b>Your content: </b> Information you provide through our Services, including your reviews, photographs, comments, lists, followers, the users you follow, current and prior restaurant reservation details, food ordering details and history, favorite restaurants, special restaurant requests, contact information of people you add to, or notify of, your restaurant reservations through our Services, names, and other information you provide on our Services, and other information in your account profile.</p>
		";

		$song_privecy_policy = array(
			'post_type' => 'page',
			'post_title' => 'Privacy Policies',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'cookie',
			'post_content' => $Privacy_Policy_content,
		);
		$song_privecy_policy_id = wp_insert_post($song_privecy_policy);
		add_post_meta($song_privecy_policy_id, '_wp_page_template', '/page-template/about-us.php');
		add_post_meta($song_privecy_policy_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);


		$termsConditionPage_content =
			"
			<h2 class='my-4'>I. Acceptance of terms</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<p><b>These Terms are effective for all existing and future Zomato customers, including but without limitation to users having access to 'restaurant business page' to manage their claimed business listings.</b></p>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
			<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
			<ul>
				<li>Clicking to accept or agree to the Terms, where it is made available to you by Zomato in the user interface for any particular Service; or</li>
				<li>Actually using the Services. In this case, you understand and agree that Zomato will treat your use of the Services as acceptance of the Terms from that point onwards.</li>
			</ul>
			<h2 class='my-3'>II. Definitions</h2>
			<h3>Customer</h3>
			<p>'Customer' or 'You' or 'Your' refers to you, as a customer of the Services. A customer is someone who accesses or uses the Services for the purpose of sharing, displaying, hosting, publishing, transacting, or uploading information or views or pictures and includes other persons jointly participating in using the Services including without limitation a user having access to the 'restaurant business page' to manage claimed business listings or otherwise.</p>
			<h3>Customer</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
			<h3>Restaurant(s)</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			<h2 class='mt-3'>III. Eligibility to use the services</h2>
			<ul>
				<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
				<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
			</ul>
			<h2 class='my-3'>IV. Changes to the terms</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
			<h2 class='mb-2'>V. Translation of the terms</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
		";


		$termsConditionPage = array(
			'post_type' => 'page',
			'post_content' => $termsConditionPage_content,
			'post_title' => 'Terms & Condition',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'page'
		);
		$termsConditionPage_id = wp_insert_post($termsConditionPage);
		// add_post_meta($termsConditionPage_id, '_wp_page_template', 'page-template/support-page.php');
		add_post_meta($termsConditionPage_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);




		$menu_title = '2 Columns';
		$content = '[products  columns="2" orderby="date" order="DESC" visibility="visible"]';
		$menu = array(
			'post_type' => 'page',
			'post_title' => $menu_title,
			'post_content' => $content,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'page'
		);
		$menu_id = wp_insert_post($menu);

		//Set the blog with right sidebar template
		add_post_meta($menu_id, '_wp_page_template', 'page-template/2-columns.php');
		add_post_meta($menu_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		// Create a contact page and assigned the template
		$menu_title = '3 Columns';
		$content = '[products  columns="3" orderby="date" order="DESC" visibility="visible"]';
		$menu = array(
			'post_type' => 'page',
			'post_title' => $menu_title,
			'post_content' => $content,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'page'
		);
		$menu_id = wp_insert_post($menu);

		//Set the blog with right sidebar template
		add_post_meta($menu_id, '_wp_page_template', 'page-template/3-columns.php');
		add_post_meta($menu_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		// Create a  page and assigned the template
		$menu_title = '4 Columns';
		$content = '[products  columns="4" orderby="date" order="DESC" visibility="visible"]';
		$menu = array(
			'post_type' => 'page',
			'post_title' => $menu_title,
			'post_content' => $content,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'page'
		);
		$menu_id = wp_insert_post($menu);


		$aboutus_title = 'Sector';
		$aboutus = array(
			'post_type' => 'page',
			'post_title' => $aboutus_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'aboutus'
		);
		$aboutus_id = wp_insert_post($aboutus);

		add_post_meta($aboutus_id, '_wp_page_template', 'page-template/about-us.php');
		add_post_meta($aboutus_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		$getAquote_title = 'Request A Quote';
		$getAquote = array(
			'post_type' => 'page',
			'post_title' => $getAquote_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'getaquote'
		);
		$getAquote_id = wp_insert_post($getAquote);


		add_post_meta($getAquote_id, '_wp_page_template', 'page-template/getAquote.php');
		add_post_meta($getAquote_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);



		$error_title = 'Error 404';
		$error = array(
			'post_type' => 'page',
			'post_title' => $error_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'error-us'
		);
		$error_id = wp_insert_post($error);

		add_post_meta($error_id, '_wp_page_template', '/404.php');
		add_post_meta($error_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		$plans = 'Plans';
		$planPost = array(
			'post_type' => 'page',
			'post_title' => $plans,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'plans',
			'post_content' => '[pmpro_levels]',
		);
		$plan_id = wp_insert_post($planPost);

		add_post_meta($plan_id, '_wp_page_template', '/page-template/pricing-page.php');
		add_post_meta($plan_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);


		$archive_radio = 'Archive Radios';
		$archive_post = array(
			'post_type' => 'page',
			'post_title' => $archive_radio,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'plans',
		);
		$radios_id = wp_insert_post($archive_post);

		add_post_meta($radios_id, '_wp_page_template', '/archive-radios.php');
		add_post_meta($radios_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);

		$archive_chart = 'topCharts';
		$archive_chart_page = array(
			'post_type' => 'page',
			'post_title' => $archive_chart,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'plans',
		);
		$chart_id = wp_insert_post($archive_chart_page);

		add_post_meta($chart_id, '_wp_page_template', '/archive-topCharts.php');
		add_post_meta($chart_id, 'vw_title_banner_image_wp_custom_attachment', $attachment_url);


		// -------------- Section Ordering ---------------

		set_theme_mod('vw_podcast_pro_section_ordering_settings_repeater', 'section-header,section-banner,section-history,section-trending,section-addOne,section-newReleases,section-artists,section-radio,section-addTwo,section-recomemended,section-topChart,section-english,section-addThree,section-pricing,section-romance,section-spanish');
		set_theme_mod('vw_podcast_pro_radio_show_all_btn', 'Archive Radios');
		set_theme_mod('vw_podcast_pro_nreleases_show_all_btn', 'http://localhost/wordpresstwo/index.php/song_categories/songs-cat1/');
		set_theme_mod('vw_podcast_pro_recomm_show_all_btn', 'http://localhost/wordpresstwo/index.php/song_categories/songs-cat1/');




		// topbar

		$topbar_social_icons = array(
			'vwsmp_facebook' => 'https://www.facebook.com/',
			'vwsmp_admin_check_facebook' => '1',
			'vwsmp_twitter' => 'https://www.twitter.com/',
			'vwsmp_admin_check_twitter' => '1',
			'vwsmp_instagram' => 'https://www.instagram.com/',
			'vwsmp_admin_check_instagram' => '1',
			'vwsmp_pinterest' => 'https://www.pinterest.com/',
			'vwsmp_admin_check_pinterest' => '1',
		);

		update_option('vwsmp_options', $topbar_social_icons);

		//Scroll Top
		set_theme_mod('vw_podcast_pro_genral_section_show_scroll_top_icon', 'fas fa-angle-double-up');
		set_theme_mod('vw_podcast_pro_hi_scnd_color', '#ffffff');

		set_theme_mod('vw_podcast_pro_advertisement_sec_image_bgimage_three', get_template_directory_uri() . '/assets/images/ads/add-two-bgimage.png');
		set_theme_mod('vw_podcast_pro_advertisement_two_sec_image_bgimage', get_template_directory_uri() . '/assets/images/ads/add-two-bg.png');

		// For 'vw_podcast_pro_topbar_enable'
		set_theme_mod('vw_podcast_pro_topbar_enable', 'Enable'); // or 'Disable' based on your preference

		// For 'vw_podcast_pro_topbar_bgimage'
		set_theme_mod('vw_podcast_pro_topbar_bgimage', '');

		// For 'vw_logistics_servics_topbar_background_color'
		set_theme_mod('vw_logistics_servics_topbar_background_color', '#000');

		// For 'vw_podcast_pro_header_text_color'
		set_theme_mod('vw_podcast_pro_header_text_color', '#fff');

		// For 'vw_podcast_pro_header_text_font_family'
		set_theme_mod('vw_podcast_pro_header_text_font_family', 'Lato');

		// For 'vw_podcast_pro_header_text_font_size'
		set_theme_mod('vw_podcast_pro_header_text_font_size', '16');

		// For 'vw_podcast_pro_topbar_icon_color'	
		set_theme_mod('vw_podcast_pro_topbar_icon_color', '');

		// For 'vw_podcast_pro_topbar_left_icon_size'
		set_theme_mod('vw_podcast_pro_topbar_left_icon_size', '14');

		// For 'vw_podcast_pro_topbar_left_1'
		set_theme_mod('vw_podcast_pro_topbar_left_1', '4b, Walse Street , USA');
		set_theme_mod('vw_podcast_pro_topbar_left_link_1', 'https://www.google.com/maps/place/4+Wall+St,+New+York,+NY+10005,+USA/@40.707607,-74.0112856,17z/data=!3m1!4b1!4m6!3m5!1s0x89c25a1726a907a7:0xe05c573fc407be98!8m2!3d40.707607!4d-74.0112856!16s%2Fg%2F11f3vdhdfk?entry=ttu');

		// For 'vw_podcast_pro_topbar_left_2'
		set_theme_mod('vw_podcast_pro_topbar_left_2', 'vwtrans@gmail.com');
		set_theme_mod('vw_podcast_pro_topbar_left_link_2', 'mailto:vwtrans@gmail.com');

		// For 'vw_podcast_pro_topbar_left_3'
		set_theme_mod('vw_podcast_pro_topbar_left_3', 'Mon – Sun: 9.00 am – 8.00pm');
		set_theme_mod('vw_podcast_pro_topbar_left_link_3', '');


		set_theme_mod('vw_podcast_pro_topbar_left_icon_1', 'fa fa-map-marker');
		set_theme_mod('vw_podcast_pro_topbar_left_icon_2', 'fa fa-envelope');
		set_theme_mod('vw_podcast_pro_topbar_left_icon_3', 'far fa-clock');
		// For 'vw_podcast_pro_social_icons_1'
		set_theme_mod('vw_podcast_pro_social_icon_1', 'fa-facebook-f');
		set_theme_mod('vw_podcast_pro_social_icon_2', 'fa-brands fa-x-twitter');
		set_theme_mod('vw_podcast_pro_social_icon_3', 'fa-brands fa-github');
		set_theme_mod('vw_podcast_pro_social_icon_4', 'fab fa-linkedin-in');
		set_theme_mod('vw_podcast_pro_social_icon_5', 'fab fa-instagram');

		// For 'vw_podcast_pro_social_icons_link_1'
		set_theme_mod('vw_podcast_pro_social_iconLink_1', 'https://facebook.com/');
		set_theme_mod('vw_podcast_pro_social_iconLink_2', 'https://twitter.com/login?lang=en');
		set_theme_mod('vw_podcast_pro_social_iconLink_3', 'https://www.git.com/');
		set_theme_mod('vw_podcast_pro_social_iconLink_4', 'https://linkedin.com/');
		set_theme_mod('vw_podcast_pro_social_iconLink_5', 'https://instagram.com/');

		set_theme_mod('vw_podcast_pro_header_getQuote_button_text', 'Request Quote');


		// For 'vw_podcast_pro_topbar_icon_size'
		set_theme_mod('vw_podcast_pro_topbar_icon_size', '20');

		// For 'vw_podcast_pro_header_social_icon_color'
		set_theme_mod('vw_podcast_pro_header_social_icon_color', '#fff');


		$pricing_featues = array('Free Ads Music', 'Listen Offline', 'High Quality', 'Android Auto App', 'Unlimited Skips');

		set_theme_mod('vw_podcast_pro_pricing_page_heading', 'Pick your Premium');
		set_theme_mod('vw_podcast_pro_pricing_page_descreption', 'Listen without limits on your phone, speaker, and other devices.');

		for ($i = 1; $i <= 5; $i++) {
			set_theme_mod('vw_podcast_pro_feature_image_' . $i, get_template_directory_uri() . '/assets/images/features/feature' . $i . '.png');
			set_theme_mod('vw_podcast_pro_pricing_page_feature_img_text' . $i, $pricing_featues[$i - 1]);
		}

		set_theme_mod('vw_podcast_pro_advertisement_sec_image_bgimage', get_template_directory_uri() . '/assets/images/ads/waveimagebg.png');
		set_theme_mod('vw_podcast_pro_advertisement_sec_floating_wave_img',get_template_directory_uri() . '/assets/images/ads/waveimage.png');
		/* --------------- songs section ---------------*/

		set_theme_mod('vw_podcast_pro_add_two_sec_ad_small_title', 'Festive Offer');
		set_theme_mod('vw_podcast_pro_add_two_sec_ad_main_title', '4 months of VW Audio Podcast Premium for ₹99');
		set_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_1', 'Ad-free Music');
		set_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_2', 'Offline Playback');
		set_theme_mod('vw_podcast_pro_add_two_sec_ad_feature_text_3', 'Play Everywhere');
		set_theme_mod('vw_podcast_pro_add_two_sec_ad_btn_link', 'http://localhost/wordpresstwo/index.php/plans/');
		set_theme_mod('vw_podcast_pro_add_two_sec_ad_btn_link_2', 'http://localhost/wordpresstwo/index.php/plans/');
		set_theme_mod('vw_podcast_pro_add_two_sec_ad_buttons_text', 'See Other Plans');
		set_theme_mod('vw_podcast_pro_add_two_sec_ad_buttons_text_2', 'Get Start');


		set_theme_mod('vw_podcast_pro_ad_three_heading', 'Go from Artist to Superstar with ArtistOne.');
		set_theme_mod('vw_podcast_pro_ad_three_register_title', 'Free Registration');
		set_theme_mod('vw_podcast_pro_ad_threebutton_title', 'Join Now');
		set_theme_mod('vw_podcast_pro_ad_threebutton_link', 'http://localhost/wordpresstwo/index.php/plans/');
		set_theme_mod('vw_podcast_pro_ad_three_middle_txt', 'All the tools you need to build your following and career on Music Podcast, all in one place.');
		set_theme_mod('vw_podcast_pro_ad_three_section_image', get_template_directory_uri() . "/assets/images/ads/addPeople.png");


		set_theme_mod('vw_podcast_pro_for_artist_heading_span', 'Become');
		set_theme_mod('vw_podcast_pro_for_artist_heading', 'Podcast Artist');
		set_theme_mod('vw_podcast_pro_for_artist_banner_btn', 'Register Now ');
		set_theme_mod('vw_podcast_pro_for_artist_register_details', 'Get Live Your First Podcast/Music');
		set_theme_mod('vw_podcast_pro_for_artist_register_deatils_text', 'Groove to 1 Million Songs from Wherever You Are. Learn more about VW Podcast');
		set_theme_mod('vw_podcast_pro_register_artist_right', get_template_directory_uri() . '/assets/images/right.png');
		set_theme_mod('vw_podcast_pro_for_artist_banner_image', get_template_directory_uri() . '/assets/images/artists-page-img.png');

		set_theme_mod('vw_podcast_pro_for_artist_res_showcase_heading_text', 'Build Your Audience at any stage');
		set_theme_mod('vw_podcast_pro_for_artist_res_text_text', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry`s standard dummy text ever since');
		set_theme_mod('vw_podcast_pro_for_artist_res_button_text', 'See More Features');
		set_theme_mod('vw_podcast_pro_for_artist_dorm_sec_text', 'Get access to VW Podcast for Artists');
		set_theme_mod('vw_podcast_pro_for_artist_from_text_text', 'Getting your music on JioSaavn not only brings you exposure to our user base of millions of passionate listeners, but also earns you proper royalties whenever your music is played.');
		set_theme_mod('vw_podcast_pro_for_artist_from_joining_num', '53+');
		set_theme_mod('vw_podcast_pro_for_artist_from_joining_num_2', '530+');


		set_theme_mod('vw_podcast_pro_for_artist_joining_num_tag', 'Event Winner Artist');
		set_theme_mod('vw_podcast_pro_for_artist_joining_num_tag_2', 'Artist Joined');

		set_theme_mod('vw_podcast_pro_for_artist_joining_num_text', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry`s standard dummy text ever');
		set_theme_mod('vw_podcast_pro_for_artist_joining_num_text_2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry`s standard dummy text ever');
		set_theme_mod('vw_podcast_pro_for_artist_heading_text', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry`s standard dummy text ever since');

		//========================= songs section new category ========================//

		// artists category 
		$artist_cat_array = array();
		$artist_category = array(
			'Justin Rider',
			'John Belle',
			'Alexandre Mark',
			'Angelina Jolie',
			'BD Sheeran',
			'Alina Walker',
		);
		$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

		foreach ($artist_category as $index => $artist_category_name) {
			$inserted_term = wp_insert_term(
				$artist_category_name,
				'artists', // Custom taxonomy name
				array(
					'description' => $content,
					'slug' => 'artist_cat' . ($index + 1), // Corrected index
				)
			);
			// error_log(print_r($inserted_term, true));
			$artist_cat_array[] = $inserted_term['term_id'];
			// error_log(print_r($radio_cat_array, true));
			if (!is_wp_error($inserted_term)) {
				// Array of image URLs corresponding to each category
				$image_urls_by_artist_category = array(
					'Justin Rider' => get_template_directory_uri() . '/assets/images/podcastimage/artist/justinrider.png',
					'John Belle' => get_template_directory_uri() . '/assets/images/podcastimage/artist/johnbelle.png',
					'Alexandre Mark' => get_template_directory_uri() . '/assets/images/podcastimage/artist/alexandremark.png',
					'Angelina Jolie' => get_template_directory_uri() . '/assets/images/podcastimage/artist/angelinajolie.png',
					'BD Sheeran' => get_template_directory_uri() . '/assets/images/podcastimage/artist/bdsheeran.png',
					'Alina Walker' => get_template_directory_uri() . '/assets/images/podcastimage/artist/alinawalker.png',
				);

				$artist_image = $image_urls_by_artist_category[$artist_category_name];

				// Upload and set featured image
				$image_data = file_get_contents($artist_image);
				$image_name = $artist_category_name . $index . '.png';
				$upload_dir = wp_upload_dir();
				$file = $upload_dir['path'] . '/' . $image_name;

				if (wp_mkdir_p($upload_dir['path'])) {
					file_put_contents($file, $image_data);

					$wp_filetype = wp_check_filetype($image_name, null);

					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title' => sanitize_file_name($image_name),
						'post_content' => '',
						'post_status' => 'inherit',
					);

					$attach_id = wp_insert_attachment($attachment, $file);

					require_once (ABSPATH . 'wp-admin/includes/image.php');

					$attach_data = wp_generate_attachment_metadata($attach_id, $file);
					wp_update_attachment_metadata($attach_id, $attach_data);

					$image_url = wp_get_attachment_image_url($attach_id, 'full');

					// Update term meta with the image URL
					update_term_meta($inserted_term['term_id'], 'category_custom_image_url', $image_url);
				}
			}
		}



		// Radio category 

		$radio_cat_array = array();
		$radio_category = array(
			'Love Hits',
			'Radio Hits',
			'Non Stop Party',
			'90s & 2000s Hits',
			'Old Is Gold',
			'Motivation Speech',
		);
		$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

		foreach ($radio_category as $index => $radio_category_name) {
			$inserted_term = wp_insert_term(
				$radio_category_name,
				'radios', // Custom taxonomy name
				array(
					'description' => $content,
					'slug' => 'radio_cat' . ($index + 1), // Corrected index
				)
			);
			$radio_cat_array[] = $inserted_term['term_id'];
			// error_log(print_r($radio_cat_array, true));

			if (!is_wp_error($inserted_term)) {
				// Array of image URLs corresponding to each category
				$image_urls_by_radio_category = array(
					'Love Hits' => get_template_directory_uri() . '/assets/images/podcastimage/radio/lovehits.png',
					'Radio Hits' => get_template_directory_uri() . '/assets/images/podcastimage/radio/radiohits.png',
					'Non Stop Party' => get_template_directory_uri() . '/assets/images/podcastimage/radio/nonstopparty.png',
					'90s & 2000s Hits' => get_template_directory_uri() . '/assets/images/podcastimage/radio/90sand2000shits.png',
					'Old Is Gold' => get_template_directory_uri() . '/assets/images/podcastimage/radio/oldisgold.png',
					'Motivation Speech' => get_template_directory_uri() . '/assets/images/podcastimage/radio/motivationspeech.png',
				);

				$radio_image = $image_urls_by_radio_category[$radio_category_name];

				// Upload and set featured image
				$image_data = file_get_contents($radio_image);
				$image_name = $radio_category_name . $index . '.png';
				$upload_dir = wp_upload_dir();
				$file = $upload_dir['path'] . '/' . $image_name;

				if (wp_mkdir_p($upload_dir['path'])) {
					file_put_contents($file, $image_data);

					$wp_filetype = wp_check_filetype($image_name, null);

					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title' => sanitize_file_name($image_name),
						'post_content' => '',
						'post_status' => 'inherit',
					);

					$attach_id = wp_insert_attachment($attachment, $file);

					require_once (ABSPATH . 'wp-admin/includes/image.php');

					$attach_data = wp_generate_attachment_metadata($attach_id, $file);
					wp_update_attachment_metadata($attach_id, $attach_data);

					$image_url = wp_get_attachment_image_url($attach_id, 'full');

					// Update term meta with the image URL
					update_term_meta($inserted_term['term_id'], 'category_custom_image_url', $image_url);
				}
			}
		}
		$songs_categories = array(
			'Songs',
			'Audiobook',
			'Podcast',
			'Speech and Lecture',
			'Radio',
			'Religious and Spiritual',
			'Instrumentals',
			'Live Recordings'
		);

		$j = 1;

		foreach ($songs_categories as $index => $songs_category_name) {

			// Insert songs post categories
			$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
			$parent_category = wp_insert_term(
				$songs_category_name,
				'song_categories', // Custom taxonomy name
				array(
					'description' => $content,
					'slug' => 'songs-cat' . ($index + 1), // Corrected index
				)
			);

			// error_log('category obj: ' . $parent_category['term_id']);
			// Array of image URLs corresponding to each category
			$image_urls_by_category = array(
				'Songs' => get_template_directory_uri() . '/assets/images/categories/songs.png',
				'Audiobook' => get_template_directory_uri() . '/assets/images/categories/audiobooks.png',
				'Podcast' => get_template_directory_uri() . '/assets/images/categories/podcast.png',
				'Speech and Lecture' => get_template_directory_uri() . '/assets/images/categories/Speechandlecture.png',
				'Radio' => get_template_directory_uri() . '/assets/images/categories/radio.png',
				'Religious and Spiritual' => get_template_directory_uri() . '/assets/images/categories/religiousandSpiritual.png',
				'Instrumentals' => get_template_directory_uri() . '/assets/images/categories/instrumentals.png',
				'Live Recordings' => get_template_directory_uri() . '/assets/images/categories/liverecodings.png',
			);

			$image_url = $image_urls_by_category[$songs_category_name];

			// Upload and set featured image
			$image_name = $songs_category_name . $j . '.png';
			$upload_dir = wp_upload_dir();

			$image_data = file_get_contents($image_url);
			$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name);
			$filename = basename($unique_file_name);

			if (wp_mkdir_p($upload_dir['path'])) {
				$file = $upload_dir['path'] . '/' . $filename;
			} else {
				$file = $upload_dir['basedir'] . '/' . $filename;
			}

			file_put_contents($file, $image_data);

			$wp_filetype = wp_check_filetype($filename, null);

			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_type' => 'attachment',
				'post_status' => 'inherit',
			);

			$attach_id = wp_insert_attachment($attachment, $file);

			require_once (ABSPATH . 'wp-admin/includes/image.php');

			$attach_data = wp_generate_attachment_metadata($attach_id, $file);

			wp_update_attachment_metadata($attach_id, $attach_data);

			$image_url = wp_get_attachment_image_url($attach_id, 'full');

			$result = update_term_meta($parent_category['term_id'], 'term_image', $image_url);

			// Create songs posts for each category
			$post_titles_by_category = array(
				'Songs' => array(
					"Neon Dreams",
					"Moonlit Serenade",
					"Echoes of Eternity",
					"Electric Dreams",
					"Oceanic Whispers",
					"Midnight Symphony",
					"Stardust Lullaby",
					"Celestial Harmony",
					"Infinite Melody",
					"Galactic Groove",
					"Starlight Sonata",
					"Aurora Borealis",
					"Dreamscape Melodies",
					"Twilight Tango",
					"Sapphire Serenade",
					"Enchanted Echo",
					"Whispering Winds",
					"Eternal Embrace",
					"Radiant Reverie",
				),
				'Audiobook' => array(
					"The Enigma of Epsilon",
					"Echoes from the Void",
					"Whispers of the Past",
				),
				'Podcast' => array(
					"Beyond the Echo",
					"The Cosmic Connection",
				),
				'Speech and Lecture' => array(
					"The Power of Perspective",
					"Unlocking Creativity",
					"Exploring the Depths of the Mind",
				),
				'Radio' => array(
					"Love Hits",
					"Romantic Songs",
					"90s & 2000s Hits",
				),
				'Religious and Spiritual' => array(
					"Divine Wisdom Hour",
					"Soulful Sermons",
				),
				'Instrumentals' => array(
					'Mistakes You Might Be Making With Your Watch1',
					'Mistakes You Might Be Making With Your Watch2',
					// 'Mistakes You Might Be Making With Your Watch3',
				),
				'Live Recordings' => array(
					"Live from the Cosmos",
					"Unplugged Sessions",

				)
			);
			$post_titles = $post_titles_by_category[$songs_category_name];
			$num_categories = count($radio_cat_array);
			$artist_cat_len = count($artist_cat_array);
			$language = array('Spanish', 'English', 'Hindi');
			for ($i = 0; $i < count($post_titles); $i++) {

				$songs_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

				$songs_post = array(
					'post_title' => wp_strip_all_tags($post_titles[$i]),
					'post_content' => $songs_content,
					'post_status' => 'publish',
					'post_type' => 'songs',
				);

				$songs_post_id = wp_insert_post($songs_post);
				$category_index = ($i - 1) % $num_categories;
				$artist_category_index = ($i - 1) % $artist_cat_len;
				$lang_index = ($i - 1) % 3;

				// Check if post insertion was successful
				if ($songs_post_id) {
					// assgin language meta to the songs 
					update_post_meta($songs_post_id, 'language', $language[$lang_index]);
					// Assign categories to the post
					$category_ids = array($parent_category['term_id']); // Assuming $parent_category['term_id'] contains the category ID
					wp_set_post_terms($songs_post_id, $category_ids, 'song_categories');
					if ($songs_category_name === 'Songs') {
						wp_set_post_terms($songs_post_id, $radio_cat_array[$category_index], 'radios');
						wp_set_post_terms($songs_post_id, $artist_cat_array[$artist_category_index], 'artists');
					}
					// Check if categories were assigned successfully
					$assigned_categories = wp_get_post_categories($songs_post_id);
				} else {
					error_log('Failed to insert post.');
				}
				// Get the filesystem path to the theme directory
				$theme_directory = get_template_directory();
				// Construct the local filesystem path to the MP3 file
				$song_path = $theme_directory . '/assets/audio/' . strtolower(str_replace(' ', '', $post_titles[$i])) . '.mp3';
				error_log('song_path=========>' . $song_path);
				// Upload and set featured image
				$song_name = strtolower(str_replace(' ', '', $post_titles[$i])) . '.mp3';

				$upload_dir = wp_upload_dir();

				$image_data = file_get_contents($song_path);
				$unique_file_name = wp_unique_filename($upload_dir['path'], $song_name);
				$filename = basename($unique_file_name);

				if (wp_mkdir_p($upload_dir['path'])) {
					$file = $upload_dir['path'] . '/' . $filename;
				} else {
					$file = $upload_dir['basedir'] . '/' . $filename;
				}

				file_put_contents($file, $image_data);

				$wp_filetype = wp_check_filetype($filename, null);

				$song_attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name($filename),
					'post_content' => '',
					'post_type' => 'attachment',
					'post_status' => 'inherit',
				);

				$song_attach_id = wp_insert_attachment($song_attachment, $file);

				require_once (ABSPATH . 'wp-admin/includes/image.php');

				$song_attach_data = wp_generate_attachment_metadata($song_attach_id, $file);

				wp_update_attachment_metadata($song_attach_id, $song_attach_data);
				$song_attachment_url = wp_get_attachment_url($song_attach_id);
				update_post_meta($songs_post_id, 'song_mp3_file', $song_attachment_url);

				$current_cat = str_replace(' ', '', $songs_category_name);
				// error_log('current cat=========>' . $current_cat);
				$image_url = get_template_directory_uri() . '/assets/images/categories/' . strtolower($current_cat) . '/' . strtolower($current_cat . $i) . '.png';

				// Upload and set featured image
				$image_name = $songs_category_name . $i . '.png';
				$upload_dir = wp_upload_dir();
				$image_data = file_get_contents($image_url);


				$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name);
				$filename = basename($unique_file_name);

				if (wp_mkdir_p($upload_dir['path'])) {
					$file = $upload_dir['path'] . '/' . $filename;
				} else {
					$file = $upload_dir['basedir'] . '/' . $filename;
				}

				file_put_contents($file, $image_data);

				$wp_filetype = wp_check_filetype($filename, null);

				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name($filename),
					'post_content' => '',
					'post_type' => 'attachment',
					'post_status' => 'inherit',
				);

				$attach_id = wp_insert_attachment($attachment, $file);

				require_once (ABSPATH . 'wp-admin/includes/image.php');

				$attach_data = wp_generate_attachment_metadata($attach_id, $file);

				wp_update_attachment_metadata($attach_id, $attach_data);

				set_post_thumbnail($songs_post_id, $attach_id);
			}
			$j++;
		}
		// add one section 
		set_theme_mod('vw_podcast_pro_advertisement_section_vs_text_btn', 'vs');
		set_theme_mod('vw_podcast_pro_section_event_name', 'ABC Mens Cricket Workld Cup');
		set_theme_mod('vw_podcast_pro_section_event_desc', 'Friday 20 Oct, 2023');
		set_theme_mod('vw_podcast_pro_section_team_name_1', 'Indiana');
		set_theme_mod('vw_podcast_pro_section_team_name_2', 'Western Indiana');
		set_theme_mod('vw_podcast_pro_section_add_timer', '2h 45m 30s');
		set_theme_mod('vw_podcast_pro_section_add_button', 'Listen Now');
		set_theme_mod('vw_podcast_pro_section_add_text', 'Commentary');
		set_theme_mod('vw_podcast_pro_section_add_button_link', 'http://localhost/wordpresstwo/index.php/plans/');
		set_theme_mod('vw_podcast_pro_section_cup_title', 'World Cup Sports');
		set_theme_mod('vw_podcast_pro_artist_show_all_btn', 'http://localhost/wordpresstwo/index.php/artists/');
		set_theme_mod('vw_podcast_pro_radio_show_all_btn', 'Archive Radios');
		set_theme_mod('vw_podcast_pro_top_chart_section_show_all_btn', 'topCharts');
		set_theme_mod('vw_podcast_pro_register_page_image_logo', get_template_directory_uri() . '/assets/images/register-logo.png');
		set_theme_mod('vw_podcast_pro_english_show_all_btn', 'http://localhost/wordpresstwo/index.php/song_categories/songs-cat1/');
		set_theme_mod('vw_podcast_pro_romance_show_all_btn_link', 'http://localhost/wordpresstwo/index.php/song_categories/songs-cat1/');
		set_theme_mod('vw_podcast_pro_spanish_show_all_btn', 'http://localhost/wordpresstwo/index.php/song_categories/songs-cat1//');
		set_theme_mod('vw_podcast_pro_trending_show_all_btn_link', 'http://localhost/wordpresstwo/index.php/song_categories/songs-cat1/');
		
		set_theme_mod('vw_podcast_pro_popular_team_image_1', get_template_directory_uri() . '/assets/images/ads/player1.png');
		set_theme_mod('vw_podcast_pro_popular_team_image_2', get_template_directory_uri() . '/assets/images/ads/plyer2.png');
		set_theme_mod('vw_podcast_pro_popular_cup_image', get_template_directory_uri() . '/assets/images/ads/trophy.png');
		
		set_theme_mod('vw_podcast_pro_romance_show_all_btn_text','See All');
		set_theme_mod('vw_podcast_pro_nreleases_show_all_text','See All');
		set_theme_mod('vw_podcast_pro_artist_show_all_text','See All');
		set_theme_mod('vw_podcast_pro_radio_show_all_text','See All');
		set_theme_mod('vw_podcast_pro_recomm_show_all_text','See All');
		set_theme_mod('vw_podcast_pro_top_chart_section_show_all_text','See All');
		set_theme_mod('vw_podcast_pro_trending_show_all_btn_text','See All');
		set_theme_mod('vw_podcast_pro_spanish_show_all_btn_text','See All');

		// FAQ Section 	
		

		// Set suitable values using set_theme_mod function

		// Enable/Disable Section
		set_theme_mod('vw_podcast_pro_faq_enable', 'Enable');

		// Background Color
		set_theme_mod('vw_podcast_pro_faq_bgcolor', '#FFFFFF');

		// Background Image
		set_theme_mod('vw_podcast_pro_faq_bgimage', '');
		// Background Image Attachment
		set_theme_mod('vw_podcast_pro_faq_bgimage_setting', 'vw-fixed');

		// Heading Tagline
		set_theme_mod('vw_podcast_pro_faq_heading_tagline', 'FAQ`s');
		set_theme_mod('vw_podcast_pro_faq_sec_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
		// Section Heading
		set_theme_mod('vw_podcast_pro_faq_sec_heading', 'Frequently Asked Questions');
		set_theme_mod('vw_podcast_pro_dropdown_icon_setting', 'fas fa-chevron-down');

		// Service Attribute 1
		set_theme_mod('vw_podcast_pro_faq_service_attribute1_title', 'Reliable & Trustworthy');
		set_theme_mod('vw_podcast_pro_faq_service_attribute1_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua');

		// Service Attribute 1 Icon
		set_theme_mod('vw_podcast_pro_faq_service_attribute1_icon', get_template_directory_uri() . '/assets/images/Faq-icon.png');

		// Service Attribute 2
		set_theme_mod('vw_podcast_pro_faq_service_attribute2_title', 'High Quality Material');
		set_theme_mod('vw_podcast_pro_faq_service_attribute2_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua');

		// Service Attribute 2 Icon
		set_theme_mod('vw_podcast_pro_faq_service_attribute2_icon', get_template_directory_uri() . '/assets/images/faq-icon2.png');

		// Number of Questions to Add
		set_theme_mod('vw_podcast_pro_faq_count', '5');

		// Questions and Answers
		for ($i = 1; $i <= 5; $i++) {
			set_theme_mod('vw_podcast_pro_faq_sec_section_1', 'May I have to pay monthly or yearly for Sales Software?');
			set_theme_mod('vw_podcast_pro_faq_sec_section_2', 'Lorem Ipsum is simply dummy text of the printing?');
			set_theme_mod('vw_podcast_pro_faq_sec_section_3', 'May I get the sales report in PDF format ?');
			set_theme_mod('vw_podcast_pro_faq_sec_section_4', 'May I use the same software from different devices simultaneously ?');
			set_theme_mod('vw_podcast_pro_faq_sec_section_5', 'May I also use the Android app on the local server also?');
			set_theme_mod('vw_podcast_pro_faq_sec_answer_' . $i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua' . $i);
		}
		// FAQ Section end 



		// Team social Icons 
		set_theme_mod('vw_podcast_pro_social_team_icon_1', 'fa fa-facebook ');
		set_theme_mod('vw_podcast_pro_social_team_icon_2', 'fa-brands fa-x-twitter');
		set_theme_mod('vw_podcast_pro_social_team_icon_3', 'fa-brands fa-github');
		set_theme_mod('vw_podcast_pro_social_team_icon_4', 'fa fa-youtube-play');




		// about us page ends



		// Sector page 
		// Set values for theme mods

		// Sector Page Section
		set_theme_mod('vw_podcast_pro_aboutus_inner_bgcolor', '');
		set_theme_mod('vw_podcast_pro_aboutus_inner_bgimage', '');
		set_theme_mod('vw_podcast_pro_aboutus_inner_bg_attachment', 'vw-scroll');

		// Our Mission Section
		set_theme_mod('vw_podcast_pro_aboutus_inner_mission_img', get_template_directory_uri() . '/assets/images/AboutUs/InnerPage/our-mission.png');
		set_theme_mod('vw_podcast_pro_mission_heading', 'Our Mission Is To Give You Good Service');
		set_theme_mod('vw_podcast_pro_mission_bold_text', 'to deliver unparalleled service excellence that sets new standards in your experience with us.');
		set_theme_mod('vw_podcast_pro_mission_text', 'Our mission is to give you good service. At the core of our existence, we are driven by the unwavering commitment to provide you with the best possible experience. Every day, our dedicated team works tirelessly to ensure that you receive not just service but exceptional service that exceeds your expectations. We understand that your satisfaction is the measure of our success, and it fuels our determination to continuously improve and innovate. ');

		// The Best Section
		set_theme_mod('vw_podcast_pro_aboutus_inner_best_bgimg', get_template_directory_uri() . '/assets/images/AboutUs/InnerPage/bg.png');
		set_theme_mod('vw_podcast_pro_aboutus_inner_best_img', get_template_directory_uri() . '/assets/images/AboutUs/InnerPage/ment.png');
		set_theme_mod('vw_podcast_pro_best_heading_tagline', 'Why We Are Best');
		set_theme_mod('vw_podcast_pro_best_heading', 'A Few Reasons Choose Us Protect Yourself');
		set_theme_mod('vw_podcast_pro_best_text', 'Happy Clients with Trust Score 4.7/5 (Based on 1,200 reviews).');

		// The Brand Section
		set_theme_mod('vw_podcast_pro_brand_heading', 'The Trucking Brand');
		set_theme_mod('vw_podcast_pro_brand_text', 'What sets Truking apart from its competitors is its relentless pursuit of excellence. Truking`s vehicles are renowned for their durability, efficiency, and cutting-edge technology. The brand`s commitment to research and development has resulted in a range of products that cater to a diverse spectrum of industries, from logistics and transportation to construction.');
		set_theme_mod('vw_podcast_pro_about_inner_brand_list', 'Link to your site: To check your site...');
		set_theme_mod('vw_podcast_pro_brand_image', get_template_directory_uri() . '/assets/images/AboutUs/InnerPage/truckingimage.png');
		// For 'vw_podcast_pro_brand_list_length'
		set_theme_mod('vw_podcast_pro_brand_list_length', '3');

		$licount = get_theme_mod('vw_podcast_pro_brand_list_length');


		// For 'vw_podcast_pro_brand_list_' . $i
		set_theme_mod('vw_podcast_pro_brand_list_1', 'A Legacy of Innovation');
		set_theme_mod('vw_podcast_pro_brand_list_2', 'Global Reach and Local Expertise');
		set_theme_mod('vw_podcast_pro_brand_list_3', 'Sustainability and Responsibility');




		// Security Section
		set_theme_mod('vw_podcast_pro_security_heading', 'Safety And Security');
		set_theme_mod('vw_podcast_pro_security_text', 'Safety and security are paramount concerns for any transport site, whether it`s a transportation hub, a bus terminal, a train station, an airport, or even a shipping port. Ensuring the safety and security of passengers, employees, and infrastructure is crucial to providing a reliable and trustworthy transportation service. ');
		set_theme_mod('vw_podcast_pro_security1_text', 'Describe the use of advanced surveillance cameras and monitoring systems to keep a close watch on all areas of the transport site.');
		set_theme_mod('vw_podcast_pro_security_image', get_template_directory_uri() . '/assets/images/AboutUs/InnerPage/SAVE.png');

		// Client and Partners Section
		set_theme_mod('vw_podcast_pro_client_heading', 'Client & Partners');
		set_theme_mod('vw_podcast_pro_client_length', '4');

		for ($i = 1; $i <= 4; $i++) {
			set_theme_mod('vw_podcast_pro_client_image' . $i, get_template_directory_uri() . '/assets/images/AboutUs/InnerPage/client' . $i . '.png');
		}

		// Distrubution Overview Section
		for ($i = 1; $i <= 4; $i++) {
			set_theme_mod('vw_podcast_pro_overview_image' . $i, get_template_directory_uri() . '/assets/images/AboutUs/package-box-' . $i . '.png');

		}
		set_theme_mod('vw_podcast_pro_overview_count1', '55,555');
		set_theme_mod('vw_podcast_pro_overview_count2', '7,000');
		set_theme_mod('vw_podcast_pro_overview_count3', '9,500');
		set_theme_mod('vw_podcast_pro_overview_count4', '12,000');




		set_theme_mod('vw_podcast_pro_overview_title1', 'Delivered packages');
		set_theme_mod('vw_podcast_pro_overview_title2', 'Tons of goods');
		set_theme_mod('vw_podcast_pro_overview_title3', 'Countries covered');
		set_theme_mod('vw_podcast_pro_overview_title4', 'Satisfied Clients');
		$link_arrray = array('https://facebook.com', 'https://twitter.com/', 'https://www.instagram.com/', 'https://youtube.com/', 'https://www.linkedin.com');
		for ($i = 1; $i <= 5; $i++) {
			set_theme_mod('vw_podcast_pro_footer_social_icons_image_link' . $i, $link_arrray[$i - 1]); // icon link
		}
		$iconArray = array('fa-facebook-f', 'fa-brands fa-x-twitter', 'fab fa-instagram','fa fa-youtube-play', 'fab fa-linkedin-in');
		for ($i = 1; $i <= 5; $i++) {
			// Set the text input value using set_theme_mod
			set_theme_mod('vw_podcast_pro_vision_footer_social_icons' . $i, $iconArray[$i - 1]);
		}









		set_theme_mod('vw_podcast_pro_quote_page_image', get_template_directory_uri() . '/assets/images/quote.png');


		// Support page 	

		// For 'vw_podcast_pro_contactus_page_bgcolor'
		set_theme_mod('vw_podcast_pro_contactus_page_bgcolor', '');

		// For 'vw_podcast_pro_contactus_page_bgimage'
		set_theme_mod('vw_podcast_pro_contactus_page_bgimage', '');

		// For 'vw_podcast_pro_contactus_page_bg_attachment'
		set_theme_mod('vw_podcast_pro_contactus_page_bg_attachment', '');

		// For 'vw_podcast_pro_contactus_contact_sectionheading'
		set_theme_mod('vw_podcast_pro_contactus_contact_sectionheading', 'Contact Information');

		// For 'vw_podcast_pro_contactus_contact_section_desc'
		set_theme_mod('vw_podcast_pro_contactus_contact_section_desc', 'Fill up the contact form and our team will get back in touch with you within 24 hours.');

		// For 'vw_podcast_pro_contactus_location_bg_image'
		set_theme_mod('vw_podcast_pro_contactus_location_bg_image', get_template_directory_uri() . '/assets/images/Contactbgimages.png');

		// For 'vw_podcast_pro_contactus_latitude'
		set_theme_mod('vw_podcast_pro_contactus_latitude', '21.1458');

		// For 'vw_podcast_pro_contactus_longitude'
		set_theme_mod('vw_podcast_pro_contactus_longitude', '79.0882');



		$cf7title = "Contact Us Form";
		$cf7content = '
		<div class="row">
		<div class="input-wrapper">
			[text* name class:Name placeholder "Enter Your Name"]
		</div>
		<div class="input-wrapper">
			[tel* Phone-number class:PhoneNumber placeholder "Phone Number"]
		</div>
		<div class="input-wrapper">
			[email* Email class:Email placeholder "Enter Your Email"]
		</div>
		<div class="input-wrapper">
			[textarea* Message class:Message placeholder "Message"]
		</div>
		<div class="input-wrapper">
			[submit class:submit id:submit-button "Submit"]
		</div>
	</div>
	[_site_title] "[your-subject]"
	[_site_title] <abc@gmail.com>
	From: [your-name] <[your-email]>
	Subject: [your-subject]

	Message Body:
	[your-message]

	--
	This e-mail was sent from a contact form on [_site_title] ([_site_url])
	[_site_admin_email]
	Reply-To: [your-email]

	0
	0

	[_site_title] "[your-subject]"
	[_site_title] <abc@gmail.com>
	Message Body:
	[your-message]

	--
	This e-mail was sent from a contact form on [_site_title] ([_site_url])
	[your-email]
	Reply-To: [_site_admin_email]

	0
	0
	Thank you for your message. It has been sent.
	There was an error trying to send your message. Please try again later.
	One or more fields have an error. Please check and try again.
	There was an error trying to send your message. Please try again later.
	You must accept the terms and conditions before sending your message.
	The field is required.
	The field is too long.
	The field is too short.
	There was an unknown error uploading the file.
	You are not allowed to upload files of this type.
	The file is too big.
	There was an error uploading the file.';

		$cf7_post = array(
			'post_title' => wp_strip_all_tags($cf7title),
			'post_content' => $cf7content,
			'post_status' => 'publish',
			'post_type' => 'wpcf7_contact_form',
		);
		// Insert the post into the database
		$cf7post_id = wp_insert_post($cf7_post);

		add_post_meta($cf7post_id, "_form", '
		<div class="row">
			<div class="input-wrapper">
				[text* name class:Name placeholder "Enter Your Name"]
			</div>
			<div class="input-wrapper">
				[tel* Phone-number class:PhoneNumber placeholder "Phone Number"]
			</div>
			<div class="input-wrapper">
				[email* Email class:Email placeholder "Enter Your Email"]
			</div>
			<div class="input-wrapper">
				[textarea* Message class:Message placeholder "Message"]
			</div>
			<div class="input-wrapper">
				[submit class:submit id:submit-button "Submit"]
			</div>
		</div>');

		$cf7mail_data = array(
			'subject' => '[_site_title] "[your-subject]"',
			'sender' => '[_site_title] <abc@gmail.com>',
			'body' => 'From: [your-name] <[your-email]>
			Subject: [your-subject]

			Message Body:
			[your-message]

			--
			This e-mail was sent from a contact form on [_site_title] ([_site_url])',
			'recipient' => '[_site_admin_email]',
			'additional_headers' => 'Reply-To: [your-email]',
			'attachments' => '',
			'use_html' => 0,
			'exclude_blank' => 0
		);

		add_post_meta($cf7post_id, "_mail", $cf7mail_data);
		// Gets term object from Tree in the database.

		$cf7shortcodeSupport = '[contact-form-7 id="' . $cf7post_id . '" title="' . $cf7title . '"]';


		// For 'vw_podcast_pro_contactus_form'
		set_theme_mod('vw_podcast_pro_contactus_contactform_shortcode', $cf7shortcodeSupport);

		set_theme_mod('vw_podcast_pro_from_bg_image', get_template_directory_uri() . '/assets/images/Contact-bg-images.png');
		// support page end 

		/*--- Latest Post---*/
		set_theme_mod('vw_podcast_pro_blog_heading_tagline', 'Blog');
		set_theme_mod('vw_podcast_pro_blog_heading', 'REsources And News');
		set_theme_mod('vw_podcast_pro_latest_blog_and_news_number', 6);
		set_theme_mod('vw_podcast_pro_news_readmore', 'Learn More');
		set_theme_mod('vw_podcast_pro_blog_icons', 'fa fa-calendar');
		set_theme_mod('vw_podcast_pro_blog_icons2', 'fas fa-comment');
		set_theme_mod('vw_podcast_pro_blog_icons3', 'fas fa-arrow-right');
		set_theme_mod('vw_podcast_pro_blog_read_more', 'Read More');

		$blog_title = array('Behind the Mic: Exploring the Stories of Our Favorite Artists', 'Tune In: The Latest Podcast Episodes and Music Releases', 'Artist Spotlights: Interviews with Emerging Talents in Podcasting and Music', 'Case Studies and Success Stories', 'From Studio to Speakers: The Making of Your Favorite Podcasts and Tracks', 'Podcast Picks and Music Mixes');
		$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		// Define an array of category names
		$category_names = array('Guest Features', 'Podcast', 'Enterprise', 'Marketers', 'Developers', 'Project Managers');
		// Initialize an array to store category IDs
		$category_ids = array();
		// Loop through category names and convert them to IDs
		$category_id = wp_create_category($category_name);
		foreach ($category_names as $category_name) {
			$category_id = wp_create_category($category_name);
			if (!is_wp_error($category_id)) {
				$category_ids[] = $category_id;
			}
		}
		for ($i = 1; $i <= 6; $i++) {
			$vw_title = $blog_title[$i - 1];
			// Create post object
			$my_post = array(
				'post_title' => wp_strip_all_tags('Lorem ipsum is simple dummy text of the'),
				'post_title' => wp_strip_all_tags($vw_title),
				'post_content' => $content,
				'post_status' => 'publish',
				'post_type' => 'post'
			);
			// Insert the post into the database
			$post_id = wp_insert_post($my_post);

			// wp_set_object_terms( $post_id, $posts_categories_name[$i], 'category', true );

			update_post_meta($post_id, 'post-banner-image', get_template_directory_uri() . '/assets/images/Blog-header-Image.png');
			update_post_meta($post_id, 'post_para_1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptasqui');
			update_post_meta($post_id, 'post_para_2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
			update_post_meta($post_id, 'post_para_3', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
			update_post_meta($post_id, 'post_que', "Why do we use it?");
			update_post_meta($post_id, 'post_image_1', get_template_directory_uri() . '/assets/images/Blog/blog-attachment2.png');
			update_post_meta($post_id, 'post_image_2', get_template_directory_uri() . '/assets/images/Blog/blog-attachment.png');

			$image_url = get_template_directory_uri() . '/assets/images/Blog/blog' . $i . '.png';

			$image_name = 'blog' . $i . '.png';
			$upload_dir = wp_upload_dir(); // Set upload folder
			$image_data = file_get_contents($image_url); // Get image data
			$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name); // Generate unique name
			$filename = basename($unique_file_name); // Create image file name
			// Check folder permission and define file location
			if (wp_mkdir_p($upload_dir['path'])) {
				$file = $upload_dir['path'] . '/' . $filename;
			} else {
				$file = $upload_dir['basedir'] . '/' . $filename;
			}

			// Create the image  file on the server
			file_put_contents($file, $image_data);

			// Check image file type
			$wp_filetype = wp_check_filetype($filename, null);

			// Set attachment data
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_type' => 'post',
				'post_status' => 'inherit'
			);

			// Create the attachment
			$attach_id = wp_insert_attachment($attachment, $file, $post_id);

			// Include image.php
			require_once (ABSPATH . 'wp-admin/includes/image.php');

			// Define attachment metadata
			$attach_data = wp_generate_attachment_metadata($attach_id, $file);

			// Assign metadata to attachment
			wp_update_attachment_metadata($attach_id, $attach_data);

			// And finally assign featured image to post
			wp_set_post_categories($post_id, $category_ids[$i - 1]);
			set_post_thumbnail($post_id, $attach_id);
		}

		// Set theme mod value for 'vw_podcast_pro_trending_heading'
		set_theme_mod('vw_podcast_pro_trending_heading', 'Trending Songs');

		// Set theme mod value for 'vw_podcast_pro_trending_language'
		$trending_language_value = ''; // Set your desired value here
		set_theme_mod('vw_podcast_pro_trending_language', $trending_language_value);

		// Set theme mod value for 'vw_podcast_pro_categories'
		// Assuming $selected_categories is an array of selected category slugs
		$selected_categories = array('28'); // Set your selected category slugs here
		set_theme_mod('vw_podcast_pro_categories', $selected_categories);

		set_theme_mod('vw_podcast_pro_romance_show_all_btn_link', 'Trending Page');


		set_theme_mod('vw_podcast_pro_popular_englishheading', 'Popular In English');

		// Set theme mod value for 'vw_podcast_pro_trending_language'
		$trending_language_value = 'English'; // Set your desired value here
		set_theme_mod('vw_podcast_pro_popular_englishlanguage', $trending_language_value);

		// Set theme mod value for 'vw_podcast_pro_categories'
		// Assuming $selected_categories is an array of selected category slugs
		$selected_categories = array('28'); // Set your selected category slugs here
		set_theme_mod('vw_podcast_pro_categories_english', $selected_categories);
		set_theme_mod('vw_podcast_pro_popular_englishsingle_page_title', 'Trending English');

		// Romance 

		set_theme_mod('vw_podcast_pro_popular_romanceheading', 'Romance');

		// Set theme mod value for 'vw_podcast_pro_trending_language'
		$trending_language_value = 'Hindi'; // Set your desired value here
		set_theme_mod('vw_podcast_pro_popular_englishlanguage', $trending_language_value);

		// Set theme mod value for 'vw_podcast_pro_categories'
		// Assuming $selected_categories is an array of selected category slugs
		$selected_categories = array('28'); // Set your selected category slugs here
		set_theme_mod('vw_podcast_pro_romance_category', $selected_categories);


		// Spanish 

		set_theme_mod('vw_podcast_pro_popular_spanishheading', 'Popular In Spanish');

		// Set theme mod value for 'vw_podcast_pro_trending_language'
		$trending_language_value = 'spanish'; // Set your desired value here
		set_theme_mod('vw_podcast_pro_popular_spanishlanguage', $trending_language_value);

		// Set theme mod value for 'vw_podcast_pro_categories'
		// Assuming $selected_categories is an array of selected category slugs
		$selected_categories = array('28'); // Set your selected category slugs here
		set_theme_mod('vw_podcast_pro_spanish_category', $selected_categories);
		set_theme_mod('vw_podcast_pro_spanish_show_all_btn_link', 'http://localhost/wordpresstwo/index.php/plans/');

		// new releases section 

		set_theme_mod('vw_podcast_pro_new_releases_section_heading', 'New Releases');


		// top charts 



		$blog_title = array('English Top 30', 'Hindi Top 30', 'Romantic Top 30', 'Spanish Top 30', 'International Top 30', 'Hop Hop Top 30');
		$lang_array = array('English', 'Hindi', 'Spanish', 'International', 'Hip Hop', 'Romantic');
		$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

		for ($i = 1; $i <= 6; $i++) {
			$vw_title = $blog_title[$i - 1];
			// Create post object
			$my_post = array(
				'post_title' => wp_strip_all_tags('Lorem ipsum is simple dummy text of the'),
				'post_title' => wp_strip_all_tags($vw_title),
				'post_content' => $content,
				'post_status' => 'publish',
				'post_type' => 'top_chart'
			);
			// Insert the post into the database
			$post_id = wp_insert_post($my_post);
			update_post_meta($post_id, 'top_charts_language', $lang_array[$i]);
			update_post_meta($post_id, 'top_charts_song_count', '10');
			$image_url = get_template_directory_uri() . '/assets/images/podcastimage/topchart/category0' . $i . '.png';

			$image_name = 'Chart' . $i . '.png';
			$upload_dir = wp_upload_dir(); // Set upload folder
			$image_data = file_get_contents($image_url); // Get image data
			$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name); // Generate unique name
			$filename = basename($unique_file_name); // Create image file name
			// Check folder permission and define file location
			if (wp_mkdir_p($upload_dir['path'])) {
				$file = $upload_dir['path'] . '/' . $filename;
			} else {
				$file = $upload_dir['basedir'] . '/' . $filename;
			}

			// Create the image  file on the server
			file_put_contents($file, $image_data);

			// Check image file type
			$wp_filetype = wp_check_filetype($filename, null);

			// Set attachment data
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_type' => 'post',
				'post_status' => 'inherit'
			);

			// Create the attachment
			$attach_id = wp_insert_attachment($attachment, $file, $post_id);

			// Include image.php
			require_once (ABSPATH . 'wp-admin/includes/image.php');

			// Define attachment metadata
			$attach_data = wp_generate_attachment_metadata($attach_id, $file);

			// Assign metadata to attachment
			wp_update_attachment_metadata($attach_id, $attach_data);

			// And finally assign featured image to post
			set_post_thumbnail($post_id, $attach_id);
		}




		// Faq Page
		set_theme_mod('vw_podcast_pro_faq_temp_faq_number', '8');
		$faqque = array("What if I am not satisfied with my product? What are your return & exchange policies?", "How do I know that my frame or sunglasses fits me well?", "How do I know which size to buy?", "Where can I find my frame measurements?", "I am unsure of what my prescription is. Can you help me with that?", "How many days will it take to make & deliver my spectacles?", "How do I find out the Status of my order?", "How do I upload my lens power details?");


		for ($i = 1; $i <= 8; $i++) {
			//counter Number
			set_theme_mod('vw_podcast_pro_faq_temp_faq_que' . $i, $faqque[$i - 1]);
			//Counter Title
			set_theme_mod('vw_podcast_pro_faq_temp_faq_ans' . $i, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting remaining.');
		}



		// create custom post type for Ad event post



		// ------------contact us section-------------

		// 

		// post type ad event 
		$post_title = 'Love Me Like Do';
		$post_status = 'publish';
		$post_type = 'ad_event';

		// Create the post
		$post_id = wp_insert_post(
			array(
				'post_title' => $post_title,
				'post_status' => $post_status,
				'post_type' => $post_type,
			)
		);
		// Get the filesystem path to the theme directory
		$theme_directory = get_template_directory();
		// Construct the local filesystem path to the MP3 file
		$song_path = $theme_directory . '/assets/audio/adEvt.mp3';

		// Upload and set featured image
		$song_name = strtolower(str_replace(' ', '', $post_titles[$i])) . '.mp3';
		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents($song_path);
		$unique_file_name = wp_unique_filename($upload_dir['path'], $song_name);
		$filename = basename($unique_file_name);

		if (wp_mkdir_p($upload_dir['path'])) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}

		file_put_contents($file, $image_data);

		$wp_filetype = wp_check_filetype($filename, null);

		$song_attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => sanitize_file_name($filename),
			'post_content' => '',
			'post_type' => 'attachment',
			'post_status' => 'inherit',
		);

		$song_attach_id = wp_insert_attachment($song_attachment, $file);

		require_once (ABSPATH . 'wp-admin/includes/image.php');

		$song_attach_data = wp_generate_attachment_metadata($song_attach_id, $file);

		wp_update_attachment_metadata($song_attach_id, $song_attach_data);
		// error_log('attachment id ==========> '.$attach_id);
		$song_attachment_url = wp_get_attachment_url($song_attach_id);
		// Check if the post was created successfully
		if (!is_wp_error($post_id)) {
			// Add meta fields
			update_post_meta($post_id, 'artists', 'John Smith');
			update_post_meta($post_id, 'date', '2024-03-30');
			update_post_meta($post_id, 'venue_name', 'Sample Venue');
			update_post_meta($post_id, 'start_time', '18:00');
			update_post_meta($post_id, 'end_time', '22:00');
			update_post_meta($post_id, 'entry_fee_tag', '$10.00');

			// Set featured image
			$image_url = get_template_directory_uri() . '/assets/images/podcastimage/adEvent.png'; // URL of the image
			$image_name = 'event background.png';
			$upload_dir = wp_upload_dir(); // Set upload folder
			$image_data = file_get_contents($image_url); // Get image data
			$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name); // Generate unique name
			$filename = basename($unique_file_name); // Create image file name
			// Check folder permission and define file location
			if (wp_mkdir_p($upload_dir['path'])) {
				$file = $upload_dir['path'] . '/' . $filename;
			} else {
				$file = $upload_dir['basedir'] . '/' . $filename;
			}

			// Create the image  file on the server
			file_put_contents($file, $image_data);

			// Check image file type
			$wp_filetype = wp_check_filetype($filename, null);

			// Set attachment data
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_type' => 'post',
				'post_status' => 'inherit'
			);

			// Create the attachment
			$attach_id = wp_insert_attachment($attachment, $file, $post_id);

			// Include image.php
			require_once (ABSPATH . 'wp-admin/includes/image.php');

			// Define attachment metadata
			$attach_data = wp_generate_attachment_metadata($attach_id, $file);

			// Assign metadata to attachment
			wp_update_attachment_metadata($attach_id, $attach_data);
			if (!is_wp_error($attach_id)) {
				set_post_thumbnail($post_id, $attach_id); // Set the image as the featured image
			}
			update_post_meta($post_id, 'song_mp3_file', $song_attachment_url);
		}


		// /footer
		// For 'vw_podcast_pro_footer_enable'
		set_theme_mod('vw_podcast_pro_footer_enable', 'Enable'); // or 'Disable' based on your preference

		// For 'vw_podcast_pro_footer_bgcolor'
		set_theme_mod('vw_podcast_pro_footer_bgcolor', '');

		// For 'vw_podcast_pro_footer_bg_image'
		set_theme_mod('vw_podcast_pro_footer_bg_image', get_template_directory_uri() . '/assets/images/Footer-BG.png');

		set_theme_mod('vw_podcast_pro_footer_copyright_text', '2023 VW Audio Podcast All rights reserved.');

		// for ($i = 1; $i <= 4; $i++) {
		// 	// Set the image value using set_theme_mod
		// 	set_theme_mod('vw_podcast_pro_footer_social_icons_image_link' . $i, '#');
		// }

		//Background image


		set_theme_mod('vw_podcast_pro_newsletter_sub_heading', 'NEWSLETTER');
		set_theme_mod('vw_podcast_pro_newsletter_heading', 'Sign Up To Our Newsletter');
		set_theme_mod('vw_podcast_pro_newsletter_paragraph', 'Stay up to date with the latest car trends, technologies, and news by signing up to our newsletter');
		set_theme_mod('vw_podcast_pro_newsletter_form_info_text', 'Your e-mail is safe with us and will not be shared with other third-party websites');





		// Newsletter shortcode
		$cf7title = "Notify Me From";
		$cf7content = '
			
		<div class="form-wrapper">
		<div class="input-wrapper">
		[text* text-208 placeholder "Enter Your Favorite Artist Name"]
		</div>
		<div class="input-wrapper">
		[email* email-537 placeholder "Enter Your Email"]
		</div>
		<p class="from text">Enter Your Email And Favorite Artist`s Name To get a Notification Their Upcoming Concert Or Podcast</p>
		<div class="submit-btn-wrapper">
		[submit "Notify Me"]
		</div>
		</div>

		From: [your-name] <[your-email]>
		Subject: New Newsletter Subscriber!
		Add this email to subscriber list: [email-462]
				--
		This e-mail was sent from a contact form on [_site_title] ([_site_url])
	
		[_site_admin_email]
		Reply-To: [your-email]
	
		0
		0
	
		[_site_title] "[your-subject]"
		[_site_title] <abc@gmail.com>
		Message Body:
		[your-message]
	
		--
		This e-mail was sent from a contact form on [_site_title] ([_site_url])
		[your-email]
		Reply-To: [_site_admin_email]
	
		0
		0
		Thank you for subscribing.
		There was an error trying to send your message. Please try again later.
		One or more fields have an error. Please check and try again.
		There was an error trying to send your message. Please try again later.
		You must accept the terms and conditions before sending your message.
		The field is required.
		The field is too long.
		The field is too short.
		There was an unknown error uploading the file.
		You are not allowed to upload files of this type.
		The file is too big.
		There was an error uploading the file.';

		$cf7_post = array(
			'post_title' => wp_strip_all_tags($cf7title),
			'post_content' => $cf7content,
			'post_status' => 'publish',
			'post_type' => 'wpcf7_contact_form',
		);
		// Insert the post into the database
		$cf7post_id = wp_insert_post($cf7_post);

		add_post_meta($cf7post_id, "_form", '	
		<div class="form-wrapper">
		<div class="input-wrapper">
		[text* text-208 placeholder "Enter Your Favorite Artist Name"]
		</div>
		<div class="input-wrapper">
		[email* email-537 placeholder "Enter Your Email"]
		</div>
		<p class="from text">Enter Your Email And Favorite Artist`s Name To get a Notification Their Upcoming Concert Or Podcast</p>
		<div class="submit-btn-wrapper">
		[submit "Notify Me"]
		</div>
		</div>');

		$cf7mail_data = array(
			'subject' => '[_site_title] "[your-subject]"',
			'sender' => '[_site_title] <abc@gmail.com>',
			'body' => 'From: [your-name] <[your-email]>
			Subject: [your-subject]
		
			Message Body:
			From: [your-name] <[your-email]>
			Subject: New Newsletter Subscriber!
			Add this email to subscriber list: [email-462]
					--
			This e-mail was sent from a contact form on [_site_title] ([_site_url])',
			'recipient' => '[_site_admin_email]',
			'additional_headers' => 'Reply-To: [your-email]',
			'attachments' => '',
			'use_html' => 0,
			'exclude_blank' => 0
		);

		add_post_meta($cf7post_id, "_mail", $cf7mail_data);
		// Gets term object from Tree in the database.

		$cf7shortcodeNewsletter = '[contact-form-7 id="' . $cf7post_id . '" title="' . $cf7title . '"]';

		set_theme_mod('vw_podcast_pro_header_notification_link',$cf7shortcodeNewsletter);
		// Newsletter shortcode




		// Newsletter shortcode
		$cf7title = "Newsletter Form";
		$cf7content = '
		<div class="footer-form-wrapper">
		<div class="Form-input-wrapper">
			[email* email-462 placeholder "Enter Your Mail Address"]
		</div>
		<div class="Footer-submit-wrapper">
			[submit "Submit"]
		</div>
	</div>

			From: [your-name] <[your-email]>
			Subject: New Newsletter Subscriber!
			Add this email to subscriber list: [email-462]
					--
			This e-mail was sent from a contact form on [_site_title] ([_site_url])
		
			[_site_admin_email]
			Reply-To: [your-email]
		
			0
			0
		
			[_site_title] "[your-subject]"
			[_site_title] <abc@gmail.com>
			Message Body:
			[your-message]
		
			--
			This e-mail was sent from a contact form on [_site_title] ([_site_url])
			[your-email]
			Reply-To: [_site_admin_email]
		
			0
			0
			Thank you for subscribing.
			There was an error trying to send your message. Please try again later.
			One or more fields have an error. Please check and try again.
			There was an error trying to send your message. Please try again later.
			You must accept the terms and conditions before sending your message.
			The field is required.
			The field is too long.
			The field is too short.
			There was an unknown error uploading the file.
			You are not allowed to upload files of this type.
			The file is too big.
			There was an error uploading the file.';

		$cf7_post = array(
			'post_title' => wp_strip_all_tags($cf7title),
			'post_content' => $cf7content,
			'post_status' => 'publish',
			'post_type' => 'wpcf7_contact_form',
		);
		// Insert the post into the database
		$cf7post_id = wp_insert_post($cf7_post);

		add_post_meta($cf7post_id, "_form", '	
			<div class="footer-form-wrapper">
				<div class="Form-input-wrapper">
					[email* email-462 placeholder "Email Address"]
				</div>
				<div class="Footer-submit-wrapper">
					[submit "Submit"]
				</div>
			</div>');

		$cf7mail_data = array(
			'subject' => '[_site_title] "[your-subject]"',
			'sender' => '[_site_title] <abc@gmail.com>',
			'body' => 'From: [your-name] <[your-email]>
			Subject: [your-subject]
		
			Message Body:
			From: [your-name] <[your-email]>
			Subject: New Newsletter Subscriber!
			Add this email to subscriber list: [email-462]
					--
			This e-mail was sent from a contact form on [_site_title] ([_site_url])',
			'recipient' => '[_site_admin_email]',
			'additional_headers' => 'Reply-To: [your-email]',
			'attachments' => '',
			'use_html' => 0,
			'exclude_blank' => 0
		);

		add_post_meta($cf7post_id, "_mail", $cf7mail_data);
		// Gets term object from Tree in the database.

		$cf7shortcode = '[contact-form-7 id="' . $cf7post_id . '" title="' . $cf7title . '"]';

		set_theme_mod('vw_podcast_pro_contactpage_shortcode', $cf7shortcode);



		$cf7title = "Joining Form";
		$cf7content = '	
		<div class="fomr-wrapper">
        <div class="input-wrapper">
            [text* text-238 class:input-name placeholder "Name"]
        </div>
        <div class="input-wrapper">
            [text* text-238 class:input-userName placeholder "User Name"]
        </div>
        <div class="input-wrapper">
            [email* mail class:email placeholder "Mail"]
        </div>
        <div class="input-wrapper">
            [tel Phone No class:phone placeholder "Phone"]
        </div>
        <div class="input-wrapper">
            [text* text-238 class:input-userlocation placeholder "Location"]
        </div>
        <div class="input-wrapper">
            [select* artist-type class:dropdown-artist "Podacast host" "Singer" "Music Director"
            "Instrumentalist"]
        </div>
        <div class="input-wrapper">
            [text* text-238 class:input-userlocation placeholder "Company/Label"]
        </div>
        <div class="input-wrapper">
            [select* music-type class:dropdown-artist  "Classic Rock" "Metal" "Heavy Metal" "Grunge Metal" "Nu
            Metal" "Death Metal" "Alternative Rock"]
        </div>
        <div class="input-wrapper uploader">
            [file* file-308 filetypes:.png class:music]
		<div class="form-label">Upload Cover Of Your Music / Podcast.</div>
        </div>
        <div class="input-wrapper uploader two">
            [file* UploadCover Of Your Music. filetypes:.mp3 class:music]
		<div class="form-label">Upload Cover Of Your Music / Podcast.</div>
        </div>
       <div class="submit-wrapper-form">
           <div class="input-wrapper submit">
            [submit id:Submit-btn "Submit"]
        </div>
 		<div class="input-wrapper checkbox">
            [checkbox* checkbox-796 include_blank class:checkbox use_label_element exclusive "I confirm that I have read and agree to
            the terms and conditions, and I am authorized to upload this podcast content."]
        </div>
       </div>
    </div>
		--
		This e-mail was sent from a contact form on [_site_title] ([_site_url])
		[_site_admin_email]
		Reply-To: [your-email]

		0
		0
		Subject: 
				[your-subject]
				From:[name]
				contact number: [phone]
				Pickup:[city]
				Drop:[DeliveryCity]
				Categories: [Categories]
				Client Email:[Email]
				Gross Weight:[GrossWeight]
				Messsage:[Message]
		--
		This e-mail was sent from a contact form on [_site_title] ([_site_url])

		Reply-To: [_site_admin_email]

		0
		0
		Thank you for your message. It has been sent.
		There was an error trying to send your message. Please try again later.
		One or more fields have an error. Please check and try again.
		There was an error trying to send your message. Please try again later.
		You must accept the terms and conditions before sending your message.
		The field is required.
		The field is too long.
		The field is too short.
		There was an unknown error uploading the file.
		You are not allowed to upload files of this type.
		The file is too big.
		There was an error uploading the file.';

		$cf7_post = array(
			'post_title' => wp_strip_all_tags($cf7title),
			'post_content' => $cf7content,
			'post_status' => 'publish',
			'post_type' => 'wpcf7_contact_form',
		);
		// Insert the post into the database
		$cf7post_id = wp_insert_post($cf7_post);

		add_post_meta($cf7post_id, "_form", '
		<div class="fomr-wrapper">
        <div class="input-wrapper">
            [text* text-238 class:input-name placeholder "Name"]
        </div>
        <div class="input-wrapper">
            [text* text-238 class:input-userName placeholder "User Name"]
        </div>
        <div class="input-wrapper">
            [email* mail class:email placeholder "Mail"]
        </div>
        <div class="input-wrapper">
            [tel Phone No class:phone placeholder "Phone"]
        </div>
        <div class="input-wrapper">
            [text* text-238 class:input-userlocation placeholder "Location"]
        </div>
        <div class="input-wrapper">
            [select* artist-type class:dropdown-artist "Podacast host" "Singer" "Music Director"
            "Instrumentalist"]
        </div>
        <div class="input-wrapper">
            [text* text-238 class:input-userlocation placeholder "Company/Label"]
        </div>
        <div class="input-wrapper">
            [select* music-type class:dropdown-artist  "Classic Rock" "Metal" "Heavy Metal" "Grunge Metal" "Nu
            Metal" "Death Metal" "Alternative Rock"]
        </div>
        <div class="input-wrapper uploader">
            [file* file-308 filetypes:.mp3 class:music]
<div class="form-label">Upload Cover Of Your Music / Podcast.</div>
        </div>
        <div class="input-wrapper uploader two">
            [file* UploadCover Of Your Music. filetypes:.mp3 class:music]
<div class="form-label">Upload Cover Of Your Music / Podcast.</div>
        </div>
       <div class="submit-wrapper-form">
           <div class="input-wrapper submit">
            [submit id:Submit-btn "Submit"]
        </div>
 <div class="input-wrapper checkbox">
            [checkbox* checkbox-796 include_blank class:checkbox use_label_element exclusive "I confirm that I have read and agree to
            the terms and conditions, and I am authorized to upload this podcast content."]
        </div>
       </div>
    </div>');

		$cf7mail_data = array(
			'subject' => '[_site_title] "[your-subject]"',
			'sender' => '[_site_title] <abc@gmail.com>',
			'body' => ' New quotation request!
					From:[name]
					contact number: [phone]
					Pickup:[city]
					Drop:[DeliveryCity]
					Categories: [Categories]
					Client Email:[Email]
					Gross Weight:[GrossWeight]
					Messsage:[Message]

					--
					This e-mail was sent from a contact form on [_site_title] ([_site_url])',
			'recipient' => '[_site_admin_email]',
			'additional_headers' => 'Reply-To: [your-email]',
			'attachments' => '',
			'use_html' => 0,
			'exclude_blank' => 0
		);
		add_post_meta($cf7post_id, "_mail", $cf7mail_data);
		// Gets term object from Tree in the database.

		$cf7shortcode = '[contact-form-7 id="' . $cf7post_id . '" title="' . $cf7title . '"]';

		// Set Get A Quote Form Shortcode
		set_theme_mod('vw_podcast_pro_for_artist_from_shortcode_text', $cf7shortcode);

		// pricing section  ends	

		// set_theme_mod('vw_podcast_pro_pricing_from_shortcode','cf7shortcode');




		// For Artists page 


		set_theme_mod('vw_podcast_pro_register_artist_banner_image', get_template_directory_uri() . '/assets/images/artists-page-img.png');

		// Albums post type 


		$album_title = array('Example Album');
		// Define an array of category names

		for ($i = 1; $i <= 1; $i++) {
			$vw_title = $album_title[$i - 1];
			// Create post object
			$my_post = array(
				'post_title' => wp_strip_all_tags($album_title[$i - 1]),
				'post_title' => wp_strip_all_tags($vw_title),
				'post_status' => 'publish',
				'post_type' => 'albums'
			);
			// Insert the post into the database
			$post_id = wp_insert_post($my_post);
			$image_url_album = get_template_directory_uri() . '/assets/images/ablum.png';

			$image_name = 'albumCover' . $i . '.png';
			$upload_dir = wp_upload_dir(); // Set upload folder
			$image_data = file_get_contents($image_url_album); // Get image data
			$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name); // Generate unique name
			$filename = basename($unique_file_name); // Create image file name
			// Check folder permission and define file location
			if (wp_mkdir_p($upload_dir['path'])) {
				$file = $upload_dir['path'] . '/' . $filename;
			} else {
				$file = $upload_dir['basedir'] . '/' . $filename;
			}

			// Create the image  file on the server
			file_put_contents($file, $image_data);

			// Check image file type
			$wp_filetype = wp_check_filetype($filename, null);

			// Set attachment data
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_type' => 'post',
				'post_status' => 'inherit'
			);

			// Create the attachment
			$attach_id = wp_insert_attachment($attachment, $file, $post_id);

			// Include image.php
			require_once (ABSPATH . 'wp-admin/includes/image.php');

			// Define attachment metadata
			$attach_data = wp_generate_attachment_metadata($attach_id, $file);
			// Selescting sogns for album songs ,eta fied 
			$songs_to_select = array('79', '95'); // Replace 1, 2, 3 with the actual IDs of the songs you want to select

			// Update the post meta for the selected songs
			update_post_meta($post_id, 'selected_songs', $songs_to_select);
			// Update post meta fields
			update_post_meta($post_id, 'collection_name', 'New Collection');
			update_post_meta($post_id, 'artist_name', 'Kunal Korde');
			update_post_meta($post_id, 'movie_name', 'Example Movie');
			update_post_meta($post_id, 'company_name', 'eg company');
			update_post_meta($post_id, 'play_count', '200');
			update_post_meta($post_id, 'duration', '2:50');

			// Assign metadata to attachment
			wp_update_attachment_metadata($attach_id, $attach_data);
			set_post_thumbnail($post_id, $attach_id);
		}




		// albums posttype end 



		// Playlist type 


		$playlist_title = array('Example playlist');
		// Define an array of category names

		for ($i = 1; $i <= 1; $i++) {
			$vw_title = $playlist_title[$i - 1];
			// Create post object
			$my_post = array(
				'post_title' => wp_strip_all_tags($playlist_title[$i - 1]),
				'post_title' => wp_strip_all_tags($vw_title),
				'post_status' => 'publish',
				'post_type' => 'playlists'
			);
			// Insert the post into the database
			$post_id = wp_insert_post($my_post);
			$image_url_playlist = get_template_directory_uri() . '/assets/images/playlist.png';

			$image_name = 'playlistCover' . $i . '.png';
			$upload_dir = wp_upload_dir(); // Set upload folder
			$image_data = file_get_contents($image_url_playlist); // Get image data
			$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name); // Generate unique name
			$filename = basename($unique_file_name); // Create image file name
			// Check folder permission and define file location
			if (wp_mkdir_p($upload_dir['path'])) {
				$file = $upload_dir['path'] . '/' . $filename;
			} else {
				$file = $upload_dir['basedir'] . '/' . $filename;
			}

			// Create the image  file on the server
			file_put_contents($file, $image_data);

			// Check image file type
			$wp_filetype = wp_check_filetype($filename, null);

			// Set attachment data
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_type' => 'post',
				'post_status' => 'inherit'
			);

			// Create the attachment
			$attach_id = wp_insert_attachment($attachment, $file, $post_id);

			// Include image.php
			require_once (ABSPATH . 'wp-admin/includes/image.php');

			// Define attachment metadata
			$attach_data = wp_generate_attachment_metadata($attach_id, $file);
			// Selescting sogns for playlist songs ,eta fied 
			$songs_to_select = array('79', '95'); // Replace 1, 2, 3 with the actual IDs of the songs you want to select

			// Update the post meta for the selected songs
			update_post_meta($post_id, 'playlist_selected_songs', $songs_to_select);
			update_post_meta($post_id, 'playlist_collection_name', 'LoFi Mix');
			update_post_meta($post_id, 'playlist_artist_name', 'Dipak Mendhe');
			update_post_meta($post_id, 'playlist_movie_name', 'Example Name');
			update_post_meta($post_id, 'playlist_company_name', 'eg Company');
			update_post_meta($post_id, 'playlist_play_count', '200');
			update_post_meta($post_id, 'playlist_duration', '2:50');

			// Assign metadata to attachment
			wp_update_attachment_metadata($attach_id, $attach_data);
			set_post_thumbnail($post_id, $attach_id);
		}









		//Contact From Title
		set_theme_mod('vw_podcast_pro_contactpage_form_title', 'Contact Information');
		set_theme_mod('vw_podcast_pro_contactpage_form_subtitle', 'Fill up the contact form and our team will get back in touch with you within 24 hours.');
		set_theme_mod('vw_podcast_pro_contactpage_call_icon', 'fas fa-phone-volume');
		set_theme_mod('vw_podcast_pro_contactpage_call', '+1 123 456 7890');
		set_theme_mod('vw_podcast_pro_contactpage_address_icon', 'fas fa-envelope');
		set_theme_mod('vw_podcast_pro_contactpage_address', 'hello@heyreviews.com');
		set_theme_mod('vw_podcast_pro_address_latitude', '28.8027594');
		set_theme_mod('vw_podcast_pro_address_longitude', '-105.9808615');
		set_theme_mod('vw_podcast_pro_contact_page_form_bg_image', get_template_directory_uri() . '/assets/images/contact/contact-bg.png');
		// set_theme_mod( 'vw_podcast_pro_contact_page_bg_image',get_template_directory_uri().'/assets/images/contact/contact-bg.png' );


		/*---------------Blog Page----------------------*/
		set_theme_mod('vw_podcast_pro_blog_comment_icon', 'fa fa-comments');
		set_theme_mod('vw_podcast_pro_blog_fright_icon', 'fas fa-tags');
		set_theme_mod('vw_podcast_pro_blog_heading', 'Resources & News.');
		set_theme_mod('vw_podcast_pro_blog_heading_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');



		// Recent blogs 

		set_theme_mod('vw_podcast_pro_single_blog_heading_tag', 'Related Post');
		set_theme_mod('vw_podcast_pro_single_blog_heading', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
		set_theme_mod('vw_podcast_pro_our_section_wrapper_bg', get_template_directory_uri() . '/assets/images/BG.png');


		set_theme_mod('vw_podcast_pro_error_temp_bg_images', get_template_directory_uri() . '/assets/images/404.png');

		set_theme_mod('vw_podcast_pro_404_page_big_word', 'Error Not Found');
		// set_theme_mod('vw_podcast_pro_404_page_heading', 'Page Not Found');
		set_theme_mod('vw_podcast_pro_404_page_content', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
		set_theme_mod('vw_podcast_pro_404_page_button_text', 'Back to Home');

		$this->theme_create_customizer_nav_menu();
		$this->theme_create_customizer_footer_services_menu();
		$this->theme_create_customizer_footer_quick_links_menu();
		$this->theme_create_customizer_footer_support_menu();
		$this->theme_create_customizer_quick_links_menu();



		$VW_Widget_Importer = new VW_Widget_Importer;
		$VW_Widget_Importer->import_widgets($this->widget_file_url);

		// echo "string";
		exit;
	}


	public function wz_activate_vw_podcast_pro()
	{
		$vw_podcast_pro_license_key = $_POST['vw_podcast_pro_license_key'];

		$endpoint = IBTANA_THEME_LICENCE_ENDPOINT . 'ibtana_client_activate_premium_theme';

		$body = [
			'theme_license_key' => $vw_podcast_pro_license_key,
			'site_url' => site_url(),
			'theme_text_domain' => wp_get_theme()->get('TextDomain')
		];
		$body = wp_json_encode($body);
		$options = [
			'body' => $body,
			'headers' => [
				'Content-Type' => 'application/json',
			]
		];
		$response = wp_remote_post($endpoint, $options);
		if (is_wp_error($response)) {
			ThemeWhizzie::remove_the_theme_key();
			ThemeWhizzie::set_the_validation_status('false');
			$response = array('status' => false, 'msg' => 'Something Went Wrong!');
			wp_send_json($response);
			exit;
		} else {
			$response_body = wp_remote_retrieve_body($response);
			$response_body = json_decode($response_body);

			if ($response_body->is_suspended == 1) {
				ThemeWhizzie::set_the_suspension_status('true');
			} else {
				ThemeWhizzie::set_the_suspension_status('false');
			}

			if ($response_body->status === false) {
				ThemeWhizzie::remove_the_theme_key();
				ThemeWhizzie::set_the_validation_status('false');
				$response = array('status' => false, 'msg' => $response_body->msg);
				wp_send_json($response);
				exit;
			} else {
				ThemeWhizzie::set_the_validation_status('true');
				ThemeWhizzie::set_the_theme_key($vw_podcast_pro_license_key);
				$response = array('status' => true, 'msg' => 'Theme Activated Successfully!');
				wp_send_json($response);
				exit;
			}
		}
	}



	/**
	 * Imports Ibtana Builder Demo Content
	 * @since 1.1.0
	 */
	public function setup_builder()
	{
		$buildercontent = '';
		$resp_slug = '';
		$json_theme = array('base_theme_text_domain' => 'vw-podcast-pro');
		$json_args = array(
			'method' => 'POST',
			'headers' => array(
				'Content-Type' => 'application/json'
			),
			'body' => json_encode($json_theme),
		);

		$request_data = wp_remote_post(IBTANA_THEME_LICENCE_ENDPOINT . 'get_client_ibtana_premium_theme_json_with_inner_pages', $json_args);
		$response_json = json_decode(wp_remote_retrieve_body($request_data));

		// echo '<pre>'; print_r($response_json->data); echo '</pre>';


		foreach ($response_json->data as $resp_json) {
			if ($resp_json->page_type = 'template') {
				$resp_slug = $resp_json->slug;
			}
		}

		$json_theme1 = array('premium_template_slug' => $resp_slug);
		$json_args1 = array(
			'method' => 'POST',
			'headers' => array(
				'Content-Type' => 'application/json'
			),
			'body' => json_encode($json_theme1),
		);

		$request_data1 = wp_remote_post(IBTANA_THEME_LICENCE_ENDPOINT . 'get_client_ibtana_premium_theme_json', $json_args1);
		$response_json1 = json_decode(wp_remote_retrieve_body($request_data1));
		/*	    print_r($response_json1->data);
		 */
		$buildercontent = $response_json1->data;



		$home_id = '';
		$blog_id = '';
		$contact_id = '';
		$page_id = '';
		$page_title = '';
		$page_slug = '';
		global $home_b;

		$page_title = 'Home Page';
		$page_slug = 'home-page';

		$page_check = get_page_by_title($page_title);
		$vw_page = array(
			'post_type' => 'page',
			'post_title' => $page_title,
			'post_content' => $buildercontent,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => $page_slug
		);
		$home_id = wp_insert_post(wp_slash($vw_page));
		add_post_meta($home_id, '_wp_page_template', 'page-template/ibtana-template.php');


		$home_b = get_page_by_title('Home Page');

		update_option('page_on_front', $home_b->ID);
		update_option('show_on_front', 'page');


		// Create a blog page and assigned the template
		$blog_title = 'Blog';
		$blog = array(
			'post_type' => 'page',
			'post_title' => $blog_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'blog'
		);
		$blog_id = wp_insert_post($blog);


		//Set the blog page template
		add_post_meta($blog_id, '_wp_page_template', 'page-template/blog-fullwidth-extend.php');


		// Create a Page
		if (get_page_by_title('Page') == NULL) {
			$page_title = 'Page ';
			$content = 'Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi. Sed quis scit si forte quod esset optima res pro me. sicut ea quae sentio. Qui vellem cadunt off ius desk ejus! Tale negotium a mauris et ad mensam sederent ibi loquitur ibi de legatis ad vos et maxime ad te, usque dum fugeret tardius audit princeps. Bene tamen fiduciam Ego got off semel';

			$page_check = get_page_by_title($page_title);
			$vw_page = array(
				'post_type' => 'page',
				'post_title' => $page_title,
				'post_content' => $content,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug' => 'page'
			);
			$page_id = wp_insert_post($vw_page);
		}

		// Create a contact page and assigned the template
		$contact_title = 'Contact Us';
		$contact = array(
			'post_type' => 'page',
			'post_title' => $contact_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'contact'
		);
		$contact_id = wp_insert_post($contact);


		//========================= songs section new category ========================//

		// artists category 
		$artist_cat_array = array();
		$artist_category = array(
			'Justin Rider',
			'John Belle',
			'Alexandre Mark',
			'Angelina Jolie',
			'BD Sheeran',
			'Alina Walker',
		);
		$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

		foreach ($artist_category as $index => $artist_category_name) {
			$inserted_term = wp_insert_term(
				$artist_category_name,
				'artists', // Custom taxonomy name
				array(
					'description' => $content,
					'slug' => 'artist_cat' . ($index + 1), // Corrected index
				)
			);
			// error_log(print_r($inserted_term, true));
			$artist_cat_array[] = $inserted_term['term_id'];
			// error_log(print_r($radio_cat_array, true));
			if (!is_wp_error($inserted_term)) {
				// Array of image URLs corresponding to each category
				$image_urls_by_artist_category = array(
					'Justin Rider' => get_template_directory_uri() . '/assets/images/podcastimage/artist/justinrider.png',
					'John Belle' => get_template_directory_uri() . '/assets/images/podcastimage/artist/johnbelle.png',
					'Alexandre Mark' => get_template_directory_uri() . '/assets/images/podcastimage/artist/alexandremark.png',
					'Angelina Jolie' => get_template_directory_uri() . '/assets/images/podcastimage/artist/angelinajolie.png',
					'BD Sheeran' => get_template_directory_uri() . '/assets/images/podcastimage/artist/bdsheeran.png',
					'Alina Walker' => get_template_directory_uri() . '/assets/images/podcastimage/artist/alinawalker.png',
				);

				$artist_image = $image_urls_by_artist_category[$artist_category_name];

				// Upload and set featured image
				$image_data = file_get_contents($artist_image);
				$image_name = $artist_category_name . $index . '.png';
				$upload_dir = wp_upload_dir();
				$file = $upload_dir['path'] . '/' . $image_name;

				if (wp_mkdir_p($upload_dir['path'])) {
					file_put_contents($file, $image_data);

					$wp_filetype = wp_check_filetype($image_name, null);

					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title' => sanitize_file_name($image_name),
						'post_content' => '',
						'post_status' => 'inherit',
					);

					$attach_id = wp_insert_attachment($attachment, $file);

					require_once (ABSPATH . 'wp-admin/includes/image.php');

					$attach_data = wp_generate_attachment_metadata($attach_id, $file);
					wp_update_attachment_metadata($attach_id, $attach_data);

					$image_url = wp_get_attachment_image_url($attach_id, 'full');

					// Update term meta with the image URL
					update_term_meta($inserted_term['term_id'], 'category_custom_image_url', $image_url);
				}
			}
		}



		// Radio category 

		$radio_cat_array = array();
		$radio_category = array(
			'Love Hits',
			'Radio Hits',
			'Non Stop Party',
			'90s & 2000s Hits',
			'Old Is Gold',
			'Motivation Speech',
		);
		$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

		foreach ($radio_category as $index => $radio_category_name) {
			$inserted_term = wp_insert_term(
				$radio_category_name,
				'radios', // Custom taxonomy name
				array(
					'description' => $content,
					'slug' => 'radio_cat' . ($index + 1), // Corrected index
				)
			);
			$radio_cat_array[] = $inserted_term['term_id'];
			// error_log(print_r($radio_cat_array, true));

			if (!is_wp_error($inserted_term)) {
				// Array of image URLs corresponding to each category
				$image_urls_by_radio_category = array(
					'Love Hits' => get_template_directory_uri() . '/assets/images/podcastimage/radio/lovehits.png',
					'Radio Hits' => get_template_directory_uri() . '/assets/images/podcastimage/radio/radiohits.png',
					'Non Stop Party' => get_template_directory_uri() . '/assets/images/podcastimage/radio/nonstopparty.png',
					'90s & 2000s Hits' => get_template_directory_uri() . '/assets/images/podcastimage/radio/90sand2000shits.png',
					'Old Is Gold' => get_template_directory_uri() . '/assets/images/podcastimage/radio/oldisgold.png',
					'Motivation Speech' => get_template_directory_uri() . '/assets/images/podcastimage/radio/motivationspeech.png',
				);

				$radio_image = $image_urls_by_radio_category[$radio_category_name];

				// Upload and set featured image
				$image_data = file_get_contents($radio_image);
				$image_name = $radio_category_name . $index . '.png';
				$upload_dir = wp_upload_dir();
				$file = $upload_dir['path'] . '/' . $image_name;

				if (wp_mkdir_p($upload_dir['path'])) {
					file_put_contents($file, $image_data);

					$wp_filetype = wp_check_filetype($image_name, null);

					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title' => sanitize_file_name($image_name),
						'post_content' => '',
						'post_status' => 'inherit',
					);

					$attach_id = wp_insert_attachment($attachment, $file);

					require_once (ABSPATH . 'wp-admin/includes/image.php');

					$attach_data = wp_generate_attachment_metadata($attach_id, $file);
					wp_update_attachment_metadata($attach_id, $attach_data);

					$image_url = wp_get_attachment_image_url($attach_id, 'full');

					// Update term meta with the image URL
					update_term_meta($inserted_term['term_id'], 'category_custom_image_url', $image_url);
				}
			}
		}
		$songs_categories = array(
			'Songs',
			'Audiobook',
			'Podcast',
			'Speech and Lecture',
			'Radio',
			'Religious and Spiritual',
			'Instrumentals',
			'Live Recordings'
		);

		$j = 1;

		foreach ($songs_categories as $index => $songs_category_name) {

			// Insert songs post categories
			$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
			$parent_category = wp_insert_term(
				$songs_category_name,
				'song_categories', // Custom taxonomy name
				array(
					'description' => $content,
					'slug' => 'songs-cat' . ($index + 1), // Corrected index
				)
			);

			// error_log('category obj: ' . $parent_category['term_id']);
			// Array of image URLs corresponding to each category
			$image_urls_by_category = array(
				'Songs' => get_template_directory_uri() . '/assets/images/categories/songs.png',
				'Audiobook' => get_template_directory_uri() . '/assets/images/categories/audiobooks.png',
				'Podcast' => get_template_directory_uri() . '/assets/images/categories/podcast.png',
				'Speech and Lecture' => get_template_directory_uri() . '/assets/images/categories/Speechandlecture.png',
				'Radio' => get_template_directory_uri() . '/assets/images/categories/radio.png',
				'Religious and Spiritual' => get_template_directory_uri() . '/assets/images/categories/religiousandSpiritual.png',
				'Instrumentals' => get_template_directory_uri() . '/assets/images/categories/instrumentals.png',
				'Live Recordings' => get_template_directory_uri() . '/assets/images/categories/liverecodings.png',
			);

			$image_url = $image_urls_by_category[$songs_category_name];

			// Upload and set featured image
			$image_name = $songs_category_name . $j . '.png';
			$upload_dir = wp_upload_dir();

			$image_data = file_get_contents($image_url);
			$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name);
			$filename = basename($unique_file_name);

			if (wp_mkdir_p($upload_dir['path'])) {
				$file = $upload_dir['path'] . '/' . $filename;
			} else {
				$file = $upload_dir['basedir'] . '/' . $filename;
			}

			file_put_contents($file, $image_data);

			$wp_filetype = wp_check_filetype($filename, null);

			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => sanitize_file_name($filename),
				'post_content' => '',
				'post_type' => 'attachment',
				'post_status' => 'inherit',
			);

			$attach_id = wp_insert_attachment($attachment, $file);

			require_once (ABSPATH . 'wp-admin/includes/image.php');

			$attach_data = wp_generate_attachment_metadata($attach_id, $file);

			wp_update_attachment_metadata($attach_id, $attach_data);

			$image_url = wp_get_attachment_image_url($attach_id, 'full');

			$result = update_term_meta($parent_category['term_id'], 'term_image', $image_url);

			// Create songs posts for each category
			$post_titles_by_category = array(
				'Songs' => array(
					"Neon Dreams",
					"Moonlit Serenade",
					"Echoes of Eternity",
					"Electric Dreams",
					"Oceanic Whispers",
					"Midnight Symphony",
					"Stardust Lullaby",
					"Celestial Harmony",
					"Infinite Melody",
					"Galactic Groove",
					"Starlight Sonata",
					"Aurora Borealis",
					"Dreamscape Melodies",
					"Twilight Tango",
					"Sapphire Serenade",
					"Enchanted Echo",
					"Whispering Winds",
					"Eternal Embrace",
					"Radiant Reverie",
				),
				'Audiobook' => array(
					"The Enigma of Epsilon",
					"Echoes from the Void",
					"Whispers of the Past",
				),
				'Podcast' => array(
					"Beyond the Echo",
					"The Cosmic Connection",

				),
				'Speech and Lecture' => array(
					"The Power of Perspective",
					"Unlocking Creativity",
					// "Exploring the Depths of the Mind",
				),
				'Radio' => array(
					"Love Hits",
					"Romantic Songs",
					"90s & 2000s Hits",
					"Old Is Gold",
					"Motivation Speech",
					"Spectrum Radio Network",
					"Cosmic Harmony FM",
					"Stellar Vibes Radio",
					"Infinity Radio Station"
				),
				'Religious and Spiritual' => array(
					"Divine Wisdom Hour",
					"Soulful Sermons",
				),
				'Instrumentals' => array(
					'Mistakes You Might Be Making With Your Watch1',
					'Mistakes You Might Be Making With Your Watch2',
					// 'Mistakes You Might Be Making With Your Watch3',
				),
				'Live Recordings' => array(
					"Live from the Cosmos",
					"Unplugged Sessions",
				)
			);
			$post_titles = $post_titles_by_category[$songs_category_name];
			$num_categories = count($radio_cat_array);
			$artist_cat_len = count($artist_cat_array);
			$language = array('Spanish', 'English', 'Hindi');
			for ($i = 1; $i < count($post_titles); $i++) {

				$songs_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

				$songs_post = array(
					'post_title' => wp_strip_all_tags($post_titles[$i]),
					'post_content' => $songs_content,
					'post_status' => 'publish',
					'post_type' => 'songs',
				);

				$songs_post_id = wp_insert_post($songs_post);
				$category_index = ($i - 1) % $num_categories;
				$artist_category_index = ($i - 1) % $artist_cat_len;
				$lang_index = ($i - 1) % 3;

				// Check if post insertion was successful
				if ($songs_post_id) {
					// assgin language meta to the songs 
					update_post_meta($songs_post_id, 'language', $language[$lang_index]);
					// Assign categories to the post
					$category_ids = array($parent_category['term_id']); // Assuming $parent_category['term_id'] contains the category ID
					wp_set_post_terms($songs_post_id, $category_ids, 'song_categories');
					if ($songs_category_name === 'Songs') {
						wp_set_post_terms($songs_post_id, $radio_cat_array[$category_index], 'radios');
						wp_set_post_terms($songs_post_id, $artist_cat_array[$artist_category_index], 'artists');
					}
					// Check if categories were assigned successfully
					$assigned_categories = wp_get_post_categories($songs_post_id);
				} else {
					error_log('Failed to insert post.');
				}
				// Get the filesystem path to the theme directory
				$theme_directory = get_template_directory();
				// Construct the local filesystem path to the MP3 file
				$song_path = $theme_directory . '/assets/audio/' . strtolower(str_replace(' ', '', $post_titles[$i])) . '.mp3';

				// Upload and set featured image
				$song_name = strtolower(str_replace(' ', '', $post_titles[$i])) . '.mp3';
				// error_log('post title =>>>>' . $song_name);
				// error_log('post path =>>>>' . $song_path);
				$upload_dir = wp_upload_dir();

				$image_data = file_get_contents($song_path);
				$unique_file_name = wp_unique_filename($upload_dir['path'], $song_name);
				$filename = basename($unique_file_name);

				if (wp_mkdir_p($upload_dir['path'])) {
					$file = $upload_dir['path'] . '/' . $filename;
				} else {
					$file = $upload_dir['basedir'] . '/' . $filename;
				}

				file_put_contents($file, $image_data);

				$wp_filetype = wp_check_filetype($filename, null);

				$song_attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name($filename),
					'post_content' => '',
					'post_type' => 'attachment',
					'post_status' => 'inherit',
				);

				$song_attach_id = wp_insert_attachment($song_attachment, $file);

				require_once (ABSPATH . 'wp-admin/includes/image.php');

				$song_attach_data = wp_generate_attachment_metadata($song_attach_id, $file);

				wp_update_attachment_metadata($song_attach_id, $song_attach_data);
				// error_log('attachment id ==========> '.$attach_id);
				$song_attachment_url = wp_get_attachment_url($song_attach_id);
				update_post_meta($songs_post_id, 'song_mp3_file', $song_attachment_url);

				$current_cat = str_replace(' ', '', $songs_category_name);
				$image_url = get_template_directory_uri() . '/assets/images/categories/' . strtolower($current_cat) . '/' . strtolower($current_cat . $i) . '.png';
				$fallback_image = get_template_directory_uri() . '/assets/images/placeholder-image.png';
				// Upload and set featured image
				$image_name = $songs_category_name . $i . '.png';
				$upload_dir = wp_upload_dir();

				if (!empty($image_url)) {
					$image_data = file_get_contents($image_url);
				} else {
					$image_data = file_get_contents($fallback_image);
				}
				$unique_file_name = wp_unique_filename($upload_dir['path'], $image_name);
				$filename = basename($unique_file_name);

				if (wp_mkdir_p($upload_dir['path'])) {
					$file = $upload_dir['path'] . '/' . $filename;
				} else {
					$file = $upload_dir['basedir'] . '/' . $filename;
				}

				file_put_contents($file, $image_data);

				$wp_filetype = wp_check_filetype($filename, null);

				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name($filename),
					'post_content' => '',
					'post_type' => 'attachment',
					'post_status' => 'inherit',
				);

				$attach_id = wp_insert_attachment($attachment, $file);

				require_once (ABSPATH . 'wp-admin/includes/image.php');

				$attach_data = wp_generate_attachment_metadata($attach_id, $file);

				wp_update_attachment_metadata($attach_id, $attach_data);

				set_post_thumbnail($songs_post_id, $attach_id);
			}
			$j++;
		}
		// add one section 

		//Set the blog with right sidebar template
		add_post_meta($contact_id, '_wp_page_template', 'page-template/contact.php');
		if (isset($home_b->ID)) {
			echo json_encode(['home_page_id' => $home_b->ID, 'home_page_url' => get_edit_post_link($home_b->ID, '')]);
		}



		if (isset($home_b->ID)) {
			echo json_encode(['home_page_id' => $home_b->ID, 'home_page_url' => get_edit_post_link($home_b->ID, '')]);
		}


		$VW_Widget_Importer = new VW_Widget_Importer;
		$VW_Widget_Importer->import_widgets($this->widget_file_url);

		exit;

	}




	// ------------ Ibtana Activation Close -----------
	//guidline for about theme


	public function vw_podcast_pro_mostrar_guide()
	{

		$display_string = '';

		// Check the validation Start
		$vw_podcast_pro_license_key = ThemeWhizzie::get_the_theme_key();
		$endpoint = IBTANA_THEME_LICENCE_ENDPOINT . 'ibtana_client_premium_theme_check_activation_status';
		$body = [
			'theme_license_key' => $vw_podcast_pro_license_key,
			'site_url' => site_url(),
			'theme_text_domain' => wp_get_theme()->get('TextDomain')
		];
		$body = wp_json_encode($body);
		$options = [
			'body' => $body,
			'headers' => [
				'Content-Type' => 'application/json',
			]
		];
		$response = wp_remote_post($endpoint, $options);
		if (is_wp_error($response)) {
			// ThemeWhizzie::set_the_validation_status('false');
		} else {
			$response_body = wp_remote_retrieve_body($response);
			$response_body = json_decode($response_body);

			if ($response_body->is_suspended == 1) {
				ThemeWhizzie::set_the_suspension_status('true');
			} else {
				ThemeWhizzie::set_the_suspension_status('false');
			}

			$display_string = isset($response_body->display_string) ? $response_body->display_string : '';

			if ($display_string != '') {
				if (strpos($display_string, '[THEME_NAME]') !== false) {
					$display_string = str_replace("[THEME_NAME]", "VW Podcast Pro", $display_string);
				}
				if (strpos($display_string, '[THEME_PERMALINK]') !== false) {
					$display_string = str_replace("[THEME_PERMALINK]", "https://www.vwthemes.com/themes/lens-wordpress-theme/", $display_string);
				}
				echo '<div class="notice is-dismissible error thb_admin_notices">' . $display_string . '</div>';
			}



			if ($response_body->status === false) {
				ThemeWhizzie::set_the_validation_status('false');
			} else {
				ThemeWhizzie::set_the_validation_status('true');
			}
		}
		// Check the validation END

		$theme_validation_status = ThemeWhizzie::get_the_validation_status();

		//custom function about theme customizer
		$return = add_query_arg(array());
		$theme = wp_get_theme('vw-podcast-pro');

		?>

		<div class="wrapper-info get-stared-page-wrap">

			<div class="wrapper-info-content">
				<h2>
					<?php _e('Welcome to VW Podcast Pro', 'vw-podcast-pro'); ?> <span class="version">Version:
						<?php echo esc_html($theme['Version']); ?>
					</span>
				</h2>
				<p>
					<?php _e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, block based and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.', 'vw-podcast-pro'); ?>
				</p>
			</div>
			<div class="tab-sec theme-option-tab">
				<div class="tab">
					<button class="tablinks active" onclick="openCity(event, 'theme_activation')" data-tab="theme_activation">
						<?php _e('Key Activation', 'vw-podcast-pro'); ?>
					</button>
					<button class="tablinks wizard-tab" onclick="openCity(event, 'demo_offer')" data-tab="demo_offer">
						<?php _e('Setup Wizard', 'vw-podcast-pro'); ?>
					</button>
					<button class="tablinks" onclick="openCity(event, 'theme_info')" data-tab="theme_info">
						<?php _e('Support', 'vw-podcast-pro'); ?>
					</button>
					<button class="tablinks" onclick="openCity(event, 'plugins')" data-tab="plugins">
						<?php _e('Plugins', 'vw-podcast-pro'); ?>
					</button>
					<button class="tablinks other-product-tab" onclick="openCity(event, 'others_theme')">
						<?php esc_html_e('All Themes', 'vw-podcast-pro'); ?>
					</button>
				</div>

				<!-- Tab content -->
				<div id="theme_activation" class="tabcontent open">

					<div class="theme_activation-wrapper">
						<div class="theme_activation_spinner">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								style="margin:auto;background:#fff;display:block;" width="200px" height="200px"
								viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
								<g transform="translate(50,50)">
									<g transform="scale(0.7)">
										<circle cx="0" cy="0" r="50" fill="#0f81d0"></circle>
										<circle cx="0" cy="-28" r="15" fill="#cfd7dd">
											<animateTransform attributeName="transform" type="rotate" dur="1s"
												repeatCount="indefinite" keyTimes="0;1" values="0 0 0;360 0 0">
											</animateTransform>
										</circle>
									</g>
								</g>
							</svg>
						</div>
						<div class="theme-wizard-key-status">
							<?php
							if ($theme_validation_status === 'false') {
								esc_html_e('Theme License Key is not activated!', 'vw-podcast-pro');
							} else {
								esc_html_e('Theme License is Activated!', 'vw-podcast-pro');
							}
							?>
						</div>
						<?php $this->activation_page(); ?>
					</div>
				</div>
				<div id="demo_offer" class="tabcontent">
					<?php $this->wizard_page(); ?>
				</div>
				<div id="theme_info" class="tabcontent">
					<div class="col-left-inner">
						<h3>
							<?php _e('VW Podcast Pro Information', 'vw-podcast-pro'); ?>
						</h3>
						<hr class="h3hr">
						<h4>
							<?php _e('Theme Documentation', 'vw-podcast-pro'); ?>
						</h4>
						<p>
							<?php _e('If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'vw-podcast-pro'); ?>
						</p>
						<div class="info-link">
							<a href="<?php echo esc_url(vw_podcast_pro_THEME_DOC); ?>" target="_blank">
								<?php _e('Documentation', 'vw-podcast-pro'); ?>
							</a>
						</div>
						<hr>
						<h4>
							<?php _e('Having Trouble, Need Support?', 'vw-podcast-pro'); ?>
						</h4>
						<p>
							<?php _e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'vw-podcast-pro'); ?>
						</p>
						<div class="info-link">
							<a href="<?php echo esc_url(vw_podcast_pro_SUPPORT); ?>" target="_blank">
								<?php _e('Support Forum', 'vw-podcast-pro'); ?>
							</a>
						</div>
						<hr>
						<h4>
							<?php _e('Reviews & Testimonials', 'vw-podcast-pro'); ?>
						</h4>
						<p>
							<?php _e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'vw-podcast-pro'); ?>
						</p>
						<div class="info-link">
							<a href="<?php echo esc_url(vw_podcast_pro_REVIEW); ?>" target="_blank">
								<?php _e('Reviews', 'vw-podcast-pro'); ?>
							</a>
						</div>
					</div>
					<div class="col-right-inner">
						<div id="vw-demo-setup-guid">
							<h3>
								<?php esc_html_e('Checkout our setup videos', 'vw-podcast-pro'); ?>
							</h3>
							<hr />
							<ul>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/nLB9E6BBBv0"><span
											class="dashicons dashicons-welcome-widgets-menus"></span>Setup Menu</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/gjccwcAK47o"><span
											class="dashicons dashicons-email-alt"></span>Setup Contact Page</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/7BvTpLh-RB8"><span
											class="dashicons dashicons-editor-table"></span>Setup Widgets</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/Mox298rk0Qo"><span
											class="dashicons dashicons-share"></span>Setup Social Icon</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/hLtS4sztAX4"><span
											class="dashicons dashicons-wordpress-alt"></span>Install WordPress Theme</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/8UxkXkix-ic"><span
											class="dashicons dashicons-admin-users"></span>Create WordPress User</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/1xGlbWOzQBg"><span
											class="dashicons dashicons-image-flip-horizontal"></span>Setup Slider</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/pJFF_wjdvcA"><span
											class="dashicons dashicons-database"></span>WordPress Backup</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/xXdnUTPG_6A"><span
											class="dashicons dashicons-instagram"></span>Connect Instagram</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/leLBzmbvdQQ"><span
											class="dashicons dashicons-table-col-delete"></span>Fix 404 Error</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/OPBONJBtO6g"><span
											class="dashicons dashicons-admin-page"></span>Setup Template Pages</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/j7veMuhcXYA"><span
											class="dashicons dashicons-video-alt3"></span>Create a New Post</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/ovcok3FPRto"><span
											class="dashicons dashicons-welcome-add-page"></span>Setup Shortcode Pages</a>
								</li>
								<li>
									<a href="javascript:void(0);"
										doc-video-url="https://www.youtube.com/embed/O6elK2kSHQw"><span
											class="dashicons dashicons-images-alt2"></span>Setup Gallery Plugin</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="wz-video-model">
				<span class="dashicons dashicons-no"></span>
				<iframe width="100%" src="" frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen></iframe>
			</div>
			<div id="plugins" class="tabcontent">
				<div class="wizard-plugin-wrapper">
					<div class="o-product-row">
						<div class="plugin-col ibtana-plugin-col">
							<img
								src="<?php echo esc_url(get_template_directory_uri() . '/theme-wizard/assets/images/banner-772x250.png'); ?>">
							<h3>
								<?php echo esc_html('Ibtana - WordPress Website Builder Plugin'); ?>
							</h3>
							<p>
								<?php echo esc_html('Ibtana Gutenberg Editor has ready made eye catching responsive templates build with custom blocks and options to extend Gutenberg’s default capabilities. You can easily import demo content for the block or templates with a single click'); ?>
							</p>
							<?php
							$plugin_ins = Vw_Premium_Theme_Plugin_Activation_Settings::get_instance();
							$vw_theme_actions = $plugin_ins->recommended_actions;

							if ($vw_theme_actions):
								foreach ($vw_theme_actions as $key => $vw_theme_actionValue):
									?>
									<div class="ibtana-activation-btn">
										<?php echo wp_kses_post($vw_theme_actionValue['link']); ?>
									</div>
								<?php endforeach;
							endif; ?>
						</div>
						<div class="plugin-col">
							<img
								src="<?php echo esc_url(get_template_directory_uri() . '/theme-wizard/assets/images/Ibtana-ecommerce-banner.png'); ?>">

							<h3>
								<?php echo esc_html('Ibtana – Woocommerce Product Addons'); ?>
							</h3>
							<p>
								<?php echo esc_html('Ibtana – Ecommerce Product Addons is excellent for designing a highly customized product page that shows your products in a more prominent and interesting way. With these product add ons, creating unique product pages is now possible.'); ?>
							</p>
							<a href="<?php echo esc_url('https://www.vwthemes.com/plugins/woocommerce-product-add-ons/'); ?>"
								target="_blank">
								<?php echo esc_html('Buy Now'); ?>
							</a>
						</div>
						<div class="plugin-col">
							<img
								src="<?php echo esc_url(get_template_directory_uri() . '/theme-wizard/assets/images/mega-menu.png'); ?>">

							<h3>
								<?php echo esc_html('Ibtana- Mega Menu Addon'); ?>
							</h3>
							<p>
								<?php echo esc_html('View our mega menu demos or start the setup wizard which will guide you through all the steps to set up your menus.'); ?>
							</p>
							<a href="<?php echo esc_url('https://www.vwthemes.com/plugins/woocommerce-product-add-ons/'); ?>"
								target="_blank">
								<?php echo esc_html('Buy Now'); ?>
							</a>
						</div>
						<div class="plugin-col">
							<img
								src="<?php echo esc_url(get_template_directory_uri() . '/theme-wizard/assets/images/VWThemes_banner_plugin.png'); ?>">
							<h3>
								<?php echo esc_html('Title Banner Image Plugin'); ?>
							</h3>
							<p>
								<?php echo esc_html('If you are interested in adding the banner images, you check VW Title Banner Plugin. Its main speciality is that it permits user the addition of banner image on post, custom post or any page. '); ?>
							</p>
							<a href="<?php echo esc_url('https://www.vwthemes.com/premium-plugin/vw-title-banner-plugin/'); ?>"
								target="_blank">
								<?php echo esc_html('Buy Now'); ?>
							</a>
						</div>

						<div class="plugin-col">
							<img
								src="<?php echo esc_url(get_template_directory_uri() . '/theme-wizard/assets/images/gallery_plugin_banner.png'); ?>">

							<h3>
								<?php echo esc_html('VW Gallery Images Plugin'); ?>
							</h3>
							<p>
								<?php echo esc_html('The VW Gallery Plugin is an amazing WordPress gallery plugin. It helps you in creating the elegant gallery within few minutes. The VW Gallery plugin offers the advantage of displaying multiple galleries on a single page or post.'); ?>
							</p>
							<a href="<?php echo esc_url('https://www.vwthemes.com/premium-plugin/vw-gallery-plugin/'); ?>"
								target="_blank">
								<?php echo esc_html('Buy Now'); ?>
							</a>
						</div>

					</div>
				</div>
			</div>
			<div id="others_theme" class="tabcontent">
				<script>

					var data_p			 ost = { "p			ara": "1" };

							jQuery.ajax({
								method: "POST",
								url: "https://www.vwthemes.com/wp-json/ibtana-licence/v2/get_modal_contents",
								data: JSON.stringify(data_post),
								dataType: 'json',
								contentType: 'application/json',
							}).done(function (data) {
								/*console.log(data);*/
								var premium_data = data.data.products;
								for (var i = 0; i < premium_data.length; i++) {
									var premium_product = premium_data[i];
									var card_content = `<div class="o-products-col" data-id="` + premium_product.id + `">
																																																																																																																				<div class="o-products-image">
																																																																																																																					<img src="`+ premium_product.image + `">
																																																																																																																				</div>
																																																																																																																				<h3>`+ premium_product.title + `</h3>
																																																																																																																				<a href="`+ premium_product.permalink + `" target="_blank">Buy Now</a>
																																																																																																																				<a href="`+ premium_product.demo_url + `" target="_blank">View Demo</a>
																																																																																																																			</div>`;
									jQuery('.wz-spinner-wrap').css('display', 'none');
									jQuery('#other-products .o-product-row').append(card_content);
								}

								var premium_category = data.data.sub;
								var active_class = ""
								/*console.log(premium_category.length);*/
								for (let i = 0; i < premium_category.length; i++) {
									if (i == 0) {
										active_class = "active";
									} else {
										active_class = "";
									}
									let premium_product = premium_category[i];
									let card_content = `<li data-ids="` + premium_product.product_ids + `" onclick="other_products(this);" class="` + active_class + `">
																																																																																																																				`+ premium_product.name + `<span class="badge badge-info">` + premium_product.product_ids.length + `</span>
																																																																																																																					</li>`;
									jQuery('.o-product-col-1 ul').append(card_content);
								}
							});

							function other_products(content) {

								jQuery('.o-product-col-1 ul li').attr('class', '');
								content.classList.add("active");
								var data_ids = jQuery(content).attr('data-ids');

								var id_arr = data_ids.split(',');
								jQuery('.o-product-row .o-products-col[data-id]').hide();
								for (var i = 0; i < id_arr.length; i++) {
									var single_id = id_arr[i];
									jQuery('.o-product-row .o-products-col[data-id="' + single_id + '"]').show();
								}

							}

						</script>
						<div id="other-products">
							<div class="wz-spinner-wrap">
								<div class="lds-dual-ring"></div>
							</div>
							<div class="o-product-main-row">
								<div class="o-product-col-1">
									<ul>

									</ul>
								</div>
								<div class="o-product-col-2">
									<div class="social-theme-search">
										<input class="themesearchinput" type="text" placeholder="Search Theme Here">
									</div>
									<div class="o-product-row" style="clear: both;">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>

		<?php }


	// Add a Custom CSS file to WP Admin Area
	public function vw_podcast_pro_admin_theme_style()
	{
		wp_enqueue_style('vw-podcast-pro-font', $this->vw_podcast_pro_admin_font_url(), array());
		wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/theme-wizard/getstarted/getstart.css');
		//( 'tab', get_template_directory_uri() . '/theme-wizard/getstarted/js/tab.js' );
	}

	// Theme Font URL
	public function vw_podcast_pro_admin_font_url()
	{
		$font_url = '';
		$font_family = array();

		$font_family[] = 'Muli:300,400,600,700,800,900';

		$query_args = array(
			'family' => urlencode(implode('|', $font_family)),
		);
		$font_url = add_query_arg($query_args, '//fonts.googleapis.com/css');
		return $font_url;
	}

}

