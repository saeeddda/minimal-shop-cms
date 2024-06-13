<?php

namespace App\Http\Requests\Site\SaleProcess;

use Illuminate\Foundation\Http\FormRequest;

class AddAddressRequest extends FormRequest
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
            'address' => 'required|string|min:5',
            'postalcode' => "required",
            'number' => 'required',
            'unit' => 'required',
            'recipient_first_name' => 'required|string|min:4',
            'recipinet_last_name' => 'required|string|min:4',
            'mobile' => 'required',
            'city_id' => 'required|exists:cities,id'
        ];
    }
}
