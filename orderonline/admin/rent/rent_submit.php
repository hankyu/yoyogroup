<?
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

$ACT_TITLE="訂房";
if ($act=="insert"){
	$REDirect_PG="rent_add.php";
}elseif($act=="update"){
	$REDirect_PG="rent_adm.php";
	// $REDirect_PG="rent_edit.php?id=$id&PB_page=$PB_page";
}elseif($act=="delete"){
	$REDirect_PG="rent_adm.php?id=$id&PB_page=$PB_page";
}elseif($act=="show"){
	$REDirect_PG="rent_adm.php?PB_page=$PB_page";
}else{
	$REDirect_PG="rent_adm.php";
}

$CLASS["DB_log"] = new xfunDB_sql;
$CLASS["DB_log"]->connect(); 
if($act=="insert"){$acttitle="新增";}
if($act=="update"){$acttitle="修改";}
if($act=="delete"){$acttitle="刪除";}
$tt=trim($projName=="")?view_kind($id,"xfun_rent_room","rentNum","projName"):$projName;
	$result_log = "INSERT INTO xfun_log (log_name,log_user,cdate)VALUES('[".$tt."]房間圖片資料".$acttitle."','".$sec_id."','".date("Y-m-d H:i:s")."')";
	$CLASS["DB_log"]->query($result_log);
$CLASS["DB_log"]->free_result($CLASS["DB_log"]->result);

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
//==============POST 資料==============
//$News_Img=$_FILES["News_Img"];
$S_Date=$S_Date==""?"0000-00-00":$S_Date;
$E_Date=$E_Date==""?"0000-00-00":$E_Date;
$sf_date=date('Y-m-d');
if (empty($S_Date)||empty($E_Date)):
	$S_Date="";
	$E_Date="";
endif;
//==============資料處理程序==============
$DB = new XFUN_SQLHelp();
$DB->DB_Table = $XFUN_TBL[TABLE_XFUN_rent];
$DB->ClassTitle = "訂房資料";
$DB->DB_Field = "`lan`,`projNum`,`projName`,`en_projName`,`rentPrice`,`display`,`rentDiscribe`,`en_rentDiscribe`,`shortDiscribe`,`en_shortDiscribe`,`creatDate`,`last_modify`";
$DB->DB_Values = "'$lan','$projNum','$projName','$en_projName',$rentPrice,'$display','$rentDiscribe','$en_rentDiscribe','$shortDiscribe','$en_shortDiscribe','$sf_date','".$sec_id."'";
$DB->DB_updValues ="
`lan`='".$lan."',
`projNum`='".stripslashes($projNum)."',
`projName`='".stripslashes($projName)."',
`en_projName`='".stripslashes($en_projName)."',
`rentPrice`=".$rentPrice.",
`display`='$display',
`rentDiscribe`='".stripslashes($rentDiscribe)."',
`en_rentDiscribe`='".stripslashes($en_rentDiscribe)."',
`shortDiscribe`='".stripslashes($shortDiscribe)."', 
`en_shortDiscribe`='".stripslashes($en_shortDiscribe)."',
`last_modify`='".stripslashes($sec_id)."' 
WHERE rentNum = $id";
$DB->DB_delValues = "rentNum = $id";
if($DB->ActDataAccess($act)):
	$Num = $DB->DB_InsertID;
	$msg = "<script language='javascript'>redirectURL('".$DB->ClassActTitle.$DB->ClassTitle."成功！','$REDirect_PG')</script>";
else:
	$msg = "<script language='javascript'>redirectURL('".$DB->ClassActTitle.$DB->ClassTitle."錯誤！','$REDirect_PG')</script>";
endif;
//==============顯示與否==============
if($act=="show"):
$DB = new XFUN_SQLHelp();
$DB->DB_Table = $XFUN_TBL[TABLE_XFUN_rent];
$DB->DB_updValues ="`display`='$s',`last_modify`='".$sec_id."'  WHERE rentNum = $id";
$DB->ClassTitle = "訂房資料";
$DB->ActDataAccess("update");
$msg = "<script language='javascript'>redirectURL('".$DB->ClassActTitle.$DB->ClassTitle."成功！','$REDirect_PG')</script>";
endif;
//==============刪除檔案==============
if($act=="delete"):
//============刪除訂房資料============
$DB = new XFUN_SQLHelp();
$DB->DB_Table = $XFUN_TBL[TABLE_XFUN_rent_date];
$DB->DB_delValues = "rentNum = $id";
$DB->ActDataAccess($act);
//============刪除圖片資料============
$CLASS["img"] = new xfunDB_sql;
$CLASS["img"]->connect(); 
$Del_Img_File=0;
$FDEL = new XFUN_Upload();
	$extquery=" WHERE rent_Num = $id";
	$CLASS["img"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_img] $extquery");
	$total = $CLASS["img"]->num_rows($CLASS["img"]->result);	//總筆數
	if($total >= 1):
		while ($result = $CLASS["img"]->fetch_array($CLASS["img"]->result)) {
			$rent_Img_File = $result['rent_Img_File'];
			$FDEL->File_Path =  $XFUN_CONFIG["CONFIG_UPLOADPATH_PRO"];
			$FDEL->DelFile_Name = $rent_Img_File;
			if($FDEL->unLinkFile()):
				$Del_Img_File++;
			endif;
			$FDEL->DelFile_Name = "s_".$rent_Img_File;
			$FDEL->unLinkFile();
		}
		$DB2 = new XFUN_SQLHelp();
		$DB2->DB_Table = $XFUN_TBL[TABLE_XFUN_rent_img];
		$DB2->DB_delValues = "rent_Num = $id";
		$DB2->ActDataAccess($act);
		if($Del_Img_File!=0):
			echo "<script language='javascript'>view_class_alert('共刪除".$Del_Img_File."個檔案成功！')</script>";
		endif;
	endif;
$CLASS["img"]->fetch_array($CLASS["img"]->result);	
endif;
//==============上傳檔案==============
$rent_Img_Sort=0;
$FUP = new XFUN_Upload();
$FUP->File_Use = "1";
$FUP->File_Title = "gohotel_";
$FUP->File = "Img";
$FUP->File_Path =  $XFUN_CONFIG["CONFIG_UPLOADPATH_PRO"];
if($FUP->UploadFile()):
	$Img_File = $FUP->File_Name;
	$Img_Size = $FUP->File_Size;

$Pro_File = new XFUN_SQLHelp();
$Pro_File->DB_Table = $XFUN_TBL[TABLE_XFUN_rent_img];
$Pro_File->ClassTitle = "圖片資料";
$Pro_File->DB_Field = "rent_Num,rent_Img_File,rent_Img_Size,rent_Img_Sort";
$Pro_File->DB_Values = "'$Num','$Img_File','$Img_Size',$rent_Img_Sort";
$Pro_File->DB_updValues ="rent_Num='$Num',rent_Img_File='$Img_File',rent_Img_Size='$Img_Size',rent_Img_Sort=$rent_Img_Sort WHERE rent_Img_File = '$rent_Img_File'";
$Pro_File->DB_delValues = "rent_Num = '$id'";
if($Pro_File->ActDataAccess($act)):
	echo $msg;
	echo "<script language='javascript'>redirectURL('".$Pro_File->ClassActTitle.$Pro_File->ClassTitle."成功！','$REDirect_PG')</script>";
endif;
endif;

echo $msg;
exit;
?>
</body>
</html>
