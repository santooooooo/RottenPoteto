<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Eloquent\UserReview;
use Illuminate\Support\Facades\DB;

class InputReview
{
	static function isContribute(int $contributeId): bool
	{
		$isContribute = DB::table('contributes')->where('id', $contributeId)->exists();

		return $isContribute;
	}

	static function isUser(int $userId): bool
	{
		$isUser = DB::table('google_users')->where('id', $userId)->exists();

		return $isUser;
	}

	static function existReview(int $contributeId, int $userId): bool
	{
		$existReview = DB::table('user_reviews')->where([
			['contribute_id', $contributeId],
			['google_user_id', $userId]
		])->exists();

		return $existReview;
	}

	static function badSafety(int $userId): bool
	{
		$safety = DB::table('google_users')->where('id', $userId)->value('safety');

		if($safety == 1)
		{
			return false;
		}
		return true;
	}

	static function input(
		int $contributeId,
		int $userId,
		string $title,
		string $review,
		string $spoiler,
		int $satisfaction,
		int $recommended
	): bool
	{
		$check = self::isContribute($contributeId) && self::isUser($userId) && 
							!self::existReview($contributeId, $userId) && !self::badSafety($userId);

		if($check)
		{
			$eloquent = new UserReview();

			$eloquent->fill([
				'contribute_id' => $contributeId,
				'google_user_id' => $userId,
				'title' => $title,
				'review' => $review,
				'spoiler' => $spoiler,
				'satisfaction' => $satisfaction,
				'recommended' => $recommended,
			]);

			$eloquent->save();

			return true;
		}
		return false;
	}
}
