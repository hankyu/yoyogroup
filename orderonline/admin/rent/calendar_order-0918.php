<link rel="stylesheet" type="text/css" href="../../admin/rent/css/supercali2.css">
<link rel="stylesheet" type="text/css" href="../../admin/js/tips.css" />
<script type="text/javascript" language="javascript" src="../../admin/js/tips.js"></script>

<?php
extract($HTTP_POST_VARS);
extract($HTTP_GET_VARS);

//Config Setup
$show_week="none";
$day_link=$PHP_SELF;
$week_link="week_event.php";
$onmouseOver=" onMouseOver=\"currentcolor=this.style.backgroundColor='#e7f2fa';\"";
$onmouseOut=" onMouseOut=\"this.style.backgroundColor='';\"";


$week_titles[] = "日";
$week_titles[] = "一";
$week_titles[] = "二";
$week_titles[] = "三";
$week_titles[] = "四";
$week_titles[] = "五";
$week_titles[] = "六";

//used with the quarter view
$week_titles_s[] = "Sun";
$week_titles_s[] = "Mon";
$week_titles_s[] = "Tue";
$week_titles_s[] = "Wed";
$week_titles_s[] = "Thu";
$week_titles_s[] = "Fri";
$week_titles_s[] = "Sat";

//used with the year view
$week_titles_ss[] = "S";
$week_titles_ss[] = "M";
$week_titles_ss[] = "T";
$week_titles_ss[] = "W";
$week_titles_ss[] = "T";
$week_titles_ss[] = "F";
$week_titles_ss[] = "S";

//月份
$week_month= Array(
	'January'	=> $lan=="cht"?'一月':'January',
	'February'	=> $lan=="cht"?'二月':'February',
	'March'		=> $lan=="cht"?'三月':'March',
	'April' 	=> $lan=="cht"?'四月':'April',
	'May'		=> $lan=="cht"?'五月':'May',
	'June'		=> $lan=="cht"?'六月':'June',
	'July'		=> $lan=="cht"?'七月':'July',
	'August'	=> $lan=="cht"?'八月':'August',
	'September'	=> $lan=="cht"?'九月':'September',
	'October'	=> $lan=="cht"?'十月':'October',
	'November'	=> $lan=="cht"?'十一月':'November',
	'December'	=> $lan=="cht"?'十二月':'December',
);

//初始化月份
$y=$y==""?date("Y"):$y;
$m=$m==""?date("m"):$m;
$a=$a==""?date("d"):$a;

//下一月份
$next["month"]["m"] = date( "m", mktime( 0, 0, 0, $m+1, 1, $y ) );
$next["month"]["y"] = date( "Y", mktime( 0, 0, 0, $m+1, 1, $y ) );

//上一月份
$prev["month"]["m"] = date( "m", mktime( 0, 0, 0, $m-1, 1, $y ) );
$prev["month"]["y"] = date( "Y", mktime( 0, 0, 0, $m-1, 1, $y ) );

//***************************************Main Corn***************************************//

function showGrid($date) {
	global $title, $niceday, $start_time, $end_time, $venue, $city, $state, $cat, $color, $background, $ed, $usr, $o, $c, $m, $a, $y, $w, $lang, $ap, $status;
	if ($start_time[$date]) {
		ksort($start_time[$date]);
		echo "<ul>\n";
		while (list($t) = each($start_time[$date])) {
			while (list($id,$value) = each($start_time[$date][$t])) {
				echo "<li>";
				echo "<div class=\"item\"";
				if ($color[$id]) echo " style=\"color: ".$color[$id]."; background: ".$background[$id].";\"";
				echo ">";
				echo "<div class=\"time\">".$value;
				if ($end_time[$date][$t][$id]) echo " - ".$end_time[$date][$t][$id];
				echo "</div>\n";
				echo "<div class=\"title\"><a href=\"show_event.php?id=".$id."&o=".$o."&c=".$c."&m=".$m."&a=".$a."&y=".$y."&w=".$w."\" onClick=\"openPic('show_event.php?id=".$id."&size=small','pop','600','400'); window.newWindow.focus(); return false\"";
				if ($color[$id]) echo " style=\"color: ".$color[$id]."; background: ".$background[$id].";\"";
				echo ">".$title[$id]."</a></div>\n";
				if ($venue[$id]) {
					echo "<div class=\"venue\">".$venue[$id]."</div>\n";
					if ($city[$id]) {
						echo "<div class=\"location\">".$city[$id];
						if ($state[$id]) echo ", ".$state[$id];
						echo "</div>\n";
					}
				}
				echo "</div>";
				if ($ed[$id]==true) {
					echo "<div class=\"edit\">";
					if (($ap[$id]==true) && (($status[$id] == 2) || ($status[$id] == 3))) echo "[<a href=\"admin_actions.php?id=".$id."&o=".$o."&c=".$c."&m=".$m."&a=".$a."&y=".$y."&w=".$w."&mode=".approve."\">".$lang["approve"]."</a>]&nbsp;&nbsp;";
					echo "[<a href=\"edit_event.php?id=".$id."&o=".$o."&c=".$c."&m=".$m."&a=".$a."&y=".$y."&w=".$w."\" onClick=\"openPic('edit_event.php?id=".$id."&size=small','pop','650','600'); window.newWindow.focus(); return false\">".$lang["edit"]."</a>]&nbsp;&nbsp;[<a href=\"delete_event.php?id=".$id."&o=".$o."&c=".$c."&m=".$m."&a=".$a."&y=".$y."&w=".$w."\">".$lang["delete"]."</a>]</div>\n";
				}
				echo "</li>\n";
			}
		}
		echo "</ul>\n";
	}
}

