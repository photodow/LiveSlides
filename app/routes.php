<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Home
Route::get('/', function() {
	$page = View::make('page', array('page' => 'home', 'title' => 'Present Slides Live'))
		->nest('localStyles', 'localStyle.home')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'blue'))
		->nest('localScripts', 'localScript.home');
		
	return $page;
	
});

function noAuth($page){
	if(Auth::check()){
		$page = Redirect::route('profile');
	}else{
		$page = $page;
	}
	
	return $page;
}

// Login
Route::get('/login', array('as' => 'login', function() {
	
	$page = noAuth(View::make('page', array('page' => 'login', 'title' => 'Login'))
			->nest('localStyles', 'localStyle.login')
			->nest('header', 'header')
			->nest('pageContent', 'login')
			->nest('footer', 'footer', array('style' => 'dark'))
			->nest('localScripts', 'localScript.login'));
		
	return $page;
	
}));

// Process Login
Route::post('/login/process', array('as' => 'loginError', function(){
	
	$username = str_replace(' ', '', trim(strip_tags($_POST['username'])));
	$password = str_replace(' ', '', trim(strip_tags($_POST['password'])));
	
    if(Auth::attempt(array('uid' => $username, 'password' => $password))){
		DB::insert('insert into logging (uid, status) values (?, ?)', array($username, "login"));
		$page = Redirect::intended('profile');
	}else{
		$page = noAuth(View::make('page', array('page' => 'login', 'title' => 'Login'))
			->nest('localStyles', 'localStyle.login')
			->nest('header', 'header')
			->nest('pageContent', 'login')
			->nest('footer', 'footer', array('style' => 'dark'))
			->nest('localScripts', 'localScript.login'));
	}
	
	return $page;
	
}));

