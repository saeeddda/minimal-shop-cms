<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'summary' => 'required|max:600|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'body' => 'required',
                'category_id' => 'required|min:1|numeric|exists:post_categories,id',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'published_at' => 'required|numeric'
            ];
        }else{
            return [
                'title' => 'required|max:120|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'summary' => 'required|max:600|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'body' => 'required',
                'category_id' => 'required|min:1|numeric|exists:post_categories,id',
                'image' => 'image|mimes:jpg,jpeg,png,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9ي\-۰-۹-ء., ]+$/u',
                'published_at' => 'numeric'
            ];
        }
    }
}
