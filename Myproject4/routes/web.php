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

//home view
Route::get('/home', function()
{
	return view('top');
});

//contribute view & func
Route::get('/contribute', function(){
	return view('contribute');
});
Route::post('/contribute', 'Contribute@record');

//getting contribution's info
Route::get('top', 'Contribute@response');

//recording users or authorize users
Route::get('login/oauth', 'OAuth@redirect');
Route::get('/login/oauth/callback', 'OAuth@handle');

//AdminerLogin view
Route::get('/adminer', function()
{
	return view('adminerLogin');
});

//authorize adminer
Route::post('/adminer', 'AdminerController@adminerAuth');
