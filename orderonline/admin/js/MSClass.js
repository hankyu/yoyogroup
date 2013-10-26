<!--
/*MSClass (Class Of Marquee Scroll籵蚚祥潔剿幗雄JS猾蚾濬) Ver 1.6*\

﹛秶釬奀潔:2006-08-29 (Ver 0.5)
﹛楷票奀潔:2006-08-31 (Ver 0.8)
﹛載陔奀潔:2007-01-31 (Ver 1.6)
﹛載陔佽隴: + 樓髡夔 * 党淏﹜俇囡
	1.6.070131
		+ 輦砦扷梓諷秶婃礿麼樟哿 (蔚菴9跺統杅扢离峈-1麼氪雄怓董硉蔚ScrollSetp扢离峈-1)
		+ 瓚剿岆瘁褫眕幗雄 (囀郖苤衾珆尨郖,寀赻雄秏幗雄)
		+ 泐徹場宎趙渣昫 (旌轎竘坳幗雄腔礿砦)
		+ 蘇硉 (壺ID斛恁俋ㄛ坻統杅歙褫跦擂錶輛俴恁寁扢离)
		+ 統杅雄怓董硉 (源砃褫蚚荎恅桶尨top|bottom|left|right,妏載眻夤﹜源晞)
		* 恅趼幗雄祥袧 (掛棒載陔翋猁醴腔賤樵森Bug,覜郅笚拾統迵聆彸)
	1.4.061211
		+ 扷梓唑礿蜊曹幗雄源砃 (扷梓唑礿諷秶酘衵幗雄)
		* 蚕衾恅紫狟婥徹鞣奧絳祡鳳腔詢僅/遵僅祥袧
		* 銡擬潭恀枙 (IE﹜FF﹜Opera﹜NS﹜MYIE)
	1.2.060922
		+ 硌隅毓峓潔衁幗雄
		* 最唗覃淕
		* 蟀哿潔衁幗雄礿砦腔渣昫
	1.0.060901
		+ 砃狟﹜砃衵幗雄
		+ 羲宎脹渾奀潔
		+ 蟀哿幗雄
		* 覃淕奀潔等弇
		* 幗雄昫船
		* 呴儂侚悜遠
		* 樓俶夔
		* 最唗蚥趙
	0.8.060829
		  楹祥潔剿砃奻﹜砃酘幗雄

﹛栳尨華硊:http://www.popub.net/script/MSClass.html
﹛狟婥華硊:http://www.popub.net/script/MSClass.js

﹛茼蚚佽隴:珜醱婦漪<script type="text/javascript" src="MSClass.js"></script>
	
	斐膘妗瞰:
		//統杅眻諉董硉楊
		new Marquee("marquee")
		new Marquee("marquee","top")
		......
		new Marquee("marquee",0,1,760,52)
		new Marquee("marquee","top",1,760,52,50,5000)
		......
		new Marquee("marquee",0,1,760,104,50,5000,3000,52)
		new Marquee("marquee",null,null,760,104,null,5000,null,-1)

		//統杅雄怓董硉楊
		var marquee1 = new Marquee("marquee")	*森統杅斛恁
		marquee1.Direction = "top";	麼氪	marquee1.Direction = 0;
		marquee1.Step = 1;
		marquee1.Width = 760;
		marquee1.Height = 52;
		marquee1.Timer = 50;
		marquee1.DelayTime = 5000;
		marquee1.WaitTime = 3000;
		marquee1.ScrollStep = 52;
		marquee1.Start();

	統杅佽隴:
		ID		"marquee"	ID		(斛恁)
		Direction	(0)		幗雄源砃	(褫恁,蘇峈0砃奻幗雄) 褫扢离腔硉婦嬤:0,1,2,3,"top","bottom","left","right" (0砃奻 1砃狟 2砃酘 3砃衵)
		Step		(1)		幗雄腔祭酗	(褫恁,蘇硉峈2,杅硉埣湮,幗雄埣辦)
		Width		(760)		褫弝遵僅	(褫恁,蘇硉峈場宎扢离腔遵僅)
		Height		(52)		褫弝詢僅	(褫恁,蘇硉峈場宎扢离腔詢僅)
		Timer		(50)		隅奀		(褫恁,蘇硉峈30,杅硉埣苤,幗雄腔厒僅埣辦,1000=1鏃,膘祜祥苤衾20)
		DelayTime	(5000)		潔衁礿嗨晊喧奀潔(褫恁,蘇峈0祥礿嗨,1000=1鏃)
		WaitTime	(3000)		羲宎奀腔脹渾奀潔(褫恁,蘇麼0峈祥脹渾,1000=1鏃)
		ScrollStep	(52)		潔衁幗雄潔擒	(褫恁,蘇峈楹遵/詢僅,蜆杅硉迵晊喧歙峈0寀峈扷梓唑礿諷秶,-1輦砦扷梓諷秶)
﹛妏蚚膘祜:
		1﹜膘祜眻諉董軑腔珆尨郖腔遵僅睿詢僅ㄛ(<div id="marquee" style="width:760px;height:52px;">......</div>)
		2﹜膘祜峈氝樓欴宒overflow = autoㄛ(<div id="marquee" style="width:760px;height:52px;overflow:auto;">......</div>)
		3﹜峈賸載袧腔鳳幗雄郖腔遵僅睿詢僅ㄛ鴃褫夔蔚跪幗雄等弇眻諉董軑淏遵詢僅
		4﹜勤衾TABLE梓暮腔筵砃幗雄ㄛ剒猁勤TABLE氝樓欴宒display = inlineㄛ(<div id="marquee" style="width:760px;height:52px;overflow:auto;"><table style="display:inline">......</table></div>)
		5﹜勤衾楹幗雄麼潔衁幗雄ㄛ猁蛁砩跪幗雄等弇潔腔潔擒ㄛ肮奀剒猁勤腔褫弝詢僅睿褫弝遵僅酕疑袧腔扢离ㄛ勤衾跪幗雄等弇潔腔潔擒褫眕籵徹扢离俴潔擒麼氪等啋跡腔詢遵僅懂輛俴覃淕
		6﹜勤衾LI赻雄遙俴腔恀枙婃奀羶衄載疑腔賤樵域楊ㄛ膘祜蔚蛌遙傖桶跡(TABLE)腔倛宒懂湛善肮脹腔虴彆
		7﹜渀勤筵砃幗雄腔恅趼僇邈ㄛ彆郔藺傷岆眕諾跡" "賦旰腔ㄛ蔚諾跡" "蛌遙傖"&nbsp;"
		8﹜扷梓唑礿幗雄佷砑埭赻Flashㄛ垀眕衄珨隅腔擁癹俶ㄗ囀躺埰勍蚚芞<img>麼氪湍蟈諉腔芞<a><img></a>腔倛宒ㄛ甜剒猁輦砦赻雄遙俴ㄘ

﹛覜﹛﹛郅:
	笚拾 zhoujun#yuchengtech.com (恅趼幗雄泐俴腔bug) 2007/01/31
	赻掛最唗楷票眕懂ㄛ彶善祥屾攬衭腔蚘璃ㄛ枑堤賸竭嗣砩獗睿膘祜ㄛ覜郅湮模腔盓厥ㄐ

\***最唗秶釬/唳垀衄:殖蚗矨(333) E-Mail:zhadan007@21cn.com 厙硊:http://www.popub.net***/


