<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php
require_once("head.php");
echo "file_name<br>";
file_name_global($file_name);
echo "frame_name<br>";
file_name_global($frame_name);
echo "session_inof<br>";
file_name_global($session_inof);
file_call(2);
?>
</body>
</html>
