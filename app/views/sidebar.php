<?php

	if(Auth::check()){
		$authName = Auth::user()->first . ' ' . Auth::user()->last;
	}
	
	if(Auth::user()->photo === null){
		$profileImage = 'noProfileImg.png';
	}else{
		$profileImage = Auth::user()->photo;	
	}
	
?>

<aside class="sidebar right">
	<?php if(Auth::check()){ ?>
	<div class="user">
    	<div class="profileImageContainer">
    		<img src="/img/userphotos/<?php echo $profileImage; ?>" alt="<?php echo $authName; ?>'s Profile Image" />
        </div>
		<h2><?php echo $authName; ?></h2>
    </div>
    <?php } ?>
	<nav>
    	<ul>
            <li><a href="/" title="Home"><i class="icon-home"></i> Home</a></li>
			<?php if(!Auth::check()) { ?>
            <li><a href="/#features" title="Features"><i class="icon-star"></i> Features</a></li>
            <?php } ?>
            <?php if(!Auth::check()){ ?>
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
    </nav>
</aside>