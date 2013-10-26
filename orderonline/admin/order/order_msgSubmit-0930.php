<?PHP
include("../../admin/config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../../admin/Common/functions.php");
include("../Common/js.php");
require_once('../../admin/Lib/xfun.SQLHelp.php');

$ACT_TITLE="訂單雙向留言";
$REDirect_PG="order_view.php?order_id=$order_id&act=viewlist";

//基本設定
$CLASS["Forum"] = new xfunDB_sql;
$CLASS["Forum"]->connect(); 
$CLASS["DB_log"] = new xfunDB_sql;
$CLASS["DB_log"]->connect(); 

$TITLE = "訂單雙向留言";		//主標題
$SUBTITLE = "訂單雙向留言";		//次標題

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$TITLE?></title>
<?=$js?>
</head>
<body>
<?
//==============討論區資料處理程序==============
$forum_catalog=$MainKind.",".$secondBox;
$mdydate=date('Y-m-d h:m:s');
$myData = new XFUN_SQLHelp();
$myData->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_order_msg];
$myData->ClassTitle = "訂單留言";
$myData->DB_Field = "order_id,order_msg_user,order_msg_content,order_msg_cdate";
$myData->DB_Values = "'$order_id','$order_msg_user','$order_msg_content','$mdydate'";
$myData->DB_updValues ="order_id='$order_id',order_msg_user='$order_msg_user',order_msg_content='$order_msg_content',order_msg_cdate=$mdydate
 WHERE order_msg_num =$order_msg_num";
$myData->DB_delValues = "order_msg_num =$order_msg_num";
if($myData->ActDataAccess($act)):
$result_log = "INSERT INTO xfun_log (log_name,log_user,cdate)VALUES('[".$order_id."]訂單留言','".$sec_id."','".date("Y-m-d H:i:s")."')";
	$CLASS["DB_log"]->query($result_log);
	$CLASS["DB_log"]->free_result($CLASS["DB_log"]->result);
	
	$Order = new XFUN_SQLHelp();
	$Order->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_order_list];
	$Order->ClassTitle = "訂單資料";
	$Order->DB_updValues = "`last_modify`='".$sec_id."' WHERE order_id='".$order_id."'";
	$Order->DB_delValues = NULL;
	$Order->ActDataAccess("update");
	$Insert_DB=true;

	//更新文章變更日期
	$Insert_DB=true;
	$msg = "<script language='javascript'>redirectURL('".$myData->ClassActTitle.$myData->ClassTitle."成功！','$REDirect_PG')</script>";
else:
	$msg = "<script language='javascript'>redirectURL('".$myData->ClassActTitle.$myData->ClassTitle."錯誤！','$REDirect_PG')</script>";
endif;
echo $msg;
?>
</body>
</html>
