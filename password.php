<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<script type="text/javascript">
var pwd1=document.getElementById("p1").value;
var pwd2=document.getElementById("p2").value;

function PassNull(pass,inpwderror,inpwdsucess){
		if(pass.length == 0)
		{
			document.getElementById(inpwderror).style.display = "inline";
			document.getElementById(inpwdsucess).style.display = "none";
			return false;
		}
		else
		{
			document.getElementById(inpwderror).style.display = "none";
			document.getElementById(inpwdsucess).style.display = "inline";
			return true;
		}
}
function cmpPass(){
	if(pwd2.length > 0 && pwd1.length > 0)
	{
		if(pwd1!=pwd2)
		{
			document.getElementById("errorpwd").style.display = "inline";
			document.getElementById("succespwd").style.display = "none";
			document.getElementById("setpswd").disabled = true;
			return false;
		}
		else
		{
			document.getElementById("errorpwd").style.display = "none";
			document.getElementById("succespwd").style.display = "inline";
			document.getElementById("setpswd").disabled = false;
			return true;
		}
	}
	else
	{
		document.getElementById("errorpwd").style.display = "none";
		document.getElementById("succespwd").style.display = "none";
	}
}
function checkPass1(){
	pwd1=document.getElementById("p1").value;
	PassNull(pwd1,"inpwd1error","inpwd1sucess");
	cmpPass();
}

function checkPass2(){
	pwd2=document.getElementById("p2").value;
	PassNull(pwd2,"inpwd2error","inpwd2sucess");
	cmpPass();
}
</script>
</head>
<body>
<?php
session_start();
require_once("head.php");
if(!$_SESSION[status])
{
	message("请登陆后修改密码!");
	file_call(2);
	file_call(3);
	exit;
}
if (isset($_POST['action']) && $_POST['action'] == 'setpswd') {
	require_once("con_database.php");
	$update_pswd = "UPDATE `managel` SET `pass`='".$_POST[password]."' WHERE `id`= ".$_SESSION[userid];
	$ret_update_pswd = mysql_query($update_pswd, $conn);
	if (!$ret_update_pswd)
	{
		$_SESSION[status] = 103;
		echo "修改密码失败<br>";
	}
	else
	{
		$_SESSION[status] = 3;
		echo "修改密码成功<br>";
	}
	mysql_close($conn);
}
	?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<p>输入结束后请点击下网页空白处，使输入框失去焦点<br>让脚本开始检验密码，并启动提交按钮</p>
<table>
<tr><td>
密码：</td><td><input type="password" name="password" maxlength="10" size="20" id="p1" onblur="return checkPass1();"></td>
<td>
<span id="inpwd1sucess" style="display:none">格式正确</span>
<span id="inpwd1error" style="display:none">不能为空</span>
</td></tr>
<tr><td>
重复密码：</td><td><input type="password" maxlength="10" size="20" id="p2" onblur="return checkPass2();"></td>
<td>
<span id="inpwd2sucess" style="display:none">格式正确</span>
<span id="inpwd2error" style="display:none">不能为空</span>
</td></tr>
<tr><td colspan="3">&nbsp;
<span id="errorpwd" style="display:none">两次输入密码不一致</span>
<span id="succespwd" style="display:none">两次输入密码相同</span>
</td></tr>
<tr><td colspan="3">
<input type="hidden" name="action" value="setpswd" />
<input type="submit" id="setpswd" name="submit" disabled="enabled" value="修改密码" />
</td></tr>
</table>
<form>

</body>
</html>
