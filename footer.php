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
		<div class="col-xs-12 col-sm-12 col-md-6 text-left footer-container">
			<p class="footer-content">&copy;<?php echo date("Y"); ?>, encad consulting GmbH. All rights reserved!</p>
		</div> <!-- ./col --> 
		<div class="col-xs-12 col-sm-12 col-md-6 text-right footer-container">
			<div class="footer-content">
				<div class="social-media-buttons">
					<?php
						$template_dir = get_template_directory_uri(); 
						$options = get_option( 'encad_options' );
						$button_type = $options['button_type'];						
						
						if (($i = $options['twitter']) != "") {
							echo "<a href='$i'><img title='Twitter' src='$template_dir/img/$button_type-socials/twitter.png' alt='Twitter' width='30' height='30' /></a>";
						}
						
						if (($i = $options['facebook']) != "") {
							echo "<a href='$i'><img title='Facebook' src='$template_dir/img/$button_type-socials/facebook.png' alt='Facebook' width='30' height='30' /></a>";
						}
						
						if (($i = $options['google_plus']) != "") {
							echo "<a href='$i'><img title='Google+' src='$template_dir/img/$button_type-socials/googleplus.png' alt='Google+' width='30' height='30' /></a>";
						}
						
						if (($i = $options['pinterest']) != "") {
							echo "<a href='$i'><img title='Google+' src='$template_dir/img/$button_type-socials/pinterest.png' alt='Google+' width='30' height='30' /></a>";
						}
						
						if (($i = $options['youtube']) != "") {
							echo "<a href='$i'><img title='Google+' src='$template_dir/img/$button_type-socials/youtube.png' alt='Google+' width='30' height='30' /></a>";
						}
						
						if (($i = $options['email']) != "") {
							echo "<a href='mailto:$i'><img title='Google+' src='$template_dir/img/$button_type-socials/email.png' alt='Google+' width='30' height='30' /></a>";
						}
						
						if (($i = $options['rss']) != "") {
							echo "<a href='$i'><img title='Google+' src='$template_dir/img/$button_type-socials/rss.png' alt='Google+' width='30' height='30' /></a>";
						}						
					?>
				</div>
			</div>
		</div><!-- ./col --> 
	</div><!-- ./copyright --> 			
</footer>
	<?php wp_footer(); ?>
 
</body>
</html>
