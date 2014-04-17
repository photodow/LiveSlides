<footer class="<?php echo $style; ?>">
    <div class="inner-wrapper">
    	<nav>
            <ul>
                <li><a href="/" title="Home">Home</a></li>
                <li><a href="/#contact" title="Contact">Contact</a></li>
                <?php if(!Auth::check()) { ?>
                <li><a href="/login" title="Login">Login</a></li>
                <li><a href="/register" title="Register">Register</a></li>
                <?php } else { ?>
                <li><a href="/profile" class="profile" title="Click here to view/edit your profile">Profile</a></li>
                <li><a href="/logout" title="Click here to logout">Logout</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</footer>