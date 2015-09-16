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
	<!-- get options -->
	<?php 		
		global $options;
		$options = get_option( 'encad_options' );
		require_once ( get_template_directory() . '/includes/options-queries.php');
	?>
	
	<?php
		$analytics = $options["google_analytics"];
		if ($analytics != "") {
			echo $analytics;
		}
	?>
	
	<title><?php wp_title('&mdash;', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />	
	
	<link href='https://fonts.googleapis.com/css?family=Roboto:500,500italic' rel='stylesheet' type='text/css'>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="header">

	<div class="bs-docs-header" id="header-bar">
		<div class="container">
			<div class="header-images <?php if($options['header_wrapped'] == 'on')echo ('wrapped') ?>">
				<div class="slider-area" id="header-slider">
					<div class="container-fluid">
						<div class="row">
							<div class="logo col-md-4" id="logo">	
								<a href="<?php echo home_url( '/' ); ?>" rel="home">
									<img src="<?php if ($options['header_logo_image_url'] != ""){ echo( $options['header_logo_image_url'] ); } ?>" class="logo-image img-responsive"/>
								</a>
							</div><!-- ./logo -->
						</div>
					</div>
				</div><!-- ./slider-area -->
			</div><!-- ./header-images -->
		</div><!--/.container -->	
	</div><!--./bs-docs-header-->
 
	<nav id="top-navigation" class="navbar navbar-inverse <?php if($options['side_menu'] == 'on')echo ('side-menu-badge') ?>" role="navigation">
		<?php 
			if ($options['side_menu'] != 'on') {
				printf(
					'
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					</div>
					'
				);
			}
		?>
        <div id="navbar" class="navbar-collapse collapse  <?php if($options['header_wrapped'] == 'on')echo ('wrapped') ?>">
			<!-- register nav_walker menu -->
			<?php 
				if ($options['side_menu'] != 'on' && has_nav_menu( 'main-menu' ) ) {   
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