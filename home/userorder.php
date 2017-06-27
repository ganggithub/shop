<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	require "../public/dbconfig.php";
	require "../public/connect.php";
	if(empty($_SESSION['users']))
	{
		echo "<script type='text/javascript'>alert('你还没有登录，请先登录！');location='login.php';</script>";
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
				<?php require "public/userleft.php"; ?>
				<div class="orderright">
					<div class="odsearch" style=""><form action="userorder.php" method='get'>
	<div class="text-c"> 订单状态：
		
		<select name="status" class="input-text Wdate" style="width:120px;">
			<option value="1" <?php echo (@$_GET['status'])==1?"selected":"";?>>新订单</option>
			<option value="2" <?php echo (@$_GET['status'])==2?"selected":"";?>>待付款</option>
			<option value="3" <?php echo (@$_GET['status'])==3?"selected":"";?>>已发货</option>
			<option value="4" <?php echo (@$_GET['status'])==4?"selected":"";?>>待收货</option>
			<option value="5" <?php echo (@$_GET['status'])==5?"selected":"";?>>已收货</option>
			<option value="6" <?php echo (@$_GET['status'])==6?"selected":"";?>>无效订单</option>
		</select>
		
		<input type="text" class="input-text" style="width:250px" placeholder="输入产品总金额" id="" name="total" value="<?php echo @$_GET['total'] ?>">
		<input type="text" class="input-text" style="width:250px" placeholder="输入订单联系人" id="" name="linkman" value="<?php echo @$_GET['linkman'] ?>">
		<button type="submit" class="btn btn-success radius" id="" name=""> 查询订单信息</button>
	</div>
	</form></div>
						<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort" style="border: 1px solid #FFDB82;width:990px;">
		<thead>
			<tr class="text-c" style="">
				
				
				<th width="100" style="background:#FFF7EA;">订单ID</th>
				<th width="80" style="background:#FFF7EA;">会员名称</th>
				<th width="90" style="background:#FFF7EA;">联系人</th>
				<th width="150" style="background:#FFF7EA;">地址</th>
				<th width="" style="background:#FFF7EA;">电话</th>
				
				<th width="130" style="background:#FFF7EA;">购买时间</th>
				<th width="70" style="background:#FFF7EA;">总金额</th>
				<th width="70" style="background:#FFF7EA;">状态</th>
				<th width="100" style="background:#FFF7EA;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($_SESSION['users'])){
				$uid=$_SESSION['users']['id'];
			$where="";
	$search="";
	$wherelist=array();
	$urlist=array();
	if(!(empty($_GET['total']))){
		$wherelist[] =" total like '%{$_GET['total']}%'";
		$urlist[]="&total={$_GET['total']}";
		}
	if(!(empty($_GET['linkman']))){
		$wherelist[] =" linkman like '%{$_GET['linkman']}%'";
		$urlist[]="&linkman={$_GET['linkman']}";
		}
	if(!(empty($_GET['status']))){
		$wherelist[]=" status like '%{$_GET['status']}%'";
		$urlist[]="&status={$_GET['status']}";
		}
	
	$wherelist[]=" uid={$uid} ";
	$wherelist[]=" isdel=1 ";
	if(count($wherelist)>0){
		$where=" where ".implode(" and ",$wherelist);
		$search="&".implode("&",$urlist);
	}
	$sql="select count(*) from orders {$where}";
	//echo $sql;die;
	$res=mysql_query($sql);
	$totalpage=@mysql_result($res,0,0);
	//$totalpage=mysql_num_rows($res);
	//echo $totalpage;die;
	$pagesize=5;//每页显示几条数据
				
	$pagenum=ceil($totalpage/$pagesize);//总共有多少页	
			$currentpage=empty($_GET['p'])?1:$_GET['p'];//当前页
				if(@$_GET['p']<1){
					$currentpage=1;
				}
				if(@$_GET['p']>$pagenum){
					$currentpage=$pagenum;
				}
				$limit="  limit  ".($currentpage-1)*$pagesize.",{$pagesize}";
				//$sql="select * from orders {$where}  {$limit}";
			
				
				$sql3="select * from orders {$where} order by id desc  {$limit} ";
				//echo $sql3;die;
				$res3=mysql_query($sql3);
								if($res3 && mysql_num_rows($res3)>0){
									while($row3=mysql_fetch_assoc($res3)){
										$date=date('Y-m-d',$row3['addtime']);
										if($row3['status']==1){
											$status="新订单";
											}else if($row3['status']==2){
												$status="待付款";
											}else if($row3['status']==3){
												$status="已发货";
											}else if($row3['status']==4){
												$status="待收货";
											}else if($row3['status']==5)
											{
												$status="已收货";
											}else if($row3['status']==6){
												$status="无效订单";
											}
										?>
			<tr class="text-c">
				
			<td><?php echo $row3['id']; ?></td>
			<td><?php echo $_SESSION['users']['username']; ?></td>
			<td><?php echo $row3['linkman'];?></td>
			<td><?php echo $row3['address'];?></td>
			<td><?php echo $row3['phone'];?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $row3['total'];?></td>
			<td><?php echo $status;?></td>
			<td>
			<a title="查看详情订单" href="ordertail.php?id=<?php echo $row3['id']; ?>&status=<?php echo $row3['status']; ?>" class="ml-5" style="text-decoration:none;display: block;" >查看详情</a> 
			<a title="查看详情订单" href="upodstate.php?id=<?php echo $row3['id']; ?>&status=<?php echo $row3['status']; ?>" class="ml-5" style="text-decoration:none;display: block;" >
			
			<?php 
				if($row3['status']==5){
					echo "";
				}else{ echo "修改状态";}
			?>
			</a> 
			<a title="删除订单" href="doaction.php?operate=delorder&id=<?php echo $row3['id']; ?>" class="ml-5" style="text-decoration:none">删除订单</a> 
			
			</td>
			</tr>	
			<?php
			
							}
					echo "<tr><td colspan='11' align='right' style='width:100%;text-align:right;'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a style='padding-left:10px;' href='userorder.php?p=1{$search}'>首页</a>";
						echo "<a style='padding-left:10px;' href='userorder.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a style='padding-left:10px;' href='userorder.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a style='padding-left:10px;' href='userorder.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</td></tr>";		
				}}
			?>
		</tbody>
	</table>
	</div>
					
					
					
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