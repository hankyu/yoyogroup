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

$ACT_TITLE="房間圖片";
$REDirect_PG="rent_img_adm.php?id=$rent_Num&main_page=$main_page&PB_page=$PB_page";

$CLASS["DB_log"] = new xfunDB_sql;
$CLASS["DB_log"]->connect(); 
if($act=="insert"){$acttitle="新增";}
if($act=="update"){$acttitle="修改";}
if($act=="delete"){$acttitle="刪除";}
	$result_log = "INSERT INTO xfun_log (log_name,log_user,cdate)VALUES('[".view_kind($rent_Num,"xfun_rent_room","rentNum","projName")."]房間圖片資料".$acttitle."','".$sec_id."','".date("Y-m-d H:i:s")."')";
	$CLASS["DB_log"]->query($result_log);
$CLASS["DB_log"]->free_result($CLASS["DB_log"]->result);
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
//==============POST 資料==============
/*if($act=="insert"):
$SQLImg=$_FILES['file_img']['tmp_name'];
if (!empty($_FILES['file_img']['tmp_name'])){
	foreach ($SQLImg as $key => $value){
		 echo $SQLImg[$key]."<br>";
	}
}
endif;
exit;
*/
//==============刪除檔案==============
if($act=="delete"):
$FDEL = new XFUN_Upload();
		$FDEL->File_Path = $XFUN_CONFIG["CONFIG_UPLOADPATH_PRO"];
		$FDEL->DelFile_Name = $img_file;
		if($FDEL->unLinkFile()):
			$Del_Img_File++;
		endif;
			$FDEL->DelFile_Name = "s_".$img;
 			$FDEL->unLinkFile();
		if($Del_Img_File!=0):
			echo "<script language='javascript'>view_class_alert('共刪除".$Del_Img_File."個檔案成功！')</script>";
		endif;
endif;
//==============上傳檔案==============
$FUP = new XFUN_Upload();
$FUP->File_Use = "1";
$FUP->File_Title = "gohotel_";
$FUP->File = "Img";
$FUP->File_Path = $XFUN_CONFIG["CONFIG_UPLOADPATH_PRO"];
if($FUP->UploadFile()):
	$FUP->DelFile_Name=$Oldart_Img;
	$FUP->unLinkFile();
	$FUP->DelFile_Name="s_".$Oldart_Img;
	$FUP->unLinkFile();
	$rent_Img_File = $FUP->File_Name;
	$rent_Img_Size = $FUP->File_Size;
else:
	$rent_Img_File = $Oldart_Img;
	$rent_Img_Size = $Oldart_Img_Size;
endif;
$SQL_File = new XFUN_SQLHelp();
$SQL_File->DB_Table = $XFUN_TBL[TABLE_XFUN_rent_img];
$SQL_File->ClassTitle = "圖片資料";
$SQL_File->DB_Field = "rent_Num,rent_Img_File,rent_Img_Size,rent_Img_Sort,last_modify";
$SQL_File->DB_Values = "'$rent_Num','$rent_Img_File','$rent_Img_Size',$rent_Img_Sort,'".$sec_id."'";
$SQL_File->DB_updValues ="rent_Num=$rent_Num,rent_Img_File='$rent_Img_File',rent_Img_Size='$rent_Img_Size',rent_Img_Sort=$rent_Img_Sort,last_modify='".$sec_id."' WHERE rent_Img_Num = $rent_Img_Num";
$SQL_File->DB_delValues = "rent_Img_Num = $rent_Img_Num";
if($SQL_File->ActDataAccess($act)):
	echo $msg;
	echo "<script language='javascript'>redirectURL('".$SQL_File->ClassActTitle.$SQL_File->ClassTitle."成功！','$REDirect_PG')</script>";
endif;
if(count($xfunTable_chkSelect)>0){

	for($i=0;$i<=count($xfunTable_chkSelect);$i++){
		list($id, $img)=split(':',$xfunTable_chkSelect[$i]);
		$bFDEL = new XFUN_Upload();
		$bFDEL->File_Path = $XFUN_CONFIG["CONFIG_UPLOADPATH_PRO"];
		$bFDEL->DelFile_Name = $img;
		if($bFDEL->unLinkFile()):
			$Del_Img_File++;
		endif;
			$bFDEL->DelFile_Name = "s_".$img;
			$bFDEL->unLinkFile();
		$SQL_File = new XFUN_SQLHelp();
		$SQL_File->DB_Table = $XFUN_TBL[TABLE_XFUN_rent_img];
		$SQL_File->ClassTitle = "圖片資料";
		$SQL_File->DB_delValues = "rent_Img_Num = '".$id."'";
		$SQL_File->ActDataAccess("delete");
		
	}
		if($Del_Img_File!=0):
			echo "<script language='javascript'>redirectURL('".$SQL_File->ClassActTitle.$SQL_File->ClassTitle."成功！','$REDirect_PG')</script>";

			echo "<script language='javascript'>view_class_alert('共刪除".$Del_Img_File."個檔案成功！')</script>";
		endif;
}
?>
</body>
</html>
