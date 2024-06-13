<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|string',
            'amount_type' => 'required|numeric|in:0,1',
            'amount' => ['required', 'numeric', (request()->amount_type == 0) ? 'max:100' : ''],
            'type' => 'required|numeric|in:0,1',
            'user_id' => 'nullable|required_if:type,==,1|exists:users,id',
            'discount_selling' => 'nullable',
            'status' => 'required|numeric|in:0,1',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
