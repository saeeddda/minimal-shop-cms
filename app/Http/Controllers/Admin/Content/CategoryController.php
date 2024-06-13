<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    public function index()
    {
        $postCategories = PostCategory::simplePaginate(15);
        return view('admin.content.category.index', compact('postCategories'));
    }

    public function create()
    {
        return view('admin.content.category.create');
    }

    public function store(PostCategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if(!$result){
                return redirect()->route('admin.content.category.index')
                ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }

        $postCategory = PostCategory::create($inputs);

        return redirect()->route('admin.content.category.index')
        ->with('alert-success','دسته بندی جدید اضافه شد.');
    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.content.category.edit', compact('postCategory'));
    }

    public function update(PostCategoryRequest $request, PostCategory $postCategory, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('image')){
            if(!empty($postCategory->image)){
                $imageService->deleteDirectoryAndFiles($postCategory->image['directory']);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result == false){
                return redirect()->route('admin.content.category.index')
                ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }else{
            if(isset($inputs['current_image']) && !empty($postCategory->image)){
                $image = $postCategory->image;
                $image['current_image'] = $inputs['current_image'];
                $inputs['image'] = $image;
            }
        }

        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index')
            ->with('alert-success','دسته بندی ویرایش شد.');
    }

    public function destroy(PostCategory $postCategory)
    {
        $result = $postCategory->delete();
        return redirect()->route('admin.content.category.index')
        ->with('alert-success', 'دسته بندی مورد نظر حذف شد');
    }

    public function status(PostCategory $postCategory){
        $postCategory->status = $postCategory->status == 1 ? 0 : 1;
        $result = $postCategory->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $postCategory->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
