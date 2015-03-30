<?php
/* ---------------------------------------------------------------------------------------------------

	Shortcodes

--------------------------------------------------------------------------------------------------- */

function jw_html_check($content){

	$content = str_replace('&#34;', '"', $content);
	
	return $content;

}

/* -----------------------------------------------------------------
	
	Columns shortcodes
	
----------------------------------------------------------------- */

if(!is_admin()){

	add_shortcode('one_one', 'jw_one_one');
	add_shortcode('one_one_last', 'jw_one_one');
	add_shortcode('one_fourth', 'jw_one_fourth');
	add_shortcode('one_fourth_last', 'jw_one_fourth_last');
	add_shortcode('three_fourth', 'jw_three_fourth');
	add_shortcode('three_fourth_last', 'jw_three_fourth_last');
	add_shortcode('one_third', 'jw_one_third');
	add_shortcode('one_third_last', 'jw_one_third_last');
	add_shortcode('two_third', 'jw_two_third');
	add_shortcode('two_third_last', 'jw_two_third_last');
	add_shortcode('one_half', 'jw_one_half');
	add_shortcode('one_half_last', 'jw_one_half_last');
	
	add_shortcode('portfolio_image', 'jw_portfolio_image');
	add_shortcode('slider_slide', 'jw_slider_slide');

}else{

	add_shortcode('one_one', 'jw_one_one_admin');
	add_shortcode('one_one_last', 'jw_one_one_admin');
	add_shortcode('one_fourth', 'jw_one_fourth_admin');
	add_shortcode('one_fourth_last', 'jw_one_fourth_last_admin');
	add_shortcode('three_fourth', 'jw_three_fourth_admin');
	add_shortcode('three_fourth_last', 'jw_three_fourth_last_admin');
	add_shortcode('one_third', 'jw_one_third_admin');
	add_shortcode('one_third_last', 'jw_one_third_last_admin');
	add_shortcode('two_third', 'jw_two_third_admin');
	add_shortcode('two_third_last', 'jw_two_third_last_admin');
	add_shortcode('one_half', 'jw_one_half_admin');
	add_shortcode('one_half_last', 'jw_one_half_last_admin');
	
	add_shortcode('portfolio_image', 'jw_portfolio_image_admin');
	add_shortcode('slider_slide', 'jw_slider_slide_admin');

}

/* -----------------------------------------------------------------
	Columns shortcodes - FRONTEND
----------------------------------------------------------------- */

function jw_one_one($atts, $content = null) {
	
	$output = '<div class="one-one">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="one_one"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_one_fourth($atts, $content = null) {
	
	$output = '<div class="one-fourth">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="one_fourth"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_one_fourth_last($atts, $content = null) {
	
	$output = '<div class="one-fourth last">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="one_fourth"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_three_fourth($atts, $content = null) {
	
	$output = '<div class="three-fourth">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="three_fourth"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_three_fourth_last($atts, $content = null) {
	
	$output = '<div class="three-fourth last">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="three_fourth"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_one_third($atts, $content = null) {
	
	$output = '<div class="one-third">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="one_third"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_one_third_last($atts, $content = null) {
	
	$output = '<div class="one-third last">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="one_third"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_two_third($atts, $content = null) {
	
	$output = '<div class="two-third">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="two_third"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_two_third_last($atts, $content = null) {
	
	$output = '<div class="two-third last">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="two_third"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_one_half($atts, $content = null) {
	
	$output = '<div class="one-half">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="one_half"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

function jw_one_half_last($atts, $content = null) {
	
	$output = '<div class="one-half last">' . $content . '</div>';
	
	$output = str_replace('[slider', '[slider container_size="one_half"', $output);
	
	return do_shortcode(jw_html_check($output));
	
}

/* -----------------------------------------------------------------
	Columns shortcodes - BACKEND
----------------------------------------------------------------- */

function jw_one_one_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-one-one';
	$module_size_value = 'one_one';
	$module_size = '1/1';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							<a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_one_fourth_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-one-fourth';
	$module_size_value = 'one_fourth';
	$module_size = '1/4';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_one_fourth_last_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-one-fourth last';
	$module_size_value = 'one_fourth';
	$module_size = '1/4';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_three_fourth_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-three-fourth';
	$module_size_value = 'three_fourth';
	$module_size = '3/4';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_three_fourth_last_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-three-fourth last';
	$module_size_value = 'three_fourth';
	$module_size = '3/4';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_one_third_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-one-third';
	$module_size_value = 'one_third';
	$module_size = '1/3';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_one_third_last_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-one-third last';
	$module_size_value = 'one_third';
	$module_size = '1/3';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_two_third_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-two-third';
	$module_size_value = 'two_third';
	$module_size = '2/3';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_two_third_last_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-two-third last';
	$module_size_value = 'two_third';
	$module_size = '2/3';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_one_half_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-one-half';
	$module_size_value = 'one_half';
	$module_size = '1/2';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
						
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}

