<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
                'title' => 'required|string',
                'url' => 'required|string',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'position' => 'required|numeric|in:0,1,2,3',
                'status' => 'required|numeric|in:0,1',
            ];
        }else{
            return [
                'title' => 'required|string',
                'url' => 'required|string',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'position' => 'required|numeric|in:0,1,2,3',
                'status' => 'required|numeric|in:0,1',
            ];
        }
    }
}
