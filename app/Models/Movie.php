<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
	use HasFactory;

	public function quotes()
	{
		return $this->hasMany(Quote::class);
	}
}