<?php

namespace App\Http\Controllers\Site\SaleProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        if (auth()->check()) {
            $cartItems = CartItem::where('user_id', auth()->user()->id)->get();
            $relatedProducts = Product::all();

            return view('site.cart.cart', compact('cartItems', 'relatedProducts'));
        }

        return redirect()->route('site.auth.login-register');
    }

    public function updateCart(Request $request)
    {
        $inputs = $request->all();
        $cartItems = CartItem::where('user_id', auth()->user()->id)->get();

        foreach ($cartItems as $item){
            if(isset($inputs['number'][$item->id])){
                $item->number = $inputs['number'][$item->id];
                $item->save();
            }
        }

        return back();
    }

    public function addToCart(Request $request, Product $product)
    {
        if (auth()->check()) {
            $request->validate([
                'color' => 'nullable|exists:product_colors,id',
                'guarantee' => 'nullable|exists:guarantees,id',
                'quantity' => 'required|numeric',
            ]);

            $cartItems = CartItem::where([
                'product_id' => $product->id,
                'user_id' => auth()->user()->id,
            ])->get();

            if (!isset($request->color)) $request->color = null;

            if (!isset($request->guarantee)) $request->guarantee = null;

            foreach ($cartItems as $item) {
                if ($item->color_id == $request->color && $item->guarantee_id == $request->guarantee) {
                    $item->update(['number' => $item->number + $request->quantity]);
                    return back()->with('alert-success', 'محصول به سبد خرید اضافه شد.');
                }
            }

            $inputs['color_id'] = $request->color;
            $inputs['guarantee_id'] = $request->guarantee;
            $inputs['user_id'] = auth()->user()->id;
            $inputs['product_id'] = $product->id;
            $inputs['number'] = $request->quantity;

            CartItem::create($inputs);

            return back()->with('alert-success', 'محصول به سبد خرید اضافه شد.');
        }

        return redirect()->route('site.auth.login-register');
    }

    public function removeFromCart(CartItem $cartItem)
    {
        if (auth()->check() && $cartItem->user == auth()->user()) {
            $cartItem->delete();
            return back()->with('alert-success', 'محصول از سبد خرید حذف شد.');
        }

        return redirect()->route('site.auth.login-register');
    }
}
