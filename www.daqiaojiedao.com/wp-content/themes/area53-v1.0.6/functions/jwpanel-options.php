<?php
/* ---------------------------------------------------------------------------------------------------
	
	JWPanel Options
	
--------------------------------------------------------------------------------------------------- */

$themename = 'AREA53';
$shortname = 'area';

$options = array();

/* -----------------------------------------------------------------
	General
----------------------------------------------------------------- */

$options[] = array( 'title' => 'General',
					'type'  => 'open',
					'desc'	=> '');

$options[] = array( 'title' => 'Page Comments',
					'desc'  => 'Do you want to show the comments on pages?',
					'id'    => $shortname.'_page_comments',
					'std'   => 'no',
					'opts'	=> array( 'Yes - Show the comments' => 'yes', 'No - Do not show the comments' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Logo - Upload',
					'desc'  => 'Upload your logo. If not uploaded the default logo will be shown which is located in the images folder of the theme.',
					'id'    => $shortname.'_logo',
					'std'   => '',
					'type'  => 'upload' );
					
$options[] = array( 'title' => 'Logo - Textual',
					'desc'  => 'In case you want to show a textual logo set this option to <strong>yes</strong>. The website title you have set when you installed WordPress will be shown.',
					'id'    => $shortname.'_logo_textual',
					'std'	=> 'no',
					'opts'  => array( 'Yes - show the textual logo' => 'yes', 'No - do not show the textual logo' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Favicon - Upload',
					'desc'  => 'Upload your favicon. If not uploaded the default favicon will be shown which is located in the root folder of the theme',
					'id'    => $shortname.'_favicon',
					'std'   => '',
					'type'  => 'upload' );
					
$options[] = array( 'title' => 'Analytics',
					'desc'  => 'Enter your full analytics code here. It will be added right before the closing body tag.',
					'id'    => $shortname.'_analytics',
					'std'   => '',
					'type'  => 'textarea' );
					
$options[] = array( 'title' => 'Analytics Position',
					'desc'  => 'Where to place the analytics code?',
					'id'    => $shortname.'_analytics_position',
					'std'   => 'body',
					'opts'	=> array( 'Before &lt;/body&gt;' => 'body', 'Before &lt;/head&gt;' => 'head' ),
					'type'  => 'select' );
					
$options[] = array( 'type'  => 'close' );

/* -----------------------------------------------------------------
	Header
----------------------------------------------------------------- */

$options[] = array( 'title' => 'Header',
					'type'  => 'open',
					'desc'	=> '');
					
$options[] = array( 'title' => 'Header Left',
					'desc'  => 'What do you want to show in the left part of the header.',
					'id'    => $shortname.'_header_left',
					'std'	=> 'content',
					'opts'  => array( 'Content - Custom content (from the textarea bellow)' => 'content', 'Social + Search' => 'social_search', 'Disabled' => 'disabled' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Header Left &darr;<br>Custom Content',
					'desc'	=> 'Custom content which will be shown on the left part of the header. <strong>HTML allowed.</strong>',
					'id'    => $shortname.'_header_left_text',
					'std'	=> 'Change this in the <strong>Theme Options</strong> &rarr; <strong>Header</strong> section.',
					'type'  => 'textarea' );
					
$options[] = array( 'title' => 'Header Right',
					'desc'  => 'What do you want to show in the right part of the header.',
					'id'    => $shortname.'_header_right',
					'std'	=> 'social_search',
					'opts'  => array( 'Content - Custom content (from the textarea bellow)' => 'content', 'Social + Search' => 'social_search', 'Disabled' => 'disabled' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Header Right &darr;<br>Custom Content',
					'desc'	=> 'Custom content which will be shown on the right part of the header. <strong>HTML allowed.</strong>',
					'id'    => $shortname.'_header_right_text',
					'std'	=> '',
					'type'  => 'textarea' );
					
$options[] = array( 'title' => 'Header Social &darr;<br>Facebook',
					'desc'	=> 'Enter full url to your profile.',
					'id'    => $shortname.'_header_social_facebook',
					'std'	=> '',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Header Social &darr;<br>Twitter',
					'desc'	=> 'Enter full url to your profile.',
					'id'    => $shortname.'_header_social_twitter',
					'std'	=> '',
					'type'  => 'text' );

$options[] = array( 'title' => 'Header Social &darr;<br>Youtube',
					'desc'	=> 'Enter full url to your profile.',
					'id'    => $shortname.'_header_social_youtube',
					'std'	=> '',
					'type'  => 'text' );

$options[] = array( 'title' => 'Header Social &darr;<br>Vimeo',
					'desc'	=> 'Enter full url to your profile.',
					'id'    => $shortname.'_header_social_vimeo',
					'std'	=> '',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Header Social &darr;<br>Linkedin',
					'desc'	=> 'Enter full url to your profile.',
					'id'    => $shortname.'_header_social_linkedin',
					'std'	=> '',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Header Social &darr;<br>Google+',
					'desc'	=> 'Enter full url to your profile.',
					'id'    => $shortname.'_header_social_googleplus',
					'std'	=> '',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Header Social &darr;<br>Dribbble',
					'desc'	=> 'Enter full url to your profile.',
					'id'    => $shortname.'_header_social_dribbble',
					'std'	=> '',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Header Social &darr;<br>RSS',
					'desc'	=> 'Enter full url to the RSS feed.',
					'id'    => $shortname.'_header_social_rss',
					'std'	=> '',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Breadcrumbs',
					'desc'  => 'Do you want to show the breadcrumbs?.',
					'id'    => $shortname.'_breadcrumbs',
					'std'	=> 'yes',
					'opts'  => array( 'Yes - show the breadcrumbs' => 'yes', 'No - do not show the breadcrumbs' => 'no' ),
					'type'  => 'select' );

$options[] = array( 'type'  => 'close' );

/* -----------------------------------------------------------------
	Footer
----------------------------------------------------------------- */

$options[] = array( 'title' => 'Footer',
					'type'  => 'open',
					'desc'	=> '');

$options[] = array( 'title' => 'Enable/Disable',
					'desc'  => 'Do you want to show the footer?',
					'id'    => $shortname.'_footer',
					'std'	=> 'yes',
					'opts'  => array( 'Yes - show the footer' => 'yes', 'No - do not show the footer' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Footer Type',
					'desc'  => 'What to show in the main area?',
					'id'    => $shortname.'_footer_main',
					'std'	=> 'widgets',
					'opts'  => array( 'Widgets - show the widgets section' => 'widgets', 'Custom HTML - type in the option bellow' => 'custom' ),
					'type'  => 'select' );

$options[] = array( 'title' => 'Footer Content&darr;<br />Custom HTML',
					'desc'  => 'The text that will appear in the main area of the footer. <strong>HTML allowed</strong>. <strong>Important:</strong> Choose "Custom" in the option above.',
					'id'    => $shortname.'_footer_main_text',
					'std'	=> '',
					'type'  => 'textarea' );

$options[] = array( 'type'  => 'close' );

/* -----------------------------------------------------------------
	Blog
----------------------------------------------------------------- */

$options[] = array( 'title' => 'Blog',
					'type'  => 'open',
					'desc'	=> '');
					
$options[] = array( 'title' => 'Listing &darr;<br />Posts per page',
					'desc'  => 'How many posts do you want to show per page on the blog posts listing?',
					'id'    => $shortname.'_blog_listing_per_page',
					'std'   => '8',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Listing &darr;<br />Thumbnails',
					'desc'  => 'Do you want to show thumbnails on the blog posts listing? Also includes search page and archive pages.',
					'id'    => $shortname.'_blog_listing_thumbnails',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show the thumbnails' => 'yes', 'No - Do not show the thumbnails' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Listing &darr;<br />Excerpt or Full',
					'desc'  => 'Do you want to show excerpts on the blog posts listing or do you want to show the full posts?',
					'id'    => $shortname.'_blog_listing_content_type',
					'std'   => 'excerpt',
					'opts'	=> array( 'Excerpt' => 'excerpt', 'Full content' => 'content' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Single &darr;<br />Thumbnail',
					'desc'  => 'Do you want to show the thumbnail?',
					'id'    => $shortname.'_blog_single_thumbnail',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show the thumbnail' => 'yes', 'No - Do not show the thumbnail' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Single &darr;<br />Author Info',
					'desc'  => 'Do you want to show the author info?',
					'id'    => $shortname.'_blog_single_about_author',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show the author info' => 'yes', 'No - Do not show the author info' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Single &darr;<br />Comments',
					'desc'  => 'Do you want to show the comments?',
					'id'    => $shortname.'_blog_single_comments',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show the comments' => 'yes', 'No - Do not show the comments' => 'no' ),
					'type'  => 'select' );

$options[] = array( 'type'  => 'close' );

/* -----------------------------------------------------------------
	Portfolio
----------------------------------------------------------------- */

$options[] = array( 'title' => 'Portfolio',
					'type'  => 'open',
					'desc'	=> '');
					
$options[] = array( 'title' => 'Listing &darr;<br />Posts per page',
					'desc'  => 'How many posts do you want to show per page on the portfolio posts listing?',
					'id'    => $shortname.'_portfolio_listing_per_page',
					'std'   => '8',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Listing &darr;<br />Lightbox',
					'desc'  => 'Do you want to show the media you added for the portoflio post in a lightbox when the visitor clicks the thumbnail?',
					'id'    => $shortname.'_portfolio_listing_lightbox',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show the lightbox' => 'yes', 'No - Do not show the lightbox' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Single &darr;<br />Project Info',
					'desc'  => 'Do you want to show the project info in the sidebar?',
					'id'    => $shortname.'_portfolio_single_info',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show the project info' => 'yes', 'No - Do not show the project info' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Single &darr;<br />Project Info - <strong>Author</strong>',
					'desc'  => 'Do you want to show this in the project info?',
					'id'    => $shortname.'_portfolio_single_info_author',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show author in project info' => 'yes', 'No - Do not show the author in the project info' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Single &darr;<br />Project Info - <strong>Date</strong>',
					'desc'  => 'Do you want to show this in the project info?',
					'id'    => $shortname.'_portfolio_single_info_date',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show date in project info' => 'yes', 'No - Do not show the date in the project info' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Single &darr;<br />Project Info - <strong>Categories</strong>',
					'desc'  => 'Do you want to show this in the project info?',
					'id'    => $shortname.'_portfolio_single_info_categories',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show categories in project info' => 'yes', 'No - Do not show the categories in the project info' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Single &darr;<br />Project Info - <strong>Client</strong>',
					'desc'  => 'Do you want to show this in the project info?',
					'id'    => $shortname.'_portfolio_single_info_client',
					'std'   => 'yes',
					'opts'	=> array( 'Yes - Show client in project info' => 'yes', 'No - Do not show the client in the project info' => 'no' ),
					'type'  => 'select' );

$options[] = array( 'title' => 'Single &darr;<br /> Comments',
					'desc'  => 'Do you want to show the comments on portfolio posts?',
					'id'    => $shortname.'_portfolio_comments',
					'std'   => 'no',
					'opts'	=> array( 'Yes - Show the comments' => 'yes', 'No - Do not show the comments' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'type'  => 'close' );

/* -----------------------------------------------------------------
	Appearance
----------------------------------------------------------------- */

$options[] = array( 'title' => 'Appearance',
					'type'  => 'open' );

$options[] = array( 'title' => 'Menu Colors',
					'desc'  => '...',
					'id'    => $shortname.'_menu_colors',
					'std'	=> '#333C42',
					'type'  => 'menu_colors' );
					
$options[] = array( 'title' => 'Wrapper',
					'desc'  => 'Choose the main style.',
					'id'    => $shortname.'_main_style',
					'std'	=> 'wrapped',
					'opts'  => array( 'Wrapped - the wrapper has border' => 'wrapped', 'Unwrapped - no border on the wrapper' => 'full'  ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'BG Color',
					'desc'  => 'Background color.',
					'id'    => $shortname.'_bg_color_custom',
					'std'	=> 'f6f2f0',
					'type'  => 'colorpicker' );
					
$options[] = array( 'title' => 'BG Image&darr;<br />Predefined',
					'desc'  => 'Choose a background image. There are 2 types: <strong>Transparent</strong> and <strong>Opaque</strong>. <strong>Transparent</strong> is a transparent repeatable pattern graphic which goes over the background color. <strong>Opaque</strong> is an opaque repeatable pattern graphic and the background color has no effect.',
					'id'    => $shortname.'_bg_image',
					'std'	=> 'pattern-line-1-darken',
					'opts'  => array( 	'None' => 'none',
										'Transparent - Line 1' => 'pattern-line-1', 'Transparent - Line 2' => 'pattern-line-2',  'Transparent - Line 3' => 'pattern-line-3', 'Transparent - Line 4' => 'pattern-line-4', 'Transparent - Line 5' => 'pattern-line-5',  'Transparent - Line 6' => 'pattern-line-6',
										'Transparent - Line 1 - Darken' => 'pattern-line-1-darken',  'Transparent - Line 2 - Darken' => 'pattern-line-2-darken', 'Transparent - Line 3 - Darken' => 'pattern-line-3-darken', 'Transparent - Line 4 - Darken' => 'pattern-line-4-darken',  'Transparent - Line 5 - Darken' => 'pattern-line-5-darken', 'Transparent - Line 6 - Darken' => 'pattern-line-6-darken',
										'Transparent - Grid 1' => 'pattern-grid-1', 'Transparent - Grid 2' => 'pattern-grid-2', 'Transparent - Grid 3' => 'pattern-grid-3', 'Transparent - Grid 4' => 'pattern-grid-4', 'Transparent - Grid 5' => 'pattern-grid-5', 'Transparent - Grid 6' => 'pattern-grid-6', 'Transparent - Grid 7' => 'pattern-grid-7', 'Transparent - Grid 8' => 'pattern-grid-8',
										'Transparent - Grid 1 - Darken' => 'pattern-grid-1-darken', 'Transparent - Grid 2 - Darken' => 'pattern-grid-2-darken', 'Transparent - Grid 3 - Darken' => 'pattern-grid-3-darken', 'Transparent - Grid 4 - Darken' => 'pattern-grid-4-darken', 'Transparent - Grid 5 - Darken' => 'pattern-grid-5-darken', 'Transparent - Grid 6 - Darken' => 'pattern-grid-6-darken', 'Transparent - Grid 7 - Darken' => 'pattern-grid-7-darken', 'Transparent - Grid 8 - Darken' => 'pattern-grid-8-darken',
										'Transparent - Dots 1' => 'pattern-dots-1', 'Transparent - Dots 2' => 'pattern-dots-2', 'Transparent - Dots 3' => 'pattern-dots-3', 'Transparent - Dots 4' => 'pattern-dots-4', 'Transparent - Dots 5' => 'pattern-dots-5', 'Transparent - Dots 6' => 'pattern-dots-6', 'Transparent - Dots 7' => 'pattern-dots-7',
										'Transparent - Dots 1 - Darken' => 'pattern-dots-1-darken', 'Transparent - Dots 2 - Darken' => 'pattern-dots-2-darken', 'Transparent - Dots 3 - Darken' => 'pattern-dots-3-darken', 'Transparent - Dots 4 - Darken' => 'pattern-dots-4-darken', 'Transparent - Dots 5 - Darken' => 'pattern-dots-5-darken', 'Transparent - Dots 6 - Darken' => 'pattern-dots-6-darken', 'Transparent - Dots 7 - Darken' => 'pattern-dots-7-darken',
										'Opaque - Wood' => 'graphic-wood', 'Opaque - Dark Wood' => 'graphic-darkwood', 'Opaque - Inflicted' => 'graphic-inflicted', 'Opaque - Squares' => 'graphic-squares', 'Opaque - Circles' => 'graphic-circles', 'Opaque - Criss Cross' => 'graphic-crisscross', 'Opaque - Cubes' => 'graphic-cubes', 'Opaque - Dark Leather' => 'graphic-darkleather', 'Opaque - Mosaic' => 'graphic-mosaic',
										'Custom - choose bellow' => 'custom' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'BG Image&darr;<br />Custom',
					'desc'  => 'Upload an image for the background. You can upload a transparent pattern to mix it with one of the background colors for example, or upload a tiled bg image.<br /><strong>Important:</strong> Choose "Custom" in the option above this one.',
					'id'    => $shortname.'_bg_image_custom',
					'std'   => '',
					'type'  => 'upload' );

$options[] = array( 'title' => 'BG Image&darr;<br />Custom&darr;<br />Repeat',
					'desc'  => 'Choose the repeat type for the custom background image.',
					'id'    => $shortname.'_bg_image_repeat',
					'std'	=> 'repeat',
					'opts'  => array( 'Repeat Full' => 'repeat', 'Repeat X' => 'repeat-x', 'Repeat Y' => 'repeat-y', 'No Repeat' => 'no-repeat' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'BG Image&darr;<br />Custom&darr;<br />Position',
					'desc'  => 'Choose the position for the custom background image.',
					'id'    => $shortname.'_bg_image_position',
					'std'	=> 'top-center',
					'opts'  => array( 'Left Top' => 'left-top', 'Left Center' => 'left-center', 'Left Bottom' => 'left-bottom', 'Right Top' => 'right-top', 'Right Center' => 'right-center', 'Right bottom' => 'right-bottom', 'Center Top' => 'center-top', 'Center Center' => 'center-center', 'Center Bottom' => 'center-bottom' ),
					'type'  => 'select' );
					
$options[] = array( 'type'  => 'close' );


/* -----------------------------------------------------------------
	Typography
----------------------------------------------------------------- */

$options[] = array( 'title' => 'Typography',
					'type'  => 'open' );
					
$options[] = array( 'title' => 'Content',
					'desc'  => '',
					'id'    => $shortname.'_typography_content',
					'std'	=> array('family' => 'Arial', 'size' => '13px', 'lineheight' => '22px', 'style' => 'normal', 'color' => '#494f56'),
					'type'  => 'font' );
					
$options[] = array( 'title' => 'Links',
					'desc'  => '',
					'id'    => $shortname.'_color_link',
					'std'	=> '#4e6984',
					'type'  => 'colorpicker' );
					
$options[] = array( 'title' => 'Links Hover BG',
					'desc'  => 'Also affects other things like the loading bar in the slider, text selection, border on testimonials, border on staff listing...',
					'id'    => $shortname.'_color_link_hover',
					'std'	=> '#FFFFFF',
					'type'  => 'colorpicker' );
					
$options[] = array( 'title' => 'Tagline &darr;<br />Title',
					'desc'  => '',
					'id'    => $shortname.'_typography_tagline_title',
					'std'	=> array('family' => 'Arial', 'size' => '26px', 'lineheight' => '26px', 'style' => 'bold', 'color' => '#494f56'),
					'type'  => 'font',
					'other' => array( 'background' => '#ffffff', 'demo_text' => 'The Tagline Title' ) );
					
$options[] = array( 'title' => 'Tagline &darr;<br />Description',
					'desc'  => '',
					'id'    => $shortname.'_typography_tagline_description',
					'std'	=> array('family' => 'Arial', 'size' => '13px', 'lineheight' => '13px', 'style' => 'bold', 'color' => '#494f56'),
					'type'  => 'font',
					'other' => array( 'background' => '#ffffff', 'demo_text' => '// the tagline description' ) );
					
$options[] = array( 'title' => 'Heading 2',
					'desc'  => '',
					'id'    => $shortname.'_typography_heading_2',
					'std'	=> array('family' => 'Arial', 'size' => '20px', 'lineheight' => '30px', 'style' => 'bold', 'color' => '#2a3036'),
					'type'  => 'font',
					'other' => array( 'demo_text' => 'This Is A Heading. This Is How It Will Look On The Website.' ) );
					
$options[] = array( 'title' => 'Heading 3',
					'desc'  => '',
					'id'    => $shortname.'_typography_heading_3',
					'std'	=> array('family' => 'Arial', 'size' => '18px', 'lineheight' => '28px', 'style' => 'bold', 'color' => '#2a3036'),
					'type'  => 'font',
					'other' => array( 'demo_text' => 'This Is A Heading. This Is How It Will Look On The Website. Lorem ipsum dolor sit amet.' ) );
					
$options[] = array( 'title' => 'Heading 4',
					'desc'  => '',
					'id'    => $shortname.'_typography_heading_4',
					'std'	=> array('family' => 'Arial', 'size' => '16px', 'lineheight' => '26px', 'style' => 'bold', 'color' => '#2a3036'),
					'type'  => 'font',
					'other' => array( 'demo_text' => 'This Is A Heading. This Is How It Will Look On The Website. Lorem ipsum dolor sit amet.' ) );
					
$options[] = array( 'title' => 'Heading 5',
					'desc'  => '',
					'id'    => $shortname.'_typography_heading_5',
					'std'	=> array('family' => 'Arial', 'size' => '14px', 'lineheight' => '24px', 'style' => 'bold', 'color' => '#2a3036'),
					'type'  => 'font',
					'other' => array( 'demo_text' => 'This Is A Heading. This Is How It Will Look On The Website. Lorem ipsum dolor sit amet, consectetur adipisicing elit.' ) );
					
$options[] = array( 'title' => 'Heading 6',
					'desc'  => '',
					'id'    => $shortname.'_typography_heading_6',
					'std'	=> array('family' => 'Arial', 'size' => '13px', 'lineheight' => '22px', 'style' => 'bold', 'color' => '#2a3036'),
					'type'  => 'font',
					'other' => array( 'demo_text' => 'This Is A Heading. This Is How It Will Look On The Website. Lorem ipsum dolor sit amet, consectetur adipisicing elit.' ) );
					
$options[] = array( 'title' => 'Navigation &darr;<br />Top Level',
					'desc'  => '',
					'id'    => $shortname.'_typography_navigation',
					'std'	=> array('family' => 'Arial', 'size' => '13px', 'lineheight' => '13px', 'style' => 'bold', 'color' => '#ffffff'),
					'type'  => 'font',
					'other' => array( 'background' => '#424c58', 'demo_text' => 'Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blog&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Portfolio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;About&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact' ) );
					
$options[] = array( 'title' => 'Navigation &darr;<br />Bottom Level',
					'desc'  => '',
					'id'    => $shortname.'_typography_navigation_sub',
					'std'	=> array('family' => 'Arial', 'size' => '12px', 'lineheight' => '14px', 'style' => 'bold', 'color' => '#ffffff'),
					'type'  => 'font',
					'other' => array( 'background' => '#424c58', 'demo_text' => 'Subnav Item<br /><br />Subnav Item<br /><br />Subnav Item<br /><br />Subnav Item' ) );
					
$options[] = array( 'title' => 'Widget Title',
					'desc'  => '',
					'id'    => $shortname.'_typography_widget_title',
					'std'	=> array('family' => 'Arial', 'size' => '14px', 'lineheight' => '14px', 'style' => 'bold', 'color' => '#2a3036'),
					'type'  => 'font',
					'other' => array( 'demo_text' => 'This Is A Widget Title' ) );
					
$options[] = array( 'title' => 'Slider &darr;<br />Title',
					'desc'  => '',
					'id'    => $shortname.'_typography_slider_title',
					'std'	=> array('family' => 'Arial', 'size' => '12px', 'lineheight' => '12px', 'style' => 'bold', 'color' => '#ffffff'),
					'type'  => 'font',
					'other' => array( 'background' => '#494f56', 'demo_text' => 'This Is A Slide Title' ) );
					
$options[] = array( 'title' => 'Blog &darr;<br />Title',
					'desc'  => '',
					'id'    => $shortname.'_typography_blog_title',
					'std'	=> array('family' => 'Arial', 'size' => '20px', 'lineheight' => '26px', 'style' => 'bold', 'color' => '#31353A'),
					'type'	=> 'font',
					'other' => array( 'demo_text' => 'Blog Post Title In Listing And Single' ) );
					
$options[] = array( 'title' => 'Portfolio &darr;<br />Title',
					'desc'  => '',
					'id'    => $shortname.'_typography_portfolio_title',
					'std'	=> array('family' => 'Arial', 'size' => '13px', 'lineheight' => '16px', 'style' => 'normal', 'color' => '#31353A'),
					'type'	=> 'font',
					'other' => array( 'demo_text' => 'Portfolio Post Title In Listing And Single' ) );
					
$options[] = array( 'type'  => 'close' );

/* -----------------------------------------------------------------
	Appearance
----------------------------------------------------------------- */

$options[] = array( 'title' => 'First Steps',
					'type'  => 'open' );

$options[] = array( 'title' => 'Default Layout',
					'desc'  => 'If you already had posts and pages before you activated this theme please choose the layout they will have. Also the posts and pages you create from now on will have this as the default value.',
					'id'    => $shortname.'jw_layout',
					'std'	=> 'layout_cs',
					'opts'  => array( 'Full Content' => 'layout_c', 'Content + Sidebar' => 'layout_cs', 'Sidebar + Content' => 'layout_sc' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Default Tagline',
					'desc'  => 'If you already had posts and pages before you activated this theme please choose do you want to show the tagline area. Also the posts and pages you create from now on will have this as the default value.',
					'id'    => $shortname.'jw_tagline_show',
					'std'	=> 'yes',
					'opts'  => array( 'Yes - show the tagline area' => 'yes', 'No - do not show the tagline area' => 'no' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Archive Layout',
					'desc'  => 'Choose the layout for the blog archive page.',
					'id'    => $shortname.'_layout_archive',
					'std'   => 'layout_cs',
					'opts'	=> array( 'Full Content' => 'layout_c', 'Content + Sidebar' => 'layout_cs', 'Sidebar + Content' => 'layout_sc' ),
					'type'  => 'select' );
					
$options[] = array( 'title' => 'Search Layout',
					'desc'  => 'Choose the layout for the search page.',
					'id'    => $shortname.'_layout_search',
					'std'   => 'layout_cs',
					'opts'	=> array( 'Full Content' => 'layout_c', 'Content + Sidebar' => 'layout_cs', 'Sidebar + Content' => 'layout_sc' ),
					'type'  => 'select' );

$options[] = array( 'type'  => 'close' );