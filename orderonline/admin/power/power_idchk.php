<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../Common/functions.php");
no_cache_header();
?>
<?
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_admin] WHERE ID='$strUsername'");
$total = $CLASS["db"]->num_rows($CLASS["db"]->result);

switch ($strCmd){
case "availability":
	if ($total==0){
	return "OK";
	}else{
	return "error";
	}
	break;
default:
	return "Invalid command: $strCmd";
	break;
}
$CLASS["db"]->free_result($CLASS["db"]->result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
</head>
<body>
</body>
</html>
