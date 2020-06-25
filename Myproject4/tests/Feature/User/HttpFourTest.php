<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;
use App\Model\User\ReviewPageInfo;

class HttpFourTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;

    /**
     * get('/review-page/') request test.
     *
     * @return void
     */
    public function testExample()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class, 10)->create();

	    $id = '4';

	    $response = $this->call('GET', '/review-page?contribute_id='.$id);
		  //  , [
		  //  'contribute_id' => $id,
	    //]);

	    //test that whether $response has jsonData or not.
	    //Don't be worry if $response has more than one data.
      $response->assertJsonCount(1);
    }
}
