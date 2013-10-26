<?php
$PageTitle=" - 優惠專案訂房系統";
include("../include/head.php");
$CLASS["order_view"] = new xfunDB_sql;
$CLASS["order_view"]->connect(); 

?>
<script>
window.print();
</script>
<link href="../../js/type2.css" rel="stylesheet" type="text/css">

	<table width="80%" border="0" cellpadding="5" cellspacing="1">
        <tr align="center">
          <td bgcolor="#FFF4DD" class="tdList01">#</td>
          <td bgcolor="#FFF4DD" class="tdList01"><?=$lan=="cht"?"房型名稱":"Room Type"?></td>
          <td bgcolor="#FFF4DD" class="tdList01"><?=$lan=="cht"?"訂房日期":"Date"?></td>
          <td bgcolor="#FFF4DD" class="tdList01"><?=$lan=="cht"?"價格":"Price"?></td>
          <td bgcolor="#FFF4DD" class="tdList01"><?=$lan=="cht"?"數量":"Room(s)"?></td>
          <td bgcolor="#FFF4DD" class="tdList01"><?=$lan=="cht"?"總金額":"Total Price"?></td>
        </tr>
<?PHP
$query_where2="WHERE order_id='".$order_id."'";
//========================================================訂單會員資料========================================================
$CLASS["mem"] = new xfunDB_sql;
$CLASS["mem"]->connect(); 
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list] ".$query_where2." ORDER BY order_date DESC";
  $CLASS["mem"]->query($result_num);
if ($row = $CLASS["mem"]->fetch_array($CLASS["mem"]->result)):

	$order_id=$row["order_id"];
	$order_name=$row["order_name"];
	$order_recivename=$row["order_recivename"];
	$order_phone=$row["order_phone"];
	$order_mobile=$row["order_mobile"];
	$order_email=$row["order_email"];
	$order_totalprice=$row["order_totalprice"];
	$order_payway=$row["order_payway"];
	$order_date=$row["order_date"];
	$order_address=$row["order_address"];
	$order_cartage=$row["order_cartage"];
	$order_status=$row["order_status"];
	$order_note=$row["order_note"];
	$order_invoice_type=$row["order_invoice_type"];
	$order_invoice_title=$row["order_invoice_title"];
	$order_invoice_num=$row["order_invoice_num"];
	$order_invoice_address=$row["order_invoice_address"];
endif;
$CLASS["mem"]->free_result($CLASS["mem"]->result);

//========================================================會員資料========================================================
?>

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
	$pjName=$lan=="cht"?"projName":"en_projName";
?>
        <tr align="center" bgcolor="#FFFFFF">
          <td class="tdList02"><?=$num?></td>
          <td class="tdList02"><?=view_kind($shopping_proname,$XFUN_TBL[TABLE_XFUN_rent],"rentNum",$pjName)?></td>
          <td class="tdList02"><?=$shopping_promodel?></td>
          <td class="tdList02"><?=$shopping_price1?></td>
          <td class="tdList02"><?=$shopping_amount?></td>
          <td class="tdList02"><?=$shopping_price1*$shopping_amount?></td>
        </tr>
<?
    }  //while_end
	$CLASS["order_view"]->free_result($CLASS["order_view"]->result);

?>
        <tr align="center" bgcolor="#FFFFFF">
          <td colspan="6" valign="middle"> <?=$lan=="cht"?"訂單內合計":"The reservation includes"?>
              <?=$shopping_totalAmount?>
<?=$lan=="cht"?"房間，金額為":" room(s), the total price is"?>：NT
<?=$shopping_countTotal?><br /><br />
<?=$lan=="cht"?"本訂單需付款總金額":"Total amount payable"?>：NT
<?=$order_cartage+$shopping_countTotal?></p></td>
        </tr>

<?	
endif;
//=========================================================訂購清單========================================================
?>
</table>
<?
	   if($lan=="cht"){
?>
<br>
<table width="80%" border="0" cellpadding="5" cellspacing="1" style="display:<?=$lan=="cht"?"":"none"?>">
      <tr>
        <td width="120" align="right" nowrap class="tdList01">發票型式：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_invoice_type?></td>
      </tr>
	  <?
	  if($order_invoice_type != "不需開立"):	  
	  ?>
      <tr>
        <td align="right" nowrap class="tdList01">發票抬頭：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_invoice_title?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01">統一編號：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_invoice_num?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01">發票地址：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_invoice_address?></td>
      </tr>
	  <?
	  endif;
	  ?>
    </table>
<br>
<? }?>
<table width="80%" border="0" cellpadding="5" cellspacing="1">
      <tr>
        <td width="20%" align="right" nowrap class="tdList01"><?=$lan=="cht"?"訂購人姓名":"Full Name of Order Person"?>：</td>
        <td width="80%" align="left" bgcolor="#FFFFFF"><?=$order_name?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"住房人姓名":"Occupant’s Name "?>：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_recivename?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"聯絡電話":"Phone Number"?>：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_phone?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"行動電話":"Mobile Number"?>：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_mobile?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"電子信箱":"EMail"?>：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_email?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"聯絡地址":"Contact Address"?>：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_address?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"交易方式":"Type of Payment"?>：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_payway?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"備註":"Remark"?>：</td>
        <td align="left" bgcolor="#FFFFFF"><?=$order_note?></td>
      </tr>
    </table>

<?
include("../include/foot.php");
?>
