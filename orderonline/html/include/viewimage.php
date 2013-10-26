<?
include("head.php");
?>
<script language="javascript" type="text/javascript" src="../../js/lock_leftkey.js"></script>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<script language="JavaScript">
<!--
//圖片按比例縮放
var flag=false;
function DrawImage(ImgD){
    var image=new Image();
	    //alert(screen.width/100);
	    //alert(screen.height/100);
		//alert(ImgD.offsetWidth);
	    //alert(ImgD.offsetHeight);
    var iwidth = screen.width/1.2;  //定義允許圖片寬度
    var iheight = screen.height/1.2;  //定義允許圖片高度
    image.src=ImgD.src;
    if(image.width>0 && image.height>0){
    flag=true;
    if(image.width/image.height>= iwidth/iheight){
        if(image.width>iwidth){  
        ImgD.width=iwidth;
        ImgD.height=(image.height*iwidth)/image.width;
        }else{
        ImgD.width=image.width;  
        ImgD.height=image.height;
        }
        ImgD.alt=image.width+"×"+image.height;
        }
    else{
        if(image.height>iheight){  
        ImgD.height=iheight;
        ImgD.width=(image.width*iheight)/image.height;        
        }else{
        ImgD.width=image.width;  
        ImgD.height=image.height;
        }
        ImgD.alt=image.width+"×"+image.height;
        }
    }
	Resize_Move('mytable');
} 
//調用：<img src="圖片" onload="javascript:DrawImage(this)">
//-->
</script>
<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="<?=$_GET["img"]?>&size=500" id="mytable" border="0" onload="javascript:DrawImage(this)"/></td>
  </tr>
</table>

</body>
</html>
