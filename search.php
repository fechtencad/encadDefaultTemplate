<?php
/**
 * Description: Search result tempalte
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadDefaultTemplate
 */
 ?>
 
<?php get_header(); ?>
<div class="jumbotron <?php if($options['wrapped'] == 'on')echo ('wrapped') ?>" >
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if (function_exists('bootstrapwp_breadcrumbs')) {
					bootstrapwp_breadcrumbs();
				} ?>
			</div>
		</div><!--/.row -->

		<div class="row content">
			<div class="col-md-8">
				<?php if (have_posts()) : ?>
					 <header class="post-title">
						 <h1><?php printf( __('Search Results for: %s', 'bootstrapwp'),'<span>' . get_search_query() . '</span>'); ?></h1>
					 </header>

				  <?php while (have_posts()) : the_post(); ?>
					<div <?php post_class(); ?>>
						<a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
							<h3><?php the_title();?></h3>
						</a>
						<?php the_content(); ?>
				 <?php endwhile; ?>				
					</div>
				<?php else: ?>
					<div class="col-md-8" >
						<header class="post-title">
						<h1><?php _e('No Results Found', 'bootstrapwp'); ?></h1>
						</header>
						<p class="lead">
							<?php _e(
								'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps you should try again with a different search term.',
								'bootstrapwp'); ?>
						</p>
					</div>
				<?php endif; ?>
			</div><!-- ./col-md-8 -->		
		</div><!-- ./row content -->
		<div class="well">
			<?php get_search_form(); ?>
		</div><!--/.well -->
	</div><!-- ./container -->
</div><!-- ./jumbotron -->

<?php get_footer(); ?>