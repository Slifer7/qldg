<?php
require_once("RegistrationInfo.php");
?>

<h1>Đăng kí sử dụng thư viện</h1>
<br/>
<div id="divImportMajors">
	<h3>Import</h3>
	<span id="txtInfo"></span>
	<form method="post" action="doImportRegistration.php" enctype="multipart/form-data" onsubmit="return ValidateImportFile();">
		Lựa chọn tập tin: <input type="file" id="upfile" name="upfile" placeholder="Excel file"/>
		<input type="submit" value="upload"/>
	</form>
</div>
<br/>
<br/>
<div id="divAllRegistrationList">
	<h3>Danh sách đã đăng kí</h3>
	<table id="tblRegistration">
		<tr>
			<th>MSSV</th>
			<th>Họ và tên</th>
			<th>Chuyên ngành</th>
			<th>Thời điểm đăng kí</th>
		</tr>
		<?php
			// TODO: paging
			$page = 1;
			
			if (isset($_GET["page"])){
				$page = $_GET["page"];
			}				
			
			$regs = RegistrationInfo::GetAllRegistration($page);
			
			foreach($regs->Data as $reg) {
				echo "<tr>";
				echo "<td style='text-align: center;'>$reg->StudentID</td>";
				echo "<td >$reg->FullName</td>";
				echo "<td >$reg->MajorName</td>";
				echo "<td >$reg->RegisterDate</td>";
				echo "<tr>";
			}
		?>
		<tr>
			<td colspan="4" class="TextRight"><?php // Sinh ra bộ duyệt trang
				for($i = 1; $i <= $regs->PageCount; $i++){
					echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
				}
			?></td>
		</tr>
	</table>
</div>