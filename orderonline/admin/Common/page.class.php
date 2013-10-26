<?
/**
 * filename: ext_page.class.php
 * @package:phpbean
 * @author :feifengxlq<feifengxlq#gmail.com><[url=http://www.phpobject.net/]http://www.phpobject.net/[/url]>
 * @copyright :Copyright 2006 feifengxlq
 * @license:version 2.0
 * @create:2006-5-31
 * @modify:2006-6-1
 * @modify:feifengxlq 2006-11-4
 * description:超強分頁類，四種分頁模式，默認採用類似baidu,google的分頁風格。
 * 2.0增加功能：支援自定義風格，自定義樣式，同時支援PHP4和PHP5,
 * to see detail,please visit [url=http://www.phpobject.net/blog/read.php]http://www.phpobject.net/blog/read.php[/url]?
 * example:
 * 模式四種分頁模式：
   require_once('../libs/classes/page.class.php');
   $page=new page(array('total'=>1000,'perpage'=>20));
   echo 'mode:1<br>'.$page->show();
   echo '<hr>mode:2<br>'.$page->show(2);
   echo '<hr>mode:3<br>'.$page->show(3);
   echo '<hr>mode:4<br>'.$page->show(4);
   開啟AJAX：
   $ajaxpage=new page(array('total'=>1000,'perpage'=>20,'ajax'=>'ajax_page','page_name'=>'test'));
   echo 'mode:1<br>'.$ajaxpage->show();
   採用繼承自定義分頁顯示模式：
   demo:http://www.phpobject.net/blog
 */
class page 
{
 /**
  * config ,public
  */
 var $page_name="PB_page";//page標籤，用來控制url頁。比如說xxx.php?PB_page=2中的PB_page
 var $next_page='>';//下一頁
 var $pre_page='<';//上一頁
 var $first_page='First';//首頁
 var $last_page='Last';//尾頁
 var $pre_bar='<<';//上一分頁條
 var $next_bar='>>';//下一分頁條
 var $format_left='[';
 var $format_right=']';
 var $is_ajax=false;//是否支援AJAX分頁模式 
 
 /**
  * private
  *
  */ 
 var $pagebarnum=10;//控制記錄條的個數。
 var $totalpage=0;//總頁數
 var $ajax_action_name='';//AJAX動作名
 var $nowindex=1;//當前頁
 var $url="";//url地址頭
 var $offset=0;
 
 /**
  * constructor構造函數
  *
  * @param array $array['total'],$array['perpage'],$array['nowindex'],$array['url'],$array['ajax']...
  */
 function page($array)
 {
  if(is_array($array)){
     if(!array_key_exists('total',$array))$this->error(__FUNCTION__,'need a param of total');
     $total=intval($array['total']);
     $perpage=(array_key_exists('perpage',$array))?intval($array['perpage']):10;
     $nowindex=(array_key_exists('nowindex',$array))?intval($array['nowindex']):'';
     $url=(array_key_exists('url',$array))?$array['url']:'';
  }else{
     $total=$array;
     $perpage=10;
     $nowindex='';
     $url='';
  }
  if((!is_int($total))||($total<0))$this->error(__FUNCTION__,$total.' is not a positive integer!');
  if((!is_int($perpage))||($perpage<=0))$this->error(__FUNCTION__,$perpage.' is not a positive integer!');
  if(!empty($array['page_name']))$this->set('page_name',$array['page_name']);//設置pagename
  $this->_set_nowindex($nowindex);//設置當前頁
  $this->_set_url($url);//設置鏈結位址
  $this->totaldata=$total;
  $this->totalpage=ceil($total/$perpage);
  $this->offset=($this->nowindex-1)*$this->perpage;
  if(!empty($array['ajax']))$this->open_ajax($array['ajax']);//打開AJAX模式
 }
 /**
  * 設定類中指定變數名的值，如果改變量不屬於這個類，將throw一個exception
  *
  * @param string $var
  * @param string $value
  */
 function set($var,$value)
 {
  if(in_array($var,get_object_vars($this)))
     $this->$var=$value;
  else {
   $this->error(__FUNCTION__,$var." does not belong to PB_Page!");
  }
  
 }
 /**
  * 打開倒AJAX模式
  *
  * @param string $action 默認ajax觸發的動作。
  */
 function open_ajax($action)
 {
  $this->is_ajax=true;
  $this->ajax_action_name=$action;
 }
 /**
  * 獲取顯示"下一頁"的代碼
  * 
  * @param string $style
  * @return string
  */
 function next_page($style='')
 {
  if($this->nowindex<$this->totalpage){
   return $this->_get_link($this->_get_url($this->nowindex+1),$this->next_page,$style);
  }
  return '<span class="'.$style.'">'.$this->next_page.'</span>';
 }
 
