<?php
	function create_connect(){
		$link = mysqli_connect("localhost", "id7769569_tcnr24", "123456") or die("建立連線失敗".mysqli_connect_error());

		//mysqli_query($link, "SET NAMES UTF8");

		return $link;
	}

	function execute_sql($link, $dbname, $sql){
		mysqli_select_db($link, $dbname) or die("連接資料庫失敗".mysqli_connect_error());

		$result = mysqli_query($link, $sql);
		return $result;
	}

?>