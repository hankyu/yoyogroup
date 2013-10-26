<?
include("config.php");
include("DataAccess/authorization.php");
?>
<head>
<link href="type.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<table width="100%" height="100%"border="1" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC" bordercolorlight="#CCCCCC" bordercolordark="#ffffff">
  <tr> 
    <td height="168" valign="middle"> 
      <div align="center"> 
	  <?=$SubLOGO?>	  </div>
      <div align="center"> 
        <p>歡迎 <strong><font color="#FF6600"><?=$sec_user_name?></font></strong> 登錄管理系統。</p>
        <br>
      </div></td>
  </tr>
</table>
</center>
</body>
</html>
