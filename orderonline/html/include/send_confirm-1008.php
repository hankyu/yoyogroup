<?PHP
//=======================================訂單送出處理程序===========================================
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
$CLASS["order_view"] = new xfunDB_sql;
$CLASS["order_view"]->connect(); 

$REDirect_PG=$lan=="cht"?"../member/member_area.php":"../member/emember_area.php";
$REMsg=$lan=="cht"?"親愛的顧客，您的訂單已成功送出，現在將重新導回查詢訂單系統頁面。請至訂單系統查詢訂單！":"Your Order Has Been Send!";
$REDirect_PG2="../room/cart_list.php";
if($process=="send_order"){
//===================斷定頁面是否重新整理========================
$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list] WHERE order_id = '".$_SESSION["Order_GID"]."'");
$total = $CLASS["db"]->num_rows($CLASS["db"]->result);
if($total >= 1):
		$msg = "<script language='javascript'>redirectURL('$REMsg','$REDirect_PG')</script>";
		echo $msg;
		exit;
else:
//===================斷定頁面是否重新整理========================
	$Cart_ID=$_COOKIE["Cart_ID"];
	$Cdate = date('Y-m-d H:i:s');
	//=================檢查庫存量=================
	if(CHK_Storage($Cart_ID)>0)
	{
		$msg = "<script language='javascript'>redirectURL('".$m1=$lan=="cht"?"親愛的顧客，房間數量不足，請重新調整謝謝！":"Quantity of room is not enough; please modify your request. ','$REDirect_PG2')</script>";
		echo $msg;
		exit;
	}else{
		UDP_Storage($Cart_ID);
	}
	//==============訂單資料處理程序==============
	$result_max_event = mysql_query("SELECT MAX(order_id) FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list]");
	$row_max_event = mysql_fetch_array($result_max_event);
	$max_orderid_event = $row_max_event["MAX(order_id)"];
	//echo $max_orderid_event;
	//exit;
	$order_mainaddress=$lan=="cht"?"(".$Zip.")".$City.$Town.$add:$add;
	$nnn=rand(100,999);
	$Order_GID =(date('Y')-1911).date('md').$nnn; //訂單編號
	$_SESSION["Order_GID"]=$Order_GID;
	$Order = new XFUN_SQLHelp();
	$Order->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_order_list];
	$Order->ClassTitle = "訂單資料";
	$Order->DB_Field = "`lan`,`order_id`,`order_name`,`order_recivename`,`order_phone`,`order_mobile`,`order_email`,`order_mainaddress`,`order_address`,`order_totalprice`,`order_cartage`,`order_payway`,`order_date`,`order_status`,`order_note`,`order_invoice_type`,`order_invoice_title`,`order_invoice_num`,`order_invoice_address`";
	$Order->DB_Values = "'$lan','$Order_GID','$order2_name','$order2_recivename','$order2_phone','$order2_cell','$order2_email','$order_mainaddress','$order2_address',$order_totalprice,0,'$order2_paykind','$Cdate','A1','$order2_note','$order_invoice_type','$invoice_title','$invoice_num','$invoice_address'";
	/*$Order->DB_updValues = "`order_id`='$Order_GID',`order_name`='$order2_recivename',`order_phone`='$order2_phone',`order_mobile`='$order2_cell',`order_email`='$order2_email',`order_address`='$order2_address',`order_totalprice`='$order_totalprice',`order_cartage`='$order_cartage',`order_payway`='$order2_paykind',`order_date`='$Cdate',`order_status`='A1',`order_note`='$order2_note' WHERE order_id=$Cart_ID";*/
	if($Order->ActDataAccess("insert")):
		$Num = $Order->DB_InsertID;
		$Insert_DB=true;
		/*$msg = "<script language='javascript'>redirectURL('".$Order->ClassActTitle.$Order->ClassTitle."成功！','$REDirect_PG2')</script>";*/
	else:
		$Insert_DB=false;
		$msg = $lan=="cht"?"系統錯誤!請通知系統管理者。":"System error!";
	endif;
	
	//==============購物清單資料處理程序==============
	$Order_Pro = new XFUN_SQLHelp();
	$Order_Pro->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_shopping_item];
	$Order_Pro->ClassTitle = "訂單資料";
	$Order_Pro->DB_updValues = "`shopping_cartid`='$Order_GID',`shopping_status`='B' WHERE shopping_cartid = '$Cart_ID'";
	if($Order_Pro->ActDataAccess("update")):
		$Num = $Order_Pro->DB_InsertID;
		$Insert_DB=true;
		$msg = "<script language='javascript'>redirectURL('".$m2=$lan=="cht"?"親愛的顧客，您的訂單已成功送出，我們會盡快幫您處理！":"Your order has been send. Thanks!"."','$REDirect_PG')</script>";
	else:
		$Insert_DB=false;
		$msg = $lan=="cht"?"系統錯誤!請通知系統管理者。":"System error!";
	endif;


	//========================訂單資料傳送======================
	if($lan=="cht"){
	$body = "<table width='700' border='1' align='center' cellpadding='0' cellspacing='0' bordercolorlight='#CCCCCC' bordercolordark='#FFFFFF'>";
	$body .= "<tr><td bgcolor='#3399CC' height='60'><div align='center'><font color='#FFFFFF' size='3'>".$XFUN_CONFIG[CONFIG_WEB_TITLE]."-訂房成功確認單<strong></strong></font></div></td></tr>";
	$body .= "<tr><td><table width='95%' align='center'><tr><td>";
	$body .= "<font size='2'>親愛的".$order2_name." 先生/小姐　您好：<br><br> 感謝您於 " .$Cdate. " 在「企業家大飯店線上訂房系統」訂房成功！<br>";
	$body .= "您選擇的交易方式為：<font color=#639c00 size='3'><b>" .$order2_paykind. "</b></font>，請您儘快完成付款手續。<a href='http://www.gohotel.com.tw/orderonline/html/include/order_help.php'>→付款方式按此查看</a><br><br>";
	$body .= "<font color=#ec8000 size='3'><b>您的訂單編號為：" .$Order_GID. "</b></font><br>";
	$body .= "您所訂購的房間如下：</font><br>";
	}else{
	$body = "<table width='700' border='1' align='center' cellpadding='0' cellspacing='0' bordercolorlight='#CCCCCC' bordercolordark='#FFFFFF'>";
	$body .= "<tr><td bgcolor='#3399CC' height='60'><div align='center'><font color='#FFFFFF' size='2'>The Enterpriser Hotel Reservation Voucher<strong></strong></font></div></td></tr>";
	$body .= "<tr><td><table width='95%' align='center'><tr><td>";
	$body .= "<font size='2'>Dear ".$order2_name."：<br><br> Thanks for your booking at 「The Enterpriser Hotel Online Order System」(" .$Cdate. ") We are pleased to advise you that the room(s) has been reserved for you at your selected dates.<br>";
	$body .= "Type of Payment：<font color=#639c00 size='3'><b>" .$order2_paykind. "</b></font>，please check <a href='http://www.gohotel.com.tw/orderonline/html/include/order_help.php?ck=e'>→Type of Payment</a>.<br><br>";
	$body .= "<font color=#ec8000 size='3'><b>Reservation Number：" .$Order_GID. "</b></font><br>";
	$body .= "Reservation Details：</font><br>";
	}
	
	$body .= "<table width='90%' border='1' align='center' cellpadding='3' cellspacing='0' bordercolorlight='#CCCCCC' bordercolordark='#FFFFFF'>";
	$body .= "<tr bgcolor='#659cd2'>" ;
	$body .= "<td width='40'　bgcolor='#659cd2'><div align='center'><font color='#FFFFFF' size='2'>#</td>";
	$body .= "<td width='150'　bgcolor='#659cd2'><div align='center'><font color='#FFFFFF' size='2'>".$a=$lan=="cht"?"房型名稱":"Room Type"."</td>";
	$body .= "<td width='150'　bgcolor='#659cd2'><div align='center'><font color='#FFFFFF' size='2'>".$b=$lan=="cht"?"訂房日期":"Date"."</td>";
	$body .= "<td width='150'　bgcolor='#659cd2'><div align='center'><font color='#FFFFFF' size='2'>".$c=$lan=="cht"?"價格":"Price"."</td>";
	$body .= "<td width='50'　bgcolor='#659cd2'><div align='center'><font color='#FFFFFF' size='2'>".$d=$lan=="cht"?"數量":"Rates"."</td>";
	$body .= "<td width='50'　bgcolor='#659cd2'><div align='center'><font color='#FFFFFF' size='2'>".$e=$lan=="cht"?"小計":"Subtotal"."</td>";
	$body .= "</tr>";
	
	//=====================================================訂購清單====================================================
	$query_where="WHERE shopping_cartid='".$Order_GID."' AND shopping_status='B'";
	  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] ".$query_where." ORDER BY shopping_promodel ASC ";
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
		$shopping_countTotal=$shopping_price1*$shopping_amount;
		$shopping_totalAmount+=$shopping_amount;
		$Total_Pay+=$shopping_countTotal;
		$pjName=$lan=="cht"?"projName":"en_projName";
	  
	$body .= "<tr>";
	$body .= "<td> <div align='center'><font size='2'>" .$num. "</td>";
	$body .= "<td> <div align='center'><font size='2'>" .view_kind($shopping_proname,$XFUN_TBL[TABLE_XFUN_rent],"rentNum",$pjName). "</td>";
	$body .= "<td> <div align='center'><font size='2'>" .$shopping_promodel. "</td>";
	$body .= "<td> <div align='center'><font size='2'>" .$shopping_price1. "</td>";
	$body .= "<td> <div align='center'><font size='2'>" .$shopping_amount. "</td>";
	$body .= "<td> <div align='center'><font size='2'>" .$shopping_countTotal. "</td>";
	$body .= "</tr>";
	
		}  //while_end
		endif;
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
	//=================================================================================================================
	if($lan=="cht"){
	$body .= "</table>";
	$body .= "<div align='center'><font color=#ec8000 size='3'>您需支付的總金額：" .$Total_Pay. "元 </font></div><br><br><br><font size='2'>請依照訂單所示金額及付款方式，於三日內完成付款手續，並於繳款完成後來電、傳真或e-mail告知飯店人員付款相關訊息。如逾期未完成付款確認，本訂單將自動取消不另行通知，且無法為您保留房間。<br><br>您也可至【<a href='http://www.gohotel.com.tw/orderonline/html/member/member_area.php'>訂單查詢</a>】系統查詢您的訂單處理進度。<br>若您有任何疑問歡迎您直接撥打客服專線，期待您的光臨，謝謝！<br><br><div align='center'>【客服專線：".$XFUN_CONFIG[CONFIG_WEB_PHONE]."】<br>【傳真號碼：".$XFUN_CONFIG[CONFIG_WEB_FAX]."】<br>【客服信箱：<a href='mailto:".$XFUN_CONFIG[CONFIG_WEB_EMAIL]."'>".$XFUN_CONFIG[CONFIG_WEB_EMAIL]."</a>】</div></font>";
	}else{
	$body .= "</table>";
	$body .= "<div align='center'><font color=#ec8000 size='3'>Total amount payable: NT " .$Total_Pay. "</font></div><br><br><br><font size='2'>The full payment of hotel accommodation should be completed within 3 days after you make an online booking. Your reservation is not confirmed until we receive your fax of “Credit Card Authorization Form” with cardholder’s signature. <br><br>Your reservation status can be checked online via the【<a href='http://www.gohotel.com.tw/orderonline/html/member/emember_area.php'>Reservation Inquiry</a>】page.<br>For any further concerns, please don’t be hesitated to write us an E-Mail :<a href='mailto:".$XFUN_CONFIG[CONFIG_WEB_EMAIL]."'>".$XFUN_CONFIG[CONFIG_WEB_EMAIL]."</a> <br>
	Thanks for staying with us, and we look forward to serving you very soon.
	<br><br><div align='center'>【TEL：".$XFUN_CONFIG[CONFIG_WEB_PHONE]."】<br>【Fax：".$XFUN_CONFIG[CONFIG_WEB_FAX]."】<br>【Email：<a href='mailto:".$XFUN_CONFIG[CONFIG_WEB_EMAIL]."'>".$XFUN_CONFIG[CONFIG_WEB_EMAIL]."</a>】</div></font>";
	}
	$body .= "</td></tr></table>";
	$body .= "<div align='right'><a href='http://www.gohotel.com.tw/'>".$f=$lan=="cht"?$XFUN_CONFIG[CONFIG_WEB_TITLE]:"The Enterpriser Hotel"."</a></div>";
	$body .= "</td></tr></table>";


