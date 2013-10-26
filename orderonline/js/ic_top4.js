var isDOM = (document.getElementById ? true : false); 
var isIE4 = ((document.all && !isDOM) ? true : false);
var isNS4 = (document.layers ? true : false);
var isNS = navigator.appName == "Netscape";

function getRef(id) {
	if (isDOM) return document.getElementById(id);
	if (isIE4) return document.all[id];
	if (isNS4) return document.layers[id];
}

function getSty(id) {
	x = getRef(id);
	return (isNS4 ? getRef(id) : getRef(id).style);
}

var scrollerHeight = 256;
var puaseBetweenImages = 1000;
var imageIdx = 0;


function moveRightEdge() {
	var yMenuFrom, yMenuTo, yOffset, timeoutNextCheck;

	if (isNS4) {
		yMenuFrom   = DivTop.top;
		yMenuTo     = windows.pageYOffset;   //  ġ
	} else if (isDOM) {
		yMenuFrom   = parseInt (DivTop.style.top, 10);
		yMenuTo     = (isNS ? window.pageYOffset : document.body.scrollTop + 500); // ZW
	}
	timeoutNextCheck = 500;

	if (yMenuFrom != yMenuTo) {
		yOffset = Math.ceil(Math.abs(yMenuTo - yMenuFrom) / 20);// ưʪt??
		if (yMenuTo < yMenuFrom)
			yOffset = -yOffset;
		if (isNS4)
			DivTop.top += yOffset;
		else if (isDOM)
			DivTop.style.top = parseInt (DivTop.style.top, 10) + yOffset;
			timeoutNextCheck = 10;// ưʪt
	}
	setTimeout ("moveRightEdge()", timeoutNextCheck);
	//alert(marginY);
}



if (isNS4) {
	var DivTop = document["DivTop"];
	DivTop.top = top.pageYOffset;
	DivTop.visibility = "visible";
	
	moveRightEdge();
} else if (isDOM) {
	var DivTop = getRef('DivTop');
	DivTop.style.top = (isNS ? window.pageYOffset : document.body.scrollTop);
	DivTop.style.visibility = "visible";
	moveRightEdge();
}