<?php
/* ---------------------------------------------------------------------------------------------------
	
	JWPanel Options
	
--------------------------------------------------------------------------------------------------- */

$shortname = 'jw';
global $sn;

$default_layout = jw_get_option($sn.$shortname.'_layout');
$default_tagline = jw_get_option($sn.$shortname.'_tagline_show');

$portfolio_categories_array = array();
$portfolio_categories_object = get_terms( 'jw_portfolio_categories', 'orderby=count&hide_empty=0' );

foreach($portfolio_categories_object as $portfolio_category_object){
	$portfolio_category_object_title = $portfolio_category_object->name;
	$portfolio_category_object_value = $portfolio_category_object->term_id;
	$portfolio_categories_array[$portfolio_category_object_title] = $portfolio_category_object_value;
}

$blog_categories_array = array();
$blog_categories_object = get_categories();

foreach($blog_categories_object as $blog_category_object){
	$blog_category_object_title = $blog_category_object->name;
	$blog_category_object_value = $blog_category_object->term_id;
	$blog_categories_array[$blog_category_object_title] = $blog_category_object_value;
}

$options = array();


$options[] = array( 'title' => 'General',
					'type'  => 'open',
					'desc'	=> 'Here you can change the layout of the post/page layout and create a special sidebar (widget area) for this post/page or select one that you already made.');
					
$options[] = array( 'title' => 'Layout',
					'desc'  => 'Choose the layout you want for this post/page. <strong>Notice:</strong> Different page templates (sidebar, under "page attributes") have different options.',
					'id'    => $shortname.'_layout',
					'std'   => $default_layout,
					'type'  => 'select',
					'opts'	=> array( 'Full Content' => 'layout_c', 'Content + Sidebar' => 'layout_cs', 'Sidebar + Content' => 'layout_sc',  ) );

$options[] = array( 'title' => 'Post Style',
					'desc'  => 'Choose the style of the posts.',
					'id'    => $shortname.'_layout_post_style',
					'std'   => 'regular',
					'type'  => 'select',
					'opts'	=> array( 'Regular' => 'regular', 'Fancy' => 'fancy' ) );
					
$options[] = array( 'title' => 'Post Width',
					'desc'  => 'Choose the width of the posts.',
					'id'    => $shortname.'_layout_special_item_size',
					'std'   => 'one_half',
					'type'  => 'select',
					'opts'	=> array( '1/2' => 'one_half', '1/3' => 'one_third', '1/4' => 'one_fourth' ) );
					
$options[] = array( 'title' => 'Custom Sidebar',
					'desc'  => 'If you do NOT want this post/page to use the default sidebar area you can create a new one or choose one you already created for a different post/page.',
					'id'    => $shortname.'_sidebar',
					'std'   => '',
					'type'  => 'sidebar' );
					

$options[] = array( 'type'  => 'close' );

$options[] = array( 'title' => 'Tagline',
					'type'  => 'open',
					'desc'	=> 'Tagline will be shown above the main content area. It is not required.');

