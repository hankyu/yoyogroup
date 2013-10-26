<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<style type="text/css">
/*FOR FireFox 瀏覽器*/
/* .xfun_table {
  display:table;
  border-collapse:separate;
  width:100%
 }
 .rowTitle {
  display:table-row;
 }
 .rowTitle div {
  display:table-cell;
 }
 .rowTitle .cell {
  padding: 0px 5px 0px 5px;
  text-align:center;
  overflow:hidden;
  background-color:#CCCCCC;
  color:#000000;
  height:10px;
 }
 .rowList {
  display:table-row;
 }
 .rowList div {
  display:table-cell;
 }
 .rowList .cell {
  padding: 0px 5px 0px 5px;
  text-align:left;
  overflow:hidden;
  background-color:#F2F2F2;
  height:10px;
 }
 */
</style>

<style type="text/css" media="all">
/*FOR IE 瀏覽器*/
	.xfun_table {
	display:block;
	 width:100%;
	}
	.rowTitle {
	padding:1px;
	}
	.rowTitle div {
	display:block;
	float:left;
	margin:0;
	}
	.rowTitle .cell {
	padding: 0px 5px 0px 5px;
    margin-left:1px;
	background-color:#FAF7F1;
	/*width:100px;*/
	float:left;
	height:20px;
	}
	.rowList {
	padding:1px;
	}
	.rowList div {
	display:block;
	float:left;
	margin:0;
	}
	.rowList .cell {
	overflow:hidden;
	padding: 0px 5px 0px 5px;
    margin-left:1px;
	background-color:#FFFFFF;
	/*width:100px;*/
	float:left;
	height:20px;
	}
	.ieclearer {
	float:none;
	clear:both;
	height:0;
	padding:0;
	font-size: 2px;
	line-height:0;
	}
	#r_0 {
	width:5%;
	}
	#r_1 {
	width:20%;
	}
	#r_2 {
	width:20%;
	}
	#r_3 {
	width:10%;
	}
	#r_4 {
	width:20%;
	}
	#r_5 {
	width:10%;
	}
</style>

<?PHP 
//==============購物商品清單資料處理程序==============
if($process=="add_toCart"){
$Cart_ID=$_COOKIE["Cart_ID"];
$Cdate = date('Y-m-d');
//連線設定
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
//echo "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] WHERE shopping_cartid = '$Cart_ID' AND shopping_proid=$rentDateNum";
//exit;
if($act!="delete"){
	$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] WHERE shopping_cartid = '$Cart_ID' AND shopping_proid=$rentDateNum ");
	$total = $CLASS["db"]->num_rows($CLASS["db"]->result);
	if($total >= 1):
		//檢查庫存數量
		$row1 = $CLASS["db"]->fetch_array($CLASS["db"]->result);
		$shopping_amount=$row1["shopping_amount"];
		$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_date] WHERE rentDateNum = '$rentDateNum'");
		$row = $CLASS["db"]->fetch_array($CLASS["db"]->result);
		$rentDateAmount=$row["rentDateAmount"]-CountStorage($rentDateNum,$rentNum,$rentDate);
		$act=$shopping_amount>=$rentDateAmount?"none":"update";
	else:
		$act="insert";
	endif;
	$CLASS["db"]->free_result($CLASS["db"]->result);
}
if($add_inlist =='true'):
	$udp_ext = "`shopping_amount` = $rentAmount";
	$act="update";
else:
	$udp_ext = "`shopping_amount`=`shopping_amount` + $rentAmount";
endif;
if(!empty($sid)&&$batch!="y"):
	$del_ext=" AND shopping_num=$sid";
endif;

if($act!="none"){
	$Cdate=date("Y-m-d");
	$Order_Pro = new XFUN_SQLHelp();
	$Order_Pro->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_shopping_item];
	$Order_Pro->ClassTitle = $lan=="cht"?"購物車資料":"Cart";
	$Order_Pro->DB_Field = "`shopping_cartid`,`shopping_proid`,`shopping_proname`,`shopping_promodel`,`shopping_price1`,`shopping_amount`,`shopping_status`,`shopping_cdate`";
	$Order_Pro->DB_Values = "'$Cart_ID',$rentDateNum,'$rentNum','$rentDate','$rentDatePrice','$rentAmount','A','$Cdate'";
	$Order_Pro->DB_updValues = $udp_ext." WHERE shopping_cartid = '$Cart_ID' AND shopping_proid=$rentDateNum ";
	$Order_Pro->DB_delValues = " shopping_cartid = '$Cart_ID'".$del_ext;
	if($Order_Pro->ActDataAccess($act)):
		$Num = $Order_Pro->DB_InsertID;
		$Insert_DB=true;
		$msg = "<script language='javascript'>redirectURL('".$Order_Pro->ClassActTitle.$Mem->ClassTitle."成功！','$REDirect_PG2')</script>";
	else:
		$Insert_DB=false;
		$msg = "系統錯誤!請通知系統管理者。";
	endif;
}
//echo $msg;
//exit;

}
?>

