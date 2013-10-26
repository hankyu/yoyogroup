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
	
//輸入搜尋****************************************************end

  $limit =4;	//每頁筆數
  
  //分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;

//類別搜尋****************************************************
 
  if(!empty($id)){
  $query_where1="WHERE artwork_Num = $id  ";
  }
  
  if(!empty($kid)){
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_artwork_img] ".$query_where1;
  }else{
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_xfun_artwork_img] ".$query_where1;
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
<SCRIPT language=JavaScript>
<!--
var slideShowSpeed = 5000;
var crossFadeDuration = 3;
function runSlideShow2(Imgsrc){
    if (document.all) {
        document.images.mainPic2.style.filter="blendTrans(duration=2)";
        document.images.mainPic2.style.filter="blendTrans(duration=crossFadeDuration)";
        document.images.mainPic2.filters.blendTrans.Apply();
    }
    document.images.mainPic2.src =Imgsrc;
    if (document.all) {
        document.images.mainPic2.filters.blendTrans.Play();
    }
}
function getFirstImg(img){
	document.images.mainPic2.src=img;
}
//-->
</SCRIPT>
<SCRIPT> 
<!-- 
function channel(img){ 
window.open("viewimage.php?img="+img,"mywindow","directories=no,location=no,menubar=no,scrollbars=no,status=no,toolbar=no,resizable=no") 
} 
//--> 
</SCRIPT>
<SCRIPT language=JavaScript1.2>

function high(which2){
theobject=which2
if (window.downlighting) clearInterval(downlighting)
highlighting=setInterval("highlightit(theobject)",100)
}

function low(which2){
clearInterval(highlighting)
theobject=which2
downlighting=setInterval("downlightit(theobject)",100)
}

function highlightit(cur2){
if (cur2.filters.alpha.opacity<100)
cur2.filters.alpha.opacity+=100//滑鼠滑進效果顯示速度
else if (window.highlighting)
clearInterval(highlighting)
}

function downlightit(cur2){
if (cur2.filters.alpha.opacity>40)
cur2.filters.alpha.opacity-=20  //修改滑鼠移開圖示後的亮度，數字越小就越亮
else if (window.downlightit)
clearInterval(downlighting)
}
</SCRIPT>

</HEAD>
<BODY style="BACKGROUND-COLOR: transparent; overflow-x:hidden" >
<div id="Layer1">
  <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0','width','741','height','400','align','middle','src','../../swf/space','quality','high','wmode','transparent','bgcolor','#ffffff','allowscriptaccess','sameDomain','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','../../swf/space' ); //end AC code
  </script>
</div>
<div id="Layer2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5" align="center" valign="top"><img src="../../image/home/space.gif" width="2" height="2"></td>
        </tr>
        <tr>
          <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              
              <tr>
                <td width="100%" align="right" valign="bottom" style="background-repeat:no-repeat"><table border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="middle"><a href="#" onClick="location.href='artwork_list.php?kid=<?=$kid?>'" onMouseOver="MM_swapImage('xx1','','../../image/news/retruna.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="../../image/news/retrun.gif" name="xx1" width="81" height="20" border="0"></a></td>
                    <td valign="top">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="5" align="center" valign="top"><img src="../../image/home/space.gif" width="2" height="2"></td>
              </tr>
              
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
                      <TD bgColor=#000000><TABLE cellSpacing=0 borderColorDark=#ffffff 
                              cellPadding=1 width="100%" align=center 
                              borderColorLight=#936054 border=0>
                        <TBODY>
                          <TR>
                            <TD width=410 align="center" valign="middle"><IMG id="mainPic2"
                                src="" onload="javascript:if(this.width>410)this.width=410;javascript:if(this.width<410)this.width=410" border=0 name=mainPic2  onClick="channel(this.src)" style="cursor:pointer"></TD>
                            <TD align="center" vAlign=top><table width="99%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td valign="top"><TABLE height=30 cellSpacing=0 cellPadding=0 
                                width="99%" align=center 
                                background="../../js/images/barbg.gif" 
                                border=0>
                                  <TBODY>

                                    <TR>
                                      <TD align=middle><?PHP
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
  $pagestr.='目前頁次【<span class="num">'.$this->nowindex."/".$this->totalpage.'</span>】共<span class="num">'.$this->totaldata.'</span>筆';
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
?></TD>
                                    </TR>
                                  </TBODY>
                                </TABLE></td>
                              </tr>
                              <tr>
                                <td height="5" valign="top"><img src="../../image/home/space.gif" width="2" height="2"></td>
                              </tr>
                              <tr>
                                <td valign="top">
								
								<TABLE cellSpacing=0 borderColorDark=#ffffff 
                                cellPadding=2 width="100%" align=center 
                                borderColorLight=#936054 border=0>
                                  <TBODY>
                                    <TR>
