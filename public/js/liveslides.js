global = {};

(function(window, document, undefined){
	
	var slide, transition, presentation, nextPage, previousPage, currentPage;
	
	slide = {};
	transition = {};
	presentation = $('#presentation');
	currentPage = presentation.find('article.active');
	nextPage = currentPage.next();
	previousPage = currentPage.prev();
	
	
	
	
	/* ====================================
	         PRESENTATION FUNCTIONS
	   ==================================== */
	
	slide.ini = function(){
		
	};
	
	slide.sync = function(){
		
	};
	
	slide.pageGoTo = function(){
		
	};
	
	slide.pageNext = function(){
		
	};
	
	slide.pageBack = function(){
		
	};
	
	
	/* ====================================
	           TRANSITION FUNCTIONS
	   ==================================== */
	
	transition.slideFade = function(obj, type, delay, speed, easing, callback){
		
		obj = obj || $('.active');
		delay = delay || 0;
		speed = speed || 500;
		easing = easing || 'easeOutCubic';
		callback = callback || function(){};
		
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
						prepElement.top = height + 'px';
						prepAnimation.top = top;
						break;
					case 'inRight':
						prepElement.left = '-' + width + 'px';
						prepAnimation.left = left;
						break;
					case 'inDown':
						prepElement.top = '-' + height + 'px';
						prepAnimation.top = top;
						break;
					case 'inLeft':
						prepElement.left = width + 'px';
						prepAnimation.left = left + 'px';
						break;
					case 'outUp':
						prepElement.top = top;
						prepAnimation.top = '-' + height + 'px';
						break;
					case 'outRight':
						prepElement.left = left;
						prepAnimation.left = width + 'px';
						break;
					case 'outDown':
						prepElement.top = top;
						prepAnimation.top = height + 'px';
						break;
					case 'outLeft':
						prepElement.left = left;
						prepAnimation.left = '-' + width + 'px';
						break;
				}
				
			}
			
			that.css(prepElement);
		
			(function(that, prepAnimation, speed, easing, callback){
				
				global.delaySlideFade = setTimeout(function(){
					that.animate(prepAnimation, speed, easing, function(){
						callback(that);
					});
					
				}, delay);
				
			}(that, prepAnimation, speed, easing, callback));
		
		});
		
	};
	
		
	transition.slideFade(currentPage, { slide: 'inLeft' }, 2000, 3000);
	$('h1').css({ position: 'absolute', left: '100px', top: '100px' }); 
	$('li').css({ position: 'absolute' }); 
	transition.slideFade($('.active h1'), { slide: 'inUp', fade: 'in' }, 3000, 1000);
	transition.slideFade($('.active li'), { slide: 'inDown', fade: 'in' }, 2000, 500);
	transition.slideFade(currentPage, { slide: 'outLeft' }, 4000, 3000);
	transition.slideFade($('.active h1'), { slide: 'outRight', fade: 'out' }, 5000, 1000);
	transition.slideFade($('.active li'), { slide: 'outDown', fade: 'out' }, 4000, 500);
	
	
	
	
	/* ====================================
	                  EVENTS
	   ==================================== */
	
	
	
	
	slide.ini();
	
}(window, document, undefined));