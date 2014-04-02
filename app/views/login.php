<form id="loginForm" class="centVert" action="" method="POST">
    <h2 class="logo">
        <?php include("img/logo.svg"); ?>
        <sub>Login</sub>
    </h2>
	<div class="first">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" />
    </div>
	<div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" />
    </div>
	<div class="last">
        <button name="submit" id="submit" class="submit">Login <i class="fa fa-sign-in"></i></button>
    </div>
    <ul class="moreinfo">
        <li><a href="/password" title="Click here to change your password">Forgot Password?</a></li>
        <li><a href="/register" title="Click here to register for a LiveSlides account">Register</a></li>
    </ul>
</form>