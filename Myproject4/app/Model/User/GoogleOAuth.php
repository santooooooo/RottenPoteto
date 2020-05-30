<?php
declare(strict_types=1);

namespace App\Model\User;

use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class GoogleOAuth
{
	/**
	 * @return RedirectResponse
	 */
    public function redirectToGoogle()
    {
	    return Socialite::driver('google')->redirect();
    }

	/**
	 * @return object
	 */
    public function googleUser()
    {
	    return Socialite::driver('google')->stateless()->user();
    }
}
