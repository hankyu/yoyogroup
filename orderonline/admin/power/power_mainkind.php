<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
//基本設定
$CLASS["menu"] = new xfunDB_sql;
$CLASS["menu"]->connect(); 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
<SCRIPT language=JavaScript>
<!--
function check(form1)
{
  if (document.form1.XFUN_menu_input.value == "")
  {
    alert("請輸入主選單類別名稱！");
    document.form1.XFUN_menu_input.focus();
    return (false);
  }
  if (document.form1.Floder.value == "")
  {
    alert("請輸入功能資料夾名稱！");
    document.form1.Floder.focus();
    return (false);
  }
  return  true;  
}
-->
</SCRIPT>
</head>
<link href="../js/type.css" rel="stylesheet" type="text/css" />
<body>
<?
$CLASS["menu"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] ORDER BY MU_ID DESC");
$total = $CLASS["menu"]->num_rows($CLASS["menu"]->result);	//總筆數
?>

<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr class="title2"> 
    <td colspan="2" align="center" valign="middle" bgcolor="#CCCCCC">
      <strong>新增主選單類別</strong>    </td>
  </tr>
<form id="form1" name="form1" method="post" action="power_submit.php" onSubmit="return check(this)">
  <tr>
    <td width="121" bgcolor="#FFFFFF">輸入類別名稱*</td>
    <td bgcolor="#FFFFFF"><input name="XFUN_menu_input" type="text" class="input" id="XFUN_menu_input" /></td>
    </tr>
  <tr>
    <td bgcolor="#FFFFFF">功能資料夾*</td>
    <td bgcolor="#FFFFFF"><input name="Floder" type="text" class="input" id="Floder" />
      <span class="option01">*請注意大小寫有別</span></td>
    </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" class="input02" value=" 新增 "/>
      <input type="hidden" name="process" value="main_menu">
      <input type="hidden" name="act" value="insert">
	  </td>
    </tr>
</form>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF">
	<table width='100%' border="1"  align=center cellpadding=3 cellspacing=0 bordercolorlight=#C0C0C0 bordercolordark=#ffffff>
      <form id="form2" name="form2" method="post" action="power_submit.php" onSubmit="return check(this)">
        <tr bgcolor="#D8D8D8">
          <td width="11%" align="center">#</td>
          <td width="38%">主選單類別名稱</td>
          <td width="37%">功能資料夾</td>
          <td width="14%" align="center">編輯</td>
        </tr>
<?
if($total >= 1):
$i=0;
while ($result = $CLASS["menu"]->fetch_array($CLASS["menu"]->result)) {
$i++;
?>
        <tr onMouseOver="this.style.backgroundColor='#e7f2fa';" onMouseOut="this.style.backgroundColor='#FFFFFF';">
          <td align="center"><a name="p<?=$i?>"></a>
              <?=$i?></td>
          <td><?
	$kind_id=$result['MU_ID'];
	$kind_title=$result['Title'];
	$Floder=$result['Floder'];
	if($_GET['edit']==$kind_id):
	echo "<input name=kind_title type=text value='$kind_title'>";
	else:
	echo $kind_title;
	endif;
	?>          </td>
          <td>
	<?
	if($_GET['edit']==$kind_id):
	echo "<input name=Floder type=text value='$Floder'>";
	else:
	echo $Floder;
	endif;
	?>		  </td>
          <td align="center"><? if($_GET['edit']==$kind_id):
	echo "<a href='#' onClick='document.form2.submit()' >確認</a>
    / <a href=$phpself#p$i>取消</a>
	<input name=\"act\" type=\"hidden\" value=\"update\" />
	<input name=\"process\" type=\"hidden\" value=\"main_menu\" />
	<input name=\"kind_id\" type=\"hidden\" value=\"$kind_id\" />";
    else:
	echo "<a href=$phpself?edit=$kind_id#p$i>修改</a>
    / <a href=\"JavaScript:chkdel('power_submit.php?kind_id=$kind_id&act=delete&process=main_menu')\">
	刪除</a>";
    endif;
}
endif;
?>          </td>
        </tr>
      </form>
    </table>	</td>
  </tr>
</table>
</body>
</html>