function showMonth ($calmonth,$calyear) {
	global $week_titles,$week_titles_s, $id, $m, $a, $y, $w, $c, $next, $prev,$ly, $lm, $la;
	global $week_month, $show_week, $onmouseOver, $onmouseOut, $week_link, $day_link, $main_page, $PB_page, $lan;
	/* determine total number of days in a month */
	$W1=$lan=="cht"?"無空房":"Full";
	$W2=$lan=="cht"?"未開放訂房":"Not Ready";
	$W3=$lan=="cht"?"今天日期":"Today";
	$calday = 0;
	$totaldays = 0;
	while ( checkdate( $calmonth, $totaldays + 1, $calyear ) )
	        $totaldays++;
	
	/* build table */
	echo '<table width="100%" class="grid""><tr>'; 
	echo '<th colspan="7" class="cal_top"><a href="',$PHP_SELF,'?id='.$id.'&main_page='.$main_page.'&PB_page='.$PB_page.'&c='.$c.'&m='.$prev["month"]["m"].'&a=1&y='.$prev["month"]["y"].'">&lt;&lt;</a> '.$week_month[date('F', mktime(0,0,0,$calmonth,1,$calyear))].'&nbsp;'.date('Y', mktime(0,0,0,$calmonth,1,$calyear)).' <a href="'.$PHP_SELF.'?id='.$id.'&main_page='.$main_page.'&PB_page='.$PB_page.'&c='.$c.'&m='.$next["month"]["m"].'&a=1&y='.$next["month"]["y"].'">&gt;&gt;</a></th></tr><tr>';
	for ( $x = 0; $x < 7; $x++ )
		if($lan=="cht"){
	        echo '<th>'. $week_titles[ $x ]. '</th>';
		}else{
	        echo '<th>'. $week_titles_s[ $x ]. '</th>';
		}
	/* ensure that a number of blanks are put in so that the first day of the month
	   lines up with the proper day of the week */
	$off = date( "w", mktime( 0, 0, 0, $calmonth, $calday, $calyear ) );
	$offset = $off + 1;
	echo '</tr><tr>';
	if ($offset > 6) $offset = 0;
	for ($t=0; $t < $offset; $t++) {
		if ($t == 0) {
			$offyear = date( "Y", mktime( 0, 0, 0, $calmonth, $calday-$off, $calyear ) );
			$offmonth = date( "m", mktime( 0, 0, 0, $calmonth, $calday-$off, $calyear ) );
			$offday = date( "d", mktime( 0, 0, 0, $calmonth, $calday-$off, $calyear ) );
			/****顯示週記事****/
			echo '<td class="day"><div class="week" style="display:'.$show_week.'"><a href="'.$week_link.'?id='.$id.'&main_page='.$main_page.'&PB_page='.$PB_page.'&c='.$c.'&m='.$offmonth.'&a='.$offday.'&y='.$offyear.'">week</a></div></td>';
		} else {
			echo '<td class="day">&nbsp;</td>';
		}
	}
	/* start entering in the information */
	for ( $d = 1; $d <= $totaldays; $d++ )
	{
		//比較日期大小
		$chkDate=$calyear."-".$calmonth."-".$d;
		$nowDate = date("Y-m-j");
		list($sy, $sm, $sd, $sh, $si, $ss) = sscanf($chkDate." 01:01:01", "%d-%d-%d %d:%d:%d");
		list($ey, $em, $ed, $eh, $ei, $es) = sscanf($nowDate." 01:01:01", "%d-%d-%d %d:%d:%d");
		$startdate=mktime("$sh","$si","$ss","$sm","$sd","$sy"); 
		$enddate=mktime("$eh","$ei","$es","$em","$ed","$ey"); 
		$days1=round((time()-$startdate)/3600/24) ; 
		$days2=round(($enddate-time())/3600/24) ; 

		/****該月份日期****/
		if($days1 <= $days2){
			$dayGrid = '<td class="day" id="defaultday" '.$onmouseOver.$onmouseOut.'>';
			$dayGrid .= '<div class="day_of_month"><form method="post" name=form'.$d.' id=form'.$d.' action='.$PHP_SELF.'?id='.$id.'&PB_page='.$PB_page.'&m='.$m.'&a='.$a.'&y='.$y.' >';
			/******資料庫取資料*****/
			list($tips, $txt, $total, $rentOutAmount) = GetRentDate($chkDate);
			//$BB = $total<=0&&$rentOutAmount>0?$d."<div style='font-size:12px;color:#996600'>無空房</div>":"<div style='font-size:12px;color:#D5D5D5'>未開放訂房</div>"
			$RoomStatus = $total<=0&&$rentOutAmount>0?$d."<div style='font-size:12px;color:#996600'>".$W1."</div>":$d."<div style='font-size:12px;color:#D5D5D5'>".$W2."</div>";
			$dayGrid .= $total>0?"<span class=\"hotspot\" onClick='document.name=form".$d.".submit()' >".$d."</span>".$tips:$RoomStatus;
			
			$dayGrid .=  $total>0?"<div>".$txt."</div>":"";
			$dayGrid .= "</form></div>";
		}elseif($days1 > $days2){
			$dayGrid = "<td class='day' id='defaultday'><div class='day_of_out'>". $d. "<div style='font-size:12px;color:#D5D5D5'>".$W2."</div></div>";
		}
		echo $dayGrid;
		//$rentOutAmount>0?$d."<div style='font-size:12px;color:#996600'>無空房</div>":
		if ($offset == 0) echo '<div class="week" style="display:'.$show_week.'"><a href="'.$week_link.'?id='.$id.'&main_page='.$main_page.'&PB_page='.$PB_page.'&c='.$c.'&m='.$calmonth.'&a='.$d.'&y='.$calyear.'">week</a></div>';
			
		/* correct date format */
		$coredate = date( "Ymd", mktime( 0, 0, 0, $calmonth, $d, $calyear ) );
		showGrid($coredate);
		echo "</td>";
		$offset++;

		/* if we're on the last day of the week, wrap to the other side */
		if ( $offset > 6 )
		{
				$offset = 0;
				echo '</tr>';
				if ( $day < $totaldays )
						echo '<tr>';
		}
	}
	
	/* fill in the remaining spaces for the end of the month, just to make it look
	   pretty */
	if ( $offset > 0 )
	        $offset = 7 - $offset;
	
	for ($t=0; $t < $offset; $t++) {
		echo "<td>&nbsp;</td>";
	}
	/* end the table */
	echo '</tr><tr><td colspan="7" ><div id="showToday">'.$W3.'：'.date("Y-m-d").'</div></td></tr></table>';
}
/*************取得資料庫中的訂房設置*************/
function GetRentDate($chkDate){
	global $id, $XFUN_TBL, $lan;
	$W4=$lan=="cht"?" 間":" Room(s)";
    $CLASS["DB"] = new xfunDB_sql;
	$CLASS["DB"]->connect(); 
	$CLASS["count"] = new xfunDB_sql;
	$CLASS["count"]->connect(); 

	$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_date] WHERE rentNum =".$id." AND rentDate ='".$chkDate."'";
	$CLASS["DB"]->query($result_num);
	$total = $CLASS["DB"]->num_rows($CLASS["DB"]->result);	//總筆數
	$rentOutAmount=0;
	$rentDateAmount=0;
	if($total >= 1):
		$row = $CLASS["DB"]->fetch_array($CLASS["DB"]->result);
		$rentDateNum=$row['rentDateNum'];
		$rentNum=$row['rentNum'];
		$rentDate=$row['rentDate'];
		
		$result_Sql = "SELECT sum(shopping_amount) as totalAmount FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] WHERE shopping_proid =".$rentDateNum." AND shopping_proname ='".$rentNum."' AND shopping_promodel = '".$rentDate."' AND shopping_status = 'B'";
		//echo $result_Sql;
		$CLASS["count"]->query($result_Sql);
		if($result = $CLASS["count"]->fetch_array($CLASS["count"]->result)){
		  $rentOutAmount=$result["totalAmount"]==""?0:$result["totalAmount"];
		}
		//$amount=0;
		$rentDatePrice=$row['rentDatePrice'];
		$rentDateAmount=$row['rentDateAmount'];
	endif;
  $tips="<div style='font-size:13px;color:#006600; font-weight:bold'>$".$rentDatePrice."</div><div style='font-size:13px;color:#006600; font-weight:bold'>".($rentDateAmount)."$W4</div>";
  $txt.="<input name=\"process\" type=\"hidden\" value=\"add_toCart\" />";
  $txt.="<input name=\"rentNum\" type=\"hidden\" value=\"".$rentNum."\" />";
  $txt.="<input name=\"rentDate\" type=\"hidden\" value=\"".$rentDate."\" />";
  $txt.="<input name=\"rentAmount\" type=\"hidden\" value=\"1\" />";
  $txt.="<input name=\"rentDatePrice\" type=\"hidden\" value=\"".$rentDatePrice."\" />";
  $txt.="<input name=\"rentDateNum\" type=\"hidden\" value=\"".$rentDateNum."\"/>";
  $my_array = array($tips,$txt,$rentDateAmount,$rentOutAmount);
  return $my_array;
}

$thismonth = $y."-".$m;
$nextmonth =  $next["month"]["y"]."-".$next["month"]["m"];
showMonth($m,$y);
?>
