<?php
	header('content-type:text/html;charset=utf-8');
	require "../public/dbconfig.php";
	require "../public/connect.php";
	error_reporting(E_ALL ^ E_NOTICE); 
	error_reporting(E_ALL ^ E_WARNING); 
	if(empty($_GET)){
		header('Location:member-list.php');die;
	}
	$operate=$_GET['operate'];
	switch($operate){
		case "add":
			if(empty($_POST)){
				header('Location:adduser.php');die;
			}
			$username=$_POST['username'];
			$password=$_POST['password'];
			$rpassword=$_POST['newpassword2'];
			$sex=$_POST['sex'];
			$address=$_POST['address'];
			//$code=$_POST['code'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$state=$_POST['state'];
			$addtime=time();
			$sqls="select * from users where username='{$username}'";
			$rels=mysql_query($sqls);
			$num=mysql_num_rows($rels);
			if($num>0){
				header('location:member-add.php?errorno=1');die;
			}
			if($password!=$rpassword){
				header('location:member-add.php?errorno=2');die;
				
			}
			$sql="insert into users(id,username,password,sex,address,phone,email,state,addtime) values(null,'{$username}','{$password}','{$sex}','{$address}','{$phone}','{$email}','{$state}','{$addtime}')";
			
			$res=mysql_query($sql);
			$m=mysql_insert_id($link);
			$sql="select * from users where id={$m}";
			$re=mysql_query($sql);
			
			$row=mysql_fetch_assoc($re);
			//var_dump($row);die;
			if($m>0){
				if($row['state']==0){
					echo "<script type='text/javascript'>alert('添加成功！');location='admin-list.php';</script>";
				}
				else{
				echo "<script type='text/javascript'>alert('添加成功！');location='member-list.php';</script>";
				}
			}else{
				
				
				
				
				echo "<script type='text/javascript'>alert('添加失败！');location='member-add.php';</script>";
			}
			
			break;
		case "update":
			if(empty($_POST)){
				header('Location:member-list.php');die;
			}
			$id=$_POST['id'];
			$username=$_POST['username'];
			$sex=$_POST['sex'];
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$state=$_POST['state'];
			//$addtime=$_POST['addtime'];
			$sqlu="select * from users where username='{$username}'";
			$relu=mysql_query($sqlu);
			$numu=mysql_num_rows($relu);
			if($numu>0){
				
				echo "<script type='text/javascript'>alert('用户名重复！');location='member-update.php';</script>";die;
			}
			$sql="update users set  username='{$username}' ,sex='{$sex}',address='{$address}',phone='{$phone}',
			email='{$email}',state='{$state}' where id={$id}";
			$res=mysql_query($sql);
			$m=mysql_affected_rows($link);
			$sql="select * from users where id={$id}";
			$re=mysql_query($sql);
			$row=mysql_fetch_assoc($re);
			if($m>0){
				$state=$row['state'];
				if($state==0){
					echo "<script type='text/javascript'>alert('修改成功！');location='admin-list.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('修改成功！');location='member-list.php';</script>";
				}
				
			}else{
				echo "<script type='text/javascript'>alert('修改失败！');location='member-update.php';</script>";
				
			}
			
			break;
		case "delete":
			
			if(empty($_GET['id'])){
				header('Location:member-list.php');die;
			}
			$id=$_GET['id'];
			$sql="select * from users where id={$id}";
			$re=mysql_query($sql);
			$row=mysql_fetch_assoc($re);
			$sql="delete from users  where id={$id}";
			$res=mysql_query($sql);
			$m=mysql_affected_rows($link);
			if($m>0){
				
				
				if($row['state']==1)
				{echo "<script type='text/javascript'>alert('删除成功！');location='member-list.php';</script>";die;}
					elseif($row['state']==0)
				{echo "<script type='text/javascript'>alert('删除成功！');location='admin-list.php';</script>";
				}
			}else{
				echo "<script type='text/javascript'>alert('删除失败！');Location='member-list.php'</script>";
				
			}
			
			break;
				case "uppwd":
					if(empty($_POST)){
					header('Location:member-list.php');die;
				}
				$id=$_POST['id'];
				$password=$_POST['password'];
				$rpassword=$_POST['newpassword2'];
				if($password!=$rpassword){
				header('location:member-add.php?errorno=2');die;
				
				}
				$sqlp="update users set password='{$password}' where id={$id}";
				//echo $sqlp;die;
				$resp=mysql_query($sqlp);
				//var_dump($resp);
				$mp=mysql_affected_rows($link);
				//echo $mp;die;
				//$row=mysql_fetch_assoc($resp);
				
				if($mp)
				{	$sql="select * from users where id={$id}";
					$re=mysql_query($sql);
					$row=mysql_fetch_assoc($re);
					if($row['state']==0){
						echo "<script type='text/javascript'>alert('修改成功！');location='admin-list.php';</script>";
					}else{
					echo "<script type='text/javascript'>alert('修改成功！');location='member-list.php';</script>";
					}
				}else{
					echo "<script type='text/javascript'>alert('修改失败！');location='updatepwd.php';</script>";
				}
			break;
				
	}
	mysql_close($link);

?>