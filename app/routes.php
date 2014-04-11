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
Route::get('/login/{error?}', array('as' => 'login', function($error = null) {
	
	$page = noAuth(View::make('page', array('page' => 'login', 'title' => 'Login'))
			->nest('localStyles', 'localStyle.login')
			->nest('header', 'header')
			->nest('pageContent', 'login', array('error' => $error))
			->nest('footer', 'footer', array('style' => 'dark'))
			->nest('localScripts', 'localScript.login'));
		
	return $page;
	
}));

// Forgot Password
Route::get('/password', function() {
	
	$page = noAuth(View::make('page', array('page' => 'password', 'title' => 'Forgot Password'))
		->nest('localStyles', 'localStyle.password')
		->nest('header', 'header')
		->nest('pageContent', 'password')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.password'));
		
	return $page;
	
});

// Register
Route::get('/register/{error?}', array('as' => 'register', function($error = null) {
	
	$page = noAuth(View::make('page', array('page' => 'register', 'title' => 'Register Account'))
		->nest('localStyles', 'localStyle.register')
		->nest('header', 'header')
		->nest('pageContent', 'register', array('error' => $error))
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.register'));
		
	return $page;
	
}));

// Slide
Route::get('/slide/{slideId?}', function($slideId = null) { // slide id required

	$page = View::make('page', array('page' => 'slide', 'title' => 'Presenting Slide'))
		->nest('localStyles', 'localStyle.slide')
		->nest('header', 'header')
		->nest('pageContent', 'slide')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.slide');
		
	return $page;
	
});

// Logout
Route::get('/logout', function() {
	
	Auth::logout();
	return Redirect::route('login');
	
});

// Process Login
Route::post('/process/login', function(){
	
	$username = str_replace(' ', '', trim(strip_tags($_POST['username'])));
	$password = str_replace(' ', '', trim(strip_tags($_POST['password'])));
	
    if(Auth::attempt(array('uid' => $username, 'password' => $password))){
		//$page = Redirect::route('profile', array());
		$page = Redirect::intended('profile');
	}else{
		$page = Redirect::route('login', array('error' => 'error'));
	}
	
	return $page;
	
});

// Process Login
Route::post('/process/register', function(){
	
	//validate data
	$validator = Validator::make(
		array(
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'email' => $_POST['email'],
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'verifypassword' => $_POST['verifypassword']
		),
		array(
			'firstname' => 'required|max:32',
			'lastname' => 'required|max:32',
			'email' => 'required|email|max:254|unique:users,email',
			'username' => 'required|max:32|unique:users,email',
			'password' => 'required|min:8|max:64|same:verifypassword'
		)
	);
	
	if ($validator->fails()){
		$page = Redirect::route('register', array('error' => 'error'));
	}else{
		
		$password = Hash::make($_POST['password']);
		DB::insert('insert into users (first, last, email, uid, password) values (?, ?, ?, ?, ?)', array($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $password));
		
		if(Auth::attempt(array('uid' => $_POST['username'], 'password' => $_POST['password']))){
			$page = Redirect::intended('profile');
		}else{
			$page = Redirect::route('login', array('error' => 'error'));
		}
	}
	
	return $page;
	
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
	if ($validator->fails())
	{
		$page = 'false';
	}else{
		
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

// pages that require authentication
Route::group(array('before' => 'auth'), function(){
	
	// profile
	Route::get('/profile/{uid?}', array('as' => 'profile', function($uid = null) { // default current user
		
		$page = View::make('page', array('page' => 'profile', 'title' => 'Profile'))
					->nest('localStyles', 'localStyle.profile')
					->nest('header', 'header')
					->nest('pageContent', 'profile', array('sidebar' => View::make('sidebar')))
					->nest('footer', 'footer', array('style' => 'dark'))
					->nest('localScripts', 'localScript.profile');
		
		return $page;
	}));
	
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