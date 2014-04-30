<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

		<title><?php echo $title; ?> - LiveSlides</title>
        
		<link rel="stylesheet" type="text/css" href="/css/icons.css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="icon" type="image/png" href="/img/icon.png" />
        <?php echo $localStyles; ?>
        
        <script>
		
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-28030649-2', 'jamesd.me');
		  ga('send', 'pageview');
		
		</script>

	</head>
	<body id="<?php echo $page; ?>">
		<?php echo $header; ?>
        
        <div class="contentWrapper">
			<?php echo $pageContent; ?>
        </div>
    
		<?php echo $footer; ?>
        
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="/js/spin/spin.js"></script>
        <script type="text/javascript" src="/js/spin/jquery.spin.js"></script>
        <script type="text/javascript" src="/js/global.js"></script>
        <?php echo $localScripts; ?>

	</body>
</html>