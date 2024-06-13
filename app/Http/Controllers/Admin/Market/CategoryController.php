<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.category.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.category.create', [
            'allCategoreis' => ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result == false){
                return redirect()->route('admin.market.category.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }

        ProductCategory::create($inputs);

        return redirect()->route('admin.market.category.index')
            ->with('alert-success','دسته بندی جدید اضافه شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.market.category.edit', [
            'productCategory' => $productCategory,
            'allCategoreis' => ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image')){
            if(!empty($productCategory->image)){
                $imageService->deleteDirectoryAndFiles($productCategory->image['directory']);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result == false){
                return redirect()->route('admin.market.category.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }else{
            if(isset($inputs['current_image']) && !empty($productCategory->image)){
                $image = $productCategory->image;
                $image['current_image'] = $inputs['current_image'];
                $inputs['image'] = $image;
            }
        }

        $productCategory->update($inputs);
        return redirect()->route('admin.market.category.index')
            ->with('alert-success','دسته بندی ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect()->route('admin.market.category.index')
            ->with('alert-success', 'دسته بندی مورد نظر حذف شد');
    }

    public function status(ProductCategory $productCategory){
        $productCategory->status = $productCategory->status == 1 ? 0 : 1;
        $result = $productCategory->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $productCategory->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function showChange(ProductCategory $productCategory){
        $productCategory->show_in_menu = $productCategory->show_in_menu == 1 ? 0 : 1;
        $result = $productCategory->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $productCategory->show_in_menu == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