function Marquee()
{
	this.ID = document.getElementById(arguments[0]);
	if(!this.ID)
	{
		alert("蠟猁扢离腔\"" + arguments[0] + "\"場宎趙渣昫\r\n潰脤梓ID扢离岆瘁淏!");
		this.ID = -1;
		return;
	}
	this.Direction = this.Width = this.Height = this.DelayTime = this.WaitTime = this.Correct = this.CTL = this.StartID = this.Stop = this.MouseOver = 0;
	this.Step = 1;
	this.Timer = 30;
	this.DirectionArray = {"top":0 , "bottom":1 , "left":2 , "right":3};
	if(typeof arguments[1] == "number" || typeof arguments[1] == "string")this.Direction = arguments[1];
	if(typeof arguments[2] == "number")this.Step = arguments[2];
	if(typeof arguments[3] == "number")this.Width = arguments[3];
	if(typeof arguments[4] == "number")this.Height = arguments[4];
	if(typeof arguments[5] == "number")this.Timer = arguments[5];
	if(typeof arguments[6] == "number")this.DelayTime = arguments[6];
	if(typeof arguments[7] == "number")this.WaitTime = arguments[7];
	if(typeof arguments[8] == "number")this.ScrollStep = arguments[8]
	this.ID.style.overflow = this.ID.style.overflowX = this.ID.style.overflowY = "hidden";
	this.ID.noWrap = true;
	this.IsNotOpera = (navigator.userAgent.toLowerCase().indexOf("opera") == -1);
	if(arguments.length >= 7)this.Start();
}


