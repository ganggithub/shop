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
		<title>产品详情页面</title>
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" type="text/css" href="public/css/prodetail.css"/>
		
		<link rel="stylesheet" href="public/css/footer.css"/>
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
						<a href="shopcar.php"><span class="cart_info">购物车<b class="num"><?php
								echo !empty($_SESSION['totalNum'])?$_SESSION['totalNum']:"0";
								
								
								?></b>件</span></a>
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
		
		
		
		<div class="shop-header">
			<div class="center">
				<div class="user-info fl">
					<div class="usertuxing fl"><a href=""><img class="face" src="public/images/pdyh.jpg"/></a></div>
					<div class="shop-name fl">
						<div class="name-wrap">
							<a href="" class="name fl">蛰居</a>
							<img class="img16" src="public/images/sjrenzheng.png"/>
						</div>
						<div class="shop-score">
							<span class="s-cat">描述<b>4.81</b></span>
							<span class="s-cat">质量<b>4.68</b></span>
							<span class="s-cat">价格<b>4.68</b></span>
							<span class="s-cat">服务<b class="low">4.71</b></span>
						</div>
						
					</div>
					<div class="shop-action fl">
							<a href="" class="shop-follow">收藏</a>
							<a href="" class="shop-follow">收藏</a>
						</div>
				</div>
				<div class="shop-search fr">
					<form action="searchlist.php" method="get">
						<input class="text" name="name" type="text" placeholder="输入你想要的商品"/>
						<input type="submit" class="submit-btn" value="搜全站"/>
						<a href="" class="search-inshop">搜本店</a>
					</form>
				</div>
			</div>
		</div>
		<div class="mod_list">
			<div class="center">
				<ol>
					<li><a href="index.php">首页</a></li>
					<li class="prodall"><a href="searchlist.php" >全部商品</a>
						
							<dl class="category_list">
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
						<dl class="category_list">
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
		<div class="detail-goods clear">
			<div class="center">
				<div class="goods-left fl">
					<div class="goods-img fl">
					<?php
						if(empty($_GET)){
							echo "<script type='text/javascript'>alert('没有选中商品，返回到首页吧！');location='index.php'</script>";
						}
						$id=$_GET['id'];
						$sql="select * from product where id={$id}";
						
						
						$res=mysql_query($sql);
						if($res && mysql_num_rows($res)>0){
							$row=mysql_fetch_assoc($res);
							$sqlup="update product set clicknum=clicknum+1 where id={$row['id']}";
							$resup=mysql_query($sqlup);
							$sqlc="select * from product where id={$id}";
							$resc=mysql_query($sqlc);
							$rowc=mysql_fetch_assoc($resc);
							if(!@empty($_SESSION['users'])){
							$rowc['uid']=$_SESSION['users']['id'];
						}
							$_SESSION['history'][$id]=$rowc;
						   /*$_SESSION['historypid']=$rowc['id'];*/
						}else{
							echo "<script type='text/javascript'>alert('查询出错了，返回到首页吧！');location='index.php'</script>";
						}
					
					?>
						<div class="big-img"><img width='468px' height='702px' src="../public/uploads/<?php echo $rowc['picname'] ;?>"/></div>
						<!--<div class="small-img">
							<ul class="carousel">
								<li><img src="public/images/detailxcar1.jpg"/></li>
								<li><img src="public/images/detailxcar2.jpg"/></li>
								<li><img src="public/images/detailxcar3.jpg"/></li>
								<li><img src="public/images/detailxcar4.jpg"/></li>
								<li><img src="public/images/detailxcar5.jpg"/></li>
								
							</ul>
						</div>-->
					</div>
					<form action="doaction.php?operate=add" method="post">
					<div class="goods-info fl">
					
						<h1 class="goods-title">
							<span><?php echo $rowc['pname']; ?></span>
						</h1>
						<div class="goods-price">
							<dl class="price-info">
								<dt class="price-origin">原价：</dt>
								<dd class="price-w">￥<?php echo $rowc['price'];?></dd>
							</dl>
							<dl class="bod">
								<dt class="">现价：</dt>
								<dd class="">
									<span class="price-now">￥
									<?php 
									$p=$rowc['price'];
									$c=$rowc['count'];
									//echo $p;die;
									echo $p*$c;?>
									</span>
									<?php 
							$sqlcm="select * from comments where pid={$id}";
							
							$rescm=mysql_query($sqlcm);
							$countcm=mysql_num_rows($rescm);

							?>
									<span class="fr cor9">评价:<span class="num"><?php echo $countcm; ?></span>累计销量：<span class="num1"><?php echo $rowc['num'] ?></span></span>
								</dd>
							</dl>
							<dl class="bod youhui">
								<dt class="">店铺优惠：</dt>
								<dd class="">全店满169元减10元<span class="more">more</span>
									<ul class="youhuqu">
										<li>全店满169元减10元<span class="linqu"><a href="">领取</a></span></li>
										<li>全店满169元减10元<span class="linqu"><a href="">领取</a></span></li>
										<li>全店满169元减10元<span class="linqu"><a href="">领取</a></span></li>
										<li>全店满169元减10元<span class="linqu"><a href="">领取</a></span></li>
										<li>全店满169元减10元<span class="linqu"><a href="">领取</a></span></li>
									</ul>
								</dd>
							</dl>
							<dl class="kefu">
								<dt class="">客服:</dt>
								<dd class=""><a href=""><img src="public/images/ww.gif"/></a></dd>
							</dl>
							</div>
							<div class="goods-pannel">
								<div class="pannel-title">选择商品信息</div>
								<div class="box">
									<dl>
										<dt>颜色：</dt>
										<dd>
											<ol>
												<!--<li class="ysli"><img src="public/images/yanse1.jpg"/></li>
												<li class="ysli"><img src="public/images/yanse1.jpg"/></li>-->
												<li>
												<?php   $color=$rowc['color'];
												$c=explode(',',$color);
												foreach($c as $k=>$v){
													echo "<label><input type='radio' name='color'  value='{$v}'/>{$v}</label>&nbsp;&nbsp;&nbsp;";
												}
												?>
												<?php
													if(@$_GET['erorr']==1){
														echo "<span style='color:red;'>请选择颜色</span>";
														//die;
													}
												
												
												
												?>
												</li>
											</ol>
										</dd>
									</dl>
									<dl class="clear size">
										<dt>尺码：</dt>
										<dd>
											<ol class="size-list">
												<!--<li>S</li>
												<li>M</li>
												<li>L</li>-->
												
												
												<li>
												
												<?php   $size=$rowc['size'];
												$s=explode(',',$size);
												foreach($s as $k=>$v){
													echo "<label><input type='radio' name='size'  value='{$v}'/>{$v}</label>&nbsp;&nbsp;&nbsp;";
												}
												?>
												<?php
													if(@$_GET['erorr']==2){
														echo "<span style='color:red;'>请选择尺码</span>";
														//die;
													}
												
												
												
												?>
												</li>
											</ol>
										</dd>
									</dl>
									<dl>
										<dt>数量：</dt>
										<dd>
										<input type="number" value="1" name="buycount" style="height:20px;text-align:center;"/>
										<?php
													if(@$_GET['erorr']==3){
														echo "<span style='color:red;'>购买数量不能为负值</span>";
													}//die;
													if(@$_GET['erorr']==4){
														echo "<span style='color:red;'>亲，没有那么多库存</span>";
													}
													//die;
												
												?>
										<input type="hidden" value="<?php  echo $rowc['store'];?>" name="store"/>
										<span class="kc">库存<?php  echo $rowc['store'];?>件</span></dd>
										<input type="hidden" name="pid" value="<?php echo $rowc['id'] ?>"/>
									</dl>
								</div>
								
							</div>
							<div class="goods-buy clear">
									<!--<a href="cmborder.php?id=<?php echo $rowc['id'];?>&buycont=buycont" >立即购买</a>-->
									<input style="border:none;cursor: pointer;" type="submit" value="立即购买" name="buy" class="buy-btn buy-now"/>
									<input style="cursor: pointer;" type="submit"  class="buy-cart buy-btn" name="buy" value="加入购物车"></>
							</div>
							<div class="goods-social">
								<div class="item"><a href="doaction.php?operate=addcollect&id=<?php echo $rowc['id'];?>&uid=<?php echo $_SESSION['users']['id'];?>" style="color:red;"><span class="zred">赞</span><span class="pd10px">收藏</span></a></div>
								<!--<div class="item">
								
								
								
								
								</div>-->
								<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone"></a><a href="#" class="bds_tsina" data-cmd="tsina"></a><a href="#" class="bds_tqq" data-cmd="tqq"></a><a href="#" class="bds_renren" data-cmd="renren"></a><a href="#" class="bds_weixin" data-cmd="weixin"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
								
								<!--<div class="report">举报</div>-->
							</div>
							<div class="goods-services clear">
								<div class="fl co9">服务承诺:</div>
								<ul class="list fl">
									<li><a href=""><img src="public/images/baoyou.png"/>全国包邮</a></li>
									<li><a href=""><img src="public/images/qitian.png"/>七天无理由退货</a></li>
									<li><a href=""><img src="public/images/72xiaoshi.png"/>72小时发货</a></li>
									<li><a href=""><img src="public/images/tuihuo.png"/>退货补运费</a></li>
									<li><a href=""><img src="public/images/mote.png"/>模特实拍</a></li>
								</ul>
							</div>
							<!--<div class="pay-methods">
								支付方式：<span></span>
							</div>-->
						</div>
						</form>
					</div>
					
					<div class="goods-right fr">
					<p class="title">
						<s></s>
						<span id="tuijian">热买推荐</span>
					</p>
					<div class="rightlist">
						<ul>
						<?php
							$sql="select * from product where state=4 limit 3";
							$res=mysql_query($sql);
							if($res && mysql_num_rows($res)>0){
								while($row=mysql_fetch_assoc($res)){
									
									?>
									<li>
								<a href="prodetail.php?id=<?php echo $row['id']; ?>"><img src="../public/uploads/<?php echo $row['picname'] ;?>"/></a>
								<span>￥<?php echo $row['price'];?></span>
							</li>
									
									<?php
								}
							}
						?>
						
							
							
						</ul>
					</div>
				</div>
					
				</div>
				
			</div>
		</div>
		<div class="detail-content clear">
			<div class="center">
				<div class="col-sidebar fl">
					<!--<div class="module-shop ui-box ">
						<h3 class="ui-hd shop-hd"><a href="" class="text">蛰居</a></h3>
						<div class="shop-evaluate">
							<ul>
								<li>
									<p class="ptext">描述</p>
									<p class="num-def">4.81</p>
								</li>
								<li>
									<p class="ptext">质量</p>
									<p class="num-def">4.68</p>
								</li>
								<li>
									<p class="ptext">价格</p>
									<p class="num-def">4.81</p>
								</li>
								<li class="last">
									<p class="ptext">服务</p>
									<p class="num-def num-low">4.71</p>
								</li>
							</ul>
						</div>
						<div class="shop-btns">
							<a href="" class="btn-fav">收藏店铺</a>
							<a href="" class="btn-goto">进入店铺</a>
						</div>
						<div class="shop-search">
							<i class="line"></i>
							<form action="" method="post">
								<input type="text" class="inptxt"/>
								<input type="submit" value="店内搜索" class="inpbtn"/>
							</form>
						</div>
						<div class="shop-provide">
							<a href=""><img src="public/images/xiaodian.png"/></a>
						</div>
					</div>-->
					<!--<div class="module-classify ui-box">
						<h3 class="ui-hd">本店分类</h3>
						<div class="ui-bd">
							<ul class="classify-list">
								<li><a href="">全部商品</a></li>
								<li><a href="">本周新品</a></li>
								<li><a href="">连衣裙</a></li>
								<li><a href="">时尚套装</a></li>
								<li><a href="">T恤</a></li>
								<li><a href="">蕾丝/雪纺衫</a></li>
								<li><a href="">裤子</a></li>
								<li><a href="">连衣裙</a></li>
								<li><a href="">时尚套装</a></li>
								<li><a href="">T恤</a></li>
								<li><a href="">蕾丝/雪纺衫</a></li>
								<li><a href="">裤子</a></li>
								<li><a href="">连衣裙</a></li>
								<li><a href="">时尚套装</a></li>
								<li><a href="">T恤</a></li>
								<li><a href="">蕾丝/雪纺衫</a></li>
								<li><a href="">裤子</a></li>
							</ul>
						</div>
					</div>-->
					<div class="module-repeat ui-box">
						<h3 class="ui-hd">浏览记录</h3>
					
						<div class="ui-bd">
							<ul class="repeat-list">
							
								<?php
									/*if(!empty($_SESSION['historypid']))*/
									if(!empty($_SESSION['history']))
									{
										//var_dump($_SESSION['history']);die;
										/*$pid=$_SESSION['historypid'];
										$sql="select * from product where id={$pid}";
										$res=mysql_query($sql);
										while($row=mysql_fetch_assoc($res)){*/
										foreach($_SESSION['history'] as $row){
											$pid=$row['id'];
											$sql="select * from product where id={$pid}";
											$res=mysql_query($sql);
											$rows=mysql_fetch_assoc($res);
											echo "<li>";
													echo "<a href=\"prodetail.php?id={$rows['id']}\" class=\"pic\"><img src=\"../public/uploads/{$rows['picname']}\"/></a>";
													echo "<div class=\"info\">";
														echo "<span class=\"price\">￥{$rows['price']}</span>";
														echo "<span class=\"fav\">{$rows['clicknum']}</span>";
													echo "</div>";
											echo "</li>";
												/*echo "<li>";
													echo "<a href=\"prodetail.php?id={$row['id']}\" class=\"pic\"><img src=\"../public/uploads/{$row['picname']}\"/></a>";
													echo "<div class=\"info\">";
														echo "<span class=\"price\">￥{$row['price']}</span>";
														echo "<span class=\"fav\">{$row['clicknum']}</span>";
													echo "</div>";
												echo "</li>";*/
											}
										}
									
								
								
								
								?>
								
								
							</ul>
						</div>
					</div>
				</div>
				<div class="module-tabpanel fl">
					<div class="tabbar-box">
						<ul class="tabbar-list">
							<li class="selected"><a href="#miaoshu">商品详情</a></li>
							
							
							<li><a href="#comment">累计评价<em><?php echo $countcm;  ?></em></a></li>
							<li><a href="#tonglei">同类商品</a></li>
							<li class="qrcode">
								<div class="qrcode-togger">手机扫码下单</div>
								<div class="qrcode-pic"></div>
								<i class="qrcode-arrow"></i>
							</li>
						</ul>
					</div>
					<div class="" id="miaoshu" style="padding:15px;">
						<?php echo $rowc['describes'] ; ?>
					</div>
					<div class="comment" id="comment">
						
							<h2>买家评价</h2>
							
							<div class="comment-content">
							
								<div class="nav">
									全部评价(<?php echo $countcm; ?>)
								</div>
								<?php
							
							if($rescm && mysql_num_rows($rescm)>0){
								while($row=mysql_fetch_assoc($rescm)){
									
							?>
								<div class="commain clear">
									<div class="cmleft fl">
										<img src="public/images/comimg.jpg"/>
									</div>
									<div class="cmright fl">
										<div class="crtitle">
											<?php 
												$uid=$row['uid'];
												$sqlu="select * from users where id={$uid}";
												$resu=mysql_query($sqlu);
												$rowu=mysql_fetch_assoc($resu);
												
												
											?>
											<span class="tname"><?php  
											
													$uname=$rowu['username'];
													//$len=strlen($uname);
													//$uone=mb_substr($uname,0,1,'utf-8');
													//$last=mb_substr($uname,strlen($uname)-1,1,'utf-8');
													//$usname=$uone."******".$last;
													//echo $usname;
													echo mb_substr($uname,0,1,'utf-8')."******".mb_substr($uname,strlen($uname)-1,1,'utf-8');
											
											?></span>
											<span class="tdate"><?php  echo date('Y-m-d',$row['addtime']); ?></span>
										</div>	
										<div class="crinfo">
											<?php echo $row['content']; ?>
					
										</div>
									</div>
								</div>
							<?php
								}
							}
						
						?>
						</div>
								
							
					
					</div>
					<div class="" id="tonglei" style="width:720px;margin:0 auto;">
								<div class="panel-title"> <h2 style="border-bottom: 1px solid #333;width:80px;margin-left:10px;">同类商品</h2> </div>
							<div class="graphic-block recommend-list" style="width:700px;margin:10px 0 0 20px;">
								<ul>
								
								<?php
									if(!empty($_GET['id']))
									{
										$id=$_GET['id'];
										$sql3="select * from product where id={$id}";
										$res3=mysql_query($sql3);
										$row3=mysql_fetch_assoc($res3);
										$cid=$row3['cid'];
										$sql4="select * from product where cid={$cid}";
										//echo $sql4;die;
										$res4=mysql_query($sql4);
										if($res4 && mysql_num_rows($res4)>0){
											while($row4=mysql_fetch_assoc($res4)){
												echo "<li>";
													echo "<a href=\"prodetail.php?id={$row4['id']}\" class=\"pic\"><img src=\"../public/uploads/{$row4['picname']}\"/></a>";
													echo "<a href=\"prodetail.php?id={$row4['id']}\" class=\"title\">{$row4['pname']}</a>";
													echo "<div class=\"info\">
											<span class=\"price\">￥{$row4['price']}</span>
											<span class=\"fav\">{$row4['clicknum']}</span>
										</div>";
												echo "</li>";
											}
										}
								}
								
								?>
								
										
										
										
									
									
								</ul>
							</div>
							</div>
					
				</div>
				<div class="module-cart fl">
					<div class="ui-box">
						<div class="ui-hd">
							<a href="" class="cart-name">其他信息</a>
						</div>
					</div>
					<div class="extranav-bd">
						<ul class="extranav-list"> 
							<li  class="">
								<a href="#miaoshu">商品描述</a>
							</li>
							<!--<li  class="selected">
								<a href="">产品参数</a>
							</li>  
							<li class="">
								<a href="">穿着效果</a>
							</li> 
							<li>
								<a href="">整体款式</a> 
							</li> 
							<li>
								<a href="">细节做工</a>
							</li> 
							<li>
								<a href="">尺码说明</a>
							</li>-->  
							<li>
								<a href="#tuijian">商品推荐</a> 
							</li> 
						</ul>
					</div>
				</div>
				
				
				
				
				
			</div>
		 </div>
		
		
		
		<?php
			require "public/footer.php";
		
		?>
		
		
		
		
		
		
		
		
		
	</body>


</html>