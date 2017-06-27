<?php
	session_start();

?>


<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>我的购物车页面</title>
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/shopcar.css"/>
	</head>
	<body>
		<!--<div class="header">
			<div class="center">
				<a href="index.php" class="home fl">蘑菇街首页</a>
				<ul class="header_top">
					<li class="s1">
						<?php
						if(!empty($_SESSION['users'])){
							echo "<a href='usercenter.php?id={$_SESSION['users']['id']}'><span style='font-weight:bold;'>{$_SESSION['users']['username']}</span>欢迎登录</a>
							<a href='../home/logout.php' style='padding-left:15px;'>退出登录</a>
							
							";
							?>
					<li class="s1 has_line user_fav">
						<a href="">我的收藏</a>
						<ul class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="searchlist.php?uid=
								<?php
							if(!empty($_SESSION['users'])){
								echo $_SESSION['users']['id'];
							}
							?>">喜欢的商品</a></li>
							<?php
						}else{
							
							echo "<a href='register.php' style='padding-right:10px;'>注册</a>
						<a href='login.php'>登录</a>";
						}
						
						
						?>
						</ul>
						
					</li>
					<li class="s1 has_line">
						<a href="userorder.php">我的订单</a>
					</li>
					<li class="s1 has_line">
						<a href="shopcar.php"><span class="cart_info">购物车<b class="num">
						
						
							
							
								
								<?php
								echo !empty($_SESSION['totalNum'])?$_SESSION['totalNum']:"0";
								
								
								?>
						
						</b>件</span></a>
					</li>
					<li class="s1 has_line">
						<a href="">客户服务</a>
						<ol class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="#">联系合作</a></li>
							<li class="s2"><a target="_blank" rel="nofollow" href="#">帮助</a></li>
						   
						</ol>
					</li>
					<li class="s1 has_line">
						<a href="">我的小店</a>
					</li>
				
							
						
					</li>
					
					
					
					
				</ul>
			</div>
		</div>-->
		<div class="header">
			<div class="center">
				<a href="index.php" class="home fl">蘑菇街首页</a>
				<ul class="header_top">
					<li class="s1">
						<?php
						if(!empty($_SESSION['users'])){
							echo "<a href='usercenter.php?id={$_SESSION['users']['id']}'>
							<span style='font-weight:bold;'>{$_SESSION['users']['username']}</span>欢迎登录</a>
							<a href='../home/logout.php' style='padding-left:15px;'>退出登录</a>
							
						";}else{
							echo "<a href='login.php' style='margin-right:5px;'>登录&nbsp;</a>";
							echo "<a href='register.php'>注册</a>";
						}
							?>
					</li>
					
					<li class="s1 has_line user_fav">
						<a href="searchlist.php?uid=<?php echo @$_SESSION['users']['id']; ?>">我的收藏</a>
						<ul class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="searchlist.php?uid=<?php echo @$_SESSION['users']['id']; ?>">喜欢的商品</a></li>
						</ul>
					</li>
					<li class="s1 has_line">
						<a href="userorder.php">我的订单</a>
					</li>
					<li class="s1 has_line">
						<a href="shopcar.php"><span class="cart_info">购物车<b class="num"><?php
								echo !empty($_SESSION['totalNum'])?$_SESSION['totalNum']:"0";
								
								
								?></b>件</span></a>
					</li>
					<li class="s1 has_line">
						<a href="">客户服务</a>
						<ol class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="#">联系合作</a></li>
							<li class="s2"><a target="_blank" rel="nofollow" href="#">帮助</a></li>
						   
						</ol>
					</li>
					<li class="s1 has_line">
						<a href="">我的小店</a>
					</li>
				</ul>
			</div>
		</div>
		
		
		
		
		<div class="g-header clear">
			<div class="center">
				<div class="process-bar">
					<div class="md_process_wrap">
						<i class="md_process_i md_process_i1">
							1<span class="md_process_tip">购物车</span>
						</i>
						<i class="md_process_i md_process_i2">
							2<span class="md_process_tip">确认订单</span>
						</i>
						<i class="md_process_i md_process_i3">
							3<span class="md_process_tip">支付</span>
						</i>
						<i class="md_process_i md_process_i4">
							<img src="public/images/right.png" alt="" height="23" width="23">
							<span class="md_process_tip">完成</span>
						</i>
					</div>
				</div>
			</div>
		</div>
		<div class="contdetail clear">
			<div class="center">
				<ul id="cartSlide" class="cart_slide pad20">
					<li><a href="" class="cart_slide_item pdall">全部商品（<span class="num">1</span>）</a></li>
					<li class="cartslide-line">|</li>
					<li><a href="" class="cart_slide_item">优惠（<span class="num">1</span>）</a></li>
					<li class="cartslide-line">|</li>
					<li><a href="" class="cart_slide_item">库存紧张（<span class="num">0</span>）</a></li>
					
				</ul>
				<div class="cart_wrap clear">
					<div class="carPage">
						<table id="cartOrderTable" class="cart_table">
							<tr>
								<th class="cars_all cart_alleft"><input type="checkbox" name="s_all" class="s_all"/><label class="lball">全选</label>
								</th>
								<th class="car_good">商品</th>
								<th class="car_goodinfo">商品信息</th>
								<th class="car_price">单价（元）</th>
								<th class="car_goodnum">数量</th>
								<th class="car_goodsum">小计（元）</th>
								<th class="car_caozuo">操作</th>
							</tr>
							<tr class="bordef">
								<td colspan="7" class="cart_group_head">
									<input type="checkbox" name="s_shopall"/>
									<label class="cart_lightgray">店铺</label>
									<a href="" class="dz">可儿靓衣</a>
									<a href="" class="dz">联系客服</a>
									<span class="quantu"><img src="public/images/quan.png"/></span>
									<div class="fr pd50">
										<span class="red">优惠券：</span><a href="">领取</a>
									</div>
								</td>
							</tr>
							
							<?php
								$totalNum=0;
									$total=0;
									$totalPrice=0;
								if(!empty($_SESSION['shopcar'])){
									
									//var_dump($_SESSION['shopcar']);die;
									foreach($_SESSION['shopcar'] as $v){
										//echo $v['price'];die;
									$total = $v['price']*$v['buycount']*$v['count'];
									echo "<tr class='bordef'>";
										echo "<td><input type=\"checkbox\"/></td>";
										echo "
										<td class='goodimg'>
									<a href='prodetail.php?id={$v['id']}' class='carpdimg'>
									<img width='100px' src='../public/uploads/{$v['picname'] }'/></a>
								<a href='prodetail.php?id={$v['id']}' class='carptitle'>{$v['pname']}</a>
										</td>
										";
									echo "
										<td>
											<p>颜色:{$v['color']}</p>
											<p>尺码：{$v['size']}</p>
										</td>
									";
									
									echo "
										<td>
											<p class='yuprice'>{$v['price']}</p>
											<p class='cxprice'>".($v['price'])*($v['count'])."</p>
											<p class='discount'>促销{$v['count']}折</p>
										</td>
									";
									
									echo "<td>
									<a href='doaction.php?operate=sub&id={$v['id']}' style='border:1px solid #ccc' >&nbsp;-&nbsp;</a>
										{$v['buycount']}
						<a href='doaction.php?operate=jia&id={$v['id']}' style='border:1px solid #ccc'>&nbsp;+&nbsp;</a>
									
									</td>
									";
									echo "<td>
									
									
									<p class='zjprice'>".($v['buycount'])*($v['price'])*($v['count'])."</p></td>";
									echo "<td><a href='doaction.php?operate=del&id={$v['id']}' class='adel'>删除</a></td>";
									 $totalPrice+=($v['buycount'])*($v['price'])*($v['count']);
									 //$totalPrice+=$total;
									 $totalNum+=$v['buycount'];
									echo "</tr>";
									
									
								}
							}
							
							$_SESSION['totalPrice']=$totalPrice;
							$_SESSION['totalNum']=$totalNum;							
							?>
							
							
						
							
							
						</table>
					</div>
					<div class="carPay">
						<div class="cpleft">
							<!--<input type="checkbox"/><label class="pd5px">全选</label>-->
							<a href="index.php" class="payprice" >继续购物</a>
							
							<a href="doaction.php?operate=clear" class="c66px">清空所有商品</a>
						</div>
						<div class="cpright">
							<div class="jianshu">共有<span class="red pad5px"><?php echo $totalNum; ?></span>件商品，总计：</div>
							<span class="price red">¥<?php echo $totalPrice; ?></span>
							<a href="cmborder.php" class="payprice">去付款</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer clear">
			<div class="center"><a href="">蘑菇街</a> | <a href="">加入开放平台</a> © 2015 Mogujie.com,All Rights Reserved. </div>
		</div>
		
		<div class="mgj_rightbar">
			<div class="rbblank"></div>
			<div class="rbtux sidebar-item">
				<a href=""><img src="public/images/yhtx.jpg" width="20px" height="20px"/></a>
			</div>
			<div class="sidebar-item">
				<a href="">
					<div class="rbctitle">购物车</div>
					<div class="rbcnum">1</div>
				</a>
			</div>
			<div class="sidebar-item"><a href="">优惠券</a></div>
			<div class="sidebar-item rbyqb"><a href="">钱包</a></div>
			<div class="sidebar-item rbyzj"><a href="">足迹</a></div>
			<div class="sidebar-item rbytop "><a href="">返回到顶部</a></div>
			
		</div>
		
	</body>

</html>