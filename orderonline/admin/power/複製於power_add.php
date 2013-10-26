<?
include("../config.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
include("../Common/functions.php");
include("../mysql_conn.php");
no_cache_header();

$TITLE = "使用者管理系統";		//主標題
$SUBTITLE = "新增使用者帳號";		//次標題


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE ?></title>
<link href="../js/type.css" rel="stylesheet" type="text/css">
<script type="text/JavaScript">
<!--
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

var saa=oRequest.responseText;
var id_char=document.reg.ID.value;
if (saa.length == 565){
document.getElementById("Available").innerHTML = "<font class=option01>帳號重複，請重新輸入！</font>";
document.reg.ID.value="";
}else if(id_char.length < 6){
document.getElementById("Available").innerHTML = "<font class=option01>帳號太短需大於六個英文數字的組合！</font>";
}else{
document.getElementById("Available").innerHTML = "<font class=option03>帳號OK！</font>";
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
<form ACTION="power_submit.php?act=add" METHOD="POST"  name="reg" style="margin:0px;" onSubmit="return check(this)">
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
			  <input name="ID" type="text" class="from_write" id="ID" size="20" onKeyUp="OnCheckAvailability('chkid');">
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
	echo get_ADGPsel($AD_Group);
?>              </font></td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td valign="top" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">班網管理<font color="#FF0000">*</font></td>
              <td colspan="3" bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<script language="javascript" type="text/javascript">  
    function choose(src, dst) {
        var oSelect1 = document.getElementById(src);
        var oSelect2 = document.getElementById(dst);
        
        var opts = new Array();           
        var i;                    
         
        for(i = 0; i < oSelect1.options.length; i++)
        {            
            var item = oSelect1.options[i];        
            if(item.selected) {
               opts.push(item);                
            }
        }       
        
        for(i = 0; i < opts.length; i++)
        {            
            var opt = document.createElement("<option>");
            opt.text = opts[i].text;
            opt.value = opts[i].value;
            opt.selected = opts[i].selected;
            if(navigator.appName == 'Microsoft Internet Explorer') {
                oSelect2.add(opt);
                //oSelect2.add(opt, null); // IE 不支持
                //oSelect2.appendChild(opt); // IE 不支持,可以添加，但是不顯示，^||^
            }
            else {
                //oSelect2.add(opt);      // firefox 不支持
                oSelect2.add(opt, null);                
                //oSelect2.appendChild(opt); // firefox 支持
            }
            oSelect1.removeChild(opts[i]);                    
        }
    }   
</script>
          <tr>
            <td height="16" colspan="3">
		<?
		  $year=date("Y")+1;
		  $id="kind_id";
		  $title="請選擇學年";
   		  $z = 1911;
		  	echo "<select name='$id' onChange='retrieveSecondOptions();'>\n";
			echo "	<option value='all' selected>" . $title . "</option>\n";
			echo "	<option value='' >全部</option>\n";
		  for($i=0;$i < 30; $i++) {
			echo "	<option value='" . ($year - $z) . "' >" . ($year - $z) . "</option>\n";
			 $z++;
		  }
		  	echo "</select>\n\n";
	  	?>
		   </td>
          </tr>
          <tr>
            <td>請選擇班級</td>
            <td width="7%" height="18" valign="top">&nbsp;</td>
            <td width="71%">管理的班網</td>
          </tr>
          <tr>
            <td width="22%" rowspan="2">
			<select id="oSelect1" name="oSelect1" size="10" multiple="multiple">
            </select>			</td>
            <td height="72" valign="top"><input name="button22" type="button" onClick="choose('oSelect2', 'oSelect1')" value="<<" /></td>
            <td width="71%" rowspan="2">
			<select id="oSelect2" name="oSelect2[]" size="10" multiple="multiple">
            </select>			</td>
          </tr>
          <tr>
            <td valign="bottom"><input name="button3" type="button" onClick="choose('oSelect1', 'oSelect2')" value=">>" /></td>
          </tr>
        </table>
			  </td>
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
<img src="../jcalendar/images/calendar.gif" alt="選擇日期" name="f_trigger_c" width="16" height="16" border="0" id="f_trigger_c" style="cursor: pointer; border: 0px solid red;" title="Date selector"
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
<img src="../jcalendar/images/calendar.gif" alt="選擇日期" width="16" height="16" border="0" id="e_trigger_c" style="cursor: pointer; border: 0px solid red;" title="Date selector"
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
              </div></td>
            </tr>
          </table>
        </td>
      </tr>
  </table>
</form>
</body>
</html>
