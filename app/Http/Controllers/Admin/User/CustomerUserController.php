<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CustomerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Notifications\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type', 0)->get();
        return view('admin.user.customer.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->file('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if($result == false){
                return redirect()->route('admin.user.customer.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['profile_photo_path'] = $result;
        }

        $inputs['user_type'] = 0;
        $inputs['password'] = Hash::make($request->password);

        User::create($inputs);

        $adminUser = User::find(1);
        $adminUser->notify(new NewUserRegistered([
            'message' => 'کاربر جدیدی ثبت نام کرد.'
        ]));

        return redirect()->route('admin.user.customer.index')
            ->with('alert-success','مشتری افزوده شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.customer.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, User $user, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->file('profile_photo_path')) {
            if(!empty($user->profile_photo_path)){
                $imageService->deleteImage($user->profile_photo_path);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if($result == false){
                return redirect()->route('admin.user.customer.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['profile_photo_path'] = $result;
        }

        $user->update($inputs);

        return redirect()->route('admin.user.customer.index')
            ->with('alert-success','مشتری ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();
        return redirect()->route('admin.user.customer.index')
            ->with('alert-success', 'مشتری مورد نظر حذف شد');
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
}
