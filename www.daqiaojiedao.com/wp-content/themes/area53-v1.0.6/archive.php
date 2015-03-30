<?php
/* ---------------------------------------------------------------------------------------------------
	
	Archive Template
	
--------------------------------------------------------------------------------------------------- */
?>
	
	<?php 
		
		/* Get theme options */
		$jw_option = jw_get_options();
		
		/* Global shortname variable */
		global $sn;
		
		/* Get the custom fields values (aka post options) */
		$post_options = jw_get_post_options($post->ID);
		
		/* Thumbnail size */
		$thumb_size = 'jw_full';
		if($jw_option[$sn.'_layout_archive'] != 'layout_c'){ $thumb_size = 'jw_two_third'; }
	
	?>
	
	<?php get_header(); /* Get header */ ?>
	
	<?php
	/* ---------------------------------------------------------------------------------------------------
		Content
	--------------------------------------------------------------------------------------------------- */
	?>
	
	<div id="content" class="col-clear <?php echo $content_class; ?>">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); /* Loop the posts */ ?>
			
			<?php
			/* ---------------------------------------------------------------------------------------------------
				Post Content
			--------------------------------------------------------------------------------------------------- */
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-entry'); ?>>
				
				<?php if(has_post_thumbnail() && $jw_option[$sn.'_blog_listing_thumbnails'] == 'yes'){ ?>
						
					<div class="blog-post-thumbnail">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumb_size, array( 'title' => get_the_title() )); ?></a>
					</div><!-- .blog-post-thumbnail -->
					
				<?php } ?>
				
				<header>
					<h1 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<ul class="blog-post-meta">
						<li>by <?php the_author_posts_link(); ?></li>
						<?php 
							$arc_year = get_the_time('Y');
							$arc_month = get_the_time('m');
							$arc_day = get_the_time('d');
						?>
						<li>on <a href="<?php echo get_day_link($arc_year, $arc_month, $arc_day); ?>"><?php the_time(__('jS F Y', 'jwlocalize')); ?></a></li>
						<li>in <?php the_category(', '); ?></li>
						<li>with <?php comments_popup_link( __('No comments', 'jwlocalize'), __('One comment', 'jwlocalize'), '% '.__('comments', 'jwlocalize'), 'blog-post-meta-comments', '' ); ?></li>
					</ul>
				</header>		
				
				<div class="blog-post-content">
					<?php
						if($jw_option[$sn.'_blog_listing_content_type'] == 'excerpt'){
							the_excerpt();
						}else{
							the_content();
						}
					?>
				</div><!-- .blog-post-content -->
				
				<a href="<?php the_permalink(); ?>" class="blog-post-read-more"><?php _e('阅读全文 &rarr;', 'jwlocalize'); ?></a>
				
			</article>
			
		<?php endwhile; else: ?>
			
			<p><?php _e('No related content found.', 'jwlocalize'); ?></p>
			
		<?php endif; ?>
		
		<?php
		/* ---------------------------------------------------------------------------------------------------
			
			Pagination
			
		--------------------------------------------------------------------------------------------------- */
		?>
		
		<div class="clear"></div>
		<?php $num_pages = $jw_query->max_num_pages; jw_pagination($num_pages); ?>
		
	</div><!-- #content -->
	
	<?php
	/* ---------------------------------------------------------------------------------------------------
		Sidebar
	--------------------------------------------------------------------------------------------------- */
	?>
	
	<?php if($post_options['jw_layout'] != 'layout_c'){ get_sidebar('blog'); } ?>

	<?php get_footer(); /* Get footer */ ?>