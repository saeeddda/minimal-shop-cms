<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $attributes = CategoryAttribute::all();
        return view('admin.market.property.index', compact('attributes'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.market.property.create', compact('categories'));
    }

    public function store(CategoryAttributeRequest $request)
    {
        $inputs = $request->all();
        CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.property.index')
            ->with('alert-success','فرم کالا جدید افزوده شد.');
    }

    public function edit(CategoryAttribute $categoryAttribute)
    {
        $categories = ProductCategory::all();
        return view('admin.market.property.edit', compact('categories', 'categoryAttribute'));
    }

    public function update(CategoryAttributeRequest $request, CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->all();
        $categoryAttribute->update($inputs);
        return redirect()->route('admin.market.property.index')
            ->with('alert-success','فرم کالا ویرایش شد.');
    }

    public function destroy(CategoryAttribute $categoryAttribute)
    {
        $categoryAttribute->delete();
        return redirect()->route('admin.market.property.index')
            ->with('alert-success','فرم کالا حذف شد.');
    }
}
