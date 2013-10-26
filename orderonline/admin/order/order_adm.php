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
require_once('../Lib/xfun.SQLHelp.php');

//基本設定
$CLASS["order_adm"] = new xfunDB_sql;
$CLASS["order_adm"]->connect(); 
$CLASS["order_view"] = new xfunDB_sql;
$CLASS["order_view"]->connect(); 

$TITLE = "訂單管理系統";		//主標題
$SUBTITLE = "訂單資料管理";		//次標題
$REDirect_PG=$phpself;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?PHP no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
<link href="../js/type.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!--

function disable_chkBox()
{
	document.getElementById("chk_all").disabled=true;
}
function tformdel(mem_no,page)
{
  if(confirm("您確定刪除此商品!?"))
    location.href='prd_del.asp?num='+mem_no+'&page='+page;
}
//-->
</script>
<script>
function blankopen(f)
{
var win = window.open(f);
}
</script> 

<SCRIPT language=JavaScript>
<!--
function check(myform)
{
  if (myform.act.value == "")
  {
    alert("請先選擇程序處理類別？");
    myform.act.focus();
    return (false);
  }
  return   true;  
}
-->
</SCRIPT>

<script type="text/javascript">
<!--
var formblock;
var forminputs;

function prepare() {
formblock= document.getElementById('myform');
forminputs = formblock.getElementsByTagName('input');
}

function select_all(name, value) {
flag=document.myform.checkbox.checked;
if(flag){
value='1';
}else{
value='0';
}
for (i = 0; i < forminputs.length; i++) {
// regex here to check name attribute
var regex = new RegExp(name, "i");
if (regex.test(forminputs[i].getAttribute('name'))) {
if (value == '1') {
forminputs[i].checked = true;
} else {
forminputs[i].checked = false;
}
}
}
}

if (window.addEventListener) {
window.addEventListener("load", prepare, false);
} else if (window.attachEvent) {
window.attachEvent("onload", prepare)
} else if (document.getElementById) {
window.onload = prepare;
}


//-->
</script>
</head>
<?PHP
//$show = htmlspecialchars(trim($HTTP_GET_VARS['show']));	//換頁
//$search_str = htmlspecialchars(trim($HTTP_POST_VARS['search_str']));//輸入查詢
	
//輸入搜尋****************************************************Start
	if(!empty($s_date)&&!empty($e_date)&&!empty($search_str)):
       $query_where = " WHERE (DATE_FORMAT(order_date, '%Y-%m-%d') between '$s_date' AND '$e_date') AND order_id = '" . $search_str . "' AND order_status!='A10'";
	elseif(!empty($s_date)&&!empty($e_date)):   
       $query_where = " WHERE (DATE_FORMAT(order_date, '%Y-%m-%d') between '$s_date' AND '$e_date') AND order_status!='A10'";
	elseif(!empty($search_str)):
       $query_where = " WHERE order_id = '" . $search_str . "' AND order_status!='A10'";   
	else:
	   $query_where = " WHERE order_status!='A10'";
	endif;
//輸入搜尋****************************************************end

  $limit =20;	//每頁筆數
  
  //分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;

if($process=="change"):
$CLASS["DB_log"] = new xfunDB_sql;
$CLASS["DB_log"]->connect(); 
if($act=="insert"){$acttitle="新增";}
if($act=="update"){$acttitle="修改";}
if($act=="delete"){$acttitle="刪除";}


