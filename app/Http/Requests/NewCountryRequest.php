<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCountryRequest extends FormRequest
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
            'country_name' => 'required'
        ];
    }
    public function messages(){
        return [
            'country_name'=>'Country is required',
        ];
    }
    public function prepareForValidation(){
        $this->merge([
            'country_name' => $this->new_country
        ]);
    }
}
