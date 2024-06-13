<?php

namespace App\Http\Requests\Site\SaleProcess;

use Illuminate\Foundation\Http\FormRequest;

class SetAddressAndDeliveryRequest extends FormRequest
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
            'address_id' => 'required|exists:addresses,id',
            'delivery_id' => 'required|exists:delivery,id',
        ];
    }
}
