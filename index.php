<?php
/**
 * Description: Default Index template to display loop of blog posts
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>

<?php get_header(); ?>

<div class="main-content">
		<div class="jumbotron <?php if($options['wrapped'] == 'on')echo ('wrapped') ?>">
			<div class="container">
				<?php
					if (have_posts()) : while (have_posts()) : the_post();

							get_template_part('content', get_post_format());

						endwhile;
					endif;
				?>
			</div>
		</div>
</div><!--./main-content -->

<?php get_footer(); ?>
