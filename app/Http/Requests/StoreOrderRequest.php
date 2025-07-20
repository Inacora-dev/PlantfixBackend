<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'plants' => 'required|array',
            'plants.*.id' => 'required|exists:plants,id',
            'plants.*.quantity' => 'required|integer|min:1',
            'plants.*.price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone_number' => ['required', 'regex:/^[0-9]{9}$/']
        ];
        
    }
 
   public function messages()
{
    return [
        'plants.required' => 'You must select at least one plant.',
        'plants.array' => 'The plants field must be a valid array.',
        'plants.*.id.required' => 'Each plant must have an ID.',
        'plants.*.id.exists' => 'The selected plant does not exist.',
        'plants.*.quantity.required' => 'Each plant must have a quantity.',
        'plants.*.quantity.integer' => 'Quantity must be an integer.',
        'plants.*.quantity.min' => 'The minimum quantity for each plant is 1.',

        'plants.*.price.required' => 'Each plant must have a price.',
        'plants.*.price.numeric' => 'Price must be a valid number.',
        'plants.*.price.min' => 'Price must be at least 0.',

        'total_price.required' => 'Total price is required.',
        'total_price.numeric' => 'Total price must be a number.',
        'total_price.min' => 'Total price must be at least 0.',

        'address.required' => 'Address is required.',
        'address.string' => 'Address must be a string.',
        'address.max' => 'Address must not exceed 255 characters.',

        'city.required' => 'City is required.',
        'city.string' => 'City must be a string.',
        'city.max' => 'City must not exceed 255 characters.',

        'country.required' => 'Country is required.',
        'country.string' => 'Country must be a string.',
        'country.max' => 'Country must not exceed 255 characters.',

        'phone_number.required' => 'Phone number is required.',
        'phone_number.digits' => 'Phone number must be exactly9 digits.', 
    ];
}

}
