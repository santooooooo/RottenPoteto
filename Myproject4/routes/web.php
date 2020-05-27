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

//get contribution's info
Route::get('top', 'Contribute@response');

//recording users or authorize users
Route::get('login/oauth', 'OAuth@redirect');
Route::get('/login/oauth/callback', 'OAuth@handle');

//get user's info
Route::get('login/oauth/info', 'OAuth@redirect');

