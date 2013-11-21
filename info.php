<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登陆</title>
<style type="text/css">
<!--
body{text-align:center}
-->
</style>
</head>
<body>
<?php
require_once("head.php");
session_start();
$status_flag = array("成功","失败");
$openrate[0] = "欢迎您游客";
$openrate[1] = "登陆";
$openrate[2] = "添加";
$openrate[3] = "修改";
$openrate[4] = "删除";
$openrate[5] = "查询";
$openrate[6] = "连接数据库";
if (!isset($_SESSION[status]))
	echo "<p>欢迎你游客</p>";
else if($_SESSION[status] == 0)
{
	echo "<p>欢迎您再来</p>";
//	unset($_SESSION[status]);
}
else
	echo $openrate[$_SESSION[status] % 100].$status_flag[$_SESSION[status] / 100];
if ($_SESSION[status] > 200)
	free_session();
?>
</body>
</html>
