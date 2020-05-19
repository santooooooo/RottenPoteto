<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

final class GoogleOAuth extends Controller
{
    public function redirectToGoogle()
    {
	    return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
	    $gUser = Socialite::driver('google')->stateless()->user();
	    dd($gUser);
    }
}
