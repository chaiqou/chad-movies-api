<?php

namespace App\Http\Requests;

use App\Rules\Lowercase;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'name'     => ['required', 'min:3', 'max:15', new Lowercase],
			'password' => ['required', 'min:8', 'max:15', 'confirmed', new Lowercase],
			'email'    => ['required', 'email', 'unique:users'],
		];
	}
}
