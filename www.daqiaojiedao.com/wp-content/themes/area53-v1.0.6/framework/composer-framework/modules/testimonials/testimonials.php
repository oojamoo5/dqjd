<?php
/* ---------------------------------------------------------------------------------------------------
	
	Testimonials Module
	
--------------------------------------------------------------------------------------------------- */

$testimonials_categories_array = array();
$testimonials_categories_object = get_terms( 'jw_testimonials_categories', 'orderby=count&hide_empty=0' );

if(!empty($testimonials_categories_object)){
	$testimonials_categories_array['Show All'] = 'all';
	foreach($testimonials_categories_object as $testimonials_category_object){
		$testimonials_category_object_title = $testimonials_category_object->name;
		$testimonials_category_object_value = $testimonials_category_object->term_id;
		$testimonials_categories_array[$testimonials_category_object_title] = $testimonials_category_object_value;
	}
}

/* Create module */
$module[] = array( 	'title' => 'Testimonials',
					'type'  => 'module_start',
					'sc'	=> 'testimonials' );

$module[] = array( 	'title' => 'Content Before',
					'desc'  => 'Enter some content here that you want to show before the actual output of this module.',
					'id'    => 'content_before',
					'std'   => '',
					'type'  => 'textarea' );

$module[] = array( 	'title' => 'Categories',
					'desc'  => 'Choose the testimonial category from which you want the posts to be fetched.',
					'id'    => 't_cat',
					'std'   => 'all',
					'opts'	=> $testimonials_categories_array,
					'type'  => 'select' );
				
$module[] = array( 	'title' => 'Amount',
					'desc'  => 'Enter the amount of posts you want to show.',
					'id'    => 'amount',
					'std'   => '8',
					'type'  => 'text' );

$module[] = array( 	'title' => 'Item Size',
					'desc'  => 'The size for each post item. The sizes are relative to the whole page container.',
					'id'    => 't_item_size',
					'std'   => 'one_third',
					'type'  => 'select',
					'opts'	=> array( '1/2' => 'one_half', '1/3' => 'one_third', '1/4' => 'one_fourth' ) );					
					
$module[] = array( 	'title' => 'Random',
					'desc'  => 'Do you want to show testimonials in random order?',
					'id'    => 't_random',
					'std'   => 'no',
					'opts'	=> array( 'Yes - randomize testimonials' => 'yes', 'No - keep them in order' => 'no' ),
					'type'  => 'select' );					
					
$module[] = array( 	'title' => 'Type',
					'desc'  => 'Choose how you want to show the testimonials.',
					'id'    => 'type',
					'std'   => 'list',
					'opts'	=> array( 'List' => 'list', 'Scroller' => 'scroller' ),
					'type'  => 'select' );
					
$module[] = array( 	'title' => 'Delay<br />(scroller type)',
					'desc'  => 'Enter the amount of miliseconds you want between each slide.',
					'id'    => 't_speed',
					'std'   => '8000',
					'type'  => 'text' );
					
$module[] = array( 	'title' => 'Content After',
					'desc'  => 'Enter some content here that you want to show after the actual output of this module.',
					'id'    => 'content_after',
					'std'   => '',
					'type'  => 'textarea' );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(!is_admin()){
	add_shortcode('testimonials', 'jw_testimonials');
}else{
	add_shortcode('testimonials', 'jw_testimonials_admin');
}

