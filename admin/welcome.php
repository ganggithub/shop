<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	require "../public/dbconfig.php";
	require "../public/connect.php";
	if(empty($_SESSION['adminuser'])){
		echo "<script type='text/javascript'>alert('你还没有登录，请先登录！');location='login.php';</script>";
	}
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
<link href="public/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="public/css/H-ui.admin.css" rel="stylesheet" type="text/css" />

<link href="public/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>我的桌面</title>
</head>
<body>
<div class="pd-20" style="padding-top:20px;">
  <p class="f-20 text-success">欢迎使用蘑菇街商城后台</p>
  <p><?php echo $_SESSION['adminuser']['username']; ?>这是您第：
  <?php $m=@$_COOKIE['count']+0;
					$m++;
					setCookie("count",$m,time()+3600,"/");
					echo $m;
  
  ?>次登录 </p>
  
  <table class="table table-border table-bordered table-bg mt-20">
    <thead>
      <tr>
        <th colspan="2" scope="col">服务器信息</th>
		
      </tr>
    </thead>
    <tbody>
      <tr>
        <th width="200">服务器的主机名</th>
        <td><span id="lbServerName"><?php  echo $_SERVER['SERVER_NAME'];?></span></td>
      </tr>
      <tr>
        <td>服务器IP地址</td>
        <td><?php  echo $_SERVER['SERVER_ADDR'];?></td>
      </tr>
      <tr>
        <td>服务器域名</td>
        <td><?php  echo $_SERVER['SERVER_NAME'];?></td>
      </tr>
      <tr>
        <td>服务器端口 </td>
        <td><?php  echo $_SERVER['SERVER_PORT'];?></td>
      </tr>
      <tr>
        <td>服务器标识字符串 </td>
        <td><?php  echo $_SERVER['SERVER_SOFTWARE'];?></td>
      </tr>
      <tr>
        <td>本文件所在文件夹 </td>
        <td><?php  echo $_SERVER['DOCUMENT_ROOT'];?></td>
      </tr>
     
      <tr>
        <td>系统所在文件夹 </td>
        <td><?php  echo $_SERVER['SystemRoot'];?></td>
      </tr>
      <tr>
        <td>服务器使用的 CGI 规范的版本 </td>
        <td><?php  echo $_SERVER['GATEWAY_INTERFACE'];?></td>
      </tr>
      <tr>
        <td>请求页面时通信协议的名称和版本 </td>
        <td><?php  echo $_SERVER['SERVER_PROTOCOL'];?></td>
      </tr>
      <tr>
        <td>访问页面使用的请求方法 </td>
        <td><?php  echo $_SERVER['REQUEST_METHOD'];?></td>
      </tr>
      <tr>
        <td>请求开始时的时间戳</td>
        <td><?php  echo $_SERVER['REQUEST_TIME'];?></td>
      </tr>
      <tr>
        <td>当前请求头中 Accept </td>
        <td><?php  echo $_SERVER['HTTP_ACCEPT'];?></td>
      </tr>
      
      <tr>
        <td>当前请求头中 Accept-Encoding </td>
        <td><?php  echo $_SERVER['HTTP_ACCEPT_ENCODING'];?></td>
      </tr>
      
    </tbody>
  </table>
</div>

<script type="text/javascript" src="public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="public/js/H-ui.js"></script>
<script>
// var _hmt = _hmt || [];
// (function() {
  // var hm = document.createElement("script");
  // hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  // var s = document.getElementsByTagName("script")[0]; 
  // s.parentNode.insertBefore(hm, s);
// })();
// var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
// document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>