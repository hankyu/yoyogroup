<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
require_once('../Lib/xfun.SQLHelp.php');

//基本設定
$CLASS["cartage"] = new xfunDB_sql;
$CLASS["cartage"]->connect(); 
$TITLE = "運費管理系統";		//主標題
$SUBTITLE = "運費管理";		//次標題
$REDirect_PG=$phpself;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
<SCRIPT language=JavaScript>
<!--
function check(form1)
{
  if (document.form1.cartage.value == "")
  {
    alert("運費不得為空白！");
    document.form1.cartage.focus();
	document.form1.cartage.value = 0;
    return (false);
  }
  if (document.form1.order_totalprice.value == "")
  {
    alert("訂單金額不得為空白！");
    document.form1.order_totalprice.focus();
    return (false);
  }
  
  if(document.form1.cartage.value != ""){
    cltxt=document.form1.cartage.value;
	for (i=0;i<cltxt.length;i++)
	{
	  c=cltxt.charAt(i);
	  if ("0123456789".indexOf(c,0)<0)
	  {
	  alert("運費請輸入阿拉伯數字");
	  document.form1.cartage.focus();
	  document.form1.cartage.value = 0;
	  return (false);
	  }
	}
  }

  if(document.form1.order_totalprice.value != ""){
    cltxt=document.form1.order_totalprice.value;
	for (i=0;i<cltxt.length;i++)
	{
	  c=cltxt.charAt(i);
	  if ("0123456789".indexOf(c,0)<0)
	  {
	  alert("訂單金額請輸入阿拉伯數字");
	  document.form1.order_totalprice.focus();
	  document.form1.order_totalprice.value = 0;
	  return (false);
	  }
	}
  }

  return  true;  
}
-->
</SCRIPT>
</head>
<link href="../js/type.css" rel="stylesheet" type="text/css" />
<?PHP
if($act=="update"){
//==============資料處理程序==============
$Mem = new XFUN_SQLHelp();
$Mem->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_cartage];
$Mem->ClassTitle = "運費資料";
$Mem->DB_Field = "`cartage_price`,`prototal_price`";
$Mem->DB_Values = "'$cartage','$order_totalprice'";
$Mem->DB_updValues = "cartage_price='$cartage',prototal_price='$order_totalprice' WHERE cartage_num = $num";
$Mem->DB_delValues = " cartage_num = $num";
if($Mem->ActDataAccess($act)):
	$Products_Num = $Mem->DB_InsertID;
	$Insert_DB=true;
	$msg = "<script language='javascript'>redirectURL('".$Mem->ClassActTitle.$Mem->ClassTitle."成功！','$REDirect_PG')</script>";
else:
	$Insert_DB=false;
	$msg = "系統錯誤!請通知系統管理者。";
endif;
echo $msg;
}
?>
<?PHP
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_cartage]";

  $CLASS["cartage"]->query($result_num);

  $total = $CLASS["cartage"]->num_rows($CLASS["cartage"]->result);	//總筆數
  if($total>=1)
  {
  	$row = $CLASS["cartage"]->fetch_array($CLASS["cartage"]->result);
	$cartage_num=$row["cartage_num"];
	$cartage=$row["cartage_price"];
	$order_totalprice=$row["prototal_price"];
  }
$CLASS["cartage"]->free_result($CLASS["cartage"]->result);

?>
<body>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr bgcolor="#CCCCCC" class="title2"> 
    <td height="8" align="center" nowrap> 
     <strong class="style2">‧<?=$SUBTITLE?>‧</strong></td>
  </tr>
</table>
<table width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
<tr>
<td align="center" valign="top">
<div align="center" style="height:auto">
<form id="form1" name="form1" method="post" action="<?=$phpself?>" onSubmit="return check(this)">
<table width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
  <tr>
    <td width="69" bgcolor="#FFFFFF">運費</td>
    <td width="204" bgcolor="#FFFFFF"><input name="cartage" type="text" class="input" id="cartage" value="<?=$cartage?>" /></td>
    <td width="750" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">訂單金額 </td>
    <td bgcolor="#FFFFFF"><input name="order_totalprice" type="text" class="input" id="order_totalprice" value="<?=$order_totalprice?>" /></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="更新">
      <input name="act" type="hidden" id="act" value="update">
      <input name="num" type="hidden" id="num" value="<?=$cartage_num?>"></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="2" bgcolor="#FFFFFF">運費規則：<span class="option01">當客戶的訂購總金額小於您設定的訂單金額，該筆訂單就加收運費。</span></td>
    </tr>
</table>
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr class="title2">
    <td align="right"></td>
  </tr>
</table>
</div>
</td>
</tr>
</table>
</body>
</html>
