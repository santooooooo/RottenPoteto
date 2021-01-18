<?php

namespace Tests\Unit\Contribute;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;
use App\Eloquent\GoodPoint;
use App\Model\Contribute\Delete;

class DeleteTest extends TestCase
{
	use RefreshDatabase;
    /**
     * \Model\Contribute\Delete test.
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

	    Delete::delete($contribute->title);

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
