<?php
/* ---------------------------------------------------------------------------------------------------
	
	Main functions file. Loads everything required.
	
--------------------------------------------------------------------------------------------------- */

if ( ! isset( $content_width ) ) $content_width = 920;

add_theme_support('post-thumbnails');
add_theme_support( 'automatic-feed-links' );
add_filter('widget_text', 'do_shortcode');

/* Localization */
load_theme_textdomain('jwlocalize', get_template_directory() . '/lang');

$sn = 'area';

$jw_composer_modules_support = array('blank', 'separator', 'portfolio_posts', 'blog_posts','page_posts', 'contact_form', 'service', 'testimonials', 'slider', 'staff_posts' );

/* JWPanel */
include get_template_directory().'/framework/jwpanel-framework/jwpanel-framework.php';

/* Content Composer */
include get_template_directory().'/framework/composer-framework/composer-framework.php';

/* Page options */
include get_template_directory().'/framework/metaboxes-framework/jw-metaboxes-framework.php';

/* Frontend functions */
include get_template_directory().'/framework/_lib/frontend.functions.php';

include get_template_directory().'/framework/_lib/menus.php';

/* Sidebars */
include get_template_directory().'/framework/sidebars.php';

/* Shortcodes */
include get_template_directory().'/framework/shortcodes.php';

/* Post Types */
include get_template_directory().'/framework/post-types.php';

/* Thumbnail sizes */
include get_template_directory().'/functions/thumbnail-sizes.php';

/* Widgets */
include get_template_directory().'/framework/widgets/widget.twitter.php';
include get_template_directory().'/framework/widgets/widget.flickr.php';
include get_template_directory().'/framework/widgets/widget.rpc.php';
include get_template_directory().'/framework/widgets/widget.slider-posts.php';

include get_template_directory().'/functions/functions.php';

//add_filter( 'posts_request', 'jw_search_hack' );
function jw_search_hack( $input ) {
	
	if(is_search()){
		
		$searchterm = stripslashes($_GET['s']);		
		$input = str_replace('OR (wp_posts.post_content LIKE', "OR (wp_postmeta.meta_value LIKE '%$searchterm%') OR (wp_posts.post_content LIKE", $input);
		$input = str_replace('WHERE 1=1', "INNER JOIN wp_postmeta ON (wp_posts.ID = wp_postmeta.post_id) WHERE 1=1", $input);
		$input = str_replace('ORDER BY', "GROUP BY wp_posts.ID ORDER BY", $input);
	
	}
	
	return $input;
}

add_action('wp_print_scripts', 'jw_include_js'); /* Include JavaScript files */
function jw_include_js(){
	
	if (!is_admin()) {
		
		// Register scripts
		wp_register_script('modernizr', get_template_directory_uri().'/js/libs/modernizr-2.5.3.min.js', false);
		wp_register_script('jquery_ui', get_template_directory_uri().'/js/jquery-ui.custom.min.js', false);
		wp_register_script('js_combined', get_template_directory_uri().'/js/plugins.combined.js', false);
		wp_register_script('js_custom', get_template_directory_uri().'/js/custom.js', false);
	
		// Enqueue scripts
		wp_enqueue_script('modernizr');
		wp_enqueue_script('jquery_ui');
		wp_enqueue_script('js_combined');
		wp_enqueue_script('js_custom');
		
		
	}

} /* jw_include_js() END */

add_filter('get_the_excerpt', 'jw_excerpt_more');
function jw_excerpt_more($text) {
	return str_replace('[...]', '...', $text);
}

/* Include Modules */
if(!is_admin() && !isset($_GET['module'])){ 
	foreach($jw_composer_modules_support as $jw_composer_module){
		$just_shortcodes = true;
		include get_template_directory().'/framework/composer-framework/modules/'.$jw_composer_module.'/'.$jw_composer_module.'.php';
	}
}

add_action( 'init', 'jw_add_excerpts_to_pages' );
function jw_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

function coolwp_remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );
