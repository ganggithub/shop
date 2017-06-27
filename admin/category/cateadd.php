<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>添加产品类别</title>
	</head>
	<body>
		<center>
			<?php
				$name="根类别";
				$pid=0;
				$path=0;
				if(isset($_GET['pid']) && isset($_GET['path'])){
					$name=$_GET['name'];
					$pid=$_GET['pid'];
					$path=$_GET['path'].$_GET['pid'].',';
				}
			?>
			<h3>添加商品类别信息</h3>
			<table width="800px" border="1px" >
				<form action="cateaction.php?operate=add" method="post">
					<input type="hidden" name="pid" value="<?php echo $pid;  ?>"/>
					<input type="hidden" name="path" value="<?php echo $path;?>"/>
					<tr>
						<td>父类别名：</td>
						<td><?php echo $name; ?></td>
					</tr>
					<tr>
						<td>类别名称：</td>
						<td><input type="text" name="name"/></td>
					</tr>
					<tr>
						
						<td colspan="2">
							<input type="submit" value="添加"/>
							<input type="reset" value="重置"/>
						</td>
					</tr>
				</form>
			</table>
		</center>
	</body>
</html>