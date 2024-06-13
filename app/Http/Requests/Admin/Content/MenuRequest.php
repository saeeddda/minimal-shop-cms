<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
            'url' => 'required',
            'status' => 'required|numeric|in:0,1',
            'parent_id' => 'nullable|min:1|exists:menus,id|'
        ];
    }
}
