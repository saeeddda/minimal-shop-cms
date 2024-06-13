<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\BannerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.content.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.content.banner.create');
    }

    public function store(BannerRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');
            $result = $imageService->save($request->file('image'));

            if($result == false){
                return redirect()->route('admin.content.banner.index')->with('alert-danger','مشکلی در آپلود تصویر به وجود آمد');
            }

            $inputs['image'] = $result;
        }

        if(!strstr('https', $request->url) || !strstr('http', $request->url))
        {
            $inputs['url'] = 'https://' . $request->url;
        }

        Banner::create($inputs);

        return redirect()->route('admin.content.banner.index')->with('alert-success','بنر با موفقیت ایجاد شد');
    }


    public function edit(Banner $banner)
    {
        return view('admin.content.banner.edit', compact('banner'));
    }

    public function update(BannerRequest $request, Banner $banner, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image')){
            if(!empty($banner->image)){
                $imageService->deleteImage($banner->image);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banner');
            $result = $imageService->save($request->file('image'));

            if($result == false){
                return redirect()->route('admin.content.banner.index')->with('alert-danger','مشکلی در آپلود تصویر به وجود آمد');
            }

            $inputs['image'] = $result;
        }

        if(!strstr('https', $request->url) || !strstr('http', $request->url))
        {
            $inputs['url'] = 'https://' . $request->url;
        }

        $banner->update($inputs);

        return redirect()->route('admin.content.banner.index')->with('alert-success','بنر با موفقیت ویرایش شد');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.content.banner.index')->with('alert-success','بنر با موفقیت حذف شد');
    }

    public function status(Banner $banner){
        $banner->status = $banner->status == 1 ? 0 : 1;
        $result = $banner->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $banner->status == 1
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
