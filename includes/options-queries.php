<?php 

/**
 * Description: PHP functions to set styles passed from options-page
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
 
 /*
 * Header
 */

function set_header_styles() {
	$options = get_option( 'encad_options' );
	
	$color = $options['header_color'];
	$image_color_url = $options['header_background_image_color_url'];
	$image_url = $options['header_background_image_url'];
	$logo_url = $options['header_logo_image_url'] ;
	$height = $options['header_height'];
	
	printf(
		"
		<style>
			.bs-docs-header { 
				background: $color; 
				height: ".$height."px;
				background-image: url($image_color_url);
			}
			.slider-area { background-image: url($image_url);}
			.logo-image { content: url($logo_url);}
		</style>
		"
	);	
}
add_action('wp_head', 'set_header_styles');

 /*
 * Menu
 */ 
 
function set_menu_styles() {
	 $options = get_option( 'encad_options' );
	 
	 $color = $options['menu_color'];
	 $color_gradient = addHexColor($color, '080808');
	 $border_color = $options['menu_border_color'];
	 $selected_color = $options['menu_selected_item_color'];	 
	 $selected_gradient_color =  addHexColor($selected_color, '080808');
	 $font_color = $options['menu_font_color'];
	 $font_active_color = $options['menu_font_active_color'];
	 $font_hover_color = $options['menu_font_hover_color'];
	 $height = $options['menu_height'];
	 
	 printf(
		"
		<style>
			.navbar {
				background-color: $color;
				background-image: linear-gradient(to bottom, $color_gradient 0, $color 100%%);
				background-image: -webkit-linear-gradient(top, $color_gradient 0, $color 100%%);
				background-image: -o-linear-gradient(top, $color_gradient 0, $color 100%%);
				background-image: -moz-linear-gradient(top, $color_gradient 0, $color 100%%);
				border-color: $border_color;
			}
			
			.navbar .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.active>a{
				background-color: $selected_color;
				background-image: linear-gradient(to bottom, $selected_gradient_color 0, $selected_color 100%%);
				background-image: -webkit-linear-gradient(top, $selected_gradient_color 0, $selected_color 100%%);
				background-image: -o-linear-gradient(top, $selected_gradient_color 0, $selected_color 100%%);
				background-image: -moz-linear-gradient(top, $selected_gradient_color 0, $selected_color 100%%);
			}
			
			.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.active>a {
				background-color: $selected_color;
				background-image: linear-gradient(to bottom, $selected_gradient_color 0, $selected_color 100%%);
				background-image: -webkit-linear-gradient(top, $selected_gradient_color 0, $selected_color 100%%);
				background-image: -o-linear-gradient(top, $selected_gradient_color 0, $selected_color 100%%);
				background-image: -moz-linear-gradient(top, $selected_gradient_color 0, $selected_color 100%%);
			}
			
			.navbar-inverse .navbar-nav>li>a {
				color: $font_color;
			}
			
			.navbar-inverse .navbar-nav>li>a:hover {
				color: $font_hover_color;
			}
			
			.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:focus {
				color: $font_active_color;
			}
			
			.nav .navbar-nav {
				height: ".$height."px;
			}
			
			.navbar-nav>li>a {
				line-height: ".$height."px;
			}
		</style>
		"
	);
}
add_action('wp_head', 'set_menu_styles');

/*
* Dropdown-Menu
*/
 
function set_dropdown_menu_styles() {
	$options = get_option( 'encad_options' );

	$color = $options['dropdown_menu_color'];
	$selected_color = $options['dropdown_menu_selected_item_color'];
	$selected_color_gradient = addHexColor($selected_color, '080808');
	$hover_color = $options['dropdown_menu_hover_item_color'];
	$hover_color_gradient = addHexColor($hover_color, '080808');
	$font_color = $options['dropdown_menu_font_color'];
	$active_font_color = $options['dropdown_menu_font_active_color'];
	$hover_font_color = $options['dropdown_menu_font_hover_color'];

	printf(
		"
		<style>
			.dropdown-menu {
				background-color: $color;
			}
			
			.dropdown-menu>li>a {
				color: $font_color;
			}
			
			.dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus {
				background-color: $selected_color;
				background-image: linear-gradient(to bottom, $selected_color_gradient 0, $selected_color 100%%);
				background-image: -webkit-linear-gradient(top, $selected_color_gradient 0, $selected_color 100%%);
				background-image: -o-linear-gradient(top, $selected_color_gradient 0, $selected_color 100%%);
				background-image: -moz-linear-gradient(top, $selected_color_gradient 0, $selected_color 100%%);
				color: $active_font_color;
			}
			
			.dropdown-menu>li>a:hover {
				background-color: $hover_color;
				background-image: linear-gradient(to bottom, $hover_color_gradient 0, $hover_color 100%%);
				background-image: -webkit-linear-gradient(top, $hover_color_gradient 0, $hover_color 100%%);
				background-image: -o-linear-gradient(top, $hover_color_gradient 0, $hover_color 100%%);
				background-image: -moz-linear-gradient(top, $hover_color_gradient 0, $hover_color 100%%);
				color: $hover_font_color;
			}
		</style>
		"	
	);
}
add_action('wp_head', 'set_dropdown_menu_styles');

/**
* Main Page
*/
 
function set_main_page_styles() {
	$options = get_option( 'encad_options' );
	
	$color = $options['main_color'];
	$blockquote_color = addHexColor($color, '#101010');
	
	printf (
		"
		<style>
			.jumbotron {
				background: $color;
			}
			blockquote {
				border-left-color: $blockquote_color;
			}
		</style>
		"
	);
 }
 add_action('wp_head', 'set_main_page_styles');
 
 /**
 * Footer
 */
 function set_footer_styles() {
	$options = get_option( 'encad_options' );
	
	$color = $options['footer_color'];
	$gradient_color = addHexColor($color, '080808');
	$font_color = $options['footer_font_color'];
	$border_color = $options['footer_border_color'];
	
	printf (
		"
		<style>
			.copyright {
				background-color: $color;
				background-image: linear-gradient(to bottom, $gradient_color 0, $color 100%%);
				background-image: -webkit-linear-gradient(top, $gradient_color 0, $color 100%%);
				background-image: -o-linear-gradient(top, $gradient_color 0, $color 100%%);
				background-image: -moz-linear-gradient(top, $gradient_color 0, $color 100%%);
				border-color: $border_color;
			}
			.footer-content {
				color: $font_color;
			}
		</style>
		"
	);
 }
 add_action('wp_head', 'set_footer_styles');
 
 /*
 * Generall Functions
 */
 
function addHexColor($c1, $c2) {
	return "#".(string)(dechex(hexdec($c1) + hexdec($c2)));
}

?>
