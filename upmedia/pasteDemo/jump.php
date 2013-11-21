<?php 
	
	if(!$_GET['msg']&&$_GET['fileName']){//
		//本地跳转到图像页面
	
		//图片的远程路径src
		$url = "http://10.0.6.200/upload/images/".$_GET['fileName'];
		//以下为查看ckfinder中的源码找到的，上传成功后会跳转到图像的那一块然后显示出图片的预览效果，并且源文件一栏已经填入图片的远程url
		header('Content-Type: text/html; charset=utf-8');
		echo "<script type=\"text/javascript\">";  
		echo "window.parent.CKEDITOR.tools.callFunction(2, '" . str_replace("'", "\\'",$url) . "', '" .str_replace("'", "\\'", ''). "');";
		echo "</script>";
	}else{
		//输出报错信息
		die("<script language=\"javascript\">alert(\" ".$_GET['msg']." \");history.go(-1)</script>");
		exit;
	}
?>