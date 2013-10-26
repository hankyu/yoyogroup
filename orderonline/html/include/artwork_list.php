<?PHP
include("../../admin/config.php");
include("../../admin/DataAccess/mysql_conn.php");
include("../../admin/DataAccess/sql_table.php");
include("../../admin/Common/functions.php");
//include("../../admin/Common/class_randmon.php");
include("../../admin/Common/js.php");
require_once('../../admin/Common/page.class.php');
require_once("../../admin/Common/class.ResizeImg.php");
?>
<?PHP
//基本設定
$CLASS["artwork"] = new xfunDB_sql;
$CLASS["artwork"]->connect(); 

	$show = htmlspecialchars(trim($HTTP_GET_VARS['show']));	//換頁
	$search_str = htmlspecialchars(trim($HTTP_POST_VARS['search_str']));//輸入查詢
	
//輸入搜尋****************************************************Start
    if(!empty($search_str)):
     if(!empty($kid)||!empty($mul)){
       $query_where2 = " And artwork_title LIKE '%" . $search_str . "%' ";
	 }else{
       $query_where = " WHERE artwork_title LIKE '%" . $search_str . "%'  and 
	   					((to_days( artwork_sdate  ) <= to_days( NOW( )) and
						to_days( artwork_edate ) >= to_days( NOW( ))) or 
						(artwork_sdate ='0000-00-00' and artwork_edate='0000-00-00')) ";
	 }  
    endif;
//輸入搜尋****************************************************end

  $limit =6;	//每頁筆數
  
  //分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;

//類別搜尋****************************************************
 
  if(!empty($kid)&&empty($skid)){
  $query_where1="WHERE artwork_kind = $kid and 
	   					((to_days( artwork_sdate  ) <= to_days( NOW( )) and
						to_days( artwork_edate ) >= to_days( NOW( ))) or 
						(artwork_sdate ='0000-00-00' and artwork_edate='0000-00-00')) ";
  }
  if(!empty($skid)){
  $query_where1="WHERE artwork_kind LIKE '%$skid%' and 
	   					((to_days( artwork_sdate  ) <= to_days( NOW( )) and
						to_days( artwork_edate ) >= to_days( NOW( ))) or 
						(artwork_sdate ='0000-00-00' and artwork_edate='0000-00-00')) ";
  }

  if(!empty($mul)){
  $query_where3="WHERE (artwork_kind = 11 OR artwork_kind = 12 OR artwork_kind = 13) and 
	   					((to_days( artwork_sdate  ) <= to_days( NOW( )) and
						to_days( artwork_edate ) >= to_days( NOW( ))) or 
						(artwork_sdate ='0000-00-00' and artwork_edate='0000-00-00')) ";
  }
  
  if(!empty($kid)||!empty($skid)){
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_artwork] ".$query_where1.$query_where2;
  }elseif(!empty($mul)){
    $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_artwork] ".$query_where3.$query_where2;
  }else{
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_artwork] ".$query_where;
  }
  //echo $result_num;
  $CLASS["artwork"]->query($result_num);

  $total = $CLASS["artwork"]->num_rows($CLASS["artwork"]->result);	//總筆數
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<TITLE>蘿蔓蘿蘭婚紗 ::: Welcome to Roman Rolan:::</TITLE>
<meta content="婚紗、台中婚紗、攝影、結婚、新娘秘書" name="keyboard" />
<meta content="婚紗、台中婚紗、攝影、結婚、新娘秘書" name="description" />
<meta content="婚紗、台中婚紗、攝影、結婚、新娘秘書" name="abstract" />
<?PHP no_cache_header();?>
<link href="../../js/typein.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../../js/button.js"></script>
<script language="javascript" type="text/javascript" src="../../js/lock_leftkey.js"></script>
<script src="../../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</HEAD>
<BODY style="BACKGROUND-COLOR: transparent; overflow-x:hidden" >
<div id="Layer1">
  <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0','width','741','height','400','align','middle','src','../../swf/space','quality','high','wmode','transparent','bgcolor','#ffffff','allowscriptaccess','sameDomain','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','../../swf/space' ); //end AC code
  </script>
