
var qqKefuTO = window.setTimeout(function(){

	jQuery("#qqkefuDv").hover(function(){
		if(isLeft=="left"){ 
			jQuery(this).stop().animate({"left":"0"});
		}else{
			jQuery(this).stop().animate({"right":"0"});
		}
	},function(){
		if(isIn){
			if(isLeft=="left"){
				jQuery(this).stop().animate({"left":"-87"});
			}else{
				jQuery(this).stop().animate({"right":"-87"});
			}
		}
		
	});
	},1000);
