<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
	use HasFactory;

	protected $guarderd = [];

	public function quotes()
	{
		return $this->belongsTo(Quote::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
