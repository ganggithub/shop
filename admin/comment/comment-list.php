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
		$wherelist[] =" pid in (select id from product where pname like '%{$_GET['pname']}%')";
		$urlist[]="&pname={$_GET['pname']}";
		}
	if(!(empty($_GET['content']))){
		$wherelist[] =" content like '%{$_GET['content']}%' ";
		$urlist[]="&content={$_GET['content']}";
		}

	$wherelist[] =" state=1 ";
	if(count($wherelist)>0){
		$where=" where ".implode(" and ",$wherelist);
		$search="&".implode("&",$urlist);
	}
	
	$sql="select * from comments {$where}";
	
	$res=mysql_query($sql);
	
	$totalpage=mysql_num_rows($res);
	
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 评论中心 <span class="c-gray en">&gt;</span> 评论管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<form action="comment-list.php" method='get'>
	<div class="text-c"> 
		
		<input type="text" class="input-text" style="width:250px" placeholder="输入产品名称" id="" name="pname" value="<?php echo @$_GET['pname'] ?>">
		<input type="text" class="input-text" style="width:250px" placeholder="输入评论的内容" id="" name="content" value="<?php echo @$_GET['content'] ?>">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 查询评论信息</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<span class="l">
	
	
	</span> <span class="r">共有数据：<strong><?php echo @$totalpage;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID号</th>
				<th width="80">产品名称</th>
				<th width="80">产品图片</th>
				<th width="90">收货人姓名</th>
				<th width="90">评论内容</th>
				<th width="80">收货人电话</th>
				<th width="180">收货人地址</th>
				<th width="90">评论时间</th>
				
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
				$sql="select * from comments {$where}  {$limit}";
				//echo $sql;die;
				$res=mysql_query($sql);
				$count=@mysql_num_rows($res);
						if($count==0){
							echo "<tr><td colspan='10'>没有数据,请添加商品吧</td></tr>";
						}
				if($res){
						while($rows=mysql_fetch_assoc($res)){
							
							echo "<tr class='text-c'>";
								echo "<td><input type='checkbox' value='1' name=''></td>";
								echo "<td>{$rows['id']}</td>";
								//根据产品id查商品名和图片
								$pid=$rows['pid'];
								$sqlp="select * from product where id={$pid}";
								$resp=mysql_query($sqlp);
								$rowp=mysql_fetch_assoc($resp);
								echo "<td>{$rowp['pname']}</td>";
								echo "<td><img width='100px' src='../../public/uploads/{$rowp['picname']}'</td>";
								//根居用户id查订单表的联系人和电话
								$uid=$rows['uid'];
								$sqlc="select * from orders where uid={$uid}";
								$resc=mysql_query($sqlc);
								$rc=mysql_fetch_assoc($resc);
								echo "<td>{$rc['linkman']}</td>";
								echo "<td>{$rows['content']}</td>";
								echo "<td>{$rc['phone']}</td>";
								
								echo "<td>{$rc['address']}</td>";
								$date=date('Y-m-d',$rows['addtime']);
								echo "<td>{$date}</td>";
								echo "<td><a href='comment-action.php?operate=upcmstate&id={$rows['id']}'>删除评论</a></td>";
								
							echo "</tr>";
						}
						echo "<tr><td colspan='10' align='right' style='width:100%;text-align:right;'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a style='padding-left:10px;' href='comment-list.php?p=1{$search}'>首页</a>";
						echo "<a style='padding-left:10px;' href='comment-list.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a style='padding-left:10px;' href='comment-list.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a style='padding-left:10px;' href='comment-list.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</td></tr>";
						
						
						
						
				}
			
			?>
		
		
			
		
		
		
		
		
		
		
			
		</tbody>
	</table>
	</div>
</div>

</body>
</html>