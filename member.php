<html>
<head>
<?php require_once("image_css.inc") ?>
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

if (isset($_GET['pages']) && $_GET['pages'])
{
	$begin = ($_GET['pages'] - 1) * $page;
}
else
{
	$begin = 0;
}
if (isset($_GET['member']) && $_GET['member'])
{
	$m="'".$_GET['member']."'";
	$member_flag=1;
}
if (isset($_GET['saerch']) && $_GET['saerch'])
{
	$search_sql = "select * from info where ".$_GET['saerch']." like '%".$_GET['content']."%'";
	//SELECT * FROM `info` WHERE 物品名称 like '%死灵%'
	$search_flag=1;
}
else
{
	$search_flag=0;
}
$sqltmp = "select distinct userid from info";
$rettmp = mysql_query($sqltmp, $conn);
$i=0;
while ($idtmp[$i++] = mysql_fetch_array($rettmp));
$total=$i;
for ($i=0; $i < $total; $i++)
{
	if ($idtmp)
		$anser_ids[$i]="'".$idtmp[$i]['userid']."'";
}

if (!isset($m))
{
	$m=implode(',',$anser_ids);
	$member_falg=0;
}
$sql = "select * from info where userid in(".$m.") limit ".$begin.",".$page;
if ($search_flag == 1)
	$sql = $search_sql;
$ret = mysql_query($sql, $conn);

if($_SESSION[status])
{
	if (!$ret)
		$_SESSION[status] = 105;
	else
		$_SESSION[status] = 5;
	file_call(2);
}
$sql_user_name = "select user,name from managel where user in(".implode(',',$anser_ids).")";
$ret_user_name = mysql_query($sql_user_name, $conn);
$i=0;
while ($user_name[$i++] = mysql_fetch_array($ret_user_name));

echo "<table><tr>";
for ($n = 0; $n <= $total; $n++)
{
	if ($n % 10 == 0 && $n > 0)
		echo "</tr><tr>";
	$mtmp=$user_name[$n]['user'];
?>
<td width="100">
<form name=<?php echo "member".$mtmp; ?> id=<?php echo "member".$mtmp; ?> member="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
<input type="hidden" name="member" value="<?php echo $mtmp; ?>" />
<a href="#" onclick="document.getElementById('<?php echo "member".$mtmp; ?>').submit();"><?php echo " ".$user_name[$n]['name']." "; ?></a>
</form>
</td>
<?php
}
echo "</tr></table>";
?>
<form name="saerch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
<select name="saerch">
<?php
for ($i=0; $table_text[$i];$i++)
{

	if ($table_text[$i] != "ID"
		&& $table_text[$i] != "userid"
		&& $table_text[$i] != "status")
	 echo "<option>".$table_text[$i]."</option>";
}
?>
<input type="text" value="" name="content" />
</select>
<input type="submit" value="提交" name="submit" />
</form>
<?php
$sql_select = "SELECT `id`, `name` FROM `managel` WHERE id IN(".$m.")";
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
	$n=-1;
	$dir="$row[userid]/"; 
	for ($i = 0; $imgtypes[$i]; $i++)
	{
		if (file_exists("image/".$dir.$row['ID'].".".$imgtypes[$i]))
		{
			$n=$i;
			break;
		}
	}
	for ($i = 0; $i < $columns; $i++)
	{
		if ($i == 0)
			echo "<tr><td>".++$k."</td>";
		if( $table_text[$i] == "ID"
				|| $table_text[$i] == "status")
			goto show_exit;
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
		{
			if ($row[$table_text[$i]] == NULL)
			{
				$tmp="-";
			}
			else
			{
				if ($table_text[$i] == "物品名称" && $n != -1)
				$tmp="<a class='thumbnail' href=''>".$row[$table_text[$i]]."<span><img
					src='image/".$dir.$row['ID'].".".$imgtypes[$n]."'></span>";
				else
					$tmp=$row[$table_text[$i]];
			}
				echo "<td>$tmp</td>";
	
		}
show_exit:
		if ($i == $columns - 1)
			echo "</tr>";
	}
}
echo "</table>";
echo "<br>";

$row_page = "SELECT COUNT( * ) FROM info where userid in(".$m.")";
if ($search_flag == 1)
	$row_page = "select COUNT( * ) from info where ".$_GET['saerch']." like '%".$_GET['content']."%'";
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
<form name=<?php echo "pages".$n; ?> id=<?php echo "pages".$n; ?> pages="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
<input type="hidden" name="pages" value="<?php echo $n; ?>" />
<?php if ($member_flag == 1) {?>
<input type="hidden" name="member" value="<?php echo $_GET['member']; ?>" />
<?php } ?>
<a href="#" onclick="document.getElementById('<?php echo "pages".$n; ?>').submit();"><?php echo " ".$n." "; ?></a>
</form>
</td>
<?php
}
echo "</tr></table>";
mysql_close($conn);
?>
</body>
</html>
