<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContributeForm;
use App\Model\Contribute\Input;
use App\Model\Contribute\Output;
use Illuminate\View\View; 

final class Contribute extends Controller
{
	/**
	 * @return View
	 */
	function record(ContributeForm $request)
	{
		$input = new Input($request);
		$input->writeDB();
		return view('contribute');
	}

	/**
	 * @return string
	 */
	function response()
	{
		$outputs = new Output();
		$json = $outputs->jsonData();
		return $json;
	}
}
