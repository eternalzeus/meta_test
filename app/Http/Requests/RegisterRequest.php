<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:200']
        ];
    }
    public function messages(){
        return [
            'name.required'=>'User Name is required',
            'name.min'=>'User Name must has more than :min characters',
            'name.max'=>'User Name must has less than :max characters',
            'name.unique'=>'User Name has been taken',
            'email.required'=>'Email Address is required',
            'email.email'=>'Please enter a valid email',
            'email.unique'=>'The email has been registered before',
            'password.required'=>'Password is required',
            'password.min'=>'Password must has more than :min characters',
            'password.max'=>'Password must has less than :max characters'
        ];
    }
}
