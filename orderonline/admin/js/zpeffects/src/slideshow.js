/**
 * Zapatec.SlideShow is a tool for creating slideshows.
 *
 * @param params [HashMap] -- array with properties.
 *		cycling [boolean] - if true, then after showing last slide slideshow
 * 			would start from the beginning.
 *		speed [int] - how much time each slide would be visible on screen(can
 *			be overrided for each slide).
 *		animSpeed [int] - animation speed(can be overrided for each slide).
 * 		effect [string] - visual effect for displaying slides(can be overrided
 *			for each slide).
 *		slides [Array] - ids or references to HTML elements.
 *		callback [function] - callback function, called during show and hide
 *        callback(bShow, intSlide)
 *        bShow - pass in boolean true if show, false if hide
 *        intSlide - currentSlide
 *		callback_endcycle [function] - callback function, called at end of cycle or start
 *        callback_endcycle(bEnd)
 *        bEnd - true if at end, false if at start
 *		display_endcycle [string] - ID of element to display at end of cycle
 */

Zapatec.SlideShow = function(params){
	this.defaultSpeed = 1000;
	this.defaultAnimSpeed = 5;
	this.defaultEffect = 'fade';
	this.cycling = false;

	// internal parameters
	this.slides = [];
	this.effects = [];
	this.animSpeeds = [];
	this.speeds = [];
	this.currentSlideNumber = -1;
	this.stopped = false;
	this.callback=null;
	this.callback_endcyle=null;
	this.display_endcyle=null;

	// analyzing parameters if given
	if(params != null){
		this.cycling = (params['cycling'] == true);

		if(params['speed'] != null && !isNaN(parseInt(params['speed']))) {
			this.defaultSpeed = parseInt(params['speed']);
		}

		if(params['animSpeed'] != null && !isNaN(parseInt(params['animSpeed']))) {
			this.defaultAnimSpeed = parseInt(params['animSpeed']);
		}

		this.defaultEffect = params['effect'] || this.defaultEffect;

		if(params['slides'] != null) {
			for(var i = 0; i < params['slides'].length; i++){
				this.addSlide(params['slides'][i]);
			}
		}

		this.callback = params['callback'] || null;
		this.callback_endcycle = params['callback_endcycle'] || null;
		this.display_endcycle = params['display_endcycle'] || null;
	}
}

/**
 * \internal hide slide that is currently visible
 */
Zapatec.SlideShow.prototype.hideCurrentSlide = function(){
	if(this.stopped){
		return;
	}

	if(this.currentSlideNumber >= 0){
	
		if (this.callback && typeof(this.callback)=='function')
			this.callback(false, this.currentSlideNumber)

		var _this = this
		Zapatec.Effects.hide(this.slides[this.currentSlideNumber], this.animSpeeds[this.currentSlideNumber], this.effects[this.currentSlideNumber], function(){_this.showNext()});
	} else {
		this.showNext();
	}
}

/**
 * \internal shows next slide
 */
Zapatec.SlideShow.prototype.showNext = function(){
	
	// Make sure end cycle display is turned off during show
	if (this.display_endcycle && typeof this.display_endcycle== 'string')
		document.getElementById(this.display_endcycle).style.display='none'

	// Make sure within range, callback could call this when state is out of sync
	if (this.currentSlideNumber >= this.slides.length || this.currentSlideNumber < 0)
		this.currentSlideNumber=-1

	if(this.currentSlideNumber >= 0) {
			this.slides[this.currentSlideNumber].style.display = 'none';
	}

	this.currentSlideNumber++;

	if(this.currentSlideNumber == this.slides.length){
		if(!this.cycling){
				if (this.callback_endcycle && typeof this.callback_endcycle == 'function')
					this.callback_endcycle(true)
				if (this.display_endcycle && typeof this.display_endcycle== 'string')
					document.getElementById(this.display_endcycle).style.display='block'
			return;
		} else {
			if (this.callback_endcycle && typeof this.callback_endcycle == 'function')
				this.callback_endcycle(false)
			this.currentSlideNumber = 0;
		}
	}

	this.slides[this.currentSlideNumber].style.display = this.slides[this.currentSlideNumber].origdisplay;

	var _this = this;
	
	if (this.callback && typeof(this.callback)=='function')
		this.callback(true, this.currentSlideNumber)

	Zapatec.Effects.show(this.slides[this.currentSlideNumber], this.animSpeeds[this.currentSlideNumber], this.effects[this.currentSlideNumber], function(){
		setTimeout(function(){_this.hideCurrentSlide()}, _this.speeds[_this.currentSlideNumber]);
	});

}

/**
 * Stops slideshow
 */
Zapatec.SlideShow.prototype.stop = function(){
	this.stopped = true;
}

/**
 * Starts slideshow
 */
Zapatec.SlideShow.prototype.start = function(){
	this.stopped = false;
	this.hideCurrentSlide();
}

/**
 * method for adding new slide to slideshow.
 *	slides [HTMLElement or string] - id or reference to HTML element.
 *	speed [int] - how much time this slide would be visible on screen.
 *	animSpeed [int] - animation speed.
 * 	effect [string] - visual effect for displaying slides.
 */
Zapatec.SlideShow.prototype.addSlide = function(params){
	var slideRef = null;

	if(typeof(params) == "string"){
		slideRef = document.getElementById(params);
	} else {
		slideRef = document.getElementById(params["elementRef"]);
	}

	if(slideRef == null){
		return;
	}

	slideRef.origdisplay = slideRef.style.display
	slideRef.style.display = 'none';

	this.slides[this.slides.length] = slideRef;
	this.effects[this.effects.length] = (params['effect'] != null ? params['effect'] : this.defaultEffect);
	this.animSpeeds[this.animSpeeds.length] = (params['animSpeed'] ? params['animSpeed'] : this.defaultAnimSpeed);
	this.speeds[this.speeds.length] = (params['speed'] ? params['speed'] : this.defaultSpeed);
}

/**
 * returns array of slides in slideshow
 */

Zapatec.SlideShow.prototype.getSlides = function(){
	return this.slides;
}
;
Zapatec.Utils.addEvent(window, 'load', Zapatec.Utils.checkActivation);
