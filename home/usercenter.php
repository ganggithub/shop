<?php
	session_start();
	require "../public/dbconfig.php";
	require "../public/connect.php";
	

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>确认订单页面</title>
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/header.css"/>
		<link rel="stylesheet" href="public/css/usercenter.css"/>
		<link rel="stylesheet" href="public/css/order.css"/>
		<link rel="stylesheet" href="public/css/H-ui.min.css"/>
		<link rel="stylesheet" href="public/css/footer.css"/>
		 <script type="text/javascript">
            //定义一个执行删除判断函数
            function doDel(id){
                if(confirm("确定要删除吗？")){
                    //跳转网页,并携带参数
                    window.location='doaction.php?operate=userdel&id='+id;
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
		
		<div class="userbody clear">
			<div class="center">
				<?php require "public/userleft.php"; ?>
				<div class="userright fl">
					<div class="userheader"><span>基本资料</span></div>
					<div class="userinfo">
					<div class="orderright">
							<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort" style="border: 1px solid #FFDB82;width:990px;">
		<thead>
			<tr class="text-c" style="">
				
				
				<th width="100" style="background:#FFF7EA;">用户名</th>
				<th width="40" style="background:#FFF7EA;">性别</th>
				<th width="90" style="background:#FFF7EA;">手机</th>
				<th width="150" style="background:#FFF7EA;">邮箱</th>
				<th width="" style="background:#FFF7EA;">地址</th>
				
				<th width="130" style="background:#FFF7EA;">加入时间</th>
				<th width="70" style="background:#FFF7EA;">状态</th>
				<th width="100" style="background:#FFF7EA;">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php  
			$uid=$_SESSION['users']['id'];
			$sql="select * from users where id={$uid}";
			$res=mysql_query($sql);
			$row=mysql_fetch_assoc($res);
		?>
			<tr class="text-c">
				<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['sex']==1?"男":"女"; ?></td>
			<td><?php echo $row['phone']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo date("Y-m-d",$row['addtime']); ?></td>
			<td><?php echo $row['state']; ?></td>
			<td>
			<a title="编辑" href="useredit.php?uid=<?php  echo $row['id'];?>" class="ml-5" style="text-decoration:none">编辑</a> 
			
			</td>
			<!--<td><?php echo $_SESSION['users']['username']; ?></td>
			<td><?php echo $_SESSION['users']['sex']==1?"男":"女"; ?></td>
			<td><?php echo $_SESSION['users']['phone']; ?></td>
			<td><?php echo $_SESSION['users']['email']; ?></td>
			<td><?php echo $_SESSION['users']['address']; ?></td>
			<td><?php echo date("Y-m-d",$_SESSION['users']['addtime']); ?></td>
			<td><?php echo $_SESSION['users']['state']; ?></td>
			<td>
			<a title="编辑" href="useredit.php" class="ml-5" style="text-decoration:none">编辑</a> 
			
			</td>-->
			</tr>		
		</tbody>
	</table>
	</div>
					
					</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php require "public/footer.php"; ?>
		
	</body>

</html>