 /**
  * 獲取顯示“上一頁”的代碼
  *
  * @param string $style
  * @return string
  */
 function pre_page($style='')
 {
  if($this->nowindex>1){
   return $this->_get_link($this->_get_url($this->nowindex-1),$this->pre_page,$style);
  }
  return '<span class="'.$style.'">'.$this->pre_page.'</span>';
 }
 
 /**
  * 獲取顯示“首頁”的代碼
  *
  * @return string
  */
 function first_page($style='')
 {
  if($this->nowindex==1){
      return '<span class="'.$style.'">'.$this->first_page.'</span>';
  }
  return $this->_get_link($this->_get_url(1),$this->first_page,$style);
 }
 
 /**
  * 獲取顯示“尾頁”的代碼
  *
  * @return string
  */
 function last_page($style='')
 {
  if($this->nowindex==$this->totalpage){
      return '<span class="'.$style.'">'.$this->last_page.'</span>';
  }
  return $this->_get_link($this->_get_url($this->totalpage),$this->last_page,$style);
 }
 
 function nowbar($style='',$nowindex_style='')
 {
  $plus=ceil($this->pagebarnum/2);
  if($this->pagebarnum-$plus+$this->nowindex>$this->totalpage)$plus=($this->pagebarnum-$this->totalpage+$this->nowindex);
  $begin=$this->nowindex-$plus+1;
  $begin=($begin>=1)?$begin:1;
  $return='';
  for($i=$begin;$i<$begin+$this->pagebarnum;$i++)
  {
   if($i<=$this->totalpage){
    if($i!=$this->nowindex)
        $return.=$this->_get_text($this->_get_link($this->_get_url($i),$i,$style));
    else 
        $return.=$this->_get_text('<span class="'.$nowindex_style.'">'.$i.'</span>');
   }else{
    break;
   }
   $return.="\n";
  }
  unset($begin);
  return $return;
 }
 /**
  * 獲取顯示跳轉按鈕的代碼
  *
  * @return string
  */
 function select()
 {
  $return='<select name="PB_Page_Select" onChange="location.href=this.options[this.selectedIndex].value;">';
  for($i=1;$i<=$this->totalpage;$i++)
  {
   if($i==$this->nowindex){
    $return.='<option value="'.$this->_get_url($i).'" selected>'.$i.'</option>';
   }else{
    $return.='<option value="'.$this->_get_url($i).'">'.$i.'</option>';
   }
  }
  unset($i);
  $return.='</select>';
  return $return;
 }
 
 /**
  * 獲取mysql 語句中limit需要的值
  *
  * @return string
  */
 function offset()
 {
  return $this->offset;
 }
 
