<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;
use App\Model\User\InputReview;

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
	 * 
	 * @return void
	 */
	public function inputReviewTest()
	{
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();

	    $contribute_id = 4;
	    $google_user_id = 5;
	    $title = 'てすとだよ。';
	    $review = 'てすとだよ。てすとだよ。てすとだよ。';
	    $satisfaction = 3;
	    $recommended = 4;

	    InputReview::input(
		    $contribute_id,
		    $google_user_id,
		    $title,
		    $review,
		    $satisfaction,
		    $recommended
	    );

			$this->assertDatabaseHas('user_reviews', [
				'contribute_id' => $contribute_id,
				'google_user_id' => $google_user_id,
				'title' => $title,
				'review' => $review,
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
	    factory(Contribute::class)->create();
	    factory(GoogleUser::class)->create();
	    factory(UserReview::class)->create();

	    $eloquent = DB::table('user_reviews')->where('id', 1)->first();

	    $this->assertDatabaseMissing('user_reviews', [
		    'id' => $eloquent->id,
		    'contribute_id' => $eloquent->contribute_id,
		    'google_user_id' => $eloquent->google_user_id,
		    'title' => $eloquent->title,
		    'review' => $eloquent->review,
		    'satisfaction' => $eloquent->satisfaction,
		    'recommended' => $eloquent->recommended,
		    'good_point' => $eloquent->good_point,
	    ]);
	}
}
