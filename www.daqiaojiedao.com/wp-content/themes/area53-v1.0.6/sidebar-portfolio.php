<?php
/* ---------------------------------------------------------------------------------------------------
	
	Sidebar - Portfolio
	
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
		if(!empty($post_options['jw_sidebar'])){ $sidebar_name = $post_options['jw_sidebar']; }else{ $sidebar_name = 'Portfolio Widgets'; }
		
	?>

	<aside id="sidebar">
		
		<?php if(isset($post_options['jw_portfolio_description']) && !empty($post_options['jw_portfolio_description'])){ ?>
			
			<section class="widget">
				<h3 class="widget-title"><span><?php _e('Description', 'jwlocalize'); ?></span></h3>
				<?php echo $post_options['jw_portfolio_description']; ?>
			</section>
			
		<?php } ?>
		
		<?php if($jw_option[$sn.'_portfolio_single_info'] == 'yes'){ ?>
			
			<section class="widget">
				
				<h3 class="widget-title"><span><?php _e('Information', 'jwlocalize'); ?></span></h3>
				
				<ul id="portfolio-sidebar-details">
					
					<?php if($jw_option[$sn.'_portfolio_single_info_author'] == 'yes'){ ?>
						<li><span><?php _e('Made by:', 'jwlocalize'); ?></span> <?php the_author_meta('display_name'); ?></li>
					<?php } ?>
					
					<?php if($jw_option[$sn.'_portfolio_single_info_date'] == 'yes'){ ?>
						<li><span><?php _e('Published:', 'jwlocalize'); ?></span> <?php the_time('nS F Y'); ?></li>
					<?php } ?>
					
					<?php if($jw_option[$sn.'_portfolio_single_info_categories'] == 'yes'){ ?>
						<?php  
							$portfolio_cats = get_the_terms($post->ID, 'jw_portfolio_categories');
							$portfolio_cats_output = '';
							if(!empty($portfolio_cats)){
							
								foreach($portfolio_cats as $portfolio_cat){
									$portfolio_cats_output .= $portfolio_cat->name.', ';
								}
								
								?><li><span><?php _e('Categories:', 'jwlocalize'); ?></span> <?php
								echo substr($portfolio_cats_output, 0, -2);
								
							}
						?>
						</li>
					<?php } ?>
					
					<?php if(isset($post_options['jw_portfolio_client_name']) && !empty($post_options['jw_portfolio_client_name']) && $jw_option[$sn.'_portfolio_single_info_client'] == 'yes'){ ?>
						<li>
							<?php if(isset($post_options['jw_portfolio_client_link']) && !empty($post_options['jw_portfolio_client_link'])){ ?>
								<span><?php _e('Client:', 'jwlocalize'); ?></span> <a href="<?php echo $post_options['jw_portfolio_client_link'] ?>"><?php echo $post_options['jw_portfolio_client_name']; ?></a>
							<?php }else{ ?>
								<span><?php _e('Client:', 'jwlocalize'); ?></span> <?php echo $post_options['jw_portfolio_client_name']; ?>
							<?php } ?>
						</li>
					<?php } ?>
				</ul>
				
			</section>
			
		<?php } ?>
		
		<h2 class="section-heading"><span><?php _e('Similar Projects', 'jwlocalize'); ?></span></h2>
		
		<?php
			
			/* Related Projects */
			
			$portfolio_cats_ids = array();
			foreach($portfolio_cats as $portfolio_cat){
				$portfolio_cats_ids[] = $portfolio_cat->term_id;
			}
			
			$portfolio_categories = get_objects_in_term($portfolio_cats_ids, 'jw_portfolio_categories');
			
			$orig_id = get_the_ID();
			
			$args = array(
				'post_type' 		=> 'jw_portfolio',
				'posts_per_page'	=> -1,
				'post__in'			=> $portfolio_categories
			);
			$jw_related_query = new WP_Query($args);
		
			$thumbnail_size = 'jw_one_third_crop';
			$item_size = 'one_third';
		
		?>
		
		<div id="portfolio-single-related">
			
			<div class="slider-container">
				
				<div class="slider flexslider">
				
					<ul class="slides">
					
						<?php if ($jw_related_query->have_posts()) : while ($jw_related_query->have_posts()) : $jw_related_query->the_post(); /* Loop the posts */ ?>
							
							<?php if(get_the_ID() != $orig_id){ ?>
							
								<li class="portfolio-post-entry">
								
									<?php if(has_post_thumbnail()){ ?>
											
											<div class="portfolio-post-images">
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumbnail_size); ?></a>
											</div>
									
									<?php } ?>
											
									<div class="slide-info">
										<h2 class="portfolio-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<div class="portfolio-post-excerpt"><?php the_excerpt(); ?></div>
									</div>
									
								</li>
							
							<?php } ?>
							
						<?php endwhile; else: endif; wp_reset_query(); ?>
				
					</ul>
					
				</div>
			
			</div>
			
		</div><!-- #portfolio-single-related -->
		
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : else : ?>
		
			
		<?php endif; ?>

	</aside><!-- #sidebar -->