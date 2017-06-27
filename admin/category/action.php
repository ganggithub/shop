<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>会员信息管理</title>
    </head>
    <body>
        <center>
           <h3>商品类别信息管理</h3>
           <?php
               //实现商品类别信息的增/删/改操作
               //1. 导入配置文件
              require "../public/dbconfig.php";
			require "../public/connect.php";
               //4. 根据参数a的值执行对应的增/删/改操作
               switch($_GET['a']){
                    case "insert": //执行添加
                        //获取要添加的信息
                        $pid  = $_POST['pid'];
                        $path = $_POST['path'];
                        $name = $_POST['name'];
                        //拼装SQL语句，并执行
                        $sql = "insert into category value(null,'{$name}','{$pid}','{$path}')";
                        mysql_query($sql,$link);
                        //根据自增id判断是否添加成功
                        if(mysql_insert_id($link)>0){
                            echo "添加成功！";
                        }else{
                            echo "添加失败！";
                        }
                        break;
                    case "del": //执行删除
                        break;
                    case "update": //执行修改
                        break;
               }
               //5. 关闭数据库
               mysql_close($link);
           ?>
        </center>
    </body>
</html>