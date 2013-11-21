<?php
if (isset($_POST['action']) && $_POST['action'] == 'set')
{
	//print_r($_POST);
	//$tmp_count = count($_POST[personal]);
	//echo "count".$tmp_count;
	//print_r($_POST[personal]);
	if (isset($_POST[rm]))
	{
		echo "<br>";
		for ($i = 0; $i < count($_POST[personal]); $i++)
		{
			$delete = "DELETE FROM `info` WHERE
				ID=".$_POST[personal][$i];
			$ret = mysql_query($delete, $conn);
			if (!$ret)
			{
				$_SESSION[status] = 104;
				echo "删除失败<br>";
			}
			else
			{
				$_SESSION[status] = 4;
				echo "删除成功<br>";
			}
		}
	}

}
?>
