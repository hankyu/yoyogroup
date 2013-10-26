<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");

$CLASS["adgroup"] = new xfunDB_sql;
$CLASS["adgroup"]->connect(); 
$CLASS["menu"] = new xfunDB_sql;
$CLASS["menu"]->connect(); 
$CLASS["menu_group"] = new xfunDB_sql;
$CLASS["menu_group"]->connect(); 

$script_filename = getenv('PATH_TRANSLATED');
if (empty($script_filename)) {
$script_filename = getenv('SCRIPT_FILENAME');
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<?=$js?>
</head>

<body>

<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
    <tr bgcolor="#CCCCCC" class="title2">
      <td align="center"><strong class="style2">‧使用者權限設定‧</strong></td>
  </tr>
    <tr>
<form action="power_submit.php" method="POST" name="reg" >
      <td>
	  <table width="100%" height="56"border="1" cellpadding="3" cellspacing="0" bordercolorlight="#CCCCCC" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr>
    <td bgcolor="#EBEBEB">&nbsp;</td>
<?
//使用者群組
$CLASS["adgroup"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_admin_group] ORDER BY GP_ID ASC");
$Rec_Grp_Total=$CLASS["adgroup"]->num_rows($CLASS["adgroup"]->result);//總筆數
if($Rec_Grp_Total >= 1):
while ($row_gp = $CLASS["adgroup"]->fetch_array($CLASS["adgroup"]->result)) {

$gp_user_level = $gp_user_level.$row_gp['User_Level'].",";
$gp_cname = $row_gp['GP_Cname'];
?>		  
<td align="center" bgcolor="#EBEBEB"><?=$gp_cname?></td>
<?
}
endif;
?>		  
</tr>
<?
//******************************主選單*************************************
$M_color = "bgcolor='#FFF5E1'";//背景顏色
$M_strong = "<strong>";//字形外觀
$M_strong2 = "</strong>";//字形外觀
$gp_user_level=explode(",",$gp_user_level);//cmu_admin_group權限代號

$CLASS["menu"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] ORDER BY Align ASC");
$M_Total=$CLASS["menu"]->num_rows($CLASS["menu"]->result);//總筆數
if($M_Total >= 1):
while ($row_a = $CLASS["menu"]->fetch_array($CLASS["menu"]->result)) {

	$MU_ID = $row_a['MU_ID'];
	$MUser_Level = $row_a['User_Level'];
	$Title = $row_a['Title'];
?>		  
<tr onMouseOver="this.style.backgroundColor='#FFFFCC';" onMouseOut="this.style.backgroundColor='#FFFFFF';">
<td <?=$M_color?>><?=$M_strong?><?=$Title?><?=$M_strong2?></td>
<?
for ($p=0;$p<$Rec_Grp_Total;$p++){
?>
<td align="center" <?=$M_color?>>
<?
$chk="";
//echo $gp_user_level[$p];
//echo $MUser_Level;
if ($MUser_Level!=""):
$M_Array=explode(",",$MUser_Level);
$Mcount_I=count($M_Array);
for($i=0;$i<=$Mcount_I;$i++){
	if ($M_Array[$i]==$gp_user_level[$p]){
		$chk="checked";
	}
}
endif;
//echo $MU_ID.$gp_user_level[$p];
?>
<input name="Mmenu<?=$MU_ID?>[]" type="checkbox" value="<?=$gp_user_level[$p]?>" <?=$chk?>>
</td>
<? }?>
</tr>
<?
//******************************次選單*************************************
$S_color = "";//背景顏色
$S_strong = "";//字形外觀
$S_strong2 = "";//字形外觀

$CLASS["menu_group"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu_group] WHERE MU_ID ='$MU_ID' ORDER BY MU_ID");
if($CLASS["menu_group"]->num_rows($CLASS["menu_group"]->result) >= 1)://總筆數
while ($row_b = $CLASS["menu_group"]->fetch_array($CLASS["menu_group"]->result)) {
	$SUB_MU_ID = $row_b['SUB_MU_ID'];
	$SUser_Level = $row_b['User_Level'];
	$Sub_Tilte = $row_b['Sub_Tilte'];
	$S_Total++;
?>		  
<tr onMouseOver="this.style.backgroundColor='#FFFFCC';" onMouseOut="this.style.backgroundColor='#FFFFFF';">
<td <?=$S_color?>><?=$S_strong?><?=$Sub_Tilte?><?=$S_strong2?></td>
<?
for ($p=0;$p<$Rec_Grp_Total;$p++){
?>
<td align="center" <?=$S_color?>>
<?
$chk="";
if ($SUser_Level!=""):
$S_Array=explode(",",$SUser_Level);
$Scount_I=count($S_Array);
for($i=0;$i<=$Scount_I;$i++){
	if ($S_Array[$i]==$gp_user_level[$p]){
		$chk="checked";
	}
}
endif;
//echo $SUB_MU_ID.$gp_user_level[$p];
?>
<input name="Smenu<?=$SUB_MU_ID?>[]" type="checkbox" value="<?=$gp_user_level[$p]?>" <?=$chk?>>
</td>
<? }?>
</tr>
<?
//******************************次選單*************************************
}
endif;
?>  

<?
//******************************主選單*************************************
}
endif;
?>
<tr>
<td colspan="<?=$Rec_Grp_Total+1?>" align="center" bgcolor="#EBEBEB">
<input name="Submit" type="submit" class="input04" value="送出修改">
<input name="Submit2" type="reset" class="input02" value=" 回復 ">
<input name="S_Total" type="hidden" id="S_Total" value="<?=$S_Total?>">
<input name="M_Total" type="hidden" id="M_Total" value="<?=$M_Total?>">
<input name="act" type="hidden" id="act" value="power_mdy"></td>
</tr>		  
</table>
</td>
</form>
</tr>
</table>
</body>
</html>
