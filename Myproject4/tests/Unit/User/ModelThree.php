<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;
use App\Model\User\GradeCinema;

class ModelThree extends TestCase
{
	use RefreshDatabase;

    /**
     * \Model\User\GradeCinema test.
     * @test
     * @return void
     */
    public function gradeCinemaTest()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class, 10)->create();

	    $testId = 1;

	    $eloquents = DB::table('user_reviews')->where('contribute_id', $testId)->get();
	    $allSatisfaction = 0;
	    $allRecommended = 0;

	    foreach($eloquents as $eloquent)
	    {
		    $allSatisfaction += $eloquent->satisfaction;
		    $allRecommended += $eloquent->recommended;
	    }

	    $number = DB::table('user_reviews')->where('contribute_id', $testId)->count();
	    if($number != 0)
	    {
		    $satisfactionAverage = round($allSatisfaction / $number, 2);
		    $recommendedAverage = round($allRecommended / $number, 2);
	    } else {
		    $satisfactionAverage = 0;
		    $recommendedAverage = 0;
	    }

	    GradeCinema::grade($testId);

	    $this->assertDatabaseHas('contributes', [
		    'id' => $testId,
		    'satisfaction' => $satisfactionAverage,
		    'recommended' => $recommendedAverage,
	    ]);
    }
}
