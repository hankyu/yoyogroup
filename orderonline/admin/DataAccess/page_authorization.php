<?
//基本設定
$CLASS["page"] = new xfunDB_sql;
$CLASS["page"]->connect(); 

//頁面使用驗證
$filename = substr(strrchr((trim($_SERVER["PHP_SELF"])), "/"), 1);
//echo $sec_user_level;
$CLASS["page"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_menu_group] WHERE Link LIKE '%$filename%' ");
$total = $CLASS["page"]->num_rows($CLASS["page"]->result);	//總筆數
if($total >= 1):
$row_b = $CLASS["page"]->fetch_array($CLASS["page"]->result);
		$SUser_Level=$row_b['User_Level'];
		$sec_menu=explode(",",$SUser_Level);
		//print_r($sec_menu)."<br>";
		$i_Key=array_search ($sec_user_level,$sec_menu);
		$key_I_chk = strlen($i_Key);
		if ($key_I_chk==0):
		 echo "<div align=center><img src='../images/icon_1.gif' width='16' height='15' align='absmiddle'> <font color=red>警告！無此權限！</font></div>";
		 exit;
		endif;
endif;

?>
