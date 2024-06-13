<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class RoleRequest extends FormRequest
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
        $route = Route::current();

        if($route->getName() == 'admin.user.role.store') {
            return [
                'name' => 'required|max:120',
                'description' => 'required|max:20',
                'permissions.*' => 'exists:permissions,id'
            ];
        }else if($route->getName() == 'admin.user.role.update'){
            return [
                'name' => 'required|max:120',
                'description' => 'required|max:20'
            ];
        }else if($route->getName() == 'admin.user.role.permission-update'){
            return [
                'permissions.*' => 'exists:permissions,id'
            ];
        }
    }
}
