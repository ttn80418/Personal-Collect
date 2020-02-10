<?php
session_start();

if(isset($_POST["username"])){
	$Username = $_POST["username"];
	$Password = $_POST["password"];  	
}

require_once("../dbtools.inc.php");
$link = create_connect();

//測試帳號密碼是否正確
//$sql = "SELECT * FROM members WHERE Username = 'Allen' AND Password = '123456' ";
$sql = "SELECT * FROM members WHERE Username = '$Username' AND Password = '$Password' ";


	$result=execute_sql($link, "id7769569_test_frineds", $sql);
	if(mysqli_num_rows($result) ==1){
		$_SESSION["username"] = $_POST["username"];
		echo"login_success";
	}else{
		echo "login_fail";
	}
?>