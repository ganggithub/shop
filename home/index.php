<?php
	session_start();
	require "../public/dbconfig.php";
	require "../public/connect.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="public/css/style.css"/><link rel="stylesheet" href="css/owl.carousel.css" />

<script type="text/javascript" src="public/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="public/js/owl.carousel.js"></script>
<script type="text/javascript">
$(function(){
	$('#owl-demo').owlCarousel({
		items: 1,
		navigation: true,
		navigationText: ["上一个","下一个"],
		autoPlay: true,
		stopOnHover: true
	}).hover(function(){
		$('.owl-buttons').show();
	}, function(){
		$('.owl-buttons').hide();
	});
});
</script>
	</head>
	<body>
		<div class="header">
			<div class="center">
				<div class="header_top fr">
					<ul class="fr">
						<?php
						
						
						if(!empty($_SESSION['users']))
						{
							echo  "
			<li class='s1'><a href='usercenter.php?id={$_SESSION['users']['id']}'><span style='font-weight:bold;'>{$_SESSION['users']['username']}</span>欢迎登录蘑菇街</a></li>
							<li class='s1'><a href='usercenter.php?id={$_SESSION['users']['id']}'>用户中心</a>
							<a href='logout.php' style='padding-left:15px;'>退出登录</a>
							
							
							
							</li>";
							echo "<li class=\"s1\"><a href=\"searchlist.php?uid={$_SESSION['users']['id']}\">我的收藏</a></li>";
						
						}else{
							
							echo "
							<li class='s1'>
						<a href='login.php'>登录</a>
						
						</li>
						<li class='s1'><a href='register.php'>注册</a></li>
							
							
							";
						}
							
						
						?>
						
						
						<!--<li class="s1 has_line"><a href="">QQ登录</a></li>
						<li class="s1"><a href="">微信登录</a></li>-->
						
						<li class="s1 has_line has_icon top_app">
							<a href="">手机蘑菇街</a>
							<ol class="ext_mode">
								<li>
									<img src="public/images/weixin.png" alt="" title="" width="90px"/></a>
								</li>
							</ol>
						</li>
						<li class="s1 has_line"><a href="">帮助中心</a></li>
					</ul>
				</div>
				<div class="header_main clear">
					<a href="" class="logo"></a>
					<div class="hmain_search">
						<div class="selectbox">
							<span class="selected">搜商品</span>
							<ol>
								<li><a href="">商品</a></li>
								<li><a href="">店铺</a></li>
							</ol>
						</div>
						<form action="searchlist.php" method="get">
							<input type="text" name="name" value="" placeholder="初夏舒适的休闲风" class="seachprod"/>
							<input type="submit"  value="" class="seachsub"/>
						</form>
					</div>
					<div class="hmain_right fr">
						<div class="shop_car sc_on">
							<a href="shopcar.php" class="shop_car_info">
								<span>购物车<b>
								
								<?php
								echo !empty($_SESSION['totalNum'])?$_SESSION['totalNum']:"0";
								
								
								?>
								
								
								</b>件</span>
								<b class="icon_delta"></b>
								<div class="shop_car_empty">
								购物车里没有商品
								<?php
								echo !empty($_SESSION['totalNum'])?"<a href='shopcar.php' style='background:none;display:inline;'>查看购物车</a>":"<a href='' style='display:inline;background:none;'>购物车里没有商品</a>";
								
								
								?>
								</div>
							</a>
						</div>
						<a href="userorder.php" class="shop_order">我的订单</a>
						
					</div>
				</div>
			</div>
		</div>
		<div class="nav clear">
			<div class="center">
				<div class="navmain clear">
					<ul class="nav_list">
						<li>
							<a href="index.php" id="on">首页</a>
						</li>
						<li>
							<a href="searchlist.php">买买买</a>
						</li>
						<li>
							<a href="searchlist.php?cid=42">美妆</a>
						</li>
						<li>
							<a href="searchlist.php">团购</a>
						</li>
						<li>
							<a href="searchlist.php">理财</a>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		<div class="navprim clear">
			<div class="center">
				<div class="navprleft">
					<ul>
						
							
							<?php
								$sql="select * from category where pid=0";
								$res=mysql_query($sql);
								if($res && mysql_num_rows($res)>0){
								while($rows=mysql_fetch_assoc($res)){
							?>
								<li class="leftli dott dwrel">
								<dl>
								<dt><a href="searchlist.php?cid=<?php  echo $rows['id'] ;?>"><?php echo $rows['name']; ?></a>
								</dt>
								<dd class="mainli">
								<?php $sql2="select * from category where pid={$rows['id']}";
								$res2=mysql_query($sql2);
								while($rows2=mysql_fetch_assoc($res2)){ ?>
								<a href="searchlist.php?cid=<?php  echo $rows2['id'] ;?>"><?php echo $rows2['name'] ; ?></a>
								<?php } ?>
								</dd>
							
								</dl>
								</li>
							<?php
										
									}
								}
							
							?>
							
						
						
						
						
						
						<!--4edn-->
					
					</ul>
				</div>
				<div id="owl-demo" class="navprmid owl-carousel">
					<!--<ul>
						<li>-->
						<?php
							$sql="select * from lunbo";
							$res=mysql_query($sql);
							if($res && mysql_num_rows($res)>0){
								$row=mysql_fetch_assoc($res);
							}
						
						
						?>
							<a href=""><img src="../public/uploads/<?php echo $row['img1']; ?>" alt="" title=""/><b></b><span><?php echo $row['adname1'];  ?></span></a>
							<a href=""><img src="../public/uploads/<?php  echo $row['img2']; ?>" alt="" title=""/><b></b><span><?php  echo $row['adname2']; ?></span></a>
							<a href=""><img src="../public/uploads/<?php  echo $row['img3']; ?>" alt="" title=""/><b></b><span><?php  echo $row['adname3'];?></span></a>
							<a href=""><img src="../public/uploads/<?php  echo $row['img4']; ?>" alt="" title=""/><b></b><span><?php  echo $row['adname4'];?></span></a>
							
						<!--</li>
					
					</ul>-->
				
				</div>
				<div class="navprright">
					<ul>
						<li><a href=""><img src="public/images/ad1.jpg"/></a></li>
						<li><a href=""><img src="public/images/ad2.jpg"/></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="prodnav clear">
			<div class="center">
				<ul>
					<li><a href=""><img src="public/images/pdnav1.png" alt="" title=""/></a></li>
					<li><a href=""><img src="public/images/pdnav2.png" alt="" title=""/></a></li>
					<li><a href=""><img src="public/images/pdnav3.png" alt="" title=""/></a></li>
					<li><a href=""><img src="public/images/pdnav4.png" alt="" title=""/></a></li>
				</ul>
			</div>
		</div>
		<div class="prodmain clear">
			<div class="center">
				<div class="prodtitle">
					<h2>买手推荐的衣服</h2>
					<div class="prodlink">
						<?php
							$sql="select * from category where pid=37";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
							
						
						?>
							<a href="searchlist.php?cid=<?php echo $row['id'];?>"><?php echo $row['name']; ?></a>
								<?php  }}?>
						
					</div>
				</div>
				<div class="product clear">
					<ul class="category_list fl">
						<?php
						//$ss="select id from category where pid=37";
							$sql="select * from product where cid in(select id from category where pid=37) limit 5";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
									
								?>	
						<li class="category_li  ">
							<a href="prodetail.php?id=<?php echo $row['id'];?>"><img src="../public/uploads/<?php echo $row['picname'] ;?>" alt="" title=""/></a>
							<p class="category_title"><a href="prodetail.php?id=<?php echo $row['id'];?>"><?php echo $row['pname']; ?></a></p>
							<p class="category_info">
								
								<span class="txt_like"><?php echo $row['clicknum'] ;?></span>
								<span class="txt_nowprice info_nowprice"><i>¥</i><?php echo $row['price'];?></span>
								<span class="txt_nowprice info_nowprice shoucang"><a  href="doaction.php?operate=addcollect&id=<?php echo $row['id']; ?>&uid=<?php echo @$_SESSION['users']['id']; ?>">收藏</a></span>
							</p>
						</li>
								
								
						<?php			
							}
						
							}?>
						
					
						
						
						
						
						
						
						
					</ul>
				</div>
				
				
				
				<div class="prodtitle padd60px clear">
					<h2>买家秀的包包</h2>
					<div class="prodlink">
						<?php
							$sql="select * from category where pid=39";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
							
						
						?>
							<a href="searchlist.php?cid=<?php  echo $row['id'];?>"><?php echo $row['name']; ?></a>
								<?php  }}?>
						
					</div>
				</div>
				<div class="product clear">
					<ul class="category_list fl">
						<?php
						//$ss="select id from category where pid=37";
							$sql="select * from product where cid in(select id from category where pid=39) limit 10";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
									
								?>	
						<li class="category_li  ">
							<a href="prodetail.php?id=<?php echo $row['id'];?>"><img src="../public/uploads/<?php echo $row['picname'] ;?>" alt="" title=""/></a>
							<p class="category_title"><a href="prodetail.php?id=<?php echo $row['id'];?>"><?php echo $row['pname']; ?></a></p>
							<p class="category_info">
								<span class="txt_like"><?php echo $row['clicknum'] ;?></span>
								<span class="txt_nowprice info_nowprice"><i>¥</i><?php echo $row['price'];?></span>
								
								<span class="txt_nowprice info_nowprice shoucang"><a  href="doaction.php?operate=addcollect&id=<?php echo $row['id']; ?>&uid=<?php  echo @$_SESSION['users']['id'];?>">收藏</a></span>
							</p>
						</li>
								
								
						<?php			
							}
						
							}?>
						
					
						
						
						
						
					</ul>
				</div>
				
				
				
				<div class="prodtitle padd60px clear">
					<h2>买家秀的鞋子</h2>
					<div class="prodlink">
						<?php
							$sql="select * from category where pid=38";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
							
						
						?>
							<a href="searchlist.php?cid=<?php echo $row['id'];?>"><?php echo $row['name']; ?></a>
								<?php  }}?>
						
					</div>
				</div>
				<div class="product clear">
					<ul class="category_list fl">
						<?php
						//$ss="select id from category where pid=37";
							$sql="select * from product where cid in(select id from category where pid=38) limit 10";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
									
								?>	
						<li class="category_li  ">
							<a href="prodetail.php?id=<?php echo $row['id'];?>"><img src="../public/uploads/<?php echo $row['picname'] ;?>" alt="" title=""/></a>
							<p class="category_title"><a href="prodetail.php?id=<?php echo $row['id'];?>"><?php echo $row['pname']; ?></a></p>
							<p class="category_info">
								<span class="txt_like"><?php echo $row['clicknum'] ;?></span>
								<span class="txt_nowprice info_nowprice"><i>¥</i><?php echo $row['price'];?></span>
								
								<span class="txt_nowprice info_nowprice shoucang"><a  href="doaction.php?operate=addcollect&id=<?php echo $row['id']; ?>&uid=<?php  echo @$_SESSION['users']['id'];?>">收藏</a></span>
							</p>
						</li>
								
								
						<?php			
							}
						
							}?>
						
					
						
						
						
						
					</ul>
				</div>
				
				
					
				<div class="prodtitle padd60px clear">
					<h2>买家秀的家居</h2>
					<div class="prodlink">
						<?php
							$sql="select * from category where pid=40";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
							
						
						?>
							<a href="searchlist.php?cid=<?php echo $row['id']?>"><?php echo $row['name']; ?></a>
								<?php  }}?>
						
					</div>
				</div>
				<div class="product clear">
					<ul class="category_list fl">
						<?php
						//$ss="select id from category where pid=37";
							$sql="select * from product where cid in(select id from category where pid=40) limit 10";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
									
								?>	
						<li class="category_li  ">
							<a href="prodetail.php?id=<?php echo $row['id'];?>"><img src="../public/uploads/<?php echo $row['picname'] ;?>" alt="" title=""/></a>
							<p class="category_title"><a href="prodetail.php?id=<?php echo $row['id'];?>"><?php echo $row['pname']; ?></a></p>
							<p class="category_info">
								<span class="txt_like"><?php echo $row['clicknum'] ;?></span>
								<span class="txt_nowprice info_nowprice"><i>¥</i><?php echo $row['price'];?></span>
								
								<span class="txt_nowprice info_nowprice shoucang"><a  href="doaction.php?operate=addcollect&id=<?php echo $row['id']; ?>&uid=<?php  echo @$_SESSION['users']['id'];?>">收藏</a></span>
							</p>
						</li>
								
								
						<?php			
							}
						
							}?>
						
					
						
						
						
						
					</ul>
				</div>
				
				
				
					
				<div class="prodtitle padd60px clear">
					<h2>买家秀的配件</h2>
					<div class="prodlink">
						<?php
							$sql="select * from category where pid=41";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
							
						
						?>
							<a href=""><?php echo $row['name']; ?></a>
								<?php  }}?>
						
					</div>
				</div>
				<div class="product clear">
					<ul class="category_list fl">
						<?php
						//$ss="select id from category where pid=37";
							$sql="select * from product where cid in(select id from category where pid=41) limit 10";
							$res1=mysql_query($sql);
							if($res1){
								while($row=mysql_fetch_assoc($res1)){
									
								?>	
						<li class="category_li  ">
							<a href="prodetail.php?id=<?php echo $row['id'];?>"><img src="../public/uploads/<?php echo $row['picname'] ;?>" alt="" title=""/></a>
							<p class="category_title"><a href="prodetail.php?id=<?php echo $row['id'];?>"><?php echo $row['pname']; ?></a></p>
							<p class="category_info">
								<span class="txt_like"><?php echo $row['clicknum'] ;?></span>
								<span class="txt_nowprice info_nowprice"><i>¥</i><?php echo $row['price'];?></span>
								
								<span class="txt_nowprice info_nowprice shoucang"><a  href="doaction.php?operate=addcollect&id=<?php echo $row['id']; ?>&uid=<?php  echo @$_SESSION['users']['id'];?>">收藏</a></span>
							</p>
						</li>
								
								
						<?php			
							}
						
							}?>
						
					
						
						
						
						
					</ul>
				</div>
			</div>
		</div>
		<div class="prodnav clear pbimg">
			<div class="center">
				<ul>
					<li><a href=""><img src="public/images/pdnavb1.png" alt="" title=""/></a></li>
					<li><a href=""><img src="public/images/pdnavb2.png" alt="" title=""/></a></li>
					<li><a href=""><img src="public/images/pdnavb3.png" alt="" title=""/></a></li>
					
				</ul>
			</div>
		</div>
		<div class="footer clear">
			<div class="center">
				<div class="footleft">
					<a href="" class="aimg"><img src="public/images/logobt.png"/></a>
					<div class="footltext">
						<p>营业执照注册号：330106000129004</p>
						<p>增值电信业务经营许可证：浙B2-20110349</p>
						<p>ICP备案号：浙ICP备10044327号-3</p>
						<p>©2015 Mogujie.com 杭州卷瓜网络有限公司</p>
					</div>
				</div>
				<div class="footright">
					<dl class="link_company">
						<dt>公司</dt>
						<dd><a href="">关于我们</a></dd>
						<dd><a href="">招聘信息</a></dd>
						<dd><a href="">联系我们</a></dd>
					</dl>
					<dl>
						<dt>消费者</dt>
						<dd><a href="">帮助中心</a></dd>
						<dd><a href="">意见反馈</a></dd>
						<dd><a href="">手机版下载</a></dd>
					</dl>
					<dl>
						<dt>商家</dt>
						<dd><a href="">帮助中心</a></dd>
						<dd><a href="">商家培训</a></dd>
						<dd><a href="">商家招募</a></dd>
						<dd><a href="">免费开店</a></dd>
					</dl>
					
					<dl>
						<dt>权威认证</dt>
						<dd><a href="">关于我们</a></dd>
						<dd><a href="">招聘信息</a></dd>
						<dd><a href="">联系我们</a></dd>
					</dl>
				</div>
				<div class="w-links clear">
					<ul>
						<li>友情连接</li>
						<?php  
							$sql="select * from link where state=1";
							$res=mysql_query($sql);
							if($res && mysql_num_rows($res)>0)
							{
								while($row=mysql_fetch_assoc($res))
								{
									?>
										<li><a href="<?php echo $row['http'];?>" title="<?php  echo $row['descr'];?>"><?php echo $row['name']; ?></a></li>
									<?php
								}
							}

						?>
					
						
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>