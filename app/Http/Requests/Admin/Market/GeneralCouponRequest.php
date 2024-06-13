<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class GeneralCouponRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'percentage' => 'required|numeric|max:100',
            'discount_selling' => 'nullable',
            'minimum_order_amount' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
