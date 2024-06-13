<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingCouponRequest;
use App\Http\Requests\Admin\Market\CouponRequest;
use App\Http\Requests\Admin\Market\GeneralCouponRequest;
use App\Models\Market\AmazingCoupon;
use App\Models\Market\Coupon;
use App\Models\Market\GeneralCoupon;
use App\Models\Market\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CopounController extends Controller
{
    //---------------- Discount -----------------------//
    public function discount()
    {
        $coupons = Coupon::simplePaginate(15);
        return view('admin.market.coupon.discount.index', compact('coupons'));
    }

    public function discountCreate()
    {
        $users = User::all();
        return view('admin.market.coupon.discount.create', compact('users'));
    }

    public function discountStore(CouponRequest $request)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimeStampEnd);

        $inputs['user_id'] = $request->type == 1 ? $request->user_id : null;

        Coupon::create($inputs);

        return redirect()->route('admin.market.coupon.discount.index')->with('alert-success', 'کد تخفیف با موفقیت افزوده شد.');
    }

    public function discountEdit(Coupon $coupon)
    {
        $users = User::all();
        return view('admin.market.coupon.discount.edit', compact('coupon', 'users'));
    }

    public function discountUpdate(CouponRequest $request, Coupon $coupon)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimeStampEnd);

        $inputs['user_id'] = $request->type == 1 ? $request->user_id : null;

        $coupon->update($inputs);

        return redirect()->route('admin.market.coupon.discount.index')->with('alert-success', 'کد تخفیف با موفقیت ویرایش شد.');
    }

    public function discountDestroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.market.coupon.discount.index')->with('alert-success', 'کد تخفیف حذف شد.');
    }

    public function discountStatus(Coupon $coupon)
    {
        $coupon->status = $coupon->status == 1 ? 0 : 1;
        $result = $coupon->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $coupon->status == 1
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    //---------------- General -----------------------//
    public function generalDiscount()
    {
        $generalDiscounts = GeneralCoupon::simplePaginate(15);
        return view('admin.market.coupon.general.index', compact('generalDiscounts'));
    }

    public function generalDiscountCreate()
    {
        return view('admin.market.coupon.general.create');
    }

    public function generalDiscountStore(GeneralCouponRequest $request)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimeStampEnd);

        GeneralCoupon::create($inputs);
        return redirect()->route('admin.market.coupon.general.index')->with('alert-success', 'کوپن عمومی با موفقیت ایجاد شد.');
    }

    public function generalDiscountEdit(GeneralCoupon $generalCoupon)
    {
        return view('admin.market.coupon.general.edit', compact('generalCoupon'));
    }

    public function generalDiscountUpdate(GeneralCouponRequest $request, GeneralCoupon $generalCoupon)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimeStampEnd);

        $generalCoupon->update($inputs);
        return redirect()->route('admin.market.coupon.general.index')->with('alert-success', 'کوپن عمومی با موفقیت ویرایش شد.');
    }

    public function generalDiscountDestroy(GeneralCoupon $generalCoupon)
    {
        $generalCoupon->delete();
        return redirect()->route('admin.market.coupon.general.index')->with('alert-success', 'کوپن عمومی با موفقیت حذف شد.');
    }

    public function generalDiscountStatus(GeneralCoupon $generalCoupon){
        $generalCoupon->status = $generalCoupon->status == 1 ? 0 : 1;
        $result = $generalCoupon->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $generalCoupon->status == 1
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    //---------------- Amazing -----------------------//
    public function amazingDiscount()
    {
        $amazingDiscounts = AmazingCoupon::simplePaginate(15);
        return view('admin.market.coupon.amazing.index', compact('amazingDiscounts'));
    }

    public function amazingDiscountCreate()
    {
        $products = Product::where(['status'=> 1, 'marketable' => 1])->get();
        return view('admin.market.coupon.amazing.create', compact('products'));
    }

    public function amazingDiscountStore(AmazingCouponRequest $request)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimeStampEnd);

        AmazingCoupon::create($inputs);
        return redirect()->route('admin.market.coupon.amazing.index')->with('alert-success', 'کوپن عمومی با موفقیت ایجاد شد.');
    }

    public function amazingDiscountEdit(AmazingCoupon $amazingCoupon)
    {
        $products = Product::where(['status'=> 1, 'marketable' => 1])->get();
        return view('admin.market.coupon.amazing.edit', compact('amazingCoupon', 'products'));
    }

    public function amazingDiscountUpdate(AmazingCouponRequest $request, AmazingCoupon $amazingCoupon)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int) $realTimeStampEnd);

        $amazingCoupon->update($inputs);
        return redirect()->route('admin.market.coupon.amazing.index')->with('alert-success', 'کوپن عمومی با موفقیت ویرایش شد.');
    }

    public function amazingDiscountDestroy(AmazingCoupon $amazingCoupon)
    {
        $amazingCoupon->delete();
        return redirect()->route('admin.market.coupon.amazing.index')->with('alert-success', 'کوپن عمومی با موفقیت حذف شد.');
    }

    public function amazingDiscountStatus(AmazingCoupon $amazingCoupon){
        $amazingCoupon->status = $amazingCoupon->status == 1 ? 0 : 1;
        $result = $amazingCoupon->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $amazingCoupon->status == 1
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
