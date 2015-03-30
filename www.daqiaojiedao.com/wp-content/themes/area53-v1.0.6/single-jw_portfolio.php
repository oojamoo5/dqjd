<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page template - Portfolio single post
	
------------------------------------------------------------------------------------------------------------ */
?>

	<?php 
		
		/* Main ID */
		$main_id = get_the_ID();
		
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
	
	<div id="portfolio-navigation" class="clearfix">
		
		<?php
			$prev_post = get_adjacent_post(false, '', true);
			$prev_post_link = get_permalink($prev_post->ID);
			$prev_post_title = $prev_post->post_title;
			$next_post = get_adjacent_post(false, '', false);
			$next_post_link = get_permalink($next_post->ID);
			$next_post_title = $next_post->post_title;
		?>
		
		<div id="portfolio-navigation-prev" class="one-third">
			<?php if($prev_post_link != get_permalink()){ ?>
				<a href="<?php echo $prev_post_link; ?>">&larr; <?php echo $prev_post_title; ?></a>
			<?php }else{ ?>
				&nbsp;
			<?php } ?>
		</div>
		
		<div id="portfolio-navigation-info" class="one-third align-center"><?php _e('project navigation', 'jwlocalize'); ?></div>
		
		<div id="portfolio-navigation-next" class="one-third last align-right">
			<?php if($next_post_link != get_permalink()){ ?>
				<a href="<?php echo $next_post_link; ?>"><?php echo $next_post_title; ?> &rarr;</a>
			<?php }else{ ?>
				&nbsp;
			<?php } ?>
		</div>
		
	</div>
	
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
			Post Content
		--------------------------------------------------------------------------------------------------- */
		?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class('post-entry portfolio-post-entry'); ?>>
			
			<?php if(isset($post_options['jw_composer_status']) && $post_options['jw_composer_status'][0] == 'active' & isset($post_options['jw_composer_main_frontend'])){ ?>
				
				<?php
				/* ---------------------------------------------------------------------------------------------------
					Composer Main
				--------------------------------------------------------------------------------------------------- */
				?>
				
				<?php echo do_shortcode($post_options['jw_composer_main_frontend'][0]); ?>
				
			<?php }else{ ?>
				
				<article class="portfolio-post-entry portfolio-post-entry-single">
			
					<?php if(isset($post_options['jw_portfolio_item_images']) && !empty($post_options['jw_portfolio_item_images'])){ ?>
						
						<div class="portfolio-post-images flexslider">
							<ul class="slides">
								<?php echo do_shortcode($post_options['jw_portfolio_item_images']); ?>
							</ul>
						</div>
					
					<?php }elseif(isset($post_options['jw_portfolio_item_video']) && !empty($post_options['jw_portfolio_item_video'])){ ?>
						
						<div class="portfolio-post-images">
							<a href="<?php echo $post_options['jw_portfolio_item_video']; ?>" class="current-slide" rel="prettyPhoto[<?php the_ID(); ?>]">
								<?php the_post_thumbnail($thumb_size); ?>
							</a>
						</div>
					
					<?php }elseif(has_post_thumbnail()){ ?>
						
						<div class="portfolio-post-images">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumb_size); ?></a>
						</div>
						
					<?php } ?>
					
					<div class="portfolio-post-content">
						<?php the_content(); ?>
					</div>
					
				</article><!-- .portfolio-post-entry -->
				
			<?php } ?>
			
			<?php
			/* ---------------------------------------------------------------------------------------------------
				Comments
			--------------------------------------------------------------------------------------------------- */
			?>
			
			<?php if($jw_option[$sn.'_portfolio_comments'] == 'yes'){ ?>
				
				<?php comments_template( '', true ); ?>
				
			<?php } ?>
			
		</div><!-- .post-entry -->
		
	</div><!-- #content -->
	
	<?php
	/* ---------------------------------------------------------------------------------------------------
		Sidebar Right
	--------------------------------------------------------------------------------------------------- */
	?>
	
	<?php if($post_options['jw_layout'] != 'layout_c'){ get_sidebar('portfolio'); } ?>
	
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