<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Model\User\UserInfo;
use App\Model\User\Profile;

class ModelSix extends TestCase
{
	use RefreshDatabase;
    /**
     * \Model\User\UserInfo test.
     * test
     * @return void
     */
    public function userInfoTest()
    {
	    factory(GoogleUser::class)->create();

	    $userId = '1';
	    $eloquent = DB::table('google_users')->where('id', $userId)->first();
	    $testUserInfo = [
		    'id' => $eloquent->id,
		    'name' => $eloquent->name,
		    'profile' => $eloquent->profile,
		    'icon' => $eloquent->icon,
		    'best' => $eloquent->best,
	    ];
	    $testData = json_encode($testUserInfo);

	    $userInfo = UserInfo::output($userId);

      $this->assertEquals($userInfo, $testData);
    }

	   /**
		  * \Model\User\Profilr test.
		  * @test
		  * @return void
	    */
	   public function profileTest()
	   {
	    factory(GoogleUser::class)->create();

	    $userId = '1';
	    $eloquent = DB::table('google_users')->where('id', $userId)->first();
	    $testUserInfo = [
		    'id' => $eloquent->id,
		    'gmail' => $eloquent->gmail,
		    'name' => $eloquent->name,
		    'profile' => $eloquent->profile,
		    'icon' => $eloquent->icon,
		    'best' => $eloquent->best,
	    ];

	    $testData = json_encode($testUserInfo);

	    $jsonData = Profile::output($eloquent->gmail);

	    $this->assertEquals($jsonData, $testData);
	   }
}
