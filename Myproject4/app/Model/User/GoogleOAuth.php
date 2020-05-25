<?php
declare(strict_types=1);

namespace App\Model\User;

use Laravel\Socialite\Facades\Socialite;

final class GoogleOAuth
{
    public function redirectToGoogle()
    {
	    return Socialite::driver('google')->redirect();
    }

    public function googleUser()
    {
	    return Socialite::driver('google')->stateless()->user();
    }
}
