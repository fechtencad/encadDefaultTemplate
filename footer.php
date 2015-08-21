<?php
/**
 * Description: Default Footer template to display widgets and copyright
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>	
	
<?php get_sidebar('footer'); ?>

<footer>
	<div class="copyright row">
		<div class="col-xs-12 col-sm-12 col-md-6 text-left">
			<p>&copy; encad consulting GmbH 2015</p>
		</div> <!-- ./container --> 
		<div class="col-xs-12 col-sm-12 col-md-6 text-right">
			<p>created by Bernd Fecht</p>
		</div>
	</div><!-- ./copyright --> 			
</footer>
	<?php wp_footer(); ?>
 
</body>
</html>
