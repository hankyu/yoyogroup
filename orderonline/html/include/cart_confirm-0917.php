<script language="javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function cop_name()
{
	var order2_name=document.reg.order2_name.value;
	order2_recivename=document.getElementById("order2_recivename");
	order2_recivename.value = order2_name;
}
function cop(){
var zip;
var city;
var town;
<? if($lan=="cht"){?>
	zip=document.getElementById("Zip");
	city=document.getElementById("City");
	town=document.getElementById("Town");
<? }?>	
	var add=document.getElementById("add");
	var order2_address=document.getElementById("order2_address");
<? if($lan=="cht"){?>
	order2_address.value = "("+zip.value+")"+city.value+town.value+add.value;
	//document.reg2.add2.focus();
<? }else{?>	
	order2_address.value = add.value;
<? }?>
}
function cop2(){
var zip;
var city;
var town;
<? if($lan=="cht"){?>
	zip=document.getElementById("Zip");
	city=document.getElementById("City");
	town=document.getElementById("Town");
<? }?>	
	var add=document.getElementById("add");
	var invoice_address=document.getElementById("invoice_address");
<? if($lan=="cht"){?>
	invoice_address.value = "("+zip.value+")"+city.value+town.value+add.value;
<? }else{?>	
	invoice_address.value = add.value;
<? }?>
}

//-->
</script>
<SCRIPT language=JavaScript>
<!--
function check(reg)
{

  if (document.reg.order2_name.value == "")
  {
    alert("<?=$lan=="cht"?"「訂購人姓名」不得為空白！":"Name Please!"?>");
    document.reg.order2_name.focus();
    return (false);
  }

  if (document.reg.order2_phone.value == "")
  {
    alert("<?=$lan=="cht"?"「連絡電話」不得為空白！":"Contact Phone Please!"?>");
    document.reg.order2_phone.focus();
    return (false);
  }
    if(document.reg.order2_phone.value != ""){
    cltxt=document.reg.order2_phone.value;
	for (i=0;i<cltxt.length;i++)
	{
	  c=cltxt.charAt(i);
	  if ("0123456789".indexOf(c,0)<0)
	  {
	  alert("<?=$lan=="cht"?"連絡電話請輸入阿拉伯數字！":"The Contact Phone Field Only Number Permit!"?>");
	  document.reg.order2_phone.focus();
	  document.reg.order2_phone.value = "";
	  return (false);
	  }
	}
  }
<?
{
?>
  if (document.reg.order2_cell.value == "")
  {
    alert("<?=$lan=="cht"?"「行動電話」不得為空白！":"Cell Phone Please!"?>");
    document.reg.order2_cell.focus();
    return (false);
  }
<?
}
?>
  if(document.reg.order2_cell.value != ""){
    cltxt=document.reg.order2_cell.value;
    for (i=0;i<cltxt.length;i++)
	{
	  c=cltxt.charAt(i);
	  if ("0123456789".indexOf(c,0)<0)
	  {
	  alert("<?=$lan=="cht"?"行動電話請輸入阿拉伯數字！":"The Cell Phone Field Only Number Permit!"?>");
	  document.reg.order2_cell.focus();
	  document.reg.order2_cell.value = "";
	  return (false);
	  }
	}

  }

  if (document.reg.order2_email.value == "")
  {
    alert("<?=$lan=="cht"?"「Email」不得為空白！":"Email Please!"?>");
    document.reg.order2_email.focus();
    return (false);
  }

  if (document.reg.order2_email.value != "")
  {
	  if(!checkmail(document.reg.order2_email.value))
	  {
			alert("<?=$lan=="cht"?"E-mail格式不正確！":"Incorrect Email Format!"?>");
			document.reg.order2_email.focus();
			document.reg.order2_email.value="";
			return false;
	  }
  }

  if (document.reg.add.value == "")
  {
    alert("<?=$lan=="cht"?"「聯絡地址」不得為空白！":"Address Please!"?>");
    document.reg.add.focus();
    return (false);
  }
  if (document.reg.order2_paykind.value == "")
  {
    alert("<?=$lan=="cht"?"請選擇交易方式！":"Type of Payment Please!"?>");
    document.reg.order2_paykind.focus();
    return (false);
  }
	paykind=document.reg.order2_paykind.value;
  if(paykind=="信用卡")
  {
	  if (document.reg.cardname.value == "")
	  {
		alert("請填寫持卡人姓名！");
		document.reg.cardname.focus();
		return (false);
	  }
	  if (document.reg.cardno1.value == "" || document.reg.cardno2.value == "" || document.reg.cardno3.value == "" || document.reg.cardno4.value == "")
	  {
		alert("請填寫信用卡號！");
		document.reg.cardno1.focus();
		return (false);
	  }else{
	  FC_Filed="cardno1"
			total=document.getElementById(FC_Filed)
			cltxt = total.value;
			for (i=0; i<cltxt.length; i++) {
				c = cltxt.charAt(i);
				if ("0123456789".indexOf(c, 0)<0) {
					total.focus();
					total.value = "";
					alert("信用卡號阿拉伯數字填寫！");
					return (false);
				}
			}
	  FC_Filed="cardno2"
			total=document.getElementById(FC_Filed)
			cltxt = total.value;
			for (i=0; i<cltxt.length; i++) {
				c = cltxt.charAt(i);
				if ("0123456789".indexOf(c, 0)<0) {
					total.focus();
					total.value = "";
					alert("信用卡號阿拉伯數字填寫！");
					return (false);
				}
			}
	  FC_Filed="cardno3"
			total=document.getElementById(FC_Filed)
			cltxt = total.value;
			for (i=0; i<cltxt.length; i++) {
				c = cltxt.charAt(i);
				if ("0123456789".indexOf(c, 0)<0) {
					total.focus();
					total.value = "";
					alert("信用卡號阿拉伯數字填寫！");
					return (false);
				}
			}
	  FC_Filed="cardno4"
			total=document.getElementById(FC_Filed)
			cltxt = total.value;
			for (i=0; i<cltxt.length; i++) {
				c = cltxt.charAt(i);
				if ("0123456789".indexOf(c, 0)<0) {
					total.focus();
					total.value = "";
					alert("信用卡號阿拉伯數字填寫！");
					return (false);
				}
			}
	  	//Chk_Filed("cardno2");
	  	//Chk_Filed("cardno3");
	  	//Chk_Filed("cardno4");
	  }
	  if (document.reg.expmonth.value == "")
	  {
		alert("請填寫信用卡期限月份！");
		document.reg.expmonth.focus();
		return (false);
	  }
	  if (document.reg.expyear.value == "")
	  {
		alert("請填寫信用卡期限年份！");
		document.reg.expyear.focus();
		return (false);
	  }
  }
  
return   true;  
}

