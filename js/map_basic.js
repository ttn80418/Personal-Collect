// For 地圖地標基本語法
// 一次只顯示一個infowindow 此法話貼在infowindow.open之上
// if($('.gm-style-iw').length) {   
//  $('.gm-style-iw').parent().remove();   
// }   
$(function(){
	//設定地圖中心點
	var map=document.getElementById("map");//此map是div裡的map
	//取得經緯度
	var lat=24.170566;
	var lng=120.609932;
	var latlng=new google.maps.LatLng(lat,lng);
	var gmap=new google.maps.Map(map,{
		zoom:15,//設定縮放比例 愈大愈近
		center:latlng,//設定中心點經緯度 必須為LatLng型態
		mapTypeId:google.maps.MapTypeId.ROADMAP//ROADMAP:2D街景地圖
		//HYBRID:衛星&街景混合 TERRAIN:顯示高度,山峰,河流 SATELLITE:衛星地圖	
	});

	var marker= new google.maps.Marker({
		position:latlng,//旗標的位置
		icon:"images/map.png",//旗標的icon
		map:gmap,
		title:"Hellow"	
	});

	//給與標記一個訊息視窗
		google.maps.event.addListener(marker,"click",function(event){
	var infowindow = new google.maps.InfoWindow({
		content:'<div><img src=images/wow.jpg alt="" width="49%"></div><p><div id= msg> Somewhere!!!! </div>',
		});
	infowindow.open(gmap,marker);//設定訊息視窗出現的位置
		});	
});//end