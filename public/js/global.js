var global = {};

(function(window, document, undefined){
	
	var app, init, validate, body, form, square, centVert, header;
	
	app = {};
	validate = {};
	body = $('body');
	form = $('form');
	square = $('.square');
	centVert = $('.centVert');
	header = $('body > header');
	
	
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
	   
	global.get = function (parameter) {
	
		var queryString, regex, variableString, value;
	
		queryString = document.location.search;
		regex = new RegExp("(" + parameter + "=){1}(.(?!\&))*(.(?=\&))?");
	
		if (regex.test(queryString)) {
			variableString = regex.exec(queryString);
			value = decodeURIComponent(variableString[0].substr(parameter.length + 1));
		} else {
			value = false;
		}
	
		return value;
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
		
		app.focusInput();
		
		clearTimeout(global.scrolling);
		global.scrolling = setTimeout(function(){
			app.scrollStop();
		}, 1500);
		
	};
	
	// perfect square
	app.openMenu = function () {
			
		var navTray, navTrayWidth, closeMenuBG;
		
		navTray = body.find('header nav aside');
		closeMenuBG = body.find('#closeMenu');
		navTrayWidth = '-' + navTray.width() + 'px';
		
		closeMenuBG.show();
		header.children('div').animate({ marginLeft: navTrayWidth }, function(){
			$(this).removeAttr('style');
		});
		body.css({ position: 'absolute', width: '100%' }).animate({ left: navTrayWidth }, function(){
			$(this).addClass('menuOpen').removeAttr('style');	
		});
		navTray.css({ display: 'block', right: navTrayWidth }).animate({ right: 0 }, function(){
			$(this).addClass('active').removeAttr('style');
		});
		
	};
	
	app.closeMenu = function () {
			
		var navTray, navTrayWidth, closeMenuBG;
		
		navTray = body.find('header nav aside');
		closeMenuBG = body.find('#closeMenu');
		navTrayWidth = '-' + navTray.width() + 'px';
		
		closeMenuBG.hide();
		header.children('div').css('marginLeft', navTrayWidth).animate({ marginLeft: 0 }, function(){
			$(this).removeAttr('style');
		});
		body.css({ position: 'absolute', width: '100%', left: navTrayWidth }).removeClass('menuOpen').animate({ left: 0 }, function(){
			$(this).removeAttr('style');	
		});
		navTray.css({ display: 'block', right: 0 }).removeClass('active').animate({ right: navTrayWidth }, function(){
			$(this).removeAttr('style');
		});
		
		clearTimeout(global.scrolling);
		global.scrolling = setTimeout(function(){
			app.scrollStop();
		}, 1500);
		
	};
	
	global.menuStatus = false;
	app.toggleMenu = function () {
		if(body.hasClass('menuOpen')){
			app.closeMenu();
			global.menuStatus = false;
		}else{
			app.openMenu();
			global.menuStatus = true;
		}
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
	
	// focus on first input element on these pages
	app.focusInput = function (){
		var page = $('body').attr('id');
		
		switch (page) {
			case 'register':
			case 'login':
			case 'password':
			$('input').eq(0).focus();
		}
		
		$('.error.input').eq(0).find('input').focus();
	};
	
	app.headerHide = function(){
		var top, viewTop, headerHeight;
		
		top = header.css('top');
		viewTop = $(document).scrollTop();
		headerHeight = header.height();
		
		if(top === '0px' && viewTop > headerHeight){
			header.animate({ top: '-' + headerHeight + 'px' });
		}
	}
	
	app.headerShow = function(){
		var top, viewTop, headerHeight;
		
		top = header.css('top');
		viewTop = $(document).scrollTop();
		headerHeight = header.height();
		
		if(top === ('-' + headerHeight + 'px')){
			header.animate({ top: '0px' });
		}
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
	
	validate.url = function(obj){
		
		var url, regex, group, span;
		
		url = validate.cleanInput(obj.val());
		obj.val(url);
		regex = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/g;
		group = obj.closest('p');
		span = group.find('label span');
		
		if(url.length !== 0){
			if(url.length <= 254){
				if(url.replace(regex, '').length === 0){
					group.removeClass('input error');
					span.html('Looks good!');
				}else{
					group.addClass('input error');
					span.html('This is not a valid URL.');
				}
			}else{
				group.addClass('input error');
				span.html('Too many characters. Max 254');
			}
		}else{
			group.removeClass('input error');
			span.html('Please provide a valid URL.');
		}
			
	};
	
	validate.headline = function(obj) {
		
		var val, group, span;
		
		val = validate.cleanInput(obj.val());
		obj.val(val);
		group = obj.closest('p');
		span = group.find('label span');
		
		if(val.length !== 0){
			if(val.length <= 64){
				group.removeClass('input error');
				span.html('Looks good!');
			}else{
				group.addClass('input error');
				span.html('Too many characters. Max 64');
			}
		}else{
			group.removeClass('input error');
			span.html('Please add a short descriptive headline about yourself.');
		}
		
	};
	
	validate.about = function(obj) {
		
		var val, group, span;
		
		val = validate.cleanInput(obj.val());
		obj.val(val);
		group = obj.closest('p');
		span = group.find('label span');
		
		if(val.length !== 0){
			group.removeClass('input error');
			span.html('Looks good!');
		}else{
			group.removeClass('input error');
			span.html('Please tell us a little about yourself.');
		}
		
	};
	
	validate.socialAccounts = function(obj) {
		
		var val, group, span;
		
		val = validate.cleanInput(obj.val());
		val = val.replace(/[ ]/g, '');
		obj.val(val);
		group = obj.closest('p');
		span = group.find('label span');
		
		if(val.length !== 0){
			if(val.length <= 64){
				group.removeClass('input error');
				span.html('Looks good!');
			}else{
				group.addClass('input error');
				span.html('Too many characters. Max 64');
			}
		}else{
			group.removeClass('input error');
			span.html('Please add your account.');
		}
		
	};
	
	
	/* ====================================
	                 EVENTS
	   ==================================== */
	   
	$('.toggleMenu, #mainNav a').on('click', function(){
		app.toggleMenu();
	});
	
	global.scrollingStatus = false;
	app.scrollStart = function(){
		if(global.scrollingStatus === false){
			app.headerShow();
			global.scrollingStatus = true;
		}
	};
	
	app.scrollStop = function(){
		app.headerHide();
		global.scrollingStatus = false;
	}
	
	global.headerMouseOverStatus = false;
	$(document).on('mousemove', function(e){
		if(e.clientY < header.height()){
			app.scrollStart();
			global.headerMouseOverStatus = true;
			clearTimeout(global.scrolling);
		}else{
			clearTimeout(global.scrolling);
			global.scrolling = setTimeout(function(){
				if(!global.menuStatus){
					app.scrollStop();
				}
			}, 1500);
			global.headerMouseOverStatus = false;
		}
	});
	
	$(document).on('scroll', function(){
		app.scrollStart();
		clearTimeout(global.scrolling);
		if(!global.headerMouseOverStatus){
			global.scrolling = setTimeout(function(){
				if(!global.menuStatus){
					app.scrollStop();
				}
			}, 1500);
		}
	});
	
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
		}else if(validateType === 'url'){
			validate.url(that);	
		}else if(validateType === 'headline'){
			validate.headline(that);	
		}else if(validateType === 'about'){
			validate.about(that);	
		}else if(validateType === 'socialAccounts'){
			validate.socialAccounts(that);	
		}
	});
	
	window.onresize = function(){
		global.centVert(centVert);
		app.square(square);
	};
	
	app.init();
	
}(window, document, undefined));