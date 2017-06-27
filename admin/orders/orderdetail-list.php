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
	if(empty($_GET['id'])){
		echo "<script type='text/javascript'>alert('你还没有选择订单，请选择订单！');location='orders-list.php';</script>";
	}
	$id=$_GET['id'];
	$where="";
	$search="";
	$wherelist=array();
	$urlist=array();
	if(!(empty($_GET['pname']))){
		$wherelist[] =" od.pname like '%{$_GET['pname']}%'";
		$urlist[]="&pname={$_GET['pname']}";
		}
	if(!(empty($_GET['orderid']))){
		$wherelist[]=" od.orderid like '%{$_GET['orderid']}%'";
		$urlist[]="&orderid={$_GET['orderid']}";
		}
	//$sql3="select * from orderdetail od,product p where orderid={$id} and od.pid=p.id";
	$wherelist[]=" od.orderid={$id} ";
	$wherelist[]=" od.pid=p.id ";
	
	
	if(count($wherelist)>0){
		$where=" where ".implode(" and ",$wherelist);
		$search="&".implode("&",$urlist);
	}
	$sql="select od.price,od.orderid,od.id,od.pid,od.buynum,od.pname,p.picname from orderdetail od,product p {$where}";
	
	//echo $sql;die;
	$res=mysql_query($sql);
	//var_dump($res);
	//echo $res;
	//die;
	//$totalpage=@mysql_result($res,0,0);
	//var_dump(mysql_num_rows($res));die;
	$totalpage=mysql_num_rows($res);
	
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单中心 <span class="c-gray en">&gt;</span> 订单详情管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<form action="orderdetail-list.php?id=<?php  echo $id; ?>" method='get'>
	<div class="text-c"> 商品状态：
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="" name="orderid" value="<?php echo @$_GET['orderid'] ?>">
		<input type="text" class="input-text" style="width:250px" placeholder="输入产品名称" id="" name="pname" value="<?php echo @$_GET['pname'] ?>">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 查询产品信息</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	 <span class="r">共有数据：<strong><?php echo @$totalpage;?></strong> <?php echo $totalpage ;?>条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID号</th>
				<th width="100">订单ID号</th>
				<th width="100">商品ID号</th>
				<th width="150">商品图片</th>
				<th width="90">商品名称</th>
				<th width="60">单价</th>
				<th width="60">数量</th>
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
				$sql="select od.price,od.orderid,od.id,od.pid,od.buynum,od.pname,p.picname from orderdetail od,product p {$where} order by id desc {$limit}";
				//echo $sql;die;
				//echo $pagenum;die;
				$res=mysql_query($sql);
				//var_dump($res);die;
				$count=@mysql_num_rows($res);
						if($count==0){
							echo "<tr><td colspan='9'>没有数据,请添加商品吧</td></tr>";
						}
				if($res){
						while($rows=mysql_fetch_assoc($res)){
							// var_dump($rows);die;
							echo "<tr class='text-c'>";
								echo "<td><input type='checkbox' value='1' name=''></td>";
								echo "<td>{$rows['id']}</td>";
								
								echo "<td>{$rows['orderid']}</td>";
								echo "<td>{$rows['pid']}</td>";
								echo "<td><img width='100px' src='../../public/uploads/{$rows['picname']}'</td>";
								echo "<td>{$rows['pname']}</td>";
								
								
								echo "<td>{$rows['price']}</td>";
								echo "<td>{$rows['buynum']}</td>";
								
								echo "<td>";
								echo "	
								
								<a href='orders-list.php' title='返回' class='ml-5' style='text-decoration:none'><i class=\"Hui-iconfont\">&#xe66b;</i></a>
								";
								
								echo "</td>";
							echo "</tr>";
						}
						echo "<tr><td colspan='9' align='right' style='width:100%;text-align:right;'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a style='padding-left:10px;' href='orderdetail-list.php?p=1&id={$id}{$search}'>首页</a>";
						echo "<a style='padding-left:10px;' href='orderdetail-list.php?p=".($currentpage-1)."&id={$id}{$search}'>上一页</a>";
						echo "<a style='padding-left:10px;' href='orderdetail-list.php?p=".($currentpage+1)."&id={$id}{$search}'>下一页</a>";
						echo "<a style='padding-left:10px;' href='orderdetail-list.php?p={$pagenum}&id={$id}{$search}'>尾页<a/>";
						echo "</td></tr>";
						
						
						
						
				}
			
			?>
		
		
			
		
		
		
		
		
		
		
			
		</tbody>
	</table>
	</div>
</div>

</body>
</html>