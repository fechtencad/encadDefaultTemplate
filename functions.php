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
 * Load Theme Options 
 *
 */
require_once ( get_template_directory() . '/includes/theme-options.php');

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
if (!function_exists('basic_bootstrapwp_enqueue_scripts')) {
	
	function basic_bootstrapwp_enqueue_scripts() 
	{
		wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/bootstrap/css/bootstrap-theme.min.css');
		wp_enqueue_style('main-style', get_template_directory_uri() . '/bootstrap/css/main.css');

		wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/bootstrap/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/bootstrap/js/vendor/bootstrap.min.js');
		wp_enqueue_script('main-script', get_template_directory_uri() . '/bootstrap/js/main.js');
		wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());
		
	}// basic_bootstrapwp_enqueue_scripts
}
add_action('wp_enqueue_scripts', 'basic_bootstrapwp_enqueue_scripts');

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
 * Load color-picker files.
 *
 */
function encad_color_picker() {
	wp_enqueue_script('iris', get_template_directory_uri().'/includes/js/iris.min.js');
	wp_enqueue_script('iris-init', get_template_directory_uri().'/js/iris-init.js');
}
add_action('admin_enqueue_scripts', 'encad_color_picker');

/**
 * Load image-picker files.
 *
 */
function encad_image_picker() {
	wp_enqueue_media();
	wp_enqueue_script('meadia_picker', get_template_directory_uri().'/js/media_picker.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'encad_image_picker');

?>

