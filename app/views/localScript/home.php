<script type="text/javascript" src="/js/contactform.js"></script>

<script text="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script text="text/javascript" src="/js/liveslides.js"></script>

<?php if($presenter === $useruid){ ?>
<script text="text/javascript" src="/js/liveslidesAuth.js"></script>
<?php }else{ ?>
<script text="text/javascript" src="/js/liveslidesView.js"></script>
<?php } ?>

<script>
	   
	$('a[data-scroll="true"]').on('click', function(){
		var aTag, aId;
		
		aId = $(this).attr('href').replace('/', '');
		aTag = $(aId);
    	$('html,body').animate({scrollTop: aTag.offset().top},'slow');
		
		return false;
	});
	
</script>