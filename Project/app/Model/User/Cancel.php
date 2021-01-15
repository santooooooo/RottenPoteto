<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;

final class Cancel
{
    static function Cancel(string $gmail): void
    {
	    $isUser = DB::table('google_users')->where('gmail', $gmail)->value('id');

	    if($isUser != null)
	    {
		    //deletng record in child DB and recalculating good points in each review.
		    $goodEloquents = DB::table('good_points')->where('google_user_id', $isUser)->get();
		    foreach($goodEloquents as $eloquent)
		    {
			    DeleteGood::delete($isUser, $eloquent->user_review_id);
		    }

		    //deletng record in child DB and recalculating satisfaction and recommende in each contribute.
		    $reviewEloquents = DB::table('user_reviews')->where('google_user_id', $isUser)->get();
		    DB::table('user_reviews')->where('google_user_id', $isUser)->delete();

		    foreach($reviewEloquents as $eloquent)
		    {
			    GradeCinema::grade($eloquent->contribute_id);
		    }

		    DB::table('google_users')->where('gmail', $gmail)->delete();
	    }
    }
}
