<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;

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
	    factory(GoogleUser::class)->create();

	    $testData = DB::table('google_users')->where('id', '1')->value('gmail');

	    $response = $this->post('/signout', [
		    'gmail' => $testData,
	    ]);

	    $this->assertDatabaseMissing('google_users', [
		    'id' => 1,
		    'gmail' => $testData,
	    ]);

        $response->assertStatus(302);
    }
}
