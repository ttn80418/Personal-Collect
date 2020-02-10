<?php
	session_start();
	if (isset($_SESSION['username'])) {
		$Username = $_SESSION['username'];

		// echo "userName=".$Username;//用來測試是否抓到username



	require_once("../dbtools.inc.php");
	$link = create_connect();
	// $sql = "SELECT * FROM members ORDER BY ID DESC";

	// $result = execute_sql($link, "id7769569_test_frineds", $sql);
	// $row = mysqli_fetch_assoc($result);

	// $memberArray = Array();

	// if(mysqli_num_rows($result) > 0){
	// 	do{
	// 		$memberArray[] = $row;
	// 	}while($row = mysqli_fetch_assoc($result));

	// 	echo json_encode($memberArray);
	// }else {
	// 	echo "查無會員紀錄!";
	// }	
	
	//以下為10.01修正 先抓一筆資料 因以下使用超帳權限登入時 會多一次執行sql動作 故在改寫成10.01-2版
	//$sql = "SELECT * FROM members WHERE Username = '$Username' ";
	//$result = execute_sql($link, "id7769569_test_frineds", $sql);

	//確認有無資料
	// if(mysqli_num_rows($result) > 0){
	// 	$row = mysqli_fetch_assoc($result);
	// 	$uname = $row["Username"];
	// 	if($uname == "superuser"){
	// 		$sql = "SELECT * FROM members ";//若為root權限 則都可以顯示全部
	// 		$result = execute_sql($link, "id7769569_test_frineds", $sql);
	// 	do{
	// 		$memberArray[] = $row;
	// 	}while($row = mysqli_fetch_assoc($result));

	// 	echo json_encode($memberArray);
	// }else {
	// 		$_SESSION['username'] = $row['Username'];
	// 		$data[] = $row ;
	// 		echo json_encode($data);
	// 	  }			
	// 	}else{
	// 		echo "查無會員紀錄!";
 //   		}
		//10.01-2版 session判斷後才執行sql語法
		if($Username == "superuser"){
			$sql = "SELECT * FROM members ";//若為root權限 則都可以顯示全部
			$result = execute_sql($link, "id7769569_test_frineds", $sql);
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				do{
					$memberArray[] = $row;
				}while($row = mysqli_fetch_assoc($result));
					echo json_encode($memberArray);
			}	
	}else {
			$sql = "SELECT * FROM members WHERE Username = '$Username' ";
			$result = execute_sql($link, "id7769569_test_frineds", $sql);
			$row = mysqli_fetch_assoc($result);
			$_SESSION['username'] = $row['Username'];
			$data[] = $row ;
			echo json_encode($data);
		  }	


   		$link->close();	
}	
?>