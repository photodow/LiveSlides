<form id="passwordForm" class="centVert" action="<?php echo action('RemindersController@postReset'); ?>" method="POST">
    <h2 class="logo">
        <?php include("img/logo.svg"); ?>
        <sub>Password</sub>
    </h2>
    <p>You can fill out the form below to change your password.</p>
    <?php
    	if(Session::has('error')){
			echo '<p class="error"><i class="icon-exclamation-circle"></i> ' . Session::get('error') . '</p>';
		}
	?>
	<p<?php if(Session::has('userError')){ echo ' class="input error"'; } ?>>
        <label for="email">
        	Email
            <span><?php if(Session::has('userError')){ echo Session::get('userError'); }else{ echo 'Must be a valid email address.'; } ?></span>
        </label>
        <input type="text" name="email" id="email" maxlength="254" data-validate="email"<?php if(Session::has('email')){ echo ' value="' . Session::get('email') . '"'; } ?> />
    </p>
	<p<?php if(Session::has('passwordError')){ echo ' class="input error"'; } ?>>
        <label for="password">
        	Password
			<span><?php if(Session::has('passwordError')){ echo Session::get('passwordError'); }else{ echo 'The password must be at least 6 characters.'; } ?></span>
        </label>
        <input type="password" name="password" id="password" data-tip="<?php if($errors->has('password')){ echo $errors->first('password'); } ?>" maxlength="64" data-validate="password" />
    </p>
	<p>
        <label for="verifypassword">Verify Password</label>
        <input type="password" name="password_confirmation" id="verifypassword" maxlength="64" data-validate="verifyPassword" />
    </p>
	<p>
		<input type="hidden" name="token" value="<?php echo $token; ?>">
        <button name="Reset Password" id="submit" class="submit">Send <i class="icon-envelope"></i></button>
    </p>
    <ul class="moreinfo">
        <li><a href="/login" title="Click here to login">Login</a></li>
        <li><a href="/register" title="Click here to register for a LiveSlides account">Register</a></li>
    </ul>
</form>