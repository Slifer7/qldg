<?php
require_once("db.php");	
?>
<div>
	<h1>Thống kê lượt truy cập</h1>
	<br/>
	<form method="get" action="showStatistics.php">
		<table>
			<tr>
				<td>Từ ngày: <input id="txtFromDate" name="txtFromDate" type="text" /></td>
				<td>Đến ngày: <input id="txtFromDate" name="txtFromDate" type="text" /></td>				
			</tr>
			<tr>
				<td>Phòng đọc: <select>
					<option value="all">Tất cả</option>	
					<option value="linhtrung">Linh Trung</option>	
					<option value="thamkhao">Tham khảo</option>	
					<option value="luuhanh">Lưu hành</option>	
				</select>
				</td>
				<td>Ngành học: <select>
					<option value="all">Tất cả</option>	
					<?php
						$majors = db::GetAllMajors();
						
						foreach($majors as $major){
							echo "<option value='$major->Code'>$major->Code - $major->MajorName</option>";
						}
					?>
				</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="center"><input type="submit" value="Thống kê"/> <input type="button" value="Xuất excel"/></td>
			</tr>
			
		</table>
	</form>
	
</div>