(function(window, document, undefined){
	
	/*var editObjects;
	
	$('.edit').on('click', function(){
		
		var that, defaultText, beforeEdit;
		
		that = $(this);
		beforeEdit = that.html();
		that.attr('contenteditable', 'true').removeClass('edit empty').get(0).focus();
		
		that.on('blur', function(){
			var isEmpty, isDefault, isBeforeEdit;
			
			isEmpty = that.text().trim() === '';
			isDefault = that.html().trim() === that.data('defaulttext');
			isBeforeEdit = that.html() === beforeEdit;
			
			if(isEmpty){
				that.html(that.data('defaulttext'));
			}
			
			if(isEmpty || isDefault){
				that.addClass('edit');
				that.remove
			}
			
			if(!isEmpty && !isDefault && !isBeforeEdit){
				$.ajax({
					url: '/update/profile',
					method: 'POST',
					dataType: 'JSON',
					data: {
						updateThis: that.data('section'),
						withThis: that.text().trim()	
					},
					success: function(data){
						console.log(data.response);
						
						// replace default text
						that.data('defaulttext', that.html());
					},
					error: function(e){
						console.log(e.responseJSON.error.message);	
					}
				});
			}
			
			that.off('blur');
		});
	});*/
	
}(window, document, undefined));