</div>
<div id="Layer2">
  <table width="100" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table width="714" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" align="center" valign="top"><img src="../../image/home/space.gif" width="2" height="2"></td>
        </tr>
        <tr>
          <td align="center" valign="top">
		  <table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" height="5" align="center" valign="top"><img src="../../image/home/space.gif" width="2" height="2" /></td>
  </tr>
  <tr>
    <td align="center" valign="top" background="../../image/news/001.gif" style="background-repeat:no-repeat"><table width="100%" height="41" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td align="right" valign="middle">
	      <form action="<?=$phpself?>" method="post" name="form1" id="form1">
	        <table width="69%" border="0" cellpadding="2" cellspacing="0">
	          <tr>
	            <td width="55%" valign="middle">
	              <input name="search_str" type="text" class="inputkeyword05" id="search_str" size="23" />	              </td>
              <td width="19%" valign="bottom">
                <input type="image" src="../../image/news/search.gif" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ss01','','../../image/news/searcha.gif',1)" style="width:56; height:18;" name="Submit" id="ss01">                </td>
              <td width="26%" valign="middle"><a href="<?=$phpself?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ss02','','../../image/news/alla.gif',1)"><img src="../../image/news/all.gif" name="ss02" width="79" height="18" border="0" id="ss02" /></a></td>
            </tr>
	          </table>
		    </form></td>
        <td width="6" valign="middle">&nbsp;</td>
        <td width="224" align="left" valign="middle">
<?PHP
//分頁設訂
class mytoppage extends page
{
 function mytoppage($array)
 {
  parent::page($array);
  $this->first_page="<img src='../../js/images/first1.gif' border=0/>";
  $this->last_page="<img src='../../js/images/end1.gif' border=0/>";
  $this->next_page="<img src='../../js/images/next1.gif' border=0/>";
  $this->pre_page="<img src='../../js/images/back1.gif' border=0 />";
  $this->set('format_left','');
  $this->set('format_right','');
 }
 
 function show()
 {
  $pagestr='<div class="pagenavi" id="lopage">';
  $pagestr.=$this->first_page().' ';
  $pagestr.=$this->pre_page().' ';
  //$pagestr.=$this->nowbar('','curr');
  $pagestr.=$this->next_page().' ';
  $pagestr.=$this->last_page();
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;共<span class="num">'.$this->totalpage.'</span>頁<span class="num">'.$this->totaldata.'</span>筆資料';
  //$pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;前往第 '.$this->select().' 頁';
  $pagestr.='</div>';
  if ($this->totalpage>1):
  	return $pagestr;
  endif;
 }
}
//取得總筆數
$CLASS["artwork"]->query($result_num);
//$total = $CLASS["artwork"]->num_rows($CLASS["artwork"]->result);
//秀分頁選單
$top_page=new mytoppage(array('total'=>$total,'perpage'=>$limit));
echo $top_page->show(2);
?>		</td>
      </tr>
    </table></td>
  </tr>
</table>
		  <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="100%" height="15" align="center" valign="top"><img src="../../image/home/space.gif" width="2" height="2"></td>
              </tr>
