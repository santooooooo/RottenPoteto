<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Eloquent\GoogleUser;
use Illuminate\Support\Facades\DB;

final class Judge
{
	/*
	 * @var int $data
	 * @var bool $is_user
	 */
	static function judge(string $info): bool
	{
		$data = DB::table('google_users')->where('gmail', $info)->count();
		$is_user = $data == 1 ? true: false;
		return $is_user;
	}
}
