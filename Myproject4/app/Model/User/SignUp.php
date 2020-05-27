<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Eloquent\GoogleUser;

final class SignUp
{
	/**
	 * @param array<string,string> $info
	 * @var object $eloquent
	 */

    static function signUp(array $info): void
    {
	    $eloquent = new GoogleUser();

	    $eloquent->gmail = $info['gmail'];
	    $eloquent->name = $info['name'];

	    $eloquent->save();
    }
}
