<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{
    public function index(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.index', compact('categoryAttribute'));
    }

    public function create(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.create', compact('categoryAttribute'));
    }

    public function store(CategoryValueRequest $request, CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->all();
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $inputs['value'] = json_encode([
            'value' => $request->value,
            'price_increase' => $request->price_increase
        ]);
        CategoryValue::create($inputs);
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)
            ->with('alert-success','مقدار فرم کالا افزوده شد.');
    }

    public function edit(CategoryAttribute $categoryAttribute, CategoryValue $categoryValue)
    {
        return view('admin.market.property.value.edit', compact('categoryAttribute', 'categoryValue'));
    }

    public function update(CategoryValueRequest $request, CategoryAttribute $categoryAttribute, CategoryValue $categoryValue)
    {
        $inputs = $request->all();
        $inputs['category_attribute_id'] = $categoryAttribute->id;
        $inputs['value'] = json_encode([
            'value' => $request->value,
            'price_increase' => $request->price_increase
        ]);
        $categoryValue->update($inputs);
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)
            ->with('alert-success','مقدار فرم کالا ویرایش شد.');
    }

    public function destroy(CategoryAttribute $categoryAttribute, CategoryValue $categoryValue)
    {
        $categoryValue->delete();
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)
            ->with('alert-success','مقدار فرم کالا حذف شد.');
    }
}
