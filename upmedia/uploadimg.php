<?php
	
ob_start();	 

if($_FILES){//�ϴ�ͼƬ�ļ�
	$uploadfile = $_FILES; 
	$returnURL = $_GET['returnURL'];

	$filepath='D:\zengq\DedeAMPZ\WebRoot\Default\upload\images/';//�������ϱ���ͼƬ��·��
	$filename=mySetFileName().strstr($uploadfile['upload']['name'],".");//������ɵ����ּ����ϴ�ͼƬ�ĸ�ʽ��׺

	if (false === move_uploaded_file($uploadfile['upload']['tmp_name'], $filepath.$filename)) {
		die("�ϴ��ļ�ʧ��");
	}
	ob_end_clean();
	header('Location:'.$returnURL.'?fileName='.$filename);//��ת����������returnURL����,�����ݲ����ļ�����
	exit();
}else{//��ͼ�ϴ�ͼƬ
	
	$imgsrc=array();
	foreach ($_POST['base64File'] as $key => $val ) {
		$imgsrc[$key]=getPic(base64_decode($val));
	}
	ob_end_clean();
	exit(json_encode($imgsrc));//����ͼƬԶ��·������
}

//��ͼƬд��������ļ��У������ص�ַ
function getPic($pic64)
{
   $filename ="upload/images/".mySetFileName().'.png';
   if($pic64){
      fopen($filename,'w+');
   }
// ��������Ҫȷ���ļ����ڲ��ҿ�д��
if (is_writable($filename)) {

    if (!$handle = fopen($filename, 'a')) {
         print "���ܴ��ļ� $filename";
         exit;
    }
    //��ͼƬд�뵽���Ǵ򿪵��ļ��С�
    if (!fwrite($handle, $pic64)) {
        print "����д�뵽�ļ� $filename";
        exit;
    }
    print "�ɹ��ؽ� ͼƬ д�뵽�ļ�";
    fclose($handle);
	$imgurl = "http://10.0.6.200/".$filename;
	return $imgurl;
	} else {
	 return false;
	} 
}
//����ͼƬ����
function mySetFileName() {
		$gettime = explode(' ', microtime());
		$string = 'abcdefghijklmnopgrstuvwxyz0123456789';
		$rand = '';

		for ($x = 0; $x < 3; $x++) {
			$rand .= substr($string, mt_rand(0, strlen($string) - 1), 1);
		}
		return date("ymdHis") . substr($gettime[0], 2, 6) . $rand;
	}