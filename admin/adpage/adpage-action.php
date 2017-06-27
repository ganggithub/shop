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
				$typelist=array('image/jpeg','image/png','image.gif');
				if(empty($_GET)){
					header('Location:adpage-list.php');die;
				}
				switch($_GET['operate']){
					case "add":
						if(!empty($_POST)){
							$res1=fileUpload($_FILES["img1"],$path,$list);
							$adname1=$_POST['adname1'];
							$img1=$res1['info'];
							$res2=fileUpload($_FILES["img2"],$path,$list);
							$adname2=$_POST['adname2'];
							$img2=$res2['info'];
							$res3=fileUpload($_FILES["img3"],$path,$list);
							$adname3=$_POST['adname3'];
							$img3=$res3['info'];
							$res4=fileUpload($_FILES["img4"],$path,$list);
							$adname4=$_POST['adname4'];
							$img4=$res4['info'];
							
							$sql="insert into lunbo(adname1,img1,adname2,img2,adname3,img3,adname4,img4) values('{$adname1}','{$img1}','{$adname2}','{$img2}','{$adname3}','{$img3}','{$adname4}','{$img4}')";
							echo $sql;die;
							$res=mysql_query($sql);
							if(mysql_insert_id($link)>0){
								
								echo "<script type='text/javascript'>alert('添加轮播图成功！');location='adpage-list.php'</script>";
							}else{
								echo "<script type='text/javascript'>alert('添加轮播图失败！');location='adpage-add.php'</script>";
								
							}
						}
						break;
					
					case "update":
						if(empty($_POST)){
							header('Location:adpage-list.php');die();
						}
						$sql = "select * from lunbo";
						$result = mysql_query($sql);
						$row = mysql_fetch_assoc($result);
						$b='img';
						//$d="jimg";
						//$d=$_POST['jimg'];
						$adname1=$_POST['adname1'];
						$adname2=$_POST['adname2'];
						$adname3=$_POST['adname3'];
						$adname4=$_POST['adname4'];
						//循环得到图片名
						for($i=1;$i<=4;$i++){
							$b="img{$i}";
							$d="jimg{$i}";
							$$b=$row['img'.$i];
							@$$d=$_POST['jimg'.$i];
						}
						$c="pic";
						for($i=1;$i<=4;$i++){
							$b="img{$i}";
							
							//$c标记每个图片是否有值上传如果有$pic($i)的值就为一;
							@$c="pic{$i}";
							$res = fileUpload($_FILES['img'.$i],$path,$typelist);
							if($res['info']!='没有上传文件'){
								if($res['error']){
									$$b = $res['info'];
									$$c = 1;
									
									//imageResize($$b,$path,697,435,'');
									//imageResize($$b,$path,124,146,"m_");

								}else{
									die('图片上传失败：原因为'.$res['info']);
								}
							}
						}
						
						
						//如果没有上传图片的则执行此sql语句
						
							$sql = "update lunbo set img1='{$img1}',img2='{$img2}',img3='{$img3}',img4='{$img4}',adname1='{$adname1}',adname2='{$adname2}',adname3='{$adname3}',adname4='{$adname4}'";
							//die($sql);

						//die($sql);
						mysql_query($sql,$link);
						if(mysql_affected_rows($link)>0){
						//如果执行成功且上传图片的则把原先的图删掉
							for($i=1;$i<=4;$i++){
								$c="pic{$i}";
								$d="jimg{$i}";
								if(@$$c == 1){
									@unlink($path.$$d);
									
								}
							}
							echo "<script>alert('修改成功!');window.location='adpage-list.php';</script>";
						}else{
						//如果执行失败且上传图片的则把刚上传的图片删掉
							for($i=1;$i<=4;$i++){
								$c="pic{$i}";
								$b="img{$i}";
								if(@$$c == 1){
									@unlink($path.$$b);
									
								}
							}
							echo "<script>alert('修改失败!');window.location='adpage-list.php';</script>";
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