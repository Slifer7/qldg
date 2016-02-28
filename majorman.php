<?php
require_once("controller/db.php");
?>

<h1>Quản lí các ngành học</h1>
<div id="divImportMajors">
	<span id="txtInfo"></span>
	<form method="post" action="controller/doImportMajors.php" enctype="multipart/form-data" onsubmit="return ValidateImportFile();">
		Lựa chọn tập tin: <input type="file" name="upfile" placeholder="Excel file"/>
		<input type="submit" value="upload"/>
	</form>
</div>
<div id="divAllMajorList">
	<table id="tblMajors">
		<tr>
			<th>Mã ngành</th>
			<th>Ngành</th>
		</tr>
		<?php
			$majors = db::GetAllMajors();
			
			foreach($majors as $major) {
				echo "<tr>";
				echo "<td style='text-align: center;'>$major->Code</td>";
				echo "<td >$major->MajorName</td>";
				echo "<tr>";
			}
		?>
	</table>
</div>