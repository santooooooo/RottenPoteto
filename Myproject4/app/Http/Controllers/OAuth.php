<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Model\User\GoogleOAuth;
use App\Model\User\Judge;
use App\Model\User\SignIn;
use App\Model\User\SignUp;

final class OAuth extends Controller
{
    private $info = [];

    public function redirect()
    {
	    $aouth = new GoogleOAuth();
	    return $aouth->redirectToGoogle();
    }

    public function handle(): void
    {
	    $user = new GoogleOAuth();
	    dd($user->googleUser());

	    //$this->info['id'] = $gUser['id'];
	    //$this->info['name'] = $gUser['nickname'] ?? $gUser['name'];

	    //$is_user = Judge::judge($this->info);
	    //if($is_user)
	    //{
		  //  SignIn::signIn($this->info);
		  //  return;
	    //}
	    //SignUp::signUp($this->info);
	    //return;
    }
}
