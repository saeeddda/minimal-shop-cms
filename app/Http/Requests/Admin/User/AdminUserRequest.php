<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->isMethod('POST')){
            return [
                'first_name' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'last_name' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'mobile' => 'required|digits:11|unique:users',
                'email' => 'required|email|string|unique:users',
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(8)->letters()->mixedCase()->numbers()->uncompromised()
                ],
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
                'activation' => 'required|numeric|in:0,1'
            ];
        }else{
            return [
                'first_name' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'last_name' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
                'activation' => 'required|numeric|in:0,1'
            ];
        }
    }
}