function LTrim(str)
{
    var i;
    for(i=0;i<str.length;i++)
    {
        if(str.charAt(i)!=" "&&str.charAt(i)!="  ")break;
    }
    str=str.substring(i,str.length);
    return str;
}

function RTrim(str)
{
    var i;
    for(i=str.length-1;i>=0;i--)
    {
        if(str.charAt(i)!=" "&&str.charAt(i)!="  ")break;
    }
    str=str.substring(0,i+1);
    return str;
}

//Check email
function checkmail(mail) 
{	
	var CheckMail = LTrim(RTrim(mail));	
	return (new RegExp(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/).test(CheckMail)); 
} 

function Chk_Filed(FC_Filed) {
    total=document.getElementById(FC_Filed)
	cltxt = total.value;
	for (i=0; i<cltxt.length; i++) {
		c = cltxt.charAt(i);
		if ("0123456789".indexOf(c, 0)<0) {
			total.focus();
			total.value = "";
			alert("信用卡號阿拉伯數字填寫！");
			return (false);
		}
	}
}
-->
</SCRIPT>
<?PHP
//基本設定
$_SESSION["Order_GID"]="";
$Cart_ID=$_COOKIE["Cart_ID"];
$CLASS["cart"] = new xfunDB_sql;
$CLASS["cart"]->connect(); 
$headtitle=$lan=="cht"?"訂 單 確 認":"Room Confirmation";
$Send_OrderFrom_URL=$lan=="cht"?"send_confirm.php":"esend_confirm.php";
	$show = htmlspecialchars(trim($HTTP_GET_VARS['show']));	//換頁
	$search_str = htmlspecialchars(trim($HTTP_POST_VARS['search_str']));//輸入查詢
	
  $limit =20;	//每頁筆數
  
  //分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;

  $query_where="WHERE shopping_cartid='".$Cart_ID."' AND shopping_status='A'";
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] ".$query_where;

  $CLASS["cart"]->query($result_num);

  $total = $CLASS["cart"]->num_rows($CLASS["cart"]->result);	//總筆數
