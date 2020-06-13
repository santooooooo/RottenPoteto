<?php

namespace Tests\Unit\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Model\User\SignOut;
use App\Model\User\updateProfile;
use Illuminate\Http\UploadedFile;

class ModelTest extends TestCase
{
	use RefreshDatabase;

    /**
     * Model\User\SignOut test.
     * 
     * @return void
     */
    public function SignOutTest()
    {
	    factory(GoogleUser::class)->create();

	    $testData = DB::table('google_users')->where('id', '1')->value('gmail');

	    SignOut::signOut($testData);

	    $this->assertDatabaseMissing('google_users', [
		    'id' => 1,
		    'gmail' => $testData
	    ]);
    }

	 /**
	  * Model\User\updateFile test
	  * @test
	  * @return void
	  */
	 public function updateProfileTest()
	 {
	    factory(GoogleUser::class)->create();

	    $setGmail = DB::table('google_users')->where('id', '1')->value('gmail');

	    $name = "映画大好き太郎";
	    $profile = "スプラッター系の映画が大好きです！";
	    $icon = UploadedFile::fake()->image('account.gif');
	    $best = "Friday 13";

	    updateProfile::update($setGmail, $name, $profile, $icon, $best);

	    $this->assertDatabaseHas('google_users', [
		    'gmail' => $setGmail,
		    'name' => $name,
		    'profile' => $profile,
		    'best' => $best,
	    ]);
	 }
}
