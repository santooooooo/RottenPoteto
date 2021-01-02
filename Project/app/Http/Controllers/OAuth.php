<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Model\User\GoogleOAuth;
use App\Model\User\Judge;
use App\Model\User\SignIn;
use App\Model\User\SignUp;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class OAuth extends Controller
{
/**
 * @var array<string, string> $info
 */
    private $info = [];

    /**
     * @return RedirectResponse
     */
    public function redirect()
    {
	    $aouth = new GoogleOAuth();
	    return $aouth->redirectToGoogle();
    }

    /**
     * @return RedirectResponse
     */
    public function handle()
    {
	    //$user = new GoogleOAuth();
	    //$gUser = $user->googleUser();

	    $this->info['gmail'] = 'testsun@gmail.com'; //$gUser['email'];
	    $this->info['name'] = 'testsun';//$gUser['nickname'] ?? $gUser['name'];

	    $is_user = Judge::judge($this->info['gmail']);
	    if(!$is_user)
	    {
		    SignUp::signUp($this->info);
	    }

	    $jsonData = SignIn::signIn($this->info['gmail']);

	    session(['user' => $jsonData]);

	    return redirect('/');
    }
}
