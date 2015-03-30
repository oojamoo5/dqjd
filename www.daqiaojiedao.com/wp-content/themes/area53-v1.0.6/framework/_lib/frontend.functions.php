<?php
/* ---------------------------------------------------------------------------------------------------
	
	Functions
	
--------------------------------------------------------------------------------------------------- */


/* ---------------------------------------------------------------------------------------------------
	
	Name: jw_get_options
	
	Gets the values of options from the JWPANEL options
	
--------------------------------------------------------------------------------------------------- */
function jw_get_options(){
		
	include get_template_directory().'/functions/jwpanel-options.php';
	
	$jw_options = array();
	
	foreach ($options as $option) {
		if($option['type'] != 'open' && $option['type'] != 'close'){
			if (get_option($option['id']) === FALSE) { 
				if($option['std'] != ''){
					$jw_options[$option['id']] = $option['std']; 
				}
			}else{
				$option_value = get_option($option['id']);
				if($option_value != ''){
					$jw_options[$option['id']] = $option_value; 
				}
			}
		}
	}
	
	return $jw_options;
	
}/* jw_get_options() END */

/* ---------------------------------------------------------------------------------------------------
	
	Name: jw_get_option
	
	Gets the value of a specific option from the JWPANEL options
	
--------------------------------------------------------------------------------------------------- */
function jw_get_option($option_id){
		
	$jw_option = '';
		
	include get_template_directory().'/functions/jwpanel-options.php';
	
	/* If option not set */
	if (get_option($option_id) === FALSE) { 
		
		/* Loop all to find the option we need */
		foreach ($options as $option) {
		
			/* If the option is an option (not open or close) */
			if(isset($option['id'])){
				
				/* If the option was found */
				if($option['id'] == $option_id){
					
					/* If the default value is set */
					if($option['std'] != ''){
						
						/* Assign the value */
						$jw_option = $option['std'];
						
					}
					
				}
			
			}
		
		}
	
	/* If option is set */
	}else{
		
		/* Assign the value */
		$jw_option = get_option($option_id);
		
	}
	
	/* Return the value */
	return $jw_option;
	
}/* jw_get_option() END */

/* -----------------------------------------------------------------
	
	Name: jw_pagination

	Numbered pagination originally made by Kriesi.
	http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin

----------------------------------------------------------------- */
function jw_pagination($pages = '', $range = 2){  
	
	$showitems = ($range * 2)+1;  

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages){
			$pages = 1;
		}
	}   

	if(1 != $pages){
		echo '
		<div id="pagination">
			<ul class="col-clear">';
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' class='button'>&laquo;</a></li>";
			if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' class='button'>&lsaquo;</a></li>";

			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)){
				echo ($paged == $i)? "<li class='current'><a href='".get_pagenum_link($i)."' class='inactive button'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive button' >".$i."</a></li>";
				}
			}

			if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' class='button'>&rsaquo;</a></li>";  
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."' class='button'>&raquo;</a></li>";
		echo '
			</ul>
		</div><!-- #pagination -->';
	}

} /* jw_pagination() END */

/* ---------------------------------------------------------------------------------------------------
	
	Name: jw_get_post_options
	
	Gets the values of special (page/post/portfolio) options
	
--------------------------------------------------------------------------------------------------- */
function jw_get_post_options($post_id){
	
	include get_template_directory().'/functions/metabox-options.php';
	
	global $sn;
	
	/* Get the options set by the user */
	$specified_values = get_post_custom($post_id);
	
	/* Apply the default value to the options without values */
	foreach($options as $option){
		
		/* If not open or close */
		if($option['type'] != 'open' && $option['type'] != 'close'){
		
			/* If a values is set */
			if(isset($specified_values[$option['id']])){
				
				$specified_values[$option['id']] = $specified_values[$option['id']][0];
				
			}else{
				
				/* Use the default value for this option */
				$specified_values[$option['id']] = $option['std'];
				
			}
		}
		
	}
	
	/* Pass it on */
	return $specified_values;
	
}/* jw_get_post_options() END */


