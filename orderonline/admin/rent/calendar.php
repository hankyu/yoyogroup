<link rel="stylesheet" type="text/css" href="css/supercali.css">
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
	'January'	=> '一月',
	'February'	=> '二月',
	'March'		=> '三月',
	'April' 	=> '四月',
	'May'		=> '五月',
	'June'		=> '六月',
	'July'		=> '七月',
	'August'	=> '八月',
	'September'	=> '九月',
	'October'	=> '十月',
	'November'	=> '十一月',
	'December'	=> '十二月',
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
	global $week_titles, $id, $m, $a, $y, $w, $c, $next, $prev,$ly, $lm, $la;
	global $week_month, $show_week, $onmouseOver, $onmouseOut, $week_link, $day_link, $main_page, $PB_page;
	/* determine total number of days in a month */
	
	$calday = 0;
	$totaldays = 0;
	while ( checkdate( $calmonth, $totaldays + 1, $calyear ) )
	        $totaldays++;
	
	/* build table */
	echo '<table width="100%" class="grid""><tr>'; 
	echo '<th colspan="7" class="cal_top"><a href="',$PHP_SELF,'?id='.$id.'&main_page='.$main_page.'&PB_page='.$PB_page.'&c='.$c.'&m='.$prev["month"]["m"].'&a=1&y='.$prev["month"]["y"].'">&lt;&lt;</a> '.$week_month[date('F', mktime(0,0,0,$calmonth,1,$calyear))].'&nbsp;'.date('Y', mktime(0,0,0,$calmonth,1,$calyear)).' <a href="'.$PHP_SELF.'?id='.$id.'&main_page='.$main_page.'&PB_page='.$PB_page.'&c='.$c.'&m='.$next["month"]["m"].'&a=1&y='.$next["month"]["y"].'">&gt;&gt;</a></th></tr><tr>';
	for ( $x = 0; $x < 7; $x++ )
	        echo '<th>'. $week_titles[ $x ]. '</th>';
	
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
	echo "<font color='#ffffff'>".date("Y-m-j G:i:s")."</font>";
	for ( $d = 1; $d <= $totaldays; $d++ )
	{
			//比較日期大小
			$chkDate=$calyear."-".$calmonth."-".$d;
			$nowDate = date("Y-m-j");
			list($sy, $sm, $sd, $sh, $si, $ss) = sscanf($chkDate." 00:00:00", "%d-%d-%d %d:%d:%d");
			list($ey, $em, $ed, $eh, $ei, $es) = sscanf($nowDate." 00:00:00", "%d-%d-%d %d:%d:%d");
			$startdate=mktime("$sh","$si","$ss","$sm","$sd","$sy"); 
			$enddate=mktime("$eh","$ei","$es","$em","$ed","$ey"); 
			$days1=(time()-$startdate)/3600/24; 
			$days2=($enddate-time())/3600/24; 
//不抓精確值了修正後的值
$days1=date("Ymd");
$reDay =  strlen($d)==1?"0".$d:$d;
$days2=$calyear.$calmonth.$reDay;
//echo "($d)".$days1." = ".$days2;
//echo "($d)".$startdate."-".$enddate;
			if($days1 >= $days2) {
				/****該月份停止日期****/
				echo '<td style="background-color:#333"><div class="day_of_month">'. $d. '</div>';
			} elseif($days1 < $days2) {
				/****該月份其他日期****/
				$checked = $d==$_GET['a'] ? " checked ":"";
				echo '<td class="day" id="'.GetRentDate($chkDate).'" '.$onmouseOver.$onmouseOut.'><div class="day_of_month"><input type="checkbox" class="checkDate" name="checkDate[]" id="checkDate'.$calyear.$calmonth.$d.'" value="'.$calyear."-".$calmonth.'-'.$d.'" '.$checked.' ><a href="'.$day_link.'?id='.$id.'&PB_page='.$PB_page.'&main_page='.$main_page.'&c='.$c.'&m='.$calmonth.'&a='.$d.'&y='.$calyear.'">'. $d. '</a></div>';
				if ($offset == 0) echo '<div class="week" style="display:'.$show_week.'"><a href="'.$week_link.'?id='.$id.'&main_page='.$main_page.'&PB_page='.$PB_page.'&c='.$c.'&m='.$calmonth.'&a='.$d.'&y='.$calyear.'">week</a></div>';
			}
				
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
	echo '</tr><tr><td colspan="7" ><div id="showToday">今天日期：'.date("Y-m-d").'</div></td></tr></table>';
}

function GetRentDate($chkDate){
	global $id, $XFUN_TBL;
	$CLASS["DB"] = new xfunDB_sql;
	$CLASS["DB"]->connect(); 

	$result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_date] WHERE rentNum =".$id." AND rentDate ='".$chkDate."'";
	$CLASS["DB"]->query($result_num);
	$total = $CLASS["DB"]->num_rows($CLASS["DB"]->result);	//總筆數
	if($total >= 1):
		$row = $CLASS["DB"]->fetch_array($CLASS["DB"]->result);
		return CountStorage($id,$chkDate)>0?"hasrentday":"rentday";
	else:
		return "";
	endif;
}

$thismonth = $y."-".$m;
$nextmonth =  $next["month"]["y"]."-".$next["month"]["m"];
showMonth($m,$y);
?>