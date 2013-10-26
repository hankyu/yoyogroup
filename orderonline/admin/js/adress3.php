<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" TYPE="text/javascript">
<!-- 
// ================= Combination Address components --- Start 
 
function SetAddressCombination(frmInput) 
{ 
	frmInput.AddressCombination.value = CombinateAddress(frmInput.Zip.value, frmInput.City.value, frmInput.Canton.value, frmInput.Village.value, frmInput.VillageOpt.value, frmInput.Block.value, frmInput.Road.value, frmInput.RoadOpt.value, frmInput.Section.value, frmInput.Alley.value, frmInput.Lane.value, frmInput.SubLane.value, frmInput.No.value, frmInput.SubNo.value, frmInput.Floor.value, frmInput.Suite.value, frmInput.Room.value, frmInput.Supplement.value); 
	 
} 
 
function CombinateAddress(PZip, PCity, PCanton, PVillage, PVillageOpt, PBlock, PRoad, PRoadOpt, PSection, PAlley, PLane, PSubLane, PNo, PSubNo, PFloor, PSuite, PRoom, PSupplement) 
{ 
var ReAddress; 
 
	if (PZip != "")  
	{ 
		ReAddress=PZip; 
	} 
 
	if (PCity !="")  
	{ 
		ReAddress=ReAddress + PCity; 
	} 
	if (PCanton != "") 
	{ 
		ReAddress=ReAddress + PCanton; 
	} 
	if (PVillage != "")  
	{ 
		ReAddress=ReAddress + PVillage + PVillageOpt; 
	} 
	if (PBlock != "")  
	{ 
		ReAddress=ReAddress + PBlock + "鄰"; 
	} 
	if (PRoad != "" )  
	{ 
		ReAddress=ReAddress + PRoad + PRoadOpt; 
	}		 
	if (PSection != "") 
 	{ 
		ReAddress=ReAddress + PSection + "段"; 
	} 
	if (PAlley != "") 
	{ 
		ReAddress=ReAddress + PAlley + "巷"; 
	}		 
	if (PLane != "" )  
	{		 
		ReAddress=ReAddress + PLane + "弄"; 
	} 
	if (PSubLane	!= "")  
	{ 
		ReAddress=ReAddress + PSubLane + "衖"; 
	} 
	if (PNo != "") 
	{  
		ReAddress=ReAddress + PNo ; 
		if (PSubNo != "")  
		{ 
			ReAddress=ReAddress + "之" + PSubNo; 
		} 
		ReAddress=ReAddress + "號"; 
	}		 
	if (PFloor != "") 
	{ 
			ReAddress=ReAddress + PFloor + "樓" ; 
	} 
	if (PSuite != "")  
	{		 
		ReAddress=ReAddress + "之" + PSuite; 
	}		 
	if (PRoom != "")  
	{ 
		ReAddress=ReAddress + "  " + PRoom + "室"; 
	} 
	if (PSupplement != "") 
	{ 
		ReAddress=ReAddress + "  " + PSupplement; 
	}			 
 
	return ReAddress; 
 
}	 
 

County = new Array("台北市", "基隆市", "台北縣", "宜蘭縣", "新竹市",  
		"新竹縣", "桃園縣", "苗栗縣", "台中市", "台中縣", "彰化縣", 
		"南投縣", "嘉義市", "嘉義縣", "雲林縣", "台南市", "台南縣", 
		"高雄市", "高雄縣", "澎湖縣", "屏東縣", "台東縣", "花蓮縣", 
		"金門縣", "連江縣"); 
 
Zone = new Array(27); 
// for "台北市" 
Zone[0] = new Array("中正區","大同區","中山區","松山區","大安區", 
	"萬華區","信義區","士林區","北投區","內湖區","南港區", 
	"文山區(木柵)","文山區(景美)"); 
// for "基隆市" 
Zone[1] = new Array("仁愛區","信義區","中正區","中山區","安樂區", 
	"暖暖區","七堵區"); 
// for "台北縣" 
Zone[2] = new Array("萬里鄉","金山鄉","板橋市","汐止市","深坑鄉","石碇鄉","瑞芳鎮", 
	"平溪鄉","雙溪鄉","貢寮鄉","新店市","坪林鄉","烏來鄉","永和市","中和市","土城市", 
	"三峽鎮","樹林市","鶯歌鎮","三重市","新莊市","泰山鄉","林口鄉","蘆洲市","五股鄉", 
	"八里鄉","淡水鎮","三芝鄉","石門鄉"); 
