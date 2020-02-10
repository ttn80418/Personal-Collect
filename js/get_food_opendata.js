// 利用OpenData取得資料在地圖上建立相關圖標
$(function(){
	$.ajax({
	type:"GET",//GET:取得資源
	url:"https://tcnr1624.000webhostapp.com/Personal_Collect/2_get_food_open_data.php",
	dataType:"json",
	success:show,//成功時之方法,show為方法
	error:function(){//此方法為錯誤時之方法
	alert("error");
		}
	});
});
function show(data){
//設定地圖中心點
	//alert(data.length);
	//alert(data[0].Coordinate);//印出經緯度
	// parray=data[0].Coordinate.split(",");
	// alert(parray[0]);
	var map=document.getElementById("map");//此map是div裡的map
	//取得經緯度
	var lat=24.1629258;
	var lng=120.638215;
	var latlng=new google.maps.LatLng(lat,lng);
	var gmap=new google.maps.Map(map,{
	zoom:8,//設定縮放比例 愈大愈近
	center:latlng,//設定中心點經緯度 必須為LatLng型態
	mapTypeId:google.maps.MapTypeId.ROADMAP//ROADMAP:2D街景地圖
	//HYBRID:衛星&街景混合 TERRAIN:顯示高度,山峰,河流 SATELLITE:衛星地圖		
	});
// 利用for迴圈重複執行google.maps.Marker，同時必須改變position的值
	var marker=[];//宣告marker為一個陣列 才能執行marker[i]
	for(i=0;i < data.length; i++){
	pArray= data[i].Coordinate.split(",");

	latlng=new google.maps.LatLng(pArray[0],pArray[1]);
	marker[i] = new google.maps.Marker({
	position:latlng,
	icon:"../images/small_map.png",
	map:gmap,
	title:"Hellow"
});
google.maps.event.addListener(marker[i],"click",function(event){
	var lat=event.latLng.lat();//觸碰地圖時取得的座標
	var lng=event.latLng.lng();//觸碰地圖時取得的座標

	for(j=0;j<data.length;j++){
	pArray= data[j].Coordinate.split(",");
	var disp=getDistance(lat,lng,pArray[0],pArray[1]);//單位:公里
// 計算地球上兩點的距離
	if(disp<0.001){
		var infowindow = new google.maps.InfoWindow({
			content:'<div><img src="'+data[j].PicURL+'"alt=""width="49%"><br></div><p>'+data[j].Name+"</p>"+data[j].Address
		});//0.001=1公尺 若觸碰<1m就會觸發 可彈性設定
	infowindow.open(gmap,marker[j]);//設定訊息視窗出現的位置	
	if($('.gm-style-iw').length) {   
 	$('.gm-style-iw').parent().remove();   
		} //只顯示一個infowindow視窗  
	infowindow.open(gmap,marker[j]);
	infowindow.open(gmap,marker[j]);
		}//if
	 }//for j end		
   });
  }//for i end
}  
function getDistance(Lat1, Long1, Lat2, Long2){
ConvertDegreeToRadians=function(degrees){
	return (Math.PI/180)*degrees;} 
var Lat1r = ConvertDegreeToRadians(Lat1);
var Lat2r = ConvertDegreeToRadians(Lat2); 
var Long1r = ConvertDegreeToRadians(Long1); 
var Long2r = ConvertDegreeToRadians(Long2);

var R = 6371; // 地球半徑(km) 
var d = Math.acos(Math.sin(Lat1r) * Math.sin(Lat2r) +
	 Math.cos(Lat1r) * Math.cos(Lat2r) * Math.cos(Long2r-Long1r)) * R; 
		return d;
} // 兩點的距離 (KM)