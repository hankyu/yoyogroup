<?
//基本設定
$CLASS["folder"] = new xfunDB_sql;
$CLASS["folder"]->connect(); 

//資料夾使用驗證
$folder = dirname($_SERVER['PHP_SELF']); 
$foldername = substr(strrchr((trim($folder )), "/"), 1);
//echo $sec_user_level;
$CLASS["folder"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu] WHERE Floder = '$foldername'");
$total = $CLASS["folder"]->num_rows($CLASS["folder"]->result);	//總筆數
if($total >= 1):
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
$row_M = $CLASS["folder"]->fetch_array($CLASS["folder"]->result);
		$MUser_Level=$row_M['User_Level'];
		$main_menu=explode(",",$MUser_Level);
		//print_r($sec_menu)."<br>";
		$m_Key=array_search ($sec_user_level,$main_menu);
		$key_M_chk = strlen($m_Key);
		if ($key_M_chk==0):
		 echo "<div align=center height='50'><img src='../images/icon_1.gif' width='16' height='15' align='absmiddle'> <font color=red>警告！您並無此權限，請儘速離開！</font></div>";
		 exit;
		endif;
else:
		 echo "<div align=center height='50'><img src='../images/icon_1.gif' width='16' height='15' align='absmiddle'> <font color=red>主選單資料夾設定錯誤，請檢查！</font></div>";
		 exit;
endif;

?>
