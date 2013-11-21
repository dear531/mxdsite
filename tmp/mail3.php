
<?php
//　require_once 'Mail.php';

　$conf['mail'] = array(
		　　　'host' = 'stmp.163.com', //smtp服务器地址，可以用ip地址或者域名
		　　　'auth' = true, //true表示smtp服务器需要验证，false代码不需要
		　　　'username' = 'mxtserver', //用户名
		　　　'password' = 'aying7333' //密码
		　);

　/***
    　* 使用$headers数组，可以定义邮件头的内容，比如使用$headers['Reply-To']可以定义回复地址
    　* 通过这种方式，可以很方便的定制待发送邮件的邮件头
    　***/
　$headers['From'] = 'mxtserver@163.com'; //发信地址
　$headers['To'] = 'mxtserver@163.com'; //收信地址
　$headers['Subject'] = 'test mail send by php'; //邮件标题
　$mail_object = &Mail::factory('smtp', $conf['mail']);

　$body = ＜＜＜ MSG //邮件正文
　hello world!!!
　MSG;

　$mail_res = $mail_object-＞send($headers['To'], $headers, $body); //发送

　if( Mail::isError($mail_res) ){ //检测错误
	　　die($mail_res-＞getMessage());
	　}
?>
