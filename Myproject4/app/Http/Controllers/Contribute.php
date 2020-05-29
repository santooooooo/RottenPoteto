<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContributeForm;
use App\Model\Contribute\Input;
use App\Model\Contribute\Output;

final class Contribute extends Controller
{
	function record(ContributeForm $request)
	{
		$input = new Input($request);
		$input->writeDB();
		return view('contribute');
	}

	function response(): string
	{
		$outputs = new Output();
		$json = $outputs->jsonData();
		return $json;
	}
}
