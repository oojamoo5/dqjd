<?php
/* ---------------------------------------------------------------------------------------------------
	
	Sidebar - Pages
	
--------------------------------------------------------------------------------------------------- */
?>

	<?php 
		
		wp_reset_query();
		
		/* Get theme options */
		$jw_option = jw_get_options();
		
		global $sn;
		
		/* Get the custom fields values (aka post options) */
		$post_options = jw_get_post_options($post->ID);	
		
		/* Get special sidebar if it exists */
		if(!empty($post_options['jw_sidebar'])){ $sidebar_name = $post_options['jw_sidebar']; }else{ $sidebar_name = 'Page Widgets'; }
		
	?>

	<aside id="sidebar">
		
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : else : ?>
			
			<!-- No widgets START -->
			
			<section class="widget">
				<h3 class="widget-title"><span><?php _e('No Widgets Added Yet', 'jwlocalize'); ?></span></h3>
				<p><?php _e('Please add them in the WordPress admin page under Appearance &rarr; Widgets. The widget section is called', 'jwlocalize'); ?> <strong><?php echo $sidebar_name; ?></strong></p> 
			</section>
			
			<!-- No widgets END -->
			
		<?php endif; ?>

	</aside><!-- #sidebar -->