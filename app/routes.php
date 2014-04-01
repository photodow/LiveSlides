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
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'blue'));
});

// Login
Route::get('/login', function() {
	return View::make('page', array('page' => 'login', 'title' => 'Login'))
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'dark'));
});

// Register
Route::get('/register', function() {
	return View::make('page', array('page' => 'register', 'title' => 'Register Account'))
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'dark'));
});

// Profile
Route::get('/profile/{userId?}', function($userId = null) { // default current user
	return View::make('page', array('page' => 'profile', 'title' => 'Profile'))
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'dark'));
});

// Slides
Route::get('/slides/{userId?}', function($userId = null) { // default current user
	return View::make('page', array('page' => 'slides', 'title' => 'View All Slides'))
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'dark'));
});

// Create
Route::get('/create', function() {
	return View::make('page', array('page' => 'create', 'title' => 'Create Slide'))
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'dark'));
});


// Edit
Route::get('/edit/{slideId}', function($slideId) { // slide id required
	return View::make('page', array('page' => 'edit', 'title' => 'Edit Slide'))
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'dark'));
});


// Slide
Route::get('/slide/{slideId}', function($slideId) { // slide id required
	return View::make('page', array('page' => 'slide', 'title' => 'Presenting Slide'))
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'dark'));
});

// Sitemap
Route::get('/sitemap', function() {
	return View::make('page', array('page' => 'sitemap', 'title' => 'Site Map'))
		->nest('style', 'style')
		->nest('header', 'header')
		->nest('pageContent', 'home')
		->nest('footer', 'footer', array('style' => 'dark'));
});