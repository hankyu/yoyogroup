<?php
$PageTitle=" - The Enterpriser Hotel Online Order System";
include("../include/head.php");

if($act=="logout"){
	error_reporting (E_ALL ^ E_WARNING ^ E_NOTICE); 
	session_start(); //
	session_unset(); //
	//session_unregister();
	session_destroy();
}
?>
  <table border="0" cellpadding="0" cellspacing="0" width="740">
    <!-- fwtable fwsrc="ordermenu.png" fwbase="ordermenu.jpg" fwstyle="Dreamweaver" fwdocid = "762039254" fwnested="0" -->
    <tr>
      <td><img src="../room/img/spacer.gif" width="11" height="1" border="0" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="9" height="1" border="0" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="335" height="1" border="0" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="331" height="1" border="0" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="38" height="1" border="0" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="16" height="1" border="0" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="6"><img name="ordermenu_r1_c1" src="../room/img/ordermenu_r1_c1.jpg" width="740" height="21" border="0" id="ordermenu_r1_c1" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="1" height="21" border="0" alt="" /></td>
    </tr>
    <tr>
      <td rowspan="2"><img name="ordermenu_r2_c1" src="../room/img/ordermenu_r2_c1.jpg" width="11" height="93" border="0" id="ordermenu_r2_c1" alt="" /></td>
      <td rowspan="2" colspan="3"><img name="enordermenu_r2_c2" src="../room/img/enordermenu_r2_c2.jpg" width="675" height="93" border="0" id="ordermenu_r2_c2" alt="" /></td>
      <td><a href="JavaScript:self.close()"><img name="ordermenu_r2_c5" src="../room/img/ordermenu_r2_c5.jpg" width="38" height="26" border="0" id="ordermenu_r2_c5" alt="" /></a></td>
      <td rowspan="2"><img name="ordermenu_r2_c6" src="../room/img/ordermenu_r2_c6.jpg" width="16" height="93" border="0" id="ordermenu_r2_c6" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="1" height="26" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img name="ordermenu_r3_c5" src="../room/img/ordermenu_r3_c5.jpg" width="38" height="67" border="0" id="ordermenu_r3_c5" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="1" height="67" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="6"><img name="ordermenu_r4_c1" src="../room/img/ordermenu_r4_c1.jpg" width="740" height="4" border="0" id="ordermenu_r4_c1" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="1" height="4" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="2" rowspan="9" background="../room/img/ordermenu_r5_c1.jpg">&nbsp;</td>
      <td colspan="3" bgcolor="#F0E2C5"><div style="padding-right:50px; text-align:right">
        <input type="button" name="query" value=" Reservation Inquiry "  class="input03" onclick="location='../member/emember_area.php'"/> <input type="button" name="query" value=" Cart "  class="input03" onclick="location='../room/ecart_list.php'"/> <input type="button" name="query" value=" Room List "  class="input03" onclick="location='../room/eindex.php'"/></div>
      </span></td>
      <td rowspan="9" background="../room/img/ordermenu_r5_c6.jpg">&nbsp;</td>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3" rowspan="7" align="center" valign="top" bgcolor="#F0E2C5">
	  <?PHP
	  $lan="eng";
	  SetReturnURL();
		  if(!empty($_SESSION["sorder_id"])):
		    if($act=="viewlist"){
		  		include("../include/member_viewlist.php"); 
			}else{
		  		include("../include/member_orderlist.php"); 
			}
		  else:
		  	include("../include/member_query.php"); 
		  endif;
	  ?>	  <p align="center">&nbsp;</p></td>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#F0E2C5">&nbsp;</td>
      <td><img src="../room/img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="6"><img name="ordermenu_r14_c1" src="../room/img/ordermenu_r14_c1.jpg" width="740" height="20" border="0" id="ordermenu_r14_c1" alt="" /></td>
      <td><img src="../room/img/spacer.gif" width="1" height="20" border="0" alt="" /></td>
    </tr>
  </table>
<?
include("../include/foot.php");
?>