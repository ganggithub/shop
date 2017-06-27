<?php
	session_start();
	require "../public/dbconfig.php";
	require "../public/connect.php";
	//if(empty($_GET)){
		//header('location:index.php');
		//die;
	//}
	//$

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>添加地址页面</title>
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/header.css"/>
		<link rel="stylesheet" href="public/css/usercenter.css"/>
		<link rel="stylesheet" href="public/css/footer.css"/>
	</head>
	<body>
		<?php require "public/podhead.php"; ?>
			
		<div class="header_mid clear">
			<div class="center">
				<a href="index.php" class="logo"></a>
				<div class="hmmidd fl">
					<div class="search_inner_box">
						<div class="selectbox">
							<span class="selected">搜商品</span>
							<ol>
								<li class="current"><a href="">商品</a></li>
								<li><a href="">店铺</a></li>
							</ol>
						</div>
						<form action="searchlist.php" method="get">
							<input class="ts_txt fl" type="text" value="简约百搭欧美大牌短靴"/>
							<input class="ts_btn" type="submit" value="搜索"/>
						</form>
					</div>
					<div class="ts_hotwords">
						<?php  
							$sql="select * from category";
							$res=mysql_query($sql);
							if($res && mysql_num_rows($res)>0){
								while($row=mysql_fetch_assoc($res)){
									echo "<a href=\"searchlist.php?id={$row['id']}\">{$row['name']}</a>";
								}
							}
						?>
						
					</div>
				</div>
				<div class="hmright fr">
					<img src="public/images/weixinlist.png" height="70px" width="70px"/>
					<p>蘑菇街客户端</p>
				</div>
			</div>
		</div>
		
		<div class="userbody clear">
			<div class="center">
				<!--<div class="ordernav fl">
					<div class="odninfo">
						<img src="public/images/myzh.jpg"/>
						<p class="odname"><a href=""><?php  echo $_SESSION['users']['username'];  ?></a></p>
					</div>
					<div class="mu_nav myorder">
						<p class="ordertitle">我的订单</p>
						<ul class="orderul">
							<li><a href="userorder.php?uid=<?php echo $_SESSION['users']['id']; ?>">全部订单</a></li>
							<li><a href="shopcar.php">待付款</a></li>
							<li><a href="dshorder.php">待收货</a></li>
							
							<li><a href="ygmprod.php">已购买的宝贝</a></li>
						</ul>
					</div>
					<div class="mu_nav mycount">
						<p class="ordertitle">个人信息</p>
						<ul class="orderul">
							<li><a href="usercenter.php">基本信息</a></li>
							<li><a href="useredit.php">修改个人信息</a></li>
							<li><a href="userpwd.php">修改密码</a></li>
							<li><a href="searchlist.php?uid=<?php echo $_SESSION['users']['id']; ?>">我的收藏</a></li>
							<li><a href="commentlist.php">查看评论</a></li>
							<li><a href="addresslist.php">地址管理</a></li>
						</ul>
					</div>
				</div>-->
				<?php require "public/userleft.php"; ?>
				<div class="userright fl">
					<div class="userheader"><span>修改基本资料</span></div>
					<div class="userinfo">
						<form action="doaction.php?operate=address" method="post">
						<input type="hidden" name="id" value="<?php  echo $_SESSION['users']['id'];?>"/>
							<dl>
								<dd>收货人：</dd>
								<dt class="uname">
								<input  class="r3 inputtext" name="linkman" type="text" value=""></dt>
								
								<dd>电话：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="phone" value=""/></dt>
								<dd>地址：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="address" value=""/></dt>
								<dd>邮编：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="code" value=""/></dt>

								<dd></dd>
								<dt>
								<input value="添加" class="r3 sbut" type="submit">
								<input value="返回" class="r3 sbut pleft" onclick="javascript:location.href='usercenter.php';" type="button">
								</dt>
							</dl>
							
							
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
			require "public/footer.php";
		
		
		?>
		
	</body>

</html>