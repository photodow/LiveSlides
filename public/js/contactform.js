(function(window, contactform, undefined){
	
	contactform.on('submit', function(e){
		
		showLoading();
		hideContactForm();
		
		data = {
			name: contactform.find('input#name').val(),
			email: contactform.find('input#email').val(),
			subject: contactform.find('input#subject').val(),
			message: contactform.find('textarea#message').val()
		};
		
		$.ajax({
			url: contactform.attr('action'),
			method: contactform.attr('method'),
			type: 'JSON',
			data: data,
			success: function(data){
				
				hideLoading();
				
				if(data.sent === 'true'){
					clearInputFields();
					showMessageSent();
				}else{
					showContactForm(true);
				}
			}
		});
		
		return false;
	});
	
	contactform.parent().on('click', '.overlayMessage.sent .newMessage', function(e){
		hideMessageSent();
		showContactForm();
		return false;
	});
	
	function clearInputFields(){
		contactform.find('input#name').val('');
		contactform.find('input#email').val('');
		contactform.find('input#subject').val('');
		contactform.find('textarea#message').val('');
	}
	
	function showLoading(){
		
		global.centVert(
			contactform
			.parent()
			.find('.overlayMessage.loading')
			.css('visibility', 'visible')
			.css('opacity', '1')
			.find('.centerVert')
		);
		contactform.parent().find('.overlayMessage.loading p').css('marginTop', '60px');
		
	}
	
	function hideLoading(){
		contactform.parent()
			.find('.overlayMessage.loading')
			.css('opacity', '0')
			.css('visibility', 'hidden')
			.find('p').css('marginTop', '0px');
	}
	
	function showMessageSent(){
		global.centVert(contactform
			.parent()
			.find('.overlayMessage.sent')
			.css('visibility', 'visible')
			.css('opacity', '1')
			.find('.centerVert'));
	}
	
	function hideMessageSent(){
		contactform.parent()
			.find('.overlayMessage.sent')
			.css('opacity', '0')
			.css('visibility', 'hidden');
	}
	
	function showContactForm(error){
		contactform.css('visibility', 'visible').css('opacity', '1');
		
		if(error){
			contactform.find('.error').css('display', 'block');
		}else{
			contactform.find('.error').css('display', 'none');
		}
	}
	
	function hideContactForm(){
		contactform.css('opacity', '0').css('visibility', 'hidden');
	}
	
}(window, $('#contactForm')));