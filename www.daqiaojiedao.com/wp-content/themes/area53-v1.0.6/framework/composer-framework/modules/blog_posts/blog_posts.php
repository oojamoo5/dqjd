<?php
/* ---------------------------------------------------------------------------------------------------
	
	Blog Posts Module
	
--------------------------------------------------------------------------------------------------- */

$blog_categories_array = array();
$blog_categories_object = get_categories();

$blog_categories_array['Show All'] = 'all';

foreach($blog_categories_object as $blog_category_object){
	$blog_category_object_title = $blog_category_object->name;
	$blog_category_object_value = $blog_category_object->term_id;
	$blog_categories_array[$blog_category_object_title] = $blog_category_object_value;
}

/* Create module */
$module[] = array( 	'title' => 'Blog',
					'type'  => 'module_start',
					'sc'	=> 'blog_posts' );

$module[] = array( 	'title' => 'Content Before',
					'desc'  => 'Enter some content here that you want to show before the actual output of this module.',
					'id'    => 'content_before',
					'std'   => '',
					'type'  => 'textarea' );
				
$module[] = array( 	'title' => 'Categories',
					'desc'  => 'Choose the blog category from which you want the posts to be fetched.',
					'id'    => 'b_cat',
					'std'   => 'all',
					'opts'	=> $blog_categories_array,
					'type'  => 'select' );
					
$module[] = array( 	'title' => 'Amount',
					'desc'  => 'Enter the amount of posts you want to show.',
					'id'    => 'amount',
					'std'   => '6',
					'type'  => 'text' );
					
$module[] = array( 	'title' => 'Item Size',
					'desc'  => 'The size for each post item. The sizes are relative to the whole page container.',
					'id'    => 'b_item_size',
					'std'   => 'one_third',
					'type'  => 'select',
					'opts'	=> array( '1/2' => 'one_half', '1/3' => 'one_third', '1/4' => 'one_fourth' ) );
					
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
					
$module[] = array( 	'title' => 'Content After',
					'desc'  => 'Enter some content here that you want to show after the actual output of this module.',
					'id'    => 'content_after',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(!is_admin()){
	add_shortcode('blog_posts', 'jw_blog_posts');
}else{
	add_shortcode('blog_posts', 'jw_blog_posts_admin');
}

function jw_blog_posts($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'amount' => '',
		'jw_size' => '',
		'b_item_size'	=> 'one_third',
		'b_cat' => 'all',
		'show_thumbnail' => 'yes',
		'show_title' => 'yes',
		'show_excerpt' => 'yes',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output = '';
	
	$output .= $content_before.'<div class="clear"></div>';
	
	if($b_cat != 'all'){
		$args = array(
			'posts_per_page'	=> $amount,
			'cat'	=> $b_cat
		);
	}else{
		$args = array(
			'posts_per_page'	=> $amount
		);
	}
	$jw_query = new WP_Query($args);
	
	/* Vars */
	$item_size = $b_item_size;
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
			
			if($show_thumbnail == 'yes'){
			
				$output .= '<div class="blog-post-thumbnail">
					<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), $thumbnail_size, array('class' => 'wrapped')).'</a>
					<span class="blog-post-pointer"></span>
				</div>';
				
			}
			
			$output .= '<div class="blog-post-content col-clear">';
			
				if($show_title == 'yes'){
					$output .= '<h2 class="blog-post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
				}
								
				$arc_year = get_the_time('Y');
				$arc_month = get_the_time('m');
				$arc_day = get_the_time('d');
				$output .= '<div class="blog-post-meta clearfix">'.get_the_time(__('jS F Y', 'jwlocalize')).'</div>';
				
				if($show_excerpt == 'yes'){
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

function jw_blog_posts_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'amount' => '',
		'b_item_size' => 'one_third',
		'b_cat' => 'all',
		'show_thumbnail' => 'yes',
		'show_title' => 'yes',
		'show_excerpt' => 'yes',
		'content_before' => '',
		'content_after'	=> ''
	), $atts));
	
	$output = '';
	
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-amount" title="amount" value="'.$amount.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-b_cat" title="b_cat" value="'.$b_cat.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-b_item_size" title="b_item_size" value="'.$b_item_size.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-show_thumbnail" title="show_thumbnail" value="'.$show_thumbnail.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-show_title" title="show_title" value="'.$show_title.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-show_excerpt" title="show_excerpt" value="'.$show_excerpt.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_before" title="content_before" value="'.$content_before.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_after" title="content_after" value="'.$content_after.'">';
	
	return $output;
	
}