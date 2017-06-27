<?php
	
	header('content-type:text/html;charset=utf-8');
	session_start();
	require "../public/dbconfig.php";
	require "../public/connect.php";
	if(empty($_SESSION['users'])){
		echo "<script type='text/javascript'>alert('你还没有登录，请登录！');location='login.php'</script>";
		die;
	}
	if(empty($_GET['operate'])){
		echo "<script type='text/javascript'>alert('你还没有购买商品，请先购买商品吧！');location='index.php'</script>";
		die;
	}
	
	$operate=$_GET['operate'];
	switch($operate){
		case "addcollect":
			if(empty($_GET['id'])){
				echo "<script type='text/javascript'>alert('你还没有选择商品，请先选择商品吧！');location='index.php'</script>";
				die;
			}
			$pid=$_GET['id'];
			$uid=$_GET['uid'];
			//$uid=$_SESSION['users']['id'];
			$sql="select * from collects where pid='{$pid}'";
			$res=mysql_query($sql);
			$row=mysql_fetch_assoc($res);
			if($pid==$row['pid'] && $uid==$row['uid']){
				//header('Location:prodetail.php?id={$pid}&erro=1')
				echo "<script type='text/javascript'>alert('该商品已经收藏，请收藏其他商品吧！');location='index.php'</script>";
				die;
			}
			$sqlc="insert into collects(id,pid,uid) values(null,'{$pid}','{$uid}')";
			$resc=mysql_query($sqlc);
			if($resc && mysql_affected_rows($link)>0){
				echo "<script type='text/javascript'>alert('收藏成功，请继续购买！');location='prodetail.php?id={$pid}'</script>";
				die;
			}
			break;
		case "cancelprod":
			if(!empty($_GET['pid'])){
				$pid=$_GET['pid'];
				$uid=$_GET['uid'];
				$sql="delete from collects where pid={$pid} and uid={$uid}";
				$res=mysql_query($sql);
				if($res && mysql_affected_rows($link)>0){
					echo "<script type='text/javascript'>alert('取消成功，请继续购物！');location='index.php'</script>";
					die;
				}
			}
			break;
		case "add":
			if(empty($_POST['pid'])){
					echo "<script type='text/javascript'>alert('你还没有购买商品，请先购买商品吧！');location='index.php'</script>";
					die;
				}
				
			$pid=$_POST['pid'];
			if(empty($_POST['color'])){
				//header('Location:prodetail.php?id={$pid}&erorr=1');
				//die;
								echo "<script type='text/javascript'>alert('没有选泽商品颜色，请选择商品颜色！');location='prodetail.php?id={$pid}'</script>";
								die;
							}
				if(empty($_POST['size'])){
					//header('Location:prodetail.php?id={$pid}&erorr=2');
					//die;
								echo "<script type='text/javascript'>alert('没有选泽商品尺寸，请选择商品尺寸！');location='prodetail.php?id={$pid}'</script>";
								die;
							}
			$color=$_POST['color'];
			$size=$_POST['size'];
			$buycount=$_POST['buycount'];
			$store=$_POST['store'];
			if($buycount<0){
				//header('Location:prodetail.php?id={$pid}&erorr=3');
				//die;
				echo "<script type='text/javascript'>alert('购买数量不能为负数，请重新输入！');location='prodetail.php?id={$pid}'</script>";
				die;
			}
			if($buycount>$store){
				//header('Location:prodetail.php?id={$pid}&erorr=4');
				//die;
				echo "<script type='text/javascript'>alert('亲没有那么多库存，重新选择！');location='prodetail.php?id={$pid}'</script>";
				die;
			}
			if($_POST['buy']=="立即购买"){
				if(isset($_SESSION['rightbuy']['$pid']))
				{
					$_SESSION['rightbuy'][$pid]['buycount']+=$buycount;
				}else{
					$sql="select * from product where id={$pid}";
					$res=mysql_query($sql);
					if(!$res|| mysql_num_rows($res)<=0){
						header('Location:index.php');
						exit;
					}
					$product=mysql_fetch_assoc($res);
					$product['buycount']=$buycount;
					$product['color']=$color;
					$product['size']=$size;
					$_SESSION['rightbuy'][$pid]=$product;
				}
				header('Location:cmborder.php');
				
				//header("Location:cmborder.php?id={$pid}&color={$color}&size={$size}&buycount={$buycount}");die;
				
			}else if($_POST['buy']=="加入购物车"){
				$pid=$_POST['pid'];
				if(empty($_POST['color'])){
								echo "<script type='text/javascript'>alert('没有选泽商品颜色，请选择商品颜色！');location='prodetail.php?id={$pid}'</script>";
							}
				if(empty($_POST['size'])){
								echo "<script type='text/javascript'>alert('没有选泽商品尺寸，请选择商品尺寸！');location='prodetail.php?id={$pid}'</script>";
							}
				$color=$_POST['color'];
				$size=$_POST['size'];
				$buycount=$_POST['buycount'];
				
				if(isset($_SESSION['shopcar']['$pid']))
				{
					$_SESSION['shopcar'][$pid]['buycount']+=$buycount;
				}else{
					$sql="select * from product where id={$pid}";
					$res=mysql_query($sql);
					if(!$res|| mysql_num_rows($res)<=0){
						header('Location:index.php');
						exit;
					}
					$product=mysql_fetch_assoc($res);
					$product['buycount']=$buycount;
					$product['color']=$color;
					$product['size']=$size;
					$_SESSION['shopcar'][$pid]=$product;
				}
				header('Location:shopcar.php');
			}
			break;
			case "addcmd":
			$uid=$_SESSION['users']['id'];
			$linkman=$_POST['linkman'];
			$address=$_POST['address'];
			$code=$_POST['code'];
			$phone=$_POST['phone'];
			$addtime=time();
			$total=$_POST['total'];
			$status=1;//1：新订单；2：已发货；3：无效订单
			$remark=$_POST['remark'];
			//$pid=$_POST['pid'];
			
			
			//setcookie("orders['pid']",$pid);
			//setcookie("",$)
			$sql="insert into orders(linkman,uid,address,code,phone,addtime,total,status,remark) values('{$linkman}','{$uid}','{$address}','{$code}','{$phone}','{$addtime}','{$total}','{$status}','{$remark}')";
			//echo $sql;die;
			$res=mysql_query($sql);
			if(mysql_affected_rows($link)<=0){
				header('Location:cmborder.php');
				die;
			}
			$oid=mysql_insert_id();
			if(!empty($_SESSION['shopcar'])){
				//var_dump($_SESSION['shopcar']);die;
				
			foreach($_SESSION['shopcar'] as $v){
				$sqldetail="insert into orderdetail(orderid,pid,pname,price,buynum) values('{$oid}','{$v['id']}','{$v['pname']}','{$v['price']}','{$v['buycount']}')";
				//echo $sqldetail;die;
				$res5=mysql_query($sqldetail);
				if(!$res5 || mysql_affected_rows()<=0){
					header('Location:cmborder.php');
					die;
				}else{
					$did=mysql_insert_id($link);
					//echo "<script type='text/javascript'>alert('添加订单成功！');location='userorder.php?oid={$oid}'</script>";
					echo "<script type='text/javascript'>alert('添加订单成功！');location='orderOk.php?id={$oid}'</script>";
					unset($_SESSION['shopcar']);
					
					unset($_SESSION['totalPrice']);
					unset($_SESSION['isorder']);
					unset($_SESSION['totalNum']);
				}
			}}elseif(!empty($_SESSION['rightbuy'])){
				foreach($_SESSION['rightbuy'] as $v){
				$sqldetail="insert into orderdetail(orderid,pid,pname,price,buynum) values('{$oid}','{$v['id']}','{$v['pname']}','{$v['price']}','{$v['buycount']}')";
				
				$res5=mysql_query($sqldetail);
				if(!$res5 || mysql_affected_rows()<=0){
					header('Location:cmborder.php');
					die;
				}else{
					$did=mysql_insert_id($link);
					//echo "<script type='text/javascript'>alert('添加订单成功！');location='userorder.php?oid={$oid}'</script>";
					echo "<script type='text/javascript'>alert('添加订单成功！');location='orderOk.php?id={$oid}'</script>";
					unset($_SESSION['rightbuy']);
					
					unset($_SESSION['rtotalPrice']);
					//unset($_SESSION['isorder']);
					unset($_SESSION['rtotalNum']);
				}
			}
			
			}
			//echo "<script type='text/javascript'>alert('添加订单成功！');location=orderOk.php?id={$oid}'</script>";
			break;
			//购物车某商品数量-1
	case 'sub':
		//var_dump($_GET['id']);die;
		if(empty($_GET['id'])){
			
			header('location:index.php');
			exit;
		}
		$_SESSION['shopcar'][$_GET['id']]['buycount']--;
		if($_SESSION['shopcar'][$_GET['id']]['buycount']<=0){
			unset($_SESSION['shopcar'][$_GET['id']]);
		}

		header('location:shopcar.php');


	break;
	//购物车某商品数量+1
	case 'jia':
		if(empty($_GET['id'])){
			//var_dump($_POST['id'])die;
			header('location:shopcar.php');
			exit;
		}
		//找到session里对应的那条记录,buynum字段加1
		$_SESSION['shopcar'][$_GET['id']]['buycount']++;

		header('location:shopcar.php');


	break;

	//删除某个商品
	case 'del':
	  if(empty($_GET['id'])){
			header('location:shopcar.php');
			exit;
		}
	  unset($_SESSION['shopcar'][$_GET['id']]);
	  header('location:shopcar.php');

	  break;
	  //这是订单里删除和添加的操作
	  case 'csub':
		//var_dump($_GET['id']);die;
		if(empty($_GET['id'])){
			
			header('location:index.php');
			exit;
		}
		$_SESSION['shopcar'][$_GET['id']]['buycount']--;
		if($_SESSION['shopcar'][$_GET['id']]['buycount']<=0){
			unset($_SESSION['shopcar'][$_GET['id']]);
		}

		header('location:cmborder.php');


	break;
	//购物车某商品数量+1
	case 'cjia':
		if(empty($_GET['id'])){
			//var_dump($_POST['id'])die;
			header('location:cmborder.php');
			exit;
		}
		//找到session里对应的那条记录,buynum字段加1
		$_SESSION['shopcar'][$_GET['id']]['buycount']++;

		header('location:cmborder.php');


	break;

	//删除某个商品
	case 'cdel':
	  if(empty($_GET['id'])){
			header('location:cmborder.php');
			exit;
		}
	  unset($_SESSION['shopcar'][$_GET['id']]);
	  header('location:cmborder.php');

	  break;

    //清空购物车
	case 'clear':
		unset($_SESSION['shopcar']);
		header('location:shopcar.php');
		break;
	case 'cclear':
		unset($_SESSION['shopcar']);
		header('location:cmborder.php');
		break;
		
	//立即购买的加减和清除
	case 'rsub':
		//var_dump($_GET['id']);die;
		if(empty($_GET['id'])){
			
			header('location:index.php');
			exit;
		}
		$_SESSION['rightbuy'][$_GET['id']]['buycount']--;
		if($_SESSION['rightbuy'][$_GET['id']]['buycount']<=0){
			unset($_SESSION['rightbuy'][$_GET['id']]);
		}

		header('location:cmborder.php');


	break;
	//购物车某商品数量+1
	case 'rjia':
		if(empty($_GET['id'])){
			//var_dump($_POST['id'])die;
			header('location:cmborder.php');
			exit;
		}
		//找到session里对应的那条记录,buynum字段加1
		$_SESSION['rightbuy'][$_GET['id']]['buycount']++;

		header('location:cmborder.php');


	break;

	//删除某个商品
	case 'rdel':
	  if(empty($_GET['id'])){
			header('location:cmborder.php');
			exit;
		}
	  unset($_SESSION['rightbuy'][$_GET['id']]);
	  header('location:cmborder.php');

	  break;

    //清空
	case 'rclear':
		unset($_SESSION['rightbuy']);
		//unset($_SESSION['shopcar']);
		header('location:cmborder.php');
		break;
	case "useredit":
		if(empty($_POST)){
				header('Location:login.php');die;
			}
			$id=$_POST['id'];
			//$username=$_POST['username'];
			//echo $username;die;
			$sex=$_POST['sex'];
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$state=$_POST['state'];
			//$addtime=$_POST['addtime'];
			
			$sql="update users set  sex='{$sex}',address='{$address}',phone='{$phone}',
			email='{$email}',state='{$state}' where id={$id}";
			$res=mysql_query($sql);
			//echo $sql;die;
			$m=mysql_affected_rows($link);
			if($m>=0){
				
				echo "<script type='text/javascript'>alert('修改成功！');location='usercenter.php';</script>";
			}else{
				echo "<script type='text/javascript'>alert('修改失败！');location='useredit.php';</script>";
				
			}
			
		break;
		case "userpwd":
			if(empty($_POST)){
				header('Location:login.php');die;
			}
			$id=$_POST['id'];
			$password=$_POST['password'];
			$rpassword=$_POST['rpassword'];
			if($password == $rpassword){
				header('location:userpwd.php?errorno=1');die;
			}
			$sql="update users set password='{$password}' where id={$id}";
			//echo $sql;die;
			$res=mysql_query($sql);
			if($res && mysql_affected_rows($link)>0){
				echo "<script type='text/javascript'>alert('修改密码成功！');location='usercenter.php';</script>";
			}else{
				echo "<script type='text/javascript'>alert('修改失败！');location='usercenter.php';</script>";
			}
		break;
		case "userdel":
			if(empty($_GET['id'])){
				header('Location:usercenter.php');die;
			}
			$id=$_GET['id'];
			
			$sql="delete from users  where id={$id}";
			$res=mysql_query($sql);
			$m=mysql_affected_rows($link);
			if($m>0){
				
				echo "<script type='text/javascript'>alert('删除成功！');Location='usercenter.php'</script>";
				
			}else{
				echo "<script type='text/javascript'>alert('删除失败！');Location='usercenter.php'</script>";
				
			}
			
			break;
			case "delorder":
			if(!empty($_GET['id'])){
				$oid=$_GET['id'];
				$sql8="update orders set isdel=0 where id={$oid}";
				$res8=mysql_query($sql8);
				if($res8 && mysql_affected_rows($link)>0){
					//$sql="delete from orderdetail where orderid={$oid}";
					echo "<script type='text/javascript'>alert('删除订单成功！');location='userorder.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('删除订单失败！');location='userorder.php';</script>";
				}
			}
			break;
			case "upstate":
				if(empty($_POST)){
					echo "<script type='text/javascript'>alert('没有选择订单！');location='userorder.php';</script>";
				}
				$id=$_POST['id'];
				$status=$_POST['status'];
				
				$sql9="update orders set status={$status} where id={$id}";
				$res9=mysql_query($sql9);
				if($res9 && mysql_affected_rows($link)>0){
					$sqlstate="select * from orders where id={$id}";
					$restate=mysql_query($sqlstate);
					$rowstate=mysql_fetch_assoc($restate);
					//var_dump($rowstate);die;
					if($rowstate['status']==5){
						$sqlp="select * from orderdetail where orderid={$id} ";
						$resp=mysql_query($sqlp);
						
						if($resp && mysql_num_rows($resp)>0){
							while($rowp=mysql_fetch_assoc($resp)){
							//var_dump($rowp);die;
							$sqlup="update product set num=num+{$rowp['buynum']},store=store-{$rowp['buynum']} where id={$rowp['pid']}";
							//echo $sqlup; die;
							$resup=mysql_query($sqlup);
							}
						}
					}
					if($rowstate['status']==6){
						$sqlod="update orders set isdel=0 where id={$id}";
						$resod=mysql_query($sqlod);
					}
					
					echo "<script type='text/javascript'>alert('修改订单状态成功！');location='userorder.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('修改订单状态失败！');location='userorder.php';</script>";
				}
			break;
		case "delorderdetail":
			if(!empty($_GET['id'])){
				$id=$_GET['id'];
				//$sql="update product set isdel=0 where id={$id}";
				$sql="delete from orderdetail where id={$id}";
				$res=mysql_query($sql);
				if($res && mysql_affected_rows()>=0){
					echo "<script type='text/javascript'>alert('删除成功！');location='ygmprod.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('删除失败！');location='ygmprod.php';</script>";
				}
			}
			break;
		case "addconment":
			if(!empty($_POST)){
				$pid=$_POST['id'];
				//$uid=$_POST['uid'];
				$uid=$_SESSION['users']['id'];
				$content=$_POST['content'];
				$addtime=time();
				$sql="insert into comments(pid,uid,content,addtime)
				values({$pid},{$uid},'{$content}','{$addtime}')";
				//echo $sql;
				$res=mysql_query($sql);
				if($res && mysql_affected_rows()>0){
					echo "<script type='text/javascript'>alert('评论成功！');location='commentlist.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('评论失败！');location='ygmprod.php';</script>";
				}
			}
			break;
		case "delcomment":
			if(!empty($_GET)){
				$id=$_GET['id'];
				$sql="delete from comments where id={$id}";
				$res=mysql_query($sql);
				if($res && mysql_affected_rows()>=0){
					echo "<script type='text/javascript'>alert('删除成功！');location='commentlist.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('删除失败！');location='commentlist.php';</script>";
				}
				
			}
		break;
		case "updateconment":
			if(!empty($_POST)){
				$id=$_POST['id'];
				$content=$_POST['content'];
				$sql="update comments set content='{$content}' where id={$id}";
				//echo $sql;die;
				$res=mysql_query($sql);
				if($res && mysql_affected_rows()>0){
					echo "<script type='text/javascript'>alert('修改成功！');location='commentlist.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('修改失败！');location='commentlist.php';</script>";
				}
			}
		break;
		case "address":
			if(!empty($_POST)){
				
				$uid=$_SESSION['users']['id'];
				$phone=$_POST['phone'];
				$code=$_POST['code'];
				$linkman=$_POST['linkman'];
				$address=$_POST['address'];
				
				$sql="insert into address(uid,phone,code,linkman,address)
				values({$uid},{$phone},'{$code}','{$linkman}','{$address}')";
				//echo $sql;
				$res=mysql_query($sql);
				if($res && mysql_affected_rows()>0){
					echo "<script type='text/javascript'>alert('添加成功成功！');location='addresslist.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('添加失败！');location='address.php';</script>";
				}
			}
		break;
		case "updateaddress":
			if(!empty($_POST)){
				$id=$_POST['id'];
				$linkman=$_POST['linkman'];
				$code=$_POST['code'];
				$phone=$_POST['phone'];
				$address=$_POST['address'];
				$sql="update address set linkman='{$linkman}'
				,code='{$code}',phone='{$phone}',address='{$address}'
				where id={$id}";
				//echo $sql;die;
				$res=mysql_query($sql);
				if($res && mysql_affected_rows()>0){
					echo "<script type='text/javascript'>alert('修改地址成功！');location='addresslist.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('修改地址失败！');location='addresslist.php';</script>";
				}
			}
		break;
		case "deladdress":
			if(!empty($_GET)){
				$id=$_GET['id'];
				$sql="delete from address where id={$id}";
				$res=mysql_query($sql);
				if($res && mysql_affected_rows()>=0){
					echo "<script type='text/javascript'>alert('删除成功！');location='addresslist.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('删除失败！');location='addresslist.php';</script>";
				}
				
			}
		break;
		case "upaddressstate":
			if(!empty($_GET)){
				$id=$_GET['id'];
				$sql="update address set state=0";
				$res=mysql_query($sql);
				$sqlu="update address set state=1 where id={$id}";
				$resu=mysql_query($sqlu);
				if($resu && mysql_affected_rows()>=0){
					echo "<script type='text/javascript'>alert('设置成功！');location='addresslist.php';</script>";
				}else{
					echo "<script type='text/javascript'>alert('设置失败！');location='addresslist.php';</script>";
				}
			}
		break;
	}
	




?>