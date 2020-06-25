<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;
use App\Model\User\ReviewPageInfo;

class ModelFive extends TestCase
{
	use RefreshDatabase;

    /**
     * App\Model\User\ReviewPageInfo test.
     * @test
     * @return void
     */
    public function ReviewPageInfoTest()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class, 50)->create();

	    $id = '3';
	    $testData = [];
	    $contribute = DB::table('contributes')->where('id', $id)->first();
	    $testData["contribute"] = [
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

		    $testData["reviews"][$i] = [
			    'reviewId' => $eloquent->id,
			    'title' => $eloquent->title,
			    'review' => $eloquent->review,
			    'spoiler' => $eloquent->spoiler,
			    'satisfaction' => $eloquent->satisfaction,
			    'recommended' => $eloquent->recommended,
			    'userName' => $eloquent->user->name,
			    'userIcon' => $eloquent->user->icon
		    ];
	    }

	    $jsonTestData = json_encode($testData);

	    $jsonReviewData = ReviewPageInfo::outputInfo($id);

      $this->assertEquals($jsonTestData, $jsonReviewData);
    }
}
