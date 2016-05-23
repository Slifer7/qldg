<?php

?>

<h1>Nhập dữ liệu từ quá khứ</h1>
<br/>
<span id="txtInfo"></span><br/><br/>
<form action="updateHistory.php" method="post">
      Ngày muốn cập nhật: <input type="text" id="txtDate" name="txtDate" placeholder="dd/mm/yyyy" /> <br/> <br/>
      Nhập danh sách sinh viên: (mỗi sinh viên một dòng) <br/><br/>
      <textarea type="text" cols="40" rows="20" id="txtStudents" placeholder="MSSV" onkeyup="inputToUpper()"></textarea><br/><br/>
      <div style="width: 300; text-align: center;">
        <input type="button" value="Cập nhật" onclick="updateHistory()"/>
      </div>
</form> 

<!--Các ký tự "CBN" trong database là chữ hoa nên phải chuyển chữ thường thành chữ hoa trong <textarea>-->

<script>

    var input = document.getElementById("txtStudents");
	

	function inputToUpper(){
 		input.value = input.value.toUpperCase();
	}
</script>
<script src="js/moment.js"></script>
<script src="js/history.js"></script>
