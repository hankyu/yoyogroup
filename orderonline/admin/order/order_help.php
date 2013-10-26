<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
include("../fckeditor/fckeditor.php") ;
require_once('../Lib/xfun.SQLHelp.php');

//基本設定
$CLASS["orderhelp"] = new xfunDB_sql;
$CLASS["orderhelp"]->connect(); 
$TITLE = "運費管理系統";		//主標題
$SUBTITLE = "付款方式管理";		//次標題
$REDirect_PG=$phpself;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
</head>
<?
$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_help]";
$CLASS["orderhelp"]->query($result_num);
$total = $CLASS["orderhelp"]->num_rows($CLASS["orderhelp"]->result);	//總筆數
if($total >= 1):
$row = $CLASS["orderhelp"]->fetch_array($CLASS["orderhelp"]->result);
$orderhelp_num=$row['orderhelp_num'];
$orderhelp_content=$row['orderhelp_content'];
$orderhelp_econtent=$row['orderhelp_econtent'];
endif;
$CLASS["orderhelp"]->free_result($CLASS["orderhelp"]->result);

?>
<?PHP

if($act=="update"){
$CLASS["DB_log"] = new xfunDB_sql;
$CLASS["DB_log"]->connect(); 
if($act=="insert"){$acttitle="新增";}
if($act=="update"){$acttitle="修改";}
if($act=="delete"){$acttitle="刪除";}
	$result_log = "INSERT INTO xfun_log (log_name,log_user,cdate)VALUES('付款方式資料".$acttitle."','".$sec_id."','".date("Y-m-d H:i:s")."')";
	$CLASS["DB_log"]->query($result_log);
$CLASS["DB_log"]->free_result($CLASS["DB_log"]->result);

//==============資料處理程序==============
$Mem = new XFUN_SQLHelp();
$Mem->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_order_help];
$Mem->ClassTitle = "付款方式資料";
$Mem->DB_Field = "`orderhelp_content`";
$Mem->DB_Values = "'$OrderHelp_editor'";
$Mem->DB_updValues = "orderhelp_content='$OrderHelp_editor',orderhelp_econtent='$OrderHelp2_editor' WHERE orderhelp_num = $num";
$Mem->DB_delValues = " orderhelp_num = $num";
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
<link href="../js/type.css" rel="stylesheet" type="text/css" />
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
<form id="form1" name="form1" method="post" action="<?=$phpself?>">
<table width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
  <tr>
    <td bgcolor="#FFFFFF">
	<div><strong>中文版</strong></div>
<?php
$sBasePath = "../fckeditor/";//$_SERVER['PHP_SELF'] ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "fckeditor" ) ) ;

$oFCKeditor = new FCKeditor('OrderHelp_editor') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $orderhelp_content;
$oFCKeditor->Create() ;
?>
	</td>
    </tr>
  <tr>
    <td bgcolor="#FFFFFF">
	<div><strong>英文版</strong></div>
<?php
$sBasePath = "../fckeditor/";//$_SERVER['PHP_SELF'] ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "fckeditor" ) ) ;

$oFCKeditor = new FCKeditor('OrderHelp2_editor') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $orderhelp_econtent;
$oFCKeditor->Create() ;
?>
	</td>
    </tr>
	
  <tr>
    <td align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit" value=" 更新 "  class="input02">
      <input name="act" type="hidden" id="act" value="update">
      <input name="num" type="hidden" id="num" value="<?=$orderhelp_num?>"></td>
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
