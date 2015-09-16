<?php
/**
 * Description: Side-Menu template to display content and side-menu
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>	


<div class="container-fluid">
	<!-- register nav_walker menu -->
	<div class="row">
		<div class="col-md-4 menu-block">
			<nav class='navblock navbar navbar-inverse' role='navigation'>
			<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-side" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						</div>
				<div id='navbar-side' class='navbar-collapse collapse side-menu'>
					<?php
							wp_nav_menu( array(
								'menu'       => 'main-menu',
								'theme_location' => 'main-menu',
								'depth'      => 1,
								'container'  => false,
								'menu_class' => 'nav navbar-nav navbar-side',
								'fallback_cb' => 'wp_page_menu',
								'walker' => new wp_bootstrap_navwalker())
							); 
					?>
				</div>
			</nav>
		</div>
		<div class="col-md-8">
			<div class="menu-spaced-content">
					<?php
						if (have_posts()) : while (have_posts()) : the_post();

								get_template_part('content', get_post_format());

							endwhile;
						endif;
					?>
			</div>
		</div>
	</div><!-- ./row -->
</div><!-- ./container -->
