<?
$Editor = $_POST['Editor'];	 
$Editor = stripslashes(eregi_replace("\n","",$Editor));
preg_match_all('/\"data.*?\"/',$Editor,$pic);//��ȡ�ַ���data�Լ�data�Ժ��ͼƬ��Ϣ
//�ύ�����������а�����ͼ
if($pic[0]){
	$pics = array();
	$strlen = 0;//��ȡ���ַ�������
	foreach($pic[0] as $key => $val){
		$strlen=strpos($val,'base64,')+7;//���ϡ�base64,���ĳ���
		$temp[$key]=substr($val,$strlen,-1);
	}
		$pics['base64File'] = $temp;
		//��ͼƬPOST��������
		$url = "http://10.0.6.200/uploadimg.php";//�����ǽ���ͼƬ�ķ�������url
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
			//���ط�������ͼƬ��url
			$result = json_decode($response,true);	
			foreach($pic[0] as $key => $val){
					$Editor = str_replace($val, $result[$key], $Editor);
				
			}
}
echo $Editor;//ֱ�Ӵ�ӡ���༭���е����ݣ���ΪͼƬ��url�Ѿ��滻ΪԶ�̣�����ͼƬ��ֱ����ʾ����


//��������ļ����ƣ�������������
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
	 
