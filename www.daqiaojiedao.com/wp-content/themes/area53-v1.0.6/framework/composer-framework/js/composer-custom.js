/* ---------------------------------------------------------------------------------------------------

	

	JavaScript for Content Composer

	

--------------------------------------------------------------------------------------------------- */



/* Sorting - TinySort */

(function(b){var o=!1,d=null,u=parseFloat,j=String.fromCharCode,q=Math.min,l=/(-?\d+\.?\d*)$/g,g,a=[],h,m,t=9472,f={},c;if(!Array.indexOf){Array.prototype.indexOf=function(w){for(var v=0,s=this.length;v<s;v++){if(this[v]==w){return v}}return -1}}for(var p=32,k=j(p),r=255;p<r;p++,k=j(p).toLowerCase()){if(a.indexOf(k)!==-1){a.push(k)}}a.sort();b.tinysort={id:"TinySort",version:"1.3.27",copyright:"Copyright (c) 2008-2012 Ron Valstar",uri:"http://tinysort.sjeiti.com/",licenced:{MIT:"http://www.opensource.org/licenses/mit-license.php",GPL:"http://www.gnu.org/licenses/gpl.html"},defaults:{order:"asc",attr:d,data:d,useVal:o,place:"start",returns:o,cases:o,forceStrings:o,sortFunction:d,charOrder:g}};b.fn.extend({tinysort:function(V,L){if(V&&typeof(V)!="string"){L=V;V=d}var T=b.extend({},b.tinysort.defaults,L),v,Q=this,z=b(this).length,ae={},W=!(!V||V==""),H=!(T.attr===d||T.attr==""),ah=T.data!==d,J=W&&V[0]==":",C=J?Q.filter(V):Q,F=T.sortFunction,s=T.order=="asc"?1:-1,P=[];if(T.charOrder!=g){g=T.charOrder;if(!T.charOrder){m=false;t=9472;f={};c=h=d}else{h=a.slice(0);m=false;for(var S=[],B=function(i,ai){S.push(ai);f[T.cases?i:i.toLowerCase()]=ai},N="",X="z",aa=g.length,ac,Z,ad=0;ad<aa;ad++){var x=g[ad],ab=x.charCodeAt(),I=ab>96&&ab<123;if(!I){if(x=="["){var D=S.length,M=D?S[D-1]:X,w=g.substr(ad+1).match(/[^\]]*/)[0],R=w.match(/{[^}]*}/g);if(R){for(ac=0,Z=R.length;ac<Z;ac++){var O=R[ac];ad+=O.length;w=w.replace(O,"");B(O.replace(/[{}]/g,""),M);m=true}}for(ac=0,Z=w.length;ac<Z;ac++){B(M,w[ac])}ad+=w.length+1}else{if(x=="{"){var G=g.substr(ad+1).match(/[^}]*/)[0];B(G,j(t++));ad+=G.length+1;m=true}else{S.push(x)}}}if(S.length&&(I||ad===aa-1)){var E=S.join("");N+=E;b.each(E,function(i,ai){h.splice(h.indexOf(ai),1)});var A=S.slice(0);A.splice(0,0,h.indexOf(X)+1,0);Array.prototype.splice.apply(h,A);S.length=0}if(ad+1===aa){c=new RegExp("["+N+"]","gi")}else{if(I){X=x}}}}}if(!F){F=T.order=="rand"?function(){return Math.random()<0.5?1:-1}:function(av,at){var au=o,am=!T.cases?n(av.s):av.s,ak=!T.cases?n(at.s):at.s;if(!T.forceStrings){var aj=am&&am.match(l),aw=ak&&ak.match(l);if(aj&&aw){var ar=am.substr(0,am.length-aj[0].length),aq=ak.substr(0,ak.length-aw[0].length);if(ar==aq){au=!o;am=u(aj[0]);ak=u(aw[0])}}}var ai=s*(am<ak?-1:(am>ak?1:0));if(!au&&T.charOrder){if(m){for(var ax in f){var al=f[ax];am=am.replace(ax,al);ak=ak.replace(ax,al)}}if(am.match(c)!==d||ak.match(c)!==d){for(var ap=0,ao=q(am.length,ak.length);ap<ao;ap++){var an=h.indexOf(am[ap]),i=h.indexOf(ak[ap]);if(ai=s*(an<i?-1:(an>i?1:0))){break}}}}return ai}}Q.each(function(ak,al){var am=b(al),ai=W?(J?C.filter(al):am.find(V)):am,an=ah?""+ai.data(T.data):(H?ai.attr(T.attr):(T.useVal?ai.val():ai.text())),aj=am.parent();if(!ae[aj]){ae[aj]={s:[],n:[]}}if(ai.length>0){ae[aj].s.push({s:an,e:am,n:ak})}else{ae[aj].n.push({e:am,n:ak})}});for(v in ae){ae[v].s.sort(F)}for(v in ae){var ag=ae[v],K=[],Y=z,af=[0,0],ad;switch(T.place){case"first":b.each(ag.s,function(ai,aj){Y=q(Y,aj.n)});break;case"org":b.each(ag.s,function(ai,aj){K.push(aj.n)});break;case"end":Y=ag.n.length;break;default:Y=0}for(ad=0;ad<z;ad++){var y=e(K,ad)?!o:ad>=Y&&ad<Y+ag.s.length,U=(y?ag.s:ag.n)[af[y?0:1]].e;U.parent().append(U);if(y||!T.returns){P.push(U.get(0))}af[y?0:1]++}}Q.length=0;Array.prototype.push.apply(Q,P);return Q}});function n(i){return i&&i.toLowerCase?i.toLowerCase():i}function e(v,x){for(var w=0,s=v.length;w<s;w++){if(v[w]==x){return !o}}return o}b.fn.TinySort=b.fn.Tinysort=b.fn.tsort=b.fn.tinysort})(jQuery);



