<form id="registerForm" class="centVert" action="/register/process" method="POST">
    <h2 class="logo">
        <?php include("img/logo.svg"); ?>
        <sub>Register</sub>
    </h2>
	<p<?php if($errors->has('firstname')){ echo ' class="input error"'; } ?>>
        <label for="firstname">
        	First Name
			<span><?php if($errors->has('firstname')){ echo $errors->first('firstname'); }else{ echo 'This field is required.'; } ?></span>
        </label>
        <input type="text" name="firstname" id="firstname" value="<?php if(isset($_POST['firstname'])){ echo $_POST['firstname']; } ?>" maxlength="32" data-validate="name" />
    </p>
	<p<?php if($errors->has('lastname')){ echo ' class="input error"'; } ?>>
        <label for="lastname">
        	Last Name
			<span><?php if($errors->has('lastname')){ echo $errors->first('lastname'); }else{ echo 'This field is required.'; } ?></span>
        </label>
        <input type="text" name="lastname" id="lastname" value="<?php if(isset($_POST['lastname'])){ echo $_POST['lastname']; } ?>" maxlength="32" data-validate="name" />
    </p>
	<p<?php if($errors->has('email')){ echo ' class="input error"'; } ?>>
        <label for="email">
        	Email
			<span><?php if($errors->has('email')){ echo $errors->first('email'); }else{ echo 'Must be a valid email address.'; } ?></span>
        </label>
        <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" maxlength="254" data-validate="email" />
    </p>
	<p<?php if($errors->has('username')){ echo ' class="input error"'; } ?>>
        <label for="username">
        	Username
			<span><?php if($errors->has('username')){ echo $errors->first('username'); }else{ echo 'This field may only contain letters, numbers, and dashes.'; } ?></span>
        </label>
        <input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" maxlength="32" data-validate="username" />
    </p>
	<p<?php if($errors->has('password')){ echo ' class="input error"'; } ?>>
        <label for="password">
        	Password
			<span><?php if($errors->has('password')){ echo $errors->first('password'); }else{ echo 'The password must be at least 6 characters.'; } ?></span>
        </label>
        <input type="password" name="password" id="password" data-tip="<?php if($errors->has('password')){ echo $errors->first('password'); } ?>" maxlength="64" data-validate="password" />
    </p>
	<p<?php if($errors->has('password')){ echo ' class="input error"'; } ?>>
        <label for="verifypassword">Verify Password</label>
        <input type="password" name="verifypassword" id="verifypassword" maxlength="64" data-validate="verifyPassword" />
    </p>
	<p>
        <button name="submit" id="submit" class="submit">Register <i class="icon-edit"></i></button>
    </p>
    <ul class="moreinfo">
        <li>Already have an account? <a href="/login" title="Click here to login">Login</a></li>
    </ul>
</form>