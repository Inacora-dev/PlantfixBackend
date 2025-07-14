<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:2048',
            'plant_family_id' => 'required|exists:plant_families,id',  ];
        }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'description.required' => 'The description field is required.',
            'stock.required' => 'The stock field is required.',
            'image_url.string' => 'The image URL must be a string.',
            'image_url.max' => 'The image URL may not be greater than 255 characters.',
            'plant_family_id.required' => 'The plant family ID field is required.',
            'plant_family_id.exists' => 'The selected plant family ID is invalid.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 0.',
            'stock.integer' => 'The stock must be an integer.',
            'stock.min' => 'The stock must be at least 0.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
        ];
    }

   
}