// for "宜蘭縣" 
Zone[3] = new Array("宜蘭市","頭城鎮","礁溪鄉","壯圍鄉","員山鄉","羅東鎮","三星鄉", 
	"大同鄉","五結鄉","冬山鄉","蘇澳鎮","南澳鄉"); 
// for "新竹市" 
Zone[4] = new Array("新竹市"); 
// for "新竹縣" 
Zone[5] = new Array("竹北市","湖口鄉","新豐鄉","新埔鄉","關西鎮","芎林鄉","寶山鄉", 
	"竹東鎮","五峰鄉","橫山鄉","尖石鄉","北埔鄉","峨嵋鄉"); 
// for "桃園縣" 
Zone[6] = new Array("中壢市","平鎮","龍潭鄉","楊梅鎮","新屋鄉","觀音鄉","桃園市", 
	"龜山鄉","八德市","大溪鎮","復興鄉","大園鄉","蘆竹鄉"); 
// for "苗栗縣" 
Zone[7] = new Array("竹南鎮","頭份鎮","三灣鄉","南庄鄉","獅潭鄉","後龍鎮","通霄鎮", 
	"苑裡鎮","苗栗市","造橋鄉","頭屋鄉","公館鄉","大湖鄉","泰安鄉","鉰鑼鄉","三義鄉", 
	"西湖鄉","卓蘭鄉"); 
// for "台中市" 
Zone[8] = new Array("中區","東區","南區","西區","北區","北屯區", 
	"西屯區","南屯區"); 
// for "台中縣" 
Zone[9] = new Array("太平市","大里市","霧峰鄉","烏日鄉","豐原市","后里鄉","石岡鄉", 
	"東勢鎮","和平鄉","新社鄉","潭子鄉","大雅鄉","神岡鄉","大肚鄉","沙鹿鎮","龍井鄉", 
	"梧棲鎮","清水鎮","大甲鎮","外圃鄉","大安鄉"); 
// for "彰化縣" 
Zone[10] = new Array("彰化市","芬園鄉","花壇鄉","秀水鄉","鹿港鎮","福興鄉","線西鄉", 
	"和美鎮","伸港鄉","員林鎮","社頭鄉","永靖鄉","埔心鄉","溪湖鎮","大村鄉","埔鹽鄉", 
	"田中鎮","北斗鎮","田尾鄉","埤頭鄉","溪州鄉","竹塘鄉","二林鎮","大城鄉","芳苑鄉", 
	"二水鄉"); 
// for "南投縣" 
Zone[11] = new Array("南投市","中寮鄉","草屯鎮","國姓鄉","埔里鎮","仁愛鄉","名間鄉", 
	"集集鄉","水里鄉","魚池鄉","信義鄉","竹山鎮","鹿谷鄉"); 
// for "嘉義市" 
Zone[12] = new Array("嘉義市"); 
// for "嘉義縣" 
Zone[13] = new Array("番路鄉","梅山鄉","竹崎鄉","阿里山鄉","中埔鄉","大埔鄉", 
"水上鄉","鹿草鄉","太保市","朴子市","東石鄉","六腳鄉","新港鄉","民雄鄉","大林鎮","漢口鄉", 
"義竹鄉","布袋鎮"); 
// for "雲林縣" 
Zone[14] = new Array("斗南市","大埤鄉","虎尾鎮","土庫鎮","褒忠鄉","東勢鄉","台西鄉", 
	"崙背鄉","麥寮鄉","斗六市","林內鄉","古坑鄉","莿桐鄉","西螺鎮","二崙鄉","北港鎮", 
	"水林鄉","口湖鄉","四湖鄉","元長鄉"); 
// for "台南市" 
Zone[15] = new Array("中區","東區","南區","西區","北區","安平區", 
	"安南區"); 
// for "台南縣" 
Zone[16] = new Array("永康市","歸仁鄉","新化鎮","左鎮鄉","玉井鄉","楠西鄉","南化鄉", 
	"仁德鄉","關廟鄉","龍崎鄉","官田鄉","麻豆鎮","佳里鎮","西港鄉","七股鄉","將軍鄉", 
	"學甲鎮","北門鄉","新營市","後壁鄉","白河鎮","東山鄉","六甲鄉","下營鄉","柳營鄉", 
	"鹽水鎮","善化鎮","大內鄉","山上鄉","新市鄉","安定鄉"); 
