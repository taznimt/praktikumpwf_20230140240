<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'category_id.required' => 'Category wajib dipilih.',
            'category_id.exists' => 'Category tidak valid.',

            'qty.required' => 'Jumlah produk wajib diisi.',
            'qty.integer' => 'Jumlah produk harus berupa angka bulat.',
            'qty.min' => 'Jumlah produk minimal 1.',

            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
            'price.min' => 'Harga produk minimal 1000.',
        ];
    }
}