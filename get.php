<?php 
#$handle = fopen ("http://www.hao123.com", "rb"); 
$handle = fopen ("http://qun.qzone.qq.com/group#!/23457308/member", "rb"); 
$contents = ""; 
do { 
	$data = fread($handle, 1024); 
	if (strlen($data) == 0) { 
		break; 
	} 
	$contents .= $data; 
} while(true); 
fclose ($handle); 
echo $contents; 
?> 
