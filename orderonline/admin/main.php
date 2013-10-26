<?PHP
include("config.php");
include("DataAccess/mysql_conn.php");
include("DataAccess/sql_table.php");
include("Common/functions.php");
include("Common/js.php");
//include("DataAccess/authorization.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$XFUN_CONFIG["CONFIG_WEB_TITLE"]?>-後台管理</title>
</head>
<frameset rows="22,*,25" framespacing=0 frameborder=0 border="0" id="OutFrameSet" >
<frame name="top" src="top.php" marginwidth="0" marginheight="0" scrolling="no" frameborder="no" noresize>
<frameset cols="245,10,*" border="0"frameborder=0 framespacing=0 id="attachucp" >
<frame src="menu.php" name="menuAREA" id="menuAREA" scrolling="auto" noresize marginwidth="0" marginheight="0" >
<frame id=leftbar name=switchFrame src="mainswitch.php" noResize scrolling=no>
<frame name="mainAREA" src="admin.php" marginwidth="0" marginheight="0" scrolling="auto" noresize frameborder=0 >
</frameset>
  <frame name="bottom" src="bottom.php" marginwidth="0" marginheight="0" scrolling="no" frameborder=0 >
</frameset><noframes></noframes>

<noframes>
</noframes> 
</html>
