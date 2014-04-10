<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8" />

		<title><?php echo $title; ?> - LiveSlides</title>
        
		<link rel="stylesheet" type="text/css" href="/css/icons.css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="icon" type="image/png" href="/img/icon.png" />
        <?php echo $localStyles; ?>

	</head>
	<body id="<?php echo $page; ?>">
    	<?php
		// register user with email, username, and password
		// hash username before adding to database 'Hash::make(String);'
		// add new user to database
		// following code will check if user is signed in
			
			//$results = DB::select('select * from users where email = ?', array('photodow@gmail.com'));
			//print_r($results);*/
			
			
		?>
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