<?php
/**
 * Description: Default template to display content
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>

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