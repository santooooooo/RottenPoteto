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
use App\Model\User\DeleteGood;

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
    PushGood::push($userEloquent->id + 1, $reviewEloquent->id);

    $this->assertDatabaseHas('good_points', [
	    'id' => 1,
	    'google_user_id' => $userEloquent->id,
	    'user_review_id' => $reviewEloquent->id,
    ]);

    $this->assertDatabaseHas('user_reviews', [
	    'id' => $reviewEloquent->id,
	    'good_point' => $reviewEloquent->good_point + 2,
    ]);
	}

	/**
	 * App\Model\User\DeleteGood test
	 * test
	 * @return void
	 */
	public function deleteGoodTest()
	{
    factory(Contribute::class, 10)->create();
    factory(GoogleUser::class, 10)->create();
    factory(UserReview::class, 10)->create();
    factory(GoodPoint::class)->create();

    $goodEloquent = DB::table('good_points')->where('id', 1)->first();

    $reviewEloquent = DB::table('user_reviews')->where('id', $goodEloquent->user_review_id)->first();

    DeleteGood::delete($goodEloquent->google_user_id, $goodEloquent->user_review_id);

    $this->assertDatabaseMissing('good_points', [
	    'id' => 1,
	    'google_user_id' => $goodEloquent->google_user_id,
	    'user_review_id' => $goodEloquent->user_review_id,
    ]);

    $this->assertDatabaseHas('user_reviews', [
	    'id' => $goodEloquent->user_review_id,
	    'good_point' => $reviewEloquent->good_point - 1,
    ]);
	}
}
