<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDistrictRequest extends FormRequest
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
            'district_name' => 'required',
        ];
    }
    public function messages(){
        return [
            'district_name.required' => 'District is required',
        ];
    }
}