?>
<?PHP
//========================================================會員資料========================================================
$CLASS["mem"] = new xfunDB_sql;
$CLASS["mem"]->connect(); 
$REDirect_PG="history.back()";
$CLASS["mem"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_member] WHERE member_num ='".$_SESSION["smember_num"]."'");

if ($row = $CLASS["mem"]->fetch_array($CLASS["mem"]->result)):

	 $member_num = $row["member_num"];
	 $member_id = $row["member_id"];
	 $member_password = $row["member_password"];
	 $member_name = $row["member_name"];
	 $member_sex = $row["member_sex"];
	 $member_birthday = $row["member_birthday"];
	 $member_userid = $row["member_userid"];
	 $member_email = $row["member_email"];
	 $member_phone = $row["member_phone"];
	 $member_cell = $row["member_cell"];
	 $member_zip = $row["member_zip"];
	 $City = $row["member_city"];
	 $Town = $row["member_town"];
	 $member_address = $row["member_address"];
	 $member_epaper_order = $row["member_epaper_order"];
	 $member_note = $row["member_note"];

endif;
$CLASS["mem"]->free_result($CLASS["mem"]->result);
//========================================================會員資料========================================================
?>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
      <td align="center"><strong><?=$headtitle?></strong></td>
  </tr>
</table>
   
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="0">
<tr>
<td align="center" valign="top">
      <table width="100%" border="0" cellpadding="5" cellspacing="1">
        <tr align="center" bgcolor="#FFCC99">
          <td width="15" class="tdList01">#</td>
          <td class="tdList01"><?=$lan=="cht"?"房型名稱":"Room Type"?></td>
          <td class="tdList01"><?=$lan=="cht"?"住宿日期":"Date"?></td>
          <td class="tdList01"><?=$lan=="cht"?"價格":"Price"?></td>
          <td class="tdList01"><?=$lan=="cht"?"數量":"Room(s)"?></td>
          <td class="tdList01"><?=$lan=="cht"?"小計":"Subtotal"?></td>
        </tr>

<?PHP
//=========================================================訂購清單========================================================
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] ".$query_where." ORDER BY shopping_promodel ASC LIMIT $show,$limit";

  $CLASS["cart"]->query($result_num);
  $total = $CLASS["cart"]->num_rows($CLASS["cart"]->result);	//總筆數
  $num = 0;
	if($total >= 1):
	while ($row = $CLASS["cart"]->fetch_array($CLASS["cart"]->result)) {
  	$num = $num + 1;
	$shopping_num=$row["shopping_num"];
	$shopping_proid=$row["shopping_proid"];
	$shopping_proname=$row["shopping_proname"];
	$shopping_promodel=$row["shopping_promodel"];
	$shopping_prosize=$row["shopping_prosize"];
	$shopping_procolor=$row["shopping_procolor"];
	$shopping_price1=$row["shopping_price1"];
	$shopping_price2=$row["shopping_price2"];
	$shopping_amount=$row["shopping_amount"];
	$shopping_totalPrice=$row["shopping_totalPrice"];
	$shopping_countTotal+=$shopping_price1*$shopping_amount;
	$shopping_totalAmount+=$shopping_amount;
	$pjName=$lan=="cht"?"projName":"en_projName";
?>
        <tr align="center" bgcolor="#FFE0C1">
          <td class="tdList02"><?=$num?></td>
          <td class="tdList02"><?=view_kind($shopping_proname,$XFUN_TBL[TABLE_XFUN_rent],"rentNum",$pjName)?></td>
          <td class="tdList02"><?=$shopping_promodel?></td>
          <td class="tdList02"><?=$shopping_price1?></td>
          <td class="tdList02"><?=$shopping_amount?></td>
          <td class="tdList02"><?=$shopping_price1*$shopping_amount?></td>
        </tr>
<?
    }  //while_end
  else:
