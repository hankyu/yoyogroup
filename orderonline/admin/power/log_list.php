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
$SUBTITLE = "系統執行記錄列表";		//次標題
$msg = array(
'no_result' => '尚無紀錄。'

);

$show = htmlspecialchars(trim($HTTP_GET_VARS['show']));	//換頁
$search_str = htmlspecialchars(trim($HTTP_POST_VARS['search_str']));//輸入查詢
	
$CLASS["db"]->query("SELECT * FROM xfun_log  ORDER BY log_num DESC");

//跳頁選單***************************************************
  $limit =30;	//每頁筆數
  
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
  $CLASS["db"]->query("SELECT * FROM xfun_log ORDER BY log_num DESC LIMIT $show,$limit");

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
    <td align=left valign=middle bgcolor="#F6F6F6"><font size=2><img src="../images/icon09.gif" width="14" height="19" align="absmiddle"><?
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
    <td bgcolor="#CCCCCC">執行動作</td>
    <td width="20%" bgcolor="#CCCCCC">執行者帳號</td>
    <td bgcolor="#CCCCCC">動作日期</td>
	</tr>
<?PHP
  $n = 0;
  if($total >= 1):
  while ($row = $CLASS["db"]->fetch_array($CLASS["db"]->result)) {
  	$n = $n + 1;
	$log_num = $row["log_num"];
	$log_name = $row["log_name"];
	$log_user = $row["log_user"];
	$cdate = $row["cdate"];
?>
<DIV class=info id=tttip<?=$AD_ID?>>密碼：<?=$PSW?></DIV>
  <tr align="center" onMouseOver="this.style.backgroundColor='#e7f2fa';" onMouseOut="this.style.backgroundColor='';">
    <td><?=$n?></td>
    <td align="left" style="padding-left:20px"><?=$log_name?></td>
    <td><?=$log_user?></td>
    <td><?=$cdate?></td>
	</tr>  
<?
  }  //while_end
  $CLASS["db"]->free_result($CLASS["db"]->result);
  else:
?>
  <tr align="center">
    <td colspan="4"><font color=red><?=$msg["no_result"]?></font></td>
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
