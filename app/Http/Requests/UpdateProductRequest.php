<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
    public function rules(){
        return [
            'product_name' => 'required',
            'description' => 'required',
            'cost' => 'required'
        ];
    }
    public function messages(){
        return [
            'product_name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'cost.required' => 'Cost is required'
        ];
    }
}
