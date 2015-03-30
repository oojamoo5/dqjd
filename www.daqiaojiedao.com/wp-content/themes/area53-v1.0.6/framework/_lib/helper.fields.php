<?php
/* ---------------------------------------------------------------------------------------------------
	
	JW Fields Helper
	
--------------------------------------------------------------------------------------------------- */

$google_fonts = array(	'Jockey One *',
						'Contrail One *',
						'Atomic Age *',
						'Quicksand *',
						'Linden Hill *',
						'Rancho *',
						'Salsa *',
						'Ubuntu Mono *',
						'Chivo *',
						'Satisfy *',
						'Ubuntu Condesed *',
						'Poly *',
						'Terminal Dosis *',
						'Federant *',
						'Alice *',
						'Andada *',
						'Sansita One *',
						'Alike *',
						'Sorts Mill Goudy *',
						'Coda *',
						'Prata *',
						'Alike Angular *',
						'Comfortaa *',
						'Coustard *',
						'Spinnaker *',
						'Changa One *',
						'Andika *',
						'Varela Round *',
						'Adamina *',
						'Sterdos Stencil *',
						'Leckerli One *',
						'Questrial *',
						'Podkova *',
						'Rochester *',
						'Corben *',
						'Voltaire *',
						'Actor *',
						'Rationale *',
						'Abril Fatface *',
						'Shadows Into Light *',
						'Paytone One *',
						'Gentium Book Basic *',
						'Shanti *',
						'Unna *',
						'Maiden Orange *',
						'Vidaloka *',
						'Open Sans *',
						'Muli *',
						'Lora *',
						'Francois One *',
						'Yeseva One *',
						'Play *',
						'Merienda One *',
						'Quattrocento *',
						'Jura *',
						'PT Serif *',
						'Philosofer *',
						'Varela *',
						'Radley *',
						'Bigshot One *',
						'Nova Round *',
						'Amaranth *',
						'Julee *',
						'News Cycle *',
						'Rosario *',
						'Nova Slim *',
						'PT Sans Caption *',
						'PT Sans Narrow *',
						'IM Fell Double Pica SC *',
						'Metrophobic *',
						'Istok Web *',
						'Unkempt *',
						'IM Fell DW Pica SC *',
						'Geo *',
						'Ubuntu *',
						'Damion *',
						'Kreon *',
						'IM Fell DW Pica *',
						'Tinos *',
						'Hammersmith One *',
						'Josefin Slab *',
						'Aclonica *',
						'EB Garamond *',
						'IM Fell English *',
						'Brawler *',
						'PT Serif Caption *',
						'Playfair Display *',
						'Oswald *',
						'Kelly Slab *',
						'Arvo *',
						'Artifika *',
						'Architects Daughter *',
						'Merriweather *',
						'Delius *',
						'Neuton *',
						'Raleway *',
						'Allerta Stencil *',
						'Goudy Bookletter 1911 *',
						'Droid Serif *',
						'Molengo *',
						'Lato *',
						'Nova Cut *',
						'Droid Sans *',
						'Tenor Sans *',
						'Maven Pro *',
						'Arimo *',
						'Bentham *',
						'Yanone Kaffeesatz *',
						'Nobile *',
						'Cantarell *',
						'Kameron *',
						'Judson *',
						'Expletus Sans *',
						'Abel *',
						'IM Fell Great Primer *',
						'Allerta *',
						'Redressed *',
						'Lobster Two *',
						'Cabin *',
						'Candal *',
						'Caudex *',
						'Buda *',
						'Federo *',
						'Delius Swash Caps *',
						'Inconsolata *',
						'Cardo *',
						'Crimson Text *',
						'Crushed *',
						'Cuprum *',
						'Copse *',
						'Quattrocento Sans *',
						'Dancing Script *',
						'Numans *',
						'PT Sans *',
						'Volkhov *',
						'Vollkorn *',
						'Nova Flat *',
						'Didact Gothic *',
						'IM Fell Double Pica *',
						'Nunito *',
						'Bangers *',
						'Modern Antiqua *',
						'Carme *',
						'Pacifico *',
						'Passero One *',
						'Mako *',
						'Rokkitt *',
						'Ovo *',
						'Lobster *',
						'Prociono *',
						'Forum *',
						'Aldrich *',
						'Gentium Basic *',
						'Tienne *',
						'Miltonian Tattoo *',
						'MedievalSharp *',
						'Nova Square *',
						'Fanwood Text *',
						'Aubrey *',
						'Limelight *',
						'Smythe *',
						'Sunshiney *',
						'Pompiere *',
						'Lekton *', );

