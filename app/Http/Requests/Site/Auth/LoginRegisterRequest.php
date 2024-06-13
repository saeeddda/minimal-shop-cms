<?php

namespace App\Http\Requests\Site\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRegisterRequest extends FormRequest
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
        return [
            'phone_email' => 'required|regex:/^[a-zA-Z0-9_.@\+]*$/'
        ];
    }

    public function attributes()
    {
        return [
            'phone_email' => 'ایمیل/شماره موبایل'
        ];
    }
}
