<?php
/* ---------------------------------------------------------------------------------------------------
	
	Header
	
--------------------------------------------------------------------------------------------------- */
?>

<?php $jw_option = jw_get_options(); /* Get theme options */ ?>

<?php
	/* Get the custom fields values (aka post options) */
	if($post && !is_search() && !is_archive()){
		$post_options = jw_get_post_options($post->ID);
	}
?>

<?php global $sn; ?>

<!doctype html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	
	<meta charset="<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?><meta name="robots" content="noindex, nofollow" /><?php } ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php bloginfo('name'); wp_title(' - '); ?></title>
	
	<?php if(isset($jw_option[$sn.'_favicon'])){ ?>
	
		<link rel="shortcut icon" href="<?php echo $jw_option[$sn.'_favicon']; ?>" type="image/x-icon" />
		
	<?php } ?>

	<!-- Mobile viewport optimized: h5bp.com/viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/framework/_lib/dynamic-css.php'; ?>" type="text/css" />
	
	<!-- Pingback -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php wp_enqueue_script('jquery'); ?>
	
	<?php wp_head(); ?>

	<style>
		
		body { background-color:<?php echo $jw_option[$sn.'_bg_color_custom']; ?>; }
		<?php if($jw_option[$sn.'_bg_image'] == 'custom' && isset($jw_option[$sn.'_bg_image'])){  ?>
			body.custom-bg-image { background-image: url("<?php echo $jw_option[$sn.'_bg_image_custom']; ?>"); }
		<?php } ?>
		
		<?php
			
			if(is_serialized( $jw_option[$sn.'_menu_colors'] )){
				
				$menu_colors = unserialize($jw_option[$sn.'_menu_colors']);
				
				foreach($menu_colors as $menu_color_id=>$menu_color_val){
					
					$menu_color_id = str_replace('cp_', '', $menu_color_id);
					
					echo '#header #nav ul li.menu-item-'.$menu_color_id.' { background-color:'.$menu_color_val.'; }';
						echo '#header #nav ul li.active.menu-item-'.$menu_color_id.' a { border-right:1px solid '.$menu_color_val.'; }';
						echo '#header #nav ul li.menu-item-'.$menu_color_id.' ul { border-bottom-color:'.$menu_color_val.'; }';
						echo '#header #nav ul li.menu-item-'.$menu_color_id.' li.active a { background-color:'.$menu_color_val.'; }';
				
				}
			
			}
		
		?>
				
	</style>
	
	<?php
	
		/* Analytics */
		if(isset($jw_option[$sn.'_analytics']) && $jw_option[$sn.'_analytics_position'] == 'head'){
			echo $jw_option[$sn.'_analytics'];
		}
		
		$body_class = '';
		/* Layout type */
		if($post_options['jw_layout'] == 'layout_c'){ $body_class .= 'sidebar-none '; }
		if($post_options['jw_layout'] == 'layout_sc'){ $body_class .= 'sidebar-pos-left '; }
		
		$body_class .= 'main-style-'.$jw_option[$sn.'_main_style'].' ';
		
		$body_class .= 'style-'.$jw_option[$sn.'_style_color'].' ';
		$body_class .= 'bg-color-'.$jw_option[$sn.'_bg_color'].' ';
		$body_class .= 'bg-'.$jw_option[$sn.'_bg_image'].' ';
		
		if(isset($jw_option[$sn.'_bg_image'])){ $body_class .= 'custom-bg-image '; }
		if(isset($jw_option[$sn.'_bg_image_repeat'])){ $body_class .= 'custom-bg-image-'.$jw_option[$sn.'_bg_image_repeat'].' '; }
		if(isset($jw_option[$sn.'_bg_image_position'])){ $body_class .= 'custom-bg-image-'.$jw_option[$sn.'_bg_image_position'].' '; }
		
		if(!is_home() && !is_front_page() && $jw_option[$sn.'_breadcrumbs'] == 'yes'){ $body_class .= 'has-breadcrumbs '; }
		
	?>
	
