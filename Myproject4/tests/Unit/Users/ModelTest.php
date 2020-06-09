<?php

namespace Tests\Unit\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Model\User\SignOut;

class ModelTest extends TestCase
{
	use RefreshDatabase;

    /**
     * Model/SignOut test.
     * @test
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
}
