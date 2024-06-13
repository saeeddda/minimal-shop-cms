<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductGallery;
use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{
    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.gallery.create', compact('product'));
    }

    public function store(Request $request, Product $product, ImageService $imageService)
    {
        $validated = $request->validate([
            'image' => 'required|image:jpg,jpeg,png,gif'
        ]);

        $inputs = $request->all();

        if($request->hasFile('image')){
            $imageService->setExclusiveDirectory( 'images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if(!$result){
                return redirect()->route('admin.market.product.gallery.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }

        $inputs['product_id'] = $product->id;

        ProductGallery::create($inputs);
        return redirect()->route('admin.market.product.gallery.index', $product->id)
            ->with('alert-success','تصویر به گالری محصول افزوده شد.');
    }

    public function destroy(Product $product, ProductGallery $productGallery)
    {
        $productGallery->delete();
        return redirect()->route('admin.market.product.gallery.index', $product->id)
            ->with('alert-success','تصویر گالری محصول حذف شد.');
    }
}
