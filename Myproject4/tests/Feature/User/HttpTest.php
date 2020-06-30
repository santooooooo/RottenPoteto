<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Eloquent\UserReview;
use App\Eloquent\Contribute;
use App\Eloquent\GoodPoint;
use Illuminate\Http\UploadedFile;

class HttpTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;
    /**
     * post request (/signout) test.
     * @test
     * @return void
     */
    public function signOutTest()
    {
	    factory(Contribute::class, 10)->create();
	    factory(GoogleUser::class, 10)->create();

	    $userId = 4;
	    $testData = DB::table('google_users')->where('id', $userId)->value('gmail');

			$contributeId = 2;
	    $googleUserId = $userId;
	    $title = 'おもしろかったかなーーーーーーーーーーーーー';
	    $review = 'ああああああああああああああああああああああああああああああああああああああああ';
	    $spoiler = 0;
	    $satisfaction = 3;
	    $recommended = 2;

	    $this->post('/review/input', [
		    'contribute_id' => $contributeId,
		    'google_user_id' => $googleUserId,
		    'title' => $title,
		    'review' => $review,
		    'spoiler' => $spoiler,
		    'satisfaction' => $satisfaction,
		    'recommended' => $recommended,
	    ]);

	    $reviewEloquent = DB::table('user_reviews')->where('id', 1)->first();

	    $this->post('/good/push', [
		    'google_user_id' => $userId,
		    'user_review_id' => $reviewEloquent->id,
	    ]);

	    //test request
	    $response = $this->post('/signout', [
		    'gmail' => $testData,
	    ]);

	    $response->assertStatus(302);

	    $this->assertDatabaseMissing('google_users', [
		    'id' => $userId,
		    'gmail' => $testData,
	    ]);

      $this->assertDatabaseMissing('user_reviews', [
		    'google_user_id' => $userId,
	    ]);
	    
	    $this->assertDatabaseMissing('good_points', [
		    'google_user_id' => $userId,
	    ]);
    }

	 /**
	  * post request (/update) test
	  * test
	  * @return void
	  */
	 public function updateUserProfileTest()
	 {
	    factory(GoogleUser::class, 10)->create();

	    $setGmail = DB::table('google_users')->where('id', '4')->value('gmail');
	    $name = "mikel";
	    $profile = "スプラッター系の映画が大好きです！";
	    $icon = null;//UploadedFile::fake()->image('account.png');
	    $best = "Friday 13";

	    $response = $this->post('/update', [
		    'gmail' => $setGmail,
		    'name' => $name,
		    'profile' => $profile,
		    'icon' => $icon,
		    'best' => $best,
	    ]);

	    $response->assertStatus(302);

	    $this->assertDatabaseHas('google_users', [
		    'id' => 4,
		    'gmail' => $setGmail,
		    'name' => $name,
		    'profile' => $profile,
		    'best' => $best,
	    ]);
	 }

	  /**
	   * get('/user-info') request test.
	   * test
		 * @return void
	   */
	   public function outputUserInfoTest()
	   {
	    factory(GoogleUser::class, 10)->create();

	    $id = '6';
	    $eloquent = DB::table('google_users')->where('id', $id)->first();
	    $testUserInfo = [
		    'id' => $eloquent->id,
		    'gmail' => $eloquent->gmail,
		    'name' => $eloquent->name,
		    'profile' => $eloquent->profile,
		    'icon' => $eloquent->icon,
		    'best' => $eloquent->best,
	    ];

	    $response = $this->get('/user-info?google_user_gmail='.$eloquent->gmail);

	    $response->assertStatus(200);
	    $response->assertExactJson($testUserInfo);
	   }
}
