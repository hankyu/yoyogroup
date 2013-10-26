<?
error_reporting (E_ALL ^ E_WARNING ^ E_NOTICE); 

function is_ie() {
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if ((strpos($useragent, 'opera') !== false) ||
        (strpos($useragent, 'konqueror') !== false)) return false;
    if (strpos($useragent, 'msie ') !== false) return true;
    return false;
}
 
function download($attachment) {
    //$ABSPATH=$_SERVER["SERVER_NAME"];
	//$UPLOAD_DIR="/cosmos/file/upload";
    //$realpath = $ABSPATH . $UPLOAD_DIR . '/' . $attachment['path'] . '/' . $attachment['savename'];
	//下載檔案路徑
    $realpath =  $attachment['path'] . '/' . $attachment['file'];
    //exit;
	//檔案大小
	$content_len = sprintf("%u", filesize($realpath));
	//重新命名檔案
    if (is_ie()) {
        // leave $filename alone so it can be accessed via the hook below as expected.
        //$filename = rawurlencode($attachment['s_as_name']);
        $filename = $attachment['s_as_name'];
    }
    else {
        $filename = &$attachment['s_as_name'];
    }
 
 	//$cmd = "echo '$filename' | iconv -f UTF-8 -t GB2312"; 
	//$filename = shell_exec($cmd); 

    while(ob_get_length() !== false) @ob_end_clean(); 
    header('Pragma: public');
    header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header('Content-Type:text/html;charset=utf8');
    header('Content-Transfer-Encoding: binary'); 
    header('Content-Encoding: none');
    header('Content-type: ' . $attachment['type']);//檔案類型
    header('Content-Disposition: attachment; filename="' . htmlspecialchars(rawurldecode(stripslashes($filename))) . '"');
    header("Content-length: $content_len");
    echo file_get_contents($realpath);
    exit();
}

$file = $_GET["file"];
$file_title=$_GET["title"];
//判斷檔案類型
$file_sub=substr($file,-3 );
switch($file_sub){
  case "pdf": $ftype="application/pdf"; break;
  case "exe": $ftype="application/octet-stream"; break;
  case "zip": $ftype="application/zip"; break;
  case "rar": $ftype="application/rar"; break;
  case "txt": $ftype="application/txt"; break;
  case "doc": $ftype="application/msword"; break;
  case "xls": $ftype="application/vnd.ms-excel"; break;
  case "ppt": $ftype="application/vnd.ms-powerpoint"; break;
  case "gif": $ftype="image/gif"; break;
  case "png": $ftype="image/png"; break;
  case "jpg": $ftype="image/jpg"; break;
  default:
  echo "<html><body>您不可以下載這個檔案!</body></html>";
  exit;

}


$attachment=array("path"=>'../../upload/File',"file"=>$file,"s_as_name"=>"$file_title","type"=>$ftype);

download($attachment);
//echo "<script language='javascript'>location.href='../../upload/File/".$file."'</script>";
?>