$thisAct=$act=="A8"?"delete":"update";
$myOrderID = count($sign_id);
	//==============訂單資料處理程序==============
	$Order = new XFUN_SQLHelp();
	$Order->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_order_list];
	$Order->ClassTitle = "訂單資料";
	//==============購物商品清單資料處理程序==============
	$Order_Pro = new XFUN_SQLHelp();
	$Order_Pro->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_shopping_item];
	$Order_Pro->ClassTitle = "購物車資料";
	//==============訂單留言處理程序==============
	$Order_Msg = new XFUN_SQLHelp();
	$Order_Msg->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_order_msg];
	$Order_Msg->ClassTitle = "訂單留言資料";

	for($i=0;$i<=$myOrderID;$i++){
	$ss=chk_status($act);
	if(trim($sign_id[$i])!=""){
	$result_log = "INSERT INTO xfun_log (log_name,log_user,cdate)VALUES('[".$sign_id[$i]."-".view_kind($sign_id[$i],"xfun_order_list","order_id","order_name")."]訂單資料".$ss."','".$sec_id."','".date("Y-m-d H:i:s")."')";
	$CLASS["DB_log"]->query($result_log);
    }
		$Order->DB_updValues = "`order_status`='$act',`last_modify`='".$sec_id."' WHERE order_id='".$sign_id[$i]."'";
		$Order->DB_delValues = " order_id = '".$sign_id[$i]."'";
		$Order->ActDataAccess($thisAct);
		$Insert_DB=true;
		$Order_Pro->DB_updValues = NULL;
		$Order_Pro->DB_delValues = " shopping_cartid = '".$sign_id[$i]."'";
		$Order_Pro->ActDataAccess($thisAct);
		$Insert_DB=true;
		$Order_Msg->DB_updValues = NULL;
		$Order_Msg->DB_delValues = " order_id = '".$sign_id[$i]."'";
		$Order_Msg->ActDataAccess($thisAct);
		$Insert_DB=true;
	}
		$msg = "<script language='javascript'>redirectURL('".$Order->ClassActTitle.$Order->ClassTitle."成功(".($i-1)."筆)！','$REDirect_PG')</script>";
	echo $msg;
elseif($process=="paychg"):
	//==============訂單資料處理程序==============
	$Order = new XFUN_SQLHelp();
	$Order->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_order_list];
	$Order->ClassTitle = "訂單資料";
		$Order->DB_updValues = "`payment`=$payment WHERE order_id=".$id;
		$Order->DB_delValues = NULL;
		$Order->ActDataAccess("update");
		$Insert_DB=true;
		$msg = "<script language='javascript'>redirectURL('".$Order->ClassActTitle.$Order->ClassTitle."成功(1筆)！','$REDirect_PG')</script>";
	echo $msg;
$CLASS["DB_log"]->free_result($CLASS["DB_log"]->result);
endif;
?>
<?
function chk_status($id)
{
	switch ($id) {
	case "A0":
		return "重新處理";
		break;
	case "A1":
		return "<font color=red>等待確認中</font>";
		break;
	case "A2":
		return "<font color=blue>接到訂單處理中</font>";
		break;
	case "A3":
		return "未連絡到客戶";
		break;
	case "A4":
		return "等待付款單據";
		break;
	case "A5":
		return "<font color=green>訂單成立 (已付款)</font>";
		break;
	case "A6":
		return "<font color=red>訂單失效 (已退款)</font>";
		break;
	case "A8":
		return "刪除訂單";
		break;
	case "A9":
		return "<font color=gray>未結案</font>";
		break;
	case "A10":
		return "<font color=gray>已結案</font>";
		break;
	}
}
?>
<body>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr bgcolor="#CCCCCC" class="title2"> 
    <td height="8" align="center" nowrap> 
     <strong class="style2">‧<?=$SUBTITLE?>‧</strong></td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr>
    <td width="1243" height="13" valign="top" bgcolor="#EBEBEB">
