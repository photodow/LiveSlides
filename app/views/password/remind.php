<form id="passwordForm" class="centVert" data-header="true" action="<?php echo action('RemindersController@postRemind'); ?>" method="POST">
    <h2 class="logo">
        <?php include("img/logo.svg"); ?>
        <sub>Password</sub>
    </h2>
    <?php if(!Session::has('status')){ ?>
    <p>Enter your email address, so we can send you the link to update your password.</p>
    <?php
		if(Session::has('error')){
			echo '<p class="error"><i class="icon-exclamation-circle"></i> ' . Session::get('error') . '</p>';
		}
	?>
	<p>
        <label for="email">
        	Email
            <span>Must be a valid email address.</span>
        </label>
        <input type="text" name="email" id="email" maxlength="254" data-validate="email" />
    </p>
	<p>
        <button name="submit" id="submit" class="submit">Send <i class="icon-envelope"></i></button>
    </p>
    <?php } else {
		echo '<p class="success"><i class="icon-check"></i> ' . Session::get('status') . '</p>'; ?>
    	<p>Please check your email for the link to reset your password.</p>
	<?php } ?>
    <ul class="moreinfo">
        <li><a href="/login" title="Click here to login">Login</a></li>
        <li><a href="/register" title="Click here to register for a LiveSlides account">Register</a></li>
    </ul>
</form>