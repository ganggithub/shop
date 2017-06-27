
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

<title>添加产品类别</title>
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品中心 <span class="c-gray en">&gt;</span> 添加产品类别 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	
	
	
	
		<div class="mt-20">
			  <?php
                //处理父类别信息
                $name = "根类别";
                $pid = 0;
                $path="0,";
                //接收参数信息
                if(isset($_GET['id']) && isset($_GET['path'])){
                    $name = $_GET['name'];
                    $pid = $_GET['id'];
                    $path = $_GET['path'].$_GET['id'].",";
                }
           
			?>
			<form action="cateaction.php?operate=add" method="post" class="form form-horizontal" id="form-admin-add">
			<input type="hidden" name="pid" value="<?php echo $pid;  ?>"/>
					<input type="hidden" name="path" value="<?php echo $path;?>"/>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>父类别名：</label>
			<div class="formControls col-5">
				<?php echo $name; ?>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>产品类别名：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="" placeholder="" id="user-name" name="name" datatype="*2-16" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		 
		
		<div class="row cl">
			<div class=" col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
			<div class="" style="float:left; margin-left:20px;">
				<input class="btn btn-primary radius" type="button" onclick="javascript:location.href='category-list.php';" value="&nbsp;&nbsp;取消&nbsp;&nbsp;">
			</div>
		</div>
	</form>
		
		</div>
	</div>

</body>
</html>