<?php
 	$member_id = $_GET["ID"];

 	require_once("dbtools.inc.php");
	$link = create_connect();

	$sql = "SELECT * FROM members WHERE ID = $member_id";
	$result = execute_sql($link, "id7769569_test_frineds", $sql);

	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		echo $row["Username"];
	}else{
		echo "update error";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>會員系統</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"  href="css/jquery.mobile-1.4.5.min.css">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script>



	</script>
</head>
<body>
	<div data-role="page" id="home" >
		<div data-role="header" data-theme="b">
			<h1>更新會員資料</h1>
		</div>
		<div role="main" class="ui-content">
			<div data-role="fieldcontain">
				<label for="username">帳號</label>
				<input type="text" name="username" id="username" value="<?php echo $row["Username"]; ?>">
			</div>
			<div id="msgname"></div>
			<div data-role="fieldcontain">
				<label for="password">密碼</label>
				<input type="password" name="password" id="password" value="<?php echo $row["Password"]; ?>">
			</div>
			<div data-role="fieldcontain">
				<label for="bday">出生日期</label>
				<input type="date" name="bday" id="bday" value="<?php echo $row["Bday"]; ?>" >
			</div>
			<div data-role="fieldcontain"><!-- 撥動式切換開關 -->
				<label for="sex">性別</label>
				<select name="sex" id="sex"  data-role="slider" value="<?php echo $row["Sex"]; ?>">
					<option value="男">男</option>
					<option value="女">女</option>
				</select>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<!-- 將ID藏入btn中 這樣update才能順利更新 故新增data-id="..." -->
					<a href="#" data-role="button" data-theme="b" id="update_btn" onclick="item()"  data-id="<?php echo $row["ID"]; ?>">更新</a>		
				</div>
				<div class="ui-block-b">
					<a href="3_member-read.php" data-role="button" data-theme="b" id="btn">取消</a>	
				</div>
			</div>
		</div>
	<script>
		
		$(function(){
			$("#update_btn").bind("click",function(){
				//alert($(this).data("id"));//this為現在點到的值
				if(confirm("確定更新此筆資料？")){
				$.ajax({
					type:"POST",
					url:"https://tcnr1624.000webhostapp.com/Personal_Collect/API/20190218-member-update-api.php",
					data:{ID: $(this).data("id"), username: $("#username").val(), password: $("#password").val(), bday: $("#bday").val(), sex: $("#sex").val() },
					success:showupdate,
					error:function(){
						alert("update faile")
						}
					});
				}
			});
		});
		// function showupdate(data){
		// 	if(data){
		// 		alert(data)
		// 		location.href="3_member-read.php"
		// 	}else{
		// 		alert("update error");
		// 	}
		// }
		//10.01新增 若為superuser以外的一般帳號 都導至_only頁面 此更新頁之php為superuser所用
		function showupdate(data){
			//alert(data);//測試是否成功 data= login_success
			//alert($("#username").val());//取得帳號的值
			if(data){
				location.href = "3_member-read.php";
			}else{
				alert("update error");
			}
		}				
	</script>
	</div>	
</body>
</html>		