function jw_one_half_last_admin($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'shortcode' => '',
		'title' => 'undefined'
	), $atts));
	
	$module_class = 'jw-one-half last';
	$module_size_value = 'one_half';
	$module_size = '1/2';
	$module_title = $title;
	$module_shortcode = $shortcode;
	
	$output = 	'<li class="'.$module_class.' jw-module">
					<div class="jw-composer-inner">
						<div class="jw-composer-inner-module">
							<a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">'.$module_size.'</span>
							<a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title" contenteditable="true">'.$module_title.'</span>
							<a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a>
						</div>
						<div class="jw-composer-inner-confirm-remove">
							Are you sure? <a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a>
						</div>
					</div>
					<div class="jw-module-info">
						<input type="hidden" class="jw-module-info-title" value="'.$module_title.'">
						<input type="hidden" class="jw-module-info-size" value="'.$module_size_value.'">
						<input type="hidden" class="jw-module-info-shortcode" value="'.$module_shortcode.'">';
	
						$output .= $content;
	
	$output.=		'</div>
				</li>';
	
	return do_shortcode($output);
	
}


/* -----------------------------------------------------------------
	
	Twitter shortcodes (Twitter widget)
	
----------------------------------------------------------------- */

add_shortcode('recent_tweets', 'jw_recent_tweets');

function jw_recent_tweets($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'profile' => 'wpscientist',
		'amount' => '5',
		'type' => 'list'
	), $atts));
	
	$output = '<div class="recent-tweets"><input type="hidden" class="twitter-profile" value="'.$profile.'" /><input type="hidden" class="twitter-amount" value="'.$amount.'" /></div>';
	
	return do_shortcode($output);
	
}

/* -----------------------------------------------------------------
	
	Flickr shortcodes (Flickr widget)
	
----------------------------------------------------------------- */

add_shortcode('flickr_stream', 'jw_flickr_stream');

function jw_flickr_stream($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'profile' => 'wpscientist',
		'amount' => '5',
		'type' => 'list'
	), $atts));
	
	$output = '<ul class="flickr-stream"><input type="hidden" class="flickr-profile" value="'.$profile.'" /><input type="hidden" class="flickr-amount" value="'.$amount.'" /></ul>';
	
	return do_shortcode($output);
	
}

/* -----------------------------------------------------------------
	
	RPC shortcodes (Recent, Popular & Comments widget)
	
----------------------------------------------------------------- */

add_shortcode('rpc', 'jw_rpc');

