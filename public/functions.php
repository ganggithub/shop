<?php
//公共函数库文件

/**
 * 文件上传函数
 *@param array $upfile 上传文件信息 如：$_FILES['myfile'];
 *@param string $path 上传文件储存路径
 *@param array $typelist 允许的上传文件类型，默认值空数组表示不限制类型
 *      例如限制图片：array("image/jpeg","image/png","image/gif");
 *@param int $maxsize 允许上传文件的大小限制，默认值0表示不限制
 *@return array 返回一个两个存储单元的数组：
 *  格式：array("error"=>"true/false表示上传成功与否","info"=>成功的文件名或失败的原因);
 */
 function fileUpload($upfile,$path,$typelist=array(),$maxsize=0){
    //1. 初始化上传信息
    $path = rtrim($path,"/")."/"; //存储上传文件目录
    $res = array("error"=>false,"info"=>""); //定义返回值格式

    //2. 判断上传错误号
    if($upfile['error']>0){
        switch($upfile['error']){
            case 1: $info = "上传文件大小超出php.ini的配置"; break;
            case 2: $info = "上传文件大小超出表单隐藏域设置"; break;
            case 3: $info = "只有部分文件被上传"; break;
            case 4: $info = "没有上传文件"; break;
            case 6: $info = "找不到临时文件夹"; break;
            case 7: $info = "上传文件写入失败"; break;
            default: $info = "未知错误！"; break;
        }
        $res['info'] = $info;
        return $res;
    }

    //3. 过滤上传类型
    if(!empty($typelist)){
        if(!in_array($upfile['type'],$typelist)){
           $res['info'] = "文件类型错误！";
           return $res;
        }
    }
    //4. 过滤上传文件大小
    if($maxsize>0){
        if($upfile['size']>$maxsize){
           $res['info'] = "文件大小超出限制！";
           return $res;
        }
    }

    //5. 随机上传文件名
    $ext = pathinfo($upfile['name'],PATHINFO_EXTENSION);//获取文件的后缀名
    do{
        //随机一个名字并判断是否已存在
        $filename = date("YmdHis").rand(1000,9999).".".$ext;
    }while(file_exists($path.$filename));

    //6. 判断并执行上传文件移动
    if(is_uploaded_file($upfile['tmp_name'])){
        //执行移动
        if(move_uploaded_file($upfile['tmp_name'],$path.$filename)){
           $res['info'] = $filename;
           $res['error']=true;
        }else{
            $res['info'] = "移动上传文件错误！";
        }
    }else{
        $res['info'] = "无效的上传文件!";
    }
    
    return $res; //返回值
 }
 
 
 
 /**
 *自定义一个图片等比缩放函数
 *@param string $picname 被缩放图片名
 *@param string $path 被缩放图片路径
 *@param int $maxWidth 图片被缩放后的最大宽度
 *@param int $maxHeight 图片被缩放后的最大高度
 *@param string $pre 缩放后的图片名前缀，默认为"s_"
 *@return boolen 返回布尔值表示成功与否。
 */
function imageResize($picname,$path,$maxWidth,$maxHeight,$pre="s_"){
    $path = rtrim($path,"/")."/";
    //1获取被缩放的图片信息
    $info = getimagesize($path.$picname);
    //获取图片的宽和高
    $width = $info[0];
    $height = $info[1];
    
    //2根据图片类型，使用对应的函数创建画布源。
    switch($info[2]){
        case 1: //gif格式
            $srcim = imagecreatefromgif($path.$picname);
            break;
        case 2: //jpeg格式
            $srcim = imagecreatefromjpeg($path.$picname);
            break;
        case 3: //png格式
            $srcim = imagecreatefrompng($path.$picname);
            break;
       default:
            return false;
            //die("无效的图片格式");
            break;
    }
    //3. 计算缩放后的图片尺寸
    if($maxWidth/$width<$maxHeight/$height){
        $w = $maxWidth;
        $h = ($maxWidth/$width)*$height;
    }else{
        $w = ($maxHeight/$height)*$width;
        $h = $maxHeight;
    }
    //4. 创建目标画布
    $dstim = imagecreatetruecolor($w,$h); 

    //5. 开始绘画(进行图片缩放)
    imagecopyresampled($dstim,$srcim,0,0,0,0,$w,$h,$width,$height);

    //6. 输出图像另存为
    switch($info[2]){
        case 1: //gif格式
            imagegif($dstim,$path.$pre.$picname);
            break;
        case 2: //jpeg格式
            imagejpeg($dstim,$path.$pre.$picname);
            break;
        case 3: //png格式
            imagepng($dstim,$path.$pre.$picname);
            break;
    }
    

    //7. 释放资源
    imagedestroy($dstim);
    imagedestroy($srcim);
    
    return true;
}