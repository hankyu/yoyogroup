<?PHP
//基本設定
$CLASS["DB"] = new xfunDB_sql;
$CLASS["DB"]->connect(); 
$CLASS["rent_img"] = new xfunDB_sql;
$CLASS["rent_img"]->connect(); 

	$show = htmlspecialchars(trim($HTTP_GET_VARS['show']));	//換頁
	$search_str = htmlspecialchars(trim($HTTP_POST_VARS['search_str']));//輸入查詢
//輸入搜尋****************************************************Start
    if(!empty($search_str)):
		$query_where = " AND projNum LIKE '%" . trim($search_str) . "%' OR projName LIKE '%" . trim($search_str) . "%'";
    endif;
//輸入搜尋****************************************************end

  $limit =10;	//每頁筆數
  
  //分頁索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;

//類別搜尋****************************************************
 
  $query_where .= " WHERE display='Y'";
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] ".$query_where;
  //echo $result_num;
  $CLASS["DB"]->query($result_num);

  $total = $CLASS["DB"]->num_rows($CLASS["DB"]->result);	//總筆數
?>

<div id="Layer2">
<table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="top">
		  <table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" align="center" valign="top" style="background-repeat:no-repeat"><!--<table width="100%" height="41" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td valign="middle">
	      <form action="<?=$phpself?>" method="post" name="form1" id="form1">
	        <table width="100%" border="0" cellpadding="2" cellspacing="0">
	          <tr>
	            <td valign="middle">
	              <input name="search_str" type="text" class="inputkeyword05" id="search_str" size="17" />            </td>
              <td valign="middle">
                <input name="search" type="submit" id="search" value=" 搜 尋 "  class="input03"/>			</td>
              <td valign="middle"><input name="search" type="submit" id="search" value=" 重新載入 "  class="input03" onclick="location='<?=$phpself?>'"/></td>
            </tr>
	          </table>
		    </form></td>
        <td width="257" align="left" valign="middle">&nbsp;</td>
      </tr>
    </table>--></td>
  </tr>
</table>
		  <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="100%" height="15" align="center" valign="top"><img src="../../image/home/space.gif" width="2" height="2"></td>
              </tr>
