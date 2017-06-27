<?php
	require "../public/dbconfig.php";
	require "../public/connect.php";
	if(empty($_GET)){
		header('Location:orders-list.php');die;
	}
	$id=$_GET['id'];
	//echo $id;die;
	$sql="select * from orders where id={$id}";
	$res=mysql_query($sql);
	$count=mysql_num_rows($res);
	if($count>0){
		$rows=mysql_fetch_assoc($res);
	}else{
		echo "<script type='text/javascript'>alert('查询失败');Location='orders-list.php'</script>";
	}
	
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
<link href="../public/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="../public/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />

<title>修改订单信息</title>
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单中心 <span class="c-gray en">&gt;</span> 修改订单信息 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	
	
	
	
		<div class="mt-20">
		
			<form action="orders-action.php?operate=update" method="post" class="form form-horizontal" id="form-admin-add" enctype="multipart/form-data">
			
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>会员名称：</label>
			<input type="hidden" name="id" value="<?php echo $rows['id'] ;?>"/>
			<div class="formControls col-5">
				<input type="text" class="input-text" disabled value="<?php 
				
				$sql2="select * from users where id={$rows['uid']}";
				//echo $sql2;die;
				$res2=mysql_query($sql2);
				
				$rows2=mysql_fetch_assoc($res2);
			
				
				
				echo $rows2['username']  ?>" placeholder=""  name="username" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		
		
		
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>联系人：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php echo $rows['linkman']; ?>" placeholder="" disabled name="linkman" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>地址：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php echo $rows['address']; ?>" placeholder="" disabled  name="address" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		
		
		
		
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>电话：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php echo $rows['phone']; ?>" placeholder="" disabled  name="phone" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>总金额：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php echo $rows['total']; ?>" placeholder="" disabled  name="total" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>备注：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php echo $rows['remark']; ?>" placeholder="" disabled  name="remark" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		 <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>订单状态：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
			
          <input type="radio" id="sex-1" value="1" name="status" <?php echo $rows['status']==1?"checked":""; ?>/>
          <label for="sex-1">新订单</label>
        </div>
       <!-- <div class="radio-box">
          <input type="radio" id="sex-2" name="status" value="2" <?php echo $rows['status']==2?"checked":""; ?>>
          <label for="sex-2">待付款</label>
        </div>-->
        <div class="radio-box">
          <input type="radio" id="sex-3" name="status" value="3" <?php echo $rows['status']==3?"checked":""; ?> />
          <label for="sex-3">已发货</label>
        </div>
		<!--<div class="radio-box">
			
          <input type="radio" id="sex-1" value="4" name="status" <?php echo $rows['status']==4?"checked":""; ?>/>
          <label for="sex-1">待收货</label>
        </div>-->
        <!--<div class="radio-box">
          <input type="radio" id="sex-2" name="status" value="5" <?php echo $rows['status']==5?"checked":""; ?>>
          <label for="sex-2">已收货</label>
        </div>-->
       <!-- <div class="radio-box">
          <input type="radio" id="sex-3" name="status" value="6" <?php echo $rows['status']==6?"checked":""; ?> />
          <label for="sex-3">无效订单</label>
        </div>-->
      </div>
      <div class="col-4"> </div>
    </div>
		
		 
		
		<div class="row cl">
			<div class=" col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;修改&nbsp;&nbsp;">
			</div>
			<div class="" style="float:left; margin-left:20px;">
				<input class="btn btn-primary radius" type="button" onclick="javascript:location.href='orders-list.php';" value="&nbsp;&nbsp;取消&nbsp;&nbsp;">
			</div>
		</div>
	</form>
		</div>
	</div>
<?php  mysql_free_result($res);
	
	mysql_close($link);?>
</body>
</html>
