<header>
	<div class="top">
    	<h1>
        	<a href="/" title="LiveSlides"><?php include("img/logo.svg"); ?></a>
        </h1>
    	<nav>
        	<button class="toggleMenu" type="button">
                <i class="icon-bars"></i>
                <span>Menu</span>
            </button>
            <aside>
                <h3>Menu</h3>
                <ul>
                    <li><a href="/" title="Home"><i class="icon-home"></i> Home</a></li>
                    <?php if(!Auth::check()) { ?>
                    <li><a href="/#features" title="Features"><i class="icon-star"></i> Features</a></li>
                    <li><a href="/#about" title="About"><i class="icon-liveslides"></i> About</a></li>
                    <?php } ?>
                    <li><a href="/#contact" title="Contact"><i class="icon-envelope"></i> Contact</a></li>
                    <?php if(!Auth::check()) { ?>
                    <li><a href="/login" title="Login"><i class="icon-sign-out"></i> Login</a></li>
                    <li><a href="/register" title="Register"><i class="icon-edit"></i> Register</a></li>
                    <?php } else { ?>
                    <li><a href="/slides" class="slides" title="Click here to view your presentations"><i class="icon-play"></i> Presentations</a></li>
                    <li><a href="/create" title="Click here to create a new presentation"><i class="icon-plus"></i> New Presentation</a></li>
                    <li><a href="/profile" class="profile" title="Click here to view/edit your profile"><i class="icon-user"></i> Profile</a></li>
                    <li><a href="/logout" title="Click here to logout"><i class="icon-sign-out"></i> Logout</a></li>
                    <?php } ?>
                </ul>
            </aside>
            <div id="closeMenu" class="toggleMenu"></div>
        </nav>
    </div>
    <div class="bottom">
    	<div id="bgLogo"></div>
        <div id="bgNav">nav</div>
    </div>
</header>