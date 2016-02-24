<?php
	$error = "";
	
	if (isset($_REQUEST["error"]))
	{
		if ("INVALID_LOGIN_INFO" == $_REQUEST["error"])
		{
			$error = "Lỗi: Tên đăng nhập hoặc mật khẩu không đúng.";
		}
	}
	
?>

<html>
	<head>
		<title> Login </title>
		<meta charset="utf-8"/>
		<script src="js/login.js" ></script>
		<link rel="stylesheet" href="css/login.css" />
	</head>
	
	<body>
		<div>
			<span class="ErrorText" id="txtErrorInfo">
				<?php echo $error ?>
			</span>
		</div>
		<form action="controller/doLogin.php" method="post" onsubmit="return ValidateLoginData();">
			Username: <input type="text" name="txtUsername" id="txtUsername"/> <br/>
			Password: <input type="password" name="txtPassword" id="txtPassword"/> <br/>
			<input type="submit" value="Đăng nhập"/>
		</form>
	</body>
</html>