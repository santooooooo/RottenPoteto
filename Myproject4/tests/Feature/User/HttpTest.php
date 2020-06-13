<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use Illuminate\Http\UploadedFile;

class HttpTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;
    /**
     * post request (/signout) test.
     * 
     * @return void
     */
    public function signOutTest()
    {
	    factory(GoogleUser::class)->create();

	    $testData = DB::table('google_users')->where('id', '1')->value('gmail');

	    $response = $this->post('/signout', [
		    'gmail' => $testData,
	    ]);

	    return $request->assertStatus(302);

	    $this->assertDatabaseMissing('google_users', [
		    'id' => 1,
		    'gmail' => $testData,
	    ]);
    }

	 /**
	  * post request (/update) test
	  * @test
	  * @return void
	  */
	 public function updateUserProfileTest()
	 {
	    factory(GoogleUser::class, 10)->create();

	    $setGmail = DB::table('google_users')->where('id', '4')->value('gmail');
	    $name = "mikel";
	    $profile = "スプラッター系の映画が大好きです！";
	    $icon = UploadedFile::fake()->image('account.gif');
	    $best = "Friday 13";

	    $response = $this->post('/update', [
		    'gmail' => $setGmail,
		    'name' => $name,
		    'profile' => null,
		    'icon' => $icon,
		    'best' => null,
	    ]);

	    $response->assertStatus(302);

	    $this->assertDatabaseHas('google_users', [
		    'id' => 4,
		    'gmail' => $setGmail,
		    'name' => $name,
		    'profile' => null,
		    'best' => null,
	    ]);
	 }
}
