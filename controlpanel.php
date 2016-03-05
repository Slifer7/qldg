<?php
require_once("LoginResult.php");
session_start();

if (isset($_SESSION["LOGGED_IN"])){
	$result = $_SESSION["LOGIN_INFO"];
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
	<link rel="stylesheet" href="css/visitman.css"/>
	<link rel="stylesheet" href="css/common.css" />
</head>
<body>
  <div id="main">
    <div id="header">
	  <div id="logo">
		<img id="logo_img" src="img/logo.png"/>
	  </div>	  
      <div id="menubar">
        <ul id="menu">		
		  <?php	
			if (0 != strcmp( "admin", 
						   strtolower($result->Room)
						   )){ // Admin thì không xử lí lượt truy cập
				echo "<li id='visitman'><a href='controlpanel.php?action=visitman'>Lượt truy cập</a></li>";          
				$choice = "visitman";
			}
		  ?>		  
          
          <li id="registration"><a href="controlpanel.php?action=registration">Đăng kí</a></li>
          <li id="majorman"><a href="controlpanel.php?action=majorman">Ngành học</a></li>
		  <?php
		  if (0 == strcmp( "admin", 
						   strtolower($result->Room)
						  )){ // Chỉ có admin mới có quyền thực hiện thống kê và quản lí tài khoản
			$choice = "statistics";
			echo "<li id='accounts'><a href='controlpanel.php?action=accounts'>Tài khoản</a></li>";
			echo "<li id='statistics'><a href='controlpanel.php?action=statistics'>Thống kê</a></li>";			
		  }
		  ?>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
        <h2>Bảng điểu khiển</h2>
        <img src="img/user.png" style="padding-left: 2px; padding-right: 2px;" /> <a id="txtUsername" href="profile.php"><b><?php echo $_SESSION["LOGIN_INFO"]->Username; ?></b></a><br/>
        <img src="img/logout.png"style="position: relative; padding-top: 5px; top: 3px;"/> <a id="txtAction" href="doLogout.php" >Thoát</a>
      </div>
      <div id="content"><?php 
			if (isset($_REQUEST["action"])){
				$choice = $_REQUEST["action"];
			}
			include_once($choice . ".php"); 
		?>
      </div>	  	  
    </div>  	
	<div id="footer">
		Thư viện Đại học Khoa học tự nhiên - 227 Nguyễn Văn Cừ P5 Q5 TP HCM
	</div>	
  </div>
  
  <script src="js/jquery-2.2.1.min.js"></script>
  <script src="js/visitman.js"></script>
  <script src="js/majorman.js"></script>	
  <script src="js/statistics.js"></script>
  <script type="text/javascript">
	document.getElementById("<?php echo $choice; ?>").className = "selected";
  </script>
</body>
</html>
