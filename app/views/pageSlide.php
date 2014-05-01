<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8" />
        <!--<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">-->

		<title><?php echo $title; ?> - LiveSlides</title>
        
		<link rel="stylesheet" type="text/css" href="/css/icons.css" />
        <link rel="icon" type="image/png" href="/img/icon.png" />
        <?php echo $localStyles; ?>

	</head>
	<body id="<?php echo $page; ?>">
    
		<?php echo $pageContent; ?>
        
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="/js/spin/spin.js"></script>
        <script type="text/javascript" src="/js/spin/jquery.spin.js"></script>
        <?php echo $localScripts; ?>

	</body>
</html>