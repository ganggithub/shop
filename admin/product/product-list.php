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
	if(!(empty($_GET['pname']))){
		$wherelist[] =" pname like '%{$_GET['pname']}%'";
		$urlist[]="&pname={$_GET['pname']}";
		}
	if(!(empty($_GET['state']))){
		$wherelist[]=" state like '%{$_GET['state']}%'";
		$urlist[]="&state={$_GET['state']}";
		}
	if(count($wherelist)>0){
		$where=" where ".implode(" and ",$wherelist);
		$search="&".implode("&",$urlist);
	}
	$sql="select count(*) from product {$where}";
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
                    window.location='product-action.php?operate=delete&id='+id;
                }
            }
 </script>


<title>产品类别管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品中心 <span class="c-gray en">&gt;</span> 产品类别管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<form action="product-list.php" method='get'>
	<div class="text-c"> 商品状态：
		
		<select name="state" class="input-text Wdate" style="width:120px;">
			<option value="1" <?php echo (@$_GET['state'])==1?"selected":"";?>>新品</option>
			<option value="2" <?php echo (@$_GET['state'])==2?"selected":"";?>>在售商品</option>
			<option value="3" <?php echo (@$_GET['state'])==3?"selected":"";?>>下线商品</option>
			<option value="4" <?php echo (@$_GET['state'])==4?"selected":"";?>>热卖商品</option>
			<option value="5" <?php echo (@$_GET['state'])==5?"selected":"";?>>促销商品</option>
		</select>
		
		<input type="text" class="input-text" style="width:250px" placeholder="输入产品名称" id="" name="pname" value="<?php echo @$_GET['pname'] ?>">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 查询产品信息</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<span class="l">
	
	
	<a href="product-add.php"  class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span class="r">共有数据：<strong><?php echo @$totalpage;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID号</th>
				<th width="80">产品名称</th>
				<th width="60">产品价格</th>
				<th>产品类别</th>
				<th width="90">产品图片</th>
				<th width="80">产品状态</th>
				<th width="60">产品库存</th>
				<th width="90">产品点击量</th>
				<th width="90">产品销售量</th>
				<th width="90">产品上传时间</th>
				<th width="80">操作</th>
				
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
				$sql="select * from product {$where} order by id desc  {$limit}";
				//echo $sql;die;
				//echo $pagenum;die;
				$res=mysql_query($sql);
				//var_dump($res);die;
				$count=@mysql_num_rows($res);
						if($count==0){
							echo "<tr><td colspan='12'>没有数据,请添加商品吧</td></tr>";
						}
				if($res){
						while($rows=mysql_fetch_assoc($res)){
							// var_dump($rows);die;
							echo "<tr class='text-c'>";
								echo "<td><input type='checkbox' value='1' name=''></td>";
								echo "<td>{$rows['id']}</td>";
								echo "<td>{$rows['pname']}</td>";
								echo "<td>{$rows['price']}</td>";
								$cid=$rows['cid'];
								$sqlc="select * from category where id={$cid}";
								$resc=mysql_query($sqlc);
								$rc=mysql_fetch_assoc($resc);
								
								
								
								echo "<td>{$rc['name']}</td>";
								echo "<td><img width='60px' height='60px' src='../../public/uploads/{$rows['picname']}'/></td>";
								
								if($rows['state']==1){
									$state="新品";
								}else if($rows['state']==2){
									$state="在售商品";
								}else if($rows['state']==3){
									$state="下线商品";
								}else if($rows['state']==4){
									$state="热销商品";
								}else if($rows['state']==5){
									$state="促销商品";
								}
								echo "<td>{$state}</td>";
								echo "<td>{$rows['store']}</td>";
								echo "<td>{$rows['num']}</td>";
								echo "<td>{$rows['clicknum']}</td>";
								$date=date('Y-m-d',$rows['addtime']);
								echo "<td>{$date}</td>";
								
								echo "<td>";
								
								
								
								
								
								echo "	
								
						<a title='编辑' href='product-update.php?id={$rows['id']}' class='ml-5' style='text-decoration:none'>
									 
								<i class='Hui-iconfont'>&#xe6df;</i>
								</a> 
								";
								
						$del="javascript:doDel({$rows['id']});";
								echo "<a href='{$del}' class='ml-5' style='text-decoration:none'>
								<i class='Hui-iconfont'>&#xe6e2;</i></a>";
								
								echo "</td>";
							echo "</tr>";
						}
						echo "<tr><td colspan='12' align='right' style='width:100%;text-align:right;'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a style='padding-left:10px;' href='product-list.php?p=1{$search}'>首页</a>";
						echo "<a style='padding-left:10px;' href='product-list.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a style='padding-left:10px;' href='product-list.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a style='padding-left:10px;' href='product-list.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</td></tr>";
						
						
						
						
				}
			
			?>
		
		
			
		
		
		
		
		
		
		
			
		</tbody>
	</table>
	</div>
</div>

</body>
</html>