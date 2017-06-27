<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>订单信息管理</title>
	</head>
	<body>
		<center>
			<h3>订单信息管理</h3>
			<?php
				require "../../public/dbconfig.php";
				require "../../public/connect.php";
				require "../../public/functions.php";
				
				if(empty($_GET)){
					header('Location:orders-list.php');die;
				}
				//var_dump($_GET);
				//var_dump($_GET['operate']);
				$operate=$_GET['operate'];
				//switch($_GET['operate']){
				switch($operate){
					case "add":
						break;
					
					case "update":
						if(empty($_GET)){
							header('Location:orders-list.php');die();
						}
						//$id=$_POST['id'];
						//$state=$_POST['status'];
						//$state=$_POST['status'];
						//$sql="update orders set status='{$state}' where id={$id}";
						$id=$_GET['id'];
						$sql="update orders set status=3 where id={$id}";
						$res=mysql_query($sql);
						//echo $sql;die;
						$count=mysql_affected_rows($link);
						if($count>0){
							echo "<script type='text/javascript'>alert('修改订单成功！');location='orders-list.php'</script>";
						}else{
								echo "<script type='text/javascript'>alert('修改订单失败！');location='orders-update.php'</script>";
								
						}
						break;
					case "delete":
						if(empty($_GET)){
							header("Location:orders-list.php");die;
						}
						$id=$_GET['id'];
						$delsql="delete from orders where id={$id}";
						$res=mysql_query($delsql);
						$count=mysql_affected_rows($link);
						if($count>0){
							$sql="delete from orderdetail where orderid={$id}";
							$reso=mysql_query($sql);
							if($reso && mysql_affected_rows()>0){
							echo "<script type='text/javascript'>alert('删除订单成功！');location='orders-list.php'</script>";
								}
							}
						else{
							"<script type='text/javascript'>alert('删除订单失败！');location='orders-list.php'</script>";
						}
						break;
				}
				mysql_close($link);
			
			?>
		</center>
	</body>
</html>