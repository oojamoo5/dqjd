<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page template - Regular Page
	
------------------------------------------------------------------------------------------------------------ */
?>

	<?php 
	
		/* Get theme options */
		$jw_option = jw_get_options();
		
		/* Get the custom fields values (aka post options) */
		$post_options = jw_get_post_options($post->ID);
		
		/* Get the post/page */
		the_post();
	
	?>
	
	<?php get_header(); /* Get header */ ?>
	
	<?php
	/* ---------------------------------------------------------------------------------------------------
		Content Composer Top
	--------------------------------------------------------------------------------------------------- */
	?>
		
	<?php if(isset($post_options['jw_composer_status']) && $post_options['jw_composer_status'][0] == 'active' & isset($post_options['jw_composer_top_frontend'])){ ?>
		
		<div id="content-top">
			<?php echo do_shortcode($post_options['jw_composer_top_frontend'][0]); ?>
		</div><!-- #content-top -->
		
		<div class="clear"></div>
		
	<?php } ?>
	
	<?php
	/* ---------------------------------------------------------------------------------------------------
		Main Content
	--------------------------------------------------------------------------------------------------- */
	?>
	
	<div id="content" class="col-clear <?php echo $content_class; ?>">
		
		<div id="post-<?php the_ID(); ?>">		
			
			<?php
			/* ---------------------------------------------------------------------------------------------------
				Post Content
			--------------------------------------------------------------------------------------------------- */
			?>
			
			<?php if(isset($post_options['jw_composer_status']) && $post_options['jw_composer_status'][0] == 'active'){ ?>
			
				<?php echo do_shortcode($post_options['jw_composer_main_frontend'][0]); ?>
				
			<?php }else{ ?>
				
				<div class="post-content">
					<?php the_content(); ?>
				</div><!-- .post-content -->
				
			<?php } ?>
			
			<?php
			/* ---------------------------------------------------------------------------------------------------
				Comments
			--------------------------------------------------------------------------------------------------- */
			?>
			
			<?php if($jw_option[$sn.'_page_comments'] == 'yes'){ ?>
				
				<div class="separator"></div>
				<?php comments_template( '', true ); ?>
				
			<?php } ?>
			
		</div><!-- #post-# -->
		
	</div><!-- #content -->
	
	<?php
	/* ---------------------------------------------------------------------------------------------------
		Sidebar
	--------------------------------------------------------------------------------------------------- */
	?>
	
	<?php if($post_options['jw_layout'] != 'layout_c'){ get_sidebar(); } ?>
	
	<?php
	/* ---------------------------------------------------------------------------------------------------
		Content Composer Bottom
	--------------------------------------------------------------------------------------------------- */
	?>
	
	<?php if(isset($post_options['jw_composer_status']) && $post_options['jw_composer_status'][0] == 'active' && isset($post_options['jw_composer_bottom_frontend'])){ ?>
		
		<div class="clear"></div>
		
		<div id="content-bottom">
			<?php echo do_shortcode($post_options['jw_composer_bottom_frontend'][0]); ?>
		</div><!-- #content-top -->
		
	<?php } ?>
	
	<?php get_footer(); /* Get footer */ ?>