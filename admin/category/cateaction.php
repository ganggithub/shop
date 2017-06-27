<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>商品类别信息管理</title>
	</head>
	<body>
		<center>
			<h3>商品类别信息管理</h3>
			<?php
				require "../../public/dbconfig.php";
				require "../../public/connect.php";
				if(empty($_GET)){
					header('Location:category-list.php');die;
				}
				switch($_GET['operate']){
					case "add":
						$pid=$_POST['pid'];
						$path=$_POST['path'];
						$name=$_POST['name'];
						$sql="insert into category values(null,'{$name}','{$pid}','{$path}')";
						//echo $sql;die;
						$res=mysql_query($sql);
						if(mysql_insert_id($link)>0){
							
							echo "<script type='text/javascript'>alert('添加商品类别成功！');location='category-list.php'</script>";
						}else{
							echo "<script type='text/javascript'>alert('添加商品类别失败！');location='category-add.php'</script>";
						}break;
					
					case "update":
						if(empty($_POST)){
							header('Location:category-list.php');die();
						}
						$id=$_POST['id'];
						$name=$_POST['name'];
						$sql="update category set name='{$name}' where id={$id}";
						$res=mysql_query($sql);
						$count=mysql_affected_rows($link);
						if($count>0){
							echo "<script type='text/javascript'>alert('修改商品类别成功！');location='category-list.php'</script>";
						}else{
								echo "<script type='text/javascript'>alert('修改商品类别失败！');location='category-update.php'</script>";
						}
						break;
					case "delete":
						if(empty($_GET)){
							header("Location:category-list.php");die;
						}
						$id=$_GET['id'];
						
						$sql1="select * from category where pid={$id}";
						$res1=mysql_query($sql1);
						$num=mysql_num_rows($res1);
						if($num>0){
								echo "<script type='text/javascript'>alert('此商品类别有子类，不能删除！');location='category-list.php'</script>";
								die;
							}
						$sqlg="select * from product where cid={$id}";
						$resg=mysql_query($sqlg);
						$numg=mysql_num_rows($resg);
						if($numg>0){
							echo "<script type='text/javascript'>alert('此商品类别有商品，不能删除！');location='category-list.php'</script>";
								die;
						}
						$rows=mysql_fetch_assoc($res1);
						$pid=$rows['pid'];
						$delsql="delete from category where id={$id}";
								//echo $delsql;die;
						$res=mysql_query($delsql);
						$count=mysql_affected_rows($link);
						if($count>0){
						echo "<script type='text/javascript'>alert('删除商品类别成功！');location='category-list.php'</script>";}else{
							"<script type='text/javascript'>alert('删除商品类别失败！');location='category-list.php'</script>";
						}
						break;
				}
				mysql_close($link);
			
			?>
		</center>
	</body>
</html>