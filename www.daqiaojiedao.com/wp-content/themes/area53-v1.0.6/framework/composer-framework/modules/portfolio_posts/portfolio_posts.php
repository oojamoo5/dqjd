<?php
/* ---------------------------------------------------------------------------------------------------
	
	Portfolio Posts Module
	
--------------------------------------------------------------------------------------------------- */

/* ---------------------------------------------------------------------------------------------------
	If only shortcodes needed don't include this part
--------------------------------------------------------------------------------------------------- */
if(!isset($just_shortcodes) || !$just_shortcodes){

	$portfolio_categories_array = array();
	$portfolio_categories_object = get_terms( 'jw_portfolio_categories', 'orderby=count&hide_empty=0' );

	if(!empty($portfolio_categories_object)){
		$portfolio_categories_array['Show All'] = 'all';
		foreach($portfolio_categories_object as $portfolio_category_object){
			$portfolio_category_object_title = $portfolio_category_object->name;
			$portfolio_category_object_value = $portfolio_category_object->term_id;
			$portfolio_categories_array[$portfolio_category_object_title] = $portfolio_category_object_value;
		}
	}

	/* Create module */
	$module[] = array( 	'title' => 'Portfolio',
						'type'  => 'module_start',
						'sc'	=> 'portfolio_posts' );
	
	$module[] = array( 	'title' => 'Content Before',
						'desc'  => 'Enter some content here that you want to show before the actual output of this module.',
						'id'    => 'content_before',
						'std'   => '',
						'type'  => 'textarea' );
	
	$module[] = array( 	'title' => 'Style',
						'desc'  => 'Choose the style for this portfolio listing.',
						'id'    => 'p_style',
						'std'   => 'regular',
						'type'  => 'select',
						'opts'	=> array( 'Regular' => 'regular', 'Fancy' => 'fancy' ) );
	
	$module[] = array( 	'title' => 'Amount',
						'desc'  => 'Enter the amount of posts you want to show.',
						'id'    => 'amount',
						'std'   => '6',
						'type'  => 'text' );
	
	$module[] = array( 	'title' => 'Item Size',
						'desc'  => 'The size for each portfolio item. The sizes are relative to the whole page container.',
						'id'    => 'p_item_size',
						'std'   => 'one_third',
						'type'  => 'select',
						'opts'	=> array( '1/2' => 'one_half', '1/3' => 'one_third', '1/4' => 'one_fourth' ) );
	
	$module[] = array( 	'title' => 'Categories',
						'desc'  => 'Choose the portfolio category from which you want the posts to be fetched.',
						'id'    => 'p_cat',
						'std'   => 'all',
						'opts'	=> $portfolio_categories_array,
						'type'  => 'select' );
	
	/*	
	$module[] = array( 	'title' => 'Show Thumbnail',
						'desc'  => 'Do you want to show the thumbnail.',
						'id'    => 'show_thumbnail',
						'std'   => 'yes',
						'type'  => 'select',
						'opts'	=> array( 'Yes - Show the thumbnail' => 'yes', 'No - Do not show the thumbnail' => 'no' ) );
						
	$module[] = array( 	'title' => 'Show Title',
						'desc'  => 'Do you want to show the title.',
						'id'    => 'show_title',
						'std'   => 'yes',
						'type'  => 'select',
						'opts'	=> array( 'Yes - Show the title' => 'yes', 'No - Do not show the title' => 'no' ) );
						
	$module[] = array( 	'title' => 'Show Excerpt',
						'desc'  => 'Do you want to show the excerpt.',
						'id'    => 'show_excerpt',
						'std'   => 'yes',
						'type'  => 'select',
						'opts'	=> array( 'Yes - Show the excerpt' => 'yes', 'No - Do not show the excerpt' => 'no' ) );
	
	*/
	
	$module[] = array( 	'title' => 'Content After',
						'desc'  => 'Enter some content here that you want to show after the actual output of this module.',
						'id'    => 'content_after',
						'std'   => '',
						'type'  => 'textarea' );
						
	$module[] = array( 	'type'  => 'module_end' );
					

}
										 

