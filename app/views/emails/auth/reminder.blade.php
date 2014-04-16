<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
    <body style="background:#21b9da; font-family: arial; color: #343434;padding: 20px;">
        <div style="padding:20px; min-height:100px; width: 500px; border-radius:3px; margin:0 auto; background: #fff; box-shadow: 0 1px 2px rgba(0,0,0, .2);">
            <a href="http://liveslides.jamesd.me/"><img src="http://liveslides.jamesd.me/img/logo.png" style="border:none; width: 250px;" alt="LiveSlides"></a>
            <h1 style="color:#343434; font-size: 24px;margin-bottom: 20px;">Password Reset</h1>
            <p style="margin-top: 0px;font-size:14px;color: #515151;text-align: justify;margin-bottom: 5px;">To reset your password, complete this form:</p>
            <p style="margin-top: 0px;font-size:14px;color: #515151;text-align: justify;margin-bottom: 5px;"><?php echo '<a href="http://liveslides.jamesd.me/password/reset/' . $token . '">http://liveslides.jamesd.me/password/reset/' . $token . '</a>'; ?></p>
        </div>
    </body>
</html>