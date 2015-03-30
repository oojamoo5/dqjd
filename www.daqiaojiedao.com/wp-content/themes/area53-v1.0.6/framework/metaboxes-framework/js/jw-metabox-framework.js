/* ---------------------------------------------------------------------------------------------------

	

	JavaScript for JW MetaBox Framework

	

--------------------------------------------------------------------------------------------------- */



jQuery(document).ready(function($){

	

	

	/* ---------------------------------------------------------------------------------------------------

	

		Sidebar options

		

	--------------------------------------------------------------------------------------------------- */

	

	/* Does the current layout support sidebar */

	function sidebar_check_availability(){

		

		current_layout = $('#jw_layout').val();

		

		if(current_layout == 'layout_cs' || current_layout == 'layout_sc'){

			$('.jw-field-sidebar').animate( { opacity : 1 }, 300 );	

		}else{

			$('.jw-field-sidebar').animate( { opacity : 0.4 }, 300 );

		}

		

	}

	

	/* Check if sidebar options are available */

	sidebar_check_availability();

	

	/* Check if sidebar options are available on layout change */

	$('#jw_layout').change(function(){

		sidebar_check_availability();

	});

	

	/* Simple animation */

	$('.jw-field-sidebar-new').click(function(){

		$(this).animate( { opacity : 1 }, 300 );

		$('.jw-field-sidebar-existing').animate( { opacity : 0.6 }, 300 );

	});

	

	/* Simple animation */

	$('.jw-field-sidebar-existing').click(function(){

		$(this).animate( { opacity : 1 }, 300 );

		$('.jw-field-sidebar-new').animate( { opacity : 0.6 }, 300 );

	});

	

	/* Set the real value */

	$('.jw-field-sidebar-new').keyup(function(){

		$('.jw-field-sidebar-real').val($(this).val());

	});

	

	/* Set the real value */

	$('.jw-field-sidebar-existing').change(function(){

		

		if($(this).val() != '- Select Existing -'){

			$('.jw-field-sidebar-new').val('Create New');

			$('.jw-field-sidebar-real').val($(this).val());

		}else{

			$('.jw-field-sidebar-new').val('Create New');

			$('.jw-field-sidebar-real').val('');

			$('.jw-field-sidebar-new').animate( { opacity : 1 }, 300 );

		}

		

	});

	

	/* ---------------------------------------------------------------------------------------------------

	

		Services

		

	--------------------------------------------------------------------------------------------------- */

	$('.jw-field-service-icons li').live('click', function(){

		

		$('.jw-field-service-icon-active').removeClass('jw-field-service-icon-active');

		$(this).addClass('jw-field-service-icon-active');

		

		var service_image_url = $(this).find('img').attr('alt');

		

		$(this).parents('.jw-field').find('.jw-field-real').val(service_image_url);

		

	});

	

	

	/* ---------------------------------------------------------------------------------------------------

	

		Portfolio Images

		

	--------------------------------------------------------------------------------------------------- */

		

	function jw_generate_image_listing_code(pii_container){

		

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		

		var shortcode = '';

		

		pii_added_listing.find('li').each(function(){

			

			var thumb_src = $(this).find('img').attr('src');

			var image_src = $(this).find('img').attr('alt');

			

			var shortcode_name = pii_container.find('input.pii-shortcode').val();

			var shortcode_atts = ' image_src="' + image_src + '" thumb_src="' + thumb_src + '"';

			

			shortcode = shortcode + ' [' + shortcode_name + shortcode_atts + ' /]';

			

		});

		

		pii_container.find('.jw-field-pii-images-real').val(shortcode);

		

	}

	

	/* Set added class to already added images */

	$('.jw-field-pii-added-listing li').each(function(){

		

		var pii_container = $(this).parents('.jw-field-pii-container');

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		

		var thumb_src = $(this).find('img').attr('src');

		

		pii_media_listing.find('img[src="' + thumb_src + '"]').parents('li').addClass('jw-image-added');

		

	});

	

	/* Click event for media listing */	

	$('.jw-field-pii-media-listing li').live('click', function(){

		

		var pii_container = $(this).parents('.jw-field-pii-container');

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		

		$(this).addClass('jw-image-added');

		var image_src = $(this).find('img').attr('alt');

		var thumb_src = $(this).find('img').attr('src');

		

		if(pii_added_listing.find('img[alt="' + image_src + '"]').length < 1){

			/* Add image */

			pii_added_listing.append('<li><img width=75 src="' + thumb_src + '" alt="' + image_src + '" /><span class="jw-field-pii-action-container"><a href="#" class="jw-field-pii-action-edit"></a><a href="#" class="jw-field-pii-action-remove"></a></span></li>');

			jw_generate_image_listing_code(pii_container);

		}else{

			/* Remove image */

			$(this).removeClass('jw-image-added');

			pii_added_listing.find('img[alt="' + image_src + '"]').parents('li').remove();

			jw_generate_image_listing_code(pii_container);

		}

		

	});

	

	/* Initiate sortable */

	$('.jw-field-pii-added-listing').each(function(){

		

		if($(this).find('li').length){

		

			var pii_container = $(this).parents('.jw-field-pii-container');

			var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

			var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

			

			$(this).sortable({

				stop: function(event, ui) { jw_generate_image_listing_code(pii_container); },

				sort: function(event, ui) { },

				start: function(event, ui) { },

				forcePlaceholderSize: true

			});

		

		}

		

	});

	

	/* Switch to media listing */

	$('.jw-field-pii-switch-to-media-listing').live('click', function(e){

		

		e.preventDefault();

		

		var pii_container = $(this).parents('.jw-field-pii-container');

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		var pii_video_listing = pii_container.find('.jw-field-pii-video-listing');

		var pii_content_listing = pii_container.find('.jw-field-pii-content-listing');

		

		pii_added_listing.hide();

		pii_media_listing.show();

		

		$('.jw-field-pii-switch-to-video-listing, .jw-field-pii-switch-to-content-listing').hide();

		$(this).text('Finish Adding Images').removeClass('jw-field-pii-switch-to-media-listing').addClass('jw-field-pii-switch-to-added-listing');

		

	});

	

	/* Switch to add video */

	$('.jw-field-pii-switch-to-video-listing').live('click', function(e){

		

		e.preventDefault();

		

		var pii_container = $(this).parents('.jw-field-pii-container');

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		var pii_video_listing = pii_container.find('.jw-field-pii-video-listing');

		var pii_content_listing = pii_container.find('.jw-field-pii-content-listing');

		

		pii_added_listing.hide();

		pii_video_listing.show();

		

		$('.jw-field-pii-switch-to-media-listing, .jw-field-pii-switch-to-content-listing').hide();

		$(this).text('Finish Adding Videos').removeClass('jw-field-pii-switch-to-video-listing').addClass('jw-field-pii-switch-to-added-listing');

		

	});

	

	/* Switch to add content */

	$('.jw-field-pii-switch-to-content-listing').live('click', function(e){

		

		e.preventDefault();

		

		var pii_container = $(this).parents('.jw-field-pii-container');

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		var pii_video_listing = pii_container.find('.jw-field-pii-video-listing');

		var pii_content_listing = pii_container.find('.jw-field-pii-content-listing');

		

		pii_added_listing.hide();

		pii_content_listing.show();

		

		$('.jw-field-pii-switch-to-media-listing, .jw-field-pii-switch-to-video-listing').hide();

		$(this).text('Finish Adding Content').removeClass('jw-field-pii-switch-to-content-listing').addClass('jw-field-pii-switch-to-added-listing');

		

	});

	

	/* Switch to images listing */

	$('.jw-field-pii-switch-to-added-listing').live('click', function(e){

		

		e.preventDefault();

		

		var pii_container = $(this).parents('.jw-field-pii-container');

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		var pii_video_listing = pii_container.find('.jw-field-pii-video-listing');

		var pii_content_listing = pii_container.find('.jw-field-pii-content-listing');

		

		if(pii_added_listing.find('li').length){

			

			pii_added_listing.sortable({

				stop: function(event, ui) { jw_generate_image_listing_code(pii_container); },

				sort: function(event, ui) { },

				start: function(event, ui) { },

				forcePlaceholderSize: true

			});

			

		}

		

		pii_media_listing.hide();

		pii_video_listing.hide();

		pii_content_listing.hide();

		pii_added_listing.show();

		

		$('.jw-field-pii-switch-to-media-listing, .jw-field-pii-switch-to-video-listing, .jw-field-pii-switch-to-content-listing').show();

		$(this).text('Add Images').removeClass('jw-field-pii-switch-to-added-listing').addClass('jw-field-pii-switch-to-media-listing');

		

		

	});

	

	/* Remove image */

	$('.jw-field-pii-action-remove').live('click', function(e){

		

		e.preventDefault();

		

		var pii_container = $(this).parents('.jw-field-pii-container');

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		

		$(this).parents('li').remove();

		

		jw_generate_image_listing_code(pii_container);

		

	});

	

	/* Edit image */

	$('.jw-field-pii-action-edit').live('click', function(e){

		

		e.preventDefault();

		

		var pii_container = $(this).parents('.jw-field-pii-container');

		var pii_media_listing = pii_container.find('.jw-field-pii-media-listing');

		var pii_added_listing = pii_container.find('.jw-field-pii-added-listing');

		

	});

	

	/* ---------------------------------------------------------------------------------------------------

	

		Slider Management

		

	--------------------------------------------------------------------------------------------------- */

	$('.jw-field-slider-switch-to-added-listing').hide();

	

	/* Initiate sortable */

	$('.jw-field-slider-added-listing').each(function(){

		

		if($(this).find('li').length){

		

			var container = $(this).parents('.jw-field-slider-container');

			

			$(this).sortable({

				stop: function(event, ui) { jw_generate_slider_code(container); },

				sort: function(event, ui) { },

				start: function(event, ui) { },

				forcePlaceholderSize: true

			});

		

		}

		

	});

	

	function jw_generate_slider_code(container){

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		var shortcode = '';

		

		var shortcode_name = container.find('input.slider-shortcode').val();

		

		added.find('li').each(function(){

			

			if($(this).hasClass('jw-field-slider-content-slide')){

				

				var content_val = $(this).find('.jw-field-slider-slide-content').val();

				var content_image = $(this).find('.jw-field-slider-slide-content-image').val();

				

				content_val = content_val.replace(/'/g,'&#39;');

				content_val = content_val.replace(/"/g,'(jwquote)');

				

				var shortcode_atts = ' slide_content="' + content_val + '" slide_content_image="' + content_image + '"';

				

			}else if($(this).hasClass('jw-field-slider-video-slide')){

			

				

			

			}else{

			

				var thumb_src = $(this).find('img').attr('src');

				var image_src = $(this).find('img').attr('alt');

				var title = $(this).find('.jw-field-slider-slide-title').val();

				var description = $(this).find('.jw-field-slider-slide-description').val();

				var link = $(this).find('.jw-field-slider-slide-link').val();

				var link_text = $(this).find('.jw-field-slider-slide-link-text').val();

				

				title = title.replace(/'/g,'&#39;');

				title = title.replace(/"/g,'&#34;');

				

				description = description.replace(/'/g,'&#39;');

				description = description.replace(/"/g,'&#34;');



				var shortcode_atts = ' image_src="' + image_src + '" thumb_src="' + thumb_src + '" slide_title="' + title + '" slide_description="' + description + '" slide_link="' + link + '" slide_link_text="' + link_text + '"';

			

			}

			

			shortcode = shortcode + ' [' + shortcode_name + shortcode_atts + ' /]';

			

		});

		

		container.find('.jw-field-slider-slides-real').val(shortcode);

		

	}

	

	jw_generate_slider_code($('#field_jw_slider'));

	

	/* Switch to media listing */

	$('.jw-field-slider-switch-to-media-listing').live('click', function(e){

	

		e.preventDefault();

	

		var container = $(this).parents('.jw-field');

		

		var switch_to_media = container.find('.jw-field-slider-switch-to-media-listing');

		var switch_to_video = container.find('.jw-field-slider-switch-to-video-add');

		var switch_to_content = container.find('.jw-field-slider-switch-to-content-add');

		var switch_to_added = container.find('.jw-field-slider-switch-to-added-listing');

		

		var media = container.find('.jw-field-slider-media-listing');

		var media_filter = container.find('.jw-field-slider-media-listing-filter');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		switch_to_media.hide();

		//switch_to_video.hide();

		switch_to_content.hide();

		switch_to_added.show();

		

		added.hide();

		media.show();

		media_filter.show();

	

	});	

	

	/* Switch to video add */

	$('.jw-field-slider-switch-to-video-add').live('click', function(e){

	

		e.preventDefault();

	

		var container = $(this).parents('.jw-field');

		

		var switch_to_media = container.find('.jw-field-slider-switch-to-media-listing');

		var switch_to_video = container.find('.jw-field-slider-switch-to-video-add');

		var switch_to_content = container.find('.jw-field-slider-switch-to-content-add');

		var switch_to_added = container.find('.jw-field-slider-switch-to-added-listing');

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		switch_to_media.hide();

		//switch_to_video.hide();

		switch_to_content.hide();

		switch_to_added.show();

		

		added.hide();

		video.show();

	

	});	

	

	/* Switch to content add */

	$('.jw-field-slider-switch-to-content-add').live('click', function(e){

	

		e.preventDefault();

	

		var container = $(this).parents('.jw-field');

		

		var switch_to_media = container.find('.jw-field-slider-switch-to-media-listing');

		var switch_to_video = container.find('.jw-field-slider-switch-to-video-add');

		var switch_to_content = container.find('.jw-field-slider-switch-to-content-add');

		var switch_to_added = container.find('.jw-field-slider-switch-to-added-listing');

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		switch_to_media.hide();

		//switch_to_video.hide();

		switch_to_content.hide();

		switch_to_added.show();

		

		added.hide()

		content.show();

	

	});	

	

	/* Switch to added listing */

	$('.jw-field-slider-switch-to-added-listing').live('click', function(e){

	

		e.preventDefault();

	

		var container = $(this).parents('.jw-field');

		

		var switch_to_media = container.find('.jw-field-slider-switch-to-media-listing');

		var switch_to_video = container.find('.jw-field-slider-switch-to-video-add');

		var switch_to_content = container.find('.jw-field-slider-switch-to-content-add');

		var switch_to_added = container.find('.jw-field-slider-switch-to-added-listing');

		

		var media = container.find('.jw-field-slider-media-listing');

		var media_filter = container.find('.jw-field-slider-media-listing-filter');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		if(added.find('li').length){

			

			added.sortable({

				stop: function(event, ui) { jw_generate_slider_code(container); },

				sort: function(event, ui) { },

				start: function(event, ui) { },

				forcePlaceholderSize: true

			});

			

		}

		

		$('.jw-field-slider-slide-editing').removeClass('jw-field-slider-slide-editing');

		

		switch_to_media.show();

		//switch_to_video.show();

		switch_to_content.show();

		switch_to_added.hide();

		

		media.hide();

		media_filter.hide();

		video.hide();

		content.hide();

		media_edit.hide();

		video_edit.hide();

		content_edit.hide()

		added.show();

	

	});

	

	/* Add Image */	

	$('.jw-field-slider-media-listing li').live('click', function(){

		

		var container = $(this).parents('.jw-field');

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		var image_src = $(this).find('img').attr('alt');

		var thumb_src = $(this).find('img').attr('src');

		

		$(this).addClass('jw-image-added');

		

		if(added.find('img[alt="' + image_src + '"]').length < 1){

			/* Add image */

			added.append('<li><img width=75 src="' + thumb_src + '" alt="' + image_src + '" /><input type="hidden" class="jw-field-slider-slide-description"><input type="hidden" class="jw-field-slider-slide-title"><input type="hidden" class="jw-field-slider-slide-link"><input type="hidden" class="jw-field-slider-slide-link-text"><span class="jw-field-slider-action-container"><a href="#" class="jw-field-slider-action-edit"></a><a href="#" class="jw-field-slider-action-remove"></a></span></li>');

			jw_generate_slider_code(container);

		}else{

			/* Remove image */

			$(this).removeClass('jw-image-added');

			added.find('img[alt="' + image_src + '"]').parents('li').remove();

			jw_generate_slider_code(container);

		}

		

	});

	

	/* Remove image */

	$('.jw-field-slider-action-remove').live('click', function(e){

		

		e.preventDefault();

		

		var container = $(this).parents('.jw-field');

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		$(this).parents('li').remove();

		

		jw_generate_slider_code(container);

		

	});

	

	/* Edit Image OPEN */

	$('.jw-field-slider-action-edit').live('click', function(e){

		

		e.preventDefault();

		

		var container = $(this).parents('.jw-field');

		

		var switch_to_media = container.find('.jw-field-slider-switch-to-media-listing');

		var switch_to_video = container.find('.jw-field-slider-switch-to-video-add');

		var switch_to_content = container.find('.jw-field-slider-switch-to-content-add');

		var switch_to_added = container.find('.jw-field-slider-switch-to-added-listing');

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		var slide_editing = $(this).parents('li').addClass('jw-field-slider-slide-editing');

		

		if(slide_editing.hasClass('jw-field-slider-content-slide')){

		

			var content_val = slide_editing.find('.jw-field-slider-slide-content').val();

			var content_image = slide_editing.find('.jw-field-slider-slide-content-image').val();

			content_val = content_val.replace(/\(jwquote\)/g,'"');			

			content_edit.find('.jw-field-slider-slide-edit-content').val(content_val);

			content_edit.find('.jw-field-slider-slide-content-selected-image-value').attr('src', content_image).attr('alt', content_image);

		

			added.hide();

			content_edit.show();

		

		}else if(slide_editing.hasClass('jw-field-slider-video-slide')){

		

			added.hide();

			video_edit.show();

		

		}else{

		

			var title = slide_editing.find('.jw-field-slider-slide-title').val();

			var description = slide_editing.find('.jw-field-slider-slide-description').val();

			var link = slide_editing.find('.jw-field-slider-slide-link').val();

			var link_text = slide_editing.find('.jw-field-slider-slide-link-text').val();

	

			media_edit.find('.jw-field-slider-slide-edit-title').val(title);

			media_edit.find('.jw-field-slider-slide-edit-description').val(description);

			media_edit.find('.jw-field-slider-slide-edit-link').val(link);

			media_edit.find('.jw-field-slider-slide-edit-link-text').val(link_text);

			

			added.hide();

			media_edit.show();

			

		}

		

		switch_to_media.hide();

		//switch_to_video.hide();

		switch_to_content.hide();

		switch_to_added.show();

		

	});

	

	/* Edit Image SUBMIT */

	$('.jw-field-slider-media-edit-update').live('click', function(e){

		

		e.preventDefault();

		

		var container = $(this).parents('.jw-field');

		

		var switch_to_media = container.find('.jw-field-slider-switch-to-media-listing');

		var switch_to_video = container.find('.jw-field-slider-switch-to-video-add');

		var switch_to_content = container.find('.jw-field-slider-switch-to-content-add');

		var switch_to_added = container.find('.jw-field-slider-switch-to-added-listing');

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		var slide_editing = $('.jw-field-slider-slide-editing');

		

		var title = media_edit.find('.jw-field-slider-slide-edit-title').val();

		var description = media_edit.find('.jw-field-slider-slide-edit-description').val();

		var link = media_edit.find('.jw-field-slider-slide-edit-link').val();

		var link_text = media_edit.find('.jw-field-slider-slide-edit-link-text').val();

		

		slide_editing.find('.jw-field-slider-slide-title').val(title);

		slide_editing.find('.jw-field-slider-slide-description').val(description);

		slide_editing.find('.jw-field-slider-slide-link').val(link);

		slide_editing.find('.jw-field-slider-slide-link-text').val(link_text);

		

		switch_to_added.hide();

		switch_to_media.show();

		//switch_to_video.show();

		switch_to_content.show();

		

		media_edit.hide();

		added.show();

		

		slide_editing.removeClass('jw-field-slider-slide-editing');

		

		jw_generate_slider_code(container);

		

	});

	

	

	/* Add Content - Submit */

	$('.jw-field-slider-content-add-submit').live('click', function(e){

		

		e.preventDefault();

		

		var container = $(this).parents('.jw-field');

		

		var switch_to_media = container.find('.jw-field-slider-switch-to-media-listing');

		var switch_to_video = container.find('.jw-field-slider-switch-to-video-add');

		var switch_to_content = container.find('.jw-field-slider-switch-to-content-add');

		var switch_to_added = container.find('.jw-field-slider-switch-to-added-listing');

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		var content_val = content.find('.jw-field-slider-slide-add-content').val();

		var content_image = content.find('.jw-field-slider-slide-content-selected-image-value').attr('alt');

		

		added.append('<li class="jw-field-slider-content-slide jw-field-slider-slide-editing"><input type="hidden" class="jw-field-slider-slide-content-image"><input type="hidden" class="jw-field-slider-slide-content"><span class="jw-field-slider-action-container"><a href="#" class="jw-field-slider-action-edit"></a><a href="#" class="jw-field-slider-action-remove"></a></span></li>');

		

		$('.jw-field-slider-slide-editing .jw-field-slider-slide-content').val(content_val);

		$('.jw-field-slider-slide-editing .jw-field-slider-slide-content-image').val(content_image);

		

		switch_to_added.hide();

		switch_to_media.show();

		//switch_to_video.show();

		switch_to_content.show();

		

		content.hide();

		added.show();

		

		$('.jw-field-slider-slide-editing').removeClass('jw-field-slider-slide-editing');

		

		jw_generate_slider_code(container);

		

	});

	

	/* Edit Content SUBMIT */

	$('.jw-field-slider-content-edit-update').live('click', function(e){

		

		e.preventDefault();

		

		var container = $(this).parents('.jw-field');

		

		var switch_to_media = container.find('.jw-field-slider-switch-to-media-listing');

		var switch_to_video = container.find('.jw-field-slider-switch-to-video-add');

		var switch_to_content = container.find('.jw-field-slider-switch-to-content-add');

		var switch_to_added = container.find('.jw-field-slider-switch-to-added-listing');

		

		var media = container.find('.jw-field-slider-media-listing');

		var video = container.find('.jw-field-slider-video-add');

		var content = container.find('.jw-field-slider-content-add');

		var added = container.find('.jw-field-slider-added-listing');

		

		var media_edit = container.find('.jw-field-slider-media-edit');

		var video_edit = container.find('.jw-field-slider-video-edit');

		var content_edit = container.find('.jw-field-slider-content-edit');

		

		var slide_editing = $('.jw-field-slider-slide-editing');

		

		var content_val = content_edit.find('.jw-field-slider-slide-edit-content').val();

		var content_image = content_edit.find('.jw-field-slider-slide-content-selected-image-value').attr('src');

		

		slide_editing.find('.jw-field-slider-slide-content').val(content_val);

		slide_editing.find('.jw-field-slider-slide-content-image').val(content_image);

		

		switch_to_added.hide();

		switch_to_media.show();

		//switch_to_video.show();

		switch_to_content.show();

		

		content_edit.hide();

		added.show();

		

		slide_editing.removeClass('jw-field-slider-slide-editing');

		

		jw_generate_slider_code(container);

		

	});

	

	/* ---------------------------------------------------------------------------------------

		Slider Slide Content Images

	----------------------------------------------------------------------------------------*/

	

	/* Show the choose image container */

	$('.jw-field-slider-slide-content-open-choose-image').live('click', function(e){

		

		e.preventDefault();

		

		var container = $(this).parents('.jw-field');

		

		var choose_image_container = container.find('.jw-field-slider-slide-content-choose-image');

		var selected_image_container = container.find('.jw-field-slider-slide-content-selected-image');

		

		selected_image_container.fadeOut(500, function(){

			

			choose_image_container.fadeIn(500);

			

		});

		

	});

	

	/* Choose image */

	$('.jw-field-slider-slide-content-choose-image ul li').live('click', function(){

		

		var container = $(this).parents('.jw-field');

		

		var choose_image_container = container.find('.jw-field-slider-slide-content-choose-image');

		var selected_image_container = container.find('.jw-field-slider-slide-content-selected-image');

		

		var image_url = $(this).find('img').attr('alt');

		var thumb_url = $(this).find('img').attr('src');

		

		container.find('.jw-field-slider-slide-content-selected-image-value').attr('src', thumb_url);

		container.find('.jw-field-slider-slide-content-selected-image-value').attr('alt', image_url);

		

		choose_image_container.fadeOut(500, function(){

			selected_image_container.fadeIn(500);

		});

		

		

	});

	

	

	

	

});