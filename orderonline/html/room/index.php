<?php
$PageTitle=" - 線 上 訂 房 系 統";
include("../include/head.php");
$_SESSION["sLan"] =	$lan;
?><style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
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
      <td colspan="3" rowspan="2" valign="middle" bgcolor="#F0E2C5">
        <div align="center">
          <font face="標楷體" size="+3"><b><font size="+2">
          <font color="459E0A"><img src="../images/welcome1.gif" width="46" height="24"></font></font></b></font>
          <font size="+3"><font size="+2"><font color="#996600" size="3">歡迎光臨</font></font><font size="3"><b>
          <font color="459E0A"></font></b></font></font>
          <font face="標楷體" size="+3"><b><font size="+2"><font color="459E0A">&nbsp;友友飯店&nbsp;</font></font></b></font>
          <font size="+3"><font size="+2"><font color="459E0A"><font size="3" color="#996600">線上訂房系統</font></font></font></font>
          <font face="標楷體" size="+3"><b><font size="+2"><img src="../images/orderline1.gif" width="47" height="24"></font></b></font>
        </div>
        <div style="text-align:right"><a href="#">中文版</a> ｜ <a href="#">English</a> </div>
      </td>
      <!--td colspan="3" rowspan="2" valign="top" bgcolor="#F0E2C5"><!--background="img/ordermenu_r2_c2.jpg"-->
        <!-- <div style="text-align:right"><a href="#">中文版</a> ｜ <a href="#">English</a> </div> ->
      </td-->
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
      <td colspan="3" bgcolor="#F0E2C5"><div style="padding-right:50px; text-align:right; vertical-align:bottom">
	    <input type="button" name="paynote" value=" 付款方法 "  style="cursor:pointer;background-color:#CC9900; border: 0px solid #FFFFFF;  font-size:12px;PADDING-TOP: 5px;PADDING-RIGHT: 1px;PADDING-BOTTOM: 2px;PADDING-LEFT: 1px;" onclick="alert('建置中...');"/><!--onclick="MM_openBrWindow('../include/order_help.php','','scrollbars=yes,width=640,height=580')"-->
	  &nbsp;<input type="button" name="rentnote" value=" 訂房須知 " style="cursor:pointer;background-color:#CCCC00; border: 0px solid #FFFFFF; font-size:12px;PADDING-TOP: 5px;PADDING-RIGHT: 1px;PADDING-BOTTOM: 2px;PADDING-LEFT: 1px;" onclick="alert('建置中...');"/>&nbsp;<!-- onclick="MM_openBrWindow('../room/terms.html','','scrollbars=yes,width=640,height=580')"-->
	  <input type="button" name="query" value=" 查詢訂單 " class="input03" style="cursor:pointer;" onclick="location='../member/member_area.php'"/> 
	  &nbsp;
	  <input type="button" name="query" value=" 購物車 "  class="input03" style="cursor:pointer;" onclick="location='../room/cart_list.php'"/> 
	  &nbsp;
	  <input type="button" name="query" value=" 訂房 "  class="input03" style="cursor:pointer;" onclick="location='../room/index.php'"/></div>
	  <div>
	  <img src="img/square.gif" width="15" height="13" align="absmiddle" />訂房步驟<img src="img/square.gif" width="15" height="13" align="absmiddle" />
	    <br />
	    1.選擇房型</a>  <img src="img/arrow.gif" width="12" height="10" align="absmiddle" />   2.選擇訂房日期  <img src="img/arrow.gif" width="12" height="10" align="absmiddle" />   3.訂房須知  <img src="img/arrow.gif" width="12" height="10" align="absmiddle" />   4.詳填訂房資料  <img src="img/arrow.gif" width="12" height="10" align="absmiddle" />   5.訂房確認  <img src="img/arrow.gif" width="12" height="10" align="absmiddle" />   6.訂房查詢	  </div>	 
		<div><br>
		<img src="img/square.gif" width="15" height="13" align="absmiddle" />使用說明
<img src="img/square.gif" width="15" height="13" align="absmiddle" /></div>
<div>
<table border="1" cellspacing="0" bordercolor="#666666" cellpadding="1" width="674" align="center">
  <tbody>
    <tr>
      <td width="668"><p>1.在下方的列表中，選擇喜歡的房型。<br />
        2.進入內容詳細介紹頁面後，底下會出現日期區塊選單，使用日期區塊最上方的左右鍵來瀏覽訂房日期，在日期區塊選單上選擇您要訂房的日期。<br />
        3.若日期的區塊為『未開放訂房』，即代表該日期目前無房間可提供訂房，請點選日期的有色文字區塊，上面會顯示目前的房間數及訂房價格。<br />
          4.直接在日期上面點選您要訂的房間，此時會將您要訂房的日期加入購物車中。<br />
          5.購物車中的列表將會列出您的訂房資料，並可使用下拉選單更改您的數量需求。 <br />
      6.確認後即可按下結帳扭進入結帳流程，在填完詳細資料送出訂單後，系統將會發送一封通知信到您指定的信箱，之後您可以到訂房查詢系統裡查詢您目前訂房的狀況。</p>
        </td>
    </tr>
  </tbody>
</table>
</div>
	  </td>
      <td rowspan="9" background="img/ordermenu_r5_c6.jpg">&nbsp;</td>
      <td><img src="img/spacer.gif" width="1" height="37" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3" rowspan="7" bgcolor="#F0E2C5" valign="top">
	  <?PHP
	  $lan="cht";
	  include("../include/room_list.php");
	  ?>	  <p align="center">&nbsp;</p></td>
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
      <td colspan="3" bgcolor="#F0E2C5">&nbsp;</td>
      <td><img src="img/spacer.gif" width="1" height="26" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="6"><img name="ordermenu_r14_c1" src="img/ordermenu_r14_c1.jpg" width="740" height="20" border="0" id="ordermenu_r14_c1" alt="" /></td>
      <td><img src="img/spacer.gif" width="1" height="20" border="0" alt="" /></td>
    </tr>
  </table>
<?include("../include/foot.php");?>