<form id="registerForm" class="centVert" action="/register/process" method="POST">
    <h2 class="logo">
        <?php include("img/logo.svg"); ?>
        <sub>Register</sub>
    </h2>
	<div class="first">
		<?php if(isset($_POST['firstname'])){ ?>
        <p class="error"><i class="icon-exclamation-circle"></i> Please review your username and password for errors.</p>
        <?php } ?>
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" value="<?php if(isset($_POST['firstname'])){ echo $_POST['firstname']; } ?>" />
    </div>
	<div>
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" value="<?php if(isset($_POST['lastname'])){ echo $_POST['lastname']; } ?>" />
    </div>
	<div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" />
    </div>
	<div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" />
    </div>
	<div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" />
    </div>
	<div>
        <label for="verifypassword">Verify Password</label>
        <input type="password" name="verifypassword" id="verifypassword" />
    </div>
	<div class="last">
        <button name="submit" id="submit" class="submit">Register <i class="icon-edit"></i></button>
    </div>
    <ul class="moreinfo">
        <li>Already have an account? <a href="/login" title="Click here to login">Login</a></li>
    </ul>
</form>