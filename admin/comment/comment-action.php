<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>产品信息管理</title>
	</head>
	<body>
		<center>
			<h3>产品信息管理</h3>
			<?php
				require "../../public/dbconfig.php";
				require "../../public/connect.php";
				require "../../public/functions.php";
				$path="../../public/uploads/";
				$list=array('image/jpeg','image/png','image.gif');
				if(empty($_GET)){
					header('Location:product-list.php');die;
				}
				switch($_GET['operate']){
					case "add":
						break;
					
					case "update":
						
						break;
					case "upcmstate":
						if(empty($_GET)){
							header("Location:product-list.php");die;
						}
						$id=$_GET['id'];
						$delsql="update comments set state=0 where id={$id}";
						$res=mysql_query($delsql);
						$count=mysql_affected_rows($link);
						if($count>0){
						echo "<script type='text/javascript'>alert('删除评论成功！');location='comment-list.php'</script>";}else{
							"<script type='text/javascript'>alert('删除评论失败！');location='comment-list.php'</script>";
						}
						break;
				}
				mysql_close($link);
			
			?>
		</center>
	</body>
</html>