<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	require "../public/dbconfig.php";
	require "../public/connect.php";
	//if(empty($_GET)){
		//header('location:index.php');
		//die;
	//}
	//$
	if(empty($_SESSION['users'])){
		echo "<script type='text/javascript'>alert('你还没有登录，请先登录！');Location='login.php'</script>";
		die;
	}
	if(empty($_GET['id'])){
		
		echo "<script type='text/javascript'>alert('没有选择订单！');Location='userorder.php'</script>";
		die;
	}
	$id=$_GET['id'];
	$status=$_GET['status'];
	

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>修改订单状态</title>
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/header.css"/>
		<link rel="stylesheet" href="public/css/usercenter.css"/>
		<link rel="stylesheet" href="public/css/footer.css"/>
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
		
		<div class="userbody clear">
			<div class="center">
				<?php require "public/userleft.php"; ?>
				<div class="userright fl">
					<div class="userheader"><span>修改基本资料</span></div>
					<div class="userinfo">
					
						<form action="doaction.php?operate=upstate" method="post">
						<input type="hidden" name="id" value="<?php  echo $_SESSION['users']['id'];?>"/>
							<dl>
								<?php  
									$sql4="select * from orders where id={$id}";
									//echo $sql4;die;
									$res4=mysql_query($sql4);
									$row4=mysql_fetch_assoc($res4);
								
								?>

								<input type="hidden" name="id" value="<?php echo $id; ?>"/>
								<dd>联系人：</dd>
								<dt class="uname">
								<input disabled class="r3 inputtext" disabled name="linkman" type="text" value="<?php  echo $row4['linkman'];?>"></dt>
								<dd>性别：</dd>
								<dt class="sex">
									<input type="radio" class="inputradio" style="margin:0;" <?php  echo $_SESSION['users']['sex']=='1'?'checked':'';?> name="sex" value="1"/>男
									<input type="radio" <?php  echo $_SESSION['users']['sex']=='0'?'checked':'';?> class="inputradio"  name="sex" value="0"/>女
								</dt>
								<dd>电话：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="phone" disabled value="<?php  echo $row4['phone'];?>"/></dt>
								<dd>地址：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="address" disabled value="<?php  echo $row4['address'];?>"/></dt>
								<dd>邮编：</dd>
								<dt class="uname">
								<input class="r3 inputtext" type="text" name="code" disabled value="<?php  echo $row4['code'];?>"/></dt>
								<dd>状态：</dd>
								<dt class="uname">
								<label><input class="inputradio" type="radio" name="status"  <?php  echo $status=='1'?'checked':'';?> value="1" disabled />新订单</label>
								<label><input class="inputradio" type="radio" name="status"  <?php  echo $status=='5'?'checked':'';?> value="5"/>已收货</label>
								<label><input class="inputradio" type="radio" name="status"  <?php  echo $status=='6'?'checked':'';?> value="6"/>取消订单</label>
								
								</dt>
								
								
								
							
								
								
								
								<dd></dd>
								<dt>
								<input value="修改" class="r3 sbut" type="submit">
								<input value="返回" onclick="javascript:location.href='userorder.php';" class="r3 sbut pleft"  type="button">
								
								</dt>
							</dl>
							
							
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
			require "public/footer.php";
		
		
		?>
		
	</body>

</html>