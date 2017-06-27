<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	require "../../public/dbconfig.php";
	require "../../public/connect.php";
	if(empty($_POST)){
		header('locahost:index.php');
		die();
	}
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql="select * from users where username='{$username}'";
	//echo $sql;die;
	$res=mysql_query($sql);
	//var_dump($res);die;
	$count=mysql_num_rows($res);
	
	$rows=mysql_fetch_assoc($res);
		if($username!=$rows['username']){
			header('Location:../login.php?eron=1');
			die;
		}else if($password!=$rows['password']){
			header('Location:../login.php?eron=2');
			die;
		}else{
		
		$_SESSION['users']=$rows;
		echo "<script type='text/javascript'>alert('登录成功！');location='../index.php'</script>";
	}
	
	mysql_close($link);

?>