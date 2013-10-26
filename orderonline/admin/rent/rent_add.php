<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
include("../fckeditor/fckeditor.php") ;

$CLASS["rent_kind"] = new xfunDB_sql;
$CLASS["rent_kind"]->connect(); 
$SubmitURL="rent_submit.php";
$TITLE = "訂房資料新增";		//主標題

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$TITLE?></title>
<?=$js?>
<script language="javascript">
<!--
//去左右空白
function trims(strvalue) { 
	ptntrim = /(^\s*)|(\s*$)/g; 
	return strvalue.replace(ptntrim,""); 
} 


//If our user enters data in the username input, then we need to enable our button
function OnCheckAvailability()
{
	if(window.XMLHttpRequest)
	{
		oRequest = new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		oRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}
		oRequest.open("POST", "rent_idchk.php", true);
		oRequest.onreadystatechange = UpdateCheckAvailability;
		oRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		oRequest.send("strCmd=availability&strprojNum=" + document.getElementById('projNum').value);
}

function UpdateCheckAvailability()
{
	if(oRequest.readyState == 4)
	{ 
		if(oRequest.status == 200)
		{
			saa=trims(oRequest.responseText);
				if (saa=="error"){
					document.getElementById("Available").innerHTML = "<font class=option01>專案編號重複，請重新輸入！</font>";
					document.getElementById("projNum").value="";
				}else{
					document.getElementById("Available").innerHTML = "<font class=option03>專案編號OK！</font>";
					var projNum=document.theForm.projNum.value;
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
    //圖片預覽
    function preViewIMG(src,id){
        document.getElementById(id).style.display="";
        document.getElementById(id).filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src =src;
    }
</script>
<SCRIPT language=JavaScript>
<!--
function check(theForm)
{
  if (document.theForm.projNum.value == "")
  {
    alert("專案編號尚未填寫？");
    document.theForm.projNum.focus();
    return (false);
  }
  
  if (document.theForm.projName.value == "")
  {
    alert("專案名稱尚未填寫？");
    document.theForm.projName.focus();
    return (false);
  }
  
  if (document.theForm.rentPrice.value == "")
  {
    alert("房價尚未填寫？");
    document.theForm.rentPrice.focus();
    return (false);
  }
  if(document.theForm.rentPrice.value != ""){
    cltxt=document.theForm.rentPrice.value;
	for (i=0;i<cltxt.length;i++)
	{
	  c=cltxt.charAt(i);
	  if ("0123456789".indexOf(c,0)<0)
	  {
	  alert("房價請輸入阿拉伯數字");
	  document.theForm.rentPrice.focus();
	  document.theForm.rentPrice.value = "";
	  return (false);
	  }
	}
  }

  if (document.theForm.Img.value != "" && document.theForm.Img.value != ""){
  last2 = document.theForm.Img.value.match(/^(.*)(\.)(.{1,8})$/)[3]; 
  if ( last2!="jpg"  &&  last2!="jpeg"  &&  last2!="png" && last2!="JPG"  &&  last2!="JPEG"  &&  last2!="PNG" ){
      alert("圖片文件格式錯誤!!!");
      return (false);
    }
  }

 return (true); 
} 
-->
</SCRIPT>

</head>
<body>
<form id="theForm" name="theForm" method="post" enctype="multipart/form-data" onSubmit="return check(this)" action="<?=$SubmitURL?>">
<table width="100%" border="1" cellpadding="3" cellspacing="0" bgcolor="#EFEFEF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
  <tr class="title2">
    <td align="center" bgcolor="#CCCCCC"><strong><?=$TITLE?></strong></td>
  </tr>
  <tr bordercolor="#EFEFF7">
    <td>
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
      <tr >
        <td bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">語系*</td>
        <td>中文</td>
        <td>英文</td>
      </tr>
      <tr >
        <td width="80" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房型編號 *</td>
        <td colspan="2"><input name="projNum" type="text" id="projNum" size="40"  onBlur="OnCheckAvailability();"/><div id="Available"></div></td>
        </tr>
      <tr>
        <td bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房型名稱 * </td>
        <td width="409"><input name="projName" type="text"  id="projName" size="40" /></td>
        <td width="408"><input name="en_projName" type="text"  id="en_projName" size="40" /></td>
      </tr>
      <tr>
        <td valign="top" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房型定價 * </td>
        <td colspan="2"><input name="rentPrice" type="text" id="rentPrice" /></td>
        </tr>
      <tr>
        <td valign="top" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">開放與否</td>
        <td colspan="2"><input name="display" type="radio" value="Y" checked="checked" />
          開放
          <input name="display" type="radio" value="N" />
          不開放</td>
        </tr>
      <tr>
        <td valign="top" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房間圖片</td>
        <td colspan="2"><div title="圖片預覽" id="myImg" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);width:150px;height:100px;display: none"></div> <!--onchange= "preViewIMG(this.value,'myImg')"-->
          <input name="Img" type="file" class="td12" id="Img" size="40"  />
          <!--圖片大小 120W x 90H ，-->          圖片規格 jpg、 png ，檔案規格請使用符合網頁格式的檔案，檔案大小請盡量控制在1M上下(請勿上傳GIF檔)。 </td>
      </tr>
      <tr>
        <td rowspan="2" valign="top" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房間說明</td>
        <td colspan="2"><div style="color:#CC0000">註：請勿直接從WORD將文字貼上，因為WORD裡面會有一些特殊編碼造成程式錯誤，建議先將文字貼至記事本在行貼上編輯器中！</div></td>
        </tr>
      <tr>
        <td><?php
$sBasePath = "../fckeditor/";//$_SERVER['PHP_SELF'] ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "fckeditor" ) ) ;

$oFCKeditor = new FCKeditor('rentDiscribe') ;
$oFCKeditor->BasePath	= $sBasePath ;
//$oFCKeditor->Value		= 'This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.' ;
$oFCKeditor->Create() ;
?></td>
        <td><?php
$sBasePath = "../fckeditor/";//$_SERVER['PHP_SELF'] ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "fckeditor" ) ) ;

$oFCKeditor = new FCKeditor('en_rentDiscribe') ;
$oFCKeditor->BasePath	= $sBasePath ;
//$oFCKeditor->Value		= 'This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.' ;
$oFCKeditor->Create() ;
?></td>
      </tr>
      <tr>
        <td valign="top" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房間簡述</td>
        <td><textarea name="shortDiscribe" cols="50" rows="10" id="news_note"></textarea></td>
        <td><textarea name="en_shortDiscribe" cols="50" rows="10" id="en_shortDiscribe"></textarea></td>
      </tr>
    </table>
      <table width="100%" border="1">

      <tr bgcolor="#F4F4FF">
        <td align="center" bordercolor="#FFFFFF" bgcolor="#EFEFEF"><span class="btn_ynws">
          <input name="Submit" type="submit" class="input02" value=" 新增 " />
        </span>
          <input type="hidden" name="act" value="insert" />
		 <input type="hidden" name="add_id" value="<?=$men_id?>" /> 
		  </td>
        </tr>
    </table></td>
  </tr>
</table>
</form>

</body>
</html>
