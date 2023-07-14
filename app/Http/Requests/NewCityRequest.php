<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCityRequest extends FormRequest
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
            'country_id' => 'required',
            'city_name' => 'required',
        ];
    }
    public function messages(){
        return [
            'country_id' => 'Country is required',
            'city_name'=>'City is required',
        ];
    }
    public function prepareForValidation(){
        $this->merge([
            'city_name' => $this->new_city
        ]);
    }
}
