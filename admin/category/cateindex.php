


<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>会员管理</title>
		 <script type="text/javascript">
            //定义一个执行删除判断函数
            function doDel(id){
                if(confirm("确定要删除吗？")){
                    //跳转网页,并携带参数
                    window.location='action.php?operate=delete&id='+id;
                }
            }
        </script>
	</head>
	<body>
		<center>
			<h3>商品类别管理</h3>
			<form action="cateindex.php" method='get'>
				<table border='1px' width='800px'>
					<tr>
						<td>商品类别名：</td>
						<td><input type="text" name='name' value="<?php echo @$_GET['name'] ?>"></td>
						<td>
							<input type="submit" value='搜索'> 
						</td>
						<td>
							<h3><a href="cateadd.php ">添加商品类别</a></h3>
						
						</td>
					</tr>
				</table>
				
				
				
				
			</form>
			<?php 
				date_default_timezone_set('PRC');
				require "../public/dbconfig.php";
				require "../public/connect.php";
				$where="";
				$search="";
				if(!(empty($_GET['name']))){
					$where .=" where name like '%{$_GET['name']}%'";
					$search.="&name={$_GET['name']}";
				}
				$sql="select * from users";
				$res=mysql_query($sql);
				$totalpage=mysql_num_rows($res);
				$pagesize=5;//每页显示几条数据
				$pagenum=ceil($totalpage/$pagesize);//总共有多少页
				$currentpage=empty($_GET['p'])?1:$_GET['p'];//当前页
				if(@$_GET['p']<1){
					$currentpage=1;
				}
				if(@$_GET['p']>$pagenum){
					$currentpage=$pagenum;
				}
				$limit="  limit  ".($currentpage-1)*$pagesize.",{$pagesize}";
				$sql="select * from category {$where}  order by concat(path,id) {$limit}";
				//echo $sql;die;
				$res=mysql_query($sql);
				
				if($res){
					echo "<table width='800px' border='1px' align='center'>";
						echo "<tr>
							
							<th>ID号</th>
							<th>类别名称</th>
							<th>父cid</th>
							<th>路径</th>
							<th>操作</th>
							
						</tr>";
						$count=mysql_num_rows($res);
						if($count==0){
							echo "<tr><td colspan='9'>没有数据,请添加用户吧</td></tr>";
						}
						while($rows=mysql_fetch_assoc($res)){
							 //计算类别名前空格数量
							$m = substr_count($rows['path'],",")-1; //计算path中逗号的次数-1
							$str = @str_repeat("&nbsp;",$m*4);
							echo "<tr>";
								echo "<td>{$rows['id']}</td>";
								echo "<td>{$rows['name']}</td>";
								echo "<td>{$rows['pid']}</td>";
								echo "<td>{$rows['path']}</td>";
								echo "<td>
									<a href='cateadd.php?pid={$rows['id']}&path={$rows['path']}&name={$rows['name']}'>添加</a>
									<a href='updatecate.php?id={$rows['id']}'>修改</a>
									<a href='javascript:doDel({$rows['id']});'>删除</a>
								</td>";
							echo "</tr>";
						}
						echo "<tr><td colspan='9' align='right'>";
						echo "当前页数是{$currentpage}/{$pagenum}";
						echo "<a href='cateindex.php?p=1{$search}'>首页</a>";
						echo "<a href='cateindex.php?p=".($currentpage-1)."{$search}'>上一页</a>";
						echo "<a href='cateindex.php?p=".($currentpage+1)."{$search}'>下一页</a>";
						echo "<a href='cateindex.php?p={$pagenum}{$search}'>尾页<a/>";
						echo "</td></tr>";
					echo "</table>";
				}
			
			?>
		</center>
	</body>

</html>