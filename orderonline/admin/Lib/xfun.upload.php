<?PHP
####################################
# XFUN  檔案上傳類別庫  2008-06-26 #
#								   #
####################################

class XFUN_Upload 
{
	var $Classname = "XFUN_Upload";
	var $File_Use;
	var $FIle;
	var $File_Name;
	var $DelFile_Name;
	var $File_Path;
	var $File_Title;
	var $File_Size;


	/**************************************************************************
	** name: getfilesize()
	** created by: xfun
	** description: 取得檔案大小
	** parameters:$file 
	** returns:檔案大小
	***************************************************************************/
	function getFileSize($file){
		if($file < 1000)
			$size = $file." bytes";
		elseif($file > 1000 && $file < 1000000)
			$size =  round(($file / 1000),2)." KB";
		elseif($file > 1000000)
			$size = round((($file / 1000) / 1000),2)." MB";
		$this->File_Size = $size;
	}


	/**************************************************************************
	** name: getfilesize()
	** created by: xfun
	** description: 上傳檔案
	** parameters:$File,$Path,$File_Use,$FileTitle
	** returns:檔案大小
	***************************************************************************/
	function UploadFile(){
	if ($this->File_Use=="1"):
	//*****用"move_uploaded_file"方式上傳*****
	 //$File上傳檔案存放目錄
		 //global $FZ,$f_name;
		  if (is_uploaded_file($_FILES[$this->File][tmp_name])){
			 //重新命名
			 $sub_name = substr($_FILES[$this->File][name],-4);
			 
			 $this->File_Name = $this->File_Title.date("Ymds")."_".rand(10000,99999).strtolower($sub_name);
			 //echo $this->File_Name;
			 //上傳檔案	
			 move_uploaded_file($_FILES[$this->File][tmp_name],$this->File_Path.$this->File_Name);
			 //取得上傳檔案大小
			 $f_size=$_FILES[$this->File][size];
			 //$FZ=round($f_size/1000,2)."KB";
			 $this->getFileSize($f_size);
			 return true;
		 }else{
			 return false;
		 }
	elseif($this->File_Use=="2"):
	//*****用"copy"方式上傳*****
		 //重新命名
		  if (is_uploaded_file($_FILES[$this->File][tmp_name])){
			 $tempfile = $_FILES[$this->File][tmp_name];
			 $realfile = $_FILES[$this->File][name];
			 $revn = substr($realfile, -4);  
			 //取得上傳檔案大小  
			 $f_size = $_FILES[$this->File][size];
			 $this->getFileSize($f_size);
			 //$FZ=round($f_size/1000,2)."KB";
			 $this->File_Name = $this->File_Title.rand(10000,99999).$revn;
			 //上傳檔案
			 copy($tempfile, $this->Path.$this->File_Name);
			 return true;
			 //建立資料夾
			 /*
			 mkdir("$Path", 0700);
			 $uploadDir = '$Path';
			 $uploadFile = $uploadDir . $_FILES['userfile']['name'];
			 */
		 }else{
			 return false;
		 }
	else:
		 return false;
	endif;
	}
	/**************************************************************************
	** name: unLinkFile()
	** created by: xfun
	** description: 刪除檔案
	** parameters:$File_Path,$File_Name
	** returns:true|false
	***************************************************************************/
	function unLinkFile()
	{
		$old_file = $this->File_Path.$this->DelFile_Name;
		if(file_exists($old_file)):
			@unlink($old_file);
			return true;
		else:
			return false;
		endif;	
	}
}
?>