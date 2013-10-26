<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
require_once('../Common/page.class.php');

$CLASS["DB"] = new xfunDB_sql;
$CLASS["DB"]->connect(); 
$CLASS["rent"] = new xfunDB_sql;
$CLASS["rent"]->connect(); 
$SubmitURL="rent_room_submit.php";
$ExitURL = "rent_adm.php";
$EditURL = $PHP_SELF;
$TITLE = "訂房資料新增";		//主標題

//****************讀取資料*******************
$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] WHERE rentNum =".$id;
$CLASS["DB"]->query($result_num);
$total = $CLASS["DB"]->num_rows($CLASS["DB"]->result);	//總筆數
if($total >= 1):
$row = $CLASS["DB"]->fetch_array($CLASS["DB"]->result);
$projNum=$row['projNum'];
$projName=$row['projName'];
$rentPrice=$row['rentPrice'];
$display=$row['display'];
$rentDiscribe=$row['rentDiscribe'];
$shortDiscribe=$row['shortDiscribe'];
endif;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$TITLE?></title>
<?=$js?>
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
  
  if (document.theForm.rentDate.value == "")
  {
    alert("日期尚未設定？");
    document.theForm.rentDate.focus();
    return (false);
  }
  
  if (document.theForm.rentDatePrice.value == "")
  {
    alert("房價尚未填寫？");
    document.theForm.rentDatePrice.focus();
    return (false);
  }
  if(document.theForm.rentDatePrice.value != ""){
    cltxt=document.theForm.rentDatePrice.value;
	for (i=0;i<cltxt.length;i++)
	{
	  c=cltxt.charAt(i);
	  if ("0123456789".indexOf(c,0)<0)
	  {
	  alert("房價請輸入阿拉伯數字");
	  document.theForm.rentDatePrice.focus();
	  document.theForm.rentDatePrice.value = "0";
	  return (false);
	  }
	}
  }
  if(document.theForm.rentDateAmount.value != ""){
    cltxt=document.theForm.rentDateAmount.value;
	for (i=0;i<cltxt.length;i++)
	{
	  c=cltxt.charAt(i);
	  if ("0123456789".indexOf(c,0)<0)
	  {
	  alert("開放數量請輸入阿拉伯數字");
	  document.theForm.rentDateAmount.focus();
	  document.theForm.rentDateAmount.value = "0";
	  return (false);
	  }
	}
  }
  if (eval(document.theForm.rentDateAmount.value) <= 0)
  {
    alert("開放數量尚未填寫？");
    document.theForm.rentDateAmount.focus();
    return (false);
  }

 return (true); 
} 
-->
</SCRIPT>

</head>
<body>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bgcolor="#EFEFEF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
  <tr class="title2">
    <td align="center" bgcolor="#CCCCCC"><strong><?=$TITLE?></strong></td>
  </tr>
  <tr bordercolor="#EFEFF7">
    <td>
<form id="theForm" name="theForm" method="post" enctype="multipart/form-data" onSubmit="return check(this)" action="<?=$SubmitURL?>">
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
      <tr >
        <td rowspan="6" align="center" bordercolor="#FFFFFF" bgcolor="#E8E8E8" class="style5">
		<?
		require_once("calendar.php");
		$rentDate=$y."-".$m."-".$a;
		?></td>
        <td width="603">房型名稱：<?=$projName?></td>
      </tr>
      <tr>
        <td width="603">設定日期：
          <input name="rentDate" type="text" id="rentDate" value="<?=$rentDate?>" readonly/></td>
      </tr>
      <tr>
        <td><span class="style5">房型定價</span>：
          <input name="rentDatePrice" type="text" id="rentDatePrice" value="<?=$rentPrice?>" /></td>
      </tr>
      <tr>
        <td>開放數量：
          <input name="rentDateAmount" type="text" id="rentDateAmount" value="0" /></td>
      </tr>
      <tr>
        <td align="left">
		<div style="width:20px; height:20px; padding-bottom:3px; background-color:#00CCFF; float:left; border:solid #333333 1px;"></div>
		<div style="height:20px; padding-bottom:3px; padding-left:2px">藍色表已設定資料。</div>
		<div style="width:20px; height:20px; background-color:#FFCC00; float:left; border:solid #333333 1px;"></div>
		<div style="height:20px; padding-left:2px">橙色表已有房間出租。</div></td>
      </tr>
      <tr>
        <td align="center"><span class="btn_ynws">
          <input name="Submit" type="submit" class="input02" value=" 新增 " />
          <input type="hidden" name="act" value="insert" />
          <input type="hidden" name="m" value="<?=$m?>" />
          <input type="hidden" name="a" value="<?=$a?>" />
          <input type="hidden" name="y" value="<?=$y?>" />
          <input name="rentNum" type="hidden" id="rentNum" value="<?=$id?>" />
          <input name="PB_page" type="hidden" id="PB_page" value="<?=$PB_page?>" />
          <input name="main_page" type="hidden" id="main_page" value="<?=$main_page?>" />
		  <input name="Submit2" type="button" class="input02" onClick="location.href='<?=$ExitURL?>?PB_page=<?=$main_page?>'" value=" 離開 ">
        </span></td>
      </tr>
    </table>