</head>

<body <?php body_class($body_class); ?>>
	
	<div id="container">
	
		<div id="wrapper">
		
			<div id="wrapper-inner">
	
				<header id="header">
					
					<div id="header-top" class="clearfix">
						
						<?php if($jw_option[$sn.'_header_left'] == 'content'){ ?>
							<div id="header-column-1" class="one-third clearfix">
								<?php echo $jw_option[$sn.'_header_left_text']; ?>
							</div><!-- #header-column-1 -->
						<?php }elseif($jw_option[$sn.'_header_left'] == 'social_search'){ ?>
							<div id="header-column-1" class="one-third clearfix">
								<ul id="header-social">
									<?php if($jw_option[$sn.'_header_social_facebook'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_facebook']; ?>" id="header-social-facebook"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_twitter'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_twitter']; ?>" id="header-social-twitter"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_youtube'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_youtube']; ?>" id="header-social-youtube"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_vimeo'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_vimeo']; ?>" id="header-social-vimeo"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_linkedin'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_linkedin']; ?>" id="header-social-linkedin"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_googleplus'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_googleplus']; ?>" id="header-social-googleplus"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_dribbble'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_dribbble']; ?>" id="header-social-dribbble"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_rss'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_rss']; ?>" id="header-social-rss"></a></li><?php } ?>
								</ul>								
								<?php get_search_form(); ?>
							</div>
						<?php } ?>
						
						<div id="logo" class="one-third">
							
							<?php if($jw_option[$sn.'_logo_textual'] == 'yes'){ ?>
							
								<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
								
							<?php }else{ ?>
							
								<?php if(isset($jw_option[$sn.'_logo'])){ $logo_img = $jw_option[$sn.'_logo']; }else{ $logo_img = get_template_directory_uri().'/images/logo.png'; } ?> 
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $logo_img; ?>" alt="" /></a>
								
							<?php } ?>
							
						</div><!-- #logo -->
						
						<?php if($jw_option[$sn.'_header_right'] == 'content'){ ?>
							<div id="header-column-2" class="one-third last clearfix">
								<?php echo $jw_option[$sn.'_header_right_text']; ?>
							</div><!-- #header-column-1 -->
						<?php }elseif($jw_option[$sn.'_header_right'] == 'social_search'){ ?>
							<div id="header-column-2" class="one-third last clearfix">
								<ul id="header-social">
									<?php if($jw_option[$sn.'_header_social_facebook'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_facebook']; ?>" id="header-social-facebook"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_twitter'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_twitter']; ?>" id="header-social-twitter"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_youtube'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_youtube']; ?>" id="header-social-youtube"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_vimeo'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_vimeo']; ?>" id="header-social-vimeo"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_linkedin'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_linkedin']; ?>" id="header-social-linkedin"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_googleplus'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_googleplus']; ?>" id="header-social-googleplus"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_dribbble'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_dribbble']; ?>" id="header-social-dribbble"></a></li><?php } ?>
									<?php if($jw_option[$sn.'_header_social_rss'] != ''){ ?><li><a href="<?php echo $jw_option[$sn.'_header_social_rss']; ?>" id="header-social-rss"></a></li><?php } ?>
								</ul>						
								<?php get_search_form(); ?>
							</div>
							
						<?php } ?>
						
					</div><!-- #header-top -->
					
					<div id="mobile-navigation-container">
						
						<div id="mobile-navigation-handle"><?php _e('Navigate to', 'jwlocalize'); ?></div>
						
						<div id="mobile-navigation">
						
							<?php
								if(has_nav_menu('main_navigation')){
									wp_nav_menu(array('container_class' => '', 'menu_class' => 'col-clear', 'theme_location' => 'main_navigation', 'link_before' => '', 'link_after' => '' ));
								}
							?>
						
						</div>
							
					</div><!-- #mobile-navigation-container -->
					
					<nav id="nav">
						
						<?php
							if (has_nav_menu('main_navigation')){
								wp_nav_menu(array('container_class' => '', 'menu_class' => 'clearfix sf-menu', 'theme_location' => 'main_navigation', 'link_before' => '', 'link_after' => '' ));
							}else{
								wp_page_menu();
								?><div class="clear"></div><?php
							}
						?>
						
					</nav>
					
				</header>

				<div role="main" class="clearfix">
					
					<?php if($post_options['jw_tagline_show'] == 'yes' || ((is_archive() || is_search() || is_404()) && $jw_option[$sn.'jw_tagline_show'] == 'yes')){ ?>
					
						<?php 
							$tagline_title = get_the_title();
							if(isset($post_options['jw_tagline_title']) && $post_options['jw_tagline_title'] != ''){ $tagline_title = $post_options['jw_tagline_title']; }
						?>
						
						<div id="tagline" class="clearfix">
							
							<?php if(is_front_page() && !is_page()){ ?>
								
								<h1>Welcome to AREA53</h1>
								
							<?php }elseif(is_archive()){ ?>
								
								<h1><?php wp_title(''); ?></h1>
								
							<?php }elseif(is_search()){ ?>
							
								<h1><?php _e('Search', 'jwlocalize'); ?></h1>
								
								<div class="tagline-description"><?php _e('Showing results for the search term', 'jwlocalize'); ?> &quot;<?php echo esc_html($s); ?>&quot;</div>
								
							<?php }elseif(is_404()){ ?>
								
								<h1><?php _e('404 - Not Found', 'jwlocalize'); ?></h1>
								
							<?php }else{ ?>
								
								<h1><?php echo $tagline_title; ?></h1>
								
								<?php if(isset($post_options['jw_tagline_description'])){ ?>
								
									<div class="tagline-description"><?php echo $post_options['jw_tagline_description']; ?></div>
									
								<?php } ?>
								
							<?php } ?>
							
							<?php
							/* ---------------------------------------------------------------------------------------------------
								Filters
							--------------------------------------------------------------------------------------------------- */
							?>
							
							<?php if($post_options['jw_portfolio_filters'] == 'yes'){ ?>
							
								<?php
									if($post_options['jw_layout'] == 'layout_sc' || $post_options['jw_layout'] == 'layout_cs'){ $last_num = 2; }else{ $last_num = 3; }
									$item_size = $post_options['jw_layout_special_item_size'];
								?>
								
								<div id="portfolio-filter" class="clearfix">
									
									<span id="portfolio-filter-info"><?php _e('filter by', 'jwlocalize'); ?></span>
									
									<ul class="clearfix">
									
										<li><a class="active" href="#" data-filter-cat="all"><?php _e('All', 'jwlocalize'); ?></a></li><?php
										
										if($post_options['jw_portfolio_categories'] != 'all'){
										
											$portfolio_categories = unserialize($post_options['jw_portfolio_categories']);
											foreach($portfolio_categories as $p_cat){
												
												$p_cat_details = get_term_by('id', $p_cat, 'jw_portfolio_categories');
												?><li>/<a href="#" data-filter-cat="<?php echo $p_cat_details->name; ?>"><?php echo $p_cat_details->name; ?></a></li><?php
											
											}
											
										}else{
										
											$portfolio_categories_array = array();
											$portfolio_categories_object = get_terms( 'jw_portfolio_categories', 'orderby=count&hide_empty=0' );
											foreach($portfolio_categories_object as $portfolio_category_object){
												?><li>/<a href="#" data-filter-cat="<?php echo $portfolio_category_object->name; ?>"><?php echo $portfolio_category_object->name; ?></a></li><?php
												
											}
											
										}
										?>
										
									</ul>
									
								</div><!-- #portfolio-filter -->
								
							<?php } ?>
							
						</div><!-- end #tagline -->
					
					<?php } ?>
					
					<?php
						
						/* Breadcrumbs */
						
						if(!is_home() && !is_front_page() && $jw_option[$sn.'_breadcrumbs'] == 'yes'){
							jw_breadcrumbs(); 
						}
					
					?>