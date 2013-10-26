<?
//***取得檔案大小 NON TEST
function getfilesize($File){
	if($File < 1000)
		$size = $File." bytes";
	elseif($File > 1000 && $File < 1000000)
		$size =  round(($File / 1000),2)." KB";
	elseif($File > 1000000)
		$size = round((($File / 1000) / 1000),2)." MB";
	return $size;
}

//***上傳檔案 TEST OK
function putFile($File,$Path,$n,$FileTitle){
if ($n=="1"):
//*****用"move_uploaded_file"方式上傳*****
 //$File上傳檔案存放目錄
 global $FZ,$f_name;
  if (is_uploaded_file($_FILES[$File][tmp_name])){
 //重新命名
     $sub_name=substr($_FILES[$File][name],-4);
	 $f_name = $FileTitle.date("Ymds")."_".rand(10000,99999).strtolower($sub_name);
 //上傳檔案	
	 move_uploaded_file($_FILES[$File][tmp_name],$Path.$f_name);
	 //取得上傳檔案大小
	 $f_size=$_FILES[$File][size];
	 //$FZ=round($f_size/1000,2)."KB";
	 $FZ=getfilesize($f_size);
	 return true;
	 }else{
     return "無法上傳";
     }
elseif($n=="2"):
//*****用"copy"方式上傳*****
     //重新命名
  if (is_uploaded_file($_FILES[$File][tmp_name])){
     $tempfile = $_FILES[$File][tmp_name];
	 $realfile = $_FILES[$File][name];
     $revn = substr($realfile, -4);  
	 //取得上傳檔案大小  
	 $f_size=$_FILES[$File][size];
	 $FZ=round($f_size/1000,2)."KB";
     $f_name=$FileTitle.rand(10000,99999).$revn;
     //上傳檔案
     copy($tempfile, $Path.$f_name);
  	 return true;
     //建立資料夾
     /*
     mkdir("$Path", 0700);
     $uploadDir = '$Path';
     $uploadFile = $uploadDir . $_FILES['userfile']['name'];
     */
	 }else{
     return "無法上傳";
     }
else:
echo "執行函數錯誤";
endif;
}

//***刪除檔案 NON TEST
function unLinkFile(){
		if($link_chk || $f_name!=$f_chk){
			$old_file = $down_path."/".$upfile_dir."/".$f_chk;
			if(file_exists($old_file))
				unlink($old_file);
		}
}
?>
<?php
/*
function getfilesize($File){
	if(filesize($File) < 1000)
		$size = filesize($File)." bytes";
	elseif(filesize($File) > 1000 && filesize($File) < 1000000)
		$size =  round((filesize($File) / 1000),2)." KB";
	elseif(filesize($File) > 1000000)
		$size = round(((filesize($File) / 1000) / 1000),2)." MB";
	return $size;
}
// 在 4.1.0 以前的 PHP 中，需要用 $HTTP_POST_FILES 代替 $_FILES。
// 在 4.0.3 以前的 PHP 中，需要用 copy() 和 is_uploaded_file() 來代替 move_uploaded_file()。

$uploaddir = '/var/www/uploads/';
$uploadfile = $uploaddir. $_FILES['userfile']['name'];
print "<pre>";
//***1
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $_FILES['userfile']['name'])) {
   print "File is valid, and was successfully uploaded.  Here's some more debugging info:\n";
   print_r($_FILES);
} else {
   print "Possible file upload attack!  Here's some debugging info:\n";
   print_r($_FILES);
}
print "</pre>";
//***2
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile))

{
    print "File is valid, and was successfully uploaded. ";
    print "Here's some more debugging info:\n";
    print_r($_FILES);
}
else
{
    print "Possible file upload attack!  Here's some debugging info:\n";
    print_r($_FILES);
}
print "</pre>";
?> 
<?
  $tempfile = $HTTP_POST_FILES['uploadfile']['tmp_name'];
  $p05 = $HTTP_POST_FILES['uploadfile']['name'];
  $ext = substr($p05, -4);    
  $qrynum = "SELECT max(num) FROM l03";
  $rsofnum = mysql_query($qrynum);
  if($rsofnum){
    $ary= mysql_fetch_array($rsofnum);
	$p04=$ary["max(num)"];
	$p04++;
	$p04=$p04.$ext;
    if(!empty($tempfile)){
      //$path = "D:/web/Apache/htdocs/upload/j/";
	  $path2 = "/home/horizon/public_html/edu/upload/l/l02/";
      copy($tempfile,$path2.$p04);
    }else{echo("檔案未上傳!!");}
  }else{echo(mysql_error());}*/
?>