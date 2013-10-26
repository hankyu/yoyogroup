<?PHP
include("head.php");
$ACT_TITLE="訂單雙向留言";
$REDirect_PG=$lan=="cht"?"../member/member_area.php?order_id=$order_id&act=viewlist":"../member/emember_area.php?order_id=$order_id&act=viewlist";
$customer=$lan=="cht"?"客戶":"Customer";
?>
<?
//==============討論區資料處理程序==============
$forum_catalog=$MainKind.",".$secondBox;
$mdydate=date('Y-m-j G:i:s');
$myData = new XFUN_SQLHelp();
$myData->DB_Table = $XFUN_TBL[TABLE_XFUN_xfun_order_msg];
$myData->ClassTitle = "訂單留言";
$myData->DB_Field = "order_id,order_msg_user,order_msg_content,order_msg_cdate";
$myData->DB_Values = "'$order_id','$customer','$order_msg_content','$mdydate'";
$myData->DB_updValues ="order_id='$order_id',order_msg_user='$order_msg_user',order_msg_content='$order_msg_content',order_msg_cdate=$mdydate
 WHERE order_msg_num =$order_msg_num";
$myData->DB_delValues = "order_msg_num =$order_msg_num";
if($myData->ActDataAccess($act)):
	//更新文章變更日期
	$Insert_DB=true;
	$msg = "<script language='javascript'>redirectURL('".$myData->ClassActTitle.$myData->ClassTitle."成功！','$REDirect_PG')</script>";
else:
	$msg = "<script language='javascript'>redirectURL('".$myData->ClassActTitle.$myData->ClassTitle."錯誤！','$REDirect_PG')</script>";
endif;
echo $msg;
?>
<?
include("foot.php");
?>