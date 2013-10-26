<?php
$PageTitle=" - 優惠專案訂房系統";
include("../include/head.php");
$CLASS["order_view"] = new xfunDB_sql;
$CLASS["order_view"]->connect(); 

	//======================================================訂單資訊====================================================
	$CLASS["Order"] = new xfunDB_sql;
	$CLASS["Order"]->connect(); 
	$result_order = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list] WHERE order_id = '$Order_GID'";
	$CLASS["Order"]->query($result_order);
	if($row = $CLASS["Order"]->fetch_array($CLASS["Order"]->result)){
		$order_name=$row["order_name"];
		$order_mainaddress=$row["order_mainaddress"];
		$order_phone=$row["order_phone"];
		$order_payway=$row["order_payway"];
	}
	$CLASS["Order"]->free_result($CLASS["Order"]->result);
$Cdate = date('Y-m-d H:i:s');
?>
<script>
window.print();
</script>
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="1" >
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff">
	<?
	if($lan=="cht"){
	?>
	<font size="3"><B>【訂房成功！謝謝您使用企業家大飯店線上訂房系統】</B></font>
	<div style='padding-left:10px; padding-right:80px; text-align:left;color:#660000; width:100%'>
	<ul>
	  <li>訂房完成後，請依照訂單所示金額及付款方式，於三日內完成付款手續，並聯絡告知飯店人員付款訊息(如帳號後五碼或匯款人姓名)，或回傳單據以完成訂房確認。
如逾期未完成付款確認，本訂單將自動取消不另行通知，且無法為您保留房間。</li>
        <li>住房人入住當日請攜帶身分證、駕照或護照正本證件，提供人員查核登記，並告知訂單編號， 以利人員為您服務。</li>
        <li>如欲更改訂房日期、房型、房數，或欲取消訂房，請直接聯絡飯店客服人員，依相關規定協助辦理。</li>
		<li>若有線上訂房操作、交易情形紀錄、飯店環境設備等問題，請電洽企業家大飯店人員為您服務。</li>
		<li>客服專線：(04)22207733 / 傳真：(02)22217540 / 電子信箱： service@gohotel.com.tw</li>	
    </ul>
	</div>
	<?
	}else{
	?>
	<font size="3"><B>=== Reservation Voucher ===</B></font>
	<font size="3"><B><br />
	【Thank you for your booking】</B></font>
	<div style='padding-left:10px; padding-right:80px; text-align:left;color:#660000; width:100%'>
	<ul>
		<li>The full payment of hotel accommodation should be completed in 3 days after you make an online booking. Your reservation is not confirmed until we confirm this payment and send the follow-up email to you.</li>
		<li>ID (or passport) and reservation vouchers must be presented for check-in. Your credit card details are required to guarantee your reservation and payment upon your arrival at the hotel.</li>
		<li>If you want to change or cancel your reservation, please contact us.</li>
		<li>TEL: 886-4-22207733  /  FAX: 886-4-22217540  /  E-Mail: service@gohotel.com.tw</li>
	</ul>
	</div>
	<?}?>
	<br>
	<font color='#990000'> <?=$lan=="cht"?"以下為您的訂房資訊，請記下您的訂單編號，以供查詢訂單處理進度，謝謝！":"Your Reservation Details (Please use reservation number to check reservation online)"?></font>	</td>
  </tr>
  <tr>
  <td align="center" valign="top" bgcolor="#ffffff">
	<div align="left" style="padding-left:45px">
	 <font color=666666><B class="style4gbu"><?=$lan=="cht"?"訂單編號為":"Reservation Number"?>：</B></font><font color=blue><B><?=$Order_GID?></B></font> <br>
     <font color=666666><B><?=$lan=="cht"?"交易總金額":"Payment Amount"?>：</B></font><font color=blue><B><?=$pri?></B></font>
	 <br />
	 <font color=666666><B><?=$lan=="cht"?"訂房人":"Order Person"?>：<?=$order_name?></B></font> <br />
	 <font color=666666><B><?=$lan=="cht"?"聯絡電話":"Phone Number"?>：<?=$order_phone?></B></font> <br />
	 <font color=666666><B><?=$lan=="cht"?"聯絡地址":"Contact Address"?>：<?=$order_mainaddress?></B></font> <br />
	 <font color=666666><B><?=$lan=="cht"?"訂購日期":"Order Date"?>：<?=$Cdate?></B></font> <br />
	 </div>
	</td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff">
	<div style="text-align:left; padding-left:50px; padding-bottom:10px; padding-top:10px;">
	<?