//'========================主旨、收件者設定======================

	$SenderEmail=$XFUN_CONFIG[CONFIG_WEB_EMAIL];
	$ReciveEmail=$order2_email;
	$SenderName=$WEB_TITLE;
	$AtchFile=$swf;
				$mail = new PHPMailer();
				$mail->CharSet = "UTF-8";
				$mail->Encoding = "base64";
				$mail->AddAttachment($AtchFile,$AtchFile,"base64","application/octet-stream");
				$mail->From = $SenderEmail;
				$mail->FromName = $SenderName;
				$mail->AddAddress($ReciveEmail);
				$mail->AddBCC($XFUN_CONFIG[CONFIG_WEB_EMAIL]);
				$mail->AddBCC($XFUN_CONFIG[CONFIG_WEB_BCCMAIL]);
				$mail->AddBCC($XFUN_CONFIG[CONFIG_WEB_BCCMAIL2]);
				$mail->AddReplyTo($sendemail, "HUNG-TOOLING");
				
				$mail->WordWrap = 40;
				$mail->IsHTML(true);

				$mail->Subject = $lan=="cht"?"企業家大飯店訂房成功確認單":"Successful Booking – The Enterpriser Hotel Online Order System";
				$mail->Body    = $body;
				$mail->AltBody = "$send_msg";
				
				if(!$mail->Send())
				{
				   $mailmsg = "<p><font color=red>".$lan=="cht"?"郵件伺服器錯誤，請聯絡系統管理者。":"System error!"."</font></p>";
				   $mailmsg .= "<p><font color=red>錯誤訊息: " . $mail->ErrorInfo ."</font></p>";
				   //exit;
				}
