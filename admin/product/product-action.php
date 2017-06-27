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
						$res=fileUpload($_FILES["picname"],$path,$list);
						$pname=$_POST['pname'];
						$cid=$_POST['cid'];
						$company=$_POST['company'];
						//$describes=$_POST['describes'];
						$price=(double)$_POST['price'];
						$describes=$_POST['describes'];
						$picname=$res['info'];
						//var_dump($picname);
						//var_dump($describes);die;
						$state=$_POST['state'];
						$color=$_POST['color'];
						$size=$_POST['size'];
						
						//$describes="ee";
						//echo $describes1;die;
						$store=(int)$_POST['store'];
						$addtime=time();
						//var_dump($_POST['']);die;
						//var_dump($price);
						/*if(is_bool($price) || is_string($price) || is_array($price)){
							echo "<script type='text/javascript'>alert('商品价格不是有效数字！');location='product-add.php'</script>";die;
						}*/
						if(!is_int($store)){
							echo "<script type='text/javascript'>alert('商品库存量不是整数！');location='product-add.php'</script>";die;
						}
						if(empty($pname)){
							//var_dump($pname);die;
							echo "<script type='text/javascript'>alert('商品名字和价格不能为空！');location='product-add.php'</script>";die;
						}
						$sql="insert into product(pname,cid,company,describes,price,picname,state,store,addtime,color,size) values('{$pname}','{$cid}','{$company}','{$describes}','{$price}','{$picname}','{$state}','{$store}','{$addtime}','{$color}','{$size}')";
						//echo $sql;die;
						$res=mysql_query($sql);
						if(mysql_insert_id($link)>0){
							
							echo "<script type='text/javascript'>alert('添加商品成功！');location='product-list.php'</script>";
						}else{
							echo "<script type='text/javascript'>alert('添加商品失败！');location='product-add.php'</script>";
							//@unlink();
						}break;
					
					case "update":
						if(empty($_POST)){
							header('Location:product-list.php');die();
						}
						$id=$_POST['id'];
						$pname=$_POST['pname'];
						$cid=$_POST['cid'];
						$company=$_POST['company'];
						$describes=$_POST['describes'];
						$color=$_POST['color'];
						$size=$_POST['size'];
						$price=$_POST['price'];
						$res=fileUpload($_FILES["picname"],$path,$list);
						//var_dump($res);die;
						$picname=$res['info'];
						if($res['info']=='没有上传文件'){
							$picname=$_POST['picname1'];
						}
						
						$state=$_POST['state'];
						$store=$_POST['store'];
						/*if(is_bool($price) || is_string($price) || is_array($price)){
							echo "<script type='text/javascript'>alert('商品价格不是有效数字！');location='product-add.php'</script>";die;
						}*/
						/*if(!is_int($store)){
							echo "<script type='text/javascript'>alert('商品库存量不是整数！');location='product-add.php'</script>";die;
						}*/
						$sql="update product set color='{$color}',size='{$size}',pname='{$pname}',cid='{$cid}',company='{$company}',describes='{$describes}',price='{$price}',picname='{$picname}',state='{$state}',store='{$store}' where id={$id}";
						//$sql="update product set color='{$color}',size='{$size}','pname='{$pname}',cid='{$cid}',company='{$company}',price='{$price}',picname='{$picname}',state='{$state}',store='{$store}' where id={$id}";
						//echo $sql;die;
						$res=mysql_query($sql);
						//echo $sql;die;
						$count=mysql_affected_rows($link);
						if($count>0){
							echo "<script type='text/javascript'>alert('修改商品成功！');location='product-list.php'</script>";
						}else{
								echo "<script type='text/javascript'>alert('修改商品失败！');location='product-update.php'</script>";
								//@unlink();
						}
						break;
					case "delete":
						if(empty($_GET)){
							header("Location:product-list.php");die;
						}
						$id=$_GET['id'];
						$delsql="delete from product where id={$id}";
						$res=mysql_query($delsql);
						$count=mysql_affected_rows($link);
						if($count>0){
						echo "<script type='text/javascript'>alert('删除商品成功！');location='product-list.php'</script>";}else{
							"<script type='text/javascript'>alert('删除商品失败！');location='product-list.php'</script>";
						}
						break;
				}
				mysql_close($link);
			
			?>
		</center>
	</body>
</html>