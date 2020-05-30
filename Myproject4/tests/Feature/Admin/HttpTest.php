<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;

class HttpTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;
    /**
     * A basic feature test example.
     * 
     * @return void
     */
    public function resourceAdminTest()
    {
        $response = $this->get('/adminer');

        $response->assertStatus(200);
    }

    /**
     * Adminer authorization test
     * 
     * @return void
     */
    public function postAdminerLoginTest()
    {
	    $response = $this->post('/adminer', [
		    'gmail' => 'santo.shunsuke@gmail.com',
		    'password' => 'fjhvhervheusheuhjihmnv,klsheish@p-9-0'
	    ]);

	    $response->assertLocation('/adminer');
    }

    /**
     * @test
     * @return void
     */
    public function postControllUserTest()
    {
	    factory(GoogleUser::class)->create();

	    $testData = DB::table('google_users')->where('id', 1)->value('gmail');

	    $response = $this->post('/adminer/safety', [
		    'gmail' => $testData,
	    ]);

	    $testSafety = DB::table('google_users')->where('id', 1)->value('safety');

	    $this->assertEquals(0, $testSafety);
    }
}
