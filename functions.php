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

/**
 * Display template for breadcrumbs.
 *
 */
function bootstrapwp_breadcrumbs()
{
    $home      = __('Home', 'bootstrapwp'); // text for the 'Home' link
    $before    = '<li class="active">'; // tag before the current crumb
    $sep       = '<span class="divider"></span>';
    $after     = '</li>'; // tag after the current crumb

    if (!is_home() && !is_front_page() || is_paged()) {

        echo '<ul class="breadcrumb">';

        global $post;
        $homeLink = home_url();
            echo '<li><a href="' . $homeLink . '">' . $home . '</a> '.$sep. '</li> ';
            if (is_category()) {
                global $wp_query;
                $cat_obj   = $wp_query->get_queried_object();
                $thisCat   = $cat_obj->term_id;
                $thisCat   = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) {
                    echo get_category_parents($parentCat, true, $sep);
                }
                echo $before . __('Archive by category', 'bootstrapwp') . ' "' . single_cat_title('', false) . '"' . $after;
            } elseif (is_day()) {
                echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
                ) . '</a></li> ';
                echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
                    'F'
                ) . '</a></li> ';
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                    'Y'
                ) . '</a></li> ';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug      = $post_type->rewrite;
                    echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ';
                    echo $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo '<li>'.get_category_parents($cat, true, $sep).'</li>';
                    echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat    = get_the_category($parent->ID);
                $cat    = $cat[0];
                echo get_category_parents($cat, true, $sep);
                echo '<li><a href="' . get_permalink(
                    $parent
                ) . '">' . $parent->post_title . '</a></li> ';
                echo $before . get_the_title() . $after;

            } elseif (is_page() && !$post->post_parent) {
                echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id   = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page          = get_page($parent_id);
                    $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title(
                        $page->ID
                    ) . '</a>' . $sep . '</li>';
                    $parent_id     = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) {
                    echo $crumb;
                }
                echo $before . get_the_title() . $after;
            } elseif (is_search()) {
                echo $before . __('Search results for', 'bootstrapwp') . ' "'. get_search_query() . '"' . $after;
            } elseif (is_tag()) {
                echo $before . __('Posts tagged', 'bootstrapwp') . ' "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . __('Articles posted by', 'bootstrapwp') . ' ' . $userdata->display_name . $after;
            } elseif (is_404()) {
                echo $before . __('Error 404', 'bootstrapwp') . $after;
            }
            // if (get_query_var('paged')) {
            //     if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()
            //     ) {
            //         echo ' (';
            //     }
            //     echo __('Page', 'bootstrapwp') . $sep . get_query_var('paged');
            //     if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()
            //     ) {
            //         echo ')';
            //     }
            // }

        echo '</ul>';

    }
}

?>

