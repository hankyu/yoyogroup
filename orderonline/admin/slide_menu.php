<?
include("config.php");
include("Authorization2.php");
include("Common/functions.php");
no_cache_header();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>滑動選單</title>
<link href="js/type.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/sdmenu/sdmenu.css" />
<script type="text/javascript" src="js/sdmenu/sdmenu.js"/></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
</head>

<body>
	<table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#EFEFEF" >
      <tr>
        <td height="26" background="images/topbar_bg.gif"><img src="images/tentative_inline.gif" width="12" height="14" align="absmiddle"> 登入資訊</td>
      </tr>
      <tr>
        <td><img src="images/i_group.gif" alt="群組" width="22" height="22" align="absmiddle"> <span class="td11"><?=view_kind("'".$sec_user_level."'","cmu_admin_group","User_Level","GP_Cname")?></span><br>
        <img src="images/i_person.gif" alt="姓名" width="22" height="22" align="absmiddle"> <span class="td11"><?=$sec_user_name?></span><br>
        <img src="images/i_edit_info.gif" alt="編輯個人資料" width="22" height="22" align="absmiddle"> <span class="td11"><a href="power/power_edit.php?act=mdy&AD_ID=<?=$ad_id;?>&from=<?=y?>" target="mainAREA">編輯個人資料</a></span><br>
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
    
      
<div style="float: left" id="my_menu" class="sdmenu">
<?
// 
$count = 0;
$menu_key=$_GET['menu_key'];
//主選單
$query_a = "SELECT * FROM cmu_menu ORDER BY Align DESC";
$result_a = mysql_query($query_a);
if(mysql_num_rows($result_a) >= 1):

while($row_a=mysql_fetch_array($result_a)){
	
	$MU_ID = $row_a['MU_ID'];
	$User_Level=$row_a['User_Level'];
	//主選單權限
	$main_menu=explode(",",$User_Level);
	$g_Key=array_search ($sec_user_level,$main_menu);
	$key_G_chk = strlen($g_Key);
	if ($key_G_chk):
	$count = $count + 1;
?>
<div>
        <span><?=$row_a['Title']?></span>
<?	//次選單
//次選單資料表
$query_b = "SELECT * FROM cmu_menu_group WHERE MU_ID ='$MU_ID' ORDER BY MU_ID";
$result_b = mysql_query($query_b);
if(mysql_num_rows($result_b) >= 1):
	while($row_b=mysql_fetch_array($result_b)){
	
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
        <a href="#" onClick="top.frames['mainAREA'].location.href ='<?=$Link?>'"><?=$Sub_Tilte?></a>
		<?   
		endif;
	} //while_end
endif;
?>
</div>
<?
endif;
}
endif;
?>
</div>

</body>
</html>
