function ValidateLoginData()
{
	var username = document.getElementById("txtUsername").value;
	var password = document.getElementById("txtPassword").value;
	var txtErrorInfo = document.getElementById("txtErrorInfo");	
	
	var errorInfo = "" 
	
	if ( (0 == username.length) || (0 == password.length) )
	{
		errorInfo = "Lỗi: Tên đăng nhập hoặc mật khẩu không được để trống!";		
	}	
	
	if (0 == errorInfo.length )
	{
		return true;
	}
	else
	{
		txtErrorInfo.innerHTML = errorInfo;
		return false;	
	}	
}