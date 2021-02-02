<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;

final class DeleteReview
{
	static function existReview(int $contributeId, int $userId): int
	{
		$existReview = DB::table('user_reviews')->where([
			['contribute_id', $contributeId],
			['google_user_id', $userId]
		])->value('id');

		$reviewId = $existReview !== null ? $existReview: 0;
		return $reviewId;
	}

  static function delete(int $contributeId, int $userId): bool
  {
	  $checkId = self::existReview($contributeId, $userId);

	  if($checkId !== 0)
	  {
		  DB::table('good_points')->where('user_review_id', $checkId)->delete();

		  DB::table('user_reviews')->where('id', $checkId)->delete();

		  return true;
	  }
	  return false;
  }
}
