//廣告的使用規則 adimgsrcary:放置圖片陣列  adnameary:廣告詞陣列 adlinkary=超連結陣列
//adimg:廣告圖 adname:廣告名 adlink:超連結
//載入ad.js並將所需變更圖片id設為showimg,文字id設為showname即可顯示廣告ad效果
$(function(){
	setInterval(ad,3000)  //每隔N秒換圖,直接呼叫function即可
});
var adindex=0; //目前的索引
var adimg,adname,adlink;//取得目前的圖檔，對應的產品名稱
//圖片
var adimgsrcary=new Array("slider1.jpg","slider2.jpg","slider3.jpg","slider4.jpg",
	"slider5.jpg","slider6.jpg","slider7.jpg");
//名稱
var adnameary=new Array("HTC 10","HTC U11","HTC U12","HTC U11 eyes");
var adlinkary=new Array("https://www.htc.com/tw/smartphones/htc-10/",
	"https://www.htc.com/tw/smartphones/htc-u11/",
	"https://www.htc.com/tw/smartphones/htc-u12-plus/",
	"https://www.htc.com/tw/smartphones/htc-u11-eyes/");

function ad(){//廣告
	adindex--;
	if(adindex<0){adindex=3}
		adimg="images/"+adimgsrcary[adindex];//取得目前產品圖片
		adname=adnameary[adindex] //取得目前產品文字
		adlink=adlinkary[adindex]//取得超連結
		$("#showimg").attr("src",adimg);//動態顯示圖片 attr取代裡面的變數 src換成setSrc
		$("#showname").text(adname);//動態顯示文字
		$("#showlink").attr("href",adlink);//超連結
}