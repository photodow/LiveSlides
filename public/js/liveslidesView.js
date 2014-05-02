(function(window, document, undefined){
	
	// go to current page in database every 1 second
	if(global.get('lid')){
		
		var lastPage = 1;
		
		global.databaseCheckInterval = setInterval(function(){ // check database and update slide
			
			$.ajax({
				url: '/live/get?lid=' + global.get('lid'),
				method: 'GET',
				dataType: 'JSON',
				success: function(data){
					if(data.hasOwnProperty('currentPage')){ // get current page
					
						var currentPage = data.currentPage;
						
						if(lastPage !== currentPage){ // prevent going to page every interval
							
							global.pageGoTo(currentPage); // go to page
							lastPage = currentPage; // remember current page
							
						}
						
					}else{
						clearInterval(global.databaseCheckInterval);
					}
				}
			});
			
		}, 1000); // 1 second interval
		
		
		$('#controls').remove();
	}
	
}(window, document, undefined));