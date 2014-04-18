(function(window, document, undefined){
	
	var editObjects;
	
	$('.edit').on('click', function(){
		
		var that, defaultText;
		
		that = $(this);
		
		that.attr('contenteditable', 'true').removeClass('edit').get(0).focus();
		document.execCommand('selectAll', false, null);
		
		that.on('blur', function(){
			if(that.text() === ''){
				that.text(that.data('defaulttext'));
			}
			
			if(that.text() === that.data('defaulttext')){
				that.addClass('edit');
			}
			
			// ajax call to update database
		});
	});
	
}(window, document, undefined));