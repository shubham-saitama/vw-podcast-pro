<?php
/**
 * Renderer class
 *
 * @package VwWavePlayer/Renderer
 */

namespace PerfectPeach\VwWavePlayer;

defined( 'ABSPATH' ) || exit;

/**
 * Renderer class
 *
 * This class contains all the functions dealing with the interface
 *
 * @since 3.0.0
 * @package VwWavePlayer/Renderer
 */
class Renderer {

	const TEMPLATE_PATH           = 'interface/';
	const PLUGIN_SKIN_PATH        = self::TEMPLATE_PATH . 'skins/';
	const PLUGIN_PLACEHOLDER_PATH = self::TEMPLATE_PATH . 'placeholders/';
	const THEME_PATH              = '/vwwaveplayer/' . self::TEMPLATE_PATH;
	const THEME_SKIN_PATH         = self::THEME_PATH . 'skins/';
	const THEME_PLACEHOLDER_PATH  = self::THEME_PATH . 'placeholders/';

	/**
	 * Store the plugin options.
	 *
	 * @var array
	 */
	private static $options;

	/**
	 * All the skins used by the instances of one page
	 * in addition to the default one
	 *
	 * @var array
	 */
	private static $used_skins = array();

	/**
	 * All the palettes used by the instances of one page
	 * in addition to the default one
	 *
	 * @var array
	 */
	private static $used_palettes = array();

	/**
	 * The tracks used in the current page.
	 */
	private static $used_tracks = array();

	/**
	 * All the instances loaded on the current page
	 *
	 * @var array
	 */
	private static $instances = array();

	/**
	 * Register all the action and filter callbacks
	 * related to the rendering of the interface
	 *
	 * @since  3.0.0
	 */
	public static function load() {
		add_shortcode( 'vwwaveplayer', array( __CLASS__, 'vwwaveplayer_shortcode' ) );
		add_shortcode( 'vwwaveplayer_stack', array( __CLASS__, 'vwwaveplayer_stack' ) );
		add_shortcode( 'vwwaveplayer_rss', array( __CLASS__, 'vwwaveplayer_rss' ) );
		add_filter( 'wp_audio_shortcode_override', array( __CLASS__, 'audio_shortcode' ), 10, 4 );
		add_filter( 'the_content', array( __CLASS__, 'replace_audio_blocks' ), 1 );
		add_filter( 'post_playlist', array( __CLASS__, 'playlist_shortcode' ), 10, 3 );

		if ( wp_doing_ajax() || wp_doing_cron() ) {
			return;
		}

		add_action( 'init', array( __CLASS__, 'register_block_type' ), 10 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'register_block_styles' ), 20 );

		add_action( 'wp_footer', array( __CLASS__, 'print_sticky_player' ), 10 );
		add_action( 'wp_footer', array( __CLASS__, 'print_placeholder_templates' ), 100 );
		add_action( 'wp_footer', array( __CLASS__, 'print_svg_icons' ), 9999 );
		add_action( 'wp_footer', array( __CLASS__, 'print_additional_styles' ), 9999 );
		add_action( 'wp_footer', array( __CLASS__, 'print_instance_track_data' ), 9999 );
		add_action( 'wp_footer', array( __CLASS__, 'print_script_with_used_tracks' ), 9999 );
		add_filter( 'media_view_strings', array( __CLASS__, 'media_string' ), 10, 2 );
		add_action( 'admin_footer', array( __CLASS__, 'print_placeholder_templates' ) );
		add_action( 'admin_footer', array( __CLASS__, 'media_template' ) );
		add_action( 'admin_footer', array( __CLASS__, 'print_svg_icons' ), 9999 );
		add_action( 'admin_footer', array( __CLASS__, 'print_instance_track_data' ), 9999 );

		add_action( 'rss_item', array( __CLASS__, 'add_rss_enclosure' ), 10 );
		add_action( 'rss2_item', array( __CLASS__, 'add_rss_enclosure' ), 10 );
		add_action( 'atom_entry', array( __CLASS__, 'add_atom_links' ), 10 );

		add_filter( 'vwwaveplayer_cached_tracks', array( __CLASS__, 'update_cached_tracks' ) );

