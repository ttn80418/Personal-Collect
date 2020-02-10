<?php
header("Access-Control-Allow-Origin:*");
$url='http://data.coa.gov.tw/Service/OpenData/ODwsv/ODwsvTravelFood.aspx';
$content= file_get_contents($url);//單純將網頁的json檔轉成文字!!
echo $content;
?>