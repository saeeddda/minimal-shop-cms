<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => 'required|max:100',
            'description' => 'required|max:600',
            'keywords' => 'required',
            'logo' => 'image|mimes:jpg,jpeg,png,gif',
            'icon' => 'image|mimes:jpg,jpeg,png,gif,ico'
        ];
    }
}