function jw_rpc($atts, $content = null) {
	
	/* The attributes */
	extract(shortcode_atts(array(
		'amount' => '5',
	), $atts));

	$recent_posts_output = '';
	$popular_posts_output = '';
	$recent_comments_output = '';
	
	/* Get recent posts */
	$q_args=array(
	   'post_type' => 'post',
	   'showposts' => $amount,
	);
	$recent_posts_query = new WP_query();
	$recent_posts_query->query($q_args);
	
	if ($recent_posts_query->have_posts()) : while ($recent_posts_query->have_posts()) : $recent_posts_query->the_post();

		$recent_posts_output .= '
		<li class="col-clear">
			<a href="'.get_permalink().'">
				<span class="posts-listing-thumb">'.get_the_post_thumbnail(get_the_ID(), 'jw_tiny', array( 'class' => 'wrapped' )).'</span>
				<div>
					'.get_the_title().'
					<small class="block">'.get_the_time('F j, Y').'</small>
				</div>
			</a>
		</li>';

	endwhile; endif;
	wp_reset_query();
	
	/* Get popular posts */
	$q_args=array(
	   'post_type' => 'post',
	   'showposts' => $amount,
	   'orderby' => 'comment_count',
	);
	$popular_posts_query = new WP_query();
	$popular_posts_query->query($q_args);
	
	if ($popular_posts_query->have_posts()) : while ($popular_posts_query->have_posts()) : $popular_posts_query->the_post();

		$popular_posts_output .= '
		<li class="col-clear">
			<a href="'.get_permalink().'">
				<span class="posts-listing-thumb">'.get_the_post_thumbnail(get_the_ID(), 'jw_tiny', array( 'class' => 'wrapped' )).'</span>
				<div>
					'.get_the_title().'
					<small class="block">'.get_the_time('F j, Y').'</small>
				</div>
			</a>
		</li>';

	endwhile; endif;
	wp_reset_query();
	
	/* Get comments */
	$q_args = array(
		'number' => $amount,
		'status' => 'approve',
		'type' => 'comment',
	);
	$comments = get_comments($q_args);
	foreach($comments as $comment) :
	
		$recent_comments_output .= '
		<li class="col-clear">
			<a href="'.get_permalink($comment->comment_post_ID ).'">
				<span class="posts-listing-thumb">'.get_avatar( $comment, 35 ).'</span>
				<div>
					'.$comment->comment_author.'
					<small class="block">'.substr($comment->comment_content, 0, 80).'...'.'</small>
				</div>
			</a>
		</li>';
	
	endforeach;

	$output = '
		<div class="tabs-container tabs-style-classic">
			<div class="tabs-nav">
				<ul class="col-clear">
					<li><a href="#">'.__('Recent', 'jwlocalize').'</a></li>
					<li><a href="#">'.__('Popular', 'jwlocalize').'</a></li>
					<li><a href="#">'.__('Comments', 'jwlocalize').'</a></li>
				</ul>
			</div><!-- .tabs-nav -->
			<div class="tabs-content">
				
				<div class="tab-content">
					<ul>
						'.$recent_posts_output.'
					</ul>
				</div>
				
				<div class="tab-content">
					<ul>
						'.$popular_posts_output.'
					</ul>
				</div>
				
				<div class="tab-content">
					<ul>
						'.$recent_comments_output.'
					</ul>
				</div>
				
			</div><!-- .tabs-contents -->
		</div><!-- .tabs-container -->';
	
	return do_shortcode($output);
	
}


/* ----------------------------------------------------------------
	
	Tabs Shortcodes
	
----------------------------------------------------------------- */

add_shortcode('tabs', 'jw_tabs');
add_shortcode('tab', 'jw_tab');

function jw_tabs($atts, $content = null) {

	/* The attributes */
	extract(shortcode_atts(array(
		'nav_position' => 'top', /* top, bottom */
		'style' => 'classic', /* classic, modern */
		'color'		=> '',
		'title_1'	=> '',
		'title_2'	=> '',
		'title_3'	=> '',
		'title_4'	=> '',
		'title_5'	=> '',
		'title_6'	=> '',
		'title_7' 	=> '',
		'title_8' 	=> '',
		'title_9' 	=> '',
		'title_10' 	=> '',
		'title_11' 	=> '',
		'title_12' 	=> '',
		'title_13' 	=> '',
		'title_14' 	=> '',
		'title_15' 	=> '',
	), $atts));
	
	$tabs_nav = '';	
	
	for ($i = 1; $i <= 15; $i++) {
		
		$titlevar = 'title_'.$i;
		
		if(!empty($$titlevar)){
			
			if($style == 'classic'){
				$tabs_nav .= '<li><a href="#">'.$$titlevar.'</a></li>';
			}else if($style == 'modern'){
				$tabs_nav .= '<li><a href="#" class="button">'.$$titlevar.'</a></li>';
			}
			
		}
		
	}
	
	
	$tabs_content = '<div class="tabs-content">'.do_shortcode($content).'</div>';
	$tabs_nav = '<div class="tabs-nav '.$color.'"><ul class="col-clear">'.$tabs_nav.'</ul></div>';
	
	if($nav_position == 'top'){ $tabs_html = $tabs_nav.$tabs_content; }else{ $tabs_html = $tabs_content.$tabs_nav; }
	
	$output = '
		<div class="tabs-container tabs-nav-position-'.$nav_position.' tabs-style-'.$style.'">
			'.$tabs_html.'
		</div><!-- .tabs-container -->';
	
	return do_shortcode($output);
	
}

function jw_tab($atts, $content = null) {

	$output = '
		<div class="tab-content">
			'.$content.'
		</div>';
	
	return do_shortcode($output);
	
}


/* ----------------------------------------------------------------
	
	Notification
	
----------------------------------------------------------------- */

add_shortcode('notification', 'jw_notification');

function jw_notification($atts, $content = null) {

	/* The attributes */
	extract(shortcode_atts(array(
		'type' => 'information' /* information, warning, success, error */
	), $atts));
	
	$output = '<div class="notification '.$type.'">'.$content.'</div>';
	
	return do_shortcode($output);
	
}


