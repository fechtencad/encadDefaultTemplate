<?php
/**
 * The default functions.php
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>

<?php 

/**
 * Setup Theme Functions
 */
 
if (!function_exists('encad_theme_setup')) {

    function encad_theme_setup() {
		
		load_theme_textdomain('encad', get_template_directory() . '/lang');
		
		register_nav_menus (
                array (
                    'main-menu' => __('Hauptmenü', 'encad'),
				)
		);
		
		// Register Custom Navigation Walker
		require get_template_directory() . '/includes/wp_bootstrap_navwalker.php';
	}
}
add_action('after_setup_theme', 'encad_theme_setup');

/**
 * Enqueue scripts & styles
 */
if (!function_exists('bootstrapBasicEnqueueScripts')) {
	
	function bootstrapBasicEnqueueScripts() 
	{
		wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/bootstrap/css/bootstrap-theme.min.css');
		wp_enqueue_style('main-style', get_template_directory_uri() . '/bootstrap/css/main.css');

		wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/bootstrap/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/bootstrap/js/vendor/bootstrap.min.js');
		wp_enqueue_script('main-script', get_template_directory_uri() . '/bootstrap/js/main.js');
		wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());
	}// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');

/**
 * Define theme's widget areas.
 *
 */
function bootstrapwp_widgets_init() {

    register_sidebar(
            array(
                'name' => __('Footer Spalte 1', 'encad'),
                'id' => 'footer-column-1',
                'description' => __('Footer Spalte 1', 'encad'),
                'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div></aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>'
            )
    );


    register_sidebar(
            array(
                'name' => __('Footer Spalte 2', 'encad'),
                'id' => 'footer-column-2',
                'description' => __('Footer Spalte 2', 'encad'),
                'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div></aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>'
            )
    );


    register_sidebar(
            array(
                'name' => __('Footer Spalte 3', 'encad'),
                'id' => 'footer-column-3',
                'description' => __('Footer Spalte 3', 'encad'),
                'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div></aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>'
            )
    );
    
        register_sidebar(
            array(
                'name' => __('Footer Spalte 4', 'encad'),
                'id' => 'footer-column-4',
                'description' => __('Footer Spalte 4', 'encad'),
                'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div></aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>'
            )
    );
        
}
add_action('init', 'bootstrapwp_widgets_init');


/**
 * Load Theme Options 
 *
 */
require_once ( get_template_directory() . '/includes/theme-options.php' );















?>

