<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
	use HasFactory;

	protected $fillable = ['body', 'user_id', 'quote_id'];

	protected static function boot()
	{
		parent::boot();

		static::creating(function ($comment) {
			$comment->user_id = auth()->id();
		});
	}

	public function quote()
	{
		return $this->belongsTo(Quote::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