/* ----------------------------------------------------------------
	
	Buttons
	
----------------------------------------------------------------- */

add_shortcode('button', 'jw_button');

function jw_button($atts, $content = null) {

	/* The attributes */
	extract(shortcode_atts(array(
		'color' => '', /* yellow, orange, green, blue, purple, red, grey, brown, lightblue */
		'link' => '#',
		'target' => '_self'
	), $atts));
	
	$output = '<a href="'.$link.'" class="button '.$color.'" target="'.$target.'">'.$content.'</a>';
	
	return do_shortcode($output);
	
}

/* ----------------------------------------------------------------
	
	Buttons
	
----------------------------------------------------------------- */

add_shortcode('section_heading', 'jw_section_heading');

function jw_section_heading($atts, $content = null) {
	
	$output = '<h2 class="section-heading"><span>'.$content.'</span></h2>';
	
	return do_shortcode($output);
	
}

/* ----------------------------------------------------------------
	
	Content Boxes
	
----------------------------------------------------------------- */

add_shortcode('content_box', 'jw_content_box');

function jw_content_box($atts, $content = null) {

	/* The attributes */
	extract(shortcode_atts(array(
		'color' => 'yellow', /* yellow, orange, green, blue, purple, red, grey, brown, lightblue */
		'title' => 'Untitled',
		'toggle' => 'on', /* on, off */
		'toggle_status' => 'closed' /* open, closed */
	), $atts));
	
	$toggle_html = '';
	
	if($toggle_status == 'closed'){
		$toggle_class = 'content-box-toggle-state-closed';
	}
	
	if($toggle != 'off'){
		$toggle_html = '<span class="content-box-toggle"></span>';
	}
	
	$output = '
		<div class="content-box '.$toggle_class.' '.$color.'">
			<div class="content-box-title">'.$title.$toggle_html.'</div>
			<div class="content-box-content">'.$content.'</div>
		</div>';
	
	return do_shortcode($output);
	
}

/* ----------------------------------------------------------------
	
	Accordion
	
----------------------------------------------------------------- */

add_shortcode('accordion', 'jw_accordion');

function jw_accordion($atts, $content = null) {

	/* The attributes */
	extract(shortcode_atts(array(
		
	), $atts));
	
	$output = '
		<div class="accordion">
			'.$content.'
		</div>';
	
	return do_shortcode($output);
	
}

/* -----------------------------------------------------------------
	Portfolio Image - BACKEND
----------------------------------------------------------------- */
function jw_portfolio_image_admin($atts, $content = null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'thumb_src' => '',
		'image_src' => ''
	), $atts));
	
	$output = '';
	
	$output .= '<li>
					<img src="'.$thumb_src.'" alt="'.$image_src.'" width=75 />
					<span class="jw-field-pii-action-container">
						<a href="#" class="jw-field-pii-action-edit"></a>
						<a href="#" class="jw-field-pii-action-remove"></a>
					</span>
				</li>';
				
	return $output;
	
}

/* -----------------------------------------------------------------
	Portfolio Image - FRONTEND
----------------------------------------------------------------- */
function jw_portfolio_image($atts, $content = null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'thumb_src' => '',
		'image_src' => '',
		'size'		=> '',
		'first'		=> 'no'
	), $atts));
	
	global $main_id;
	$pretty_id = get_the_ID();
	
	$post_size = get_post_meta($main_id, 'jw_layout_special_item_size', true);
	$page_layout = get_post_meta($main_id, 'jw_layout', true);
	
	$crop = true;
	
	if($main_id != $pretty_id){
	
		if($page_layout == 'layout_cs' || $page_layout == 'layout_sc'){
		
			$resize_width = 445;
			$resize_height = 445;
		
		}else{
		
			if($post_size == 'one_fourth'){
				$resize_width = 445;
				$resize_height = 445;
			}elseif($post_size == 'one_third'){
				$resize_width = 445;
				$resize_height = 445;
			}elseif($post_size == 'one_half'){
				$resize_width = 445;
				$resize_height = 445;
			}
			
		}
		
	}else{
		
		if($page_layout == 'layout_cs' || $page_layout == 'layout_sc'){
		
			$resize_width = 604;
			$resize_height = 604;
			
		}else{
		
			$resize_width = 920;
			$resize_height = 920;
			
		}
		
	}
	
	/* If it's from the posts slider */
	if((!isset($resize_width) || !isset($resize_height)) || $size != ''){
		
		if($size == 'one_fourth'){
			$resize_width = 445;
			$resize_height = 445;
		}elseif($size == 'one_third'){
			$resize_width = 445;
			$resize_height = 445;
		}elseif($size == 'one_half'){
			$resize_width = 445;
			$resize_height = 445;
		}
		
	}
	
	if($first == 'no'){ $display_class = 'display-none'; }else{ $display_class = ''; }
	
	$path_to_real = $image_src;
	
	$path_to_thumb = jw_resize( '', $image_src, $resize_width, $resize_height, $crop );
	
	$output = '<li><a href="'.$path_to_real.'" rel="prettyPhoto['.$pretty_id.']"><img src="'.$path_to_thumb['url'].'" /></a></li>';
	
	return $output;
	
}