</form>
	
      <table width="100%" border="1">

      <tr bgcolor="#F4F4FF">
        <td align="center" bordercolor="#FFFFFF" bgcolor="#EFEFEF">
<?
  $limit = 30;	//每頁筆數
  
  //分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;

?>		
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
  <tr align="center" bgcolor="#065F93" class="style1">
    <td width="5%" bgcolor="#CCCCCC">#</td>
    <td width="24%" bgcolor="#CCCCCC">設定日期</td>
    <td width="25%" bgcolor="#CCCCCC">房價</td>
    <td width="13%" bgcolor="#CCCCCC">開放數量</td>
    <td width="8%" bgcolor="#CCCCCC">已有訂購</td>
    <td width="12%" bgcolor="#CCCCCC">最後編輯</td>
    <td width="13%" bgcolor="#CCCCCC">編輯</td>
  </tr>
<?PHP
  $extednSql=" WHERE rentNum=".$id;
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_date] $extednSql ORDER BY rentDate ASC LIMIT $show,$limit";
  //echo $result_num;
  $CLASS["rent"]->query($result_num);
  $totala = $CLASS["rent"]->num_rows($CLASS["rent"]->result);	//總筆數
  $num = 0;
	if($totala >= 1):
	while ($row = $CLASS["rent"]->fetch_array($CLASS["rent"]->result)) {
  	$num = $num + 1;
	$rentDateNum = $row["rentDateNum"];
	$rentNum = $row["rentNum"];
	$rentDate = $row["rentDate"];
	$rentDatePrice = $row["rentDatePrice"];
	$rentDateAmount = $row["rentDateAmount"];
	$last_modify = $row["last_modify"];
?>
<form id="form2" name="form2"  enctype="multipart/form-data" method="post" action="<?=$SubmitURL?>" >
  <tr align="center" onMouseOver="this.style.backgroundColor='#e7f2fa';" onMouseOut="this.style.backgroundColor='';">
    <td><?=$num?></td>
    <td align="left" style="padding-left:20px">
	<?
	if($rdn==$rentDateNum):
		echo "<input name=rentDate id=rentDate type=text size=15 readonly value=$rentDate />";
	else:
		echo $rentDate;	
	endif;
	?>    </td>
    <td align="left" style="padding-left:30px">
	<?
	if($rdn==$rentDateNum):
		echo "<input name=rentDatePrice id=rentDatePrice type=text size=15 value=$rentDatePrice />";
	else:
		echo $rentDatePrice;	
	endif;
	?>	</td>
    <td align="left" style="padding-left:30px">
	<?
	if($rdn==$rentDateNum):
		echo "<input name=rentDateAmount id=rentDateAmount type=text size=15 value=$rentDateAmount />";
	else:
		echo $rentDateAmount;	
	endif;
	?>      </td>
    <td align="left" style="padding-left:30px">
	<?=CountStorage($rentNum,$rentDate)>0?CountStorage($rentNum,$rentDate):"0"?>	</td>
    <td align="left" style="padding-left:30px"><?=$last_modify==""?"尚未":$last_modify?></td>
    <td>
<?
if($rdn==$rentDateNum):
?>
<input name="act" type="hidden" id="act" value="update">
<input name="rentDateNum" type="hidden" id="rentDateNum" value="<?=$rentDateNum?>">
<input name="PB_page" type="hidden" id="PB_page" value="<?=$PB_page?>">
<input name="main_page" type="hidden" id="PB_page" value="<?=$main_page?>">
<input name="rentNum" type="hidden" id="rentNum" value="<?=$id?>">
   <input name="Submit3" type="submit" class="btn_UpdateImg" value="" title="更新">
   <input name="Submit4" type="button" class="btn_CancelImg" value="" title="取消" onClick="location='<?=$EditURL?>?id=<?=$id?>&main_page=<?=$main_page?>&PB_page=<?=$PB_page?>'">

<? else :?>
<a href="<?=$EditURL?>?act=mdy&id=<?=$id?>&rdn=<?=$rentDateNum; ?>&PB_page=<?=$PB_page?>&main_page=<?=$main_page?>"> 
<img src="../images/edit.gif" alt="修改資料" width="16" height="16" border="0" align="middle"></a> <a href="JavaScript:chkdel('<?=$SubmitURL?>?act=delete&rentNum=<?=$id?>&rentDateNum=<?=$rentDateNum; ?>&PB_page=<?=$PB_page?>&main_page=<?=$main_page?>')"><img src="../images/del2.gif" alt="刪除資料" width="16" height="16" border="0" align="middle"></a>
<? endif;?>	  </td>
  </tr>  
</form>  
<?
  }  //while_end
  else:
?>
  <tr align="center">
    <td colspan="7"><font color=red><?=$msg["no_result"]?></font></td>
  </tr>
<? endif;?>
</table>
		</td>
        </tr>
      <tr bgcolor="#F4F4FF">
        <td align="center" bordercolor="#FFFFFF" bgcolor="#EFEFEF">
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
$CLASS["rent"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_date] $extednSql");
$total = $CLASS["rent"]->num_rows($CLASS["rent"]->result);
//秀分頁選單
$page=new mypage(array('total'=>$total,'perpage'=>$limit));
echo $page->show(2);
$CLASS["rent"]->free_result($CLASS["rent"]->result);
$CLASS["DB"]->free_result($CLASS["DB"]->result);
?>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
