<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	#allmap{
		width:445px;
		height: 500px;
	}
	</style>
</head>
<body>
<div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=xnc1LHMGyRGtmcPnHsqd0XlC"></script>
<div id="allmap"></div>
<script type="text/javascript">
	var lat = "121.540217";
	var lan = "31.282094";
	var point = new BMap.Point(lat, lan);
	// 百度地图API功能
	var map = new BMap.Map("allmap");    // 创建Map实例
	map.centerAndZoom(point, 20);
	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
	map.setCurrentCity("上海");          // 设置地图显示的城市 此项是必须设置的
	map.enableScrollWheelZoom(true); 
	 
	var marker = new BMap.Marker(point); 
	map.addOverlay(marker);               // 将标注添加到地图中
	marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
	   //开启鼠标滚轮缩放
</script>
<div>
</body>
</html>