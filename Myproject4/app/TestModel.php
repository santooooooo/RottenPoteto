<?php

namespace App;

class TestModel
{
	private $level = "saiyajin2";
}

$dbz                = new TestModel();
$ReflectionProperty = new \ReflectionProperty(TestModel::class, "level");
$ReflectionProperty->setAccessible(true);
$level              = $ReflectionProperty->getValue($dbz);
print_r($level);
