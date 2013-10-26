<?php
$PageTitle=" - 付款方式";
include("../include/head.php");
//基本設定
$CLASS["DB"] = new xfunDB_sql;
$CLASS["DB"]->connect(); 
?>
<?
$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_help]";
$CLASS["DB"]->query($result_num);
$total = $CLASS["DB"]->num_rows($CLASS["DB"]->result);	//總筆數
if($total >= 1):
$row = $CLASS["DB"]->fetch_array($CLASS["DB"]->result);
$orderhelp_num=$row['orderhelp_num'];
$orderhelp_content=$row['orderhelp_content'];
$orderhelp_econtent=$row['orderhelp_econtent'];
endif;
$CLASS["DB"]->free_result($CLASS["DB"]->result);
?>
	<table width="80%" height="80%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" bgcolor="#ffffff">
<div align="left">
<?php
	echo $ck!="e"?$orderhelp_content:$orderhelp_econtent;
?>
</div></td>
  </tr>
</table>
<?
include("../include/foot.php");
?>
