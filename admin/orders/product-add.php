<?php
	require "../../public/dbconfig.php";
	require "../../public/connect.php";
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

<title>添加产品信息</title>
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品中心 <span class="c-gray en">&gt;</span> 添加产品信息 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	
	
	
	
		<div class="mt-20">
			  
			<form action="product-action.php?operate=add" method="post" class="form form-horizontal" id="form-admin-add" enctype="multipart/form-data">
			
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>产品名称：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="" placeholder=""  name="pname" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		
		
		
		 <div class="row cl">
      <label class="form-label col-3">产品类别：</label>
      <div class="formControls col-5"> <span class="select-box">
        <select class="select" size="1" name="cid" datatype="*" nullmsg="请选择产品类别！">
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
						if(in_array($v['id'],$pid)){
							echo "<option disabled value='{$v['id']}'>{$html}|--{$v['name']}</option>";
						}else{
							echo "<option  value='{$v['id']}'>{$html}|--{$v['name']}</option>";
						}
					}
				}else{

				}
                   ?>
				
          
        </select>
        </span> </div>
      <div class="col-4"> </div>
    </div>
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>公司名称：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="" placeholder=""  name="company" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>产品价格：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="" placeholder=""  name="price" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		
		
		<div class="row cl" style="height:100px;line-height:100px;">
      <label class="form-label col-3">产品图片：</label>
      <div class="formControls col-5" style="height:100px;line-height:100px;"> <span class="btn-upload form-group" style="height:100px;line-height:100px;">
	   <input type="file" name="picname"  class="">
	   
      <img src="../../public/uploads/picname" width="70px" height="70px"/>
        
       
		
		
        </span> </div>
      <div class="col-4"> </div>
    </div>
		
		
		<div class="row cl">
			<label class="form-label col-3"><span class="c-red">*</span>产品库存：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="" placeholder=""  name="store" >
				
			</div>
			<div class="col-4"> </div>
		</div>
		 <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>状态：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="sex-1" value="1" name="state" datatype="*" nullmsg="请选择性别！">
          <label for="sex-1">新品</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-2" name="state" value="2">
          <label for="sex-2">在售商品</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-3" name="state" value="3">
          <label for="sex-3">下线</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
		 <div class="row cl">
      <label class="form-label col-3">产品描述：</label>
      <div class="formControls col-5">
        <textarea name="describes" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
      <div class="col-4"> </div>
    </div>
		 
		
		<div class="row cl">
			<div class=" col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
			<div class="" style="float:left; margin-left:20px;">
				<input class="btn btn-primary radius" type="reset" value="&nbsp;&nbsp;重置&nbsp;&nbsp;">
			</div>
		</div>
	</form>
		
		</div>
	</div>

</body>
</html>