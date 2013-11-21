<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
require_once("head.php");
//error_reporting(0);
session_start();
//print_r($_SESSION);
if(!$_SESSION[status])
{
	message("请登陆再操作，不登陆只能以游客身份查询发布信息!");
	file_call(2);
	file_call(3);
	exit;
}
echo "<strong>用户添加</strong>";

require_once("con_database.php");
//select_tebles("mxd", "info", $conn, "userid");
$fields = mysql_list_fields("mxd", "info", $conn);
$columns = mysql_num_fields($fields);
for ($i = 0; $i < $columns; $i++)
$table_text[$i] = mysql_field_name($fields, $i);
require_once("insert_personal.php");
require_once("delete_personal.php");
require_once("select_personal.php");
if ($insert_flag == 1)
{
	//print_tebles($table_text, $tmp_tr);
	echo "插入成功<br><br>";
	$insert_flag = 0;
}
//print_r($_POST);
echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";
echo "<table>";
for ($i = 0; $i < $columns; $i++)
{
	if($table_text[$i] == "userid"
			|| $table_text[$i] == "ID"
			|| $table_text[$i] == "status")
		continue;
	echo "<tr><td>".$table_text[$i].":</td>
		<td><input type=\"text\" name=\"personal[".$table_text[$i]."]\"></td></tr>";
}  
echo "</table>";
echo "<input type=\"hidden\" name=\"action\" value=\"submitted\" />";
echo "<input type=\"submit\" name=\"submit\" value=\"增加物品\" />";
echo "</form>";
//print_r($table_text);
mysql_close($conn);
?>
</body>
</html>
