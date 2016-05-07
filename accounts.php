<?php
include_once("Account.php");
?>

<h1>Danh sách các phòng</h1>
<br/>
<table id="tblAccounts">
  <tr>
    <th>Tên đăng nhập</th>
    <th>Mật khẩu</th>
    <th>Phòng</th>
  </tr>
  <?php
    $list = Account::GetAll();
    foreach($list as $item){
        echo "<tr id='$item->Username'>";
        echo "<td>$item->Username</td>";
        echo "<td><a href='' onclick='return changePass($item->Username);'>Đổi mật khẩu</a></td>";
        echo "<td>$item->Room</td>";
        echo "<td><a href='' onclick='return beginEditUser($item->Username);'>Edit</a></td>";
        echo "</tr>";
    }
  ?>
  <tr>
    <td><input id="txtNewUsername" type="text" style="width: 100px;" placeholder="Tên" /></td>
    <td><input id="txtNewPassword" type="password" style="width: 100px;" placeholder="Mật khẩu" /></td>
    <td><input id="txtNewRoom" type="text" style="width: 100px;" placeholder="Phòng" /></td>
    <td><a href='' onclick='return add();'>Thêm</a></td>
  </tr>
</table>

<script src="js/accounts.js"></script>
