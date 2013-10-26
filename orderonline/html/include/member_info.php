<?
//基本設定
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
$REDirect_PG="history.back()";

$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_member] WHERE member_id ='".$_SESSION["smember_id"]."'");

if ($row = $CLASS["db"]->fetch_array($CLASS["db"]->result)):

	 $member_num = $row["member_num"];
	 $member_id = $row["member_id"];
	 $member_ps = $row["member_password"];
	 $member_name = $row["member_name"];
	 $member_sex = $row["member_sex"];
	 $member_birthday = $row["member_birthday"];
	 $member_userid = $row["member_userid"];
	 $member_email = $row["member_email"];
	 $member_phone = $row["member_phone"];
	 $member_cell = $row["member_cell"];
	 $member_zip = $row["member_zip"];
	 $member_pic = $row["member_pic"];
	 $City = $row["member_city"];
	 $Town = $row["member_town"];
	 $member_address = $row["member_address"];
	 $member_epaper_order = $row["member_epaper_order"];
	 $member_note = $row["member_note"];

	if(!empty($Class_mateSDate)):
		$count_agn=explode("-",$Class_mateSDate);
		$Syear=$count_agn[0];//年
		$Smonth=$count_agn[1];//月
		$Sday=$count_agn[2];//日
	endif;
	if(!empty($Class_mateEDate)):
		$count_agn=explode("-",$Class_mateEDate);
		$Eyear=$count_agn[0];//年
		$Emonth=$count_agn[1];//月
		$Eday=$count_agn[2];//日
	endif;
	if(!empty($member_birthday)):
		$count_agn=explode("-",$member_birthday);
		$Byear=$count_agn[0];//年
		$Bmonth=$count_agn[1];//月
		$Bday=$count_agn[2];//日
	endif;
endif;
$CLASS["db"]->free_result($CLASS["db"]->result);
?>    
<table width="80%"  border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="4" align="left" bgcolor="#CCCC99"><strong class="style01">會員帳號資料<a name="y"></a></strong></td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="16%"><font class="b" color="#FF3300">*</font> 帳　　號：</td>
        <td width="84%" align="left"><?=$member_id?>
          <div id="Available"></div>
        <div id="Available"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="left" bgcolor="#CCCC99"><strong class="style01">會員基本資料</strong></td>
  </tr>
  <tr>
    <td width="19%">姓　　名：</td>
    <td width="26%" align="left"><?=$member_name?></td>
    <td width="19%">性　　別：</td>
    <td width="36%" align="left"><?=$member_sex=="M"?"男":"" ?>
      <?=$member_sex=="F"?"女":"" ?></td>
  </tr>
  <tr>
    <td>身份證號：</td>
    <td align="left"><?=$member_userid?></td>
    <td>出生年月：</td>
    <td align="left"><?=$Byear?>
      年
        <?=$Bmonth?>
        月
        <?=$Bday?>
    日</td>
  </tr>
  <tr>
    <td>通訊電話：</td>
    <td align="left"><?=$member_phone?></td>
    <td>手機號碼：</td>
    <td align="left"><?=$member_cell?></td>
  </tr>
  <tr>
    <td>通訊地址：</td>
    <td colspan="3" align="left"><?=$member_zip ?>
    <?=$member_address?></td>
  </tr>
  <tr>
    <td> E - mail<font class="b">：</font></td>
    <td colspan="3" align="left"><?=$member_email?></td>
  </tr>
</table>
