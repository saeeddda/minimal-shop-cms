<?php

namespace App\Http\Controllers\Site\Market;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Market\Brand;
use App\Models\Market\Compare;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Product $product){
        $relatedProducts = Product::with('category')->whereHas('category', function ($query) use ($product){
            $query->where('id', $product->category->id);
        })->get()->except($product->id);

        return view('site.product.single', compact('product', 'relatedProducts'));
    }

    public function commentStore(Request $request, Product $product){
        $request->validate([
            'body' => 'required|max:360'
        ]);

        $inputs['body'] = str_replace(PHP_EOL,'<br>', $request->body);
        $inputs['author_id'] = auth()->user()->id;
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;

        Comment::create($inputs);

        return back();
    }

    public function addToFavorite(Product $product){
        $product->user()->toggle([auth()->user()->id]);
        return response()->json([
            'success' => true,
            'type' => $product->user->contains(auth()->user()->id) ? 0 : 1,
        ]);
    }

    public function addToCompare(Product $product){
        $user = auth()->user();

        if($user->compare()->count() > 0)
        {
            $userCompareList = $user->compare;
        }else{
            $userCompareList = Compare::create([
                'user_id' => $user->id
            ]);
        }

        $product->compares()->toggle([$userCompareList->id]);
        return response()->json([
            'success' => true,
            'type' => $product->compares->contains($userCompareList->id) ? 0 : 1,
        ]);
    }

    public function products(Request $request, ProductCategory $category = null){
        $brands = Brand::where('status', 1)->get();

        $categories = ProductCategory::whereNull('parent_id')->get();

        if($category)
            $products = $category->products();
        else
            $products = new Product();

        $sortType = 'created_at';
        $sortDirection = 'desc';

        switch ($request->sort){
            case 1;
                $sortType = 'created_at';
                $sortDirection = 'desc';
                break;
            case 3;
                $sortType = 'price';
                $sortDirection = 'desc';
                break;
            case 4;
                $sortType = 'price';
                $sortDirection = 'asc';
                break;
            case 6;
                $sortType = 'sold_number';
                $sortDirection = 'desc';
                break;
        }

        if(!empty($request->search)){
            $products = $products->where('name', 'like', '%' . $request->search . '%')->orderBy($sortType, $sortDirection);
        }else{
            $products = $products->orderBy($sortType, $sortDirection);
        }

        if($request->min_price && $request->max_price){
            $products = $products->whereBetween('price', [$request->min_price, $request->max_price]);
        }else{
            $products = $products->when($request->min_price, function ($products) use ($request){
                $products->where('price', '>=', $request->min_price)->get();
            })->when($request->max_price, function ($products) use ($request){
                $products->where('price', '>=', $request->max_price)->get();
            });
        }

        $products = $products->when($request->brands, function () use ($request, $products){
            $products->where('brand_id', $request->brands)->get();
        });

        $products = $products->paginate();
        $products->appends($request->query());

        $selectedBrands = [];
        if(isset($request->brands)){
            $selectedBrand = Brand::find($request->brands);
            foreach ($selectedBrand as $brand){
                $selectedBrands[] = $brand->persian_name;
            }
        }

        return view('site.product.archive', compact('products', 'brands', 'selectedBrands', 'categories'));
    }

    public function rateProduct(Product $product){
        if(auth()->check())
            auth()->user()->rate($product, 5);

        return back();
    }
}
