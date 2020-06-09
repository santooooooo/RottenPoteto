<?php
declare(strict_types=1);

namespace Tests\Unit\Adminer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Model\Adminer\CheckAdminer;
use App\Model\Adminer\ChangeSafety;
use App\Model\Adminer\UsersData;

final class ModelTest extends TestCase
{
	use RefreshDatabase;
    /**
     * checkAdminer test.
     * 
     *
     * @return void
     */
    public function checkAdminerTest()
    {
	    $testData = [
		    'name' => 'Shunsuke Santoh',
		    'gmail' => 'santo.shunsuke@gmail.com',
	    ];

	    $eloquent = new GoogleUser();
	    $eloquent->name = $testData['name'];
	    $eloquent->gmail = $testData['gmail'];
	    $eloquent->save();

	    $test = CheckAdminer::check($testData['gmail']);

	    $this->assertTrue($test);
    }

	 /**
	  * ChangeSafety::change test
	  * 
	  * @return void
	  */
	public function changeSafetyTest()
	{
	    factory(GoogleUser::class)->create();

	    $gmail = DB::table('google_users')->where('id', 1)->value('gmail');

	    ChangeSafety::change($gmail);
	    $safety = DB::table('google_users')->where('id', 1)->value('safety');

	    $this->assertEquals(0, $safety);
	}

	 /**
	  * usersData::jsonData test
	  * @test
	  * @return void
	  */
	public function usersDataTest()
	{
		 factory(GoogleUser::class)->create();
		 $eloquent = GoogleUser::all();
		 $testData = $eloquent->toJson();
		 $encodeData = base64_encode($testData);

		 $jsonData = usersData::jsonData();

		 $this->assertEquals($encodeData, $jsonData);
	}
}
