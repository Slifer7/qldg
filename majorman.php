<?php
require_once("db.php");
?>
<h1>Quản lí các ngành học</h1>
<br/>
<div id="divImportMajors">
	<h3>Import</h3>
	<span id="txtInfo"></span>
	<form method="post" action="doImportMajors.php" enctype="multipart/form-data" onsubmit="return ValidateImportFile();">
		Lựa chọn tập tin: <input type="file" id="upfile" name="upfile" placeholder="Excel file"/>
		<input type="submit" value="upload"/>
	</form>
</div>
<br/>
<br/>
<div id="divAllMajorList">
	<h3>Danh sách các ngành học</h3>
	<table id="tblMajors">
		<tr>
			<th>Mã ngành</th>
			<th>Ngành</th>
		</tr>
	<?php
		$majors = db::GetAllMajors();

		foreach($majors as $major){
			echo "<tr id='$major->Code'>";
				echo "<td style='text-align: center;'>$major->Code</td>";
				echo "<td>$major->MajorName</td>";
				echo "<td style='width: 60px; text-align: center;'><a href='beginedit' onclick='return beginEditMajor($major->Code);'>Edit</a></td>";
			echo "</tr>";
		}
	?>
	</table>
</div>
<script src="js/helper.js"></script>
<script src="js/majorman.js"></script>
