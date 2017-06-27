	<div class="ordernav fl">
					<div class="odninfo">
						<img src="public/images/myzh.jpg"/>
						<p class="odname"><a href=""><?php  echo $_SESSION['users']['username'];  ?></a></p>
					</div>
					<div class="mu_nav myorder">
						<p class="ordertitle">我的订单</p>
						<ul class="orderul">
							<li><a href="userorder.php?uid=<?php echo $_SESSION['users']['id']; ?>">全部订单</a></li>
							<li><a href="shopcar.php">待付款</a></li>
							<li><a href="dshorder.php">待收货</a></li>
							
							<li><a href="ygmprod.php">已购买的宝贝</a></li>
						</ul>
					</div>
					<div class="mu_nav mycount">
						<p class="ordertitle">个人信息</p>
						<ul class="orderul">
							<li><a href="usercenter.php">基本信息</a></li>
							<li><a href="useredit.php?uid=<?php echo $_SESSION['users']['id']; ?>">修改个人信息</a></li>
							<li><a href="userpwd.php">修改密码</a></li>
							<li><a href="searchlist.php?uid=<?php echo $_SESSION['users']['id']; ?>">我的收藏</a></li>
							<li><a href="commentlist.php">查看评论</a></li>
							<li><a href="addresslist.php">地址管理</a></li>
						</ul>
					</div>
				</div>