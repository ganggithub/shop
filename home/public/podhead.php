<div class="header">
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
							?>
							
							
							">喜欢的商品</a></li>
							<?php
						}else{
							
							echo "<a href='register.php' style='padding-right:10px;'>注册</a>
						<a href='login.php'>登录</a>";
						}
						
						
						?>
						
						<!--<ol class="ext_mode">
							<li class="s2"><a target="_blank" rel="nofollow" href="#">个人设置</a></li>
							<li class="s2"><a target="_blank" rel="nofollow" href="#">账号绑定</a></li>
							<li class="s2"><a rel="nofollow" href="#">退出</a></li>
						</ol>-->
					</li>
					<li class="s1 has_line">
						<a href="">消息<span class="num m_num">1</span></a>
					</li>
				
							<!--<li class="s2"><a target="_blank" rel="nofollow" href="">收藏的小店</a></li>-->
							<!--<li class="s2"><a target="_blank" rel="nofollow" href="">浏览足迹</a></li>-->
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