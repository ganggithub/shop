<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	include "../dbmysql/dbconfig.php";
	include "../dbmysql/connect.php";
	if(empty($_POST)){
		header('locahost:index.php');
		die();
	}
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql="select * from users where username='{$username}' and password='{$password}'";
	//echo $sql;die;
	$res=mysql_query($sql);
	$count=mysql_num_rows($res);
	if($count>0){
		
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		$_SESSION['islogin']=1;
		//echo "登录成功";
		//var_dump($_SESSION);
		//echo "<meta http-equiv='refresh' content='2;url=index.php'>";
		//echo "<script>alert('登录成功');Location='index.php';</script>";
		echo "<script type='text/javascript'>alert('登录成功！');location='../../index.php'</script>";
	}else{
		//echo "登录失败".mysql_error()."<br/>";
		//echo "失败原因是：".mysql_error();
		//echo "<script>alert('登录失败');Location='login.php';</script>";
		echo "<script type='text/javascript'>alert('登录失败!');location='../../index.php'</script>";
	}
	mysql_close($link);

?>