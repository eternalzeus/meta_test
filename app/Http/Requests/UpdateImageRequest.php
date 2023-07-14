<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    public function messages(){
        return [
            'images.image' => 'The input file must be images',
            'images.mimes' => 'The image type must be jpeg,png,jpg,gif',
            'images.max' => "The size of the file is too big (max:2 MB)"
        ];
    }
}