<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>

<body>
<?php
$conn = mysql_connect("localhost", "root", "aying");
echo $conn;
mysql_select_db("conn_php", $conn);
$sql = "select * from manage";
$ret = mysql_query($sql, $conn);
//$sql = "insert into manage values(4,'aying','7333')";
//$ret = mysql_query($sql, $conn);
echo "<table border='1' cellpadding='0' cellspacing='0'
bordercolordark=#0066ff bordercolorlight=#ffffff
bgcolor='#ffffff'
>";
while ($row = mysql_fetch_array($ret)) 
//	print_r($row);
	//print_r(mysql_fetch_array($ret));
//{ echo "<p id="id">" , ($row['id']) , "</p>
//	<p id="name">&ndash;" , nl2br($row['name']) ,"</p>"; } 
{echo  "<tr><td id='id'>$row[id]</td>
	<td id='user'>$row[user]</td></tr>";}
echo "</table>";
echo  "<p>111</p>";
if($ret)
	echo 'ok';
else
	echo 'error';
echo $ret;
mysql_close($conn);
?>
</body>
</html>
