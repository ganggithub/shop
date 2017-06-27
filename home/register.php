<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>蘑菇街注册页面</title>
		<link rel="stylesheet" type="text/css" href="public/css/public.css"/>
		<link rel="stylesheet" type="text/css" href="public/css/login.css"/>
	</head>
	<body>
		<div class="login">
			<div class="content">
				<div class="login_left">
					<a href="index.php"><img src="public/images/login_logo.jpg" alt=""/></a>
				</div>
				<div class="login_right width350">
					<div class="lright_title">
						<div class="fl mod ">
							<a href="" class="lo_mod tab_on">新用户注册</a>
						</div>
						<div class="fl mod">
							<a href="" class="eb_mod"></a>
						</div>
					</div>
					<div class="lg_form fl">
						<form action="users/adduser.php" method="post">
							<div class="user">
								<span class="fl rgspan padleft"><span class="red">*</span>用户名：</span>
								<input type="text" style='width:130px;' class="short_text inbord " name="username" value=""/>
								<?php
									if(@$_GET['erro']==3){
										echo "<span style='color:red;'>用户名重复</span>";
									}
								?>
							</div>
							<div class="padd20bo fl">
								<span class="fl rgspan"><span class="red">*</span>请设置密码：</span>
								<input type="password" style='width:130px;' class="short_text inbord" name="password" value=""/>
							</div>
							<div class="padd20bo fl">
								<span class="fl rgspan"><span class="red">*</span>请确认密码：</span>
								<input type="password" style='width:130px;' class="short_text inbord" name="rpassword" value=""/>
								<?php
									if(@$_GET['erro']==2){
										echo "<span style='color:red;'>两次密码不一致</span>";
									}
								?>
							</div>
									
							<div class="padd20bo fl">
								<span class="fl rgspan padleft"><span class="red">*</span>验证码：</span>
								<input type="text" class="short_text inbord wi150 " name="code" value=""/>
								<img class="pad15"src="public/dbmysql/yzm.php" onclick="this.src='public/dbmysql/yzm.php?id='+Math.random()" alt="验证码"/>
								<p style="text-align: center;"><?php
									if(@$_GET['erro']==1){
										echo "<span style='color:red;'>验证码错误</span>";
									}
								?></p>
							</div>
							
							<div class="lg_login clearfix">
								<input value="注册" class="sub" type="submit">
							</div>
							<div class="lg_remember">
								<label><input value="1" name="remember" class="check" checked="checked" type="checkbox">
									<span> 我已阅读并且同意<a target="_blank" href="" style="text-decoration:underline">《蘑菇街网络服务使用协议》</a></span>
								</label>
								
							</div>
							<a class="hvzh" href="login.php">已有账户</a>
						</form>
						
					</div>
				</div>
			
			</div>
		</div>
	</body>
</html>