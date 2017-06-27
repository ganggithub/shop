<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>商品类别信息管理</title>
    </head>
    <body>
        <center>
           <h3>商品类别信息</h3>
           <select name="typeid">
                <?php
                    //执行数据信息提取并循环输出
                    //1. 导入配置文件
                    require "../public/dbconfig.php";
					require "../public/connect.php";
                    
                    //4. 定义sql语句，并发送执行
                    $sql = "select * from category order by concat(path,id)";
                    $result = mysql_query($sql,$link);
                    
                    //5. 解析结果集，并遍历输出
                    while($row = mysql_fetch_assoc($result)){
                        //计算类别名前空格数量
                        $m = substr_count($row['path'],",")-1; //计算path中逗号的次数-1
                        $str = str_repeat("&nbsp;",$m*4);
                        //判断是否禁用
                        $disabled = ($row['pid']==0)?"disabled":"";
                        //输出下拉项
                        echo "<option {$disabled} value='{$row['id']}'>";
                        echo "{$str}|--{$row['name']}";
                        echo "</option>";
                    }
                    
                    //6. 释放结果集，关闭数据库
                    mysql_free_result($result);
                    mysql_close($link);
                ?>
           </select>
        </center>
    </body>
</html>