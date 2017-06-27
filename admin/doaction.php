<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	require "../public/dbconfig.php";
	require "../public/connect.php";
	$operate=$_GET['operate'];
	switch($operate){
		case "dologin":
		if(empty($_POST)){
		header('Location:index.php');die;
		}
		$username=$_POST['username'];
		$password=$_POST['password'];
		$acode=$_POST['acode'];
		
		if(strtoupper($acode)!=strtoupper($_SESSION['mycode'])){
			
			header('location:login.php?errorno=1');
		}else{
			$sql="select * from users where username='{$username}' and state=0";
			$res=mysql_query($sql);
			$count=mysql_num_rows($res);
			if($count>0){
				$rows=mysql_fetch_assoc($res);
				
				if($rows['password']==$password){
					$_SESSION['adminuser']=$rows;
					
					echo "<script type='text/javascript'>alert('登录成功');location='index.php';</script>";
					mysql_free_result($res);
					mysql_close($link);
				}else{
					
					header('location:login.php?errorno=3');
				}
			}else{
				
				header('location:login.php?errorno=2');
			}
			
		}
		
		break;
	case "outlogin":
		$username=$_SESSION['adminuser']['username'];
		unset($_SESSION['adminuser']);
		session_destroy();
		echo "<script type='text/javascript'>alert('{$username}退出成功，欢迎下次再来');location='login.php'</script>";
		//echo "{$username}退出成功，欢迎下次再来";
		//echo "<meta http-equiv='refresh' content='2;url=login.php'>";
		break;
		
	}
	

?>