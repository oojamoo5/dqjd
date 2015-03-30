<?php
/* ---------------------------------------------------------------------------------------------------
	
	Blank Module
	
--------------------------------------------------------------------------------------------------- */

$portfolio_categories_array = array();
$portfolio_categories_object = get_terms( 'jw_portfolio_categories', 'orderby=count&hide_empty=0' );

$portfolio_categories_array['All'] = 'all';

foreach($portfolio_categories_object as $portfolio_category_object){
	$portfolio_category_object_title = $portfolio_category_object->name;
	$portfolio_category_object_value = $portfolio_category_object->term_id;
	$portfolio_categories_array[$portfolio_category_object_title] = $portfolio_category_object_value;
}

$blog_categories_array = array();
$blog_categories_object = get_categories();

$blog_categories_array['All'] = 'all';

foreach($blog_categories_object as $blog_category_object){
	$blog_category_object_title = $blog_category_object->name;
	$blog_category_object_value = $blog_category_object->term_id;
	$blog_categories_array[$blog_category_object_title] = $blog_category_object_value;
}

/* Create module */
$module[] = array( 	'title' => 'Slider',
					'type'  => 'module_start',
					'sc'	=> 'slider'
					);

$module[] = array( 	'title' => 'Type',
					'desc'  => 'Choose what kind of "slider" do you want.',
					'id'    => 'slider_type',
					'std'   => 'slider',
					'type'  => 'select',
					'opts'	=> array( 'Regular' => 'slider', 'Carousel' => 'carousel' ) );
					
$module[] = array( 	'title' => 'Slides Type',
					'desc'  => 'Do you want to use blog or portfolio posts as slides or want to create custom ones?',
					'id'    => 'slider_slides_type',
					'std'   => 'custom',
					'type'  => 'select',
					'opts'	=> array( 'Custom - Make your own slides' => 'custom', 'Posts - Use posts as slides' => 'posts' ) );
					
$module[] = array( 	'title' => 'Slides',
					'desc'  => '',
					'id'    => 'slider_slides',
					'std'   => '',
					'type'  => 'composer_slider',
					'extra'	=> array( 'shortcode' => 'slider_slide', 'min_width' => 1 ) );
					
/* posts type options start */

$module[] = array( 	'title' => 'Post Type(posts)',
					'desc'  => 'Do you want to shop blog posts or portfolio posts?',
					'id'    => 'slider_post_type',
					'std'   => 'blog',
					'type'  => 'select',
					'opts'	=> array( 'Blog' => 'post', 'Portfolio' => 'jw_portfolio' ) );

$module[] = array(	'title'	=> 'Category',
					'desc'  => 'The category of the posts to be fetched.',
					'id'	=> 'slider_post_portfolio_cats',
					'std'	=> 'all',
					'type'	=> 'select',
					'opts'	=> $portfolio_categories_array );
					
$module[] = array(	'title'	=> 'Category',
					'desc'  => 'The category of the posts to be fetched.',
					'id'	=> 'slider_post_blog_cats',
					'std'	=> 'all',
					'type'	=> 'select',
					'opts'	=> $blog_categories_array );
					
$module[] = array( 	'title' => 'Order by',
					'desc'  => 'By what do you want the posts to be ordered.',
					'id'    => 'slider_post_order_by',
					'std'   => 'date', /* date, ID, author, title, modified, parent, rand, comment_count */
					'type'  => 'select',
					'opts'	=> array( 'date' => 'date', 'ID' => 'ID', 'author' => 'author', 'title' => 'title', 'modified' => 'modified', 'parent' => 'parent', 'rand' => 'rand', 'comment_count' => 'comment_count' ) );
	
$module[] = array( 	'title' => 'Order',
					'desc'  => 'By which order do you want it to be, ascending or descending?',
					'id'    => 'slider_post_order',
					'std'   => 'DESC',
					'type'  => 'select',
					'opts'	=> array( 'Descending' => 'DESC', 'Ascending' => 'ASC' ) );
	
$module[] = array( 	'title' => 'Amount',
					'desc'  => 'How many posts do you want to show?',
					'id'    => 'slider_post_amount',
					'std'   => '10',
					'type'  => 'text' );
					
/* posts type options end */

