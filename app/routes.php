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
	return View::make('page', array('page' => 'home', 'title' => 'Present Slides Live'))
		->nest('localStyles', 'localStyle.home')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'blue'))
		->nest('localScripts', 'localScript.home');
});

// Login
Route::get('/login', function() {
	return View::make('page', array('page' => 'login', 'title' => 'Login'))
		->nest('localStyles', 'localStyle.login')
		->nest('header', 'header')
		->nest('pageContent', 'login')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.login');
});

// Forgot Password
Route::get('/password', function() {
	return View::make('page', array('page' => 'password', 'title' => 'Forgot Password'))
		->nest('localStyles', 'localStyle.password')
		->nest('header', 'header')
		->nest('pageContent', 'password')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.password');
});

// Register
Route::get('/register', function() {
	return View::make('page', array('page' => 'register', 'title' => 'Register Account'))
		->nest('localStyles', 'localStyle.register')
		->nest('header', 'header')
		->nest('pageContent', 'register')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.register');
});

// Profile
Route::get('/profile/{userId?}', function($userId = null) { // default current user
	return View::make('page', array('page' => 'profile', 'title' => 'Profile'))
		->nest('localStyles', 'localStyle.profile')
		->nest('header', 'header')
		->nest('pageContent', 'profile', array('sidebar' => View::make('sidebar')))
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.profile');
});

// Slides
Route::get('/slides/{userId?}', function($userId = null) { // default current user
	return View::make('page', array('page' => 'slides', 'title' => 'View All Slides'))
		->nest('localStyles', 'localStyle.slides')
		->nest('header', 'header')
		->nest('pageContent', 'slides', array('sidebar' => View::make('sidebar')))
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.slides');
});

// Create
Route::get('/create', function() {
	return View::make('page', array('page' => 'create', 'title' => 'Create Slide'))
		->nest('localStyles', 'localStyle.create')
		->nest('header', 'header')
		->nest('pageContent', 'create')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.create');
});


// Edit
Route::get('/edit/{slideId?}', function($slideId = null) { // slide id required
	return View::make('page', array('page' => 'edit', 'title' => 'Edit Slide'))
		->nest('localStyles', 'localStyle.edit')
		->nest('header', 'header')
		->nest('pageContent', 'edit')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.edit');
});


// Slide
Route::get('/slide/{slideId?}', function($slideId = null) { // slide id required
	return View::make('page', array('page' => 'slide', 'title' => 'Presenting Slide'))
		->nest('localStyles', 'localStyle.slide')
		->nest('header', 'header')
		->nest('pageContent', 'slide')
		->nest('footer', 'footer', array('style' => 'dark'))
		->nest('localScripts', 'localScript.slide');
});