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
        <td class="bigred" bgcolor="f7f7f7" align="center">����</td>
      </tr>
      <tr> 
        <td align="center"  height='530'> 	
		<div id='divHtml' style="height:100%;display:;">
			   <textarea rows="80" cols="50" name="Editor" id="Editor"></textarea>
			  				<script language="javascript">
						
						CKEDITOR.replace( 'Editor',{
								 //ͼƬ�ϴ�����·����returnURLΪ����,������������ת������ҳ��
								filebrowserImageUploadUrl : 'http://10.0.6.200/uploadimg.php?returnURL=http://localhost/pasteDemo/jump.php'		
						});
								//��ckeditor������ɺ���¼�������󶨵���ճ���¼���ʵ�ֽ�ͼֱ��ճ��ͼƬ�ڱ༭����
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
											
								//FileReader���Բο�<p>API
											var fileReader = new FileReader();
											
								//readAsDataURL��һ���첽���̣������ṩ�ص�����
											fileReader.onloadend = function () {
												var d = this.result.substr( this.result.indexOf(',')+1);
												//��ckeditor�в���ͼƬ,base64�������
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
                <input type="submit" value="�� ��" name="submit" class="btnOrange"/>
              </td>
              <td > 
                <input type="reset"	value="�� ��" name="reset" class="btnBlack" onclick="CKEDITOR.instances.Editor.document.getBody().$.innerHTML=''"/>
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