// Forgot Password
Route::get('/password', array('as' => 'password', function() {
	
	$page = noAuth(View::make('page', array('page' => 'password', 'title' => 'Forgot Password'))
		->nest('localStyles', 'localStyle.password')
		->nest('header', 'header')
		->nest('pageContent', 'password.remind')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.password'));
		
	return $page;
	
}));

// Reset Password
Route::get('/password/reset/{token?}', function($token = null) {
	
	$page = noAuth(View::make('page', array('page' => 'password', 'title' => 'Forgot Password'))
		->nest('localStyles', 'localStyle.password')
		->nest('header', 'header')
		->nest('pageContent', 'password.reset', array('token' => $token))
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.password'));
		
	return $page;
	
});

Route::controller('password', 'RemindersController');

// Register
Route::get('/register', array('as' => 'register', function() {
	
	$page = noAuth(View::make('page', array('page' => 'register', 'title' => 'Register Account'))
		->nest('localStyles', 'localStyle.register')
		->nest('header', 'header')
		->nest('pageContent', 'register')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.register'));
		
	return $page;
	
}));
	
function clean($value){
	return str_replace(' ', '', trim(strip_tags($value)));
}

// Process Registration
Route::post('/register/process', function(){
		
	$firstname = clean($_POST['firstname']);
	$lastname = clean($_POST['lastname']);
	$email = clean(strtolower($_POST['email']));
	$username = clean(strtolower($_POST['username']));
	$password = clean($_POST['password']);
	$verifyPassword = clean($_POST['verifypassword']);
	
	//validate data
	$validator = Validator::make(
		array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'email' => $email,
			'username' => $username,
			'password' => $password,
			'verifypassword' => $verifyPassword
		),
		array(
			'firstname' => 'required|max:32|alpha',
			'lastname' => 'required|max:32|alpha',
			'email' => 'required|email|max:254|unique:users,email',
			'username' => 'required|max:32|alpha_dash|unique:users,uid',
			'password' => 'required|min:6|max:64|same:verifypassword'
		)
	);
	
	if ($validator->fails()){
		$page = noAuth(View::make('page', array('page' => 'register', 'title' => 'Register Account'))
				->nest('localStyles', 'localStyle.register')
				->nest('header', 'header')
				->nest('pageContent', 'register', array('errors' => $validator->messages()))
				->nest('footer', 'footer', array('style' => 'dark'))
				->nest('localScripts', 'localScript.register'));
	}else{
		$passwordHash = Hash::make($password);
		
		DB::insert('insert into users (first, last, email, uid, password) values (?, ?, ?, ?, ?)', array($firstname, $lastname, $email, $username, $passwordHash));
		
		if(Auth::attempt(array('uid' => $username, 'password' => $password))){
			DB::insert('insert into logging (uid, status) values (?, ?)', array($username, "login"));
			$page = Redirect::intended('profile');
		}else{
			$page = Redirect::route('loginError');
		}
	}
	
	return $page;
	
});

// Slide
Route::get('/slide/{slideId?}', function($slideId = null) { // slide id required

	$page = View::make('pageSlide', array('page' => 'slide', 'title' => 'Presenting Slide'))
		->nest('localStyles', 'localStyle.slide')
		->nest('pageContent', 'slide')
		->nest('localScripts', 'localScript.slide');
		
	return $page;
	
});

// Logout
Route::get('/logout', function() {
	
	DB::insert('insert into logging (uid, status) values (?, ?)', array(Auth::user()->uid, "logout"));
	
	Auth::logout();
	return Redirect::route('login');
	
});

// process homepage contact form
Route::post('/process/contactform', function(){
	
	$validator = Validator::make(
		array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'subject' => $_POST['subject'],
			'message' => $_POST['message']
		),
		array(
			'name' => 'required',
			'email' => 'required|email',
			'subject' => 'required|max:32',
			'message' => 'required'
		)
	);
	if ($validator->fails()) {
		$page = 'false';
	} else {
		
		$name = trim(strip_tags($_POST['name']));
		$email = trim(strip_tags($_POST['email']));
		$subject = trim(strip_tags($_POST['subject']));
		$message = trim(strip_tags($_POST['message']));
		$message = preg_replace('/\n{2,}/', "</p><p>", $message);
		$message = preg_replace('/\n/', '<br>', $message);
		
		try {
			Mail::send('emails.contactform', array('name' => $name, 'email' => $email, 'subject' => $subject, 'messageBody' => $message), function($message){
				$message->to('photodow@gmail.com', 'James Dow')->subject($_POST['subject']);
			});
		} catch (Exception $e) {
			$page = 'false';
		}
		
		$page = 'true';
	}
				
	return Response::make('{"sent":"' . $page . '"}', '200')->header('Content-Type', 'application/json');
	
});//application/json

// profile
Route::get('/profile/{uid?}', array('as' => 'profile', function($uid = null) {
	
	if(!Auth::check() && $uid === null){
		
		$page = Redirect::route('login');
		
	}else{
		
		if($uid === null){ // default current user
			$uid = Auth::user()->uid;
		}
	
		$page = View::make('page', array('page' => 'profile', 'title' => 'Profile'))
					->nest('localStyles', 'localStyle.profile')
					->nest('header', 'header')
					->nest('pageContent', 'profile', array('uid' => $uid, 'sidebar' => View::make('sidebar')))
					->nest('footer', 'footer', array('style' => 'dark'))
					->nest('localScripts', 'localScript.profile', array('uid' => $uid));
			
	}
	
	return $page;
}));




// pages that require authentication
Route::group(array('before' => 'auth'), function(){

	// edit profile
	Route::get('/edit/profile', function() {
		
		$page = View::make('page', array('page' => 'profileEdit', 'title' => 'Edit Profile'))
					->nest('localStyles', 'localStyle.profileEdit')
					->nest('header', 'header')
					->nest('pageContent', 'profileEdit', array('sidebar' => View::make('sidebar')))
					->nest('footer', 'footer', array('style' => 'dark'))
					->nest('localScripts', 'localScript.profileEdit');
		
		return $page;
	});

	// process edit profile request
	Route::post('/edit/profile/process', function() {
		
		$uid = Auth::user()->uid;
		$headline = trim(strip_tags($_POST['headline']));
		$about = trim(strip_tags($_POST['about']));
		$email = trim(strip_tags($_POST['email']));
		$website = trim(strip_tags($_POST['website']));
		$facebook = trim(strip_tags($_POST['facebook']));
		$twitter = trim(strip_tags($_POST['twitter']));
		$googleplus = trim(strip_tags($_POST['googleplus']));
		$linkedin = trim(strip_tags($_POST['linkedin']));
		$currentPassword = trim(strip_tags($_POST['password']));
		$newPassword = trim(strip_tags($_POST['newpassword']));
		$verifyNewPassword = trim(strip_tags($_POST['confirmnewpassword']));
		
		if($email !== Auth::user()->email){ // handle email validation
			$validateEmail = 'required|email|max:254|unique:users,email';
			$changeEmail = true;
		}else{
			$validateEmail = '';	
			$changeEmail = false;
		}
		
		Validator::extend('checkPassword', function($attribute, $value, $parameters) {
			return Hash::check($value, Auth::user()->password);
		});
		
		Validator::replacer('checkPassword', function($message, $attribute, $rule, $parameters) {
			return 'Incorrect password.';
		});
		
		Validator::replacer('URL', function($message, $attribute, $rule, $parameters) {
			return 'This is not a valid URL.';
		});
		
		if(!empty($currentPassword) || !empty($newPassword) || !empty($verifyNewPassword)){
			$validateCurrentPassword = 'required|checkPassword';
			$validateNewPassword = 'required|min:6|max:64|same:verifyNewPassword|different:currentPassword';
			$validateVerifyNewPassword = 'required';
			$changePassword = true;
		}else{
			$validateCurrentPassword = '';
			$validateNewPassword = '';
			$validateVerifyNewPassword = '';
			$changePassword = false;
		}
		
		$validator = Validator::make(
			array(
				'headline' => $headline,
				'about' => $about,
				'email' => $email,
				'website' => $website,
				'facebook' => $facebook,
				'twitter' => $twitter,
				'googleplus' => $googleplus,
				'linkedin' => $linkedin,
				'currentPassword' => $currentPassword,
				'newPassword' => $newPassword,
				'verifyNewPassword' => $verifyNewPassword
			),
			array(
				'headline' => 'max:64',
				'about' => '',
				'email' => $validateEmail,
				'website' => 'URL|max:254',
				'facebook' => 'max:64',
				'twitter' => 'max:64',
				'googleplus' => 'max:64',
				'linkedin' => 'max:64',
				'currentPassword' => $validateCurrentPassword,
				'newPassword' => $validateNewPassword,
				'verifyNewPassword' => $validateVerifyNewPassword
			)
		);
		
		$messages = $validator->messages();
		
		if($validator->fails()){
			// did not pass
			// redirect with error messages
			Session::put('error', $messages);
			Session::put('post', $_POST);
			$page = Redirect::to('/edit/profile');
		}else{
			// pass
			if($changeEmail){
				// update email address
				DB::update('update users set email = ? where uid = ?', array($email, $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "email"));
			}
			
			if($changePassword){
				// update password
				DB::update('update users set password = ? where uid = ?', array(Hash::make($newPassword), $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "password"));
			}
			
			if($headline !== Auth::user()->headline){
				if(empty($headline)){
					$headline = null;	
				}
				// update headline
				DB::update('update users set headline = ? where uid = ?', array($headline, $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "headline"));
			}
			
			if($about !== Auth::user()->about){
				if(empty($about)){
					$about = null;	
				}
				// update about
				DB::update('update users set about = ? where uid = ?', array($about, $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "about"));
			}
			
			if($website !== Auth::user()->website){
				if(empty($website)){
					$website = null;	
				}
				// update website
				DB::update('update users set website = ? where uid = ?', array($website, $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "website"));
			}
			
			if($facebook !== Auth::user()->facebook){
				if(empty($facebook)){
					$facebook = null;	
				}
				// update facebook
				DB::update('update users set facebook = ? where uid = ?', array($facebook, $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "facebook"));
			}
			
			if($twitter !== Auth::user()->twitter){
				if(empty($twitter)){
					$twitter = null;	
				}
				// update twitter
				DB::update('update users set twitter = ? where uid = ?', array($twitter, $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "twitter"));
			}
			
			if($googleplus !== Auth::user()->googleplus){
				if(empty($googleplus)){
					$googleplus = null;	
				}
				// update googleplus
				DB::update('update users set googleplus = ? where uid = ?', array($googleplus, $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "googleplus"));
			}
			
			if($linkedin !== Auth::user()->linkedin){
				if(empty($linkedin)){
					$linkedin = null;	
				}
				// update linkedin
				DB::update('update users set linkedin = ? where uid = ?', array($linkedin, $uid));
				DB::insert('insert into lastModified (uid, tablename, rowid, columnname) values (?, ?, ?, ?)', array($uid, "users", Auth::user()->id, "linkedin"));
			}
			
			// redirect with success
			Session::put('success', 'Your profile has been updated successfully!');
			$page = Redirect::to('/profile');
		}
		
		return $page;
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// slides
	Route::get('/slides/{uid?}', function($uid = null) { // default current user
	
		$page = View::make('page', array('page' => 'slides', 'title' => 'View All Slides'))
			->nest('localStyles', 'localStyle.slides')
			->nest('header', 'header')
			->nest('pageContent', 'slides', array('sidebar' => View::make('sidebar')))
			->nest('footer', 'footer', array('style' => 'dark'))
			->nest('localScripts', 'localScript.slides');
			
		return $page;
		
	});
	
	// Create
	Route::get('/create', function() {
		
		$page = View::make('page', array('page' => 'create', 'title' => 'Create Slide'))
			->nest('localStyles', 'localStyle.create')
			->nest('header', 'header')
			->nest('pageContent', 'create')
			->nest('footer', 'footer', array('style' => 'dark'))
			->nest('localScripts', 'localScript.create');
			
		return $page;
		
	});
	
	// Edit
	Route::get('/edit/{slideId?}', function($slideId = null) { // slide id required
	
		$page = View::make('page', array('page' => 'edit', 'title' => 'Edit Slide'))
			->nest('localStyles', 'localStyle.edit')
			->nest('header', 'header')
			->nest('pageContent', 'edit')
			->nest('footer', 'footer', array('style' => 'dark'))
			->nest('localScripts', 'localScript.edit');
			
		return $page;
		
	});
	
});



// Emails
Route::get('/emails/alpha', function() {
	$page = View::make('emails.alpha');
		
	return $page;
	
});

Route::get('/emails/beta', function() {
	$page = View::make('emails.beta');
		
	return $page;
	
});

App::error(function($exception, $code)
{
    switch ($code)
    {
        /*case 403:
            return Response::view('errors.403', array(), 403);*/

        /*case 404:
            return '404: page not found';//Response::view('errors.404', array(), 404);*/

        /*case 500:
            return Response::view('errors.500', array(), 500);

        default:
            return Response::view('errors.default', array(), $code);*/
    }
});