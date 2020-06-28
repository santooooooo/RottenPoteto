<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;

class Profile
{
	/**
	 * @return void | string
	 */
    static function output(string $gmail)
    {
	    $is_user = DB::table('google_users')->where('gmail', $gmail)->exists();

	    if($is_user)
	    {
	      $eloquent = DB::table('google_users')->where('gmail', $gmail)->first();
		    $userInfo = [
			    'id' => $eloquent->id,
			    'gmail' => $eloquent->gmail,
			    'name' => $eloquent->name,
			    'profile' => $eloquent->profile,
			    'icon' => $eloquent->icon,
			    'best' => $eloquent->best,
		    ];
		    $jsonData = json_encode($userInfo);

		    return $jsonData;
	    }
	   return;
    }
}