 /**
  * 控制分頁顯示風格（你可以增加相應的風格）
  *
  * @param int $mode
  * @return string
  */
 function show($mode=1)
 {
  switch ($mode)
  {
   case '1':
    $this->next_page='下一頁';
    $this->pre_page='上一頁';
    return $this->pre_page().$this->nowbar().$this->next_page().'第'.$this->select().'頁';
    break;
   case '2':
    $this->next_page='下一頁';
    $this->pre_page='上一頁';
    $this->first_page='首頁';
    $this->last_page='尾頁';
    return $this->first_page().$this->pre_page().'[第'.$this->nowindex.'頁]'.$this->next_page().$this->last_page().'第'.$this->select().'頁';
    break;
   case '3':
    $this->next_page='下一頁';
    $this->pre_page='上一頁';
    $this->first_page='首頁';
    $this->last_page='尾頁';
    return $this->first_page().$this->pre_page().$this->next_page().$this->last_page();
    break;
   case '4':
    $this->next_page='下一頁';
    $this->pre_page='上一頁';
    return $this->pre_page().$this->nowbar().$this->next_page();
    break;
   case '5':
    return $this->pre_bar().$this->pre_page().$this->nowbar().$this->next_page().$this->next_bar();
    break;
   case '6':
    $this->next_page='下一頁';
    $this->pre_page='上一頁';
    $this->first_page='首頁';
    $this->last_page='尾頁';
    return $this->first_page().$this->pre_page().$this->nowbar().$this->next_page().$this->last_page().'第'.$this->select().'頁';
    break;
}
  
 }
/*----------------private function (私有方法)-----------------------------------------------------------*/
 /**
  * 設置url頭位址
  * @param: String $url
  * @return boolean
  */
 function _set_url($url="")
 {
 /**
  * 取代$_SERVER['REQUEST_URI']<=僅可跑Apache，如果SERVER是IIS的話，則將取代為另一種方法。
  *
  */
 	if (isset($_SERVER['REQUEST_URI'])) 
	{         
		$uri = $_SERVER['REQUEST_URI'];     
	}else{         
		if (!empty($_SERVER['argv'][0])) 
		{ 
			$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
		}elseif(!empty($_SERVER['QUERY_STRING'])){ 
			$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];         
		}     
	}  
	
  if(!empty($url)){
      //手動設置
   $this->url=$url.((stristr($url,'?'))?'&':'?').$this->page_name."=";
  }else{
      //自動獲取
   if(empty($_SERVER['QUERY_STRING'])){
       //不存在QUERY_STRING時
    $this->url=$uri."?".$this->page_name."=";
   }else{
       //
    if(stristr($_SERVER['QUERY_STRING'],$this->page_name.'=')){
        //位址存在頁面參數
     $this->url=str_replace($this->page_name.'='.$this->nowindex,'',$uri);
     $last=$this->url[strlen($this->url)-1];
     if($last=='?'||$last=='&'){
         $this->url.=$this->page_name."=";
     }else{
         $this->url.='&'.$this->page_name."=";
     }
    }else{
        //
     $this->url=$uri.'&'.$this->page_name.'=';
    }//end if    
   }//end if
  }//end if
 }
 

 /**
  * 設置當前頁面
  *
  */
 function _set_nowindex($nowindex)
 {
  if(empty($nowindex)){
   //系統獲取
   
   if(isset($_GET[$this->page_name])){
    $this->nowindex=intval($_GET[$this->page_name]);
   }
  }else{
      //手動設置
   $this->nowindex=intval($nowindex);
  }
 }
  
 /**
  * 為指定的頁面返回位址值
  *
  * @param int $pageno
  * @return string $url
  */
 function _get_url($pageno=1)
 {
  return $this->url.$pageno;
 }
 
 /**
  * 獲取分頁顯示文字，比如說默認情況下_get_text('<a href="">1</a>')將返回[<a href="">1</a>]
  *
  * @param String $str
  * @return string $url
  */ 
 function _get_text($str)
 {
  return $this->format_left.$str.$this->format_right;
 }
 
 /**
   * 獲取鏈結位址
 */
 function _get_link($url,$text,$style=''){
  $style=(empty($style))?'':'class="'.$style.'"';
  if($this->is_ajax){
      //如果是使用AJAX模式
   return '<a '.$style.' href="javascript:'.$this->ajax_action_name.'(\''.$url.'\')">'.$text.'</a>';
  }else{
   return '<a '.$style.' href="'.$url.'">'.$text.'</a>';
  }
 }
 /**
   * 出錯處理方式
 */
 function error($function,$errormsg)
 {
     die('Error in file <b>'.__FILE__.'</b> ,Function <b>'.$function.'()</b> :'.$errormsg);
 }
}
?> 
