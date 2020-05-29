<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class HttpTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;
    /**
     * A basic feature test example.
     * 
     * @return void
     */
    public function resourceAdminTest()
    {
        $response = $this->get('/adminer');

        $response->assertStatus(200);
    }

    /**
     * Adminer authorization test
     * @test
     * @return void
     */
    public function postAdminerLoginTest()
    {
	    $response = $this->post('/adminer', [
		    'email' => 'santo.shunsuke@gmail.com',
		    'password' => 'fjhvhervheusheuhjihmnv,klsheish@p-9-0'
	    ]);

	    $response->assertSessionHas('message', '管理者として認証できませんでした。');
    }
}
