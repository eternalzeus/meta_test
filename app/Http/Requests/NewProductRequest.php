<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewProductRequest extends FormRequest
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
            'cost' => 'required',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|required'
        ];
    }
    public function messages(){
        return [
            'product_name.required'=>'Product name is required',
            'cost.required' => 'Product cost is required',
            'description.required' => 'Product description is required',
            'images.*.image' => 'The input file must be images',
            'images.*.mimes' => 'The image type must be jpeg,png,jpg,gif',
            'images.*.max' => "The size of the file is too big (max:2 MB)",
            'images.*.required' => 'Please add image for the product',
        ];
    }
}
