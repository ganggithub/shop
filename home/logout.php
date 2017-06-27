
<?php

header('content-type:text/html;charset=utf-8');
	session_start();
	$name=$_SESSION['users']['username'];
	unset($_SESSION['users']);
	
	//$_SESSION=array();
	session_destroy();
	
	
	echo "<script type='text/javascript'>alert('{$name},欢迎再来！');location='login.php'</script>";
	//echo "{$name},走好不送!欢迎再来!<br/>";
	//echo "<meta http-equiv='refresh' content='3;url=index.php'>";
	
?>