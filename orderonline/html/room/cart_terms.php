<?php
$PageTitle=" - 線 上 訂 房 系 統";
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
      </td>
      <!-- <td colspan="3" rowspan="2" valign="middle" bgcolor="#F0E2C5">
        <div align="center"><font face="標楷體" size="+3"><b><font size="+2"><font color="459E0A"><img src="images/welcome1.gif" width="46" height="24"></font></font></b></font><font size="+3"><font size="+2"><font color="#996600" size="3">歡迎光臨</font></font><font size="3"><b><font color="459E0A"></font></b></font></font><font face="標楷體" size="+3"><b><font size="+2"><font color="459E0A">&nbsp;友友飯店&nbsp;</font></font></b></font><font size="+3"><font size="+2"><font color="459E0A"><font size="3" color="#996600">線上訂房系統</font></font></font></font><font face="標楷體" size="+3"><b><font size="+2"><img src="images/orderline1.gif" width="47" height="24"></font></b></font></div>
      </td> -->
      <!-- <td rowspan="2" colspan="3"><img name="ordermenu_r2_c2" src="img/ordermenu_r2_c2.jpg" width="675" height="93" border="0" id="ordermenu_r2_c2" alt="" /></td> -->
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
      <td colspan="3" bgcolor="#F0E2C5"><div style="padding-right:50px; text-align:right">
        <input type="button" name="query" value=" 查詢訂單 " class="input03" style="cursor:pointer;" onclick="location='../member/member_area.php'"/> <input type="button" name="query" value=" 購物車 "  class="input03" onclick="location='../room/cart_list.php'"/> <input type="button" name="query" value=" 訂房 "  class="input03" onclick="location='../room/index.php'"/></div></td>
      <td rowspan="9" background="img/ordermenu_r5_c6.jpg">&nbsp;</td>
      <td><img src="img/spacer.gif" width="1" height="37" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3" rowspan="7" align="left" valign="top" bgcolor="#F0E2C5" style="padding-left:20px"><div style="text-align:left; padding:10px;" class="scroll1">
        <h2 align="center">友友大飯店 線上訂房須知</h2>
        一、客服問題：
        <ul>
          <li>有關在本網站上交易的訂房紀錄、操作疑問等問題，請電洽友友飯店客服人員為您服務。</li>
          <li>若有飯店設施、交通路線等問題，則請上本店網站或以電話逕向欲訂之飯店洽詢。</li>
          <li>訂房後，若有任何其他變更本網站交易內容之情事請email至電子信箱 yoyo@ffh.com.tw 我們會儘速為您處理。 </li>
          <li>聯絡方式：電話(02)2531-6767 傳真(02)2511-9637 電子信箱 yoyo@ffh.com.tw</li>
          <li>如使用國民旅遊卡時 敬請備註需預購型交易</li>
        </ul>
        二、價格：
        <ul>
          <li>本網站上所公佈的刷卡優惠價格，均包含房間費用、稅(5%)以及服務費。</li>
          <li>刷卡優惠價格不包含各項附加服務之費用，附加服務費用請另於住宿時支付。</li>
          <li>刷卡優惠價格將依日期、房型而不同，請您在確認訂房付款前仔細查看確認。</li>
        </ul>
        三、住房手續（Check in）：
        <ul>
          <li>飯店會於13：00後受理住房作業。</li>
          <li>住房者請務必於住房當日攜帶以下證件，以便飯店查核登記。<br>
            <1>本人身分證（或護照）正本。<br>
            <2>訂房訂單編號。<br>
            <3>採【信用卡線上授權刷卡】訂房者， 請攜帶並出示原刷卡之【信用卡】。並請於飯店出示的訂房訂單上簽名。
          </li>
          <li>若您在時間上有所耽擱，無法在規定時間內辦理住房手續，請您於住房(check in)時限前先以電話聯繫訂房中心，否則將視為您當日取消訂房，恕不退費。</li>
          <li>若您因故有所耽擱，無法在規定時間內辦理住房手續，請您於住房(check in)時限前先以電話聯繫
            飯店人員，否則將視為您當日取消訂房，恕不退費。</li>
        </ul>
        四、退房手續（Check out）：
        <ul>
          <li>須於12：00前辦理退房手續。</li>
          <li>如續住、加床、餐飲費、小費、電話費...等，必須在現場直接付清。</li>
        </ul>
        五、訂房訂單更改：
        <ul>
          <li>訂房後如欲更改訂房日期、房型或房間數，請聯絡本網站客服人員協助處理，惟限於入住日3 天(含)前始可更改住房日期、房型及房間數 (不另收手續費)。</li>
          <li>同筆訂單限更改乙次，更改後之訂單恕不接受退房(取消)。</li>
          <li>更改後的訂單總金額大於原訂單總金額時，須補足價差。更改後的訂單總金額少於原訂單總金額時，將扣取匯款手續費30元(採信用卡線上付款以及信用卡傳真授權付款者除外)後退還。</li>
        </ul>
       六、取消訂房訂單（Cancel）(退房)：
        <ul>
          <li>訂房後如欲取消訂房訂單，請聯絡客服人員協助處理。取消訂房訂單時，將依照訂房相關規定中所公告之取消訂房訂單之規定，扣取退房手續費。請於訂房時，詳讀該飯店的相關規定。</li>
          <li>旅客於入住日當日取消訂單(退房)者，扣取房價的100%為退房手續費。</li>
          <li>入住日的前1~2天(含)內取消訂單者，扣取房價的30%為退房手續費。</li>
          <li>入住日的前3~5天(含)內取消訂單者，扣取房價的15%為退房手續費。</li>
          <li>入住日的前6天取消訂單者，不扣取手續費。</li>
        </ul>
        七、特殊因素之退房處理：
        <ul>
          <li>如所預訂的飯店所在地於預訂住宿當日，遇颱風、地震等不可抗拒因素時(以飯店所在地縣市政府頒布狀況為判定準則)，請以電話聯絡客服人員，並依規定處理之。如無故不依訂房日期入住，則將依照規定不退還已收之訂房費用。</li>
        </ul>
      </div>
        <div style="padding:10px">
	  如您按下「同意」按鈕並完成最終線上訂房程序，即表示您已同意接受本「訂房須知」之條款約定。
	    <input type="button" name="Submit" value="同意" onclick="location='cart_confirm.php'"/>
	  </div>	  </td>
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