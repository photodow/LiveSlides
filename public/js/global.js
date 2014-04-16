var global = {};

(function(window, document, undefined){
	
	var app, init, validate, form, square, centVert;
	
	app = {};
	validate = {};
	form = $('form');
	square = $('.square');
	centVert = $('.centVert');
	
	
	/* ====================================
	                 GLOBALS
	   ==================================== */
	
	// center vertically
	global.centVert = function (obj) {
		'use strict';
		
		// variabls declared in this scope
		var objHeight, parentHeight, marginTop;
		
		// the object's height
		objHeight = obj.height();
		// the object's parent's height
		parentHeight = obj.parent().height();
		// half of the available space
		marginTop = ((parentHeight - objHeight) / 2);
		
		/* if half of the available space is any less than 85px
		   the header may cut the top of the object off */
		if (marginTop < 85 && obj.attr('data-header') === 'true') {
			// set the margin-top to 85px
			obj.css('marginTop', '85px');
		} else {
			// set the margin-top to half of the available space
			obj.css('marginTop', marginTop);
		}
	};
	
	
	/* ====================================
	          APPLICATION FUNCTIONS
	   ==================================== */
	   
	app.init = function () {
		
		global.centVert(centVert);
		app.square(square);
		
		$('.spin').spin({
			lines: 13,
			length: 10,
			width: 6,
			radius: 20,
			corners: 0.8,
			rotate: 37,
			trail: 54,
			speed: 0.9,
			direction: 1
		});
		
	};
	
	// perfect square
	app.square = function (obj) {
		obj.css('height', obj.width());
	};
	
	// height 100%
	app.fullHeight = function (obj) {
		var parentHeight, padding, newHeight;
		
		parentHeight = obj.parent().height();
		padding = obj.outHeight() - obj.height();
		
		obj.height(parentHeight - padding);
	}
	
	
	/* ====================================
	          VALIDATION FUNCTIONS
	   ==================================== */
	
	// cleans input value
	validate.cleanInput = function(val){
		val = val.replace(/(<([^>]+)>)/g,""); // strip HTML tags
		val = val.trim(); // strip whitespace at the beginning and end
		return val;
	};
	
	// validates a required field (makes sure it's not empty)
	validate.require = function(obj){
		var value, pGroup, spanTip, regexAlpha, length;
		
		value = validate.cleanInput(obj.val());
		obj.val(value);
		value = obj.val();
		pGroup = obj.closest('p');
		spanTip = pGroup.find('label span');
		length = value.length;
		
		if(length > 0){
			pGroup.removeClass('input error');
			spanTip.html('Looks good!');
		}else{
			// this field is required
			pGroup.addClass('input error');
			spanTip.html('This field is required');
		}
	};
	
	// validates a full name
	validate.fullName = function(obj){
		var value, pGroup, spanTip, regexAlpha, length;
		
		value = validate.cleanInput(obj.val());
		obj.val(value);
		value = obj.val();
		pGroup = obj.closest('p');
		spanTip = pGroup.find('label span');
		length = value.length;
		
		if(length > 0){
			regexAlpha = /[a-zA-Z ]*/g;
			length = value.replace(regexAlpha, '').length;
			if(length === 0){
				pGroup.removeClass('input error');
				spanTip.html('Looks good!');
			}else{
				// This field may only contain letters.
				pGroup.addClass('input error');
				spanTip.html('This field may only contain letters.');
			}
		}else{
			// this field is required
			pGroup.addClass('input error');
			spanTip.html('This field is required');
		}
	};
	
	// validates a name
	validate.name = function(obj){
		var value, pGroup, spanTip, regexAlpha, length;
		
		value = validate.cleanInput(obj.val());
		obj.val(value);
		value = obj.val();
		pGroup = obj.closest('p');
		spanTip = pGroup.find('label span');
		length = value.length;
		
		if(length > 0){
			if(length <= 32){
				regexAlpha = /[a-zA-Z]*/g;
				length = value.replace(regexAlpha, '').length;
				if(length === 0){
					pGroup.removeClass('input error');
					spanTip.html('Looks good!');
				}else{
					// This field may only contain letters.
					pGroup.addClass('input error');
					spanTip.html('This field may only contain letters.');
				}
			}else{
				// Too many characters. Max 32
				pGroup.addClass('input error');
				spanTip.html('Too many characters. Max 32');
			}
		}else{
			// this field is required
			pGroup.addClass('input error');
			spanTip.html('This field is required');
		}
	};
	
	validate.email = function(obj){
		var value, pGroup, spanTip, regexAlpha, length;
		
		value = validate.cleanInput(obj.val());
		obj.val(value.toLowerCase());
		value = obj.val();
		pGroup = obj.closest('p');
		spanTip = pGroup.find('label span');
		length = value.length;
		
		if(length > 0){
			if(length <= 254){
				regexAlpha = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/g;
				length = value.replace(regexAlpha, '').length;
				if(length === 0){
					pGroup.removeClass('input error');
					spanTip.html('Looks good!');
				}else{
					// This field may only contain letters.
					pGroup.addClass('input error');
					spanTip.html('Must be a valid email address.');
				}
			}else{
				// Too many characters. Max 254
				pGroup.addClass('input error');
				spanTip.html('Too many characters. Max 254');
			}
		}else{
			// this field is required
			pGroup.addClass('input error');
			spanTip.html('Must be a valid email address.');
		}
	};
	
	validate.username = function(obj){
		var value, pGroup, spanTip, regexAlpha, length;
		
		value = validate.cleanInput(obj.val());
		obj.val(value.toLowerCase());
		value = obj.val();
		pGroup = obj.closest('p');
		spanTip = pGroup.find('label span');
		length = value.length;
		
		if(length > 0){
			if(length <= 32){
				regexAlpha = /[\w-]*/g;
				length = value.replace(regexAlpha, '').length;
				if(length === 0){
					pGroup.removeClass('input error');
					spanTip.html('Looks good!');
				}else{
					// This field may only contain letters.
					pGroup.addClass('input error');
					spanTip.html('This field may only contain letters, numbers, and dashes.');
				}
			}else{
				// Too many characters. Max 32
				pGroup.addClass('input error');
				spanTip.html('Too many characters. Max 32');
			}
		}else{
			// this field is required
			pGroup.addClass('input error');
			spanTip.html('This field may only contain letters, numbers, and dashes.');
		}
	};
	
	validate.password = function(obj){
		var value, pGroup, spanTip, length;
		
		value = validate.cleanInput(obj.val());
		obj.val(value);
		value = obj.val();
		pGroup = obj.closest('p');
		spanTip = pGroup.find('label span');
		length = value.length;
		
		if(length >= 6){
			if(length <= 64){
					pGroup.removeClass('input error');
					spanTip.html('Looks good!');
			}else{
				// Too many characters. Max 64
				pGroup.addClass('input error');
				spanTip.html('Too many characters. Max 64');
			}
		}else{
			// this field is required
			pGroup.addClass('input error');
			spanTip.html('The password must be at least 6 characters.');
		}
	};
	
	validate.verifyPassword = function(obj){
		var value, pGroup, spanTip, passwordInput, passwordVal, passwordpGroup, length;
		
		value = obj.val();
		pGroup = obj.closest('p');
		passwordpGroup = pGroup.prev();
		passwordInput = passwordpGroup.find('input');
		passwordVal = passwordInput.val();
		spanTip = passwordpGroup.find('label span');
		length = value.length;
		
		if(value === passwordVal && length > 0){
				passwordpGroup.removeClass('input error');
				pGroup.removeClass('input error');
				spanTip.html('Looks good!');
				validate.password(passwordInput);
		}else{
			// this field is required
			passwordpGroup.addClass('input error');
			pGroup.addClass('input error');
			spanTip.html('The password and verifypassword must match.');
		}
	};
	
	
	/* ====================================
	                 EVENTS
	   ==================================== */
	
	form.on('focus', 'input, textarea', function(){
		$(this).closest('p').find('label span').css('display', 'block');
	});
	
	form.on('blur', 'input, textarea', function(){
		var that, validateType, thatVal;
		
		that = $(this);
		that.closest('p').find('label span').css('display', 'none');
		validateType = that.data('validate');
		
		if(validateType === 'name'){
			validate.name(that);
		}else if(validateType === 'email'){
			validate.email(that);
		}else if(validateType === 'username'){
			validate.username(that);
		}else if(validateType === 'password'){
			validate.password(that);
		}else if(validateType === 'verifyPassword'){
			validate.verifyPassword(that);
		}else if(validateType === 'require'){
			validate.require(that);	
		}else if(validateType === 'fullName'){
			validate.fullName(that);	
		}
	});
	
	window.onresize = function(){
		global.centVert(centVert);
		app.square(square);
	};
	
	app.init();
	
}(window, document, undefined));