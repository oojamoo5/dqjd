/* ---------------------------------------------------------------------------------------------------
	
	JavaScript for JW Framework
	
--------------------------------------------------------------------------------------------------- */
function load_google_font(font_name){
	
	var font = font_name + ':400,700,400italic,700italic:latin';
	
	WebFontConfig = {
		google: { families: [ font ] }
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})();
	
}


jQuery(document).ready(function($){

	var fonts_to_load = '';
	var fonts_to_load_count = 0;

	$('.jw-font-switcher-family').each(function(){
		
		if(fonts_to_load == 0){
			fonts_to_load = fonts_to_load + $(this).val();
		}else{
			fonts_to_load = fonts_to_load + '|' + $(this).val();
		}
		fonts_to_load_count = fonts_to_load_count + 1;
		
	});
	
	load_google_font(fonts_to_load);
	
	$('.jw-font-switcher-family').change(function(){
		
		load_google_font($(this).val());
		
	});
	
	/* Tabs */
	$('.jw-section:first').siblings('.jw-section').hide();
	
	$('.jw-sidebar li:first').addClass('active');
	$('.jw-sidebar li a').click(function(e){
	
		e.preventDefault();
		
		$(this).parents('li').addClass('active').siblings('.active').removeClass('active');
		
		var panel = $(this).attr('href');
		
		$(panel).show().siblings('.jw-section').hide();
		
	});
	
});

jQuery(window).load(function(){
	
	
});