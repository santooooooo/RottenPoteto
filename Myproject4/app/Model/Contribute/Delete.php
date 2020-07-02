<?php

namespace App\Model\Contribute;

use Illuminate\Support\Facades\DB;

class Delete
{
    static function delete(string $title): bool
    {
	    $contributeId = DB::table('contributes')->where('title', $title)->value('id');

	    if($contributeId != 0)
	    {
		    $reviews = DB::table('user_reviews')->where('contribute_id', $contributeId)->get();
		    foreach($reviews as $review)
		    {
			    DB::table('good_points')->where('user_review_id', $review->id)->delete();
		    }

		    DB::table('user_reviews')->where('contribute_id', $contributeId)->delete();

		    DB::table('contributes')->where('id', $contributeId)->delete();

		    return true;
	    }
	    return false;
    }
}
