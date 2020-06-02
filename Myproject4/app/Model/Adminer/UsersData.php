<?php
declare(strict_types=1);

namespace App\Model\Adminer;

use App\Eloquent\GoogleUser;

class UsersData
{
	/**
	 * @var object $eloquent
	 * @var string $jsonData
	 */
    static function jsonData(): string
    {
	    $eloquent = GoogleUser::all();
	    $jsonData = $eloquent->toJson();

	    return $jsonData;
    }
}
