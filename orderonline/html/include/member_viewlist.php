<?PHP
//基本設定
$CLASS["order_view"] = new xfunDB_sql;
$CLASS["order_view"]->connect(); 

$TITLE = "訂單管理系統";		//主標題
$SUBTITLE = "訂購商品清單";		//次標題
$REDirect_PG=$lan=="cht"?"member_area.php?act=orderlist":"emember_area.php?act=orderlist";
$Msg_SumitUrl="../include/order_msgSubmit.php";
?>
<link href="../../js/type2.css" rel="stylesheet" type="text/css">



	<table width="80%" border="0" cellpadding="5" cellspacing="1">
        <tr align="center">
          <td bgcolor="#FAF7F1" class="tdList01">#</td>
          <td bgcolor="#FAF7F1" class="tdList01"><?=$lan=="cht"?"房型名稱":"Room Type"?></td>
          <td bgcolor="#FAF7F1" class="tdList01"><?=$lan=="cht"?"訂房日期":"Date"?></td>
          <td bgcolor="#FAF7F1" class="tdList01"><?=$lan=="cht"?"價格":"Price"?></td>
          <td bgcolor="#FAF7F1" class="tdList01"><?=$lan=="cht"?"數量":"Room(s)"?></td>
          <td bgcolor="FAF7F1" class="tdList01"><?=$lan=="cht"?"總金額":"Total Price"?></td>
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
          <td colspan="6" valign="middle" bgcolor="#F0E2C5"> <?=$lan=="cht"?"訂單內合計":"The reservation includes"?>
              <?=$shopping_totalAmount?>
<?=$lan=="cht"?"房間，金額為":" room(s), the total price is"?>：NT
<?=$shopping_countTotal?><br />
<br />
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
        <td align="left" bgcolor="#F0E2C5"><?=$order_invoice_type?></td>
      </tr>
	  <?
	  if($order_invoice_type != "不需開立"):	  
	  ?>
      <tr>
        <td align="right" nowrap class="tdList01">發票抬頭：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_invoice_title?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01">統一編號：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_invoice_num?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01">發票地址：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_invoice_address?></td>
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
        <td width="80%" align="left" bgcolor="#F0E2C5"><?=$order_name?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"住房人姓名":"Occupant’s Name "?>：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_recivename?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"聯絡電話":"Phone Number"?>：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_phone?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"行動電話":"Mobile Number"?>：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_mobile?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"電子信箱":"EMail"?>：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_email?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"聯絡地址":"Contact Address"?>：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_address?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"交易方式":"Type of Payment"?>：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_payway?></td>
      </tr>
      <tr>
        <td align="right" nowrap class="tdList01"><?=$lan=="cht"?"備註":"Remark"?>：</td>
        <td align="left" bgcolor="#F0E2C5"><?=$order_note?></td>
      </tr>
    </table>
	<br>
	<?
//基本設定
$CLASS["msg"] = new xfunDB_sql;
$CLASS["msg"]->connect(); 

?>
<form id="form1" name="form1" method="post" action="<?=$Msg_SumitUrl?>">		 
    <table width="80%" border="0" cellpadding="5" cellspacing="1">
      <tr>
        <td class="tdList01">&nbsp;&nbsp;<?=$lan=="cht"?"訂單雙向留言":"Interactive Message"?></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#F0E2C5">
		<?
		$CLASS["msg"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_msg] WHERE order_id='$order_id' ORDER BY order_msg_cdate DESC");
		$n = 1;
		while ($row = $CLASS["msg"]->fetch_array($CLASS["msg"]->result)) 
		{
			$order_msg_user = $row["order_msg_user"];
			$order_msg_content = $row["order_msg_content"];
			$order_msg_cdate = $row["order_msg_cdate"];
		?>
		<table width="80%" border="0" cellspacing="0" cellpadding="5">
                        <tr>
                          <td width="10" valign="top" align="center" class="style100"><?=$n?>.</td>
                          <td width="300" align="left" valign="top" nowrap="nowrap" bgcolor="#F0E2C5"><?=nl2br($order_msg_content)?></td>
                          <td width="100" align="right"><?=$lan=="cht"?"時間":"Date"?>：<?=$order_msg_cdate?><br><?=$lan=="cht"?"作者":"Author"?>：<?=$order_msg_user?></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="10" class="bg10_xlefttop"><hr /></td>
                        </tr>
        </table>
		<?
		$n++;
		}
		  $CLASS["msg"]->free_result($CLASS["msg"]->result);
		?>		</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#F0E2C5">
          <textarea name="order_msg_content" cols="60" rows="10"></textarea>        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#F0E2C5"><input name="lan" type="hidden" id="lan" value="<?=$lan?>" />
        <input name="order_id" type="hidden" id="order_id" value="<?=$order_id?>" />
          <input name="order_msg_user" type="hidden" id="order_msg_user" value="<?=$_SESSION['smember_name']?>" />
            <input name="act" type="hidden" id="act" value="insert" />
			<input type="submit" name="Submit" value=" <?=$lan=="cht"?"送 出":"Submit"?> " class="input03"/>
			<input name="button" type="button" value=" <?=$lan=="cht"?"離 開":"Exit"?> " onclick="location='<?=$REDirect_PG?>'" class="input03"/>
			<input name="button" type="button" value=" <?=$lan=="cht"?"列印本頁":"Print"?> " onclick="MM_openBrWindow('../include/print2.php?order_id=<?=$order_id?>&lan=<?=$lan?>','','scrollbars=yes,width=600,height=600')" class="input03"/>		</td>
      </tr>
    </table>
</form>	