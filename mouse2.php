<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>鼠标经过效果</title>
<style type="text/css">
.thumbnail{
position: relative;
	  z-index: 0;
}
.thumbnail:hover{
	background-color: transparent;
	z-index: 50;
}
.thumbnail span{
position: absolute;
padding: 1px;
left: -1000px;
visibility: hidden;
color: black;
       text-decoration: none;
}
.thumbnail span img{
	border-width: 0;
padding: 2px;
}
.thumbnail:hover span{
visibility: visible;
top: 17px;
left: 100px;
}
</style>
</head>
<body>
<a class="thumbnail" href="">鼠标点击这里
<span><img src="qian.jpg"></span>
</a><br/>
<a class="thumbnail" href="">鼠标点击这里
<span><img src="wait1.png"></span>
</a><br/>
注释：“鼠标点击这里”===》图片效果为：
<a class="thumbnail"><img src="/images/duanxiaoxi.gif" border="0" onClick="showDiv(this)"><span><img src="/images2/dxxpic.gif" width="165" height="26" border="0"></span></a>
</body>
</body>
</html>
