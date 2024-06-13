<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use DB;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\DeclareDeclare;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('updated_at','desc')->simplePaginate(15);
        return view('admin.market.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        $productBrands = Brand::all();
        return view('admin.market.product.create', compact( 'productCategories', 'productBrands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        if($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result == false){
                return redirect()->route('admin.market.product.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }

        DB::transaction(function ()use($request, $inputs){
            $product = Product::create($inputs);

            $product_meta = array_combine($request->meta_key, $request->meta_value);
            foreach ($product_meta as $key => $value) {
                ProductMeta::create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id' => $product->id,
                ]);
            }
        });

        return redirect()->route('admin.market.product.index')
            ->with('alert-success','محصول جدید اضافه شد.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::all();
        $productBrands = Brand::all();
        return view('admin.market.product.edit', compact('product', 'productBrands', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        if($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result == false){
                return redirect()->route('admin.market.product.index')
                    ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }

        DB::transaction(function ()use($request, $inputs){
            $product = Product::create($inputs);

            $product_meta = array_combine($request->meta_key, $request->meta_value);
            foreach ($product_meta as $key => $value) {
                ProductMeta::create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'product_id' => $product->id,
                ]);
            }
        });

        return redirect()->route('admin.market.product.index')
            ->with('alert-success','محصول ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.market.product.index')
            ->with('alert-success','محصول حذف شد.');
    }

    public function status(Product $product)
    {
        //
    }

    public function marketable(Product $product)
    {
        //
    }
}
