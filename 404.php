<?php
/**
 * Description: The template for displaying 404 pages (Not found)
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadDefaultTemplate
 */
 
 ?>
 
<?php get_header(); ?>
<div class="jumbotron <?php if($options['wrapped'] == 'on')echo ('wrapped') ?>" >
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php if (function_exists('bootstrapwp_breadcrumbs')) {
				bootstrapwp_breadcrumbs();
			} ?>
			</div>
		</div>

	   <div class="content">

				<header class="page-title">
					<h1><?php _e('This is Embarrassing', 'bootstrapwp'); ?></h1>
				</header>

				<p class="lead"><?php _e(
					'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.',
					'bootstrapwp'
				); ?></p>

			   <div class="well">
				   <?php get_search_form(); ?>
			   </div>

		    <h2>All Pages</h2>
		    <?php wp_page_menu(); ?>
		</div><!-- ./content-->
	</div><!-- ./container --> 
</div><!-- ./jumbotron -->	   
<?php get_footer(); ?>
