<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

<<<<<<<< HEAD:app/Http/Requests/StorePemasokRequest.php
class StorePemasokRequest extends FormRequest
========
class StoreProdukRequest extends FormRequest
>>>>>>>> dev/produk/be/han:app/Http/Requests/StoreProdukRequest.php
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'txtpemasok' => 'required',
            'txtdomisili' => 'required'
        ];
    }
}
