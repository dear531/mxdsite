<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK">
<title></title>

<link rel="stylesheet" href="css/std.css" type="text/css">

<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"  >
<form name=postcontent method="POST" action="upload.php">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td class="bigred" align="center" background="images/bgloveyou2.gif" height="10"></td>
      </tr>
      <tr>
        <td class="bigred" bgcolor="f7f7f7" align="center">内容</td>
      </tr>
      <tr> 
        <td align="center"  height='530'> 	
		<div id='divHtml' style="height:100%;display:;">
			   <textarea rows="80" cols="50" name="Editor" id="Editor"></textarea>
			  				<script language="javascript">
						
						CKEDITOR.replace( 'Editor',{
								 //图片上传发送路径，returnURL为参数,到服务器后跳转回来的页面
								filebrowserImageUploadUrl : 'http://10.0.6.200/uploadimg.php?returnURL=http://localhost/pasteDemo/jump.php'		
						});
								//当ckeditor加载完成后绑定事件，这里绑定的是粘贴事件，实现截图直接粘贴图片在编辑器中
								CKEDITOR.instances["Editor"].on("instanceReady", function () {  
											
											this.document.on("paste", Paste);  	
													 }); 
								function Paste(e){
									//console.log(e)
									console.log(CKEDITOR.instances.Editor.document.getBody())
									var items = e.data.$.clipboardData.items;
									
									for (var i = 0; i < items.length; ++i) {
										var item = e.data.$.clipboardData.items[i];
										
										if (items[i].kind == 'file' && items[i].type == 'image/png') {
											
								//FileReader可以参考<p>API
											var fileReader = new FileReader();
											
								//readAsDataURL是一个异步过程，这里提供回调方法
											fileReader.onloadend = function () {
												var d = this.result.substr( this.result.indexOf(',')+1);
												//往ckeditor中插入图片,base64编码过的
												CKEDITOR.instances.Editor.insertHtml("<img src='data:image/jpeg;base64,"+d+"'>"); 
													
											};
											fileReader.readAsDataURL(item.getAsFile());
											break; 
										}
									  }	
								}
								
					</script>
		</div>
        </td>
      </tr>
      <tr> 
        <td> 
          <table align="center" >
            <tr> 
              <td > 
                <input type="submit" value="完 成" name="submit" class="btnOrange"/>
              </td>
              <td > 
                <input type="reset"	value="重 置" name="reset" class="btnBlack" onclick="CKEDITOR.instances.Editor.document.getBody().$.innerHTML=''"/>
              </td>
			  <td > 		  
            </td>
            </tr>
          </table>
          <hr noshade color=ff9933>
        </td>
      </tr>	 
    </table> 
	</form>
</body>
</html>
