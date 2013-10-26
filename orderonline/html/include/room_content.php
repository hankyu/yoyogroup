<?PHP
//基本設定
$CLASS["DB"] = new xfunDB_sql;
$CLASS["DB"]->connect(); 
$CLASS["rent_img"] = new xfunDB_sql;
$CLASS["rent_img"]->connect(); 


 
//資料讀取****************************************************
  $query_where1="WHERE rentNum = $_GET[id] ";
  $result_num = "SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent] ".$query_where1;
  $CLASS["DB"]->query($result_num);
  if ($row = $CLASS["DB"]->fetch_array($CLASS["DB"]->result)) {
	$rentNum=$row["rentNum"];
	$projNum=$row["projNum"];
	$projName=$row["projName"];
	$en_projName=$row["en_projName"];
	$rentPrice=$row["rentPrice"];
	$display=$row["display"];
	$rentDiscribe=$row["rentDiscribe"];
	$shortDiscribe=$row["shortDiscribe"];
	$en_rentDiscribe=$row["en_rentDiscribe"];
	$en_shortDiscribe=$row["en_shortDiscribe"];
	$creatDate=$row["creatDate"];
   }
?>

<SCRIPT> 
<!-- 
function channel(img){ 

window.open("../include/viewimage.php?img="+encodeURIComponent(img),"mywindow","menubar=no,scrollbars=no,status=no,toolbar=no,resizable=no") 
} 
//--> 
</SCRIPT>
<div style="padding-left:15px; padding-right:15px;">
<table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td align="left" valign="top" style="font-family:'新細明體'; font-size:15px; font-weight:bold; background-color:#FAF7F2; padding-top:2px; padding-bottom:2px;">◆<?=$lan=="cht"?"房間資訊":"Room Information"?></td>
              </tr>
              <tr>
                <td height="15" align="center" valign="top" ></td>
              </tr>
              <tr>
                <td align="center" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td width="200" valign="top"><table width="110" height="80" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" valign="middle">
<?php
$extquery=" WHERE rent_Num = $rentNum ORDER BY rent_Img_Sort ASC";
$CLASS["rent_img"]->query("SELECT * FROM $XFUN_TBL[TABLE_XFUN_rent_img] $extquery");
$total = $CLASS["rent_img"]->num_rows($CLASS["rent_img"]->result);	//總筆數
if($total >= 1):
		
	while ($result = $CLASS["rent_img"]->fetch_array($CLASS["rent_img"]->result)) 
	{
		$n++;
		if($n==1){
		$rent_Img_File1 = $result['rent_Img_File'];
		}
		$rent_Img_Num = $result['rent_Img_Num'];
		$rent_Img_File = $result['rent_Img_File'];
		$rent_Img_Size = $result['rent_Img_Size'];
		$rent_Img_Sort = $result['rent_Img_Sort'];
		$ImgList.="<LI id=tmpcss".$n."><IMG onmouseover=changeimg(this,$n) onmouseout=remove(this,$n)  height=64  src=\"../include/image.php?file=".$XFUN_CONFIG["CONFIG_UPLOADPATH_PRO"].$rent_Img_File."&size=64\" width=64> </LI>";
	}
endif;

if(!empty($rent_Img_File)):
$MainImg = "<img id='main_img' src='../include/image.php?file=".$XFUN_CONFIG['CONFIG_UPLOADPATH_PRO'].$rent_Img_File1."&size=280' alt='$vote_title' border=0 >";
else:
//$MainImg = "<img id='main_img' src='../../images/03_products/nopic.gif' width='120' height='90' border=0>";
endif;
?>   
<!---------產品圖片切換展示--------->
<!--main wrap-->
<DIV id=ZoomImg class=btn_zoom></DIV>
<DIV id=wrap><!--main col-->
<DIV id=main_cont><!--product illustration-->
<DIV id=pr_illust>
<DIV class=pir23_wrap>
<DIV class=pri002_rec id=prodimg>
<BLOCKQUOTE><SPAN></SPAN></BLOCKQUOTE>
<DIV><?=$MainImg?></DIV></DIV>
</DIV>
<UL class=pri004></UL>
</DIV><!--end product illustration--><!--product data-->
<!--end regular section-->
</DIV>
<!--end main col--><!--side bar-->
<!--end side bar-->
</DIV>
<!--end main wrap-->                      </td>
                        </tr>
                      </table></td>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1">
