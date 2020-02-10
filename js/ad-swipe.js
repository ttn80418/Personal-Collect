
//page的ID必須修正 預設ID名稱為demo-page
//使用規則 aryBookSrc 放置 廣告圖片, aryNameSrc 放置廣告台詞, arrayadlink 廣告連結
//#adimg 廣告圖片名稱  #adname廣告台詞名稱  #adlink廣告超連結
var index=0; //目前的索引
var setSrc,setName,adlink,adcontent1,adcontent2;//取得目前的圖檔，對應的產品名稱,超連結，內容
//圖片
var aryBookSrc=new Array("htc01.png","htc02.png","htc03.png");
//名稱
var aryNameSrc=new Array("HTC 10","HTC U11","HTC U12");
//超連結
var arrayadlink = new Array("http://link01", "http://link02", "http://link03", "http://link04", "http://link05", "http://link06");
//內容
var arryadcontent1 = new Array("售價:5000元","售價:10,000元","售價:15,000元");
var arryadcontent2 = new Array("相機畫素：500萬","相機畫素：800萬","相機畫素：1200萬");


// -------圖片滑動效果--------
// for home page
$( document ).on( "pagecreate", "#demo-page", function() {
    $( document ).on( "swipeleft swiperight", "#demo-page", function( e ) {
        if ( $( ".ui-page-active" ).jqmData( "panel" ) !== "open" ) {
            if ( e.type === "swipeleft" ) {
                adshowprev();//直接呼叫方法 就能轉滑動轉換圖片
            } else if ( e.type === "swiperight" ) {
                adshownext();
            }
        }
    });
}); 

function adshowprev(){//上一筆
    index--;
    if(index<0){index=2}//可循環 因陣列中是(0~2)小於0的話會在指定回給2(htc03.png)
        setSrc="images/"+aryBookSrc[index];//取得目前產品圖片
        setName=aryNameSrc[index] //取得目前產品文字
        adlink = arrayadlink[index];//取得超連結
        adcontent1=arryadcontent1[index];//內容1
        adcontent2=arryadcontent2[index];//內容2

        // $("#adimg").fadeOut(500);
        // $("#adimg").attr("src",setSrc).fadeIn(800);動態顯示圖片 attr取代裡面的變數 src換成setSrc  //fadeOut fadeIn 圖片淡入淡出效果
        $("#adimg").attr("src",setSrc);
        $("#adname").text(setName);//動態顯示文字
        $("#adlink").attr("href", adlink);//顯示超連結
        $("#adcontent1").text(adcontent1);//顯示內容1
        $("#adcontent2").text(adcontent2);//顯示內容2
}

function adshownext(){
    index++;
    if(index>2){index=0}//可循環 因陣列中是(0~2)大於2的話會在指定回給0(htc01.png)
        setSrc="images/"+aryBookSrc[index];//取得目前產品圖片
        setName=aryNameSrc[index] //取得目前產品文字
        adlink = arrayadlink[index];
        adcontent1=arryadcontent1[index];//內容1
        adcontent2=arryadcontent2[index];//內容2       
        $("#adimg").attr("src",setSrc);//動態顯示圖片
        $("#adname").text(setName);//動態顯示文字
        $("#adlink").attr("href", adlink);//顯示超連結 
        $("#adcontent1").text(adcontent1);
        $("#adcontent2").text(adcontent2);
}             


