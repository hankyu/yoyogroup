<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");

$TITLE = "使用者管理系統";		//主標題
$SUBTITLE = "新增使用者帳號";		//次標題


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE ?></title>
<?=$js?>
<script type="text/JavaScript">
<!--
//去左右空白
function trims(strvalue) { 
	ptntrim = /(^\s*)|(\s*$)/g; 
	return strvalue.replace(ptntrim,""); 
} 
//If our user enters data in the username input, then we need to enable our button
function OnCheckAvailability(a)
{
if(window.XMLHttpRequest)
{
oRequest = new XMLHttpRequest();
}
else if(window.ActiveXObject)
{
oRequest = new ActiveXObject("Microsoft.XMLHTTP");
}
if (a == "chkid"){
oRequest.open("POST", "power_idchk.php", true);
oRequest.onreadystatechange = UpdateCheckAvailability;

oRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
oRequest.send("strCmd=availability&strUsername=" + document.reg.ID.value);
}
}

function UpdateCheckAvailability()
{
if(oRequest.readyState == 4)
{ 
if(oRequest.status == 200)
{

var saa=trims(oRequest.responseText);
var id_char=document.reg.ID.value;
if (saa=="error"){
document.getElementById("Available").innerHTML = "<font class=option01>帳號重複，請重新輸入！</font>";
document.reg.ID.value="";
}else if(id_char.length < 6){
document.getElementById("Available").innerHTML = "<font class=option01>帳號太短需大於六個英文數字的組合！</font>"+saa;
}else{
document.getElementById("Available").innerHTML = "<font class=option03>帳號OK！</font>"+saa;
}
}
else
{
document.getElementById("Available").innerHTML = "<font class=option01>非同步傳輸錯誤</font>";
}
}
}

//-->
</script>

<SCRIPT language=JavaScript>
<!--
function check(theForm)
{
  if (document.reg.ID.value == "")
  {
    alert("「帳號」不得為空白！");
    document.reg.ID.focus();
    return (false);
  }

  if (document.reg.PSW.value == "")
  {
    alert("「密碼」不得為空白！");
    document.reg.PSW.focus();
    return (false);
  }
  
  if (document.reg.PSW.value != document.reg.PSW2.value)
  {
    alert("「確認密碼」和「密碼」不同！");
	document.reg.PSW.value=""
	document.reg.PSW2.value=""
    document.reg.PSW.focus();
    return (false);
  }
  
  if (document.reg.Name.value == "")
  {
    alert("「姓名」不得為空白！");
    document.reg.Name.focus();
    return (false);
  }
  
  if (reg.AD_Group.value=="")
  {
    alert("請選擇權限類別！");
    document.reg.AD_Group.focus();
    return (false);
  }

  if(document.reg.Email.value != ""){
     crucial=document.reg.Email.value.indexOf("@");
      if(crucial == -1)
      {
         alert("請檢查你的電子信箱？");
         document.reg.Email.value='';
         document.reg.Email.focus();
         return false;
      }
  } 
  return (true); 
} 
-->
</SCRIPT>
<link rel="stylesheet" type="text/css" media="all" href="../jcalendar/calendar-blue.css" title="brown" />
<script type="text/javascript" src="../jcalendar/calendar.js"></script>
<script type="text/javascript" src="../jcalendar/lang/calendar-big5.js"></script>
<script type="text/javascript" src="../jcalendar/calendar-setup.js"></script>

</head>
<body>
<form ACTION="power_submit.php" METHOD="POST"  name="reg" style="margin:0px;" onSubmit="return check(this)">
<table width="62%" border="1" cellpadding="2" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
      <tr class="title2"> 
        <td height="26" bgcolor="#CCCCCC"> 
        <div align="center"><strong class="style2">‧<?=$SUBTITLE?>‧</strong></div></td>
    </tr>
      <tr> 
        <td height="234" valign="top" bgcolor="#EBEBEB"><table width='100%' border="1"  align=center 
                        cellpadding=3 cellspacing=0 
                    bordercolorlight=#C0C0C0 bordercolordark=#ffffff>
            <tr bgcolor="#F7F7F7"> 
              <td colspan="4" align="left" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px"><strong>帳號資料</strong></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td width="17%" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">使用者帳號<font color="#FF0000">*</font></td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
			  <input name="ID" type="text" class="from_write" id="ID" size="20" onChange="OnCheckAvailability('chkid');">
(6~8個的英文字或數字的組合)
<div id="Available"></div></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">使用者密碼<font color="#FF0000">*</font></td>
              <td width="32%" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><input name="PSW" type="password"  class="from_write" id="PSW" value="" size="20" ></td>
              <td width="14%" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">確認密碼<font class="b" color="#FF3300">*</font></td>
              <td width="37%" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><input name="PSW2" type="password"  class="from_write " id="PSW2" value="" size="20" ></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td colspan="4" align="left" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px"><strong>基本資料</strong></td>
            </tr>
            <tr bgcolor="#F7F7F7"> 
              <td valign="top" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">使用者名稱<font color="#FF0000">*</font></td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><input name="Name" type="text"  class="from_write " id="Name" size="40" ></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">使用者類別<font color="#FF0000">*</font></td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><font class=b color="#000000">
<?
	$CLASS["sdb"] = new xfunDB_sql;
	$CLASS["sdb"]->connect(); 
	echo get_ADGPsel($AD_Group,$XFUN_TBL[TABLE_XFUN_admin_group]);
?>              </font></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">使用者電話</td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><input name="Phone" type="text" id="Phone"></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">使用者信箱</td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><input name="Email" type="text"  class="from_write " id="Email" size="40" ></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">停權/授權<font color="#FF0000">*</font></td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><input name="Usr_Lock" type="radio" value="Yes" checked>
授權
  <input name="Usr_Lock" type="radio" value="No">
              停權</td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">上下線日期</td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
                從
                      <input name="S_Date" type="text" id="S_Date" size="15" readonly>
<img src="../js/jcalendar/images/calendar.gif" alt="選擇日期" name="f_trigger_c" width="16" height="16" border="0" id="f_trigger_c" style="cursor: pointer; border: 0px solid red;" title="Date selector"
      onmouseover="window.status='跳出行事曆以選擇日期';return true" onMouseOut="window.status='';return true;" />
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "S_Date",     // id of the input field
        ifFormat       :    "%Y-%m-%e",     // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
	  
               到
               <input name="E_Date" type="text" id="E_Date" size="15" readonly>  
<img src="../js/jcalendar/images/calendar.gif" alt="選擇日期" width="16" height="16" border="0" id="e_trigger_c" style="cursor: pointer; border: 0px solid red;" title="Date selector"
      onmouseover="window.status='跳出行事曆以選擇日期';return true" onMouseOut="window.status='';return true;" />
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "E_Date",     // id of the input field
        ifFormat       :    "%Y-%m-%e",     // format of the input field
        button         :    "e_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
			   
              止<br>
              <span class="Lword0301">*如果不設定日期則帳號永遠有效，若有設定日期則日期的權限會大於停權權限。</span></td>
            </tr>
            <tr bgcolor="#F7F7F7"> 
              <td height="28" colspan="4" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">                <div align="center"> 
                  <input name="Submit" type="submit" class="input02" value=" 新增 ">
                  <input name="Submit2" type="reset" class="input02" value=" 清除 ">
                  <input name="act" type="hidden" id="act" value="insert">
                  <input name="precess" type="hidden" id="precess" value="adm">
              </div></td>
            </tr>
          </table>
        </td>
      </tr>
  </table>
</form>
</body>
</html>
