<!DOCTYPE html>
<html lang="en-US">
	<head>
    	<title><?php echo $subject; ?></title>
		<meta charset="utf-8">
	</head>
	<body>
		<p>From: <a href="mailto:<?php echo $email; ?>" title="<?php echo $name; ?>,&lt;<?php echo $email; ?>&gt;"><?php echo $name; ?></a></p>
		<h2><?php echo $subject; ?></h2>
        <p><?php echo $messageBody; ?></p>
	</body>
</html>