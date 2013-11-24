<?php
if (isset($_POST['action']) && $_POST['action'] == 'submitted')
{
	echo '<pre>';
	$insert = "INSERT INTO info ";
	$insert_flag = 0;
	for ($i = 0; $i < $columns; $i++)
	{
		unset($tmp);
		if ($table_text[$i] == "status")
			continue;
		if($i == 0)
			$tmp = "(";
		$tmp = $tmp.$table_text[$i];
		if ($i == $columns - 1)
			$tmp = $tmp.")";
		else
			$tmp = $tmp.",";
		$insert = $insert.$tmp;
	}
	$insert = $insert." VALUES ";
	for ($i = 0; $i < $columns; $i++)
	{
		unset($tmp);
		if ($table_text[$i] == "status")
		{
			$tmp_tr[$i] = 1;
			continue;
		}
		if($i == 0)
			$tmp = "(";
		if($table_text[$i] == "userid")
		{
			$tmp = $tmp."'".$_SESSION[userid]."'";
			$tmp_tr[$i] = $_SESSION[userid];
		}
		else if($table_text[$i] == "ID")
		{
			$sql = "select max(ID)
				from info";
			$result=mysql_query($sql,$conn);
			$max=mysql_fetch_row($result);
			$max[0]++;
			$tmp = $tmp.$max[0];
			$tmp_tr[$i] = $max[0];
		}
		else
		{
			if ($_POST[personal][$table_text[$i]] == NULL)
				$tmp = $tmp."\"-\"";
			else
				$tmp = $tmp."\"".$_POST[personal][$table_text[$i]]."\"";
			$tmp_tr[$i] = $_POST[personal][$table_text[$i]];
		}
		if ($i == $columns - 1)
			$tmp = $tmp.") ";
		else
			$tmp = $tmp.",";
		$insert = $insert.$tmp;
	}  
	$ret = mysql_query($insert, $conn);
	if (!$ret)
		$_SESSION[status] = 105;
	else
	{
		$_SESSION[status] = 5;
		$insert_flag = 1;
	}
	file_call(2);
	echo '</pre>';
}
?>
