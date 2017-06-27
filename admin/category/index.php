<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>商品类别信息管理</title>
        <script type="text/javascript">
            //定义一个执行删除判断函数
            function doDel(id){
                if(confirm("确定要删除吗？")){
                    //跳转网页,并携带参数
                    window.location='action.php?a=del&id='+id;
                }
            }
        </script>
    </head>
    <body>
        <center>
           <h3>商品类别信息</h3>
           <table width="600" border="1">
                <tr>
                    <th>ID号</th>
                    <th>类别名称</th>
                    <th>父pid</th>
                    <th>路径</th>
                    <th>操作</th>
                </tr>
                <?php
                    //执行数据信息提取并循环输出
                    //1. 导入配置文件
                    require "../public/dbconfig.php";
					require "../public/connect.php";
                    //3. 选择数据库并设置字符编码
                    mysql_select_db(DBNAME,$link);
                    mysql_set_charset("utf8");
                    
                    //4. 定义sql语句，并发送执行
                    $sql = "select * from category order by concat(path,id)";
                    $result = mysql_query($sql,$link);
                    
                    //5. 解析结果集，并遍历输出
                    while($row = mysql_fetch_assoc($result)){
                        //计算类别名前空格数量
                        $m = @substr_count($row['path'],",")-1; //计算path中逗号的次数-1
                        $str = @str_repeat("&nbsp;",$m*4);
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$str}|--{$row['name']}</td>";
                        echo "<td>{$row['pid']}</td>";
                        echo "<td>{$row['path']}</td>";
                        echo "<td>
                                <a href='add.php?pid={$row['id']}&path={$row['path']}&name={$row['name']}'>添加子类别</a>
                                <a href='javascript:doDel({$row['id']});'>删除</a>
                                <a href='edit.php?id={$row['id']}'>修改</a>
                                </td>";
                        echo "</tr>";
                    }
                    
                    //6. 释放结果集，关闭数据库
                    mysql_free_result($result);
                    mysql_close($link);
                ?>
           </table>
        </center>
    </body>
</html>