//=========================== SendEmail ===========================


endif;
$CLASS["db"]->free_result($CLASS["db"]->result);//釋放資料庫	
}
//=======================================訂單送出處理程序===========================================
?>

<form action="<?=$Send_OrderFrom_URL?>" method="post" name="reg" id="reg" style="margin-top: 0" onSubmit="return check(this)">
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
     <font color=666666><B><?=$lan=="cht"?"交易總金額":"Payment Amount"?>：</B></font><font color=blue><B><?=($shopping_countTotal+$cartage)?></B></font>
	 <br />
	 <font color=666666><B><?=$lan=="cht"?"訂房人":"Order Person"?>：<?=$order_name?></B></font> <br />
	 <font color=666666><B><?=$lan=="cht"?"聯絡電話":"Phone Number"?>：<?=$order_phone?></B></font> <br />
	 <font color=666666><B><?=$lan=="cht"?"聯絡地址":"Contact Address"?>：<?=$order_mainaddress?></B></font> <br />
	 <font color=666666><B><?=$lan=="cht"?"訂購日期":"Order Date"?>：<?=$Cdate?></B></font> <br />
	   
	 <?=$lan=="cht"?"建議您":"We suggest you "?> <a href="#" onclick="MM_openBrWindow('../include/print.php?oid=<?=$Order_GID?>&lan=<?=$lan?>&pri=<?=$shopping_countTotal+$cartage?>','','scrollbars=yes,width=600,height=600')"><img src="../../admin/images/<?=$lan=="cht"?"Print":"ePrint"?>.gif" alt="<?=$lan=="cht"?"列印":"print this"?>" width="87" height="20" / border="0"></a> <?=$lan=="cht"?"內容，並保留下來，以便日後查詢。":" page out now, for later review"?>	</div>
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
</form>