?>
        <tr>
          <td colspan="6" align="center" valign="middle" bgcolor="#ffffff"><font color="#990000">
		  <?=$lan=="cht"?"尚無訂房資料，請至訂房專區選訂，謝謝！":"Here are no items in your cart. Please go back to room list and choose rooms again, thank you!"?>
		  </font></td>
        </tr>
<? 
endif;
//=========================================================訂購清單========================================================
?>
</table>
</td>
  </tr>
      <tr>
        <td align="center" valign="middle">
<?PHP
//==========================================分頁設訂=====================================================
class mypage extends page
{
 function mypage($array)
 {
  parent::page($array);
  $this->first_page="<img src='../../images/000_home/btfirst.gif' border=0/>";
  $this->last_page="<img src='../../images/000_home/btfinal.gif' border=0/>";
  $this->next_page="<img src='../../images/000_home/btnext.gif' border=0/>";
  $this->pre_page="<img src='../../images/000_home/btprevious.gif' border=0 />";
  $this->set('format_left','');
  $this->set('format_right','');
 }
 
 function show()
 {
  $pagestr='<div class="pagenavi" id="lopage">';
  $pagestr.=$this->first_page().' ';
  $pagestr.=$this->pre_page().' ';
  //$pagestr.=$this->nowbar('','curr');
  $pagestr.=$this->next_page();
  $pagestr.=$this->last_page();
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;共<span class="num">'.$this->totalpage.'</span>頁<span class="num">'.$this->totaldata.'</span>筆資料';
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;前往第 '.$this->select().' 頁';
  $pagestr.='</div>';
  if ($this->totalpage>1):
  	return $pagestr;
  endif;
 }
}
//取得總筆數
$CLASS["cart"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_shopping_item] $query_where");
$total = $CLASS["cart"]->num_rows($CLASS["cart"]->result);
//秀分頁選單
$page=new mypage(array('total'=>$total,'perpage'=>$limit));
echo $page->show(2);
$CLASS["cart"]->free_result($CLASS["cart"]->result);
?>	
<?PHP
if($total >= 1):
?>
<form action="<?=$Send_OrderFrom_URL?>" method="post" name="reg" id="reg" style="margin-top: 0" onSubmit="return check(this)">

<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="tdList00">

	<?=$lan=="cht"?"訂單內合計":"The reservation includes"?> <font color="#FF0000"><?=$shopping_totalAmount?></font> <?=$lan=="cht"?"間訂房":"room(s)"?>，<?=$lan=="cht"?"訂房總金額":" the total price is "?>：<font color="#990000">NT <?=$shopping_countTotal?>  </font> 
	  <input name="order_cartage" type="hidden" id="order_cartage" value="<?=$cartage?>" />
	  </td>
  </tr>
  <!--<tr>
    <td align="center" class="tdList00">商品運費金額：<font color="#990000">NT <?=$cartage?> 元</font> 
     </td>
  </tr>-->
  <tr>
    <td align="center" class="tdList00"><?=$lan=="cht"?"本訂單需付款總金額":"Total amount payable"?>：<font color="#990000">NT
      <?=$cartage+$shopping_countTotal?></font>
      <input name="order_totalprice" type="hidden" id="order_totalprice" value="<?=$cartage+$shopping_countTotal?>" /></td>
  </tr>
  <tr >
    <td align="left" background="../../images/000_home/line3.gif" class="bg_bottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">
	<?=$lan=="cht"?"注意事項：<br />請再次確認以上您的訂單內容，若您想繼續訂房或變更訂房內容，請按下方\"<font color=\"#FF0000\">變更訂單</font>\"鍵，若您的訂單經確認後無誤，請按下方\"<font color=\"#FF0000\">結帳</font>\"鍵。 <br />":"Notice:<br />
