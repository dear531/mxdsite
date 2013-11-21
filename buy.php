<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php

require_once("head.php");
//error_reporting(0);
session_start();
//print_r($_SESSION);
if(!isset($_SESSION[status]))
{
	file_call(2);
	message('不登陆只能以游客身份查询发布信息!');
	$_SESSION[status]=0;
}


require_once("con_database.php");

global $table_text;
$fields = mysql_list_fields("mxd", info, $conn);
$columns = mysql_num_fields($fields);
for ($i = 0; $i < $columns; $i++)
$table_text[$i] = mysql_field_name($fields, $i);

if (isset($_POST['action']) && $_POST['action'] == 'buy_select')
	$begin = ($_POST['buy_select'] - 1) * $page;
else
	$begin = 0;
$sql = "select * from info limit ".$begin.",".$page;
$ret = mysql_query($sql, $conn);

if($_SESSION[status])
{
	if (!$ret)
		$_SESSION[status] = 105;
	else
		$_SESSION[status] = 5;
	file_call(2);
}

$sql_select = "SELECT `id`, `name` FROM `managel`";
$ret_select = mysql_query($sql_select, $conn);
$i = 0;
while ($row_select[$i++] = mysql_fetch_array($ret_select));
//print_r($row_select);
//echo "count".count($row_select);
echo "<table border='1' cellpadding='0' cellspacing='0'
bordercolordark=#0066ff bordercolorlight=#ffffff
bgcolor='#ffffff'
>";
for ($i = 0; $i < $columns; $i++)
{
	if ($i == 0)
		echo "<tr><th>序号</th>";
	if ($table_text[$i] == "ID"
			|| $table_text[$i] == "status")
		continue;
	if($table_text[$i] == "userid")
		echo "<th>玩家</th>";
	else
		echo "<th>".$table_text[$i]."</th>";
	if ($i == $columns - 1)
		echo "</tr>";
}
$k = $begin;
while ($row = mysql_fetch_array($ret)) 
{
	for ($i = 0; $i < $columns; $i++)
	{
		if ($i == 0)
			echo "<tr><td>".++$k."</td>";
		if( $table_text[$i] == "ID"
				|| $table_text[$i] == "status")
			continue;
		if($table_text[$i] == "userid")
		{
			for($j = 0; $j < count($row_select); $j++)
			{
				if ($row[userid] == $row_select[$j][id])
				{
					echo "<td>".$row_select[$j][name]."</td>";
					break;
				}
			}
		}
		else
			if ($row[$table_text[$i]] == NULL)
				echo "<td>-</td>";
			else
				echo "<td>".$row[$table_text[$i]]."</td>";
		if ($i == $columns - 1)
			echo "</tr>";
	}  
}
echo "</table>";
echo "<br>";
$row_page = "SELECT COUNT( * ) FROM info";
$ret_page = mysql_query($row_page, $conn);
if (!$ret_page)
{
	echo "<p>".$ret_page." error:".$php_errormsg."</p>";
	file_call(2);
}
$page_num = mysql_fetch_array($ret_page);
echo "<table><tr>";
for ($n = 1; $n < ceil($page_num[0] / $page) + 1; $n++)
{
?>
<td width="20">
<form name=<?php echo "buy_select".$n; ?> id=<?php echo "buy_select".$n; ?> action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="buy_select" value="<?php echo $n; ?>" />
<input type="hidden" name="action" value="buy_select" />
<a href="#" onclick="document.getElementById('<?php echo "buy_select".$n; ?>').submit();"><?php echo " ".$n." "; ?></a>
</form>
</td>
<?php
}
echo "</tr></table>";
mysql_close($conn);
?>
</body>
</html>
