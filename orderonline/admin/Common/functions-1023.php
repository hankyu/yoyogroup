<?php
function CountVote($ID){
$query=mysql_query("SELECT Class_VoteNum, sum( Class_VoteItemCount )as totalVote FROM cmu_class_vote_item GROUP BY Class_VoteNum
HAVING Class_VoteNum=$ID");

  if($result=mysql_fetch_array($query)){
  	$totalVote=$result["totalVote"];
  }
  return $totalVote;
}

//=========================顯示目前訂購數量
function CountStorage($rentNum,$rentDate)
{
$amount=0;
$CLASS["count"] = new xfunDB_sql;
$CLASS["count"]->connect(); 
$result_Sql = "SELECT sum(shopping_amount) as totalAmount FROM xfun_shopping_item WHERE shopping_proname ='".$rentNum."' AND shopping_promodel = '".$rentDate."' AND shopping_status = 'B'";
	$CLASS["count"]->query($result_Sql);
	if($result = $CLASS["count"]->fetch_array($CLASS["count"]->result)){
	  $amount=$result["totalAmount"];
	}
	//echo $amount;
	return $amount;
$CLASS["count"]->free_result($CLASS["count"]->result);
}
//=========================檢查留言數
function  CountMsg($order_id)
{
$chkAmount=0;
$CLASS["count"] = new xfunDB_sql;
$CLASS["count"]->connect(); 
$result_Sql = "SELECT * FROM xfun_order_msg WHERE order_id ='".$order_id."'";
$CLASS["count"]->query($result_Sql);
$total = $CLASS["count"]->num_rows($CLASS["count"]->result);	//總筆數
		if($total>0)
		{
			$chkAmount=$total;
		}
	$CLASS["count"]->free_result($CLASS["count"]->result);
	return $chkAmount;
}
//=========================檢查庫存
function  CHK_Storage($cart_id)
{
$chkAmount=0;
$CLASS["count"] = new xfunDB_sql;
$CLASS["count"]->connect(); 
$CLASS["chk"] = new xfunDB_sql;
$CLASS["chk"]->connect(); 
$result_Sql = "SELECT * FROM xfun_shopping_item WHERE shopping_cartid ='".$cart_id."'";
$CLASS["count"]->query($result_Sql);
	while($result = $CLASS["count"]->fetch_array($CLASS["count"]->result)){
		$shopping_proid=$result["shopping_proid"];
		$shopping_promodel=$result["shopping_promodel"];
		$shopping_proname=$result["shopping_proname"];
		$shopping_amount=$result["shopping_amount"];
$chk_Sql = "SELECT * FROM xfun_rent_date WHERE rentDateNum =".$shopping_proid." AND rentNum =".$shopping_proname." AND rentDate = '".$shopping_promodel."' AND rentDateAmount < $shopping_amount";
		$CLASS["chk"]->query($chk_Sql);
		$total = $CLASS["chk"]->num_rows($CLASS["chk"]->result);	//總筆數
		if($total>0)
		{
			$chkAmount=$chkAmount+1;
		}
	}
	$CLASS["chk"]->free_result($CLASS["chk"]->result);
	$CLASS["count"]->free_result($CLASS["count"]->result);
	return $chkAmount;
}
//===========================更新庫存
function  UDP_Storage($cart_id)
{
$CLASS["count"] = new xfunDB_sql;
$CLASS["count"]->connect(); 
$CLASS["udp"] = new xfunDB_sql;
$CLASS["udp"]->connect(); 
$result_Sql = "SELECT * FROM xfun_shopping_item WHERE shopping_cartid ='".$cart_id."'";
$CLASS["count"]->query($result_Sql);
	while($result = $CLASS["count"]->fetch_array($CLASS["count"]->result)){
		$shopping_proid=$result["shopping_proid"];
		$shopping_promodel=$result["shopping_promodel"];
		$shopping_proname=$result["shopping_proname"];
		$shopping_amount=$result["shopping_amount"];
		$chk_Sql = "UPDATE xfun_rent_date SET rentDateAmount=rentDateAmount-$shopping_amount WHERE rentDateNum =".$shopping_proid." AND rentNum =".$shopping_proname." AND rentDate = '".$shopping_promodel."'";
		$CLASS["udp"]->query($chk_Sql);
	}
	$CLASS["udp"]->free_result($CLASS["udp"]->result);
	$CLASS["count"]->free_result($CLASS["count"]->result);
}

function RedirectURL($URL){
	echo "<script language='JavaScript'>RedirectURLPAGE('$URL')</script>";
}
?>
<?PHP
function SetReturnURL()
{
	$reURL = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING']; 
	setcookie("ReturnURL",   $reURL,   time()+3600,'/');   
}
?>
<?php
//============================設定網頁過期
function no_cache_header() {
	//echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	//header("Content-Type: text/html; charset=utf-8");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
}
//============================
function view_type($type)
{
	switch($type){
		case "0":
			echo "教授";	break;
		case "1":
			echo "副教授";	break;
		case "2":
			echo "助理教授";	break;
		case "3":
			echo "講師";	break;
		case "4":
			echo "兼任講師";	break;
		case "5":
			echo "技術教師";	break;
		default:
			echo "無";	break;
	}
}
?>
<?php
//============================無亂碼-中文字碼截字串
function cut_str($str, $maxlen) {
    $i = 0; $l = 0; $f = true;
    $len = strlen($str);
    while ($i <= $len) {
        if (ord($str{$i}) < 0x80) { $l++; $i++;
        }
        elseif (ord($str{$i}) < 0xe0) { $l++; $i += 2;
        }
        elseif (ord($str{$i}) < 0xf0) { $l += 2; $i += 3;
        }
        elseif (ord($str{$i}) < 0xf8) { $l += 1; $i += 4;
        }
        elseif (ord($str{$i}) < 0xfc) { $l += 1; $i += 5;
        }
        elseif (ord($str{$i}) < 0xfe) { $l += 1; $i += 6;
        }
        if (($l >= $maxlen - 1) && $f)  {
           $str = substr($str, 0, $i);
           $f = false;
        }
        if (($l > $maxlen) && ($i <=$len)) {
            $str .= "…";
            break;
        }
    }
    return $str;
  }
?>
<?php
//============================將EMAIL轉換成圖片按鈕連結
function GetMailBtn($mail){
	return "<img src='../images/button_email.gif' onClick=location='mailto:$mail' style='cursor:hand' alt='$mail'>";
}
?>
<?php
//============================取得完整年月日
function Get_YMD($t){
	list($y, $m, $d, $h, $i, $s) = sscanf($t, "%d-%d-%d %d:%d:%d");
echo "$y-$m-$d";
}
?>
<?php
//============================檔案類別選單-重新導向頁面選單
function c_file_type_PullDown_re($TYPE_SELECT,$PATH,$ID)
{
$query=mysql_query("SELECT * FROM cmu_file_type ORDER BY File_Type_ID DESC");
//判斷是否重新導向頁面
    echo "<select onChange=self.location.href=this.options[this.selectedIndex].value;>";
	echo "<option value=\"" .$PATH."\" selected >" . $TYPE_SELECT . "</option>";
while($result=mysql_fetch_array($query)){
   	  $File_Type=$result['File_Type'];
	  $File_Type_ID=$result['File_Type_ID'];
	    if($File_Type_ID==$ID):
			echo "<option value=\"" .$PATH."&ID=".$File_Type_ID . "\" selected >" . $File_Type . "</option>";
		else:
			echo "<option value=\"" .$PATH."&ID=".$File_Type_ID . "\" >" . $File_Type . "</option>";
		endif;
	}
	echo "</select>";
}
?>
<?PHP
//============================刪除過期購物車資訊
function DelCartTemp(){
		$SQL="DELETE FROM xfun_shopping_item WHERE TO_DAYS(NOW()) - TO_DAYS(`shopping_cdate`) >= 30";
		$CLASS["db"] = new xfunDB_sql;
		$CLASS["db"]->connect(); 
		$CLASS["db"]->query($SQL);
		$CLASS["db"]->free_result($CLASS["db"]->result);
}
DelCartTemp();
//============================刪除過期log資訊
function DelLogTemp(){
		$SQL="DELETE FROM xfun_log WHERE TO_DAYS(NOW()) - TO_DAYS(`cdate`) >= 90";
		$CLASS["db"] = new xfunDB_sql;
		$CLASS["db"]->connect(); 
		$CLASS["db"]->query($SQL);
		$CLASS["db"]->free_result($CLASS["db"]->result);
}
DelLogTemp();

?>
<?php
//============================上下架日期檢查
function Day_Status($SD,$ED){
if (($SD!="" && $ED!="") && ($SD!="0000-00-00" && $ED!="0000-00-00")){
	$s_date=$SD." 00:00:00";//"2007-07-18 00:00:00";//開始日期
	$e_date=$ED." 00:00:00";//"2007-07-22 00:00:00";//結束日期
	$t=date("Y-m-d 00:00:00");	  //目前日期
	list($y, $m, $d, $h, $i, $s) = sscanf($t, "%d-%d-%d %d:%d:%d");
	list($sy, $sm, $sd, $sh, $si, $ss) = sscanf($s_date, "%d-%d-%d %d:%d:%d");
	list($ey, $em, $ed, $eh, $ei, $es) = sscanf($e_date, "%d-%d-%d %d:%d:%d");
	//轉換成時間戳記/計算時間差的方式
	$nowdate=mktime("$h","$i","$s","$m","$d","$y"); 
	$startdate=mktime("$sh","$si","$ss","$sm","$sd","$sy"); 
	$enddate=mktime("$eh","$ei","$es","$em","$ed","$ey"); 
	//轉換天數
	$days1=round((time()-$startdate)/3600/24) ; 
	$days2=round(($enddate-time())/3600/24) ; 
	$days=round(($enddate-$startdate)/3600/24) ; 
	//echo "<br><br><br>已開始天數".$days1."<br>";
	//echo "<br><br><br>最後天數".$days2."<br>";
	//echo "結束剩餘天數".$days."<br>";
	//相差天數
	//echo "總天數".$days."<br>"; 
	if($days1>=0 && $days2>=0 && days>=0){
		return "true";//"上架中";
	}elseif($days1<0){
		return "false_a";//"未上架";
	}else{
		return "false_b";//"下架中";
	}
}else{
return "true";
}
}

?>
<?php
//============================類別選單
/*USE
	$CLASS["sdb"] = new xfunDB_sql;
	$CLASS["sdb"]->connect(); 
	echo get_ADGPsel($AD_Group);
*/
function get_ADGPsel($id,$Table) {
    global $CLASS, $XFUN_TBL;
    $CLASS["sdb"]->query("SELECT * FROM $Table ORDER BY GP_ID asc");
    $select_field = "<select name=\"AD_Group\" class=\"select\">\n<option value=\"\">請選擇</option>\n";
    while ($row_gp = $CLASS["sdb"]->fetch_array($CLASS["sdb"]->result)) {
	$selected="";
	if ($id==$row_gp["User_Level"]){
		$selected="selected";
	}
        $select_field .= "<option value=\"$row_gp[User_Level]\" ".$selected.">$row_gp[GP_Cname]</option>\n";
    }
    $select_field .= "</select>\n";
    return $select_field;
}
?>
<?php
//*****************************檢查資料是否為空
function check_empty($filed){
	  if(!empty($filed)):
		   echo $filed;
	  else:
		   echo "<font color=#cccccc>無</font>";
	  endif;
}
?>

<?php
//*****************************查看關連資料
function view_kind($id,$table,$tar_id,$filed){
	  if (!empty($id)){
		  $query = "select * from $table where $tar_id=".$id;
		  $result = mysql_query($query);
		  if(mysql_num_rows($result) >= 1):
		  $row=mysql_fetch_array($result);
			$title=$row[$filed];
			   return $title;
		  else:
		     return "不存在";
		  endif;
	  }else{
	  return "無";
	  }
}
?>
<?php
//===========================產品類別路徑
function Show_Tree($kind_id,$table,$targetfield,$showfield){
	$catalog="<font color=red>尚未歸納</font>";
	list($m_ID,$s_ID,$t_ID)=explode(",",$kind_id);
	if(!empty($m_ID))$main_kind=view_kind($m_ID,$table,$targetfield,$showfield);
	if(!empty($s_ID))$sub_kind=view_kind($s_ID,$table,$targetfield,$showfield);
	if(!empty($t_ID))$third_kind=view_kind($t_ID,$table,$targetfield,$showfield);
	$A=$main_kind!=""?$main_kind:"";
	$B=$sub_kind!=""?" &gt; ".$sub_kind:"";
	$C=$third_kind!=""?" &gt; ".$third_kind:"";
	if(!empty($A)):
		$catalog=$A.$B.$C;
	endif;
	return $catalog;
}
?>
<?php
//*****************************查看相關管理者資料
function view_adm($id,$table,$tar_id,$filed){
	  $query = "select * from $table where $tar_id like '%$id%'";
	  //echo $query;
	  $result = mysql_query($query);
	  if(mysql_num_rows($result) >= 1):
	  $row=mysql_fetch_array($result);
		$title=$row[$filed];
		   return $title;
	  else:
	  	   return "<font color=#cccccc>無</font>";
	  endif;
}
?>
<?php
//*****************************返回關連資料
function reutrn_id($id,$table,$tar_id,$filed){
	  $query = "select * from $table where $tar_id=".$id;
	  $result = mysql_query($query);
	  if(mysql_num_rows($result) >= 1):
	  $row=mysql_fetch_array($result);
		$title=$row[$filed];
		   return $title;
	  endif;
}
?>
<?php
//============================年 選單
function yearPullDown($year)
{
	echo "<select name=\"getyear\">\n";
	$z = 0;
	for($i=1;$i < 12; $i++) {
		if ($z == 0) {
			echo "	<option value=\"" . ($year - $z) . "\" selected>" . ($year - $z) . "</option>\n";
		} else {
			echo "	<option value=\"" . ($year - $z) . "\">" . ($year - $z) . "</option>\n";
		}
		$z--;
	}
	echo "</select>\n\n";
}

//============================月 選單
function monthPullDown($month)
{
if($month==""){
$month=date('m');
}

	echo "\n<select name=\"last_month\">\n";
	for($i=1;$i < 13; $i++) {
		if ($i != ($month)) {
			echo "	<option value=\"" . $i . "\">$i</option>\n";
		} else {
			echo "	<option value=\"" . $i . "\" selected>$i</option>\n";
		}
	}
	echo "</select>\n\n";
}

//=============================轉換成民國年 選單
function CHyearPullDown($year,$id,$title,$chang,$path,$chid)
{
//跳頁
if ($chang=="chang"):
    echo "<select name='$id' onChange=self.location.href=this.options[this.selectedIndex].value;>";
	$z = 1911;
			echo "	<option value='$path' selected>" . $title . "</option>\n";
	for($i=0;$i < 30; $i++) {
			($year - $z)==$chid?$ss="selected":$ss="";
			echo "	<option value='$path" . ($year - $z) . "' $ss>" . ($year - $z) . "</option>\n";
		$z++;
	}
	echo "</select>\n\n";
else:
//無跳頁
	echo "<select name='$id'>\n";
	$z = 1911;
			echo "	<option value='' selected>" . $title . "</option>\n";
	for($i=0;$i < 30; $i++) {
			echo "	<option value='" . ($year - $z) . "' >" . ($year - $z) . "</option>\n";
		$z++;
	}
	echo "</select>\n\n";
endif;	
}

//============================月 選單
function monthPullDown3($month)
{
	echo "\n<select name=\"getmonth\">\n";
	for($i=1;$i < 13; $i++) {
	    if($i<10):
		$n="0";
		else:
		$n="";
		endif;
		if ($i != ($month)) {
			echo "	<option value=\"$n$i\">$n$i</option>\n";
		} else {
			echo "	<option value=\"$n$i\" selected>$n$i</option>\n";
		}
	}
	echo "</select>\n\n";
}
//============================日 選單
function dayPullDown($day)
{
	echo "<select name=\"getday\">\n";
	for($i=1;$i <= 31; $i++) {
	    if($i<10):
		$n="0";
		else:
		$n="";
		endif;
		if ($i == $day) {
			echo "	<option value=\"$n$i\" selected>$n$i</option>\n";
		} else {
			echo "	<option value=\"$n$i\">$n$i</option>\n";
		}
	}
	echo "</select>\n\n";
}
//============================時 選單
function hourPullDown($hour, $namepre)
{
	echo "\n<select name=\"" . $namepre . "_hour\">\n";

	for($i=0;$i <= 24; $i++) {
		if ($i == $hour) {
			echo "	<option value=\"$i\" selected>$i</option>\n";
		} else {
			echo "	<option value=\"$i\">$i</option>\n";
		}
	}

	echo "</select>\n\n";
}

//============================分 選單
function minPullDown($min, $namepre)
{
	echo "\n<select name=\"" . $namepre . "_min\">\n";

	for($i=0;$i <= 55; $i+=5) {
		
		if ($i < 10) { $disp = "0" . $i; } else { $disp = $i; }
		
		if ($i == $min) {
			echo "	<option value=\"$i\" selected>$disp</option>\n";
		} else {
			echo "	<option value=\"$i\">$disp</option>\n";
		}
	}

	echo "</select>\n\n";
}
?>