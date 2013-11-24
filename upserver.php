<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>上传图片</title>
<style type="text/css">
<!--
body{text-align:center}
-->
</style>
</head>
<body>
<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
//echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//echo "Type: " . $_FILES["file"]["type"] . "<br />";
//echo "Size: " . (int)($_FILES["file"]["size"] / 1024) . " Kb<br />";
//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
$uptypes = array( 
		'image/jpg', 
		'image/jpeg', 
		'image/png', 
		'image/pjpeg', 
		'image/gif', 
		'image/bmp', 
		'image/x-png' 
		);
$type_flag = 0;
for ($i = 0; $uptypes[$i]; $i++)
{
	if ($_FILES["file"]["type"] == $uptypes[$i])
	{
		$type_flag = 1;
		break;
	}
}
if ($type_flag)
{
	echo "图片是：".$_FILES["file"]["type"]."格式有效<br/>";
}
else
{
	echo "无效的文件格式<br/>";
	exit;
}
if ($_FILES["file"]["size"] < 2 * 1024 * 1024)
{
	$size_flag = 1;
	echo "文件大小：".(int)($_FILES["file"]["size"] / 1024)."Kb有效<br/>";
}
else
{
	$size_flag = 0;
	echo "文件大小超出限制<br />";
	exit;
}
if ($_FILES["file"]["error"] > 0)
{
	echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else
{
	$dir="$_SESSION[user]/"; 
	if ($dir == "/")
	{
		echo "用户路径不能为空！<br/>";
		exit;
	}
	else if(@!opendir("$dir"))
	{
			echo "第一次上传图片<br/>";
		if (!mkdir($dir))
		{
			echo "初始化空间失败,请联系管理员<br/>";
			exit;
		}
		else
		{
			$dir_flag=1;
			echo "初始化空间成功<br/>";
		}
	}
	if (file_exists($dir.$_FILES["file"]["name"]))
	{
		echo $_FILES["file"]["name"]."同名文件已经存在. <br/>";
	}
	else
	{	//此处需要重命名图片文件名字，对应表格查询
		if (move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$_FILES["file"]["name"]))
			echo $_FILES["file"]["name"]."上传成功<br/>";
		else
			echo "上传失败，请联系管理员<br/>";
	}
}
?>
</body>
</html>
