<?PHP
/*======================================================*/
/*================ 網站資訊組態設定檔 ==================*/
/*================ Author By XFUN 2009/02/16 ===========*/
/*======================================================*/
//資料庫連線
$XFUNDB = Array(
'dbName'   =>'vhost29762-1',
'host'	   =>'localhost',
'user'	   =>'vhost29762',
'pass'	   =>'my12345',
'set_utf8' =>'false',
'class'	   =>'mysql_conn.php'
);



//***************** 網站暫存虛擬目錄 *****************
$WEB_ROOT="";
//***************** 網站資訊 **********************
$XFUN_CONFIG = Array(
'CONFIG_WEB_TITLE'  			=> '企 業 家 大 飯 店',
'CONFIG_WEB_URL'  			    => 'www.gohotel.com.tw',
'CONFIG_WEB_ADMINEMAIL'  		=> 'x_fun77@hotmail.com',
'CONFIG_WEB_EMAIL'  			=> 'service@gohotel.com.tw',
'CONFIG_WEB_BCCMAIL'  			=> 'e22207733@gmail.com',
'CONFIG_WEB_BCCMAIL2'  			=> 'mydeargeorge@hotmail.com',
'CONFIG_WEB_PHONE'  			=> '(04)22207733',
'CONFIG_WEB_FAX'	  			=> '(04)22217540',
'CONFIG_WEB_ADDRESS'  			=> '住址',
'CONFIG_WEB_LOGO'	  			=> 'logo.jpg',
'CONFIG_WEB_SUBLOGO'  			=> 'logo.jpg',
'CONFIG_WEB_LOGOBG_COLOR'		=> '#FFFFF',
'CONFIG_ROOT_PATH'  			=> $WEB_ROOT.'/orderonline/admin/',
'CONFIG_FCK_FilePath'		 	=> '../../upload/',
'CONFIG_UPLOADPATH_PRO'			=> '../../upload/product/',
'CONFIG_UPLOADPATH_NEWS'		=> '../../upload/news/',
'CONFIG_UPLOADPATH_FILE'		=> '../..upload/file/',
'CONFIG_UPLOADPATH_ART'		    => '../../upload/artwork/',
'CONFIG_UPLOADPATH_TEAM'		=> '../../upload/team/',
'CONFIG_UPLOADPATH_VOTE'		=> '../../upload/vote/',
'CONFIG_HOME_PATH'		 		=> $_SERVER["SERVER_NAME"].'$WEB_ROOT',
'CONFIG_LINK_PATH_QRY'	 		=> $HTTP_SERVER_VARS["QUERY_STRING"].'$WEB_ROOT',
'CONFIG_PREFER_PATH'		 	=> substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'],'/')+1),
'CONFIG_PG_LINK'		 		=> $_SERVER['REQUEST_URI']
);
$nowSrvPath = str_replace('\\', '/', dirname(__FILE__));//取得絕對路徑
$FCK_FilePath=$WEB_ROOT."/upload/";//FCK編輯器檔案上傳路徑
//$FCK_ABSFilePath=$nowSrvPath."/upload/";
//***************** 原頁面導回 *****************
if(isset($_SERVER['PHP_SELF'])){
$phpself=$_SERVER['PHP_SELF']; 
}else{
$phpself="";  
}
//***************** 判斷繁簡中文 *****************
/*if($_SERVER["HTTP_ACCEPT_LANGUAGE"]=="zh-cn") {
require_once('lang/zh-cn.lang.php');
//$LANG="UTF-8";
define('CHARSET', 'UTF-8');
define('HTML_PARAMS','dir="ltr" lang="cn"');
}
elseif($_SERVER["HTTP_ACCEPT_LANGUAGE"]=="zh-tw") {
require_once('lang/zh-tw.lang.php');
define('CHARSET', 'UTF-8');
define('HTML_PARAMS','dir="ltr" lang="tw"');
//$LANG="big5";
}*/
define('CHARSET', 'UTF-8');
?>
<?PHP
//*****************出現Undefined variable 跟 Cannot send session cache limiter - headers already sent 使用。 *****************
error_reporting (E_ALL ^ E_WARNING ^ E_NOTICE); 
//*****************自動取得變數回傳
/*
if(!empty($_POST)):
foreach ($_POST as $key=>$value)
{
$$key=$value;
}
else:
foreach ($_GET as $key=>$value)
{
$$key=$value;
}
endif;
while ( list( $key, $val ) = each( $HTTP_POST_VARS ) ) $$key = $val;
while ( list( $key, $val ) = each( $HTTP_GET_VARS ) ) $$key = $val;
*/
//取得變數[php4.1.0開始就將registry_globals=off設為預設值，是因為安全性的關係，因此兼容低版本最簡單的方法是使用下列語法。
extract($HTTP_POST_VARS);
extract($HTTP_GET_VARS);
session_start(); 
extract($HTTP_SESSION_VARS); 
?>
