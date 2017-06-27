<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>链接信息管理</title>
	</head>
	<body>
		<center>
			<h3>链接信息管理</h3>
			<?php
				require "../../public/dbconfig.php";
				require "../../public/connect.php";
				
				if(empty($_GET)){
					header('Location:link-list.php');die;
				}
				switch($_GET['operate']){
					case "add":
						
						$name=$_POST['name'];
						$descr=$_POST['descr'];
						$http=$_POST['http'];
						$state=$_POST['state'];
						$addtime=time();
						$sql="insert into link(name,descr,http,state,addtime) 
						values('{$name}','{$descr}','{$http}','{$state}','{$addtime}')";
						//echo $sql;die;
						$res=mysql_query($sql);
						if(mysql_insert_id($link)>0){
							
							echo "<script type='text/javascript'>alert('添加链接成功！');location='link-list.php'</script>";
						}else{
							echo "<script type='text/javascript'>alert('添加链接失败！');location='link-add.php'</script>";
							
						}break;
					
					case "update":
						if(empty($_POST)){
							header('Location:product-list.php');die();
						}
						$id=$_POST['id'];
						$name=$_POST['name'];
						$descr=$_POST['descr'];
						$http=$_POST['http'];
						$state=$_POST['state'];
						$sql="update link set name='{$name}',descr='{$descr}',http='{$http}',state='{$state}' where id={$id}";
						//echo $sql;die;
						$res=mysql_query($sql);
						
						$count=mysql_affected_rows($link);
						if($count>=0){
							echo "<script type='text/javascript'>alert('修改链接成功！');location='link-list.php'</script>";
						}else{
								echo "<script type='text/javascript'>alert('修改链接失败！');location='link-update.php'</script>";
								
						}
						break;
					case "delete":
						if(empty($_GET)){
							header("Location:product-list.php");die;
						}
						$id=$_GET['id'];
						$delsql="delete from link where id={$id}";
						$res=mysql_query($delsql);
						$count=mysql_affected_rows($link);
						if($count>0){
						echo "<script type='text/javascript'>alert('删除链接成功！');location='link-list.php'</script>";}
						else{
							"<script type='text/javascript'>alert('删除链接失败！');location='link-list.php'</script>";
						}
						break;
				}
				mysql_close($link);
			
			?>
		</center>
	</body>
</html>