/* -----------------------------------------------------------------
	Slider Slide - BACKEND
----------------------------------------------------------------- */
function jw_slider_slide_admin($atts, $content = null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'type'	=> 'image',
		'video_url' => '',
		'text'	=> '',
		'thumb_src' => '',
		'image_src' => '',
		'slide_title'		=> '',
		'slide_description' => '',
		'slide_content'	=> '',
		'slide_content_image' => '',
		'slide_link'		=> '',
		'slide_link_text'	=> 'READ MORE'
	), $atts));
	
	$output = '';
	
	if($image_src != ''){
	
		$output .= '<li>
					<img src="'.$thumb_src.'" alt="'.$image_src.'" width=75 />
					<input type="hidden" class="jw-field-slider-slide-description" value="'.$slide_description.'">
					<input type="hidden" class="jw-field-slider-slide-title" value="'.$slide_title.'">
					<input type="hidden" class="jw-field-slider-slide-link" value="'.$slide_link.'">
					<input type="hidden" class="jw-field-slider-slide-link-text" value="'.$slide_link_text.'">
					<span class="jw-field-slider-action-container">
						<a href="#" class="jw-field-slider-action-edit"></a>
						<a href="#" class="jw-field-slider-action-remove"></a>
					</span>
				</li>';
	
	}elseif($slide_content != ''){
		
		$output .= '<li class="jw-field-slider-content-slide">
					<input type="hidden" class="jw-field-slider-slide-content" value="'.$slide_content.'">
					<input type="hidden" class="jw-field-slider-slide-content-image" value="'.$slide_content_image.'">
					<span class="jw-field-slider-action-container">
						<a href="#" class="jw-field-slider-action-edit"></a>
						<a href="#" class="jw-field-slider-action-remove"></a>
					</span>
				</li>';
		
	}
				
	return $output;
	
}

/* -----------------------------------------------------------------
	Slider Slide - FRONTEND
----------------------------------------------------------------- */
function jw_slider_slide($atts, $content = null){
	
	/* The attributes */
	extract(shortcode_atts(array(		
		'video_url' => '',
		'text'	=> '',
		'thumb_src' => '',
		'image_src' => '',
		'slide_title'		=> '',
		'slide_description' => '',
		'slide_content'	=> '',
		'slide_link'		=> '',
		'slide_link_text'	=> 'READ MORE',
		'slide_size' => '',		
		'type' => 'regular',
		'resize_width' => '',
	), $atts));
	
	$post_layout = get_post_meta(get_the_ID(), 'jw_layout', true);
	/*$image_height = get_post_meta(get_the_ID(), 'jw_slider_images_height', true);*/
	
	$crop = false;
	/* if($image_height != ''){ $crop = true; } */
	$image_height = 9999;
	
	/* START get the image info */
	
	$file_path_orig = parse_url( $image_src );
	$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path_orig['path'];
	$file_path_alt = ltrim( $file_path_orig['path'], '/' );
	$image_info = @getimagesize($file_path);
	if(!$image_info){
		$file_path = $file_path_alt;
		$image_info = @getimagesize($file_path);
	}
	
	/* END get the image info */
	
	if($image_info[0] == $resize_width && ($image_height == '' || $image_height == $image_info[1]) ){ 
		$resized_image['url'] = $image_src;
	}else{
		$resized_image = jw_resize( '', $image_src, $resize_width, $image_height, $crop );
	}
	
	if($type == 'regular'){
		
		if($image_src != ''){
			$output .= '<li class="slide">';
				if($slide_link != ''){
					$output .= '<a href="'.$slide_link.'"><img src="'.$resized_image['url'].'"></a>';
				}else{
					$output .= '<img src="'.$resized_image['url'].'">';
				}
				if($slide_title != ''){
					$output .= '<div class="slide-title">';
						$output .= $slide_title;
					$output .= '</div>';
				}
			$output .= '</li><!-- .slide -->';
		}else{
			$output .= '<li class="slide">';
				$output .= $slide_content;
			$output .= '</li><!-- .slide -->';
		}
								
	}elseif($type == 'carousel'){
		
		if($image_src != ''){
			$output .= '<li class="slide">';
				
				if($slide_link != ''){
					$output .= '<a href="'.$slide_link.'"><img src="'.$resized_image['url'].'"></a>';
				}else{
					$output .= '<img src="'.$resized_image['url'].'">';
				}
				
				if($slide_title != '' || $slide_description != ''){
					
					$output .= '<div class="slide-info">';
						if($slide_title != ''){
							if($slide_link != ''){
								$output .= '<h3 class="slide-title"><a href="'.$slide_link.'">'.$slide_title.'</a></h3>';
							}else{
								$output .= '<h3 class="slide-title">'.$slide_title.'</h3>';
							}
						}
						if($slide_description != ''){
							$output .= '<div class="slide-description">'.$slide_description.'</div>';
						}
					$output .= '</div>';
					
				}
				
			$output .= '</li><!-- .slide -->';

		}else{

			$output .= '<li class="slide">';

				$output .= $slide_content;

			$output .= '</li>';
			
		}
		
	}
	
	return str_replace('(jwquote)', '"', jw_html_check($output));

}

