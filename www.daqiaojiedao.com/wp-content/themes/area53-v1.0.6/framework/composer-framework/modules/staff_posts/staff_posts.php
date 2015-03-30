<?php
/* ---------------------------------------------------------------------------------------------------
	
	Staff Posts Module
	
--------------------------------------------------------------------------------------------------- */

$staff_categories_array = array();
$staff_categories_object = get_terms( 'jw_staff_categories', 'orderby=count&hide_empty=0' );

if(!empty($staff_categories_object)){
	$staff_categories_array['Show All'] = 'all';
	foreach($staff_categories_object as $staff_category_object){
		$staff_category_object_title = $staff_category_object->name;
		$staff_category_object_value = $staff_category_object->term_id;
		$staff_categories_array[$staff_category_object_title] = $staff_category_object_value;
	}
}

/* Create module */
$module[] = array( 	'title' => 'Staff',
					'type'  => 'module_start',
					'sc'	=> 'staff_posts' );

$module[] = array( 	'title' => 'Content Before',
					'desc'  => 'Enter some content here that you want to show before the actual output of this module.',
					'id'    => 'content_before',
					'std'   => '',
					'type'  => 'textarea' );
			
$module[] = array( 	'title' => 'Amount',
					'desc'  => 'Enter the amount of staff members you want to show.',
					'id'    => 'staff_amount',
					'std'   => '6',
					'type'  => 'text' );
					
$module[] = array( 	'title' => 'Categories',
					'desc'  => 'Choose the staff category from which you want the posts to be fetched.',
					'id'    => 'staff_categories',
					'std'   => 'all',
					'opts'	=> $staff_categories_array,
					'type'  => 'select' );
					
$module[] = array( 	'title' => 'Item Size',
					'desc'  => 'The size for each staff member post. The sizes are relative to the whole page container.',
					'id'    => 'staff_item_size',
					'std'   => 'one_third',
					'type'  => 'select',
					'opts'	=> array( '1/2' => 'one_half', '1/3' => 'one_third', '1/4' => 'one_fourth' ) );
					
