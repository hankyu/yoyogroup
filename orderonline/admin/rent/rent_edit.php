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
require_once("../Common/class.ResizeImg.php");

//基本設定
$CLASS["DB"] = new xfunDB_sql;
$CLASS["DB"]->connect(); 
$SubmitURL = "rent_submit.php";
$ExitURL = "rent_adm.php";
$TITLE = "訂房資料修改";		//主標題

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="News_Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<?=$js?>
<?
//群組判斷
if($sec_user_level!="X"):
	echo "<script language='javascript'>redirectURL('您沒有該權限，請離開！','../main.php')</script>";
endif;
?>

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
 return (true); 
} 
-->
</SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<?
$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] WHERE rentNum =".$id;
$CLASS["DB"]->query($result_num);
$total = $CLASS["DB"]->num_rows($CLASS["DB"]->result);	//總筆數
if($total >= 1):
$row = $CLASS["DB"]->fetch_array($CLASS["DB"]->result);
$lan=$row['lan'];
$projNum=$row['projNum'];
$projName=$row['projName'];
$rentPrice=$row['rentPrice'];
$en_projName=$row['en_projName'];
$en_rentPrice=$row['en_rentPrice'];
$display=$row['display'];
$rentDiscribe=$row['rentDiscribe'];
$shortDiscribe=$row['shortDiscribe'];
$en_rentDiscribe=$row['en_rentDiscribe'];
$en_shortDiscribe=$row['en_shortDiscribe'];
endif;
?>
<body>
<form id="theForm" name="theForm" method="post" enctype="multipart/form-data" onSubmit="return check(this)" action="<?=$SubmitURL?>">
<table width="100%" border="1" cellpadding="3" cellspacing="0" bgcolor="#EFEFEF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
  <tr>
    <td width="519" bgcolor="#CCCCCC"><strong><?=$TITLE?></strong></td>
  </tr>
  <tr bordercolor="#EFEFF7">
    <td>
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
      <tr>
        <td bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">語系*</td>
        <td>中文</td>
        <td>英文</td>
      </tr>
      <tr>
        <td width="87" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房型編號*</td>
        <td colspan="2"><input name="projNum" type="text" id="projNum" size="20" value="<?=$projNum?>" readonly style="background-color:#CCFFFF; border:thin" /></td>
      </tr>
      <tr>
        <td bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房型名稱 *</td>
        <td width="435"><input name="projName" type="text"  id="projName" size="40" value="<?=$projName?>" /></td>
        <td width="448"><input name="en_projName" type="text"  id="en_projName" size="40" value="<?=$en_projName?>" /></td>
      </tr>
      <tr>
        <td bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房型定價 *</td>
        <td colspan="2"><input name="rentPrice" type="text" class="option02" id="rentPrice" value="<?=$rentPrice?>" /></td>
        </tr>
      <tr>
        <td valign="top" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">開放與否</td>
        <td colspan="2"><input name="display" type="radio" value="Y" <?=$display=="Y"?"checked":""?> />
開放
  <input name="display" type="radio" value="N" <?=$display=="N"?"checked":""?>/>
不開放</td>
      </tr>
      <tr>
        <td rowspan="2" valign="top" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房間說明</td>
        <td colspan="2"><div style="color:#CC0000">註：請勿直接從WORD將文字貼上，因為WORD裡面會有一些特殊編碼造成程式錯誤，建議先將文字貼至記事本在行貼上編輯器中！</div></td>
        </tr>
      <tr>
        <td><?php
$sBasePath = "../fckeditor/";//$_SERVER['PHP_SELF'] ;
$oFCKeditor = new FCKeditor('rentDiscribe') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $rentDiscribe ;
$oFCKeditor->Create() ;
?></td>
        <td><?php
$sBasePath = "../fckeditor/";//$_SERVER['PHP_SELF'] ;
$oFCKeditor = new FCKeditor('en_rentDiscribe') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $en_rentDiscribe ;
$oFCKeditor->Create() ;
?></td>
      </tr>
      <tr>
        <td valign="top" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">房間簡述</td>
        <td><textarea name="shortDiscribe" cols="50" rows="10" id="shortDiscribe"><?=$shortDiscribe?></textarea></td>
        <td><textarea name="en_shortDiscribe" cols="50" rows="10" id="en_shortDiscribe"><?=$en_shortDiscribe?></textarea></td>
      </tr>
    </table>
      <table width="100%" border="1">

      <tr bgcolor="#F4F4FF">
        <td align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
		<input name="Submit2" type="button" class="input02" onClick="location.href='<?=$ExitURL?>?show=<?=$show?>'" value=" 離開 ">
          <input name="Submit" type="submit" class="input02" value=" 修改 " />
          <input type="hidden" name="act" value="update" />
          <input type="hidden" name="id" value="<?=$id?>" />
          <input name="PB_page" type="hidden" id="PB_page" value="<?=$PB_page?>"></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
