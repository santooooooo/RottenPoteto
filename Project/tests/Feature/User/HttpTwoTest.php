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

class HttpTwoTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;

    /**
     * post request(/review/input) test
     * @test
     * @return void
     */
    public function inputReviewTest()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();

	    $contributeId = 2;
	    $googleUserId = 9;
	    $title = bin2hex(random_bytes(127));
	    $review = bin2hex(random_bytes(1500));
	    $spoiler = 0;
	    $satisfaction = 3;
	    $recommended = 2;

	    $response = $this->post('/review/input', [
		    'contribute_id' => $contributeId,
		    'google_user_id' => $googleUserId,
		    'title' => $title,
		    'review' => $review,
		    'spoiler' => $spoiler,
		    'satisfaction' => $satisfaction,
		    'recommended' => $recommended,
	    ]);

	    $this->assertDatabaseHas('user_reviews', [
		    'id' => 1,
		    'contribute_id' => $contributeId,
		    'google_user_id' => $googleUserId,
		    'title' => $title,
		    'review' => $review,
		    'spoiler' => '',
		    'satisfaction' => $satisfaction,
		    'recommended' => $recommended,
	    ]);

	    $this->assertDatabaseHas('contributes', [
		    'id' => $contributeId,
		    'satisfaction' => $satisfaction,
		    'recommended' => $recommended,
	    ]);
    }

	/**
	 * post request(/review/delete) test
	 * test
	 * @return void
	 */
	public function deleteReviewTest()
	{
    factory(Contribute::class, 10)->create();
	  factory(GoogleUser::class, 10)->create();

	    $contributeId = 2;
	    $googleUserId = 9;
	    $title = 'おもしろかったかなーーーーーーーーーーーーー';
	    $review = 'ああああああああああああああああああああああああああああああああああああああああ';
	    $satisfaction = 3;
	    $recommended = 2;

	    $response = $this->post('/review/input', [
		    'contribute_id' => $contributeId,
		    'google_user_id' => $googleUserId,
		    'title' => $title,
		    'review' => $review,
		    'satisfaction' => $satisfaction,
		    'recommended' => $recommended,
	    ]);

    $eloquent = DB::table('user_reviews')->where('id', 1)->first();

    $contributeId = $eloquent->contribute_id;
    $googleUserId = $eloquent->google_user_id;

    $response = $this->post('/review/delete', [
	    'contribute_id' => $contributeId,
	    'google_user_id' => $googleUserId,
    ]);

    $response->assertSessionHas('message');

    $this->assertDatabaseMissing('user_reviews', [
	    'id' => 1,
	    'contribute_id' => $contributeId,
	    'google_user_id' => $googleUserId,
    ]);

    $this->assertDatabaseHas('contributes', [
	    'id' => $contributeId,
	    'satisfaction' => 0,
	    'recommended' => 0,
    ]);
	}
}
