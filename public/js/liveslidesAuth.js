(function(window, document, undefined){
	
	// set currentPage in database
	if(global.get('lid')){
		global.syncPages = function(pageNum){
			
			$.ajax({
				url: '/live/update?lid=' + global.get('lid'),
				method: 'POST',
				dataType: 'JSON',
				data: { newPageNum: pageNum}
			});
			
		};
	}
	
}(window, document, undefined));