<?php
	require_once("VisitInfo.php");
	
	if (!isset($_SESSION["LOGGED_IN"])){
		// Redirect to log in page
		header("Location: login.php");
	}	
?>
<h1>Quản lí lượt truy cập</h1>
<br/>
<div>
	<h3>Thêm một lượt truy cập</h3>
	<span id="txtInfo"></span>
	<div id="divStudentInfo">
		<input id="txtStudentID" type="text" placeholder="MSSV" onkeypress="return txtStudentID_KeyDown();"  onpaste="txtStudentID_TextChanged();"  autofocus/> 
		<input id="txtFullName" type="text" placeholder="Họ và tên" /> 		
		<input type="button" value="Kiểm tra" onclick="btnCheckStudentID_Click();" /> 
		<div style="text-align: center; margin-top: 10px;">			
			<input type="button" value="Thêm" onclick="btnInsertStudentID_Click();"/>
		</div>
	</div>
</div>
<br/>
<br/>
<div id="divVisitList"> 
	<h3>Các lượt truy cập của ngày hiện tại: <?php echo (new DateTime())->format('d/m/Y');?></h3>
	<table id="tblVisitList" border="1">
		<tr>
			<th>MSSV</th>
			<th>Họ và tên</th>
			<th>Ngành học</th>
			<th>Thời gian</th>
		</tr>
	<?php		 
		// Hiển thị các lượt đã truy cập của ngày hôm đó sắp xếp giảm dần
		$visits = VisitInfo::GetTodayVisits($result->Room);			
		error_log("Room:" . $result->Room);
		foreach($visits as $visit){
			echo "<tr>";
				echo "<td>$visit->StudentID</td>";
				echo "<td>$visit->FullName</td>";
				echo "<td>$visit->Major</td>";
				echo "<td>$visit->Date</td>";
			echo "</tr>";
		}
	?>
	</table>
</div>