<?php
	session_start();
	$c=4;
	$t=3;
	$width=$c*20;
	$height=30;
	$code=getCode11($c,$t);
	//
	$img=imagecreate($width,$height);
	$bg[0]=imagecolorallocate($img,200,200,200);
	$bg[1]=imagecolorallocate($img,220,230,210);
	$bg[2]=imagecolorallocate($img,120,130,110);
	$col[0]=imagecolorallocate($img,0,255,0);
	$col[1]=imagecolorallocate($img,0,0,255);
	$col[2]=imagecolorallocate($img,130,128,20);
	$col[3]=imagecolorallocate($img,255,0,0);
	$black=imagecolorallocate($img,0,0,0);
	$gray=imagecolorallocate($img,204,204,204);
	
	imagefill($img,0,0,$bg[rand(0,2)]);
	
	imagerectangle($img,0,0,$width-1,$height-1,$gray);
	for($i=0;$i<100;$i++){
		$co=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		imagesetpixel($img,rand(0,$width),rand(0,$height),$co);
	}
	for($i=0;$i<5;$i++){
		$cc=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		imageline($img,rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$cc);
	}
	for($i=0;$i < $c;$i++){
		imagettftext($img,18,rand(-30,30),(3+$i*20),24,$col[rand(0,3)],'fonts/msyh.ttf',$code[$i]);
		
		
		
	}
	
	//var_Dump($code);
	header('Content-type:image/jpeg');
	imagejpeg($img);
	
	
	$_SESSION['code']=$code;
	$_SESSION['mycode']=$code;
	//echo $code;die;
	
	imagedestroy($img);

	function getCode11($count,$type=1){
		$str="0123456789ioabdefghijkmnpqrstuvwxyzABCDEOFGHIJKLMNPQRSTUVWXYZ";
		if($type==1){
			$m=9;
		}
		if($type==2){
			$m=35;
		}
		if($type==3){
			$m=61;
		}
		$len=strlen($str);
		$mess="";
		for($i=0;$i<$count;$i++){
			$mess.=$str[rand(0,$m)];
			//$mess.=$str[1];
		}
		return $mess;
	}
	
?>