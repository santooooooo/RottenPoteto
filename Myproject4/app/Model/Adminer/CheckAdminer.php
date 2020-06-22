<?php
declare(strict_types=1);

namespace App\Model\Adminer;

use App\Eloquent\GoogleUser;
use Illuminate\Support\Facades\DB;

final class CheckAdminer
{
	/*
	 * @var object $eloquent
	 * @var bool $is_adminer
	 */
    static function check(string $info): bool
    {
	    $eloquent = DB::table('google_users')->where('gmail', 'santo.shunsuke@gmail.com')->first();

	    $isAdminer = optional($eloquent)->gmail == $info;

	    return $isAdminer;
    }
}
