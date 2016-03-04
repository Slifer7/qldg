<?php
	$error = "";
	
	if (isset($_REQUEST["error"]))	{
		if ("INVALID_LOGIN_INFO" == $_REQUEST["error"])	{
			$error = "Tên đăng nhập hoặc mật khẩu không đúng.<br/><br/>";
		}
	}	
?>

<html>
	<head>
		<title> Login </title>
		<meta charset="utf-8"/>
		<script src="js/login.js" ></script>
		<link rel='stylesheet prefetch' href='css/jquery-ui.css'>
		<link rel="stylesheet" href="css/login.css" />
	</head>
	
	<body>
		<div>
			
		</div>
		<div class="login-card">
			<img src="img/logo.png" id="logo_img"/> <div style="float: right; margin-right: 30px; margin-top:10px;"><h2>| Thư viện</h2></div>
			<h1>Quản lí truy cập</h1>
			<form action="doLogin.php" method="post" onsubmit="return ValidateLoginData();">
				<input type="text" name="txtUsername" id="txtUsername" placeholder="Username" autofocus/> <br/>
				<input type="password" name="txtPassword" id="txtPassword" placeholder="Password"/> <br/>
				<span class="ErrorText" id="txtErrorInfo">
					<?php echo $error ?>
				</span>
				<input type="submit" class="login login-submit"  value="Đăng nhập"/>
			</form>
		</div>
		
		<script src='js/jquery-2.2.1.min.js'></script>
		<script src='js/jquery-ui.min.js'></script>
	</body>
</html>