<form name='searchform' method='post' action='<?=$phpself?>'>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" align="left" valign="top">
		訂單日期查詢：
          從
          <input name="s_date" type="text" id="s_date" value="<?=$s_date?>">
          <img src="../js/jcalendar/images/cal_16.gif" alt="選擇日期" width="16" height="16" border="0" id="f_trigger_c" style="cursor: pointer; border: 0px solid red;" title="Date selector"
      onmouseover="window.status='跳出行事曆以選擇日期';return true" onMouseOut="window.status='';return true;" />
          <script type="text/javascript">
    Calendar.setup({
        inputField     :    "s_date",     // id of the input field
        ifFormat       :    "%Y-%m-%e",     // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
          </script>
至
<input name="e_date" type="text" id="e_date" value="<?=$e_date?>">
<img src="../js/jcalendar/images/cal_16.gif" alt="選擇日期" width="16" height="16" border="0" id="e_trigger_c" style="cursor: pointer; border: 0px solid red;" title="Date selector"
      onmouseover="window.status='跳出行事曆以選擇日期';return true" onMouseOut="window.status='';return true;" />
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "e_date",     // id of the input field
        ifFormat       :    "%Y-%m-%e",     // format of the input field
        button         :    "e_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
止
		</td>
      </tr>
      <tr>
        <td height="22" align="left" valign="top">
		 訂單查詢：
        <input name='search_str' type='text' class='input' value="<?=$search_str?>">
        <img src="../images/ico_do.gif" width="13" height="13" align="absmiddle" />
  <input name='button' type='submit' class='submit01' value='搜尋'>
  &nbsp;搜尋條件：請輸入<font color="red">訂單編號</font></td>
        </tr>
      <tr>
	  </table>
</form>
<form id="myform" name="myform" method="post" action="<?=$phpself?>" onSubmit="return check(this)">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <td height="22" align="left" valign="top">
          勾選程序處理：
          <select name="act" class="inputkeyword01" id="act" >
            <option value="" selected>請選擇</option>
            <? if($sec_user_level=="X"):?><option value="A0" >重新處理</option><? endif?>
            <option value="A1" >等待確認中</option>
            <? if($sec_user_level=="X"):?><option value="A2" >接到訂單處理中</option><? endif?>
            <? if($sec_user_level=="X"):?><option value="A3" >未連絡到客戶</option><? endif?>
            <option value="A4" >等待付款單據</option>
            <option value="A5" >訂單成立 (已付款)</option>
            <option value="A6" >訂單失效 (已退款)</option>
            <? if($sec_user_level=="X"):?><option value="A8" >刪除訂單</option><? endif?>
            <? if($sec_user_level=="X"):?><option value="A9" >未結案</option><? endif?>
            <option value="A10" >已結案</option>
              </select>
          <input name="submit" type="submit" class="input02" value=" 送出 ">
          <a href="javascript:window.print()"><img src="../images/Print.gif" border="0" align="absmiddle"></a> <input name="process" type="hidden" id="process" value="change" /></td>
    <td width="459" align="right" valign="top"><?=$msg?></td>
  </tr>
    </table>	
	  <table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
        <tr bgcolor="#B7B700">
          <td align="center" valign="middle" nowrap bgcolor="#CCCCCC" class="style13"> #</td>
          <td height="20" align="center" nowrap bgcolor="#CCCCCC" class="style13">
		  <span class="word5">全選</span>
		  <input type="checkbox" name="checkbox" id="chk_all" value="checkbox" onClick="select_all('sign_id', '1');"></td>
          <td height="20" align="center" nowrap bgcolor="#CCCCCC" class="style13">訂單編號</td>
          <td align="center" nowrap bgcolor="#CCCCCC" class="style13">訂購人姓名</td>
          <td align="center" nowrap bgcolor="#CCCCCC" class="style13">連絡電話</td>
          <td height="20" align="center" nowrap bgcolor="#CCCCCC" class="style13">Email信箱</td>
          <td height="20" align="center" nowrap bgcolor="#CCCCCC" class="style13">訂購總金額</td>
          <td align="center" nowrap bgcolor="#CCCCCC" class="style13">付款方式</td>
          <td align="center" nowrap bgcolor="#CCCCCC" class="style13">留言筆數</td>
          <td align="center" nowrap bgcolor="#CCCCCC" class="style13">訂單日期</td>
          <td align="center" nowrap bgcolor="#CCCCCC" class="style13">入住日期</td>
          <td align="center" nowrap bgcolor="#CCCCCC" class="style13">最後編輯</td>
          <td align="center" nowrap bgcolor="#CCCCCC" class="style13"><font class=c>處理情形</font></td>
        </tr>
<?PHP
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list] ".$query_where." ORDER BY order_date desc LIMIT $show,$limit";
  //echo $result_num;
  $CLASS["order_adm"]->query($result_num);
  $total = $CLASS["order_adm"]->num_rows($CLASS["order_adm"]->result);	//總筆數

  $num = 0;
	if($total >= 1):
	while ($row = $CLASS["order_adm"]->fetch_array($CLASS["order_adm"]->result)) {
  	$num = $num + 1;
	$order_id=$row["order_id"];
	$payment=$row["payment"];
	$order_name=$row["order_name"];
	$order_phone=$row["order_phone"];
	$order_mobile=$row["order_mobile"];
	$order_email=$row["order_email"];
	$order_totalprice=$row["order_totalprice"];
	$order_payway=$row["order_payway"];
	$order_date=$row["order_date"];
	$order_status=$row["order_status"];
	$last_modify = $row["last_modify"];
?>
        <tr bgcolor="#FFFFFF" onmouseover="this.style.backgroundColor='#FFFFCC';" onmouseout="this.style.backgroundColor='#FFFFFF';">
          <td align="center" bgcolor="#CCCCCC" class="style13"><?=$num?></td>
          <td align="center" valign="middle"><input name="sign_id[]" type="checkbox" id="sign_id[]" value="<?=$order_id?>" /></td>
          <td align="center"><a href="order_view.php?order_id=<?=$order_id?>" title="檢視訂單內容">
            <?=$order_id?>
          </a></td>
          <td align="center"><?=$order_name?></td>
          <td align="center"><?=$order_phone?>
              <br />
              <?=$order_mobile?>          </td>
          <td align="center"><?=$order_email?></td>
          <td align="center">
		  <?PHP
$query_where1="WHERE shopping_cartid='".$order_id."' AND shopping_status='B'";
//=========================================================訂購清單========================================================
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] ".$query_where1." ORDER BY shopping_promodel ASC";
//echo $result_num;
  $CLASS["order_view"]->query($result_num);
  $total = $CLASS["order_view"]->num_rows($CLASS["order_view"]->result);	//總筆數
  $shopping_countTotal=0;
  $shopping_totalAmount=0;
	if($total >= 1):
	while ($row = $CLASS["order_view"]->fetch_array($CLASS["order_view"]->result)) {
	$shopping_num=$row["shopping_num"];
	$shopping_proid=$row["shopping_proid"];
	$shopping_cartid=$row["shopping_cartid"];
	$shopping_proname=$row["shopping_proname"];
	$shopping_promodel=$row["shopping_promodel"];
	$shopping_prosize=$row["shopping_prosize"];
	$shopping_procolor=$row["shopping_procolor"];
	$shopping_price1=$row["shopping_price1"];
	$shopping_price2=$row["shopping_price2"];
	$shopping_amount=$row["shopping_amount"];
	$shopping_totalPrice=$row["shopping_totalPrice"];
	$shopping_countTotal+=$shopping_price1*$shopping_amount;
	$shopping_totalAmount+=$shopping_amount;
	}
	endif;
?>
		  <?=$shopping_countTotal?></td>
          <td align="center"><?=$order_payway?></td>
          <td align="center"><?=CountMsg($order_id)?></td>
          <td align="center"><?=$order_date?></td>
          <td align="center">
		  <?
		  $query_where1="WHERE shopping_cartid='".$order_id."' AND shopping_status='B'";
		  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] ".$query_where1." ORDER BY shopping_promodel ASC LIMIT 0,1";
