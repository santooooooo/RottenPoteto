<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;

final class SignOut
{
    static function signOut(string $gmail): void
    {
	    $isUsers = DB::table('google_users')->where('gmail', $gmail)->exists();

	    if($isUsers)
	    {
		    DB::table('google_users')->where('gmail', $gmail)->delete();
	    }
    }
}
