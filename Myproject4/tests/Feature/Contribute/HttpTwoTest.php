<?php

namespace Tests\Feature\Contribute;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;
use App\Eloquent\GoodPoint;

class HttpTwoTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;
    /**
     * post('/contribute/delete') request test.
     * @test
     * @return void
     */
    public function deleteTest()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class, 10)->create();
	    factory(GoodPoint::class)->create();

	    $id = 3;
	    $contribute = DB::table('contributes')->where('id', $id)->first();
	    $review = DB::table('user_reviews')->where('contribute_id', $contribute->id)->first();

	    $response = $this->post('/contribute/delete', [
		    'title' => $contribute->title,
	    ]);

	    $response->assertStatus(302);

	    $this->assertDatabaseMissing('contributes', [
		    'id' => $id,
	    ]);

	    $this->assertDatabaseMissing('user_reviews', [
		    'contribute_id' => $id,
	    ]);

	    $this->assertDatabaseMissing('good_points', [
		    'id' => $review->id,
	    ]);
    }
}
