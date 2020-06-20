<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;

class DeleteGood
{
    static function existsGood(int $userId, int $reviewId): bool
    {
			$existGood = DB::table('good_points')->where([
				['google_user_id', $userId],
				['user_review_id', $reviewId]
			])->exists();

			return $existGood;
    }

    static function delete(int $userId, int $reviewId): bool
    {
	    $check = self::existsGood($userId, $reviewId);

	    if($check)
	    {
			  DB::table('good_points')->where([
				  ['google_user_id', $userId],
				  ['user_review_id', $reviewId],
			  ])->delete();

			  DB::table('user_reviews')->where('id', $reviewId)->decrement('good_point');

		    return true;
	    }
	    return false;
    }
}