<?PHP
//***********************************GridView*********************************************************
$ch=array("#","房型名稱","住宿日期","價格","訂購數量","編輯");
$en=array("#","Room Type","Date","Price","Room(s)","Edit");
$deletefirst=$lan=="cht"?"請先刪除滿額訂房，重新選訂，謝謝。":"Delete The Empty Room First";
$delete=$lan=="cht"?"刪除":"Delete";
$checkout=$lan=="cht"?"結 帳":"Checkout";
$deleteall=$lan=="cht"?"刪除所有訂房":"Delete All";
$continue=$lan=="cht"?"繼續瀏覽":"Continue";
$continueUrl=$lan=="cht"?"index.php":"eindex.php";
$chekcoutUrl=$lan=="cht"?"cart_terms.php":"ecart_terms.php";
$xTableTitle=$lan=="cht"?$ch:$en;
$full=$lan=="cht"?"滿額":"full";
$xTlength = count($xTableTitle);
for($i=0;$i<$xTlength;$i++)
{
	//標題
	$tdTitle.="<div class=\"cell\" id=\"r_".$i."\">".$xTableTitle[$i]."</div>";
}
$ForIE="<div class='ieclearer'></div><br>";
$trTitle="<div class=\"rowTitle\">".$tdTitle.$ForIE."</div>";

$CLASS["DB"] = new xfunDB_sql;
$CLASS["DB"]->connect(); 
//每頁筆數
$limit = 20;
//分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;

  $extednSql=" WHERE `shopping_cartid`='".$_COOKIE["Cart_ID"]."'";
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] $extednSql ORDER BY shopping_promodel ASC LIMIT $show,$limit";
  $CLASS["DB"]->query($result_num);
  $total = $CLASS["DB"]->num_rows($CLASS["DB"]->result);	//總筆數
  $num = 0;
  $chkFull = 0;
  if($total >= 1):
		  while ($row = $CLASS["DB"]->fetch_array($CLASS["DB"]->result)) {
			$num = $num + 1;
			$shopping_num = $row["shopping_num"];
			$shopping_proid = $row["shopping_proid"];
			$shopping_proname = $row["shopping_proname"];
			$shopping_promodel = $row["shopping_promodel"];
			$shopping_price1 = $row["shopping_price1"];
			$shopping_amount = $row["shopping_amount"];
			//******************內容列表***********************
			//庫存數量
		    $selectURL = $PHP_SELF."?id=$id&PB_page=$PB_page&m=$m&a=$a&y=$y&add_inlist=true&process=add_toCart&Cart_ID=".$_COOKIE["Cart_ID"]."&rentDateNum=$shopping_proid";
			$delURL = $PHP_SELF."?id=$id&PB_page=$PB_page&m=$m&a=$a&y=$y&act=delete&process=add_toCart&sid=$shopping_num";
			$batchDelURL = $PHP_SELF."?id=$id&PB_page=$PB_page&m=$m&a=$a&y=$y&act=delete&process=add_toCart&sid=$shopping_num&batch=y";
			$rentAmount=view_kind($shopping_proid,$XFUN_TBL[TABLE_XFUN_rent_date],"rentDateNum","rentDateAmount");
			$pjName=$lan=="cht"?"projName":"en_projName";
			$pojname=view_kind($shopping_proname,$XFUN_TBL[TABLE_XFUN_rent],"rentNum",$pjName);
			if($rentAmount>0){
			 $selOption=selectControl($rentAmount,$shopping_amount);
			}else{
			 $chkFull = $chkFull + 1;
			 $selOption="<font color=red>$full</font>";
			}
			$tdContent="";
			$tdContent.="<div class=\"cell\" id=\"r_0\">".$num."</div>";
			$tdContent.="<div class=\"cell\" id=\"r_1\">".$pojname."</div>";
			$tdContent.="<div class=\"cell\" id=\"r_2\">".$shopping_promodel."</div>";
			$tdContent.="<div class=\"cell\" id=\"r_3\">".$shopping_price1."</div>";
			$tdContent.="<div class=\"cell\" id=\"r_4\">".$selOption."</div>";
			$tdContent.="<div class=\"cell\" id=\"r_5\"><a href=\"".$delURL."\" >$delete</a></div>";
			$trContent.="<div class=\"rowList\">".$tdContent.$ForIE."</div>";
		  }  //while_end
		    $CheckOutBtn=$chkFull<=0?"onclick=\"location='".$chekcoutUrl."'\"":"onclick=\"javascript:alert('$deletefirst')\"";
		  $confirmBtn="<input type=\"button\" name=\"button\" value=\" $checkout \" ".$CheckOutBtn."  class=\"input03\"/> <input type=\"button\" name=\"button\" value=\" $deleteall \" onclick=\"location='$batchDelURL'\" class=\"input03\"/>";
  else:
		   $trTitle="";
  endif;
//產生輸出表格  
$xfun_GridView ="<div id=\"xfun_GridView\" class=\"xfun_table\">".$trTitle.$trContent."</div>";
echo $xfun_GridView;
?>
<?PHP
//下拉選單
function  selectControl($amount,$selectValue){
global $selectURL;
  $selectCtrl.="<select name=\"menu1\" style='width:50px' onchange=\"MM_jumpMenu('self',this,0)\">";
	  for($n=1;$n<=$amount;$n++){
	  	$selected=$selectValue==$n?"selected":"";
		$selectCtrl.="<option ".$selected." value=".$selectURL."&rentAmount=".$n.">".$n."</option>";
	  }
  $selectCtrl.="</select>";
  return $selectCtrl;
}
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
$CLASS["DB"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] $extednSql");
$totalRow = $CLASS["DB"]->num_rows($CLASS["DB"]->result);
//秀分頁選單
$page=new mypage(array('total'=>$totalRow,'perpage'=>$limit));
if($totalRow > $limit):
echo "<div class=\"rowTitle\">".$page->show(2)."</div>";
endif;
$ss="<input type=\"button\" name=\"button\" value=\" $continue \" onclick=\"location='../room/$continueUrl'\"  class=\"input03\"/> ";
echo "<br><div align='center'>".$ss.$confirmBtn."</div>";
?>
