<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<script>
	$(function(){
		$("#password2").blur(function(){
			if($(this).val()==$("#password").val()){
				$("#passwordok").show();
				$("#passwordfail").hide();
			} else {
				$("#passwordfail").show();
				$("#passwordok").hide();
			}
		})	
	})
</script>
<body>
<li>
                            <span class="zc_name"> 密码： </span>
                            <input type="password" class="zc_text required" id="password" name="password" />
                            <span class="zc_tip"> <font color="red">*</font> <span id="showPwd">由6-16位字符组成，请使用英文字母、符号或数字。</span><span class="OK1 passwordok"><img  id="passwordok" src="/css/images/yes.gif" /></span><span class="no1 passwordfail"><img id="passwordfail" src="/css/images/no.gif" /></span></span>
                        </li>

                        <li>
                            <span class="zc_name"> 确认密码： </span>
                            <input type="password" class="zc_text required" id="password2" equalTo="#password" name="password2" "/>
                            <span class="zc_tip"> <font color="red">*</font> <span id="showPwd1">为了您记住输入的密码，请再次输入密码</span><span class="OK1 passwordok"><img  id="passwordok" src="/css/images/yes.gif" /></span><span class="no1 passwordfail"><img id="passwordfail" src="/css/images/no.gif" /></span></span>
                        </li>
</body>
</html>
