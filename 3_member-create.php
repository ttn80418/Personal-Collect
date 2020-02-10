<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	<script>
		$(function(){
			$("#username").bind("input propertychange", function(){
				if($("#username").val().length < 5){
					$("#error_username").html("帳號不得少於5個字數");
					$("#error_username").css("background-color", "red");
					$("#error_username").css("color", "white");
				}else{
					$("#error_username").html("");
				}
			});
// ----password-----
			$("#password").bind("input propertychange", function(){
				if($("#password").val().length < 6){
					$("#error_password").html("密碼不得少於6個字數");
					$("#error_password").css("background-color", "red");
					$("#error_password").css("color", "white");
				}else{
					$("#error_password").html("");
				}
			});			

			$("#reg_ok").bind("click", function(){
				$.ajax({
					type: "POST",
					url: "https://tcnr1624.000webhostapp.com/Personal_Collect/API/20190218-member-create_api.php",
					data: {username: $("#username").val(), password: $("#password").val(), bday: $("#bday").val(), sex: $("#sex").val() },
					success: reg,
					error:function(){
						alert("註冊api回傳失敗");
					}
				}); // end ajax
			});
		}); // end function()


		function reg(data){
			if(data){
				location.href = "3_member-login.php";
			}else{
				alert(data);
			}
		}
	</script>
</head>
<body>
	<div data-role="page" id="home">
		<div data-role="header" data-position="fixed" id="home" data-theme="b">
			<h1>會員註冊</h1>
		</div>
		<div role="main" class="ui-content">
			<div data-role="fieldcontain">
				<label for="username">帳號</label>
				<input type="text" name="username" id="username">
			</div>
			<div id="error_username"></div>
			<div data-role="fieldcontain">
				<label for="password">密碼</label>
				<input type="password" name="password" id="password">
			</div>
			<div id="error_password"></div>
			<div data-role="fieldcontain">
				<label for="bday">生日</label>
				<input type="date" name="bday" id="bday">
			</div>
			<div data-role="fieldcontain">
				<label for="sex">性別</label>
				<select name="sex" id="sex" data-role="slider">
					<option value="男">男生</option>
					<option value="女">女生</option>
				</select>	
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a">
					<a href="#" data-role="button" data-theme="b">取消</a>		
				</div>
				<div class="ui-block-b">
					<a href="#" data-role="button" data-theme="b" id="reg_ok">註冊</a>		
				</div>
			</div>
		</div>
		<div data-role="footer" data-position="fixed" data-theme="b">
			<h1>footer</h1>
		</div>
	</div>
</body>
</html>		