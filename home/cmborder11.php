<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	$_SESSION['isorder']=1;
	require "../public/dbconfig.php";
	require "../public/connect.php";
	if(empty($_SESSION['users'])){
		echo "<script type='text/javascript'>alert('你还没有登录，请登录！');location='login.php?order=1'</script>";
		die;
	}
	
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>我的确认订单页面</title>
		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/shopcar.css"/>
		<script language="javascript" src="public/css/11.js" type="text/javascript" charset="utf-8"></script>
   
	</head>
	<body>
		<?php require "public/podhead.php"; ?>
		
		<div class="g-header clear">
			<div class="center">
				<div class="ghleft fl"><a href="index.php" style="display:inline-block;width:100%;height:100%;">&nbsp;&nbsp;</a></div>
				<div class="process-bar">
					<div class="md_process_wrap">
						<i class="md_process_i md_process_i1">
							1<span class="md_process_tip">购物车</span>
						</i>
						<i class="md_process_i md_process_i2">
							2<span class="md_process_tip">确认订单</span>
						</i>
						<i class="md_process_i md_process_i3">
							3<span class="md_process_tip">支付</span>
						</i>
						<i class="md_process_i md_process_i4">
							<img src="public/images/right.png" alt="" height="23" width="23">
							<span class="md_process_tip">完成</span>
						</i>
					</div>
				</div>
			</div>
		</div>
		<?php
		
		
		?>
		<form action="doaction.php?operate=addcmd" method="post">
		<div class="contdetail clear">
			<div class="center">
				<div class="odaddress">
					<h2>选择收货地址</h2>
					<div class="aressinfo">
						<ul class="admana">
							<li><a href="addresslist.php">显示全部地址</a></li>
							<li><a href="addresslist.php">管理收货地址</a></li>
							<li><a href="address.php">使用新地址</a></li>
						</ul>
						<div class="addaress clear">
							
								<dl class="address_pop">
									<!--<input type="hidden"/>
									<dt>省：</dt>
									<dd>
										<i class="needicon">*</i>
										<select class="w140">
											<option>北京</option>
											<option>上海</option>
										</select>
										<label class="dt">市：</label>
										<select class="w140">
											<option>北京</option>
											<option>上海</option>
										</select>
										<label class="dt">区：</label>
										<select class="w140">
											<option>北京</option>
											<option>上海</option>
										</select>
									</dd>-->
									<dt>邮政编码：</dt>
									<dd>
										<i class="needicon">*</i>
										<input type="text" class="text" name="code"/>
									</dd>
									<!--<dt>街道地址：</dt>
									<dd>
										<i class="needicon">*</i>
										<textarea rows="3" cols="30" class="textarea"></textarea>
									</dd>-->
									<dt>详细地址：</dt>
									<dd>
										<i class="needicon">*</i>
										<textarea rows="3" name="address" cols="30" class="textarea"></textarea>
									</dd>
									<dt>收货人姓名：</dt>
									<dd>
										<i class="needicon">*</i>
										<input type="text" class="text" value="" name="linkman"/>
									</dd>
									<dt>手机：</dt>
									<dd>
										<i class="needicon">*</i>
										<input type="text" class="text" value="" name="phone"/>
									</dd>
									<!--<dt></dt>
									<dd>
										<input type="submit" value="确认地址"/>
										<input type="reset" value="取消"/>
									</dd>-->
								</dl>
							
						</div>
					</div>
				</div>
				<div class="cart_wrap clear ordmc20">
					<div class="carPage">
						<h2>确认商品信息</h2>
						<table id="cartOrderTable" class="cart_table">
							<tr>
								<!--<th class="cars_all cart_alleft"><input type="checkbox" name="s_all" class="s_all"/><label class="lball">全选</label>
								</th>-->
								<th class="car_good">商品</th>
								<th class="car_goodinfo">商品信息</th>
								<th class="car_price">单价（元）</th>
								<th class="car_goodnum">数量</th>
								<th class="car_goodsum">小计（元）</th>
								<th class="car_caozuo">操作</th>
								
							</tr>
							<tr class="bordef">
								<td colspan="7" class="cart_group_head">
									<input type="checkbox" name="s_shopall"/>
									<label class="cart_lightgray">店铺</label>
									<a href="" class="dz">可儿靓衣</a>
									<a href="" class="dz">联系客服</a>
									<span class="quantu"><img src="public/images/quan.png"/></span>
									<div class="fr pd50">
										<span class="red">优惠券：</span><a href="">领取</a>
									</div>
								</td>
							</tr>
							<?php 
							if(!empty($_SESSION['rightbuy'])){
								$totalNum=0;
									$total=0;
									$totalPrice=0;
									//var_dump($_SESSION['rightbuy']);
								foreach($_SESSION['rightbuy'] as $v){
									
									$total = $v['price']*$v['buycount']*$v['count'];
									echo "<tr class='bordef'>";
										echo "
										<td class='goodimg'>
									<a href='prodetail.php?id={$v['id']}' class='carpdimg'>
									<img width='100px' src='../public/uploads/{$v['picname'] }'/></a>
								<a href='prodetail.php?id={$v['id']}' class='carptitle'>{$v['pname']}</a>
										</td>
										";
									echo "
										<td>
											<p>颜色:{$v['color']}</p>
											<p>尺码：{$v['size']}</p>
										</td>
									";
									
									echo "
										<td>
											<p class='yuprice'>{$v['price']}</p>
											<p class='cxprice'>".($v['price'])*($v['count'])."</p>
											<p class='discount'>促销{$v['count']}折</p>
										</td>
									";
									
									echo "<td>
					
					<a href='doaction.php?operate=rsub&id={$v['id']}' style='border:1px solid #ccc' >&nbsp;-&nbsp;</a>
										{$v['buycount']}
						<a href='doaction.php?operate=rjia&id={$v['id']}' style='border:1px solid #ccc'>&nbsp;+&nbsp;</a>
					
					
					
					</td>";
									echo "<td><p class='zjprice'>".($v['buycount'])*($v['price'])*($v['count'])."</p></td>";
									echo "<td><a href='doaction.php?operate=rdel&id={$v['id']}' class='adel'>删除</a></td>";
									 $totalPrice+=($v['buycount'])*($v['price'])*($v['count']);
									 //$totalPrice+=$total;
									 $totalNum+=$v['buycount'];
									
									echo "</tr>";
									
								}
							$_SESSION['rtotalPrice']=$totalPrice;
							$_SESSION['rtotalNum']=$totalNum;
							}elseif(!empty($_SESSION['shopcar'])){
								foreach($_SESSION['shopcar'] as $v){
									echo "<tr class='bordef'>";
										echo "
										<td class='goodimg'>
									<a href='prodetail.php?id={$v['id']}' class='carpdimg'>
									<img width='100px' src='../public/uploads/{$v['picname'] }'/></a>
								<a href='prodetail.php?id={$v['id']}' class='carptitle'>{$v['pname']}</a>
										</td>
										";
									echo "
										<td>
											<p>颜色:{$v['color']}</p>
											<p>尺码：{$v['size']}</p>
										</td>
									";
									
									echo "
										<td>
											<p class='yuprice'>{$v['price']}</p>
											<p class='cxprice'>".($v['price'])*($v['count'])."</p>
											<p class='discount'>促销{$v['count']}折</p>
										</td>
									";
									
									echo "<td>
				
					<a href='doaction.php?operate=csub&id={$v['id']}' style='border:1px solid #ccc' >&nbsp;-&nbsp;</a>
										{$v['buycount']}
						<a href='doaction.php?operate=cjia&id={$v['id']}' style='border:1px solid #ccc'>&nbsp;+&nbsp;</a>
					
					
					</td>";
									echo "<td><p class='zjprice'>".($v['buycount'])*($v['price'])*($v['count'])."</p></td>";
									echo "<td><a href='doaction.php?operate=cdel&id={$v['id']}' class='adel'>删除</a></td>";
									
									echo "</tr>";
									
								}
							}
						
							?>
							
						</table>
					</div>
					<div class="carPay">
						<div class="cpleft">
							<label class="pd5px">备注：</label><input type="text" class="cart_table_note cart_text" placeholder="补充填写其他信息，如有快递不到也请留言备注" value="" name="remark"/>
							
						</div>
						<div class="cpright">
							<span class="pd30px">快递运费：<strong>全国包邮</strong></span>
						</div>
					</div>
					<div class="totalprice clear">合计：<span class="red fond">¥ <?php
					if(!empty($_SESSION['shopcar']))
					{echo $_SESSION['totalPrice'];}
					elseif(!empty($_SESSION['rightbuy'])){
						echo $_SESSION['rtotalPrice'];
					}
				
				
				?>
				
				
				</span></div>
					<div class="yuhichoose clear fr">
						<label class="">全场优惠：</label>
						<select><option>不使用优惠</option></select>
						<span class="cor6">-0.00元</span>
					</div>
					<div class="modou clear">
						<div class="fl">
						<a style="text-decoration:none;"
						href="
						<?php
					if(!empty($_SESSION['shopcar']))
					{echo 'doaction.php?operate=cclear';}
					elseif(!empty($_SESSION['rightbuy'])){
						echo 'doaction.php?operate=rclear';
					}
				
				
				?>
						
						
						
						
						"

						class="c66px">清空所有商品</a>
						</div>
						<div class="fr">
							<input type="checkbox"/>
						<label>蘑豆抵现<span class="cor6">（可用0粒）</span></label>
						</div>
						
					</div>
					<div class="jeisuan clear">
						<div class="jsleft fl cor6">
						<a href="index.php" class="cor6" style="background: #f13e3a;display: inline-block;width: 100px;height: 40px;line-height: 40px;text-align: center;font-size: 20px;color: #fff;border-radius: 5px;">继续购买</a>
						<a href="shopcar.php" class="cor6" style="background: #f13e3a;margin-left:10px;display: inline-block;width: 120px;height: 40px;line-height: 40px;text-align: center;font-size: 20px;color: #fff;border-radius: 5px;">返回购物车</a>&nbsp;
						
						</div>
						<div class="jsright fr">
							<div class="jianshu">共有<span class="red pad5px">
							<input type="hidden" name="buycount" value="
							
							<?php  
								if(!empty($_SESSION['shopcar']))
									{echo $_SESSION['totalNum'];}
									elseif(!empty($_SESSION['rightbuy'])){
									echo $_SESSION['rtotalNum'];
									}
							
							
							
							?>
							
							
							"/>
							<?php  
								if(!empty($_SESSION['shopcar']))
									{echo $_SESSION['totalNum'];}
									elseif(!empty($_SESSION['rightbuy'])){
									echo $_SESSION['rtotalNum'];
									}
							
							
							
							?></span>件商品，总计：</div>
							<input type="hidden" name="total" value="<?php 
							if(!empty($_SESSION['shopcar']))
					{echo $_SESSION['totalPrice'];}
					elseif(!empty($_SESSION['rightbuy'])){
						echo $_SESSION['rtotalPrice'];
					}
				



							?>"/>
							<!--<input type="hidden" name="pid" value="<?php 
							if(!empty($_SESSION['shopcar']))
						{echo $v['id'];}
						else{
						echo $id;
						}
							
							?>" />-->
							<span class="price red">¥<?php 
							
							if(!empty($_SESSION['shopcar']))
							{echo $_SESSION['totalPrice'];}
								elseif(!empty($_SESSION['rightbuy'])){
									echo $_SESSION['rtotalPrice'];
								}
				
							
							
							
							?></span>
							<input style="border:none;cursor: pointer;" class="payprice" type="submit" value="去付款"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
		<div class="footer clear pad20px">
			<div class="center"><a href="">蘑菇街</a> | <a href="">加入开放平台</a> © 2015 Mogujie.com,All Rights Reserved. </div>
		</div>
		
		<div class="mgj_rightbar">
			<div class="rbblank"></div>
			<div class="rbtux sidebar-item">
				<a href=""><img src="public/images/yhtx.jpg"/></a>
			</div>
			<div class="sidebar-item rbcar pad10px">
				<a href="">
					<div class="rbctitle">购物车</div>
					<div class="rbcnum">1</div>
				</a>
			</div>
			<div class="sidebar-item rbyhq pad10px"><a href="">优惠券</a></div>
			<div class="sidebar-item rbyqb pad10px"><a href="">钱包</a></div>
			<div class="sidebar-item rbyzj pad10px"><a href="">足迹</a></div>
			<div class="sidebar-item rbytop pad10px"><a href="">返回到顶部</a></div>
			
		</div>
		
	</body>

</html>