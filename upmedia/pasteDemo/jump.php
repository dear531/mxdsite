<?php 
	
	if(!$_GET['msg']&&$_GET['fileName']){//
		//������ת��ͼ��ҳ��
	
		//ͼƬ��Զ��·��src
		$url = "http://10.0.6.200/upload/images/".$_GET['fileName'];
		//����Ϊ�鿴ckfinder�е�Դ���ҵ��ģ��ϴ��ɹ������ת��ͼ�����һ��Ȼ����ʾ��ͼƬ��Ԥ��Ч��������Դ�ļ�һ���Ѿ�����ͼƬ��Զ��url
		header('Content-Type: text/html; charset=utf-8');
		echo "<script type=\"text/javascript\">";  
		echo "window.parent.CKEDITOR.tools.callFunction(2, '" . str_replace("'", "\\'",$url) . "', '" .str_replace("'", "\\'", ''). "');";
		echo "</script>";
	}else{
		//���������Ϣ
		die("<script language=\"javascript\">alert(\" ".$_GET['msg']." \");history.go(-1)</script>");
		exit;
	}
?>