<?
include("config.php");
include("Common/js.php");

if($error_id="01"):
	$msg="資料已過期！請重新登入！";
endif;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>錯誤訊息</title>
<?=$js?>
</head>

<body>
<div align=center style="height:100px; width:100%; vertical-align:middle">
        <table border="0" align=center cellpadding="0" cellspacing="0">
        <tr><td align=center>
        <?=$msg?><br>
		<a href='<?=$LOGIN?>' target="_top"><font color=red>LOGIN</font></a>
        </td></tr>
        </table>
</div>		
</body>
</html>
