<?php 

	header("Content-type: text/css");
	define('WP_USE_THEMES', false);
	require('../../../../../wp-load.php');

?>

<?php 

	/* Get theme options */
	$jw_option = jw_get_options();
	
	/* Global shortname variable */
	global $sn;

	function jw_check_font($font){
		
		$font = str_replace('+', ' ', $font);
		
		switch($font){
			
			case 'Arial':
				$font = '"Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif';
				break;
				
			case 'Arial Black':
				$font = '"Arial Black", Gadget, sans-serif';
				break;
				
			case 'Courier New':
				$font = '"Courier New", Courier, monospace';
				break;
				
			case 'Georgia':
				$font = 'Georgia, serif';
				break;
				
			case 'Lucida':
				$font = '"Lucida Sans Unicode", "Lucida Grande", sans-serif';
				break;
				
			case 'Tahoma':
				$font = 'Tahoma, Geneva, sans-serif';
				break;
				
			case 'Times New Roman':
				$font = '"Times New Roman", Times, serif';
				break;
				
			case 'Trebuchet MS':
				$font = '"Trebuchet MS", Helvetica, sans-serif';
				break;
				
			case 'Verdana':
				$font = 'Verdana, Geneva, sans-serif';
				break;
			
			default:
				$font = '"'.$font.'"';
			
		}
		
		return $font;
		
	}
	
?>

<?php
	$import_output = '';
	$css_output = '';
	$used_fonts = array();
?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_content'])){
		$font_opts = $jw_option[$sn.'_typography_content'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_content']);
	}
	
	$element = 'body';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		//$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php
	
	$element = 'a, #pagination li a';
	$color = $jw_option[$sn.'_color_link'];
	$css_output .= $element.' { color:'.$color.'; }';
	
	$element_bg = 'a:hover, .slider .slider-prev:hover, .slider .slider-next:hover, .slider-loader-inner, .carousel .carousel-prev:hover, .carousel .carousel-next:hover, a.blog-post-read-more:hover, .portfolio-post-entry .flex-direction-nav a, .portfolio-post-entry .flex-direction-nav a.flex-prev, #portfolio-filter ul li a.active, #comments .comment-meta .comment-author a:hover, #comments .comment-meta .comment-reply-link:hover, .widget .tagcloud a:hover, html.csstransitions .portfolio-post-entry:hover .portfolio-post-images-overlay, #pagination li a, #content input[type="submit"], #content button, #mobile-navigation li.active > a';
	$element_border = '.testimonial-entry, .staff-post-entry, #mobile-navigation-handle';
	$element_color = '#footer a:hover';
	$color = $jw_option[$sn.'_color_link_hover'];
	$css_output .= $element_bg.' { background-color:'.$color.'; } '.$element_border.' { border-color:'.$color.' } ::-moz-selection { background:'.$color.' } ::selection { background:'.$color.' } '.$element_color.' { color:'.$color.' }';

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_tagline_title'])){
		$font_opts = $jw_option[$sn.'_typography_tagline_title'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_tagline_title']);
	}
	/* Variables */
	$element = '#tagline h1';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		//$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_tagline_description'])){
		$font_opts = $jw_option[$sn.'_typography_tagline_description'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_tagline_description']);
	}
	$element = '.tagline-description';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		//$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_heading_2'])){
		$font_opts = $jw_option[$sn.'_typography_heading_2'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_heading_2']);
	}
	$element = 'h2';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		//$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_heading_3'])){
		$font_opts = $jw_option[$sn.'_typography_heading_3'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_heading_3']);
	}
	$element = 'h3';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		//$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_heading_4'])){
		$font_opts = $jw_option[$sn.'_typography_heading_4'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_heading_4']);
	}
	$element = 'h4';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_heading_5'])){
		$font_opts = $jw_option[$sn.'_typography_heading_5'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_heading_5']);
	}
	$element = 'h5';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_heading_6'])){
		$font_opts = $jw_option[$sn.'_typography_heading_6'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_heading_6']);
	}
	$element = 'h6';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_navigation'])){
		$font_opts = $jw_option[$sn.'_typography_navigation'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_navigation']);
	}
	$element = '#header #nav ul li a';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_navigation_sub'])){
		$font_opts = $jw_option[$sn.'_typography_navigation_sub'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_navigation_sub']);
	}
	$element = '#header #nav ul ul li a';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_widget_title'])){
		$font_opts = $jw_option[$sn.'_typography_widget_title'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_widget_title']);
	}
	$element = '#sidebar h3.widget-title';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_slider_title'])){
		$font_opts = $jw_option[$sn.'_typography_slider_title'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_slider_title']);
	}
	$element = '.slider ul.slides li.slide .slide-title';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_blog_title'])){
		$font_opts = $jw_option[$sn.'_typography_blog_title'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_blog_title']);
	}
	$element = 'h1.blog-post-title';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php 

	/* Variables */
	if(is_array($jw_option[$sn.'_typography_portfolio_title'])){
		$font_opts = $jw_option[$sn.'_typography_portfolio_title'];
	}else{
		$font_opts = unserialize($jw_option[$sn.'_typography_portfolio_title']);
	}
	$element = 'h2.portfolio-post-title';
	
	/* Get the font style, font weight and font family vars */
	$font_style = 'normal'; $font_weight = 'normal'; $font_family = jw_check_font($font_opts['family']);
	if($font_opts['style'] == 'bold+italic'){ $font_weight = 'bold'; $font_style = 'italic'; }elseif($font_opts['style'] == 'italic'){ $font_style = 'italic'; } elseif($font_opts['style'] == 'bold'){ $font_weight = 'bold'; }
	$css_output .= $element.' { color:'.$font_opts['color'].'; font-family:'.$font_family.'; font-size:'.$font_opts['size'].'; font-weight:'.$font_weight.'; font-style:'.$font_style.'; line-height:'.$font_opts['lineheight'].'; }';
	
	/* Import the fonts if it's not already imported and add it to the imported fonts array */
	if(!in_array($font_opts['family'], $used_fonts)){
		$import_output .= '@import url(http://fonts.googleapis.com/css?family='.$font_opts['family'].'&subset=latin,latin-ext);';
		$used_fonts[] = $font_opts['family'];
	}

?>

<?php
	//echo $import_output;
	echo $css_output;
?>