// for "高雄市" 
Zone[17] = new Array("新興區","前金區","苓雅區","鹽埕區","鼓山區", 
	"旗津區","前鎮區","三民區","楠梓區","小港區","左營區"); 
// for "高雄縣" 
Zone[18] = new Array("仁武鄉","大社鄉","岡山鎮","路竹鄉","阿蓮鄉","田寮鄉","燕巢鄉", 
	"橋頭鄉","梓官鄉","彌陀鄉","永安鄉","湖內鄉","鳳山市","大寮鄉","林園鄉","鳥松鄉", 
	"大樹鄉","旗山鎮","美濃鎮","六龜鄉","內門鄉","杉林鄉","甲仙鄉","桃源鄉","三民鄉", 
	"茂林鄉","茄萣鄉"); 
// for "澎湖縣" 
Zone[19] = new Array("馬公市","西嶼鄉","望安鄉","七美鄉","白沙鄉","湖西鄉"); 
// for "屏東縣" 
Zone[20] = new Array("屏東市","三地門鄉","霧台鄉","瑪家鄉","九如鄉","里港鄉","高樹鄉", 
	"鹽埔鄉","長治鄉","麟洛鄉","竹田鄉","內埔鄉","萬丹鄉","潮州鎮","泰武鄉","來義鄉", 
	"萬巒鄉","嵌頂鄉","新埤鄉","南州鄉","林邊鄉","東港鎮","琉球鄉","佳冬鄉","新園鄉", 
	"枋寮鄉", "枋山鄉","春日鄉","獅子鄉","車城鄉","牡丹鄉","恆春鎮","滿州鄉"); 
// for "台東縣" 
Zone[21] = new Array("台東市","綠島鄉","蘭嶼鄉","延平鄉","卑南鄉","鹿野鄉","關山鎮", 
	"海端鄉","池上鄉","東河鄉","成功鎮","長濱鄉","太麻里鄉","金峰鄉","大武鄉","達仁鄉"); 
// for "花蓮縣" 
Zone[22] = new Array("花蓮市","新城鄉","秀林鄉","吉安鄉","壽豐鄉","鳳林鎮","光復鄉", 
	"豐濱鄉","瑞穗鄉","萬榮鄉","玉里鎮","卓溪鄉","富里鄉"); 
// for "金門縣" 
Zone[23] = new Array("金沙鎮","金湖鎮","金寧鄉","金城鎮","烈嶼鄉","烏坵鄉"); 
// for "連江縣" 
Zone[24] = new Array("南竿鄉","北竿鄉","莒光鄉","東引"); 
 
ZipCode = new Array(27); 
// for "台北市" 
ZipCode[0] = new Array("100","103","104","105","106","108","110","111", 
	"112","114","115","116","117"); 
// for "基隆市" 
ZipCode[1] = new Array("200","201","202","203","204","205","206"); 
// for "台北縣" 
ZipCode[2] = new Array("207","208","220","221","222","223","224","226", 
	"227","228","231","232","233","234","235","236","237","238","239", 
	"241","242","243","244","247","248","249","251","252","253"); 
// for "宜蘭縣" 
ZipCode[3] = new Array("260","261","262","263","264","265","266","267", 
	"268","269","270","272"); 
// for "新竹市" 
ZipCode[4] = new Array("300"); 
// for "新竹縣" 
ZipCode[5] = new Array("302","303","304","305","306","307","308","310", 
	"311","312","313","314","315"); 
// for "桃園縣" 
ZipCode[6] = new Array("320","324","325","326","327","328","330","333", 
	"334","335","336","337","338"); 
// for "苗栗縣" 
ZipCode[7] = new Array("350","351","352","353","354","356","357", 
	"358","360","361","362","363","364","365","366","367","368","369"); 
// for "台中市" 
ZipCode[8] = new Array("400","401","402","403","404","406","407","408"); 
// for "台中縣" 
ZipCode[9] = new Array("411","412","413","414","420","421","422","423", 
	"424","426","427","428","429","432","433","434","435","436","437", 
	"438","439"); 
// for "彰化縣" 
ZipCode[10] = new Array("500","502","503","504","505","506","507","508", 
	"509","510","511","5112","513","514","515","516","520","521","522", 
	"523","524","525","526","527","528","530"); 
// for "南投縣" 
ZipCode[11] = new Array("540","541","542","544","545","546","551","552", 
	"553","555","556","557","558"); 
