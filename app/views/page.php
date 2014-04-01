<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8" />

		<title><?php echo $title; ?> - LiveSlides</title>
        
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="icon" type="image/png" href="/img/icon.png" />
        <?php echo $localStyles; ?>

	</head>
	<body id="<?php echo $page; ?>">
    
		<?php echo $header; ?>
        
        <div class="contentWrapper">
			<?php echo $pageContent; ?>
        </div>
    
		<?php echo $footer; ?>
        
        <?php echo $localScripts; ?>

	</body>
</html>