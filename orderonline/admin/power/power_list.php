<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
?>
<?
//基本設定
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
$CLASS["group"] = new xfunDB_sql;
$CLASS["group"]->connect(); 
$TITLE = "使用者管理系統";		//主標題
$SUBTITLE = "使用者列表";		//次標題
$msg = array(
'no_result' => '尚無使用者資料，請新增。'

);

$show = htmlspecialchars(trim($HTTP_GET_VARS['show']));	//換頁
$search_str = htmlspecialchars(trim($HTTP_POST_VARS['search_str']));//輸入查詢
	
  if(!empty($ID)){
  $query_where1="WHERE User_Level='$ID'";
  //$query_where1="WHERE User_Level='$ID' and ID!='xfun'";
  }else{
 // $query_where1="WHERE ID!='xfun'";
  }
  if(!empty($sID)){
  $query_where1.=" AND User_Level=$sID";
  }
  

$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_admin] $query_where1 ORDER BY AD_ID ASC");

//跳頁選單***************************************************
  $limit =20;	//每頁筆數
  
  //索引序號
  if(!empty($show)):
  	$count = ($show/$limit + 1) * $limit - $limit;
  else:
  	$show = 0; $count = 0;
  endif;

  $total = $CLASS["db"]->num_rows($CLASS["db"]->result);					//總筆數
  $pageNum = $total % $limit == 0 ? $total/$limit : floor($total/$limit)+1; //總頁數

  $next = $show + $limit;  	//下一頁
  $back = $show - $limit;  	//上一頁
	
  //直接跳到第iNum頁
  $iNum = 1; //目前頁次
  $option = "<select onChange=\"location.href=this.options[this.selectedIndex].value;\">";
  for($i=0;$i < $total;$i++){
	$iNum = $i/$limit + 1;
	if($i == $show){
		$option .= "<option value=\"".$phpself."?show=".$show."\"selected>第".$iNum."頁</option>";
	}else{
		$option .= "<option value=\"".$phpself."?show=".$i."\">第".$iNum."頁</option>";
	}
	$i = $i + $limit - 1;
  }
  $option .= "</select>";
  //echo "select * from cmu_news  ".$query_where1.$query_where2;
  $CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_admin] $query_where1 ORDER BY AD_ID DESC LIMIT $show,$limit");

?>

