<?php
/* ---------------------------------------------------------------------------------------------------
	
	Template Name: Portfolio
	
--------------------------------------------------------------------------------------------------- */
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
		
		/* Query the blog posts */
		if($post_options['jw_portfolio_categories'] != 'all'){
			$portfolio_categories = get_objects_in_term(unserialize(($post_options['jw_portfolio_categories'])), 'jw_portfolio_categories');
		}else{
			$portfolio_categories = '';
		}
		
		/* If filters activated show all posts */
		if($post_options['jw_portfolio_filters'] == 'yes'){
			$jw_option[$sn.'_portfolio_listing_per_page'] = -1;
		}
		
		if(is_front_page()){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }else{ $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; }
		$args = array(
			'paged' 			=> $paged, 
			'post_type' 		=> 'jw_portfolio',
			'posts_per_page'	=> $jw_option[$sn.'_portfolio_listing_per_page'],
			'post__in'			=> $portfolio_categories,
			'order'				=>  $post_options['jw_portfolio_order']
		);
		$jw_query = new WP_Query($args);
	
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
		Content
	--------------------------------------------------------------------------------------------------- */
	?>
	
	<div id="content" class="clearfix">
		
		<?php
		/* ---------------------------------------------------------------------------------------------------
			Content
		--------------------------------------------------------------------------------------------------- */
		?>
		
		<?php 
		
			$count = 0;
			$count_max = 2;
			if($post_options['jw_layout'] == 'layout_c'){ $count_max = 3; }
			
			$portfolio_ul_class = 'portfolio-listing-'.$post_options['jw_layout_post_style'];
			
			/* Get sizes and other vars */
					
			$item_size = $post_options['jw_layout_special_item_size'];
			
			if($item_size == 'one_half'){
				
				$size_class = 'one-half';
				$thumb_size = 'jw_one_half_crop';
				
			}elseif($item_size == 'one_third'){
			
				$size_class = 'one-third';
				$thumb_size = 'jw_one_half_crop'; /* Bigger for responsivness */
			
			}elseif($item_size == 'one_fourth'){
			
				$size_class = 'one-fourth';
				$thumb_size = 'jw_one_half_crop'; /* Bigger for responsivness */
			
			}
			
			switch ($item_size) {
				case 'one_half':
					$count_max = 2;
					break;
				case 'one_third':
					$count_max = 3;
					break;
				case 'one_fourth':
					$count_max = 4;
					break;
			}
			
			if($post_options['jw_layout'] == 'layout_cs' || ($post_options['jw_layout'] == 'layout_sc')){
				
				$count_max = 2;
				$size_class = 'one-third';
				$thumb_size = 'jw_one_half_crop'; /* Bigger for responsivness */
				
			}
			
		?>
		
		<div class="portfolio-quicksand portfolio-listing clearfix <?php echo $size_class.'-items '.$portfolio_ul_class; ?>">
			
			<?php if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */ $count++; ?>
				
				<?php
					/* Get the custom fields values (aka post options) */
					$post_options_single = jw_get_post_options($post->ID);
				?>
				
				<?php
					
					$last = '';
					$clear = '';
					if($count == $count_max){ $last = ' last'; $count = 0; }
					if($count == 1){ $clear = ' clear'; }
					
					$portfolio_cats = get_the_terms($post->ID, 'jw_portfolio_categories');
					$portfolio_cats_output = '';
					if(!empty($portfolio_cats)){
					
						foreach($portfolio_cats as $portfolio_cat){
							$portfolio_cats_output .= $portfolio_cat->name.' ';
						}
						
					}
					
					/* ---------------------------------------------------------------------------------------------------
						Style 1
					--------------------------------------------------------------------------------------------------- */
					if($post_options['jw_layout_post_style'] == 'fancy'){
						
						?>
							
							<article data-id="quicksand-id-<?php the_ID(); ?>" data-cat="<?php echo $portfolio_cats_output; ?>" class="portfolio-post-entry <?php echo $size_class; ?>">
								
								<div class="portfolio-post-images">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumb_size); ?></a>
								</div>
								<div class="portfolio-post-images-overlay"></div>
								<a href="<?php the_permalink(); ?>" class="portfolio-post-info-overlay">
									<h2 class="portfolio-post-title"><?php the_title(); ?></h2>								
									<span class="portfolio-post-excerpt">
										<?php the_excerpt(); ?>
									</span>
								</a>
								
							</article><!-- .portfolio-post-entry -->
							
						<?php
						
					/* ---------------------------------------------------------------------------------------------------
						Regular Style (default)
					--------------------------------------------------------------------------------------------------- */
					}else{
						
						?>

							<article data-id="quicksand-id-<?php the_ID(); ?>" data-cat="<?php echo $portfolio_cats_output; ?>" class="portfolio-post-entry <?php echo $size_class.$last.$clear; ?>">
								
								<?php if($jw_option[$sn.'_portfolio_listing_lightbox'] == 'yes'){ ?>
								
									<?php if(isset($post_options_single['jw_portfolio_item_images']) && !empty($post_options_single['jw_portfolio_item_images'])){ ?>
										
										<div class="portfolio-post-images flexslider">
											<ul class="slides">
												<?php echo do_shortcode($post_options_single['jw_portfolio_item_images']); ?>
											</ul>
											<div class="portfolio-post-hover portfolio-post-hover-image"></div>
										</div>
									
									<?php }elseif(isset($post_options_single['jw_portfolio_item_video']) && !empty($post_options_single['jw_portfolio_item_video'])){ ?>
										
										<div class="portfolio-post-images">
											<a href="<?php echo $post_options_single['jw_portfolio_item_video']; ?>" class="current-slide" rel="prettyPhoto[<?php the_ID(); ?>]">
												<?php the_post_thumbnail($thumb_size); ?>
											</a>
											<div class="portfolio-post-hover portfolio-post-hover-video"></div>
										</div>
									
									<?php }elseif(has_post_thumbnail()){ ?>
										
										<div class="portfolio-post-images">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumb_size); ?></a>
										</div>
										
									<?php } ?>
									
								<?php }else{ ?>
								
									<div class="portfolio-post-images">
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumb_size); ?></a>
									</div>
								
								<?php } ?>
								
								<h2 class="portfolio-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
								<div class="portfolio-post-excerpt">
									<?php the_excerpt(); ?>
								</div>
								
							</article><!-- .portfolio-post-entry -->
							
						<?php
						
					}
					
				?>
				
			<?php endwhile; else: ?>
				
				<p><?php _e('The portfolio is empty.', 'jwlocalize'); ?></p>
				
			<?php endif; ?>
		
		</div>
		
		<div class="clear"></div>
		
		<?php
		/* ---------------------------------------------------------------------------------------------------
			Pagination
		--------------------------------------------------------------------------------------------------- */
		?>
		
		<?php $num_pages = $jw_query->max_num_pages; jw_pagination($num_pages); ?>
		
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
	
	<?php get_footer(); /* get footer */ ?>