<?php
//print_r($_FILES);
//print_r($_GET);
//print_r($_POST);
//die();
$url='http://10.0.6.200/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

//?command=QuickUpload&type=Images
//keyֵ
//$aucode=abcdefghijklmnopqrstuvwxyz;

$filename=$_FILES['upload']['name'];
//echo $filename;
//die();
$filepath = 'D:/zengq/DedeAMPZ/WebRoot/Default/temp/'.$filename;//������ͼƬ�ľ���·��

//$filepath = 'D:/'.$filename;

$update_filepath='@'.$_FILES['upload']['tmp_name'];//������@+����·�����������·���±����ж�ӦͼƬ
echo $_FILES['upload']['tmp_name'];
echo '$filepath:'.$filepath;
die();
//echo $filename;
//echo $filepath;

//ͼƬ�ϴ�������
//print_r($_FILES);
//$file=base64_encode(file_get_contents($_FILES['file']['tmp_name']));
//echo $file;exit;
//move_uploaded_file($_FILES['upload']['tmp_name'],$filepath);//������Բ�Ҫ�ģ�������ֻ��Ϊ�˱��ؾ���·������Ƭ�����ϴ���������

$postdate=array('aucode' =>$aucode,'file'=>$update_filepath);//��֯�ϴ�������

//����:ͼƬ��ͼƬ������

$result = postMessage2($url,$postdate);//curl��post��ʽ����ͼƬ���������ص���json����
echo $result;

function postMessage($url,$postdate){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_POST, true);//POST��ʽ

		curl_setopt($ch, CURLOPT_URL, $url );//������Ҫ�ύ��url��ַ

		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdate);//POST����

		ob_start();

		curl_exec($ch);

		$result = ob_get_contents();

		ob_end_clean();

		return $result;
	}
function postMessage2($url,$postdate){

    $curl = curl_init();

    curl_setopt($curl,CURLOPT_URL,$url);

    curl_setopt($curl,CURLOPT_POST,true);

    curl_setopt($curl,CURLOPT_POSTFIELDS,$postdate);

    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

    $result=curl_exec($curl);

    //curl_exec($curl); ����һ�д���Ҳ����д������������

    //$result=curl_multi_getcontent($curl);

    return $result;

}
exit;
?>