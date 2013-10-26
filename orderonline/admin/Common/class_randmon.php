<?php
/*
實作 class_randmon.php ，包含下列 methods 

取得任意個數由亂數產生的數字
取得任意個數由亂數產生的英文字
讀入一個文字檔，並由亂數隨意截取字串，讀檔時，錯誤處理以 throw execption 的語法實作
*/
// 亂數取得各種型態的數值
class randomValue
{
	//最小數
	var $min=0;
	//最大數
    var $max= 9;
    //取字串數
    var $word_num=10;
    //宣告常數
    var $FILE_NOT_EXIST_ERROR=1;
    
    // 建構函式
    function randomValue(){

    }

    // 取整數
    function rand_integer($min=0,$max=0){
        if ($min == 0):
            $min = $this->min;
		endif;	
        if ($max == 0):
            $min = $this->max;
		endif;	
        return     rand($min,$max);
    }
    
    //取字串
    function rand_str($word_num=0){
		$time_radom = time()."_".rand(10000,99999); 
        if ($word_num < 1 ):
            $word_num = $this->word_num;
		endif;	
        $str = '';
        for($i=0; $i<$word_num; $i++){
            if (rand(0,1)):
                $str .= chr(rand(65,90));
            else:
                $str .= chr(rand(97,122));
			endif;	
        }
        return $time_radom.$str;
    }

}

$aa = new randomValue();
if($_COOKIE["Cart_ID"]==""){
$Month = 2592000 + time(); 
	setcookie ("Cart_ID", $aa->rand_str(90), $Month);
}

//echo $_COOKIE["Cart_ID"];
//setcookie ("Cart_ID");

//echo $aa->rand_integer();
//echo $aa->rand_str(90);
//echo "<hr>";
/*
try {
    echo $aa->rand_file_str('news.txt',50);
}
catch (Exception $e) {
    if ($e->getCode() == randomValue::FILE_NOT_EXIST_ERROR) {
        die($e->getMessage()); 
    }
}*/
?>
