<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdukRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'txtproduk' => 'required|string|max:255',
			'txtkategori' => 'required|string|max:255',
			'txtpemasok' => 'required|string|max:255',
			'txtkuantitas' => 'required|string|max:255',
			'txthargaperpcs' => 'required|string|max:255',

		];
	}
}
