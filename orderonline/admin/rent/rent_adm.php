<?PHP
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
require_once('../Common/page.class.php');
//基本設定
$CLASS["rent"] = new xfunDB_sql;
$CLASS["rent"]->connect(); 
$SubmitURL="rent_submit.php";
$EditURL="rent_edit.php";
$ImgAdmURL="rent_img_adm.php";
$RentRoomURL="rent_room.php";
$TITLE = "訂房管理系統";		//主標題
$headtitle = "訂房管理";		//次標題

$msg = array(
	'no_result' => '<font color=red>尚無產品資料，請新增。</font>'
);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
<style type="text/css">
<!--
/*分頁選單*/
.pagenavi { text-align:center;  font: 11px Arial, tahoma, sans-serif; padding-top: 0px; padding-bottom: 0px; margin: 0px; }
.pagenavi .break {border: medium none;  text-decoration: none; color:#C16012; background:;; padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px}
.pagenavi .num {color:#C16012; font-size:12pt; padding-left:3px; padding-right:3px; padding-top:0; padding-bottom:0}
.pagenavi .curr {padding: 2px 6px; border-color: #999; font-weight: bold; font-size:12pt; background:transparent;}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body onLoad="MM_preloadImages('../../image/news/retruna.gif')">
<?
//輸入搜尋****************************************************Start
    if(!empty($search_str)):
     if(!empty($mainkind)){
       $query_where2 = " AND projNum LIKE '%" . trim($search_str) . "%' OR projName LIKE '%" . trim($search_str) . "%'";
	 }else{
       $query_where = " WHERE projNum LIKE '%" . trim($search_str) . "%' OR projName LIKE '%" . trim($search_str) . "%'";
	 }  
    endif;
//輸入搜尋****************************************************end

  $limit =10;	//每頁筆數
  
  //分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;
  
  if(!empty($mainkind)){
  	$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] ".$query_where1.$query_where2;
  }else{
  	$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] ".$query_where;
  }
  $CLASS["rent"]->query($result_num);
?>
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#EFEFEF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
    <tr class="title2">
      <td align="center" bgcolor="#CCCCCC"><strong><?=$headtitle?></strong></td>
  </tr>
</table>
   
<form name='form1' method='post' action='<?=$phpself?>'>
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#EFEFEF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
  <tr>
    <td>
  <img src=../images/ico_do.gif width=13 height=13 align="absmiddle"> 關鍵字查詢：
  <input name='search_str' type='text' class='input'>
  <input name='button' type='submit' class='submit01' value='搜尋'>
  &nbsp;搜尋條件：請輸入<font color="red">房型編號或房型名稱</font></td>
  </tr>
  </table>
</form>

<table width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
<tr>
<td align="center" valign="top">
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
  <tr align="center" bgcolor="#065F93" class="style1">
    <td width="4%" bgcolor="#CCCCCC">#</td>
    <td width="16%" bgcolor="#CCCCCC">房型編號</td>
    <td width="19%" bgcolor="#CCCCCC">房型名稱</td>
    <td width="18%" bgcolor="#CCCCCC">房型房價</td>
    <td width="17%" bgcolor="#CCCCCC">建檔日期</td>
    	<? if($sec_user_level=="X"):?>
<td width="8%" bgcolor="#CCCCCC">開放與否</td><? endif;?>
	<td width="9%" bgcolor="#CCCCCC">最後編輯</td>
	<td width="9%" bgcolor="#CCCCCC">編輯</td>
  </tr>
<?PHP

  if(!empty($mainkind)){
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] ".$query_where1." ORDER BY projNum ASC LIMIT $show,$limit";
  }else{
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] ".$query_where." ORDER BY projNum ASC LIMIT $show,$limit";
  }
  //echo $result_num;
  $CLASS["rent"]->query($result_num);
  $totala = $CLASS["rent"]->num_rows($CLASS["rent"]->result);	//總筆數
  $num = 0;
	if($totala >= 1):
	while ($row = $CLASS["rent"]->fetch_array($CLASS["rent"]->result)) {
  	$num = $num + 1;
	$id=$row["rentNum"];
	$lan=$row["lan"];
	$projNum=$row["projNum"];
	$projName=$row["projName"];
	$rentPrice=$row["rentPrice"];
	$display=$row["display"];
	$creatDate =$row["creatDate"];
	$last_modify=$row["last_modify"];
?>
  <tr align="center" onMouseOver="this.style.backgroundColor='#e7f2fa';" onMouseOut="this.style.backgroundColor='';">
    <td><?=$num?></td>
    <td align="left" style="padding-left:20px"><?=$projNum?></td>
    <td align="left" style="padding-left:30px"><?=$projName?></td>
    <td align="left" style="padding-left:30px"><?=$rentPrice?></td>
    <td align="left" style="padding-left:30px"><?=$creatDate?></td>
	<? if($sec_user_level=="X"):?>
    <td nowrap><span style="padding-left:0px">
      <?
	if($display=="Y"):
echo "<a href=\"#\"><img src=\"../images/on.gif\" alt=\"是\" width=\"13\" height=\"13\" border=\"0\"></a> <a href=\"".$SubmitURL."?act=show&s=N&id=$id&PB_page=$PB_page\"> <img src=\"../images/off2.gif\" alt=\"否\" width=\"13\" height=\"13\" border=\"0\"></a>";
	elseif($display="N"):
echo "<a href=\"".$SubmitURL."?act=show&s=Y&id=$id&PB_page=$PB_page\"><img src=\"../images/on2.gif\" alt=\"是\" width=\"13\" height=\"13\" border=\"0\"></a> <a href=\"#\"><img src=\"../images/off.gif\" alt=\"否\" width=\"13\" height=\"13\" border=\"0\"></a>";
	endif;
	?>
      </span></td>
	  <? endif;?>
	<td nowrap><?=$last_modify==""?"尚未":$last_modify?></td>
	<td>
	<input name="" type="button" value="" title="訂房維護" onClick="location='<?=$RentRoomURL?>?id=<?=$id?>&main_page=<?=$PB_page?>'" class="btn_Calendar">
	<? if($sec_user_level=="X"):?>
	<input type="button" name="Submit" value="" onClick="location='<?=$ImgAdmURL?>?id=<?=$id?>&main_page=<?=$PB_page?>'" class="btn_AddImageFileImg">
	<a href="<?=$EditURL?>?act=mdy&id=<?=$id; ?>&PB_page=<?=$PB_page?>">  
	  <img src="../images/edit.gif" alt="修改資料" width="16" height="16" border="0" align="middle"></a> <a href="JavaScript:chkdel('<?=$SubmitURL?>?act=delete&id=<?=$id; ?>&PB_page=<?=$PB_page?>')"><img src="../images/del2.gif" alt="刪除資料" width="16" height="16" border="0" align="middle"></a>
	  <? endif?>	  </td>
  </tr>  
<?
  }  //while_end
  else:
?>
  <tr align="center">
    <td colspan="8"><font color=red><?=$msg["no_result"]?></font></td>
  </tr>
<? endif;?>
</table>
    </td>
  </tr>
      <tr>
        <td align="center" valign="top" bgcolor="#EBEBEB">
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
$CLASS["rent"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent]");
$total = $CLASS["rent"]->num_rows($CLASS["rent"]->result);
//秀分頁選單
$page=new mypage(array('total'=>$total,'perpage'=>$limit));
echo $page->show(2);
?>		</td>
      </tr>
</table>
</body>
</html>
