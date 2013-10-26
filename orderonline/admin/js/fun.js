//Function Name：trim
//功能介紹：清除前後空白字串
//參數說明：欲清除的字串
function trim(strvalue) { 
	ptntrim = /(^\s*)|(\s*$)/g; 
	return strvalue.replace(ptntrim,""); 
} 
//Function Name：openNewWindow
//功能介紹：另開子視窗傳訊息後重新導向
//參數說明：視窗路徑、名稱及相關設定
function openNewWindow(url,msg,URLtoOpen, windowName, windowFeatures) { 
  alert(msg);
  newWindow=window.open(URLtoOpen, windowName, windowFeatures);
  location.href=url;
}
//Function Name：openMyWindow
//功能介紹：另開子視窗
//參數說明：視窗路徑、名稱及相關設定
function openMyWindow(URLtoOpen, windowName, windowFeatures) { 
  newWindow=window.open(URLtoOpen, windowName, windowFeatures);
}
//Function checkAll
//功能介紹：全反選 checkbox 物件
//參數說明：欲全反選的欄位名稱
function checkAll(str) {
	var a = document.getElementsByName(str);
	var n = a.length;
	for (var i=0; i<n; i++)
	a[i].checked = window.event.srcElement.checked;
}

//Function Name：redirectURL
//功能介紹：更新資料後重新導向網址
//參數說明：msg:跳出的訊息,url:重新導向的網頁
//返回值：alert
function redirectURL(msg,url){
    alert(msg);
	location.href=url;
}
function RedirectURLPAGE(url){
	location.href=url;
}
//
function reloadFrame(target){
	//top.frames[target].location.reload();
	//parent.frames[target].location.reload(); 
	//parent.window.location.reload();
	parent.window.frames["mainAREA"].location.reload();
	//document.parent.getElementById(target).src="../menu.php";   
	//document.frames(target).document.location="../menu.php";//
}
function reloadPage(target){
	top.frames[target].location.reload();
}
//Function Name：logoutURL
//功能介紹：閒置過久登出重新導向網址
//參數說明：msg:跳出的訊息,url:重新導向的網頁
//返回值：alert
function logoutURL(msg,url){
  alert(msg); 
  setTimeout("parent.location='"+url+"'")
}
//
function chkdel(url){
if(confirm("資料刪除後即無法回復，且其相關資料可能無法讀取，您確定要刪除？")){
	window.location.href = url;
}
}//-->
//Function Name：Check_user_id
//功能介紹：檢查輸入的帳號是否有重複
//參數說明：msg:跳出的訊息,chk:檢查輸入的帳號是否有重複
//返回值：alert
function Check_user_id(msg,chk){
  alert(msg); 
  if (chk=="failed"){
	opener.document.reg.id.value=""; 
	opener.document.reg.id.focus();
  }
  window.close();
}
//Function Name：Del_Confirm
//功能介紹：刪除資料確認檢查
//參數說明：url:刪除的程式網址,mem_no刪除資料的ID值
//返回值：alert
function Del_Confirm(url,mem_no,msg)
{
  if(confirm(msg))
		location.href=url+mem_no;
}
//Function Name：Del_Confirm
//功能介紹：刪除資料確認檢查
//參數說明：url:刪除的程式網址,mem_no刪除資料的ID值
//返回值：alert
function Point_Confirm(url,mem_no,msg)
{
  if(confirm(msg))
		location.href=url+mem_no;
		//alert(url+mem_no)
}
//Function Name：Del_Confirm
//功能介紹：刪除資料確認檢查
//參數說明：url:刪除的程式網址,mem_no刪除資料的ID值
//返回值：alert
function Filepower_Confirm(url,mem_no,msg,selObj)
{
  if(confirm(msg))
		location.href=url+mem_no+"&file_power="+selObj.options[selObj.selectedIndex].value;
		//alert(url+mem_no)
}
//Function Name：Del_Confirm
//功能介紹：刪除資料確認檢查
//參數說明：url:刪除的程式網址,mem_no刪除資料的ID值
//返回值：alert
function Reply_Confirm(url,mem_no,msg)
{
  if(confirm(msg))
  form1.submit()
		//location.href=url+mem_no;
		//alert(url+mem_no)
}
//Function Name：MM_jumpMenu
//功能介紹：跳頁選單
//參數說明：targ:開啟網頁的方式,連結頁面:restore:
//返回值：alert
//Function Name：MM_jumpMenu
//功能介紹：跳頁選單
//參數說明：targ:開啟網頁的方式,連結頁面:restore:
//返回值：alert
function MM_jumpMenuURL(targ,url,selObj,restore){ //v4.0
  eval(targ+".location='"+url+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function MM_jumpMenu(targ,url,selObj,restore){ //v3.0
  eval(targ+".location='"+url+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

//Function Name：POPupwin
//功能介紹：另開視窗配合表格大小調整置中使用
//參數說明：page：頁面 id：傳值
//返回值：無

function POPupwin(page,id) {
   var vstr, rvalue
   rvalue = window.open(page+id,"popup",'height=400,width=400,toolbar=no,scrollbars=yes,resizable=yes');
}

//Function Name：Resize_Move
//功能介紹：將開啟的視窗調整至表格欄位的大小並移至中間
//參數說明：myTable：表格的ID名稱
//返回值：w：含有表格寬度 h：含有表格高度

function Resize_Move(myTable){
var myT=document.getElementById(myTable);
w=eval(myT.width)+35; 
h=eval(myT.height)+60;
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
//alert(w);
//alert(h);
window.resizeTo(w,h);
window.moveTo(LeftPosition,TopPosition)
}

function text_chk(text){
    alert(text);
	history.back()
}  

function view_class_alert(text){
    alert(text);
	//history.back()
} 
//Function Name：fucPWDchk
//功能介紹：檢查是否含有非數字或字母
//參數說明：要檢查的字符串
//返回值：0：含有 1：全部數字或字母

/*  var ch,i,temp,check;
  var strSource ="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

  for (i=0;i<=(str.length-1);i++)
  {
  
    ch = str.charAt(i);
    temp = strSource.indexOf(ch);
    if (temp==-1) 
    {
     check = 0;
    }
  }

  if (check==0)
  {
     alert('不得輸入字母及數字以外的值。');
	 return false;
  }

  if (strSource.indexOf(ch)==-1)
  {
     alert('不得輸入字母及數字以外的值。');
	 return false;
  }
*/

//Function checkImg
//功能介紹：依圖片大小開始視窗
var imgObj;
function checkImg(theURL,winName){
  if (typeof(imgObj) == "object"){
    if ((imgObj.width != 0) && (imgObj.height != 0))
      OpenFullSizeWindow(theURL,winName, ",width=" + (imgObj.width+20) + ",height=" + (imgObj.height+30));
    else
      setTimeout("checkImg('" + theURL + "','" + winName + "')", 100)
  }
}

function OpenFullSizeWindow(theURL,winName,features) {
  var aNewWin, sBaseCmd;
  sBaseCmd = "toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,";
  if (features == null || features == ""){
    imgObj = new Image();
    imgObj.src = theURL;
    checkImg(theURL, winName)
  }
  else{
    aNewWin = window.open(theURL,winName, sBaseCmd + features);
    aNewWin.focus();
  }
}
