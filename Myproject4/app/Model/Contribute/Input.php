<?php
declare(strict_types=1);

namespace App\Model\Contribute;

use App\Eloquent\Contribute;
use App\Http\Requests\ContributeForm;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

final class Input
{
	/**
	 * @var string $title
	 */
	private $title;
	/**
	 * @var string contents
	 */
	private $contents;
	/**
	 * @var UploadedFile $picture
	 */
	private $picture;
	/**
	 * @var string $genre
	 */
	private $genre;

	function __construct(ContributeForm $request)
	{
		$this->title = $request->input('title');
		$this->contents = $request->input('contents');
		$this->picture = $request->file('picture');
		$this->genre = $request->input('genre');
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
		$eloquent->genre = $this->genre;
		$eloquent->save();
	}
}
