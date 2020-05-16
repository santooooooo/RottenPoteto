<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Contribute\Input;
use Eloquent\Contribute;


class ContributeInput extends TestCase
{
    /**
     * A basic unit test example.
     *@test
     */
    public function contribute()
    {
	    $response = $this->post('/contribute');
	    $response->assertStatus();
    }
}