Marquee.prototype.Start = function()
{
	if(this.ID == -1)return;
	if(this.WaitTime < 800)this.WaitTime = 800;
	if(this.Timer < 20)this.Timer = 20;
	if(this.Width == 0)this.Width = parseInt(this.ID.style.width);
	if(this.Height == 0)this.Height = parseInt(this.ID.style.height);
	if(typeof this.Direction == "string")this.Direction = this.DirectionArray[this.Direction.toString().toLowerCase()];
	this.HalfWidth = Math.round(this.Width / 2);
	this.HalfHeight = Math.round(this.Height / 2);
	this.BakStep = this.Step;
	this.ID.style.width = this.Width;
	this.ID.style.height = this.Height;
	if(typeof this.ScrollStep != "number")this.ScrollStep = this.Direction > 1 ? this.Width : this.Height;
	var msobj = this;
	var timer = this.Timer;
	var delaytime = this.DelayTime;
	var waittime = this.WaitTime;
	msobj.StartID = function(){msobj.Scroll()}
	msobj.Continue = function()
				{
					if(msobj.MouseOver == 1)
					{
						setTimeout(msobj.Continue,delaytime);
					}
					else
					{	clearInterval(msobj.TimerID);
						msobj.CTL = msobj.Stop = 0;
						msobj.TimerID = setInterval(msobj.StartID,timer);
					}
				}

	msobj.Pause = function()
			{
				msobj.Stop = 1;
				clearInterval(msobj.TimerID);
				setTimeout(msobj.Continue,delaytime);
			}

	msobj.Begin = function()
		{
			msobj.ClientScroll = msobj.Direction > 1 ? msobj.ID.scrollWidth : msobj.ID.scrollHeight;
			if((msobj.Direction <= 1 && msobj.ClientScroll <= msobj.Height + msobj.Step) || (msobj.Direction > 1 && msobj.ClientScroll <= msobj.Width + msobj.Step))return;
			msobj.ID.innerHTML += msobj.ID.innerHTML;
			msobj.TimerID = setInterval(msobj.StartID,timer);
			if(msobj.ScrollStep < 0)return;
			msobj.ID.onmousemove = function(event)
						{
							if(msobj.ScrollStep == 0 && msobj.Direction > 1)
							{
								var event = event || window.event;
								if(window.event)
								{
									if(msobj.IsNotOpera)
									{
										msobj.EventLeft = event.srcElement.id == msobj.ID.id ? event.offsetX - msobj.ID.scrollLeft : event.srcElement.offsetLeft - msobj.ID.scrollLeft + event.offsetX;
									}
									else
									{
										msobj.ScrollStep = null;
										return;
									}
								}
								else
								{
									msobj.EventLeft = event.layerX - msobj.ID.scrollLeft;
								}
								msobj.Direction = msobj.EventLeft > msobj.HalfWidth ? 3 : 2;
								msobj.AbsCenter = Math.abs(msobj.HalfWidth - msobj.EventLeft);
								msobj.Step = Math.round(msobj.AbsCenter * (msobj.BakStep*2) / msobj.HalfWidth);
							}
						}
			msobj.ID.onmouseover = function()
						{
							if(msobj.ScrollStep == 0)return;
							msobj.MouseOver = 1;
							clearInterval(msobj.TimerID);
						}
			msobj.ID.onmouseout = function()
						{
							if(msobj.ScrollStep == 0)
							{
								if(msobj.Step == 0)msobj.Step = 1;
								return;
							}
							msobj.MouseOver = 0;
							if(msobj.Stop == 0)
							{
								clearInterval(msobj.TimerID);
								msobj.TimerID = setInterval(msobj.StartID,timer);
							}
						}
		}
	setTimeout(msobj.Begin,waittime);
}

Marquee.prototype.Scroll = function()
{
	switch(this.Direction)
	{
		case 0:
			this.CTL += this.Step;
			if(this.CTL >= this.ScrollStep && this.DelayTime > 0)
			{
				this.ID.scrollTop += this.ScrollStep + this.Step - this.CTL;
				this.Pause();
				return;
			}
			else
			{
				if(this.ID.scrollTop >= this.ClientScroll)
				{
					this.ID.scrollTop -= this.ClientScroll;
				}
				this.ID.scrollTop += this.Step;
			}
		break;

		case 1:
			this.CTL += this.Step;
			if(this.CTL >= this.ScrollStep && this.DelayTime > 0)
			{
				this.ID.scrollTop -= this.ScrollStep + this.Step - this.CTL;
				this.Pause();
				return;
			}
			else
			{
				if(this.ID.scrollTop <= 0)
				{
					this.ID.scrollTop += this.ClientScroll;
				}
				this.ID.scrollTop -= this.Step;
			}
		break;

		case 2:
			this.CTL += this.Step;
			if(this.CTL >= this.ScrollStep && this.DelayTime > 0)
			{
				this.ID.scrollLeft += this.ScrollStep + this.Step - this.CTL;
				this.Pause();
				return;
			}
			else
			{
				if(this.ID.scrollLeft >= this.ClientScroll)
				{
					this.ID.scrollLeft -= this.ClientScroll;
				}
				this.ID.scrollLeft += this.Step;
			}
		break;

		case 3:
			this.CTL += this.Step;
			if(this.CTL >= this.ScrollStep && this.DelayTime > 0)
			{
				this.ID.scrollLeft -= this.ScrollStep + this.Step - this.CTL;
				this.Pause();
				return;
			}
			else
			{
				if(this.ID.scrollLeft <= 0)
				{
					this.ID.scrollLeft += this.ClientScroll;
				}
				this.ID.scrollLeft -= this.Step;
			}
		break;
	}
}
//-->