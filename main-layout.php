<?php
/**
 * Description: Default template to display content
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>

<div class="container">
	<div class="row">
		<div class="span12">
			<?php if (function_exists('bootstrapwp_breadcrumbs')) {
				bootstrapwp_breadcrumbs();
			} ?>
		</div>
	</div>
	<?php
		if (have_posts()) : while (have_posts()) : the_post();
				get_template_part('content', get_post_format());
			endwhile;
		endif;
	?>
</div>
