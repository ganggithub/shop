<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	require "../dbmysql/dbconfig.php";
	require "../dbmysql/connect.php";
	if(empty($_POST)){
		echo "<script>alert('你还没有注册');Location='../../register.php';</script>";die;
	}
	$username=$_POST['username'];
	$password=$_POST['password'];
	$rpassword=$_POST['rpassword'];
	$code=$_POST['code'];
	//echo time();die;
	//echo strtoupper($_SESSION['code']).'<hr/>';
	//   echo strtoupper($code);die;
	if(@strtoupper($_SESSION['code'])!=strtoupper($code)){
		//echo "<script>alert('验证码不正确！');Location='register.php';</script>";
       
		echo "<script type='text/javascript'>alert('验证码不正确！');location='../../register.php'</script>";
	}else{
		if($password!=$rpassword)
		{
			//echo "<script>alert('两次密码不一致！');Location='register.php';</script>";
			echo "<script type='text/javascript'>alert('两次密码不一致！');location='../../register.php'</script>";
		}else{
			$sql="insert into users(id,username,password,addtime) values(null,'{$username}','{$password}',".time().")";
			//echo $sql;die;
			$res=mysql_query($sql);
			if($res && mysql_affected_rows($link)>0){
				//echo "插入成功!";
				//echo "<meta http-equiv='refresh' content='3;url=index.php'>";
				//echo "<script>alert('注册成功！');Location='index.php';</script>";
				echo "<script type='text/javascript'>alert('注册成功！');location='../../index.php'</script>";
			}else{
				//echo "<script>alert('注册失败！');Location='register.php';</script>";
				echo "<script type='text/javascript'>alert('注册失败！');location='../../register.php'</script>";
			}
		}
	}
	 mysql_close($link);
?>