<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'name' => 'required|max:120|min:2',
            'amount' => 'required|regex:/^[0-9]+$/u',
            'delivery_time' => 'required|integer',
            'delivery_time_unit' => 'required',
            'status' => 'required|numeric|in:0,1'
        ];
    }
}