function jw_testimonials($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'type' => 'list',
		'amount' => '4',
		't_item_size' => 'one_third',
		't_cat' => 'all',
		't_speed' => '8000',
		't_random' => 'no',
		'jw_size' => '',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output = '';
	
	$output .= $content_before.'<div class="clear"></div>';
	
	if($t_cat != 'all'){
		$testimonials_categories = get_objects_in_term($t_cat, 'jw_testimonials_categories');
	}else{
		$testimonials_categories = '';
	}
	
	if($t_random == 'yes'){
		$order_by = 'rand';
	}else{
		$order_by = 'date';
	}
	
	$args = array(
		'post_type' 		=> 'jw_testimonials',
		'posts_per_page'	=> $amount,
		'post__in'			=> $testimonials_categories,
		'orderby'			=> $order_by
	);
	$jw_query = new WP_Query($args);
	
	/* Vars */
	$item_size = $t_item_size;
	$container_size = $jw_size;
	
	if($item_size == 'one_half'){
		
		$size_class = 'one-half';
		
	}elseif($item_size == 'one_third'){
	
		$size_class = 'one-third';
	
	}elseif($item_size == 'one_fourth'){
	
		$size_class = 'one-fourth';
	
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
	
	if($type == 'list'){
		
		if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */ $count++; $real_count++;
			
			$last = '';
			$clear = '';
			$separator = '';
			
			if($count == $count_max){ $last = ' last'; $count = 0; }
			if($count == 1){ $clear = ' clear'; }
			
			/* Get the custom fields values (aka post options) */
			$post_options_single = jw_get_post_options(get_the_ID());
			
			$no_margin_from = $jw_query->post_count - $count_max;
			if($real_count > $no_margin_from){ $margin_class = ' no-margin-bottom'; }else{ $margin_class = ''; }
			
			$output .= '<div id="post-'.get_the_ID().'" class="'.$size_class.$last.$clear.$margin_class.'">';
				
				$output .= '<div class="testimonial-entry ">';
				
					$output .= '<div class="testimonial-entry-content">'.$post_options_single['jw_testimonial_content'].'</div>';
			
					if($post_options_single['jw_testimonial_author_name'] != ''){
						if($post_options_single['jw_testimonial_author_url'] != ''){
							$output .= '<span class="testimonial-entry-author">- <a href="'.$post_options_single['jw_testimonial_author_url'].'">'.$post_options_single['jw_testimonial_author_name'].'</a></span>';
						}else{
							$output .= '<span class="testimonial-entry-author">- '.$post_options_single['jw_testimonial_author_name'].'</span>';
						}
					}
					
				$output .= '</div>';
				
			$output .= '</div><!-- .testimonial-entry -->';
			
		endwhile; else:
			
		endif;
		
	}elseif($type == 'scroller'){
		
		$output .= '<div class="testimonials-scroller-container" data-autoplay="'.$t_speed.'">';
		
			$output .= '<div class="testimonials-scroller flexslider">';
			

				$output .= '<ul class="slides">';

					if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */
						
						/* Get the custom fields values (aka post options) */
						$post_options_single = jw_get_post_options(get_the_ID());
						
						$output .= '<li>';
							
							$output .= '<div class="testimonials-scroller-content">'.$post_options_single['jw_testimonial_content'].'</div>';
							
							if($post_options_single['jw_testimonial_author_url'] != ''){
								$output .= '<div class="testimonials-scroller-author"><a href="'.$post_options_single['jw_testimonial_author_url'].'">'.$post_options_single['jw_testimonial_author_name'].'</a></div>';
							}else{
								$output .= '<div class="testimonials-scroller-author">'.$post_options_single['jw_testimonial_author_name'].'</div>';
							}
							
						$output .= '</li><!-- .testimonial-entry -->';
						
					endwhile; else:
						
					endif;

				$output .= '</ul>';
			
			$output .= '</div>';
			
			$output .= '<div class="testimonials-scroller-actions"><a href="#" class="testimonials-scroller-prev"></a><a href="#" class="testimonials-scroller-next"></a></div>';
			
		$output .= '</div>';
		
	}
	
	wp_reset_query();
	
	$output .= '<div class="clear"></div>'.$content_after;
	
	return do_shortcode($output);
	
}

function jw_testimonials_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'amount' => '',
		't_item_size' => 'one_third',
		't_cat' => 'all',
		'type' => '',
		't_speed' => '8000',
		't_random' => 'no',
		'content_before' => '',
		'content_after'	=> ''
	), $atts));
	
	$output = '';
	
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-amount" title="amount" value="'.$amount.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-t_item_size" title="t_item_size" value="'.$t_item_size.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-t_cat" title="t_cat" value="'.$t_cat.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-t_speed" title="t_speed" value="'.$t_speed.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-t_random" title="t_random" value="'.$t_random.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-type" title="type" value="'.$type.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_before" title="content_before" value="'.$content_before.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-content_after" title="content_after" value="'.$content_after.'">';
	
	return $output;
	
}