<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;

class UserInfo
{
	/**
	 * output's parameter is string because type of parameter from get request is string.
	 */
   static function output(string $userId): string
   {
	    $eloquent = DB::table('google_users')->where('id', $userId)->first();
	    $userInfo = [
		    'id' => $eloquent->id,
		    'name' => $eloquent->name,
		    'profile' => $eloquent->profile,
		    'icon' => $eloquent->icon,
		    'best' => $eloquent->best,
	    ];
	    $jsonData = json_encode($userInfo);

	    return $jsonData;
   }
}
