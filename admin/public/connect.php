<?php
	$link=@mysql_connect(HOST,USER,PWD) or die('数据库连接失败');
	mysql_select_db(DBNAME);
	mysql_set_charset('utf8');

?>