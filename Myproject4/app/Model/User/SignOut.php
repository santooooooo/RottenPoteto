<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;

final class SignOut
{
    static function signOut(string $gmail): void
    {
	    $isUser = DB::table('google_users')->where('gmail', $gmail)->value('id');

	    if($isUser != null)
	    {
		    //compare satisfaction and recommende in each contributes.
		    $eloquents = DB::table('user_reviews')->where('google_user_id', $isUser)->get();
		    DB::table('user_reviews')->where('google_user_id', $isUser)->delete();

		    foreach($eloquents as $eloquent)
		    {
			    GradeCinema::grade($eloquent->contribute_id);
		    }

		    DB::table('google_users')->where('gmail', $gmail)->delete();
	    }
    }
}
