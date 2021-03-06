<?php
declare(strict_types=1);

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class Contribute extends Model
{
	protected $fillable = [
		'title',
		'contents',
		'picture',
		'genre',
		'satisfaction',
		'recommended',
	];

	public function reviews()
	{
		return $this->hasMany('App\Eloquent\UserReview');
	}
}
