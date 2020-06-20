<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;

class DeleteReview
{
	static function existReview(int $contributeId, int $userId): bool
	{
		$existReview = DB::table('user_reviews')->where([
			['contribute_id', $contributeId],
			['google_user_id', $userId]
		])->exists();

		return $existReview;
	}

  static function delete(int $contributeId, int $userId): bool
  {
	  $check = self::existReview($contributeId, $userId);

	  if($check)
	  {
		  DB::table('user_reviews')->where([
			  ['contribute_id', $contributeId],
			  ['google_user_id', $userId],
		  ])->delete();

		  return true;
	  }
	  return false;
  }
}
