<?php 
    session_start();
    //用isset判斷資是否存在
    if(isset($_SESSION["username"])){
        echo '<script>alert("'.$_SESSION["username"].'會員您好");</script>';
    }else{
        echo '<script>alert("請先登入會員");location.href="3_member-login.php";</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>會員名單</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.btn{
			margin-left: 5px;
		}
	</style>
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  				<h1 class="text-center">會員列表</h1>
  			<div class="col-sm-8 col-sm-offset-2">
  				<table class="table mt10">
  					<thead>
  						<tr>
  							<th>ID</th>
  							<th>Username</th>
  							<th>Password</th>
  							<th>Bday</th>
  							<th>Sex</th>
  							<th>Create_time</th>
  						</tr>
  					</thead>
  						<tbody id="member_list">
<!--   							<tr>
  								<td>1</td>
  								<td>Tom</td>
  								<td>123456</td>
  								<td>2019/02/18</td>
  								<td>男</td>
  								<td>20190218</td>
  							</tr> -->
  						</tbody>
 			 	</table>
  			</div>
  		</div><!-- row end -->
  	</div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script>
    	$(function(){
    		$.ajax({
			type:"GET",
			url:"https://tcnr1624.000webhostapp.com/Personal_Collect/API/20190218-member-read-api.php",
			dataType:"json",
			success:showMember,
			error:function(){
				alert("會員列表API回傳失敗");
				  }
			   });//end ajax  
    	});	


		function showMember(data){
			//console.log(data.length);
			for(i=0; i<data.length; i++){
				srHTML = "";
  				srHTML='<tr><td>'+data[i].ID+'</td><td>'+data[i].Username+'</td><td>'+data[i].Password+'</td><td>'+data[i].Bday+'</td><td>'+data[i].Sex+'</td><td>'+data[i].Date+'</td><td><a href="3_member-update.php?ID='+data[i].ID+'" class="btn btn-primary">更新</a><a data-id="'+data[i].ID+'" href="#" class="btn btn-danger" onclick="del_item(this) ">刪除</a></td></tr>';	
  				$("#member_list").append(srHTML);
  				//按下刪除需新增一個詢問視窗。 用confirm方法(用w3 cschool搜尋)	
  				//又或是新增一個onclick 方法	()中this 為目前按到的item id	
			}
		}
      function del_item(myevent){
        // console.log($(myevent).data("id"));
        if(confirm("確定刪除會員"+$(myevent).data("id")+"??")){
          $.ajax({
            type: "POST",
            url: "https://tcnr1624.000webhostapp.com/Personal_Collect/API/20190218-member-delete-api.php",
            data: {ID: $(myevent).data("id")},
            success:show,
            error: function(){
              alert("刪除會員API失敗");
            }
          });
        }else{

        }
      }

      function show(data){
        if(data){
          location.href="3_member-read.php";
        }else{
          alert("刪除會員失敗");
        }
      }
    </script>

  </body>
</html>
