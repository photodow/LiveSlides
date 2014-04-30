global = {};

(function(window, document, undefined){
	
	var slide, transition, presentation, nextPage, previousPage, currentPage, numSlides, currentPageNum;
	
	slide = {};
	transition = {};
	presentation = $('#presentation');
	numSlides = presentation.find('article').length;
	
	 
	
	
	/* ====================================
	         PRESENTATION FUNCTIONS
	   ==================================== */
	
	slide.ini = function(){
		
		slide.setCurrentPage();
		transition.slideFade(currentPage, slide.getTransition(currentPage, 'in'));
		
	};
	
	slide.sync = function(){
		
	};
	
	slide.setCurrentPage = function(obj){
		
		currentPage = presentation.find('article.active');
		currentPageNum = currentPage.index() + 1;
		nextPage = currentPage.next();
		previousPage = currentPage.prev();
		
	};
	
	slide.getTransition = function(obj, introExit){
		
		return obj.data(introExit);
		
	};
	
	slide.pageGoTo = function(page){
		
		if(Number(page) > 0 && Number(page) <= numSlides){
			
			var nextPage;
			
			nextPage = presentation.find('article').eq(page - 1);
			
			transition.slideFade(nextPage, slide.getTransition(nextPage, 'in'), undefined, undefined, undefined, function(){
				currentPage.removeClass('active');
				nextPage.addClass('active');
				slide.setCurrentPage();
			});
			
		}
		
	};
	
	slide.pageNext = function(){
		
		if(currentPageNum < numSlides){
			transition.slideFade(nextPage, slide.getTransition(nextPage, 'in'), undefined, undefined, undefined, function(){
				currentPage.removeClass('active');
				nextPage.addClass('active');
				slide.setCurrentPage();
			});
			transition.slideFade(currentPage, slide.getTransition(currentPage, 'out'));
		}
		
	};
	
	slide.pageBack = function(){
		
		if(currentPageNum > 1){
			transition.slideFade(previousPage, slide.getTransition(previousPage, 'in'), undefined, undefined, undefined, function(){
				currentPage.removeClass('active');
				previousPage.addClass('active');
				slide.setCurrentPage();
			});
			transition.slideFade(currentPage, slide.getTransition(currentPage, 'out'));
		}
		
	};
	
	
	/* ====================================
	           TRANSITION FUNCTIONS
	   ==================================== */
	   
	transition.slideFade = function(obj, type, delay, speed, easing, callback){
		
		obj = obj || $('.active');
		delay = delay || 0;
		speed = speed || 2000;
		easing = easing || 'easeOutCubic';
		callback = callback || function(){};
		type = type || {};
		
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
						that.removeAttr('style');
						callback(that);
					});
					
				}, delay);
				
			}(that, prepAnimation, speed, easing, callback));
		
		});
		
	};
	
	
	
	
	/* ====================================
	                  EVENTS
	   ==================================== */
	
	$('body').on('click', function(){
		slide.pageNext();
	});
	
	
	slide.ini();
	
}(window, document, undefined));