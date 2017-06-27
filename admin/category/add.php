<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>会员信息管理</title>
    </head>
    <body>
        <center>
           <?php
                //处理父类别信息
                $name = "根类别";
                $pid = 0;
                $path="0,";
                //接收参数信息
                if(isset($_GET['pid']) && isset($_GET['path'])){
                    $name = $_GET['name'];
                    $pid = $_GET['pid'];
                    $path = $_GET['path'].$_GET['pid'].",";
                }
           
           ?>
           <h3>添加商品类别信息</h3>
           <table width="280" border="0">
           <form action="action.php?a=insert" method="post">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>"/>
                <input type="hidden" name="path" value="<?php echo $path; ?>"/>
                <tr>
                    <td align="right">父类别名：</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td align="right">类别名称：</td>
                    <td><input type="text" name="name"/></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加"/>
                        <input type="reset" value="重置"/>
                    </td>
                </tr>
           </form>
           </table>
        </center>
    </body>
</html>