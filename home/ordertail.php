<?php
	session_start();
	require "../public/dbconfig.php";
	require "../public/connect.php";
	if(empty($_SESSION['users']))
	{
		echo "<script type='text/javascript'>alert('你还没有登录，请先登录！');location='index.php'</script>";
		die;
	}
	
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>确认订单页面</title>
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/header.css"/>
		<link rel="stylesheet" href="public/css/order.css"/>
		<link rel="stylesheet" href="public/css/H-ui.min.css"/>
		<link rel="stylesheet" href="public/css/footer.css"/>
		 <script type="text/javascript">
            //定义一个执行删除判断函数
            function doDel(id){
                if(confirm("确定要删除吗？")){
                    //跳转网页,并携带参数
                    window.location='doaction.php?operate=upstate&oid='+id;
                }
            }
 </script>
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
		
		<div class="orderbody clear">
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
							<li><a href="shopcar.php?uid=<?php echo $_SESSION['users']['id']; ?>&state=2">待付款</a></li>
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
				<div class="orderright">
					
						<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort" style="border: 1px solid #FFDB82;width:990px;">
		<thead>
			<tr class="text-c" style="">
				<th width="120" style="background:#FFF7EA;text-align:left;" colspan="8">
					<?php if(!empty($_GET['id'])){
						$id=$_GET['id'];
						$sql4="select * from orders where id={$id}";
						$res4=mysql_query($sql4);
						if($res4 && mysql_num_rows($res4)>0){
							$row4=mysql_fetch_assoc($res4);
							echo "<span style=\"padding-right:30px;\">订单号：{$row4['id']}</span>";
							echo "<span style=\"padding-right:30px;\">收件人：{$row4['linkman']}</span>";	
							
							echo "<span style=\"padding-right:30px;\">收货地址：{$row4['address']}</span>";	
							
							echo "<span style=\"padding-right:30px;\">成交时间：".date('Y-m-d',$row4['addtime'])."</span>";

						}
							}
					?>
				
				</th>
			</tr>
			<tr class="text-c" style="">
				
				
				<th width="120" style="background:#FFF7EA;">订单ID</th>
				
				<th width="100" style="background:#FFF7EA;">会员名称</th>
				<th width="150" style="background:#FFF7EA;">商品图片</th>
				<th width="150" style="background:#FFF7EA;">商品名称</th>
				<th width="150" style="background:#FFF7EA;">商品单价</th>
				<th width="" style="background:#FFF7EA;">购买数量</th>
	
				<th width="70" style="background:#FFF7EA;">状态</th>
				<th width="" style="background:#FFF7EA;">操作</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($_GET['id'])){
				
				$id=$_GET['id'];
		
				
			
			
			
							
								$status=$_GET['status'];
								$sql3="select *  from orderdetail od,product p where orderid={$id} and od.pid=p.id";
								$res3=mysql_query($sql3);
								if($res3 && mysql_num_rows($res3)>0){
									while($row3=mysql_fetch_assoc($res3)){
										
										
										?>
			<tr class="text-c">
				
			<td><?php echo $id; ?></td>
			<td><a href="usercenter.php"><?php echo $_SESSION['users']['username']; ?></a></td>
			<td><img width='100px' src="../public/uploads/<?php echo $row3['picname'];?>"></td>
			<td><a href="prodetail.php?id=<?php  echo $row3['pid']; ?>"><?php echo $row3['pname'];?></a></td>
			<td>￥<?php echo $row3['price'];?></td>
			<td><?php echo $row3['buynum'];?></td>
			<td><?php echo $status;?></td>
			<td>
				<a href="userorder.php?uid=<?php echo $_SESSION['users']['id']; ?>" style='display:block;'>返回订单</a>
				<a href="addcoment.php?id=<?php echo $row3['id']; ?>">
			<?php 
					echo $status==5?"添加评论":"";
				
				
				?>
				
				
				
				</a>
			
			</td>
			</tr>	
			<?php
			
							}
							
			
							
							
							}}
			?>
		</tbody>
	</table>
	</div>
					
				<!--<button	 onclick="history.go(-1)"></button>	history.go(-1)-->
					
				</div>
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
			</div>
		</div>
		
	</body>

</html>