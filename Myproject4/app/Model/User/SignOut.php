<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;

class SignOut
{
    static function signOut(string $gmail): void
    {
	    $is_users = DB::table('google_users')->where('gmail', $gmail)->exists();

	    if($is_users)
	    {
		    DB::table('google_users')->where('gmail', $gmail)->delete();
	    }
    }
}
