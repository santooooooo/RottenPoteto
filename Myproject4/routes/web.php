<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	echo("Welcome home!");
	return view('welcome');
});
//User`s Zone
//
//home view
Route::get('/home', function()
{
	return view('top');
});

//getting contribution's info
Route::get('top', 'Contribute@response');

//recording users or authorize users
Route::get('login/oauth', 'OAuth@redirect');
Route::get('/login/oauth/callback', 'OAuth@handle');

//deleting user's account
Route::post('/signout', 'UsersController@userSignOut');

//log out func for users
Route::get('/logout', 'UsersController@userLogOut');

//updating user's account info
Route::post('/update', 'UsersController@updateUserProfile');

//inputting user's review
Route::post('/review/input', 'ReviewController@inputReview');

//deleting user's review
Route::post('/review/delete', 'ReviewController@deleteReview');

//pushing good on user's reviews
Route::post('/good/push', 'GoodController@pushGood');

//deleting good on user's reviews
Route::post('/good/delete', 'GoodController@deleteGood');

//outputting contribute's info and reviews
Route::get('/review-page/', 'ReviewPageController@outputInfo');



//Adminer's Zone

//contribute func
Route::post('/contribute', 'Contribute@record');

//AdminerLogin view
Route::get('/adminer', function()
{
	return view('adminerLogin');
});

//authorize adminer
Route::post('/adminer', 'AdminerController@adminerAuth');
