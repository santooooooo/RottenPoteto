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
	    factory(UserReview::class, 10)->create();

	    $id = 3;
	    $testData = [];
	    $contribute = Contribute::find($id)->first();
		  $testData["contribute"] = [$contribute->title, $contribute->contents, $contribute->picture,
		  $contribute->genre, $contribute->satisfaction,$contribute->recommended];

	    $eloquents = Contribute::find($id)->reviews;
	    for($i = 0; $i < count($eloquents); $i++)
	    {
		    $eloquent = $eloquents[$i];

		    $testData["reviews"][$i] = [$eloquent->title, $eloquent->review, $eloquent->spoiler,
		    $eloquent->satisfaction, $eloquent->recommended, $eloquent->user->name, $eloquent->user->icon];
	    }

	    $jsonTestData = json_encode($testData);

	    $jsonReviewData = ReviewPageInfo::reviewInfo($id);

      $this->assertEquals($jsonTestData, $jsonReviewData);
    }
}
