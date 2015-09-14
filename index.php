<?php
/**
 * Description: Default Index template to display loop of blog posts
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>

<?php get_header(); ?>

	<?php 
		if ($options['side_menu']) {
			require_once(get_template_directory().'/side-menu-layout.php');
		}
		else {
			require_once(get_template_directory().'/main-layout.php');
		}
	?>	

<?php get_footer(); ?>
