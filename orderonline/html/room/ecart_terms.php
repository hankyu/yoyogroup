<?php
$PageTitle=" - The Enterpriser Hotel Online Order System";
include("../include/head.php");
?>
<style>
div.scroll {
	background-color:#FFF2E6;
	scrollbar-highlight-color :#d4edfd;   /*左上外框內緣*/
	scrollbar-shadow-color    :#d4edfd;   /*右下外框內緣-深色*/
	scrollbar-darkshadow-color:#BF8200;   /*右下外框邊緣*/ 
	scrollbar-3dlight-color   :#BF8200;   /*左上外框邊緣-深色*/
	scrollbar-arrow-color     :#d4edfd;   /*箭頭*/
	scrollbar-face-color      :#BF8200;   /*面板*/ 
	scrollbar-track-color     :#BF8200;   /*面板底色*/
	/*overflow-y: hidden; /*隱藏垂直SCROLLBAR*/
	overflow-x: hidden;  /*隱藏水平SCROLLBAR*/
	height: 500px;
	width: 600px;
	overflow: auto;
	/*border: 1px solid #666;*/
	padding: 8px;
}
div.scroll1 {	background-color:#FAF7F1;
	scrollbar-highlight-color :#FFFFFF;   /*左上外框內緣*/
	scrollbar-shadow-color    :#FFFFFF;   /*右下外框內緣-深色*/
	scrollbar-darkshadow-color:#FFFFFF;   /*右下外框邊緣*/ 
	scrollbar-3dlight-color   :#FFFFFF;   /*左上外框邊緣-深色*/
	scrollbar-arrow-color     :#FFFFFF;   /*箭頭*/
	scrollbar-face-color      :#FAF7F1;   /*面板*/ 
	scrollbar-track-color     :#FAF7F1;   /*面板底色*/
	/*overflow-y: hidden; /*隱藏垂直SCROLLBAR*/
	overflow-x: hidden;  /*隱藏水平SCROLLBAR*/
	height: 500px;
	width: 600px;
	overflow: auto;
	/*border: 1px solid #666;*/
	padding: 8px;
}
</style>
  <table border="0" cellpadding="0" cellspacing="0" width="740">
    <!-- fwtable fwsrc="ordermenu.png" fwbase="ordermenu.jpg" fwstyle="Dreamweaver" fwdocid = "762039254" fwnested="0" -->
    <tr>
      <td><img src="img/spacer.gif" width="11" height="1" border="0" alt="" /></td>
      <td><img src="img/spacer.gif" width="9" height="1" border="0" alt="" /></td>
      <td><img src="img/spacer.gif" width="335" height="1" border="0" alt="" /></td>
      <td><img src="img/spacer.gif" width="331" height="1" border="0" alt="" /></td>
      <td><img src="img/spacer.gif" width="38" height="1" border="0" alt="" /></td>
      <td><img src="img/spacer.gif" width="16" height="1" border="0" alt="" /></td>
      <td><img src="img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="6"><img name="ordermenu_r1_c1" src="img/ordermenu_r1_c1.jpg" width="740" height="21" border="0" id="ordermenu_r1_c1" alt="" /></td>
      <td><img src="img/spacer.gif" width="1" height="21" border="0" alt="" /></td>
    </tr>
    <tr>
      <td rowspan="2"><img name="ordermenu_r2_c1" src="img/ordermenu_r2_c1.jpg" width="11" height="93" border="0" id="ordermenu_r2_c1" alt="" /></td>
      <td rowspan="2" colspan="3"><img name="enordermenu_r2_c2" src="img/enordermenu_r2_c2.jpg" width="675" height="93" border="0" id="ordermenu_r2_c2" alt="" /></td>
      <td><a href="JavaScript:self.close()"><img name="ordermenu_r2_c5" src="img/ordermenu_r2_c5.jpg" width="38" height="26" border="0" id="ordermenu_r2_c5" alt="" /></a></td>
      <td rowspan="2"><img name="ordermenu_r2_c6" src="img/ordermenu_r2_c6.jpg" width="16" height="93" border="0" id="ordermenu_r2_c6" alt="" /></td>
      <td><img src="img/spacer.gif" width="1" height="26" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img name="ordermenu_r3_c5" src="img/ordermenu_r3_c5.jpg" width="38" height="67" border="0" id="ordermenu_r3_c5" alt="" /></td>
      <td><img src="img/spacer.gif" width="1" height="67" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="6"><img name="ordermenu_r4_c1" src="img/ordermenu_r4_c1.jpg" width="740" height="4" border="0" id="ordermenu_r4_c1" alt="" /></td>
      <td><img src="img/spacer.gif" width="1" height="4" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="2" rowspan="9" background="img/ordermenu_r5_c1.jpg">&nbsp;</td>
      <td colspan="3" bgcolor="#F0E2C5"><div style="padding-right:50px; text-align:right"><input type="button" name="query" value=" Reservation Inquiry "  class="input03" onclick="location='../member/emember_area.php'"/> <input type="button" name="query" value=" Cart "  class="input03" onclick="location='../room/ecart_list.php'"/> <input type="button" name="query" value=" Room List "  class="input03" onclick="location='../room/eindex.php'"/></div></td>
      <td rowspan="9" background="img/ordermenu_r5_c6.jpg">&nbsp;</td>
      <td><img src="img/spacer.gif" width="1" height="37" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3" rowspan="7" align="left" valign="top" bgcolor="#F0E2C5" style="padding-left:20px">
	    <div style="text-align:left; padding:10px;" class="scroll1">
