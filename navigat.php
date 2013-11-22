<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<style type="text/css">
<!--
body{text-align:center}
-->
</style>
</head>
<body>
<p>
<?php
require_once("head.php");
session_start();
if (isset($_POST['action']) && $_POST['action'] == 'unset')
{
	unset($_POST['action']);
	file_call(2);
	file_call(0);
	free_session();
	$_SESSION[status] = 0;
}
if (!$_SESSION[status])
{
	echo "<p><a href=".$file_name[3][0]." target=".$frame_name[0][0].">".$file_name[3][1]."</a></p>";
	//<p><a href="denglu.php" target="show">登陆</a></p>
	echo "<p><a href=".$file_name[4][0]."
		target=".$frame_name[0][0].">".$file_name[4][1]."(所有群内成员用QQ<br>号码做帐号和密码登陆)</a></p>";
	//<p><a href="reg.php" target="show">注册</a></p>
}
echo "<p><a href=".$file_name[5][0]." target=".$frame_name[0][0].">".$file_name[5][1]."</a></p>";
//<p><a href="sell.php" target="show">我要出售</a></p>
echo "<p><a href=".$file_name[6][0]." target=".$frame_name[0][0].">".$file_name[6][1]."</a></p>";
//<p><a href="buy.php" target="show">我要求购</a></p>
echo "<p><a href=".$file_name[8][0]." target=".$frame_name[0][0].">".$file_name[8][1]."</a></p>";
//<p><a href="buy.php" target="show">查看个人</a></p>
if ($_SESSION[status])
{
	echo "<p><a href=".$file_name[7][0]." target=".$frame_name[0][0].">".$file_name[7][1]."</a></p>";
	//<p><a href="buy.php" target="show">我要求购</a></p>
	?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="hidden" name="action" value="unset" />
		<input type="submit" name="submit" value="退出" />
		<?php 
}
?>
</body>
</html>
