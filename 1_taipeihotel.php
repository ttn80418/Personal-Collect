<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>來去台北住一晚</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"  href="css/jquery.mobile-1.4.5.css">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.js"></script>
	<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-be5pwhgwxTsdF35doJEbsUw086Hbso8" type="text/javascript"></script>
	<style>
		#img{
			width: 500px;
			height: 500px;
			box-shadow: 2px 2px 2px 3px #ccc;
			margin-top: 0px;
			margin-bottom: 0px;
			margin-left: auto;
			margin-right: auto;
		}
		#showmap{
			width: 400px;
			height: 700px;
			box-shadow: 2px 2px 2px 3px #ccc;
			margin-top: 0px;
			margin-bottom: 0px;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
	<script>
		$(function(){
			$.ajax({
				type:"GET",//GET:取得資源
				url:"https://tcnr1624.000webhostapp.com/Personal_Collect/1_get_taipeihotel.php",
				dataType:"json",
				success:show,//成功時之方法,show為方法
				error:function(){//此方法為錯誤時之方法
					alert("error");
				}
			});
		});
		function show(data){
			//console.log(data.length); //用console測試有無抓到資料
		var regionTitle= new Array(); //分區名稱
		var counter= new Array();  //分區編號
		var regionData= new Array();  //分區旅館資料			
			for(var i=0; i<data.length;i++){
				getRegion=data[i]["display_addr"].substring(0,data[i]["display_addr"].indexOf("區",0)+1);//取得區的位置編號
				//substring(0,n)從第0筆開始抓取n筆字串
				if(counter[getRegion]==undefined){//設某區還沒被定義(ex松山區)則寫入
					counter[getRegion]=regionData.length;//記錄分區
					regionData.push(new Array());//新增一筆空記錄
					regionTitle[counter[getRegion]]=getRegion;//記錄分區名稱
				}//if_end
				regionData[counter[getRegion]].push(data[i]);//將資料放入
				//若已被定義則直接執行↑ 將資料放入已經記錄的分區中
			}//for_end	
			// console.log(regionTitle.length);
			// console.log(counter.length);
			// console.log(regionData.length);//以上用來測試長度是否符合資料需求
			//listview選單
			$("#output").empty();//執行前先清空listview	
			for(var i=0; i<regionTitle.length; i++){//因為裡面變數共用 所以i要宣告var
				// strHTML='<li data-icon="home"><a href="#content" >'+regionTitle[i]+'旅館資料<span class="ui-li-count">'+regionData[i].length+'</span></a></li>';
				// $("#output").append(strHTML);//將迴圈資料堆疊用append(階段一測試完成)
				var hotel_name="";
				var hotel_addr="";
				var hotel_tel="";
				var hotel_X="";
				var hotel_Y="";
				for(var j=0;j<regionData[i].length;j++){//某區旅館的間數長度
					hotel_name+= regionData[i][j]["name"]+"|";
					hotel_addr+= regionData[i][j]["display_addr"]+"|";
					hotel_tel+= regionData[i][j]["tel"]+"|";//用|分隔字串
					hotel_X+=regionData[i][j]["Y"]+"|";
					hotel_Y+=regionData[i][j]["X"]+"|";

				}//end for j
				  // console.log(hotel_name);//測試有無抓到值
				  // console.log(hotel_addr);
				  // console.log(hotel_tel);
				 strHTML='<li><a href="#hotel" regionTitle="'+regionTitle[i]+' "hotel_name="'+hotel_name+'" hotel_addr="'+hotel_addr+'" hotel_tel="'+hotel_tel+'" hotel_X="'+hotel_X+'" hotel_Y="'+hotel_Y+'" id="hotel">'+regionTitle[i]+'旅館資料<span class="ui-li-count">'+regionData[i].length+'</a></span><a href="#map" data-icon="location" regionTitle="'+regionTitle[i]+' "hotel_name="'+hotel_name+'" hotel_addr="'+hotel_addr+'" hotel_tel="'+hotel_tel+'" hotel_X="'+hotel_X+'" hotel_Y="'+hotel_Y+'" id="map"></a></li>';
				 //將資料塞入<a>中 於下一個頁面將資料載入 在某listview右鍵->按檢查就可看到
				 $("#output").append(strHTML);

			}//end for i

				 $("a",$("#output")).bind("click",function(){
				 	if($(this).attr("id")=="hotel"){
				 		getItem($(this).attr("regionTitle"),$(this).attr("hotel_name"),$(this).attr("hotel_addr"),$(this).attr("hotel_tel"),$(this).attr("hotel_X"),$(this).attr("hotel_Y"))
				 	}else if($(this).attr("id")=="map"){
				 		getmap($(this).attr("regionTitle"),$(this).attr("hotel_name"),$(this).attr("hotel_addr"),$(this).attr("hotel_tel"),$(this).attr("hotel_X"),$(this).attr("hotel_Y"))
				 	}
				 });//a是指點擊output其中一個 this:點擊當下的事件 attr:改變參數

			$("#output").listview("refresh");//★★★一定要寫此語法 listview才會重整


		}//end show(data)

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

		function getItem(regionTitle,hotel_name,hotel_addr,hotel_tel,hotel_X,hotel_Y){
			console.log("regionTitle:"+regionTitle);
			console.log(hotel_name);//測試有無抓到參數
			console.log(hotel_addr);
			console.log(hotel_tel);
			console.log(hotel_X);
			console.log(hotel_Y);

			$("#hotel_title").html(regionTitle+"飯店列表");//將標題換成對應title
			 var hotel_namearray=hotel_name.split("|");
			 var hotel_addrarray=hotel_addr.split("|");
			 var hotel_telarray=hotel_tel.split("|");
			 var hotel_Xarray=hotel_X.split("|");
			 var hotel_Yarray=hotel_Y.split("|");

		$("#output_hotel").empty();
			  for(var i=0;i<hotel_namearray.length-1;i++){
			  	//建立各區旅館資料
			  	strHTML='<li><a href="" data-addr="'+hotel_addrarray[i]+'"><h3>'+hotel_namearray[i]+'</h3><p>'+hotel_addrarray[i]+'</p><p>'+hotel_telarray[i]+'</p></a></li>';
			  	$("#output_hotel").append(strHTML);
			  	//<a>裡的data-addr為傳遞地址的參數,這樣才能連結各區地圖
			  }
			  	 $("a",$("#output_hotel")).bind("click",function(){
				 	searchfor($(this).attr("data-addr"));
				 });
			  $("#output_hotel").listview("refresh");

		}//getitem end






 function getmap(regionTitle,hotel_name,hotel_addr,hotel_tel,hotel_X,hotel_Y){
			 var hotel_namearray=hotel_name.split("|");
			 var hotel_addrarray=hotel_addr.split("|");
			 var hotel_telarray=hotel_tel.split("|");
			 var hotel_Xarray=hotel_X.split("|");
			 var hotel_Yarray=hotel_Y.split("|");


	 var map=document.getElementById("showmap");//此map是div裡的map
	//取得經緯度
	var lat=hotel_Xarray[0];
	var lng=hotel_Yarray[0];
	var latlng=new google.maps.LatLng(lat,lng);
	var gmap=new google.maps.Map(map,{
		zoom:13,
		center:latlng,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	});
	var marker=[];//宣告marker為一個陣列 才能執行marker[i]
	for(i=0;i < regionTitle.length; i++){
	var lat =hotel_Xarray[i];
	var lng =hotel_Yarray[i];

	latlng=new google.maps.LatLng(lat,lng);
	 marker[i] = new google.maps.Marker({
		position:latlng,
		icon:"../images/map.png",
		map:gmap,
		title:"Hellow"
	});
	 	google.maps.event.addListener(marker[i],"click",function(event){
		var lat=event.latLng.lat();//觸碰地圖時取得的座標
		var lng=event.latLng.lng();//觸碰地圖時取得的座標

		for(j=0;j<hotel_Xarray.length;j++){
	var hotle_lat =hotel_Xarray[j];
	var hotel_lng =hotel_Yarray[j];
	var disp=getDistance(lat,lng,hotle_lat,hotel_lng);//單位:公里
	// 計算地球上兩點的距離
			if(disp<0.001){
				var infowindow = new google.maps.InfoWindow({
					content:"<div>"+hotel_namearray[j]+"<br>"+hotel_addrarray[j]+"<br>"+hotel_telarray[j]+"</div>"
				});//0.001=1公尺 若觸碰<1m就會觸發 可彈性設定
			if($('.gm-style-iw').length) {   
         	$('.gm-style-iw').parent().remove();   
     }  //一次只彈出一個視窗
			infowindow.open(gmap,marker[j]);//設定訊息視窗出現的位置	
			}//if
		}//for j end			
	});
  }//for i end

 }




	function searchfor(addr){
		window.open("http://maps.google.com/maps?hl=zh-TW&q=" + addr );//開啟新視窗
		//只要在q= 後面代入參數即可
		//https://www.google.com/maps/dir// 規劃導航 只要在//後面代入參數 ex:中彰投分署
	}

