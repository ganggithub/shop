<?php
	session_start();
	if(empty($_SESSION['adminuser']))
	{
		
		echo "<script type='text/javascript'>alert('你还没有登录，请先登录！');location='../login.php';</script>";
		die();
		
	}
	
	date_default_timezone_set('PRC');
				require "../public/dbconfig.php";
				require "../public/connect.php";
				$where="";
				$search="";
				if(!(empty($_GET['name']))){
					$where .=" where name like '%{$_GET['name']}%'";
					$search.="&name={$_GET['name']}";
				}
				$sql="select * from category {$where}";
				//echo $sql;die;
				$res=mysql_query($sql);
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
                    window.location='cateaction.php?operate=delete&id='+id;
                }
            }
 </script>


<title>产品类别管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品中心 <span class="c-gray en">&gt;</span> 产品类别管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<form action="category-list.php" method='get'>
	<div class="text-c"> 
		
	
		<input type="text" class="input-text" style="width:250px" placeholder="输入用户名称" id="" name="name" value="<?php echo @$_GET['name'] ?>">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜产品类别名</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<span class="l">
	
	
	<a href="category-add.php"  class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong><?php echo @$totalpage;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID号</th>
				<th width="100">类别名称</th>
				<th width="40">父cid</th>
				<th width="90">路径</th>
				<th width="150">操作</th>
				
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
				$sql="select * from category {$where}  order by concat(path,id) {$limit}";
				//echo $sql;die;
				//echo $pagenum;die;
				$res=mysql_query($sql);
				$count=mysql_num_rows($res);
						if($count==0){
							echo "<tr><td colspan='6'>没有数据,请添加用户吧</td></tr>";
						}
				if($res){
						while($rows=mysql_fetch_assoc($res)){
							 //计算类别名前空格数量
							$m = substr_count($rows['path'],",")-1; //计算path中逗号的次数-1
							$str = @str_repeat("&nbsp;",$m*4);
							echo "<tr class='text-c'>";
								echo "<td><input type='checkbox' value='1' name=''></td>";
								echo "<td>{$rows['id']}</td>";
								echo "<td>{$str}|--{$rows['name']}</td>";
								echo "<td>{$rows['pid']}</td>";
								echo "<td>{$rows['path']}</td>";
								echo "<td>";
								//$pid="{$rows['id']}&{$rows['path']}&name={$rows['name']}";
								echo "	
								
							<a title='添加产品子类' href='category-add.php?id={$rows['id']}&path={$rows['path']}&name={$rows['name']}' class='ml-5' style='text-decoration:none'>
								<i class='Hui-iconfont'>&#xe63f;</i>
								</a> 
								";
								
								
								
								echo "	
								
						<a title='编辑' href='category-update.php?id={$rows['id']}' class='ml-5' style='text-decoration:none'>
									 
								<i class='Hui-iconfont'>&#xe6df;</i>
								</a> 
								";
								
						$del="javascript:doDel({$rows['id']});";
								echo "<a href='{$del}' class='ml-5' style='text-decoration:none'>
								<i class='Hui-iconfont'>&#xe6e2;</i></a>";
								
								echo "</td>";
							echo "</tr>";
						}
						echo "<tr><td colspan='6' align='right' style='width:100%;text-align:right;'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a style='padding-left:10px;' href='category-list.php?p=1{$search}'>首页</a>";
						echo "<a style='padding-left:10px;' href='category-list.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a style='padding-left:10px;' href='category-list.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a style='padding-left:10px;' href='category-list.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</td></tr>";
						
						
						
						
				}
			
			?>
		
		
			
		
		
		
		
		
		
		
			
		</tbody>
	</table>
	</div>
</div>

</body>
</html>