<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function index(Product $product){
        return view('admin.market.product.color.index', compact('product'));
    }

    public function create(Product $product){
        return view('admin.market.product.color.create', compact('product'));
    }

    public function store(Request $request, Product $product){
        $validated = $request->validate([
            'color_name' => 'required|min:3',
            'price_increase' => 'required|numeric',
            'color_code' => 'required|string'
        ]);

        $inputs = $request->all();

//        dd($inputs);

        $inputs['product_id'] = $product->id;

        ProductColor::create($inputs);
        return redirect()->route('admin.market.product.color.index', $product->id)
            ->with('alert-success','رنگ جدید محصول افزوده شد.');
    }

    public function destroy(Product $product, ProductColor $productColor){
        $productColor->delete();
        return redirect()->route('admin.market.product.color.index', $product->id)
            ->with('alert-success','رنگ محصول حذف شد.');
    }
}
