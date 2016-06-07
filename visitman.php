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
		<input id="txtStudentID" type="text" style="width: 200px" placeholder="MSSV" onpaste="return txtStudentID_Pasted(event);"  onkeyup="return txtStudentID_KeyUp(event);" autofocus/>
		<div style="padding-left: 80px; margin-top: 10px;">
			<input type="button" value="Thêm" id="btnInsertStudent" onclick="btnInsertStudentID_Click();"/>
		</div>
	</div>
</div>
<br/>
<br/>
<div id="divVisitList">
	<h3>Các lượt truy cập của ngày hiện tại: <?php echo (new DateTime())->format('d/m/Y');?></h3>
	<table id="tblVisitList" border="1">
		<tr>
			<th>STT</th>
			<th>MSSV</th>
			<th>Họ và tên</th>
			<th>Ngành học</th>
			<th>Thời gian</th>
		</tr>
	<?php
		// Hiển thị các lượt đã truy cập của ngày hôm đó sắp xếp giảm dần
		$visits = VisitInfo::GetTodayVisits($result->Room);
		$count = count($visits);


		foreach($visits as $visit){
			echo "<tr>";
				echo "<td style='text-align: center;'>$count</td>";
				echo "<td>$visit->StudentID</td>";
				echo "<td>$visit->FullName</td>";
				echo "<td>$visit->Major</td>";
				echo "<td>$visit->Date</td>";
			echo "</tr>";
			$count--;
		}
		?>
	</table>
	<?php $n = count($visits); echo "<script>var gVisitCount = $n;</script>";?>
</div>
<script type="text/javascript" src="js/helper.js"></script>
