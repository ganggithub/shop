<?php
	session_start();
	date_default_timezone_set('PRC');
	require "../public/dbconfig.php";
	require "../public/connect.php";
	
	if(empty($_SESSION['adminuser']))
	{
		
		echo "<script type='text/javascript'>alert('你还没有登录，请先登录！');location='../login.php';</script>";
		die();
		
	}
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


?>
<!DOCTYPE HTML>
<html>
<head>

<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,member-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link href="../public/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="../public/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="../public/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />


 <script type="text/javascript">
            //定义一个执行删除判断函数
            function doDel(id){
                if(confirm("确定要删除吗？")){
                    //跳转网页,并携带参数
                    window.location='orders-action.php?operate=delete&id='+id;
                }
            }
 </script>


<title>产品订单管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单中心 <span class="c-gray en">&gt;</span> 产品订单管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<form action="orders-list.php" method='get'>
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
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 查询订单信息</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	 <span class="r">共有数据：<strong><?php echo @$totalpage;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID号</th>
				<th width="60">会员名称</th>
				<th width="50">联系人</th>
				<th>邮编</th>
				<th width="90">地址</th>
				<th width="60">电话</th>
				<th width="60">购物时间</th>
				<th width="80">总金额</th>
				<th width="90">状态</th>
				
				<th width="100">操作</th>
				
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
				$sql="select * from orders {$where} order by id desc {$limit}";
				//echo $sql;die;
				//echo $pagenum;die;
				$res=mysql_query($sql);
				//var_dump($res);die;
				$count=@mysql_num_rows($res);
						if($count==0){
							echo "<tr><td colspan='11'>没有数据,请添加商品吧</td></tr>";
						}
				if($res){
						$status="";
						while($rows=mysql_fetch_assoc($res)){
							// var_dump($rows);die;
							echo "<tr class='text-c'>";
								echo "<td><input type='checkbox' value='1' name=''></td>";
								echo "<td>{$rows['id']}</td>";
								$uid=$rows['uid'];
								$sqlu="select * from users where id={$uid}";
								$resu=mysql_query($sqlu);
								$rowu=mysql_fetch_assoc($resu);
								echo "<td>{$rowu['username']}</td>";
								echo "<td>{$rows['linkman']}</td>";
								echo "<td>{$rows['code']}</td>";
								echo "<td>{$rows['address']}</td>";
								echo "<td>{$rows['phone']}</td>";
								
								$date=date('Y-m-d',$rows['addtime']);
								echo "<td>{$date}</td>";
								echo "<td>{$rows['total']}</td>";
								
								if($rows['status']==1){
									$status="新订单";
								}else if($rows['status']==2){
									$status="待付款";
								}else if($rows['status']==3){
									$status="已发货";
								}else if($rows['status']==4){
									$status="待收货";
								}else if($rows['status']==5){
									$status="已收货";
								}else if($rows['status']==6){
									$status="无效订单";
								}
								//echo $rows['status'];die;
								echo "<td>{$status}</td>";
								echo "<td>";
								echo "	
								<a href='orderdetail-list.php?id={$rows['id']}' title='查看详情' class='ml-5' style='text-decoration:none'><i class=\"Hui-iconfont\">&#xe665;</i></a>
								
						<a title='编辑' href='orders-action.php?operate=update&id={$rows['id']}' class='ml-5' style='text-decoration:none'>
									 ";
									 $ss="";
									if($rows['status']==6 || $rows['status']==5) {
										$ss="";
									}else{$ss="<i class='Hui-iconfont'>&#xe6df;</i>";}
									 
								echo empty($ss)?"":"<i class='Hui-iconfont'>&#xe6df;</i>";
								echo "</a>";
								
						$del="javascript:doDel({$rows['id']});";
								echo "<a href='{$del}' class='ml-5' style='text-decoration:none'>
								<i class='Hui-iconfont'>&#xe6e2;</i></a>";
								
								echo "</td>";
							echo "</tr>";
						}
						echo "<tr><td colspan='11' align='right' style='width:100%;text-align:right;'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a style='padding-left:10px;' href='orders-list.php?p=1{$search}'>首页</a>";
						echo "<a style='padding-left:10px;' href='orders-list.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a style='padding-left:10px;' href='orders-list.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a style='padding-left:10px;' href='orders-list.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</td></tr>";
						
						
						
						
				}
			
			?>
		
		
			
		
		
		
		
		
		
		
			
		</tbody>
	</table>
	</div>
</div>

</body>
</html>