add_shortcode('slider_slide_nav', 'jw_slider_slide_nav');
/* -----------------------------------------------------------------
	Slider Slide Nav
----------------------------------------------------------------- */
function jw_slider_slide_nav($atts, $content = null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'type'	=> 'image',
		'video_url' => '',
		'text'	=> '',
		'thumb_src' => '',
		'image_src' => '',
		'slide_title'		=> '',
		'slide_description' => '',
		'slide_content'	=> '',
		'slide_content_image' => '',
		'slide_link'		=> '',
		'slide_link_text'	=> 'READ MORE',
		'width'	=> '',
		'height' => '',
	), $atts));
	
	//$post_layout = get_post_meta(get_the_ID(), 'jw_layout', true);
	
	$output = '<li>';

			$crop = false;
			if($height != ''){ $crop = true; }
			if($image_src == ''){
				$image_src = $slide_content_image;
			}
			
			$resized_image = jw_resize( '', $image_src, $width, $height, $crop );
		
			$output .= '<a href="#"><img class="slider-nav-image" src="'.$resized_image['url'].'" /></a>';
			
	$output .= '</li>';
				
	return $output;
	
}

add_shortcode('posts_slider', 'jw_posts_slider');

/* -----------------------------------------------------------------
	Posts Slider
----------------------------------------------------------------- */
function jw_posts_slider($atts, $content = null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'post_type' => 'post',
		'post_category_portfolio' => 'all',
		'post_category_blog' => 'all',
		'amount' => 8,
		'item_size' => 'one_fourth',
		'type' => 'regular',
	), $atts));
	
	if($post_category_blog != 'all'){
		$post_category_blog = implode(',', unserialize($post_category_blog));
	}else{
		$post_category_blog = '';
	}
	
	if($post_category_portfolio != 'all'){
		$post_category_portfolio = get_objects_in_term(unserialize($post_category_portfolio), 'jw_portfolio_categories');
	}else{
		$post_category_portfolio = '';
	}
	
	if($post_type == 'post'){
		
		$args=array(
		   'post_type' => $post_type,
		   'showposts' => $amount,
		   'cat' => $post_category_blog
		);
	
	}elseif($post_type == 'jw_portfolio'){
		
		$args=array(
		   'post_type' => $post_type,
		   'showposts' => $amount,
		   'post__in' => $post_category_portfolio
		);
		
	}
	
	/* Vars */
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
	
	$jw_query = new WP_Query($args);
	
	$output = '';
	$count = 0;
	
	if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++;  /* Loop the posts */
		
		
		/* Get the custom fields values (aka post options) */
		$post_options = jw_get_post_options(get_the_ID());
		
		if($type == 'regular' || $type == 'carousel'){
		
			if($post_type == 'jw_portfolio'){ $portfolio_class = 'portfolio-post-entry'; }else{ $portfolio_class = ''; } 
			
			$output.= '
			
			<li class="'.$size_class.' '.$portfolio_class.'">';
				
				if($post_type == 'post'){
				
					$output .= '
					<a href="'.get_permalink().'">';
						
						if(has_post_thumbnail()){
							$output .= get_the_post_thumbnail(get_the_ID(), $thumbnail_size, array('class' => 'post-thumb-special'));
						}
						
					$output.= '
					</a>';
				
				}else{ 
					
					$output .= '<div class="slide-images">';
									
						$output .= '<div class="slide-images-inner">';
							
							if(isset($post_options['jw_portfolio_item_video']) && !empty($post_options['jw_portfolio_item_video'])){
				
								$output .= '<a href="'.$post_options['jw_portfolio_item_video'].'" class="current-slide" rel="prettyPhoto['.get_the_ID().']">';
									$output .= get_the_post_thumbnail(get_the_ID(), $thumbnail_size, array('class' => 'wrapped'));
								$output .= '</a>';
								
							}elseif(isset($post_options['jw_portfolio_item_images']) && !empty($post_options['jw_portfolio_item_images'])){
								
								$portfolio_images_shortcode = str_replace('[portfolio_image', '[portfolio_image size="'.$item_size.'"', $post_options['jw_portfolio_item_images']);
								$portfolio_images_shortcode = preg_replace('/portfolio_image/', 'portfolio_image first="yes"', $portfolio_images_shortcode, 1);
								$output .= do_shortcode($portfolio_images_shortcode);
								
							}else{
								
								$output .= '<a href="'.get_permalink().'">';
									$output .= get_the_post_thumbnail(get_the_ID(), $thumbnail_size, array('title' => '' ));
								$output .= '</a>';
								
							}
							
						$output .= '</div><!-- .slide-images-inner -->';
						
						if((isset($post_options['jw_portfolio_item_images']) && !empty($post_options['jw_portfolio_item_images'])) || (isset($post_options['jw_portfolio_item_video']) && !empty($post_options['jw_portfolio_item_video']))){
							$output .= '<div class="slide-overlay">';
								if(!empty($post_options['jw_portfolio_item_video'])){
									$output .= '<img src="'.get_template_directory_uri().'/images/elements/play.png" class="slide-overlay-inner" />';
								}else{
									$output .= '<img src="'.get_template_directory_uri().'/images/elements/magnifier.png" class="slide-overlay-inner" />';
								}
							$output .= '</div><!-- .slide-overlay -->';
						}
						
						$output .= '<span class="slide-pointer"></span>';
						
					$output .= '</div>';
					
				}
				
			$output .= '
				<span class="slide-info">
					<span class="slide-images-nav"></span>
					<span class="slide-title"><a href="'.get_permalink().'">'.get_the_title().'</a></span>
					<span class="slide-description">'.get_the_excerpt().'</span>
					<a href="'.get_permalink().'" class="slide-link">'.__('DETAILS', 'jwlocalize').'</a>
				</span><!-- .slide-info -->
				
			</li><!-- .post-entry -->';
		
		}elseif($type == 'accordion'){
			
			$output .= '<li>';
					
				$output .= '<a href="'.get_permalink().'">';
					
					if(has_post_thumbnail()){
						$output .= get_the_post_thumbnail(get_the_ID(), 'jw_accordion', array( 'title' => '' ));
					}
					
					$output .= '<span class="slide-info">';
					
						$output .= '<span class="slide-title">'.get_the_title().'</span>';
						
						$output .= '<span class="slide-description">'.get_the_excerpt().'</span>';
					
					$output .= '</span>';
				
				$output .= '</a>';
				
			$output .= '</li>';
			
		}
		
	endwhile; endif;
	
	wp_reset_query();
				
	return $output;
	
}

