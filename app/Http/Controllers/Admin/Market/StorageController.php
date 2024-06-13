<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AddStorageRequest;
use App\Http\Requests\Admin\Market\UpdateStorageRequest;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('updated_at','desc')->simplePaginate(15);
        return view('admin.market.storage.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToStorage(Product $product)
    {
        return view('admin.market.storage.add-to-storage', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddStorageRequest $request, Product $product)
    {
        $product->marketable_number += $request->marketable_number;
        $product->save();
        Log::info("Add to storage, pid: $product->id, qty: $request->marketable_number, receiver: $request->receiver, delivery: $request->delivery, desc: $request->description");
        return redirect()->route('admin.market.storage.index')
            ->with('alert-success', 'افزایش موجودی با موفقیت انجام شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.market.storage.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStorageRequest $request, Product $product)
    {
        $product->marketable_number = $request->marketable_number;
        $product->frozen_number = $request->frozen_number;
        $product->sold_number = $request->sold_number;
        $product->save();
        return redirect()->route('admin.market.storage.index')
            ->with('alert-success', 'ویرایش موجودی با موفقیت انجام شد');
    }
}
