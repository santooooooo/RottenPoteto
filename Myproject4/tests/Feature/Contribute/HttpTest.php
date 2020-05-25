<?php

namespace Tests\Feature\Contribute;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Eloquent\Contribute;
use Illuminate\Http\UploadedFile;

class HttpTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;

    /**
     * A get resource.
     * 
     * @return void
     */
    public function getTest()
    {
        $response = $this->get('/contribute');

        $response->assertStatus(200);
    }

		/**
     * A eloquent test.
     * @test
     * @return void
     */
    public function inputAllTest()
    {
	    $file = UploadedFile::fake()->image('cinema.gif');

	    $response = $this->post('/contribute', [
		    'title' => 'test',
		    'contents' => 'vkfnkvfejvkejvk',
		    'picture' => $file,
		    'genre' => 'アニメ'
	    ]);

	     $this->assertDatabaseHas('contributes', [
		     'id' => 1,
	     ]);
    }
}
