<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	require "../public/dbconfig.php";
	require "../public/connect.php";
	if(empty($_SESSION['users']))
	{
		echo "<script type='text/javascript'>alert('你还没有登录，请先登录！');location='index.php'</script>";
		die;
	}
	$uuid=$_SESSION['users']['id'];
	$where="";
	$search="";
	$wherelist=array();
	$urlist=array();
	if(!(empty($_GET['linkman']))){
		$wherelist[] =" linkman like '%{$_GET['pname']}%'";
		$urlist[]="&linkman={$_GET['pname']}";
		}
	
	$wherelist[] =" uid={$_SESSION['users']['id']}";
	//$wherelist[]=" p.isdel=1 ";
	if(count($wherelist)>0){
		$where=" where ".implode(" and ",$wherelist);
		$search="&".implode("&",$urlist);
	}
	
	$sql="select * from address {$where}";
	
	$res=mysql_query($sql);
	
	$totalpage=mysql_num_rows($res);
	
	$pagesize=5;//每页显示几条数据
				
	$pagenum=ceil($totalpage/$pagesize);//总共有多少页	
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
                    window.location='doaction.php?operate=deladdress&id='+id;
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
		
		<div class="orderbody clear">
			<div class="center">
				<!--<div class="ordernav fl">
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
							<li><a href="addresslist.php">地址管理</a></li>
						</ul>
					</div>
				</div>-->
				<?php require "public/userleft.php"; ?>
				<div class="orderright">
					
						<div class="pd-20">
	<form action="commentlist.php" method='get'>
	<div class="text-c">
		
		<!--<select name="state" class="input-text Wdate" style="width:120px;">
			<option value="1" <?php echo (@$_GET['state'])==1?"selected":"";?>>新品</option>
			<option value="2" <?php echo (@$_GET['state'])==2?"selected":"";?>>在售商品</option>
			<option value="3" <?php echo (@$_GET['state'])==3?"selected":"";?>>下线商品</option>
			<option value="4" <?php echo (@$_GET['state'])==4?"selected":"";?>>热卖商品</option>
			<option value="5" <?php echo (@$_GET['state'])==5?"selected":"";?>>促销商品</option>
		</select>-->
		
		<input type="text" class="input-text" style="width:250px" placeholder="输入产品名称" id="" name="pname" value="<?php echo @$_GET['pname'] ?>">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont"></i> 查询产品信息</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<span class="l">
	
	<a href="address.php"  class="btn btn-primary radius">添加地址</a>
	</span> <span class="r">共有数据：<strong><?php echo @$totalpage;?></strong> 条</span> </div>
	<div class="mt-20">
	
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">收货人</th>
				<th width="150">收货地址</th>
				<th width="100">电话</th>
				<th width="150">邮编</th>
				<th width="90">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				
				
				
				//echo $pagenum;die;
				$currentpage=empty($_GET['p'])?1:$_GET['p'];//当前页
				if(@$_GET['p']<1){
					$currentpage=1;
				}
				if(@$_GET['p']>$pagenum){
					$currentpage=$pagenum;
				}
				$limit="  limit  ".($currentpage-1)*$pagesize.",{$pagesize}";
				$sql="select * from address {$where}  {$limit}";
				//echo $sql;die;
				//echo $pagenum;die;
				$res=mysql_query($sql);
				//var_dump($res);die;
				$count=@mysql_num_rows($res);
						if($count==0){
							echo "<tr><td colspan='6'>没有数据,请添加地址吧</td></tr>";
						}
				if($res){
						while($rows=mysql_fetch_assoc($res)){
							// var_dump($rows);die;
							echo "<tr class='text-c'>";
								echo "<td><input type='checkbox' value='1' name=''></td>";
								echo "<td>{$rows['linkman']}</td>";
								echo "<td>{$rows['address']}</td>";
								
								
								echo "<td>{$rows['phone']}</td>";
								echo "<td>{$rows['code']}</td>";
								
								
								
								echo "<td>";
								
								
								
								
								
								echo "	
								
						<a title='设为默认' style=\"display:block;\" href='doaction.php?operate=upaddressstate&id={$rows['id']}' class='ml-5' style='text-decoration:none'>
									 
								<i class='Hui-iconfont'>设为默认</i>
								</a> 
								";
								
						$del="javascript:doDel({$rows['id']});";
								echo "<a href='{$del}' class='ml-5' style='text-decoration:none'>
								<i class='Hui-iconfont'>删除地址</i></a>";
								
								echo "</td>";
							echo "</tr>";
						}
						echo "<tr><td colspan='8' align='right' style='width:100%;text-align:right;'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a style='padding-left:10px;' href='addresslist.php?p=1{$search}'>首页</a>";
						echo "<a style='padding-left:10px;' href='addresslist.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a style='padding-left:10px;' href='addresslist.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a style='padding-left:10px;' href='addresslist.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</td></tr>";
						
						
						
						
				}
			
			?>
		
		
			
		
		
		
		
		
		
		
			
		</tbody>
	</table>
	</div>
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