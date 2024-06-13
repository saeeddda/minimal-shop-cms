<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.user.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.user.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $inputs = $request->all();
        $inputs['status'] = 1;

        Permission::create($inputs);
        return redirect()->route('admin.user.permission.index')->with('alert-success','مجوز افزوده شد');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.user.permission.index')->with('alert-success', 'مجوز حذف شد.');
    }
}
