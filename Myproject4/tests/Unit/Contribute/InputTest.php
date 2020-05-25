<?php

namespace Tests\Unit\Contribute;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ContributeForm;

class InputTest extends TestCase
{
		/**
     *
     * @test
     * @return void
     * @dataProvider dataProvider
     */
    public function validateTest(string $item, $data, bool $expect)
    {
	    $request = new ContributeForm();
	    $rules = $request->rules();
	    $dataList = [$item => $data];

	    $validator = Validator::make($dataList, $rules);
	    $result = $validator->passes();

	    $this->assertEquals($result, $expect);
    }

    /**
     * @dataProvider dataProvider
     */
    public function dataProvider() :array
    {
	    $file = UploadedFile::fake()->image('cinema.gif');

	    return [
		    //'request' => ['title', 'cdhhurfhvujdgs', true],
		    //'request' => ['contents', 'dheuduhuhudeufh', true],
		    'request' => ['picture', $file, true],
		    //'requests' => ['genre', 'アニメ', true],
	    ];
    }
}
