<?php

namespace App;

class MyDestructableClass 
{
	public function test()
	{
		return "hello!";
	}
}

$obj = new MyDestructableClass();
return $obj->test();
exit();
