/* ---------------------------------------------------------------------------------------------------

	

	JavaScript for JWPanel

	

--------------------------------------------------------------------------------------------------- */



jQuery(document).ready(function($){

	

	$('.colorpicker-holder').each(function(){

		

		var colorpicker = $(this);

		var colorpickerHolder = $(this).find('.colorpickerHolder');

		var colorSelector = $(this).find('.colorSelector');

		var color_value = colorpicker.find('.real-value').val();

		var field_container = colorpicker.parents('.jw-field-content');

		

		colorpickerHolder.ColorPicker({

			flat: true,

			color: color_value,

			onSubmit: function(hsb, hex, rgb) {

				colorpicker.find('.colorSelector div').css('backgroundColor', '#' + hex);

				colorpicker.find('.real-value').val('#' + hex);

				field_container.find('.jw-field-font-demo').css('color', '#' + hex);

			}

		});

		

		colorpicker.find('.colorSelector div').css('backgroundColor', color_value);

		

		colorpicker.find('.colorpickerHolder>div').css('position', 'absolute');

		var widt = false;

		colorSelector.bind('click', function() {

			colorpickerHolder.stop().animate({height: widt ? 0 : 173}, 500);

			if( widt ){ colorpicker.removeClass('colopicker-shown'); }else{ colorpicker.addClass('colopicker-shown'); }

			widt = !widt;

		});

		

	});

	

	

	$('.jw-font-switcher-size').change(function(){

		

		$(this).parents('.jw-field').find('.jw-field-font-demo').css({ 'font-size' : $(this).val() });

		

	});

	

	$('.jw-font-switcher-line-height').change(function(){

		

		$(this).parents('.jw-field').find('.jw-field-font-demo').css({ 'line-height' : $(this).val() });

		

	});

	

	$('.jw-font-switcher-family').change(function(){

		

		var font = $(this).val();

		

		font = font.replace('+', ' ')

		

		$(this).parents('.jw-field').find('.jw-field-font-demo').css({ 'font-family' : font });

		

	});

	

	$('.jw-font-switcher-style').change(function(){

		

		var demo_font_style = '';

		var demo_font_weight = '';

		var demo_font_value = $(this).val();

		

		if(demo_font_value == 'italic'){

			demo_font_style = 'italic';

		}else if(demo_font_value == 'bold'){

			demo_font_weight = 'bold';

		}else if(demo_font_value == 'bold+italic'){

			demo_font_style = 'italic';

			demo_font_weight = 'bold';

		}

		

		$(this).parents('.jw-field').find('.jw-field-font-demo').css({ 'font-style' : demo_font_style, 'font-weight' : demo_font_weight });

		

	});

	// For theme options upload
	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;

	$('.jw-file-uploader').click(function(e) {
		
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var id = button.attr('id').replace('_button', '');
		_custom_media = true;
		
		wp.media.editor.send.attachment = function(props, attachment){
			button.siblings('.jw-file-uploader-real-value').val(attachment.url);
			button.siblings('img').attr('src', attachment.url);
		}

		wp.media.editor.open(button);
		return false;

	});

	$('.add_media').on('click', function(){
		_custom_media = false;
	});

	

});