function jw_comment_layout($comment, $args, $depth) {
		
	global $domain; /* The unique string used for translation */
	
	$GLOBALS['comment'] = $comment;

	?>
	<li <?php comment_class('commentWrap'); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-author-avatar"><?php echo get_avatar($comment, $size = '75'); ?></div>
		<div class="comment-main">
			<div class="comment-meta">
				<span class="comment-author"><?php comment_author_link(); ?></span>
				<span class="comment-date"><?php _e('on', 'jwlocalize'); ?> <?php comment_date(); ?></span>
			</div><!-- .comment-meta -->
			<div class="comment-content">
				<?php if ($comment->comment_approved == '0'){ /* If comment is awaing moderation */ ?>
					<p><em><?php _e('Your comment is awaiting moderation', 'jwlocalize'); ?></em></p>
				<?php } ?>
				<?php comment_text(); ?>
				<?php comment_reply_link(array_merge(array('reply_text' => __('Reply', 'jwlocalize')), array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div><!-- .comment-content -->
		</div><!-- .comment-main -->
		
		<!-- comment layout ends here -->
	
<?php 
} /* jw_comment_layout() END */


/* ------------------------------------------------------------------
	
	Name: jw_resize

	Resizing images. Return array (url, width and height).
	Original code by Victor Teixeira.

------------------------------------------------------------------ */
function jw_resize($attach_id = null, $img_url = null, $width, $height, $crop = false) {

	// this is an attachment, so we have the ID
	if($attach_id) {
	
		$image_src = wp_get_attachment_image_src($attach_id, 'full');
		$file_path = get_attached_file($attach_id);
	
	// this is not an attachment, let's use the image url
	}else if($img_url){
		
		/* START get the image info */
		
		$file_path_orig = parse_url( $img_url );
		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path_orig['path'];
		$file_path_alt = ltrim( $file_path_orig['path'], '/' );
		$orig_size = @getimagesize($file_path);
		if(!$orig_size){
			$file_path = $file_path_alt;
			$orig_size = @getimagesize($file_path);
		}
		
		/* END get the image info */
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	}
	
	$file_info = pathinfo($file_path);
	$extension = '.'. $file_info['extension'];

	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ($image_src[1] > $width || $image_src[2] > $height) {

		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if (file_exists($cropped_img_path)) {

			$cropped_img_url = str_replace(basename($image_src[0]), basename($cropped_img_path), $image_src[0]);
			
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}

		// $crop = false
		if ($crop == false) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if (file_exists($resized_img_path)) {
			
				$resized_img_url = str_replace(basename($image_src[0]), basename($resized_img_path), $image_src[0]);

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				
				return $vt_image;
			}
		}

		// no cache files - let's finally resize it
		$new_img_path = image_resize($file_path, $width, $height, $crop);
		$new_img_size = getimagesize($new_img_path);
		$new_img = str_replace(basename($image_src[0]), basename($new_img_path), $image_src[0]);

		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);
		
		return $vt_image;
	}

	// default output - without resizing
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	
	return $vt_image;
	
} /* jw_resize() */


/* ------------------------------------------------------------------
	
	Name: jw_get_post_id

	Get post id

------------------------------------------------------------------ */
function jw_get_post_id($by, $needle){
		
		global $wpdb;
		
		if($by == 'name'){ return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$needle."'"); }
		
		if($by == 'title'){ return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$needle."'"); }
		
		if($by == 'template'){ $pages = $wpdb->get_row("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_page_template' AND meta_value='".$needle."'", ARRAY_A); return $pages['post_id']; }
		
	} /* jw_get_post_id() END */


