<script language="javascript">
function check2(b)
{
	
  if (document.all[b].id.value == "")
  {
    alert("<?=$lan=="cht"?"請輸入訂單編號":"Please Fill Out The Reservation Number"?>？");
    document.all[b].id.focus();
    return (false);
  }
 
  document.all[b].submit();
return true;  
}
</script>
<?PHP
//基本設定
$CLASS["login"] = new xfunDB_sql;
$CLASS["login"]->connect(); 
//返回原先點取的頁面
$Login_URL = $_COOKIE["ReturnURL"]==""?$phpself:$_COOKIE["ReturnURL"];   
if ($act=="login"){

	  if((htmlspecialchars(trim($id))=="")){
	  	   //檢查欄位值是否為空白
			$msg = "<font color=red>請填寫您的訂單編號！</font>";
	  }else{
	  //****************************************************************************************
				$CLASS["login"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_order_list] WHERE order_id  = '".$id."'");
			if ($row_mate = $CLASS["login"]->fetch_array($CLASS["login"]->result)) {		//查有此人
							$order_id = $row_mate["order_id"];				// 會員資料庫編號
                            $_SESSION["sorder_id"] = $order_id;     			// 會員教室
							$reUrl=$lan=="cht"?"../member/member_area.php":"../member/emember_area.php";
							echo "<script language='JavaScript'>RedirectURLPAGE('$reUrl')</script>";
			}else{
			  $msg = $lan=="cht"?"<font color=red>無此訂單編號，請確認！</font>":"<font color=red>Invalid Reservation Number, please check again!</font>";
			}
			$CLASS["login"]->free_result($CLASS["login"]->result);	
	  }
}	 
?>

<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top">
 <table width="580" border="0" cellpadding="2" cellspacing="0" bordercolorlight="#cccccc" bordercolordark="#ffffff">
    <tr>
      <td align="center" bgcolor="#FAF7F1" class="td11b" ><strong><?=$lan=="cht"?"訂單查詢":"Reservation Inquiry"?></strong></td>
    </tr>
    <tr>
      <td align="center" >
	  <table width="66%" border="0" cellpadding="4" cellspacing="0">
		<form action="<?=$phpself?>" method="post" name="loginFrom" id="loginFrom" style="margin:0px" onSubmit="return check2('loginFrom')">
          <tr>
            <td width="80" valign="middle"><?=$lan=="cht"?"訂單編號":"Reservation Number"?>：</td>
            <td width="284" align="left"><input name="id" type="text" class="inputkeyword01index" id="id" size="25">
			</td>
          </tr>
          <tr>
            <td valign="middle">&nbsp;</td>
            <td align="left"><input type="submit" value=" <?=$lan=="cht"?"查 詢":"Submit"?> " name="button2" class="input03"/>
              <input name="reset2" type="reset" value=" <?=$lan=="cht"?"清 除":"Clear"?> " class="input03" />
              <input name="act" type="hidden" id="act" value="login"></td>
          </tr>
        </form>
      </table>
	  <?=$msg?>
	  </td>
    </tr>
  </table>
    </td>
  </tr>
</table>