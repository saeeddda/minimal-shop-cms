<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\GuaranteeRequest;
use App\Models\Market\Guarantee;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class ProductGuaranteeController extends Controller
{
    public function index(Product $product)
    {
        return view('admin.market.product.guarantee.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.guarantee.create', compact('product'));
    }

    public function store(GuaranteeRequest $request, Product $product)
    {
        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        Guarantee::create($inputs);
        return view('admin.market.product.guarantee.index', compact('product'))
            ->with('alert-success', 'گارانتی با موفقیت افزوده شد');
    }

    public function destroy(Product $product, Guarantee $guarantee)
    {
        $guarantee->delete();
        return view('admin.market.product.guarantee.index', compact('product'))
            ->with('alert-success', 'گارانتی با موفقیت حذف شد');
    }
}