jQuery(document).ready(function($){

	

$('.content-add_media-clone').live('click', function(e){

	e.preventDefault();

	$('#content-add_media').click();

});

	

/* Generate the content composer code */

function jw_generate_composer_code(){

		

	/* Remove possibility to change separator size */

	$('.jw-module-info-shortcode[value=separator]').parents('.jw-module').find('.jw-composer-module-size-down, .jw-composer-module-size, .jw-composer-module-size-up').hide();

		

	var composer_code = '';

	var composer_code_top = '';

	var composer_code_bottom = '';

	var module_code;

	var module_title;

	var composer_html;

	var module_atts = '';

	var module_size;

	var module_last = '';

	

	/* Go through each module and generate code */

	$('#jw-composer-content-main .jw-module').each(function(){

		

		/* Generate module attributes */

		$(this).find('.jw-module-info .jw-module-info-att').each(function(){

			

			module_att_name = $(this).attr('title');

			module_att_value = $(this).val();

			module_att_value = module_att_value.replace(/'/g,'&#39;');

			module_att_value = module_att_value.replace(/"/g,'&#34;');

			module_att_value = module_att_value.replace(/\[/g,'&#91;');

			module_att_value = module_att_value.replace(/\]/g,'&#93;');

			module_atts += ' ' + module_att_name + '=' + "'" + module_att_value + "'";

			

		});

		

		/* Generate new module_code value */

		module_title = $(this).find('.jw-module-info-title').val();

		module_shortcode = $(this).find('.jw-module-info-shortcode').val();

		module_size = $(this).find('.jw-module-info-size').val();

		module_code = '[' + module_shortcode + module_atts + ' jw_size=' + module_size + ']' + '&nbsp;' + '[/' + module_shortcode + '] ';

		

		/* Erase the atts value */

		module_atts = '';

		

		/* Determine size */

		if($(this).hasClass('last')){ module_last = '_last'; }else{ module_last = ''; }

		module_code = '[' + module_size + module_last + ' shortcode="' + module_shortcode + '" title="' + module_title + '"]' + module_code + '[/' + module_size + module_last + '] ';

		

		/* Add the new module code to the complete code */

		composer_code += module_code;

		

	});

	

	/* Go through each module and generate code */

	$('#jw-composer-content-top .jw-module').each(function(){

		

		/* Generate module attributes */

		$(this).find('.jw-module-info .jw-module-info-att').each(function(){

			

			module_att_name = $(this).attr('title');

			module_att_value = $(this).val();

			module_att_value = module_att_value.replace(/'/g,'&#39;');

			module_att_value = module_att_value.replace(/"/g,'&#34;');

			module_att_value = module_att_value.replace(/\[/g,'&#91;');

			module_att_value = module_att_value.replace(/\]/g,'&#93;');

			module_atts += ' ' + module_att_name + '=' + "'" + module_att_value + "'";

			

		});

		

		/* Generate new module_code value */

		module_title = $(this).find('.jw-module-info-title').val();

		module_shortcode = $(this).find('.jw-module-info-shortcode').val();

		module_size = $(this).find('.jw-module-info-size').val();

		module_code = '[' + module_shortcode + module_atts + ' jw_size=' + module_size + ']' + '&nbsp;' + '[/' + module_shortcode + '] ';

		

		/* Erase the atts value */

		module_atts = '';

		

		/* Determine size */

		if($(this).hasClass('last')){ module_last = '_last'; }else{ module_last = ''; }

		module_code = '[' + module_size + module_last + ' shortcode="' + module_shortcode + '" title="' + module_title + '"]' + module_code + '[/' + module_size + module_last + '] ';

		

		/* Add the new module code to the complete code */

		composer_code_top += module_code;

		

	});

	

	/* Go through each module and generate code */

	$('#jw-composer-content-bottom .jw-module').each(function(){

		

		/* Generate module attributes */

		$(this).find('.jw-module-info .jw-module-info-att').each(function(){

			

			module_att_name = $(this).attr('title');

			module_att_value = $(this).val();

			module_att_value = module_att_value.replace(/'/g,'&#39;');

			module_att_value = module_att_value.replace(/"/g,'&#34;');

			module_att_value = module_att_value.replace(/\[/g,'&#91;');

			module_att_value = module_att_value.replace(/\]/g,'&#93;');

			module_atts += ' ' + module_att_name + '=' + "'" + module_att_value + "'";

			

		});

		

		/* Generate new module_code value */

		module_title = $(this).find('.jw-module-info-title').val();

		module_shortcode = $(this).find('.jw-module-info-shortcode').val();

		module_size = $(this).find('.jw-module-info-size').val();

		module_code = '[' + module_shortcode + module_atts + ' jw_size=' + module_size + ']' + '&nbsp;' + '[/' + module_shortcode + '] ';

		

		/* Erase the atts value */

		module_atts = '';

		

		/* Determine size */

		if($(this).hasClass('last')){ module_last = '_last'; }else{ module_last = ''; }

		module_code = '[' + module_size + module_last + ' shortcode="' + module_shortcode + '" title="' + module_title + '"]' + module_code + '[/' + module_size + module_last + '] ';

		

		/* Add the new module code to the complete code */

		composer_code_bottom += module_code;

		

	});

	

	composer_html = composer_code;

	composer_html_top = composer_code_top;

	composer_html_bottom = composer_code_bottom;

	

	/* Set new value for the composer value (custom field) */

	

	$('#jw_composer_main_frontend').val(composer_code);

	$('#jw_composer_main_backend').val(composer_html);

	$('#jw-composer-menu-export-main-textarea').val(composer_html);

	

	$('#jw_composer_top_frontend').val(composer_code_top);

	$('#jw_composer_top_backend').val(composer_html_top);

	$('#jw-composer-menu-export-top-textarea').val(composer_html_top);

	

	$('#jw_composer_bottom_frontend').val(composer_code_bottom);

	$('#jw_composer_bottom_backend').val(composer_html_bottom);

	$('#jw-composer-menu-export-bottom-textarea').val(composer_html_bottom);

	

}/* end jw_generate_composer_code() */

	

/* ---------------------------------------------------------------------------------------------------

	BUTTON SWITCH

--------------------------------------------------------------------------------------------------- */

	

	/* Add the switch button */

	if($('input#post_type').val() != 'jw_testimonials' && $('input#post_type').val() != 'jw_staff'){

		$('div#titlediv').after('<p class="composer-switch"><a href="#" class="switch-to-composer button-primary">Switch to composer</a></p>');

	}

	

	/* Switch to composer */

	$('.switch-to-composer').live('click', function(e){

		

		e.preventDefault();

		

		$('#postdivrich').hide();

		$('#jw_page_metabox_compose').show();

		

		$('#jw_page_metabox_compose').find('input.real-value').val('active');

		

		$(this).html('Switch to classic').removeClass('switch-to-composer').addClass('switch-to-classic');

		

		$('#jw_composer_status').val('active');

		

		jw_composer_menu_height_fix();

		

		jw_composer_size();

		

	});



	/* Determine status on load */

	var composer_status = $('#jw_composer_status').val();

	if(composer_status == 'active'){ $('.switch-to-composer').click(); }

	

	/* Switch to classic */

	$('.switch-to-classic').live('click', function(e){

		

		e.preventDefault();

		

		$('#jw_page_metabox_compose').hide();

		$('#postdivrich').show();

		

		$('#jw_page_metabox_compose').find('input.real-value').val('inactive');

		

		$(this).html('Switch to composer').removeClass('switch-to-classic').addClass('switch-to-composer');

		

		$('#jw_composer_status').val('inactive');

		

	});

	

	/* Switch to composer if it's active */

	if($('#jw_page_metabox_compose').find('input.real-value').val() == 'active'){

		$('.switch-to-composer').click();

	}



/* ---------------------------------------------------------------------------------------------------

	Composer layout

--------------------------------------------------------------------------------------------------- */	

	

	function jw_composer_layout(){

		

		var current_layout = $('#jw_layout').val();

		

		if(current_layout == 'layout_cs' || current_layout == 'layout_sc'){

			

			$('.jw-composer-sidebar-module').show();

			

			if(current_layout == 'layout_cs'){

				

				$('.jw-composer-sidebar-module').css({ 'float' : 'right' });

				

			}else{

				

				$('.jw-composer-sidebar-module').css({ 'float' : 'left' });

				

			}

			

			$('#jw-composer-content-main .jw-module').each(function(){

				

				if($(this).find('.jw-module-info-size').val() == 'three_fourth'){

					

					$(this).find('.jw-composer-module-size-down').click();

					

				}

				

				if($(this).find('.jw-module-info-size').val() == 'one_one'){

					

					$(this).find('.jw-composer-module-size-down').click();

					$(this).find('.jw-composer-module-size-down').click();

					

				}

				

			});

			

		}else{

		

			$('.jw-composer-sidebar-module').hide();

			

			$('.jw-module').each(function(){

				

				if($(this).find('.jw-module-info-size').val() == 'two_third' && $(this).find('.jw-module-info-title').val() == 'Separator'){

					$(this).find('.jw-composer-module-size-up').click();

					$(this).find('.jw-composer-module-size-up').click();

				}

				

			});

		

		}

		

		jw_generate_composer_code();

		

	}

	

	jw_composer_layout();

	

	$('#jw_layout').change(function(){

		

		jw_composer_layout();

		

	});



/* ---------------------------------------------------------------------------------------------------

	Module add

--------------------------------------------------------------------------------------------------- */



	$('#jw-composer-modules li a').live('click', function(e){

		

		e.preventDefault();

		

		var module_title = $(this).parent().find('input.jw-module-info-title').val();

		var module_info = $(this).parent().find('.jw-module-info').html();

		var module_size = $(this).parent().find('input.jw-module-info-size').val();

		var layout = $('#jw_layout').val();

		

		if(module_size == 'one_one'){

			

			var li_class = 'jw-one-one';

			var size_text = '1/1';

			

		}else if(module_size == 'one_half'){

			

			var li_class = 'jw-one-half';

			var size_text = '1/2';

			

		}else if(module_size == 'two_third'){

			

			var li_class = 'jw-two-third';

			var size_text = '2/3';

			

		}

		

		$('#jw-composer-content-main').append('<li class="latest-added ' + li_class + ' jw-module"><div class="jw-composer-inner"><div class="jw-composer-inner-module"><a href="#" class="jw-composer-module-size-down"></a><span class="jw-composer-module-size">' + size_text + '</span><a href="#" class="jw-composer-module-size-up"></a><span class="jw-composer-module-title">' + module_title + '</span><a href="#" class="jw-composer-module-remove"></a><a href="#" class="jw-composer-module-edit"></a></div><div class="jw-composer-inner-confirm-remove"><a href="#" class="jw-composer-module-cancel-remove">Cancel</a> - <a href="#" class="jw-composer-module-confirm-remove">Confirm</a></div></div><div class="jw-module-info">' + module_info + '</div></li>');

		

		if(module_title == 'Separator' && (layout == 'layout_cs' || layout == 'layout_sc')){

			$('.latest-added .jw-composer-module-size-down').click();

			$('.latest-added .jw-composer-module-size-down').click();

		}

		

		$('.latest-added').removeClass('latest-added');

		

		/* Fix sidebar height */

		$('.jw-composer-sidebar-module').height($('#jw-composer-content-main').height());

		

		jw_composer_module_last();

		jw_composer_size();

		

	});

	

/* ---------------------------------------------------------------------------------------------------

	Module size increase & decrease

--------------------------------------------------------------------------------------------------- */

	

	function jw_composer_module_last(){

		

		var module;

		var module_width;

		var module_width_sum = 0;

		var module_width_total_min = 9.9;

		var module_width_total_max = 10.1;

		

		var current_layout = $('#jw_layout').val();

		if(current_layout != 'layout_c'){ module_width_total_min = 6.55; module_width_total_max = 6.75; }

		

		$('#jw-composer-content-main .jw-module').each(function(){

					

			module = $(this);

		

			if(module.is('.jw-one-one')){

				

				module_width = 10;

				

			}else if(module.is('.jw-three-fourth')){

			

				module_width = 7.5;

			

			}else if(module.is('.jw-two-third')){

				

				module_width = 6.66;

				

			}else if(module.is('.jw-one-half')){

				

				module_width = 5;

				

			}else if(module.is('.jw-one-third')){

				

				module_width = 3.33;

				

			}else if(module.is('.jw-one-fourth')){

			

				module_width = 2.5;

			

			}else{

				

				module_width = 0;

				

			}

			

			module_width_sum += module_width;

			

			module.removeClass('last');

			

			if(module_width_sum > module_width_total_min && module_width_sum < module_width_total_max){

				

				module.addClass('last');

				module_width_sum = 0;

				

			}else if(module_width_sum > module_width_total_max){

				

				module_width_sum = module_width;

				

			}			

			

		});

		

		module_width_total_min = 9.9;

		module_width_total_max = 10.1;

		module_width = 0;

		module_width_sum = 0;

		

		/* Find last columns for top area composer */

		$('#jw-composer-content-top .jw-module').each(function(){

			

			module = $(this);

		

			module_title = $(this).find('.jw-module-info-title').val();

			module_size = $(this).find('.jw-module-info-size').val();

			

			if(module_title == 'Separator' && module_size == 'two_third'){

				

				module.find('.jw-composer-module-size-up').click();

				module.find('.jw-composer-module-size-up').click();

				

			}

			

			if(module.is('.jw-one-one')){

				

				module_width = 10;

				

			}else if(module.is('.jw-three-fourth')){

			

				module_width = 7.5;

			

			}else if(module.is('.jw-two-third')){

				

				module_width = 6.66;

				

			}else if(module.is('.jw-one-half')){

				

				module_width = 5;

				

			}else if(module.is('.jw-one-third')){

				

				module_width = 3.33;

				

			}else if(module.is('.jw-one-fourth')){

			

				module_width = 2.5;

			

			}else{

				

				module_width = 0;

				

			}

			

			module_width_sum += module_width;

			

			module.removeClass('last');

			

			if(module_width_sum > module_width_total_min && module_width_sum < module_width_total_max){

				

				module.addClass('last');

				module_width_sum = 0;

				

			}else if(module_width_sum > 10.1){

				

				module_width_sum = module_width;

				

			}

			

		});

		

		module_width_total_min = 9.9;

		module_width_total_max = 10.1;

		module_width = 0;

		module_width_sum = 0;

		

		/* Find last columns for bottom area composer */

		$('#jw-composer-content-bottom .jw-module').each(function(){

			

			module = $(this);

		

			module_title = $(this).find('.jw-module-info-title').val();

			module_size = $(this).find('.jw-module-info-size').val();

		

			if(module_title == 'Separator' && module_size == 'two_third'){

				

				module.find('.jw-composer-module-size-up').click();

				module.find('.jw-composer-module-size-up').click();

				

			}

		

			if(module.is('.jw-one-one')){

				

				module_width = 10;

				

			}else if(module.is('.jw-three-fourth')){

			

				module_width = 7.5;

			

			}else if(module.is('.jw-two-third')){

				

				module_width = 6.66;

				

			}else if(module.is('.jw-one-half')){

				

				module_width = 5;

				

			}else if(module.is('.jw-one-third')){

				

				module_width = 3.33;

				

			}else if(module.is('.jw-one-fourth')){

			

				module_width = 2.5;

			

			}else{

				

				module_width = 0;

				

			}

			

			module_width_sum += module_width;

			

			module.removeClass('last');

			

			if(module_width_sum > module_width_total_min && module_width_sum < module_width_total_max){

				

				module.addClass('last');

				module_width_sum = 0;

				

			}else if(module_width_sum > 10.1){

				

				module_width_sum = module_width;

				

			}

			

		});

		

		jw_generate_composer_code();

		

	}

	

	/* Decrease size */

	$('.jw-composer-module-size-down').live('click', function(e){

		

		e.preventDefault();

		

		var module = $(this).parents('li');

		var module_size_el = module.find('.jw-composer-module-size');

		

		if(module.is('.jw-one-one')){

			

			module.removeClass('jw-one-one').addClass('jw-three-fourth');

			module_size_el.html('3/4');

			module.find('.jw-module-info-size').val('three_fourth');

			

		}else if(module.is('.jw-three-fourth')){

		

			module.removeClass('jw-three-fourth').addClass('jw-two-third');

			module_size_el.html('2/3');

			module.find('.jw-module-info-size').val('two_third');

		

		}else if(module.is('.jw-two-third')){

			

			module.removeClass('jw-two-third').addClass('jw-one-half');

			module_size_el.html('1/2');

			module.find('.jw-module-info-size').val('one_half');

			

		}else if(module.is('.jw-one-half')){

			

			module.removeClass('jw-one-half').addClass('jw-one-third');

			module_size_el.html('1/3');

			module.find('.jw-module-info-size').val('one_third');

			

		}else if(module.is('.jw-one-third')){

			

			module.removeClass('jw-one-third').addClass('jw-one-fourth');

			module_size_el.html('1/4');

			module.find('.jw-module-info-size').val('one_fourth');

			

		}

		

		jw_composer_module_last();

		

	});

	

	/* Increase size */

	$('.jw-composer-module-size-up').live('click', function(e){

		

		e.preventDefault();

		

		var module = $(this).parents('li');

		var module_size_el = module.find('.jw-composer-module-size');

		var layout = $('#jw_layout').val();

		

		if(module.is('.jw-one-fourth')){

			

			module.removeClass('jw-one-fourth').addClass('jw-one-third');

			module_size_el.html('1/3');

			module.find('.jw-module-info-size').val('one_third');

			

		}else if(module.is('.jw-one-third')){

		

			module.removeClass('jw-one-third').addClass('jw-one-half');

			module_size_el.html('1/2');

			module.find('.jw-module-info-size').val('one_half');

		

		}else if(module.is('.jw-one-half')){

			

			module.removeClass('jw-one-half').addClass('jw-two-third');

			module_size_el.html('2/3');

			module.find('.jw-module-info-size').val('two_third');

			

		}else if(module.is('.jw-two-third')){

			

			if(module.parents('#jw-composer-content-top').length || module.parents('#jw-composer-content-bottom').length ||  layout == 'layout_c'){

			

				module.removeClass('jw-two-third').addClass('jw-three-fourth');

				module_size_el.html('3/4');

				module.find('.jw-module-info-size').val('three_fourth');

			

			}

			

		}else if(module.is('.jw-three-fourth')){

			

			if(module.parents('#jw-composer-content-top').length || module.parents('#jw-composer-content-bottom').length ||  layout == 'layout_c'){

			

				module.removeClass('jw-three-fourth').addClass('jw-one-one');

				module_size_el.html('1/1');

				module.find('.jw-module-info-size').val('one_one');

			

			}

			

		}

		

		jw_composer_module_last();

		

	});

	

/* ---------------------------------------------------------------------------------------------------

	Module remove

--------------------------------------------------------------------------------------------------- */

	

	$('.jw-composer-module-remove').live('click', function(e){

		

		e.preventDefault();

		var module = $(this).parents('li');

		var module_inner = module.find('.jw-composer-inner-module');

		var module_inner_confirm_remove = module.find('.jw-composer-inner-confirm-remove');

		

		module_inner.hide();

		module_inner_confirm_remove.show();

		

	});

	

	$('.jw-composer-module-cancel-remove').live('click', function(e){

		

		e.preventDefault();

		var module = $(this).parents('li');

		var module_inner = module.find('.jw-composer-inner-module');

		var module_inner_confirm_remove = module.find('.jw-composer-inner-confirm-remove');

		

		module_inner_confirm_remove.hide();

		module_inner.show();

		

	});

	

	$('.jw-composer-module-confirm-remove').live('click', function(e){

		

		e.preventDefault();

		var module = $(this).parents('li');

		

		module.animate({ opacity : 0 }, 100, function(){

			module.remove();

			jw_composer_module_last();

		});

		

	});

	

/* ---------------------------------------------------------------------------------------------------

	Module hover

--------------------------------------------------------------------------------------------------- */

	

	$('.jw-module').live('mouseover', function(){

		$(this).siblings('.jw-module').stop().animate({ opacity : 0.9 }, 200);

	}).live('mouseout', function(){

		$(this).siblings('.jw-module').stop().animate({ opacity : 1 }, 200);

	});



/* ---------------------------------------------------------------------------------------------------

	Module edit

--------------------------------------------------------------------------------------------------- */

	

	function jw_check_module_fields(module_title){

		

		if(module_title == 'slider'){

			

			var slider_type = $('#jw-composer-edit #slider_type').val();

			var slider_slides_type = $('#jw-composer-edit #slider_slides_type').val();

			var slider_post_type = $('#jw-composer-edit #slider_post_type').val();

			

			$('#jw-composer-edit .jw-field').hide(); /* Hide all the fields */

			

			$('#jw-composer-edit #field_slider_type, #jw-composer-edit #field_slider_slides_type').show(); /* Show all the ones that are shared by everything */

			

			if(slider_slides_type == 'custom'){

				

				/* If slider slides type is custom (user chooses images and content) */

				$('#jw-composer-edit #field_slider_slides').show();

				

				if(slider_type == 'slider'){

					

					/* If the slides are fetched from posts and it's a slider */

					$('#jw-composer-edit #field_slider_loop, #jw-composer-edit #field_slider_animation, #jw-composer-edit #field_slider_autoplay, #jw-composer-edit #field_slider_autoplay_bar, #jw-composer-edit #field_slider_arrows').show();

					

				}else if(slider_type == 'carousel'){

					

					/* If the slides are fetched from posts and it's a carousel */

					$('#jw-composer-edit #field_slider_loop, #jw-composer-edit #field_slider_autoplay, #jw-composer-edit #field_slider_arrows, #jw-composer-edit #field_slider_carousel_amount').show();

					

				}else if(slider_type == 'accordion'){

					

					/* If the slides are fetched from posts and it's an accordion */

					

					

				}

				

				

			}else if(slider_slides_type == 'posts'){

				

				/* If slider slides type is posts (the content is fetched from blog or portfolio posts) */

				

				$('#jw-composer-edit #field_slider_post_type, #jw-composer-edit #field_slider_post_order_by, #jw-composer-edit #field_slider_post_order, #jw-composer-edit #field_slider_post_amount').show();

				

				if(slider_post_type == 'post'){

					/* If blog posts */

					$('#jw-composer-edit #field_slider_post_blog_cats').show();

				}else if(slider_post_type == 'jw_portfolio'){

					/* If portfolio posts */

					$('#jw-composer-edit #field_slider_post_portfolio_cats').show();

				}

				

				if(slider_type == 'slider'){

					

					/* If the slides are fetched from posts and it's a slider */

					$('#jw-composer-edit #field_slider_loop, #jw-composer-edit #field_slider_animation, #jw-composer-edit #field_slider_autoplay, #jw-composer-edit #field_slider_autoplay_bar, #jw-composer-edit #field_slider_arrows').show();

					

				}else if(slider_type == 'carousel'){

					

					/* If the slides are fetched from posts and it's a carousel */

					$('#jw-composer-edit #field_slider_loop, #jw-composer-edit #field_slider_autoplay, #jw-composer-edit #field_slider_arrows, #jw-composer-edit #field_slider_carousel_amount').show();

					

				}else if(slider_type == 'accordion'){

					

					/* If the slides are fetched from posts and it's an accordion */

					

					

				}

				

			}

			

		}

		

	}

	

	$('#jw-composer-edit #slider_type, #jw-composer-edit #slider_slides_type, #jw-composer-edit #slider_post_type').live('change', function(){ 

		var module = $('.jw-module.editing-module'); 

		var module_title = module.find('input.jw-module-info-shortcode').val(); 

		jw_check_module_fields(module_title); 

	});

	

	$('.jw-composer-module-edit').live('click', function(e){

	

		e.preventDefault();

		

		$('#jw-composer-edit-loading').show();

		

		var module = $(this).parents('.jw-module');

		var module_title = module.find('input.jw-module-info-shortcode').val();

		var ajax_composer_path = $('#jw-composer-ajax-path').val();

		ajax_composer_path += '?module=' + module_title;

		

		$('.editing-module').removeClass('editing-module');

		module.addClass('editing-module');

		

		$('#jw-composer-modules, #jw-composer-content').fadeOut(200, function(){

			

			$('#jw-composer-edit').fadeIn(200, function(){

				

				$('#jw-composer-edit-content').load(ajax_composer_path, function() {

					

					/* Go through each option and populate values if not default */

					$('#jw-composer-edit .jw-form-field').each(function(){

						

						var option_id = $(this).attr('id');

						var option_value_real = $('.editing-module .jw-module-info-' + option_id).val();

						var option_value_default = $(this).val();

						

						if(option_value_real != option_value_default){

							

							if(option_id == 'icon'){

								$('.jw-field-service-icons li').find('img[alt="' + option_value_real + '"]').parents('li').addClass('jw-field-service-icon-active');

							}

							

							if(option_id == 'slider_slides'){

								

								var ajax_composer_path_2 = $('#jw-composer-ajax-path').val();

								ajax_composer_path_2 += '?action=slider_slides';

								

								$.ajax({

									type: "POST",

									url: ajax_composer_path_2,

									data: { val: option_value_real }

								}).done(function( msg ) {

									$('#jw-composer-edit-content .jw-field-slider-added-listing').html(msg);

									$('#jw-composer-edit-content .jw-field-slider-added-listing').each(function(){

										

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

									

								});

								

							}

							

							$(this).val(option_value_real);

							

						}

						

						if(option_id == 'slider_slides'){

							

							/* Hide all */

							$('#jw-composer-edit-content .jw-field-slider-media-listing li').hide().addClass('jw-field-slider-media-listing-fits-criteria');

							

							/* Load first batch */

							$('#jw-composer-edit-content .jw-field-slider-media-listing li').slice(0, 40).show().each(function(){

								

								var the_image = $(this).find('img');

								var the_image_src = the_image.closest('li').data('src');

								the_image.attr('src', the_image_src);

								

							});

							

							/* Filter */

							$('#jw-composer-edit-content .jw-field-slider-media-listing-filter input').keyup(function(){

								

								var filter_min_width = $('.jw-field-slider-media-listing-filter-width').val();

								var filter_min_height = $('.jw-field-slider-media-listing-filter-height').val();

								var filter_title = $('.jw-field-slider-media-listing-filter-title').val().toLowerCase();

								

								$('.jw-field-slider-media-listing li').hide().removeClass('jw-field-slider-media-listing-fits-criteria').filter(function (index) {

									if(filter_title != ''){

										var filter_real_title = $(this).data('title').toLowerCase();

										return $(this).data('width') >= filter_min_width && $(this).data('height') >= filter_min_height && filter_real_title.indexOf(filter_title) != -1;

									}else{

										return $(this).data('width') >= filter_min_width && $(this).data('height') >= filter_min_height;

									}

								}).addClass('jw-field-slider-media-listing-fits-criteria').slice(0, 40).show().each(function(){

									

									var the_image = $(this).find('img');

									var the_image_src = the_image.closest('li').data('src');

									if(the_image.attr('src') != the_image_src){

										the_image.attr('src', the_image_src);

									}

									

								});

								

								var pag_total_items = $('.jw-field-slider-media-listing li.jw-field-slider-media-listing-fits-criteria').length;

								var pag_total_pages = Math.ceil(pag_total_items / 40);



								$('.jw-field-slider-media-listing-filter-pagination-info-current').text('1');

								$('.jw-field-slider-media-listing-filter-pagination-info-total').text(pag_total_pages);

								$('.jw-field-slider-media-listing-filter-pagination').data('totalitems', pag_total_items);

								$('.jw-field-slider-media-listing-filter-pagination').data('current', '1');

								$('.jw-field-slider-media-listing-filter-pagination').data('totalpages', pag_total_pages);

								

							});

							

							/* Sort */

							$('#jw-composer-edit-content .jw-field-slider-media-listing-filter select').change(function(){

								

								var sort_order = $('.jw-field-slider-media-listing-filter-order').val();

								var sort_orderby = $('.jw-field-slider-media-listing-filter-orderby').val();

								

								$('.jw-field-slider-media-listing li').tsort({ order : sort_order, data : sort_orderby });

								

								$('#jw-composer-edit-content .jw-field-slider-media-listing-filter input:first').keyup();

								

							});

							

							/* Pagination next */

							$('.jw-field-slider-media-listing-filter-pagination-next').click(function(e){

								

								e.preventDefault();

								

								var pag = $(this).closest('.jw-field-slider-media-listing-filter-pagination');

								var pag_current_page = parseInt(pag.data('current'));

								var pag_next_page = pag_current_page + 1;

								var pag_total_items = parseInt(pag.data('totalitems'));

								var pag_total_pages = parseInt(pag.data('totalpages'));

								var pag_slice_start = (pag_next_page - 1) * 40;

								var pag_slide_end = (pag_slice_start - 1) + 41;

								

								if(pag_next_page <= pag_total_pages){

									

									$('.jw-field-slider-media-listing li').hide();

									$('.jw-field-slider-media-listing li.jw-field-slider-media-listing-fits-criteria').slice(pag_slice_start, pag_slide_end).show().each(function(){

									

										var the_image = $(this).find('img');

										var the_image_src = the_image.closest('li').data('src');

										if(the_image.attr('src') != the_image_src){

											the_image.attr('src', the_image_src);

										}

										

									});

									

									pag.data('current', pag_next_page);

									$('.jw-field-slider-media-listing-filter-pagination-info-current').text(pag_next_page);

									

								}

								

							});

							

							/* Pagination prev */

							$('.jw-field-slider-media-listing-filter-pagination-prev').click(function(e){

								

								e.preventDefault();

								

								var pag = $(this).closest('.jw-field-slider-media-listing-filter-pagination');

								var pag_current_page = parseInt(pag.data('current'));

								var pag_next_page = pag_current_page - 1;

								var pag_total_items = parseInt(pag.data('totalitems'));

								var pag_total_pages = parseInt(pag.data('totalpages'));

								var pag_slice_start = (pag_next_page - 1) * 40;

								var pag_slide_end = (pag_slice_start - 1) + 41;

								

								if(pag_next_page > 0){

									

									$('.jw-field-slider-media-listing li').hide();

									$('.jw-field-slider-media-listing li.jw-field-slider-media-listing-fits-criteria').slice(pag_slice_start, pag_slide_end).show().each(function(){

									

										var the_image = $(this).find('img');

										var the_image_src = the_image.closest('li').data('src');

										if(the_image.attr('src') != the_image_src){

											the_image.attr('src', the_image_src);

										}

										

									});

									

									pag.data('current', pag_next_page);

									$('.jw-field-slider-media-listing-filter-pagination-info-current').text(pag_next_page);

									

								}

								

							});

							

						}

						

					});

					

					jw_check_module_fields(module_title);

					

					$('#jw-composer-edit-loading').hide();

					

				});

				

			});

			

		});

		

	});



/* ---------------------------------------------------------------------------------------------------

	Module Edit - HTML5 title edit

--------------------------------------------------------------------------------------------------- */

	$('.jw-composer-module-title').keyup(function(){

		$(this).parents('.jw-module').find('.jw-module-info-title').val($(this).text());

		jw_generate_composer_code();

	});

	

/* ---------------------------------------------------------------------------------------------------

	Module Edit - Action - Close

--------------------------------------------------------------------------------------------------- */

	$('.module-edit-action-close').live('click', function(e){

		

		e.preventDefault();

		

		$('#jw-composer-edit').fadeOut(200, function(){

			

			$('#jw-composer-edit-content').html('');

			$('#jw-composer-modules, #jw-composer-content').fadeIn(200);

		

		});

		

	});

	

	

/* ---------------------------------------------------------------------------------------------------

	Module Edit - Action - Save

--------------------------------------------------------------------------------------------------- */

	$('.module-edit-action-save').live('click', function(e){

		

		e.preventDefault();

		

		/* Save */

		$('#jw-composer-edit .jw-form-field').each(function(){

						

			var option_id = $(this).attr('id');

			var option_value_old = $('.editing-module .jw-module-info-' + option_id).val();

			var option_value_new = $(this).val();

			

			if(option_value_new != option_value_old){

				

				$('.editing-module .jw-module-info-' + option_id).val(option_value_new);

				

			}

			

		});

		

		jw_generate_composer_code();

		

		/* Hide edit and show modules */

		$('#jw-composer-edit').fadeOut(200, function(){

			

			$('#jw-composer-edit-content').html('');

			$('#jw-composer-modules, #jw-composer-content').fadeIn(200);

		

		});

		

	});

	

	

/* ---------------------------------------------------------------------------------------------------

	Initiate Sortable

--------------------------------------------------------------------------------------------------- */

	$('#jw-composer-content ul').each(function(){

		var composer = $(this).parents('#jw-composer');

		$(this).sortable({

			connectWith: "#jw-composer-content ul",

			stop: function(event, ui) { jw_composer_module_last(); },

			sort: function(event, ui) { jw_composer_module_last(); },

			start: function(event, ui) { jw_composer_module_last(); },

			forcePlaceholderSize: true,

			placeholder: 'jw-composer-module-placeholder',

			items: "li:not(.jw-composer-sidebar-module)"

		});

	});	

	

/* ---------------------------------------------------------------------------------------------------

	Menu

--------------------------------------------------------------------------------------------------- */

	function jw_composer_menu_open_height_fix(){

		

		var jw_composer = $('#jw-composer');

		var jw_composer_menu = $('#jw-composer-menu');

		

		if(jw_composer.height() < 700){

			jw_composer.height(700);

		}

		

	}

	

	function jw_composer_menu_close_height_fix(){

		

		var jw_composer = $('#jw-composer');

		var jw_composer_menu = $('#jw-composer-menu');

		

		if(jw_composer.height('auto'));

	}

	

	function jw_composer_menu_height_fix(){

		

		$('#jw-composer-menu-list').height($('#jw-composer-menu-list').height()).hide();

		$('#jw-composer-menu-export').height($('#jw-composer-menu-export').height()).hide();

		$('#jw-composer-menu-import').height($('#jw-composer-menu-import').height()).hide();

		$('#jw-composer-menu-load').height($('#jw-composer-menu-load').height()).hide();

		$('#jw-composer-menu-save').height($('#jw-composer-menu-save').height()).hide();

		

	}

	

	if(composer_status == 'active'){ jw_composer_menu_height_fix(); }

	

	$('#jw-composer-menu-action').live('click', function(e){

		

		e.preventDefault();

		

		if($(this).hasClass('jw-composer-menu-action-show')){

		

			jw_composer_menu_open_height_fix();

			$('#jw-composer-menu-list').slideDown(300);

			$('#jw-composer-menu-overlay').fadeIn(300);

			$(this).removeClass('jw-composer-menu-action-show');

			$('#jw-composer-menu-export').addClass('jw-composer-menu-content-open')

		

		}else{

			

			if($('.jw-composer-menu-content-open').length){

				

				$('.jw-composer-menu-content-open').slideUp(300, function(){



					jw_composer_menu_close_height_fix();

					$('#jw-composer-menu-list').slideUp(300);

					$('#jw-composer-menu-overlay').fadeOut(300);

					$(this).removeClass('jw-composer-menu-content-open');

					

				});

				

			}else{

			

				jw_composer_menu_close_height_fix();

				$('#jw-composer-menu-list').slideUp(300);

				$('#jw-composer-menu-overlay').fadeOut(300);

			

			}

			

			$(this).addClass('jw-composer-menu-action-show');

			

		}

		

	});

	

	$('#jw-composer-menu-list a').live('click', function(e){

		

		e.preventDefault();

		

		if($('.jw-composer-menu-content-open:not(:animated)').length){

		

			var composer_menu_content_id = $(this).attr('href');

			

			$('#jw-composer-menu-import-main-textarea, #jw-composer-menu-import-top-textarea, #jw-composer-menu-import-bottom-textarea').val('');

			

			$('.jw-composer-menu-content-open').slideUp(300, function(){

				$(composer_menu_content_id).slideDown(300);

				$(this).removeClass('jw-composer-menu-content-open');

				$(composer_menu_content_id).addClass('jw-composer-menu-content-open');

			});

			

		

		}

		

	});

	

	$('#jw-composer-menu-import-action-submit').live('click', function(e){

		

		e.preventDefault();

		

		var ajax_composer_path = $('#jw-composer-ajax-path').val();

		var code = $('#jw-composer-menu-import-main-textarea').val();

		var code_top = $('#jw-composer-menu-import-top-textarea').val();

		var code_bottom = $('#jw-composer-menu-import-bottom-textarea').val();

		ajax_composer_path += '?action=import';

		

		$.ajax({

		   type: "POST",

		   url: ajax_composer_path,

		   data: { 'code_main' : code, 'code_top' : code_top, 'code_bottom' : code_bottom },

		   success: function(result){

			var codes = $.parseJSON(result);

				$('#jw-composer-content-main').html(codes.code_main);

				$('#jw-composer-content-top').html(codes.code_top);

				$('#jw-composer-content-bottom').html(codes.code_bottom);

			 jw_generate_composer_code();

		   }

		 });

		

	});

	

	/* Load our template */

	$('#jw-composer-menu-load-our li a').live('click', function(e){

		

		e.preventDefault();

		

		$('#jw-composer-menu-load-content').hide();

		$('#jw-composer-menu-load .jw-composer-menu-loader').show();

		

		var ajax_composer_path = $('#jw-composer-ajax-path').val();

		var template_id = $(this).attr('title');

		ajax_composer_path += '?action=load';

		

		$.ajax({

		   type: "POST",

		   url: ajax_composer_path,

		   data: { 'template_id' : template_id },

		   success: function(result){

				var codes = $.parseJSON(result);

				$('#jw-composer-content-main').html(codes.code_main);

				$('#jw-composer-content-top').html(codes.code_top);

				$('#jw-composer-content-bottom').html(codes.code_bottom);

				$('#jw-composer-menu-load .jw-composer-menu-loader').hide();

				$('#jw-composer-menu-load-content').show();

				$('#jw-composer-menu-action').click();

				jw_generate_composer_code();

		   }

		 });

		

	});

	

	/* Load user template */

	$('#jw-composer-menu-load-user li a.jw-load-user-template').live('click', function(e){

		

		e.preventDefault();

		

		$('#jw-composer-menu-load-content').hide();

		$('#jw-composer-menu-load .jw-composer-menu-loader').show();

		

		var ajax_composer_path = $('#jw-composer-ajax-path').val();

		var template_title = $(this).attr('title');

		ajax_composer_path += '?action=load_user_made';

		

		$.ajax({

		   type: "POST",

		   url: ajax_composer_path,

		   data: { 'template_title' : template_title },

		   success: function(result){

				var codes = $.parseJSON(result);

				$('#jw-composer-content-main').html(codes.code_main);

				$('#jw-composer-content-top').html(codes.code_top);

				$('#jw-composer-content-bottom').html(codes.code_bottom);

				$('#jw-composer-menu-load .jw-composer-menu-loader').hide();

				$('#jw-composer-menu-load-content').show();

				$('#jw-composer-menu-action').click();

				jw_generate_composer_code();

		   }

		 });

		

	});

	

	/* Remove user template */

	$('#jw-composer-menu-load-user li a.jw-remove-user-template').live('click', function(e){

		

		e.preventDefault();

		

		var ajax_composer_path = $('#jw-composer-ajax-path').val();

		var template_title = $(this).attr('title');

		ajax_composer_path += '?action=remove_user_made';

		var template = $(this).parents('li');

		

		$.ajax({

		   type: "POST",

		   url: ajax_composer_path,

		   data: { 'template_title' : template_title },

		   success: function(result){

				//var codes = $.parseJSON(result);

				template.fadeOut(200);

		   }

		 });

		

	});

	

	/* Save user template */

	$('#jw-composer-menu-save-action-submit').live('click', function(e){

		

		e.preventDefault();

		

		//$('#jw-composer-menu-load-content').hide();

		//$('#jw-composer-menu-load .jw-composer-menu-loader').show();

		

		var ajax_composer_path = $('#jw-composer-ajax-path').val();

		var template_title = $('#jw-composer-menu-save-title').val();

		var template_code_main = $('#jw_composer_main_frontend').val();

		var template_code_top = $('#jw_composer_top_frontend').val();

		var template_code_bottom = $('#jw_composer_bottom_frontend').val();

		

		ajax_composer_path += '?action=save';

		

		$.ajax({

		   type: "POST",

		   url: ajax_composer_path,

		   data: { 'title' : template_title, 'code_main' : template_code_main, 'code_top' : template_code_top, 'code_bottom' : template_code_bottom },

		   success: function(result){

				

				

				//$('#jw-composer-menu-load .jw-composer-menu-loader').hide();

				//$('#jw-composer-menu-load-content').show();

				$('#jw-composer-menu-action').click();

				//jw_generate_composer_code();

		   }

		 });

		

	});

	

	

});



function jw_composer_size(){

	

	var composer_sidebar_width = jQuery('#jw-composer-modules').outerWidth();

	var composer_width = jQuery('#jw-composer').width();

	var composer_content_width = composer_width - composer_sidebar_width - 20;

	

	jQuery('#jw-composer-content').width(composer_content_width);

	

}



jQuery(window).load(function(){

	

	jw_composer_size();

	

	jQuery(window).resize(function(){

	

		jw_composer_size();

	

	});

	

});