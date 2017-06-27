<?php
	$link=@mysql_connect(HOST,USER,PWD) or die('连接数据库失败'.mysql_error());
	mysql_select_db(DBNAME);
	mysql_set_charset('utf8');

?>