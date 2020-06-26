<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Model\User\UserInfo;

class ModelSix extends TestCase
{
	use RefreshDatabase;
    /**
     * \Model\User\UserInfo test.
     * @test
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
}
