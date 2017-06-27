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
			<?php require "public/userleft.php"; ?>
				<div class="userright fl">
					<div class="userheader"><span>修改基本资料</span></div>
					<div class="userinfo">
					<?php
						if(!empty($_GET['id'])){
							$id=$_GET['id'];
							$sql="select * from address where id={$id}";
							$res=mysql_query($sql);
							$row=mysql_fetch_assoc($res);
						}
					
					?>
						<form action="doaction.php?operate=updateaddress" method="post">
						<input type="hidden" name="id" value="<?php  echo $row['id'];?>"/>
							<dl>
								<dd>收货人：</dd>
								<dt class="uname">
								<input  class="r3 inputtext" name="linkman" type="text" value="<?php  echo $row['linkman'];?>"></dt>
								
								<dd>电话：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="phone" value="<?php  echo $row['phone'];?>"/></dt>
								<dd>地址：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="address" value="<?php  echo $row['address'];?>"/></dt>
								<dd>邮编：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="code" value="<?php  echo $row['code'];?>"/></dt>
								
								
								
							
								
								
								
								<dd></dd>
								<dt>
								<input value="修改" class="r3 sbut" type="submit">
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