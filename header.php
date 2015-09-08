<?php
/**
 * Default Page Header
 *
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>

<!DOCTYPE html>
<!-- HTML5 -->
<html <?php language_attributes();?>>

<head>	
	<?php global $template_dir;
		$template_dir = get_template_directory_uri(); 
	?>
	
	<!-- get options -->
	<?php 		
		global $options;
		$options = get_option( 'encad_options' );
		require_once ( get_template_directory() . '/options-queries.php');
	?>
	
	<title><?php wp_title('&mdash;', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<header id="header">

	<div class="bs-docs-header" id="header-bar">
		<div class="container">
			<div class="header-images <?php if($options['header_wrapped'] == 'on')echo ('wrapped') ?>">
				<div class="slider-area" id="header-slider">
					<div class="logo" id="logo">	
						<a href="<?php echo home_url( '/' ); ?>" rel="home">
							<span class="helper"></span>
								<img class="logo-image"/>
						</a>
					</div><!-- ./logo -->
				</div><!-- ./slider-area -->
			</div><!-- ./header-images -->
		</div><!--/.container -->	
	</div><!--./bs-docs-header-->
 
	<nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse  <?php if($options['header_wrapped'] == 'on')echo ('wrapped') ?>">
			<!-- register nav_walker menu -->
			<?php                
				if ( has_nav_menu( 'main-menu' ) ) {      
					wp_nav_menu( array(
						'menu'       => 'main-menu',
						'theme_location' => 'main-menu',
						'depth'      => 2,
						'container'  => false,
						'menu_class' => 'nav navbar-nav',
						'fallback_cb' => 'wp_page_menu',
						'walker' => new wp_bootstrap_navwalker())
					); 				
				}
			?>			
        </div><!--/.navbar-collapse -->
	</nav>
	
</header>
		
<!-- End Header. Begin Body Content -->