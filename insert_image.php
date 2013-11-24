<?php
session_start();
if (isset($_POST['action']) && $_POST['action'] == 'set')
{
	//print_r($_POST);
	//$tmp_count = count($_POST[personal]);
	//echo "count".$tmp_count;
	//print_r($_POST[personal]);
	if (isset($_POST["file"]))
	{
		$total=count($_POST[personal]);
		if ($total == 0)
		{
			echo "请选择加图片的项目<br/><br/>";
			goto image_exit;
		}
		else if ($total > 1)
		{
			echo "只能选择唯一的项目添加图片<br/><br/>";
			goto image_exit;
		}
	}
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
		goto image_exit;
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
		goto image_exit;
	}
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		goto image_exit;
	}
	else
	{
		$dir="$_SESSION[user]/"; 
		if ($dir == "/")
		{
			echo "用户路径不能为空！<br/>";
			goto image_exit;
		}
		else if(@!opendir("$dir"))
		{
			echo "第一次上传图片<br/>";
			if (!mkdir($dir))
			{
				echo "初始化空间失败,请联系管理员<br/>";
				goto image_exit;
			}
			else
			{
				$dir_flag=1;
				echo "初始化空间成功<br/>";
			}
		}
		$file_name=explode(".",$_FILES["file"]["name"]);
		$file_flag=0;
		for ($i = 0; $imgtypes[$i]; $i++)
		{
			if (file_exists($dir.$_POST[personal][0].".".$imgtypes[$i]))
				$file_flag=1;
		}
		if ($file_flag)
		{
			echo $_FILES["file"]["name"]."同名文件已经存在. <br/>";
		}
		else
			if (move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$_POST[personal][0].".".$file_name[1]))
				echo $_FILES["file"]["name"]."上传成功<br/>";
			else
				echo "上传失败，请联系管理员<br/>";
	}
}
image_exit:
?>
