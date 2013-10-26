<?
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");

no_cache_header();
//基本設定
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
?>
<?
//基本設定
$CLASS["db"] = new xfunDB_sql;
$CLASS["db"]->connect(); 
$TITLE = "使用者管理系統";		//主標題
$SUBTITLE = "使用者列表";		//次標題
$msg = array(
'no_result' => '尚無使用者資料，請新增。'
);


//取得班級資料
if(!empty($kind_id)){
  $query_where1="WHERE Class_Year ='$kind_id'";
}


$CLASS["db"]->query("SELECT * FROM $XFUN_TBL[TABLE_cmu_class_room] $query_where1 ORDER BY Class_Num DESC");

  $total = $CLASS["db"]->num_rows($CLASS["db"]->result);					//總筆數

  if($total >= 1):
  while ($row = $CLASS["db"]->fetch_array($CLASS["db"]->result)) {
  	$n = $n + 1;
	$class_num = $row["Class_Num"];
	$class_year = $row["Class_Year"];
	$class_room = $row["Class_Room"];
	$class_logo = $row["Class_Logo"];
	$class_nickname = $row["Class_NickName"];
	$class_note = $row["Class_Note"];
	$box_id=$box_id.$class_num."|";
	$box_classroom=$box_classroom.$class_room."|";
  }	
	$class_len=count($box_classroom)-1;
	//echo $class_len;
	$box_class = substr($box_classroom, 1, $class_len);
	echo $box_classroom.",".$box_id;
  	$CLASS["db"]->free_result($CLASS["db"]->result);
  else:
    echo "no_result";
  endif;
?>
