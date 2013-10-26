<?
// 
// จาคl1
include "class.GenAuth.php";
$AuthPic = new GenAuth();
$AuthPic->Show();

echo $_SESSION['vcode'];
?>