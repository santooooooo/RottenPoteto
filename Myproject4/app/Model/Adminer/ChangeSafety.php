<?php

namespace App\Model\Adminer;

use App\Eloquent\GoogleUser;
use Illuminate\Support\Facades\DB;

class ChangeSafety
{
    static function change(string $gmail): void
    {
	    $safety = DB::table('google_users')->where('gmail', $gmail)->value('safety');

	    if($safety == 1)
	    {
		    DB::table('google_users')->where('gmail', $gmail)->update(['safety' => false]);
		    return;
	    }
	    DB::table('google_users')->where('gmail', $gmail)->update(['safety' => true]);
	    return;
    }
}
