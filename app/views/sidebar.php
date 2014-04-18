<aside class="sidebar right">
	<div class="user">
    	<img src="/img/noProfileImg.png" alt="The User's Profile Image" />
		<h2><?php echo Auth::user()->first . ' ' . Auth::user()->last; ?></h2>
    </div>
	<nav>
    	<ul>
        	<?php /*<li><a href="/slides" class="slides" title="Click here to view your presentations"><i class="icon-play"></i> Presentations</a></li>
        	<li><a href="/create" title="Click here to create a new presentation"><i class="icon-plus"></i> New Presentation</a></li>*/ ?>
        	<li><a href="/profile" class="profile" title="Click here to view/edit your profile"><i class="icon-user"></i> Profile</a></li>
        	<li><a href="/logout" title="Click here to logout"><i class="icon-sign-out"></i> Logout</a></li>
        </ul>
    </nav>
</aside>