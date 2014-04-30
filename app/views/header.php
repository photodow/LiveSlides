<header>
    <div>
        <div class="top">
            <h1>
                <a href="/" title="LiveSlides"><?php include("img/logo.svg"); ?></a>
            </h1>
            <nav id="mainNav">
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
            <?php } ?>
			<?php if(!Auth::check()) { ?>
            <li><a href="/#contact" title="Contact"><i class="icon-envelope"></i> Contact</a></li>
            <?php } ?>
            <?php if(Auth::check()){ ?>
        	<li><a href="/profile" class="profile" title="Click here to view your profile"><i class="icon-user"></i> Profile</a></li>
            <?php } ?>
            <?php if(Auth::check()){ ?>
        	<li><a href="/edit/profile" class="profileEdit" title="Click here to edit your profile"><i class="icon-pencil"></i> Edit Profile</a></li>
            <?php } ?>
        	<?php if(Auth::check()){ ?>
            <li><a href="/logout" title="Click here to logout"><i class="icon-sign-out"></i> Logout</a></li>
            <?php } ?>
        	<?php if(!Auth::check()){ ?>
            <li><a href="/login" title="Click here to login"><i class="icon-sign-in"></i> Login</a></li>
            <?php } ?>
        	<?php if(!Auth::check()){ ?>
            <li><a href="/register" title="Click here to register"><i class="icon-edit"></i> Register</a></li>
            <?php } ?>
                    </ul>
                </aside>
                <div id="closeMenu" class="toggleMenu"></div>
            </nav>
        </div>
        <div class="bottom">
            <div id="bgLogo"></div>
            <div id="bgNav"></div>
        </div>
    </div>
</header>