
$(function(){
	setInterval(showprev,2000)  //每隔N秒換圖,直接呼叫function即可
	$('#showprev').bind('click',showprev); //上一筆 ('#showprev')類似findviewbyID
	$('#shownext').bind('click',shownext);//下一筆bind('click',shownext)宣告監聽
});
var index=0; //目前的索引
var setSrc,setName//取得目前的圖檔，對應的產品名稱
//圖片
var aryBookSrc=new Array("slider1.jpg","slider2.jpg","slider3.jpg","slider4.jpg",
	"slider5.jpg","slider6.jpg","slider7.jpg");
//名稱
var aryNameSrc=new Array("HTC 10","HTC U11","HTC U12");

function showprev(){//上一筆
	index--;
	if(index<0){index=2}//可循環 因陣列中是(0~2)小於0的話會在指定回給2(htc03.png)
		setSrc="images/"+aryBookSrc[index];//取得目前產品圖片
		setName=aryNameSrc[index] //取得目前產品文字
		$("#himg").attr("src",setSrc);//動態顯示圖片 attr取代裡面的變數 src換成setSrc
		$("#hname").text(setName);//動態顯示文字
}

function shownext(){//下一筆
	index++;
	if(index>2){index=0}//可循環 因陣列中是(0~2)大於2的話會在指定回給0(htc01.png)
		setSrc="images/"+aryBookSrc[index];//取得目前產品圖片
		setName=aryNameSrc[index] //取得目前產品文字
		$("#himg").attr("src",setSrc);//動態顯示圖片
		$("#hname").text(setName);//動態顯示文字		
}

//--------rightPanel裡的logo轉換動畫------
$(function(){
	setInterval(logonext,2000)  //每隔N秒換圖,直接呼叫function即可
	$('#logonext').bind('click',logonext);//下一筆bind('click',shownext)宣告監聽
});
var indexlogo=0; //目前的索引
var setLogo//取得目前的圖檔，對應的產品名稱
//圖片
var aryBookLogo=new Array("htclogo.png","htclogo2.png","htclogo3.png");

function logonext(){//下一筆
	indexlogo++;
	if(indexlogo>2){indexlogo=0}//可循環 因陣列中是(0~2)大於2的話會在指定回給0(htc01.png)
		setLogo="images/"+aryBookLogo[indexlogo];//取得目前產品圖片
		$("#logoimg").attr("src",setLogo);//動態顯示圖片	
}
