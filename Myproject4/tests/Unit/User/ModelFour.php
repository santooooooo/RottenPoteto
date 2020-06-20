<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;
use App\Eloquent\GoodPoint;
use App\Model\User\PushGood;

class ModelFour extends TestCase
{
	use RefreshDatabase;
    /**
     * eloquent GoodPoints test.
     * test
     * @return void
     */
    public function eloquentTest()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class, 100)->create();
	    factory(GoodPoint::class)->create();

	    $eloquent = DB::table('good_points')->where('id', 1)->first();

	    $this->assertDatabaseHas('good_points', [
		    'id' => 1,
		    'google_user_id' => $eloquent->google_user_id,
		    'user_review_id' => $eloquent->user_review_id,
	    ]);
    }

	/**
	 * App\Model\User\PushGood test
	 * @test
	 * @return void
	 */
	public function pushGoodTest()
	{
    factory(Contribute::class, 10)->create();
    factory(GoogleUser::class, 10)->create();
    factory(UserReview::class, 1)->create();

    $userEloquent = DB::table('google_users')->where('id', 6)->first();
    $reviewEloquent = DB::table('user_reviews')->where('id', 1)->first();

    PushGood::push($userEloquent->id, $reviewEloquent->id);

    $this->assertDatabaseHas('good_points', [
	    'id' => 1,
	    'google_user_id' => $userEloquent->id,
	    'user_review_id' => $reviewEloquent->id,
    ]);
	}
}