/* ---------------------------------------------------------------------------------------------------
	Shortcodes
--------------------------------------------------------------------------------------------------- */
if(!is_admin()){
	
	add_shortcode('portfolio_posts', 'jw_portfolio_posts');
	
}else{

	add_shortcode('portfolio_posts', 'jw_portfolio_posts_admin');
	
}

/* ---------------------------------------------------------------------------------------------------
	Frontend Shortcode
--------------------------------------------------------------------------------------------------- */
function jw_portfolio_posts($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'amount' => '',
		'jw_size' => '',
		'size' => '',
		'p_item_size' => 'one_third',
		'p_cat'	=> 'all',
		/*
		'show_thumbnail' => 'yes',
		'show_title' => 'yes',
		'show_excerpt' => 'yes',
		*/
		'content_before' => '',
		'content_after' => '',
		'p_style' => 'regular'
	), $atts));
	
	/* Get theme options */
	$jw_option = jw_get_options();
	
	$output = '';
	
	$output .= $content_before.'<div class="clear"></div>';
	
	if($p_cat != 'all'){
		$portfolio_categories = get_objects_in_term($p_cat, 'jw_portfolio_categories');
	}else{
		$portfolio_categories = '';
	}
	
	$args = array(
		'post_type' 		=> 'jw_portfolio',
		'posts_per_page'	=> $amount,
		'post__in'			=> $portfolio_categories
	);
	$jw_query = new WP_Query($args);
	
	
	/* Vars */
	$item_size = $p_item_size;
	$container_size = $jw_size;
	
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
	
	if($container_size == 'one_third'){ 
		
		switch ($item_size) {
			case 'one_half':
				$count_max = 1;
				break;
			case 'one_third':
				$count_max = 1;
				break;
			case 'one_fourth':
				$count_max = 1;
				break;
		}
		
	}elseif($container_size == 'two_third'){ 
		
		switch ($item_size) {
			case 'one_half':
				$count_max = 1;
				break;
			case 'one_third':
				$count_max = 2;
				break;
			case 'one_fourth':
				$count_max = 3;
				break;
		}
	
	}elseif($container_size == 'one_half'){ 
		
		switch ($item_size) {
			case 'one_half':
				$count_max = 1;
				break;
			case 'one_third':
				$count_max = 1;
				break;
			case 'one_fourth':
				$count_max = 2;
				break;
		}
	
	}elseif($container_size == 'three_fourth'){ 
		
		switch ($item_size) {
			case 'one_half':
				$count_max = 1;
				break;
			case 'one_third':
				$count_max = 2;
				break;
			case 'one_fourth':
				$count_max = 3;
				break;
		}
	
	}elseif($container_size == 'one_one'){ 
		
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
		
	}
	
	if($p_style == 'fancy'){
		$portfolio_ul_class = 'portfolio-listing-fancy';
	}elseif($p_style == 'frames_simple'){
		$portfolio_ul_class = 'portfolio-listing-frames portfolio-listing-frames-simple';
	}else{
		$portfolio_ul_class = 'portfolio-listing-regular';
	}
	
	$count = 0;
	$real_count = 0;
	
	global $sn;
	
	$output .= '<div class="clearfix '.$portfolio_ul_class.' '.$size_class.'-items">';
	
		if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */ $count++; $real_count++;
			
			/* Get the custom fields values (aka post options) */
			$post_options_single = jw_get_post_options(get_the_ID());
			
			$last = '';
			$clear = '';
			if($count == $count_max){ $last = ' last'; $count = 0; }
			if($count == 1){ $clear = ' clear'; }
			
			$no_margin_from = $jw_query->post_count - $count_max;
			if($real_count > $no_margin_from){ $margin_class = ' no-margin-bottom'; }else{ $margin_class = ''; }
			
			if($p_style == 'fancy'){
				
				$output .= '<article class="portfolio-post-entry '.$size_class.'">';
								
					$output .= '<div class="portfolio-post-images">';
						$output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), $thumb_size).'</a>';
					$output .= '</div>';
					$output .= '<div class="portfolio-post-images-overlay"></div>';
					$output .= '<a href="'.get_permalink().'" class="portfolio-post-info-overlay">';
						$output .= '<h2 class="portfolio-post-title">'.get_the_title().'</h2>';
						$output .= '<span class="portfolio-post-excerpt">';
							$output .= get_the_excerpt();
						$output .= '</span>';
					$output .= '</a>';
					
				$output .= '</article><!-- .portfolio-post-entry -->';
				
			}else{
				
				$output .= '<article class="portfolio-post-entry '.$size_class.$last.$margin_class.'">';
			
					if(isset($post_options_single['jw_portfolio_item_images']) && !empty($post_options_single['jw_portfolio_item_images'])){
						
						$output .= '<div class="portfolio-post-images flexslider">';
							$output .= '<ul class="slides">';
								$portfolio_images_shortcode = str_replace('[portfolio_image', '[portfolio_image size="'.$item_size.'"', $post_options_single['jw_portfolio_item_images']);
								$portfolio_images_shortcode = preg_replace('/portfolio_image/', 'portfolio_image first="yes"', $portfolio_images_shortcode, 1);
								$output .= do_shortcode($portfolio_images_shortcode);
							$output .= '</ul>';
							$output .= '<div class="portfolio-post-hover portfolio-post-hover-image"></div>';
						$output .= '</div>';
					
					}elseif(isset($post_options_single['jw_portfolio_item_video']) && !empty($post_options_single['jw_portfolio_item_video'])){
						
						$output .= '<div class="portfolio-post-images">';
							$output .= '<a href="'.$post_options_single['jw_portfolio_item_video'].'" class="current-slide" rel="prettyPhoto['.get_the_ID().']">';
								$output .= get_the_post_thumbnail(get_the_ID(), $thumb_size);
							$output .= '</a>';
							$output .= '<div class="portfolio-post-hover portfolio-post-hover-video"></div>';
						$output .= '</div>';
					
					}elseif(has_post_thumbnail()){
						
						$output .= '<div class="portfolio-post-images">';
							$output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), $thumb_size).'</a>';
						$output .= '</div>';
						
					}
					
					$output .= '<h2 class="portfolio-post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
					
					$output .= '<div class="portfolio-post-excerpt">';
						$output .= get_the_excerpt();
					$output .= '</div>';
					
				$output .= '</article><!-- .portfolio-post-entry -->';
				
			}
			
		endwhile; else:
			
		endif;
	
	$output .= '</div>';
	
	wp_reset_query();
	
	$output = '<div class="portfolio-module">'.$output.'</div>';
	
	return do_shortcode($output);
	
}

/* ---------------------------------------------------------------------------------------------------
	Backend shortcode
--------------------------------------------------------------------------------------------------- */
function jw_portfolio_posts_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'amount' => '',
		'p_cat' => 'all',
		'p_item_size' => 'one_third',
		/*
		'show_thumbnail' => 'yes',
		'show_title' => 'yes',
		'show_excerpt' => 'yes',
		*/
		'content_before' => '',
		'content_after'	=> '',
		'p_style' => 'regular'
	), $atts));
	
	$output = '';
	
	/* The fields */
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-amount" title="amount" value="'.$amount.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-p_item_size" title="p_item_size" value="'.$p_item_size.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-p_cat" title="p_cat" value="'.$p_cat.'">';
	/*
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-show_thumbnail" title="show_thumbnail" value="'.$show_thumbnail.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-show_title" title="show_title" value="'.$show_title.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-show_excerpt" title="show_excerpt" value="'.$show_excerpt.'">';
	*/
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_before" title="content_before" value="'.$content_before.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_after" title="content_after" value="'.$content_after.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-p_style" title="p_style" value="'.$p_style.'">';
	
	/* Return the output */
	return $output;
	
}