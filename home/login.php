<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>蘑菇街登录页面</title>
		<link rel="stylesheet" type="text/css" href="public/css/public.css"/>
		<link rel="stylesheet" type="text/css" href="public/css/login.css"/>
	</head>
	<body>
		<div class="login">
			<div class="content">
				<div class="login_left">
					<a href="index.php"><img src="public/images/login_logo.jpg" alt=""/></a>
				</div>
				<div class="login_right">
					<div class="lright_title">
						<div class="fl mod ">
							<a href="" class="lo_mod tab_on">普通登录</a>
						</div>
						<div class="fl mod">
							<a href="" class="eb_mod"></a>
						</div>
					</div>
					<div class="lg_form">
						<form action="users/dologin.php" method="post">
							
							<div class="">
									
								<div class="pdt15">
									<input maxlength="32" class="pwd_text dd" name="username" placeholder="昵称/邮箱/手机号"  type="text" style='width:190px;'>
									<?php
										if(@$_GET['eron']==1){
											echo "<span style='color:red;'>用户名错误</span>";
										}
									
									?>
								</div>
								<div class="">
									<input maxlength="32" class="pwd_text dd" name="password" value="" placeholder="密码"  type="password" style='width:190px;'>
									<?php
										if(@$_GET['eron']==2){
											echo "<span style='color:red;'>密码错误</span>";
										}
									
									?>
								</div>
							</div>
							<?php
										if(@$_GET['eron']==3){
											echo "<span style='color:red;'>登录失败</span>";
										}
									
									?>
							<div class="lg_remember">
								<label><input value="1" name="remember" class="check" checked="checked" type="checkbox"><span> 2周内自动登录</span></label>
								<a class="findpwd" href="" >忘记密码？</a>
							</div>
							<div class="lg_login clearfix">
								<input value="登录" class="sub" type="submit">
							</div>
							<div class="lg_reg clear">
								<a class="oversea_login" href="">海外手机登录</a>
								<a class="regist" href="register.php">新用户注册</a>
							</div>
						</form>
						<div class="ot_login">
							<span>你也可以用以下方式登录：</span>
							<div class="ot_btn clearfix">
								<a href=""><img src="public/images/qq.png"></a>
								<a href=""><img src="public/images/s_weixin.png"></a>
								<a href=""><img src="public/images/weibo.png"></a>
								<a href=""><img src="public/images/txwb.png"></a>
								<a href=""><img src="public/images/ren.png"></a>
								<a href=""><img src="public/images/tong.png"></a>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</div>
	</body>
</html>