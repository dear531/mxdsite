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
if ($_SESSION[status])
{
	file_call(2);
	echo "您已经登陆<br>";
}
else
{
	free_session();
	if (isset($_POST['action']) && $_POST['action'] == 'submitted') {
		//print_r($_POST);
		require_once("con_database.php");

		$name=$_POST[personal]['user'];
		$passowrd=$_POST[personal]['password'];
		$user_table = "managel";

		$sql = "select * from ".$user_table;
		$ret = mysql_query($sql, $conn);
		if (!$ret)
		{
			echo "<p>服务器错误，连接失败</p>";
			exit;
		}
		
		$flag = 0;
		while ($row = mysql_fetch_array($ret))
		{
			if ($row[user] == $name)
			{
				if ($row[pass] == $passowrd)
				{
			//		$_SESSION["temp"]=array($row[user],$row[pass],$row[name],$row[id],1);
					init_session(1,$row[id], $row[user], $row[pass], $row[name], $conn);
					$sql_update = "UPDATE `managel` SET `lognum`= `lognum`+1 WHERE id = ".$row[id];
					$ret_update = mysql_query($sql_update, $conn);
					if (!$ret_update)
						echo "增加登陆次数失败，不过不影响您其他操作<br>";
					$sql_lognum = "SELECT lognum FROM  `managel` WHERE id = ".$row[id];
					$ret_lognum = mysql_query($sql_lognum, $conn);
					if (!$ret_lognum)
						echo "查询登陆次数失败，不过不影响您其他操作<br>";
					$row_lognum = mysql_fetch_array($ret_lognum);
					file_call(1);
					message("登陆成功！这是您第".$row_lognum[lognum]."次登陆");
					file_call(2);
					
					print_r($_SESSION);
					mysql_close($conn);
				}
				else
				{
					free_session();
					echo "<p>密码错误</p>";
					echo '<a href="'. $_SERVER['PHP_SELF'] .'">返回重填</a>';
				}
				$flag = 1;
				break;
			}	
		}	
		if ($flag == 0)
		{
			free_session();
			echo "<p>用户名不存在</p>";
			echo '<a href="'. $_SERVER['PHP_SELF'] .'">返回重填</a>';
		}
	}
	else
	{
		?>
			<form align="middle" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<center>
			<table>
			<tr>
			<td>用户名:<input type="user" name="personal[user]"></td>
			<td>用户名和密码都是QQ号码</td>
			</tr>
			<tr>
			<td>密&nbsp;&nbsp;&nbsp;&nbsp;码:<input type="password" name="personal[password]"></td>
			<td>别再用QQ密码当密码了</td>
			</tr>
			</table>
			</center>
			<input type="hidden" name="action" value="submitted" />
			<input type="submit" name="submit" value="登陆" />
			</form>
			<?php
	}
}
?>
</body>
</html>
