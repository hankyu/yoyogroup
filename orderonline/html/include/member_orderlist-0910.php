<?PHP
//基本設定
$CLASS["order_adm"] = new xfunDB_sql;
$CLASS["order_adm"]->connect(); 

//$show = htmlspecialchars(trim($HTTP_GET_VARS['show']));	//換頁
//$search_str = htmlspecialchars(trim($HTTP_POST_VARS['search_str']));//輸入查詢
	
//輸入搜尋****************************************************Start
       $query_where = " WHERE order_id=".$_SESSION["sorder_id"];

    if(!empty($search_str)):
       $query_where .= " AND order_id = '" . $search_str . "' ";
    endif;
	if(!empty($s_date)&&!empty($e_date)):   
       $query_where = "  AND (DATE_FORMAT(order_date, '%Y-%m-%d') between '$s_date' AND '$e_date')
	   ";
	endif;
//輸入搜尋****************************************************end

  $limit =30;	//每頁筆數
  
  //分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;
?>
<?
function chk_status($id)
{
global $lan;
	switch ($id) {
	case "A0":
		$Astatus=$lan=="cht"?"重新處理":"Re-Check";
		echo $Astatus;
		break;
	case "A1":
		$Astatus=$lan=="cht"?"等待確認中":"Wait for confirmation";
		echo "<font color=red>$Astatus</font>";
		break;
	case "A2":
		$Astatus=$lan=="cht"?"接到訂單處理中":"In dealing process";
		echo "<font color=blue>$Astatus</font>";
		break;
	case "A3":
		$Astatus=$lan=="cht"?"未連絡到客戶":"Failed in contact";
		echo $Astatus;
		break;
	case "A4":
		$Astatus=$lan=="cht"?"等待付款單據":"Wait for paying vouchers";
		echo $Astatus;
		break;
	case "A5":
		$Astatus=$lan=="cht"?"訂單成立 (已付款)":"Confirmed";
		echo "<font color=green>$Astatus</font>";
		break;
	case "A6":
		$Astatus=$lan=="cht"?"訂單失效 (未匯款)":"Refund";
		echo "<font color=red>$Astatus</font>";
		break;
	case "A8":
		$Astatus=$lan=="cht"?"刪除訂單":"Deleted";
		echo $Astatus;
		break;
	case "A9":
		$Astatus=$lan=="cht"?"未結案":"Not finished";
		echo "<font color=gray>$Astatus</font>";
		break;
	case "A10":
		$Astatus=$lan=="cht"?"已結案":"Finished";
		echo "<font color=gray>$Astatus</font>";
		break;
	}
}
?>

<table width="90%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
  <tr>
    <td height="13" align="left" valign="top" bgcolor="#FFF2E6"><input type="button" name="Submit" value=" <?=$lan=="cht"?"重新查詢":"Reset"?> " class="input03" onclick="location='<?=$phpself."?act=logout"?>'"/></td>
  </tr>
  <tr>
    <td width="1243" height="13" valign="top" bgcolor="#FFF2E6"><form id="myform" name="myform" method="post" action="<?=$phpself?>" onSubmit="return check(this)">
  <table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#cccccc" bordercolorlight="#cccccc" bordercolordark="#ffffff" bgcolor="#FFFFFF">
        <tr bgcolor="#B7B700">
          <td align="center" valign="middle" nowrap bgcolor="#FFCC99" class="style13"> #</td>
          <td height="20" align="center" nowrap bgcolor="#FFCC99" class="style13"><?=$lan=="cht"?"訂單編號":"Reservation Number"?></td>
          <td height="20" align="center" nowrap bgcolor="#FFCC99" class="style13"><?=$lan=="cht"?"訂購總金額":"Total Amount"?></td>
          <td align="center" nowrap bgcolor="#FFCC99" class="style13"><?=$lan=="cht"?"付款方式":"Type of Payment"?></td>
          <td align="center" nowrap bgcolor="#FFCC99" class="style13"><?=$lan=="cht"?"訂單日期":"Order Date"?></td>
          <td align="center" nowrap bgcolor="#FFCC99" class="style13"><font class=c><?=$lan=="cht"?"處理情形":"Result"?></font></td>
        </tr>
<?PHP

  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list] ".$query_where." ORDER BY order_date DESC LIMIT $show,$limit";
//echo $result_num;
  $CLASS["order_adm"]->query($result_num);
  $total = $CLASS["order_adm"]->num_rows($CLASS["order_adm"]->result);	//總筆數

  $num = 0;
	if($total >= 1):
	while ($row = $CLASS["order_adm"]->fetch_array($CLASS["order_adm"]->result)) {
  	$num = $num + 1;
	$order_id=$row["order_id"];
	$order_name=$row["order_name"];
	$order_phone=$row["order_phone"];
	$order_mobile=$row["order_mobile"];
	$order_email=$row["order_email"];
	$order_totalprice=$row["order_totalprice"];
	$order_payway=$row["order_payway"];
	$order_date=$row["order_date"];
	$order_status=$row["order_status"];
?>
        <tr bgcolor="#FFFFFF" onmouseover="this.style.backgroundColor='#FFFFCC';" onmouseout="this.style.backgroundColor='#FFFFFF';">
          <td align="center" bgcolor="#FFCC99" class="style13"><?=$num?></td>
          <td align="center" valign="middle"><a href="<?=$phpself?>?order_id=<?=$order_id?>&act=viewlist" title="檢視訂單內容">
            <font color="#990000"><?=$order_id?></font>
          </a></td>
          <td align="center"><?=$order_totalprice?></td>
          <td align="center"><?=$order_payway?></td>
          <td align="center"><?=$order_date?></td>
          <td align="center"><? chk_status($order_status)?></td>
        </tr>
        <?
    }  //while_end
  else:
?>
        <tr align="center">
          <td colspan="7">
              <font color=red><?=$lan=="cht"?"尚無訂單資料":"No Result!"?></font></td>
        </tr>
        <? endif;?>
      </table>
</form>    </td>
  </tr>
  <tr>
    <td height="13" align="center" valign="top" bgcolor="#FFF2E6"><table>
      <tr>
        <td align="center" valign="top" bgcolor="#FFCC99"><?PHP
//分頁設訂
class mypage extends page
{
 function mypage($array)
 {
  parent::page($array);
  $this->first_page="<img src='../../admin/images/page_first.gif' border=0/>";
  $this->last_page="<img src='../../admin/images/page_last.gif' border=0/>";
  $this->next_page="<img src='../../admin/images/page_next.gif' border=0/>";
  $this->pre_page="<img src='../../admin/images/page_prev.gif' border=0 />";
  $this->set('format_left','');
  $this->set('format_right','');
 }
 
 function show()
 {
  $pagestr='<div class="pagenavi" id="lopage">';
  $pagestr.=$this->first_page().' ';
  $pagestr.=$this->pre_page().' ';
  $pagestr.=$this->nowbar('','curr');
  $pagestr.=$this->next_page();
  $pagestr.=$this->last_page();
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;共<span class="num">'.$this->totalpage.'</span>頁<span class="num">'.$this->totaldata.'</span>筆資料';
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;前往第 '.$this->select().' 頁';
  $pagestr.='</div>';
  return $pagestr;
 }
}
//取得總筆數
$CLASS["order_adm"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list]".$query_where);
$total = $CLASS["order_adm"]->num_rows($CLASS["order_adm"]->result);
//秀分頁選單
if($total > $limit){
	$page=new mypage(array('total'=>$total,'perpage'=>$limit));
	echo $page->show(2);
}
?>        </td>
      </tr>
    </table></td>
  </tr>
</table>
