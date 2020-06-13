<?php
declare(strict_types=1);

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class GoogleUser extends Model
{
	protected $fillable = [
		'gmail',
		'name',
		'profile',
		'icon',
		'best'
	];
}
