<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page template - Regular Page
	
------------------------------------------------------------------------------------------------------------ */
?>

	<?php 
	
		/* Get theme options */
		$jw_option = jw_get_options();
	
	?>
	
	<?php get_header(); ?>
	
	<div id="content" class="col-clear <?php echo $content_class; ?>">
		
		<p><?php _e('The page you are looking for could not be found.', 'jwlocalize'); ?></p>
		
	</div><!-- #content -->
	
	<?php get_footer(); ?>