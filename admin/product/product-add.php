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






<!--[if lt IE 9]>
<script type="text/javascript" src="../public/lib/html5.js"></script>
<script type="text/javascript" src="../public/lib/respond.min.js"></script>
<script type="text/javascript" src="../public/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="../public/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="../public/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="../public/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="../public/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<link href="../public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="../public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加产品信息</title>
</head>
<body>
	
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品中心 <span class="c-gray en">&gt;</span> 添加产品信息 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="pd-20">
	<form action="product-action.php?operate=add" method="post" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>产品标题：</label>
			<div class="formControls col-10">
				<input type="text" class="input-text" value="" placeholder="" id="" name="pname">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-2"><span class="c-red">*</span>产品类别：</label>
			<div class="formControls col-2"> <span class="select-box">
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
		
			
		
		</div>
		
		<div class="row cl">
			<label class="form-label col-2">公司名称：</label>
			<div class="formControls col-10">
				<input type="text" name="company" id="" placeholder="" value="" class="input-text">
			</div>
		</div>
		
		
		<div class="row cl">
			<label class="form-label col-2">产品展示价格：</label>
			<div class="formControls col-4">
				<input type="text" name="price" id="" placeholder="" value="" class="input-text" style="width:90%">
				元</div>
			<label class="form-label col-2">产品库存：</label>
			<div class="formControls col-4">
				<input type="text" name="store" id="" placeholder="" value="" class="input-text" style="width:90%">
				件</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-2">产品颜色：</label>
			<div class="formControls col-10">
				<input type="text" name="color" id="" placeholder="多中颜色用英文逗号隔开，限10中颜色" value="" class="input-text">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-2">产品尺寸：</label>
			<div class="formControls col-10">
				<input type="text" name="size" id="" placeholder="多中尺寸用英文逗号隔开，限10种尺寸" value="" class="input-text">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-2">产品状态：</label>
			<div class="formControls col-10">
				 <div class="radio-box">
          <input type="radio" id="sex-1" value="1" name="state" datatype="*" nullmsg="请选择性别！">
          <label for="sex-1">新品</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-2" name="state" value="2">
          <label for="sex-2">在售商品</label>
        </div>
		<div class="radio-box">
          <input type="radio" id="sex-4" name="state" value="4">
          <label for="sex-3">热卖</label>
        </div>
		<div class="radio-box">
          <input type="radio" id="sex-5" name="state" value="5" >
          <label for="sex-3">促销</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-3" name="state" value="3">
          <label for="sex-3">下线</label>
        </div>
			</div>
		</div>
		 
		<div class="row cl">
			<label class="form-label col-2">缩略图：</label>
			
				
					 <input type="file" name="picname"  class="">
				
				
			
		</div>
		
		<div class="row cl">
			<label class="form-label col-2">文章内容：</label>
			<div class="formControls col-10"> 
				<script id="editor" name="describes" type="text/plain" style="width:100%;height:400px;"></script> 
			</div>
		</div>
		<div class="row cl">
			<div class="col-10 col-offset-2">
				
				<button  class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加</button>
				<button onclick="javascript:location.href='product-list.php';" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
</div>
	
	
	
	
	
	
	
	
	


	
<script type="text/javascript" src="../public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="../public/lib/layer/1.9.3/layer.js"></script> 
<script type="text/javascript" src="../public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="../public/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="../public/lib/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="../public/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="../public/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="../public/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="../public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> 
<script type="text/javascript" src="../public/js/H-ui.js"></script> 
<script type="text/javascript" src="../public/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$list = $("#fileList"),
	$btn = $("#btn-star"),
	state = "pending",
	uploader;

	var uploader = WebUploader.create({
		auto: true,
		swf: 'lib/webuploader/0.1.5/Uploader.swf',
	
		// 文件接收服务端。
		server: 'http://lib.h-ui.net/webuploader/0.1.5/server/fileupload.php',
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		}
	});
	uploader.on( 'fileQueued', function( file ) {
		var $li = $(
			'<div id="' + file.id + '" class="item">' +
				'<div class="pic-box"><img></div>'+
				'<div class="info">' + file.name + '</div>' +
				'<p class="state">等待上传...</p>'+
			'</div>'
		),
		$img = $li.find('img');
		$list.append( $li );
	
		// 创建缩略图
		// 如果为非图片文件，可以不用调用此方法。
		// thumbnailWidth x thumbnailHeight 为 100 x 100
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>不能预览</span>');
				return;
			}
	
			$img.attr( 'src', src );
		}, thumbnailWidth, thumbnailHeight );
	});
	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
			$percent = $li.find('.progress-box .sr-only');
	
		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
		}
		$li.find(".state").text("上传中");
		$percent.css( 'width', percentage * 100 + '%' );
	});
	
	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	uploader.on( 'uploadSuccess', function( file ) {
		$( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
	});
	
	// 文件上传失败，显示上传出错。
	uploader.on( 'uploadError', function( file ) {
		$( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
	});
	
	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on( 'uploadComplete', function( file ) {
		$( '#'+file.id ).find('.progress-box').fadeOut();
	});
	uploader.on('all', function (type) {
        if (type === 'startUpload') {
            state = 'uploading';
        } else if (type === 'stopUpload') {
            state = 'paused';
        } else if (type === 'uploadFinished') {
            state = 'done';
        }

        if (state === 'uploading') {
            $btn.text('暂停上传');
        } else {
            $btn.text('开始上传');
        }
    });

    $btn.on('click', function () {
        if (state === 'uploading') {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });

	
	
	var ue = UE.getEditor('editor');
	
});

function mobanxuanze(){
	
}
</script>
</body>
</html>