add_shortcode('contact_form', 'jw_contact_form');
/* -----------------------------------------------------------------
	Contact Form
----------------------------------------------------------------- */
function jw_contact_form($atts, $content = null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'email_to' => '',
		'success_msg' => 'Message succesfuly sent.',
		'fail_msg' => 'There was a problem. Try again later.',
		'content_before' => '',
		'content_after' => ''
	), $atts));
	
	$output = '';
	
	$output .= $content_before.'<div class="clear"></div>';
	
	$output .= '
		<div class="contact-form">
			<form action="'.get_bloginfo('template_url').'/functions/contact-send.php">
				<p><label>'.__('Name', 'jwlocalize').'</label> <input type="text" name="name" class="contact-form-name" /></p>
				<p><label>'.__('Email', 'jwlocalize').'</label> <input type="text" name="email" class="contact-form-email" /></p>
				<p><textarea name="message" class="contact-form-message"></textarea></p>
				<button>'.__('Send', 'jwlocalize').'</button>
				<input type="hidden" class="contact-form-email-to" name="email_to" value="'.$email_to.'" />
				<input type="hidden" class="contact-form-success-msg" name="success_msg" value="'.$success_msg.'" />
				<input type="hidden" class="contact-form-fail-msg" name="fail_msg" value="'.$fail_msg.'" />
			</form>
		</div>
	';
	
	$output .= '<div class="clear"></div>'.$content_after;
	
	return do_shortcode($output);

}