$options[] = array( 'title' => 'Enable/Disable',
					'desc'  => 'Do you want to show the tagline area?',
					'id'    => $shortname.'_tagline_show',
					'std'	=> $default_tagline,
					'opts'  => array( 'Enabled - show the tagline area' => 'yes', 'Disabled - do not show the tagline area' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Title',
					'desc'  => 'Enter the tagline title here.',
					'id'    => $shortname.'_tagline_title',
					'std'   => '',
					'type'  => 'text' );

$options[] = array( 'title' => 'Description',
					'desc'  => 'Enter the tagline description here.',
					'id'    => $shortname.'_tagline_description',
					'std'   => '',
					'type'  => 'text' );
					
					
$options[] = array( 'type'  => 'close' );

$options[] = array( 'title' => 'Blog',
					'type'  => 'open',
					'desc'	=> 'These are special options for when you\'re using this page as a blog posts listing.');

$options[] = array( 'title'	=> 'Categories',
					'desc'	=> 'Choose the categories from which you want the blog posts to be fetched. If none selected all blog posts posts will be shown.',
					'id'	=> $shortname.'_blog_categories',
					'std'	=> 'all',
					'type'	=> 'checkbox',
					'opts'	=> $blog_categories_array );
					
$options[] = array( 'type'  => 'close' );

$options[] = array( 'title' => 'Portfolio',
					'type'  => 'open',
					'desc'	=> 'These are special options for when you\'re using this page as a portfolio posts listing.');

$options[] = array( 'title'	=> 'Order',
					'desc'	=> 'Choose the order of the posts.',
					'id'	=> $shortname.'_portfolio_order',
					'std'	=> 'DESC',
					'type'	=> 'select',
					'opts'	=> array( 'Descending - newest to oldest' => 'DESC', 'Ascending - oldest to newest' => 'ASC' ) );
					
$options[] = array( 'title'	=> 'Categories',
					'desc'	=> 'Choose the categories from which you want the portfolio posts to be fetched. If none selected all portfolio posts will be shown.',
					'id'	=> $shortname.'_portfolio_categories',
					'std'	=> 'all',
					'type'	=> 'checkbox',
					'opts'	=> $portfolio_categories_array );
					
$options[] = array( 'title'	=> 'Animated Filters',
					'desc'	=> 'Show animated filters powered by jQuery (JavaScript library).',
					'id'	=> $shortname.'_portfolio_filters',
					'std'	=> 'no',
					'type'	=> 'select',
					'opts'	=> array( 'Enabled - show the animated filters' => 'yes', 'Disabled - do not show the animated filters' => 'no' ) );
					
$options[] = array( 'type'  => 'close' );

$options[] = array( 'title' => 'Portfolio Info',
					'type'  => 'open',
					'desc'	=> 'This is where you fill in information about this portfolio posts.');

$options[] = array( 'title'	=> 'Description',
					'desc'	=> 'Will be shown in the sidebar area.',
					'id'	=> $shortname.'_portfolio_description',
					'std'	=> '',
					'type'	=> 'textarea' );
					
$options[] = array( 'title'	=> 'Client Name',
					'desc'	=> 'Will be shown in the sidebar area.',
					'id'	=> $shortname.'_portfolio_client_name',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'title'	=> 'Client Link',
					'desc'	=> 'Will be shown in the sidebar area.',
					'id'	=> $shortname.'_portfolio_client_link',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'type'  => 'close' );

$options[] = array( 'title' => 'Portfolio Media',
					'type'  => 'open',
					'desc'	=> 'The images and videos you select here will be shown in the slider on top of the portfolio single post page and in the lightbox on portfolio listing and portfolio single post page.' );
					
$options[] = array( 'title'	=> 'Images',
					'desc'	=> '',
					'id'	=> $shortname.'_portfolio_item_images',
					'std'	=> '',
					'type'	=> 'portfolio_item_images',
					'extra'	=> 'portfolio_image' );
					
$options[] = array( 'title'	=> 'Lightbox Video',
					'desc'	=> 'If you want to show a video in the lightbox (on portfolio listing page) instead of the images enter the full video url here.',
					'id'	=> $shortname.'_portfolio_item_video',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'type'  => 'close' );

$options[] = array( 'title' => 'Testimonial Info',
					'type'  => 'open',
					'desc'	=> 'Enter the testimonials information here.' );

$options[] = array( 'title'	=> 'Author Name',
					'desc'	=> '',
					'id'	=> $shortname.'_testimonial_author_name',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'title'	=> 'Author Website',
					'desc'	=> '',
					'id'	=> $shortname.'_testimonial_author_url',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'title'	=> 'Testimonial',
					'desc'	=> '',
					'id'	=> $shortname.'_testimonial_content',
					'std'	=> '',
					'type'	=> 'textarea' );
					
$options[] = array( 'type'  => 'close' );

$options[] = array( 'title' => 'Staff Member',
					'type'  => 'open',
					'desc'	=> 'Enter the staff member information here.' );

$options[] = array( 'title'	=> 'Name',
					'desc'	=> 'Full name of the staff member.',
					'id'	=> $shortname.'_staff_member_name',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'title'	=> 'Position',
					'desc'	=> 'On which position does the staff member work (CEO, Senior Developer...)',
					'id'	=> $shortname.'_staff_member_position',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'title'	=> 'About',
					'desc'	=> 'More info about this staff member.',
					'id'	=> $shortname.'_staff_member_about',
					'std'	=> '',
					'type'	=> 'textarea' );
					
$options[] = array( 'title'	=> 'Social &darr;<br>Twitter',
					'desc'	=> 'Enter full URL to the profile.',
					'id'	=> $shortname.'_staff_member_social_twitter',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'title'	=> 'Social &darr;<br>Facebook',
					'desc'	=> 'Enter full URL to the profile.',
					'id'	=> $shortname.'_staff_member_social_facebook',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'title'	=> 'Social &darr;<br>Linkedin',
					'desc'	=> 'Enter full URL to the profile.',
					'id'	=> $shortname.'_staff_member_social_linkedin',
					'std'	=> '',
					'type'	=> 'text' );
					
$options[] = array( 'type'  => 'close' );

