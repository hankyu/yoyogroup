<?PHP
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
require_once('../Common/upfile_function.php');
require_once('../Lib/xfun.SQLHelp.php');
require_once('../Lib/xfun.upload.php');

$ACT_TITLE="開放訂房";
$REDirect_PG="rent_room.php?id=$rentNum&main_page=$main_page&PB_page=$PB_page";

//echo count($xfunTable_chkSelect);
//echo $xfunTable_chkSelect[0];

//list($month, $day, $year) = split('[/.-]', $date);
//echo $id."<br>";
//echo $img;
//exit;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?PHP no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<?=$js?>
</head>

<body>
<?PHP
$CLASS["DB"] = new xfunDB_sql;
$CLASS["DB"]->connect(); 
$CLASS["DB_Sopping"] = new xfunDB_sql;
$CLASS["DB_Sopping"]->connect(); 

if($act=="insert"){$acttitle="新增";}
if($act=="update"){$acttitle="修改";}
if($act=="delete"){$acttitle="刪除";}
	$result_log = "INSERT INTO xfun_log (log_name,log_user,cdate)VALUES('[".view_kind($rentNum,"xfun_rent_room","rentNum","projName")."]訂房日期資料".$acttitle."','".$sec_id."','".date("Y-m-d H:i:s")."')";
	$CLASS["DB_Sopping"]->query($result_log);

if($act=="insert"){
	$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_date] WHERE rentDate ='".$rentDate."' AND rentNum=".$rentNum;
	$CLASS["DB"]->query($result_num);
	$total = $CLASS["DB"]->num_rows($CLASS["DB"]->result);	//總筆數
	if($total >= 1):
	echo "<script language='javascript'>redirectURL('[$rentDate]已有設定，請至清單中修改！','$REDirect_PG')</script>";
	exit;
	endif;
	
}
if($act=="update" || $act=="delete"){
	$result_num = "DELETE FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] WHERE shopping_proname='".$rentNum."' AND shopping_proid ='".$rentDateNum."' AND shopping_promodel ='".$rentDate."' AND shopping_status = 'A'";
	$CLASS["DB"]->query($result_num);
}
$CLASS["DB"]->free_result($CLASS["DB"]->result);
$CLASS["DB_Sopping"]->free_result($CLASS["DB_Sopping"]->result);
//==============資料處理==============
$SQL_File = new XFUN_SQLHelp();
$SQL_File->DB_Table = $XFUN_TBL[TABLE_XFUN_rent_date];
$SQL_File->ClassTitle = "訂房資料";
$SQL_File->DB_Field = "rentNum,rentDate,rentDatePrice,rentDateAmount,last_modify";
$SQL_File->DB_Values = "'$rentNum','$rentDate','$rentDatePrice','$rentDateAmount','".$sec_id."'";
$SQL_File->DB_updValues ="rentDate='$rentDate',rentDatePrice='$rentDatePrice',rentDateAmount=$rentDateAmount,last_modify='".$sec_id."' WHERE rentDateNum = $rentDateNum";
$SQL_File->DB_delValues = "rentDateNum = $rentDateNum";
if($SQL_File->ActDataAccess($act)):
	echo $msg;
	echo "<script language='javascript'>redirectURL('".$SQL_File->ClassActTitle.$SQL_File->ClassTitle."成功！','$REDirect_PG')</script>";
endif;
?>
</body>
</html>
