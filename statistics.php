<?php
require_once("db.php");	
?>
<div>
	<h1>Thống kê lượt truy cập</h1>
	<br/>
	<span id="txtInfo" class="Error"></span>
	<form method="get" action="showStatistics.php">
		<table>
			<tr><?php
					$today = date("d/m/Y");
				?>
				<td>Từ ngày:</td> <td><input id="txtFromDate" name="txtFromDate" type="text" value="<?php echo $today;?>" required/></td>
				<td>Đến ngày:</td><td><input id="txtToDate" name="txtToDate" type="text" value="<?php echo $today;?>" required/></td>				
			</tr>
			<tr>
				<td>Phòng đọc:</td>
				<td><select id="cmbReadingRoom" class="FullWidth">
					<option value="all">Tất cả</option>	
					<option value="linhtrung">Linh Trung</option>	
					<option value="thamkhao">Tham khảo</option>	
					<option value="luuhanh">Lưu hành</option>	
				</select>
				</td>
				<td>Ngành học:</td>
				<td><select id="cmbMajor" class="FullWidth">
					<option value="all">Tất cả</option>	
					<?php
						$majors = db::GetAllMajors();
						
						foreach($majors as $major){
							echo "<option value='$major->MajorName'>$major->Code - $major->MajorName</option>";
						}
					?>
				</select>
				</td>
			</tr>
			<tr>
				<td colspan="4" class="Center">
					<input type="button" value="Thống kê" onclick="btnShowStatistics_Click()" /> 
					<input type="button" value="Xuất excel" onclick="btnExport2Excel_Click()"/>
				</td>
			</tr>			
		</table>
	</form>
	<br/>
	<br/>
	<div id="divResult">
		<h3>Kết quả thống kê</h3>
		<br/>
		<table id="tblVisits">
			<tr>
				<th>Thời gian</th>
				<th>MSSV</th>				
				<th>Ngành học</th>
				<th>Phòng đọc</th>
			</tr>
		</table>
	</div>
</div>
<script src="js/moment.js"></script>