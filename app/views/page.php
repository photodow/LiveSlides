<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8" />

		<title><?php echo $title; ?> - LiveSlides</title>
		
        <?php echo $style; ?>
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body id="<?php echo $page; ?>">
    
		<?php echo $header; ?>
        
        <div class="contentWrapper">
			<?php echo $pageContent; ?>
        </div>
    
		<?php echo $footer; ?>

	</body>
</html>