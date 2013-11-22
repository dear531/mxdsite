<html>
	<?php
$frame_name[0] = array("show", 		"展示窗口");
$frame_name[1] = array("navigat", 	"控制面板");
$frame_name[2] = array("info",		"用户状态");

$file_name[0] = array("welcome.html",	"欢迎");
$file_name[1] = array("navigat.php",	"控制面板");
$file_name[2] = array("info.php",	"个人信息");
$file_name[3] = array("login.php",	"登陆");
$file_name[4] = array("reg.php", 	"注册");
$file_name[5] = array("sell.php",	"我要出售");
$file_name[6] = array("buy.php",	"我要求购");
$file_name[7] = array("password.php",	"修改密码");
$file_name[8] = array("member.php",	"查看个人");

$session_info[0] = array("status",	"用户状态");
$session_info[1] = array("userid",	"用户ID");
$session_info[2] = array("user",	"用户名");
$session_info[3] = array("pass",	"密码");
$session_info[4] = array("name",	"人物名");
$session_info[5] = array("conn",	"链接数据库");
$page = 20;
function file_name_global($info)
{
	for($i = 0; $i < count($info); $i++)
	{
		echo $i;	
		print_r($info[$i]);
		echo "<br>";
	}
}


function init_session($status, $userid, $user, $pass,
		$name, $conn)
{
	global $session_info;
	$_SESSION[$session_info[0][0]] = $status;
	$_SESSION[$session_info[1][0]] = $userid;
	$_SESSION[$session_info[2][0]] = $user;
	$_SESSION[$session_info[3][0]] = $pass;
	$_SESSION[$session_info[4][0]] = $name;
	$_SESSION[$session_info[5][0]] = $conn;
}
function free_session()
{
	global $session_info;
	for($i = 0; $i < count($session_info); $i++)
		unset($_SESSION[$session_info[$i][0]]);
}

function file_call($file_num)
{
	global $file_name;
	global $frame_name;
	if($file_num > 2)
		$frame_num = 0;
	else
		$frame_num = $file_num;
	echo "<script language=javascript>window.parent.".$frame_name[$frame_num][0].".location.href='".$file_name[$file_num][0]."'</script>";
}

function message($mess)
{
	echo "<script language=javascript>alert('".$mess."')</script>";
}

function set_mysql_utf8()
{
	mysql_query("set names 'utf8' ");
	mysql_query("set character_set_client=utf8");
	mysql_query("set character_set_results=utf8");
}
function select_tebles($database, $table, $conn,
		$exclude)
{
	$fields = mysql_list_fields($database, $table, $conn);
	$columns = mysql_num_fields($fields);
	for ($i = 0; $i < $columns; $i++)
	{
		$table_text[$i] = mysql_field_name($fields, $i);
	}
	$sql = "select * from ".$table." where
		userid = ".$_SESSION[userid];
	$ret = mysql_query($sql, $conn);
	if (!$ret)
	{
		echo "<p>".$sql." error:".$php_errormsg."</p>";
		return -1;
	}
	echo "<table border='1' cellpadding='0' cellspacing='0'>";
	for ($i = 0; $i < $columns; $i++)
	{
		if($table_text[$i] == "userid"
		|| $table_text[$i] == "ID"
		|| $table_text[$i] == "status")
			continue;
		if ($i == 0)
			echo "<tr>";
		echo "<th>".$table_text[$i]."</th>";
		if ($i == $columns - 1)
			echo "</tr>";
	}
	while ($row = mysql_fetch_array($ret)) 
	{
		for ($i = 0; $i < $columns; $i++)
		{
			if($table_text[$i] == "userid"
			|| $table_text[$i] == "ID"
			|| $table_text[$i] == "status")
				continue;
			if ($i == 0)
				echo "<tr>";
			if ($row[$table_text[$i]] == NULL)
				echo "<td>-</td>";
			else
				echo "<td>".$row[$table_text[$i]]."</td>";
			if ($i == $columns - 1)
				echo "</tr>";
		}  
	}
	echo "</table>";
	return 0;
}
function print_tebles($th, $tr)
{
	echo "<table border='1' cellpadding='0' cellspacing='0' >";
	$th_len = count($th);
	for ($i = 0; $i < $th_len; $i++)
	{
		if ($i == 0)
			echo "<tr><th>序号</th>";
		echo "<th>".$th[$i]."</th>";
		if ($i == $th_len - 1)
			echo "</tr>";

	}
	$tr_len1 = count($tr);
	$tr_len2 = count($tr[0]);
	for ($i = 0; $i < $tr_len1; $i++)
	{
		for($j = 0; $j < $tr_len2; $j++)
		{
			if ($tr_len2 == 1)
			{
				if ($i == 0)
				{
					echo "<tr><th>";
					echo $i+1;
					echo "</th>";
				}
				echo "<th>".$tr[$i]."</th>";
				if ($i == $tr_len1 - 1)
					echo "</tr>";
			}
			else
			{
				if ($j == 0)
				{
					echo "<tr><th>";
					echo $i+1;
					echo "</th>";
				}
				echo "<th>".$tr[$i][$j]."</th>";
				if ($j == $tr_len2 - 1)
					echo "</tr>";
			}
		}
	}
	echo "</table>";
}
?>

</html>
