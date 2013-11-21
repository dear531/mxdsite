<html>
<head>
<title>用户注册</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<strong>用户注册</strong>
<form action="reg.php" method="post">
用户名称：<input type="text" name="user"><br>
您的密码：<input type="password" name="pass"><br>
确定密码：<input type="password" name="pass2"><br>
<input type="submit" name="submit" value="注册">
</form>
</body>
</html>
<?php 
include ('manage.frm');    //这里是您配置的数据库
if($_POST[submit]){
//判断用户名不低于字数
$struser=strlen($_POST[user]);
if($struser <= 4){
	echo "<script language=javascript>alert('注册请输入5位数以上');history.go(-1);</script>";
	exit;
}
//判断用户是否存在
$users=$_POST[user];
$result=mysql_query("select * from manage where user='$users'");
$row=mysql_fetch_array($result);
	if($_POST[user]==$row[user]){
		echo "<script language=javascript>alert('啊！这个名字有人注册啦！');history.go(-1);</script>";
		exit;
	}
//判断用户密码两次输入正确
	if($_POST[pass]!=$_POST[pass2]){
		echo "<script language=javascript>alert('亲，别耍我啦，两次密码怎么能输入不一样呢？');history.go(-1);</script>";
		exit;
	}
$_POST[pass]=md5($_POST[pass]);
$sql=mysql_query("insert into manage(id,user,pass)
VALUES('','$_POST[user]','$_POST[pass]')
");
if($sql){
	echo "<script language=javascript>alert('亲,注册成功！');history.go(-1);</script>";
}
else {
	echo "<script language=javascript>alert('对不起，亲！注册失败咯！');history.go(-1);</script>";
}
exit;
}
mysql_close($con)
?>
