<section class="profile left">
	<header><?php
	if($uid === null){
		$uid = Auth::user()->uid;
	}
	
	$userProfile = DB::select('select first, last, uid, headline, email, about from users where uid = ?', array($uid));
	
	if(!empty($userProfile)){
		$userProfile = $userProfile[0];
	}else{
		App::abort(404);
	}
	
	$userName = $userProfile->first . ' ' . $userProfile->last;
	
	$headline = $userProfile->headline;
	$headlineEdit = false;
	
	if($headline === null){
		$headline = 'Click here to add a descriptive headline!';
		$headlineEdit = true;
	}
	
	$email = $userProfile->email;
	
	$about = $userProfile->about;
	$aboutEdit = false;
	
	if($about === null){
		$about = 'Click here to write a little about yourself!';
		$aboutEdit = true;
	}
	
	$socialMedia = DB::select('select * from socialMedia where uid = ?', array($uid));
?>
    	<img src="/img/noProfileImg.png" alt="<?php echo $userName; ?>'s Profile Image" />
        <div class="centVert">
            <h2><?php echo $userName; ?></h2>
            <p class="headline<?php if($headlineEdit){ echo ' edit'; } ?>"<?php  if($headlineEdit){ echo ' data-defaultText="' . $headline . '"'; } ?>><?php echo $headline; ?></p>
            <aside class="social">
                <ul>
                    <li><a href="mailto:<?php echo $email ?>" class="email" title="Email"><i class="icon-envelope"></i></a></li>
                    <?php /*<li><a href="#" class="website" title="Website"><i class="icon-globe"></i></a></li>
                    <li><a href="https://www.facebook.com/" class="facebook" title="Facebook"><i class="icon-facebook-square"></i></a></li>
                    <li><a href="https://twitter.com/" class="twitter" title="Twitter"><i class="icon-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/‎" class="googleplus" title="Google Plus"><i class="icon-google-plus-square"></i></a></li>
                    <li><a href="https://www.linkedin.com/" class="linkedin" title="LinkedIn"><i class="icon-linkedin-square"></i></a></li>*/ ?>
                </ul>
            </aside>
        </div>
        <?php /*<aside class="stats">
        	<ul>
            	<li class="followers"><i class="icon-group"></i> <span class="num">5 Follower<span class="plural">s</span></li>
            	<li class="presentation"><i class="icon-youtube-play"></i> <span class="num">10</span> Presentation<span class="plural">s</span></li>
            </ul>
        </aside> */ ?>
    </header>
    <article class="about">
    	<h3>About</h3>
        <p<?php  if($aboutEdit){ echo ' class="edit"'; } ?><?php  if($aboutEdit){ echo ' data-defaultText="' . $about . '"'; } ?>><?php echo $about; ?></p>
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