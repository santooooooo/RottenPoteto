<?php
declare(strict_types=1);
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
	protected $fillable = [
		'contribute_id',
		'google_user_id',
		'title',
		'review',
		'spoiler',
		'satisfaction',
		'recommended',
		'goog_point',
	];

	public function user()
	{
		return $this->belongsTo('App\Eloquent\GoogleUser', 'google_user_id');
	}
}
