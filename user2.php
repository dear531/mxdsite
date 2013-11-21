<?
error_reporting(0);
$name=$_POST['name'];
$passowrd=$_POST['password'];
$mysql_database = $name;
$conn = mysql_connect("db4.cwsurf.de", "mxd", "aying7333");
if(!$conn)
{
	echo "<p>connect databases error:$php_errormsg</p>";
	exit;
}
echo "<p>connect databases succes</p>";

$ret = mysql_select_db("mxd"); 
if(!$ret)
{
	echo "<p>connect manage error:$php_errormsg</p>";
	exit;
}
echo "<p>connect manage succes</p>";

$sql = "select * from manage";
$ret = mysql_query($sql, $conn);
if (!$ret)
{
	echo "<p>select manage error:$php_errormsg</p>";
	exit;
}
echo "<p>select manage succes</p>";
$flag = 0;
while ($row = mysql_fetch_array($ret))
{
	if ($row[user] == $name)
	{
		if ($row[pass] == $passowrd)
		{
			echo "<script language=javascript>alert('恭喜您，登陆成功！')</script>";
			echo "<script language=javascript>window.parent.info.location.href='info2.html'</script>";
			session_start();
			$_SESSION["temp"]=array($name,$passowrd,1);
		}
		else
		{
			echo "<p>password error</p>";
		}
		$flag = 1;
		break;
	}	
}	

if ($flag == 0)
	echo "<p>user not exist</p>";
?>
