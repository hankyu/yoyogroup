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
$CLASS["order_view"] = new xfunDB_sql;
$CLASS["order_view"]->connect(); 

$TITLE = "訂單管理系統";		//主標題
$SUBTITLE = "訂房清單";		//次標題
$REDirect_PG="order_adm.php";
$Msg_SumitUrl="order_msgSubmit.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?PHP no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
<link href="../js/type.css" rel="stylesheet" type="text/css" />
<script language="javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

</head>
<body>
<form id="form1" name="form1" method="post" action="<?=$Msg_SumitUrl?>">		 
<?PHP
$query_where2="WHERE order_id='".$order_id."'";
//========================================================訂單會員資料========================================================
$CLASS["mem"] = new xfunDB_sql;
$CLASS["mem"]->connect(); 
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list] ".$query_where2." ORDER BY order_date DESC";
  $CLASS["mem"]->query($result_num);
if ($row = $CLASS["mem"]->fetch_array($CLASS["mem"]->result)):

	$order_id=$row["order_id"];
	$lan=$row["lan"];
	$order_name=$row["order_name"];
	$order_recivename=$row["order_recivename"];
	$order_phone=$row["order_phone"];
	$order_mobile=$row["order_mobile"];
	$order_email=$row["order_email"];
	$order_totalprice=$row["order_totalprice"];
	$order_payway=$row["order_payway"];
	$order_date=$row["order_date"];
	$order_mainaddress=$row["order_mainaddress"];
	$order_cartage=$row["order_cartage"];
	$order_status=$row["order_status"];
	$order_note=$row["order_note"];
	$order_invoice_type=$row["order_invoice_type"];
	$order_invoice_title=$row["order_invoice_title"];
	$order_invoice_num=$row["order_invoice_num"];
	$order_invoice_address=$row["order_invoice_address"];
	$last_modify=$row["last_modify"];

endif;
$CLASS["mem"]->free_result($CLASS["mem"]->result);
//========================================================會員資料========================================================
?>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr bgcolor="#CCCCCC" class="title2"> 
    <td height="8" align="center" nowrap> 
     <strong class="style2">‧<?=$SUBTITLE?>‧</strong></td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr>
    <td height="13" valign="top" bgcolor="#EBEBEB">
	<table width="100%" border="0" cellpadding="5" cellspacing="2" background="../../images/000_home/line3.gif" class="bg_bottom">
      <tr>
        <td width="8%" bgcolor="#FFFFFF">訂單編號</td>
        <td width="16%" bgcolor="#FFFFFF"><?=$order_id?></td>
        <td width="4%" bgcolor="#FFFFFF">語系</td>
        <td width="36%" bgcolor="#FFFFFF"><?=$lan=="eng"?"英文":"中文"?></td>
        <td width="8%" bgcolor="#FFFFFF">最後編輯</td>
        <td width="28%" bgcolor="#FFFFFF"><?=$last_modify?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="1243" height="13" valign="top" bgcolor="#EBEBEB">
	<table width="100%" border="0" cellpadding="5" cellspacing="2" background="../../images/000_home/line3.gif" class="bg_bottom">
        <tr>
          <td width="17" align="center" valign="middle" bgcolor="#FFFFFF">#</td>
          <td width="197" align="left" valign="top" bgcolor="#FFFFFF">房型名稱</td>
          <td width="231" align="left" valign="top" bgcolor="#FFFFFF">訂房日期</td>
          <td width="200" align="left" valign="top" bgcolor="#FFFFFF">價格</td>
          <td width="124" align="left" valign="top" bgcolor="#FFFFFF">數量</td>
          <td width="173" align="left" valign="top" bgcolor="#FFFFFF">總金額</td>
        </tr>
<?PHP
$query_where1="WHERE shopping_cartid='".$order_id."' AND shopping_status='B'";
//=========================================================訂購清單========================================================
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] ".$query_where1." ORDER BY shopping_promodel ASC";
//echo $result_num;
  $CLASS["order_view"]->query($result_num);
  $total = $CLASS["order_view"]->num_rows($CLASS["order_view"]->result);	//總筆數
  $num = 0;
	if($total >= 1):
	while ($row = $CLASS["order_view"]->fetch_array($CLASS["order_view"]->result)) {
  	$num = $num + 1;
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
?>
        <tr>
          <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$num?></td>
          <td align="left" valign="top" bgcolor="#FFFFFF"><?=view_kind($shopping_proname,$XFUN_TBL[TABLE_XFUN_rent],"rentNum","projName")?></td>
          <td align="left" valign="top" bgcolor="#FFFFFF"><?=$shopping_promodel?></td>
          <td align="left" valign="top" bgcolor="#FFFFFF"><?=$shopping_price1?></td>
          <td align="left" valign="top" bgcolor="#FFFFFF"><?=$shopping_amount?></td>
          <td align="left" valign="top" bgcolor="#FFFFFF"><?=$shopping_price1*$shopping_amount?></td>
        </tr>
<?
    }  //while_end
