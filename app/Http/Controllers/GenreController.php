<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;

class GenreController extends Controller
{
	public function index()
	{
		return GenreResource::collection(Genre::all());
	}
}