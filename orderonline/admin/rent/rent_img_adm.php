<?PHP
include("../config.php");
include("../DataAccess/mysql_conn.php");
include("../DataAccess/sql_table.php");
include("../Common/functions.php");
include("../Common/class.ResizeImg.php");
include("../Common/js.php");
include("../DataAccess/authorization.php");
include("../DataAccess/folder_authorization.php");
include("../DataAccess/page_authorization.php");
require_once('../Common/page.class.php');

//基本設定
$CLASS["rent"] = new xfunDB_sql;
$CLASS["rent"]->connect(); 
$CLASS["rent_img"] = new xfunDB_sql;
$CLASS["rent_img"]->connect(); 
$SubmitURL="rent_img_submit.php";
$ExitURL="rent_adm.php";

$TITLE = "訂房管理系統";		//主標題
$headtitle = "房間圖片管理";		//次標題
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<? no_cache_header();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$TITLE?></title>
<?=$js?>
<?
//群組判斷
if($sec_user_level!="X"):
	echo "<script language='javascript'>redirectURL('您沒有該權限，請離開！','../main.php')</script>";
endif;
?>
<SCRIPT language=JavaScript>
<!--
function check(theForm)
{
  if (document.theForm.Img.value == "")
  {
    alert("請選擇欲上傳之圖片？");
    document.theForm.Pro_Img.focus();
    return (false);
  }

  if (document.theForm.Img.value != "" && document.theForm.Img.value != ""){
  last2 = document.theForm.Img.value.match(/^(.*)(\.)(.{1,8})$/)[3]; 
  if ( last2!="jpg"  &&  last2!="jpeg"  &&  last2!="png" && last2!="JPG"  &&  last2!="JPEG"  &&  last2!="PNG" ){
      alert("圖片文件格式錯誤!!!");
      return (false);
    }
  }

  return   true;  
}
-->
</SCRIPT>
<SCRIPT language=javascript type=text/javascript>
        var counter = 0;
        //設定來源 GridView ID
        var pattern = '^xfunTable';

        // Get the checkboxes inside the Gridview which is part of the template column
        function GetChildCheckBoxCount() 
        {    
            var checkBoxCount = 0;  
            
            var elements = document.getElementsByTagName("INPUT"); 
            
            for(i=0; i<elements.length;i++) 
            {
                if(IsCheckBox(elements[i]) &&  IsMatch(elements[i].id)) checkBoxCount++; 
            }
           return parseInt(checkBoxCount); 
        }

        // A function that checks if the checkboxes are the one inside the GridView 
        function IsMatch(id) 
        {
            var regularExpresssion = new RegExp(pattern); 
            
            if(id.match(regularExpresssion)) return true; 
            else return false; 
        }

        function IsCheckBox(chk) 
        {
            if(chk.type == 'checkbox') return true; 
            else return false;
        }


        function AttachListener()
        {
            var elements =  document.getElementsByTagName("INPUT");
            
            for(i=0; i< elements.length; i++) 
            {       
                if( IsCheckBox(elements[i]) &&  IsMatch(elements[i].id)) 
                {
                    AddEvent(elements[i],'click',CheckChild); 
                }
            }    
        }

        function CheckChild(e) 
        {
            var evt = e || window.event; 
            
            var obj = evt.target || evt.srcElement 
            if(obj.checked)
            {
                if(counter < GetChildCheckBoxCount()) 
                    { counter++; }        
            }    
                    
            else 
            {
               if(counter > 0) { counter--; }    
            } 
               
            if(counter == GetChildCheckBoxCount()) 
            { document.getElementById("chkAll").checked = true; } 
            else if(counter < GetChildCheckBoxCount()) { document.getElementById("chkAll").checked = false; }    
          
        }

        function AddEvent(obj, evType, fn) 
        {
            if (obj.addEventListener)
            {
            obj.addEventListener(evType, fn, true);
            return true;
            }
         
         else if (obj.attachEvent)
         {
            var r = obj.attachEvent("on"+evType, fn);
            return r;
         }
          else
           {
            return false;
           }    
        }


        function Check(parentChk) 
        {
            var elements =  document.getElementsByTagName("INPUT"); 
            
            for(i=0; i<elements.length;i++) 
            {
                if(parentChk.checked == true) 
                {  
                    if( IsCheckBox(elements[i]) &&  IsMatch(elements[i].id)) 
                    {
                    elements[i].checked = true; 
                    }         
                }
                else 
                {
                    elements[i].checked = false; 
                    // reset the counter 
                    counter = 0; 
                }       
            }
            
            if(parentChk.checked == true) 
            {
                counter = GetChildCheckBoxCount(); 
            }   
               
        }


    </SCRIPT>
