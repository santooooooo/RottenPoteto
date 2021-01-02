<?php

namespace Tests\Feature\OAuth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class HttpTest extends TestCase
{
	use WithoutMiddleware;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function resourceTest()
    {
        $response = $this->get('/login/oauth');

        $response->assertStatus(200);
    }
}
