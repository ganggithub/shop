<?php
	session_start();
	require "../public/dbconfig.php";
	require "../public/connect.php";
	

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>确认订单页面</title>
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/header.css"/>
		<link rel="stylesheet" href="public/css/usercenter.css"/>
		<link rel="stylesheet" href="public/css/order.css"/>
		<link rel="stylesheet" href="public/css/H-ui.min.css"/>
		<link rel="stylesheet" href="public/css/footer.css"/>
		 <script type="text/javascript">
            //定义一个执行删除判断函数
            function doDel(id){
                if(confirm("确定要删除吗？")){
                    //跳转网页,并携带参数
                    window.location='doaction.php?operate=userdel&id='+id;
                }
            }
 </script>
 <style  type="text/css">
 .ordok p{font-size:24px;}
 .shop{
	display: inline-block;
	width: 140px;
	height: 50px;
	line-height: 50px;
	font-size: 24px;
	margin-right:20px;margin-top:20px;
	text-align: center;
	background:#FFF7EA;
	color: #333;
	float:left;
	border-radius: 5px;
 }
 .shop:hover{text-decoration:none;color:#333;}
 </style>
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
						<form>
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
				<div class="ordernav fl">
					<div class="odninfo">
						<img src="public/images/myzh.jpg"/>
						<p class="odname">
						<a href=""><?php  echo $_SESSION['users']['username'];  ?></a></p>
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
						</ul>
					</div>
				</div>
				<div class="userright fl">
					<div class="userheader"><span>订单信息</span></div>
					<div class="userinfo">
					<div class="orderright">
							<div class="mt-20">
							<?php
								if(!empty($_GET['id'])){
									$id=$_GET['id'];
									$sql="select * from orders where id={$id}";
									$res=mysql_query($sql);
									if($res && mysql_num_rows($res)>0){
										$row=mysql_fetch_assoc($res);
									}
								}
							
							
							?>
							<div class="ordok" style="font-size:24px;">
								<h2>订单信息：</h2>
								<p>恭喜您，购买成功，您的订单号是<?php echo $row['id']; ?></p>
								<p>
									<span>收货人是：<?php echo $row['linkman']?></span>
									
								</p>
								<p>
									<span>收货地址：<?php echo $row['address']?></span>
									
								</p>
								<p>
									<span>收货地址：<?php echo $row['phone']?></span>
									
								</p>
								<p>
									<span>消费金额：<?php echo $row['total']?></span>
									
								</p>
								<p>
									<span>请实时关注订单物流状态</span>
									
								</p>
								<p>
									<span><a href="index.php" style="" class="shop">继续购物</a></span>
									
								</p>
								<p>
									<span><a href="usercenter.php" class="shop">个人中心</a></span>
									
								</p>
							</div>
							
							</div>
					
					</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php require "public/footer.php"; ?>
		
	</body>

</html>