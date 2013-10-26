<?
include("../config.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
include("../Common/functions.php");
include("../mysql_conn.php");
no_cache_header();

//基本設定
$CLASS["menu"] = new xfunDB_sql;
$CLASS["menu"]->connect(); 
$TITLE = "選單功能管理系統";		//主標題
$SUBTITLE = "選單管理列表";		//次標題
$msg = array(
'no_result' => '尚無選單資料，請新增。'

);

//分頁設訂
require_once('../Common/page.class.php');
class mypage extends page
{
    function mypage($array)
 {
     parent::page($array);
  $this->first_page="|<";
  $this->last_page=">|";
  $this->set('format_left','');
  $this->set('format_right','');
 }
 
 function show()
 {
  $pagestr='<div class="pagenavi" id="lopage">頁:';
  $pagestr.=$this->first_page().' ';
  $pagestr.=$this->nowbar('','curr');
  $pagestr.='<span class="break">...</span>';
  $pagestr.=$this->last_page();
  $pagestr.='(總計<span class="num">'.$this->totalpage.'</span>頁) ';
  $pagestr.=$this->select();
  $pagestr.='</div>';
  return $pagestr;
 }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<link href="../js/type.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
/*分頁選單*/
.pagenavi { text-align:center;  font: 11px Arial, tahoma, sans-serif; padding-top: 20px; padding-bottom: 10px; margin: 0px; }
.pagenavi a {border: 1px solid #E2F1AF; background: #FFFFFF; text-decoration: none; color:#C16012; display:inline-block; padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px}
.pagenavi a:visited {border: 1px solid #E2F1AF; background: #FFFFFF; text-decoration: none; padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px}
.pagenavi .break {border: medium none;  text-decoration: none; color:#C16012; background:;; padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px}
.pagenavi .num {color:#C16012; font-size:12pt; padding-left:3px; padding-right:3px; padding-top:0; padding-bottom:0}
.pagenavi .curr {padding: 2px 6px; border-color: #999; font-weight: bold; font-size:12pt; background:transparent;}
.pagenavi a:hover {color: #C16012; background: #E2F1AF; text-decoration: none}
-->
</style>

<SCRIPT language=JavaScript>
<!--
function check(reg)
{

  if (document.reg.cmu_menu.value == "" && document.reg.cmu_menu_input.value == "")
  {
    alert("尚未選擇選單主項目或輸選單主項？");
    document.reg.cmu_menu.focus();
    return (false);
  }else if(document.reg.cmu_menu.value != "" && document.reg.cmu_menu_input.value != ""){
    alert("選擇選單主項與輸入選單主項只能擇其一？");
    document.reg.cmu_menu.focus();
    document.reg.cmu_menu_input.value="";
    return (false);
  }

  if (document.reg.sub_menu.value == "")
  {
    alert("「選單次選項」不得為空白！");
    document.reg.sub_menu.focus();
    return (false);
  }

  if (document.reg.url_link.value == "")
  {
    alert("「功能連結」不得為空白！");
    document.reg.url_link.focus();
    return (false);
  }
 
  return (true); 
} 
-->
</SCRIPT>
</head>
<body>

<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
      <tr class="title2"> 
        <td height="26" bgcolor="#CCCCCC"> 
        <div align="center"><strong class="style2">‧新增選單功能‧</strong></div></td>
    </tr>
      <tr> 
        <td valign="top" bgcolor="#EBEBEB">
<form ACTION="power_submit.php" METHOD="POST"  name="reg" style="margin:0px;" onSubmit="return check(this)">		
		<table width='100%' border="1"  align=center cellpadding=3 cellspacing=0 bordercolorlight=#C0C0C0 bordercolordark=#ffffff>
            <tr bgcolor="#F7F7F7">
              <td width="17%" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">選單主選項<font color="#FF0000">*</font></td>
              <td bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
  
    <select name="cmu_menu" id="cmu_menu">
	  <option value=""><?=$app_strings['COS_SELECT']?></option>
	<? 
	$sq=mysql_query("select * from cmu_menu");
	while($row=mysql_fetch_array($sq)){
	?>
	  <option value="<?=$row["MU_ID"]?>"><?=$row["Title"]?></option>
	<?
	}
	?>
  </select>
    或輸入
			  <input name="cmu_menu_input" type="text" class="from_write" id="cmu_menu_input" size="20">			  </td>
            </tr>
            <tr bgcolor="#F7F7F7">
              <td bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">選單次選項<font color="#FF0000">*</font></td>
              <td bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
			  <input name="sub_menu" type="text"  class="from_write" id="sub_menu" value="" size="20" ></td>
            </tr>
            <tr bgcolor="#F7F7F7"> 
              <td valign="top" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">功能連結<font color="#FF0000">*</font></td>
              <td bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
			  <input name="url_link" type="text"  class="from_write " id="url_link" size="50" ></td>
            </tr>
            <tr bgcolor="#F7F7F7"> 
              <td height="28" colspan="2" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">
			  <div align="center"> 
                  <input name="act" type="hidden" id="act" value="add_menu">
                  <input name="Submit" type="submit" class="input02" value=" 新增 ">
                  <input name="Submit2" type="reset" class="input02" value=" 清除 ">
              </div></td>
            </tr>
        </table>
</form>		  
		<form ACTION="power_submit.php" METHOD="POST"  name="reg" style="margin:0px;">
		<table width='100%' border="1"  align=center cellpadding=4 cellspacing=0 bordercolorlight=#C0C0C0 bordercolordark=#ffffff bgcolor="#FFFFFF">
            <tr>
              <td colspan="4" align="center" class="title2">選單功能列表</td>
            </tr>
            <tr>
              <td bgcolor="#EBEBEB">功能名稱</td>
              <td bgcolor="#EBEBEB">次功能名稱</td>
              <td bgcolor="#EBEBEB">連結</td>
              <td bgcolor="#EBEBEB">編輯</td>
            </tr>
<?

// 
$count = 0;
$menu_key=$_GET['menu_key'];
//主選單
$CLASS["menu"]->query("SELECT * FROM $XFUN_TBL[TABLE_cmu_menu] $query_where1 ORDER BY Align DESC");
$total = $CLASS["menu"]->num_rows($CLASS["menu"]->result);					//總筆數
if($total >= 1):
while ($row_a = $CLASS["menu"]->fetch_array($CLASS["menu"]->result)) {
	$Title = $row_a['Title'];
	$MU_ID = $row_a['MU_ID'];
	$User_Level=$row_a['User_Level'];
	//主選單權限
	$main_menu=explode(",",$User_Level);
	$g_Key=array_search ($sec_user_level,$main_menu);
	$key_G_chk = strlen($g_Key);
	if ($key_G_chk):
	$count = $count + 1;
	//**************************************************//
	//次選單資料表
		$CLASS["menu"]->query("SELECT * FROM $XFUN_TBL[TABLE_cmu_menu_group] $query_where1 ORDER BY MU_ID DESC");
		$totalb = $CLASS["menu"]->num_rows($CLASS["menu"]->result);					//總筆數
		if($totalb >= 1):
		while ($row_b = $CLASS["menu"]->fetch_array($CLASS["menu"]->result)) {
			$page_count=$page_count+1;
	    	$SUB_MU_ID = $row_b['SUB_MU_ID'];
			$Link = $row_b['Link'];
			$Sub_Tilte = $row_b['Sub_Tilte'];
			$SUser_Level=$row_b['User_Level'];
			//次選單權限
			$sec_menu=explode(",",$SUser_Level);
			$i_Key=array_search ($sec_user_level,$sec_menu);
			$key_I_chk = strlen($i_Key);
			if ($key_I_chk):

				
?>
            <tr onMouseOver="this.style.backgroundColor='#e7f2fa';" onMouseOut="this.style.backgroundColor='';">

<?
			if ($act="mdy" && $mdy_id==$SUB_MU_ID)
				{
?>
<td>
<!--
	<select name="cmu_menu" id="cmu_menu">
	<option value=""><?=$app_strings['COS_SELECT']?></option>
	<? 
	$sq=mysql_query("select * from cmu_menu");
	while($row=mysql_fetch_array($sq)){
	?>
	<option value="<?=$row["MU_ID"]?>" <? if ($MU_ID==$row["MU_ID"]) echo "selected" ?>><?=$row["Title"]?></option>
	<? }?>
  	</select>
//-->
<?=$Title?></td>
<td>
<input name="sub_menu" type="text"  class="from_write" id="sub_menu" value="<?=$Sub_Tilte?>" size="20" ></td>
<td>
<input name="url_link" type="text"  class="from_write " id="url_link" value="<?=$Link?>" size="50" ></td>
<td><input name="act" type="hidden" id="act" value="mdy_menu">
  <input name="mdy_id" type="hidden" id="mdy_id" value="<?=$mdy_id?>">
  <input name="Submit3" type="submit" class="td2" value="修改">
  <input name="Submit4" type="button" class="td2" value="取消" onClick="location='<?=$phpself?>'"></td>
<?
			}else{
?>
              <td><?=$Title?></td>
              <td><?=$Sub_Tilte?></td>
              <td><?=$Link?></td>
              <td>
			  <a href="<?=$phpself?>?act=mdy&mdy_id=<?=$SUB_MU_ID; ?>&show=<?=$show?>"><img src="../images/edit.gif" alt="修改該筆資料" width="16" height="16" border="0"></a> 
	<a href="JavaScript:Del_Confirm('power_submit.php?act=menu_del&mdy_id=<?=$SUB_MU_ID?>&show=','<?=$show?>','您確定刪除此資料?')"><img src="../images/del2.gif" alt="刪除該筆資料" width="16" height="16" border="0"></a>			</td>
            </tr>
<?
			}
			endif;
		} //while_end
	endif;

	endif;
}
endif;
?>     
          </table>
		</form>	    </td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#EBEBEB">
<?
$page=new mypage(array('total'=>1000,'perpage'=>20));
echo $page->show(2);

?>
		</td>
      </tr>
</table>
</body>
</html>
