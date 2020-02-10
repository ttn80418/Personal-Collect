<?php 
//因為session儲存問題 故於每次加載login頁面時先做清除動作
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登入會員</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"  href="css/jquery.mobile-1.4.5.min.css">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script>


		$(function(){
			$("#username").bind("input propertychange",function(){
				if($("#username").val().length <5){
					$("#msgname").text(" 帳號不得少於5個字");
					$("#msgname").css("background-color", "red");
				}else {	
					$("#msgname").text("");
					$("#msgname").css("background-color", "white");
				}
			});

				$("#ok_btn").bind("click",function(){
				$.ajax({
					type:"POST",
					url:"https://tcnr1624.000webhostapp.com/Personal_Collect/API/20190218-member-login_api.php",
					data:{username:$("#username").val(),password:$("#password").val()},
					success:login,
					error:function(){
						alert("登入API回傳失敗");
					}
				});//end ajax
			});//end click function()
		});	

		// function login(data){
		// 	//alert(data);//測試是否成功
		// 	if(data){
		// 		location.href = "3_member-read.php";
		// 	}else{
		// 		alert(data);
		// 	}
		// }
		//10.01新增 若為superuser則導入 可進行更新刪除的read.php 反之則只有更新功能的read_only.php	
		function login(data){
			//alert(data);//測試是否成功 data= login_success
			//alert($("#username").val());//取得帳號的值
			if($("#username").val() =="superuser"){
				location.href = "3_member-read.php";
			}else{
				location.href = "3_member-read_only.php";
			}
		}		
	</script>
</head>
<body>
	<div data-role="page" id="home" >
		<div data-role="header" data-theme="b">
			<h1>會員登入</h1>
		</div>
		<div role="main" class="ui-content">
			<div data-role="fieldcontain">
				<label for="username">帳號</label>
				<input type="text" name="username" id="username">
			</div>
			<div id="msgname"></div>
			<div data-role="fieldcontain">
				<label for="password">密碼</label>
				<input type="password" name="password" id="password">
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<a href="#" data-role="button" data-theme="b" id="ok_btn">登入</a>		
				</div>
				<div class="ui-block-b">
					<a href="#" data-role="button" data-theme="b" id="btn">取消</a>	
				</div>
			</div>
		</div>
		<div data-role="footer" data-position="fixed" data-theme="b">
		</div>	
	</div>	
</body>
</html>		