<style type="text/css">
<!--
/*分頁選單*/
.pagenavi { text-align:center;  font: 11px Arial, tahoma, sans-serif; padding-top: 0px; padding-bottom: 0px; margin: 0px; }
.pagenavi .break {border: medium none;  text-decoration: none; color:#C16012; background:;; padding-left:6px; padding-right:6px; padding-top:2px; padding-bottom:2px}
.pagenavi .num {color:#C16012; font-size:12pt; padding-left:3px; padding-right:3px; padding-top:0; padding-bottom:0}
.pagenavi .curr {padding: 2px 6px; border-color: #999; font-weight: bold; font-size:12pt; background:transparent;}
-->
</style>

</head>

<body>
<table width="100%"border="1" cellpadding="3" cellspacing="0" bgcolor="#EFEFEF" bordercolordark="#ffffff" bordercolorlight="#cccccc">
    <tr class="title2">
      <td align="center" bgcolor="#CCCCCC"><strong>‧<?=$headtitle?>‧</strong></td>
  </tr>
    <tr>
      <td align="center" bgcolor="#CCCCCC">
	  <table width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
<tr>
<td align="center" valign="top">
<div align="center" style="height:auto">
<?
  $limit =10;	//每頁筆數
  //索引序號
  if(!empty($PB_page)):
  	$show = (($PB_page-1)*$limit);
  else:
  	$PB_page = 1;
  	$show = 0;
  endif;

if($id):
	$extquery=" WHERE rent_Num = $id";
endif;

	$CLASS["rent_img"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_img] $extquery ORDER BY rent_Img_Sort ASC LIMIT $show,$limit");
	$total = $CLASS["rent_img"]->num_rows($CLASS["rent_img"]->result);	//總筆數
?>

<form id="theForm" enctype="multipart/form-data" name="theForm" method="post" action="<?=$SubmitURL?>" onSubmit="return check(this)">
<table width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
  <tr bgcolor="#EFEFEF" >
    <td colspan="3" align="center" valign="middle" bgcolor="#CCCCCC">
      <strong>上傳圖片</strong>    </td>
  </tr>
  <tr>
    <td width="82" bgcolor="#FFFFFF">房間圖片</td>
    <td width="169" bgcolor="#FFFFFF">
		<input type="file" name="Img" size="40"/>		</td>
    <td width="688" rowspan="2" bgcolor="#FFFFFF">
	  <input name="submit" type="submit" class="input02" value=" 新增 "/>
      <input name="act" type="hidden" id="act" value="insert" />
      <input name="rent_Num" type="hidden" id="rent_Num" value="<?=$id?>" />
      <input name="main_page" type="hidden" id="main_page" value="<?=$main_page?>" />
      <input name="PB_page" type="hidden" id="PB_page" value="<?=$PB_page?>" />
<input type="button" name="Submit" class="input02" value=" 離開 "  onclick="location='<?=$ExitURL?>?PB_page=<?=$main_page?>'"/><br />
圖片規格 jpg、 png ，檔案規格請使用符合網頁格式的檔案，檔案大小請盡量控制在1M上下(請勿上傳GIF檔)。 
</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">排序</td>
    <td width="169" bgcolor="#FFFFFF">
			<select name="rent_Img_Sort"  id="rent_Img_Sort">
			<? for ($i=0;$i<50;$i++){?>
			  <option value="<?=$i?>"><?=$i?></option>
			<? }?>  
			</select>	</td>
  </tr>
</table>
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr class="title2">
    <td align="left">
	</td>
  </tr>
</table>
<table id="xfunTable" width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
<form id="form2" name="form2" enctype="multipart/form-data" method="post" action="<?=$SubmitURL?>" >
  <tr bgcolor="#D8D8D8">
    <td width="33" align="center">#</td>
    <td width="180">圖片</td>
    <td width="209">圖片檔名</td>
    <td width="157">大小</td>
    <td width="78">排序</td>
    <td width="79">最後編輯</td>
    <td width="204" align="center">編輯
	<img src="../images/del.gif" alt="批次刪除" width="14" height="12" border="0" onClick="javascript:form2.submit();"><INPUT id='chkAll' onclick='Check(this)' type='checkbox' name='chkAll'>
   <input name="main_page" type="hidden" id="main_page" value="<?=$main_page?>">
   <input name="PB_page" type="hidden" id="PB_page" value="<?=$PB_page?>">
   <input name="rent_Num" type="hidden" id="rent_Num" value="<?=$id?>">	</td>
  </tr>
  
<?
$i=0;
if($total >= 1):
while ($result = $CLASS["rent_img"]->fetch_array($CLASS["rent_img"]->result)) {
$i++;
	$rent_Img_Num = $result['rent_Img_Num'];
	$rent_Img_File = $result['rent_Img_File'];
	$rent_Img_Size = $result['rent_Img_Size'];
	$rent_Img_Sort = $result['rent_Img_Sort'];
	$last_modify = $result['last_modify'];
?>  
    <tr onMouseOver="this.style.backgroundColor='#e7f2fa';" onMouseOut="this.style.backgroundColor='#EFEFEF';">
	<td align="center"><a name="p<?=$i?>"></a><?=$i?></td>
    <td>
	<?php
@unlink ($XFUN_CONFIG['CONFIG_UPLOADPATH_PRO']."Temp_Img.jpg");
//取得副檔名
$ext = explode('.',$Products_Img_File);
$size = count($ext);
$subFileName = $ext[$size-1];
//how to use the class:
//makes a simple thumbnail of an image of 100x100 and saves the image then outputs it.
$imgresize = new resize_img();

$imgresize->sizelimit_x = 150;
$imgresize->sizelimit_y = 150;
$imgresize->keep_proportions = true;
$imgresize->output = $subFileName;

if( $imgresize->resize_image( $XFUN_CONFIG['CONFIG_UPLOADPATH_PRO'].$Products_Img_File ) === false )
{
  //echo 'ERROR!';
}
else
{
  $imgresize->save_resizedimage( $XFUN_CONFIG['CONFIG_UPLOADPATH_PRO'], 'Temp_Img' );
  //$imgresize->output_resizedimage();
}
if(!empty($rent_Img_File)):
echo "<div><img src='".$XFUN_CONFIG['CONFIG_UPLOADPATH_PRO'].$rent_Img_File."' alt='舊圖' width=150 height=100 ></div>";
$imgresize->destroy_resizedimage();
endif;
?>	</td>
    <td>
	<input name="OldPro_Img" type="hidden" id="OldPro_Img" value="<?=$Products_Img_File?>">
	<?
	if($edit==$rent_Img_Num):
	    echo $rent_Img_File;
		echo "<br><input type='file' name='Img' size='40'/>";
	else:
		echo $rent_Img_File;
	endif;
	?></td>
    <td>
	<input name="OldPro_Img_Size" type="hidden" id="OldPro_Img_Size" value="<?=$Products_Img_Size?>" />
	<?=$rent_Img_Size?>	</td>
    <td>
	<?
	if($edit==$rent_Img_Num):
			$select= "<select name='rent_Img_Sort' id='rent_Img_Sort'>";
			for ($i=0;$i<50;$i++){
			$selected=$Products_Img_Sort==$i?"selected":"";
				 $select.= "<option value='$i' $selected>".$i."</option>";
			}
			$select.= "</select>";
			echo $select;
	else:
			echo $rent_Img_Sort;
	endif;
	?>	</td>
    <td><?=$last_modify==""?"尚未":$last_modify?></td>
    <td align="center">
	<? 
	if($edit==$rent_Img_Num):
	?>
   <input name="act" type="hidden" id="act" value="update">
   <input name="rent_Img_Num" type="hidden" id="rent_Img_Num" value="<?=$rent_Img_Num?>">
   <input name="rent_Num" type="hidden" id="rent_Num" value="<?=$id?>">
   <input name="main_page" type="hidden" id="main_page" value="<?=$main_page?>">
   <input name="PB_page" type="hidden" id="PB_page" value="<?=$PB_page?>">
   <input name="Submit3" type="submit" class="btn_UpdateImg" value="" title="更新">
   <input name="Submit4" type="button" class="btn_CancelImg" value="" title="取消" onClick="location='<?=$phpself?>?id=<?=$id?>&main_page=<?=$main_page?>&PB_page=<?=$PB_page?>'">
	<?
	else:
	?>
	<a href="<?=$phpself?>?act=mdy&id=<?=$id?>&main_page=<?=$main_page?>&PB_page=<?=$PB_page?>&edit=<?=$rent_Img_Num?>"><img src="../images/edit.gif" alt="修改該筆資料" width="16" height="16" border="0"></a>
	<a href="JavaScript:Del_Confirm('<?=$SubmitURL?>?act=delete&rent_Num=<?=$id?>&main_page=<?=$main_page?>&PB_page=<?=$PB_page?>&img_file=<?=$rent_Img_File?>&rent_Img_Num=','<?=$rent_Img_Num?>','您確定刪除此資料?')"><img src="../images/del2.gif" alt="刪除該筆資料" width="16" height="16" border="0"></a>
	<INPUT id="xfunTable_chkSelect[]" type="checkbox" name="xfunTable_chkSelect[]" value="<?=$rent_Img_Num?>:<?=$rent_Img_File?>">
	<?
    endif;
}
endif;
?>   </td>
  </tr>
</form>
</table>
<table width="100%"border="1" cellpadding="1" cellspacing="0" bgcolor="#F3F3F3" bordercolordark="#ffffff" bordercolorlight="#ffffff">
      <tr>
        <td align="center" valign="top" bgcolor="#EBEBEB">
<?PHP
//分頁設訂
class mypage extends page
{
 function mypage($array)
 {
  parent::page($array);
  $this->first_page="<img src='../images/page_first.gif' border=0/>";
  $this->last_page="<img src='../images/page_last.gif' border=0/>";
  $this->next_page="<img src='../images/page_next.gif' border=0/>";
  $this->pre_page="<img src='../images/page_prev.gif' border=0 />";
  $this->set('format_left','');
  $this->set('format_right','');
 }
 
 function show()
 {
  $pagestr='<div class="pagenavi" id="lopage">';
  $pagestr.=$this->first_page().' ';
  $pagestr.=$this->pre_page().' ';
  $pagestr.=$this->nowbar('','curr');
  $pagestr.=$this->next_page();
  $pagestr.=$this->last_page();
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;共<span class="num">'.$this->totalpage.'</span>頁<span class="num">'.$this->totaldata.'</span>筆資料';
  $pagestr.='&nbsp;&nbsp;&nbsp;&nbsp;前往第 '.$this->select().' 頁';
  $pagestr.='</div>';
  return $pagestr;
 }
}
//取得總筆數
$CLASS["rent"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_img] $extquery");
$total = $CLASS["rent"]->num_rows($CLASS["rent"]->result);
//秀分頁選單
$page=new mypage(array('total'=>$total,'perpage'=>$limit));
echo $page->show(2);

$CLASS["rent"]->free_result($CLASS["rent"]->result);
$CLASS["rent_img"]->free_result($CLASS["rent_img"]->result);
?>		</td>
      </tr>
</table>
</div>
</td>
</tr>
</table>
	  </td>
    </tr>
</table>
</body>
</html>
