<?
if(($sec_id=='')&&($sec_password=='')){
	ob_start(); 
	echo "<script>location.href='".$XFUN_CONFIG["CONFIG_ROOT_PATH"]."error_msg.php?error_id=01'</script>";
	header("location:".$XFUN_CONFIG["CONFIG_ROOT_PATH"]."error_msg.php?error_id=01"); 
	ob_end_flush();	   
exit;
}
?>