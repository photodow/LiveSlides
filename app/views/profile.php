<?php

	if(Session::has('success')){
		$success = Session::get('success');
		Session::forget('success');
	}else{
		$success = false;
	}
	
?>


<section class="profile left">
	<?php if($success){ ?>
	<p class="success"><i class="icon-check" style="font-size: 1.25em;"></i> <?php echo $success; ?></p>
    <?php } ?>
	<header><?php
	
	// user profile data
	$userProfile = DB::select('SELECT * FROM users WHERE uid = ?', array($uid));
	
	if(!empty($userProfile)){
		$userProfile = $userProfile[0];
	}else{
		App::abort(404);
	}
	
	if($userProfile->photo === null){
		$profileImage = 'noProfileImg.png';
	}else{
		$profileImage = $userProfile->photo;	
	}
	
	$name = $userProfile->first . ' ' . $userProfile->last;
	$headline = $userProfile->headline;
	$about = $userProfile->about;
	$email = $userProfile->email;
	$website = $userProfile->website;
	$facebook = $userProfile->facebook;
	$twitter = $userProfile->twitter;
	$googleplus = $userProfile->googleplus;
	$linkedin = $userProfile->linkedin;
	
	// trims the $headline to a manageble/unified length (consider revising)
	if(strlen($headline) > 32){
		$headline = trim(substr($headline, 0, 32)) . '...';
	}
	
	// formats the $about text
	$about = preg_replace('/\n(\s*\n)+/', '</p><p>', $about);
	$about = preg_replace('/\n/', '<br>', $about);
	$about = '<p>'.$about.'</p>';
	
	
	// number of presentations
	$numPresentations = DB::select('SELECT COUNT(id) as count FROM presentations WHERE uid = ?', array($uid));
	$numPresentations = $numPresentations[0]->count;
	
	// presentations
	$presentations = DB::select('SELECT title, description, pid, keywords FROM presentations WHERE uid = ?', array($uid));
?>
    	<div class="profileImageContainer">
    		<img src="/img/userphotos/<?php echo $profileImage; ?>" alt="<?php echo $name; ?>'s Profile Image" />
        </div>
        <div class="centVert">
            <h2><?php echo $name; ?></h2>
            <p class="headline"><?php echo $headline; ?></p>
            <aside class="social">
                <ul>
                    <li><a href="mailto:<?php echo $email ?>" class="email" title="Email"><i class="icon-envelope"></i></a></li>
                    <?php if($website !== null){ ?>
                    <li><a href="<?php echo $website; ?>" class="website" title="Website"><i class="icon-globe"></i></a></li>
                    <?php } ?>
                    <?php if($facebook !== null){ ?>
                    <li><a href="https://www.facebook.com/<?php echo $facebook; ?>" class="facebook" title="Facebook"><i class="icon-facebook-square"></i></a></li>
                    <?php } ?>
                    <?php if($twitter !== null){ ?>
                    <li><a href="https://twitter.com/<?php echo $twitter; ?>" class="twitter" title="Twitter"><i class="icon-twitter"></i></a></li>
                    <?php } ?>
                    <?php if($googleplus !== null){ ?>
                    <li><a href="https://plus.google.com/<?php echo $googleplus; ?>‎" class="googleplus" title="Google Plus"><i class="icon-google-plus-square"></i></a></li>
                    <?php } ?>
                    <?php if($linkedin !== null){ ?>
                    <li><a href="https://www.linkedin.com/in/<?php echo $linkedin; ?>" class="linkedin" title="LinkedIn"><i class="icon-linkedin-square"></i></a></li>
                    <?php } ?>
                </ul>
            </aside>
        </div>
        <aside class="stats">
        	<ul>
            	<?php /*<li class="followers"><i class="icon-group"></i> <span class="num">5 Follower<span class="plural">s</span></li>*/ ?>
            	<li class="presentation"><i class="icon-youtube-play"></i> <span class="num"><?php echo $numPresentations; ?></span> Presentation<span class="plural">s</span></li>
            </ul>
        </aside>
    </header>
    <article class="about">
    	<h3>About</h3>
        <div class="body">
        	<p><?php echo $about; ?></p>
        </div>
    </article>
    <?php /*<article>
    	<h3>Featured</h3>
    	<ul class="presentations">
        	<li class="linebreak square"></li>
        	<li class="square"></li>
        	<li class="square"></li>
        	<li class="square"></li>
        </ul>
    </article>
    <article>
    	<h3>Most Viewed</h3>
    	<ul class="presentations">
        	<li class="linebreak square"></li>
        	<li class="square"></li>
        	<li class="square"></li>
        	<li class="square"></li>
        </ul>
    </article>*/ ?>
</section>

<?php echo $sidebar; ?>


<section class="profile left">
	<h2><i class="icon-youtube-play"></i> Presentations</h2>
    <article id="presentations">
        <ul>
        <?php foreach ($presentations as $presentation){ ?>
            <li>
                <a href="/slide/<?php echo $presentation->pid; ?>" title="Click here to view <?php echo $presentation->title; ?>">
                    <span class="title"><?php echo $presentation->title; ?></span>
                    <span class="description"><?php echo $presentation->description; ?></span>
                    <span class="keywords"><?php echo $presentation->keywords; ?></span>
                </a>
            </li>
        <?php } ?>
        	<li></li>
        </ul>
    </article>
</section>