(function(window, document, undefined){
	
	// set currentPage in database
	if(global.get('lid')){
		
		syncPages(1);
		
		global.syncPages = function(pageNum){
			syncPages(pageNum);
		};
		
		function syncPages(pageNum){
			
			$.ajax({
				url: '/live/update?lid=' + global.get('lid'),
				method: 'POST',
				dataType: 'JSON',
				data: { newPageNum: pageNum}
			});
			
		}
	}
	
}(window, document, undefined));