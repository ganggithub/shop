<?php
	require "../public/dbconfig.php";
	require "../public/connect.php";
	if(empty($_GET)){
		header('Location:member-list.php');die;
	}
	$id=$_GET['id'];
	//echo $id;die;
	$sql="select * from users where id={$id}";
	$res=mysql_query($sql);
	$count=mysql_num_rows($res);
	if($count>0){
		$rows=mysql_fetch_assoc($res);
	}else{
		echo "<script type='text/javascript'>alert('查询失败');Location='member-list.php'</script>";
	}
	mysql_free_result($res);
	mysql_close($link);
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

<title>添加用户</title>
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 修改用户 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	
	
	
	
		<div class="mt-20">
		
			<form action="action.php?operate=update" method="post" class="form form-horizontal" id="form-admin-add">
		<div class="row cl">
			<input type="hidden" name="id" value="<?php  echo $rows['id'];?>"/>
			<label class="form-label col-3"><span class="c-red">*</span>管理员：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php  echo $rows['username'];?>" placeholder="" id="user-name" name="username" datatype="*2-16" nullmsg="用户名不能为空">

			</div>
			<div class="col-4"> </div>
		</div>
		
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>性别：</label>
			<div class="formControls col-5 skin-minimal">
				<div class="radio-box">
					<input type="radio" id="sex-1" name="sex" datatype="*" nullmsg="请选择性别！" value="1"  <?php  echo $rows['sex']=='1'?'checked':'';?>>
					<label for="sex-1">男</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="sex" value="0" <?php  echo $rows['sex']=='0'?'checked':'';?>>
					<label for="sex-2">女</label>
				</div>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>手机：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php  echo $rows['phone'];?>" placeholder="" id="user-tel" name="phone" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>地址：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="<?php  echo $rows['address'];?>" placeholder="" id="user-tel" name="address"  datatype="m" nullmsg="手机不能为空">
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" placeholder="@" name="email" id="email" value="<?php  echo $rows['email'];?>"/>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">角色：</label>
			<div class="formControls col-5"> <span class="select-box" style="width:150px;">
				<select class="select" name="state" size="1">
					<option value="0"  <?php  echo $rows['state']=='0'?'selected':'';?>>管理员</option>
					<option value="1"  <?php  echo $rows['state']=='1'?'selected':'';?>>普通会员</option>	
				</select>
				</span> </div>
		</div>
		
		<div class="row cl">
			<div class=" col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
			<div class="" style="float:left; margin-left:20px;">
				<input class="btn btn-primary radius" onclick="javascript:location.href='member-list.php';" type="button" value="&nbsp;&nbsp;取消&nbsp;&nbsp;">
			</div>
		</div>
	</form>
		
		</div>
	</div>

</body>
</html>