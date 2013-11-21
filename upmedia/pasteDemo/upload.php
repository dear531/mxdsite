<?
$Editor = $_POST['Editor'];	 
$Editor = stripslashes(eregi_replace("\n","",$Editor));
preg_match_all('/\"data.*?\"/',$Editor,$pic);//获取字符串data以及data以后的图片信息
//提交过来的内容中包含截图
if($pic[0]){
	$pics = array();
	$strlen = 0;//截取的字符串长度
	foreach($pic[0] as $key => $val){
		$strlen=strpos($val,'base64,')+7;//加上“base64,”的长度
		$temp[$key]=substr($val,$strlen,-1);
	}
		$pics['base64File'] = $temp;
		//将图片POST到服务器
		$url = "http://10.0.6.200/uploadimg.php";//这里是接收图片的服务器的url
			$curl = curl_init();

			curl_setopt($curl,CURLOPT_URL,$url);

			curl_setopt($curl,CURLOPT_POST,true);

			curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($pics));

			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		
			$response=curl_exec($curl);
			if ($response === FALSE) {
				 echo "cURL Error: " . curl_error($curl);
			}
			curl_close($curl);	
			//返回服务器上图片的url
			$result = json_decode($response,true);	
			foreach($pic[0] as $key => $val){
					$Editor = str_replace($val, $result[$key], $Editor);
				
			}
}
echo $Editor;//直接打印出编辑器中的内容，因为图片的url已经替换为远程，所以图片将直接显示出来


//随机生成文件名称，方法来自网络
function mySetFileName() {
		$gettime = explode(' ', microtime());
		$string = 'abcdefghijklmnopgrstuvwxyz0123456789';
		$rand = '';

		for ($x = 0; $x < 3; $x++) {
			$rand .= substr($string, mt_rand(0, strlen($string) - 1), 1);
		}

		return date("ymdHis") . substr($gettime[0], 2, 6) . $rand;
	}


?> 
	 
