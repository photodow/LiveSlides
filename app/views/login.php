<form id="loginForm" class="centVert" action="/login/process" method="POST">
    <h2 class="logo">
        <?php include("img/logo.svg"); ?>
        <sub>Login</sub>
    </h2>
	<?php if(isset($_POST['username'])){ ?>
        <p class="error"><i class="icon-exclamation-circle"></i> Please review your username and password for errors.</p>
    <?php } ?>
    <?php
		if(Session::has('passwordChange')){
			echo '<p class="success"><i class="icon-check"></i> ' . Session::get('passwordChange') . '</p>';
		}
	?>
	<p>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" <?php if(Session::has('username')){ echo ' value="' . Session::get('username') . '"'; }else{ if(isset($_POST['username'])){ echo 'value="' . $_POST['username'] . '"'; } } ?> />
    </p>
	<p>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" />
    </p>
	<p class="last">
        <button name="submit" id="submit" class="submit">Login <i class="icon-sign-in"></i></button>
    </p>
    <ul class="moreinfo">
        <li><a href="/password" title="Click here to change your password">Forgot Password?</a></li>
        <li><a href="/register" title="Click here to register for a LiveSlides account">Register</a></li>
    </ul>
</form>