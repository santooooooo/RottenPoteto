<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Eloquent\UserReview;
use Illuminate\Support\Facades\DB;

class InputReview
{
	static function isContribute(int $contributeId): bool
	{
		$is_contribute = DB::table('contributes')->where('id', $contributeId)->exists();

		return $is_contribute;
	}

	static function isUser(int $userId): bool
	{
		$is_user = DB::table('google_users')->where('id', $userId)->exists();

		return $is_user;
	}

	static function existReview(int $contributeId, int $userId): bool
	{
		$exist_review = DB::table('user_reviews')->where([
			['contribute_id', $contributeId],
			['google_user_id', $userId]
		])->exists();

		return $exist_review;
	}

	static function input(
		int $contributeId,
		int $userId,
		string $title,
		string $review,
		int $satisfaction,
		int $recommended
	): bool
	{
		$check = self::isContribute($contributeId) && self::isUser($userId) && 
							!self::existReview($contributeId, $userId);

		if($check)
		{
			$eloquent = new UserReview();

			$eloquent->fill([
				'contribute_id' => $contributeId,
				'google_user_id' => $userId,
				'title' => $title,
				'review' => $review,
				'satisfaction' => $satisfaction,
				'recommended' => $recommended,
			]);

			$eloquent->save();

			return true;
		}
		return false;
	}
}
