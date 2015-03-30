<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page template - Blog single post page
	
------------------------------------------------------------------------------------------------------------ */
?>

	<?php 
		
		/* Get theme options */
		$jw_option = jw_get_options();
		
		/* Global shortname variable */
		global $sn;
		
		/* Get the custom fields values (aka post options) */
		$post_options = jw_get_post_options($post->ID);
		
		/* Get the post/page */
		the_post();
		
		/* Thumbnail size */
		$thumb_size = 'jw_full';
		if($post_options['jw_layout'] != 'layout_c'){ $thumb_size = 'jw_two_third'; }
	
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
		
		<?php
		/* ---------------------------------------------------------------------------------------------------
			Post
		--------------------------------------------------------------------------------------------------- */
		?>
		
		<?php if(isset($post_options['jw_composer_status']) && $post_options['jw_composer_status'][0] == 'active' & isset($post_options['jw_composer_main_frontend'])){ ?>
			
			<?php
			/* ---------------------------------------------------------------------------------------------------
				Composer Main
			--------------------------------------------------------------------------------------------------- */
			?>
			
			<?php echo do_shortcode($post_options['jw_composer_main_frontend'][0]); ?>
			
		<?php }else{ ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-entry'); ?>>
		
				<?php if(has_post_thumbnail() && $jw_option[$sn.'_blog_single_thumbnail'] == 'yes'){ ?>
						
					<div class="blog-post-thumbnail">
						<?php the_post_thumbnail($thumb_size, array( 'title' => get_the_title() )); ?>
					</div><!-- .blog-post-thumbnail -->
					
				<?php } ?>
				
				
				
				<div class="blog-post-content">
					<?php the_content(); ?>
				</div><!-- .blog-post-content -->
				
			</article>

		<?php } ?>
			
		<div class="separator big"></div>
		
	</div><!-- #content -->
	
	<?php
	/* ---------------------------------------------------------------------------------------------------
		Sidebar
	--------------------------------------------------------------------------------------------------- */
	?>
	
	<?php if($post_options['jw_layout'] != 'layout_c'){ get_sidebar('blog'); } ?>
	
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