<h2 align="center">The Enterpriser Hotel Reservation Terms</h2>
<ul>
The on-line reservation system only accepts making reservation(s) and reservation record inquiry. If you want to modify your reservation, please send a request by email: service@gohotel.com.tw
</ul>
【Price & Payment】
<ul>
<li>The displayed room rate includes tax and service charge. In addition, the room rate varies, so please review the total amount carefully before you make a reservation.</li>
<li>The full payment of hotel accommodation should be completed in 3 days after you make an online booking. Your reservation is not confirmed until we confirm this payment and send the follow-up email to you.</li>
<li>To make a reservation less than 3 days before arrival date, please contact us.</li>
</ul>
【Check-in】
<ul>
<li>Check-in is accepted after 15:00 unless special requirements by the hotels and guest is requested to follow accordingly. </li>
<li>ID (or passport) and reservation vouchers must be presented for check-in. Your credit card details are required to guarantee your reservation and payment upon your arrival at the hotel.</li>
</ul>
【Check-out】
<ul>
<li>Check-out must be processed before 12:00. </li>
<li>Any surcharges (extra beds, extended stay, phone calls...etc.) have to be settled before leaving the hotel with receipts.</li>
</ul>
【Change reservation】
<ul>
<li>Reservation details could be amended 3 days before check-in date. If you want to change your reservation, please contact us. There is no surcharge for change of date and room type, but only one amendment can be made and it is not allowed for refund afterwards.</li>
<li>You are required to pay the surcharge of the amendment when check-in; and there is no refund for the difference of the payment because of the amendment.</li>
</ul>
【Cancel Policy】
<ul>
<li>According to the reservation terms and conditions, each cancellation is subject to a charge of 15% of the total amount of your voucher value if the cancellation made 8 days before arrival date. (excluding the date of arrival). 30% of the total amount of your voucher value is charged if the cancellation made within 4-7 days before arrival date (excluding the date of arrival). 50% of the total amount of your voucher value is charged if the cancellation made within 3 days before arrival date (excluding the date of arrival). And 100% of the total amount of your voucher value is charged if the cancellation made on the date of arrival.</li>
<li>If you want to cancel your reservation, please contact us. </li>
</ul>
【Specific Terms】
<ul>
<li>If your reservation is affected by force majeure such as earthquake, traffic interruption caused by typhoon or any other reasons, you may contact the hotel reservation department within 3 days from the check-in date (including the check-in date) to modify or cancel your reservation accordingly.</li>
</ul>

	  </div>
	  	  <div style="padding:10px">
	  By clicking the "I Agree" button, you signify your assent to these terms of use.
	    <input type="button" name="Submit" value="I Agree" onclick="location='ecart_confirm.php'"/>
	  </div>
	  </td>
      <td><img src="img/spacer.gif" width="1" height="122" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="img/spacer.gif" width="1" height="25" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="img/spacer.gif" width="1" height="35" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="img/spacer.gif" width="1" height="39" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="img/spacer.gif" width="1" height="26" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="img/spacer.gif" width="1" height="33" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="img/spacer.gif" width="1" height="305" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#F0E2C5">	  </td>
      <td><img src="img/spacer.gif" width="1" height="26" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="6"><img name="ordermenu_r14_c1" src="img/ordermenu_r14_c1.jpg" width="740" height="20" border="0" id="ordermenu_r14_c1" alt="" /></td>
      <td><img src="img/spacer.gif" width="1" height="20" border="0" alt="" /></td>
    </tr>
  </table>
<?
include("../include/foot.php");
?>