<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\GoodPoint;
use App\Eloquent\Contribute;
use App\Model\User\InputReview;
use App\Model\User\DeleteReview;
use App\Model\User\PushGood;

class ModelTwo extends TestCase
{
	use RefreshDatabase;
    /**
     * DB UserReviews test.
     * 
     *
     * @return void
     */
    public function eloquentTest()
    {
	    factory(Contribute::class)->create();
	    factory(GoogleUser::class)->create();
	    factory(UserReview::class)->create();
	    $eloquent = DB::table('user_reviews')->where('id', 1)->first();

			$this->assertDatabaseHas('user_reviews', [
				'id' => $eloquent->id,
				'contribute_id' => $eloquent->contribute_id,
				'google_user_id' => $eloquent->google_user_id,
				'title' => $eloquent->title,
				'text' => $eloquent->text,
				'satisfaction' => $eloquent->satisfaction,
				'recommended' => $eloquent->recommended,
				'good_point' => $eloquent->good_point,
			]);
    }

	/**
	 * Model/User/InputReview test
	 * test
	 * @return void
	 */
	public function inputReviewTest()
	{
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class)->create();

	    $contribute_id = 1;
	    $google_user_id = 2;
	    $title = 'てすとだよ。';
	    $review = 'てすとだよ。てすとだよ。てすとだよ。';
	    $spoiler = 0;
	    $satisfaction = 3;
	    $recommended = 4;

	    InputReview::input(
		    $contribute_id,
		    $google_user_id,
		    $title,
		    $review,
		    $spoiler,
		    $satisfaction,
		    $recommended
	    );

			$this->assertDatabaseHas('user_reviews', [
				'contribute_id' => $contribute_id,
				'google_user_id' => $google_user_id,
				'title' => $title,
				'review' => $review,
				'spoiler' => '',
				'satisfaction' => $satisfaction,
				'recommended' => $recommended,
			]);
	}

	/**
	 * Model/User/DeleteReview
	 * @test
	 * @return void
	 */
	public function deleteReviewTest()
	{
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class, 10)->create();
    	factory(GoodPoint::class, 10)->create();

	    $eloquent = DB::table('user_reviews')->where('id', 1)->first();

	    DeleteReview::delete($eloquent->contribute_id, $eloquent->google_user_id);

	    $this->assertDatabaseMissing('user_reviews', [
		    'id' => $eloquent->id,
		    'contribute_id' => $eloquent->contribute_id,
		    'google_user_id' => $eloquent->google_user_id,
		    'title' => $eloquent->title,
		    'review' => $eloquent->review,
		    'spoiler' => $eloquent->spoiler,
		    'satisfaction' => $eloquent->satisfaction,
		    'recommended' => $eloquent->recommended,
		    'good_point' => $eloquent->good_point,
	    ]);

	    //if values entered by someone are unvalid
//	    $unvalid = DeleteReview::delete(20, $eloquent->google_user_id);
//	    $this->assertFalse($unvalid);
	}
}
