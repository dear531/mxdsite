<?php
$conn = mysql_connect("localhost", "root", "aying");
if(!$conn)
{
	echo "<p>服务器错误，连接失败</p>";
	exit;
}
set_mysql_utf8();

$ret = mysql_select_db("mxd"); 
if(!$ret)
{
	echo "<p>服务器错误，连接失败</p>";
	exit;
}
?>
