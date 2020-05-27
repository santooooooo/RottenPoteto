<?php

namespace Tests\Unit\OAuth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Model\User\Judge;
use App\Model\User\SignIn;
use App\Model\User\SignUp;

class ModelTest extends TestCase
{
	use RefreshDatabase;
    /**
     * Elouent Test.
     * 
     * @return void
     */
    public function eloquentTest()
    {
	    factory(GoogleUser::class)->create();

	    $this->assertDatabaseHas('google_users', [
		    'id' => 1,
	    ]);
    }

    /**
     * Elouent Test.
     * 
     * @return void
     */
    public function judgeTest()
    {
	    factory(GoogleUser::class, 10)->create();

	    $testData = DB::table('google_users')->where('id','=', '10')->value('gmail');
	    $judge = Judge::judge($testData);

	    $this->assertTrue($judge);
    }

		/**
     * Sign up test.
     * 
     * @return void
     */
    public function signUpTest()
    {
	    $data = [
		    'name' => 'テスト太郎',
		    'gmail' => 'testtarou@gmail.com'
	    ];

	    SignUp::signUp($data);

	    $this->assertDatabaseHas('google_users', [
		    'name' => $data['name'],
		    'gmail' => $data['gmail']
	    ]);
    }

    /**
     * Sign in test.
     * @test
     *
     * @return void
     */
    public function signInTest()
    {
	    factory(GoogleUser::class, 1)->create();

	    $data = DB::table('google_users')->where('id', '1')->first();

	    $dataArray = [
		    'id' => $data->id,
		    'name' => $data->name,
		    'profile' => $data->profile,
		    'icon' => $data->icon,
		    'best' => $data->best,
		    'safety' => $data->safety,
	    ];
	    $testData = json_encode($dataArray);

	    $jsonData = SignIn::signIn($data->gmail);

	    $this->assertEquals($jsonData, $testData);
    }
}