/* ------------------------------------------------------------------
	
	Name: jw_breadcrumbs

	Breadcrumbs...

------------------------------------------------------------------ */
function jw_breadcrumbs(){
		
		wp_reset_query();
		
		global $post;
		
		global $domain;
		
		$delimiter = '&rarr;';
		
		?>
		
			<div id="breadcrumbs">
				<ul class="clearfix">
					<li><span class="breadcrumbs-info"><?php _e('您的位置&rarr;', 'jwlocalize'); ?></span></li>
					<li><a href="<?php echo home_url(); ?>"><?php _e('首页', 'jwlocalize'); ?></a></li>
				
		<?php

			if (is_category() || is_single() || is_author()) {
				
				if(get_post_type() == 'post'){
				
					$blog_page_id = jw_get_post_id('template', 'template-blog.php');
					$blog_link = get_permalink($blog_page_id);
					$blog_title = get_the_title($blog_page_id);
					echo '<li class="sep">'.$delimiter.'</li><li><a href="'.$blog_link.'">'.$blog_title.'</a></li>';
					
				}
				
				if(is_category()){
					if(get_post_type() == 'post'){
						$ID = get_query_var('cat');
						echo '<li class="sep">'.$delimiter.'</li><li>'.get_category_parents($ID, TRUE, '</li><li class="sep">'.$delimiter.'</li><li>').'</li>';
					}
				}else if(is_author()){
					echo '<li class="sep">'.$delimiter.'</li><li>'.get_the_author().'</li>';
				}
				
			}
			
			if(is_page() && $post->post_parent){ 
				$anc = get_post_ancestors( $post->ID );
				$anc = array_reverse($anc);
				foreach ( $anc as $ancestor ) {
						echo '<li class="sep">'.$delimiter.'</li><li><a href="'.get_permalink($ancestor).'"><span>'.get_the_title($ancestor).'</span></a></li>'; 
				}
			}
			
			if(is_single()){
				$ID = get_query_var('cat');
				echo '<li class="sep">'.$delimiter.'</li>';
				//echo '<li class="sep">'.$delimiter.'</li><li>'.get_category_parents($ID, TRUE, '</li><li class="sep">'.$delimiter.'</li><li>').'</li>';
				echo '<li><span>'.get_the_title().'</span></li>';
			}
			
			if((is_page()) && (!is_front_page() && !is_home())) { echo '<li class="sep">'.$delimiter.'</li><li><span>'.get_the_title().'</span></li>'; }
			if(is_tag()){ echo '<li class="sep">'.$delimiter.'</li><li><span>Tag: '.single_tag_title('',FALSE).'</span></li>'; }
			if(is_404()){ echo '<li class="sep">'.$delimiter.'</li><li><span>404 - Page not Found</span></li>'; }
			if(is_search()){ echo '<li class="sep">'.$delimiter.'</li><li><span>Search</span></li>'; }
			if(is_year()){ echo '<li class="sep">'.$delimiter.'</li><li><span>'.get_the_time('Y').'</span></li>'; }
			if(is_tax('jw_portfolio_categories')){
				$portfolio_id = jw_get_post_id('template', 'template-portfolio.php');
				$portfolio_link = get_permalink($portfolio_id);
				$portfolio_title = get_the_title($portfolio_id);
				$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				echo '<li class="sep">'.$delimiter.'</li><li><a href="'.$portfolio_link.'">'.$portfolio_title.'</a></li><li class="sep">'.$delimiter.'</li><li><span>'.$term->name.'</span></li>'; 
			}
			
		?>
			
			</ul>
		</div><!-- end #breadcrumb -->
		
		<?php
		
	}/* jw_breadcrumbs() END */
	
/*
Plugin Name: the_excerpt Reloaded
Plugin URI: http://guff.szub.net/the-excerpt-reloaded/
Description: This mod of WordPress' template function the_excerpt() knows there is no spoon.
Version: R1
Author: Kaf Oseo
Author URI: http://szub.net

    Copyright (c) 2004, 2005 Kaf Oseo (http://szub.net)
    the_excerpt Reloaded is released under the GNU General Public
    License: http://www.gnu.org/licenses/gpl.txt

    This is a WordPress plugin (http://wordpress.org). WordPress is
    free software; you can redistribute it and/or modify it under the
    terms of the GNU General Public License as published by the Free
    Software Foundation; either version 2 of the License, or (at your
    option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
    General Public License for more details.

    For a copy of the GNU General Public License, write to:

    Free Software Foundation, Inc.
    59 Temple Place, Suite 330
    Boston, MA  02111-1307
    USA

    You can also view a copy of the HTML version of the GNU General
    Public License at http://www.gnu.org/copyleft/gpl.html

~Changelog:
R1  (21-Aug-2005)
Lots of changes and additions. Now a full-blown Release version...

0.3 (20-Apr-2005)
Fixed '...' so it appears when expected; added 'all' argument to
allowedtags parameter (allows all HTML tags); altered filter_type
so if 'content' is the argument, WordPress text formatting occurs
(HTML paragraphs, 'fancy' punctuation, etc).

0.2 (16-Dec-2004)
Plugin now attempts to correct *broken* HTML tags (those allowed
through 'allowedtags') by using WP's balanceTags function.  This
is controlled through the 'fix_tags' parameter.

*/

