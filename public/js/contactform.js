(function(window, contactform, undefined){
	
	contactform.on('submit', function(e){
		
		global.centVert(
			contactform
			.parent()
			.find('.overlayMessage')
			.css('display', 'block')
			.css('opacity', '1')
			.find('.centVert')
		);
		contactform.css('opacity', '0');
		
		data = {
			name: contactform.find('input#name').val(),
			email: contactform.find('input#email').val(),
			subject: contactform.find('input#subject').val(),
			message: contactform.find('textarea#message').val()
		};
		
		console.log(data);
		
		$.ajax({
			url: contactform.attr('action'),
			method: contactform.attr('method'),
			type: 'JSON',
			data: data,
			success: function(sent){
				console.log(sent);
			},
			error: function(e){
				console.log(e);
			}
		});
		
		return false;
	});
	
}(window, $('#contactForm')));