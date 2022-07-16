<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use Exception;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Resources\QuoteResource;

class QuoteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return QuoteResource::collection(Quote::all());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(QuoteRequest $request)
	{
		$image_path = $this->saveImage($request->thumbnail);

		$quote = Quote::create(
			[
				'quote' => [
					'en' => $request->quote_en,
					'ka' => $request->quote_ka,
				],
				'movie_id'  => 1,
				'thumbnail' => $image_path,
			]
		);

		return new QuoteResource($quote);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Quote $quote
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Quote $quote)
	{
		return new QuoteResource($quote);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Quote        $quote
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Quote $quote)
	{
		return new QuoteResource($quote);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Quote $quote
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Quote $quote)
	{
		$quote->delete();
		return response()->json(['message' => 'Quote deleted successfully']);
	}

	private function saveImage($image)
	{
		if (preg_match('/^data:image\/(\w+);base64,/', $image, $type))
		{
			$image = substr($image, strpos($image, ',') + 1);
			$type = strtolower($type[1]);

			if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png']))
			{
				throw new Exception('invalid image type');
			}

			$image = str_replace(' ', '+', $image);
			$image = base64_decode($image);
		}
		else
		{
			throw new Exception('Invalid image type.');
		}

		$dir = 'images/';
		$file_name = uniqid() . '.' . $type;
		$absolutePath = public_path($dir);
		$relativePath = $dir . $file_name;
		if (!file_exists($absolutePath))
		{
			File::makeDirectory($absolutePath, 0775, true);
		}
		file_put_contents($relativePath, $image);

		return $relativePath;
	}
}