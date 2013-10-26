<?
include("../config.php");
include("../Common/js.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
include("../Common/functions.php");
?>
<?
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_admin] WHERE AD_ID=$AD_ID");
  $row = $CLASS["db"]->fetch_array($CLASS["db"]->result);
  	$n = $n + 1;
	$AD_ID = $row["AD_ID"];
	$Name = $row["Name"];
	$ID = $row["ID"];
	$PSW = $row["PSW"];
	$Phone = $row["Phone"];
	$Email = $row["Email"];
	$Usr_Lock = $row["Usr_Lock"];
	$C_Date = $row["C_Date"];
	$User_Level = $row["User_Level"];
	$Class_Year = $row["Class_Year"];
	$Class_room = $row["Class_room"];
	$S_Date = $row["S_Date"];
	$E_Date = $row["E_Date"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?PHP no_cache_header();?>
<title>無標題文件</title>
<?=$js?>
<script type="text/JavaScript">
 var req;
 /*
  * Get the second options by calling a Struts action
  */
 function retrieveSecondOptions(){
    
    kind_id = document.getElementById('kind_id');
    
    selectedOption = kind_id.options[kind_id.selectedIndex].value;
    //get the (form based) params to push up as part of the get request
    url="select_kind.php?kind_id="+selectedOption;
    //alert(url)
    //Do the Ajax call
	if(window.XMLHttpRequest)
	{
	req = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
	req = new ActiveXObject("Microsoft.XMLHTTP");
	}
      req.onreadystatechange = UpdateCheckSelectBox;
	  //req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      req.open("GET", url, true);
      req.send(null);
  }
  
function UpdateCheckSelectBox()
{
if(req.readyState == 4)
{ 
if(req.status == 200)
{
/*清除Select Option 裡面的值*/
obj = document.getElementById('oSelect1'); ///drp是select控件的ID值
for(i=obj.options.length-1 ; i>= 0 ; i--){
 obj.options[i] = null;
}
         textToSplit = req.responseText
		 
         if(textToSplit == 'no_result'){
			document.getElementById('oSelect1').options[0] = null;
			obj2 = document.getElementById('oSelect2'); ///drp是select控件的ID值
			for(i2=obj2.options.length-1 ; i2>= 0 ; i2--){
			 obj2.options[i2] = null;
			}
		 }else{
		 
		 //alert(textToSplit)
		 returnElements=textToSplit.split(",")
		 title=returnElements[0]
		 val=returnElements[1]
		 TotalTitle=title.split("|")
		 TotalVal=val.split("|")
		 //alert(TotalTitle.length)

		 selectedOption2 = document.getElementById('oSelect2');
		 //SelectOPVal=selectedOption2.split(",")
		 
		 for ( var i=0; i<TotalVal.length-1; i++ ){
             valueLabel_T = TotalTitle[i];
             valueLabel_V = TotalVal[i];
             document.getElementById('oSelect1').options[i] = new Option(valueLabel_T);
             document.getElementById('oSelect1').options[i].value = valueLabel_V;
			 //alert("---------")
          }
		 
		 } 
}
else
{
document.getElementById('oSelect1').options[0] = null;
//alert("非同步傳輸錯誤")
}
}
}

  
</script>

<SCRIPT language=JavaScript>
<!--
function check(theForm)
{
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
  
  if(document.reg.Email.value != ""){
     crucial=reg.Email.value.indexOf("@");
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
</head>
<body>
<form ACTION="power_submit.php" METHOD="POST"  name="reg" style="margin:0px;" onSubmit="return check(this)">
<table width="59%" height="262"border="1" align="left" cellpadding="3" cellspacing="0" bordercolorlight="#CCCCCC" bordercolordark="#ffffff" bgcolor="#FFFFFF">
      <tr class="title2"> 
        <td height="20" bgcolor="#CCCCCC"> 
        <div align="center"><strong>++ 編 輯 使 用 者 帳 號 ++</strong></div></td>
    </tr>
      <tr> 
        <td height="234" valign="top" bgcolor="#EBEBEB"><table width='100%' border="1"  align=center 
                        cellpadding=3 cellspacing=0 
                    bordercolorlight=#C0C0C0 bordercolordark=#ffffff>
            <tr bgcolor="#F7F7F7"> 
              <td colspan="4" align="left" bgcolor="#CCCCCC" style="PADDING-LEFT: 6px"><strong>帳號資料</strong></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td width="16%" bgcolor="#CCCCCC" style="PADDING-LEFT: 6px">使用者帳號<font color="#FF0000">*</font></td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><?=$ID?>
			  <input name="ID" type="hidden" class="from_write" id="ID"  value="<?=$ID?>" size="20"></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td bgcolor="#CCCCCC" style="PADDING-LEFT: 6px">使用者密碼<font color="#FF0000">*</font></td>
              <td width="31%" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
			  <input name="PSW" type="password"  class="from_write" id="PSW" value="<?=$PSW?>" size="20" ></td>
              <td width="12%" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">確認密碼<font class="b" color="#FF3300">*</font></td>
              <td width="41%" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
			  <input name="PSW2" type="password"  class="from_write " id="PSW2" value="<?=$PSW?>" size="20" ></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td colspan="4" align="left" bgcolor="#CCCCCC" style="PADDING-LEFT: 6px"><strong>基本資料</strong></td>
            </tr>
            <tr bgcolor="#F7F7F7"> 
              <td valign="top" bgcolor="#CCCCCC" style="PADDING-LEFT: 6px">使用者名稱<font color="#FF0000">*</font></td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
			  <input name="Name" type="text"  class="from_write " id="Name" value="<?=$Name?>" size="40" ></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#CCCCCC" style="PADDING-LEFT: 6px">使用者類別<font color="#FF0000">*</font></td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
<?
if ($sec_user_level=="X"):
	$CLASS["sdb"] = new xfunDB_sql;
	$CLASS["sdb"]->connect(); 
	echo get_ADGPsel($User_Level,$XFUN_TBL[TABLE_XFUN_admin_group]);
else:
    view_kind("'".$User_Level."'",$XFUN_TBL[TABLE_XFUN_admin_group],"User_Level","GP_Cname");	
	echo "<input name='AD_Group' type='hidden' id='AD_Group' value='$User_Level'>";
endif;	
?>			  </td>
            </tr>
<? 
if ($sec_user_level=="X"):
?>
<?
endif;
?>			
            <tr bgcolor="#F7F7F7">
              <td bgcolor="#CCCCCC" style="PADDING-LEFT: 6px">使用者電話</td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><input name="Phone" type="text" id="Phone" value="<?=$Phone?>"></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#CCCCCC" style="PADDING-LEFT: 6px">使用者信箱</td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px"><input name="Email" type="text"  class="from_write " id="Email" value="<?=$Email?>" size="40" ></td>
            </tr>
<? 
if ($sec_user_level=="X"):
?>			  
	         <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#CCCCCC" style="PADDING-LEFT: 6px">上下線日期</td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
			  從
                <input name="S_Date" type="text" id="S_Date" value="<?=$S_Date?>" size="15" readonly> 
                
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
<input name="E_Date" type="text" id="E_Date" value="<?=$E_Date?>" size="15" readonly>
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
<span class="Lword0301">*如果不設定日期則帳號永遠有效，若有設定日期則日期的權限會大於除權權限。</span></td>
</tr>
<?
else:
?>
<input name="S_Date" type="hidden" value="<?=$S_Date?>">
<input name="E_Date" type="hidden" value="<?=$E_Date?>">
<?
endif;
?>
            <tr bgcolor="#F7F7F7"> 
              <td height="28" colspan="4" bgcolor="#CCCCCC" style="PADDING-LEFT: 6px">
			  <div align="center"> 
                  <input name="Submit" type="submit" class="input02" value=" 修改 ">
              <? if ($sec_user_level=="X"):?>
			      <input name="Submit2" type="button" class="input02" onClick="location.href='power_list.php?show=<?=$show?>'" value=" 離開 ">			
			  <? endif;?>  
                  <input name="AD_ID" type="hidden" id="AD_ID" value="<?=$AD_ID?>">
                  <input name="act" type="hidden" id="act" value="update">
                  <input name="show" type="hidden" id="show" value="<?=$show?>">
                  <input name="from" type="hidden" id="from" value="<?=$from?>">
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
<?
$CLASS["db"]->free_result($CLASS["db"]->result);
?>