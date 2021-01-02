<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;
use App\Eloquent\GoodPoint;

class HttpTestThree extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;
    /**
     * post(/good/push) request test.
     * @test
     * @return void
     */
    public function pushGoodTest()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class, 10)->create();

	    $userEloquent = DB::table('google_users')->where('id', 2)->first();
	    $reviewEloquent = DB::table('user_reviews')->where('id', 4)->first();

	    $response = $this->post('/api/good/push', [
		    'google_user_id' => $userEloquent->id,
		    'user_review_id' => $reviewEloquent->id,
	    ]);

	    $returnJson = ['bool' => true];

	    $response->assertJson($returnJson);

	    $this->assertDatabaseHas('good_points', [
		    'id' => 1,
		    'google_user_id' => $userEloquent->id,
		    'user_review_id' => $reviewEloquent->id,
	    ]);

	    $this->assertDatabaseHas('user_reviews', [
		    'id' => $reviewEloquent->id,
		    'good_point' => $reviewEloquent->good_point + 1,
	    ]);
    }

	/**
	 * post(/good/delete) request test
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

    $response = $this->post('/api/good/delete', [
	    'google_user_id' => $goodEloquent->google_user_id,
	    'user_review_id' => $goodEloquent->user_review_id,
    ]);

    $returnJson = ['bool' => true];

    $response->assertJson($returnJson);


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
