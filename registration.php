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
			$page = 1;
			
			if (isset($_GET["page"])){
				$page = $_GET["page"];
			}				
			
			$recordsPerPage = 200;
			$regs = RegistrationInfo::GetAllRegistration($page, $recordsPerPage);
			
			foreach($regs->Data as $reg) {
				echo "<tr id='$reg->StudentID'>";
				echo "<td style='text-align: center;'>$reg->StudentID</td>";
				echo "<td >$reg->FullName</td>";
				echo "<td >$reg->MajorName</td>";
				echo "<td style='width: 150px'>$reg->RegisterDate</td>";
				echo "<td style='width: 60px; text-align: center;'><a href='beginedit' onclick='return beginEdit($reg->StudentID)'>Edit</a></td>";
				echo "<tr>";
			}
		?>
		<tr>
			<td colspan="5" class="TextRight"><?php // Sinh ra bộ duyệt trang
				if ($page < 7){
					for ($i = 1; $i < $page; $i++)
						echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
				}
				else{					
					echo "<a href='controlpanel.php?action=registration&page=1'>1</a> &nbsp;";
					echo "<a href='controlpanel.php?action=registration&page=2'>2</a> &nbsp;";
					echo "<a href='controlpanel.php?action=registration&page=1'>3</a> &nbsp;";
					echo " ... ";
					$i = $page - 2;
					echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
					$i = $page - 1;
					echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
				}
			
				echo "<a><b>$page</b></a> &nbsp;";	
				
				if($regs->PageCount - $page < 6){
					for ($i = $page + 1; $i <= $regs->PageCount; $i++)
						echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
				}
				else{
					$i = $page + 1;
					echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
					$i = $page + 2;
					echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
					echo " ... ";
					
					$i = $regs->PageCount - 1;
					echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
					$i = $regs->PageCount;
					echo "<a href='controlpanel.php?action=registration&page=$i'>$i</a> &nbsp;";
				}
					
			?></td>
		</tr>
	</table>
</div>
<script src="js/helper.js"></script>
<script src="js/registration.js"></script>