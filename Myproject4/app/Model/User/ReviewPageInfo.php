<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Eloquent\Contribute;

class ReviewPageInfo
{
    static function outputInfo(int $contributeId): string
    {
	    $contribute = Contribute::find($contributeId)->first();
	    $data = [];

		  $data["contribute"] = [$contribute->title, $contribute->contents, $contribute->picture,
		  $contribute->genre, $contribute->satisfaction,$contribute->recommended];

	    $eloquents = Contribute::find($contributeId)->reviews;
	    for($i = 0; $i < count($eloquents); $i++)
	    {
		    $eloquent = $eloquents[$i];

		    $data["reviews"][$i] = [$eloquent->title, $eloquent->review, $eloquent->spoiler,
		    $eloquent->satisfaction, $eloquent->recommended, $eloquent->user->name, $eloquent->user->icon];
	    }

	    $jsonData = json_encode($data);

	    return $jsonData;
    }
}