<?PHP
  $CLASS["artwork"]->query($result_num." ORDER BY artwork_Img_Sort DESC LIMIT $show,$limit");
  //$total = $CLASS["artwork"]->num_rows($CLASS["artwork"]->result);	//總筆數
  $num = 0;
	if($total >= 1):
	while ($row = $CLASS["artwork"]->fetch_array($CLASS["artwork"]->result)) {
  	$num = $num + 1;
	$artwork_Img_Num=$row["artwork_Img_Num"];
	$artwork_Img_File=$row["artwork_Img_File"];
	if($num==1){
		echo "<script type='text/javascript'>getFirstImg('".$XFUN_CONFIG['CONFIG_UPLOADPATH_ART'].$artwork_Img_File."')</script>";
	}
?>
                                      <TD vAlign=top align=center><?php
//@unlink ("../../upload/product/Temp_Img.jpg");
//取得副檔名
if(!empty($artwork_Img_File)):
	$ext = explode('.',$artwork_Img_File);
	$size = count($ext);
	$subFileName = $ext[$size-1];
	$FileName = $ext[0];
	//how to use the class:
	//makes a simple thumbnail of an image of 100x100 and saves the image then outputs it.
	$imgresize = new resize_img();
	
	$imgresize->sizelimit_x = 135;
	$imgresize->sizelimit_y = 135;
	$imgresize->keep_proportions = true;
	$imgresize->output = $subFileName;
	
	if( $imgresize->resize_image( $XFUN_CONFIG['CONFIG_UPLOADPATH_ART'].$artwork_Img_File ) === false )
	{
	  //echo 'ERROR!';
	}
	else
	{
	  $imgresize->save_resizedimage( $XFUN_CONFIG['CONFIG_UPLOADPATH_ART'], "s_".$FileName );
	  //$imgresize->output_resizedimage();
	}
endif;
if(!empty($artwork_Img_File)):
echo "<img onmouseover=\"style.cursor='hand';high(this);runSlideShow2('".$XFUN_CONFIG['CONFIG_UPLOADPATH_ART'].$artwork_Img_File."')\" style=\"FILTER: alpha(opacity=40)\" onmouseout=low(this)  src='".$XFUN_CONFIG['CONFIG_UPLOADPATH_ART']."s_".$artwork_Img_File."' >";
$imgresize->destroy_resizedimage();
else:
echo "<img src='../../images/03_products/nopic.gif' width='145' height='145' border=0>";
endif;
?></TD>
<?
 	$tr=$num % 2 == 0 ? "<tr>" :"";
	echo $tr;
   }  //while_end
  else:
?>
    <div align="center"><font color=red>資料建構中</font></div>
<? endif;?>

                                      </TR>
                                  </TBODY>
                                </TABLE>
								
								</td></tr></table></TD>
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
                </TABLE></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="middle">&nbsp;</td>
        </tr>
        
      </table></td>
    </tr>
  </table>
</div>