add_shortcode('slider_posts_widget', 'jw_slider_posts_widget');
/* -----------------------------------------------------------------
	Slider Posts Widget
----------------------------------------------------------------- */
function jw_slider_posts_widget($atts, $content = null){
	
	/* The attributes */
	extract(shortcode_atts(array(
		'amount' => '',
		'post_type' => '',
		'slide_speed' => '',
		'order'	=> '',
		'cat'	=> '',
		'show_title' => '',
		'show_excerpt' => '',
		'show_thumb' => '',
	), $atts));
	
	$output = '';
	
	if($post_type == 'post'){
		
		if($cat == 'all'){
			$cat = '';
		}
		
		$args = array(
			'posts_per_page'	=> $amount,
			'post_type'			=> $post_type,
			'orderby'			=> $order,
			'cat'				=> $cat
		);
		
		
	}elseif($post_type == 'jw_portfolio'){
	
		if($cat != 'all'){
			$portfolio_categories = get_objects_in_term($cat, 'jw_portfolio_categories');
		}else{
			$portfolio_categories = '';
		}
		
		$args = array(
			'posts_per_page'	=> $amount,
			'post_type'			=> $post_type,
			'orderby'			=> $order,
			'post__in'			=> $portfolio_categories
		);
		
	}
	
	$jw_query = new WP_Query($args);
	
	$thumbnail_size = 'jw_one_third_crop';
	$item_size = 'one_third';
	
	if($post_type == 'jw_portfolio'){ $portfolio_class = 'portfolio-post-entry'; }else{ $portfolio_class = ''; } 
	
	$output .= '<input type="hidden" class="slider-posts-widget-speed" value="'.$slide_speed.'" />';
	
	$output .= '<div class="">';
		
		if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); /* Loop the posts */
			
			/* Get the custom fields values (aka post options) */
			$post_options_single = jw_get_post_options(get_the_ID());
			
			$output .= '<div class="slider-posts-post-entry '.$portfolio_class.' type-'.$post_type.'">';
				
				if($show_thumb == 'yes'){
						
					if($post_type == 'post'){
			
						$output .= '<div class="blog-post-thumbnail">';
							$output .= '<a href="'.get_permalink().'">';							
								if(has_post_thumbnail()){ $output .= get_the_post_thumbnail(get_the_ID(), $thumbnail_size, array('class' => 'post-thumb-special')); }
							$output.= '</a>';
						$output .= '</div>';
					
					
					}else{
							
						if(isset($post_options_single['jw_portfolio_item_images']) && !empty($post_options_single['jw_portfolio_item_images'])){
									
							$output .= '<div class="portfolio-post-images flexslider">';
								$output .= '<ul class="slides">';
									$portfolio_images_shortcode = str_replace('[portfolio_image', '[portfolio_image size="'.$item_size.'"', $post_options_single['jw_portfolio_item_images']);
									$output .= do_shortcode($portfolio_images_shortcode);
								$output .= '</ul>';
							$output .= '</div>';
						
						}elseif(isset($post_options_single['jw_portfolio_item_video']) && !empty($post_options_single['jw_portfolio_item_video'])){
							
							$output .= '<div class="portfolio-post-images">';
								$output .= '<a href="'.$post_options_single['jw_portfolio_item_video'].'" class="current-slide" rel="prettyPhoto['.get_the_ID().']">';
									$output .= get_the_post_thumbnail(get_the_ID(), $thumbnail_size);
								$output .= '</a>';
							$output .= '</div>';
						
						}elseif(has_post_thumbnail()){
							
							$output .= '<div class="portfolio-post-images">';
								$output .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), $thumbnail_size).'</a>';
							$output .= '</div>';
							
						}
					
					}
					
				}
				
				if($show_title == 'yes' || $show_excerpt == 'yes'){ 
					$output .= '<div class="slide-info">';
				}
				
					if($show_title == 'yes'){
						$output .= '<h3 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
					}
					
					if($show_excerpt == 'yes'){
						$output .= '<div class="slide-description">'.get_the_excerpt().'</div>';
					}
				
				if($show_title == 'yes' || $show_excerpt == 'yes'){ 
					$output .= '</div>';
				}
			
			$output .= '</div>';
		
		endwhile; endif;
		
	$output .= '</div>';
	
	return do_shortcode($output);

}