$module[] = array( 	'title' => 'No. of Columns',
					'desc'  => 'How many columns do you want to show?',
					'id'    => 'slider_carousel_amount',
					'std'   => '4',
					'type'  => 'text' );

$module[] = array( 	'title' => 'Autoplay',
					'desc'  => 'The amount of miliseconds between slides. If you do not want autoplay enter <strong>0</strong>',
					'id'    => 'slider_autoplay',
					'std'   => '0',
					'type'  => 'text' );
					
$module[] = array( 	'title' => 'Loading Bar',
					'desc'  => 'Do you want to show a loading bar for the autoplay.',
					'id'    => 'slider_autoplay_bar',
					'std'   => 'true',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the loading bar' => 'true', 'No - Do not show the loading bar' => 'false' ) );

$module[] = array( 	'title' => 'Arrows',
					'desc'  => 'Do you want to show the previous and next arrows?',
					'id'    => 'slider_arrows',
					'std'   => 'true',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Show the arrows' => 'true', 'No - Do not show the arrows' => 'false' ) );
					
$module[] = array( 	'title' => 'Animation',
					'desc'  => 'What kind of animation do you want?',
					'id'    => 'slider_animation',
					'std'   => 'yes',
					'type'  => 'select',
					'opts'	=> array( 'Slide' => 'slide', 'Fade' => 'fade' ) );

$module[] = array( 	'title' => 'Loop',
					'desc'  => 'Do you want it to start from begging after the last one?',
					'id'    => 'slider_loop',
					'std'   => 'true',
					'type'  => 'select',
					'opts'	=> array( 'Yes - Loop the slides' => 'true', 'No - do not loop the slides' => 'false' ) );
					
$module[] = array( 	'type'  => 'module_end' );
					

										 

/* Module shortcode */
if(!is_admin()){
	add_shortcode('slider', 'jw_slider');
}else{
	add_shortcode('slider', 'jw_slider_admin');
}

function jw_slider($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'container_size' => '',
		'slider_type' => 'slider',
		'slider_slides' => '',
		'slider_slides_type' => 'custom',
		'slider_post_type' => 'blog',
		'slider_post_amount' => '10',
		'slider_post_order' => 'DESC',
		'slider_post_order_by' => 'date',
		'slider_post_portfolio_cats' => 'all',
		'slider_post_blog_cats' => 'all',
		'slider_autoplay' => '0',
		'slider_autoplay_bar' => 'yes',
		'slider_arrows' => 'yes',
		'slider_animation' => 'yes',
		'slider_loop' => 'yes',
		'slider_carousel_amount' => 4,
	), $atts));
	
	$output = '';
	
	/* ---------------------------------------------------------------------------------------------------
		Sizes
	--------------------------------------------------------------------------------------------------- */
	switch ($container_size) {
		case 'one_one':
			$resize_width = 920;
			$resize_width_id = 'jw_full';
			break;
		case 'one_half':
			$resize_width = 445;
			$resize_width_id = 'jw_one_half';
			break;
		case 'one_third':
			$resize_width = 286;
			$resize_width_id = 'jw_one_third';
			break;
		case 'two_third':
			$resize_width = 604;
			$resize_width_id = 'jw_two_third';
			break;
		case 'one_fourth':
			$resize_width = 207;
			$resize_width_id = 'jw_one_fourth';
			break;
		case 'three_fourth':
			$resize_width = 683;
			$resize_width_id = 'jw_three_fourth';
			break;
	}
	
	if($slider_type == 'carousel'){
		
		$resize_width = round((920 - 20 * $slider_carousel_amount) / $slider_carousel_amount);
		
	}
		
	/* ---------------------------------------------------------------------------------------------------
		Output
	--------------------------------------------------------------------------------------------------- */
	if($slider_slides_type == 'custom'){
		
		if($slider_type == 'slider'){
			
			/* ---------------------------------------------------------------------------------------------------
				Slider - CUSTOM TYPE
			--------------------------------------------------------------------------------------------------- */
			
			$slider_slides = str_replace('&#91;', '[', $slider_slides);
			$slider_slides = str_replace('&#93;', ']', $slider_slides);
			$slider_slides = str_replace('[slider_slide', '[slider_slide resize_width="'.$resize_width.'"', $slider_slides);
			
			$output .= '<div class="slider-container" data-autoplay="'.$slider_autoplay.'" data-autoplaybar="'.$slider_autoplay_bar.'" data-loop="'.$slider_loop.'" data-animation="'.$slider_animation.'" data-arrows="'.$slider_arrows.'">';
				
				$output .= '<div class="slider-loader"><div class="slider-loader-inner"></div></div>';
				
				$output .= '<div class="slider flexslider">';
					
					$output .= '<ul class="slides">';
						
						$output .= do_shortcode($slider_slides);
						
					$output .= '</ul><!-- .slides -->';
					
					$output .= '<a href="#" class="slider-prev"></a>';
					$output .= '<a href="#" class="slider-next"></a>';
					
				$output .= '</div><!-- .slider -->';
				
			$output .= '</div><!-- .slider-container -->';
			
		}elseif($slider_type == 'carousel'){
			
			/* ---------------------------------------------------------------------------------------------------
				Carousel - CUSTOM TYPE
			--------------------------------------------------------------------------------------------------- */
			
			$output .= '<div class="carousel-container" data-autoplay="'.$slider_autoplay.'" data-loop="'.$slider_loop.'" data-animation="slide" data-arrows="'.$slider_arrows.'" data-items="'.$slider_carousel_amount.'">';
				
				$output .= '<div class="carousel flexslider">';
					
					$output .= '<ul class="slides">';
						
						$slider_slides = str_replace('&#91;', '[', $slider_slides);
						$slider_slides = str_replace('&#93;', ']', $slider_slides);
						$slider_slides = str_replace('[slider_slide', '[slider_slide type="carousel"', $slider_slides);
						$slider_slides = str_replace('[slider_slide', '[slider_slide resize_width="'.$resize_width.'"', $slider_slides);
						
						$output .= do_shortcode($slider_slides);
						
					$output .= '</ul><!-- .slides -->';
					
					$output .= '<div class="carousel-actions">';
						$output .= '<a href="#" class="carousel-prev"></a>';
						$output .= '<a href="#" class="carousel-next"></a>';
					$output .= '</div>';
					
				$output .= '</div><!-- .carousel -->';
				
			$output .= '</div><!-- .carousel-container -->';
			
		}
		
		
	}elseif($slider_slides_type == 'posts'){
		
		/* ---------------------------------------------------------------------------------------------------
			Posts Type
		--------------------------------------------------------------------------------------------------- */
		
		if($post_type == 'jw_portfolio'){
		
			if($slider_post_portfolio_cats != 'all'){
				$slider_post_cats = get_objects_in_term($slider_post_portfolio_cats, 'jw_portfolio_categories');
			}else{
				$slider_post_cats = '';
			}
		
			$args = array(
				'post_type' 		=> $slider_post_type,
				'posts_per_page'	=> $slider_post_amount,
				'order'				=> $slider_post_order,
				'orderby'			=> $slider_post_order_by,
				'post__in'			=> $slider_post_cats
			);
			
		}else{
			
			if($slider_post_blog_cats != 'all'){
				$slider_post_cats = $slider_post_blog_cats;
			}else{
				$slider_post_cats = '';
			}
			
			$args = array(
				'post_type' 		=> $slider_post_type,
				'posts_per_page'	=> $slider_post_amount,
				'order'				=> $slider_post_order,
				'orderby'			=> $slider_post_order_by,
				'category__in'		=> $slider_post_cats
			);
			
		}
		
		$jw_query = new WP_Query($args);
		
		if($slider_type == 'slider'){
			
			/* ---------------------------------------------------------------------------------------------------
				Slider - POSTS TYPE
			--------------------------------------------------------------------------------------------------- */
			
			$output .= '<div class="slider-container" data-autoplay="'.$slider_autoplay.'" data-autoplaybar="'.$slider_autoplay_bar.'" data-loop="'.$slider_loop.'" data-animation="'.$slider_animation.'" data-arrows="'.$slider_arrows.'">';
				
				$output .= '<div class="slider flexslider">';
					
					$output .= '<ul class="slides">';
						
						if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */
						
							$output .= '<li class="slide">';
								$output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), $resize_width_id).'</a>';
								$output .= '<div class="slide-title">';
									$output .= get_the_title();
								$output .= '</div>';
							$output .= '</li><!-- .slide -->';
						
						endwhile; endif;
						
					$output .= '</ul><!-- .slides -->';
					
					$output .= '<a href="#" class="slider-prev"></a>';
					$output .= '<a href="#" class="slider-next"></a>';
					
				$output .= '</div><!-- .slider -->';
				
			$output .= '</div><!-- .slider-container -->';
			
		}elseif($slider_type == 'carousel'){
			
			/* ---------------------------------------------------------------------------------------------------
				Carousel - POSTS TYPE
			--------------------------------------------------------------------------------------------------- */
			
			$output .= '<div class="carousel-container" data-autoplay="'.$slider_autoplay.'" data-loop="'.$slider_loop.'" data-animation="slide" data-arrows="'.$slider_arrows.'" data-items="'.$slider_carousel_amount.'">';
				
				$output .= '<div class="carousel flexslider">';
					
					$output .= '<ul class="slides">';
						
						if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */
							
							$image_id = get_post_thumbnail_id(get_the_ID());  
							$image_url = wp_get_attachment_image_src($image_id, 'jw_full');  
							$image_src = $image_url[0];

							$resized_image = jw_resize( '', $image_src, $resize_width, 9999, false );
							
							$output .= '<li class="slide">';
								$output .= '<a href="'.get_permalink().'"><img src="'.$resized_image['url'].'"></a>';
								$output .= '<div class="slide-info">';
									$output .= '<h3 class="slide-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
									$output .= '<div class="slide-description">'.get_the_excerpt().'</div>';
								$output .= '</div>';
							$output .= '</li><!-- .slide -->';
						
						endwhile; endif;
						
					$output .= '</ul><!-- .slides -->';
					
					$output .= '<div class="carousel-actions">';
						$output .= '<a href="#" class="carousel-prev"></a>';
						$output .= '<a href="#" class="carousel-next"></a>';
					$output .= '</div>';
					
				$output .= '</div><!-- .carousel -->';
				
			$output .= '</div><!-- .carousel-container -->';
			
		}elseif($slider_type == 'accordion'){
			
			/* ---------------------------------------------------------------------------------------------------
				Accordion - POSTS TYPE
			--------------------------------------------------------------------------------------------------- */
			
		}
	
	}
	
	return do_shortcode($output);
	
}

