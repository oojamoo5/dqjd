var addQQ = '<li style="border:1px solid red">客服QQ  标题<input name="qqTitle[]"> QQ号码<input class="large-text code" id="QQ_1" style="width:126px" name="qq[]"  ></li>';

var addWang = '<li style="border:1px solid red">旺旺号:<input name="wangwang[]"> </li>';
var addWangInter = '<li style="border:1px solid blue">旺旺号:<input name="wangwangInter[]"> 客服名称:<input name="wangwangInterTitles[]"> </li>';
$(function(){
    $("#btnAddQQ").click(function(){
            $("#qqLi").append(addQQ);
     })
     
     $(".btnDelQQ").click(function(){
            $(this).parents("li").remove();
     })
	 
	   $("#btnAddWang").click(function(){
            $("#wangwangLi").append(addWang);
     })
	   
	   $("#btnAddwangwangInter").click(function(){
            $("#wangwangInterLi").append(addWangInter);
     })
	 
	 $("#updateInfo").click(function(){
		$("#updateInfoDiv").slideToggle("slow");
	 })
	
	
})

 jQuery(document).ready(function(){
		jQuery('.rm_options').slideUp();
		
		jQuery('.qqkefu_section h3').click(function(){		
			if(jQuery(this).parent().next('.rm_options').css('display')=='none')
				{	jQuery(this).removeClass('inactive');
					jQuery(this).addClass('active');
					jQuery(this).children('img').removeClass('inactive');
					jQuery(this).children('img').addClass('active');
					
				}
			else
				{	jQuery(this).removeClass('active');
					jQuery(this).addClass('inactive');		
					jQuery(this).children('img').removeClass('active');			
					jQuery(this).children('img').addClass('inactive');
				}
				
			jQuery(this).parent().next('.rm_options').slideToggle('slow');	
		});
});