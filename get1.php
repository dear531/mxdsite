<?php 
$contents = ""; 
$url=www.hao123.com;
exec("wget {$url}");
echo $contents; 
?> 
