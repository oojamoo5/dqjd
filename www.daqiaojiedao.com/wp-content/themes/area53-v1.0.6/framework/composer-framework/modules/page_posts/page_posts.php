<?php
/* ---------------------------------------------------------------------------------------------------
	
	Blog Posts Module
	
--------------------------------------------------------------------------------------------------- */

$page_categories_array = array();
$page_categories_object = get_terms( 'jw_page_categories', 'orderby=count&hide_empty=0' );

if(!empty($page_categories_object)){
	$page_categories_array['Show All'] = 'all';
	foreach($page_categories_object as $page_category_object){
		$page_category_object_title = $page_category_object->name;
		$page_category_object_value = $page_category_object->term_id;
		$page_categories_array[$page_category_object_title] = $page_category_object_value;
	}
}

/* Create module */
$module[] = array( 	'title' => 'Pages',
					'type'  => 'module_start',
					'sc'	=> 'page_posts' );

$module[] = array( 	'title' => 'Content Before',
					'desc'  => 'Enter some content here that you want to show before the actual output of this module.',
					'id'    => 'content_before',
					'std'   => '',
					'type'  => 'textarea' );
				
$module[] = array( 	'title' => 'Categories',
					'desc'  => 'Choose the blog category from which you want the posts to be fetched.',
					'id'    => 'page_cat',
					'std'   => 'all',
					'opts'	=> $page_categories_array,
					'type'  => 'select' );
					
$module[] = array( 	'title' => 'Amount',
					'desc'  => 'Enter the amount of posts you want to show.',
					'id'    => 'page_amount',
					'std'   => '6',
					'type'  => 'text' );
					
$module[] = array( 	'title' => 'Item Size',
					'desc'  => 'The size for each post item. The sizes are relative to the whole page container.',
					'id'    => 'page_item_size',
					'std'   => 'one_third',
					'type'  => 'select',
					'opts'	=> array( '1/2' => 'one_half', '1/3' => 'one_third', '1/4' => 'one_fourth' ) );
					
$module[] = array( 	'title' => 'Show Thumbnail',
					'desc'  => 'Do you want to show the thumbnail.',
					'id'    => 'page_show_thumbnail',
					'std'   => 'yes',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the thumbnail' => 'yes', 'No - Do not show the thumbnail' => 'no' ) );
					
$module[] = array( 	'title' => 'Show Title',
					'desc'  => 'Do you want to show the title.',
					'id'    => 'page_show_title',
					'std'   => 'yes',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the title' => 'yes', 'No - Do not show the title' => 'no' ) );
					
$module[] = array( 	'title' => 'Show Excerpt',
					'desc'  => 'Do you want to show the excerpt.',
					'id'    => 'page_show_excerpt',
					'std'   => 'yes',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the excerpt' => 'yes', 'No - Do not show the excerpt' => 'no' ) );
					
$module[] = array( 	'title' => 'Content After',
					'desc'  => 'Enter some content here that you want to show after the actual output of this module.',
					'id'    => 'content_after',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(!is_admin()){
	add_shortcode('page_posts', 'jw_page_posts');
}else{
	add_shortcode('page_posts', 'jw_page_posts_admin');
}

function jw_page_posts($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'page_amount' => '',
		'jw_size' => '',
		'page_cat' => 'all',
		'page_item_size'	=> 'one_third',
		'page_show_thumbnail' => 'yes',
		'page_show_title' => 'yes',
		'page_show_excerpt' => 'yes',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output = '';
	
	$output .= $content_before.'<div class="clear"></div>';
	
	if($page_cat != 'all'){
		$page_categories = get_objects_in_term($page_cat, 'jw_page_categories');
	}else{
		$page_categories = '';
	}
	
	if($page_cat != 'all'){
		$args = array(
			'post_type' => 'page',
			'posts_per_page'	=> $page_amount,
			'post__in'	=> $page_categories
		);
	}else{
		$args = array(
			'post_type' => 'page',
			'posts_per_page'	=> $page_amount
		);
	}
	$jw_query = new WP_Query($args);
	
	/* Vars */
	$item_size = $page_item_size;
	$container_size = $jw_size;
	
	if($item_size == 'one_half'){
		
		$size_class = 'one-half';
		$thumbnail_size = 'jw_one_half_crop';
		
	}elseif($item_size == 'one_third'){
	
		$size_class = 'one-third';
		$thumbnail_size = 'jw_one_half_crop'; /* Bigger for responsivness */
	
	}elseif($item_size == 'one_fourth'){
	
		$size_class = 'one-fourth';
		$thumbnail_size = 'jw_one_half_crop'; /* Bigger for responsivness */
	
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
	
	$count = 0;
	$real_count = 0;
	
	if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */ $count++; $real_count++;
		
		$last = '';
		$clear = '';
		$separator = '';
		
		if($count == $count_max){ $last = ' last'; $count = 0; $separator = '<div class="separator"></div>'; }
		if($count == 1){ $clear = ' clear'; }
		
		$no_margin_from = $jw_query->post_count - $count_max;
		if($real_count > $no_margin_from){ $margin_class = ' no-margin-bottom'; }else{ $margin_class = ''; }
		
		$output .= '<article class="composer-blog-post-entry '.$size_class.$last.$clear.$margin_class.'">';
			
			if($page_show_thumbnail == 'yes'){
			
				$output .= '<div class="blog-post-thumbnail">
					<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), $thumbnail_size, array('class' => 'wrapped')).'</a>
					<span class="blog-post-pointer"></span>
				</div>';
				
			}
			
			$output .= '<div class="blog-post-content col-clear">';
			
				if($page_show_title == 'yes'){
					$output .= '<h2 class="blog-post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
				}
				
				if($page_show_excerpt == 'yes'){
					$output .= '<div class="post-content">'.get_the_excerpt().'</div>';
				}
				
			$output .= '</div>';
			
		$output .= '</article><!-- .post-entry -->';
		
	endwhile; else:
		
	endif;
	
	wp_reset_query();
	
	$output .= $content_after;
	
	$output = '<div class="blog-module">'.$output.'</div>';
	
	return do_shortcode($output);
	
}

function jw_page_posts_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'page_amount' => '',
		'page_cat' => 'all',
		'page_item_size' => 'one_third',
		'page_show_thumbnail' => 'yes',
		'page_show_title' => 'yes',
		'page_show_excerpt' => 'yes',
		'content_before' => '',
		'content_after'	=> ''
	), $atts));
	
	$output = '';
	
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-page_amount" title="page_amount" value="'.$page_amount.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-page_cat" title="page_cat" value="'.$page_cat.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-page_item_size" title="page_item_size" value="'.$page_item_size.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-page_show_thumbnail" title="page_show_thumbnail" value="'.$page_show_thumbnail.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-page_show_title" title="page_show_title" value="'.$page_show_title.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-page_show_excerpt" title="page_show_excerpt" value="'.$page_show_excerpt.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_before" title="content_before" value="'.$content_before.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_after" title="content_after" value="'.$content_after.'">';
	
	return $output;
	
}