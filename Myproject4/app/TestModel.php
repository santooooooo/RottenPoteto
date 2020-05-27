<?php

namespace App;

class TestModel
{
    static $test;

    public function setTest(): void
    {
	    self::$test = 'testdayo';
    }

    public function getTest()
    {
	    return self::$test;
    }
}

$sample = new TestModel();
echo $sample->getTest()."\n";

$sample->setTest();
echo $sample->getTest()."\n";
echo $sample->getTest()."\n";