$module[] = array( 	'title' => 'Show Pictures',
					'desc'  => 'Do you want to show the member\'s pictures.',
					'id'    => 'staff_show_pictures',
					'std'   => 'yes',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the thumbnail' => 'yes', 'No - Do not show the thumbnail' => 'no' ) );
					
$module[] = array( 	'title' => 'Show Names',
					'desc'  => 'Do you want to show the member\'s names.',
					'id'    => 'staff_show_names',
					'std'   => 'yes',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the title' => 'yes', 'No - Do not show the title' => 'no' ) );
					
$module[] = array( 	'title' => 'Show About Text',
					'desc'  => 'Do you want to show the about text.',
					'id'    => 'staff_show_about',
					'std'   => 'yes',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the about text' => 'yes', 'No - Do not show the about text' => 'no' ) );
					
$module[] = array( 	'title' => 'Show Social Links',
					'desc'  => 'Do you want to show the links to social networks.',
					'id'    => 'staff_show_social',
					'std'   => 'yes',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the links' => 'yes', 'No - Do not show the links' => 'no' ) );
					
$module[] = array( 	'title' => 'Content After',
					'desc'  => 'Enter some content here that you want to show after the actual output of this module.',
					'id'    => 'content_after',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(!is_admin()){
	add_shortcode('staff_posts', 'jw_staff_posts');
}else{
	add_shortcode('staff_posts', 'jw_staff_posts_admin');
}

function jw_staff_posts($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'staff_amount' => '',
		'jw_size' => '',
		'staff_categories' => 'all',
		'staff_item_size' => 'one_third',
		'staff_show_pictures' => 'yes',
		'staff_show_names' => 'yes',
		'staff_show_about' => 'yes',
		'staff_show_social' => 'yes',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output = '';
	
	$output .= $content_before.'<div class="clear"></div>';
	
	if($staff_categories != 'all'){
		$staff_categories = get_objects_in_term($staff_categories, 'jw_staff_categories');
	}else{
		$staff_categories = '';
	}
	
	$args = array(
		'post_type' => 'jw_staff',
		'posts_per_page' => $staff_amount,
		'order' => 'ASC',
		'post__in' => $staff_categories
	);
	
	$jw_query = new WP_Query($args);
	
	/* Vars */
	$item_size = $staff_item_size;
	$container_size = $jw_size;
	
	if($item_size == 'one_half'){
		
		$size_class = 'one-half';
		$thumbnail_size = 'jw_one_half_crop';
		
	}elseif($item_size == 'one_third'){
	
		$size_class = 'one-third';
		$thumbnail_size = 'jw_one_third_crop';
	
	}elseif($item_size == 'one_fourth'){
	
		$size_class = 'one-fourth';
		$thumbnail_size = 'jw_one_fourth_crop';
	
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
	
	$output .= '<div class="staff-listing clearfix">';
	
		if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */ $count++; $real_count++;
			
			/* Get the custom fields values (aka post options) */
			$post_options = jw_get_post_options($post->ID);
			
			$last = '';
			$clear = '';
			$separator = '';
			
			if($count == $count_max){ $last = ' last'; $count = 0; $separator = '<div class="separator"></div>'; }
			if($count == 1){ $clear = ' clear'; }
			
			$no_margin_from = $jw_query->post_count - $count_max;
			if($real_count > $no_margin_from){ $margin_class = ' no-margin-bottom'; }else{ $margin_class = ''; }
			
			$output .= '<article class="staff-post-entry '.$size_class.$last.$clear.$margin_class.'">';
				
				if($staff_show_pictures == 'yes'){
				
					$output .= '<div class="staff-post-thumbnail">';
					
						$output .= get_the_post_thumbnail(get_the_ID(), $thumbnail_size);
						
					$output .= '</div><!-- .staff-post-thumbnail -->';
				
				}
				
				if($staff_show_names == 'yes'){
				
					$output .= '<h2 class="staff-post-title">'.$post_options['jw_staff_member_name'].'</h2>';
					
				}
				
				if($staff_show_position == 'yes' || 1==1){
				
					$output .= '<span class="staff-post-position">'.$post_options['jw_staff_member_position'].'</span>';
					
				}
				
				if($staff_show_about == 'yes'){
				
					$output .= '<div class="staff-post-excerpt">';
						$output .= $post_options['jw_staff_member_about'];
					$output .= '</div>';
					
				}
				
				if($staff_show_social == 'yes'){
					
					$output .= '<ul class="staff-post-social">';
						if(!empty($post_options['jw_staff_member_social_facebook'])){ $output .= ' <li><a href="'.$post_options['jw_staff_member_social_facebook'].'" class="staff-post-social-facebook"></a></li>'; }
						if(!empty($post_options['jw_staff_member_social_twitter'])){ $output .= ' <li><a href="'.$post_options['jw_staff_member_social_twitter'].'" class="staff-post-social-twitter"></a></li>'; }
						if(!empty($post_options['jw_staff_member_social_linkedin'])){ $output .= ' <li><a href="'.$post_options['jw_staff_member_social_linkedin'].'" class="staff-post-social-linkedin"></a></li>'; }
					$output .= '</ul>';
					
				}
				
			$output .= '</article><!-- .staff-post-entry -->';
			
		endwhile; else:
			
		endif;
	
	$output .= '</div><!-- .staff-listing -->';
	
	wp_reset_query();
	
	$output .= $content_after;
	
	$output = '<div class="blog-module">'.$output.'</div>';
	
	return do_shortcode($output);
	
}

function jw_staff_posts_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'staff_categories' => 'all',
		'staff_amount' => '',
		'staff_item_size' => 'one_third',
		'staff_show_pictures' => 'yes',
		'staff_show_names' => 'yes',
		'staff_show_about' => 'yes',
		'staff_show_social' => 'yes',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output = '';
	
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-staff_categories" title="staff_categories" value="'.$staff_categories.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-staff_amount" title="staff_amount" value="'.$staff_amount.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-staff_item_size" title="staff_item_size" value="'.$staff_item_size.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-staff_show_pictures" title="staff_show_pictures" value="'.$staff_show_pictures.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-staff_show_about" title="staff_show_about" value="'.$staff_show_about.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-staff_show_social" title="staff_show_social" value="'.$staff_show_social.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_before" title="content_before" value="'.$content_before.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_after" title="content_after" value="'.$content_after.'">';
	
	return $output;
	
}