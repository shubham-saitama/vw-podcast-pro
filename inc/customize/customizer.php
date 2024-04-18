<?php
/**
 * vw-podcast-pro Theme Customizer
 *
 * @package vw-podcast-pro
 */
/**
 * Loads custom control for layout settings
 */
function vw_podcast_pro_custom_controls()
{
    require_once get_template_directory() . '/inc/customize/controls/admin/customize-texteditor-control.php';
    require_once get_template_directory() . '/inc/customize/controls/custom-controls.php';
    require_once get_template_directory() . '/inc/customize/controls/button-controls.php';
    require_once get_template_directory() . '/inc/customize/controls/custom-multiselect.php';

    // Inlcude the Alpha Color Picker control file.
    require_once get_template_directory() . '/inc/customize/controls/alpha-color-picker.php';
    get_stylesheet_directory_uri() . '/assets/js/alpha-color-picker.js';
    get_stylesheet_directory_uri() . '/assets/css/alpha-color-picker.css';

}
add_action('customize_register', 'vw_podcast_pro_custom_controls');
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_podcast_pro_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial('blogname', array(
        'selector' => '.logo a',
        'render_callback' => 'twentyfifteen_customize_partial_blogname',
    ));
    $wp_customize->selective_refresh->add_partial('blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'twentyfifteen_customize_partial_blogdescription',
    ));

    $wp_customize->add_setting('vw_podcast_pro_display_title', array(
        'default' => 'false',
        'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('vw_podcast_pro_display_title', array(
        'type' => 'checkbox',
        'label' => __('Show Title', 'vw-podcast-pro'),
        'section' => 'title_tagline',
    )
    );
    $wp_customize->add_setting('vw_podcast_pro_display_tagline', array(
        'default' => 'false',
        'sanitize_callback' => 'sanitize_text_field'
    )
    );
    $wp_customize->add_control('vw_podcast_pro_display_tagline', array(
        'type' => 'checkbox',
        'label' => __('Show Tagline', 'vw-podcast-pro'),
        'section' => 'title_tagline',
    )
    );
    //add home page setting pannel
    $wp_customize->add_panel('vw_podcast_pro_panel_id', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Theme Settings', 'vw-podcast-pro'),
        'description' => __('Description of what this panel does.', 'vw-podcast-pro'),
    ));
   
    $font_array = array(
        '' => __('No Fonts', 'vw-podcast-pro'),
        'Abril Fatface' => __('Abril Fatface', 'vw-podcast-pro'),
        'Acme' => __('Acme', 'vw-podcast-pro'),
        'Anton' => __('Anton', 'vw-podcast-pro'),
        'Architects Daughter' => __('Architects Daughter', 'vw-podcast-pro'),
        'Arimo' => __('Arimo', 'vw-podcast-pro'),
        'Arsenal' => __('Arsenal', 'vw-podcast-pro'),
        'Arvo' => __('Arvo', 'vw-podcast-pro'),
        'Alegreya' => __('Alegreya', 'vw-podcast-pro'),
        'Alfa Slab One' => __('Alfa Slab One', 'vw-podcast-pro'),
        'Averia Serif Libre' => __('Averia Serif Libre', 'vw-podcast-pro'),
        'Bangers' => __('Bangers', 'vw-podcast-pro'),
        'Boogaloo' => __('Boogaloo', 'vw-podcast-pro'),
        'Bad Script' => __('Bad Script', 'vw-podcast-pro'),
        'Bitter' => __('Bitter', 'vw-podcast-pro'),
        'Bree Serif' => __('Bree Serif', 'vw-podcast-pro'),
        'BenchNine' => __('BenchNine', 'vw-podcast-pro'),
        'Cabin' => __('Cabin', 'vw-podcast-pro'),
        'Cardo' => __('Cardo', 'vw-podcast-pro'),
        'Courgette' => __('Courgette', 'vw-podcast-pro'),
        'Cherry Swash' => __('Cherry Swash', 'vw-podcast-pro'),
        'Cormorant Garamond' => __('Cormorant Garamond', 'vw-podcast-pro'),
        'Crimson Text' => __('Crimson Text', 'vw-podcast-pro'),
        'Cuprum' => __('Cuprum', 'vw-podcast-pro'),
        'Cookie' => __('Cookie', 'vw-podcast-pro'),
        'Chewy' => __('Chewy', 'vw-podcast-pro'),
        'Days One' => __('Days One', 'vw-podcast-pro'),
        'Dosis' => __('Dosis', 'vw-podcast-pro'),
        'Economica' => __('Economica', 'vw-podcast-pro'),
        'Fredoka One' => __('Fredoka One', 'vw-podcast-pro'),
        'Fjalla One' => __('Fjalla One', 'vw-podcast-pro'),
        'Francois One' => __('Francois One', 'vw-podcast-pro'),
        'Frank Ruhl Libre' => __('Frank Ruhl Libre', 'vw-podcast-pro'),
        'Gloria Hallelujah' => __('Gloria Hallelujah', 'vw-podcast-pro'),
        'Great Vibes' => __('Great Vibes', 'vw-podcast-pro'),
        'Handlee' => __('Handlee', 'vw-podcast-pro'),
        'Hammersmith One' => __('Hammersmith One', 'vw-podcast-pro'),
        'Inconsolata' => __('Inconsolata', 'vw-podcast-pro'),
        'Indie Flower' => __('Indie Flower', 'vw-podcast-pro'),
        'IM Fell English SC' => __('IM Fell English SC', 'vw-podcast-pro'),
        'Julius Sans One' => __('Julius Sans One', 'vw-podcast-pro'),
        'Josefin Slab' => __('Josefin Slab', 'vw-podcast-pro'),
        'Josefin Sans' => __('Josefin Sans', 'vw-podcast-pro'),
        'Kanit' => __('Kanit', 'vw-podcast-pro'),
        'Lobster' => __('Lobster', 'vw-podcast-pro'),
        'Lato' => __('Lato', 'vw-podcast-pro'),
        'Lora' => __('Lora', 'vw-podcast-pro'),
        'Libre Baskerville' => __('Libre Baskerville', 'vw-podcast-pro'),
        'Lobster Two' => __('Lobster Two', 'vw-podcast-pro'),
        'Merriweather' => __('Merriweather', 'vw-podcast-pro'),
        'Monda' => __('Monda', 'vw-podcast-pro'),
        'Montserrat' => __('Montserrat', 'vw-podcast-pro'),
        'Muli' => __('Muli', 'vw-podcast-pro'),
        'Marck Script' => __('Marck Script', 'vw-podcast-pro'),
        'Noto Serif' => __('Noto Serif', 'vw-podcast-pro'),
        'Open Sans' => __('Open Sans', 'vw-podcast-pro'),
        'Overpass' => __('Overpass', 'vw-podcast-pro'),
        'Overpass Mono' => __('Overpass Mono', 'vw-podcast-pro'),
        'Oxygen' => __('Oxygen', 'vw-podcast-pro'),
        'Orbitron' => __('Orbitron', 'vw-podcast-pro'),
        'Patua One' => __('Patua One', 'vw-podcast-pro'),
        'Pacifico' => __('Pacifico', 'vw-podcast-pro'),
        'Padauk' => __('Padauk', 'vw-podcast-pro'),
        'Playball' => __('Playball', 'vw-podcast-pro'),
        'Playfair Display' => __('Playfair Display', 'vw-podcast-pro'),
        'PT Sans' => __('PT Sans', 'vw-podcast-pro'),
        'Philosopher' => __('Philosopher', 'vw-podcast-pro'),
        'Permanent Marker' => __('Permanent Marker', 'vw-podcast-pro'),
        'Poiret One' => __('Poiret One', 'vw-podcast-pro'),
        'Quicksand' => __('Quicksand', 'vw-podcast-pro'),
        'Quattrocento Sans' => __('Quattrocento Sans', 'vw-podcast-pro'),
        'Raleway' => __('Raleway', 'vw-podcast-pro'),
        'Rubik' => __('Rubik', 'vw-podcast-pro'),
        'Rokkitt' => __('Rokkitt', 'vw-podcast-pro'),
        'Russo One' => __('Russo One', 'vw-podcast-pro'),
        'Righteous' => __('Righteous', 'vw-podcast-pro'),
        'Slabo' => __('Slabo', 'vw-podcast-pro'),
        'Source Sans Pro' => __('Source Sans Pro', 'vw-podcast-pro'),
        'Shadows Into Light Two' => __('Shadows Into Light Two', 'vw-podcast-pro'),
        'Shadows Into Light' => __('Shadows Into Light', 'vw-podcast-pro'),
        'Sacramento' => __('Sacramento', 'vw-podcast-pro'),
        'Shrikhand' => __('Shrikhand', 'vw-podcast-pro'),
        'Tangerine' => __('Tangerine', 'vw-podcast-pro'),
        'Ubuntu' => __('Ubuntu', 'vw-podcast-pro'),
        'VT323' => __('VT323', 'vw-podcast-pro'),
        'Varela Round' => __('Varela Round', 'vw-podcast-pro'),
        'Vampiro One' => __('Vampiro One', 'vw-podcast-pro'),
        'Vollkorn' => __('Vollkorn', 'vw-podcast-pro'),
        'Volkhov' => __('Volkhov', 'vw-podcast-pro'),
        'Yanone Kaffeesatz' => __('Yanone Kaffeesatz', 'vw-podcast-pro')
    );

    $Check_option = array(
        '' => __('Not Selected', 'logistics_services_pr'),
        'Check' => __('Check', 'vw_podcast_pro'),
        'Uncheck' => __('Cross', 'vw_podcast_pro'),
    );
    $font_weight_array = array(
        '' => __('Not Selected','vw-podcast-pro'),
        '100' => __('100','vw-podcast-pro'),
        '200' => __('200', 'vw-podcast-pro'),
        '300' => __('300', 'vw-podcast-pro'),
        '400' => __('400', 'vw-podcast-pro'),
        '500' => __('500', 'vw-podcast-pro'),
        '600' => __('600', 'vw-podcast-pro'),
        '700' => __('700', 'vw-podcast-pro'),
        '800' => __('800', 'vw-podcast-pro'),
        '900' => __('900', 'vw-podcast-pro'),
    );
    require_once get_template_directory() . '/inc/customize/controls/slider-line-control/slider-line-control.php';
    require_once get_template_directory() . '/inc/customize/controls/social-icons/social-icon-picker.php';

    require_once get_template_directory() . '/inc/customize/controls/customizer-text-radio-button/class/customizer-text-radio-button.php';
    require_once get_template_directory() . '/inc/customize/controls/customizer-seperator/class/customizer-seperator.php';
    require_once get_template_directory() . '/inc/customize/controls/customizer-notice/class/customizer-notice.php';

    require_once get_template_directory() . '/inc/customize/controls/customize-repeater/customize-repeater.php';

    if ((ThemeWhizzie::get_the_validation_status() === 'true') && (ThemeWhizzie::get_the_suspension_status() == 'false')) {
        require_once get_template_directory() . '/inc/customize/sections/customizer-custom-variables.php';
        // require_once get_template_directory() . '/inc/customize/sections/customizer-part-social-icons.php';
        require_once get_template_directory() . '/inc/customize/sections/customizer-part-header.php';
        require_once get_template_directory() . '/inc/customize/sections/customizer-part-slide.php';
        require_once get_template_directory() . '/inc/customize/sections/customizer-part-home.php';
        require_once get_template_directory() . '/inc/customize/sections/customizer-part-footer.php';
        require_once get_template_directory() . '/inc/customize/sections/customizer-other-page.php';

    }
}
add_action('customize_register', 'vw_podcast_pro_customize_register');
//Integer
function vw_podcast_pro_sanitize_integer($input)
{
    if (is_numeric($input)) {
        return intval($input);
    }
}