function wp_the_excerpt_reloaded($args='') {
    parse_str($args);
    if(!isset($excerpt_length)) $excerpt_length = 120; // length of excerpt in words. -1 to display all excerpt/content
    if(!isset($allowedtags)) $allowedtags = '<a>'; // HTML tags allowed in excerpt, 'all' to allow all tags.
    if(!isset($filter_type)) $filter_type = 'none'; // format filter used => 'content', 'excerpt', 'content_rss', 'excerpt_rss', 'none'
    if(!isset($use_more_link)) $use_more_link = 1; // display
    if(!isset($more_link_text)) $more_link_text = "(more...)";
    if(!isset($force_more)) $force_more = 1;
    if(!isset($fakeit)) $fakeit = 1;
    if(!isset($fix_tags)) $fix_tags = 1;
    if(!isset($no_more)) $no_more = 0;
    if(!isset($more_tag)) $more_tag = 'div';
    if(!isset($more_link_title)) $more_link_title = 'Continue reading this entry';
    if(!isset($showdots)) $showdots = 1;

    return the_excerpt_reloaded($excerpt_length, $allowedtags, $filter_type, $use_more_link, $more_link_text, $force_more, $fakeit, $fix_tags, $no_more, $more_tag, $more_link_title, $showdots);
}

function the_excerpt_reloaded($excerpt_length=120, $allowedtags='<a>', $filter_type='none', $use_more_link=true, $more_link_text="(more...)", $force_more=true, $fakeit=1, $fix_tags=true, $no_more=false, $more_tag='div', $more_link_title='Continue reading this entry', $showdots=true) {
    if(preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {
        $filter_type = 'the_' . $filter_type;
    }
    echo get_the_excerpt_reloaded($excerpt_length, $allowedtags, $filter_type, $use_more_link, $more_link_text, $force_more, $fakeit, $no_more, $more_tag, $more_link_title, $showdots);
}

function get_the_excerpt_reloaded($excerpt_length=120, $allowedtags='<a>', $filter_type='none', $use_more_link=true, $more_link_text="(more...)", $force_more=true, $fakeit=1, $no_more=false, $more_tag='div', $more_link_title='Continue reading this entry', $showdots=true) {
    global $post;

    if (!empty($post->post_password)) { // if there's a password
        if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) { // and it doesn't match cookie
            if(is_feed()) { // if this runs in a feed
                $output = __('There is no excerpt because this is a protected post.', 'jwlocalize');
            } else {
                $output = get_the_password_form();
            }
        }
        return $output;
    }

    if($fakeit == 2) { // force content as excerpt
        $text = $post->post_content;
    } elseif($fakeit == 1) { // content as excerpt, if no excerpt
        $text = (empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
    } else { // excerpt no matter what
        $text = $post->post_excerpt;
    }

    if($excerpt_length < 0) {
        $output = $text;
    } else {
        if(!$no_more && strpos($text, '<!--more-->')) {
            $text = explode('<!--more-->', $text, 2);
            $l = count($text[0]);
            $more_link = 1;
        } else {
            $text = explode(' ', $text);
            if(count($text) > $excerpt_length) {
                $l = $excerpt_length;
                $ellipsis = 1;
            } else {
                $l = count($text);
                $more_link_text = '';
                $ellipsis = 0;
            }
        }
        for ($i=0; $i<$l; $i++)
                $output .= $text[$i] . ' ';
    }

    if('all' != $allowed_tags) {
        $output = strip_tags($output, $allowedtags);
    }

//    $output = str_replace(array("\r\n", "\r", "\n", "  "), " ", $output);

    $output = rtrim($output, "\s\n\t\r\0\x0B");
    $output = ($fix_tags) ? $output : balanceTags($output);
    $output .= ($showdots && $ellipsis) ? '...' : '';

    switch($more_tag) {
        case('div') :
            $tag = 'div';
        break;
        case('span') :
            $tag = 'span';
        break;
        case('p') :
            $tag = 'p';
        break;
        default :
            $tag = 'span';
    }

    if ($use_more_link && $more_link_text) {
        if($force_more) {
            $output .= ' <' . $tag . ' class="more-link"><a href="'. get_permalink($post->ID) . '#more-' . $post->ID .'" title="' . $more_link_title . '">' . $more_link_text . '</a></' . $tag . '>' . "\n";
        } else {
            $output .= ' <' . $tag . ' class="more-link"><a href="'. get_permalink($post->ID) . '" title="' . $more_link_title . '">' . $more_link_text . '</a></' . $tag . '>' . "\n";
        }
    }

    $output = apply_filters($filter_type, $output);

    return $output;
}
?>