<?php
$database = "mxd";
$table_info = "info";
$fields = mysql_list_fields($database, $table_info, $conn);
$columns = mysql_num_fields($fields);
for ($i = 0; $i < $columns; $i++)
{
	$table_info_text[$i] = mysql_field_name($fields, $i);
}
$sql = "select * from ".$table_info." where userid = '".$_SESSION[userid]."'";
$ret = mysql_query($sql, $conn);
if (!$ret)
{
	echo "<p>".$sql." error:".$php_errormsg."</p>";
	return -1;
}
?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<?php
echo "<table border='1' cellpadding='0' cellspacing='0'>";
for ($i = 0; $i < $columns; $i++)
{
	if($table_info_text[$i] == "userid"
			|| $table_info_text[$i] == "ID"
			|| $table_info_text[$i] == "status")
	{
		if ($i == 0)
			echo "<tr><th>选择物品</th>";
		if ($i == $columns - 1)
			echo "</tr>";
	}
	else
	{
		if ($i == 0)
			echo "<tr><th>选择物品</th>";
		echo "<th>".$table_info_text[$i]."</th>";
		if ($i == $columns - 1)
			echo "</tr>";
	}
}
while ($row = mysql_fetch_array($ret)) 
{
	for ($i = 0; $i < $columns; $i++)
	{
		if($table_info_text[$i] == "userid"
				|| $table_info_text[$i] == "ID"
				|| $table_info_text[$i] == "status")
		{
			if ($i == 0)
			echo "<tr><td><input type=\"checkbox\" name=\"personal[]\"
				value=".$row[ID]." /></td>";
			if ($i == $columns - 1)
				echo "</tr>";
		}
		else
		{
			if ($i == 0)
			echo "<tr><td><input type=\"checkbox\" name=\"personal[]\"
				value=".$row[ID]." /></td>";
			if ($row[$table_info_text[$i]] == NULL)
				echo "<td>-</td>";
			else
				echo "<td>".$row[$table_info_text[$i]]."</td>";
			if ($i == $columns - 1)
				echo "</tr>";
		}
	}  
}
?>
</table>
<input type="hidden" name="action" value="set" />
<input type="submit" name="rm" value=" 删除物品" />
<input type="submit" name="update" value=" 修改物品" />
<label for="file">选择图片路径:</label> 
<input type="file" name="file" id="file"/> 
<input type="submit" name="file" value="上传" /> 
</form> 
