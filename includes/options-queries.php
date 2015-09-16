<?php 

/**
 * Description: PHP functions to set styles passed from options-page
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadDefaultTemplate
 */
 
 /*
 * Header
 */

function set_header_styles() {
	$options = get_option( 'encad_options' );
	
	$color = $options['header_color'];
	$image_color_url = $options['header_background_color_image_url'];
	$image_url = $options['header_background_image_url'];
	$height = $options['header_height'];
	$shadow = $options['header_shadow'];
	
	printf(
		"
		<style>
			.bs-docs-header { 
				background: $color; 
				height: ".$height."px;
				background-image: url($image_color_url);
			}
			.slider-area { 
				background-image: url($image_url);
			}		
		</style>
		"
	);	
	
	if ($shadow == "on") {
		echo "<style>#top-navigation {
			-webkit-box-shadow: 0px 3px 9px -1px rgba(0,0,0,0.57);
			-moz-box-shadow: 0px 3px 9px -1px rgba(0,0,0,0.57);
			box-shadow: 0px 3px 9px -1px rgba(0,0,0,0.57);
			}
			</style>";
	}
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
			
			.side-menu-badge {
				height: ".$height."px;
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
* Side-Menu
*/

function set_side_menu_styles() {
	$options = get_option( 'encad_options' );
	
	$font_color = $options['side_menu_font_color'];
	$hover_font_color = $options['side_menu_hover_font_color'];
	$active_font_color = $options['side_menu_active_font_color'];
	$font_size = $options['side_menu_font_size'];
	$list_style = $options['side_menu_list_style'];
	$list_style_image = $options['side_menu_list_style_image_url'];
	printf(
		"
		<style>
			.navbar-side >li>a {
				color: $font_color !important;
				font-size: ".$font_size."px;
			}
			
			.navbar-side >li>a:hover, .navbar-side >li>a:focus {
				color: $hover_font_color !important;
			}
			
			.navbar-side .active>a, .navbar-side .active>a:hover, .navbar-side .active>a:focus {
				color: $active_font_color !important;
			}
			
			.navbar-side {
				list-style-type: $list_style;
			}
		</style>
		"
	);
	if ($list_style_image != '') {
		echo "<style>.navbar-side{ list-style-image: url($list_style_image); list-style-type: none;}</style>";
	}
		
}
add_action('wp_head', 'set_side_menu_styles');

/**
* Main Page
*/
 
function set_main_page_styles() {
	$options = get_option( 'encad_options' );
	
	$color = $options['main_color'];
	$blockquote_color = addHexColor($color, '#101010');
	$shadow = $options['shadow'];
	$title_color = $options['title_font_color'];
	
	printf (
		"
		<style>
			.jumbotron {
				background: $color;
			}
			blockquote {
				border-left-color: $blockquote_color;
			}
			
			.jumbotron h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
				color: $title_color;
			}
		</style>
		"
	);
	
	if ($shadow == "on") {
		echo "<style>.jumbotron{
			-webkit-box-shadow: -3px 0px 12px -1px rgba(0,0,0,0.57), 3px 0px 12px -1px rgba(0,0,0,0.57);
			-moz-box-shadow: -3px 0px 12px -1px rgba(0,0,0,0.57), 3px 0px 12px -1px rgba(0,0,0,0.57);
			box-shadow: -3px 0px 12px -1px rgba(0,0,0,0.57), 3px 0px 12px -1px rgba(0,0,0,0.57);
			}
			</style>";
	}	
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
