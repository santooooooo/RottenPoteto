<?php

namespace App\Model\Contribute;

use Illuminate\Support\Facades\DB;

class Delete
{
    static function delete(string $title): bool
    {
	    $contribute = DB::table('contributes')->where('title', $title)->first();

	    if($contribute->id != 0)
	    {
		    $reviews = DB::table('user_reviews')->where('contribute_id', $contribute->id)->get();
		    foreach($reviews as $review)
		    {
			    DB::table('good_points')->where('user_review_id', $review->id)->delete();
		    }

		    DB::table('user_reviews')->where('contribute_id', $contribute->id)->delete();

		    DB::table('contributes')->where('id', $contribute->id)->delete();

		    return true;
	    }
	    return false;
    }
}