<!--                        <tr>
                          <td width="115" align="left" valign="top"><?=$lan=="cht"?"房型編號":"Room No."?>：</td>
                          <td width="420" align="left" ><?=$projNum?></td>
                        </tr>-->
                        <tr>
                          <td align="left" valign="top"><?=$lan=="cht"?"房型名稱":"Room Type"?>：</td>
                          <td align="left" ><?=$lan=="cht"?$projName:$en_projName?></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><?=$lan=="cht"?"線上特價":"Rates"?>：</td>
                          <td align="left" valign="top" class="style17gray"><?=$lan=="cht"?"":"NTD "?>
						  <?=$rentPrice?><?=$lan=="cht"?"元起":" and up"?>
						  <div>※<?=$lan=="cht"?"實際房價依據訂閱日期有所調整
":"The room rates might be different according to date."?><br />
						  ※<?=$lan=="cht"?"請點選下面標示紅色的日期進行訂房動作":"Please click the date (signed red) to start your reservation."?></div>						  </td>
                        </tr>
                      </table>
<DIV class=pri003 id=talklook>
<DIV id=btn style="display:none">
<button class="btnleft" id="goleft" title="往前" hidefocus="true"></button>
<button class="btnright" id="goright" title="往後" hidefocus="true"></button>
</DIV>
<DIV id=showArea>
 <UL id=ulwidth>
    <DIV id=Products_Content1_smallImg>
	<SPAN>
	  <?=$ImgList?>
	</SPAN>	</div>
  </UL></DIV></DIV>

                        </td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top">
					                          <div style="width:100%; height:200">
                          <?
						  require_once("../../admin/rent/calendar_order.php");
						  ?>
                        </div>
						<?
						  require_once("../include/car_list.php");
						  ?>
					  </td>
                    </tr>
                </table>
				</td>
              </tr>
              <tr>
                <td align="left" valign="top" style="font-family:'新細明體'; font-size:15px; font-weight:bold; background-color:#D9B3B3;">
				◆ <?=$lan=="cht"?"房間介紹":"Room Introduction"?></td>
                </tr>
              <tr>
                <td align="left" valign="top" style="padding-left:20px"></td>
              </tr>
              <tr>
                <td align="left" valign="top"><?=$lan=="cht"?$rentDiscribe:$en_rentDiscribe?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
        </tr>
      </table>
</div>
<SCRIPT type=text/javascript>
var MyMar;
var speed = 1;
var spec = 1; 
var tmpseq; 
document.getElementById("goleft").onmouseover = function() {MyMar=setInterval(goleft,speed);};
document.getElementById("goleft").onmouseout =  function() { clearInterval(MyMar);};
document.getElementById("goright").onmouseover =  function() { MyMar=setInterval(goright,speed);};
document.getElementById("goright").onmouseout =  function() {clearInterval(MyMar);};
//取得圖片數量
var elements =  document.getElementsByTagName("LI");
//設定圖片區塊捲動寬度
$("#ulwidth").css("width",elements.length*70);
function goleft() {document.getElementById('showArea').scrollLeft-=spec; }
function goright() {document.getElementById('showArea').scrollLeft+=spec;}
function changeimg(obj,seq){
	tmpsrc = obj.src;
	if(tmpsrc.search('image.php')!=-1){
		tmpsrc_len = tmpsrc.length-8;
		tmpsrc_str = tmpsrc.substr(0,tmpsrc_len);
		//tmpsrc_strImgName = tmpsrc.substr(tmpsrc.length-36,28);
		tmpsrc_tmp = tmpsrc_str+"&size=280";
	}else{
		tmpsrc_tmp = tmpsrc
	}
	document.getElementById("main_img").src=tmpsrc_tmp;
    document.getElementById("ZoomImg").onclick =function(){window.open('../include/viewimage.php?img='+tmpsrc_tmp ,'mywindow','width=600,height=550,scrollbars =yes,resizable =yes')}; 
	$("#tmpcss"+seq).addClass("here");
	$("#tmpcss"+tmpseq).removeClass();
}
function remove(obj,seq){
	tmpseq=seq;
}
</SCRIPT>
<?
if(!empty($MainImg)):
echo "<script>changeimg(document.getElementById('main_img'),1)</script>";
endif;
?>