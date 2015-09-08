<?php
/**
 * Description: Default template to display Footer widgets
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>		

<?php
	global $options;
	$options = get_option( 'encad_options' );
?>	

<?php
	$widget_amount = $options['widgets'];
	if ($widget_amount == 0) {
		return;
	}
	else {	
		
		printf(
			'<div class="widgets-area %s">',
			($options['wrapped'] == 'on' ? "wrapped" : "")
		);	
		$col_index = 12 / $widget_amount;
		echo '<div class="row">';
				
		for ($i = 1; $i <= intval($widget_amount); $i++) {				
			echo '<div class="col-md-'.$col_index.'">';
			if (function_exists('dynamic_sidebar')) {
				dynamic_sidebar("footer-column-$i");
			}
			echo '</div><!-- ./col -->';
		}

		echo '</div><!-- ./row -->';
		echo '</div><!-- ./widgets-area -->';
	}
?>
			
