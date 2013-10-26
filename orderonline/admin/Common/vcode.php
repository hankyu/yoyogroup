<?php 
 require_once('rw.inc.php'); 
 $EncodeKey='rgb1677216@net!@$^%$&%^*&&*((*&$@#$@#$()_|+*$#%^'; 
 $RA=new RobotAway($EncodeKey,'CheckKey'); 
 if(isset($_POST['CheckKey'])) 
 { 
  //驗證Clinet送過來的這個Checkey值是否合法 
  $OK=$RA->Verify($_POST['CheckKey'])?'Valid':'Invalid'; 
 } 
?> 
<html> 
<head> 
 <script> 
<?=$RA->GenerateJS()?> 
 </script> 
 </head> 
 <body> 
 CheckStatus:<?=$OK?> 
 <form action='' method=post> 
  <input type=hidden name="CheckKey" id="CheckKey" value=''><br> 
<!-- 
在執行submit之前呼叫RA_Check();將驗證碼指定給CheckKey這個hidden欄位 
--> 
  <input type=button value=" verify   " onClick="<?=$RA->CheckFunction()?>;submit();"> 
 </form> 
<?php 
/* 
 *   Filename: authimg.php 
 *   Author:   hutuworm 
 *   Date:     2003-04-28 
 *   @Copyleft hutuworm.org 
 */ 
//生成验证码图片 
Header("Content-type: image/PNG");  
srand((double)microtime()*1000000); 
$im = imagecreate(62,20); 
$black = ImageColorAllocate($im, 0,0,0); 
$white = ImageColorAllocate($im, 255,255,255); 
$gray = ImageColorAllocate($im, 200,200,200); 
imagefill($im,68,30,$gray); 
while(($authnum=rand()%100000)<10000);
//将四位整数验证码绘入图片 
imagestring($im, 5, 10, 3, $authnum, $black); 
for($i=0;$i<200;$i++)   //加入干扰象素 
{ 
    $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
    imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); 
} 
ImagePNG($im); 
ImageDestroy($im); 
?> 
 </body> 
</html> 

