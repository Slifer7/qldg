<?php
require_once("controller/LoginResult.php");
session_start();
?>
<html>
<head>
	<title>Admin control panel</title>
	<script src="js/visitman.js"></script>
	<link rel="stylesheet" href="css/visitman.css"></link>
</head>

<body>
	<div id="control panel">
		<a href="admincp/action=majorman">Quản lí các ngành học </a> <br/>
		<a href="admincp/action=userman">Quản lí người dùng</a> <br/>		
		<a href="admincp/action=import">Import danh sách sinh viên</a> <br/>
		<a href="admincp/action=visitman">Quản lí lượt truy cập</a> <br/>
		<a href="admincp/action=statistics">Thống kê</a> <br/>
	</div>
	<div id="MainContent">
	<?php
		$choice = "visitman";
		if (isset($_REQUEST["action"]))
		{
			$choice = $_REQUEST["action"];
		}		
		include_once($choice . ".php");
	?>
	</div>
	<div id="UserInfo">
		<a href="userinfo.php"><?php echo $_SESSION["LOGIN_INFO"]->Username; ?></a>
		<a href="controller/dologout.php">Đăng xuất</a>
	</div>
</body>
</html>