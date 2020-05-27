<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Eloquent\GoogleUser;
use Illuminate\Support\Facades\DB;

final class SignIn
{
	/*
	 * @var object $eloquent
	 */
    static function signIn(string $info): string
    {
	    $eloquent = DB::table('google_users')->where('gmail', $info)->first();

	    $dataArray = [
		    'id' => $eloquent->id,
		    'name' => $eloquent->name,
		    'profile' => $eloquent->profile,
		    'icon' => $eloquent->icon,
		    'best' => $eloquent->best,
		    'safety' => $eloquent->safety,
	    ];

	    $jsonData = json_encode($dataArray);
	    return $jsonData;
	  }
}