		self::$used_skins    = array( vwwaveplayer()->get_option( 'skin' ) );
		self::$used_palettes = array( vwwaveplayer()->get_option( 'default_palette' ) );
	}

	/**
	 * Register the assets for the Gutenberg block
	 *
	 * @since  3.0.0
	 */
	public static function register_block_assets() {
	}

	/**
	 * Register the assets for the Gutenberg block editor
	 *
	 * @since  3.0.0
	 */
	public static function register_block_editor_assets() {
	}

	/**
	 * Register the extra styles for the Gutenberg block
	 *
	 * @since  3.0.0
	 */
	public static function register_block_styles() {
		foreach ( self::get_skins() as $skin ) {
			wp_register_style(
				"vwwaveplayer-skin-{$skin['skin']}",
				self::get_skin_url( $skin['skin'], 'style' ),
				array(),
				filemtime( self::get_skin_resource( $skin['skin'], 'style' ) )
			);
			wp_enqueue_style( "vwwaveplayer-skin-{$skin['skin']}" );
		}
		foreach ( self::get_palettes() as $palette ) {
			wp_add_inline_style( 'vwwaveplayer_admin_style', self::get_palette_style( $palette['colors'] ) );
		}
	}

	/**
	 * Register the VwWavePlayer Gutenberg block type
	 *
	 * @since  3.0.0
	 */
	public static function register_block_type() {
		$asset      = include plugin_dir_path( __DIR__ ) . 'assets/block/index.asset.php';
		$script_url = plugin_dir_url( __DIR__ ) . 'assets/block/index.js';
		$style_url  = plugin_dir_url( __DIR__ ) . 'assets/block/style-index.css';

		wp_register_script(
			'vwwaveplayer-block',
			$script_url,
			$asset['dependencies'],
			$asset['version'],
			true
		);
		wp_register_style(
			'vwwaveplayer-frontend',
			$style_url,
			array(),
			$asset['version'],
		);
		register_block_type(
			plugin_dir_path( __DIR__ ) . 'assets/block',
			array(
				'editor_script'   => 'vwwaveplayer-block',
				'editor_style'    => 'vwwaveplayer-block',
				'style'           => 'vwwaveplayer-frontend',
				'render_callback' => array( __CLASS__, 'vwwaveplayer_shortcode' ),
				'supports'        => array(
					'html' => false,
				),
			)
		);
	}

	/**
	 * Minify the CSS code of the dynamic styles
	 *
	 * @since  3.0.6
	 * @param  string $css The CSS code to be minified.
	 * @return string      The minified CSS code
	 */
	public static function minify_css( $css ) {
		$minified_css = preg_replace( '!/ {2;}/!', ' ', $css );
		$minified_css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minified_css );
		$minified_css = preg_replace( '/(\r\n|\n{1,}|\r{1,}|\t{1,}| {2,})/', '', $minified_css );
		$minified_css = str_replace( array( '{ ', ' {', ' }', '} ', '; ', ': ' ), array( '{', '{', '}', '}', ';', ':' ), $minified_css );
		return $minified_css;
	}

	/**
	 * Check whether the user is currently editing a post using the Gutenberg editor
	 *
	 * @since 3.0.4
	 * @return boolean
	 */
	public static function is_gutenberg_editor() {
		global $current_screen;

		return is_admin() && ( $current_screen instanceof \WP_Screen ) && $current_screen->is_block_editor();
	}

	/**
	 * Check whether the user is currently editing a post using the Elementor editor
	 *
	 * @since 3.0.4
	 * @return boolean
	 */
	public static function is_elementor_editor() {
		if ( ! class_exists( 'Elementor\Plugin' ) ) {
			return false;
		}
		return \Elementor\Plugin::$instance->editor->is_edit_mode();
	}

	/**
	 * Get the path or URL of a skin resource
	 *
	 * @since  3.0.0
	 * @param  string  $skin       The name of the skin.
	 * @param  string  $type       The type of resource to be loaded.
	 *                             It can be 'main' for the markup, 'style' or 'script'.
	 * @param  boolean $return_url Whether the function should return the local path or the URL of the resource.
	 * @return string              The path or the URL of the resource
	 */
	private static function get_skin_resource( $skin, $type = 'main', $return_url = false ) {
		if ( 'default' === $skin ) {
			$skin = vwwaveplayer()->get_option( 'skin' );
		}

		$suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$file_type_names = array(
			'main'   => 'index.php',
			'style'  => "style$suffix.css",
			'script' => "script$suffix.js",
		);

		$theme_skin_path  = self::THEME_SKIN_PATH . "$skin/{$file_type_names[$type]}";
		$plugin_skin_path = self::PLUGIN_SKIN_PATH . "$skin/{$file_type_names[$type]}";

		if ( file_exists( get_stylesheet_directory() . $theme_skin_path ) ) {
			$base = $return_url ? get_stylesheet_directory_uri() : get_stylesheet_directory();
			return $base . $theme_skin_path;
		} elseif ( file_exists( plugin_dir_path( __DIR__ ) . $plugin_skin_path ) ) {
			$base = $return_url ? plugin_dir_url( __DIR__ ) : plugin_dir_path( __DIR__ );
			return $base . $plugin_skin_path;
		}
		return false;
	}

	/**
	 * Get the path or URL of a placeholder resource
	 *
	 * @since  3.0.0
	 * @param  string  $placeholder The name of the skin.
	 * @param  boolean $return_url  Whether the function should return the path or the URL of the resource.
	 * @return string               The path or the URL of the placeholder resource
	 */
	private static function get_placeholder_resource( $placeholder, $return_url = false ) {

		$theme_placeholder_path  = self::THEME_PLACEHOLDER_PATH . "$placeholder.php";
		$plugin_placeholder_path = self::PLUGIN_PLACEHOLDER_PATH . "$placeholder.php";

		if ( file_exists( get_stylesheet_directory() . $theme_placeholder_path ) ) {
			$base = $return_url ? get_stylesheet_directory_uri() : get_stylesheet_directory();
			return $base . $theme_placeholder_path;
		} elseif ( file_exists( plugin_dir_path( __DIR__ ) . $plugin_placeholder_path ) ) {
			$base = $return_url ? plugin_dir_url( __DIR__ ) : plugin_dir_path( __DIR__ );
			return $base . $plugin_placeholder_path;
		} else {
			return false;
		}
	}

	/**
	 * Get the path of a skin file
	 *
	 * @since  3.0.0
	 * @param  string $skin The name of the skin.
	 * @param  string $type The type of resource to be loaded.
	 *                      It can be 'main' for the markup, 'style' or 'script'.
	 * @return string       The path of the skin file
	 */
	private static function get_skin_file( $skin, $type = 'main' ) {
		return wp_normalize_path( self::get_skin_resource( $skin, $type ) );
	}

	/**
	 * Get the URL of a skin file
	 *
	 * @since  3.0.0
	 * @param  string $skin The name of the skin.
	 * @param  string $type The type of resource to be loaded.
	 *                      It can be 'main' for the markup, 'style' or 'script'.
	 * @return string       The URL of the skin file
	 */
	public static function get_skin_url( $skin, $type = 'main' ) {
		return self::get_skin_resource( $skin, $type, true );
	}

	/**
	 * Get the path of a placeholder file
	 *
	 * @since  3.0.0
	 * @param  string $placeholder The name of the skin.
	 * @return string              The path of the skin file
	 */
	private static function get_placeholder_file( $placeholder ) {
		return self::get_placeholder_resource( $placeholder );
	}

	/**
	 * Get the URL of a placeholder file
	 *
	 * @since  3.0.0
	 * @param  string $placeholder The name of the skin.
	 * @return string              The URL of the skin file
	 */
	private static function get_placeholder_url( $placeholder ) {
		return self::get_placeholder_resource( $placeholder, true );
	}

	/**
	 * Get the available skins
	 *
	 * @since  3.0.0
	 * @return array An array of the available skins
	 */
	public static function get_skins() {
		static $skins = array();

		if ( empty( $skins ) ) {
			$files = glob( plugin_dir_path( __DIR__ ) . self::PLUGIN_SKIN_PATH . '*', GLOB_ONLYDIR );
			$files = array_merge( $files, glob( get_stylesheet_directory() . self::THEME_SKIN_PATH . '*', GLOB_ONLYDIR ) );

			$files = array_filter(
				$files,
				function( $file ) {
					return file_exists( $file . '/index.php' );
				}
			);
			$files = array_map(
				function( $file ) {
					return $file . '/index.php';
				},
				$files
			);

			foreach ( $files as $filename ) {
				$file_data      = get_file_data(
					$filename,
					array(
						'name'        => 'Skin Name',
						'support'     => 'Supports',
						'version'     => 'Version',
						'author'      => 'Author',
						'author_uri'  => 'Author URI',
						'description' => 'Description',
					)
				);
				$skin           = basename( str_replace( 'index.php', '', $filename ) );
				$support        = array_map( 'trim', explode( ',', $file_data['support'] ) );
				$skins[ $skin ] = array(
					'skin'        => $skin,
					'name'        => $file_data['name'],
					'file'        => $filename,
					'description' => $file_data['description'],
					'support'     => $support,
				);
			}
		}

		return $skins;
	}

	/**
	 * Get the CSS style that applies a given palette
	 * provided as a sequence of 12 dash-separated 6-digit color codes
	 *
	 * @since  3.0.0
	 * @param  string $colors The palette of 12 dash-separated 6-digit color codes.
	 * @return string         The CSS style for the palette
	 */
	public static function get_palette_style( $colors ) {
		$vars = array( 'fc', 'fc-s', 'bc', 'bc-s', 'hc', 'hc-s', 'wc', 'wc-s', 'pc', 'pc-s', 'cc', 'cc-s' );

		$color_array = explode( '-', $colors );
		$color_array = array_map(
			function( $color, $var ) {
				$rgb = '';
				if ( preg_match( '/([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})/i', $color, $matches ) ) {
					$rgb = hexdec( $matches[1] ) . ',' . hexdec( $matches[2] ) . ',' . hexdec( $matches[3] );
				}
				return "--$var: $rgb";
			},
			$color_array,
			$vars
		);
		$rules       = implode( '; ', $color_array );
		$palette_id  = md5( $colors );
		return ".vwwvpl-palette-$palette_id { $rules }";
	}

	/**
	 * Get the HTML markup of the options for the skin selectbox
	 *
	 * @since  3.0.0
	 * @param  string $prefix The name of the skin.
	 * @return string         The HTML markup of the options for the skin selectbox
	 */
	public static function get_skin_options( $prefix = '' ) {
		ob_start();

		$options = vwwaveplayer()->get_options();

		$option = $prefix ? $prefix : 'skin';

		foreach ( self::get_skins() as $skin ) { ?>
			<option
				name="<?php echo esc_attr( "{$option}_{$skin['skin']}" ); ?>"
				value="<?php echo esc_attr( $skin['skin'] ); ?>"
				data-support="<?php echo esc_attr( implode( ',', $skin['support'] ) ); ?>" <?php selected( $options[ $option ], $skin['skin'] ); ?>
				title="<?php echo esc_attr( $skin['description'] ); ?>"
			><?php echo esc_html( $skin['name'] ); ?></option>
			<?php
		}

		return ob_get_clean();
	}

	/**
	 * Get the palettes stored in the database
	 *
	 * @since  3.0.0
	 * @return array The palettes stored in the database
	 */
	public static function get_palettes() {
		$palettes = get_option( 'vwwaveplayer_palettes', self::factory_palettes() );
		foreach ( $palettes as &$palette ) {
			$palette['id'] = md5( $palette['colors'] );
		}
		return array_values( $palettes );
	}

	/**
	 * Print the palette selectbox
	 *
	 * @since  3.0.0
	 */
	public static function print_palette_selectbox() {
		$default_palette = vwwaveplayer()->get_option( 'default_palette' );

		$palettes = get_option( 'vwwaveplayer_palettes', self::factory_palettes() );

		$index = array_search( $default_palette, array_column( $palettes, 'colors' ), true );
		if ( ! is_numeric( $index ) ) {
			$index           = 0;
			$default_palette = $palettes[ $index ]['colors'];
		}

		$default_colors = explode( '-', $default_palette );
		?>

		<div class="vwwvpl-palette-selectbox">
			<div class="vwwvpl-palette-item">
				<span class="vwwvpl-palette-item-name"><?php echo esc_html( $palettes[ $index ]['name'] ); ?></span>
				<?php foreach ( $default_colors as $color ) { ?>
					<span class="vwwvpl-palette-item-swatch" style="background-color:#<?php echo esc_attr( $color ); ?>;"></span>
				<?php } ?>
			</div>
			<ul>
				<?php
				foreach ( $palettes as $index => $palette ) {
					$colors = explode( '-', $palette['colors'] );
					?>
					<li class="vwwvpl-palette-item <?php echo esc_attr( $default_palette === $palette['colors'] ? 'selected' : '' ); ?>" data-id="<?php echo esc_attr( md5( $palette['colors'] ) ); ?>" data-colors="<?php echo esc_attr( $palette['colors'] ); ?>">
						<span class="vwwvpl-palette-item-name"><?php echo esc_html( $palette['name'] ); ?></span>
						<?php foreach ( $colors as $color ) { ?>
							<span class="vwwvpl-palette-item-swatch" style="background-color:#<?php echo esc_attr( $color ); ?>;"></span>
						<?php } ?>
					</li>
				<?php } ?>
			</ul>
			<input type="hidden" name="vwwaveplayer_default_palette" value="<?php echo esc_attr( $default_palette ); ?>"/>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Include the skin markup
	 *
	 * @since  3.0.0
	 * @param  string $skin The name of the skin.
	 * @param  string $type The type of file that is requested (HTML markup, style or script).
	 * @param  array  $args The array of arguments prepared by the shortcode.
	 * @return string       The HTML markup of the skin
	 */
	public static function get_skin( $skin, $type = 'main', $args = array() ) { //phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
		ob_start();

		$skin_file = self::get_skin_file( $skin, $type );
		if ( $skin_file ) {
			include $skin_file;
		} else {
			?>
			<div class="skin-error">
				<?php esc_html_e( 'VwWavePlayer could not find the selected skin. Please check your settings or reinstall the plugin.', 'vwwaveplayer' ); ?>
			</div>
			<?php
		}

		return ob_get_clean();
	}

	/**
	 * Include the placeholder markup
	 *
	 * @since  3.0.0
	 * @param  string $placeholder The name of the placeholder.
	 * @param  array  $args        The array of arguments prepared by the shortcode.
	 * @return string              The HTML markup of the placeholder
	 */
	private static function get_placeholder( $placeholder, $args = array() ) { //phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
		ob_start();

		$placeholder_file = self::get_placeholder_file( $placeholder );
		if ( $placeholder_file ) {
			include $placeholder_file;
		}

		return ob_get_clean();
	}

	/**
	 * Print the skin to the page
	 *
	 * @since  3.0.0
	 * @param  string $skin The name of the skin.
	 * @param  string $type The type of file that is requested (HTML markup, style or script).
	 * @param  array  $args The array of arguments prepared by the shortcode.
	 */
	private static function print_skin( $skin, $type = 'main', $args = array() ) {
		if ( 'main' === $type ) {
			do_action( 'vwwaveplayer_before_instance', $skin, $type, $args );
		}

		echo '<div class="vwwaveplayer-container">';

		echo self::get_skin( $skin, $type, $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		echo '</div>';

		if ( 'main' === $type ) {
			do_action( 'vwwaveplayer_after_instance', $skin, $type, $args );
		}
	}

	/**
	 * Print the placeholder to the page
	 *
	 * @since  3.0.0
	 * @param  string $placeholder The name of the placeholder.
	 * @param  array  $args        The array of arguments prepared by the shortcode.
	 */
	private static function print_placeholder( $placeholder, $args = array() ) {
		echo self::get_placeholder( $placeholder, $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}


	/**
	 * Get the style of a skin
	 *
	 * @since  3.0.0
	 * @param  string $skin The name of the skin.
	 * @return string       The HTML markup of the style
	 */
	public static function get_skin_style( $skin ) {
		$skin_file = self::get_skin_file( $skin, 'style' );
		if ( $skin_file ) {
			ob_start();

			include $skin_file;

			return ob_get_clean();
		}
		return false;
	}

	/**
	 * Print the CSS style of a skin
	 *
	 * @since  3.0.0
	 * @param  string $skin The name of the skin.
	 */
	public static function print_style( $skin ) {
		?>
		<style>
			<?php echo self::minify_css( self::get_skin_style( $skin ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</style>
		<?php
	}

	/**
	 * Print the CSS style of a palette
	 *
	 * @since  3.0.0
	 * @param  string $colors The sequence of the 12 dash-separated 6-digit color codes.
	 */
	public static function print_palette( $colors ) {
		?>
		<style>
			<?php echo self::minify_css( self::get_palette_style( $colors ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</style>
		<?php
	}

	/**
	 * Print the HTML markup of the sticky player
	 *
	 * @since  3.0.0
	 */
	public static function print_sticky_player() {
		$options = vwwaveplayer()->get_options();
		if ( 'disabled' === $options['sticky_player_position'] ) {
			return;
		}

		$position   = isset( $options['sticky_player_position'] ) ? $options['sticky_player_position'] : 'bottom';
		$palette_id = md5( $options['default_palette'] );
		$classes    = array( "vwwvpl-style-{$options['style']}", "vwwvpl-palette-$palette_id" );

		/**
		 * Filters the array of classes being added to the sticky player instance.
		 *
		 * @since 3.0.0
		 * @param array   $classes An array containing all the classes being added to the player instance
		 */
		$classes = implode( ' ', apply_filters( 'vwwaveplayer_sticky_player_classes', $classes ) );

		include_once self::include_template( 'sticky' );
	}

	/**
	 * Include a template
	 *
	 * @since 3.0.10
	 * @param string $template The template name.
	 * @param string $part     An optional part for the template.
	 */
	public static function include_template( $template, $part = '' ) {

		if ( $part ) {
			$template = "$template-$part";
		}

		$theme_template_path  = get_stylesheet_directory() . self::THEME_PATH . "$template.php";
		$plugin_template_path = plugin_dir_path( __DIR__ ) . self::TEMPLATE_PATH . "$template.php";

		if ( file_exists( $theme_template_path ) ) {
			return $theme_template_path;
		} elseif ( file_exists( $plugin_template_path ) ) {
			return $plugin_template_path;
		}
	}

	/**
	 * Print the SVG icons
	 *
	 * @since  3.0.0
	 */
	public static function print_svg_icons() {
		$svg_icons = plugin_dir_path( __DIR__ ) . 'assets/img/icons.svg';
		if ( file_exists( $svg_icons ) ) {
			require_once $svg_icons;
		}
	}

	/**
	 * Print the placeholder templates
	 *
	 * @since  3.0.0
	 */
	public static function print_placeholder_templates() {

		$placeholders = array();
		foreach ( glob( plugin_dir_path( __DIR__ ) . self::PLUGIN_PLACEHOLDER_PATH . '/*.php' ) as $filename ) {
			$placeholders[] = basename( $filename, '.php' );
		}
		foreach ( glob( get_stylesheet_directory() . self::THEME_PLACEHOLDER_PATH . '/*.php' ) as $filename ) {
			$placeholders[] = basename( $filename, '.php' );
		}
		$placeholders = array_unique( $placeholders );

		?>

		<script type="text/html" id="tmpl-placeholders">
			<% var s = track[ key ] || ''; <?php // phpcs:ignore Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound ?>
				switch (key) {
					<?php foreach ( $placeholders as $placeholder ) { ?>
						case '<?php echo esc_attr( $placeholder ); ?>': %>
							<?php self::print_placeholder( $placeholder ); ?>
							<% break; <?php // phpcs:ignore Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound ?>
					<?php } ?>
					default: %>
						<?php self::print_placeholder( 'default' ); ?>
					<%  break; <?php // phpcs:ignore Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound ?>
			} %>
		</script>

		<?php
	}

	/**
	 * Return the average color of an image and its best contrasting color
	 *
	 * @since  3.0.10
	 * @param  string $image_url The URL of an image.
	 * @return array             The array containing the two colors
	 */
	public static function get_image_colors( $image_url ) {
		$image  = imagecreatefromstring( wp_remote_retrieve_body( wp_remote_get( $image_url ) ) );
		$width  = imagesx( $image );
		$height = imagesy( $image );
		$pixel  = imagecreatetruecolor( 1, 1 );
		imagecopyresampled( $pixel, $image, 0, 0, 0, 0, 1, 1, $width, $height );
		$rgb   = imagecolorat( $pixel, 0, 0 );
		$color = imagecolorsforindex( $pixel, $rgb );

		$background_color = "{$color['red']},{$color['green']},{$color['blue']}";
		$color            = ( $color['red'] * 0.299 + $color['green'] * 0.587 + $color['blue'] * 0.114 ) > 186 ? '#000' : '#fff';

		return array( $background_color, $color );
	}

	/**
	 * Generate the [vwwaveplayer] shortcode
	 *
	 * @since  3.0.0
	 * @param  array  $atts    The parameters of the shortcode.
	 * @param  string $content The content of the shortcode (not used).
	 * @return string
	 */
	public static function vwwaveplayer_shortcode( $atts, $content = '' ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
		global $product;

		$options = vwwaveplayer()->get_options();
		$atts    = (array) $atts;
		$args    = shortcode_atts(
			array(
				'ids'                  => '',
				'url'                  => '',
				'limit'                => '0',
				'mode'                 => 'normal',
				'skin'                 => $options['skin'],
				'palette'              => $options['default_palette'],
				'style'                => $options['style'],
				'size'                 => $options['size'],
				'shape'                => $options['shape'],
				'override_wave_colors' => $options['override_wave_colors'],
				'wave_mode'            => $options['wave_mode'],
				'gap_width'            => $options['gap_width'],
			),
			$atts,
			'vwwaveplayer'
		);

		$args = array_merge( $atts, $args );

		if ( is_a( $product, 'WC_Product' ) ) {
			$args['product'] = $product->get_id();
		}

		if ( ! in_array( $args['skin'], array_keys( self::get_skins() ), true ) ) {
			$args['skin'] = $options['skin'];
		}

		switch ( $args['size'] ) {
			case 'large':
			case 'lg':
				$args['size'] = 'lg';
				break;
			case 'medium':
			case 'md':
				$args['size'] = 'md';
				break;
			case 'small':
			case 'sm':
				$args['size'] = 'sm';
				break;
			case 'xsmall':
			case 'xs':
				$args['size'] = 'xs';
				break;
		}

		$taxonomies = get_object_taxonomies( 'attachment:audio', 'objects' );
		$tax_tracks = array();
		$post_args  = array(
			'posts_per_page' => -1,
			'post_type'      => 'attachment',
			'post_mime_type' => 'audio',
			'post_status'    => 'any',
			'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				'relation' => 'AND',
			),
		);
		foreach ( $taxonomies as $tax_name => $tax ) {
			if ( isset( $args[ $tax_name ] ) && '' !== $args[ $tax_name ] ) {

				switch ( $args[ $tax_name ] ) {
					case 'all':
					case '*':
						break;
					default:
						$post_args['tax_query'][] = array(
							'taxonomy' => 'music_genre',
							'field'    => 'slug',
							'terms'    => explode( ',', $args[ $tax_name ] ),
						);
						break;
				}
				$tracks = get_posts( $post_args );
				foreach ( $tracks as $t ) {
					$tax_tracks[] = $t->ID;
				}
				$limit = intval( $args['limit'] );
				if ( $limit ) {
					$tax_tracks = array_splice( $tax_tracks, 0, $limit );
				}
			}
		}
		if ( $tax_tracks ) {
			$args['ids'] = implode( ',', array_merge( explode( ',', $args['ids'] ), $tax_tracks ) );
		}

		if ( $args['url'] ) {
			$ids_array = array();
			$url_array = explode( ',', $args['url'] );
			foreach ( $url_array as $key => $url ) {
				$att_id = vwwaveplayer()->attachment_url_to_postid( $url );
				if ( $att_id ) {
					$ids_array[] = $att_id;
					unset( $url_array[ $key ] );
				}
			}
			$args['ids'] = implode( ',', array_merge( explode( ',', $args['ids'] ), $ids_array ) );
			$args['url'] = implode( ',', $url_array );
		}

		if ( ! $args['ids'] && ! $args['url'] && $product ) {
			$preview_files = WooCommerce::get_preview_files( $product->get_id() );
			if ( $preview_files ) {
				if ( isset( $preview_files['ids'] ) ) {
					$args['ids'] = implode( ',', $preview_files['ids'] );
				}
				if ( isset( $preview_files['url'] ) ) {
					$args['url'] = implode( ',', $preview_files['url'] );
				}
			} else {
				return '';
			}
			unset( $args['type'] );
		}

		if ( 'separate' === $args['mode'] || true === $args['mode'] ) {
			$stack = '';
			foreach ( array_filter( explode( ',', $args['ids'] ) ) as $id ) {
				$single_args        = $args;
				$single_args['ids'] = $id;
				unset( $single_args['url'] );

				$stack .= self::shortcode_content( $single_args );
			}
			foreach ( array_filter( explode( ',', $args['url'] ) ) as $url ) {
				$single_args        = $args;
				$single_args['url'] = $url;
				unset( $single_args['ids'] );

				$stack .= self::shortcode_content( $single_args );
			}

			return $stack;
		} else {
			return self::shortcode_content( $args );
		}
	}

	/**
	 * 
	 */
	private static function shortcode_content( $args ) {
		static $index = 1;
		$label        = "player $index";
		Debug::start( $label );

		global $post;

		$options            = vwwaveplayer()->get_options();
		$options['palette'] = $options['default_palette'];
		unset( $options['default_palette'] );

		$post_id = 0;
		if ( $post ) {
			$post_id = $post->ID;
		}

		/**
		 * Filter the rendering of instances for REST requests
		 *
		 * @since 3.1.1
		 * @param boolean $no_render_in_rest Whether the instance should be rendered in REST requests or not
		 */
		$no_render_in_rest = apply_filters( 'vwwaveplayer_no_render_in_rest', false, $post_id ) && vwwaveplayer()->is_rest_request();

		if ( is_feed() || $no_render_in_rest ) {
			$html = '';
			$ids  = explode( ',', $args['ids'] );
			$urls = explode( ',', $args['url'] );
			if ( ! empty( $args['url'] ) && $urls ) {
				foreach ( $urls as $url ) {
					$html .= "<figure class=\"wp-block-audio\"><audio controls src=\"$url\"></audio></figure>";
				}
			} elseif ( isset( $args['ids'] ) && $ids ) {
				foreach ( $ids as $id ) {
					$url = wp_get_attachment_url( $id );
					$src = wp_get_attachment_image_url( get_post_thumbnail_id( $id ) );
					if ( $src ) {
						$html .= "<p><img src=\"$src\" /></p>";
					}
					$html .= "<figure class=\"wp-block-audio\"><audio controls src=\"$url\"></audio></figure>";
				}
			}
			return $html;
		}

		$config_id   = md5( implode( '', $args ) );
		$instance_id = $config_id . '-' . uniqid();
		$nonce       = wp_create_nonce( $instance_id );

		$args['instance_id'] = $instance_id;

		$tracks = array();
		$data   = get_transient( "vwwaveplayer_instance_data_$config_id" );
		Debug::log( $data );

		/**
		 * Filter the result of the existance of a cache file
		 * so that the instance caching can be globally deactivated
		 *
		 * @since 3.0.7
		 * @param boolean $use_caching Whether the instance should be cached
		 */
		$is_cached = apply_filters( 'vwwaveplayer_use_instance_caching', ! empty( $data ) );

		if ( $is_cached ) {
			$instance_id                 = $config_id . '-' . uniqid();
			$data['args']['instance_id'] = $instance_id;
			$args                        = array_merge( $options, $data['args'] );
			$data['tracks']              = array_map(
				function ( $track ) {
					if ( ! empty( $track['peaks'] ) ) {
						// phpcs:reason The `peaks` property can contain unicode characters requiring base64 encoding.
						// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
						$track['peaks'] = base64_decode( $track['peaks'] );
					}

					return $track;
				},
				$data['tracks']
			);

			/**
			 * Filter the tracks cached for a given instance
			 * so that their properties can be updated
			 *
			 * @since 3.5
			 * @param boolean $use_caching Whether the instance should be cached
			 */
			$tracks = apply_filters( 'vwwaveplayer_cached_tracks', $data['tracks'], $args );
			Debug::lap( $label, "from cache" );
		}

		if ( ! $is_cached || empty( $tracks ) ) {
			$tracks = array();

			if ( isset( $args['ids'] ) ) {
				$tracks = array_merge( $tracks, AJAX::create_playlist( $args['ids'], $post_id ) );
			}

			if ( isset( $args['url'] ) && $args['url'] ) {
				$tracks = array_merge( $tracks, AJAX::create_external_playlist( $args['url'], $post_id ) );
			}

			if ( isset( $args['tracks'] ) ) {
				$track_param = json_decode( base64_decode( $args['tracks'] ), true ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
				if ( is_array( $track_param ) ) {
					foreach ( $track_param as &$track ) {
						$track = AJAX::read_info( $track );
					}
				}
				$tracks = array_merge( $tracks, $track_param );
			}

			$cached_args = array_filter(
				$args,
				function ( $value, $key ) use ( $options ) {
					return $value !== ( $options[ $key ] ?? null );
				},
				ARRAY_FILTER_USE_BOTH
			);

			$cached_tracks = array_map(
				function ( $track ) {
					if ( ! empty( $track['peaks'] ) ) {
						// phpcs:reason The `peaks` property can contain unicode characters requiring base64 encoding.
						// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
						$track['peaks'] = base64_encode( $track['peaks'] );
					}

					return $track;
				},
				$tracks
			);

			$data = array(
				'args'   => $cached_args,
				'tracks' => $cached_tracks,
			);

			set_transient( "vwwaveplayer_instance_data_$config_id", $data, WEEK_IN_SECONDS );
			Debug::lap( $label, "no cache or peaks found" );
		}

		if ( ( isset( $args['shuffle'] ) && $args['shuffle'] ) || ( isset( $options['shuffle'] ) && $options['shuffle'] ) ) {
			shuffle( $tracks );
		}

		if ( wp_doing_ajax() || vwwaveplayer()->is_ajax() || self::is_gutenberg_editor() || self::is_elementor_editor() || vwwaveplayer()->is_json_request() ) {
			$args['tracks'] = base64_encode( wp_json_encode( $tracks ) ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
			$args['nonce']  = $nonce;
		} else {
			self::$instances[ $instance_id ] = array(
				'args'   => $args,
				'nonce'  => $nonce,
				'tracks' => base64_encode( wp_json_encode( $tracks ) ), // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
			);

			self::$used_tracks = array_merge(
				self::$used_tracks,
				array_map(
					function( $t ) {
						return $t['id'];
					},
					$tracks
				)
			);
		}

		unset( $args['ids'] );
		unset( $args['url'] );

		$colors          = $args['palette'];
		$args['palette'] = md5( $args['palette'] );

		$classes = array(
			'vwwaveplayer',
			'loading',
			"vwwvpl-skin-{$args['skin']}",
			"vwwvpl-palette-{$args['palette']}",
			"vwwvpl-style-{$args['style']}",
		);

		$skin_object = self::get_skins()[ $args['skin'] ] ?? null;

		if ( $skin_object ) {
			if ( in_array( 'size', $skin_object['support'], true ) ) {
				$classes[] = "vwwvpl-size-{$args['size']}";
			}

			if ( in_array( 'shape', $skin_object['support'], true ) ) {
				$classes[] = "vwwvpl-shape-{$args['shape']}";
			}

			if ( in_array( 'playlist', $skin_object['support'], true ) && (int) $options['full_width_playlist'] ) {
				$classes[] = 'vwwvpl-full-width-playlist';
			}
		}

		$classes = array_unique( array_merge( $classes, explode( ' ', $args['class'] ?? '' ), explode( ' ', $args['className'] ?? '' ) ) );

		unset( $args['palette'], $args['class'] );

		/**
		 * Filters the array of classes being added to the player instance.
		 *
		 * @since 3.0.0
		 * @param array   $classes An array containing all the classes being added to the player instance
		 * @param string  $post    The post object of the post or page containing the player instance
		 */
		$classes = apply_filters( 'vwwaveplayer_player_classes', $classes, $post );

		$dataset = array();
		foreach ( $args as $name => $value ) {
			if ( ! isset( $options[ $name ] ) || ( $options[ $name ] !== $value ) ) {
				$dataset[ $name ] = esc_attr( $value );
			}
		}

		/**
		 * Filters the array of the dataset for the player markup.
		 *
		 * @since 3.0.0
		 * @param array   $dataset An associative array `[key] => value` where `key` is the name of the data attribute and value its `value`
		 * @param string  $post    The post object of the post or page containing the player instance
		 */
		$dataset = apply_filters( 'vwwaveplayer_player_dataset', $dataset, $post );

		$data = array(
			'id'                => "vwwaveplayer-$instance_id",
			'classes'           => implode( ' ', $classes ),
			'dataset'           => implode(
				' ',
				array_filter(
					array_map(
						function( $a, $b ) {
							if ( '' !== $a ) {
								if ( 'css' === $b ) {
									return "style=\"$a\"";
								}

								return "data-$b=\"$a\"";
							}

							return '';
						},
						$dataset,
						array_keys( $dataset )
					)
				)
			),
			'default_thumbnail' => $options['default_thumbnail'],
		);

		ob_start();

		if ( is_admin() ) {
			if ( $args['skin'] !== $options['skin'] ) {
				self::print_style( $args['skin'] );
			}
			if ( $colors !== $options['palette'] ) {
				self::print_palette( $colors );
			}
		}

		if ( $args['skin'] !== $options['skin'] && ! in_array( $args['skin'], self::$used_skins, true ) ) {
			self::$used_skins[] = $args['skin'];
		}
		if ( $colors !== $options['palette'] && ! in_array( $colors, self::$used_palettes, true ) ) {
			self::$used_palettes[] = $colors;
		}

		self::print_skin( $args['skin'], 'main', $data );

		Debug::stop( $label );
		$index++;

		return ob_get_clean();
	}


	/**
	 * Experimental shortcode the outputs multiple instances
	 *
	 * @param  array  $atts    The parameters of the shortcode.
	 * @param  string $content The content of the shortcode (not used).
	 * @return string
	 */
	public static function vwwaveplayer_stack( $atts, $content = '' ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
		if ( ! isset( $atts['ids'] ) || ! $atts['ids'] ) {
			return '';
		}

		$html = '';
		foreach ( explode( ',', $atts['ids'] ) as $id ) {
			$html .= do_shortcode( "[vwwaveplayer ids='$id' skin='play_n_wave']" );
		}

		return $html;

	}

	/**
	 * Overrides the default audio element using a single track 'vwwaveplayer' shortcode
	 *
	 * @since  3.0.0
	 * @param  string $html    The markup of the rendered audio shortcode.
	 * @param  array  $attr    The attributes of the audio shortcode.
	 * @param  string $content The content of the audio shortcode (not used).
	 * @return string The markup of the converted shortcode
	 */
	public static function audio_shortcode( $html, $attr, $content ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
		if ( ! vwwaveplayer()->get_option( 'audio_override' ) ) {
			return $html;
		}

		if ( ! isset( $attr['ids'] ) ) {
			$ids    = get_the_ID();
			$source = '';

			if ( 'attachment' !== get_post_type( $ids ) ) {
				$ids = '';
				if ( isset( $attr['src'] ) ) {
					$source = $attr['src'];
				}
				if ( ! $source && isset( $attr['mp3'] ) ) {
					$source = $attr['mp3'];
				}
				if ( ! $source && isset( $attr['m4a'] ) ) {
					$source = $attr['m4a'];
				}
				if ( ! $source && isset( $attr['ogg'] ) ) {
					$source = $attr['ogg'];
				}
				if ( ! $source && isset( $attr['wav'] ) ) {
					$source = $attr['wav'];
				}
				if ( ! $source && isset( $attr['wma'] ) ) {
					$source = $attr['wma'];
				}

				$ids = vwwaveplayer()->attachment_url_to_postid( $source );
				if ( $ids ) {
					$source = '';
				}
			}
		} else {
			$ids = $attr['ids'];
			if ( is_array( $ids ) ) {
				$ids = implode( ',', $ids );
			}
		}

		$args = array(
			'ids' => $ids,
			'url' => $source,
		);

		$html = self::vwwaveplayer_shortcode( $args );
		return $html;
	}

	/**
	 * Replace audio blocks with vwwaveplayer blocks
	 *
	 * @since  3.0.10
	 * @param  string $content The current post_content.
	 * @return string          The post_content with the audio blocks replaced with vwwaveplayer blocks
	 */
	public static function replace_audio_blocks( $content ) {
		if ( ! vwwaveplayer()->get_option( 'audio_override' ) || self::is_gutenberg_editor() ) {
			return $content;
		}

		$blocks = parse_blocks( $content );

		if ( ! in_array( 'core/audio', array_column( $blocks, 'blockName' ), true ) ) {
			return $content;
		}
		ob_start();
		foreach ( $blocks as $block ) {
			if ( 'core/audio' === $block['blockName'] ) {
				if ( isset( $block['attrs']['id'] ) ) {
					echo do_shortcode( "[vwwaveplayer ids='{$block['attrs']['id']}']" );
				} else {
					if ( preg_match( '/.*src="([^"]+)".*/', $block['innerHTML'], $matches ) && isset( $matches[1] ) ) {
						echo do_shortcode( "[vwwaveplayer url='{$matches[1]}']" );
					}
				}
			} else {
				echo render_block( $block ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
		return ob_get_clean();
	}

	/**
	 * Overrides the default playlist shortcode
	 *
	 * @since  3.0.0
	 * @param  string $html    The markup of the rendered playlist shortcode.
	 * @param  array  $attr    The attributes of the audio shortcode.
	 * @return string The markup of the converted shortcode
	 */
	public static function playlist_shortcode( $html, $attr ) {
		return self::audio_shortcode( $html, $attr, '' );
	}

	/**
	 * Adds all the strings relevant to VwWavePlayer to the Media string array
	 *
	 * @since  3.0.0
	 * @param  array   $strings An array of the Media strings.
	 * @param  WP_Post $post    The $post object.
	 * @return array
	 */
	public static function media_string( $strings, $post ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
		$strings['createNewWaveplayer']          = esc_html__( 'Create a new VwWavePlayer', 'vwwaveplayer' );
		$strings['waveplayerDragInfo']           = esc_html__( 'Drag and drop to reorder tracks.', 'vwwaveplayer' );
		$strings['createWaveplayerTitle']        = esc_html__( 'Create VwWavePlayer', 'vwwaveplayer' );
		$strings['editWaveplayerTitle']          = esc_html__( 'Edit VwWavePlayer', 'vwwaveplayer' );
		$strings['cancelWaveplayerTitle']        = esc_html__( '&#8592; Cancel VwWavePlayer', 'vwwaveplayer' );
		$strings['insertWaveplayer']             = esc_html__( 'Insert VwWavePlayer', 'vwwaveplayer' );
		$strings['updateWaveplayer']             = esc_html__( 'Update VwWavePlayer', 'vwwaveplayer' );
		$strings['addToWaveplayer']              = esc_html__( 'Add to VwWavePlayer', 'vwwaveplayer' );
		$strings['addToWaveplayerTitle']         = esc_html__( 'Add to VwWavePlayer', 'vwwaveplayer' );
		$strings['createWaveplayerFromURLTitle'] = esc_html__( 'Create VwWavePlayer from URL', 'vwwaveplayer' );
		$strings['editWaveplayerFromURLTitle']   = esc_html__( 'Edit VwWavePlayer URL', 'vwwaveplayer' );
		$strings['addWaveplayerFromURLTitle']    = esc_html__( 'Add from URL', 'vwwaveplayer' );
		return $strings;
	}


	/**
	 * Creates a template for the VwWavePlayer Settings in WordPress Media Manager
	 *
	 * @since  3.0.0
	 */
	public static function media_template() {

		$options = vwwaveplayer()->get_options();

		?>

		<script type="text/html" id="tmpl-vwwaveplayer-url-settings">
		</script>

		<script type="text/html" id="tmpl-vwwaveplayer-settings">
			<h2><?php esc_html_e( 'VwWavePlayer Settings', 'vwwaveplayer' ); ?></h2>

			<label class="setting">
				<span><?php esc_html_e( 'Skin', 'vwwaveplayer' ); ?></span>
				<select data-setting="skin" class="setting">
			<?php
				echo self::get_skin_options(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Size', 'vwwaveplayer' ); ?></span>
				<select data-setting="size" class="setting">
					<option name="size_large"  value="lg" <?php selected( 'lg' === $options['size'] ); ?>><?php esc_html_e( 'Large', 'vwwaveplayer' ); ?></option>
					<option name="size_medium"  value="md" <?php selected( 'md' === $options['size'] ); ?>><?php esc_html_e( 'Medium', 'vwwaveplayer' ); ?></option>
					<option name="size_small"  value="sm" <?php selected( 'sm' === $options['size'] ); ?>><?php esc_html_e( 'Small', 'vwwaveplayer' ); ?></option>
					<option name="size_xsmall"  value="xs" <?php selected( 'xs' === $options['size'] ); ?>><?php esc_html_e( 'Extra Small', 'vwwaveplayer' ); ?></option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Shape', 'vwwaveplayer' ); ?></span>
				<select data-setting="shape" class="setting">
					<option name="shape_square" value="square" <?php selected( 'square' === $options['shape'] ); ?>><?php esc_html_e( 'Square', 'vwwaveplayer' ); ?></option>
					<option name="shape_circle" value="circle" <?php selected( 'circle' === $options['shape'] ); ?>><?php esc_html_e( 'Circle', 'vwwaveplayer' ); ?></option>
					<option name="shape_rounded" value="rounded" <?php selected( 'rounded' === $options['shape'] ); ?>><?php esc_html_e( 'Rounded', 'vwwaveplayer' ); ?></option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Style', 'vwwaveplayer' ); ?></span>
				<select data-setting="style" class="setting">
					<option name="style_light" value="light" <?php selected( 'light' === $options['style'] ); ?>><?php esc_html_e( 'Light', 'vwwaveplayer' ); ?></option>
					<option name="style_dark" value="dark" <?php selected( 'dark' === $options['style'] ); ?>><?php esc_html_e( 'Dark', 'vwwaveplayer' ); ?></option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Info display', 'vwwaveplayer' ); ?></span>
				<select data-setting="info" class="setting">
					<option name="vwwaveplayer_info_none" value="none" <?php selected( 'none' === $options['info'] ); ?>><?php esc_html_e( 'None', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_info_bar" value="bar" <?php selected( 'bar' === $options['info'] ); ?>><?php esc_html_e( 'Info bar', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_info_playlist" value="playlist" <?php selected( 'playlist' === $options['info'] ); ?>><?php esc_html_e( 'Info bar and Playlist', 'vwwaveplayer' ); ?></option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Autoplay', 'vwwaveplayer' ); ?></span>
				<input type="checkbox" data-setting="autoplay" value="1" <?php echo isset( $options['autoplay'] ) ? checked( $options['autoplay'], 1 ) : ''; ?> />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Repeat All', 'vwwaveplayer' ); ?></span>
				<input type="checkbox" data-setting="repeat_all" value="1" <?php echo isset( $options['repeat_all'] ) ? checked( $options['repeat_all'], 1 ) : ''; ?> />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Shuffle', 'vwwaveplayer' ); ?></span>
				<input type="checkbox" data-setting="shuffle" value="1" <?php echo isset( $options['shuffle'] ) ? checked( $options['shuffle'], 1 ) : ''; ?> />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Wave Color', 'vwwaveplayer' ); ?></span>
				<input type="text" class="setting vwwaveplayer-color-picker" data-setting="wave_color" value="<?php echo esc_attr( $options['wave_color'] ); ?>" />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Wave Color 2', 'vwwaveplayer' ); ?></span>
				<input type="text" class="setting vwwaveplayer-color-picker" data-setting="wave_color_2" value="<?php echo esc_attr( $options['wave_color_2'] ); ?>" />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Prog. Color', 'vwwaveplayer' ); ?></span>
				<input type="text" class="setting vwwaveplayer-color-picker" data-setting="progress_color" value="<?php echo esc_attr( $options['progress_color'] ); ?>" />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Prog. Color 2', 'vwwaveplayer' ); ?></span>
				<input type="text" class="setting vwwaveplayer-color-picker" data-setting="progress_color_2" value="<?php echo esc_attr( $options['progress_color_2'] ); ?>" />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Hover opacity', 'vwwaveplayer' ); ?></span>
				<select data-setting="hover_opacity" class="setting">
					<option name="vwwaveplayer_wave_hover_opacity_100" value="100" <?php selected( '100' === $options['hover_opacity'] ); ?>>100%</option>
					<option name="vwwaveplayer_wave_hover_opacity_90" value="90" <?php selected( '90' === $options['hover_opacity'] ); ?>>90%</option>
					<option name="vwwaveplayer_wave_hover_opacity_80" value="80" <?php selected( '80' === $options['hover_opacity'] ); ?>>80%</option>
					<option name="vwwaveplayer_wave_hover_opacity_70" value="70" <?php selected( '70' === $options['hover_opacity'] ); ?>>70%</option>
					<option name="vwwaveplayer_wave_hover_opacity_60" value="60" <?php selected( '60' === $options['hover_opacity'] ); ?>>60%</option>
					<option name="vwwaveplayer_wave_hover_opacity_50" value="50" <?php selected( '50' === $options['hover_opacity'] ); ?>>50%</option>
					<option name="vwwaveplayer_wave_hover_opacity_40" value="40" <?php selected( '40' === $options['hover_opacity'] ); ?>>40%</option>
					<option name="vwwaveplayer_wave_hover_opacity_30" value="30" <?php selected( '30' === $options['hover_opacity'] ); ?>>30%</option>
					<option name="vwwaveplayer_wave_hover_opacity_20" value="20" <?php selected( '20' === $options['hover_opacity'] ); ?>>20%</option>
					<option name="vwwaveplayer_wave_hover_opacity_10" value="10" <?php selected( '10' === $options['hover_opacity'] ); ?>>10%</option>
					<option name="vwwaveplayer_wave_hover_opacity_0" value="0" <?php selected( '0' === $options['hover_opacity'] ); ?>>0%</option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Cursor color', 'vwwaveplayer' ); ?></span>
				<input type="text" class="setting vwwaveplayer-color-picker" data-setting="cursor_color" value="<?php echo esc_attr( $options['cursor_color'] ); ?>" />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Cursor color 2', 'vwwaveplayer' ); ?></span>
				<input type="text" class="setting vwwaveplayer-color-picker" data-setting="cursor_color_2" value="<?php echo esc_attr( $options['cursor_color_2'] ); ?>" />
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Cursor width', 'vwwaveplayer' ); ?></span>
				<select data-setting="cursor_width" class="setting">
					<option name="vwwaveplayer_wave_cursor_width_0" value="0" <?php selected( '0' === $options['cursor_width'] ); ?>><?php esc_html_e( 'Invisible', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_cursor_width_1" value="1" <?php selected( '1' === $options['cursor_width'] ); ?>><?php esc_html_e( 'Thin (1px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_cursor_width_2" value="2" <?php selected( '2' === $options['cursor_width'] ); ?>><?php esc_html_e( 'Normal (2px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_cursor_width_4" value="4" <?php selected( '4' === $options['cursor_width'] ); ?>><?php esc_html_e( 'Thick (4px)', 'vwwaveplayer' ); ?></option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Wave mode', 'vwwaveplayer' ); ?></span>
				<select data-setting="wave_mode" class="setting">
					<option name="vwwaveplayer_wave_mode_0" value="0" <?php selected( '0' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Continuous', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_1" value="1" <?php selected( '1' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (1px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_2" value="2" <?php selected( '2' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (2px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_3" value="3" <?php selected( '3' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (3px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_4" value="4" <?php selected( '4' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (4px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_5" value="5" <?php selected( '5' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (5px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_6" value="6" <?php selected( '6' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (6px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_7" value="7" <?php selected( '7' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (7px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_8" value="8" <?php selected( '8' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (8px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_9" value="9" <?php selected( '9' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (9px)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_mode_10" value="10" <?php selected( '10' === $options['wave_mode'] ); ?>><?php esc_html_e( 'Bars (10px)', 'vwwaveplayer' ); ?></option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Gap width', 'vwwaveplayer' ); ?></span>
				<select data-setting="gap_width" class="setting">
					<option name="vwwaveplayer_gap_width_0" value="0" <?php selected( '0' === $options['gap_width'] ); ?>>0px</option>
					<option name="vwwaveplayer_gap_width_1" value="1" <?php selected( '1' === $options['gap_width'] ); ?>>1px</option>
					<option name="vwwaveplayer_gap_width_2" value="2" <?php selected( '2' === $options['gap_width'] ); ?>>2px</option>
					<option name="vwwaveplayer_gap_width_3" value="3" <?php selected( '3' === $options['gap_width'] ); ?>>3px</option>
					<option name="vwwaveplayer_gap_width_4" value="4" <?php selected( '4' === $options['gap_width'] ); ?>>4px</option>
					<option name="vwwaveplayer_gap_width_5" value="5" <?php selected( '5' === $options['gap_width'] ); ?>>5px</option>
					<option name="vwwaveplayer_gap_width_6" value="6" <?php selected( '6' === $options['gap_width'] ); ?>>6px</option>
					<option name="vwwaveplayer_gap_width_7" value="7" <?php selected( '7' === $options['gap_width'] ); ?>>7px</option>
					<option name="vwwaveplayer_gap_width_8" value="8" <?php selected( '8' === $options['gap_width'] ); ?>>8px</option>
					<option name="vwwaveplayer_gap_width_9" value="9" <?php selected( '9' === $options['gap_width'] ); ?>>9px</option>
					<option name="vwwaveplayer_gap_width_10" value="10" <?php selected( '10' === $options['gap_width'] ); ?>>10px</option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Wave comp.', 'vwwaveplayer' ); ?></span>
				<select data-setting="wave_compression" class="setting">
					<option name="vwwaveplayer_wave_compression_linear" value="1" <?php selected( '1' === $options['wave_compression'] ); ?>><?php esc_html_e( 'None (linear)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_compression_square" value="2" <?php selected( '2' === $options['wave_compression'] ); ?>><?php esc_html_e( 'Moderate (square)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_compression_cubic" value="3" <?php selected( '3' === $options['wave_compression'] ); ?>><?php esc_html_e( 'High (cubic)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_compression_4th" value="4" <?php selected( '4' === $options['wave_compression'] ); ?>><?php esc_html_e( 'Very high (4th order)', 'vwwaveplayer' ); ?></option>
					<option name="vwwaveplayer_wave_compression_5th" value="5" <?php selected( '5' === $options['wave_compression'] ); ?>><?php esc_html_e( 'Extreme (5th order)', 'vwwaveplayer' ); ?></option>
				</select>
			</label>

			<label class="setting">
				<span><?php esc_html_e( 'Wave asym.', 'vwwaveplayer' ); ?></span>
				<select data-setting="wave_asymmetry" class="setting">
					<option name="vwwaveplayer_wave_asymmetry_1" value="1" <?php selected( '1' === $options['wave_asymmetry'] ); ?>>1/2 + 1/2</option>
					<option name="vwwaveplayer_wave_asymmetry_2" value="2" <?php selected( '2' === $options['wave_asymmetry'] ); ?>>2/3 + 1/3</option>
					<option name="vwwaveplayer_wave_asymmetry_3" value="3" <?php selected( '3' === $options['wave_asymmetry'] ); ?>>3/4 + 1/4</option>
					<option name="vwwaveplayer_wave_asymmetry_4" value="4" <?php selected( '4' === $options['wave_asymmetry'] ); ?>>4/5 + 1/5</option>
					<option name="vwwaveplayer_wave_asymmetry_5" value="5" <?php selected( '5' === $options['wave_asymmetry'] ); ?>>5/6 + 1/6</option>
				</select>
			</label>

		</script>

		<script type="text/html" id="tmpl-attachment">
			<div class="attachment-preview js--select-attachment type-{{ data.type }} subtype-{{ data.subtype }} {{ data.orientation }}">
				<div class="thumbnail">
					<# if ( data.uploading ) { #>
						<div class="media-progress-bar"><div style="width: {{ data.percent }}%"></div></div>
					<# } else if ( 'image' === data.type && data.sizes ) { #>
						<div class="centered">
							<img src="{{ data.size.url }}" draggable="false" alt="" />
						</div>
					<# } else { #>
						<div class="centered">
							<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
								<img src="{{ data.image.src }}" class="thumbnail" draggable="false" alt="" />
							<# } else { #>
								<img src="{{ data.icon }}" class="icon" draggable="true" alt="" />
							<# } #>
						</div>
						<div class="filename">
					<?php if ( $options['media_library_title'] ) { ?>
							<div>{{ data.title }}</div>
					<?php } else { ?>
							<div>{{ data.filename }}</div>
					<?php } ?>
						</div>
						<# if ( 'audio' === data.type ) { #>
						<# } #>
					<# } #>
				</div>
				<# if ( data.buttons.close ) { #>
					<button type="button" class="button-link attachment-close media-modal-icon"><span class="screen-reader-text"><?php esc_html_e( 'Remove', 'vwwaveplayer' ); ?></span></button>
				<# } #>
			</div>
			<# if ( data.buttons.check ) { #>
				<button type="button" class="button-link check" tabindex="-1"><span class="media-modal-icon"></span><span class="screen-reader-text"><?php esc_html_e( 'Deselect', 'vwwaveplayer' ); ?></span></button>
			<# } #>
			<#
			var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly';
			if ( data.describe ) {
				if ( 'image' === data.type ) { #>
					<input type="text" value="{{ data.caption }}" class="describe" data-setting="caption"
						placeholder="<?php esc_html_e( 'Caption this image&hellip;', 'vwwaveplayer' ); ?>" {{ maybeReadOnly }} />
				<# } else { #>
					<input type="text" value="{{ data.title }}" class="describe" data-setting="title"
						<# if ( 'video' === data.type ) { #>
							placeholder="<?php esc_html_e( 'Describe this video&hellip;', 'vwwaveplayer' ); ?>"
						<# } else if ( 'audio' === data.type ) { #>
							placeholder="<?php esc_html_e( 'Describe this audio file&hellip;', 'vwwaveplayer' ); ?>"
						<# } else { #>
							placeholder="<?php esc_html_e( 'Describe this media file&hellip;', 'vwwaveplayer' ); ?>"
						<# } #> {{ maybeReadOnly }} />
				<# }
			} #>
		</script>
		<?php
	}

	/**
	 * Provides the necessary styles to render the player in the MCE Editor
	 *
	 * @since  3.0.0
	 * @param  string $skin    The name of the skin.
	 * @return array  An array of URLs for the styles that need to be added to the sandbox editor
	 */
	public static function sandbox_styles( $skin ) {
		$version = '?ver=' . vwwaveplayer()->get_version();
		$suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		$styles_urls   = array();
		$styles_urls[] = plugins_url( "/assets/css/styles$suffix.css", __DIR__ ) . $version;
		$styles_urls[] = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/solid.min.css';
		$styles_urls[] = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/brands.min.css';
		$skin_style    = self::get_skin_url( $skin, 'style' );

		if ( $skin_style ) {
			$styles_urls[] = $skin_style;
		}

		return $styles_urls;
	}

	/**
	 * Renders a vwwaveplayer shortcode and sends an head and body of an iframe to vwwaveplayer.js through the AJAX call
	 *
	 * @since  3.0.0
	 */
	public static function ajax_parse_shortcode() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-parse-shortcode' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error(
				array(
					'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ),
					'vwwaveplayer',
				)
			);
		}

		global $post, $wp_scripts;

		if ( empty( $_POST['shortcode'] ) ) {
			wp_send_json_error();
		}

		$shortcode = stripslashes( $_POST['shortcode'] );  // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

		$_post = $post;
		if ( ! empty( $_POST['post_ID'] ) ) {
			$_post = get_post( (int) $_POST['post_ID'] );
		}

		if ( ! $_post || ! current_user_can( 'edit_post', $_post->ID ) ) {
			if ( 'embed' === $shortcode ) {
				wp_send_json_error();
			}
		} else {
			setup_postdata( $_post );
		}

		$atts = shortcode_parse_atts( $shortcode );
		$skin = vwwaveplayer()->get_option( 'skin' );
		if ( isset( $atts['skin'] ) ) {
			$skin = $atts['skin'];
		}
		$palette = vwwaveplayer()->get_option( 'default_palette' );
		if ( isset( $atts['palette'] ) ) {
			$palette = $atts['palette'];
		}

		$parsed = do_shortcode( $shortcode );

		if ( empty( $parsed ) ) {
			wp_send_json_error(
				array(
					'type'    => 'no-items',
					'message' => esc_html__( 'No items found.', 'vwwaveplayer' ),
				)
			);
		}

		$head    = '';
		$styles  = self::sandbox_styles( $skin );
		$scripts = '<script type="text/javascript" src="' . plugins_url( '/assets/js/vwwaveplayer.js', __DIR__ ) . '?ver=' . esc_url( vwwaveplayer()->get_version() ) . '"/></script>'; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript

		foreach ( $styles as $style ) {
			$head .= '<link type="text/css" rel="stylesheet" href="' . esc_url( $style ) . '">'; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
		}
		$head .= "<style>body#wpview-iframe-sandbox{height:fit-content;}\n" . self::minify_css( self::get_palette_style( $palette ) ) . "\n</style>";

		if ( ! empty( $wp_scripts ) ) {
			$wp_scripts->done = array();
		}

		ob_start();

		echo $parsed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		wp_print_scripts( array( 'jquery', 'underscore' ) );
		echo $scripts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		self::print_placeholder_templates();

		wp_send_json_success(
			array(
				'head' => $head,
				'body' => ob_get_clean(),
			)
		);
	}


	/**
	 * Renders a vwwaveplayer shortcode and sends an head and body of an iframe to vwwaveplayer.js through the AJAX call
	 * This is used to override the [audio] shortcode in the MCE Editor
	 *
	 * @since 3.0.0
	 */
	public static function ajax_parse_single_shortcode() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vwwaveplayer-parse-shortcode' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
			wp_send_json_error(
				array(
					'message' => esc_html__( 'The request is not valid', 'vwwaveplayer' ),
					'vwwaveplayer',
				)
			);
		}

		global $post, $wp_scripts;

		if ( empty( $_POST['shortcode'] ) ) {
			wp_send_json_error();
		}

		$shortcode = stripslashes( $_POST['shortcode'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash

		$_post = $post;
		if ( ! empty( $_POST['post_ID'] ) ) {
			$_post = get_post( (int) $_POST['post_ID'] );
		}

		if ( ! $_post || ! current_user_can( 'edit_post', $_post->ID ) ) {
			if ( 'embed' === $shortcode ) {
				wp_send_json_error();
			}
		} else {
			setup_postdata( $_post );
		}

		$atts = shortcode_parse_atts( $shortcode );
		$skin = vwwaveplayer()->get_option( 'skin' );
		if ( isset( $atts['skin'] ) ) {
			$skin = $atts['skin'];
		}
		$palette = vwwaveplayer()->get_option( 'default_palette' );
		if ( isset( $atts['palette'] ) ) {
			$palette = $atts['palette'];
		}

		$parsed = do_shortcode( $shortcode );

		if ( empty( $parsed ) ) {
			wp_send_json_error(
				array(
					'type'    => 'no-items',
					'message' => esc_html__( 'No items found.', 'vwwaveplayer' ),
				)
			);
		}

		$head    = '';
		$styles  = self::sandbox_styles( $skin );
		$scripts = '<script type="text/javascript" src="' . esc_url( plugins_url( '/assets/js/vwwaveplayer.js', __DIR__ ) ) . '?ver=' . esc_attr( vwwaveplayer()->get_version() ) . '"/></script>'; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
		foreach ( $styles as $style ) {
			$head .= '<link type="text/css" rel="stylesheet" href="' . esc_url( $style ) . '">'; // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
		}
		$head .= "<style>body#wpview-iframe-sandbox{height:fit-content;}\n" . self::minify_css( self::get_palette_style( $palette ) ) . "\n</style>";

		if ( ! empty( $wp_scripts ) ) {
			$wp_scripts->done = array();
		}

		ob_start();

		echo $parsed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		wp_print_scripts( array( 'jquery', 'underscore' ) );
		echo $scripts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		self::print_placeholder_templates();

		wp_send_json_success(
			array(
				'head' => $head,
				'body' => ob_get_clean(),
			)
		);
	}

	/**
	 * Output the inline CSS styles for the additional skins and palettes
	 *
	 * @since 3.0.0
	 */
	public static function print_additional_styles() {
		?>
		<style type="text/css" id="vwwaveplayer-additional-styles">
			<?php

			$css = '';

			$default_font = vwwaveplayer()->get_option( 'default_font' );
			if ( 'default' !== strtolower( $default_font ) ) {
				$css .= ".vwwaveplayer{font-family: '$default_font';}";
			}

			// output the default skin stylesheet.
			$css .= self::get_skin_style( vwwaveplayer()->get_option( 'skin' ) );

			// output the default skin stylesheet.
			$css .= self::get_palette_style( vwwaveplayer()->get_option( 'default_palette' ) );

			// output any additional skin stylesheet.
			foreach ( self::$used_skins as $skin ) {
				if ( vwwaveplayer()->get_option( 'skin' ) !== $skin ) {
					$css .= self::get_skin_style( $skin );
				}
			}

			// output any additional palette stylesheet.
			foreach ( self::$used_palettes as $colors ) {
				if ( vwwaveplayer()->get_option( 'default_palette' ) !== $colors ) {
					$css .= self::get_palette_style( $colors );
				}
			}

			$css .= vwwaveplayer()->get_option( 'custom_css' );

			echo self::minify_css( $css ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</style>
		<script>
		</script>
		<?php
	}

	/**
	 * Search the post content for the [vwwaveplayer] shortcode
	 * convert it to a list of audio element for the RSS Feed
	 *
	 * @since 3.0.0
	 */
	public static function add_rss_enclosure() {
		ob_start();
		rss_enclosure();
		$enclosure = ob_get_clean();

		if ( $enclosure ) {
			return;
		}

		$content = get_the_content();
		$result  = preg_match( '/\[vwwaveplayer([^\]]*)\]/', $content, $matches );
		$atts    = array();
		foreach ( explode( ' ', trim( $matches[1] ) ) as $param ) {
			if ( preg_match( "/([^ \=\"\']+)\=[\'\"]([^\=\"\']*)[\'\"]/", $param, $p ) ) {
				$atts[ $p[1] ] = $p[2];
			}
		}
		$ids = isset( $atts['ids'] ) ? explode( ',', $atts['ids'] ) : '';
		if ( isset( $atts['url'] ) ) {
			echo '<enclosure url="' . esc_url( $atts['url'] ) . '" />';
		} elseif ( $ids ) {
			$id  = (int) trim( $ids[0] );
			$url = esc_url( wp_get_attachment_url( $id ) );
			if ( $url ) {
				$size = esc_attr( filesize( get_attached_file( $id ) ) );
				$type = esc_attr( get_post_mime_type( $id ) );
				echo "<enclosure url=\"$url\" length=\"$size\" type=\"$type\" />"; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}

	/**
	 * Search the post content for the [vwwaveplayer] shortcode
	 * convert it to a list of audio element for the Atom Feed
	 *
	 * @since 3.0.0
	 */
	public static function add_atom_links() {
		ob_start();
		atom_enclosure();
		$enclosure = ob_get_clean();

		if ( $enclosure ) {
			return;
		}

		$post_content = get_the_content();
		$result       = preg_match_all( '/\[vwwaveplayer([^\]]*)\]/', $post_content, $matches );
		if ( isset( $matches[1] ) ) {
			foreach ( $matches[1] as $match ) {
				$atts = array();
				foreach ( explode( ' ', trim( $match ) ) as $param ) {
					if ( preg_match( "/([^ \=\"\']+)\=[\'\"]([^\=\"\']*)[\'\"]/", $param, $p ) ) {
						$atts[ $p[1] ] = $p[2];
					}
				}
				$ids = isset( $atts['ids'] ) ? explode( ',', $atts['ids'] ) : '';
				if ( isset( $atts['url'] ) ) {
					echo '<enclosure url="' . esc_url( $atts['url'] ) . '" />';
				} elseif ( $ids ) {
					$id  = (int) trim( $ids[0] );
					$url = esc_url( wp_get_attachment_url( $id ) );
					if ( $url ) {
						$size  = esc_attr( filesize( get_attached_file( $id ) ) );
						$type  = esc_attr( get_post_mime_type( $id ) );
						$title = esc_attr( get_the_title( $id ) );
						echo "<link rel=\"enclosure\" href=\"$url\" title=\"$title\" length=\"$size\" type=\"$type\" />"; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				}
			}
		}
	}

	/**
	 * Return the HTML markup of the options for a selectbox of the registered image sizes
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public static function get_registered_image_sizes() {
		ob_start();
		$default_thumbnail_size = vwwaveplayer()->get_option( 'default_thumbnail_size' );
		$sizes                  = array();
		?>

		<option name="vwwaveplayer_default_thumbnail_size_full" value="full" <?php selected( $default_thumbnail_size, 'full' ); ?>>full (original size)</option>

		<?php
		foreach ( wp_get_registered_image_subsizes() as $size_name => $image_size ) {
			$cropped             = $image_size['crop'] ? ', cropped' : '';
			$size_label          = "$size_name ({$image_size['width']}x{$image_size['height']}$cropped)";
			$sizes[ $size_name ] = array(
				'label' => $size_label,
				'value' => $size_name,
			);
			?>
			<option name="vwwaveplayer_default_thumbnail_size_<?php echo esc_attr( $size_name ); ?>" value="<?php echo esc_attr( $size_name ); ?>" <?php selected( $default_thumbnail_size, $size_name ); ?>>
					<?php echo esc_html( $size_label ); ?>
			</option>
			<?php
		}
		return ob_get_clean();
	}

	/**
	 * Output the markup of the element containing the data of all the tracks on the page
	 *
	 * @since 3.0.0
	 */
	public static function print_instance_track_data() {

		if ( empty( self::$instances ) ) {
			return;
		}
		?>

		<ul id="instance_track_data">

		<?php foreach ( self::$instances as $instance_id => $instance ) { ?>
			<li id="data-<?php echo esc_attr( $instance_id ); ?>" data-tracks="<?php echo esc_attr( $instance['tracks'] ); ?>" data-nonce="<?php echo esc_attr( $instance['nonce'] ); ?>"></li>
		<?php } ?>

		</ul>

		<?php
	}

	public static function print_script_with_used_tracks() {
		$user_id = get_current_user_id();

		if ( ! $user_id ) {
			return;
		}

		$user_likes = array_map( 'intval', get_user_meta( $user_id, 'wvpl_likes' ) ?: [] );
		$likes      = array_values( array_unique( array_intersect( $user_likes, self::$used_tracks ) ) );

		?>
		<script type="text/javascript">
			if ( vwwvplVars?.currentUser ) {
				vwwvplVars.currentUser.likes = <?php echo wp_json_encode( $likes ); ?>;
			}
		</script>
		<?php
	}

	/**
	 * Update cached tracks to make their stats current.
	 *
	 * @since 3.5.0
	 * @param  array $tracks The cached tracks being evaluated.
	 * @return array
	 */
	public static function update_cached_tracks( $tracks ) {
		foreach ( $tracks as $key => $track ) {
			if ( ! is_numeric( $track['id'] ) ) {
				continue;
			}

			$stats        = AJAX::get_track_stats( $track['id'] );
			$liked        = false;
			$liked_tracks = array();
			$liked_tracks = get_user_meta( get_current_user_id(), 'wvpl_likes' );
			if ( $liked_tracks ) {
				$liked = in_array( $track['id'], $liked_tracks, true );
			}

			$tracks[ $key ]['stats'] = $stats;
			$tracks[ $key ]['liked'] = $liked;
		}

		return $tracks;
	}

	/**
	 * Return an array with the factory palettes
	 *
	 * @since 3.0.0
	 * @return array
	 */
	public static function factory_palettes() {
		return array(
			array(
				'name'   => 'Desert (mono)',
				'colors' => '1f1913-604c38-f1ece8-cbb5a1-8b6540-ba946f-a36328-d99656-653e19-e4b68c-925d2a-ce9a69',
			),
			array(
				'name'   => 'Green Neon (mono)',
				'colors' => '222b20-2e4429-eaf1e8-bdd8b7-5c8055-77b769-30b314-69e04f-2a771a-b7e6ae-369222-7cce6b',
			),
			array(
				'name'   => 'Purple (mono)',
				'colors' => '120d13-543b59-e7dfe9-c7adcc-723a7d-ad75b8-a02eb7-c158d6-591d65-dca6e7-822994-bf62d1',
			),
			array(
				'name'   => 'Autumn in Fire (mono)',
				'colors' => '110e0e-422d30-efe9ea-cfb5b9-7f3843-c67c87-a9142b-dc6577-60111d-ec94a2-a33647-d96274',
			),
			array(
				'name'   => 'Green Sea (mono)',
				'colors' => '101716-2b3f3c-dbebe8-a6cbc5-418278-7bb7ae-189c87-40dbc3-178070-94e7da-27a490-56d5c1',
			),
			array(
				'name'   => 'Banana (mono)',
				'colors' => '16150d-3e3e2c-e5e4d6-d6d5ad-8f8e56-bbb85e-aba718-e8e458-626011-dedc90-a09d2a-ccc961',
			),
			array(
				'name'   => 'Paradise (mono)',
				'colors' => '141f24-2f4651-e9edef-bed0d8-557a89-83b2c7-238fbd-49b6e6-205e79-a6d6ea-21779b-5fb2d6',
			),
			array(
				'name'   => 'Eclectic (pairs)',
				'colors' => '0f0b0c-593e47-d8dae5-b1b5d6-3c5286-5d7abf-b32135-e55f70-405613-cfe998-4ead2e-78ca5d',
			),
			array(
				'name'   => 'Horizon (pairs)',
				'colors' => '211c2d-362a53-e2e2ec-bcbbce-724650-bb8693-a1242c-df5d65-1d687c-9ad1df-9d521c-d38751',
			),
			array(
				'name'   => 'Elements (pairs)',
				'colors' => '251b18-49332e-e1d7db-cfb1bd-744c59-b46a82-18859c-63cae0-551d5a-df99e6-29af2a-72d173',
			),
			array(
				'name'   => 'Violet Garden (pairs)',
				'colors' => '241921-5c3152-eff1ec-c2c8b4-708b55-8cb663-be1ca3-e862d2-512474-c59ae6-932e36-d2666f',
			),
			array(
				'name'   => 'Savana (pairs)',
				'colors' => '2b2a1c-3c3a2b-efefeb-cfd2af-7d7f43-c0c37d-b08b1a-dbbf6a-28571b-98e982-82b031-a5dc47',
			),
			array(
				'name'   => 'Playful (pairs)',
				'colors' => '291c20-452d34-f4efef-d3bfbf-465270-778abc-a2901d-e9d13a-1f735e-97decc-8f246a-d752a9',
			),
			array(
				'name'   => 'Wedding (pairs)',
				'colors' => '0e1215-24394b-f3f2ea-d8d5b1-409395-69b1b2-bf1c87-eb5fba-215464-a7dced-25649c-5193cd',
			),
			array(
				'name'   => 'Vineyard',
				'colors' => '1d1b2c-413750-f5f1ee-a7bcd3-3a6379-9aba89-1b9753-6be466-681d35-dceea3-af5428-cbc955',
			),
			array(
				'name'   => 'Club',
				'colors' => '0e0c11-2a4f4b-eff1e9-cbb3a7-9c4777-68c2a8-2159c2-9f3ae5-3b2067-ebc1ad-7722b1-4bcfd7',
			),
			array(
				'name'   => 'Woods on Fire',
				'colors' => '132016-4e452b-e6e2df-bbd8b5-623b87-86c3c0-b0285b-e3e04b-71203d-dd9b96-aba423-4ed889',
			),
			array(
				'name'   => 'Orange Tree',
				'colors' => '17180f-5a4a38-f4f2f1-b2c8c4-4c517e-bc6f64-c15022-e8c836-766b1b-b9e98a-8f2747-654adf',
			),
			array(
				'name'   => 'Excalibur',
				'colors' => '100e19-2e2940-e8f2f0-c1aaa8-618044-afca75-2a1db9-e945a8-731921-83bfe3-a0354e-d7de54',
			),
		);
	}

}

Renderer::load();
