<?php 
	//数据库配置文件
	include "../../public/dbconfig.php";
	//数据库连接文件
	include "../../public/connect.php";
	

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加商品</title>
</head>
<body>
<center>
	<form action="doaction.php?a=add" method='post' enctype="multipart/form-data">
		<table>
		   
			<tr>
				<td>商品名称</td>
				<td> <input type="text" name='proname' value=''></td>
			</tr>
			<tr>
				<td>分类ID</td>
				<td> 
				<select name="tid">
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
							echo "<option disabled value='{$v['id']}'>{$html}{$v['name']}</option>";
						}else{
							echo "<option  value='{$v['id']}'>{$html}{$v['name']}</option>";
						}
					}
				}else{

				}
                   ?>
					</select>

				</td>
			</tr>
			<tr>
				<td>商品价格</td>
				<td> <input type="text" name='price' value=''></td>
			</tr>
			<tr>
				<td>商品图片1</td>
				<td> <input type="file" name='image1' value=''></td>
			</tr>
			<tr>
				<td>商品图片2</td>
				<td> <input type="file" name='image2' value=''></td>
			</tr>
			<tr>
				<td>商品图片3</td>
				<td> <input type="file" name='image3' value=''></td>
			</tr>


			<tr>
				<td>库存</td>
				<td> <input type="text" name='store' value=''></td>
			</tr>
			<tr>
				<td>商品描述</td>
				<td> <textarea name="des" id="" cols="30" rows="10"></textarea></td>
			</tr>
			<tr>
				<td>商品状态</td>
				<td> 
					<select name="state">
						<option value="1">新品</option>
						<option value="2">在售</option>
						<option value="3">下架</option>
					</select>
				</td>
			</tr>
		
			<tr>
				
				<td colspan=2> <input type="submit"  value='添加'></td>
			</tr>
		</table>


	</form>
<center>
</body>
</html>