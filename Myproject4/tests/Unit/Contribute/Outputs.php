<?php

namespace Tests\Unit\Contribute;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Eloquent\Contribute;
use App\Model\Contribute\Output;

class Outputs extends TestCase
{
	use RefreshDatabase;
    /**
     * Check Eloquent.
     * @test
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
		 * 
		 * @return void
	  */
		public function outputTest()
		{
	    factory(Contribute::class)->create();
	    $eloquent = Contribute::all();
	    $jsonData = $eloquent->toJson();

	    $output = new Output();
	    $outputData = $output->jsonData();

	    $this->assertEquals($jsonData, $outputData);
		}
}
