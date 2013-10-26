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


$ACT_TITLE="使用者";
$REDirect_PG="power_list.php";
$REDirect_PG2="power_edit.php";
$REDirect_PG3="power_link_adm.php?show=$show&PB_page=$PB_page";
$REDirect_PG4="power_mainkind.php";
$REDirect_PG5="power_add.php";

$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<?=$js?>
</head>

<body>
<?
//==============POST 資料==============
//==============管理者資料處理程序==============
if ($precess=='adm')
{
$S_Date=$S_Date==""?"0000-00-00":$S_Date;
$E_Date=$E_Date==""?"0000-00-00":$E_Date;
$C_Date=date('Y-m-d');
	$Adm = new XFUN_SQLHelp();
	$Adm->DB_Table = $XFUN_TBL[TABLE_XFUN_admin];
	$Adm->ClassTitle = "管理者資料";
	$Adm->DB_Field = "ID,PSW,Name,User_Level,Phone,Email,Usr_Lock,S_Date,E_Date,C_Date";
	$Adm->DB_Values = "'$ID','$PSW','$Name','$AD_Group','$Phone','$Email','$Usr_Lock','$S_Date','$E_Date','$C_Date'";
	$Adm->DB_updValues ="PSW='$PSW',Name='$Name',User_Level='$AD_Group',Phone='$Phone',Email='$Email',S_Date='$S_Date',E_Date='$E_Date' WHERE AD_ID=$AD_ID";
	$Adm->DB_delValues = "AD_ID=$AD_ID";
	if($Adm->ActDataAccess($act)):
		$Products_Num = $Adm->DB_InsertID;
		$msg = "<script language='javascript'>redirectURL('".$Adm->ClassActTitle.$Adm->ClassTitle."成功！','$REDirect_PG')</script>";
	else:
		$msg = "<script language='javascript'>redirectURL('".$Adm->ClassActTitle.$Adm->ClassTitle."錯誤！','$REDirect_PG')</script>";
	endif;
	echo $msg;
	exit;
}
?>
<?
if ($act=='show'){
if($s=="Yes"):
$msg="授權成功！";
else:
$msg="停權成功！";
endif;
$CLASS["db"]->query("UPDATE $XFUN_TBL[TABLE_XFUN_admin] SET Usr_Lock='$s' WHERE AD_ID=$AD_ID");
echo "<script language='javascript'>redirectURL('$msg','".$REDirect_PG."?show=$show')</script>";
}
?>
<?
//******************************************************
if ($act=='power_mdy'){

//更新主選單
$sql_Mmenu="SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] ORDER BY Align ASC";
$result_Mmenu = mysql_query($sql_Mmenu);
if(mysql_num_rows($result_Mmenu) >= 1):
	while($row_M=mysql_fetch_array($result_Mmenu)){
		 $MU_ID=$row_M["MU_ID"];
		 $Mmenu= "Mmenu$MU_ID";
		 $splitMmenu= $$Mmenu;
		 $MM="";
		 //print_r($splitMmenu)."<br>";
		 $Mcount_I=count($splitMmenu);
		 for($i=0;$i<$Mcount_I;$i++){
			$MM=$MM.$splitMmenu[$i].",";
		 }

		 $sqlM="UPDATE $XFUN_TBL[TABLE_XFUN_menu] SET User_Level='$MM' WHERE MU_ID=$MU_ID";
		 $queryM=mysql_query($sqlM)or die("無法更新主選單".mysql_error());
	}
endif;
//$sql="UPDATE XFUN_menu SET User_Level='' WHERE MU_ID=$";
//$query=mysql_query($sql)or die("無法新增".mysql_error());

//更新次選單
//$sql="UPDATE XFUN_menu_group SET User_Level='' WHERE MU_ID=$";
//$query=mysql_query($sql)or die("無法新增".mysql_error());
$sql_Smenu="SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu_group] ORDER BY SUB_MU_ID ASC";
$result_Smenu = mysql_query($sql_Smenu);
if(mysql_num_rows($result_Smenu) >= 1):
	while($row_S=mysql_fetch_array($result_Smenu)){
		 $SUB_MU_ID=$row_S["SUB_MU_ID"];
		 $Smenu= "Smenu$SUB_MU_ID";
		 $splitSmenu= $$Smenu;
		 $SS="";
		 //print_r($splitMmenu)."<br>";
		 $Scount_I=count($splitSmenu);
		 for($i=0;$i<$Scount_I;$i++){
			$SS=$SS.$splitSmenu[$i].",";
		 }

		 $sqlS="UPDATE $XFUN_TBL[TABLE_XFUN_menu_group] SET User_Level='$SS' WHERE SUB_MU_ID=$SUB_MU_ID";
		 $queryS=mysql_query($sqlS)or die("無法更新次選單".mysql_error());
	}
endif;

echo "<script language='javascript'>redirectURL('權限修改成功！','power_set.php')</script>";
}
?>
<?
//***************************************************************選單功能
$folder = dirname($url_link);
$foldername = substr(strrchr((trim($folder )), "/"), 1);
if ($process=="sub_menu"){
	$subMenu = new XFUN_SQLHelp();
	$subMenu->DB_Table = $XFUN_TBL[TABLE_XFUN_menu_group];
	$subMenu->ClassTitle = "選單資料";
	$subMenu->DB_Field = "MU_ID,Sub_Tilte,Link,User_Level";
	$subMenu->DB_Values = "'$mainMenu','$sub_menu','$url_link','X'";
	$subMenu->DB_updValues ="MU_ID='$mainMenu',Sub_Tilte='$sub_menu',Link='$url_link' WHERE SUB_MU_ID=$mdy_id";
	$subMenu->DB_delValues = "SUB_MU_ID=$mdy_id";
	if($subMenu->ActDataAccess($act)):
		$Products_Num = $subMenu->DB_InsertID;
		$msg = "<script language='javascript'>redirectURL('".$subMenu->ClassActTitle.$subMenu->ClassTitle."成功！','$REDirect_PG3')</script>";
	else:
		$msg = "<script language='javascript'>redirectURL('".$subMenu->ClassActTitle.$subMenu->ClassTitle."錯誤！','$REDirect_PG3')</script>";
	endif;
	echo $msg;
	exit;
}	
?>
<?
//================新增修改選單主類別
if ($process=="main_menu"){
	$subMenu = new XFUN_SQLHelp();
	$subMenu->DB_Table = $XFUN_TBL[TABLE_XFUN_menu];
	$subMenu->ClassTitle = "主選單資料";
	$subMenu->DB_Field = "Title,User_Level,Floder";
	$subMenu->DB_Values = "'$XFUN_menu_input','X','$Floder'";
	$subMenu->DB_updValues ="Title='$kind_title',Floder='$Floder' WHERE MU_ID = $kind_id";
	$subMenu->DB_delValues = "MU_ID = $kind_id";
	if($subMenu->ActDataAccess($act)):
		$Products_Num = $subMenu->DB_InsertID;
		$msg = "<script language='javascript'>redirectURL('".$subMenu->ClassActTitle.$subMenu->ClassTitle."成功！','$REDirect_PG4')</script>";
	else:
		$msg = "<script language='javascript'>redirectURL('".$subMenu->ClassActTitle.$subMenu->ClassTitle."錯誤！','$REDirect_PG4')</script>";
	endif;
	echo $msg;
	exit;
}
?>
</body>
</html>
