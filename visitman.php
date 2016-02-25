<?php
	require_once("controller/db.php");
?>
<h1>Quản lí lượt truy cập</h1>
<div>
	<span id="txtInfo"></span>
	
	<div id="divStudentInfo">
		<input id="txtStudentID" type="text" onkeypress="txtStudentID_TextChanged();" placeholder="MSSV" autofocus/> 
		<select id="cmbMajor">
			<option value="Ngành">Ngành</option>
			<?php
				$majors = db::GetAllMajors();
				
				foreach($majors as $major)
				{
					$value = $major->Code . " - " . $major->MajorName;
					echo "<option value='$major->MajorName'>$value</option>";
				}
			?>
		</select>
		<input type="button" value="Kiểm tra" onclick="btnCheckStudentID();"/> 	
		<div style="text-align: center;">
			<input type="button" value="Thêm" onclick="btnInsertStudentID();"/>
		</div>
	</div>
	
	<div id="divVisitList"> 
		<h3>Các lượt truy cập của ngày hiện tại: <?php echo (new DateTime())->format('d/m/Y');?></h3>
		<table>
			<tr>
				<th>MSSV</th>
				<th>Họ và tên</th>
				<th>Ngành học</th>
				<th>Thời gian</th>
			</tr>
		<?php		
			// Hiển thị các lượt đã truy cập của ngày hôm đó sắp xếp giảm dần
			$visits = db::GetTodayVisits();			
			
			foreach($visits as $visit)
			{
				echo "<tr>";
					echo "<td>$visit->VisitID</td>";
					echo "<td>$visit->StudentID</td>";
					echo "<td>$visit->Major</td>";
					echo "<td>$visit->Date</td>";
				echo "</tr>";
			}
		?>
		</table>
	</div>
	
<div/>