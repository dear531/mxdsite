<?php
//print_r($_FILES);
//print_r($_GET);
//print_r($_POST);
//die();
$url='http://10.0.6.200/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';

//?command=QuickUpload&type=Images
//key值
//$aucode=abcdefghijklmnopqrstuvwxyz;

$filename=$_FILES['upload']['name'];
//echo $filename;
//die();
$filepath = 'D:/zengq/DedeAMPZ/WebRoot/Default/temp/'.$filename;//换成你图片的绝对路径

//$filepath = 'D:/'.$filename;

$update_filepath='@'.$_FILES['upload']['tmp_name'];//必须是@+绝对路径，这个绝对路径下必须有对应图片
echo $_FILES['upload']['tmp_name'];
echo '$filepath:'.$filepath;
die();
//echo $filename;
//echo $filepath;

//图片上传到本地
//print_r($_FILES);
//$file=base64_encode(file_get_contents($_FILES['file']['tmp_name']));
//echo $file;exit;
//move_uploaded_file($_FILES['upload']['tmp_name'],$filepath);//这个可以不要的，我这里只是为了本地绝对路径有照片可以上传到服务器

$postdate=array('aucode' =>$aucode,'file'=>$update_filepath);//组织上传的数据

//发送:图片到图片服务器

$result = postMessage2($url,$postdate);//curl以post方式发送图片，本例返回的是json数据
echo $result;

function postMessage($url,$postdate){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_POST, true);//POST方式

		curl_setopt($ch, CURLOPT_URL, $url );//设置需要提交的url地址

		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdate);//POST数据

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

    //curl_exec($curl); 上面一行代码也可以写成下面这两行

    //$result=curl_multi_getcontent($curl);

    return $result;

}
exit;
?>