?>
        <tr>
          <td colspan="6" align="left" valign="middle" bgcolor="#FFFFFF">訂單內合計
              <?=$shopping_totalAmount?>
間訂房，訂房總金額：NT
<?=$shopping_countTotal?>
元
<br />
本訂單需付款總金額：NT
<?=$order_cartage+$shopping_countTotal?>
元          </p></td>
        </tr>

<?	
endif;
//=========================================================訂購清單========================================================
?>
</table>	</td>
  </tr>
  <tr>
    <td height="5" align="center" valign="top" bgcolor="#EBEBEB"><table width="100%" border="0" cellspacing="1" cellpadding="0">
      <tr>
        <td width="8%" bgcolor="#FFFFFF">發票型式：</td>
        <td width="92%" bgcolor="#FFFFFF"><?=$order_invoice_type?></td>
      </tr>
	  <?
	  if($order_invoice_type != "不需開立"):	  
	  ?>
      <tr>
        <td bgcolor="#FFFFFF">發票抬頭：</td>
        <td bgcolor="#FFFFFF"><?=$order_invoice_title?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">統一編號：</td>
        <td bgcolor="#FFFFFF"><?=$order_invoice_num?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">發票地址：</td>
        <td bgcolor="#FFFFFF"><?=$order_invoice_address?></td>
      </tr>
	  <? endif ?>
    </table></td>
  </tr>
  <tr>
    <td height="5" align="center" valign="top" bgcolor="#EBEBEB"><table width="100%" border="0" cellspacing="1" cellpadding="0">
      <tr>
        <td width="8%" bgcolor="#FFFFFF">訂購人姓名：</td>
        <td width="92%" bgcolor="#FFFFFF"><?=$order_name?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">住房人姓名：</td>
        <td bgcolor="#FFFFFF"><?=$order_recivename?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">聯絡電話：</td>
        <td bgcolor="#FFFFFF"><?=$order_phone?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">行動電話：</td>
        <td bgcolor="#FFFFFF"><?=$order_mobile?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">電子信箱：</td>
        <td bgcolor="#FFFFFF"><?=$order_email?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">聯絡地址：</td>
        <td bgcolor="#FFFFFF"><?=$order_mainaddress?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">交易方式：</td>
        <td bgcolor="#FFFFFF"><?=$order_payway?></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">備註：</td>
        <td bgcolor="#FFFFFF"><?=$order_note?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="6" align="center" valign="top" bgcolor="#EBEBEB">
	<?
//基本設定
$CLASS["msg"] = new xfunDB_sql;
$CLASS["msg"]->connect(); 

?>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="0" >
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;&nbsp;訂單雙向留言</td>
        </tr>
      <tr>
        <td bgcolor="#FFFFFF"><?
		$CLASS["msg"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_msg] WHERE order_id='$order_id' ORDER BY order_msg_cdate DESC");
		$n = 1;
		while ($row = $CLASS["msg"]->fetch_array($CLASS["msg"]->result)) 
		{
			$order_msg_num = $row["order_msg_num"];
			$order_msg_user = $row["order_msg_user"];
			$order_msg_content = $row["order_msg_content"];
			$order_msg_cdate = $row["order_msg_cdate"];
		?>
		<table width="80%" border="0" cellspacing="0" cellpadding="5">
                        <tr>
                          <td width="10" valign="top" align="center" class="style100"><?=$n?>.</td>
                          <td width="300" align="left" valign="top" nowrap="nowrap"><?=nl2br($order_msg_content)?></td>
                          <td width="100" align="right">時間：<?=$order_msg_cdate?><br>作者：<?=$order_msg_user?></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="10" class="bg10_xlefttop"><hr /><a href="<?=$Msg_SumitUrl?>?order_msg_num=<?=$order_msg_num?>&order_id=<?=$order_id?>&act=delete">刪除</a></td>
                        </tr>
        </table>
		<?
		$n++;
		}
		  $CLASS["msg"]->free_result($CLASS["msg"]->result);
		?>		</td>
        </tr>
      <tr>
        <td bgcolor="#FFFFFF">
		<textarea name="order_msg_content" cols="60" rows="10"></textarea>		</td>
        </tr>
    </table>
	
	</td>
  </tr>
  <tr>
    <td height="6" align="center" valign="top" bgcolor="#EBEBEB">
	<input name="order_id" type="hidden" id="order_id" value="<?=$order_id?>" />
          <input name="order_msg_user" type="hidden" id="order_msg_user" value="<?=$sec_id?>" />
            <input name="act" type="hidden" id="act" value="insert" />
<input type="submit" name="Submit" value="送出" />
	<input type="button" name="Submit" value="離開" onclick="location.href='<?=$REDirect_PG?>'" />
	 <a href="#" onclick="MM_openBrWindow('print.php?order_id=<?=$order_id?>','','scrollbars=yes,width=600,height=600')"><img src="../images/Print.gif" border="0" align="absmiddle"></a>	</td>
  </tr>
</table>
</form>	
</body>
</html>