Please review the total amount carefully. <br />If you want to continue booking or modify the reservation, click “change” button below.
And click “Submit” button if you want to confirm this reservation.
"
	?>
     <!--2. 若您的購物未滿台幣 <font color="#990000"><?=$order_totalprice?></font>元，則須加收台幣 <font color="#990000"><?=$cartage?></font>元運費，謝謝您。<br />
     -->
     <!--2. 若對訂房流程有任何疑問，請參考 <img src="../../admin/images/icon09.gif" alt="訂房須知" width="14" height="19" /> <a href="#" class="d" onclick="MM_openBrWindow('../include/order_help.php','','scrollbars=yes,width=640,height=580')"><strong><font color="#CC0000">訂房須知</font></strong></a> 說明。     --></td>
  </tr>
  <tr>
    <td align="left"  background="../../images/000_home/line3.gif" class="bg_bottom">&nbsp;</td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr align="center">
          <td height="20" colspan="4" align="left" bgcolor="#CCCC99" class="tdList00"><?=$lan=="cht"?"請確認您的資料是否正確，以免造成無法聯繫":"Please check user information carefully"?></td>
        </tr>
        <tr>
          <td width="170" height="2" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"訂購人姓名":"Full Name of Order Person"?><span class="style8">*</span></td>
            <td width="628" height="2" colspan="3" align="left" bgcolor="#ffffff"><input name="order2_name" type="text" class="text" id="order2_name" value="<?=$member_name?>" size="15" ></td>
        </tr>
        <tr>
          <td width="170" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"聯絡電話":"Phone Number"?><span class="style8">*</span></td>
            <td width="628" colspan="3" align="left" bgcolor="#ffffff"><input name="order2_phone" type="text" class="text" id="order2_phone" value="<?=$member_phone?>" size="15"><br>
              <font color="#990000">
            <?=$lan=="cht"?"請輸入區碼+電話號碼數字，不要有()或-符號":"Please input numbers, don’t  include ( ) or -"?></font> </td>
        </tr>
        
        <tr>
          <td width="170" height="0" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"行動電話":"Mobile Number"?></td>
            <td width="628" height="0" colspan="3" align="left" bgcolor="#ffffff"><input name="order2_cell" type="text" class="text" id="order2_cell" value="<?=$member_cell?>" size="15">
			<font color="#990000">
            <?=$lan=="cht"?"請輸入台灣手機10碼數字，不要有()或-符號":""?></font> 
			
			</td>
        </tr>
        <tr>
          <td height="0" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"電子信箱":"E-Mail"?><span class="style8">*</span></td>
          <td height="0" colspan="3" align="left" bgcolor="#ffffff" class="option03"><input name="order2_email" type="text" id="order2_email" value="<?=$member_email?>" class="text" /></td>
        </tr>
        <tr>
          <td height="0" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"聯絡地址":"Contact Address"?><span class="style8">*</span></td>
          <td width="628" height="0" colspan="3" align="left" bgcolor="#ffffff" class="option03">
		  <?
		  if($lan=="cht"){
		  ?>
		  <select name=City size=1 id="City" onChange="changeZone(document.getElementById('City'), document.getElementById('Town'), document.getElementById('Zip'))">
            </select>
            &nbsp;&nbsp;&nbsp;
            <select name=Town size=1 id="Town" onChange="showZipCode(document.getElementById('City'), document.getElementById('Town'), document.getElementById('Zip'))">
            </select>
			&nbsp;&nbsp;<?=$lan=="cht"?"郵遞區號":"Zip Code"?>：&nbsp;<input name="Zip" type="text" id="Zip" size="5" maxlength="5">
			<? include("../../admin/js/adress2.php")?>
		  <? }?>
