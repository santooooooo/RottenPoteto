<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

	function response()
	{
		$outputs = new Output();
		$json = $outputs->jsonData();
		return $json;
	}
}
