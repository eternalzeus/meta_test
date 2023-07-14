<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
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
            'city_id' => 'required',
            'district_id' => 'required',
            'user_address' => 'required',
        ];
    }
    public function messages(){
        return [
            'country_id' => 'Country is required',
            'city_id' => 'City is required',
            'district_id' => 'District is required',
            'user_address' => 'Address is required',
        ];
    }
}
