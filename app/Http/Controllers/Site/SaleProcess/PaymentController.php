<?php

namespace App\Http\Controllers\Site\SaleProcess;

use App\Http\Controllers\Controller;
use App\Http\Services\Payment\Gateways\Zarinpal;
use App\Http\Services\Payment\PaymentService;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\Coupon;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment(){
        return view('site.payment.index');
    }

    public function applyCoupon(Request $request){
        $request->validate([
            'code' => 'required|string'
        ]);

        $coupon = Coupon::where([
            'code' => $request->code,
            'status' => 1,
            ['start_date', '<', now()],
            ['end_date', '>', now()],
        ])->first();

        if($coupon->type == 1){
            $user_coupon = Coupon::where([
                'code' => $request->code,
                'status' => 1,
                ['start_date', '<', now()],
                ['end_date', '>', now()],
                'user_id' => auth()->user()->id,
            ])->first();

            if($user_coupon == null){
                return redirect()->back();
            }
        }

        $order = Order::where([
            'user_id' => auth()->user()->id,
            'order_status' => 0,
            'coupon_id' => null
        ])->first();

        if($order != null){
            if($coupon->amount_type == 0){
                $couponDiscountPrice = $order->order_final_amount * ($coupon->amount / 100);

                if($couponDiscountPrice > $coupon->discount_selling){
                    $couponDiscountPrice = $coupon->discount_selling;
                }
            }else{
                $couponDiscountPrice = $coupon->amount;
            }

            $order->order_final_amount = $order->order_final_amount - $couponDiscountPrice;
            $order->order_coupon_discount_amount = $couponDiscountPrice;
            $order->order_total_products_discount_amount += $couponDiscountPrice;
            $order->coupon_id = $coupon->id;

            $order->save();
        }

        return redirect()->back();
    }

    public function paymentSubmit(Request $request){
        $request->validate([
            'payment_id' => 'required',
        ]);

        $order = Order::where([
            'user_id' => auth()->user()->id,
            'order_status' => 0,
        ])->first();

        $cartItems = CartItem::where(
            'user_id', auth()->user()->id
        )->get();

        switch ($request->payment_id){
            case 1:
                $targetModel = OnlinePayment::class;
                $paymentType = 0;
                break;
            case 2:
                $targetModel = OfflinePayment::class;
                $paymentType = 1;
                break;
            case 3:
                $targetModel = CashPayment::class;
                $paymentType = 2;
                break;
            default:
                return redirect()->back()->with('alert-danger', 'خطای درگاه پرداخت');
        }

        DB::beginTransaction();

        $payed = $targetModel::create([
            'amount' => $order->order_final_amount,
            'user_id' => auth()->user()->id,
            'pay_date' => now(),
            'status' => 1,
            'gateway' => 'zarinpal',
            'transaction_id' => '',
        ]);

        Payment::create([
            'amount' => $order->order_final_amount,
            'user_id' => auth()->user()->id,
            'pay_date' => now(),
            'type' => $paymentType,
            'paymentable_id' => $payed->id,
            'paymentable_type' => $targetModel,
            'status' => 1
        ]);

        if($request->payment_id == 1){


            $paymentService = new PaymentService(new Zarinpal());
            $paymentResult = $paymentService->requestPayment(
                (int)$order->order_final_amount,
                'سفارش شماره ' . $order->id,
                route('site.sale.payment.callback', ['order' => $order->id, 'onlinePayment' => $payed->id])
            );

            $payed->update([
                'bank_first_response' => $paymentResult
            ]);

            $order->update([
                'order_status' => 3,
            ]);

            foreach ($cartItems as $cartItem){
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->id,
                    'product_object' => $cartItem,
                    'amazing_coupon_id' => $cartItem->product->getActiveAmazingCoupon()->id ?? null,
                    'amazing_coupon_object' => $cartItem->product->getActiveAmazingCoupon(),
                    'amazing_coupon_amount' => $cartItem->product->getDiscountPrice,
                    'number' => $cartItem->number,
                    'final_product_price' => $cartItem->cartItemFinalPrice(),
                    'final_total_price' => $cartItem->cartItemTotalPrice(),
                    'color_id' => $cartItem->color_id,
                    'guarantee_id' => $cartItem->guarantee_id,
                ]);
                $cartItem->delete();
            }

            DB::commit();

            return $paymentService->redirectToGateway($paymentResult['authority']);
        }

        $order->update([
            'order_status' => 3,
        ]);

        foreach ($cartItems as $cartItem){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product->id,
                'product_object' => $cartItem,
                'amazing_coupon_id' => $cartItem->product->getActiveAmazingCoupon()->id ?? null,
                'amazing_coupon_object' => $cartItem->product->getActiveAmazingCoupon(),
                'amazing_coupon_amount' => $cartItem->product->getDiscountPrice,
                'number' => $cartItem->number,
                'final_product_price' => $cartItem->cartItemFinalPrice(),
                'final_total_price' => $cartItem->cartItemTotalPrice(),
                'color_id' => $cartItem->color_id,
                'guarantee_id' => $cartItem->guarantee_id,
            ]);
            $cartItem->delete();
        }

        DB::commit();

        return redirect()->route('site.home')->with('alert-success', 'سفارش شما با موفقیت ثبت شد');
    }

    public function paymentCallback(Request $request, Order $order, OnlinePayment $onlinePayment){
        $authority = $request->get('Authority');

        $paymentService = new PaymentService(new Zarinpal());
        $verifyResult = $paymentService->verifyPayment($onlinePayment->amount, $authority);

        $onlinePayment->update([
            'bank_second_response' => $verifyResult
        ]);

        if(isset($verifyResult['success']) && $verifyResult['success']){
            return redirect()->route('site.home')->with('alert-success', $paymentService->getMessage($verifyResult['code']));
        }else {
            return redirect()->route('site.sale.payment.index')->with('alert-danger', $paymentService->getMessage($verifyResult['code']));
        }
    }
}
