<?php
	
	if(Session::has('error')){
		$error = Session::get('error');
		Session::forget('error');
	}else{
		$error = Validator::make(array(), array())->messages();
	}
	
	if(Session::has('post')){
		$post = Session::get('post');
		Session::forget('post');
	}else{
		$post = $_POST;
	}
	
	$uid = Auth::user()->uid;
	$firstname = Auth::user()->first;
	$lastname = Auth::user()->last;
	$headline = Auth::user()->headline;
	$email = Auth::user()->email;
	$website = Auth::user()->website;
	$facebook = Auth::user()->facebook;
	$twitter = Auth::user()->twitter;
	$googleplus = Auth::user()->googleplus;
	$linkedin = Auth::user()->linkedin;
	$about = Auth::user()->about;
	
	// number of presentations
	$numPresentations = DB::select('SELECT COUNT(id) as count FROM presentations WHERE uid = ?', array($uid));
	$numPresentations = $numPresentations[0]->count;
	
?>

<section class="profileEdit left">
    <h2><i class="icon-pencil"></i> Edit Profile</h2>
    <form action="/edit/profile/process" method="POST">
    	<fieldset>
        	<legend><i class="icon-user"></i> Describe Yourself</legend>
            <p<?php if($error->has('headline')){ echo ' class="input error"'; } ?>>
                <label for="headline">
                    Headline
                    <span style="left: 228px;">
						<?php if($error->has('headline')){ echo $error->first('headline'); }else if($headline === null){ ?>
                        Please add a short descriptive headline about yourself.
                        <?php }else{ ?>
                        Looks good!
                        <?php } ?>
                    </span>
                </label>
                <input type="text" name="headline" id="headline" value="<?php if(!empty($post['headline'])){ echo $post['headline']; }else{ echo $headline; } ?>" maxlength="64" data-validate="headline">
            </p>
            <p<?php if($error->has('about')){ echo ' class="input error"'; } ?>>
                <label for="about">
                    About
                    <span style="left: 599px;">
						<?php if($error->has('about')){ echo $error->first('about'); }else if($about === null){ ?>
                        Please tell us a little about yourself.
                        <?php }else{ ?>
                        Looks good!
                        <?php } ?>
                    </span>
                </label>
                <textarea id="about" class="about" name="about" data-validate="about"><?php if(!empty($post['about'])){ echo $post['about']; }else{ echo $about; } ?></textarea>
            </p>
        </fieldset>
    	<fieldset>
        	<legend><i class="icon-envelope"></i> Contact Information</legend>
            <p<?php if($error->has('email')){ echo ' class="input error"'; } ?>>
                <label for="email">
                    Email
                    <span style="left: 228px;">
                    <?php if($error->has('email')){ echo $error->first('email'); }else{ ?>
                    Looks Good!
                    <?php } ?>
                    </span>
                </label>
                <input type="text" name="email" id="email" value="<?php if(!empty($post['email'])){ echo $post['email']; }else{ echo $email; } ?>" maxlength="254" data-validate="email">
            </p>
            <p<?php if($error->has('website')){ echo ' class="input error"'; } ?>>
                <label for="website">
                    Website
                    <span style="left: 228px;">
						<?php if($error->has('website')){ echo $error->first('website'); }else if($website === null){ ?>
                        Please provide a valid URL.
                        <?php }else{ ?>
                        Looks Good!
                        <?php } ?>
                    </span>
                </label>
                <input type="text" name="website" id="website" value="<?php if(!empty($post['website'])){ echo $post['website']; }else{ echo $website; } ?>" maxlength="254" data-validate="url">
            </p>
        </fieldset>
    	<fieldset>
        	<legend><i class="icon-comments"></i> Social Networks</legend>
            <p<?php if($error->has('facebook')){ echo ' class="input error"'; } ?>>
                <label for="facebook">
                    Facebook
                    <span style="left: 305px;">
						<?php if($error->has('facebook')){ echo $error->first('facebook'); }else if($facebook === null){ ?>
                        Please add your account.
                        <?php }else{ ?>
                        Looks good!
                        <?php } ?>
                    </span>
                </label>
                <span class="href">https://www.facebook.com/</span> <input type="text" name="facebook" class="social" id="facebook" value="<?php if(!empty($post['facebook'])){ echo $post['facebook']; }else{ echo $facebook; } ?>" maxlength="64" data-validate="socialAccounts">
            </p>
            <p<?php if($error->has('twitter')){ echo ' class="input error"'; } ?>>
                <label for="twitter">
                    Twitter
                    <span style="left: 257px;">
						<?php if($error->has('twitter')){ echo $error->first('twitter'); }else if($twitter === null){ ?>
                        Please add your account.
                        <?php }else{ ?>
                        Looks good!
                        <?php } ?>
                    </span>
                </label>
                <span class="href">https://twitter.com/</span> <input type="text" name="twitter" class="social" id="twitter" value="<?php if(!empty($post['twitter'])){ echo $post['twitter']; }else{ echo $twitter; } ?>" maxlength="64" data-validate="socialAccounts">
            </p>
            <p<?php if($error->has('googleplus')){ echo ' class="input error"'; } ?>>
                <label for="googleplus">
                    Google+
                    <span style="left: 288px;">
						<?php if($error->has('googleplus')){ echo $error->first('googleplus'); }else if($googleplus === null){ ?>
                        Please add your account.
                        <?php }else{ ?>
                        Looks good!
                        <?php } ?>
                    </span>
                </label>
                <span class="href">https://plus.google.com/</span> <input type="text" name="googleplus" class="social" id="googleplus" value="<?php if(!empty($post['googleplus'])){ echo $post['googleplus']; }else{ echo $googleplus; } ?>" maxlength="64" data-validate="socialAccounts">
            </p>
            <p<?php if($error->has('linkedin')){ echo ' class="input error"'; } ?>>
                <label for="linkedin">
                    LinkedIn
                    <span style="left: 311px;">
						<?php if($error->has('linkedin')){ echo $error->first('linkedin'); }else if($linkedin === null){ ?>
                        Please add your account.
                        <?php }else{ ?>
                        Looks good!
                        <?php } ?>
                    </span>
                </label>
                <span class="href">https://www.linkedin.com/in/</span> <input type="text" name="linkedin" class="social" id="linkedin" value="<?php if(!empty($post['linkedin'])){ echo $post['linkedin']; }else{ echo $linkedin; } ?>" maxlength="64" data-validate="socialAccounts">
            </p>
        </fieldset>
    	<fieldset>
        	<legend><i class="icon-lock"></i> Change Password</legend>
            <p<?php if($error->has('currentPassword')){ echo ' class="input error"'; } ?>>
                <label for="password">
                    Current Password
                    <span style="left: 228px;">
						<?php if($error->has('currentPassword')){ echo $error->first('currentPassword'); }else{ ?>
                        This field is required if you are changing your password.
                        <?php } ?>
                    </span>
                </label>
                <input type="password" name="password" id="password" maxlength="64">
            </p>
            <p<?php if($error->has('newPassword')){ echo ' class="input error"'; } ?>>
                <label for="newpassword">
                    New Password
                    <span style="left: 228px;">
						<?php if($error->has('newPassword')){ echo $error->first('newPassword'); }else{ ?>
                        The password must be at least 6 characters.
                        <?php } ?>
                    </span>
                </label>
                <input type="password" name="newpassword" id="newpassword" maxlength="64" data-validate="password">
            </p>
            <p<?php if($error->has('confirmnewpassword')){ echo ' class="input error"'; } ?>>
                <label for="confirmnewpassword">
                    Verify New Password
                </label>
                <input type="password" name="confirmnewpassword" id="confirmnewpassword" maxlength="64" data-validate="verifyPassword">
            </p>
        </fieldset>
        <p>
            <button name="save" id="save" class="submit">Save <i class="icon-save"></i></button>
        </p>
    </form>
</section>

<?php echo $sidebar; ?>