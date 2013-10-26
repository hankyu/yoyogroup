<?PHP
include("config.php");
include("DataAccess/sql_table.php");
include("DataAccess/mysql_conn.php");
include("Common/js.php");
include("Common/functions.php");
no_cache_header();
session_start(); //
session_unset(); //
//session_unregister();
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$TITLE?></title>
<?=$js?>
</head>
<body>
<?
echo "<script language='JavaScript'>redirectURL('登出成功','index.php')</script>";
?>
</body>
</html>