//10.02新增搜尋功能

	</script>
</head>
<body>
	<div data-role="page" id="home" >
		<div data-role="header" data-theme="b">
			<h1>來去台北住一晚</h1>
		</div>
		<div role="main" class="ui-content">
			<div id="img">
				<img src="http://fakeimg.pl/500x500/00CED1/FFF/?text=Go TO Taipei">
			</div>	
			<div>
				<ol data-role="listview" data-inset="flase" data-filter="flase" data-filter-placeholder="請輸入您要尋找旅館" id="output">
					<li>
						<a href="#content">台北市大同區旅館資料</a><span class="ui-li-count">5</span>
					</li>
				</ol>	
			</div>		
		</div>
		<div data-role="footer" data-position="fixed" data-theme="b">
		</div>
	</div>
<!-- 	page content↓ -->
		<div data-role="page" id="hotel" >
				<div data-role="header" data-theme="b">
				    <a href="#home" data-icon="back" data-role="button" >Back</a>
					<h1 id="hotel_title">旅館資料</h1>
				</div>
				<div role="main" class="ui-content">
			<div id="img">
				<img src="http://fakeimg.pl/500x500/00CED1/FFF/?text=Go TO Taipei">
			</div>
			<div>
				<ol data-role="listview" data-inset="true" id="output_hotel"  >
					<li>
						<a href="" data-addr="">
						<a href="#map" data-icon="location"></a>	
						<h3>飯店名稱</h3>
						<p>住址</p>
						<p>電話</p>							
						</a></a>
					</li>

				</ol>	
			</div>						
				</div>
				<div data-role="footer" data-position="fixed" data-theme="b">
				</div>	
			</div>
<!-- page map	 -->
		<div data-role="page" id="map" >
				<div data-role="header" data-theme="b">
					<h1>地圖分佈</h1>
				</div>
				<div role="main" class="ui-content">
					<div id="showmap"></div>
				</div>
				<div data-role="footer" data-position="fixed" data-theme="b">
				</div>	
			</div>						
</body>
</html>		