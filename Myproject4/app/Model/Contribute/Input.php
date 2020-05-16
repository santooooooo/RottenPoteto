<?php
declare(strict_types=1);

namespace App\Model\Contribute;

use App\Eloquent\Contribute;
use Illuminate\Http\Request;

final class Input
{
	function __construct(Request $request)
	{
		$this->title = $request->input('title');
		$this->contents = $request->input('contents');
		$this->picture = $request->file('picture');
	}

	public function picturePath(): string
	{
		$path = $this->picture->store('contribute');
		return $path;
	}

	public function writeDB(): void
	{
		$eloquent = new Contribute();
		$eloquent->title = $this->title;
		$eloquent->contents = $this->contents;
		$eloquent->picture = $this->picturePath();
		$eloquent->save();
	}
}
