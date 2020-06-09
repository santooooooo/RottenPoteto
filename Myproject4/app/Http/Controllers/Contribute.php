<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContributeForm;
use App\Model\Contribute\Input;
use App\Model\Contribute\Output;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class Contribute extends Controller
{
	/**
	 * @return RedirectResponse
	 */
	function record(ContributeForm $request)
	{
		$input = new Input($request);
		$input->writeDB();
		return redirect('adminer')->with('message', 'レビュー記事の投稿が成功しました。');
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
