<?php

namespace App;

class TestModel
{
	public function testfunc():void 
	{
		$test = null;
			if($test == false) {
				echo 'Success! Foo!';
				return;
			}
			echo 'False';
			return;
	}
}

$testob = TestModel::class;
var_dump($testob);
