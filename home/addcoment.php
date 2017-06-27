<?php
	session_start();
	require "../public/dbconfig.php";
	require "../public/connect.php";
	//if(empty($_GET)){
		//header('location:index.php');
		//die;
	//}
	//$

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="public/lib/html5.js"></script>
<script type="text/javascript" src="public/lib/respond.min.js"></script>
<script type="text/javascript" src="public/lib/PIE_IE678.js"></script>
<![endif]-->

		<link rel="stylesheet" href="public/css/public.css"/>
		<link rel="stylesheet" href="public/css/header.css"/>
		<link rel="stylesheet" href="public/css/usercenter.css"/>
<link href="public/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="public/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="public/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="public/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<link href="public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>确认添加评论页面</title>
</head>
<body>
	<?php require "public/podhead.php"; ?>
			
		<div class="header_mid clear">
			<div class="center">
				<a href="index.php" class="logo"></a>
				<div class="hmmidd fl">
					<div class="search_inner_box">
						<div class="selectbox">
							<span class="selected">搜商品</span>
							<ol>
								<li class="current"><a href="">商品</a></li>
								<li><a href="">店铺</a></li>
							</ol>
						</div>
						<form action="searchlist.php" method="get">
							<input class="ts_txt fl" type="text" value="简约百搭欧美大牌短靴"/>
							<input class="ts_btn" type="submit" value="搜索"/>
						</form>
					</div>
					<div class="ts_hotwords">
						<?php  
							$sql="select * from category";
							$res=mysql_query($sql);
							if($res && mysql_num_rows($res)>0){
								while($row=mysql_fetch_assoc($res)){
									echo "<a href=\"searchlist.php?id={$row['id']}\">{$row['name']}</a>";
								}
							}
						?>
						
					</div>
				</div>
				<div class="hmright fr">
					<img src="public/images/weixinlist.png" height="70px" width="70px"/>
					<p>蘑菇街客户端</p>
				</div>
			</div>
		</div>
		<div class="userbody clear">
			<div class="center">
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
							<li><a href="useredit.php">修改个人信息</a></li>
							<li><a href="userpwd.php">修改密码</a></li>
							<li><a href="searchlist.php?uid=<?php echo $_SESSION['users']['id']; ?>">我的收藏</a></li>
							<li><a href="commentlist.php">查看评论</a></li>
							<li><a href="addresslist.php">地址管理</a></li>
						</ul>
					</div>
				</div>
				<div class="userright fl">
					<div class="userheader"><span>添加评论</span></div>
					<div class="userinfo">
<div class="pd-20">
	<form action="doaction.php?operate=addconment" method="post" class="form form-horizontal" id="form-article-add">
		
		<div class="row cl">
			<?php
				if(!empty($_GET['id'])){
					$id=$_GET['id'];
					$sql="select * from product where id={$id}";
					$res=mysql_query($sql);
					$row=mysql_fetch_assoc($res);
				}
			
			?>
			<input type="hidden" name="id" value="<?php  echo $row['id'];?>"/>
			<label class="form-label col-2">评论内容：</label>
			<div class="formControls col-10"> 
				<script id="editor" type="text/plain" name="content" style="width:100%;height:400px;"></script> 
			</div>
		</div>
		<div class="row cl">
			<div class="col-10 col-offset-2">
				
				<button  class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 发布评论</button>
				<button  class="btn btn-default radius" type="button" onclick="javascript:location.href='commentlist.php';">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>
</div>
				</div>
			</div>
		</div>
<script type="text/javascript" src="public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="public/lib/layer/1.9.3/layer.js"></script> 
<script type="text/javascript" src="public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="public/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="public/lib/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="public/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="public/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="public/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> 
<script type="text/javascript" src="public/js/H-ui.js"></script> 
<script type="text/javascript" src="public/js/H-ui.admin.js"></script> 
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