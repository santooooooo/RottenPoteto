<?php
declare(strict_types=1);

namespace Tests\Unit\Adminer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Model\Adminer\CheckAdminer;

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
}
