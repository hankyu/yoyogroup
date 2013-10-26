/**
 * Zapatec.Hoverer is a tool for creating simple presentations.
 * If you mouseover anchor - depending target element would be showed using 
 *   given effect.
 *
 * @param params [HashMap] -- array with properties.
 * 		effect [String] - effect to use for showing targets("fade" by default)
 *		animSpeed [int] - animation speed(5 by default)
 */

Zapatec.Hoverer = function(params){
	this.hoverMark = 0;
	this.storage = {};
	this.currentlyShowing = null;
	this.effect = 'fade';
	this.animSpeed = 5;

	if(params != null){
		this.effect = params['effect'] || this.effect;
		this.animSpeed = params['animSpeed'] || this.animSpeed;
	}
}

/**
 * \internal triggers when user mouseoser anchor.
 * @param anchorRef [HTMLElement] - link to anchor HTML element.
 */
Zapatec.Hoverer.prototype.show = function(anchorRef){
    // do nothing if element to show is element that is visible now 
    //     or if this anchor is not found in storage.
	if(
		anchorRef == this.currentlyShowing || 
		anchorRef == null ||
		this.storage[anchorRef.__zp_hovermark] == null
	){
		return;
	}

	if(this.currentlyShowing != null){
		// hide previous element
		this.storage[this.currentlyShowing.__zp_hovermark].origdisplay = 
			this.storage[this.currentlyShowing.__zp_hovermark].style.display

		this.storage[this.currentlyShowing.__zp_hovermark].style.display 
			= 'none';
	}

	this.currentlyShowing = anchorRef;

	this.storage[this.currentlyShowing.__zp_hovermark].style.display = this.storage[this.currentlyShowing.__zp_hovermark].origdisplay;
	
	// show new element
	Zapatec.Effects.show(this.storage[this.currentlyShowing.__zp_hovermark], this.animSpeed, this.effect);
}

/**
 * use this method to add elements to current Hoverer object
 *
 * @param params [HashMap] -- array with properties.
 *		anchorRef [HTMLElement or string] - link to anchor element
 *		targetRef [HTMLElement or string] - link to target element
 *		isDefault [boolean] - if true - this elements wouldn't be hided on page load
 */
Zapatec.Hoverer.prototype.addElement = function(params){
    var anchorRef = params['anchorRef'];

	if(typeof(anchorRef) == 'string'){
		anchorRef = document.getElementById(anchorRef);
	}

	if(anchorRef == null || this.storage[anchorRef.__zp_hovermark] != null){
		return;
	}

    var targetRef = params['targetRef'];

	if(typeof(targetRef) == 'string'){
		targetRef = document.getElementById(targetRef);
	}

	if(targetRef == null){
		return;
	}

	anchorRef.__zp_hovermark = this.hoverMark++;
	this.storage[anchorRef.__zp_hovermark] = targetRef;

	targetRef.origdisplay = anchorRef.style.display;

	if(this.currentlyShowing == null || params['isDefault'] == true){
		if(this.currentlyShowing != null){
			this.storage[this.currentlyShowing.__zp_hovermark].style.display = 'none';
		}

		this.currentlyShowing = anchorRef;
	} else {
		targetRef.style.display = 'none';
	}

	var _this = this;

	anchorRef.onmouseout = function(){
		if(this.running){
			this.origbackground = this.origbackgroundcolor;
		} else {
			this.style.backgroundColor = this.origbackgroundcolor;
			Zapatec.Effects.hide(this, 10, 'highlight');
		}
	};

	anchorRef.onmouseover = function(){
		if(!this.running){
			this.origbackgroundcolor = this.style.backgroundColor;
			this.style.backgroundColor = "#FFFF69";
        } else {
			this.origbackground = "#FFFF69";
        }

		_this.show(this)
	};
};
Zapatec.Utils.addEvent(window, 'load', Zapatec.Utils.checkActivation);
