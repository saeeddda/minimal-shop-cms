<?php

namespace App\Http\Controllers\Site\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if($request->get('type') != null){
            $orders = auth()->user()->orders()->where('order_status', $request->get('type'))->orderByDesc('id')->get();
        }else{
            $orders = auth()->user()->orders()->orderByDesc('id')->get();
        }

        return view('site.account.order-list', compact('orders'));
    }
}
