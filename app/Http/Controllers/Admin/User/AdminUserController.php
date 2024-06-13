<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = User::where('user_type', 1)->get();
        return view('admin.user.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.user.admin.create');
    }

    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->file('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if($result == false){
                return redirect()->route('admin.user.admin.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['profile_photo_path'] = $result;
        }

        $inputs['user_type'] = 1;
        $inputs['password'] = Hash::make($request->password);

        User::create($inputs);

        return redirect()->route('admin.user.admin.index')
            ->with('alert-success','کاربر ادمین افزوده شد.');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.user.admin.edit', compact('user'));
    }

    public function update(AdminUserRequest $request, User $user, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->file('profile_photo_path')) {
            if(!empty($user->profile_photo_path)){
                $imageService->deleteImage($user->profile_photo_path);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if($result == false){
                return redirect()->route('admin.user.admin.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['profile_photo_path'] = $result;
        }

        $user->update($inputs);

        return redirect()->route('admin.user.admin.index')
            ->with('alert-success','کاربر ادمین  ویرایش شد.');
    }

    public function destroy(User $user)
    {
        $user->forceDelete();
        return redirect()->route('admin.user.admin.index')
            ->with('alert-success', 'ادمین مورد نظر حذف شد');
    }

    public function status(User $user){
        $user->status = $user->status == 1 ? 0 : 1;
        $result = $user->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $user->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function activation(User $user){
        $user->activation = $user->activation == 1 ? 0 : 1;
        $result = $user->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $user->activation == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function role(User $user){
        $roles = Role::all();
        return view('admin.user.admin.role', compact('user', 'roles'));
    }

    public function roleStore(Request $request, User $user){
        $request->validate([
            'roles.*' => 'required|exists:roles,id'
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.user.admin.index')->with('alert-success', 'نقش کاربر تعیین شد');
    }

    public function permission(User $user){
        $permissions = Permission::all();
        return view('admin.user.admin.permission', compact('user', 'permissions'));
    }

    public function permissionStore(Request $request, User $user){
        $request->validate([
            'permissions.*' => 'required|exists:permissions,id'
        ]);

        $user->permissions()->sync($request->permissions);

        return redirect()->route('admin.user.admin.index')->with('alert-success', 'دسترسی های کاربر تعیین شد');
    }
}
