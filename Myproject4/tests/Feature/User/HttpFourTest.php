<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Eloquent\UserReview;
use App\Eloquent\GoogleUser;
use App\Eloquent\Contribute;

class HttpFourTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;

    /**
     * get('/review-page/') request test.
     * test
     * @return void
     */
    public function reviewPageInfoTest()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();
	    factory(UserReview::class, 10)->create();

	    $id = '4';

	    $response = $this->call('GET', '/review-page?contribute_id='.$id);

	    //test that whether $response has jsonData or not.
	    //Don't be worry if $response has more than one data.
      $response->assertJsonCount(1);
    }

	  /**
	   * get('/review-page/user/') request test.
	   * @test
		 * @return void
	   */
	   public function outputUserInfoTest()
	   {
	    factory(GoogleUser::class, 10)->create();

	    $id = '6';
	    $eloquent = DB::table('google_users')->where('id', $id)->first();
	    $testUserInfo = [
		    'id' => $eloquent->id,
		    'name' => $eloquent->name,
		    'profile' => $eloquent->profile,
		    'icon' => $eloquent->icon,
		    'best' => $eloquent->best,
	    ];

	    $response = $this->get('/review-page/user?google_user_id='.$id);

	    $response->assertStatus(200);
	    $response->assertExactJson($testUserInfo);
	   }
}
