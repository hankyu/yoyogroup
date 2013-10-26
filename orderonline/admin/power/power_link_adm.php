<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
require_once('../Common/page.class.php');
//基本設定
$CLASS["menu"] = new xfunDB_sql;
$CLASS["menu"]->connect(); 
$CLASS["smenu"] = new xfunDB_sql;
$CLASS["smenu"]->connect(); 
$TITLE = "選單功能管理系統";		//主標題
$SUBTITLE = "選單管理列表";		//次標題
$msg = array(
'no_result' => '尚無選單資料，請新增。'
);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
<link href="../js/type.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
/*分頁選單*/
.pagenavi { text-align:center;  font: 11px Arial, tahoma, sans-serif; padding-top: 0px; padding-bottom: 0px; margin: 0px; }
.pagenavi .break {border: medium none;  text-decoration: none; color:#C16012; background:;; padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px}
.pagenavi .num {color:#C16012; font-size:12pt; padding-left:3px; padding-right:3px; padding-top:0; padding-bottom:0}
.pagenavi .curr {padding: 2px 6px; border-color: #999; font-weight: bold; font-size:12pt; background:transparent;}
-->
</style>

<SCRIPT language=JavaScript>
<!--
function check(theForm)
{
  if (document.theForm.mainMenu.value == "")
  {
    alert("尚未選擇選單主項目或輸選單主項？");
    document.theForm.mainMenu.focus();
    return (false);
  }

  if (document.theForm.sub_menu.value == "")
  {
    alert("「選單次選項」不得為空白！");
    document.theForm.sub_menu.focus();
    return (false);
  }

  if (document.theForm.url_link.value == "")
  {
    alert("「功能連結」不得為空白！");
    document.theForm.url_link.focus();
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
<form ACTION="power_submit.php" METHOD="POST"  name="theForm" style="margin:0px;" onSubmit="return check(this)">		
		<table width='100%' border="1"  align=center cellpadding=3 cellspacing=0 bordercolorlight=#C0C0C0 bordercolordark=#ffffff>
            <tr bgcolor="#F7F7F7">
              <td width="17%" bgcolor="#EBEBEB" style="PADDING-LEFT: 6px">選單主選項<font color="#FF0000">*</font></td>
              <td bgcolor="#FFFFFF" style="PADDING-LEFT: 6px">
  
    <select name="mainMenu" id="mainMenu">
	  <option value="">請選擇</option>
	<? 
	$CLASS["menu"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu]");
	$total = $CLASS["menu"]->num_rows($CLASS["menu"]->result);	//總筆數
	if($total >= 1):
		while ($row = $CLASS["menu"]->fetch_array($CLASS["menu"]->result)) {
			?>
			  <option value="<?=$row["MU_ID"]?>"><?=$row["Title"]?></option>
			<?
		}
	endif;
	?>
  </select></td>
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
                  <input name="process" type="hidden" id="process" value="sub_menu">
                  <input name="act" type="hidden" id="act" value="insert">
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
$limit=10;//每頁筆數

  //索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$show = 0;
  endif;

$menu_key=$_GET['menu_key'];
//主選單
$query_where1="WHERE a.MU_ID=b.MU_ID";
$CLASS["menu"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] a JOIN $XFUN_TBL[TABLE_XFUN_menu_group] b $query_where1 ORDER BY Align DESC LIMIT $show,$limit");
//echo "SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] a JOIN $XFUN_TBL[TABLE_XFUN_menu_group] b $query_where1 ORDER BY Align DESC LIMIT $show,$limit";
$total = $CLASS["menu"]->num_rows($CLASS["menu"]->result);	//總筆數
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
			$page_count=$page_count+1;
	    	$SUB_MU_ID = $row_a['SUB_MU_ID'];
			$Link = $row_a['Link'];
			$Sub_Tilte = $row_a['Sub_Tilte'];
			$SUser_Level=$row_a['User_Level'];
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
	<select name="mainMenu" id="mainMenu">
	<option value=""><?=$app_strings['COS_SELECT']?></option>
	<? 
	$CLASS["smenu"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] ORDER BY MU_ID DESC ");
	$total_b = $CLASS["smenu"]->num_rows($CLASS["smenu"]->result);
	if($total_b >= 1):
	while($row = $CLASS["smenu"]->fetch_array($CLASS["smenu"]->result)){
	?>
	<option value="<?=$row["MU_ID"]?>" <? if ($MU_ID==$row["MU_ID"]) echo "selected" ?>><?=$row["Title"]?></option>
	<? 
	}
	endif;
	?>
  	</select>
<?=$Title?>
</td>
<td>
<input name="sub_menu" type="text"  class="from_write" id="sub_menu" value="<?=$Sub_Tilte?>" size="20" ></td>
<td>
<input name="url_link" type="text"  class="from_write " id="url_link" value="<?=$Link?>" size="50" ></td>
<td><input name="process" type="hidden" id="process" value="sub_menu">
<input name="act" type="hidden" id="act" value="update">
  <input name="mdy_id" type="hidden" id="mdy_id" value="<?=$mdy_id?>">
  <input name="PB_page" type="hidden" id="PB_page" value="<?=$PB_page?>">
  <input name="Submit3" type="submit" class="td2" value="修改">
  <input name="Submit4" type="button" class="td2" value="取消" onClick="location='<?=$phpself?>?PB_page=<?=$PB_page?>'"></td>
<?
}else{
?>
              <td><?=$Title?></td>
              <td><?=$Sub_Tilte?></td>
              <td><?=$Link?></td>
              <td>
			  <a href="<?=$phpself?>?act=mdy&mdy_id=<?=$SUB_MU_ID; ?>&PB_page=<?=$PB_page?>"><img src="../images/edit.gif" alt="修改該筆資料" width="16" height="16" border="0"></a> 
	<a href="JavaScript:Del_Confirm('power_submit.php?act=delete&process=sub_menu&mdy_id=<?=$SUB_MU_ID?>&PB_page=','<?=$PB_page?>','您確定刪除此資料?')"><img src="../images/del2.gif" alt="刪除該筆資料" width="16" height="16" border="0"></a>			</td>
            </tr>
<?
			}
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
<?PHP
//分頁設訂
class mypage extends page
{
 function mypage($array)
 {
  parent::page($array);
  $this->first_page="<img src='../images/page_first.gif' border=0/>";
  $this->last_page="<img src='../images/page_last.gif' border=0/>";
  $this->next_page="<img src='../images/page_next.gif' border=0/>";
  $this->pre_page="<img src='../images/page_prev.gif' border=0 />";
  $this->set('format_left','');
  $this->set('format_right','');
 }
 
 function show()
 {
  $pagestr='<div class="pagenavi" id="lopage">';
  $pagestr.=$this->first_page().' ';
  $pagestr.=$this->pre_page().' ';
  $pagestr.=$this->nowbar('','curr');
  $pagestr.=$this->next_page();
  $pagestr.=$this->last_page();
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;共<span class="num">'.$this->totalpage.'</span>頁<span class="num">'.$this->totaldata.'</span>筆資料';
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;前往第 '.$this->select().' 頁';
  $pagestr.='</div>';
  return $pagestr;
 }
}

//取得總筆數
$CLASS["menu"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] a JOIN $XFUN_TBL[TABLE_XFUN_menu_group] b $query_where1 ORDER BY Align DESC ");
$total = $CLASS["menu"]->num_rows($CLASS["menu"]->result);
//秀分頁選單
$page=new mypage(array('total'=>$total,'perpage'=>$limit));
echo $page->show(2);
?>
		</td>
      </tr>
</table>
</body>
</html>
