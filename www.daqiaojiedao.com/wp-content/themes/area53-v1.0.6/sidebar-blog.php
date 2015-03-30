<?php
/* ---------------------------------------------------------------------------------------------------
	
	Sidebar - Blog
	
--------------------------------------------------------------------------------------------------- */
?>

	<?php 
		
		wp_reset_query();
		
		/* Get theme options */
		$jw_option = jw_get_options();
		
		global $sn;
		
		/* Get the custom fields values (aka post options) */
		$post_options = jw_get_post_options($post->ID);		
		
		/* Generate class attribute for #sidebar */
		$sidebar_class = '';
		if(is_archive()){
			if($jw_option[$sn.'_layout_archive'] == 'layout_cs'){ $sidebar_class .= 'last '; }
		}else if(is_search()){
			if($jw_option[$sn.'_layout_search'] == 'layout_cs'){ $sidebar_class .= 'last '; }
		}else{
			if($post_options['jw_layout'] == 'layout_cs'){ $sidebar_class .= 'last '; }
		}
		
		/* Get special sidebar if it exists */
		if(!empty($post_options['jw_sidebar'])){ $sidebar_name = $post_options['jw_sidebar']; }else{ $sidebar_name = 'Blog Widgets'; }
		
	?>

	<div id="sidebar" class="one-third <?php echo $sidebar_class; ?>">
		
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : else : ?>
			
			<!-- No widgets START -->
			
			<div class="widget">
				<div class="widget-inner">
					<h3 class="widget-title"><span><?php _e('No Widgets Added Yet', 'jwlocalize'); ?></span></h3>
					<p><?php _e('Please add them in the WordPress admin page under Appearance &rarr; Widgets. The widget section is called', 'jwlocalize'); ?> <strong><?php echo $sidebar_name; ?></strong></p> 
				</div>
			</div>
			
			<!-- No widgets END -->
			
		<?php endif; ?>

	</div><!-- #sidebar -->