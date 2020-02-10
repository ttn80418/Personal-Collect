<?php
$ID = $_POST["ID"];
 	require_once("../dbtools.inc.php");
	$link = create_connect();

	$sql = "DELETE FROM members WHERE ID= $ID ";


	if($result = execute_sql($link, "id7769569_test_frineds", $sql)){
		echo "1";//刪除成功 
		//刪除成功自動換頁
	}else{
		echo "0";//刪除失敗
	}

?>
