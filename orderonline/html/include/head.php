<?PHP

include("../../admin/config.php");
include("../../admin/DataAccess/mysql_conn.php");
require_once("../../admin/DataAccess/sql_table.php");
require_once("../../admin/Common/functions.php");
require_once("../../admin/Common/js.php");
require_once("../../admin/Common/class_randmon.php");
require_once('../../admin/Common/page.class.php');
require_once("../../admin/Common/class.ResizeImg.php");
require_once('../../admin/Common/phpmailer/class.phpmailer.php');	//PHPmailer v1.73 - 寄送Email用類別
require_once('../../admin/Lib/xfun.SQLHelp.php');
require_once('../../admin/Lib/xfun.upload.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$XFUN_CONFIG["CONFIG_WEB_TITLE"].$PageTitle?></title>
<?=$js?>
<script language="javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body>