<?PHP
  $CLASS["artwork"]->query($result_num." ORDER BY artwork_cdate DESC LIMIT $show,$limit");
  //$total = $CLASS["artwork"]->num_rows($CLASS["artwork"]->result);	//總筆數
  $num = 0;
	if($total >= 1):
	while ($row = $CLASS["artwork"]->fetch_array($CLASS["artwork"]->result)) {
  	$num = $num + 1;
	$artwork_kind=$row["artwork_kind"];
	$artwork_img=$row["artwork_img"];
	$artwork_title=$row["artwork_title"];
	$artwork_num=$row["artwork_num"];
	$S_Date=$row["artwork_sdate"];
	$E_Date=$row["artwork_edate"];
	$C_date=$row["artwork_cdate"];
	$artwork_note=$row["artwork_note"];
?>

              <tr>
                <td align="center" valign="top"><TABLE height=10 cellSpacing=0 cellPadding=0 width="100%" 
                        border=0>
                  <TBODY>
                    <TR>
                      <TD width=18 height=18><IMG height=18 
                              src="../../image/home/wbox_01.gif" 
                              width=18></TD>
                      <TD 
                            background="../../image/home/wbox_03.gif"><TABLE class=bg00 cellSpacing=0 cellPadding=0 
                              width="100%" 
                              background="../../image/home/wbox_02.gif" 
                              border=0>
                          <TBODY>
                            <TR>
                              <TD class=bg1000 
                                background="../../image/home/wbox_04.gif"><DIV align=center><IMG height=18 
                                src="../../image/home/wbox_03.gif" 
                                width=1></DIV></TD>
                            </TR>
                          </TBODY>
                      </TABLE></TD>
                      <TD width=18 height=18><IMG height=18 
                              src="../../image/home/wbox_05.gif" 
                              width=18></TD>
                    </TR>
                    <TR>
                      <TD vAlign=top 
                            background="../../image/home/wbox_07.gif"><TABLE class=bg00 height="100%" cellSpacing=0 
                              cellPadding=0 width=18 
                              background="../../image/home/wbox_06.gif" 
                              border=0>
                          <TBODY>
                            <TR>
                              <TD class=bg0100 
                                background="../../image/home/wbox_08.gif">&nbsp;</TD>
                            </TR>
                          </TBODY>
                      </TABLE></TD>
                      <TD bgColor=#000000><TABLE cellSpacing=0 cellPadding=0 width="100%" 
                              border=0>
                          <TBODY>
                            <TR>
                              <TD width="7%" align=left vAlign=center ><?php
//@unlink ("../../upload/product/Temp_Img.jpg");
//取得副檔名
if(!empty($artwork_img)):
	$ext = explode('.',$artwork_img);
	$size = count($ext);
	$subFileName = $ext[$size-1];
	$FileName = $ext[0];
	//how to use the class:
	//makes a simple thumbnail of an image of 100x100 and saves the image then outputs it.
	$imgresize = new resize_img();
	
	$imgresize->sizelimit_x = 200;
	$imgresize->sizelimit_y = 200;
	$imgresize->keep_proportions = true;
	$imgresize->output = $subFileName;
	
	if( $imgresize->resize_image( $XFUN_CONFIG['CONFIG_UPLOADPATH_ART'].$artwork_img ) === false )
	{
	  //echo 'ERROR!';
	}
	else
	{
	  $imgresize->save_resizedimage( $XFUN_CONFIG['CONFIG_UPLOADPATH_ART'], "s_".$FileName );
	  //$imgresize->output_resizedimage();
	}
endif;
if(!empty($artwork_img)):
echo "<a href='../include/artwork_content.php?id=$artwork_num&PB_page=$PB_page&kid=$kid'><img src='".$XFUN_CONFIG['CONFIG_UPLOADPATH_ART']."s_".$artwork_img."' alt='$artwork_title' border=0></a>";
$imgresize->destroy_resizedimage();
else:
echo "<a href='../include/artwork_content.php?id=$artwork_num&PB_page=$PB_page&kid=$kid'><img src='../../images/03_products/nopic.gif' width='400' height='115' border=0></a>";
endif;
?></TD>
                              <TD width="93%" align="left" vAlign=top><TABLE cellSpacing=0 cellPadding=0 width="100%" 
                                align=left border=0>
                                  <TBODY>
                                    <TR>
                                      <TD align="left" vAlign=top style="WORD-BREAK: break-all"><TABLE 
                                
                                border=0 cellPadding=0 cellSpacing=0 
                                background="../../image/home/subjectbg.gif" class=bg0100>
                                        <TBODY>
                                          <TR>
                                            <TD style="PADDING-RIGHT: 0px; PADDING-LEFT: 60px; PADDING-BOTTOM: 3px; PADDING-TOP: 0px" 
                                vAlign=top><?=$artwork_title//view_kind($artwork_kind,$XFUN_TBL[TABLE_XFUN_xfun_artwork_kind],"artworkKind_Num","artworkKind_Title")?></TD>
                                          </TR>
                                        </TBODY>
                                      </TABLE></TD>
                                    </TR>
                                    <TR>
                                      <TD align="center" vAlign=top style="WORD-BREAK: break-all"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td style="padding-left:5px"><span class="style17gray">
                                            <?=$artwork_note?>
                                          </span></td>
                                        </tr>
                                      </table></TD>
                                    </TR>
                                  </TBODY>
                              </TABLE></TD>
                            </TR>
                          </TBODY>
                      </TABLE></TD>
                      <TD vAlign=top 
                            background="../../image/home/wbox_10.gif"><TABLE class=bg00 height="100%" cellSpacing=0 
                              cellPadding=0 width=18 
                              background="../../image/home/wbox_09.gif" 
                              border=0>
                          <TBODY>
                            <TR>
                              <TD class=bg0100 
                                background="../../image/home/wbox_11.gif">&nbsp;</TD>
                            </TR>
                          </TBODY>
                      </TABLE></TD>
                    </TR>
                    <TR>
                      <TD width=18 height=18><IMG height=18 
                              src="../../image/home/wbox_12.gif" 
                              width=18></TD>
                      <TD 
                            background="../../image/home/wbox_14.gif"><TABLE class=bg00 cellSpacing=0 cellPadding=0 
                              width="100%" 
                              background="../../image/home/wbox_13.gif" 
                              border=0>
                          <TBODY>
                            <TR>
                              <TD class=bg1000 
                                background="../../image/home/wbox_15.gif"><DIV align=center><IMG height=18 
                                src="../../image/home/wbox_14.gif" 
                                width=1></DIV></TD>
                            </TR>
                          </TBODY>
                      </TABLE></TD>
                      <TD width=18 height=18><IMG height=18 
                              src="../../image/home/wbox_16.gif" 
                              width=18></TD>
                    </TR>
                  </TBODY>
                </TABLE>
                  <table width="100%" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                      <td height="10" align="center" valign="middle"><img src="../../image/home/space.gif" width="2" height="2"></td>
                    </tr>
                  </table></td>
              </tr>
              
<?
    }  //while_end
  else:
