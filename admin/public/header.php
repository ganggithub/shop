<?php session_start(); //开启session会话 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>商城后台管理</title>
    </head>
    <body style="background-color:#ddd;">
        <h2>**商城后台管理</h2>
            你好！<?php echo $_SESSION['adminuser']['username'];  ?> <a href="../doaction.php?operate=outlogin" target="_top">退出</a>
    </body>
</html>