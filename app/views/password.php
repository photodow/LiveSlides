<form id="passwordForm" class="centVert" action="" method="POST">
    <h2 class="logo">
        <?php include("img/logo.svg"); ?>
        <sub>Password</sub>
    </h2>
    <p class="first">Enter your email address, so we can send you the link to update your password.</p>
	<div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" />
    </div>
	<div class="last">
        <button name="submit" id="submit" class="submit">Send <i class="icon-envelope"></i></button>
    </div>
    <ul class="moreinfo">
        <li><a href="/login" title="Click here to login">Login</a></li>
        <li><a href="/register" title="Click here to register for a LiveSlides account">Register</a></li>
    </ul>
</form>