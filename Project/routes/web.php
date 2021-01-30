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

//User`s Zone
//
//home view
Route::get('/', function()
{
	return view('top');
});

//getting contribution's info
Route::get('/top', 'Contribute@response');

//recording users or authorize users
//Route::get('login/oauth', 'OAuth@redirect');
//Route::get('/login/oauth/callback', 'OAuth@handle');

//this code is for test in local
Route::get('/login/oauth', 'OAuth@handle');

//deleting user's account
Route::post('/cancel', 'UsersController@userCancel');

//log out func for users
Route::get('/logout', 'UsersController@userLogOut');

//updating user's account info
Route::post('/update', 'UsersController@updateUserProfile');

//showing own info on user's page
Route::get('/user-info', 'UsersController@outputInfo');

//inputting user's review
Route::post('/review/input', 'ReviewController@inputReview');

//deleting user's review
Route::post('/review/delete', 'ReviewController@deleteReview');

//outputting contribute's info and reviews
Route::get('/review-page/', 'ReviewPageController@outputInfo');

//outputting user's info related to get request
Route::get('/review-page/user/', 'ReviewPageController@outputUserInfo');



//Adminer's Zone

//contribute func
Route::post('/contribute', 'Contribute@record');

//deleting a contribute
Route::post('/contribute/delete', 'Contribute@delete');

//AdminerLogin view
Route::get('/adminer', function()
{
	return view('adminerLogin');
});

//authorize adminer
Route::post('/adminer', 'AdminerController@adminerAuth');