<input name="add" type="text" id="add" value="" size="40"></td>
        </tr>
        <tr>
          <td width="170" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"住房人地址":"Occupant’s Address"?></td>
            <td width="628" colspan="3" align="left" bgcolor="#ffffff"><input name="order2_address" type="text" class="text" id="order2_address" size="40">
            <font color="#990000"><span onclick="javascript:cop()" style="cursor:pointer"><?=$lan=="cht"?"同上":"Same as Contact Address"?></span></font></td>
        </tr>
        
        <tr>
          <td width="170" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"住房人姓名":"Occupant’s Name "?></td>
            <td width="628" colspan="3" align="left" bgcolor="#ffffff"><input name="order2_recivename" type="text" class="text" id="order2_recivename" size="15">
            <font color="#990000"><span onclick="javascript:cop_name()" style="cursor:pointer"><?=$lan=="cht"?"同訂購人":"Same as Order Person"?></span></font></td>
        </tr>
       </table>
	   <br>
	   <?
	   if($lan=="cht"){
	   ?>
	   <table width="90%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr align="center">
          <td height="20" colspan="4" align="left" bgcolor="#CCCC99" class="tdList00">開立統一編號</td>
        </tr>
        <tr>
          <td width="170" height="2" align="left" valign="middle" class="tdList01">發票型式<span class="style8">*</span></td>
            <td width="628" height="2" colspan="3" align="left" bgcolor="#ffffff"><input name="order_invoice_type" type="radio" value="不需開立" checked="checked" />
              不需開立
              <input name="order_invoice_type" type="radio" value="二連式" />
              二連式
              <input name="order_invoice_type" type="radio" value="三連式" />
            三連式</td>
        </tr>
        <tr>
          <td width="170" align="left" valign="middle" class="tdList01">發票抬頭</td>
            <td width="628" colspan="3" align="left" bgcolor="#ffffff"><input name="invoice_title" type="text" class="text" id="invoice_title" size="20" /></td>
        </tr>
        
        <tr>
          <td height="0" align="left" valign="middle" class="tdList01">統一編號</td>
          <td height="0" colspan="3" align="left" bgcolor="#ffffff"><input name="invoice_num" type="text" class="text" id="invoice_num" size="20" /></td>
        </tr>
        <tr>
          <td width="170" height="0" align="left" valign="middle" class="tdList01">發票地址</td>
            <td width="628" height="0" colspan="3" align="left" bgcolor="#ffffff"><input name="invoice_address" type="text" class="text" id="invoice_address" size="40"  />
            <font color="#990000"><span  onclick="javascript:cop2()" style="cursor:pointer">同訂購人</span></font></td>
        </tr>
       </table>
	   <?
	   }else{
	    echo "<input name=\"order_invoice_type\" type=\"hidden\" value=\"不需開立\" />";
	   }
	   ?>
	   <br>
	   <table width="90%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td height="24" colspan="4" align="left" valign="middle" bgcolor="#CCCC99" class="tdList00"><span class="style16"><?=$lan=="cht"?"請選擇交易方式，若不清楚付款方法請":"Please choose type of payment"?>→<a href="#" class="d" onclick="MM_openBrWindow('../include/order_help.php<?=$lan=="cht"?"":"?ck=e"?>','','scrollbars=yes,width=640,height=580')"><u><font color="green"><?=$lan=="cht"?"按此查看":"More Info"?></font></u></a></span></td>
        </tr>
        <tr>
          <td width="170" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"交易方式":"Type of Payment"?><span class="style8">*</span></td>
            <td width="628" colspan="3" align="left" bgcolor="#ffffff">
              <select name="order2_paykind" class="text" id="order2_paykind">
                <option value="" selected="selected"><?=$lan=="cht"?"請選擇":"Please Choose"?></option>
                <!--<option value="信用卡">信用卡</option>//-->
				<?=$lan=="cht"?"<option value=\"ATM/匯款\">ATM/匯款</option>":""?>
                <option value="<?=$lan=="cht"?"傳真刷卡":"Credit Card via FAX"?>"><?=$lan=="cht"?"傳真刷卡":"Credit Card via FAX"?></option>
            </select>          </td>
        </tr>
        <tr>
          <td width="170" align="left" valign="middle" class="tdList01"><?=$lan=="cht"?"備註":"Remark"?></td>
            <td width="628" colspan="3" align="left" bgcolor="#ffffff">
            <textarea name="order2_note" cols="40" rows="5" class="text" id="order2_note"></textarea>          </td>
        </tr>
  </table><br>
<table border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td align="center"><input name="submit2" type="button" value=" <?=$lan=="cht"?"變更訂單":"Change"?> " onclick="location=' <?=$lan=="cht"?"cart_list.php":"ecart_list.php"?> '"  class="input03"/></td>
	<td></td>
    <td align="center"><input name="submit" type="submit" value=" <?=$lan=="cht"?"確認訂房":"Submit"?> "  class="input03"/>
      <input name="process" type="hidden" id="process" value="send_order" /></td>
  </tr>
</table>
</form>  
<?
endif;
?>
	</td>
      </tr>
</table>