//echo $result_num;
  $CLASS["order_view"]->query($result_num);
  $total = $CLASS["order_view"]->num_rows($CLASS["order_view"]->result);	//總筆數
  //$num = 0;
	if ($row = $CLASS["order_view"]->fetch_array($CLASS["order_view"]->result)) {
  		echo $shopping_promodel=$row["shopping_promodel"];
		}
		  ?>		  </td>
          <td align="center"><?=$last_modify==""?"尚未":$last_modify?></td>
          <td align="center"><?=chk_status($order_status)?></td>
        </tr>
        <?
    }  //while_end
  else:
?>
        <tr align="center">
          <td colspan="14">
		  <?="<SCRIPT language='JavaScript'>disable_chkBox()</SCRIPT>"?>
              <font color=red>尚無訂單資料。</font></td>
        </tr>
        <? endif;?>
      </table>
</form>	  
	  </td>
  </tr>
  <tr>
    <td height="13" align="center" valign="top" bgcolor="#EBEBEB"><table>
      <tr>
        <td align="center" valign="top" bgcolor="#EBEBEB"><?PHP
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
$CLASS["order_adm"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list]".$query_where);
$total = $CLASS["order_adm"]->num_rows($CLASS["order_adm"]->result);
//秀分頁選單
if($total>=1){
	$page=new mypage(array('total'=>$total,'perpage'=>$limit));
	echo $page->show(2);
}
$CLASS["order_adm"]->free_result($CLASS["order_adm"]->result);
$CLASS["order_view"]->free_result($CLASS["order_view"]->result);
?>        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
