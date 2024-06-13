<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.market.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.market.brand.create');
    }

    public function store(BrandRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('logo')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->save($request->file('logo'));

            if($result == false){
                return redirect()->route('admin.market.brand.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['logo'] = $result;
        }

        Brand::create($inputs);

        return redirect()->route('admin.market.brand.index')
            ->with('alert-success','برند جدید اضافه شد.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image')){
            if(!empty($brand->logo)){
                $imageService->deleteDirectoryAndFiles($brand->logo['directory']);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->save($request->file('logo'));

            if($result == false){
                return redirect()->route('admin.market.category.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['logo'] = $result;
        }

        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')
            ->with('alert-success','دسته بندی ویرایش شد.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.market.brand.index')
            ->with('alert-success', 'برند مورد نظر حذف شد');
    }

    public function status(Brand $brand)
    {
        $brand->status = $brand->status == 1 ? 0 : 1;
        $result = $brand->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $brand->status == 1
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
