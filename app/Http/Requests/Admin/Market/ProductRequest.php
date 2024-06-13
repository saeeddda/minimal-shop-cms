<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'name' => 'required|max:120',
                'introduction' => 'required|max:3000',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif',
                'weight' => 'required',
                'height' => 'required',
                'width' => 'required',
                'length' => 'required',
                'price' => 'required',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'brand_id' => 'required|min:1|numeric|exists:brands,id',
                'category_id' => 'required|min:1|numeric|exists:product_categories,id',
                'published_at' => 'required|numeric',
                'meta_key.*' => 'required',
                'meta_value.*' => 'required',
            ];
        }else{
            return [
                'name' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'introduction' => 'required|max:3000',
                'image' => 'image|mimes:jpg,jpeg,png,gif',
                'weight' => 'required',
                'height' => 'required',
                'width' => 'required',
                'length' => 'required',
                'price' => 'required',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'brand_id' => 'required|min:1|numeric|exists:brands,id',
                'category_id' => 'required|min:1|numeric|exists:product_categories,id',
                'published_at' => 'required|numeric'
            ];
        }
    }
}
