<?php
//將帳密資料存放於session(server端)  cookie則是user端

if(isset($_POST["username"])){

$Username = $_POST["username"];
$Password = $_POST["password"];
$Bday = $_POST["bday"];
$Sex = $_POST["sex"];
}

require_once("../dbtools.inc.php");
$link = create_connect();

$sql = "INSERT INTO members ( Username, Password, Bday, Sex) Values('$Username', '$Password', '$Bday', '$Sex')";

// $sql = "INSERT INTO members (Username, Password, Bday, Sex) Values('test001', '123456', '2019-03-14 00:00:00', '男')";

if(execute_sql($link, "id7769569_test_frineds", $sql)){
	echo "success";
}else{
	echo "fail";
}



?>