function jw_slider_admin($atts, $inside=null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'slider_type' => 'slider',
		'slider_slides' => '',
		'slider_slides_type' => 'custom',
		'slider_post_type' => 'blog',
		'slider_post_amount' => '10',
		'slider_post_order' => 'DESC',
		'slider_post_order_by' => 'date',
		'slider_post_portfolio_cats' => 'all',
		'slider_post_blog_cats' => 'all',
		'slider_autoplay' => '0',
		'slider_autoplay_bar' => 'yes',
		'slider_arrows' => 'yes',
		'slider_animation' => 'yes',
		'slider_loop' => 'yes',
		'slider_carousel_amount' => 4,
	), $atts));
	
	$output  = '<input type="hidden" class="jw-module-info-att jw-module-info-slider_type" title="slider_type" value="'.$slider_type.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_slides" title="slider_slides" value="'.$slider_slides.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_slides_type" title="slider_slides_type" value="'.$slider_slides_type.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_post_type" title="slider_post_type" value="'.$slider_post_type.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_post_amount" title="slider_post_amount" value="'.$slider_post_amount.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_post_order" title="slider_post_order" value="'.$slider_post_order.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_post_order_by" title="slider_post_order_by" value="'.$slider_post_order_by.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_post_portfolio_cats" title="slider_post_portfolio_cats" value="'.$slider_post_portfolio_cats.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_post_blog_cats" title="slider_post_blog_cats" value="'.$slider_post_blog_cats.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_autoplay" title="slider_autoplay" value="'.$slider_autoplay.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_autoplay_bar" title="slider_autoplay_bar" value="'.$slider_autoplay_bar.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_arrows" title="slider_arrows" value="'.$slider_arrows.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_animation" title="slider_animation" value="'.$slider_animation.'">';
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_loop" title="slider_loop" value="'.$slider_loop.'">';
	
	$output  .= '<input type="hidden" class="jw-module-info-att jw-module-info-slider_carousel_amount" title="slider_carousel_amount" value="'.$slider_carousel_amount.'">';
	
	return $output;
	
}