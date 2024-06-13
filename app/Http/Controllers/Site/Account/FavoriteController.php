<?php

namespace App\Http\Controllers\Site\Account;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('site.account.favorite-list');
    }

    public function removeFavorite(Product $product)
    {
        auth()->user()->products()->detach($product);
        return redirect()->route('site.account.favorite.index');
    }
}
