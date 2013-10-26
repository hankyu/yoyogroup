<?
include("config.php");
include("DataAccess/sql_table.php");
include("DataAccess/mysql_conn.php");
include("Common/js.php");
include("Common/functions.php");
include("DataAccess/authorization.php");

$group=view_kind("'".$sec_user_level."'","$XFUN_TBL[TABLE_XFUN_admin_group]","User_Level","GP_Cname");

$CLASS["myMenu"] = new xfunDB_sql;
$CLASS["myMenu"]->connect(); 
$CLASS["mySMenu"] = new xfunDB_sql;
$CLASS["mySMenu"]->connect(); 
?>
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<?=$js?>
</head>

<body>
	<table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#EFEFEF" >
      <tr>
        <td height="26" background="images/topbar_bg.gif"><img src="images/tentative_inline.gif" width="12" height="14" align="absmiddle"> 登入資訊</td>
      </tr>
      <tr>
        <td><img src="images/i_group.gif" alt="群組" width="22" height="22" align="absmiddle"> <span class="td11">
		<?=$sec_user_level_title?></span><br>
        <img src="images/i_person.gif" alt="姓名" width="22" height="22" align="absmiddle"> <span class="td11"><?=$sec_user_name?></span><br>
        <!--<img src="images/i_edit_info.gif" alt="編輯個人資料" width="22" height="22" align="absmiddle"> <span class="td11"><a href="power/power_edit.php?act=mdy&AD_ID=<?=$ad_id;?>&from=<?=y?>" target="mainAREA">編輯個人資料</a></span><br>//-->
        </a></span></td>
      </tr>
      <tr>
        <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/i_logout.gif" alt="登出系統" width="22" height="22" align="absmiddle"><a href="logout.php" target="_top">登出系統</a></td>
          <td><img src="images/i_home.gif" alt="網站前台" width="22" height="22" align="absmiddle"> <a href="../" target="_blank">前台首頁</a></td>
        </tr>
      </table>
		</td>
      </tr>
</table>
<?
// 
$count = 0;
$menu_key=$_GET['menu_key'];
//主選單
$CLASS["myMenu"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] ORDER BY MU_ID DESC");
$total = $CLASS["myMenu"]->num_rows($CLASS["myMenu"]->result);
if($total >= 1):
while($row_a = $CLASS["myMenu"]->fetch_array($CLASS["myMenu"]->result)){
	
	$MU_ID = $row_a['MU_ID'];
	$User_Level=$row_a['User_Level'];
	//主選單權限
	$main_menu=explode(",",$User_Level);
	$g_Key=array_search ($sec_user_level,$main_menu);
	$key_G_chk = strlen($g_Key);
	if ($key_G_chk):
	$count = $count + 1;
?>
	<table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#EFEFEF" >
      <tr bgcolor="#E0E0E0">
        <td height="10" background="images/memu_bg.jpg" bgcolor="#E0E0E0" onClick="javascript:DisplayLayer('<?=$count;?>')" style="cursor:hand">&nbsp;<img src="images/bg_all.gif" align="absmiddle">&nbsp;&nbsp;<?=$row_a['Title']?>
        <a name="t<?=$count?>"></a></td>
      </tr>
</table>
<div id="LeftMenuLayer<?=$count;?>" style="display:<? if($count==$menu_key){echo '';}else{echo 'none';}?>">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<?	//次選單
//次選單資料表
$CLASS["mySMenu"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu_group] WHERE MU_ID ='$MU_ID' ORDER BY SUB_MU_ID DESC");
$total_b = $CLASS["mySMenu"]->num_rows($CLASS["mySMenu"]->result);
if($total_b >= 1):
	while($row_b = $CLASS["mySMenu"]->fetch_array($CLASS["mySMenu"]->result)){
	    $MU_ID = $row_b['MU_ID'];
		$Link = $row_b['Link'];
		$Sub_Tilte = $row_b['Sub_Tilte'];
		$SUser_Level=$row_b['User_Level'];
		//次選單權限
		$sec_menu=explode(",",$SUser_Level);
		$i_Key=array_search ($sec_user_level,$sec_menu);
		$key_I_chk = strlen($i_Key);
		if ($key_I_chk):
		?>
		<table width="100%" border="1" cellspacing="0" cellpadding="0" bgcolor="#EFEFEF" bordercolordark="#ffffff" bordercolorlight="#EFEFEF" >
		<tr bgcolor="#FFF0D0" >
        <td height="20" bgcolor="#FDFDFD" onMouseOver="this.style.backgroundColor='#e7f2fa';" onMouseOut="this.style.backgroundColor='';" onClick="top.frames['mainAREA'].location.href ='<?=$Link?>'" style="cursor:hand">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/bullet_13.gif" align="absmiddle"> 
<?=$Sub_Tilte?></td>
		</tr>
		</table>
<?   
		endif;
	} //while_end
endif;
?>
</td></tr>
</table>
</div>
<?
 endif;
}
endif;
?>
<SCRIPT language=javascript>
function style_display_on() { 
    
      return "block"; 
} 
function DisplayLayer(value){
	if (value!='')
		if (document.getElementById("LeftMenuLayer" + value ).style.display=='none')	{
			for (i=1; i<=<?=$count;?>; i++)
			document.getElementById("LeftMenuLayer" + i ).style.display='none';
			document.getElementById("LeftMenuLayer" + value ).style.display=style_display_on();
			}
		else
			{
			for (i=1; i<=<?=$count;?>; i++)
			document.getElementById("LeftMenuLayer" + i ).style.display='none';
			document.getElementById("LeftMenuLayer" + value ).style.display='none';
			}
	else
		for (i=1; i<=<?=$count;?>; i++)
			document.getElementById("LeftMenuLayer" + i ).style.display='none';
}
</SCRIPT>

</body>
</html>
