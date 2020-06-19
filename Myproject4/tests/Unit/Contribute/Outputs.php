<?php

namespace Tests\Unit\Contribute;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Eloquent\Contribute;
use App\Model\Contribute\Output;
use Illuminate\Support\Facades\DB;

class Outputs extends TestCase
{
	use RefreshDatabase;
    /**
     * Check Eloquent.
     * test
     * @return void
     */
    public function eloquentTest()
    {
	    factory(Contribute::class)->create();

	    $this->assertDatabaseHas('contributes', [
		    'id' => 1,
	    ]);
    }

	 /**
		 * Check Output.php.
		 * @test
		 * @return void
	  */
		public function outputTest()
		{
	    factory(Contribute::class, 10)->create();
	    $eloquent = DB::table('contributes')->orderBy('id', 'desc')->get();
	    $jsonData = json_encode($eloquent);

	    $output = new Output();
	    $outputData = $output->jsonData();

	    $this->assertEquals($jsonData, $outputData);
		}
}
