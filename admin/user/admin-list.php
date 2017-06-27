<?php
	session_start();
	if(empty($_SESSION['adminuser']))
	{
		
		echo "<script type='text/javascript'>alert('你还没有登录，请先登录！');location='../login.php';</script>";
		die();
		
	}
error_reporting(E_ALL & ~E_WARNING);
				error_reporting(E_ALL & ~E_NOTICE);
				date_default_timezone_set('PRC');
				require "../public/dbconfig.php";
				require "../public/connect.php";
				//$op=$_GET['op'];
				//$state=empty($op)?1:0;
				//$where="where state={$state} ";
				$where="where state=0";
				$search="";
				if(!(empty($_GET['username']))){
					$where .="  and username like '%{$_GET['username']}%'";
					//$where .=" and username like '%{$_GET['username']}%'";
					$search.="&username={$_GET['username']}";
				}
				$sql="select * from users {$where}";
				//echo $sql;die;
				$res=mysql_query($sql);
				$totalpage=@mysql_num_rows($res);
				//var_dump($totalpage);die;
				$pagesize=5;//每页显示几条数据
				$pagenum=@ceil($totalpage/$pagesize);//总共有多少页

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
                    window.location='action.php?operate=delete&id='+id;
                }
            }
 </script>


<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<form action="admin-list.php" method='get'>
	<div class="text-c"> 

		
		<input type="text" class="input-text" style="width:250px" placeholder="输入用户名称" id="" name="username" value="<?php echo @$_GET['username'] ?>">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<span class="l">
	<!--<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> -->
	
	<a href="member-add.php"  class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong><?php echo @$totalpage;?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="40">性别</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th width="">地址</th>
				
				<th width="130">加入时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				
				$currentpage=empty($_GET['p'])?1:$_GET['p'];//当前页
				if(@$_GET['p']<1){
					$currentpage=1;
				}
				if(@$_GET['p']>$pagenum){
					$currentpage=$pagenum;
				}
				$limit="  limit  ".($currentpage-1)*$pagesize.",{$pagesize}";
				//echo $where;die;
				$sql="select * from users {$where} {$limit}";
				$res=mysql_query($sql);
				//echo $sql;die;
				if($res){
						$count=mysql_num_rows($res);
						if($count==0){
							echo "<tr class='text-c'><td colspan='10'>没有数据,请添加用户吧</td></tr>";
						}
						while($rows=mysql_fetch_assoc($res)){
							
							echo "<tr class='text-c'>";
				echo "<td><input type='checkbox' value='1' name=''></td>";
								echo "<td>{$rows['id']}</td>";
								echo "<td>{$rows['username']}</td>";
								$sex=$rows['sex']=='1'?'男':'女';
								echo "<td>{$sex}</td>";
								echo "<td>{$rows['phone']}</td>";
								echo "<td>{$rows['email']}</td>";
								echo "<td>{$rows['address']}</td>";
								$time=date('Y-m-d H:i:s',$rows['addtime']);
								echo "<td>{$time}</td>";
								$state=$rows['state']=='1'?'普通会员':'管理员';
								echo "<td>{$state}</td>";
								
								echo "<td>";
							
								echo "	
								
								<a title='编辑' href='member-update.php?id={$rows['id']}'
									 class='ml-5' style='text-decoration:none'>
								<i class='Hui-iconfont'>&#xe6df;</i>
								</a> 
								";
								
								echo "<a style='text-decoration:none' class='ml-5'  href='updatepwd.php?id={$rows['id']}' title='修改密码'><i class='Hui-iconfont'>&#xe63f;</i></a>";
								
						$del="javascript:doDel({$rows['id']});";
								echo "<a href='{$del}' class='ml-5' style='text-decoration:none'>
								<i class='Hui-iconfont'>&#xe6e2;</i></a>";
								
								echo "</td>";
							echo "</tr>";
						}
						
						echo "<tr style=''><td colspan='10' align='right' style='width:100%;text-align:right;'>";
						echo "当前页数是&nbsp;&nbsp;{$currentpage}/{$pagenum}";
						echo "<a style='padding-left:10px;' href='admin-list.php?p=1{$search}'>首页</a>";
						echo "<a style='padding-left:10px;'  href='admin-list.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a style='padding-left:10px;'  href='admin-list.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a style='padding-left:10px;'   href='admin-list.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</td></tr>";
						

				}
				
			
			?>
		
		
			
		
		
		
		
		
		
		
			
		</tbody>
	</table>
	</div>
</div>

</body>
</html>