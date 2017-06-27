<?php
	session_start();
	require "../public/dbconfig.php";
	require "../public/connect.php";
	error_reporting(E_ALL ^ E_NOTICE); 

?>
<!doctype html>
<html>
	<head>
		
		<meta charset="utf-8">
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/header.css"/>
		<link rel="stylesheet" href="public/css/prodlist.css"/>
		<link rel="stylesheet" href="public/css/searchlist.css"/>
		
		<link rel="stylesheet" href="public/css/footer.css"/>
		
		<title>商品列表页</title>
	</head>
	<body>
		<!--<div class="header">
			<div class="center">
				<a href="index.php" class="home fl">蘑菇街首页</a>
				<ul class="header_top">
					<li class="s1">
						<?php
						if(!empty($_SESSION['users'])){
							echo "<a href='usercenter.php?id={$_SESSION['users']['id']}'><span style='font-weight:bold;'>{$_SESSION['users']['username']}</span>欢迎登录</a>
							<a href='../home/logout.php' style='padding-left:15px;'>退出登录</a>
							
							";
							?>
					<li class="s1 has_line user_fav">
						<a href="">我的收藏</a>
						<ul class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="searchlist.php?uid=
								<?php
							if(!empty($_SESSION['users'])){
								echo $_SESSION['users']['id'];
							}
							?>">喜欢的商品</a></li>
							<?php
						}else{
							
							echo "<a href='register.php' style='padding-right:10px;'>注册</a>
						<a href='login.php'>登录</a>";
						}
						
						
						?>
						
						</ul>
					</li>
					<li class="s1 has_line">
						<a href="userorder.php">我的订单</a>
					</li>
					<li class="s1 has_line">
						<a href="shopcar.php"><span class="cart_info">购物车<b class="num">
						
						
							
							
								
								<?php
								echo !empty($_SESSION['totalNum'])?$_SESSION['totalNum']:"0";
								
								
								?>
						
						</b>件</span></a>
					</li>
					<li class="s1 has_line">
						<a href="">客户服务</a>
						<ol class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="#">联系合作</a></li>
							<li class="s2"><a target="_blank" rel="nofollow" href="#">帮助</a></li>
						   
						</ol>
					</li>
					<li class="s1 has_line">
						<a href="">我的小店</a>
					</li>
				
							
						
					</li>
					
					
					
					
				</ul>
			</div>
		</div>-->
		<div class="header">
			<div class="center">
				<a href="index.php" class="home fl">蘑菇街首页</a>
				<ul class="header_top">
					<li class="s1">
						<?php
						if(!empty($_SESSION['users'])){
							echo "<a href='usercenter.php?id={$_SESSION['users']['id']}'>
							<span style='font-weight:bold;'>{$_SESSION['users']['username']}</span>欢迎登录</a>
							<a href='../home/logout.php' style='padding-left:15px;'>退出登录</a>
							
						";}else{
							echo "<a href='login.php' style='margin-right:5px;'>登录&nbsp;</a>";
							echo "<a href='register.php'>注册</a>";
						}
							?>
					</li>
					
					<li class="s1 has_line user_fav">
						<a href="searchlist.php?uid=<?php echo @$_SESSION['users']['id']; ?>">我的收藏</a>
						<ul class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="searchlist.php?uid=<?php echo @$_SESSION['users']['id']; ?>">喜欢的商品</a></li>
						</ul>
					</li>
					<li class="s1 has_line">
						<a href="userorder.php">我的订单</a>
					</li>
					<li class="s1 has_line">
						<a href="shopcar.php"><span class="cart_info">购物车<b class="num">
						
						<?php
								echo !empty($_SESSION['totalNum'])?$_SESSION['totalNum']:"0";
								
								
								?>
						
						</b>件</span></a>
					</li>
					<li class="s1 has_line">
						<a href="">客户服务</a>
						<ol class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="#">联系合作</a></li>
							<li class="s2"><a target="_blank" rel="nofollow" href="#">帮助</a></li>
						   
						</ol>
					</li>
					<li class="s1 has_line">
						<a href="">我的小店</a>
					</li>
				</ul>
			</div>
		</div>
		
		
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
							<input class="ts_txt fl" name="name" type="text" value="简约百搭欧美大牌短靴"/>
							<input class="ts_btn" type="submit" value="搜索"/>
						</form>
					</div>
					<div class="ts_hotwords">
						<?php  
							$sql="select * from category";
							$res=mysql_query($sql);
							if($res && mysql_num_rows($res)>0){
								while($row=mysql_fetch_assoc($res)){
									echo "<a href='searchlist.php?cid={$row['id']}'>{$row['name']}</a>";
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
			<div class="mod_list clear">
			<div class="center">
				<ol>
					<li><a href="index.php">首页</a></li>
					<li class="prodall"><a href="searchlist.php" >全部商品</a>
						
							<dl class="category_list11">
								 <?php 
			     //准备sql语句,取出分类表里排好序的所有分类
			     $sql ="select id,name,pid,path,concat(path,id) as pathid from category order by pathid";
                 //发送
				 $res = mysql_query($sql);
                //如果有结果集,也就是分类表里有数据
				if($res){
					//每次循环一个分类
					while($row = mysql_fetch_assoc($res)){
						 
						   //取出所有的分类记录
						   $arr[]=$row;
						   //将所有的pid取出
						   $pid[]=$row['pid'];
						   //将所有的pid取出,并过滤掉重复的
						   //$pidarr =array_unique($pid);
					}
					//$arr存的是分类表里所有的分类
					foreach($arr as $k=>$v){
						  //统计path字段里有多少,
						   $count = substr_count($v['path'],',');
						   //统计-重复的次数 ,一级类重复一次 二级 重复两次......
						   $html = str_repeat('&nbsp;',$count*3);
						
							echo "<dd><a href='searchlist.php?cid={$v['id']}'>{$html}|--{$v['name']}</a></dd>";
						
					}
				}
                   ?>
								
							</dl>
					
					
					</li>
					<?php   
						$sql="select * from category where  pid=0";
						$res=mysql_query($sql);
						if($res && mysql_num_rows($res)>0){
							while($rows=mysql_fetch_assoc($res)){	
						?>
						<li class="prodall"><a href='searchlist.php?cid=<?php  echo $rows['id'] ;?>'><?php  echo $rows['name']; ?></a>
						<dl class="category_list11">
							<?php $sql2="select * from category where pid={$rows['id']}";
								$res2=mysql_query($sql2);
								while($rows2=mysql_fetch_assoc($res2)){								?>
						<dd><a href="searchlist.php?cid=<?php echo $rows2['id'];?>"><?php echo $rows2['name'] ; ?></a></dd>
								<?php } ?>
								</dl>
								</li>
						<?php
							}
						}?>
					
					
				</ol>
			</div>
		</div>
		
		
		
		
		
		
			<div class="prod_common clear">
				<div class="center">
					<div class="common_tips">
						<img src="public/images/brand/chao.png"/>
					</div>
						<div class="product clear">
					<ul class="category_list fl">
					
						<?php
							//var_dump($_GET['cid']);
							//var_dump($_GET['name']);die;
						
							if(!empty($_GET['cid'])){
								$id=$_GET['cid'];
								$sql="select * from category where pid={$id}";
								//echo $sql;die;
								$res=mysql_query($sql);
								//var_dump($res);die;
								$row=mysql_fetch_assoc($res);
								//var_dump($row);die;
								if($id==$row['pid']){
									$sql1="select * from product where cid in (select id from category where pid={$id})";
									//echo $sql1;die;
									$res1=mysql_query($sql1);
									if($res1 && mysql_num_rows($res1)>0){
										while($row1=mysql_fetch_assoc($res1)){
											echo "<li class=\"category_li\">";
											echo "<a href=\"prodetail.php?id={$row1['id']}\"><img src=\"../public/uploads/{$row1['picname']}\" alt=\"\" title=\"\"/></a>";
											echo "<p class=\"category_title\"><a href=\"prodetail.php?id={$row1['id']}\">{$row1['pname']}</a></p>";
										echo "<p class=\"category_info\">
								<span class=\"txt_like\">{$row1['clicknum']}</span>
								<span class=\"txt_nowprice info_nowprice\"><i>¥</i>{$row1['price']}</span>
								<span class=\"txt_nowprice info_nowprice shoucang\"><a  href=\"doaction.php?operate=addcollect&id={$row1['id']}&uid={$_SESSION['users']['id']}\">收藏</a></span>
								
							</p>";
											echo "</li>";
											
											
							
							
						
											
										}
									}else{
								echo "<script type='text/javascript'>alert('没有搜索到商品，请查看其他商品吧！');location='index.php'</script>";
								die;
							}
									
									
								}
								else{
									$sql2="select * from product where cid={$id}";
									//echo $sql2;die;
									$res2=mysql_query($sql2);
									if($res2 && mysql_num_rows($res2)>0){
										while($row2=mysql_fetch_assoc($res2)){
											echo "<li class=\"category_li\">";
											echo "<a href=\"prodetail.php?id={$row2['id']}\"><img src=\"../public/uploads/{$row2['picname']}\" alt=\"\" title=\"\"/></a>";
											echo "<p class=\"category_title\"><a href=\"prodetail.php?id={$row2['id']}\">{$row2['pname']}</a></p>";
										echo "<p class=\"category_info\">
								<span class=\"txt_like\">{$row2['clicknum']}</span>
								<span class=\"txt_nowprice info_nowprice\"><i>¥</i>{$row2['price']}</span>
								
								<span class=\"txt_nowprice info_nowprice shoucang\"><a  href=\"doaction.php?operate=addcollect&id={$row2['id']}&uid={$_SESSION['users']['id']}\">收藏</a></span>
							</p>";
											echo "</li>";
										}
									}else{
								echo "<script type='text/javascript'>alert('没有搜索到商品，请查看其他商品吧！');location='index.php'</script>";
								die;
							}
									
									
									
								}
							}
							if(!@empty($_GET['name'])){
								$name=$_GET['name'];
								$sql3="select * from product where pname like '%{$name}%' or cid in (select id from category where name like '%{$name}%') ";
								//echo $sql3;die;
								$res3=mysql_query($sql3);
								if($res3 && mysql_num_rows($res3)>0){
									while($row3=mysql_fetch_assoc($res3)){
										echo "<li class=\"category_li\">";
											echo "<a href=\"prodetail.php?id={$row3['id']}\"><img src=\"../public/uploads/{$row3['picname']}\" alt=\"\" title=\"\"/></a>";
											echo "<p class=\"category_title\"><a href=\"prodetail.php?id={$row3['id']}\">{$row3['pname']}</a></p>";
										echo "<p class=\"category_info\">
								<span class=\"txt_like\">{$row3['clicknum']}</span>
								<span class=\"txt_nowprice info_nowprice\"><i>¥</i>{$row3['price']}</span>
								<span class=\"txt_nowprice info_nowprice shoucang\"><a  href=\"doaction.php?operate=addcollect&id={$row3['id']}&uid={$_SESSION['users']['id']}\">收藏</a></span>
								
							</p>";
											echo "</li>";
									}
								}else{
								echo "<script type='text/javascript'>alert('没有搜索到商品，请查看其他商品吧！');location='index.php'</script>";
								die;
							}
							}
						if(!empty($_GET['uid'])){
							$uid=$_GET['uid'];
							//$sql5="select pid from collects where uid={$uid}";
							
							$sql5="select * from product where id in (select pid from collects where uid={$uid})";
							//echo $sql5;die;
							$res5=mysql_query($sql5);
							if($res5 && mysql_num_rows($res5)>0){
								while($row5=mysql_fetch_assoc($res5)){
									echo "<li class=\"category_li\">";
											echo "<a href=\"prodetail.php?id={$row5['id']}\"><img src=\"../public/uploads/{$row5['picname']}\" alt=\"\" title=\"\"/></a>";
											echo "<p class=\"category_title\"><a href=\"prodetail.php?id={$row5['id']}\">{$row5['pname']}</a></p>";
										echo "<p class=\"category_info\">
								<span class=\"txt_like\">{$row5['clicknum']}</span>
								<span class=\"txt_nowprice info_nowprice\" style='margin-left:10px;'><i>¥</i>{$row5['price']}</span>
								
								
								<span class=\"\"><a href=\"doaction.php?operate=cancelprod&pid={$row5['id']}&uid={$_SESSION['users']['id']}\" style='display:inline-block;color:#999;padding-left:50px;'>取消收藏</a></span>
								
							</p>";
											echo "</li>";
								}
							}else{
								echo "<script type='text/javascript'>alert('没有搜索到商品，请查看其他商品吧！');location='index.php'</script>";
								die;
							}
							
						}
						if(empty($_GET['cid']) && empty($_GET['name']) && empty($_GET['uid'])){
							
							$where="";
							$search="";
							$wherelist=array();
							$urlist=array();
							if(!(empty($_GET['name']))){
								$wherelist[] =" pname like '%{$_GET['name']}%'";
								$urlist[]="&pname={$_GET['name']}";
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
							$res4=mysql_query($sql);
							
							//$sql4="select * from product";
							//$res4=mysql_query($sql4);
							if($res4 && mysql_num_rows($res4)>0){
								while($row4=mysql_fetch_assoc($res4)){
									echo "<li class=\"category_li\">";
											echo "<a href=\"prodetail.php?id={$row4['id']}\"><img src=\"../public/uploads/{$row4['picname']}\" alt=\"\" title=\"\"/></a>";
											echo "<p class=\"category_title\"><a href=\"prodetail.php?id={$row4['id']}\">{$row4['pname']}</a></p>";
										echo "<p class=\"category_info\">
								<span class=\"txt_like\">{$row4['clicknum']}</span>
								<span class=\"txt_nowprice info_nowprice\"><i>¥</i>{$row4['price']}</span>
								
								<span class=\"txt_nowprice info_nowprice shoucang\"><a  href=\"doaction.php?operate=addcollect&id={$row4['id']}&uid={$_SESSION['users']['id']}\">收藏</a></span>
								
							</p>";
											echo "</li>";
								}
									echo "<li class='seachlia123'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a class='seacha123' style='' href='searchlist.php?p=1{$search}'>首页</a>";
						echo "<a class='seacha123' href='searchlist.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a class='seacha123' href='searchlist.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a class='seacha123' href='searchlist.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</li>";
							}else{
								echo "<script type='text/javascript'>alert('没有搜索到商品，请查看其他商品吧！');location='index.php'</script>";
								die;
							}
							
						}
						
						?>
						
					</ul>
				</div>
				</div>
			
		</div>
		<div class="security clear">
			<div class="center">
				<a href=""><img class="img_960" src="public/images/security1.png"/></a>
				<a href=""><img class="img_1200" src="public/images/security2.png"/></a>
			</div>
		</div>
	<?php require "public/footer.php"; ?>
	</body>
</html>