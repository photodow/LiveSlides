
if(typeof(global) === 'undefined'){
	var global = {};
}

(function(window, document, undefined){
	
	var slide, transition, presentation, controls, nextPage, previousPage, currentPage, numSlides, currentPageNum;
	
	slide = {};
	transition = {};
	presentation = $('#presentation');
	numSlides = presentation.find('article').length;
	
	
	
	/* ====================================
	                GLOBALS
	   ==================================== */
	   
	
	global.controls = $('#controls');
	   
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
	
	global.pageGoTo = function(page){
		
		if(Number(page) > 0 && Number(page) <= numSlides){
			
			var nextPage, reverseValue;
			
			nextPageNum = page - 1;
			nextPage = presentation.find('article').eq(nextPageNum);
			
			if(nextPageNum < currentPageNum){
				reverseValue = true;
			}else{
				reverseValue = false;	
			}
			
			transition.slideFade(
				nextPage,
				slide.getTransitionIn(nextPage),
				slide.getDelay(nextPage),
				slide.getSpeed(nextPage),
				slide.getEasing(nextPage),
				reverseValue,
				function(){
					currentPage.removeClass('active').removeAttr('style');
					nextPage.addClass('active').removeAttr('style');
					slide.setCurrentPage();
					slide.syncPages();
				}
			);
			
			transition.slideFade(
				currentPage,
				slide.getTransitionOut(currentPage),
				slide.getDelay(nextPage),
				slide.getSpeed(nextPage),
				slide.getEasing(nextPage),
				reverseValue
			);
			
		}
		
	};
	
	
	
	/* ====================================
	         PRESENTATION FUNCTIONS
	   ==================================== */
	
	slide.ini = function(){
		
		slide.setCurrentPage();
		
		if(Number(global.get('page'))){
			global.pageGoTo(Number(global.get('page')));
		}
		
	};
	
	slide.syncPages = function(){
	
		if(global.hasOwnProperty('syncPages')){
			global.syncPages(currentPageNum);
		}	
		
	};
	
	slide.updatePageViews = function(){
		// update the amount page loads for the live sessions
		// update the amount of page loads for the slide
	};
	
	slide.setCurrentPage = function(obj){
		
		currentPage = presentation.find('article.active');
		currentPageNum = currentPage.index() + 1;
		nextPage = currentPage.next();
		previousPage = currentPage.prev();
		
		var back, next;
		
		back = global.controls.find('.back');
		next = global.controls.find('.next');
		
		if(currentPageNum === numSlides){
			next.css('display', 'none');	
		}else{
			next.css('display', 'block');	
		}
		
		if(currentPageNum === 1){
			back.css('display', 'none');	
		}else{
			back.css('display', 'block');	
		}
		
	};
	
	slide.getTransitionIn = function(obj){
		
		return obj.data('in');
		
	};
	
	slide.getTransitionOut = function(obj){
		
		return obj.data('out');
		
	};
	
	slide.getDelay = function(obj){
		
		return obj.data('delay');
		
	};
	
	slide.getSpeed = function(obj){
		return obj.data('speed');
		
	};
	
	slide.getEasing = function(obj){
		
		return obj.data('easing');
		
	};
	
	slide.pageNext = function(){
		
		if(currentPageNum < numSlides){
			
			transition.slideFade(
				nextPage,
				slide.getTransitionIn(nextPage),
				slide.getDelay(nextPage),
				slide.getSpeed(nextPage),
				slide.getEasing(nextPage),
				false,
				function(){
					currentPage.removeClass('active').removeAttr('style');
					nextPage.addClass('active').removeAttr('style');
					slide.setCurrentPage();
					slide.syncPages();
				}
			);
			
			transition.slideFade(
				currentPage,
				slide.getTransitionOut(currentPage),
				slide.getDelay(nextPage),
				slide.getSpeed(nextPage),
				slide.getEasing(nextPage),
				false
			);
		}
		
	};
	
	slide.pageBack = function(){
		
		if(currentPageNum > 1){
			
			transition.slideFade(
				previousPage,
				slide.getTransitionIn(previousPage),
				slide.getDelay(previousPage),
				slide.getSpeed(previousPage),
				slide.getEasing(previousPage),
				true,
				function(){
					currentPage.removeClass('active').removeAttr('style');
					previousPage.addClass('active').removeAttr('style');
					slide.setCurrentPage();
					slide.syncPages();
				}
			);
			
			transition.slideFade(
				currentPage,
				slide.getTransitionOut(currentPage),
				slide.getDelay(previousPage),
				slide.getSpeed(previousPage),
				slide.getEasing(previousPage),
				true
			);
			
		}
		
	};
	
	
	/* ====================================
	               TRANSITIONS
	   ==================================== */
	   
	transition.wait = [];
	
	transition.status = false;
	   
	transition.slideFade = function(obj, type, delay, speed, easing, reverse, callback){
		
		obj = obj || $('.active');
		delay = delay || 0;
		speed = speed || 2000;
		easing = easing || 'easeOutCubic';
		callback = callback || function(){};
		type = type || {};
		reverse = reverse || false;
		
		var prepElement, prepAnimation, that, left, top, height, width;
		
		obj.each(function(){
			
			that = $(this);
			top = that[0].offsetTop;
			left = that[0].offsetLeft;
			height = that.closest('#presentation').height();
			width = that.closest('#presentation').width();
			
			prepElement = {
				visibility: 'visible',
				zIndex: 1
			};
			
			prepAnimation = {};
			
			if(type.hasOwnProperty('fade')){
				
				switch (type.fade) {
					case 'in':
						prepElement.opacity = 0;
						prepAnimation.opacity = 1;
						break;
					case 'out':
						prepElement.opacity = 1;
						prepAnimation.opacity = 0;
						break;
				}
				
			}
			
			if(type.hasOwnProperty('slide')){
				
				switch (type.slide) {
					case 'inUp':
						if(reverse){
							prepElement.top = '-' + height + 'px';
							prepAnimation.top = top;
						}else{
							prepElement.top = height + 'px';
							prepAnimation.top = top;
						}
						break;
					case 'inRight':
						if(reverse){
							prepElement.left = width + 'px';
							prepAnimation.left = left;
						}else{
							prepElement.left = '-' + width + 'px';
							prepAnimation.left = left;
						}
						break;
					case 'inDown':
						if(reverse){
							prepElement.top = height + 'px';
							prepAnimation.top = top;
						}else{
							prepElement.top = '-' + height + 'px';
							prepAnimation.top = top;
						}
						break;
					case 'inLeft':
						if(reverse){
							prepElement.left = '-' + width + 'px';
							prepAnimation.left = left + 'px';
						}else{
							prepElement.left = width + 'px';
							prepAnimation.left = left + 'px';
						}
						break;
					case 'outUp':
						if(reverse){
							prepElement.top = top;
							prepAnimation.top = height + 'px';
						}else{
							prepElement.top = top;
							prepAnimation.top = '-' + height + 'px';
						}
						break;
					case 'outRight':
						if(reverse){
							prepElement.left = left;
							prepAnimation.left = '-' + width + 'px';
						}else{
							prepElement.left = left;
							prepAnimation.left = width + 'px';
						}
						break;
					case 'outDown':
						if(reverse){
							prepElement.top = top;
							prepAnimation.top = '-' + height + 'px';
						}else{
							prepElement.top = top;
							prepAnimation.top = height + 'px';
						}
						break;
					case 'outLeft':
						if(reverse){
							prepElement.left = left;
							prepAnimation.left = width + 'px';
						}else{
							prepElement.left = left;
							prepAnimation.left = '-' + width + 'px';
						}
						break;
				}
				
			}
			
			that.css(prepElement);
		
			(function(that, prepAnimation, speed, easing, callback){
				
				global.delaySlideFade = setTimeout(function(){
					transition.status = true;
					transition.wait.push(that.animate(prepAnimation, speed, easing, function(){
					
						$.when.apply(null, transition.wait).done(function () {
							
							callback(that);
							transition.animations = [];
							transition.status = false;
							
						});
						
					}));
					
				}, delay);
				
			}(that, prepAnimation, speed, easing, callback));
		
		});
		
	};
	
	
	
	
	/* ====================================
	                  EVENTS
	   ==================================== */
	
	global.controls.on('click', '.next', function(){ // next slide
		if(!transition.status){
			slide.pageNext();
		}
	});
	
	global.controls.on('click', '.back', function(){ // previous slide
		if(!transition.status){
			slide.pageBack();
		}
	});
	
	
	
	slide.ini();
	
}(window, document, undefined));