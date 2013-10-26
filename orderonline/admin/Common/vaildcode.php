<?php
//小豬會氣功
session_start();
session_register('code');
$width = "70";//圖片寬
$height = "25";//圖片高
$len = "4";//生成幾位驗證碼
$bgcolor = "#ffffff";//背景色
$noise = true;//生成雜點
$noisenum = 200;//雜點數量
$border = false;//邊框
$bordercolor = "#000000";
$image = imageCreate($width, $height);
$back = getcolor($bgcolor);
imageFilledRectangle($image, 0, 0, $width, $height, $back);
$size = $width/$len;
if($size>$height) $size=$height;
$left = ($width-$len*($size+$size/10))/$size;
for ($i=0; $i<$len; $i++)
{
        $randtext = rand(0, 9);
        $code .= $randtext;
	$textColor = imageColorAllocate($image, rand(0, 100), rand(0, 100), rand(0, 100));
	$font = rand(1,4).".ttf"; 
	$randsize = rand($size-$size/10, $size+$size/10);
	$location = $left+($i*$size+$size/10);
	imagettftext($image, $randsize, rand(-18,18), $location, rand($size-$size/10, $size+$size/10), $textColor, $font, $randtext); 
}
if($noise == true) setnoise();
$_SESSION['code'] = $code;
$bordercolor = getcolor($bordercolor); 
if($border==true) imageRectangle($image, 0, 0, $width-1, $height-1, $bordercolor);
header("Content-type: image/png");
imagePng($image);
imagedestroy($image);
function getcolor($color)
{
     global $image;
     $color = eregi_replace ("^#","",$color);
     $r = $color[0].$color[1];
     $r = hexdec ($r);
     $b = $color[2].$color[3];
     $b = hexdec ($b);
     $g = $color[4].$color[5];
     $g = hexdec ($g);
     $color = imagecolorallocate ($image, $r, $b, $g); 
     return $color;
}
function setnoise()
{
	global $image, $width, $height, $back, $noisenum;
	for ($i=0; $i<$noisenum; $i++){
		$randColor = imageColorAllocate($image, rand(0, 255), rand(0, 255), rand(0, 255));  
		imageSetPixel($image, rand(0, $width), rand(0, $height), $randColor);
	} 
}
?> 
