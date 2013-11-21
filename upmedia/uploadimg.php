<?php
	
ob_start();	 

if($_FILES){//上传图片文件
	$uploadfile = $_FILES; 
	$returnURL = $_GET['returnURL'];

	$filepath='D:\zengq\DedeAMPZ\WebRoot\Default\upload\images/';//服务器上保存图片的路径
	$filename=mySetFileName().strstr($uploadfile['upload']['name'],".");//随机生成的名字加上上传图片的格式后缀

	if (false === move_uploaded_file($uploadfile['upload']['tmp_name'], $filepath.$filename)) {
		die("上传文件失败");
	}
	ob_end_clean();
	header('Location:'.$returnURL.'?fileName='.$filename);//跳转到传过来的returnURL参数,并传递参数文件名称
	exit();
}else{//截图上传图片
	
	$imgsrc=array();
	foreach ($_POST['base64File'] as $key => $val ) {
		$imgsrc[$key]=getPic(base64_decode($val));
	}
	ob_end_clean();
	exit(json_encode($imgsrc));//返回图片远程路径数组
}

//将图片写入服务器文件中，并返回地址
function getPic($pic64)
{
   $filename ="upload/images/".mySetFileName().'.png';
   if($pic64){
      fopen($filename,'w+');
   }
// 首先我们要确定文件存在并且可写。
if (is_writable($filename)) {

    if (!$handle = fopen($filename, 'a')) {
         print "不能打开文件 $filename";
         exit;
    }
    //将图片写入到我们打开的文件中。
    if (!fwrite($handle, $pic64)) {
        print "不能写入到文件 $filename";
        exit;
    }
    print "成功地将 图片 写入到文件";
    fclose($handle);
	$imgurl = "http://10.0.6.200/".$filename;
	return $imgurl;
	} else {
	 return false;
	} 
}
//生成图片名称
function mySetFileName() {
		$gettime = explode(' ', microtime());
		$string = 'abcdefghijklmnopgrstuvwxyz0123456789';
		$rand = '';

		for ($x = 0; $x < 3; $x++) {
			$rand .= substr($string, mt_rand(0, strlen($string) - 1), 1);
		}
		return date("ymdHis") . substr($gettime[0], 2, 6) . $rand;
	}