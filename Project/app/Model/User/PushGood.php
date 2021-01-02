<?php

declare(strict_types=1);

namespace App\Model\User;

use App\Eloquent\UserReview;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoodPoint;

final class PushGood
{
		static function isUser(int $userId): bool
		{
			$isUser = DB::table('google_users')->where('id', $userId)->exists();

			return $isUser;
		}

		static function isReview(int $reviewId): bool
		{
			$isReview = DB::table('user_reviews')->where('id', $reviewId)->exists();

			return $isReview;
		}

		static function existsGood(int $userId, int $reviewId): bool
		{
			$existGood = DB::table('good_points')->where([
				['google_user_id', $userId],
				['user_review_id', $reviewId]
			])->exists();

			return $existGood;
		}

    static function push(int $userId, int $reviewId): bool
    {
	    $check = self::isUser($userId) && self::isReview($reviewId)
		    				&& !self::existsGood($userId, $reviewId);

	    if($check)
	    {
		    $goodEloquent = new GoodPoint();
		    $goodEloquent->fill([
			    'google_user_id' => $userId,
			    'user_review_id' => $reviewId,
		    ]);
		    $goodEloquent->save();

		    DB::table('user_reviews')->where('id', $reviewId)->increment('good_point');

		    return true;
	    }
	    return false;
    }
}