?>
  <tr align="center">
    <td><font color=red>資料建構中</font></td>
  </tr>
<? endif;?>
          </table></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="middle"><img src="../../image/home/space.gif" width="2" height="2"></td>
        </tr>
        <tr>
          <td align="center" valign="middle"><?PHP
//分頁設訂
class mypage extends page
{
 function mypage($array)
 {
  parent::page($array);
  $this->first_page="<img src='../../image/home/page_first.gif' border=0/>";
  $this->last_page="<img src='../../image/home/page_last.gif' border=0/>";
  $this->next_page="<img src='../../image/home/next.gif' border=0/>";
  $this->pre_page="<img src='../../image/home/back.gif' border=0 />";
  $this->set('format_left','[');
  $this->set('format_right',']');
 }
 
 function show()
 {
  $pagestr='<div class="pagenavi" id="lopage">';
  $pagestr.=$this->first_page().' ';
  $pagestr.=$this->pre_page().' ';
  $pagestr.=$this->nowbar('','curr');
  $pagestr.=$this->next_page().' ';
  $pagestr.=$this->last_page();
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;共<span class="num">'.$this->totalpage.'</span>頁<span class="num">'.$this->totaldata.'</span>筆資料';
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;前往第 '.$this->select().' 頁';
  $pagestr.='</div>';
  if ($this->totalpage>1):
  	return $pagestr;
  endif;
 }
}
//取得總筆數
$CLASS["artwork"]->query($result_num);
//$total = $CLASS["artwork"]->num_rows($CLASS["artwork"]->result);
//秀分頁選單
$page=new mypage(array('total'=>$total,'perpage'=>$limit));
echo $page->show(2);
?>
          </td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>

