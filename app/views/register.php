<form id="registerForm" class="centVert" action="" method="POST">
    <h2 class="logo">
        <?php include("img/logo.svg"); ?>
        <sub>Register</sub>
    </h2>
	<div class="first">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" />
    </div>
	<div>
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" />
    </div>
	<div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" />
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
        <button name="submit" id="submit" class="submit">Register <i class="fa fa-pencil-square-o"></i></button>
    </div>
    <ul class="moreinfo">
        <li>Already have an account? <a href="/login" title="Click here to login">Login</a></li>
    </ul>
</form>