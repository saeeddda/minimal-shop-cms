<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'name' => 'required|max:100|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'description' => 'required|max:600',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'parent_id' => 'nullable|min:1|exists:product_categories,id',
                'show_in_menu' => 'required|numeric|in:0,1'
            ];
        }else{
            return [
                'name' => 'required|max:100|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'description' => 'required|max:600',
                'image' => 'image|mimes:jpg,jpeg,png,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'parent_id' => 'nullable|min:1|exists:product_categories,id',
                'show_in_menu' => 'required|numeric|in:0,1'
            ];
        }
    }
}
