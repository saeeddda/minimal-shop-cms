<?php

namespace App\Http\Controllers\Site\SaleProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\SaleProcess\AddAddressRequest;
use App\Http\Requests\Site\SaleProcess\SetAddressAndDeliveryRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Market\CartItem;
use App\Models\Market\Delivery;
use App\Models\Market\GeneralCoupon;
use App\Models\Market\Order;
use App\Models\Province;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function shipping()
    {
        $deliveries = Delivery::where('status', 1)->get();
        $addresses = Address::where([
            'status' => 1,
            'user_id' => auth()->user()->id,
        ])->get();
        $provinces = Province::all();
        $cities = City::all();
        $cartItems = CartItem::where('user_id', auth()->user()->id)->get();

        return view('site.shipping.index', compact('deliveries', 'addresses', 'provinces', 'cities', 'cartItems'));
    }

    public function addAddress(AddAddressRequest $request)
    {
        $inputs = $request->all();

        $inputs['user_id'] = auth()->user()->id;
        $inputs['status'] = 1;

        $address = Address::create($inputs);

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }

    public function setAddressAndDelivery(SetAddressAndDeliveryRequest $request){
        $user_id = auth()->user()->id;
        $inputs = $request->all();
        $inputs['user_id'] = $user_id;

        //price
        $cartItems = CartItem::where('user_id', $user_id)->get();

        $totalItemsPrice = 0;
        $totalFinalPrice = 0;
        $totalDiscountPrice = 0;
        $totalFinalDiscountWithNumber = 0;

        foreach ($cartItems as $cartItem){
            $totalItemsPrice += $cartItem->cartItemTotalPrice();
            $totalDiscountPrice += $cartItem->cartItemDiscountPrice();
            $totalFinalPrice += $cartItem->cartItemFinalPrice();
            $totalFinalDiscountWithNumber += $cartItem->cartItemTotalDiscount();
        }

        $generalDiscount = GeneralCoupon::where([
            ['status', '1'],
            ['start_date', '<', now()],
            ['end_date', '>', now()],
        ])->first();

        $finalPrice = $totalFinalPrice;

        if($generalDiscount != null){
            $generalPercentagePrice = $totalFinalPrice * ($generalDiscount->percentage / 100);

            if($generalPercentagePrice > $generalDiscount->discount_selling){
                $generalPercentagePrice = $generalDiscount->discount_selling;
            }

            if($totalFinalPrice >= $generalDiscount->minimum_order_amount){
                $finalPrice = $totalFinalPrice - $generalPercentagePrice;
            }else{
                $finalPrice = $totalFinalPrice;
            }

            $inputs['general_coupon_id'] = $generalDiscount->id;
            $inputs['order_discount_amount'] = $totalFinalDiscountWithNumber;
            $inputs['order_general_coupon_discount_amount'] = $generalPercentagePrice;
            $inputs['order_total_products_discount_amount'] = $inputs['order_discount_amount'] + $inputs['order_general_coupon_discount_amount'];
        }

        $inputs['order_final_amount'] = $finalPrice;
        $inputs['delivery_amount'] = Delivery::find($request->delivery_id)->amount;

        $order = Order::updateOrCreate([
            'user_id' => $user_id,
            'order_status' => 0,
        ], $inputs);

        return redirect()->route('site.sale.payment.index');
    }
}