/* Logo Resizer */
load_template(trailingslashit(get_template_directory()) . '/inc/logo/logo-resizer.php');

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class vw_podcast_pro_customize
{
    /**
     * Returns the instance.
     *
     * @since  1.0.0
     * @access public
     * @return object
     */
    public static function get_instance()
    {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new self;
            $instance->setup_actions();
        }
        return $instance;
    }
    /**
     * Constructor method.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function __construct()
    {
    }
    /**
     * Sets up initial actions.
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function setup_actions()
    {
        // Register panels, sections, settings, controls, and partials.
        add_action('customize_register', array($this, 'sections'));
        add_action('customize_register', array($this, 'bundle'));
        // Register scripts and styles for the controls.
        add_action('customize_controls_enqueue_scripts', array($this, 'enqueue_control_scripts'), 0);
    }
    /**
     * Sets up the customizer sections.
     *
     * @since  1.0.0
     * @access public
     * @param  object  $manager
     * @return void
     */
    public function sections($manager)
    {
        // Load custom sections.
        load_template(trailingslashit(get_template_directory()) . '/inc/review-section.php');
        // Register custom section types.
        $manager->register_section_type('vw_podcast_pro_customize_reviews_and_testimonials');
        // Register sections.
        $manager->add_section(
            new vw_podcast_pro_customize_reviews_and_testimonials(
                $manager,
                'example_1',
                array(
                    'title' => esc_html__('Review & Testimonial', 'vw-podcast-pro'),
                    'reviews_and_testimonials_text' => esc_html__('Rate Us', 'vw-podcast-pro'),
                    'reviews_and_testimonials_url' => 'https://www.vwthemes.com/topic/reviews-and-testimonials/',
                    'priority' => 1,
                )
            )
        );
    }

    public function bundle($manager)
    {
        // Load custom sections.
        load_template(trailingslashit(get_template_directory()) . '/inc/review-section.php');
        // Register custom section types.
        $manager->register_section_type('vw_podcast_pro_customize_reviews_and_testimonials');
        // Register sections.
        $manager->add_section(
            new vw_podcast_pro_customize_reviews_and_testimonials(
                $manager,
                'example_2',
                array(
                    'title' => esc_html__('Theme Bundle', 'vw-podcast-pro'),
                    'reviews_and_testimonials_text' => esc_html__('Buy Now', 'vw-podcast-pro'),
                    'reviews_and_testimonials_url' => 'https://www.vwthemes.com/premium/theme-bundle/',
                    'priority' => 2,
                )
            )
        );
    }
    /**
     * Loads theme customizer CSS.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue_control_scripts()
    {
        wp_enqueue_script('vw-podcast-pro-customize-controls', trailingslashit(get_template_directory_uri()) . '/assets/js/customize-controls.js', array('customize-controls'));
        wp_enqueue_style('vw-podcast-pro-customize-controls', trailingslashit(get_template_directory_uri()) . '/assets/css/customize-controls.css');
    }
}
// Doing this customizer thang!
vw_podcast_pro_customize::get_instance();