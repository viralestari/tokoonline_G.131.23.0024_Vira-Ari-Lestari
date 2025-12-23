<?php

namespace App\Filament\Resources\ProductResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'produk_name' => 'required',
			'produk_code' => 'required',
			'price' => 'required|numeric',
			'tanggal_masuk' => 'required|date',
			'quantity' => 'required',
			'product_description_long' => 'required|string',
			'product_description_short' => 'required|string'
		];
    }
}
