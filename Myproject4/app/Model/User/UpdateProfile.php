<?php
declare(strict_types=1);

namespace App\Model\User;

use Illuminate\Support\Facades\DB;
use App\Eloquent\GoogleUser;
use App\Http\Requests\UserProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UpdateProfile
{
	/**
	 * @var string $gmail
	 */
	private $gmail;
	/**
	 * @var string $name
	 */
	private $name;
	/**
	 * @var string $profile
	 */
	private $profile;
	/**
	 * @var UploadedFile $icon
	 */
	private $icon;
	/**
	 * @var string $best
	 */
	private $best;

	public function __construct(UserProfile $request)
	{
		$this->gmail = $request->input('gmail');
		$this->name = $request->input('name');
		$this->profile = $request->input('profile');
		$this->icon = $request->file('icon');
		$this->best = $request->input('best');
	}
	
	/**
	 * @return null | string
	 */
	public function iconPath()
	{
		if($this->icon == null)
		{
			return null;
		}
		$path = $this->icon->store('user');
		return $path;
	}

	/**
	 * I can't understand type of $path
	 */
	public function deleteIcon($path): void
	{
			if($path != null)
			{
				Storage::delete($path);
			}
	}

	/**
	 * @var string $isUser
	 * @var string $iconPath
	 * @var object $eloquent
	 */
	public function update(): void
	{
		$isUser = DB::table('google_users')->where('gmail', $this->gmail)->value('id');

		if($isUser != null)
		{
			$iconPath = $this->iconPath();

			$eloquent = GoogleUser::find($isUser);

			if($iconPath != null)
			{
				$this->deleteIcon($eloquent->icon);
				$eloquent->fill(['icon' => $iconPath]);
			}

			$eloquent->fill(
				['name' => $this->name, 
				'profile' => $this->profile,
				'best' => $this->best
			]);

			$eloquent->save();

			return;
		}
		return;
	}
}
