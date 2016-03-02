<?php
require_once("LoginResult.php");
session_start();

if (isset($_SESSION["LOGGED_IN"])){
	$result = $_SESSION["LOGIN_INFO"];
	
	if (0 != strcmp( "admin", strtolower($result->RoleName) ) )	{ // No admin right
		header("Location: login.php");
	}
}
else {// Haven't login yet
	// Redirect to log in page
	header("Location: login.php");
}	
?>
<html>
<head>
	<title>Admin control panel</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" href="css/admin.css"/>	
	<link rel="stylesheet" href="css/visitman.css" />
</head>
<body>
  <div id="main">
    <div id="header">
	  <div id="logo">
		<img id="logo_img" src="img/logo.png"/>
	  </div>	  
      <div id="menubar">
        <ul id="menu">		  
          <li class="selected"><a href="index.html">Lượt truy cập</a></li>
          <li><a href="examples.html">Thống kê</a></li>
          <li><a href="page.html">Tài khoản</a></li>
          <li><a href="another_page.html">Đăng kí</a></li>
          <li><a href="admincp.php?action=majorman">Ngành học</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
        <h3>Control panel</h3>
        <a id="txtUsername" href="profile.php"><?php echo $_SESSION["LOGIN_INFO"]->Username; ?></a><br/>
        <a id="txtAction" href="doLogout.php" >Thoát</a>
      </div>
      <div id="content">
        <?php
		$choice = "visitman";
		if (isset($_REQUEST["action"]))
		{
			$choice = $_REQUEST["action"];
		}		
		include_once($choice . ".php");
		?>
      </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">
      Thư viện Đại học Khoa học tự nhiên - 227 Nguyễn Văn Cừ P5 Q5 TP HCM
    </div>
  </div>
  
  <script src="js/jquery-2.2.1.min.js"></script>
  <script src="js/visitman.js"></script>
  <script src="js/majorman.js"></script>	
</body>
</html>