// for "嘉義市" 
ZipCode[12] = new Array("600"); 
// for "嘉義縣" 
ZipCode[13] = new Array("602","603","604","605","606","607","608","611", 
	"612","613","614","615","616","621","622","623","624","625"); 
// for "雲林縣" 
ZipCode[14] = new Array("630","631","632","633","634","635","636","637", 
	"638","640","643","646","647","648","649","651","652","653","654", 
	"655"); 
// for "台南市" 
ZipCode[15] = new Array("700","701","702","703","704","708","709"); 
// for "台南縣" 
ZipCode[16] = new Array("710","711","712","713","714","715","716","717", 
	"718","719","720","721","722","723","724","725","726","727","730", 
	"731","732","733","734","735","736","737","741","742","743","744", 
	"745"); 
// for "高雄市" 
ZipCode[17] = new Array("800","801","802","803","804","805","806","807", 
	"811","812","813"); 
// for "高雄縣" 
ZipCode[18] = new Array("814","815","820","821","822","823","824","825", 
	"826","827","828","829","830","831","832","833","840","842","843", 
	"844","845","846","847","848","849","851","852"); 
// for "澎湖縣" 
ZipCode[19] = new Array("880","881","882","883","884","885"); 
// for "屏東縣" 
ZipCode[20] = new Array("900","901","902","903","904","905","906","907", 
	"908","909","911","912","913","920","921","922","923","924","925", 
	"926","927","928","929","931","932","940","941","942","943","944", 
	"945","946","947"); 
// for "台東縣" 
ZipCode[21] = new Array("950","951","952","953","954","955","956","957", 
	"958","959","961","962","963","964","965","966"); 
// for "花蓮縣" 
ZipCode[22] = new Array("970","971","972","973","974","975","976","977", 
	"978","979","981","982","983"); 
// for "金門縣" 
ZipCode[23] = new Array("890","891","892","893","894","896"); 
// for "連江縣" 
ZipCode[24] = new Array("209","210","211","212"); 
 
 
function initCounty(countyInput){ 
	countyInput.length = County.length; 
	for (i = 0; i < County.length; i++) { 
		countyInput.options[i].value = County[i]; 
		countyInput.options[i].text = County[i]; 
	} 
	countyInput.selectedIndex = 0; 
} 
 
function initZone(countyInput, zoneInput, post){ 
	changeZone(countyInput, zoneInput, post); 
} 
 
function initCounty2(countyInput, countyValue){ 
 
	countyInput.length = County.length; 
	for (i = 0; i < County.length; i++) { 
		countyInput.options[i].value = County[i]; 
		countyInput.options[i].text = County[i]; 
 
		if (countyValue == County[i]) 
			countyInput.selectedIndex = i; 
	} 
} 
 
function initZone2(countyInput, zoneInput, post, zoneValue){ 
 
	selectedCountyIndex = countyInput.selectedIndex; 
 
	zoneInput.length = Zone[selectedCountyIndex].length; 
	for (i = 0; i < Zone[selectedCountyIndex].length; i++) { 
		zoneInput.options[i].value = Zone[selectedCountyIndex][i]; 
		zoneInput.options[i].text = Zone[selectedCountyIndex][i]; 
		if (zoneValue == Zone[selectedCountyIndex][i]) 
			zoneInput.selectedIndex = i;	 
	} 
 
	showZipCode(countyInput, zoneInput, post); 
} 
 
function changeZone(countyInput, zoneInput, post) { 
	selectedCountyIndex = countyInput.selectedIndex; 
 
	zoneInput.length = Zone[selectedCountyIndex].length; 
	for (i = 0; i < Zone[selectedCountyIndex].length; i++) { 
		zoneInput.options[i].value = Zone[selectedCountyIndex][i]; 
		zoneInput.options[i].text = Zone[selectedCountyIndex][i]; 
		if (zoneInput.options[i].text == post) 
			zoneInput.options[i].selected = true; 
	} 
	//zoneInput.selectedIndex = 0;	 
 
	showZipCode(countyInput, zoneInput, post); 
} 
 
function showZipCode(countyInput, zoneInput, post) { 
	post.value = ZipCode[countyInput.selectedIndex][zoneInput.selectedIndex]; 
} 
 
//==================== for zip code end ========================= 
<!-- END --> 
 
	function ResetAll()		{ 
		initCounty2(reg.City,"<?=$City?>"); 
		initZone(reg.City, reg.Town, "<?=$Town?>"); 
	} 
 
	ResetAll(); 
// --> 
</script>
