<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'thumbnail' => 'required|image|max:4000',
            'name' => 'required|string|max:255',
            'description' => 'required|string|',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'group' => 'required|in:all,man,women',
            'category_id' => 'required|exists:categories,id',
            'is_visible' => 'boolean',
        ];
    }
}