$jw_content = '';
$jw_sidebar = '';

foreach($options as $option){
	
	if($option['type'] != 'open' && $option['type'] != 'close'){
	
		
		$val = $option['std'];
		
		/* Get the value */
		if($fields_for == 'jwpanel_framework'){
		
			$field_value = get_option($option['id']);
			if(!is_serialized($field_value)){
				$field_value = htmlspecialchars($field_value);
			}
			
		}else if($fields_for == 'metaboxes_framework'){
			
			$field_value = get_post_meta($post_id, $option['id'], true);
			
		}else{
		
			$field_value = '';
			
		}
		if($field_value == '') { $field_value = $option['std']; }
	
	}
	
	switch ($option['type']) {
		
		/* open: Opens a new section */
		case 'open':
			
			$tab_id = str_replace(' ', '-', strtolower($option['title']));
			
			$jw_sidebar .= '<li id="jwtab-'.$tab_id.'-sidebar-li"><a href="#jwtab-'.$tab_id.'">'.$option['title'].'</a></li>';
			
			$jw_content .= '<div class="jw-section" id="jwtab-'.$tab_id.'">';
				
				$jw_content .= '<div class="jw-section-description">';
					$jw_content .= '<h4>'.$option['title'].' Options</h4>';
					if(isset($option['desc'])){
						$jw_content .= $option['desc'];
					}
				$jw_content .= '</div>';
			
			break;
			
		/* close: Closes the current section */
		case 'close':
		
			$jw_content .= '</div><!-- .jw-section -->';
			break;
		
		/* text: Simple textual input field */
		case 'text':
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
				
					/* Field */
					$jw_content .= '<input class="jw-form-field" type="text" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$field_value.'" />';
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
		
		/* textarea: Textarea field */
		case 'textarea':
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
				
					/* Field */
					$jw_content .= '<textarea class="jw-form-field '.$option['id'].'" name="'.$option['id'].'" id="'.$option['id'].'">'.$field_value.'</textarea>';
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			break;
			
		case 'select':
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
				
					/* Field */
					$jw_content .= '<select class="jw-form-field" name="'.$option['id'].'" id="'.$option['id'].'">';
						
						/* Loop options */
						foreach($option['opts'] as $key => $value){
							
							/* Which options should be selected */
							if($value == $field_value){
								$active_attr = 'selected';
							}else{
								$active_attr = '';
							}
							
							/* Option */
							$jw_content .= '<option value="'.$value.'" '.$active_attr.'>'.$key.'</option>';
							
						}
						
					$jw_content .= '</select>';
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
			
		case 'radio':
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					/* Loop options */
					foreach($option['opts'] as $key => $value){
						
						/* Which options should be selected */
						if($value == $field_value){
							$active_attr = 'checked';
						}else{
							$active_attr = '';
						}
						
						/* Field */
						$jw_content .= '<span class="jw-radio-option">';
							$jw_content .= '<input class="jw-form-field" type="radio" name="'.$option['id'].'" value="'.$value.'" '.$active_attr.'> ';
							$jw_content .= $key;
						$jw_content .= '</span>';
						
					}
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
			
		case 'checkbox':
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					/* Loop options */
					foreach($option['opts'] as $key => $value){
						
						/* Field */
						$jw_content .= '<span class="jw-radio-option">';
							
							/* If multiple checkbox options */
							
							if(count($option['opts']) > 1){
								$field_value_array = $field_value;
								if ($field_value_array != 'all' && in_array($value, $field_value_array)) {
									$active_attr = 'checked';
								}else{
									$active_attr = '';
								}
								$jw_content .= '<input class="jw-form-field" type="checkbox" name="'.$option['id'].'[]" value="'.$value.'" '.$active_attr.'> ';
							/* If single checkbox option */
							}else{
								if($value == $field_value){
									$active_attr = 'checked';
								}else{
									$active_attr = '';
								}
								$jw_content .= '<input class="jw-form-field" type="checkbox" name="'.$option['id'].'" value="'.$value.'" '.$active_attr.'> ';
							}
							
							$jw_content .= $key;
						$jw_content .= '</span>';
						
					}
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
			
		/* upload: Upload field */
		case 'upload':
				
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
				
					/* Field */
					$jw_content .= '<div class="jw-file-uploader" id="file-uploader-'.$option['id'].'">Upload</div>';
					$jw_content .= '<input type="hidden" class="jw-file-uploader-real-value" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$field_value.'" />';
					
					if($field_value != ''){ $jw_content .= '<img style="float:right;" src="'.$field_value.'" height="40" />'; }
					
					$jw_content .= '<div style="clear:both;"></div>';
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
		
		/* font: Font options */
		case 'font':
			
			/* Font families */
			$font_families_opts_regular = array('Arial', 'Arial Black', 'Courier New', 'Georgia', 'Lucida', 'Tahoma', 'Times New Roman', 'Trebuchet MS', 'Verdana'  );
			sort($font_families_opts_regular);
			sort($google_fonts);
			$font_families_opts_google = $google_fonts;
			$font_families_opts = array_merge($font_families_opts_regular, $font_families_opts_google);
			
			/* Font styles */
			$font_style_opts	= array('Regular' => 'normal', 'Italic' => 'italic', 'Bold' => 'bold', 'Bold Italic' => 'bold+italic');
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					/* Get all values in an array */
					if(is_array($field_value)){
						$field_value_array = $field_value;
					}else{
						$field_value_array = unserialize($field_value);
					}
					
					/* Field */
					$jw_content .= '<select class="jw-font-switcher-family" name="'.$option['id'].'[family]">';
										
										foreach($font_families_opts as $font_family){
										
											$font_family_value = str_replace(' *', '', $font_family);
											$font_family_value = str_replace(' ', '+', $font_family_value);
											
											if($field_value_array['family'] == $font_family_value){
												$jw_content .= '<option value="'.$font_family_value.'" selected>'.$font_family.'</option>';
											}else{
												$jw_content .= '<option value="'.$font_family_value.'">'.$font_family.'</option>';
											}
										}
										
					$jw_content .= '</select>
									<select class="jw-font-switcher-size"  name="'.$option['id'].'[size]">';
										
										for ($i = 8; $i <= 50; $i++) {
											$ipx = $i.'px';
											if($field_value_array['size'] == $ipx){
												$jw_content .= '<option value="'.$ipx.'" selected>size &rarr; '.$ipx.'</option>';
											}else{
												$jw_content .= '<option value="'.$ipx.'">size &rarr; '.$ipx.'</option>';
											}
										}
										
					$jw_content .= '</select>
									<select class="jw-font-switcher-line-height"  name="'.$option['id'].'[lineheight]">';
											
										for ($i = 8; $i <= 100; $i++) {
											$ipx = $i.'px';
											if($field_value_array['lineheight'] == $ipx){
												$jw_content .= '<option value="'.$ipx.'" selected>line height &rarr; '.$ipx.'</option>';
											}else{
												$jw_content .= '<option value="'.$ipx.'">line height &rarr; '.$ipx.'</option>';
											}
										}
					$jw_content .= '</select>
									<select class="jw-font-switcher-style"  name="'.$option['id'].'[style]">';
										
										foreach($font_style_opts as $opt_key=>$opt_value){
											if($field_value_array['style'] == $opt_value){
												$jw_content .= '<option value="'.$opt_value.'" selected>style &rarr; '.$opt_key.'</option>';
											}else{
												$jw_content .= '<option value="'.$opt_value.'">style &rarr; '.$opt_key.'</option>';
											}
										}
									
											
					$jw_content .= '</select>
									<div class="colorpicker-holder">
										<div class="colorSelector" id="colorSelector-'.$option['id'].'"><div style="background-color: #00ff00"></div></div>
										<div class="colorpickerHolder" id="colorpickerHolder-'.$option['id'].'"></div>
										<input type="hidden" class="real-value" name="'.$option['id'].'[color]" value="'.$field_value_array['color'].'" />
									</div>';
					
					$demo_font_style = 'normal'; $demo_font_weight = 'normal'; $demo_font_family = str_replace('+', ' ', $demo_font_opts['family']);
					if($field_value_array['style'] == 'bold+italic'){ $demo_font_weight = 'bold'; $demo_font_style = 'italic'; }elseif($field_value_array['style'] == 'italic'){ $demo_font_style = 'italic'; } elseif($field_value_array['style'] == 'bold'){ $demo_font_weight = 'bold'; }
					$demo_font_family = str_replace('+', ' ', $field_value_array['family']);
					
					$demo_bg_color = '#fff';
					$demo_text = 'This is a demonstration of how it will look like on the actual website. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.';
					
					if(isset($option['other']['background'])){
						$demo_bg_color = $option['other']['background'];
					}
					
					if(isset($option['other']['demo_text'])){
						$demo_text = $option['other']['demo_text'];
					}
					
					$jw_content .= '
					<div class="jw-field-font-demo" style="background:'.$demo_bg_color.'; color:'.$field_value_array['color'].'; font-family:\''.$demo_font_family.'\'; font-size:'.$field_value_array['size'].'; font-style:'.$demo_font_style.'; font-weight:'.$demo_font_weight.'; line-height:'.$field_value_array['lineheight'].';">
						'.$demo_text.'
					</div>';
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
		
		/* colorpicker */
		case 'colorpicker':
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					/* Field */
					$jw_content .= 
						'<div class="colorpicker-holder">
							<div class="colorSelector" id="colorSelector-'.$option['id'].'"><div style="background-color: #'.$field_value.'"></div></div>
							<div class="colorpickerHolder" id="colorpickerHolder-'.$option['id'].'"></div>
							<input type="hidden" class="real-value" name="'.$option['id'].'" value="'.$field_value.'" />
						</div>';
					
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
		
		/* sidebar: Special use field */
		case 'sidebar':
				
			$sidebar_existing_options = '';
			
			global $wpdb;

			$widgetized_pages = $wpdb->get_col( "SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'jw_sidebar'" );
			
			if($widgetized_pages){
				
				foreach($widgetized_pages as $w_page){
					if($w_page == $field_value){ $selected = ' selected'; } else { $selected = ''; }
					$sidebar_existing_options .= '<option'.$selected.'>'.$w_page.'</option>';
				}
				
			}
				
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field jw-field-sidebar">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					/* Special fields */
					$jw_content .= '<select class="jw-field-sidebar-existing"><option>- Select Existing -</option>'.$sidebar_existing_options.'</select> &nbsp;&nbsp;<em>or</em>&nbsp;&nbsp; <input class="jw-field-sidebar-new" type="text" value="Create New" /><br /><br />';
					
					/* Field */
					$jw_content .= '<input type="hidden" class="jw-field-sidebar-real" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$field_value.'" />';
					
					/* Description */
					if(isset($option['desc'])){
						$jw_content .= '<div class="jw-field-description">';
							$jw_content .= $option['desc'];
						$jw_content .= '</div><!-- .jw-field-description -->';
					}
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
		
		case 'portfolio_item_images':
			
			$min_width = 1;
			
			$shortcode_name = $option['extra'];
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field jw-field-pii-container">';
				
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					$jw_content .= '
						<a href="#" class="button-primary jw-field-pii-switch-to-media-listing" style="display:block; float:left; margin-right:10px;">Add Image</a> 
						<div class="clear"></div><br /><br />';
					
					global $wpdb;
					$media_images = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' order by ID desc");
					
					$jw_content .= '
					<ul class="jw-field-pii-listing jw-field-pii-media-listing">';
					
						foreach($media_images as $image_post){
							
							$img_details = wp_get_attachment_image_src($image_post->ID, 'full');
							
							//If image is big enough for the slider proceed
							if($img_details[1] >= $min_width){
							
								$thumb_src = wp_get_attachment_image_src($image_post->ID);
								$thumb_src = $thumb_src[0];
								
								if(!empty($active_imgs) && in_array($image_post->ID, $active_imgs)){ $class_attr .= ' class="added"'; } else { $class_attr = ''; }
								
								$jw_content .= '
								<li'.$class_attr.'>
									<img src="'.$thumb_src.'" alt="'.$img_details[0].'" width=75 />
									<span class="jw-image-size">'.$img_details[1].'x'.$img_details[2].'</span>
									<span class="jw-image-added-notice">Added</span>
								</li>';
								
							}
							
						}
					
					$jw_content .= '
					</ul>';
					
					$jw_content .= '
					<ul class="jw-field-pii-listing jw-field-pii-added-listing">';
					
						$jw_content .= do_shortcode($field_value);
					
					$jw_content .= '
					</ul>';
					
					/* Field */
					$jw_content .= '<textarea style="display:none;" class="jw-field-pii-images-real" name="'.$option['id'].'" id="'.$option['id'].'">'.$field_value.'</textarea>';
					$jw_content .= '<input type="hidden" class="pii-shortcode" value="'.$shortcode_name.'" />';
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
		
		break;
		
		case 'slider':
			
			$shortcode_name = $option['extra'];
			$min_width = 920;
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field jw-field-slider-container">';
				
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					$jw_content .= '
						<a href="#" class="button-primary jw-field-slider-switch-to-media-listing" style="display:block; float:left; margin-right:10px;">Add Image Slides</a> 
						<a href="#" class="button-primary jw-field-slider-switch-to-video-add" style="display:none; float:left; margin-right:10px;">Add Video Slides</a> 
						<a href="#" class="button-primary jw-field-slider-switch-to-content-add" style="display:block; float:left;">Add Content Slides</a>
						<a href="#" class="button-primary jw-field-slider-switch-to-added-listing">&larr; Back</a>
						<div class="clear"></div><br /><br />';
					
					global $wpdb;
					$media_images = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' order by ID desc");
					
					$count_imgs = 0;
					
					$jw_content .= '
					<ul class="jw-field-slider-listing jw-field-slider-media-listing">';
					
						foreach($media_images as $image_post){
							
							$img_details = wp_get_attachment_image_src($image_post->ID, 'full');
							
							//If image is big enough for the slider proceed
							if($img_details[1] >= $min_width){

								$count_imgs++;

								$thumb_src = wp_get_attachment_image_src($image_post->ID);
								$thumb_src = $thumb_src[0];
								
								if(!empty($active_imgs) && in_array($image_post->ID, $active_imgs)){ $class_attr .= ' class="added"'; } else { $class_attr = ''; }
								
								$jw_content .= '
								<li'.$class_attr.'>
									<img src="'.$thumb_src.'" alt="'.$img_details[0].'" width=75 />
									<span class="jw-image-size">'.$img_details[1].'x'.$img_details[2].'</span>
									<span class="jw-image-added-notice">Added</span>
								</li>';
								
							}
							
						}
						
						if($count_imgs == 0){
							$jw_content .= 'No images equal or larger then '.$min_width.'px in width found in the <strong>Media Library</strong>';
						}
					
					$jw_content .= '
					</ul>';
					
					$jw_content .= '
					<div class="jw-field-slider-listing jw-field-slider-media-edit">';
					
					$jw_content .= '<label>Title</label>
										<br /><br />
										<div class="jw-field-content">
											<input type="text" class="jw-field-slider-slide-edit-title" />
											<div class="jw-field-description">Enter the title for this slide.</div>
										</div>
										<div class="clear"></div>
										<br />
										<label>Description</label> 
										<br /><br />
										<div class="jw-field-content">
											<input type="text" class="jw-field-slider-slide-edit-description" />
											<div class="jw-field-description">Enter the description for this slide.</div>
										</div>
										<div class="clear"></div>
										<br />
										<label>Link</label> 
										<br /><br />
										<div class="jw-field-content">
											<input type="text" class="jw-field-slider-slide-edit-link" />
											<div class="jw-field-description">Enter the link url for this slide.</div>
										</div>
										<div class="clear"></div>
										
										<label style="display:none;">Link Text</label> 
										
										<div class="jw-field-content">
											<input style="display:none;" type="text" class="jw-field-slider-slide-edit-link-text" />
											<div style="display:none;" class="jw-field-description">Enter the text for the link.</div>
											<br /><br />
											<a href="#" class="button-primary jw-field-slider-media-edit-update" style="display:block; float:left;">Update Image Slide</a>
										</div>';
					
					$jw_content .= '
					</div>';
					
					$jw_content .= '
					<div class="jw-field-slider-listing jw-field-slider-video-add">';
					
						$jw_content .= '<label>Video URL</label> 
										<div class="jw-field-content">
											<input type="text" /> <a href="#" class="button-primary" style="margin-left:15px;">Add Video Slide</a>
											<div class="jw-field-description">Enter the url to a Vimeo or Youtube video.</div>
										</div>';
					
					$jw_content .= '
					</div>';
					
					$jw_content .= '
					<div class="jw-field-slider-listing jw-field-slider-video-edit">';
					
						$jw_content .= '<label>Video URL</label> 
										<div class="jw-field-content">
											<input type="text" /> <a href="#" class="button-primary" style="margin-left:15px;">Update Video Slide</a>
											<div class="jw-field-description">Enter the url to a Vimeo or Youtube video.</div>
										</div>';
					
					$jw_content .= '
					</div>';
					
					$jw_content .= '
					<div class="jw-field-slider-listing jw-field-slider-content-add">';
					
						$jw_content .= '<label>Content</label> 
										<br /><br />
										<div class="jw-field-content">
											<textarea class="jw-field-slider-slide-add-content"></textarea>
											<div class="jw-field-description">Enter the content of the slide. <strong>HTML allowed</strong></div>
										</div>
										<div class="clear"></div>
										<br />
										<label>Navigation Image</label> 
										<br /><br />
										<div class="jw-field-content">
											
											<div class="jw-field-slider-slide-content-selected-image">
												<img class="jw-field-slider-slide-content-selected-image-value" src="" />
												&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="button-secondary jw-field-slider-slide-content-open-choose-image">Select Image</a>
											</div>
											
											<div class="jw-field-slider-slide-content-choose-image">
											
												Simply left click on the image you want to choose.<br /><br />';
												
												$min_width = 165;
												
												$jw_content .= '
													<ul>';
													
														foreach($media_images as $image_post){
															
															$img_details = wp_get_attachment_image_src($image_post->ID, 'full');
															
															//If image is big enough for the slider proceed
															if($img_details[1] >= $min_width){
															
																$thumb_src = wp_get_attachment_image_src($image_post->ID);
																$thumb_src = $thumb_src[0];
																
																if(!empty($active_imgs) && in_array($image_post->ID, $active_imgs)){ $class_attr .= ' class="added"'; } else { $class_attr = ''; }
																
																$jw_content .= '
																<li'.$class_attr.'>
																	<img src="'.$thumb_src.'" alt="'.$img_details[0].'" width=75 />
																	<span class="jw-image-size">'.$img_details[1].'x'.$img_details[2].'</span>
																</li>';
																
															}
															
														}
													
												$jw_content .= '
												</ul>
												<div class="clear"></div>';
											
											$jw_content .= '
											</div>
											
											<div class="clear"></div>
											
											<br /><br />
											<a href="#" class="button-primary jw-field-slider-content-add-submit" style="display:block; float:left;">Add Content Slide</a>
										</div>';
					
					$jw_content .= '
					</div>';
					
					$jw_content .= '
					<div class="jw-field-slider-listing jw-field-slider-content-edit">';
					
						$jw_content .= '<label>Content</label> 
										<br /><br />
										<div class="jw-field-content">
											<textarea class="jw-field-slider-slide-edit-content"></textarea>
											<div class="jw-field-description">Enter the content of the slide. <strong>HTML allowed</strong></div>
										</div>
										<div class="clear"></div>
										<br />
										<label>Navigation Image</label> 
										<br /><br />
										<div class="jw-field-content">
											
											<div class="jw-field-slider-slide-content-selected-image">
												<img class="jw-field-slider-slide-content-selected-image-value" src="" />
												&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="button-secondary jw-field-slider-slide-content-open-choose-image">Select Image</a>
											</div>
											
											<div class="jw-field-slider-slide-content-choose-image">
											
												Simply left click on the image you want to choose.<br /><br />';
												
												$min_width = 165;
												
												$jw_content .= '
													<ul>';
													
														foreach($media_images as $image_post){
															
															$img_details = wp_get_attachment_image_src($image_post->ID, 'full');
															
															//If image is big enough for the slider proceed
															if($img_details[1] >= $min_width){
															
																$thumb_src = wp_get_attachment_image_src($image_post->ID);
																$thumb_src = $thumb_src[0];
																
																if(!empty($active_imgs) && in_array($image_post->ID, $active_imgs)){ $class_attr .= ' class="added"'; } else { $class_attr = ''; }
																
																$jw_content .= '
																<li'.$class_attr.'>
																	<img src="'.$thumb_src.'" alt="'.$img_details[0].'" width=75 />
																	<span class="jw-image-size">'.$img_details[1].'x'.$img_details[2].'</span>
																</li>';
																
															}
															
														}
													
												$jw_content .= '
												</ul>
												<div class="clear"></div>';
											
											$jw_content .= '
											</div>
											
											<div class="clear"></div>
											
											<br /><br />
											<a href="#" class="button-primary jw-field-slider-content-edit-update" style="display:block; float:left;">Update Content Slide</a>
										</div>';
					
					$jw_content .= '
					</div>';
					
					$jw_content .= '
					<ul class="jw-field-slider-listing jw-field-slider-added-listing">';
					
						$jw_content .= do_shortcode($field_value);
					
					$jw_content .= '
					</ul>';
					
					/* Field */
					$jw_content .= '<textarea style="display:none;" class="jw-field-slider-slides-real" name="'.$option['id'].'" id="'.$option['id'].'">'.$field_value.'</textarea>';
					$jw_content .= '<input type="hidden" class="slider-shortcode" value="'.$shortcode_name.'" />';
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
		
		break;
		
		case 'composer_slider':
			
			/* Variables */
			$shortcode_name = $option['extra']['shortcode'];
			$min_width = $option['extra']['min_width'];
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field jw-field-slider-container">';
				
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					/* Buttons */
					$jw_content .= '
						<a href="#" class="button-primary jw-field-slider-switch-to-media-listing" style="display:block; float:left; margin-right:10px;">Add Image Slides</a> 
						<a href="#" class="button-primary jw-field-slider-switch-to-content-add" style="display:block; float:left;">Add Content Slides</a>
						<a href="#" class="button-primary jw-field-slider-switch-to-added-listing" style="display:none;">&larr; Back</a>
						<div class="clear"></div>';
					
					/* Get images */
					global $wpdb;
					$media_images = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' order by ID desc");
					$count_imgs = 0;
					
					$pag_total_items = count($media_images);
					$pag_total_pages = ceil($pag_total_items / 40);
					
					$jw_content .= '
						<div class="jw-field-slider-media-listing-filter">
							min width: <input type="text" class="jw-field-slider-media-listing-filter-width" value="0">
							min height: <input type="text" class="jw-field-slider-media-listing-filter-height" value="0">
							title: <input type="text" class="jw-field-slider-media-listing-filter-title">
							order: 		<select class="jw-field-slider-media-listing-filter-order">
											<option value="desc">DESC</option>
											<option value="asc">ASC</option>
										</select>
							order by: 	<select class="jw-field-slider-media-listing-filter-orderby">
											<option value="id">ID</option>
											<option value="title">title</option>
										</select>
							<br><br>
							<div class="jw-field-slider-media-listing-filter-pagination" data-current="1" data-totalitems="'.$pag_total_items.'" data-totalpages="'.$pag_total_pages.'">
								<a href="#" class="jw-field-slider-media-listing-filter-pagination-prev">&larr; prev</a> <span class="jw-field-slider-media-listing-filter-pagination-info-current">1</span>/<span class="jw-field-slider-media-listing-filter-pagination-info-total">'. $pag_total_pages .'</span> <a href="#" class="jw-field-slider-media-listing-filter-pagination-next">next &rarr;</a>
							</div>
						</div>';
					
					/* Add image slides */
					$jw_content .= '
					<ul class="jw-field-slider-listing jw-field-slider-media-listing">';
					
						foreach($media_images as $image_post){
							
							$img_details = wp_get_attachment_image_src($image_post->ID, 'full');
							$img_title = $image_post->post_title;
														
							//If image is big enough for the slider proceed
							if($img_details[1] >= $min_width){

								$count_imgs++;

								$thumb_src = wp_get_attachment_image_src($image_post->ID);
								$thumb_src = $thumb_src[0];
								
								if(!empty($active_imgs) && in_array($image_post->ID, $active_imgs)){ $class_attr .= ' class="added"'; } else { $class_attr = ''; }
								
								$jw_content .= '
								<li'.$class_attr.' data-src="'.$thumb_src.'" data-width="'.$img_details[1].'" data-height="'.$img_details[2].'" data-title="'.$img_title.'" data-id="'.$image_post->ID.'">
									<img src="#" alt="'.$img_details[0].'" width=75 />
									<span class="jw-image-size">'.$img_details[1].'x'.$img_details[2].'</span>
									<span class="jw-image-added-notice">Added</span>
								</li>';
								
							}
							
						}
						
						if($count_imgs == 0){
							$jw_content .= 'No images equal or larger then '.$min_width.'px in width found in the <strong>Media Library</strong>';
						}
					
					$jw_content .= '
					</ul>';
					
					/* Edit Image Slide */
					$jw_content .= '<div class="jw-field-slider-listing jw-field-slider-media-edit">';
					
						$jw_content .= '<label>Title</label>
										<br /><br />
										<div class="jw-field-content">
											<input type="text" class="jw-field-slider-slide-edit-title" />
											<div class="jw-field-description">Enter the title for this slide.</div>
										</div>
										<div class="clear"></div>
										<br />
										<label>Description</label> 
										<br /><br />
										<div class="jw-field-content">
											<input type="text" class="jw-field-slider-slide-edit-description" />
											<div class="jw-field-description">Enter the description for this slide.</div>
										</div>
										<div class="clear"></div>
										<br />
										<label>Link</label> 
										<br /><br />
										<div class="jw-field-content">
											<input type="text" class="jw-field-slider-slide-edit-link" />
											<div class="jw-field-description">Enter the link url for this slide.</div>
										</div>
										<div class="clear"></div>
										
										<label style="display:none;">Link Text</label> 
										
										<div class="jw-field-content">
											<input style="display:none;" type="text" class="jw-field-slider-slide-edit-link-text" />
											<div style="display:none;" class="jw-field-description">Enter the text for the link.</div>
											<br /><br />
											<a href="#" class="button-primary jw-field-slider-media-edit-update" style="display:block; float:left;">Update Image Slide</a>
										</div>';
					
					$jw_content .= '</div>';
					
					/* Add content slide */
					$jw_content .= '<div class="jw-field-slider-listing jw-field-slider-content-add">';
					
						$jw_content .= '<label>Content</label> 
										<br /><br />
										<div class="jw-field-content">
											<textarea class="jw-field-slider-slide-add-content"></textarea>
											<div class="jw-field-description">Enter the content of the slide. <strong>HTML allowed</strong></div>
										</div>
										<div class="clear"></div>
										<br /><br />
										<a href="#" class="button-primary jw-field-slider-content-add-submit" style="display:block; float:left;">Add Content Slide</a>';
					
					$jw_content .= '</div>';
					
					/* Edit Content Slide */
					$jw_content .= '<div class="jw-field-slider-listing jw-field-slider-content-edit">';
					
						$jw_content .= '<label>Content</label> 
										<br /><br />
										<div class="jw-field-content">
											<textarea class="jw-field-slider-slide-edit-content"></textarea>
											<div class="jw-field-description">Enter the content of the slide. <strong>HTML allowed</strong></div>
										</div>
										<div class="clear"></div>
										<br /><br />
										<a href="#" class="button-primary jw-field-slider-content-edit-update" style="display:block; float:left;">Update Content Slide</a>';
					
					$jw_content .= '</div>';
					
					/* Listinf of added slides */
					$jw_content .= '<ul class="jw-field-slider-listing jw-field-slider-added-listing">';
					
						$jw_content .= do_shortcode($field_value);
					
					$jw_content .= '</ul>';
					
					/* Field */
					$jw_content .= '<textarea style="display:none;" class="jw-field-slider-slides-real jw-form-field" name="'.$option['id'].'" id="'.$option['id'].'">'.$field_value.'</textarea>';
					$jw_content .= '<input type="hidden" class="slider-shortcode" value="'.$shortcode_name.'" />';
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
		
		break;
			
		case 'service_icons':
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
					
					$jw_content .= '<ul class="jw-field-service-icons">';
					
						for ($i = 1; $i <= 90; $i++) {
							if($i < 10){ $num = '0'.$i; }else{ $num = $i; }
							
							$jw_content .= '
								<li>
									<img alt="/images/icons/black-and-white/blackandwhite-'.$num.'.png" src="'.get_template_directory_uri().'/images/icons/black-and-white/blackandwhite-'.$num.'.png" />
								</li>';
						}
					
					$jw_content .= '</ul>';
					
					/* Field */
					$jw_content .= '<input type="hidden" class="jw-field-real jw-form-field" name="'.$option['id'].'" id="'.$option['id'].'" value="'.$field_value.'" />';
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
		
		break;
		
		case 'menu_colors':
			
			/* Field container open */
			$jw_content .= '<div id="field_'.$option['id'].'" class="jw-field">';
					
				/* Label */
				$jw_content .= '<label for="'.$option['id'].'">'.$option['title'].'</label>';
				
				/* Field content open */
				$jw_content .= '<div class="jw-field-content">';
				
					$field_value = unserialize($field_value);
					
					// Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
					// This code based on wp_nav_menu's code to get Menu ID from menu slug

					$menu_name = 'main_navigation';

					if(($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){
					
						$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						$menu_items = wp_get_nav_menu_items($menu->term_id);
						
						$menu_list = '<ul style="margin:0;">';

							foreach ( (array) $menu_items as $key => $menu_item ) {
								if($menu_item->menu_item_parent == 0){
									$title = $menu_item->title;
									$url = $menu_item->url;
									$ID = $menu_item->ID;
									$cp_ID = 'cp_'.$ID;
									if($field_value[$cp_ID] == ''){ $field_value[$cp_ID] = $option['std']; }
									$menu_list .= '
										<li data-id='.$ID.'>
											<div class="colorpicker-holder">
												<div class="colorSelector" id="colorSelector-'.$option['id'].'-'.$ID.'"><div style="background-color: '.$field_value[$cp_ID].'"></div></div>
												<div class="colorpickerHolder" id="colorpickerHolder-'.$option['id'].'-'.$ID.'"></div>
												<input type="hidden" class="jw-field-real real-value" name="'.$option['id'].'[cp_'.$ID.']" value="'.$field_value[$cp_ID].'" />
											</div>
											<span style="margin-left:50px;">'.$title.'</span></a>
										</li>';
								}
							}
						
						$menu_list .= '</ul>';
						
					}else{
						$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
					}
					// $menu_list now ready to output
					
					$jw_content .= $menu_list;
				
				/* Field content close */
				$jw_content .= '</div><!-- .jw-field-content -->';
			
			/* Field container close */
			$jw_content .= '</div><!-- .jw-field -->';
			
		break;
		
	}
	
}