<?PHP
  $CLASS["DB"]->query($result_num." ORDER BY projNum ASC LIMIT $show,$limit");
  //$total = $CLASS["vote"]->num_rows($CLASS["vote"]->result);	//總筆數
  $num = 0;
	if($total >= 1):
	while ($row = $CLASS["DB"]->fetch_array($CLASS["DB"]->result)) {
  	$num = $num + 1;
	$rentNum=$row["rentNum"];
	$projName=$row["projName"];
	$rentPrice=$row["rentPrice"];
	$en_projName=$row["en_projName"];
	$en_rentPrice=$row["en_rentPrice"];
	$display=$row["display"];
	$rentDiscribe=$row["rentDiscribe"];
	$shortDiscribe=$row["shortDiscribe"];
	$en_rentDiscribe=$row["en_rentDiscribe"];
	$en_shortDiscribe=$row["en_shortDiscribe"];
	$creatDate=$row["creatDate"];
?>

              <tr>
                <td align="center" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="120" valign="top"><table width="110" height="80" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" valign="middle">
<?php
$extquery=" WHERE rent_Num = $rentNum";
$CLASS["rent_img"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_img] $extquery  ORDER BY rent_Img_Sort ASC");
$total = $CLASS["rent_img"]->num_rows($CLASS["rent_img"]->result);	//總筆數
if($total >= 1):
	if ($result = $CLASS["rent_img"]->fetch_array($CLASS["rent_img"]->result)) 
	{
		$rent_Img_Num = $result['rent_Img_Num'];
		$rent_Img_File = $result['rent_Img_File'];
		$rent_Img_Size = $result['rent_Img_Size'];
		$rent_Img_Sort = $result['rent_Img_Sort'];
	}
endif;
//@unlink ("../../upload/product/Temp_Img.jpg");
//取得副檔名
if(!empty($rent_Img_File)):
	$ext = explode('.',$rent_Img_File);
	$size = count($ext);
	$subFileName = $ext[$size-1];
	$FileName = $ext[0];
	//how to use the class:
	//makes a simple thumbnail of an image of 100x100 and saves the image then outputs it.
	$imgresize = new resize_img();
	
	$imgresize->sizelimit_x = 120;
	$imgresize->sizelimit_y = 120;
	$imgresize->keep_proportions = true;
	$imgresize->output = $subFileName;
	
	if( $imgresize->resize_image( $XFUN_CONFIG["CONFIG_UPLOADPATH_PRO"].$rent_Img_File ) === false )
	{
	  //echo 'ERROR!';
	}
	else
	{
	  $imgresize->save_resizedimage( $XFUN_CONFIG['CONFIG_UPLOADPATH_PRO'], "s_".$FileName );
	  //$imgresize->output_resizedimage();
	}
endif;
$linkurl=$lan=="cht"?"room_content.php":"eroom_content.php";
if(!empty($rent_Img_File)):
echo "<a href='$linkurl?id=$rentNum&PB_page=$PB_page'><img src='".$XFUN_CONFIG['CONFIG_UPLOADPATH_PRO']."s_".$rent_Img_File."' alt='$vote_title' border=0></a>";
$imgresize->destroy_resizedimage();
else:
echo "<a href='$linkurl?id=$rentNum&PB_page=$PB_page'><img src='../../admin/images/nopics.gif' width='120' height='90' border=0></a>";
endif;
?>
				</td>
                        </tr>
                      </table></td>
                      <td width="5" valign="top"><img src="../../images/spacer.gif" width="1" height="1" /></td>
                      <td valign="top" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="28" align="center" valign="top">&nbsp;</td>
                            <td width="309" align="left"><a href="<?=$linkurl?>?id=<?=$rentNum?>&show=<?=$show?>" style="font-weight:bold; font-size:15px" ><?=$lan=="cht"?$projName:$en_projName?></a></td>
                            <td width="310" align="right" style="font-weight:bold; color:#990000;">
							<?=$lan=="cht"?"":"NTD "?><?=$rentPrice?><?=$lan=="cht"?"元起":" and up"?>
							</td>
                          </tr>
                          <tr>
                            <td align="center" valign="top">&nbsp;</td>
                            <td colspan="2" align="left" valign="top" class="style17gray"><?=$lan=="cht"?$shortDiscribe:$en_shortDiscribe?></td>
                          </tr>
                          <tr>
                            <td colspan="3" align="right" valign="top"><a href="<?=$linkurl?>?id=<?=$rentNum?>&show=<?=$show?>"><?=$lan=="cht"?"詳細內容":"Details"?></a></td>
                        </tr>
                      </table></td>
                    </tr>
                </table>
                  <table width="100%" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                      <td height="30" align="center" valign="middle">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              
<?
    }  //while_end
  else:
?>
  <tr align="center">
    <td><font color=red><?=$lan=="cht"?"資料建構中":"Under Building"?></font></td>
  </tr>
<? endif;?>
          </table></td>
        </tr>
        <tr>
          <td align="center" valign="middle">
<?PHP
//分頁設訂
class mypage extends page
{
 function mypage($array)
 {
  parent::page($array);
  $this->first_page="<img src='../../admin/images/page_first.gif' border=0/>";
  $this->last_page="<img src='../../admin/images/page_last.gif' border=0/>";
  $this->next_page="<img src='../../admin/images/page_next.gif' border=0/>";
  $this->pre_page="<img src='../../admin/images/page_prev.gif' border=0 />";
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
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;目前頁次【<span class="num">'.$this->nowindex."/".$this->totalpage.'</span>】共<span class="num">'.$this->totaldata.'</span>筆';
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;前往第 '.$this->select().' 頁';
  $pagestr.='</div>';
  if ($this->totalpage>1):
  	return $pagestr;
  endif;
 }
}
//取得總筆數
$CLASS["DB"]->query($result_num);
//$total = $CLASS["vote"]->num_rows($CLASS["vote"]->result);
//秀分頁選單
if($total > $limit){
    $page=new mypage(array('total'=>$total,'perpage'=>$limit));
	echo $page->show(2);
}
?>          </td>
        </tr>
      </table>
</div>

