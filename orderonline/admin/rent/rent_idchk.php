<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] WHERE projNum='$strprojNum'");
$total = $CLASS["db"]->num_rows($CLASS["db"]->result);

switch ($strCmd){
case "availability":
	if ($total==0){
	echo "OK";
	}else{
	echo "error";
	}
	break;
default:
	echo "Invalid command: $strCmd";
	break;
}
$CLASS["db"]->free_result($CLASS["db"]->result);
?>
