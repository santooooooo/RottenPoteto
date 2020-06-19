<?php
declare(strict_types=1);

namespace App\Model\Contribute;

use App\Eloquent\Contribute;
use Illuminate\Support\Facades\DB;

final class Output
{
/**
 * @var object $eloquent
 */
	private $eloquent;

	function __construct()
	{
		$this->eloquent = DB::table('contributes')->orderBy('id', 'desc')->get();
	}

	public function jsonData(): string
	{
		$json = json_encode($this->eloquent);
		return $json;
	}
}