if(trim($order_payway)=="ATM/匯款"){
?>
<br />
<div style="color:#993300; font-size:14; font-weight:bold; padding:5px">◆ATM轉帳/匯款 帳號</div>
<font color="#CC0000">
<strong>
行　號: 013<br/>
銀行名: 國泰世華銀行  東台中分行<br />
戶　名: 企業家旅館有限公司 （負責人：郭秋榆）<br />
帳　號: 235-03-000701-5 </strong><br />
</font>
<?
}
if($order_payway=="傳真刷卡"||$order_payway=="Credit Card via FAX"){
$downloadfile=$lan=="cht"?"下載傳真刷卡付款單":"Download Credit Card Authorization Form";
$downloadURL=$lan=="cht"?"<a href='../include/cd.pdf' target='blank'><img src='../../admin/images/icon07.gif' alt='$downloadfile' width='21' height='21' border='0'/>$downloadfile<a/>":"<a href='../include/Credit Card Authorization Form.pdf' target='blank'><img src='../../admin/images/icon07.gif' alt='$downloadfile' width='21' height='21' border='0'/>$downloadfile<a/>";
echo $downloadURL;
}
?>
	</div>
	<table width="90%" border="0" cellpadding="5" cellspacing="1" >
        <tr align="center">
          <td width="17" bgcolor="#FFFFCC" class="tdList01">#</td>
          <td width="133" bgcolor="#FFFFCC" class="tdList01"><?=$lan=="cht"?"房型名稱":"Room Type"?></td>
          <td width="130" bgcolor="#FFFFCC" class="tdList01"><?=$lan=="cht"?"住宿日期":"Date"?></td>
          <td width="52" bgcolor="#FFFFCC" class="tdList01"><?=$lan=="cht"?"價格":"Price"?></td>
          <td width="76" bgcolor="#FFFFCC" class="tdList01"><?=$lan=="cht"?"數量":"Room(s)"?></td>
          <td width="170" bgcolor="#FFFFCC" class="tdList01"><?=$lan=="cht"?"總金額":"Total Amount"?></td>
        </tr>

<?PHP
$query_where1="WHERE shopping_cartid='".$Order_GID."' AND shopping_status='B'";
$shopping_totalAmount=0;
$shopping_countTotal=0;
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
        <tr align="center" bgcolor="#ffffff">
          <td><?=$num?></td>
          <td><?=view_kind($shopping_proname,$XFUN_TBL[TABLE_XFUN_rent],"rentNum",$pjName)?></td>
          <td><?=$shopping_promodel?></td>
          <td><?=$shopping_price1?></td>
          <td><?=$shopping_amount?></td>
          <td><?=$shopping_price1*$shopping_amount?></td>
        </tr>
<?
    }  //while_end
	$CLASS["order_view"]->free_result($CLASS["order_view"]->result);//釋放資料庫	

?>
        <tr align="center" bgcolor="#FFFFFF">
          <td colspan="6" valign="middle">
		  <?=$lan=="cht"?"訂單內合計":"The reservation includes"?>
		  <?=$shopping_totalAmount?>
		  <?=$lan=="cht"?"房間，金額為":" room(s), the total price is"?>：NT
<?=$shopping_countTotal?>
<br /> 
<br />
 <?=$lan=="cht"?"本訂單需付款總金額":"Total amount payable"?>
：NT
<?=$cartage+$shopping_countTotal?>
          </p></td>
        </tr>

<?	
endif;
//=========================================================訂購清單========================================================
?>
</table>	</td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff">
<?
if($lan=="cht"){
?>	
	<div align="left" style="padding-left:45px;">
1. 若您需查詢訂單進度，請先至"查詢訂單"系統，輸入您的訂單編號查詢您的訂單處理進度。 <br />
2. 若有任何疑問歡迎您直接撥打 <?=$XFUN_CONFIG[CONFIG_WEB_PHONE]?>，我們將為您服務。 <br />
<font color="#FF0000">3. 傳真或電話確認是必須的步驟。</font></div>	
<?
}else{
?>
<div align="left" style="padding-left:45px;">
1. You can check reservation result via “Reservation Inquiry” page.<br />
2. For any further questions, please don’t be hesitated to write us a E-Mail : service@gohotel.com.tw<br />
</div>	
<?
}
?>
</td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"><?=$mailmsg?></td>
  </tr>
</table>
<?
include("../include/foot.php");
?>
