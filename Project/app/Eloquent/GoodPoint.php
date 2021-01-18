<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class GoodPoint extends Model
{
	protected $fillable = [
		'google_user_id',
		'user_review_id',
	];
}
