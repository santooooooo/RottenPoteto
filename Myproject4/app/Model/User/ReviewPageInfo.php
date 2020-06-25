<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Eloquent\Contribute;
use Illuminate\Support\Facades\DB;

class ReviewPageInfo
{
    static function outputInfo(string $contributeId): string
    {
	    $contribute = DB::table('contributes')->where('id', $contributeId)->first();
	    $data = [];

	    $data["contribute"] = [
		    'id' => $contribute->id,
		    'title' => $contribute->title,
		    'contents' => $contribute->contents,
		    'picture' => $contribute->picture,
		    'genre' => $contribute->genre,
		    'satisfaction' => $contribute->satisfaction,
		    'recommended' => $contribute->recommended
	    ];

	    $eloquents = Contribute::find($contribute->id)->reviews()->orderBy('id', 'desc')->get();
	    for($i = 0; $i < count($eloquents); $i++)
	    {
		    $eloquent = $eloquents[$i];

		    $data["reviews"][$i] = [
			    'reviewId' => $eloquent->id,
			    'title' => $eloquent->title,
			    'review' => $eloquent->review,
			    'spoiler' => $eloquent->spoiler,
			    'satisfaction' => $eloquent->satisfaction,
			    'recommended' => $eloquent->recommended,
			    'goodPoint' => $eloquent->good_point,
			    'userId' => $eloquent->user->id,
			    'userName' => $eloquent->user->name,
			    'userIcon' => $eloquent->user->icon
		    ];
	    }

	    $jsonData = json_encode($data);

	    return $jsonData;
    }
}
