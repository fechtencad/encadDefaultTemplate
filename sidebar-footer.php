<?php
/**
 * Description: Default template to display Footer widgets
 * @author Bernd Fecht (encad consulting GmbH)
 * @package WordPress
 * @subpackage encadTemplate
 */
?>		
	
<div class="widgets-area wrapped">
	<div class="cotnainer">
		<div class="row">
			 <div class="col-md-3">
                <?php
                if (function_exists('dynamic_sidebar')) {
                    dynamic_sidebar("footer-column-1");
                }
                ?>
            </div>
            <div class="col-md-3">
                <?php
                if (function_exists('dynamic_sidebar')) {
                    dynamic_sidebar("footer-column-2");
                }
                ?>
            </div>
            <div class="col-md-3">
                <?php
                if (function_exists('dynamic_sidebar')) {
                    dynamic_sidebar("footer-column-3");
                }
                ?>
            </div>
             <div class="col-md-3">
                <?php
                if (function_exists('dynamic_sidebar')) {
                    dynamic_sidebar("footer-column-4");
                }
                ?>
            </div>
		</div><!-- ./row -->
	</div><!-- ./container -->	
</div><!-- ./widgets-area -->