<html><head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
<style type="text/css">
<!--
.style11 {color: #333333}
-->
</style>
<STYLE type=text/css>.ttip {
	CURSOR: hand; BORDER-BOTTOM: #000000 1px dashed
}
.info {
	BORDER-RIGHT: #000000 1px solid; PADDING-RIGHT: 2px; BORDER-TOP: #000000 1px solid; DISPLAY: none; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; BORDER-LEFT: #000000 1px solid; WIDTH: 90px; PADDING-TOP: 2px; BORDER-BOTTOM: #000000 1px solid; BACKGROUND-COLOR: #ccffcc
}
</STYLE>
<SCRIPT src="../js/js_tooltips.js" type=text/javascript></SCRIPT>
</head>
<body bgcolor="#FFFFFF">
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr bgcolor="#CCCCCC" class="title2"> 
    <td height="8" align="center" nowrap> 
     <strong class="style2">‧<?=$SUBTITLE?>‧</strong></td>
  </tr>
</table>    
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#EFEFEF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
  <tr>
    <td align=left valign=middle bgcolor="#F6F6F6"><font size=2><img src="../images/icon09.gif" width="14" height="19" align="absmiddle"> 請選擇使用者類別：
        <select name="news_kind" class="option02" id="news_kind" onChange="location.href=this.options[this.selectedIndex].value">
    	<option value="<?=$phpself?>">全部</option>
		<? 
	$CLASS["group"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_admin_group] ORDER BY GP_ID ASC");
	$total_a = $CLASS["group"]->num_rows($CLASS["group"]->result);	//總筆數
	if($total_a >= 1):
		while ($row = $CLASS["group"]->fetch_array($CLASS["group"]->result)) {
			$User_Level=$row["User_Level"];
			$GP_Cname=$row["GP_Cname"];
			if ($User_Level==$ID){
	        echo "<option value='$phpself?ID=$User_Level' selected>$GP_Cname</option>";
			}else{
	        echo "<option value='$phpself?ID=$User_Level' >$GP_Cname</option>";
			}
		  }
		  endif;
		?>	
</select>
 <?
  echo " 共有 <font color=red>".$total."</font> 筆資料　";
  if($show > 0){
	echo "<a href=\"".$phpself."?$pg_link&show=".$back."\">上一頁</a> ";
  }
  if($next < $total){
	echo "<a href=\"".$phpself."?$pg_link&show=".$next."\">下一頁</a> ";
  }
  ?>
  <?=$option?>/共 <font color=red><?=$pageNum?></font> 頁
  <input name="ID" type="hidden" id="ID" value="<?=$ID?>">
</font></td>
  </tr></table>
<table width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
<tr>
<td align="center" valign="top">
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
  <tr align="center" bgcolor="#065F93" class="style1">
    <td width="2%" bgcolor="#CCCCCC">#</td>
    <td width="9%" bgcolor="#CCCCCC">使用者類別</td>
    <td width="15%" bgcolor="#CCCCCC">使用者名稱</td>
    <td width="16%" bgcolor="#CCCCCC">使用者帳號</td>
    <td width="23%" bgcolor="#CCCCCC">使用者信箱</td>
    <td width="20%" bgcolor="#CCCCCC">授權/停權</td>
    <td width="8%" bgcolor="#CCCCCC">建檔日期</td>
	<td width="7%" bgcolor="#CCCCCC">編輯</td>
  </tr>
<?PHP
  $n = 0;
  if($total >= 1):
  while ($row = $CLASS["db"]->fetch_array($CLASS["db"]->result)) {
  	$n = $n + 1;
	$AD_ID = $row["AD_ID"];
	$Name = $row["Name"];
	$ID = $row["ID"];
	$PSW = $row["PSW"];
	$Email = $row["Email"];
	$Usr_Lock = $row["Usr_Lock"];
	$C_Date = $row["C_Date"];
	$User_Level = $row["User_Level"];
	$Class_room = $row["Class_room"];
?>
<DIV class=info id=tttip<?=$AD_ID?>>密碼：<?=$PSW?></DIV>
  <tr align="center" onMouseOver="this.style.backgroundColor='#e7f2fa';" onMouseOut="this.style.backgroundColor='';">
    <td><?=$n?></td>
    <td><?=view_kind("'".$User_Level."'","xfun_admin_group","User_Level","GP_Cname")?></td>
    <td><?=$Name?></td>
    <td><span class=ttip id=ttip<?=$AD_ID?>><?=$ID?></span></td>
    <td><?=GetMailBtn($Email)?></td>
    <td>
	  <?
	if($Usr_Lock=="Yes"):
echo "<a href=\"#\"><img src=\"../images/on.gif\" alt=\"復權\" width=\"13\" height=\"13\" border=\"0\"></a> <a href=\"power_submit.php?act=show&s=No&AD_ID=$AD_ID&show=$show\"> <img src=\"../images/off2.gif\" alt=\"除權\" width=\"13\" height=\"13\" border=\"0\"></a>";
	elseif($Usr_Lock="No"):
echo "<a href=\"power_submit.php?act=show&s=Yes&AD_ID=$AD_ID&show=$show\"><img src=\"../images/on2.gif\" alt=\"復權\" width=\"13\" height=\"13\" border=\"0\"></a> <a href=\"#\"><img src=\"../images/off.gif\" alt=\"除權\" width=\"13\" height=\"13\" border=\"0\"></a>";
	endif;
	?>	</td>
    <td><?=$C_Date?></td>
	<td><a href="power_edit.php?act=mdy&AD_ID=<?=$AD_ID; ?>&show=<?=$show?>"><img src="../images/edit.gif" alt="修改該筆資料" width="16" height="16" border="0"></a> 
	<? 
	if ($sec_id!=$ID){
	//if ($sec_id=="yes"){
	?>
	<a href="JavaScript:Del_Confirm('power_submit.php?act=delete&precess=adm&AD_ID=<?=$AD_ID?>&show=','<?=$show?>','您確定刪除此資料?')"><img src="../images/del2.gif" alt="刪除該筆資料" width="16" height="16" border="0"></a>
	<? }?>	</td>
  </tr>  
<?
  }  //while_end
  $CLASS["db"]->free_result($CLASS["db"]->result);
  else:
?>
  <tr align="center">
    <td colspan="8"><font color=red><?=$msg["no_result"]?></font></td>
  </tr>
<? endif;?>
</table>
    </td>
  </tr>
<?PHP
  echo "<tr bgcolor=\"#F7F7F7\"><td><table border=0 cellpadding=4 cellspacing=2 align=center width=100%>\n";	
  echo "<tr align=right>\n";
  echo "  <td colspan=6><font size=2>";
  echo "共有 <font color=red>".$total."</font> 筆資料　";
  if($show > 0){
	echo "<a href=\"".$phpself."?show=".$back."\">上一頁</a> ";
  }
  if($next < $total){
	echo "<a href=\"".$phpself."?show=".$next."\">下一頁</a> ";
  }
  echo $option." /共 <font color=red>".$pageNum."</font> 頁</font></td>\n";
  echo "</tr>\n";
  echo "</table></td></tr>\n";
?>
</table>
</body>
</html>                                                                                               
