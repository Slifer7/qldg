function ValidateLoginData()
{
	var username = $("#txtUsername").val();
	var password = $("#txtPassword").val();
	var txtErrorInfo = $("#txtErrorInfo");	
	
	var errorInfo = "" 
	
	if ( (0 == username.length) || (0 == password.length) ){
		errorInfo = "Tên đăng nhập hoặc mật khẩu không được để trống!<br/><br/>";		
	}	
	
	if (0 == errorInfo.length )	{
		return true;
	}
	else {
		txtErrorInfo.innerHTML = errorInfo;
		return false;	
	}	
}