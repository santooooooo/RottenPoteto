<?php
declare(strict_types=1);

namespace App\Model\Contribute;

use App\Eloquent\Contribute;

final class Output
{
	private $eloquent;

	function __construct()
	{
		$this->eloquent = Contribute::all();
	}

	public function jsonData()
	{
		$json = $this->eloquent->toJson();
		return $json;
	}
}
