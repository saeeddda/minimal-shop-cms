@extends('admin.layouts.master')
@section('title', 'ادمین - فاکتور سفارش')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'فاکتور سفارش'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    فاکتور سفارش
                                    <small class="float-right">تاریخ ثبت : {{ jalaliDate($order->created_at) }}</small>
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row invoice-info">
                            <div class="col-sm-6 invoice-col">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th style="width: 50%">سفارش شماره :</th>
                                            <td>{{ $order->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>تاریخ پرداخت :</th>
                                            <td>{{ jalaliDate($order->payment->paymentable->pay_date) }}</td>
                                        </tr>
                                        <tr>
                                            <th>وضعیت پرداخت :</th>
                                            <td>{{ $order->getOrderPaymentStatus }}</td>
                                        </tr>
                                        <tr>
                                            <th>وضعیت سفارش :</th>
                                            <td>{{ $order->getOrderStatus }}</td>
                                        </tr>
                                        <tr>
                                            <th>وضعیت ارسال :</th>
                                            <td>{{ $order->getOrderDeliveryStatus }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-6 invoice-col">
                                <address>
                                    <strong>{{ $order->user->fullName }}</strong><br>
                                    آدرس : {{ $order->userFullAddress }}<br>
                                    تلفن : {{ $order->address->mobile }}<br>
                                    ایمیل : {{ $order->user->email }}
                                </address>
                            </div>
                        </div>
                        <br>
                        <h6>لیست محصولات</h6>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>محصول</th>
                                            <th>تعداد</th>
                                            <th>توضیحات</th>
                                            <th>تخفیف شگفت انگیز</th>
                                            <th>قیمت فی</th>
                                            <th>جمع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>{{ $item->product->id }}</td>
                                                <td>
                                                    {{ $item->product->name }}
                                                    <p class="text-muted">
                                                        ویژگی ها :
                                                        @forelse($item->orderItemAttribute as $attribute)
                                                            {{ $attribute->categoryAttribute->name ?? '-' }} : {{ json_decode($attribute->categoryAttributeValue->value)->value ?? '-' }}
                                                        @empty
                                                            ندارد
                                                        @endforelse
                                                    </p>
                                                </td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{ $item->itemDescription }}</td>
                                                <td>{{ $item->amazing_coupon_amount ?? '0' }} تومان</td>
                                                <td>{{ $item->final_product_price }} تومان</td>
                                                <td>{{ $item->final_total_price }} تومان</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">روش پرداخت:</p>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">روش : </th>
                                            <td>{{ $order->getOrderPaymentType }} - درگاه : {{ $order->payment->paymentable->gateway ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>تاریخ : </th>
                                            <td>{{ jalaliDate($order->payment->paymentable->pay_date) }}</td>
                                        </tr>
                                        <tr>
                                            <th>وضعیت : </th>
                                            <td>{{ $order->getOrderPaymentStatus }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p class="lead pt-1">روش ارسال:</p>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">وضعیت ارسال : </th>
                                            <td>{{ $order->getOrderDeliveryStatus }}</td>
                                        </tr>
                                        <tr>
                                            <th>روش : </th>
                                            <td>{{ $order->delivery->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-6">
                                <p class="lead">جمع کل فاکتور</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">جمع فاکتور :</th>
                                            <td>{{ $order->order_final_amount }} تومان</td>
                                        </tr>
                                        <tr>
                                            <th>تخفیف کالا ها :</th>
                                            <td>{{ $order->order_total_products_discount_amount ?? '0' }} تومان</td>
                                        </tr>
                                        <tr>
                                            <th>جمع تخفیفات :</th>
                                            <td>{{ $order->order_discount_amount ?? '0' }} تومان
                                                <span class="text-muted">عنوان : {{ ( $order->generalCoupon->title ?? $order->coupon->code ) ?? '-' }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>مبلغ ارسال :</th>
                                            <td>{{ $order->delivery->amount }} تومان</td>
                                        </tr>
                                        <tr>
                                            <th>جمع کل:</th>
                                            <td>{{ $order->getOrderTotalAmount }} تومان</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('admin.market.order.print', $order->id) }}" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> پرینت</a>
                                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card ml-2"></i>تائید پرداخت</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
